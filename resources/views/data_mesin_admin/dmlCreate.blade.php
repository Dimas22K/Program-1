<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Measin Las</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Tambah Data Mesin las</h2>

        <form action="{{ route('admin.store', [$jenis, $divisi]) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold">Kodefikasi</label>
                <input type="text" name="kodefikasi" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Nama Alat</label>
                <input type="text" name="nama_alat" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Merk / Type</label>
                <input type="text" name="merk_type" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">No Seri</label>
                <input type="text" name="no_seri" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Range Alat</label>
                <input type="text" name="range_alat" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Tanggal Kalibrasi</label>
                <input type="date" name="tgl_kalibrasi" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Kalibrasi Selanjutnya</label>
                <input type="date" name="kalibrasi_selanjutnya" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Status</label>
                <select name="status" class="w-full border p-2 rounded" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="DONE">DONE</option>
                    <option value="Luar">Luar</option>
                    <option value="OOT">OOT</option>
                    <option value="PROGRESS">Progress</option>
                    <option value="RE CAL">Recall</option>
                    <option value="RUSAK">Rusak</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</body>
</html>
