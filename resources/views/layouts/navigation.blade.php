<nav x-data="{ open: false }"
    class="bg-gradient-to-r from-orange-100 via-pink-100 to-yellow-100 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 font-sans">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div
                    class="shrink-0 flex items-center text-2xl font-semibold text-gray-800 hover:text-green-600 transition duration-300">
                    <a href="{{ route('index') }}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        &nbsp;Patte à patte
                    </a>

                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('index')" :active="request()->routeIs('index')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>

                <!-- Pour les utilisateurs authentifiés -->
                @if (Auth::check())

                    <!-- Pour les propriétaires authentifiés -->
                    @if(Auth::user()->role === 'proprietaire')
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('dogsitters.index')" :active="request()->routeIs('dogsitters.index')">
                                {{ __('Find a dogsitter') }}
                            </x-nav-link>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('proprietaires.mesprestations')" :active="request()->routeIs('proprietaires.mesprestations')">
                                {{ __('My prestations') }}
                            </x-nav-link>
                        </div>

                        <!-- Pour les dogsitters authentifiés -->
                    @else
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('dogsitters.calendar')"
                                :active="request()->routeIs('dogsitters.calendar')">
                                {{ __('My appointments') }}
                            </x-nav-link>
                        </div>
                    @endif

                    <!-- Pour les utilisateurs identifiés, propriétaires ou dogsitters -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.index')">
                            {{ __('Messages') }}
                            @if (isset($unreadCount) && $unreadCount > 0)
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-2">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </x-nav-link>
                    </div>
                @endif

                <!-- Seulement pour les dogsitters authentifiés -->
                @if (Auth::check() && Auth::user()->role === 'dogsitter')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dogsitters.annonce')" :active="request()->routeIs('dogsitters.annonce')">
                            {{ __('Post your ad') }}
                        </x-nav-link>
                    </div>
                @endif
            </div>
            
            <!-- Menu connecté -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black dark:text-gray-400  hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div> Bonjour, {{ Auth::user()->name }} {{ Auth::user()->prenom }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" :active="request()->routeIs('profile')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                                {{ __('Account') }}
                            </x-dropdown-link>
                            @if(Auth::user()->role === 'proprietaire')
                                <x-dropdown-link :href="route('dogs.create')" :active="request()->routeIs('dogs.create')">
                                    {{ __('Add a dog') }}
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link :href="route('prix')"
                                    :active="request()->routeIs('prix')">
                                    {{ __('Subcription') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('dogsitters.annonce')"
                                    :active="request()->routeIs('dogsitters.annonce')">
                                    {{ __('Post your ad') }}
                                </x-dropdown-link>

                            @endif
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex gap-4">
                        <a href="{{ route('register') }}?proprietaire=true"
                            class="font-semibold text-black bg-gradient-to-r from-yellow-300 to-pink-300 px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 py-2 px-4 rounded-lg transition duration-300 hover:bg-gradient-to-r hover:from-green-300 hover:via-yellow-300 hover:to-blue-300">
                            S'inscrire
                        </a>
                        <a href="{{ route('login') }}"
                            class="font-semibold text-black bg-gradient-to-r from-yellow-300 to-pink-300  px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 py-2 px-4 rounded-lg transition duration-300 hover:bg-gradient-to-r hover:from-blue-300 hover:via-yellow-300 hover:to-green-300">
                            Se connecter
                        </a>
                    </div>
                @endauth
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-black hover:text-yellow-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @auth
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('index')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('proprietaires.mesprestations')" :active="request()->routeIs('proprietaires.mesprestations')">
                    {{ __('My prestations') }}
                </x-responsive-nav-link>
            </div>

            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.index')">
                    {{ __('Messages') }}
                </x-responsive-nav-link>
            </div>

            @if (Auth::check() && Auth::user()->role === 'proprietaire')               
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dogsitters.index')" :active="request()->routeIs('dogsitters.index')">
                        {{ __('Find a dogsitter') }}
                    </x-responsive-nav-link>
                </div>
            @else
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dogsitters.calendar')" :active="request()->routeIs('dogsitters.calendar')">
                        {{ __('My appointments') }}
                    </x-responsive-nav-link>
                </div>

                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dogsitters.annonce')" :active="request()->routeIs('dogsitters.annonce')">
                        {{ __('Post your ad') }}
                    </x-responsive-nav-link>
                </div>
            @endif

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                @auth    
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-black-200">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</div>
                </div>
                @endauth
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Account') }}
                    </x-responsive-nav-link>
                    @if(Auth::user()->role === 'dogsitter')
                        <x-responsive-nav-link :href="route('prix')">
                            {{ __('Subcription') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('dogsitters.annonce')">
                            {{ __('Post your ad') }}
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link :href="route('dogs.create')">
                            {{ __('Add a dog') }}
                        </x-responsive-nav-link>
                    @endif
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('register') }}?proprietaire=true"
                    class="font-semibold text-black bg-gradient-to-r from-yellow-300 to-pink-300 px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 py-2 px-4 rounded-lg transition duration-300 hover:bg-gradient-to-r hover:from-green-300 hover:via-yellow-300 hover:to-blue-300">
                    S'inscrire
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('login') }}"
                    class="font-semibold text-black bg-gradient-to-r from-yellow-300 to-pink-300  px-6 py-3 rounded-lg hover:from-yellow-400 hover:to-pink-400 py-2 px-4 rounded-lg transition duration-300 hover:bg-gradient-to-r hover:from-blue-300 hover:via-yellow-300 hover:to-green-300">
                    Se connecter
                </x-responsive-nav-link>
            </div>
        @endauth
    </div>
</nav>