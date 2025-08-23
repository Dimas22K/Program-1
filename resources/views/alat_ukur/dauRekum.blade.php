<!DOCTYPE html>
<html>
<head>
    <title>Data Alat Ukur Rekum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <h1 class="text-2xl font-bold mb-4">Data Alat Ukur Rekum</h1>

    {{-- Filter Form --}}
    <form method="GET" action="{{ url()->current() }}" class="mb-4 flex flex-wrap items-center gap-4 bg-white p-4 rounded-lg shadow">
        {{-- Search Gabungan --}}
        <div>
            <label for="search" class="block text-sm font-medium">Search</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                   class="mt-1 border rounded px-2 py-1 w-60" placeholder="Kodefikasi / Nama / Merk">
        </div>

        {{-- Filter Tanggal Kalibrasi --}}
        <div>
            <label for="tgl_mulai" class="block text-sm font-medium">Tgl Kalibrasi (Mulai)</label>
            <input type="date" name="tgl_mulai" id="tgl_mulai" value="{{ request('tgl_mulai') }}"
                class="mt-1 border rounded px-2 py-1 w-44">
        </div>

        {{-- Filter Status --}}
        <div>
            <label for="status" class="block text-sm font-medium">Filter Status</label>
            <select name="status" id="status" class="mt-1 border rounded px-2 py-1 w-40">
                <option value="">-- Semua --</option>
                <option value="DONE" {{ request('status')=='DONE' ? 'selected' : '' }}>DONE</option>
                <option value="RUSAK" {{ request('status')=='RUSAK' ? 'selected' : '' }}>RUSAK</option>
                <option value="PROGRESS" {{ request('status')=='PROGRESS' ? 'selected' : '' }}>PROGRESS</option>
                <option value="RE CAL" {{ request('status')=='RE CAL' ? 'selected' : '' }}>RE CAL</option>
                <option value="OOT" {{ request('status')=='OOT' ? 'selected' : '' }}>OOT</option>
            </select>
        </div>

        {{-- Tombol --}}
        <div class="pt-5">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Filter
            </button>
            <a href="{{ url()->current() }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Reset
            </a>
        </div>
    </form>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Kodefikasi</th>
                    <th class="px-4 py-2 border">Nama Alat</th>
                    <th class="px-4 py-2 border">Merk / Type</th>
                    <th class="px-4 py-2 border">No. Seri</th>
                    <th class="px-4 py-2 border">Range</th>
                    <th class="px-4 py-2 border">Tgl Kalibrasi</th>
                    <th class="px-4 py-2 border">Kalibrasi Berikutnya</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $row->id }}</td>
                    <td class="px-4 py-2 border">{{ $row->kodefikasi }}</td>
                    <td class="px-4 py-2 border">{{ $row->nama_alat }}</td>
                    <td class="px-4 py-2 border">{{ $row->merk_type }}</td>
                    <td class="px-4 py-2 border">{{ $row->no_seri }}</td>
                    <td class="px-4 py-2 border">{{ $row->range_alat }}</td>
                    <td class="px-4 py-2 border">{{ $row->tgl_kalibrasi }}</td>
                    <td class="px-4 py-2 border">{{ $row->kalibrasi_selanjutnya }}</td>
                    <td class="px-4 py-2 border">{{ $row->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $data->links() }}
    </div>

</body>
</html>
