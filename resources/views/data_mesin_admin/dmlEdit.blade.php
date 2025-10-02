<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welding Machine Data Update</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-cyan-200 via-teal-200 to-blue-300">
    <div class="min-h-screen flex items-center justify-center py-12 px-4">

        <div class="w-full max-w-lg mx-auto bg-white/80 backdrop-blur-sm shadow-2xl rounded-2xl p-8">

            <div class="mb-6">
                <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 rounded-lg px-3 py-1 font-semibold text-teal-700 hover:bg-teal-100 hover:text-teal-900 hover:-translate-x-1 transition-all duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <h2 class="text-3xl font-bold mb-8 text-center text-teal-800">
                Update Welding Machine Data
            </h2>

            <form action="{{ route('admin.update', [$jenis, $divisi, $row->id]) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Hidden agar status tetap terkirim -->
                <input type="hidden" name="status" value="{{ $row->status }}">

                <div>
                    <label for="kodefikasi" class="block text-sm font-medium text-slate-700">Codefication</label>
                    <input type="text" id="kodefikasi" name="kodefikasi" 
                           value="{{ $row->kodefikasi }}"
                           class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 
                                  placeholder-slate-400 focus:outline-none focus:border-orange-500 
                                  focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400" required>
                </div>

                <div>
                    <label for="nama_alat" class="block text-sm font-medium text-slate-700">Welding Machine Name</label>
                    <input type="text" id="nama_alat" name="nama_alat" 
                           value="{{ $row->nama_alat }}"
                           class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 
                                  placeholder-slate-400 focus:outline-none focus:border-orange-500 
                                  focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="merk_type" class="block text-sm font-medium text-slate-700">Merk / Type</label>
                        <input type="text" id="merk_type" name="merk_type" 
                               value="{{ $row->merk_type }}"
                               class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 
                                      placeholder-slate-400 focus:outline-none focus:border-orange-500 
                                      focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400">
                    </div>
                    <div>
                        <label for="no_seri" class="block text-sm font-medium text-slate-700">Serial Number</label>
                        <input type="text" id="no_seri" name="no_seri" 
                               value="{{ $row->no_seri }}"
                               class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 
                                      placeholder-slate-400 focus:outline-none focus:border-orange-500 
                                      focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400">
                    </div>
                </div>

                <div>
                    <label for="range_alat" class="block text-sm font-medium text-slate-700">Range</label>
                    <input type="text" id="range_alat" name="range_alat" 
                           value="{{ $row->range_alat }}"
                           class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 
                                  placeholder-slate-400 focus:outline-none focus:border-orange-500 
                                  focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400">
                </div>

                <div>
    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
    <select id="description" name="description"
            class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 
                   placeholder-slate-400 focus:outline-none focus:border-orange-500 
                   focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400" required>
        <option value="" disabled selected>Pilih status...</option>
        <option value="-" {{ $row->description == '-' ? 'selected' : '' }}>-</option>
        <option value="TOOL NOT SEND" {{ $row->description == 'TOOL NOT SEND' ? 'selected' : '' }}>TOOL NOT SEND</option>
        <option value="BROKEN" {{ $row->description == 'BROKEN' ? 'selected' : '' }}>BROKEN</option>
        <option value="STILL IN USE" {{ $row->description == 'STILL IN USE' ? 'selected' : '' }}>STILL IN USE</option>
    </select>
</div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="tgl_kalibrasi" class="block text-sm font-medium text-slate-700">Date</label>
                        <input type="date" id="tgl_kalibrasi" name="tgl_kalibrasi" 
                               value="{{ $row->tgl_kalibrasi }}"
                               class="w-full mt-2 bg-white/70 border-2 border-cyan-200 rounded-lg py-2 px-3 
                                      placeholder-slate-400 focus:outline-none focus:border-orange-500 
                                      focus:ring-1 focus:ring-orange-500 transition duration-300 hover:border-teal-400">
                    </div>
                </div>

                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg font-semibold text-white bg-orange-500 
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white/80 focus:ring-orange-500 
                               transition-all duration-300 ease-in-out hover:bg-orange-600 hover:-translate-y-1 hover:shadow-orange-500/40">
                    Update Data
                </button>
            </form>
        </div>
    </div>
</body>
</html>