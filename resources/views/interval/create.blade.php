<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Interval Data - Calibration Laboratory</title>
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
              <a href="{{ route('chart.admin') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Dashboard</a>
              <a href="{{ route('admin') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Detail</a>
              <a href="{{ route('kemampuanLabAdmin') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Calibration Laboratory Capability</a>
              <a href="{{ route('interval.index') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Calibration Interval</a>
              <a href="{{ route('logout') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </header>

  <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-20">

    <div class="max-w-2xl mx-auto bg-white p-6 sm:p-8 rounded-xl shadow-lg">
      
      <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-8">Add New Interval</h1>

      <form action="{{ route('interval.store') }}" method="post">
        @csrf
        
        <div class="mb-6">
          <label for="nama_alat" class="block text-sm font-medium text-gray-700 mb-2">Machine Name</label>
          <input type="text" name="nama_alat" id="nama_alat" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Example: Digital Caliper">
        </div>

        <div class="mb-8">
          <label for="interval_bulan" class="block text-sm font-medium text-gray-700 mb-2">Interval (Month)</label>
          <input type="number" name="interval_bulan" id="interval_bulan" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Example: 6">
        </div>

        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('interval.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-200">
                Save
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