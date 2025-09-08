<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kalibrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { height: 8px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #64748b; }
    </style>
</head>
<body class="bg-slate-100">

    <div class="flex h-screen">
        <aside class="w-64 bg-slate-800 text-white flex flex-col flex-shrink-0">
            <div class="p-6 text-2xl font-bold border-b border-slate-700">
                <a href="#">Biro Kalibrasi</a>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 bg-slate-900 rounded-lg text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" /><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" /></svg>
                    <span>Dashboard</span>
                </a>
                 @if(Session::get('role') === 'user')
                    <a href="{{ route('welcome') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                        <span>Detail Aset</span>
                    </a>
                    <a href="{{ route('kemampuanLab') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7 2a.5.5 0 01.5.5V3h5V2.5a.5.5 0 011 0V3h1a2 2 0 012 2v1H3V5a2 2 0 012-2h1V2.5a.5.5 0 01.5-.5zM3 8v7a2 2 0 002 2h10a2 2 0 002-2V8H3zm3 4a1 1 0 011-1h2a1 1 0 110 2H7a1 1 0 01-1-1z" clip-rule="evenodd" /></svg>
                        <span>Kemampuan Lab</span>
                    </a>
                @else
                    <a href="{{ route('admin') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                        <span>Detail Aset</span>
                    </a>
                    <a href="{{ route('kemampuanLabAdmin') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7 2a.5.5 0 01.5.5V3h5V2.5a.5.5 0 011 0V3h1a2 2 0 012 2v1H3V5a2 2 0 012-2h1V2.5a.5.5 0 01.5-.5zM3 8v7a2 2 0 002 2h10a2 2 0 002-2V8H3zm3 4a1 1 0 011-1h2a1 1 0 110 2H7a1 1 0 01-1-1z" clip-rule="evenodd" /></svg>
                        <span>Kemampuan Lab</span>
                    </a>
                @endif
            </nav>
            <div class="mt-auto p-4 border-t border-slate-700">
                <a href="{{ route('logout') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-slate-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" /></svg>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 lg:p-8 overflow-y-auto">
            <h1 class="text-3xl font-bold text-slate-800">Dashboard Ringkasan Kalibrasi</h1>
            <p class="text-slate-500 mt-1">Status terkini untuk Alat Ukur dan Mesin Las di semua divisi.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                 <div class="bg-white p-5 rounded-xl shadow flex items-center gap-4">
                    <div class="p-3 bg-indigo-100 rounded-lg"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" /></svg></div>
                    <div>
                        <p class="text-sm text-slate-500">Total Alat Ukur</p>
                        <p id="totalAlatUkur" class="text-2xl font-bold text-slate-800">0</p>
                    </div>
                </div>
                 <div class="bg-white p-5 rounded-xl shadow flex items-center gap-4">
                    <div class="p-3 bg-cyan-100 rounded-lg"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg></div>
                    <div>
                        <p class="text-sm text-slate-500">Total Mesin Las</p>
                        <p id="totalMesinLas" class="text-2xl font-bold text-slate-800">0</p>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-xl shadow flex items-center gap-4">
                    <div class="p-3 bg-amber-100 rounded-lg"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                    <div>
                        <p class="text-sm text-slate-500">Perlu Kalibrasi Ulang</p>
                        <p id="totalRecal" class="text-2xl font-bold text-slate-800">0</p>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-xl shadow flex items-center gap-4">
                    <div class="p-3 bg-rose-100 rounded-lg"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg></div>
                    <div>
                        <p class="text-sm text-slate-500">Total Aset Rusak</p>
                        <p id="totalRusak" class="text-2xl font-bold text-slate-800">0</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-6">
                <div class="bg-white p-6 rounded-xl shadow">
                    <h2 class="text-xl font-semibold text-slate-800">Status Alat Ukur per Divisi</h2>
                    <div class="relative h-96 overflow-x-auto mt-4 custom-scrollbar">
                         <div id="chartContainerAlatUkur" class="h-full">
                              <canvas id="chartAlatUkur"></canvas>
                         </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <h2 class="text-xl font-semibold text-slate-800">Status Mesin Las per Divisi</h2>
                    <div class="relative h-96 overflow-x-auto mt-4 custom-scrollbar">
                        <div id="chartContainerMesinLas" class="h-full">
                            <canvas id="chartMesinLas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        fetch("{{ route('chart.data') }}")
            .then(res => res.json())
            .then(data => {
                const labels = data.alat.map(d => d.divisi);

                // Hitung KPI Cards
                const totalAlatUkur = data.alat.reduce((sum, item) => sum + item.total, 0);
                const totalMesinLas = data.mesin.reduce((sum, item) => sum + item.total, 0);
                const totalRecal = data.alat.reduce((sum, item) => sum + item.recal, 0) + data.mesin.reduce((sum, item) => sum + item.recal, 0);
                const totalRusak = data.alat.reduce((sum, item) => sum + item.rusak, 0) + data.mesin.reduce((sum, item) => sum + item.rusak, 0);

                document.getElementById('totalAlatUkur').textContent = totalAlatUkur.toLocaleString('id-ID');
                document.getElementById('totalMesinLas').textContent = totalMesinLas.toLocaleString('id-ID');
                document.getElementById('totalRecal').textContent = totalRecal.toLocaleString('id-ID');
                document.getElementById('totalRusak').textContent = totalRusak.toLocaleString('id-ID');

                // Atur lebar chart secara dinamis agar batang tidak terlalu kecil/rapat
                // Diperkirakan 4 batang per divisi + spasi = ~100px per divisi
                const pixelsPerCategory = 100;
                const chartMinWidth = labels.length * pixelsPerCategory; 
                document.getElementById('chartContainerAlatUkur').style.minWidth = `${chartMinWidth}px`;
                document.getElementById('chartContainerMesinLas').style.minWidth = `${chartMinWidth}px`;

                // ✨ Opsi Chart diubah untuk GROUPED BAR CHART
                const chartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: '#e2e8f0' }, 
                            ticks: { color: '#64748b' } 
                        },
                        x: { 
                            // Untuk grouped bar, x-axis TIDAK stacked
                            stacked: false, 
                            grid: { display: false }, 
                            ticks: { color: '#64748b' } 
                        }
                    },
                    plugins: {
                        legend: { position: 'top', labels: { color: '#334155', usePointStyle: true, boxWidth: 8 } },
                        title: { display: false } // Judul sudah ada di H2 di atas chart
                    },
                    // ✨ BARU: Mengatur jarak antar kelompok batang
                    categoryPercentage: 0.8, // Lebar total kelompok batang
                    barPercentage: 0.8 // Lebar setiap batang dalam kelompok
                };
                
                // Chart Alat Ukur (Grouped Bar)
                new Chart(document.getElementById('chartAlatUkur'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            { label: 'Total Alat Ukur', data: data.alat.map(d => d.total), backgroundColor: '#4f46e5' }, // Biru/Indigo
                            { label: 'DONE', data: data.alat.map(d => d.done), backgroundColor: '#10b981' }, // Hijau/Emerald
                            { label: 'RE CAL', data: data.alat.map(d => d.recal), backgroundColor: '#f59e0b' }, // Oranye/Amber
                            { label: 'RUSAK', data: data.alat.map(d => d.rusak), backgroundColor: '#ef4444' } // Merah/Rose
                        ]
                    },
                    options: chartOptions
                });

                // Chart Mesin Las (Grouped Bar)
                new Chart(document.getElementById('chartMesinLas'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            { label: 'Total Mesin Las', data: data.mesin.map(d => d.total), backgroundColor: '#06b6d4' }, // Biru muda/Cyan
                            { label: 'DONE', data: data.mesin.map(d => d.done), backgroundColor: '#10b981' }, // Hijau/Emerald
                            { label: 'RE CAL', data: data.mesin.map(d => d.recal), backgroundColor: '#f59e0b' }, // Oranye/Amber
                            { label: 'RUSAK', data: data.mesin.map(d => d.rusak), backgroundColor: '#ef4444' }  // Merah/Rose
                        ]
                    },
                    options: chartOptions
                });
            })
            .catch(error => console.error('Gagal mengambil data chart:', error));
    </script>
</body>
</html>