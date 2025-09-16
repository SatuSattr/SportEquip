<nav x-data="{ open: false }" class="bg-white shadow-sm border-b border-slate-200">
    <!-- Enhanced navigation with subtle shadow and modern border -->
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto ">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <!-- Enhanced logo area with modern styling -->
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-dumbbell text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold text-slate-800">SportEquip</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                @auth
                    <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex">
                        <!-- Improved navigation link spacing and styling -->
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg transition-all duration-200">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.equipment.index')" :active="request()->routeIs('admin.equipment.*')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg transition-all duration-200">
                            <i class="fas fa-boxes mr-2"></i>
                            {{ __('Equipment') }}
                        </x-nav-link>

                        <x-nav-link :href="route('admin.borrow.requests')" :active="request()->routeIs('admin.borrow.*')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg transition-all duration-200">
                            <i class="fas fa-clipboard-list mr-2"></i>
                            {{ __('Borrow Requests') }}
                        </x-nav-link>

                        <x-nav-link :href="route('equipment.list')" :active="request()->routeIs('equipment.list')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg transition-all duration-200">
                            <i class="fas fa-hand-holding-heart mr-2"></i>
                            {{ __('Borrow') }}
                        </x-nav-link>
                    </div>
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <!-- Modern user dropdown with avatar styling -->
                            <button
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-slate-600 bg-white hover:text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-200">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-slate-400 to-slate-500 rounded-full flex items-center justify-center mr-3">
                                    <span
                                        class="text-white text-xs font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-2">
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
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 focus:text-slate-500 transition duration-150 ease-in-out">
                    <!-- Improved mobile menu button styling -->
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        @auth
            <div class="pt-2 pb-3 space-y-1 px-4">
                <!-- Enhanced mobile navigation styling -->
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="flex items-center px-4 py-3 text-base font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.equipment.index')" :active="request()->routeIs('admin.equipment.*')"
                    class="flex items-center px-4 py-3 text-base font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg">
                    <i class="fas fa-boxes mr-3"></i>
                    {{ __('Equipment') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.borrow.requests')" :active="request()->routeIs('admin.borrow.*')"
                    class="flex items-center px-4 py-3 text-base font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg">
                    <i class="fas fa-clipboard-list mr-3"></i>
                    {{ __('Borrow Requests') }}
                </x-responsive-nav-link>
            </div>
        @endauth

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-slate-200">
                <div class="px-4">
                    <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1 px-4">
                    <x-responsive-nav-link :href="route('profile.edit')"
                        class="flex items-center px-4 py-3 text-base font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="flex items-center px-4 py-3 text-base font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 rounded-lg">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
