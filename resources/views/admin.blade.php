<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calibration Laboratory</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-white">
  <header class="bg-[#2ba7cf] text-white py-4 shadow-md">
    <div class="max-w-7xl mx-auto px-4 md:px-3 flex items-center">

      <!-- Logo -->
      <div class="flex items-center space-x-2">
        <img src="/images/pal.png" alt="Logo" class="h-10 md:h-16 w-auto mr-4">
      </div>

      <!-- Menu + Hamburger -->
      <div class="flex items-center ml-auto relative z-50">
        <!-- Navbar Desktop -->

        <!-- Hamburger -->
        <div class="ml-4 relative z-50">
          <button id="mobile-menu-button">
            <img src="/images/profile.png" alt="Menu" class="w-12 h-12">
          </button>

          <!-- Dropdown animasi -->
          <div id="mobile-menu"
            class="absolute left-1/2 -translate-x-1/2 mt-2 w-40 bg-[#0085FF] text- rounded-lg shadow-lg overflow-hidden transform scale-y-0 origin-top transition-transform duration-300 z-50">
            <a href="{{ route('chart.admin') }}"
              class="block px-5 py-2 hover:bg-[#0063c0] text-center">Dashboard</a>

            <a href="{{ route('admin') }}"
              class="block px-5 py-2 hover:bg-[#0063c0] text-center">Detail</a>

            <a href="{{ route('kemampuanLabAdmin') }}"
              class="block px-5 py-2 hover:bg-[#0063c0] text-center">Calibration Laboratory Capability </a>

            <a href="{{ route('interval.index') }}"
               class="block px-5 py-2 hover:bg-[#0063c0] text-center">Interval Kalibrasi</a>

            <a href="{{ route('logout') }}"
              class="block px-5 py-2 hover:bg-[#0063c0] text-center">Logout</a>

          </div>

        </div>
      </div>
    </div>
  </header>

  </div>
  </header>

  <!-- Hero Section -->
  <section class="relative">
    <img src="/images/banner 1.png" alt="Banner" class="w-full h-64 object-cover">
  </section>

  <!-- Content Section -->
  <section class="py-12 bg-white">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-20 text-center">

      <!-- Data 
       -->
      <!-- Data Mesin -->
      <div class="cursor-pointer" onclick="openModal('data-mesin')">
        <img src="/images/mesin las 1.png"
          alt="Mesin Las"
          class="w-full rounded-lg object-cover h-[700px] transition-transform duration-300 hover:scale-105">
      </div>

      <!-- Alat Ukur -->
      <div class="cursor-pointer" onclick="openModal('alat-ukur')">
        <img src="/images/alat ukur 1.png"
          alt="Alat Ukur"
          class="w-full rounded-lg object-cover h-[700px] transition-transform duration-300 hover:scale-105">
      </div>
    </div>
  </section>

  <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-7xl w-[90%] relative">
      <button onclick="closeModal()" class="absolute top-3 right-4 text-2xl font-bold hover:text-red-500 transition">&times;</button>
      <h2 class="text-center text-2xl font-bold mb-8">Pilih Divisi</h2>

      <!-- Flex container -->
      <div class="flex flex-wrap justify-center gap-8">
        <!-- Baris 1 -->
        <div onclick="goToDivisi('kania')" class="relative cursor-pointer w-72 h-44 hover:scale-105 transition-transform duration-200">
          <img src="/images/divisikania.png" class="w-full h-full object-cover rounded-lg">
          <p class="absolute inset-0 flex items-center justify-center text-white text-lg font-bold bg-black bg-opacity-30">Kania Division</p>
        </div>

        <div onclick="goToDivisi('kapsel')" class="relative cursor-pointer w-72 h-44 hover:scale-105 transition-transform duration-200">
          <img src="/images/divisikapsel.png" class="w-full h-full object-cover rounded-lg">
          <p class="absolute inset-0 flex items-center justify-center text-white text-lg font-bold bg-black bg-opacity-30">Kapsel Division</p>
        </div>

        <div onclick="goToDivisi('kaprang')" class="relative cursor-pointer w-72 h-44 hover:scale-105 transition-transform duration-200">
          <img src="/images/divisikaprang.png" class="w-full h-full object-cover rounded-lg">
          <p class="absolute inset-0 flex items-center justify-center text-white text-lg font-bold bg-black bg-opacity-30">Kaprang Division</p>
        </div>

        <!-- Baris 2 -->
        <div onclick="goToDivisi('harkan')" class="relative cursor-pointer w-72 h-44 hover:scale-105 transition-transform duration-200">
          <img src="/images/divisiharkan.png" class="w-full h-full object-cover rounded-lg">
          <p class="absolute inset-0 flex items-center justify-center text-white text-lg font-bold bg-black bg-opacity-30">Harkan Division</p>
        </div>

        <div onclick="goToDivisi('rekum')" class="relative cursor-pointer w-72 h-44 hover:scale-105 transition-transform duration-200">
          <img src="/images/divisirekum.png" class="w-full h-full object-cover rounded-lg">
          <p class="absolute inset-0 flex items-center justify-center text-white text-lg font-bold bg-black bg-opacity-30">Rekum Division</p>
        </div>
      </div>
    </div>
  </div>


  <footer class="bg-[#2ba7cf] text-white py-6 mt-12">
    <div class="container mx-auto px-6 text-center text-sm">

      <div class="inline-flex items-center justify-center gap-x-16 mb-4">
        <img src="/images/pal.png" class="h-8 md:h-12 lg:h-14 object-contain" alt="PAL">
        <img src="/images/kan.png" class="h-8 md:h-12 lg:h-20 object-contain" alt="KAN">
        <img src="/images/iso.png" class="h-8 md:h-12 lg:h-24 object-contain" alt="ISO">
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

    // Fungsi buka modal
    function openModal(jenis) {
      document.getElementById('modal').classList.remove('hidden');
      // Bisa simpan jenis untuk digunakan nanti jika perlu
      document.getElementById('modal').setAttribute('data-jenis', jenis);
    }

    // Fungsi tutup modal
    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
    }

    // Fungsi pilih divisi
    function goToDivisi(divisi) {
      const jenis = document.getElementById('modal').getAttribute('data-jenis');
      window.location.href = `/admin/${jenis}/${divisi}`;
    }
  </script>

</body>

</html>