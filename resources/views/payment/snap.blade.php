<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
</head>

<!-- tidak full page layout, hanya center container -->
<div class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm">

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md text-center">

        <h1 class="text-xl font-bold mb-3">Konfirmasi Pembayaran</h1>

        <p class="text-gray-600 mb-2">
            Paket: <strong>{{ $pendaftaran->paket }}</strong>
        </p>

        <p class="text-gray-600 mb-6">
            Total:
            <strong class="text-orange-500 text-lg">
                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
            </strong>
        </p>

        <button id="pay-button"
            class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-6 py-3 rounded-full w-full">
            Lanjutkan Pembayaran
        </button>

        <p class="text-xs text-gray-400 mt-4">
            Anda akan diarahkan ke pembayaran Midtrans
        </p>

    </div>
</div>

<script>
    document.getElementById('pay-button').addEventListener('click', function() {

        window.snap.pay('{{ $snapToken }}', {

            onSuccess: function(result) {
                alert('Pembayaran berhasil!');
                window.location.href = '/dashboard';
            },

            onPending: function() {
                alert('Menunggu pembayaran');
            },

            onError: function() {
                alert('Pembayaran gagal');
            },

            onClose: function() {
                console.log('Popup ditutup');
            }

        });

    });
</script>

</html>
