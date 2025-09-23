<!DOCTYPE html>
<html>
<head>
    <title>List of Lab Capability</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

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
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-10 h-10 text-white"
             fill="none" viewBox="0 0 24 24"
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

    <div class="container mx-auto p-4 sm:p-6 lg:p-8 mt-16">

        <a href="{{ url('/welcome') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 transition-colors mb-4 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            <span>Back</span>
        </a>

        {{-- Diubah: Judul diberi warna tema (indigo) --}}
        <h1 class="text-3xl font-bold mb-6 text-indigo-800">List of Lab Capability</h1>

        {{-- Wrapper tabel tidak diubah, tetap dengan shadow --}}
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">

                    {{-- Diubah: Header diberi background indigo solid dengan teks putih --}}
                    <thead class="bg-indigo-700">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider w-16">No</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Measurement Group</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Measuring Instrument</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Measurement Range</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach($data as $row)
                        {{-- Diubah: Efek hover & warna baris genap disesuaikan dengan tema --}}
                        <tr class="even:bg-indigo-50/60 hover:bg-indigo-100 transition-colors duration-150">

                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-800 align-top">{{ $row->No }}</td>

                            {{-- Diubah: Teks 'Kelompok Pengukuran' diberi warna aksen --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-900 align-top">{{ $row->Kelompok_Pengukuran }}</td>

                            <td class="px-6 py-4 text-sm text-gray-700 align-top">
                                @foreach(explode(',', $row->alat_ukur) as $alat)
                                    <span class="block">{{ trim($alat) }}</span>
                                @endforeach
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600 align-top">
                                @foreach(explode(',', $row->rentang_ukur) as $rentang)
                                    <span class="block whitespace-nowrap">{{ str_replace('~', ' ~ ', trim($rentang)) }}</span>
                                @endforeach
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $data->links() }}
        </div>
    </div>
</body>
</html>