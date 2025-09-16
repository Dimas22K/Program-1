<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>War Ship Welding Machine Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans">

    <div class="container mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ url('/welcome') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 transition-colors mb-6 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            <span>Back</span>
        </a>

        <h1 class="text-3xl font-bold mb-6 text-slate-800">War Ship Welding Machine Data</h1>

        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <form method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-end gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="mt-1 border-gray-300 rounded-md shadow-sm w-60"
                           placeholder="Code / Name / Brand">
                </div>

                <div>
                    <label for="tgl_mulai" class="block text-sm font-medium text-gray-700">Calibration Date</label>
                    <input type="date" name="tgl_mulai" id="tgl_mulai" value="{{ request('tgl_mulai') }}"
                           class="mt-1 border-gray-300 rounded-md shadow-sm w-44">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 border-gray-300 rounded-md shadow-sm w-40">
                        <option value="">All</option>
                        <option value="DONE"     {{ request('status') == 'DONE'     ? 'selected' : '' }}>DONE</option>
                        <option value="RE CAL"   {{ request('status') == 'RE CAL'   ? 'selected' : '' }}>RE CAL</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2 rounded-md">Filter</button>
                    <a href="{{ url()->current() }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-5 py-2 rounded-md">Reset</a>
                </div>
            </form>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <table class="w-full table-fixed">
                <thead class="bg-slate-800 text-white">
                    <tr>
                        <th class="w-[4%] px-2 py-3 text-left text-xs font-semibold uppercase">No</th>
                        <th class="w-[10%] px-2 py-3 text-left text-xs font-semibold uppercase">Codification</th>
                        <th class="w-[14%] px-2 py-3 text-left text-xs font-semibold uppercase">Machine Name</th>
                        <th class="w-[14%] px-2 py-3 text-left text-xs font-semibold uppercase">Brand / Type</th>
                        <th class="w-[12%] px-2 py-3 text-left text-xs font-semibold uppercase">Serial Number</th>
                        <th class="w-[8%] px-2 py-3 text-left text-xs font-semibold uppercase">Range</th>
                        <th class="w-[8%] px-2 py-3 text-left text-xs font-semibold uppercase">Date</th>
                        <th class="w-[8%] px-2 py-3 text-left text-xs font-semibold uppercase">Due Date</th>
                        <th class="w-[12%] px-2 py-3 text-left text-xs font-semibold uppercase">Calibration Plan</th>
                        <th class="w-[10%] px-2 py-3 text-center text-xs font-semibold uppercase">Status</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 text-sm">
                    @forelse($data as $row)
                        @php
                            // NORMALIZE key jadi nilai enum yang kita pakai
                            $statusKey = strtoupper(trim($row->status)); // pastikan kapital

                            // kelas baris
                            $rowClass = match($statusKey) {
                                'DONE'     => 'bg-green-50 hover:bg-green-100',
                                'RE CAL'   => 'bg-yellow-50 hover:bg-yellow-100',
                                default    => 'hover:bg-gray-50'
                            };

                            // kelas label/status
                            $statusClass = match($statusKey) {
                                'DONE'     => 'bg-green-200 text-green-800',
                                'RE CAL'   => 'bg-yellow-300 text-yellow-900',
                                default    => 'bg-gray-200 text-gray-800'
                            };

                            // label ramah pengguna
                            $statusLabelMap = [
                                'DONE'     => 'DONE',
                                'RE CAL'   => 'RE CAL',
                            ];
                            $displayLabel = $statusLabelMap[$statusKey] ?? $row->status;
                        @endphp

                        <tr class="{{ $rowClass }} transition-colors duration-200 align-top">
                            <td class="px-2 py-4 border-b border-gray-200">{{ $row->id }}</td>
                            <td class="px-2 py-4 border-b border-gray-200">{{ $row->kodefikasi }}</td>
                            <td class="px-2 py-4 border-b border-gray-200">{{ $row->nama_alat }}</td>
                            <td class="px-2 py-4 border-b border-gray-200">{{ $row->merk_type }}</td>
                            <td class="px-2 py-4 border-b border-gray-200">{{ $row->no_seri }}</td>
                            <td class="px-2 py-4 border-b border-gray-200">{{ $row->range_alat }}</td>
                            <td class="px-2 py-4 border-b border-gray-200">{{ $row->tgl_kalibrasi }}</td>
                            <td class="px-2 py-4 border-b border-gray-200">{{ $row->kalibrasi_selanjutnya }}</td>
                            <td class="px-3 py-4 border-b border-gray-200">
                                @if(!empty($row->kalibrasi_selanjutnya))
                                    @php
                                        $nextCal  = \Carbon\Carbon::parse($row->kalibrasi_selanjutnya);
                                        $planDate = $nextCal->copy()->subDays(7);
                                    @endphp
                                    <span class="text-blue-600 font-semibold">{{ $planDate->format('Y-m-d') }}</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-2 py-4 border-b border-gray-200 text-center">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $displayLabel }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-10 text-gray-500 font-medium">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $data->withQueryString()->links() }}
        </div>
    </div>
</body>
</html>
