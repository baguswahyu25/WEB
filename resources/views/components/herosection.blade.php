<section class="relative bg-white min-h-screen overflow-hidden ">
    {{-- CATATAN: Hapus h-[768px] dan py-16 dari <section> --}}

    {{-- Div ini menguasai seluruh ruang yang tersisa dan menggunakan Flexbox untuk sentralisasi vertikal --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">

        {{-- Kontainer Flex Utama: Hapus mt-96px yang tidak perlu --}}
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12 w-full py-16">

            {{-- Kiri: Konten Teks dan Tombol --}}
            <div class="lg:w-1/2 text-center lg:text-left z-20">

                <p class="text-xl text-blue-600 font-semibold mb-3">Hallo, selamat datang di</p>

                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-4">
                    Kursus mengemudi <br>
                    <span class="text-gray-900">dhuha group</span>
                </h1>

                <p class="text-lg text-gray-600 mb-8">
                    Belajar mengemudi jadi lebih aman, mudah dan terjadwal.
                </p>

                {{-- Tombol Aksi --}}
                @guest
                    <div class="flex justify-center lg:justify-start space-x-4">
                        <a href="{{ route('register') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-300">
                            Daftar
                        </a>
                        <a href="/login"
                            class="border border-blue-600 text-blue-600 hover:bg-blue-50 font-bold py-3 px-8 rounded-lg transition duration-300">
                            Login
                        </a>
                    </div>
                </div>
            @endguest

            @auth
                <div class="flex justify-center lg:justify-start space-x-4">
                    <a href="{{ route('register') }}"
                        class="bg-white hover:bg-white text-white  py-3 px-8 rounded-lg  transition duration-300">
                        Daftar
                    </a>
                    <a href="/login"
                        class="bg-white hover:bg-white text-white  py-3 px-8 rounded-lg  transition duration-300">
                        Login
                    </a>
                </div>
            </div>
        @endauth

        {{-- Kanan: Gambar Ilustrasi Mobil dan Orang --}}
        <div class="lg:w-1/2 flex justify-center mt-12 lg:mt-0 relative z-10">
            <img src="{{ asset('img/heroik.png') }}" alt="Kursus Mengemudi Dhuha Group dengan Mobil dan Instruktur"
                class="w-full max-w-lg h-auto object-contain" />
        </div>

    </div>
    </div>
</section>
