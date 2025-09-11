<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Alat Ukur Kaprang</title>
    {{-- Memuat pustaka Tailwind CSS dari CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaprang Welding Machine Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans">

    {{-- Main container to center content and limit width --}}
    <div class="container mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8 py-8">

        {{-- 1. Back Arrow Button to Welcome Page --}}
        <a href="{{ url('/welcome') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 transition-colors mb-6 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            <span>Back</span>
        </a>

        <h1 class="text-3xl font-bold mb-6 text-slate-800">Harkan Welding Machine Data</h1>

        {{-- Filter Form --}}
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <form method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-end gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-60"
                           placeholder="Code / Name / Brand">
                </div>
                <div>
                    <label for="tgl_mulai" class="block text-sm font-medium text-gray-700">Calibration Date</label>
                    <input type="date" name="tgl_mulai" id="tgl_mulai" value="{{ request('tgl_mulai') }}"
                           class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-44">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-40">
                        <option value="">All</option>
                        <option value="DONE"     {{ request('status') == 'DONE'     ? 'selected' : '' }}>Done</option>
                        <option value="RUSAK"    {{ request('status') == 'RUSAK'    ? 'selected' : '' }}>Broken</option>
                        <option value="PROGRESS" {{ request('status') == 'PROGRESS' ? 'selected' : '' }}>In Progress</option>
                        <option value="RE CAL"   {{ request('status') == 'RE CAL'   ? 'selected' : '' }}>Re-Calibration</option>
                        <option value="OOT"      {{ request('status') == 'OOT'      ? 'selected' : '' }}>Out of Tolerance</option>
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2 rounded-md shadow-sm transition-colors">
                        Filter
                    </button>
                    <a href="{{ url()->current() }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-5 py-2 rounded-md shadow-sm transition-colors">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Data Table: Using table-fixed to control column widths precisely --}}
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <table class="w-full table-fixed">
                <thead class="bg-slate-800 text-white">
                    <tr>
                        {{-- REFINED: Adjusted widths for 10 columns --}}
                        <th class="w-[4%] px-2 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">No</th>
                        <th class="w-[10%] px-2 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Codification</th>
                        <th class="w-[14%] px-2 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Machine Name</th>
                        <th class="w-[14%] px-2 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Brand / Type</th>
                        <th class="w-[12%] px-2 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Serial Number</th>
                        <th class="w-[8%] px-2 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Range</th>
                        <th class="w-[8%] px-2 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Date</th>
                        <th class="w-[8%] px-2 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Due Date</th>
                        <th class="w-[12%] px-2 py-3 border-b-2 border-slate-700 text-left text-xs font-semibold uppercase tracking-wider">Calibration Plan</th>
                        <th class="w-[10%] px-2 py-3 border-b-2 border-slate-700 text-center text-xs font-semibold uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @forelse($data as $row)
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

                        <tr class="{{ $rowClass }} transition-colors duration-200 align-top">
                            {{-- REFINED: Using break-words for content wrapping --}}
                            <td class="px-2 py-4 border-b border-gray-200 break-words">{{ $loop->iteration }}</td>
                            <td class="px-2 py-4 border-b border-gray-200 break-words">{{ $row->kodefikasi }}</td>
                            <td class="px-2 py-4 border-b border-gray-200 break-words">{{ $row->nama_alat }}</td>
                            <td class="px-2 py-4 border-b border-gray-200 break-words">{{ $row->merk_type }}</td>
                            <td class="px-2 py-4 border-b border-gray-200 break-words">{{ $row->no_seri }}</td>
                            <td class="px-2 py-4 border-b border-gray-200 break-words">{{ $row->range_alat }}</td>
                            <td class="px-2 py-4 border-b border-gray-200 break-words">{{ $row->tgl_kalibrasi }}</td>
                            <td class="px-2 py-4 border-b border-gray-200 break-words">{{ $row->kalibrasi_selanjutnya }}</td>
                            {{-- ISI kolom baru: Calibration Plan --}}
                            <td class="px-3 py-4 border-b border-gray-200">
                                @if(!empty($row->kalibrasi_selanjutnya))
                                    @php
                                        $nextCal  = \Carbon\Carbon::parse($row->kalibrasi_selanjutnya);
                                        $planDate = $nextCal->copy()->subDays(7);
                                    @endphp

                                    <span class="text-blue-600 font-semibold">
                                        {{ $planDate->format('Y-m-d') }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-2 py-4 border-b border-gray-200 text-center">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $row->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            {{-- Corrected colspan to 10 --}}
                            <td colspan="10" class="text-center py-10 px-4 text-gray-500 font-medium">
                                No data found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $data->withQueryString()->links() }}
        </div>

    </div>
</body>
</html>


<body class="bg-gray-100">
    
    {{-- Kontainer Utama untuk membatasi lebar dan meletakkannya di tengah --}}
    <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">

        {{-- 1. Tombol Panah Kembali ke Halaman Welcome --}}
        <a href="{{ url('/welcome') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 transition-colors mb-4 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            <span>Kembali</span>
        </a>

        <h1 class="text-3xl font-bold mb-6 text-slate-800">Data Mesin Las Kaprang</h1>

        {{-- Form Filter --}}
        <form method="GET" action="{{ url()->current() }}" class="mb-6 flex flex-wrap items-center gap-4 bg-white p-4 rounded-lg shadow-sm">
            {{-- Search Gabungan --}}
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                       class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-60"
                       placeholder="Kodefikasi / Nama / Merk">
            </div>

            {{-- Filter Tanggal Kalibrasi --}}
            <div>
                <label for="tgl_mulai" class="block text-sm font-medium text-gray-700">Tgl Kalibrasi (Mulai)</label>
                <input type="date" name="tgl_mulai" id="tgl_mulai" value="{{ request('tgl_mulai') }}"
                       class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-44">
            </div>

            {{-- Filter Status --}}
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Filter Status</label>
                <select name="status" id="status" class="mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-40">
                    <option value="">-- Semua --</option>
                    <option value="DONE"     {{ request('status') == 'DONE'     ? 'selected' : '' }}>DONE</option>
                    <option value="RUSAK"    {{ request('status') == 'RUSAK'    ? 'selected' : '' }}>RUSAK</option>
                    <option value="PROGRESS" {{ request('status') == 'PROGRESS' ? 'selected' : '' }}>PROGRESS</option>
                    <option value="RE CAL"   {{ request('status') == 'RE CAL'   ? 'selected' : '' }}>RE CAL</option>
                    <option value="OOT"      {{ request('status') == 'OOT'      ? 'selected' : '' }}>OOT</option>
                </select>
            </div>

            {{-- Tombol --}}
            <div class="pt-5">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2 rounded-md shadow-sm transition-colors duration-200">
                    Filter
                </button>
                <a href="{{ url()->current() }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-5 py-2 rounded-md shadow-sm transition-colors duration-200">
                    Reset
                </a>
            </div>
        </form>

        {{-- Container Tabel --}}
        <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
            <table class="w-full border-collapse">
                {{-- Header Tabel dengan Gaya Baru --}}
                <thead class="bg-slate-700 text-white">
                    <tr>
                        <th class="px-4 py-3 border-b-2 border-slate-600 text-left text-xs font-semibold uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 border-b-2 border-slate-600 text-left text-xs font-semibold uppercase tracking-wider">Kodefikasi</th>
                        <th class="px-4 py-3 border-b-2 border-slate-600 text-left text-xs font-semibold uppercase tracking-wider">Nama Alat</th>
                        <th class="px-4 py-3 border-b-2 border-slate-600 text-left text-xs font-semibold uppercase tracking-wider">Merk / Type</th>
                        <th class="px-4 py-3 border-b-2 border-slate-600 text-left text-xs font-semibold uppercase tracking-wider">No. Seri</th>
                        <th class="px-4 py-3 border-b-2 border-slate-600 text-left text-xs font-semibold uppercase tracking-wider">Range</th>
                        <th class="px-4 py-3 border-b-2 border-slate-600 text-left text-xs font-semibold uppercase tracking-wider">Tgl Kalibrasi</th>
                        <th class="px-4 py-3 border-b-2 border-slate-600 text-left text-xs font-semibold uppercase tracking-wider">Kalibrasi Berikutnya</th>
                        <th class="px-4 py-3 border-b-2 border-slate-600 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                    </tr>
                </thead>

                {{-- Body Tabel dengan Pewarnaan Dinamis --}}
                <tbody class="text-gray-700">
                    @forelse($data as $row)
                        @php
                            $rowClass = match($row->status) {
                                'DONE'     => 'bg-green-50 hover:bg-green-100 transition-colors duration-200',
                                'RUSAK'    => 'bg-red-100 hover:bg-red-200 text-red-900 font-medium transition-colors duration-200',
                                'PROGRESS' => 'bg-blue-50 hover:bg-blue-100 transition-colors duration-200',
                                'RE CAL'   => 'bg-yellow-50 hover:bg-yellow-100 transition-colors duration-200',
                                'OOT'      => 'bg-purple-100 hover:bg-purple-200 transition-colors duration-200',
                                default    => 'hover:bg-gray-50 transition-colors duration-200'
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

                        <tr class="{{ $rowClass }}">
                            <td class="px-4 py-3 border-b border-gray-200 whitespace-nowrap">{{ $row->id }}</td>
                            <td class="px-4 py-3 border-b border-gray-200 whitespace-nowrap">{{ $row->kodefikasi }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">{{ $row->nama_alat }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">{{ $row->merk_type }}</td>
                            <td class="px-4 py-3 border-b border-gray-200 whitespace-nowrap">{{ $row->no_seri }}</td>
                            <td class="px-4 py-3 border-b border-gray-200 whitespace-nowrap">{{ $row->range_alat }}</td>
                            <td class="px-4 py-3 border-b border-gray-200 whitespace-nowrap">{{ $row->tgl_kalibrasi }}</td>
                            <td class="px-4 py-3 border-b border-gray-200 whitespace-nowrap">{{ $row->kalibrasi_selanjutnya }}</td>
                            <td class="px-4 py-3 border-b border-gray-200">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $row->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        {{-- Baris ini akan muncul HANYA JIKA $data kosong --}}
                        <tr>
                            <td colspan="9" class="text-center py-6 px-4 text-gray-500 font-medium">
                                Data tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Link Paginasi --}}
        <div class="mt-6">
            {{ $data->withQueryString()->links() }}
        </div>

    </div> {{-- Akhir dari Kontainer Utama --}}

</body>
</html>