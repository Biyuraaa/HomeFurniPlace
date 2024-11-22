<nav
    class="bg-gradient-to-b from-amber-950 to-amber-900 text-amber-100 relative z-50 border-b border-amber-800/50 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo Section -->
            <div class="flex-shrink-0">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-3">
                    <svg class="h-8 w-8 text-amber-200" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M3 10h18v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9zm0-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v3H3z" />
                    </svg>
                    <span class="text-2xl font-bold text-amber-200 font-serif tracking-tight">HomeFurniPlace</span>
                </a>
            </div>

            <!-- Search Bar - Desktop -->
            <div class="hidden md:block flex-1 max-w-xl mx-8">
                <form action="" method="GET" class="relative">
                    <input type="text" name="query" placeholder="Cari furniture impian Anda..."
                        class="w-full px-4 py-3 pl-12 text-amber-900 placeholder-amber-500 bg-amber-800/20 border border-amber-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition duration-200 ease-in-out shadow-sm hover:border-amber-600">
                    <button type="submit" class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="w-5 h-5 text-amber-400 hover:text-amber-300 transition-colors duration-150"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Navigation Items -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="" class="text-amber-200/80 hover:text-amber-200 font-medium transition duration-150">
                    Katalog
                </a>
                <a href="" class="text-amber-200/80 hover:text-amber-200 font-medium transition duration-150">
                    Kategori
                </a>

                @auth
                    <!-- Cart Icon -->
                    <a href="{{ route('carts.index') }}" class="relative group">
                        <svg class="w-6 h-6 text-amber-200/80 group-hover:text-amber-200 transition duration-150"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @if (Auth::user()->cart_count > 0)
                            <span
                                class="absolute -top-2 -right-2 bg-amber-500 text-amber-950 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ Auth::user()->cart_count }}
                            </span>
                        @endif
                    </a>

                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none"
                            @click.away="open = false">
                            <img class="h-10 w-10 rounded-full object-cover border-2 border-amber-700"
                                src="{{ Auth::user()->image ? asset('storage/images/users/' . Auth::user()->image) : asset('images/default.png') }}"
                                alt="{{ Auth::user()->name }}">
                            <span class="text-amber-200/80">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-3 w-48 bg-amber-900 rounded-xl shadow-lg py-1 border border-amber-800">
                            <a href="{{ route('profile-user.index') }}"
                                class="block px-4 py-2 text-sm text-amber-200/80 hover:bg-amber-800 transition duration-150">Profile</a>
                            <a href=""
                                class="block px-4 py-2 text-sm text-amber-200/80 hover:bg-amber-800 transition duration-150">Pesanan
                                Saya</a>
                            <a href=""
                                class="block px-4 py-2 text-sm text-amber-200/80 hover:bg-amber-800 transition duration-150">Wishlist</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-amber-200/80 hover:bg-amber-800 transition duration-150">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-amber-200/80 hover:text-amber-200 font-medium transition duration-150">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-6 py-2.5 bg-amber-600 hover:bg-amber-700 text-amber-100 font-medium rounded-xl shadow-sm transition duration-150 hover:shadow focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-amber-900">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen"
                    class="text-amber-200/80 hover:text-amber-200 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" class="md:hidden bg-amber-900 border-t border-amber-800">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <!-- Mobile Search -->
            <div class="pt-2 pb-3">
                <form action="" method="GET">
                    <input type="text" name="query" placeholder="Cari furniture..."
                        class="w-full px-4 py-2 text-amber-200 placeholder-amber-400 bg-amber-800/30 border border-amber-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                </form>
            </div>

            <a href=""
                class="block px-4 py-2 text-base font-medium text-amber-200/80 hover:bg-amber-800 rounded-lg">
                Katalog
            </a>
            <a href=""
                class="block px-4 py-2 text-base font-medium text-amber-200/80 hover:bg-amber-800 rounded-lg">
                Kategori
            </a>

            @auth
                <a href="{{ route('carts.index') }}"
                    class="block px-4 py-2 text-base font-medium text-amber-200/80 hover:bg-amber-800 rounded-lg">
                    Keranjang
                    @if (Auth::user()->cart_count > 0)
                        <span class="ml-2 bg-amber-500 text-amber-950 text-xs font-bold rounded-full px-2 py-1">
                            {{ Auth::user()->cart_count }}
                        </span>
                    @endif
                </a>
                <a href="{{ route('profile-user.index') }}"
                    class="block px-4 py-2 text-base font-medium text-amber-200/80 hover:bg-amber-800 rounded-lg">
                    Profile
                </a>
                <a href=""
                    class="block px-4 py-2 text-base font-medium text-amber-200/80 hover:bg-amber-800 rounded-lg">
                    Pesanan Saya
                </a>
                <a href=""
                    class="block px-4 py-2 text-base font-medium text-amber-200/80 hover:bg-amber-800 rounded-lg">
                    Wishlist
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-base font-medium text-amber-200/80 hover:bg-amber-800 rounded-lg">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block px-4 py-2 text-base font-medium text-amber-200/80 hover:bg-amber-800 rounded-lg">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="block px-4 py-2 text-base font-medium text-white bg-amber-600 hover:bg-amber-700 rounded-lg">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Alpine.js for dropdown functionality -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('navbar', () => ({
            mobileMenuOpen: false
        }))
    })
</script>
