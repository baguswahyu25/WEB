<nav id="main-navbar" class="fixed top-0 left-0 right-0 z-50 h-16 transition duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between items-center h-full">

            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center h-full">
                <img src="{{ asset('img/logo2.png') }}" alt="Logo DriveNusa" class="h-10 w-auto">
            </div>

            {{-- Menu Navigasi & Aksi --}}
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8 h-full items-center">

                {{-- Link Navigasi --}}
                <a href="/"
                    class="text-gray-900 inline-flex items-center px-1 border-b-2 text-sm font-medium h-full hover:text-blue-600 border-transparent transition duration-150 transform hover:-translate-y-0.5">
                    Beranda
                </a>
                <a href="#"
                    class="text-gray-900 inline-flex items-center px-1 border-b-2 text-sm font-medium h-full hover:text-blue-600 border-transparent transition duration-150 transform hover:-translate-y-0.5">
                    Tentang Kami
                </a>
                <a href="#"
                    class="text-gray-900 inline-flex items-center px-1 border-b-2 text-sm font-medium h-full hover:text-blue-600 border-transparent transition duration-150 transform hover:-translate-y-0.5">
                    Layanan Kami
                </a>
                <a href="/paket"
                    class="text-gray-900 inline-flex items-center px-1 border-b-2 text-sm font-medium h-full hover:text-blue-600 border-transparent transition duration-150 transform hover:-translate-y-0.5">
                    Paket Kursus
                </a>
                <a href="#"
                    class="text-gray-900 inline-flex items-center px-1 border-b-2 text-sm font-medium h-full hover:text-blue-600 border-transparent transition duration-150 transform hover:-translate-y-0.5">
                    Support
                </a>

                {{-- Pemisah (Spacer) - Menggantikan link kosong Anda --}}
                <div class="w-4 h-full"></div>

                {{-- **BAGIAN KONDISIONAL: LOGIN vs PROFILE** --}}

                @guest
                    <a
                        href="/login"class=" inline-flex items-center py-1 px-4 border border-gray-900 text-sm rounded-lg text-gray-900 transition duration-300 transform hover:-translate-y-0.5  hover:border-blue-600 hover:text-blue-600 ">Login</a>
                @endguest

                @auth
                    {{-- TAMPILAN JIKA SUDAH LOGIN (Profile/Dropdown) --}}
                    {{-- Hapus kelas 'group' karena kita akan menggunakan JS untuk klik --}}
                    <div class="relative">

                        {{-- Avatar atau Nama Pengguna (TRIGGER) --}}
                        {{-- Tambahkan id untuk JS dan onClick --}}
                        <button id="profile-dropdown-button" type="button"
                            class="flex items-center text-gray-900 hover:text-blue-600 focus:outline-none transition duration-150 transform hover:-translate-y-0.5 py-2">

                            {{-- Menggunakan Nama atau Avatar --}}
                            <img class="h-8 w-8 rounded-full object-cover mr-2" src="{{ asset('img/logo2.png') }}"
                                alt="{{ Auth::user()->name }}">
                            <span class="text-sm font-medium hidden lg:inline">{{ Auth::user()->name }}</span>

                            {{-- Chevron Down Icon --}}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        {{-- Dropdown Menu (KONTEN) --}}
                        {{-- 2. DROP DOWN MENU --}}
                        <div id="profile-dropdown-menu" {{-- Styling Dropdown --}}
                            class="absolute right-0 mt-2 w-64 rounded-md shadow-2xl py-0 z-50 hidden 
                   overflow-hidden border border-gray-700">

                            {{-- A. HEADER PROFIL (Sesuai Gambar: Nama & Email) --}}
                            <div class="flex items-center p-4 border-b border-gray-700  bg-[#ffb144]">
                                <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ asset('img/logo2.png') }}"
                                    alt="{{ Auth::user()->name }}">

                                <div>
                                    {{-- Nama Pengguna --}}
                                    <p class="text-base font-semibold">{{ Auth::user()->name ?? 'Pengguna' }}</p>
                                    {{-- Email Pengguna --}}
                                    <p class="text-xs text-gray-400 font-light">
                                        {{ Auth::user()->email ?? 'user@example.com' }}</p>
                                </div>
                            </div>

                            {{-- B. LIST MENU (Sesuai Gambar) --}}
                            <div class="py-2">

                                {{-- My Profile --}}
                                <a href="{{ route('profile.show') }}"
                                    class="block px-4 py-3 text-sm hover:bg-[#ffffff] transition duration-100">
                                    My Profile
                                </a>

                                {{-- Settings --}}
                                <a href="/settings"
                                    class="block px-4 py-3 text-sm hover:bg-[#ffffff] transition duration-100">
                                    Settings
                                </a>

                                {{-- Billing --}}
                                <a href="/billing"
                                    class="block px-4 py-3 text-sm hover:bg-[#ffffff] transition duration-100">
                                    Billing
                                </a>

                                {{-- FAQs --}}
                                <a href="/faqs"
                                    class="block px-4 py-3 text-sm hover:bg-[#ffffff] transition duration-100">
                                    FAQs
                                </a>
                            </div>

                            {{-- C. FOOTER (Logout) --}}
                            <div class="border-t border-gray-700">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-3 text-sm hover:bg-[#ffffff] transition duration-100">
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
