<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mesin Las Harkan - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">

    {{-- Kontainer Utama untuk membatasi lebar dan meletakkannya di tengah --}}
    <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">

        {{-- 1. Tombol Panah Kembali ke Halaman Welcome --}}
        <a href="{{ url('/admin') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 transition-colors mb-4 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            <span>Kembali</span>
        </a>

    <div class="container mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6 text-slate-800">Data Alat Ukur Kapsel (Admin)</h1>

        {{-- Filter Form --}}
        <form method="GET" action="{{ url()->current() }}" class="mb-6 flex flex-wrap items-center gap-4 bg-white p-4 rounded-lg shadow-sm">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                       class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-60"
                       placeholder="Kodefikasi / Nama / Merk">
            </div>
            <div>
                <label for="tgl_mulai" class="block text-sm font-medium text-gray-700">Tgl Kalibrasi (Mulai)</label>
                <input type="date" name="tgl_mulai" id="tgl_mulai" value="{{ request('tgl_mulai') }}"
                       class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-44">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Filter Status</label>
                <select name="status" id="status" class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-40">
                    <option value="">-- Semua --</option>
                    <option value="DONE"     {{ request('status') == 'DONE'     ? 'selected' : '' }}>DONE</option>
                    <option value="RUSAK"    {{ request('status') == 'RUSAK'    ? 'selected' : '' }}>RUSAK</option>
                    <option value="PROGRESS" {{ request('status') == 'PROGRESS' ? 'selected' : '' }}>PROGRESS</option>
                    <option value="RE CAL"   {{ request('status') == 'RE CAL'   ? 'selected' : '' }}>RE CAL</option>
                    <option value="OOT"      {{ request('status') == 'OOT'      ? 'selected' : '' }}>OOT</option>
                </select>
            </div>
            <div class="pt-5">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2 rounded-md shadow-sm transition-colors">
                    Filter
                </button>
                <a href="{{ url()->current() }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-5 py-2 rounded-md shadow-sm transition-colors">
                    Reset
                </a>
            </div>
        </form>

        {{-- Tombol Tambah Data --}}
        <div class="mb-4">
            <a href="{{ route('admin.create', [$jenis, $divisi]) }}"
               class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-transform transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Data
            </a>
        </div>

        {{-- Tabel Data. Dihapus overflow-x-auto agar tidak bisa scroll --}}
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-slate-800 text-white">
                    <tr>
                        {{-- PERUBAHAN: Padding diubah dari px-5 menjadi px-3 dan semua whitespace-nowrap dihapus --}}
                        <th class="px-3 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">No</th>
                        <th class="px-3 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Kodefikasi</th>
                        <th class="px-3 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Nama Alat</th>
                        <th class="px-3 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Merk / Type</th>
                        <th class="px-3 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">No. Seri</th>
                        <th class="px-3 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Range</th>
                        <th class="px-3 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Tgl Kalibrasi</th>
                        <th class="px-3 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Kalibrasi Berikutnya</th>
                        <th class="px-3 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                        <th class="px-3 py-3 border-b-2 border-slate-700 text-center text-xs font-semibold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                {{-- PERUBAHAN: Ukuran font di body tabel dikecilkan menjadi text-sm --}}
                <tbody class="text-gray-700 text-sm">
                    @foreach($data as $row)
                        @php
                            $rowClass = match($row->status) {
                                'DONE'     => 'bg-green-50 hover:bg-green-100',
                                'RUSAK'    => 'bg-red-100 hover:bg-red-200 font-medium text-red-900',
                                'PROGRESS' => 'bg-blue-50 hover:bg-blue-100',
                                'RE CAL'   => 'bg-yellow-50 hover:bg-yellow-100',
                                'OOT'      => 'bg-purple-50 hover:bg-purple-100',
                                default    => 'hover:bg-gray-50'
                            };

                            $statusClass = match($row->status) {
                                'DONE'     => 'bg-green-200 text-green-800',
                                'RUSAK'    => 'bg-red-500 text-white',
                                'PROGRESS' => 'bg-blue-200 text-blue-800',
                                'RE CAL'   => 'bg-yellow-300 text-yellow-900',
                                'OOT'      => 'bg-purple-300 text-purple-900',
                                default    => 'bg-gray-200 text-gray-800'
                            };
                        @endphp

                        <tr class="{{ $rowClass }} transition-colors duration-200">
                            {{-- PERUBAHAN: Padding diubah dari px-5 menjadi px-3 --}}
                            <td class="px-3 py-4 border-b border-gray-200">{{ $row->id }}</td>
                            <td class="px-3 py-4 border-b border-gray-200">{{ $row->kodefikasi }}</td>
                            <td class="px-3 py-4 border-b border-gray-200">{{ $row->nama_alat }}</td>
                            <td class="px-3 py-4 border-b border-gray-200">{{ $row->merk_type }}</td>
                            <td class="px-3 py-4 border-b border-gray-200">{{ $row->no_seri }}</td>
                            <td class="px-3 py-4 border-b border-gray-200">{{ $row->range_alat }}</td>
                            <td class="px-3 py-4 border-b border-gray-200">{{ $row->tgl_kalibrasi }}</td>
                            <td class="px-3 py-4 border-b border-gray-200">{{ $row->kalibrasi_selanjutnya }}</td>
                            <td class="px-3 py-4 border-b border-gray-200">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $row->status }}
                                </span>
                            </td>
                            <td class="px-3 py-4 border-b border-gray-200 text-center">
                                <div class="flex items-center justify-center gap-4">
                                    <a href="{{ route('admin.edit', [$jenis, $divisi, $row->id]) }}"
                                       class="font-medium text-indigo-600 hover:text-indigo-900">Edit</a>

                                    <form action="{{ route('admin.delete', [$jenis, $divisi, $row->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                class="font-medium text-red-600 hover:text-red-900">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $data->links() }}
        </div>

    </div>
</body>
</html>