<x-app-layout>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
            <h2 class="text-center mb-8 text-3xl font-bold text-black">Choisissez un abonnement</h2>
        </div>
        <div class="mt-12 grid sm:grid-cols-1 lg:grid-cols-2 gap-6 lg:items-center">
            <div class="flex flex-col border border-black-200 text-center rounded-xl p-8 dark:border-black-700 bg-white/60 hover:bg-white/85 hover:scale-[102%] transition-all ease-in-out duration-200">
                <h4 class="font-medium text-lg text-black-800 dark:text-black">Mensuel</h4>
                <span class="mt-5 font-bold text-5xl text-black-800 dark:text-black">
                    29,99
                    <span class="font-bold text-2xl -me-2">€</span>
                </span>

                <a href="{{ route('checkout', ['plan' => 'price_1RM73dPq260KNrONH4cY3Suf']) }}" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-indigo-100 text-indigo-800 hover:bg-indigo-200 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-indigo-900 dark:text-indigo-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-black-600">
                    Choisir cet abonnement
                </a>
            </div>
            <div class="flex flex-col border-2 border-indigo-600 text-center shadow-xl rounded-xl p-8 dark:border-indigo-700 bg-white/70 hover:bg-white/75 hover:scale-[102%]">
                <p class="mb-3"><span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold bg-indigo-100 text-indigo-800 dark:bg-indigo-600 dark:text-white"> Le plus populaire</span></p>
                <h4 class="font-medium text-lg text-black-800 dark:text-black-200">Annuel</h4>
                <span class="mt-5 font-bold text-5xl text-black-800 dark:text-black-200">
                    199,99
                    <span class="font-bold text-2xl -me-2">€</span>
                </span>

                <a href="{{ route('checkout', ['plan' => 'price_1RM73dPq260KNrONj176TJRk']) }}" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-black-600">
                    Choisir cet abonnement
                </a>
            </div>
            </div>
        {{-- Section de gestion de l'abonnement actuel --}}
        @auth
            <div class="max-w-2xl mx-auto text-center mt-14 mb-10 lg:mb-14 p-8 border rounded-lg shadow-md bg-white">
                <h2 class="text-center mb-8 text-3xl font-bold text-black">Gérer votre abonnement actuel</h2>
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                @if (session('info'))
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('info') }}</span>
                    </div>
                @endif
                @if ($subscriptions && count($subscriptions->data))
                    @php $sub = $subscriptions->data[0]; @endphp
                    @if ($sub->cancel_at_period_end)
                        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mb-4 rounded">
                            <p class="font-bold">Abonnement annulé</p>
                            <p>
                                Votre abonnement a été annulé. Il restera actif jusqu'au 
                                <strong>{{ \Carbon\Carbon::createFromTimestamp($sub->current_period_end)->format('d/m/Y') }}</strong>.
                            </p>
                        </div>
                    @endif
                    <p class="text-black-700 dark:text-black-300 mb-4">
                        Vous êtes actuellement abonné(e) au plan : 
                        <span class="font-semibold">{{ $sub->plan->nickname ?? 'Inconnu' }}</span><br>
                        Statut de l’abonnement : 
                        <span class="font-semibold">{{ ucfirst($sub->status) }}</span><br>
                        Prochaine facturation : 
                        <span class="font-semibold">{{ \Carbon\Carbon::createFromTimestamp($sub->current_period_end)->format('d/m/Y') }}</span>
                    </p>
                    @if (!$sub->cancel_at_period_end)
                        <form action="{{ route('abonnements.cancel') }}" method="POST">
                            @csrf
                            <input type="hidden" name="subscription_id" value="{{ $sub->id }}">
                            <button type="submit" class="mt-4 py-2 px-4 bg-red-600 text-white rounded hover:bg-red-700">
                                Annuler l'abonnement
                            </button>
                        </form>
                    @endif
                @else
                    <p class="text-black-700 dark:text-black-300">
                        Vous n'avez pas d'abonnement actif pour le moment.
                    </p>
                @endif
            </div>
        @endauth
    </div>
    {{-- Modal de confirmation d'annulation (Alpine.js) --}}
    <div x-data="{ openModal: false }">
        <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="openModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.021 3.373 1.866 3.373h14.469c1.845 0 2.732-1.873 1.866-3.373L13.563 4.47a1.925 1.925 0 00-3.126 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Confirmer l'annulation de l'abonnement
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Êtes-vous sûr de vouloir annuler votre abonnement ? Votre accès restera valide jusqu'à la fin de la période de facturation actuelle.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form action="{{ route('subscription.cancel') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Annuler l'abonnement
                            </button>
                        </form>
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="openModal = false">
                            Retour
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Fin Modal de confirmation --}}

</x-app-layout>