<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-[#000f3f] p-4">

        <div class="w-full max-w-md bg-white rounded-xl shadow-xl p-6">

            {{-- LOGO --}}
            <div class="flex justify-center mb-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-[125px] w-auto">
            </div>

            <h2 class="text-center text-2xl font-bold text-[#000f3f] mb-4">
                Reset Password
            </h2>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="block">
                    <x-label for="email" value="{{ __('Email') }}" class="text-[#000f3f]" />
                    <x-input id="email" class="block mt-1 w-full"
                        type="email" name="email"
                        :value="old('email', $request->email)" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-[#000f3f]" />
                    <x-input id="password" class="block mt-1 w-full"
                        type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-[#000f3f]" />
                    <x-input id="password_confirmation" class="block mt-1 w-full"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button class="px-4 py-2 bg-[#f89331] text-white font-semibold rounded-lg shadow hover:bg-orange-500 transition">
                        Reset Password
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-guest-layout>