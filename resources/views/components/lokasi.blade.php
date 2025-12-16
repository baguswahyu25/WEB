<section id="lokasi" class="py-12 px-4 md:px-16 bg-white scroll-mt-20">
    <div class="max-w-6xl mx-auto text-center">

        {{-- JUDUL DAN DESKRIPSI --}}
        <h2 class="text-3xl font-bold text-[#F4A54F] mb-3">Lokasi Kursus</h2>
        <p class="text-gray-700 max-w-2xl mx-auto mb-10 leading-relaxed">
            Belajar Mengemudi Dhuha Bengkalis beralamat di Wonosari, Bengkalis
            Sub-District, Bengkalis Regency, Riau 28711, Indonesia
        </p>

        {{-- KARTU PETA GOOGLE MAPS --}}
        <div class="bg-white rounded-xl shadow-2xl p-4 border border-gray-100 overflow-hidden">
            {{--
                CATATAN: Untuk peta, Anda akan menempatkan embed code dari Google Maps (iframe) di sini.
                Saat ini, saya menggunakan div placeholder dengan warna latar belakang hijau muda
                untuk meniru area peta agar tampilan tetap sesuai.
            --}}
            <div class="w-full h-[400px] rounded-lg overflow-hidden relative">

                {{-- Placeholder Peta (Ganti dengan <iframe> Google Maps Embed Anda) --}}
                <div class="w-full h-full bg-[#E5F5E2] flex items-center justify-center text-gray-500 font-medium">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d249.27943261739998!2d102.12763969632225!3d1.4890912685374913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1617892640bd7%3A0xb9e1d46cdf3f78fb!2sKursus%20Mengemudi%20DHUHA!5e0!3m2!1sid!2sid!4v1765832048049!5m2!1sid!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                {{-- Text "Google Maps" di kanan bawah placeholder --}}
                <span class="absolute bottom-4 right-4 text-gray-400 text-sm font-semibold">Google Maps</span>
            </div>
        </div>

        {{-- INFORMASI KONTAK (DI BAWAH PETA) --}}
        <div class="flex flex-col sm:flex-row justify-center gap-6 mt-8">

            {{-- Kontak 1: Telepon/WhatsApp (Hijau) --}}
            <div
                class="flex items-center justify-center gap-3 py-3 px-6 rounded-full bg-white border border-gray-200 shadow-lg">
                {{-- Lingkaran Ikon Hijau --}}
                <div
                    class="w-8 h-8 rounded-full bg-[#14B789] flex items-center justify-center text-white flex-shrink-0">
                    {{-- Placeholder Ikon Telepon/WhatsApp (Ganti dengan SVG jika perlu) --}}
                    <img src="{{ asset('img/telpon.png') }}" alt="Telepon" class="h-9 w-auto">
                </div>
                <span class="text-sm font-medium text-gray-800">+6285272201996</span>
            </div>

            {{-- Kontak 2: Email (Biru) --}}
            <div
                class="flex items-center justify-center gap-3 py-3 px-6 rounded-full bg-white border border-gray-200 shadow-lg">
                {{-- Lingkaran Ikon Biru --}}
                <div class="w-8 h-8 rounded-full  flex items-center justify-center text-white flex-shrink-0">
                    {{-- Placeholder Ikon Email (Ganti dengan SVG jika perlu) --}}
                    <img src="{{ asset('img/email.png') }}" alt="Email" class="h-9 w-auto">
                </div>
                <span class="text-sm font-medium text-gray-800">dhuha.hdc@gmail.com</span>
            </div>
        </div>

    </div>
</section>
