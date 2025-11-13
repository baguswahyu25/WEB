<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <title>{{ config('app.name') }}</title>
    {{-- @include('layouts.load') --}}

    <style>
        /* Efek animasi halus saat muncul */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.8s ease-in-out;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-white to-[#02104A] flex flex-col justify-between">


    {{-- @include('layouts.nafbaar') --}}



    <br>
    <br>
    <br>

    <main class="flex flex-col items-center justify-center flex-grow px-4 py-10 ">
        <!-- Logo -->
        <div class="absolute top-[75px] left-5 flex items-center gap-2">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-[125px] w-auto">
        </div>

        <!-- Card Form -->
        <div
            class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md border border-gray-200 fade-in backdrop-blur-sm bg-opacity-95">
            <center>
                {{-- Session Status (Untuk pesan sukses/pemberitahuan) --}}
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- PENTING: Menampilkan error validasi umum (seperti 'Kredensial tidak cocok' atau error non-field-specific lainnya) --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm font-medium text-left">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- END PENTING --}}
            </center>

            <h2 class="text-2xl font-bold text-[#02104A] mb-6 text-center">Hai, Selamat Datang Kembali!</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Username / Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-1 font-medium">Username atau Email</label>

                    <input id="email" name="email" type="text" placeholder="Masukkan username atau email"
                        value="{{ old('email') }}" {{-- PENTING: Menjaga input setelah validasi gagal --}} required autofocus autocomplete="username"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#02104A] focus:border-transparent transition-all duration-200 shadow-sm
                        @error('email') border-red-500 @enderror">

                    <x-input id="email" type="text" name="email" placeholder="Masukkan username anda"
                        class="mt-4" />

                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ 'email anda salah kawan' }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-1 font-medium">Password</label>
                    <input id="password" name="password" type="password" placeholder="Masukkan password" required
                        autocomplete="current-password"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#02104A] focus:border-transparent transition-all duration-200 shadow-sm
                        @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-end mt-2">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm text-[#02104A] hover:underline font-medium">Lupa password?</a>
                        @endif
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input id="remember" name="remember" type="checkbox"
                        class="w-4 h-4 text-[#02104A] border-gray-300 rounded focus:ring-[#02104A]">
                    <label for="remember" class="ml-2 text-sm text-gray-700">Tetap masuk</label>
                </div>

                <!-- Tombol Login -->
                <button type="submit"
                    class="w-full bg-[#02104A] text-white font-semibold py-2.5 rounded-lg hover:bg-[#031873] hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                    Masuk
                </button>

                <!-- Register -->
                <p class="text-center text-sm text-gray-700 mt-5">
                    Belum punya akun?
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="text-[#02104A] font-semibold hover:underline">Registrasi
                            sekarang</a>
                    @endif
                </p>
            </form>
        </div>
    </main>

    {{-- @include('layouts.footer') --}}

</body>

</html>
