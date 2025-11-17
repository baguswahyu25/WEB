<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


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


    <div id="scroll-progress" class="fixed top-[64px] left-0 h-1 bg-[#0928a4] z-[9999] w-0 transition-all duration-250">
    </div>

    <!-- Footer -->
    <footer class="bg-[#02104A] text-white py-8">
        <div class="container mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 md:gap-3 items-start">

            <!-- Logo -->
            <div class="flex justify-center md:justify-start mt-[-10px]">
                <img src="{{ asset('img/logop.png') }}" alt="Logo" class="h-[100px] md:h-[115px] w-auto">
            </div>

            <!-- Tautan Fitur -->
            <div class="text-center sm:text-left">
                <h3 class="font-semibold mb-2">Tautan Fitur</h3>
                <ul class="text-sm space-y-2">

                    <!-- LIST ITEM DENGAN IKON -->
                    <li>
                        <a href="#" class="flex items-center gap-2 hover:underline">
                            <!-- Placeholder Ikon: Ganti dengan <img src="..."> Anda -->
                            <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2 hover:underline">
                            <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon">
                            Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2 hover:underline">
                            <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon">
                            Kursus
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2 hover:underline">
                            <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon">
                            Jual Beli Unit
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2 hover:underline">
                            <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon">
                            Support
                        </a>
                    </li>

                </ul>
            </div>

            <!-- Support -->
            <div class="text-center sm:text-left">
                <h3 class="font-semibold mb-2">Support</h3>
                <ul class="text-sm space-y-2">

                    <!-- LIST ITEM DENGAN IKON -->
                    <li>
                        <a href="#" class="flex items-center gap-2 hover:underline">
                            <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon">
                            Certivicate Holder
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2 hover:underline">
                            <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon">
                            Support
                        </a>
                    </li>

                </ul>
            </div>

            <!-- Info Kontak (Tidak Berubah) -->
            <div class="text-center sm:text-left">
                <p class="font-semibold mb-2">Belajar Mengemudi Dhuha Bengkalis</p>
                <ul class="text-sm space-y-3">

                    <!-- Lokasi -->
                    <li class="flex flex-col sm:flex-row items-center sm:items-start gap-2">
                        <img src="{{ asset('img/mp.png') }}" alt="Lokasi" class="h-7 w-auto">
                        <a target="_blank"
                            href="https://www.google.com/maps/place/6PH4F4QH%2BH6M/@1.4889518,102.1280318,21z/data=!4m4!3m3!8m2!3d1.4889625!4d102.1280469?entry=ttu&g_ep=EgoyMDI1MTAyOS4yIKXMDSoASAFQAw%3D%3D">
                            <p class="leading-6 text-center sm:text-left">
                                F4QH+H6M, Wonosari, Bengkalis Sub-District, Riau 28711
                            </p>
                        </a>
                    </li>

                    <!-- Telepon -->
                    <li class="flex flex-col sm:flex-row items-center sm:items-start gap-2">
                        <img src="{{ asset('img/tlp.png') }}" alt="Telepon" class="h-7 w-auto">
                        <a target="_blank" href="https://wa.me/+6285272201996">
                            <p>+6285272201996</p>
                        </a>
                    </li>

                    <!-- Email -->
                    <li class="flex flex-col sm:flex-row items-center sm:items-start gap-2">
                        <img src="{{ asset('img/email.png') }}" alt="Email" class="h-7 w-auto">
                        <a href="mailto:dhuahdc@gmail.com" target="_blank">
                            <p>dhuahdc@gmail.com</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="relative mt-5">
            <!-- Ikon Sosial Media -->
            <div class="flex justify-center md:justify-start gap-4 mb-4 md:absolute md:left-6 md:bottom-0">
                <a href="https://web.facebook.com/p/Dhuha-Mobilindo-100068821356785/?_rdc=1&_rdr#" target="_blank"
                    class="hover:opacity-60 transition">
                    <img src="{{ asset('img/fbp.png') }}"  alt="Facebook" class="h-8 w-auto">
                </a>
                <a href="https://www.instagram.com/dhuhagroup_id/" target="_blank" class="hover:opacity-60 transition">
                    <img src="{{ asset('img/igp.png') }}"  alt="Instagram" class="h-8 w-auto">
                </a>
                <a target="_blank" href="https://wa.me/+6285272201996" class="hover:opacity-60 transition">
                    <img src="{{ asset('img/wap.png') }}"  alt="WhatsApp" class="h-8 w-auto">
                </a>
            </div>
        </div>

    </footer>

    <!-- Bagian bawah footer -->
    <div class="bg-[#f89331] text-white py-[4px]">


        <!-- Copyright -->
        <div class="text-center text-sm opacity-80">
            © 2025 DRIVE NUSA ACADEMY. All rights reserved.
        </div>
    </div>


    {{-- load --}}
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

        window.addEventListener('scroll', function() {
            const scrollProgress = document.getElementById('scroll-progress');
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            scrollProgress.style.width = scrollPercent + '%';
        });
    </script>




    @vite(['resources/js/app.js'])
</body>

</html>
