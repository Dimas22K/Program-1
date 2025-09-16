<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Interval Kalibrasi - Calibration Laboratory</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

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
              <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>


            <!-- Dropdown: centered under the button -->
            <div id="mobile-menu"
              class="absolute left-1/2 -translate-x-1/2 top-full mt-2 w-48 bg-[#0085FF] rounded-lg shadow-lg overflow-hidden transform scale-y-0 origin-top transition-transform duration-200 z-50"
              style="transform-origin: top center;">
              <a href="{{ route('chart.user') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Dashboard</a>
              <a href="{{ route('admin') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Detail</a>
              <a href="{{ route('kemampuanLabAdmin') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Calibration Laboratory Capability</a>
              <a href="{{ route('interval.index') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Calibration Interval</a>
              <a href="{{ route('logout') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Logout</a>
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

  <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-12">
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Calibration Interval Data</h1>
        <a href="{{ route('interval.create') }}" class="inline-block bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-200">
          + Add Data
        </a>
      </div>
      <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table class="min-w-full bg-white">
          <thead class="bg-gray-100">
            <tr class="divide-x divide-gray-200">
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">ID</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tools Name</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Duration (Month)</th>
              <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach($intervals as $i)
            <tr class="hover:bg-gray-50 transition-colors duration-150 divide-x divide-gray-200">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $i->id }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $i->nama_alat }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $i->interval_bulan }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                <a href="{{ route('interval.edit', $i->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                <a href="{{ route('interval.delete', $i->id) }}" class="text-red-600 hover:text-red-900">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <footer class="bg-[#2ba7cf] text-white py-6 mt-12">
    <div class="container mx-auto px-6 text-center text-sm">
      <div class="inline-flex items-center justify-center gap-x-12 sm:gap-x-16 mb-4">
        <img src="/images/kan.png" class="h-12 sm:h-16 object-contain" alt="KAN">
      </div>
      <div>
        Laboratorium Kalibrasi PT. PAL Indonesia (Persero). Copyright 2021.
      </div>
    </div>
  </footer>

  <script>
    const menuBtn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');
    let menuOpen = false;
    menuBtn.addEventListener('click', (event) => {
      event.stopPropagation();
      menuOpen = !menuOpen;
      menu.classList.toggle('scale-y-100', menuOpen);
      menu.classList.toggle('scale-y-0', !menuOpen);
    });
    window.addEventListener('click', () => {
      if (menuOpen) {
        menuOpen = false;
        menu.classList.remove('scale-y-100');
        menu.classList.add('scale-y-0');
      }
    });
  </script>

</body>
</html>