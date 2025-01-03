<?php
namespace App\Http\Controllers;

use Cmgmyr\Messenger\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Lister tous les threads (indépendamment des participants)
    // public function index()
    // {
    //     // Récupérer tous les threads, triés par date de mise à jour
    //     $threads = Thread::latest('updated_at')->get();

    //     return view('messages.index', compact('threads'));
    // }
    public function index()
    {
        // Récupérer les threads où l'utilisateur est un participant
        $threads = Thread::whereHas('participants', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest('updated_at')->get();
    
        return view('messages.index', compact('threads'));
    }
    // Afficher un thread spécifique et ses messages
    // public function show($id)
    // {
    //     // Récupérer un thread spécifique avec tous ses messages
    //     $thread = Thread::with(['messages.user', 'participants'])->findOrFail($id);

    //     // Passer le thread et ses messages à la vue
    //     return view('messages.show', compact('thread'));
    // }

    public function show($id)
    {
        // Récupérer un thread spécifique avec tous ses messages et les utilisateurs associés
        $thread = Thread::with(['messages.user', 'participants'])->findOrFail($id);
    
        // Vérifier que l'utilisateur fait bien partie du thread
        if (!$thread->participants()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('messages.index')->with('error', 'Vous n\'êtes pas autorisé à voir cette conversation.');
        }
    
        // Passer le thread et ses messages à la vue
        return view('messages.show', compact('thread'));
    }

    // Créer une nouvelle conversation
    public function create()
    {
          $users = User::whereIn('role', ['proprietaire', 'dogsitter'])->get();

        return view('messages.create', compact('users'));
    }

    // Ajouter un message à un thread existant
    public function addMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $thread = Thread::findOrFail($id);

        // Ajouter le message
        $message = $thread->messages()->create([
            'user_id' => Auth::id(),
            'body' => $request->input('message'),
        ]);

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