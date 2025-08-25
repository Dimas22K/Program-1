<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kemampuan Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Diubah: Judul diberi warna tema (indigo) --}}
        <h1 class="text-3xl font-bold mb-6 text-indigo-800">Daftar Kemampuan Lab</h1>

        {{-- Wrapper tabel tidak diubah, tetap dengan shadow --}}
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    
                    {{-- Diubah: Header diberi background indigo solid dengan teks putih --}}
                    <thead class="bg-indigo-700"> 
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider w-16">No</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Kelompok Pengukuran</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Alat Ukur</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Rentang Ukur</th>
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



//tes//