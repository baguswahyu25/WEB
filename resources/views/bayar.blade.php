<x-app-layout>
    <h1>Pendaftaran Paket {{ $paket }}</h1>

    <form id="payment-form">
        @csrf
        <input type="hidden" name="paket" value="{{ $paket }}">
        <input type="hidden" name="harga" value="{{ $harga }}">

        <input name="nama_lengkap" placeholder="Nama Lengkap" required>
        <input name="tempat_lahir" placeholder="Tempat Lahir" required>
        <input type="date" name="tanggal_lahir" required>
        <input name="alamat" placeholder="Alamat" required>
        <select name="jenis_kelamin" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
        <input name="pekerjaan" placeholder="Pekerjaan" required>
        <input name="mobil_dipilih" placeholder="Mobil Dipilih" required>

        <button type="submit" id="pay-button">Bayar Sekarang</button>
    </form>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function(e) {
            e.preventDefault();
            const data = {
                nama_lengkap: document.querySelector('[name="nama_lengkap"]').value,
                tempat_lahir: document.querySelector('[name="tempat_lahir"]').value,
                tanggal_lahir: document.querySelector('[name="tanggal_lahir"]').value,
                alamat: document.querySelector('[name="alamat"]').value,
                jenis_kelamin: document.querySelector('[name="jenis_kelamin"]').value,
                pekerjaan: document.querySelector('[name="pekerjaan"]').value,
                mobil_dipilih: document.querySelector('[name="mobil_dipilih"]').value,
                paket: document.querySelector('[name="paket"]').value,
                harga: document.querySelector('[name="harga"]').value
            };

            fetch("{{ route('bayar.init', [], true) }}", { // param true = paksa https
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(data)
                })

                .then(res => res.json())
                .then(res => {
                    if (res.snapToken) {
                        snap.pay(res.snapToken, {
                            onSuccess: function(result) {
                                alert("Pembayaran sukses!");
                                console.log(result);
                                location.reload();
                            },
                            onPending: function(result) {
                                alert("Pembayaran pending!");
                                console.log(result);
                            },
                            onError: function(result) {
                                alert("Terjadi error!");
                                console.log(result);
                            }
                        });
                    } else {
                        alert(res.error);
                    }
                });
        });
    </script>
</x-app-layout>
