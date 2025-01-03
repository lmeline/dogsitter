<?php
namespace App\Http\Controllers;

use Cmgmyr\Messenger\Models\Thread;
use App\Models\User;
use Cmgmyr\Messenger\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
  
    public function index()
    {
        // Récupérer tous les threads de l'utilisateur
        $threads = Thread::whereHas('participants', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest()->get();
    
        // Calculer le nombre de messages non lus pour cet utilisateur
        $unreadCount = $threads->reduce(function ($carry, $thread) {
            return $carry + $thread->messages()->where('lu', false)
                                              ->where('user_id', '!=', Auth::id())
                                              ->count();
        }, 0);
    
        // Passer $unreadCount à la vue
        return view('messages.index', compact('threads', 'unreadCount'));
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
    // Validation des champs du formulaire
    $request->validate([
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'participants' => 'required|array|min:1',
        'participants.*' => 'exists:users,id',
    ]);

    // Création du thread
    $thread = Thread::create([
        'subject' => $request->input('subject'),
    ]);

    // Ajout du premier message
    $thread->messages()->create([
        'user_id' => Auth::id(),
        'body' => $request->input('message'),
    ]);

    // Ajout des participants (y compris l'utilisateur authentifié)
    $participants = array_merge($request->input('participants'), [Auth::id()]);
    $thread->addParticipant($participants);

    return redirect()->route('messages.index')->with('success', 'Conversation créée.');
}

}