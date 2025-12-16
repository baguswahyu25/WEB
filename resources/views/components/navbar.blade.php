<nav id="main-navbar" class="fixed top-0 left-0 right-0 z-[100] bg-white shadow-md h-16 transition duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between items-center h-full">

            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center h-full">
                <img src="{{ asset('img/logo2.png') }}" alt="Logo DriveNusa" class="h-10 w-auto">
            </div>

            {{-- Menu Navigasi & Aksi --}}
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8 h-full items-center">

                {{-- Link Navigasi --}}
                {{-- 1. Beranda --}}
                <a href="/"
                    class="inline-flex items-center px-1  text-sm font-medium h-full transition duration-150 transform hover:-translate-y-0.5
                   {{ request()->is('/') ? 'text-blue-600' : 'text-gray-900  hover:text-blue-600' }}">
                    Beranda
                </a>

                {{-- 2. Tentang Kami --}}
                <a href="/tentang"
                    class="inline-flex items-center px-1  text-sm font-medium h-full transition duration-150 transform hover:-translate-y-0.5
                   {{ request()->is('tentang') ? 'text-blue-600' : 'text-gray-900  hover:text-blue-600' }}">
                    Tentang Kami
                </a>

                {{-- 3. Layanan Kami (Dianggap '/layanan') --}}
                <a href="/layanan"
                    class="inline-flex items-center px-1  text-sm font-medium h-full transition duration-150 transform hover:-translate-y-0.5
                   {{ request()->is('layanan') ? 'text-blue-600' : 'text-gray-900  hover:text-blue-600' }}">
                    Layanan Kami
                </a>

                {{-- 4. Paket Kursus --}}
                <a href="/paket"
                    class="inline-flex items-center px-1  text-sm font-medium h-full transition duration-150 transform hover:-translate-y-0.5
                   {{ request()->is('paket') ? 'text-blue-600' : 'text-gray-900  hover:text-blue-600' }}">
                    Paket Kursus
                </a>

                {{-- 5. Support (Dianggap '/support') --}}
                <a href="/support"
                    class="inline-flex items-center px-1  text-sm font-medium h-full transition duration-150 transform hover:-translate-y-0.5
                   {{ request()->is('support') ? 'text-blue-600' : 'text-gray-900  hover:text-blue-600' }}">
                    Support
                </a>

                {{-- Pemisah (Spacer) --}}
                <div class="w-4 h-full"></div>

                {{-- **BAGIAN KONDISIONAL: LOGIN vs PROFILE** --}}

                @guest
                    <a href="/login"
                        class="inline-flex items-center py-1 px-4 border border-gray-900 text-sm rounded-lg text-gray-900 transition duration-300 transform hover:-translate-y-0.5 hover:border-blue-600 hover:text-blue-600 ">Login</a>
                @endguest

                @auth
                    {{-- TAMPILAN JIKA SUDAH LOGIN (Profile/Dropdown) --}}
                    <div class="relative">

                        {{-- Avatar atau Nama Pengguna (TRIGGER) --}}
                        <button id="profile-dropdown-button" type="button"
                            class="flex items-center text-gray-900 hover:text-blue-600 focus:outline-none transition duration-150 transform hover:-translate-y-0.5 py-2">

                            {{-- Menggunakan Nama atau Avatar --}}
                            <img class="h-8 w-8 rounded-full object-cover mr-2" src="{{ asset('img/N.png') }}"
                                alt="{{ Auth::user()->name }}">
                            <span class="text-sm font-medium hidden lg:inline">{{ Auth::user()->name ?? 'Pengguna' }}</span>

                            {{-- Chevron Down Icon --}}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        {{-- Dropdown Menu (KONTEN) --}}
                        <div id="profile-dropdown-menu"
                            class="absolute right-0 mt-2 w-64 rounded-md shadow-2xl py-0 z-50 hidden 
                    overflow-hidden border border-gray-700">

                            {{-- A. HEADER PROFIL --}}
                            <div class="flex items-center p-4 border-b border-gray-700 bg-[#ffb144]">
                                <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ asset('img/N.png') }}"
                                    alt="{{ Auth::user()->name }}">

                                <div>
                                    <p class="text-base font-semibold">{{ Auth::user()->name ?? 'Pengguna' }}</p>
                                    <p class="text-xs text-gray-700 font-light">
                                        {{ Auth::user()->email ?? 'user@example.com' }}</p>
                                </div>
                            </div>

                            {{-- B. LIST MENU --}}
                            <div class="py-2 bg-white">
                                <a href="{{ route('profile.show') }}"
                                    class="block px-4 py-3 text-sm text-gray-800 hover:bg-gray-100 transition duration-100">
                                    My Profile
                                </a>
                                <a href="/settings"
                                    class="block px-4 py-3 text-sm text-gray-800 hover:bg-gray-100 transition duration-100">
                                    Settings
                                </a>
                                <a href="/billing"
                                    class="block px-4 py-3 text-sm text-gray-800 hover:bg-gray-100 transition duration-100">
                                    Billing
                                </a>
                                <a href="/faqs"
                                    class="block px-4 py-3 text-sm text-gray-800 hover:bg-gray-100 transition duration-100">
                                    FAQs
                                </a>
                            </div>

                            {{-- C. FOOTER (Logout) --}}
                            <div class="border-t border-gray-200 bg-white">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-3 text-sm text-gray-800 hover:bg-gray-100 transition duration-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
