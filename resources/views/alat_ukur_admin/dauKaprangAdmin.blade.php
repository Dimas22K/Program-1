<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>War Ship Measuring Instruments Data - Admin</title>
    <link rel="icon" type="image/png" href="/images/kalibrasi.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans">

    <div class="w-full max-w-[90%] mx-auto py-8">
        <a href="{{ url('/admin') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 transition-colors mb-6 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            <span>Back</span>
        </a>

        <h1 class="text-3xl font-bold mb-6 text-slate-800">War Ship Measuring Instruments Data (Admin)</h1>

        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <form method="GET" action="{{ url()->current() }}" class="flex flex-wrap items-end gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="mt-1 border-gray-300 rounded-md shadow-sm w-60" placeholder="Code / Name / Brand">
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
                        <option value="DONE" {{ request('status') == 'DONE' ? 'selected' : '' }}>DONE</option>
                        <option value="RE CALL" {{ request('status') == 'RE CALL' ? 'selected' : '' }}>RE CALL</option>
                        <option value="BROKEN" {{ request('status') == 'BROKEN' ? 'selected' : '' }}>BROKEN</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2 rounded-md">Filter</button>
                    <a href="{{ url()->current() }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-5 py-2 rounded-md">Reset</a>
                </div>
            </form>
        </div>

        <div class="mb-6 items-center">
            <a href="{{ route('admin.create', [$jenis, $divisi]) }}"
                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-transform transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Add Data</span>
            </a>

            <a href="{{ route('admin.export', [$jenis, $divisi] + request()->query()) }}"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition-transform transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span>Download Excel</span>
            </a>
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
                        <th class="w-[8%] px-2 py-3 text-center text-xs font-semibold uppercase">Status</th>
                        <th class="w-[12%] px-2 py-3 text-left text-xs font-semibold uppercase">Description</th>
                        <th class="w-[10%] px-2 py-3 text-center text-xs font-semibold uppercase">Action</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 text-sm">
                    @forelse($data as $row)
                    @php
                        $statusKey = strtoupper(trim($row->status));

                        $rowClass = match ($statusKey) {
                            'DONE' => 'bg-green-50 hover:bg-green-100',
                            'RE CALL' => 'bg-yellow-50 hover:bg-yellow-100',
                            'BROKEN' => 'bg-red-50 hover:bg-red-100',
                            'OOT' => 'bg-gray-50 hover:bg-gray-300',
                            default => 'bg-white'
                        };

                        $statusClass = match ($statusKey) {
                            'DONE' => 'bg-green-200 text-green-800',
                            'RE CALL' => 'bg-yellow-300 text-yellow-900',
                            'BROKEN' => 'bg-red-300 text-red-900',
                            'OOT' => 'bg-gray-200 text-gray-800',
                            default => 'bg-white'
                        };

                        $statusLabelMap = [
                            'DONE' => 'DONE',
                            'RE CALL' => 'RE CALL',
                            'BROKEN' => 'BROKEN',
                            'OOT' => 'OOT',
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
                        <td class="px-2 py-4 border-b border-gray-200">{{ $row->tgl_kalibrasi ? \Carbon\Carbon::parse($row->tgl_kalibrasi)->format('d-m-Y') : '-' }}</td>
                        <td class="px-2 py-4 border-b border-gray-200">{{ $row->kalibrasi_selanjutnya ? \Carbon\Carbon::parse($row->kalibrasi_selanjutnya)->format('d-m-Y') : '-' }}</td>
                        <td class="px-3 py-4 border-b border-gray-200">
                            @if(!empty($row->kalibrasi_selanjutnya))
                            @php
                                    $nextCal = \Carbon\Carbon::parse($row->kalibrasi_selanjutnya);
                                    $planDate = $nextCal->copy()->subDays(7);
                                @endphp
                                <span class="text-blue-600 font-semibold">{{ $planDate->format('d-m-Y') }}</span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        <td class="px-2 py-4 border-b border-gray-200 text-center">
                            <span
                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                {{ $displayLabel }}
                            </span>
                        </td>
                        <td class="px-2 py-4 border-b border-gray-200">
                            {{ $row->description ?? '-' }}
                        </td>
                        <td class="px-2 py-4 border-b border-gray-200 text-center">
                            <div class="flex items-center justify-center gap-4">
                                <a href="{{ route('admin.edit', [$jenis, $divisi, $row->id]) }}"
                                    class="font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('admin.delete', [$jenis, $divisi, $row->id]) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this data?')"
                                        class="font-medium text-red-600 hover:text-red-900">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center py-10 text-gray-500 font-medium">No data found.</td>
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