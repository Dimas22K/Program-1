<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Mesin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-8">
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-slate-900 font-semibold transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
        <h2 class="text-2xl font-bold mb-6 text-center">Update Data Mesin</h2>

        <form action="{{ route('admin.update', [$jenis, $divisi, $row->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="kodefikasi" class="block font-semibold text-gray-700 mb-2">Kodefikasi</label>
                <input type="text" id="kodefikasi" name="kodefikasi" value="{{ $row->kodefikasi }}" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label for="nama_alat" class="block font-semibold text-gray-700 mb-2">Nama Alat</label>
                <input type="text" id="nama_alat" name="nama_alat" value="{{ $row->nama_alat }}" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label for="merk_type" class="block font-semibold text-gray-700 mb-2">Merk / Type</label>
                <input type="text" id="merk_type" name="merk_type" value="{{ $row->merk_type }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label for="no_seri" class="block font-semibold text-gray-700 mb-2">No Seri</label>
                <input type="text" id="no_seri" name="no_seri" value="{{ $row->no_seri }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label for="range_alat" class="block font-semibold text-gray-700 mb-2">Range Alat</label>
                <input type="text" id="range_alat" name="range_alat" value="{{ $row->range_alat }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label for="tgl_kalibrasi" class="block font-semibold text-gray-700 mb-2">Tanggal Kalibrasi</label>
                <input type="date" id="tgl_kalibrasi" name="tgl_kalibrasi" value="{{ $row->tgl_kalibrasi }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label for="kalibrasi_selanjutnya" class="block font-semibold text-gray-700 mb-2">Kalibrasi Selanjutnya</label>
                <input type="date" id="kalibrasi_selanjutnya" name="kalibrasi_selanjutnya" value="{{ $row->kalibrasi_selanjutnya }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label for="status" class="block font-semibold text-gray-700 mb-2">Status</label>
                <select id="status" name="status" class="w-full border p-2 rounded" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="DONE" {{ $row->status=='DONE'?'selected':'' }}>DONE</option>
                    <option value="Luar" {{ $row->status=='Luar'?'selected':'' }}>Luar</option>
                    <option value="OOT" {{ $row->status=='OOT'?'selected':'' }}>OOT</option>
                    <option value="PROGRESS" {{ $row->status=='PROGRESS'?'selected':'' }}>Progress</option>
                    <option value="RE CAL" {{ $row->status=='RE CAL'?'selected':'' }}>Recall</option>
                    <option value="RUSAK" {{ $row->status=='RUSAK'?'selected':'' }}>Rusak</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded mt-3 hover:bg-blue-700 font-bold">
                Update
            </button>
        </form>
    </div>

</body>
</html>
