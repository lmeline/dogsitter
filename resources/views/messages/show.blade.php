<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="bg-white shadow p-4 rounded-lg">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-800 leading-tight">
                @if($thread->users->count() > 1)
                    @foreach($thread->users as $user)
                        @if($user->id !== auth()->id())
                            {{ $user->name }} {{ $user->prenom }}
                            @break
                        @endif
                    @endforeach
                @endif
            </h2>
            <ul id="message-list" class="space-y-4 mt-4">
                {{-- Les messages initiaux sont chargés ici par Blade (facultatif, peuvent être chargés par JS directement) --}}
                @foreach ($thread->messages as $message)
                    <li class="bg-gray-100 p-4 rounded-lg">
                        <div class="flex justify-between">
                            <span class="font-bold">{{ $message->user->name }} {{ $message->user->prenom }} :</span>
                            <span class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-2 text-gray-700"> {!! nl2br(e($message->body)) !!}</p>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="mt-6">
            <form id="messageForm" action="{{ route('addMessage', $thread->id) }}" method="POST">
                @csrf
                <textarea id="messageInput" name="message" class="w-full p-4 border border-white rounded-lg min-h-[70px] max-h-[300px]"
                    placeholder="Écrire un message..." required></textarea>
                <button type="submit"
                    class="inline-block bg-gradient-to-r from-yellow-300 to-pink-300 px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition w-full">
                    Envoyer
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const messageForm = document.getElementById('messageForm');
            const messageInput = document.getElementById('messageInput');
            const messageList = document.getElementById('message-list');
            const threadId = {{ $thread->id }};
            const fetchMessagesUrl = "{{ route('messages.fetch', $thread->id) }}";

            function fetchMessages() {

                fetch(fetchMessagesUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Erreur HTTP ! statut : ${response.status}`);
                    }
                    return response.json(); 
                })
                .then(messages => {
                
                    messageList.innerHTML = ''; 

                    messages.forEach(message => {
                        const li = document.createElement('li');
                        li.className = 'bg-gray-100 p-4 rounded-lg';
                        li.innerHTML = `
                            <div class="flex justify-between">
                                <span class="font-bold">${message.user.name} ${message.user.prenom} :</span>
                                <span class="text-sm text-gray-500">${message.created_at_human}</span>
                            </div>
                            <p class="mt-2 text-gray-700">${message.body_formatted}</p>
                        `;
                        messageList.appendChild(li);
                    });
                    messageList.scrollTop = messageList.scrollHeight;
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des messages :', error);
                });
            }

            messageForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const message = messageInput.value.trim();
                const token = document.querySelector('input[name="_token"]').value;
                const url = this.action; 

                if (!message) return;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => {
                    if (!response.ok) throw new Error("Erreur lors de l'envoi.");
                    return response.json();
                })
                .then(data => {
                    messageInput.value = ''; 
                    fetchMessages();
                })
                .catch(error => {
                    console.error('Erreur AJAX lors de l\'envoi :', error);
                    alert('Une erreur est survenue lors de l\'envoi du message.');
                });
            });
            fetchMessages();
            setInterval(fetchMessages, 3000);
        });
    </script>
</x-app-layout>