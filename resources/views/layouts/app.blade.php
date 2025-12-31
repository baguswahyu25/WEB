<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy"
        content="script-src 'self' 'unsafe-inline' 'unsafe-eval' https://app.sandbox.midtrans.com;">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'DriveeNusa' }}</title>

    {{-- Memanggil Favicon di sini (Tambahkan file di public/) --}}
    <link rel="icon" type="image/png" href="{{ asset('img/ico.png') }}">

    {{-- 1. Import Font Poppins (Sudah Benar) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <style>
        /* ======================================================= */
        /* BAGIAN CSS: STYLING KURSOR BIRU */
        /* ======================================================= */



        body {
            cursor: none;
            background-color: #ffffff;
            min-height: 100vh;
            margin: 0;
            /* Pastikan margin benar-benar nol */
            padding: 0;
            /* Pastikan padding benar-benar nol */
            overflow-x: hidden;
            /* Mencegah scroll horizontal */
        }

        #cursor-trail {
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 9999;

            /* TAMBAHKAN INI */
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        #scroll-progress {
            /* ... kode lainnya ... */
            /* TAMBAHKAN INI */
            display: none;
        }

        .trail-element {
            position: absolute;
            width: 15px;
            height: 15px;
            border-radius: 50%;

            /* EFEK CAHAYA BIRU (Menggantikan api hitam) */
            /* Menggunakan warna biru gelap (seperti bg-blue-700) dengan gradien */
            background: radial-gradient(circle, rgba(29, 78, 216, 0.9) 0%, rgba(59, 130, 246, 0) 70%);
            /* Biru Tailwind 700/600 */
            box-shadow: 0 0 10px rgba(29, 78, 216, 0.7), 0 0 20px rgba(29, 78, 216, 0.4);
            /* Bayangan Biru */

            opacity: 0;

            /* Durasi Transisi dikurangi untuk respons yang lebih cepat */
            transition: transform 0.05s, opacity 0.4s;

            transform: scale(0);

            /* Dalam tag <style> Anda */
            /* ... (CSS trail-element yang sudah ada) ... */

            .trail-hover-link {
                /* Gaya saat kursor berada di atas link/button */
                width: 20px !important;
                height: 20px !important;

                /* Warna yang berbeda (misalnya, Oranye aksen Anda: #F6A935) */
                background: radial-gradient(circle, rgba(246, 169, 53, 1) 0%, rgba(255, 192, 99, 0) 70%);
                box-shadow: 0 0 10px rgba(246, 169, 53, 0.9), 0 0 20px rgba(246, 169, 53, 0.5);
            }
        }
    </style>


    <style>
        .loader {
            width: 60px;
            height: 32px;
            --_g: no-repeat radial-gradient(farthest-side, #02104A 94%, #0000);
            background:
                var(--_g) 50% 0,
                var(--_g) 100% 0;
            background-size: 14px 14px;
            position: relative;
            animation: l23-0 1.5s linear infinite;
        }

        .loader:before {
            content: "";
            position: absolute;
            height: 14px;
            aspect-ratio: 1;
            border-radius: 50%;
            background: #02104A;
            left: 0;
            top: 0;
            animation:
                l23-1 1.5s linear infinite,
                l23-2 0.5s cubic-bezier(0, 200, .8, 200) infinite;
        }

        @keyframes l23-0 {

            0%,
            31% {
                background-position: 50% 0, 100% 0
            }

            33% {
                background-position: 50% 100%, 100% 0
            }

            43%,
            64% {
                background-position: 50% 0, 100% 0
            }

            66% {
                background-position: 50% 0, 100% 100%
            }

            79% {
                background-position: 50% 0, 100% 0
            }

            100% {
                transform: translateX(calc(-100%/3))
            }
        }

        @keyframes l23-1 {
            100% {
                left: calc(100% + 7px)
            }
        }

        @keyframes l23-2 {
            100% {
                top: -0.1px
            }
        }
    </style>

</head>

<body class="font-sans antialiased">

    <div id="preloader"
        class="fixed inset-0 z-[9999] flex items-center justify-center 
            bg-white opacity-100 transition-opacity duration-700">

        <div class="flex flex-col items-center">

            {{-- <img src="{{ asset('img/logo.png') }}" alt="Drive Nusa Loading"
                class="h-[130px] w-auto mb-6 object-contain" /> --}}

            <div class="loader"></div>

            {{-- <p class="mt-6 text-sm text-gray-600">Sedang mempersiapkan...</p> --}}
        </div>
    </div>

    <div class="min-h-screen">

        {{-- Tempatkan Komponen Navbar Anda di sini (misalnya <x-navbar />) --}}

        {{-- 4. Main Content --}}
        {{-- Menggunakan pt-[64px] (tinggi h-16) untuk mengimbangi navbar fixed --}}
        {{-- Jika rute saat ini mengandung kata 'profile' atau 'user', jangan pakai pt-16 --}}
        {{-- Tetapkan pt-16 secara default, kecuali benar-benar di halaman Profile Dashboard --}}
        <main class="{{ Request::is('user/profile', 'profile/*') ? '' : 'pt-16' }}">
            {{ $slot }}
        </main>

    </div>

    @stack('modals')

    {{-- Tampilkan progress bar HANYA JIKA rute saat ini BUKAN profile atau user --}}
    @if (!Request::is('profile*') && !Request::is('user*'))
        <div id="scroll-progress"
            class="fixed top-[64px] left-0 h-1 bg-[#0928a4] z-[9999] w-0 transition-all duration-250">
        </div>
    @endif

    <div id="cursor-trail"></div>

    {{-- scroll bar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // =========================================================
            // A. SMOOTH SCROLL & LOGIC NAVIGASI
            // =========================================================

            // Jalankan hanya di halaman utama
            if (window.location.pathname === '/' || window.location.pathname === '/index') {
                document.querySelectorAll('a.scroll-link').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        const targetId = this.getAttribute('href').split('#')[1];
                        const targetElement = document.getElementById(targetId);
                        if (targetElement) {
                            e.preventDefault();
                            // SINKRONISASI: Menggunakan 64px (tinggi navbar h-16)
                            const offset = targetElement.offsetTop - 64;
                            window.scrollTo({
                                top: offset,
                                behavior: 'smooth'
                            });
                        }
                    });
                });
            }

            // =========================================================
            // B. SCROLL PROGRESS BAR (DIGABUNGKAN)
            // =========================================================

            const progressBar = document.getElementById('scroll-progress');
            if (progressBar) {
                function updateProgressBar() {
                    const scrollHeight = document.documentElement.scrollHeight - document.documentElement
                        .clientHeight;
                    const scrolled = window.scrollY;

                    if (scrollHeight > 0) {
                        const scrollPercentage = (scrolled / scrollHeight) * 100;
                        progressBar.style.width = scrollPercentage + '%';
                    }
                }
                updateProgressBar();
                window.addEventListener('scroll', updateProgressBar);
            }

            // =========================================================
            // C. DROPDOWN PROFILE (DIGABUNGKAN)
            // =========================================================

            const button = document.getElementById('profile-dropdown-button');
            const menu = document.getElementById('profile-dropdown-menu');

            if (button && menu) {
                button.addEventListener('click', function() {
                    menu.classList.toggle('hidden');
                });

                // Menutup dropdown jika user klik di luar area menu
                document.addEventListener('click', function(event) {
                    if (!button.contains(event.target) && !menu.contains(event.target)) {
                        if (!menu.classList.contains('hidden')) {
                            menu.classList.add('hidden');
                        }
                    }
                });
            }

            // =========================================================
            // D. NAVBAR BACKGROUND SCROLL
            // =========================================================

            const navbar = document.getElementById('main-navbar');
            const scrollThreshold = 50;

            if (navbar) {
                const activeClasses = ['bg-gradient-to-r', 'from-white', 'to-[#a8bcff]',
                    'shadow-md'
                ]; // Menggunakan Gradasi

                function handleScroll() {
                    if (window.scrollY > scrollThreshold) {
                        navbar.classList.add(...activeClasses);
                    } else {
                        navbar.classList.remove(...activeClasses);
                    }
                }
                handleScroll();
                window.addEventListener('scroll', handleScroll);
            }
        });
    </script>

    {{-- kursor --}}
    <script>
        // =======================================================
        // BAGIAN JAVASCRIPT: LOGIKA JEJAK KURSSOR WARNA-WARNI + KLIK
        // =======================================================

        const trailContainer = document.getElementById('cursor-trail');
        const maxTrailElements = 30;
        let trailElements = [];
        let mouseX = 0;
        let mouseY = 0;

        const lagFactor = 0.8;
        let targetX = 0;
        let targetY = 0;
        let isHoveringLink = false;

        // FUNGSI BANTUAN: Menghasilkan string warna HSL
        function getRainbowColor(index, max) {
            const hue = (index * (360 / max)) % 360;
            return `hsl(${hue}, 100%, 70%)`;
        }

        // 1. Inisialisasi: Buat elemen jejak dan berikan warna
        if (trailContainer) {
            for (let i = 0; i < maxTrailElements; i++) {
                const el = document.createElement('div');
                el.classList.add('trail-element');

                const color = getRainbowColor(i, maxTrailElements);

                // Terapkan warna dan bayangan secara dinamis
                el.style.background =
                    `radial-gradient(circle, ${color} 0%, hsla(${color.match(/\d+/)[0]}, 100%, 70%, 0) 70%)`;
                el.style.boxShadow = `0 0 10px ${color}, 0 0 20px ${color}`;

                trailContainer.appendChild(el);
                trailElements.push(el);
            }
        }

        // Elemen Kepala Kursor (elemen pertama dalam array)
        const cursorHead = trailElements[0];

        // 2. Dapatkan posisi mouse secara real-time
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        // 3. LOGIKA DETEKSI HOVER LINK (Mengubah warna/ukuran)
        const interactiveElements = document.querySelectorAll('a, button, [role="button"], [onclick], [href]');

        interactiveElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                isHoveringLink = true;
                // Kelas trail-hover-link akan membuat efek menjadi putih/terang
                trailElements.forEach(item => item.classList.add('trail-hover-link'));
            });
            el.addEventListener('mouseleave', () => {
                isHoveringLink = false;
                trailElements.forEach(item => item.classList.remove('trail-hover-link'));
            });
        });


        // 4. LOGIKA INTERAKSI KLIK (MOUSEDOWN / MOUSEUP)

        // Gaya untuk keadaan Normal (seperti di gambar: 25px)
        const normalSize = '25px';
        const normalShadow = `0 0 10px ${getRainbowColor(0, 1)}, 0 0 20px ${getRainbowColor(0, 1)}`;

        // Gaya untuk keadaan Ditekan (Squish Down, seperti di gambar: 40px)
        const pressedSize = '40px';
        // Gunakan warna yang lebih kuat saat ditekan
        const pressedShadow =
            `0 0 15px ${getRainbowColor(0, 1)}, 0 0 30px ${getRainbowColor(0, 1)}, 0 0 50px ${getRainbowColor(0, 1)}`;

        // MOUSE DOWN: Kursor Membesar
        window.addEventListener('mousedown', () => {
            if (cursorHead) {
                // Pastikan elemen kepala tidak memiliki kelas hover yang dapat mengganggu perubahan warna
                if (!isHoveringLink) {
                    cursorHead.style.background =
                        `radial-gradient(circle, ${getRainbowColor(0, 1)} 0%, hsla(${getRainbowColor(0, 1).match(/\d+/)[0]}, 100%, 70%, 0) 70%)`;
                    cursorHead.style.boxShadow = pressedShadow;
                }
                cursorHead.style.width = pressedSize;
                cursorHead.style.height = pressedSize;
            }
        });

        // MOUSE UP: Kursor Kembali Normal
        window.addEventListener('mouseup', () => {
            if (cursorHead) {
                // Kembalikan ukuran ke normal
                cursorHead.style.width = normalSize;
                cursorHead.style.height = normalSize;

                // Kembalikan bayangan ke bayangan pelangi asli (untuk elemen kepala)
                if (!isHoveringLink) {
                    const color = getRainbowColor(0, maxTrailElements);
                    cursorHead.style.boxShadow = `0 0 10px ${color}, 0 0 20px ${color}`;
                }
            }
        });


        // 5. Loop animasi (Logika pergerakan sama)
        function animateTrail() {
            targetX += (mouseX - targetX) * (1 - lagFactor);
            targetY += (mouseY - targetY) * (1 - lagFactor);

            for (let i = trailElements.length - 1; i > 0; i--) {
                const prevElement = trailElements[i - 1];
                const currentElement = trailElements[i];

                const prevX = parseFloat(prevElement.style.left) || targetX;
                const prevY = parseFloat(prevElement.style.top) || targetY;

                currentElement.style.left = `${prevX}px`;
                currentElement.style.top = `${prevY}px`;

                currentElement.style.opacity = (maxTrailElements - i) / maxTrailElements;
                currentElement.style.transform = `scale(${(maxTrailElements - i) / maxTrailElements * 0.8 + 0.2})`;
            }

            const firstElement = trailElements[0];
            firstElement.style.left = `${targetX}px`;
            firstElement.style.top = `${targetY}px`;
            firstElement.style.opacity = 1;
            firstElement.style.transform = 'scale(1)';

            requestAnimationFrame(animateTrail);
        }

        // Mulai animasi
        if (trailContainer) {
            animateTrail();
        }
    </script>

    <script>
        // Durasi Transisi CSS (700ms dari Tailwind 'duration-700')
        const FADE_OUT_DURATION = 700;

        // Delay Tambahan untuk melihat animasi (3000ms = 3 detik)
        const ADDITIONAL_DELAY = 0;

        // Kunci scroll segera setelah script berjalan
        document.body.style.overflow = 'hidden';

        function hidePreloader() {
            const preloader = document.getElementById('preloader');
            const cursor = document.getElementById('cursor-trail');
            const progressBar = document.getElementById('scroll-progress');

            if (preloader) {
                preloader.classList.add('opacity-0');

                setTimeout(() => {
                    preloader.classList.add('hidden');
                    preloader.remove();

                    // 1. Tampilkan Cursor Trail secara halus
                    if (cursor) cursor.style.opacity = "1";

                    // 2. Tampilkan Progress Bar
                    if (progressBar) progressBar.style.display = "block";

                    // 3. Kembalikan scroll ke normal
                    document.body.style.overflow = 'auto';

                }, FADE_OUT_DURATION);
            }
        }

        // Tunggu sampai semua aset halaman selesai dimuat (window.load)
        window.addEventListener('load', function() {
            // Gabungkan ADDITIONAL_DELAY dengan FADE_OUT_DURATION
            // Ini memastikan total durasi animasi yang terlihat
            setTimeout(hidePreloader, ADDITIONAL_DELAY);
        });

        window.addEventListener('scroll', function() {
            const scrollProgress = document.getElementById('scroll-progress');
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            scrollProgress.style.width = scrollPercent + '%';
        });
    </script>


    @livewireScripts
</body>

</html>
