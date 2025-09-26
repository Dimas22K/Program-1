<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calibration Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .custom-scrollbar::-webkit-scrollbar {
            height: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
    </style>
</head>

<body class="bg-slate-100 flex flex-col min-h-screen">
    </head>

    <body class="bg-white">
        <header class="fixed top-0 left-0 w-full z-50 bg-[#2ba7cf] text-white py-4 shadow-md">
            <div class="max-w-7xl mx-auto px-4 md:px-3 flex items-center justify-between">
                <!-- Logo Kiri -->
                <div class="flex items-center space-x-2">
                    <img src="/images/danantara.jpg" alt="Danantara Logo" class="h-10 md:h-12 w-auto mr-4">
                </div>

                <!-- Bagian kanan: PAL + tombol menu -->
                <div class="flex items-center space-x-6">
                    <!-- Logo PAL -->
                    <img src="/images/pal.png" alt="PAL Logo" class="h-10 md:h-12 w-auto">

                    <!-- Wrapper tombol menu (HANYA ini yang relative) -->
                    <div class="relative inline-block ml-8">
                        <!-- Tombol Menu -->
                        <button id="mobile-menu-button" class="focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>


                        <!-- Dropdown: centered under the button -->
                        <div id="mobile-menu"
                            class="absolute left-1/2 -translate-x-1/2 top-full mt-2 w-48 bg-[#0085FF] rounded-lg shadow-lg overflow-hidden transform scale-y-0 origin-top transition-transform duration-200 z-50"
                            style="transform-origin: top center;">
                            <a href="{{ route('chart.admin') }}"
                                class="block px-5 py-2 hover:bg-[#0063c0] text-center">Dashboard</a>
                            <a href="{{ route('admin') }}"
                                class="block px-5 py-2 hover:bg-[#0063c0] text-center">Detail</a>
                            <a href="{{ route('kemampuanLabAdmin') }}"
                                class="block px-5 py-2 hover:bg-[#0063c0] text-center">Calibration Laboratory
                                Capability</a>
                            <a href="{{ route('interval.index') }}"
                                class="block px-5 py-2 hover:bg-[#0063c0] text-center">Calibration Interval</a>
                            <a href="{{ route('logout') }}"
                                class="block px-5 py-2 hover:bg-[#0063c0] text-center">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const button = document.getElementById('mobile-menu-button');
                const menu = document.getElementById('mobile-menu');
                const wrapper = document.getElementById('menu-wrapper');

                // Toggle: stop propagation supaya click tidak "bubbling" ke document
                button.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const open = menu.classList.toggle('scale-y-100');
                    menu.classList.toggle('scale-y-0', !open);
                    // accessible state
                    button.setAttribute('aria-expanded', open ? 'true' : 'false');
                });

                // Klik di luar area -> tutup menu
                document.addEventListener('click', function (e) {
                    if (!wrapper.contains(e.target)) {
                        menu.classList.add('scale-y-0');
                        menu.classList.remove('scale-y-100');
                        button.setAttribute('aria-expanded', 'false');
                    }
                });

                // optional: tekan Esc untuk tutup
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        menu.classList.add('scale-y-0');
                        menu.classList.remove('scale-y-100');
                        button.setAttribute('aria-expanded', 'false');
                    }
                });
            });
        </script>


        <main class="flex-1 p-6 lg:p-8 w-full max-w-7xl mx-auto mt-20">
            <h1 class="text-3xl font-bold text-slate-800">Calibration Summary Dashboard </h1>
            <p class="text-slate-500 mt-1">Current status of measuring instruments and welding machines in all divisions.</p>

            <!-- KPI Section -->
            <div class="flex justify-center gap-6 mt-6">
                <!-- Card 1 -->
                <div class="bg-white p-5 rounded-xl shadow flex items-center gap-4">
                    <div class="p-3 bg-indigo-100 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Total Measuring Instruments</p>
                        <p id="totalAlatUkur" class="text-2xl font-bold text-slate-800">0</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-5 rounded-xl shadow flex items-center gap-4">
                    <div class="p-3 bg-cyan-100 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Total Welding Machines</p>
                        <p id="totalMesinLas" class="text-2xl font-bold text-slate-800">0</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-5 rounded-xl shadow flex items-center gap-4">
                    <div class="p-3 bg-amber-100 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Requires Recalibration</p>
                        <p id="totalRecal" class="text-2xl font-bold text-slate-800">0</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-6">
                <div class="bg-white p-6 rounded-xl shadow">
                    <h2 class="text-xl font-semibold text-slate-800">Measuring Instrument Status per Division</h2>
                    <div class="relative h-96 overflow-x-auto mt-4 custom-scrollbar">
                        <div id="chartContainerAlatUkur" class="h-full">
                            <canvas id="chartAlatUkur"></canvas>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <h2 class="text-xl font-semibold text-slate-800">Welding Machine Status per Division</h2>
                    <div class="relative h-96 overflow-x-auto mt-4 custom-scrollbar">
                        <div id="chartContainerMesinLas" class="h-full">
                            <canvas id="chartMesinLas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-[#2ba7cf] text-white py-6 mt-12">
            <div class="container mx-auto px-6 text-center text-sm">

                <div class="inline-flex items-center justify-center gap-x-16 mb-4">
                    <img src="/images/kan.png" class="h-8 md:h-12 lg:h-20 object-contain" alt="KAN">
                </div>

                <div>
                    Laboratorium Kalibrasi PT. PAL Indonesia. Copyright 2026.
                </div>

            </div>
        </footer>

        <script>
            fetch("{{ route('chart.data') }}")
                .then(res => res.json())
                .then(data => {
                    const labels = data.alat.map(d => `${d.divisi}`);

                    // Hitung KPI Cards
                    const totalAlatUkur = data.alat.reduce((sum, item) => sum + item.total, 0);
                    const totalMesinLas = data.mesin.reduce((sum, item) => sum + item.total, 0);
                    const totalRecal = data.alat.reduce((sum, item) => sum + item.recal, 0) + data.mesin.reduce((sum, item) => sum + item.recal, 0);

                    document.getElementById('totalAlatUkur').textContent = totalAlatUkur.toLocaleString('id-ID');
                    document.getElementById('totalMesinLas').textContent = totalMesinLas.toLocaleString('id-ID');
                    document.getElementById('totalRecal').textContent = totalRecal.toLocaleString('id-ID');

                    // Atur lebar chart secara dinamis
                    const pixelsPerCategory = 100;
                    const chartMinWidth = labels.length * pixelsPerCategory;
                    document.getElementById('chartContainerAlatUkur').style.minWidth = `${chartMinWidth}px`;
                    document.getElementById('chartContainerMesinLas').style.minWidth = `${chartMinWidth}px`;

                    const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        y: {
            beginAtZero: true,
            grid: { color: '#e2e8f0' },
            ticks: { color: '#64748b' },
            title: {
                display: true,
                text: 'Total Item',
                font: { size: 14, weight: 'bold' },
                padding: { bottom: 10 }
            }
        },
        x: {
            stacked: false,
            grid: { display: false },
            ticks: {
                color: '#64748b',
                autoSkip: false,
                font: { size: 13 },
            }
        }
    },
    plugins: {
        legend: {
            position: 'top',
            labels: {
                color: '#334155',
                usePointStyle: true,
                boxWidth: 8
            }
        },
        tooltip: {
            callbacks: {
                label: function (context) {
                    const datasetLabel = context.dataset.label || '';
                    const value = context.raw;
                    const index = context.dataIndex;

                    // total per divisi = ambil dataset[0] (total)
                    const total = context.chart.data.datasets[0].data[index];
                    let percent = '';
                    if (datasetLabel === 'DONE' || datasetLabel === 'RE CAL') {
                        percent = ` (${((value / total) * 100).toFixed(1)}%)`;
                    }

                    return `${datasetLabel}: ${value} Unit${percent}`;
                }
            }
        }
    },
    categoryPercentage: 0.8,
    barPercentage: 0.8
};


                    // Chart Alat Ukur (Grouped Bar)
                    new Chart(document.getElementById('chartAlatUkur'), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Measuring Instruments',
                                data: data.alat.map(d => d.total),
                                backgroundColor: '#4f46e5'
                            },
                            {
                                label: 'DONE',
                                data: data.alat.map(d => d.done),
                                backgroundColor: '#10b981'
                            },
                            {
                                label: 'RE CAL',
                                data: data.alat.map(d => d.recal),
                                backgroundColor: '#f59e0b'
                            }
                            ]
                        },
                        options: chartOptions
                    });

                    // Chart Mesin Las (Grouped Bar)
                    new Chart(document.getElementById('chartMesinLas'), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Welding Machines',
                                data: data.mesin.map(d => d.total),
                                backgroundColor: '#06b6d4'
                            },
                            {
                                label: 'DONE',
                                data: data.mesin.map(d => d.done),
                                backgroundColor: '#10b981'
                            },
                            {
                                label: 'RE CAL',
                                data: data.mesin.map(d => d.recal),
                                backgroundColor: '#f59e0b'
                            }
                            ]
                        },
                        options: chartOptions
                    });
                })
                .catch(error => console.error('Gagal mengambil data chart:', error));

            const menuBtn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');
            let menuOpen = false;

            menuBtn.addEventListener('click', () => {
                if (menuOpen) {
                    menu.classList.remove('scale-y-100');
                    menu.classList.add('scale-y-0');
                } else {
                    menu.classList.remove('scale-y-0');
                    menu.classList.add('scale-y-100');
                }
                menuOpen = !menuOpen;
            });
        </script>

    </body>

</html>