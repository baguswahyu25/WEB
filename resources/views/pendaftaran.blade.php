<x-app-layout>
    <x-nafbar />


    <main
        class="flex flex-col items-center justify-center flex-grow px-4 py-10 bg-gradient-to-b from-white to-[#3c4d91]">

        <!-- Logo -->
        <div class="absolute top-[75px] left-5 flex items-center gap-2">
            <img src="{{ asset('img/logo2.png') }}" alt="Logo" class="h-[125px] w-auto">
        </div>

        <!-- Card Form -->
        <div
            class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-xl border border-gray-200 backdrop-blur-sm bg-opacity-95">

            <h2 class="text-2xl font-semibold text-[#02104A] mb-2 text-center">
                Form Pendaftaran Kursus
            </h2>

            <p class="text-center text-gray-600 mb-6">
                Paket: <b>{{ ucfirst($paket) }}</b> |
                Harga: <b>Rp {{ number_format($harga) }}</b>
            </p>

            <form action="{{ route('pendaftaran.store') }}" method="POST">
                @csrf

                <input type="hidden" name="paket" value="{{ $paket }}">
                <input type="hidden" name="harga" value="{{ $harga }}">

                <!-- Nama -->
                <div class="mb-4">
                    <x-label for="nama_lengkap" value="Nama Lengkap" />
                    <x-input name="nama_lengkap" class="block mt-1 w-full" required />
                </div>

                <!-- Tempat Lahir -->
                <div class="mb-4">
                    <x-label for="tempat_lahir" value="Tempat Lahir" />
                    <x-input name="tempat_lahir" class="block mt-1 w-full" required />
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-4">
                    <x-label for="tanggal_lahir" value="Tanggal Lahir" />
                    <x-input type="date" name="tanggal_lahir" class="block mt-1 w-full" required />
                </div>

                <!-- Jenis Kelamin -->
                <div class="mb-4">
                    <x-label value="Jenis Kelamin" />
                    <select name="jenis_kelamin"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#02104A] focus:border-[#02104A]">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <!-- Alamat -->
                <div class="mb-4">
                    <x-label value="Alamat" />
                    <textarea name="alamat" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#02104A] focus:border-[#02104A]"
                        rows="3" required></textarea>
                </div>

                <!-- Pekerjaan -->
                <div class="mb-4">
                    <x-label value="Pekerjaan" />
                    <x-input name="pekerjaan" class="block mt-1 w-full" required />
                </div>

                <!-- Mobil -->
                <div class="mb-4">
                    <x-label value="Mobil Dipilih" />
                    <select name="mobil_dipilih"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#02104A] focus:border-[#02104A]">
                        <option value="">Pilih Mobil</option>
                        <option value="Avanza Manual">Avanza Manual</option>
                        <option value="Brio Manual">Brio Manual</option>
                    </select>
                </div>

                <!-- Tipe Pendaftaran -->
                <div class="mb-4">
                    <x-label value="Tipe Pendaftaran" />
                    <select name="tipe_pendaftaran"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#02104A] focus:border-[#02104A]">
                        <option value="non_sim">Non SIM</option>
                    </select>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-6">
                    <x-label value="Metode Pembayaran" />
                    <select name="metode_pembayaran"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#02104A] focus:border-[#02104A]">
                        <option value="">Pilih Metode</option>
                        <option value="tunai">Bayar di Tempat</option>
                        <option value="midtrans">Bayar Online (Midtrans)</option>
                    </select>
                </div>

                <!-- Tombol -->
                <button type="submit"
                    class="w-full bg-[#02104A] text-white font-semibold py-3 rounded-lg hover:bg-[#031873] hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                    Daftar & Lanjut Pembayaran
                </button>

            </form>

        </div>

    </main>

    <x-footer />


</x-app-layout>
