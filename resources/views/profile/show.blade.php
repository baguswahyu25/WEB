<x-profile-layout>
    <div class="relative group cursor-none" id="avatar-trigger">
        <img class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-xl transition hover:opacity-90"
            src="{{ Auth::user()->profile_photo_url }}" alt="Profile">

        <div
            class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-md text-orange-500 border border-gray-100 hover:scale-110 transition">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
        </div>
    </div>

    <div id="photo-modal" class="fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black/50" id="overlay-bg"></div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-6 z-10 relative">
                <button id="close-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 cursor-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="mt-4 text-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Ubah Foto Profil</h3>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl border border-dashed border-gray-300">
                    @livewire('profile-photo-upload')

                    <x-section-border />

                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')
                    @endif

                </div>
            </div>
        </div>
    </div>
    <h2 class="mt-4 text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
    <div class="flex gap-12 mt-8">
        <div class="flex flex-col items-center group cursor-none">
            <div
                class="bg-orange-100 p-4 rounded-2xl text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-all">
                <img src="{{ asset('img/pesan.png') }}" class="w-7 h-7">
            </div>
            <span class="text-xs mt-2 font-medium text-gray-500">pesan</span>
        </div>
        <div class="flex flex-col items-center group cursor-none">
            <div
                class="bg-orange-100 p-4 rounded-2xl text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-all">
                <img src="{{ asset('img/jadwal.png') }}" class="w-7 h-7">
            </div>
            <span class="text-xs mt-2 font-medium text-gray-500">jadwal</span>
        </div>
        <div class="flex flex-col items-center group cursor-none">
            <div
                class="bg-orange-100 p-4 rounded-2xl text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-all">
                <img src="{{ asset('img/riwayat.png') }}" class="w-7 h-7">
            </div>
            <span class="text-xs mt-2 font-medium text-gray-500">riwayat</span>
        </div>
    </div>




    <script>
        const trigger = document.getElementById('avatar-trigger');
        const modal = document.getElementById('photo-modal');
        const closeBtn = document.getElementById('close-modal');
        const overlay = document.getElementById('overlay-bg');

        // Buka Modal
        trigger.addEventListener('click', () => {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Kunci scroll body
        });

        // Tutup Modal (Tombol X)
        closeBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Lepas scroll body
        });

        // Tutup Modal (Klik Luar Area)
        overlay.addEventListener('click', () => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });
    </script>


</x-profile-layout>
