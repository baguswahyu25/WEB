<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow">

    <h2 class="text-xl font-bold mb-4">1. Data Pendaftar</h2>

    <input wire:model.live="nama_lengkap" type="text" placeholder="Nama Lengkap" class="input">
    <input wire:model.live="tempat_lahir" type="text" placeholder="Tempat Lahir" class="input">
    <input wire:model.live="tanggal_lahir" type="date" class="input">
    <textarea wire:model.live="alamat" placeholder="Alamat" class="input"></textarea>

    <select wire:model.live="jenis_kelamin" class="input">
        <option value="">Pilih Jenis Kelamin</option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select>

    <input wire:model.live="pekerjaan" type="text" placeholder="Pekerjaan" class="input">

    <select wire:model.live="mobil_dipilih" class="input">
        <option value="">Pilih Mobil</option>
        <option value="Avanza Manual">Avanza Manual</option>
        <option value="Brio Manual">Brio Manual</option>
        <option value="Avanza Matic">Avanza Matic</option>
    </select>

    <h2 class="text-xl font-bold mt-6">2. Paket Dipilih</h2>
    <div class="bg-gray-100 p-4 rounded">
        <p><strong>Paket:</strong> {{ $paket }}</p>
        <p><strong>Harga:</strong> Rp {{ number_format($harga, 0, ',', '.') }}</p>
    </div>

    <h2 class="text-xl font-bold mt-6">
        3. Pembayaran (Total: Rp {{ number_format($harga, 0, ',', '.') }})
    </h2>

    <label class="flex items-center gap-2 mt-2">
        <input type="radio" wire:model.live="metode_pembayaran" value="midtrans">
        Bayar Online (Midtrans)
    </label>

    <label class="flex items-center gap-2">
        <input type="radio" wire:model.live="metode_pembayaran" value="tunai">
        Bayar Tunai
    </label>

    <button type="button" wire:click="submit"
        class="mt-6 w-full bg-orange-500 text-white py-3 rounded-lg font-bold
           relative z-50">
        Daftar & Bayar
    </button>




    <script>
        document.addEventListener('livewire:initialized', () => {

            Livewire.on('open-midtrans', data => {
                if (!window.snap) {
                    alert('Midtrans Snap belum termuat');
                    return;
                }

                window.snap.pay(data.token, {
                    onSuccess: function(result) {
                        console.log('SUCCESS', result);
                        window.location.href = '/pembayaran/sukses';
                    },
                    onPending: function(result) {
                        console.log('PENDING', result);
                        window.location.href = '/pembayaran/pending';
                    },
                    onError: function(result) {
                        console.log('ERROR', result);
                        alert('Pembayaran gagal');
                    },
                    onClose: function() {
                        alert('Pembayaran dibatalkan');
                    }
                });
            });

        });
    </script>

</div>
