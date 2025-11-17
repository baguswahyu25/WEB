<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JagoStir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="../asset/logo.png">

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
</head>

<body class="min-h-screen bg-gradient-to-b from-white to-[#02104A] flex flex-col justify-between">

    <x-navbar>
    </x-navbar>

    <br>
    <br>
    <br>

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


    <!-- Tentang Dhuha -->
    <section id="tentang" class="bg-[#fffaf6] py-12 px-6 md:px-16 scroll-mt-20">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 items-center">
            <img src="{{ asset('img/sirkuit.png') }}" alt="Tentang Dhuha" class="rounded-lg shadow-lg h-[435px]">
            <div>
                <h2 class="text-2xl font-bold mb-3 text-[#02104A]">Tentang Dhuha</h2>
                <p class="text-gray-700 mb-4 text-justify">
                    Merupakan salah satu jasa kursus / les mengemudi di Kabupaten Bengkalis.
                    Telah berdiri sejak tahun 2000 dan berpengalaman melatih ribuan siswa
                    mengemudi mulai dari dasar, matic, hingga kendaraan berat.
                </p>

                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div class="p-3 border border-[#f89331] rounded-md">
                        <p class="font-semibold text-[#02104A]">Lokasi</p>
                        <p>Bengkalis Sub-District</p>
                    </div>
                    <div class="p-3 border border-[#f89331] rounded-md">
                        <p class="font-semibold text-[#02104A]">24 Tahun</p>
                        <p>Berdiri sejak tahun 2000</p>
                    </div>
                    <div class="p-3 border border-[#f89331] rounded-md">
                        <p class="font-semibold text-[#02104A]">2000+</p>
                        <p>Siswa per tahun</p>
                    </div>
                    <div class="p-3 border border-[#f89331] rounded-md">
                        <p class="font-semibold text-[#02104A]">17</p>
                        <p>Instruktur tersertifikasi</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4 mt-6">
                    <!-- KOTAK VISION -->
                    <div class="bg-[#efdfb8] p-4 rounded-md border border-[#f89331] flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('img/visi.png') }}" alt="Ikon Visi" class="h-6 w-6 object-contain">
                            <h3 class="font-semibold text-lg">Vision</h3>
                        </div>
                        <p class="text-sm">Menjadi lembaga pelatihan mengemudi yang profesional dan beretika tinggi
                            di
                            Kabupaten Bengkalis.</p>
                    </div>
                    <!-- KOTAK VISION -->

                    <!-- KOTAK MISSION -->
                    <div class="bg-[#efdfb8] p-4 rounded-md border border-[#f89331] flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('img/misi.png') }}" alt="Ikon Misi" class="h-6 w-6 object-contain">
                            <h3 class="font-semibold text-lg">Mission</h3>
                        </div>
                        <p class="text-sm">Memberikan pengalaman belajar mengemudi yang aman, efektif, dan
                            menyenangkan.
                        </p>
                    </div>
                    <!-- KOTAK MISSION -->

                </div>
            </div>
    </section>
    {{-- end tentang dhuha --}}


    <!-- Layanan Kami -->
    <section id="layanan" class="bg-white py-12 px-6 md:px-16 scroll-mt-20">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold text-center text-[#02104A] mb-8">Layanan Kami</h2>

            <div class="grid md:grid-cols-2 gap-6">

                {{-- cr1 --}}
                <div class="border border-[#02104A] p-5 rounded-md hover:shadow-lg transition bg-white">

                    <img src="{{ asset('img/lg1.png') }}" alt="Ikon Layanan"
                        class="h-8 w-10 mb-3 text-[#02104A] mx-auto md:mx-0">
                    <h3 class="font-bold text-xl mb-2 text-[#02104A] text-center md:text-left">
                        Kursus Mengemudi Dasar Matic dan Manual
                    </h3>
                    <p class="text-sm text-gray-700 text-center md:text-left">
                        Program kursus yang memberikan pelatihan dasar dalam mengemudi baik kendaraan otomatis
                        (matic)
                        maupun manual, dengan durasi beragam sesuai kebutuhan.
                    </p>

                </div>

                {{-- cr2 --}}
                <div class="border border-[#02104A] p-5 rounded-md hover:shadow-lg transition bg-white">

                    <img src="{{ asset('img/lg2.png') }}" alt="Ikon Layanan"
                        class="h-8 w-10 mb-3 text-[#02104A] mx-auto md:mx-0">
                    <h3 class="font-bold text-xl mb-2 text-[#02104A] text-center md:text-left">
                        Kursus Mengemudi Memperlanjar Matic & Manual
                    </h3>
                    <p class="text-sm text-gray-700 text-center md:text-left">
                        Program lanjutan yang dirancang untuk pengemudi yang ngin memperlancar kemampuan mengemudi
                        mobil
                        matic dan manual baik secara teknis maupun mental.
                    </p>

                </div>

                {{-- cr3 --}}
                <div class="border border-[#02104A] p-5 rounded-md hover:shadow-lg transition bg-white">

                    <img src="{{ asset('img/lg3.png') }}" alt="Ikon Layanan"
                        class="h-8 w-10 mb-3 text-[#02104A] mx-auto md:mx-0">
                    <h3 class="font-bold text-xl mb-2 text-[#02104A] text-center md:text-left">
                        Jual Beli Kendaraan
                    </h3>
                    <p class="text-sm text-gray-700 text-center md:text-left">
                        Kami melayani jual beli mobil berkualitas dengan
                        harga yang bersaing dan proses yang mudah. Transaksi dijamin aman, transparan, dan
                        terpercaya
                        untuk kenyamanan pelanggan.Kami juga menerima pembelian mobil Anda dengan proses cepat serta
                        pembayaran tunai.
                    </p>

                </div>

                {{-- cr4 --}}
                <div class="border border-[#02104A] p-5 rounded-md hover:shadow-lg transition bg-white">

                    <img src="{{ asset('img/lg1.png') }}" alt="Ikon Layanan"
                        class="h-8 w-10 mb-3 text-[#02104A] mx-auto md:mx-0">
                    <h3 class="font-bold text-xl mb-2 text-[#02104A] text-center md:text-left">
                        Jenis Kendaraan Belajar (Full AC)
                    </h3>
                    <ul
                        class="grid grid-cols-2 gap-x-4 text-sm text-gray-700 text-center md:text-left list-disc list-inside ml-4 md:ml-0">
                        <li>Toyota Avanza</li>
                        <li>Honda Brio</li>
                        <li>Toyota Calya</li>
                        <li>Honda Mobilio</li>
                        <li>Daihatsu Ayla</li>
                    </ul>

                </div>

                {{-- cr5 --}}
                <div class="border border-[#02104A] p-5 rounded-md hover:shadow-lg transition bg-white">

                    <img src="{{ asset('img/lg4.png') }}" alt="Ikon Layanan"
                        class="h-8 w-10 mb-3 text-[#02104A] mx-auto md:mx-0">
                    <h3 class="font-bold text-xl mb-2 text-[#02104A] text-center md:text-left">
                        Info SIM Tambahan
                    </h3>

                    <ul
                        class="grid gap-x-4 text-sm text-gray-700 text-center md:text-left list-disc list-inside ml-4 md:ml-0">
                        <li> Pas Photo ukuran 3 x 4 sebanyak : 2 lembar</li>
                        <li> Foto copy KTP sebanyak : 5 lembar</li>
                        <li>KIR Kesehatan + Psikologi (Tanggungan Siswa)</li>
                        <li> Biaya SIM : Rp. 120.000</li>

                    </ul>
                </div>

                {{-- cr6 --}}
                <div class="border border-[#02104A] p-5 rounded-md hover:shadow-lg transition bg-white">

                    <img src="{{ asset('img/lg5.png') }}" alt="Ikon Layanan"
                        class="h-8 w-10 mb-3 text-[#02104A] mx-auto md:mx-0">
                    <h3 class="font-bold text-xl mb-2 text-[#02104A] text-center md:text-left">
                        Informasi Biaya Tambahan (Opsional)
                    </h3>

                    <ul
                        class="grid gap-x-4 text-sm text-gray-700 text-center md:text-left list-disc list-inside ml-4 md:ml-0">
                        <li> Antar-Jemput Siswa : Rp 300.000</li>
                        <li>Kartu Belajar & Buku Rambu-Rambu : Rp 20.000</li>

                    </ul>
                </div>

            </div>
        </div>
    </section>
    {{-- end layanan kami --}}




    <!-- Pilihan Kursus -->
    <section id="paket" class="bg-[#f89331] py-10 px-6 md:px-16 scroll-mt-20">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold text-center text-[#02104A] mb-8">Pilihan Kursus</h2>

            {{-- Menggunakan GRID: 1 kolom di layar kecil, 2 kolom di layar SM ke atas --}}
            {{-- Hapus lg:grid-cols-3 dan xl:grid-cols-4 jika Anda hanya ingin 2x2 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                {{-- KARTU 1: Paket Manual (MT) (Template yang Diperbaiki) --}}
                <div class="bg-white rounded-lg shadow-sm border hover:shadow-lg transition h-[510px]">

                    {{-- Tambahkan h-full di sini, agar kartu memiliki tinggi yang sama --}}
                    <div class="h-full flex flex-col">

                        <img src="{{ asset('img/1.png') }}" alt="Paket Manual"
                            class="rounded-t-lg w-full h-40 object-cover mb-4 flex-none">
                        {{-- flex-none agar gambar tidak diubah ukurannya --}}

                        <div class="p-4 flex flex-col flex-grow">
                            {{-- flex-grow agar container konten mengisi sisa ruang --}}

                            <h3 class="font-semibold text-xl text-[#02104A] mb-4">🚘 Paket Manual (MT)</h3>

                            {{-- Detail Paket --}}
                            <p class="text-gray-700 mb-2 text-sm">Durasi: 14 kali pertemuan (1 jam/pertemuan)</p>
                            <p class="text-gray-700 mb-4 text-sm">Sistem: 1 Instruktur</p>

                            {{-- Informasi Pembelajaran & Siswa --}}
                            <div class="flex items-center mb-2 text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">...</svg>
                                <span class="text-sm">25 Pembelajaran</span>
                            </div>
                            <div class="flex items-center mb-4 text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">...</svg>
                                <span class="text-sm">12 Siswa</span>
                            </div>

                            {{-- Harga dan Tombol (mt-auto Mendorong ke Bawah) --}}
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                <div class="mb-3 text-lg font-bold text-[#02104A] text-center">
                                    Rp 2.150.000
                                </div>
                                <button
                                    class="w-full bg-[#02104A] text-white px-4 py-2 rounded-md flex justify-center items-center hover:bg-[#0928a4] transition">
                                    Tambah Troli
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">...</svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KARTU 1: Paket Manual (MT) (Template yang Diperbaiki) --}}
                <div class="bg-white rounded-lg shadow-sm border hover:shadow-lg transition h-[510px]">

                    {{-- Tambahkan h-full di sini, agar kartu memiliki tinggi yang sama --}}
                    <div class="h-full flex flex-col">

                        <img src="{{ asset('img/1.png') }}" alt="Paket Manual"
                            class="rounded-t-lg w-full h-40 object-cover mb-4 flex-none">
                        {{-- flex-none agar gambar tidak diubah ukurannya --}}

                        <div class="p-4 flex flex-col flex-grow">
                            {{-- flex-grow agar container konten mengisi sisa ruang --}}

                            <h3 class="font-semibold text-xl text-[#02104A] mb-4">🚘 Paket Manual (MT)</h3>

                            {{-- Detail Paket --}}
                            <p class="text-gray-700 mb-2 text-sm">Durasi: 14 kali pertemuan (1 jam/pertemuan)</p>
                            <p class="text-gray-700 mb-4 text-sm">Sistem: 1 Instruktur</p>

                            {{-- Informasi Pembelajaran & Siswa --}}
                            <div class="flex items-center mb-2 text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">...</svg>
                                <span class="text-sm">25 Pembelajaran</span>
                            </div>
                            <div class="flex items-center mb-4 text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">...</svg>
                                <span class="text-sm">12 Siswa</span>
                            </div>

                            {{-- Harga dan Tombol (mt-auto Mendorong ke Bawah) --}}
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                <div class="mb-3 text-lg font-bold text-[#02104A] text-center">
                                    Rp 2.150.000
                                </div>
                                <button
                                    class="w-full bg-[#02104A] text-white px-4 py-2 rounded-md flex justify-center items-center hover:bg-[#0928a4] transition">
                                    Tambah Troli
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">...</svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- KARTU 1: Paket Manual (MT) (Template yang Diperbaiki) --}}
                <div class="bg-white rounded-lg shadow-sm border hover:shadow-lg transition h-[510px]">

                    {{-- Tambahkan h-full di sini, agar kartu memiliki tinggi yang sama --}}
                    <div class="h-full flex flex-col">

                        <img src="{{ asset('img/1.png') }}" alt="Paket Manual"
                            class="rounded-t-lg w-full h-40 object-cover mb-4 flex-none">
                        {{-- flex-none agar gambar tidak diubah ukurannya --}}

                        <div class="p-4 flex flex-col flex-grow">
                            {{-- flex-grow agar container konten mengisi sisa ruang --}}

                            <h3 class="font-semibold text-xl text-[#02104A] mb-4">🚘 Paket Manual (MT)</h3>

                            {{-- Detail Paket --}}
                            <p class="text-gray-700 mb-2 text-sm">Durasi: 14 kali pertemuan (1 jam/pertemuan)</p>
                            <p class="text-gray-700 mb-4 text-sm">Sistem: 1 Instruktur</p>

                            {{-- Informasi Pembelajaran & Siswa --}}
                            <div class="flex items-center mb-2 text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">...</svg>
                                <span class="text-sm">25 Pembelajaran</span>
                            </div>
                            <div class="flex items-center mb-4 text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">...</svg>
                                <span class="text-sm">12 Siswa</span>
                            </div>

                            {{-- Harga dan Tombol (mt-auto Mendorong ke Bawah) --}}
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                <div class="mb-3 text-lg font-bold text-[#02104A] text-center">
                                    Rp 2.150.000
                                </div>
                                <button
                                    class="w-full bg-[#02104A] text-white px-4 py-2 rounded-md flex justify-center items-center hover:bg-[#0928a4] transition">
                                    Tambah Troli
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">...</svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- KARTU 1: Paket Manual (MT) (Template yang Diperbaiki) --}}
                <div class="bg-white rounded-lg shadow-sm border hover:shadow-lg transition h-[510px]">

                    {{-- Tambahkan h-full di sini, agar kartu memiliki tinggi yang sama --}}
                    <div class="h-full flex flex-col">

                        <img src="{{ asset('img/1.png') }}" alt="Paket Manual"
                            class="rounded-t-lg w-full h-40 object-cover mb-4 flex-none">
                        {{-- flex-none agar gambar tidak diubah ukurannya --}}

                        <div class="p-4 flex flex-col flex-grow">
                            {{-- flex-grow agar container konten mengisi sisa ruang --}}

                            <h3 class="font-semibold text-xl text-[#02104A] mb-4">🚘 Paket Manual (MT)</h3>

                            {{-- Detail Paket --}}
                            <p class="text-gray-700 mb-2 text-sm">Durasi: 14 kali pertemuan (1 jam/pertemuan)</p>
                            <p class="text-gray-700 mb-4 text-sm">Sistem: 1 Instruktur</p>

                            {{-- Informasi Pembelajaran & Siswa --}}
                            <div class="flex items-center mb-2 text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">...</svg>
                                <span class="text-sm">25 Pembelajaran</span>
                            </div>
                            <div class="flex items-center mb-4 text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">...</svg>
                                <span class="text-sm">12 Siswa</span>
                            </div>

                            {{-- Harga dan Tombol (mt-auto Mendorong ke Bawah) --}}
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                <div class="mb-3 text-lg font-bold text-[#02104A] text-center">
                                    Rp 2.150.000
                                </div>
                                <button
                                    class="w-full bg-[#02104A] text-white px-4 py-2 rounded-md flex justify-center items-center hover:bg-[#0928a4] transition">
                                    Tambah Troli
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">...</svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Tambahkan Kartu 2, 3, dan 4 di sini menggunakan struktur yang sama --}}

            </div>
        </div>
    </section>
    {{-- end pilihan kursus --}}



    <section id="support">
        <x-footer></x-footer>
    </section>


</body>

</html>
