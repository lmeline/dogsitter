<x-app-layout>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Title -->
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
            <h2 class="text-center mb-8 text-3xl font-bold text-black">Choisissez un abonnement</h2>
        </div>
        <!-- End Title -->
    
        <!-- Grid -->
        <div class="mt-12 grid sm:grid-cols-1 lg:grid-cols-2 gap-6 lg:items-center">
            <!-- Card -->
            <div class="flex flex-col border border-black-200 text-center rounded-xl p-8 dark:border-black-700 bg-white/60 hover:bg-white/85 hover:scale-[102%] transition-all ease-in-out duration-200">
                <h4 class="font-medium text-lg text-black-800 dark:text-black">Mensuel</h4>
                <span class="mt-5 font-bold text-5xl text-black-800 dark:text-black">
                    29,99
                    <span class="font-bold text-2xl -me-2">€</span>
                </span>
    
                <a href="{{ route('checkout', ['plan' => 'price_1RM73dPq260KNrONH4cY3Suf']) }}" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-indigo-100 text-indigo-800 hover:bg-indigo-200 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-indigo-900 dark:text-indigo-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-black-600" >
                    Choisir cet abonnement
                </a>
            </div>
            <!-- End Card -->
    
            <!-- Card -->
            <div class="flex flex-col border-2 border-indigo-600 text-center shadow-xl rounded-xl p-8 dark:border-indigo-700 bg-white/70 hover:bg-white/75 hover:scale-[102%]">
                <p class="mb-3"><span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold bg-indigo-100 text-indigo-800 dark:bg-indigo-600 dark:text-white"> Le plus populaire</span></p>
                <h4 class="font-medium text-lg text-black-800 dark:text-black-200">Annuel</h4>
                <span class="mt-5 font-bold text-5xl text-black-800 dark:text-black-200">
                    199,99
                    <span class="font-bold text-2xl -me-2">€</span>
                </span>

                <a href="{{ route('checkout', ['plan' => 'price_1RM73dPq260KNrONj176TJRk']) }}" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-black-600" >
                 Choisir cet abonnement
                </a>
            </diiiv>
            <!-- End Card -->
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Pricing -->


</x-app-layout>
