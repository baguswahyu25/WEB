<form action="{{ route('pendaftaran.store') }}" method="POST">

    @csrf

    <input type="hidden" name="paket" value="{{ $paket }}">
    <input type="hidden" name="harga" value="{{ $harga }}">


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
<select name="jenis_kelamin" required>
    <option value="">Jenis Kelamin</option>
    <option value="Laki-laki">Laki-laki</option>
    <option value="Perempuan">Perempuan</option>
</select>

<input name="pekerjaan" placeholder="Pekerjaan" required>

<select name="tipe_pendaftaran" required>
    <option value="non_sim">Non SIM</option>
    <option value="sim">Dengan SIM</option>
</select>

    <button type="submit">
        Daftar & Lanjut Pembayaran
    </button>
</form>
