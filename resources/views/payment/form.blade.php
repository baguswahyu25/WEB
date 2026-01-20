<x-app-layout>
    <div class="max-w-xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">
            Pendaftaran Paket {{ $pendaftaran->paket }}
        </h1>


        <form action="{{ route('payment.snap', $pendaftaran->id) }}" method="GET">
            <button class="w-full bg-orange-500 text-white py-3 rounded font-bold">
                Bayar Sekarang
            </button>
        </form>

    </div>
</x-app-layout>
