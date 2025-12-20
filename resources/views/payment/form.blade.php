<x-app-layout>
    <div class="max-w-xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">
            Pendaftaran Paket {{ $paket }}
        </h1>

        <form method="POST" action="{{ route('payment.store') }}">
            @csrf

            <input type="hidden" name="paket" value="{{ $paket }}">
            <input type="hidden" name="harga" value="{{ $harga }}">
            <input type="hidden" name="metode_pembayaran" value="midtrans">

            <input name="nama_lengkap" placeholder="Nama Lengkap" class="w-full border p-3 rounded mb-4" required>

            <input name="tempat_lahir" placeholder="Tempat Lahir" class="w-full border p-3 rounded" required>

            <input type="date" name="tanggal_lahir" class="w-full border p-3 rounded" required>

            <select name="jenis_kelamin" class="w-full border p-3 rounded" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <input name="alamat" placeholder="Alamat" class="w-full border p-3 rounded" required>

            <input name="pekerjaan" placeholder="Pekerjaan" class="w-full border p-3 rounded" required>

            <input name="mobil_dipilih" placeholder="Mobil Dipilih" class="w-full border p-3 rounded" required>

            <button class="w-full bg-orange-500 text-white py-3 rounded font-bold">
                Lanjut Pembayaran
            </button>
        </form>

    </div>
</x-app-layout>
