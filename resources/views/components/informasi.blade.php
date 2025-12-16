<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- ========================================================= --}}
    {{-- A. SECTION FITUR & LAYANAN UTAMA (Warna Lebih Kuat) --}}
    {{-- ========================================================= --}}

    <div class="mb-40 mt-20">
        {{-- Container Luar dengan Border Biru Tebal dan Rounded Besar --}}
        <div class="p-8  rounded-xl shadow-lg  bg-white mb-10">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Kartu 1: Paket SIM Tambahan (Hijau Pastel) --}}
                <div class="flex items-start p-6 rounded-xl bg-[#D5F8EF] shadow-md">
                    {{-- Lingkaran Ikon (Hijau Solid: #00B18A) --}}
                    <div class="flex-shrink-0 relative p-3 rounded-xl bg-[#14B789] text-white mr-4 shadow-lg">
                        {{-- Placeholder Icon (Gunakan Gambar Anda Sendiri) --}}
                        <img src="{{ asset('img/ic9.png') }}" alt="Icon SIM" class="w-[60px] h-[60px] object-contain" />
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 leading-snug">Paket sim tambahan</h3>
                        <p class="text-sm text-gray-700 leading-snug mt-1">bagi siswa kursus yang ingin mendapatkan sim
                            card</p>
                    </div>
                </div>

                {{-- Kartu 2: Biaya Tambahan (Oranye Pastel) --}}
                <div class="flex items-start p-6 rounded-xl bg-[#FFECD0] shadow-md">
                    {{-- Lingkaran Ikon (Oranye Solid: #F4A54F) --}}
                    <div class="flex-shrink-0 p-3 rounded-xl bg-[#F6A935] text-white mr-4 shadow-lg">
                        {{-- Placeholder Icon (Gunakan Gambar Anda Sendiri) --}}
                        <img src="{{ asset('img/ic7.png') }}" alt="Icon Biaya Tambahan"
                            class="w-[60px] h-[60px] object-contain" />
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 leading-snug">Biaya tambahan</h3>
                        <p class="text-sm text-gray-700 leading-snug mt-1">bagi siswa kursus yang ingin menggunakan
                            layanan antar jemput</p>
                    </div>
                </div>

                {{-- Kartu 3: Jual Beli Kendaraan (Biru Pastel) --}}
                <div class="flex items-start p-6 rounded-xl bg-[#D8F6FF] shadow-md">
                    {{-- Lingkaran Ikon (Biru Solid: #0091D0) --}}
                    <div class="flex-shrink-0 relative p-3 rounded-xl bg-[#00AEE5] text-white mr-4 shadow-lg">
                        {{-- Placeholder Icon (Gunakan Gambar Anda Sendiri) --}}
                        <img src="{{ asset('img/ic8.png') }}" alt="Icon Jual Beli Mobil"
                            class="w-[60px] h-[60px] object-contain" />

                        {{-- Teks $ (Menggunakan absolute positioning seperti di gambar) --}}
                        <span class="absolute top-0 right-0 text-white text-base font-bold -mt-2 -mr-1.5"></span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 leading-snug">Jual beli kendaraan</h3>
                        <p class="text-sm text-gray-700 leading-snug mt-1">Tersedia layanan jual & beli kendaraan aman
                            dan terpercaya</p>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- B. SECTION VISI & MISI (Warna Lebih Kuat) --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-20">

        {{-- Kartu 1: Visi --}}
        <div class="bg-white rounded-xl shadow-xl p-0  relative">
            {{-- CATATAN: 'overflow-hidden' DIHAPUS DARI SINI --}}

            {{-- Header Visi (Kotak Oranye dengan Ikon dan Teks) --}}
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
                {{-- Penambahan z-50 di sini untuk memastikan stacking context --}}
                <div class="flex items-center justify-center py-2 px-6 rounded-xl bg-[#F6A935] text-white shadow-lg">
                    {{-- PLACEHOLDER ICON (Vision/Rocket) --}}
                    <img src="{{ asset('img/visis.png') }}" alt="Icon Visi" class="w-5 h-5 mr-2 object-contain" />
                    <h2 class="text-lg ">Vision</h2>
                </div>
            </div>

            {{-- Konten Visi --}}
            <div class="p-8 pt-16">
                <br>

                <p class="text-gray-700 text-center leading-relaxed ">

                    Menjadi lembaga pelatihan mengemudi yang profesional dan berkualitas untuk menghasilkan sumber daya
                    manusia yang kompeten dalam bidang mengemudi kendaraan bermotor. </p>
                <br>
            </div>
        </div>
        {{-- Kartu 2: Misi --}}
        <div class="bg-white rounded-xl shadow-xl p-0  border-gray-300 relative">
            {{-- CATATAN: 'overflow-hidden' DIHAPUS DARI SINI --}}

            {{-- Header Visi (Kotak Oranye dengan Ikon dan Teks) --}}
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
                {{-- Penambahan z-50 di sini untuk memastikan stacking context --}}
                <div class="flex items-center justify-center py-2 px-6 rounded-xl bg-[#F6A935] text-white shadow-lg">
                    {{-- PLACEHOLDER ICON (Vision/Rocket) --}}
                    <img src="{{ asset('img/misis.png') }}" alt="Icon Visi" class="w-5 h-5 mr-2 object-contain" />
                    <h2 class="text-lg ">Mission</h2>
                </div>
            </div>

            {{-- Konten Visi --}}
            <div class="p-8 pt-16">
                <br>

                <ul class=" text-gray-700 space-y-2 list-disc list-inside marker:text-black">
                    <li>Menyelenggarakan program pelatihan mengemudi secara profesional.</li>
                    <li>Memberikan pelatihan yang bermutu dalam bidang mengemudi kendaraan bermotor.</li>

                </ul>
                <br>

            </div>
        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- C. SECTION INFORMASI KONTAK (Warna Lebih Kuat) --}}
    {{-- ========================================================= --}}

    <div class="flex flex-wrap justify-center md:justify-start gap-6 md:gap-12 p-6 rounded-xl">

        {{-- Kontak: Telepon --}}
        <div class="flex items-center space-x-3">
            <div class="p-3 rounded-full bg-[#14B789] text-white shadow-md">
                {{-- PLACEHOLDER ICON (Whatsapp/Phone) --}}
                <img src="{{ asset('img/wapp.png') }}" alt="Icon Whatsapp" class="w-[22px] h-[22px] object-contain" />
            </div>
            <span class="text-gray-700 font-medium">+6285272201996</span>
        </div>

        {{-- Kontak: Email --}}
        <div class="flex items-center space-x-3">
            <div class="p-3 rounded-full bg-[#00AEE5] text-white shadow-md">
                {{-- PLACEHOLDER ICON (Email) --}}
                <img src="{{ asset('img/mail.png') }}" alt="Icon Email" class="w-[22px] h-[22px] object-contain" />
            </div>
            <span class="text-gray-700 font-medium">dhuahdc@gmail.com</span>
        </div>

        {{-- Kontak: Lokasi --}}
        <div class="flex items-center space-x-3">
            <div class="p-3 rounded-full bg-[#F6A935] text-white shadow-md">
                {{-- PLACEHOLDER ICON (Location) --}}
                <img src="{{ asset('img/icloc.png') }}" alt="Icon Lokasi" class="w-[22px] h-[22px] object-contain" />
            </div>
            <span class="text-gray-700 font-medium">Wonosari - Bengkalis</span>
        </div>

    </div>

</div>
