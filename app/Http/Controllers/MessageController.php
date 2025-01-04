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
        $search = $request->input('search');
    
        $threads = Thread::query()
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
    
        return view('messages.index', compact('threads', 'unreadCount', 'search'));
    }
    
    
    
 
    public function show($id)
    {
        // Récupérer un thread spécifique avec tous ses messages et leurs auteurs (utilisateurs)
        $thread = Thread::with(['messages.user'])->findOrFail($id);
    
        // Vérifier que l'utilisateur fait bien partie du thread
        if (!$thread->participants()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('messages.index')->with('error', 'Vous n\'êtes pas autorisé à voir cette conversation.');
        }
    
        // Marquer tous les messages comme lus pour l'utilisateur actuel
        $thread->messages()->where('lu', false)
              ->where('user_id', '!=', Auth::id()) // Ne pas marquer les messages envoyés par l'utilisateur comme lus
              ->update(['lu' => true]);
    
        // Passer le thread et ses messages à la vue
        return view('messages.show', compact('thread'));
    }
    public function showProfile($dogsitterId)
    {
        // Récupérer le dogsitter en fonction de son ID
        $dogsitter = User::findOrFail($dogsitterId);
    
        // Passer la variable $dogsitter à la vue
        return view('messages.create', compact('dogsitter'));
    }
    


    // Créer une nouvelle conversation
    public function create($dogsitterId)
    {
        // L'utilisateur qui initie la conversation est celui qui est actuellement connecté
        $userId = Auth::id();
    
        // Vérifier si un thread existe déjà entre l'utilisateur actuel et ce dogsitter
        $existingThread = Thread::whereHas('participants', function($query) use ($userId, $dogsitterId) {
            // Vérifie si le thread contient à la fois l'utilisateur actuel et le dogsitter
            $query->where('user_id', $userId)
                  ->orWhere('user_id', $dogsitterId);
        })->first();
    
        // Si un thread existe, rediriger vers ce thread
        if ($existingThread) {
            return redirect()->route('messages.show', $existingThread->id);
        }
    
        // Sinon, créer un nouveau thread
        $thread = Thread::create([
            'subject' => 'Conversation avec ' . $dogsitterId,  // Sujet de la conversation
        ]);
    
        // Ajouter les participants (l'utilisateur actuel et le dogsitter)
        $thread->participants()->attach($userId);  // Ajout de l'utilisateur actuel
        $thread->participants()->attach($dogsitterId);  // Ajout du dogsitter
    
        // Créer le premier message de la conversation
        $message = new Message();
        $message->user_id = $userId;
        $message->body = 'Bonjour, je souhaite vous contacter.';
        $thread->messages()->save($message);  // Sauvegarder le message dans le thread
    
        // Rediriger vers le thread de messages
        return redirect()->route('messages.show', $thread->id);
    }

    public function createOrRedirectToThread($dogsitterId)
{
    $user = Auth::user();

    // Rechercher un thread existant entre l'utilisateur et le dogsitter
    $thread = Thread::whereHas('users', function ($query) use ($user) {
        $query->where('users.id', $user->id);
    })
    ->whereHas('users', function ($query) use ($dogsitterId) {
        $query->where('users.id', $dogsitterId);
    })
    ->first();

    if ($thread) {
        // Rediriger vers le thread existant
        return redirect()->route('messages.show', $thread->id);
    }

    // Créer un nouveau thread
    return view('messages.create', ['dogsitterId' => $dogsitterId]);
}

    

    // Ajouter un message à un thread existant
    public function addMessage(Request $request, $id)
{
    // Valider le message
    $request->validate([
        'message' => 'required|string|max:500', // Vous pouvez ajuster la taille du message si nécessaire
    ]);

    // Récupérer le thread spécifié
    $thread = Thread::findOrFail($id);

    // Vérifier si l'utilisateur est un participant de ce thread
    if (!$thread->participants()->where('user_id', Auth::id())->exists()) {
        return redirect()->route('messages.index')->with('error', 'Vous n\'êtes pas autorisé à envoyer un message dans cette conversation.');
    }

    // Créer et enregistrer le message dans la base de données
    $thread->messages()->create([
        'user_id' => Auth::id(), // L'utilisateur qui envoie le message
        'body' => $request->input('message'), // Le contenu du message
    ]);

    // Rediriger l'utilisateur vers la page du thread avec un message de succès
    return redirect()->route('messages.show', $id)->with('success', 'Message envoyé.');
}


public function store(Request $request)
{
    // Validation du message, participants et subject
    $validated = $request->validate([
        'subject' => 'nullable|string|max:255',  // Rendre le champ subject nullable
        'message' => 'required|string',
        'participants' => 'required|array',
        'participants.*' => 'exists:users,id', // Validation pour les participants
    ]);

    // Si le sujet n'est pas fourni, utiliser le nom du dogsitter comme valeur par défaut
    $subject = $validated['subject'] ?? $request->dogsitter->name;

    // Créer la conversation (thread)
    $thread = Thread::create([
        'subject' => $subject,  // Utilisation du sujet validé ou du nom du dogsitter
    ]);

    // Ajouter les participants au thread (y compris l'utilisateur actuel et les participants)
    $thread->users()->attach([Auth::id(), ...$validated['participants']]);

    // Ajouter le message initial dans cette conversation
    $thread->messages()->create([
        'user_id' => Auth::id(),
        'body' => $validated['message'],
        'lu' => false,
    ]);

    // Rediriger vers la conversation
    return redirect()->route('messages.show', $thread->id);
}



}