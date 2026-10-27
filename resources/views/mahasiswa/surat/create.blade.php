<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Ajukan Surat</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('mahasiswa.surat.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat</label>
                        <select name="jenis_surat"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Surat Aktif Kuliah">Surat Aktif Kuliah</option>
                            <option value="Surat Izin Penelitian">Surat Izin Penelitian</option>
                            <option value="Surat Keterangan">Surat Keterangan</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keperluan</label>
                        <textarea name="keperluan" rows="4"
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('mahasiswa.surat.index') }}"
                           class="text-sm text-gray-600 hover:underline">Batal</a>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                            Ajukan Surat
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>