<?php
namespace App\Http\Controllers;

use Cmgmyr\Messenger\Models\Thread;
use App\Models\User;
use Cmgmyr\Messenger\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    
    public function createProprietaire($proprietaire)
    {
        // $user = Auth::user();
        
        // $thread = Thread::whereHas('users', function ($query) use ($user) {
        //     $query->where('users.id', $user->id);
        // })
        // ->whereHas('users', function ($query) use ($proprietaire) {
        //     $query->where('users.id', $proprietaire);
        // })
        // ->first();

        // if ($thread) {

        //     return redirect()->route('messages.show', $thread->id);
        // }

        return view('messages.createProprietaire', ['proprietaire' => $proprietaire]);
    }

        public function addMessage(Request $request, $id)
    {
        
        $request->validate([
            'message' => 'required|string|max:500', 
        ]);

    
        $thread = Thread::findOrFail($id);

        if (!$thread->participants()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('messages.index')->with('error', 'Vous n\'êtes pas autorisé à envoyer un message dans cette conversation.');
        }

        $thread->messages()->create([
            'user_id' => Auth::id(), 
            'body' => $request->input('message'), 
        ]);

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
        try{
            $query = User::query();
            $query->where('role', 'proprietaire');

            if($request->filled('name')) {
                $query->where('name', 'LIKE', "%{$request->name}%");
            }
            $users = $query->get();
            return response()->json($users);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

}