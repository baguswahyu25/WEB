<x-app-layout>
    <x-navbar />


    <x-herosection />

    <!-- Hero / Slider -->
    <section id="home" class="relative w-full overflow-hidden h-[490px] pt-20 -mt-20">
        <div class="slider flex transition-transform duration-700 ease-in-out">
            <div class="flex-shrink-0 w-full h-[490px]">
                <img src="{{ asset('img/1.png') }}" alt="Slide 1" class="w-full h-full object-cover">
            </div>
            <div class="flex-shrink-0 w-full h-[490px]">
                <img src="{{ asset('img/2.png') }}" alt="Slide 2" class="w-full h-full object-cover">
            </div>
            <div class="flex-shrink-0 w-full h-[490px]">
                <img src="{{ asset('img/3.png') }}" alt="Slide 3" class="w-full h-full object-cover">
            </div>
            <!-- Duplikasi slide pertama -->
            <div class="flex-shrink-0 w-full h-[490px]">
                <img src="{{ asset('img/1.png') }}" alt="Slide 1 clone" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Indicator -->
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
            <div class="dot w-3 h-3 bg-white rounded-full opacity-100"></div>
            <div class="dot w-3 h-3 bg-white rounded-full opacity-60"></div>
            <div class="dot w-3 h-3 bg-white rounded-full opacity-60"></div>
        </div>
    </section>

    <script>
        const slider = document.querySelector(".slider");
        const slides = slider.children;
        const dots = document.querySelectorAll(".dot");
        const totalSlides = slides.length;
        let slideIndex = 0;

        function showSlide(index) {
            slider.style.transform = `translateX(-${index * 100}%)`;
            dots.forEach((dot, i) => {
                dot.classList.toggle("opacity-100", i === index % (totalSlides - 1));
                dot.classList.toggle("opacity-60", i !== index % (totalSlides - 1));
            });
        }

        setInterval(() => {
            slideIndex++;
            slider.style.transition = "transform 0.7s ease-in-out";
            showSlide(slideIndex);

            // Saat mencapai duplikasi terakhir, langsung reset tanpa animasi
            if (slideIndex === totalSlides - 1) {
                setTimeout(() => {
                    slider.style.transition = "none";
                    slideIndex = 0;
                    showSlide(slideIndex);
                }, 700);
            }
        }, 4000);
    </script>
    {{-- end hero slide --}}






    <x-footer>
    </x-footer>



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
</x-app-layout>
