<!DOCTYPE html>
<html>
<head>
    <title>Data Alat Ukur Kaprang</title>
    {{-- Menggunakan CDN Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-4 md:p-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Data Alat Ukur Kaprang</h1>

        {{-- Filter Form --}}
        {{-- Diubah: 'items-end' untuk meratakan bagian bawah, gap diperkecil, shadow diubah --}}
        <div class="mb-6 bg-white p-4 rounded-xl shadow-sm">
            <form method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-end gap-3">
                
                {{-- Search Gabungan --}}
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-600">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 w-60" placeholder="Kodefikasi / Nama / Merk">
                </div>

                {{-- Filter Tanggal Kalibrasi --}}
                <div>
                    <label for="tgl_mulai" class="block text-sm font-medium text-gray-600">Tgl Kalibrasi (Mulai)</label>
                    <input type="date" name="tgl_mulai" id="tgl_mulai" value="{{ request('tgl_mulai') }}"
                           class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 w-44">
                </div>

                {{-- Filter Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-600">Filter Status</label>
                    <select name="status" id="status" class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 w-40">
                        <option value="">-- Semua --</option>
                        <option value="DONE" {{ request('status')=='DONE' ? 'selected' : '' }}>DONE</option>
                        <option value="RUSAK" {{ request('status')=='RUSAK' ? 'selected' : '' }}>RUSAK</option>
                        <option value="PROGRESS" {{ request('status')=='PROGRESS' ? 'selected' : '' }}>PROGRESS</option>
                        <option value="RE CAL" {{ request('status')=='RE CAL' ? 'selected' : '' }}>RE CAL</option>
                        <option value="OOT" {{ request('status')=='OOT' ? 'selected' : '' }}>OOT</option>
                    </select>
                </div>

                {{-- Tombol --}}
                {{-- Diubah: Margin atas dihapus karena sudah rata dengan 'items-end' --}}
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2 rounded-md transition duration-150 ease-in-out">
                        Filter
                    </button>
                    <a href="{{ url()->current() }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-5 py-2 rounded-md transition duration-150 ease-in-out">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Container Tabel --}}
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    {{-- Header Tabel --}}
                    {{-- Diubah: Tampilan header dibuat lebih modern dan minimalis --}}
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kodefikasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merk / Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Seri</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Range</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Kalibrasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kalibrasi Berikutnya</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    {{-- Body Tabel --}}
                    {{-- Diubah: Menggunakan 'divide-y' untuk garis antar baris & warna selang-seling --}}
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($data as $key => $row)
                        {{-- 'odd:bg-white even:bg-gray-50' untuk warna selang-seling --}}
                        <tr class="odd:bg-white even:bg-gray-50 hover:bg-blue-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->firstItem() + $key }}</td> {{-- Nomor urut yang benar untuk paginasi --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $row->kodefikasi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $row->nama_alat }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $row->merk_type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $row->no_seri ?? '-' }}</td> {{-- Memberi tanda '-' jika NULL --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $row->range_alat }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $row->tgl_kalibrasi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $row->kalibrasi_selanjutnya }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{-- INI BAGIAN BARU: Badge Status Berwarna --}}
                                @if($row->status == 'DONE')
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        DONE
                                    </span>
                                @elseif($row->status == 'RE CAL')
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        RE CAL
                                    </span>
                                @elseif($row->status == 'RUSAK')
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        RUSAK
                                    </span>
                                @else
                                     <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $row->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Paginasi --}}
        {{-- Diubah: Diberi margin atas agar tidak terlalu mepet --}}
        <div class="mt-4">
            {{ $data->links() }}
        </div>

    </div>
</body>
</html>