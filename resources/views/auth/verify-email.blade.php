<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JagoStir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="../asset/logo.png">
</head>

<body class="min-h-screen bg-gradient-to-b from-white to-[#02104A] flex flex-col justify-between">

    <x-nafbar>
    </x-nafbar>

    <br>
    <br>

    <!-- Form Login -->
    <br>
    <br>

    <main class="flex flex-col items-center justify-center flex-grow px-4 py-10 ">

        <div class="absolute top-[75px] left-5 flex items-center gap-2">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-[125px] w-auto">
        </div>

        <div
            class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md border border-gray-200 fade-in backdrop-blur-sm bg-opacity-95">


            <div class="mb-4 text-sm text-gray-600 text-justify">
                {{ __('Selamat datang! Langkah terakhir untuk mengaktifkan akun Anda adalah dengan memverifikasi alamat email Anda. Tanpa menyelesaikan proses verifikasi ini, Anda tidak dapat melewati halaman ini dan semua akses ke sistem akan ditolak.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('Email Verifikasi di kirim ke alamat email yang anda Daftarkan.') }}
                </div>
            @endif

            <div class="mt-4 flex flex-col items-center">
                <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                    @csrf

                    <div class="w-full">
                        <button type="submit"
                            class="w-full bg-[#02104A] text-white font-semibold py-2.5 rounded-lg hover:bg-[#031873] hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                            {{ __('Kirim Ulang Email Verifikasi') }}
                        </button>
                    </div>
                </form>
                <form method="POST" action="{{ route('logout') }}" class="mt-4 w-full text-center">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </main>


    <x-footer></x-footer>

</body>

</html>
