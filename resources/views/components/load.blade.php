<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- <style>
        /* Menggunakan kelas global loader */
        .loader {
            /* Ukuran container disesuaikan */
            width: 60px;
            height: 32px;
            /* Warna titik dan background disesuaikan dengan brand Anda */
            --_g: no-repeat radial-gradient(farthest-side, #02104A 94%, #0000);
            background:
                var(--_g) 50% 0,
                var(--_g) 100% 0;
            background-size: 14px 14px;
            /* Ukuran titik */
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
            /* Warna titik bergerak */
            left: 0;
            top: 0;
            animation:
                l23-1 1.5s linear infinite,
                l23-2 0.5s cubic-bezier(0, 200, .8, 200) infinite;
        }

        /* Keyframes yang Anda Berikan */
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
    </style> --}}

    <style>
        /*
        Definisi Keyframe Kustom L23
        (CSS tidak berubah, hanya JS yang berubah)
    */
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

<body>

    {{-- <div id="preloader"
        class="fixed inset-0 z-[9999] flex items-center justify-center 
            bg-white opacity-100 transition-opacity duration-700">

        <!-- Container Utama -->
        <div class="flex flex-col items-center">

            <!-- Logo atau Ikon Anda -->
            {{-- <img src="{{ asset('img/logo.png') }}" alt="Drive Nusa Loading" class="h-16 w-auto mb-6 object-contain" /> --}}

    <!-- Animasi L23 -->
    {{-- <div class="loader"></div> --}}

    {{-- <p class="mt-6 text-sm text-gray-600">Sedang mempersiapkan...</p> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    <div id="preloader"
        class="fixed inset-0 z-[9999] flex items-center justify-center 
            bg-white opacity-100 transition-opacity duration-700">

        <div class="flex flex-col items-center">

            <img src="{{ asset('img/logo.png') }}" alt="Drive Nusa Loading"
                class="h-[130px] w-auto mb-6 object-contain" />

            <div class="loader"></div>

            <p class="mt-6 text-sm text-gray-600">Sedang mempersiapkan...</p>
        </div>
    </div>
    <!-- END: Preloader Animasi L23 Kustom -->





    {{-- <script>
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.classList.add('opacity-0');
                setTimeout(() => {
                    preloader.classList.add('hidden');
                    preloader.remove();
                }, 5000); // Harus sesuai dengan 'duration-700'
            }
        });
    </script> --}}

    <script>
        // Durasi Transisi CSS (700ms dari Tailwind 'duration-700')
        const FADE_OUT_DURATION = 700;

        // Delay Tambahan untuk melihat animasi (3000ms = 3 detik)
        const ADDITIONAL_DELAY = 3000;

        // Kunci scroll segera setelah script berjalan
        document.body.style.overflow = 'hidden';

        function hidePreloader() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                // 1. Menurunkan opacity secara halus (memulai fade out)
                // Note: Kelas 'transition-opacity duration-700' di HTML yang akan mengurus transisi ini.
                preloader.classList.add('opacity-0');

                // 2. Menghapus elemen dari DOM dan MENGAKTIFKAN KEMBALI SCROLL
                // Tunggu hingga transisi (FADE_OUT_DURATION) selesai
                setTimeout(() => {
                    preloader.classList.add('hidden');
                    preloader.remove();

                    // KUNCI 2: Kembalikan scroll ke normal
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
    </script>

</body>

</html>
