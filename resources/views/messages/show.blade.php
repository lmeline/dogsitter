<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="bg-white shadow p-4 rounded-lg">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                @if($thread->users->count() > 1)
                    @foreach($thread->users as $user)
                        @if($user->id !== auth()->id())
                            {{ $user->name }} {{ $user->prenom }}
                            @break
                        @endif
                    @endforeach
                @endif
            </h2>
            <ul class="space-y-4 mt-4">
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
            <form action="{{ route('addMessage', $thread->id) }}" method="POST">
                @csrf
                <textarea name="message" class="w-full p-4 border border-white rounded-lg min-h-[70px] max-h-[300px]"
                    placeholder="Écrire un message..." required></textarea>
                <button type="submit"
                    class="inline-block bg-gradient-to-r  from-yellow-300 to-pink-300 px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 transition w-full">
                    Envoyer
                </button>
            </form>
        </div>
    </div>
</x-app-layout>