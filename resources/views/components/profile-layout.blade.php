{{-- resources/views/components/profile-layout.blade.php --}}
<x-app-layout>
    <style>
        /* Membuat scrollbar navigasi jadi lebih tipis dan transparan */
        .nav-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .nav-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .nav-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .nav-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>

    <div class="flex min-h-screen bg-gray-100">
        {{-- SIDEBAR --}}
        <aside class="w-64 bg-[#02104A] text-white hidden lg:flex flex-col sticky top-0 h-screen z-40">

            {{-- BAGIAN ATAS (FIXED) --}}
            <div class="p-6 flex-shrink-0 flex items-center gap-3">
                <a href="/" class="bg-white/10 p-2 rounded-full hover:bg-white/20 transition cursor-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <span class="text-xl font-bold">Profile</span>
            </div>

            {{-- BAGIAN TENAH (SCROLLABLE) --}}
            <nav class="flex-grow overflow-y-auto px-4 mt-4 space-y-6 min-h-0 nav-scrollbar">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('profile.show') }}"
                            class="flex items-center gap-3 p-3 rounded-xl cursor-none {{ request()->routeIs('profile.show') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                            <img src="{{ asset('img/lock.png') }}" class="w-5 h-5"> OverView
                        </a>
                    </li>
                </ul>

                <div>
                    <p class="text-[10px] font-semibold uppercase opacity-50 mb-4 px-2 tracking-widest">Pengaturan akun
                    </p>
                    <ul class="space-y-1">
                        <li>
                            <a href="/profile/keamanan"
                                class="flex items-center gap-3 p-3 rounded-xl cursor-none {{ request()->path() == 'profile/keamanan' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                                <img src="{{ asset('img/bell.png') }}" class="w-5 h-5"> keamanan
                            </a>
                        </li>
                        <li>
                            <a href="/profile/notifications"
                                class="flex items-center gap-3 p-3 rounded-xl cursor-none {{ request()->path() == 'profile/notifications' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                                <img src="{{ asset('img/bell.png') }}" class="w-5 h-5"> Notifikasi
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="text-[10px] font-semibold uppercase opacity-50 mb-4 px-2 tracking-widest">Pusat bantuan
                    </p>
                    <ul class="space-y-1">
                        <li>
                            <a href="/profile/keamanan"
                                class="flex items-center gap-3 p-3 rounded-xl cursor-none {{ request()->path() == 'profile/keamanan' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                                <img src="{{ asset('img/bell.png') }}" class="w-5 h-5"> Customer Service
                            </a>
                        </li>
                        <li>
                            <a href="/profile/notifications"
                                class="flex items-center gap-3 p-3 rounded-xl cursor-none {{ request()->path() == 'profile/notifications' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                                <img src="{{ asset('img/bell.png') }}" class="w-5 h-5"> Beri Dukungan
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="text-[10px] font-semibold uppercase opacity-50 mb-4 px-2 tracking-widest">Tentang Aplikasi
                    </p>
                    <ul class="space-y-1">
                        <li>
                            <a href="/profile/keamanan"
                                class="flex items-center gap-3 p-3 rounded-xl cursor-none {{ request()->path() == 'profile/keamanan' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                                <img src="{{ asset('img/bell.png') }}" class="w-5 h-5"> Kenali DriveNusa
                            </a>
                        </li>
                        <li>
                            <a href="/profile/notifications"
                                class="flex items-center gap-3 p-3 rounded-xl cursor-none {{ request()->path() == 'profile/notifications' ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                                <img src="{{ asset('img/bell.png') }}" class="w-5 h-5"> Syarat & ketentuan
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            {{-- BAGIAN BAWAH (FIXED) --}}
            <div class="p-4 border-t border-white/10 flex-shrink-0">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 p-3 w-full text-red-400 hover:text-red-300 transition cursor-none hover:bg-white/5 rounded-xl">
                        <img src="{{ asset('img/logout.png') }}" class="w-5 h-5"> Keluar Akun
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 flex flex-col items-center py-12 px-6 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>
</x-app-layout>
