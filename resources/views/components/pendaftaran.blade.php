<form action="{{ route('daftar.store') }}" method="POST">
    @csrf

    <input type="hidden" name="paket" value="{{ request('paket') }}">
    <input type="hidden" name="harga" value="{{ request('harga') }}">

    <input name="nama_lengkap" placeholder="Nama Lengkap" required>
    <input name="tempat_lahir" placeholder="Tempat Lahir" required>

    <input type="date" name="tanggal_lahir" required>

    <textarea name="alamat" placeholder="Alamat" required></textarea>

    <select name="mobil_dipilih" required>
        <option value="">Pilih Mobil</option>
        <option value="Avanza Manual">Avanza Manual</option>
        <option value="Brio Manual">Brio Manual</option>
    </select>

    <select name="metode_pembayaran" required>
        <option value="">Pilih Metode</option>
        <option value="tunai">Bayar di Tempat</option>
        <option value="midtrans">Bayar Online (Midtrans)</option>
    </select>

    <button type="submit">
        Daftar & Lanjut Pembayaran
    </button>
</form>
