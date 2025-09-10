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

  <header class="bg-[#2ba7cf] text-white py-4 shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 md:px-3 flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <img src="/images/pal.png" alt="Logo" class="h-10 md:h-12 w-auto">
      </div>
      <div class="relative">
        <button id="mobile-menu-button" class="flex items-center justify-center">
          <img src="/images/profile.png" alt="Menu" class="w-12 h-12 rounded-full border-2 border-white">
        </button>
        <div id="mobile-menu" class="absolute right-0 mt-2 w-56 bg-white text-black rounded-lg shadow-xl overflow-hidden transform scale-y-0 origin-top transition-transform duration-300 z-50">
          <a href="{{ route('chart.admin') }}" class="block px-4 py-3 text-sm hover:bg-gray-100">Dashboard</a>
          <a href="{{ route('admin') }}" class="block px-4 py-3 text-sm hover:bg-gray-100">Detail</a>
          <a href="{{ route('kemampuanLabAdmin') }}" class="block px-4 py-3 text-sm hover:bg-gray-100">Calibration Laboratory Capability</a>
          <a href="{{ route('interval.index') }}" class="block px-4 py-3 text-sm bg-gray-100 font-semibold text-blue-600">Interval Kalibrasi</a>
          <hr>
          <a href="{{ route('logout') }}" class="block px-4 py-3 text-sm text-red-600 hover:bg-red-50">Logout</a>
        </div>
      </div>
    </div>
  </header>

  <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Data Interval Kalibrasi</h1>
        <a href="{{ route('interval.create') }}" class="inline-block bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-200">
          + Tambah Data
        </a>
      </div>
      <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table class="min-w-full bg-white">
          <thead class="bg-gray-100">
            <tr class="divide-x divide-gray-200">
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">ID</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Alat</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Durasi (Bulan)</th>
              <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
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
                <a href="{{ route('interval.delete', $i->id) }}" class="text-red-600 hover:text-red-900">Hapus</a>
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
        <img src="/images/pal.png" class="h-10 sm:h-12 object-contain" alt="PAL">
        <img src="/images/kan.png" class="h-12 sm:h-16 object-contain" alt="KAN">
        <img src="/images/iso.png" class="h-16 sm:h-20 object-contain" alt="ISO">
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