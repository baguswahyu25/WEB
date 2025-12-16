<section class="py-12 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="max-w-3xl mx-auto p-8 bg-white rounded-xl shadow-lg border border-gray-100">

        <h2 class="text-2xl font-semibold text-gray-900 mb-2">Kirimkan pesan kepada kami</h2>
        <p class="text-sm text-gray-500 mb-8">Alamat email Anda tidak akan dipublikasikan</p>

        <form action="#" method="POST" class="space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <input type="text" id="nama" name="nama" placeholder="Nama" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500 shadow-sm transition duration-150 ease-in-out">
                </div>

                <div>
                    <input type="email" id="email" name="email" placeholder="Email" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500 shadow-sm transition duration-150 ease-in-out">
                </div>
            </div>

            <div>
                <input type="text" id="perihal" name="perihal" placeholder="Perihal" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500 shadow-sm transition duration-150 ease-in-out">
            </div>

            <div>
                <textarea id="pesan" name="pesan" rows="6" placeholder="Pesan Anda" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500 shadow-sm transition duration-150 ease-in-out resize-none"></textarea>
            </div>

            <div>
                <button type="submit"
                    class="px-10 py-3 bg-blue-700 text-white font-semibold rounded-lg shadow-md hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300 ease-in-out"
                    style="background-color: #0b589a;">
                    Kirim sekarang
                </button>
            </div>

        </form>
    </div>
</section>
