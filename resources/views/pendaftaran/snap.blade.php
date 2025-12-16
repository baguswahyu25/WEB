<!DOCTYPE html>
<html>

<head>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
</head>

<body>

    <script>
        snap.pay('{{ $snapToken }}', {
            onSuccess: () => window.location.href = '/daftar?status=success',
            onPending: () => alert('Menunggu pembayaran'),
            onError: () => alert('Pembayaran gagal')
        });
    </script>

</body>

</html>
