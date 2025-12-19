<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">👋 Selamat Datang, Admin!</h1>

            {{-- Statistik Utama --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Statistik 1: Total Pendaftaran --}}
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-sm text-gray-500">Total Pendaftaran</p>
                    {{-- Data ini perlu diambil dari Controller --}}
                    <p class="text-4xl font-extrabold text-indigo-600">
                        {{-- {{ $totalPendaftaran }} --}} 125
                    </p>
                </div>

                {{-- Statistik 2: Menunggu Pembayaran Tunai --}}
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-sm text-gray-500">Menunggu Tunai</p>
                    <p class="text-4xl font-extrabold text-yellow-600">
                        {{-- {{ $menungguTunai }} --}} 15
                    </p>
                </div>

                {{-- Statistik 3: Transaksi Lunas --}}
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-sm text-gray-500">Pembayaran Lunas</p>
                    <p class="text-4xl font-extrabold text-green-600">
                        {{-- {{ $transaksiLunas }} --}} Rp 55.000.000
                    </p>
                </div>
            </div>

            {{-- Daftar Pendaftaran Terbaru (Gunakan Livewire/Blade untuk data) --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Pendaftaran Terbaru</h2>

                {{-- Tempat untuk List Pendaftaran --}}
                {{-- Di sini Anda bisa memanggil komponen Livewire Admin untuk tabel data --}}
                {{-- @livewire('admin.pendaftaran-list') --}}
                <p>Tabel data akan muncul di sini.</p>
            </div>

            <br>
            <br>
            <br>




            {{-- Isi dashboard di sini --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>


            <br>

        </div>
    </div>


</body>

</html>
