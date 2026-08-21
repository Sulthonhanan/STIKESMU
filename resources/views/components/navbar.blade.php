<nav class="bg-primary/95 backdrop-blur-md sticky top-0 z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex-shrink-0 flex items-center gap-3">
                <!-- Logo -->
                <img src="{{ asset('images/logo.png') }}" alt="Logo STIKESMU" class="h-16 w-auto object-contain">
                <div class="flex flex-col">
                    <span class="text-white font-display font-bold text-lg tracking-tight leading-tight">STIKES MUHAMMADIYAH</span>
                    <span class="text-accent font-display text-sm font-semibold leading-tight">WONOSOBO</span>
                </div>
            </div>
            
            <div class="hidden md:flex space-x-8 items-center">
                <a href="/" class="text-white hover:text-accent font-medium transition duration-300">Beranda</a>
                <a href="/halaman/sejarah-kampus" class="text-white hover:text-accent font-medium transition duration-300">Profil</a>
                <a href="/program-studi" class="text-white hover:text-accent font-medium transition duration-300">Program Studi</a>
                <a href="/berita" class="text-white hover:text-accent font-medium transition duration-300">Berita</a>
                <a href="/dokumen" class="text-white hover:text-accent font-medium transition duration-300">Dokumen</a>
                <a href="{{ route('pmb.status_check') }}" class="text-white hover:text-accent font-medium transition duration-300">Cek Status PMB</a>
                <a href="{{ route('pmb.jalur') }}" class="bg-accent text-primary px-5 py-2 rounded-full font-bold hover:bg-white hover:shadow-lg transform hover:-translate-y-0.5 transition duration-300">PMB Online</a>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 text-white hover:text-accent transition duration-300 focus:outline-none">
                        @auth
                            <div class="w-8 h-8 rounded-full bg-white text-primary flex items-center justify-center font-bold text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @else
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                            <span class="font-medium">Login</span>
                        @endauth
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180': open}"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 border border-gray-100 hidden" 
                         :class="{'hidden': !open}" style="display: none;">
                        @auth
                            @hasanyrole('Super Admin|Admin CMS')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition">Dashboard Admin</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition">Dashboard User</a>
                            @endhasanyrole
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary hover:text-white transition">Login Admin</a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" class="text-white hover:text-accent focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
