<section id="tentang" class="bg-white py-12 px-6 md:px-16 scroll-mt-20">
    <div class="max-w-6xl mx-auto">

        {{-- JUDUL TENGAH ORANYE --}}
        <h2 class="text-3xl font-bold text-[#F6A935] mb-10 text-center">Tentang kami</h2>

        <div class="grid md:grid-cols-2 gap-10 items-start">

            {{-- KOLOM KIRI: GAMBAR --}}
            <div class="mx-auto md:mx-0">
                {{-- Menggunakan asset dari gambar Anda, disarankan menggunakan gambar mobil dari contoh --}}
                <img src="{{ asset('img/dh.png') }}" alt="Mobil kursus mengemudi"
                    class="rounded-xl shadow-xl w-full max-w-sm md:max-w-none h-[400px]">
            </div>

            {{-- KOLOM KANAN: DESKRIPSI DAN FAKTA --}}
            <div>
                <p class="text-gray-700 mb-14 leading-relaxed">
                    Kami adalah pusat pelatihan mengemudi profesional di Kabupaten Bengkalis yang
                    menyediakan layanan kursus atau les setir kendaraan. Kami berkomitmen untuk melatih
                    peserta didik menjadi pengemudi yang kompeten dan bertanggung jawab.
                </p>

                {{-- KOTAK FAKTA (Grid 2x2) --}}
                <div class="grid grid-cols-2 gap-8 text-sm">

                    {{-- Fakta 1: Lokasi --}}
                    <div class="p-4 rounded-xl shadow-md">
                        <p class="font-bold text-[#F6A935] text-base">Lokasi</p>
                        <p class="text-gray-600 mt-1">Bengkalis Sub-District</p>
                    </div>

                    {{-- Fakta 2: Tahun Berdiri --}}
                    <div class="p-4 rounded-xl shadow-md">
                        <p class="font-bold text-[#F6A935] text-base">24 Tahun</p>
                        <p class="text-gray-600 mt-1">Berdiri sejak tahun 2000</p>
                    </div>

                    {{-- Fakta 3: Siswa Puas --}}
                    <div class="p-4 rounded-xl shadow-md">
                        <p class="font-bold text-[#F6A935] text-base">2000+</p>
                        <p class="text-gray-600 mt-1">Siswa puas setiap tahun</p>
                    </div>

                    {{-- Fakta 4: Instruktur --}}
                    <div class="p-4 rounded-xl shadow-md">
                        <p class="font-bold text-[#F6A935] text-base">07</p>
                        <p class="text-gray-600 mt-1">Instruktur tersertifikasi</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN VISI & MISI (Menggunakan desain dari gambar b8f5a1.png) --}}

    </div>
</section>
