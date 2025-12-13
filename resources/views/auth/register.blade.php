{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}


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
    <br>


    <main class="flex flex-col items-center justify-center flex-grow px-4 py-10 ">
        <!-- Logo -->
        <div class="absolute top-[75px] left-5 flex items-center gap-2">
            <img src="{{ asset('img/logo2.png') }}" alt="Logo" class="h-[125px] w-auto">
        </div>

        <!-- Card Form -->
        <div class="bg-white shadow-md rounded-md p-8 w-full max-w-md border fade-in border-gray-200">
            <h2 class="text-2xl font-semibold text-center mb-6 text-[#02104A]">Register</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- First Name -->
                {{-- <div>
                    <label for="first_name" class="block text-sm font-medium mb-1 text-gray-700">First Name</label>
                    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required
                        autofocus placeholder="First Name"
                        class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#02104A] focus:border-transparent outline-none shadow-sm" />
                    
                </div> --}}

                {{-- <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div> --}}

                <div>
                    <x-label for="password_confirmation" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        placeholder="Full Name" required autofocus autocomplete="name" />
                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                {{-- <div>
                    <label for="last_name" class="block text-sm font-medium mb-1 text-gray-700">Last Name</label>
                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required
                        placeholder="Last Name"
                        class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#02104A] focus:border-transparent outline-none shadow-sm" />
                    @error('last_name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div> --}}

                <!-- Username -->
                {{-- <div>
                    <label for="username" class="block text-sm font-medium mb-1 text-gray-700">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required
                        placeholder="Username"
                        class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#02104A] focus:border-transparent outline-none shadow-sm" />
                    @error('username')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div> --}}

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium mb-1 text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        placeholder="Email Address"
                        class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#02104A] focus:border-transparent outline-none shadow-sm" />
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium mb-1 text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required placeholder="Password"
                        class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#02104A] focus:border-transparent outline-none shadow-sm" />
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium mb-1 text-gray-700">Password
                        Confirmation</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        placeholder="Password Confirmation"
                        class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#02104A] focus:border-transparent outline-none shadow-sm" />
                    @error('password_confirmation')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Register -->
                <button type="submit"
                    class="w-full bg-[#000C4F] text-white py-2 rounded-md font-semibold hover:bg-[#001060] transition">
                    Register
                </button>

                <!-- Link ke login -->
                <div class="text-center mt-4">

                    <p class="text-center text-sm text-gray-700 mt-5">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-[#02104A] font-semibold hover:underline">Masuk di
                            sini</a>
                    </p>

                </div>
            </form>
        </div>
    </main>

    <x-footer></x-footer>

</body>

</html>
