<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Data Interval - Calibration Laboratory</title>
  <link rel="icon" type="image/png" href="/images/kalibrasi.png">
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
    <div class="max-w-2xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-lg">
      
      <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-8">Edit Interval Kalibrasi</h1>

      <form action="{{ route('interval.update', $interval->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
          <label for="nama_alat" class="block text-sm font-medium text-gray-700 mb-2">Nama Alat</label>
          <input type="text" name="nama_alat" id="nama_alat" value="{{ $interval->nama_alat }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-8">
          <label for="interval_bulan" class="block text-sm font-medium text-gray-700 mb-2">Interval (bulan)</label>
          <input type="number" name="interval_bulan" id="interval_bulan" value="{{ $interval->interval_bulan }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('interval.index') }}" class="text-gray-600 hover:text-gray-800">Batal</a>
            <button type="submit" class="bg-green-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-green-700 transition-colors duration-200">
                Update Data
            </button>
        </div>
      </form>
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