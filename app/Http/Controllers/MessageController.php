<?php

namespace App\Http\Controllers;

use Cmgmyr\Messenger\Models\Thread;
use App\Models\User;
use Cmgmyr\Messenger\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $proprietaires = User::where('role', 'proprietaire')->get();
        $search = $request->input('search');

        $threads = Thread::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->whereHas('users', function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
            })
            ->with(['users', 'messages' => function ($query) {
                $query->latest();
            }])
            ->get();

        $unreadCount = $threads->reduce(function ($carry, $thread) {
            return $carry + $thread->messages()
                ->where('lu', false)
                ->where('user_id', '!=', Auth::id())
                ->count();
        }, 0);

        return view('messages.index', compact('threads', 'unreadCount', 'search', 'proprietaires'));
    }


    public function show($id)
    {

        $thread = Thread::with(['messages.user'])->findOrFail($id);

        if (!$thread->participants()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('messages.index')->with('error', 'Vous n\'êtes pas autorisé à voir cette conversation.');
        }

        $thread->messages()->where('lu', false)
            ->where('user_id', '!=', Auth::id())
            ->update(['lu' => true]);
        $participants = $thread->participants;
        return view('messages.show', compact('thread', 'participants'));
    }
    public function showProfile($dogsitterId)
    {
        $dogsitter = User::findOrFail($dogsitterId);

        return view('messages.createDogsitter', compact('dogsitter'));
    }

    public function createDogsitter($dogsitterId)
    {
        $user = Auth::user();

        $dogsitter = User::findOrFail($dogsitterId);

        $thread = Thread::whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })
            ->whereHas('users', function ($query) use ($dogsitter) {
                $query->where('users.id', $dogsitter->id);
            })
            ->first();

        if ($thread) {
            return redirect()->route('messages.show', $thread->id);
        }

        return view('messages.createDogsitter', ['dogsitter' => $dogsitter]);
    }



    public function addMessage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $thread = Thread::findOrFail($id);

        if (!$thread->participants()->where('user_id', Auth::id())->exists()) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Non autorisé.'], 403);
            }
            return redirect()->route('messages.index')->with('error', 'Vous n\'êtes pas autorisé à envoyer un message dans cette conversation.');
        }

        $message = $thread->messages()->create([
            'user_id' => Auth::id(),
            'body' => $request->input('message'),
            'lu' => false,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message_id' => $message->id]);
        }

        return redirect()->route('messages.show', $id)->with('success', 'Message envoyé.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'participants' => 'required|array',
            'participants.*' => 'exists:users,id',
        ]);

        $subject = $validated['subject'] ?? $request->dogsitter->name;

        $thread = Thread::create([
            'subject' => $subject,
        ]);

        $thread->users()->attach([Auth::id(), ...$validated['participants']]);


        $thread->messages()->create([
            'user_id' => Auth::id(),
            'body' => $validated['message'],
            'lu' => false,
        ]);

        return redirect()->route('messages.show', $thread->id);
    }

    public function searchOwner(Request $request)
    {
        try {
            $query = User::query();
            $query->where('role', 'proprietaire');

            if ($request->filled('name')) {
                $query->where('name', 'LIKE', "%{$request->name}%");
            }
            $users = $query->get();
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function searchDogsitter(Request $request)
    {
        try {
            $query = User::query();
            $query->where('role', 'dogsitter');

            if ($request->filled('name')) {
                $query->where('name', 'LIKE', "%{$request->name}%");
            }
            $users = $query->get();
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function fetchMessages(Thread $thread)
    {
        try {

            $messages = $thread->messages()->with('user')->oldest()->get();

            $formattedMessages = $messages->map(function ($message) {
                return [
                    'id' => $message->id,
                    'user' => [
                        'name' => $message->user->name,
                        'prenom' => $message->user->prenom,
                    ],
                    'body' => $message->body,
                    'body_formatted' => nl2br(e($message->body)),
                    'created_at' => $message->created_at,
                    'created_at_human' => $message->created_at->diffForHumans(),
                ];
            });

            return response()->json($formattedMessages);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function fetchThreads(Request $request)
    {
        try {
            $user = Auth::user();
            $search = $request->input('search'); // Pour la recherche dans les threads

            $threads = Thread::whereHas('participants', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // Ajoutez un filtre de recherche si le terme est présent
            ->when($search, function ($query, $search) {
                $query->whereHas('users', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('prenom', 'like', '%' . $search . '%');
                });
            })
            ->with(['users', 'messages' => function ($query) {
                // Charge uniquement le dernier message de chaque thread
                $query->latest()->limit(1);
            }])
            ->get();

            $formattedThreads = $threads->map(function ($thread) use ($user) {
                $otherUser = $thread->users->where('id', '!=', $user->id)->first();

                // Si pour une raison bizarre il n'y a pas d'autre utilisateur, on ignore ce thread
                if (!$otherUser) {
                    return null;
                }

                $unreadCountThread = $thread->messages()
                    ->where('lu', false)
                    ->where('user_id', '!=', $user->id) // Messages non lus reçus par l'utilisateur actuel
                    ->count();

                $lastMessage = $thread->messages->first(); // Le premier message de la collection (car on a fait latest()->limit(1))

                return [
                    'id' => $thread->id,
                    'other_user_name' => $otherUser->name . ' ' . $otherUser->prenom,
                    'other_user_photo' => asset($otherUser->photo ?? 'images/default-avatar.jpg'),
                    'last_message_sender' => $lastMessage ? $lastMessage->user->name : '',
                    'unread_count' => $unreadCountThread,
                    'thread_url' => route('messages.show', $thread->id),
                ];
            })->filter()->values(); // Filtre les nulls et réindexe

            return response()->json($formattedThreads);

        } catch (\Exception $e) {
           
            return response()->json(['error' => 'Erreur de serveur.'], 500);
        }
    }
}
