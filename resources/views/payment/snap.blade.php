<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran Midtrans</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Midtrans Snap --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md text-center">
        <h1 class="text-2xl font-bold mb-4">Pembayaran Kursus</h1>

        <p class="text-gray-600 mb-2">
            Paket: <strong>{{ $pendaftaran->paket }}</strong>
        </p>

        <p class="text-gray-600 mb-6">
            Total:
            <strong class="text-lg text-orange-500">
                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
            </strong>
        </p>

        <button id="pay-button"
            class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-6 py-3 rounded-full w-full shadow">
            Bayar Sekarang
        </button>

        <p class="text-sm text-gray-400 mt-4">
            Jangan tutup halaman ini sebelum pembayaran selesai
        </p>
    </div>

    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    console.log('SUCCESS', result);
                    alert('Pembayaran berhasil!');
                    window.location.href = '/dashboard';
                },
                onPending: function(result) {
                    console.log('PENDING', result);
                    alert('Menunggu pembayaran');
                },
                onError: function(result) {
                    console.log('ERROR', result);
                    alert('Pembayaran gagal');
                },
                onClose: function() {
                    alert('Popup ditutup sebelum menyelesaikan pembayaran');
                }
            });
        });
    </script>

</body>

</html>
