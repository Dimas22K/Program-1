<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Mesin Las</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-cyan-200 via-teal-200 to-blue-300">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">

        <div class="w-full max-w-lg mx-auto bg-white/80 backdrop-blur-sm shadow-2xl rounded-2xl p-8">
            
            <!-- Tombol Kembali dengan Efek Hover dan Gerak (Ditambahkan) -->
            <div class="mb-6">
                <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 rounded-lg px-3 py-1 font-semibold text-teal-700 hover:bg-teal-100 hover:text-teal-900 hover:-translate-x-1 transition-all duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <h2 class="text-3xl font-bold mb-8 text-center text-teal-800">
                Tambah Data Mesin Las
            </h2>

            <form action="{{ route('admin.store', [$jenis, $divisi]) }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="kodefikasi" class="block text-sm font-medium text-slate-700">Kodefikasi</label>
                    <input type="text" name="kodefikasi" id="kodefikasi" class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 placeholder-slate-400 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400" required>
                </div>

                <div>
                    <label for="nama_alat" class="block text-sm font-medium text-slate-700">Nama Alat</label>
                    <input type="text" name="nama_alat" id="nama_alat" class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 placeholder-slate-400 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="merk_type" class="block text-sm font-medium text-slate-700">Merk / Type</label>
                        <input type="text" name="merk_type" id="merk_type" class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 placeholder-slate-400 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400">
                    </div>
                    <div>
                        <label for="no_seri" class="block text-sm font-medium text-slate-700">No Seri</label>
                        <input type="text" name="no_seri" id="no_seri" class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 placeholder-slate-400 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400">
                    </div>
                </div>
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                     <div>
                        <label for="tgl_kalibrasi" class="block text-sm font-medium text-slate-700">Tgl Kalibrasi</label>
                        <input type="date" name="tgl_kalibrasi" id="tgl_kalibrasi" class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 placeholder-slate-400 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400">
                    </div>
                     <div>
                        <label for="kalibrasi_selanjutnya" class="block text-sm font-medium text-slate-700">Kalibrasi Lanjut</label>
                        <input type="date" name="kalibrasi_selanjutnya" id="kalibrasi_selanjutnya" class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 placeholder-slate-400 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400">
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" id="status" class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="DONE">DONE</option>
                        <option value="OOT">OOT</option>
                        <option value="PROGRESS">PROGRESS</option>
                        <option value="RE CAL">RE CAL</option>
                        <option value="RUSAK">RUSAK</option>
                    </select>
                </div>

                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg font-semibold text-white bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white/80 focus:ring-orange-500 transition-all duration-300 ease-in-out hover:bg-orange-600 hover:-translate-y-1 hover:shadow-orange-500/40">
                    Simpan Data
                </button>
            </form>
        </div>
    </div>
</body>
</html>