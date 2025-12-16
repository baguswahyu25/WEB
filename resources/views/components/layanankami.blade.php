<section class="py-10">
    <div class="max-w-6xl mx-auto px-4">

        {{-- JUDUL UTAMA --}}
        <div class="mb-10 text-center md:text-left">
            <h2 class="text-3xl font-bold text-[#006A9F]">Layanan kami</h2>
            <p class="text-gray-600 mt-2 text-sm">Temukan layanan kursus mengemudi yang paling sesuai dengan kebutuhan
                dan target kelancaran Anda</p>
        </div>
        <br>

        {{-- GRID LAYANAN (2 KOLOM, 4 BARIS) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">

            {{-- Manual matic dasar --}}
            <div class="bg-[#D8F6FF] rounded-xl shadow-xl p-0  relative">
                {{-- CATATAN: 'overflow-hidden' DIHAPUS DARI SINI --}}

                {{-- Header Visi (Kotak Oranye dengan Ikon dan Teks) --}}
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
                    {{-- Penambahan z-50 di sini untuk memastikan stacking context --}}
                    <div
                        class="flex items-center justify-center py-2 px-6 rounded-xl bg-[#008CFF] text-white shadow-lg w-[280px] mb-4">
                        {{-- PLACEHOLDER ICON (Vision/Rocket) --}}
                        <img src="{{ asset('img/visis.png') }}" alt="Icon Visi" class="w-5 h-5 mr-2 object-contain" />
                        <h4 class="text-lg ">Dasar manual / matic</h4>
                    </div>
                </div>

                {{-- Konten Visi --}}
                <div class="p-8 pt-16">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Program kursus yang memberikan pelatihan dasar dalam mengemudi
                        baik kendaraan otomatis (matic) maupun manual, dengan durasi
                        beragam sesuai jadwal.
                    </p>

                </div>
            </div>

            {{-- KARTU 2: Memperlancar manual / matic (HIJAU MUDA) --}}
            <div class="bg-[#D5F8EF] rounded-xl shadow-xl p-0  relative">
                {{-- CATATAN: 'overflow-hidden' DIHAPUS DARI SINI --}}

                {{-- Header Visi (Kotak Oranye dengan Ikon dan Teks) --}}
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
                    {{-- Penambahan z-50 di sini untuk memastikan stacking context --}}
                    <div
                        class="flex items-center justify-center py-2 px-6 rounded-xl bg-[#14B789] text-white shadow-lg w-[330px] mb-4">
                        {{-- PLACEHOLDER ICON (Vision/Rocket) --}}
                        <img src="{{ asset('img/visis.png') }}" alt="Icon Visi" class="w-5 h-5 mr-2 object-contain" />
                        <h6 class="text-lg text-center">Memperlancar manual / matic</h6>
                    </div>
                </div>

                {{-- Konten Visi --}}
                <div class="p-8 pt-16">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Program lanjutan yang dirancang untuk pengemudi yang ingin
                        memperlancar kemampuan mengemudi mobil matic dan manual
                        baik secara teknis maupun mental.
                    </p>

                </div>
            </div>


            {{-- KARTU 3: Memperlancar manual / matic (HIJAU MUDA) --}}
            <div class="bg-[#D5F8EF] rounded-xl shadow-xl p-0  relative">
                {{-- CATATAN: 'overflow-hidden' DIHAPUS DARI SINI --}}

                {{-- Header Visi (Kotak Oranye dengan Ikon dan Teks) --}}
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
                    {{-- Penambahan z-50 di sini untuk memastikan stacking context --}}
                    <div
                        class="flex items-center justify-center py-2 px-6 rounded-xl bg-[#14B789] text-white shadow-lg w-[280px] mb-4">
                        {{-- PLACEHOLDER ICON (Vision/Rocket) --}}
                        <img src="{{ asset('img/visis.png') }}" alt="Icon Visi" class="w-5 h-5 mr-2 object-contain" />
                        <h4 class="text-lg text-center">SIM Tambahan</h4>
                    </div>
                </div>

                {{-- Konten Visi --}}
                <div class="p-8 pt-8">
                    <ul class="text-sm text-gray-700 leading-relaxed list-disc list-inside space-y-1 pl-4">
                        <li>Pas Photo ukuran 3 x 4 sebanyak : 2 lembar</li>
                        <li>Foto copy KTP sebanyak : 5 lembar</li>
                        <li>KIR Kesehatan + Psikologi (Tanggungan Siswa)</li>
                        <li>Biaya SIM : Rp. 120.000</li>
                    </ul>

                </div>
            </div>


            {{-- KARTU 4: Memperlancar manual / matic (HIJAU MUDA) --}}
            <div class="bg-[#FFECD0] rounded-xl shadow-xl p-0  relative">
                {{-- CATATAN: 'overflow-hidden' DIHAPUS DARI SINI --}}

                {{-- Header Visi (Kotak Oranye dengan Ikon dan Teks) --}}
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
                    {{-- Penambahan z-50 di sini untuk memastikan stacking context --}}
                    <div
                        class="flex items-center justify-center py-2 px-6 rounded-xl bg-[#F6A935] text-white shadow-lg w-[280px] mb-4">
                        {{-- PLACEHOLDER ICON (Vision/Rocket) --}}
                        <img src="{{ asset('img/visis.png') }}" alt="Icon Visi" class="w-5 h-5 mr-2 object-contain" />
                        <h4 class="text-lg text-center">Biaya Tambahan (Opsional)</h4>
                    </div>
                </div>

                {{-- Konten Visi --}}
                <div class="p-8 pt-16">
                    <ul class="text-sm text-gray-700 leading-relaxed list-disc list-inside space-y-1 pl-4">
                        <li>Antar-Jemput Siswa : Rp 300.000</li>
                        <li>Kartu Belajar & Buku Rambu-Rambu : Rp 20.000</li>
                    </ul>

                </div>
            </div>


            {{-- KARTU 5: Memperlancar manual / matic (HIJAU MUDA) --}}
            <div class="bg-[#FFECD0] rounded-xl shadow-xl p-0  relative">
                {{-- CATATAN: 'overflow-hidden' DIHAPUS DARI SINI --}}

                {{-- Header Visi (Kotak Oranye dengan Ikon dan Teks) --}}
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
                    {{-- Penambahan z-50 di sini untuk memastikan stacking context --}}
                    <div
                        class="flex items-center justify-center py-2 px-6 rounded-xl bg-[#F6A935] text-white shadow-lg w-[280px] mb-4">
                        {{-- PLACEHOLDER ICON (Vision/Rocket) --}}
                        <img src="{{ asset('img/visis.png') }}" alt="Icon Visi" class="w-5 h-5 mr-2 object-contain" />
                        <h4 class="text-lg text-center ">Jual Beli Kendaraan</h4>
                    </div>
                </div>

                {{-- Konten Visi --}}
                <div class="p-8 pt-16">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Jual beli mobil berkualitas dengan harga yang bersaing dan proses yang
                        mudah. Transaksi dijamin aman, transparan, dan terpercaya untuk
                        kenyamanan pelanggan.
                    </p>

                </div>
            </div>

            {{-- KARTU 2: Memperlancar manual / matic (HIJAU MUDA) --}}
            <div class="bg-[#FFD2D3] rounded-xl shadow-xl p-0  relative">
                {{-- CATATAN: 'overflow-hidden' DIHAPUS DARI SINI --}}

                {{-- Header Visi (Kotak Oranye dengan Ikon dan Teks) --}}
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
                    {{-- Penambahan z-50 di sini untuk memastikan stacking context --}}
                    <div
                        class="flex items-center justify-center py-2 px-6 rounded-xl bg-[#FD6A6C] text-white shadow-lg w-[280px] mb-4">
                        {{-- PLACEHOLDER ICON (Vision/Rocket) --}}
                        <img src="{{ asset('img/visis.png') }}" alt="Icon Visi" class="w-5 h-5 mr-2 object-contain" />
                        <h4 class="text-lg text-center">Jenis kendraan belajar</h4>
                    </div>
                </div>

                {{-- Konten Visi --}}
                <div class="p-8 pt-16">
                    <ul class="text-sm text-gray-700 leading-relaxed list-disc list-inside space-y-1 pl-4">
                        <li>Toyota Avanza</li>
                        <li>Honda Brio</li>
                        <li>Toyota Calya</li>
                        <li>Honda Mobilio</li>
                        <li>Daihatsu Ayla</li>
                    </ul>

                </div>
            </div>


        </div>
        {{-- CATATAN: Karena ada 8 kartu di gambar, grid ini seharusnya 4 baris. Saya hanya menampilkan 6 kartu yang datanya jelas di gambar. Tambahkan dua kartu lagi jika Anda memiliki datanya. --}}

    </div>
</section>
