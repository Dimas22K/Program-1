<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\IntervalKalibrasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InstrumentsExport;

class AdminController extends Controller
{
    public function export(Request $request, $jenis, $divisi)
    {
        $table = $this->getTableName($jenis, $divisi);
        $fileName = 'Data_Instrumen_' . $jenis . '_' . $divisi . '_' . time() . '.xlsx';
        return Excel::download(new InstrumentsExport($request, $table), $fileName);
    }

    private $labelMap = [
        'kania' => 'Merchant Div',
        'kapsel' => 'Submarine Div',
        'kaprang' => 'War Ship Div',
        'rekum' => 'General Eng. Div',
        'harkan' => 'MRO Div',
    ];

    public function index($jenis, $divisi, Request $request)
    {
        $table = $this->getTableName($jenis, $divisi);

        $query = DB::table($table)->select('*');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('kodefikasi', 'like', '%' . $searchTerm . '%')
                    ->orWhere('nama_alat', 'like', '%' . $searchTerm . '%')
                    ->orWhere('merk_type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }
        if ($request->filled('tgl_mulai')) {
            $query->where('tgl_kalibrasi', '>=', $request->tgl_mulai);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('id', 'asc')->paginate(20);

        $filterParams = [
            'search' => $request->search,
            'tgl_mulai' => $request->tgl_mulai,
            'status' => $request->status,
        ];

        $folder = $jenis === 'data-mesin' ? 'data_mesin_admin' : 'alat_ukur_admin';
        $mapView = [
            'data-mesin' => [
                'kania' => 'dmlKaniaAdmin',
                'kapsel' => 'dmlKapselAdmin',
                'kaprang' => 'dmlKaprangAdmin',
                'harkan' => 'dmlHarkanAdmin',
                'rekum' => 'dmlRekumAdmin',
            ],
            'alat-ukur' => [
                'kania' => 'dauKaniaAdmin',
                'kapsel' => 'dauKapselAdmin',
                'kaprang' => 'dauKaprangAdmin',
                'harkan' => 'dauHarkanAdmin',
                'rekum' => 'dauRekumAdmin',
            ],
        ];

        $view = $mapView[$jenis][$divisi] ?? abort(404, 'View tidak ditemukan');
        $divisiLabel = $this->labelMap[$divisi] ?? ucfirst($divisi);

        return view("$folder.$view", compact('data', 'jenis', 'divisi', 'divisiLabel', 'filterParams'));
    }

    public function create($jenis, $divisi)
    {
        $divisiLabel = $this->labelMap[$divisi] ?? ucfirst($divisi);

        $intervals = IntervalKalibrasi::select('nama_alat', 'interval_bulan')->get();

        if ($jenis === 'data-mesin') {
            return view('data_mesin_admin.dmlCreate', compact('divisi', 'divisiLabel', 'jenis', 'intervals'));
        } elseif ($jenis === 'alat-ukur') {
            return view('alat_ukur_admin.dauCreate', compact('divisi', 'divisiLabel', 'jenis', 'intervals'));
        }

        abort(404, 'Halaman tidak ditemukan');
    }

    public function store(Request $request, $jenis, $divisi)
    {
        $table = $this->getTableName($jenis, $divisi);
        $divisiLabel = $this->labelMap[$divisi] ?? ucfirst($divisi);

        $validated = $request->validate([
            'kodefikasi' => 'required|string',
            'nama_alat' => 'required|string',
            'merk_type' => 'nullable|string',
            'no_seri' => 'nullable|string',
            'range_alat' => 'nullable|string',
            'tgl_kalibrasi' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        // Mengambil Interval berdasarkan nama alat
        $intervalModel = IntervalKalibrasi::where('nama_alat', $validated['nama_alat'])->first();
        $intervalBulan = $intervalModel ? (int) $intervalModel->interval_bulan : 12;

        // Perhitungan kalibrasi selanjutnya
        $nextCalibration = null;
        if (!empty($validated['tgl_kalibrasi'])) {
            $nextCalibration = Carbon::parse($validated['tgl_kalibrasi'])
                ->addMonths($intervalBulan)
                ->toDateString();
        }

        $status = 'DONE';
        if ($nextCalibration && Carbon::parse($nextCalibration)->isPast()) {
            $status = 'RE CALL';
        }

        // Data Baru
        $data = [
            'kodefikasi' => $validated['kodefikasi'],
            'nama_alat' => $validated['nama_alat'],
            'merk_type' => $validated['merk_type'] ?? null,
            'no_seri' => $validated['no_seri'] ?? null,
            'range_alat' => $validated['range_alat'] ?? null,
            'tgl_kalibrasi' => $validated['tgl_kalibrasi'] ?? null,
            'kalibrasi_selanjutnya' => $nextCalibration,
            'status' => $status,
            'description' => $request->input('description', null),
        ];

        DB::table($table)->insert($data);

        return redirect()->route('admin.divisi', [$jenis, $divisi])
            ->with('success', "Data berhasil ditambahkan ke $divisiLabel dengan status $status");
    }

    public function edit($jenis, $divisi, $id)
    {
        $table = $this->getTableName($jenis, $divisi);
        $row = DB::table($table)->select('*')->find($id);
        $divisiLabel = $this->labelMap[$divisi] ?? ucfirst($divisi);

        if (!$row) {
            return redirect()->route('admin.divisi', [$jenis, $divisi])
                ->with('error', 'Data tidak ditemukan');
        }

        if ($jenis === 'data-mesin') {
            return view('data_mesin_admin.dmlEdit', compact('row', 'jenis', 'divisi', 'divisiLabel'));
        } elseif ($jenis === 'alat-ukur') {
            return view('alat_ukur_admin.dauEdit', compact('row', 'jenis', 'divisi', 'divisiLabel'));
        }

        abort(404, 'Halaman tidak ditemukan');
    }

    public function update(Request $request, $jenis, $divisi, $id)
    {
        $table = $this->getTableName($jenis, $divisi);
        $divisiLabel = $this->labelMap[$divisi] ?? ucfirst($divisi);

        $validated = $request->validate([
            'kodefikasi' => 'required|string',
            'nama_alat' => 'required|string',
            'merk_type' => 'nullable|string',
            'no_seri' => 'nullable|string',
            'range_alat' => 'nullable|string',
            'tgl_kalibrasi' => 'nullable|date',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $intervalModel = \App\Models\IntervalKalibrasi::where('nama_alat', $validated['nama_alat'])->first();
        $intervalBulan = $intervalModel ? (int) $intervalModel->interval_bulan : 12;

        $nextCalibration = null;
        if (!empty($validated['tgl_kalibrasi'])) {
            $nextCalibration = \Carbon\Carbon::parse($validated['tgl_kalibrasi'])
                ->addMonths($intervalBulan)
                ->toDateString();
        }

        $status = 'DONE';
        if ($nextCalibration && \Carbon\Carbon::parse($nextCalibration)->isPast()) {
            $status = 'RE CALL';
        }

        DB::table($table)->where('id', $id)->update([
            'kodefikasi' => $validated['kodefikasi'],
            'nama_alat' => $validated['nama_alat'],
            'merk_type' => $validated['merk_type'],
            'no_seri' => $validated['no_seri'],
            'range_alat' => $validated['range_alat'],
            'tgl_kalibrasi' => $validated['tgl_kalibrasi'],
            'kalibrasi_selanjutnya' => $nextCalibration,
            'status' => $status,
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.divisi', [$jenis, $divisi])
            ->with('success', "Data di $divisiLabel berhasil diupdate dan interval kalibrasi dihitung ulang.");
    }

    public function destroy($jenis, $divisi, $id)
    {
        $table = $this->getTableName($jenis, $divisi);
        $divisiLabel = $this->labelMap[$divisi] ?? ucfirst($divisi);

        $deleted = DB::table($table)->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->route('admin.divisi', [$jenis, $divisi])
                ->with('success', "Data di $divisiLabel berhasil dihapus");
        } else {
            return redirect()->route('admin.divisi', [$jenis, $divisi])
                ->with('error', "Data di $divisiLabel gagal dihapus atau tidak ditemukan");
        }
    }

    public function getChartData()
    {
        $divisi = ['rekum', 'kaprang', 'kapsel', 'harkan', 'kania'];

        $dataAlat = [];
        $dataMesin = [];

        foreach ($divisi as $d) {
            $totalAlat = DB::table("dau_$d")->count();
            $doneAlat = DB::table("dau_$d")->where('status', 'DONE')->count();
            $recalAlat = DB::table("dau_$d")->where('status', 'RE CALL')->count();
            $rusakAlat = DB::table("dau_$d")->where('status', 'RUSAK')->count();

            $totalMesin = DB::table("dml_$d")->count();
            $doneMesin = DB::table("dml_$d")->where('status', 'DONE')->count();
            $recalMesin = DB::table("dml_$d")->where('status', 'RE CALL')->count();
            $rusakMesin = DB::table("dml_$d")->where('status', 'RUSAK')->count();

            $label = $this->labelMap[$d] ?? ucfirst($d);

            $dataAlat[] = [
                'divisi' => $label,
                'total' => $totalAlat,
                'done' => $doneAlat,
                'recal' => $recalAlat,
                'rusak' => $rusakAlat,
            ];

            $dataMesin[] = [
                'divisi' => $label,
                'total' => $totalMesin,
                'done' => $doneMesin,
                'recal' => $recalMesin,
                'rusak' => $rusakMesin,
            ];
        }

        return response()->json([
            'alat' => $dataAlat,
            'mesin' => $dataMesin,
        ]);
    }

    private function getTableName($jenis, $divisi)
    {
        if ($jenis === 'data-mesin') {
            return "dml_" . $divisi;
        } elseif ($jenis === 'alat-ukur') {
            return "dau_" . $divisi;
        }

        abort(404, "Jenis $jenis tidak dikenali");
    }
}