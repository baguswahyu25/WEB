<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DriveNusa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('img/ico.png') }}">

    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
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
        <!-- Logo -->
        <div class="absolute top-[75px] left-5 flex items-center gap-2">
            <img src="{{ asset('img/logo2.png') }}" alt="Logo" class="h-[125px] w-auto">
        </div>

        <!-- Card Form -->
        <div
            class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md border border-gray-200 fade-in backdrop-blur-sm bg-opacity-95">
            <center>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
            </center>

            <h2 class="text-2xl font-semibold text-[#02104A] mb-6 text-center">Hai, Selamat datang kembali!</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Username / Email -->
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')"
                        placeholder="Email" required autofocus autocomplete="email" />
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ 'Pastikan email anda benar' }}</p>
                    @enderror
                </div>
                {{-- end user --}}

                <br>

                <!-- Password -->
                <div class="mb-4">
                    <div>
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                            :value="old('password')" placeholder="Password" required autofocus autocomplete="password" />
                        @error('password')
                            <p class="text-sm text-red-500 mt-1">{{ 'Pastikan passwprd anda benar' }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-2">
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-[#02104A] hover:underline font-medium">Lupa password?</a>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input id="remember" name="remember" type="checkbox"
                        class="w-4 h-4 text-[#02104A] border-gray-300 rounded focus:ring-[#02104A]">
                    <label for="remember" class="ml-2 text-sm text-gray-700">Tetap masuk</label>
                </div>
                {{--  --}}

                <!-- Tombol Login -->
                <button type="submit"
                    class="w-full bg-[#02104A] text-white font-semibold py-2.5 rounded-lg hover:bg-[#031873] hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                    Masuk
                </button>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                            __('Terms of Service') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                            __('Privacy Policy') .
                                            '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif


                <!-- Register -->
                <p class="text-center text-sm text-gray-700 mt-5">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-[#02104A] font-semibold hover:underline">Registrasi
                        sekarang</a>
                </p>
            </form>
        </div>
    </main>

    <x-footer></x-footer>



</body>

</html>
