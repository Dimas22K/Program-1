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
              <a href="{{ route('welcome') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Detail</a>
              <a href="{{ route('kemampuanLab') }}" class="block px-5 py-2 hover:bg-[#0063c0] text-center">Calibration Laboratory Capability</a>
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

    <!-- Hero Section -->
    <section class="relative mt-20">
      <img src="/images/banner 1.png" alt="Banner" class="w-full h-64 object-cover">
    </section>

    <!-- Content Section -->
    <section class="py-12 bg-white">
      <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-20 text-center">

        <!-- Alat Ukur -->
        <div class="cursor-pointer" onclick="openModal('alat-ukur')">
          <img src="/images/alat ukur 1.png" alt="Alat Ukur"
            class="w-full rounded-lg object-cover h-[700px] transition-transform duration-300 hover:scale-105">
        </div>

        <!-- Data Mesin -->
        <div class="cursor-pointer" onclick="openModal('data-mesin')">
          <img src="/images/mesin las 1.png" alt="Mesin Las"
            class="w-full rounded-lg object-cover h-[700px] transition-transform duration-300 hover:scale-105">
        </div>


      </div>
    </section>

    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-lg p-8 max-w-7xl w-[90%] relative">
        <button onclick="closeModal()"
          class="absolute top-3 right-4 text-2xl font-bold hover:text-red-500 transition">&times;</button>
        <h2 class="text-center text-2xl font-bold mb-8">Choose Division</h2>

        <!-- Flex container -->
        <div class="flex flex-wrap justify-center gap-8">
          <!-- Baris 1 -->
          <div onclick="goToDivisi('kania')"
            class="relative cursor-pointer w-72 h-44 hover:scale-105 transition-transform duration-200">
            <img src="/images/divisikania.png" class="w-full h-full object-cover rounded-lg">
            <p
              class="absolute inset-0 flex items-center justify-center text-white text-lg font-bold bg-black bg-opacity-30">
              Merchant Ship Division</p>
          </div>

          <div onclick="goToDivisi('kapsel')"
            class="relative cursor-pointer w-72 h-44 hover:scale-105 transition-transform duration-200">
            <img src="/images/divisikapsel.png" class="w-full h-full object-cover rounded-lg">
            <p
              class="absolute inset-0 flex items-center justify-center text-white text-lg font-bold bg-black bg-opacity-30">
              Submarine Division</p>
          </div>

          <div onclick="goToDivisi('kaprang')"
            class="relative cursor-pointer w-72 h-44 hover:scale-105 transition-transform duration-200">
            <img src="/images/divisikaprang.png" class="w-full h-full object-cover rounded-lg">
            <p
              class="absolute inset-0 flex items-center justify-center text-white text-lg font-bold bg-black bg-opacity-30">
              War Ship Division</p>
          </div>

          <!-- Baris 2 -->
          <div onclick="goToDivisi('harkan')"
            class="relative cursor-pointer w-72 h-44 hover:scale-105 transition-transform duration-200">
            <img src="/images/divisiharkan.png" class="w-full h-full object-cover rounded-lg">
            <p
              class="absolute inset-0 flex items-center justify-center text-white text-lg font-bold bg-black bg-opacity-30">
              MRO Division</p>
          </div>

          <div onclick="goToDivisi('rekum')"
            class="relative cursor-pointer w-72 h-44 hover:scale-105 transition-transform duration-200">
            <img src="/images/divisirekum.png" class="w-full h-full object-cover rounded-lg">
            <p
              class="absolute inset-0 flex items-center justify-center text-white text-lg font-bold bg-black bg-opacity-30">
              General Engineering Division</p>
          </div>
        </div>
      </div>
    </div>


    <footer class="bg-[#2ba7cf] text-white py-6 mt-12">
      <div class="container mx-auto px-6 text-center text-sm">

        <div class="inline-flex items-center justify-center gap-x-16 mb-4">
          <img src="/images/kan.png" class="h-8 md:h-12 lg:h-20 object-contain" alt="KAN">
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
        window.location.href = `/${jenis}/${divisi}`;
      }
    </script>

  </body>

</html>