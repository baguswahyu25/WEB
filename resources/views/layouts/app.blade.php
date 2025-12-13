<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'DriveeNusa' }}</title>
    {{-- Menggunakan $title untuk judul dinamis --}}

    {{-- 1. Import Font Poppins (Sudah Benar) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">



    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

{{-- 2. Memastikan Poppins digunakan (melalui konfigurasi tailwind.config.js) --}}

<body class="font-sans antialiased">

    {{-- Hapus <x-banner /> jika tidak diperlukan pada halaman utama --}}
    {{-- <x-banner /> --}}

    <div class="min-h-screen">

        {{-- 3. Ganti Navigation dengan Komponen Navbar Anda --}}


        {{-- 4. Main Content --}}
        {{-- Kita menggunakan pt-14 (56px) untuk mengimbangi tinggi navbar fixed --}}


        {{-- Hapus Page Heading jika ini adalah layout untuk landing page --}}
        {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

        {{ $slot }}
        </main>
    </div>

    @stack('modals')

    {{-- progress barrr --}}
    <div id="scroll-progress" class="fixed top-[64px] left-0 h-1 bg-[#0928a4] z-[9999] w-0 transition-all duration-250">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Jalankan hanya di halaman utama
            if (window.location.pathname === '/' || window.location.pathname === '/index') {
                document.querySelectorAll('a.scroll-link').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        const targetId = this.getAttribute('href').split('#')[1];
                        const targetElement = document.getElementById(targetId);
                        if (targetElement) {
                            e.preventDefault();
                            const offset = targetElement.offsetTop - 80; // tinggi navbar
                            window.scrollTo({
                                top: offset,
                                behavior: 'smooth'
                            });
                        }
                    });
                });
            }
        });
    </script>
    {{-- progress barrr --}}

    {{-- dropdownD --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('profile-dropdown-button');
            const menu = document.getElementById('profile-dropdown-menu');

            if (button && menu) {
                button.addEventListener('click', function() {
                    // Toggle kelas 'hidden' untuk menampilkan/menyembunyikan menu
                    menu.classList.toggle('hidden');
                });

                // Menutup dropdown jika user klik di luar area menu
                document.addEventListener('click', function(event) {
                    // Cek apakah klik berasal dari luar tombol dan luar menu
                    if (!button.contains(event.target) && !menu.contains(event.target)) {
                        // Jika menu sedang terbuka, sembunyikan
                        if (!menu.classList.contains('hidden')) {
                            menu.classList.add('hidden');
                        }
                    }
                });
            }
        });
    </script>
    {{-- dropdown --}}

    {{-- bg navbar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pastikan ID ini sesuai dengan ID di komponen navbar Anda
            const navbar = document.getElementById('main-navbar');
            const scrollThreshold = 50;

            if (navbar) { // Cek apakah elemen navbar ada
                function handleScroll() {
                    if (window.scrollY > scrollThreshold) {
                        // Ketika di-scroll ke bawah: Tambahkan background dan shadow
                        navbar.classList.add('bg-white', 'shadow-md');
                    } else {
                        // Ketika kembali ke atas: Hapus background dan shadow
                        navbar.classList.remove('bg-white', 'shadow-md');
                    }
                }

                // Jalankan fungsi sekali saat memuat halaman
                handleScroll();

                // Panggil fungsi setiap kali terjadi peristiwa scroll
                window.addEventListener('scroll', handleScroll);
            }
        });
    </script>
    {{-- end bg --}}

    @livewireScripts
</body>

</html>
