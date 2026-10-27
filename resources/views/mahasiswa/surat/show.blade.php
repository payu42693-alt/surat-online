<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detail Pengajuan Surat</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <dl class="divide-y divide-gray-100">
                    <div class="py-3 flex justify-between gap-4">
                        <dt class="text-sm font-medium text-gray-500">Jenis Surat</dt>
                        <dd class="text-sm text-gray-900 text-right">{{ $surat->jenis_surat }}</dd>
                    </div>

                    <div class="py-3 flex justify-between gap-4">
                        <dt class="text-sm font-medium text-gray-500">Keperluan</dt>
                        <dd class="text-sm text-gray-900 text-right">{{ $surat->keperluan }}</dd>
                    </div>

                    <div class="py-3 flex justify-between gap-4">
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="text-sm">
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($surat->status === 'disetujui') bg-green-100 text-green-800
                                @elseif($surat->status === 'ditolak') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ $surat->status }}
                            </span>
                        </dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <a href="{{ route('mahasiswa.surat.index') }}"
                       class="text-sm text-indigo-600 hover:underline">
                        &larr; Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>