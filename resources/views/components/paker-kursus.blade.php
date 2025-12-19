<!-- SECTION: PILIHAN PAKET (Sesuai Desain) -->
<section class="py-20 px-4 bg-white font-sans">

    <!-- HEADER -->
    <div class="text-center mb-16">
        <h1 class="text-5xl font-extrabold text-orange-400 mb-4">Pilihan Paket</h1>
        <p class="text-lg text-gray-700">Pilih paket kursus yang sesuai dengan kebutuhan anda</p>
    </div>

    <!-- CARD WRAPPER -->
    <div class="flex flex-col lg:flex-row justify-center gap-10 max-w-7xl mx-auto">

        <!-- CARD MANUAL -->
        <div class="relative w-full max-w-sm bg-[#FFF3E0] border border-gray-300 rounded-3xl p-6 flex flex-col">
            <span
                class="absolute -top-4 left-1/2 -translate-x-1/2 bg-white px-6 py-2 rounded-full shadow text-sm text-gray-700">
                Transmisi manual
            </span>
            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-2">Manual</h2>
            <p class="text-gray-700 mb-6">Cocok untuk kamu yang ingin belajar mengendarai mobil manual...</p>
            <div class="bg-white rounded-xl shadow p-4 mb-6 flex justify-center">
                <img src="img/M.png" alt="Manual" class="max-h-40 object-contain">
            </div>
            <div class="mb-8">
                <h4 class="font-semibold mb-3">Benefit kursus:</h4>
                <ul class="text-sm text-gray-700 space-y-2 list-disc list-inside marker:text-orange-400">
                    <li>Dapat diajarkan mulai dari dasar</li>
                    <li>Berlatih menggunakan Mobil Manual</li>
                    <li>Belajar Praktik Parkir</li>
                    <li>Belajar Praktik di Jalan Raya</li>
                    <li>14 pertemuan</li>
                </ul>
            </div>


            @guest
                <a href="/login"
                    class="mt-auto mx-auto bg-orange-400 hover:bg-orange-500 text-white font-bold px-10 py-3 rounded-full shadow text-center block">
                    Rp 2.150.000
                </a>
            @endguest


            @auth
                <form action="{{ route('bayar.show') }}" method="POST" class="mt-auto">
                    @csrf
                    {{-- Data disembunyikan agar tidak muncul di URL --}}
                    <input type="hidden" name="paket" value="Manual">
                    <input type="hidden" name="harga" value="2150000">

                    <button type="submit"
                        class="mx-auto bg-orange-400 hover:bg-orange-500 text-white font-bold px-10 py-3 rounded-full shadow text-center block w-full">
                        Rp 2.150.000
                    </button>
                </form>
                {{-- <a href="{{ route('bayar.show', ['paket' => 'Manual', 'harga' => 2150000]) }}"
                    class="mt-auto mx-auto bg-orange-400 hover:bg-orange-500 text-white font-bold px-10 py-3 rounded-full shadow text-center block">
                    Rp 2.150.000
                </a> --}}
            @endauth
        </div>


        <!-- CARD MATIC (POPULAR) -->
        <div
            class="relative w-full max-w-sm bg-[#FFF3E0] border-2 border-orange-400 rounded-3xl p-6 flex flex-col scale-105 z-10">

            <span
                class="absolute -top-4 left-1/2 -translate-x-1/2 bg-white px-6 py-2 rounded-full shadow text-sm text-gray-700">
                Transmisi otomatis
            </span>

            <span class="absolute top-4 right-4 bg-orange-400 text-white text-xs font-bold px-3 py-1 rounded-full">
                Populer
            </span>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-2">Matic</h2>
            <p class="text-gray-700 mb-6">
                Cocok untuk kamu yang ingin belajar mengendarai mobil Matic dari dasar maupun melancarkan
            </p>

            <div class="bg-white rounded-xl shadow p-4 mb-6 flex justify-center">
                <img src="path/to/matic-car-image.png" alt="Matic" class="max-h-40 object-contain">
            </div>

            <div class="mb-8">
                <h4 class="font-semibold mb-3">Benefit kursus:</h4>
                <ul class="text-sm text-gray-700 space-y-2 list-disc list-inside marker:text-orange-400">
                    <li>Dapat diajarkan mulai dari dasar</li>
                    <li>Berlatih menggunakan Mobil Matic</li>
                    <li>Belajar Praktik Parkir</li>
                    <li>Belajar Praktik di Jalan Raya</li>
                    <li>14 pertemuan</li>
                </ul>
            </div>

            <button
                class="mt-auto mx-auto bg-orange-400 hover:bg-orange-500 text-white font-bold px-10 py-3 rounded-full shadow">
                Rp 2.450.000
            </button>
        </div>

        <!-- CARD SIM -->
        <div class="relative w-full max-w-sm bg-[#FFF3E0] border border-gray-300 rounded-3xl p-6 flex flex-col">

            <span
                class="absolute -top-4 left-1/2 -translate-x-1/2 bg-white px-6 py-2 rounded-full shadow text-sm text-gray-700">
                Paket SIM
            </span>

            <h2 class="text-2xl font-bold text-gray-900 mt-8 mb-2">Manual / Matic + SIM</h2>
            <p class="text-gray-700 mb-6">
                Cocok untuk kamu yang ingin belajar mengendarai mobil dari dasar maupun melancarkan
            </p>

            <div class="bg-white rounded-xl shadow p-4 mb-6 flex justify-center">
                <img src="path/to/sim-car-image.png" alt="SIM" class="max-h-40 object-contain">
            </div>

            <div class="mb-8">
                <h4 class="font-semibold mb-3">Benefit kursus:</h4>
                <ul class="text-sm text-gray-700 space-y-2 list-disc list-inside marker:text-orange-400">
                    <li>Dapat diajarkan mulai dari dasar</li>
                    <li>Mobil manual atau matic</li>
                    <li>Belajar Praktik Parkir</li>
                    <li>Belajar Praktik di Jalan Raya</li>
                    <li>14 pertemuan + SIM</li>
                </ul>
            </div>

            <button
                class="mt-auto mx-auto bg-orange-400 hover:bg-orange-500 text-white font-bold px-10 py-3 rounded-full shadow">
                Rp 2.570.000
            </button>
        </div>

    </div>
</section>
