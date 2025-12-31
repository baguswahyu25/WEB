<div>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Foto Profil</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Upload foto profil Anda. Format yang didukung: JPG, PNG, GIF. Maksimal 1MB.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form wire:submit.prevent="save">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <div>
                                <label for="photo" class="block text-sm font-medium text-gray-700">
                                    Pilih Foto
                                </label>
                                <input type="file" wire:model="photo" id="photo" class="mt-1 block w-full">
                                @error('photo')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            @if ($photo)
                                <div>
                                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview"
                                        class="w-32 h-32 rounded-full object-cover">
                                </div>
                            @endif
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan Foto
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
    @endif
</div>
