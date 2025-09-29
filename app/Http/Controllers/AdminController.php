<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    // =========================
    // 🔧 Mapping Divisi → Label Baru
    // =========================
    private $labelMap = [
        'kania'  => 'Merchant Div',
        'kapsel' => 'Submarine Div',
        'kaprang'=> 'War Ship Div',
        'rekum'  => 'General Eng. Div',
        'harkan' => 'MRO Div',
    ];

    // =========================
    // 👨‍💼 CRUD DATA MESIN / ALAT UKUR PER DIVISI
    // =========================
    public function index($jenis, $divisi, Request $request)
    {
        $table = $this->getTableName($jenis, $divisi);

        // ambil semua kolom termasuk description
        $query = DB::table($table)->select('*');

        // 🔍 FILTERS
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('kodefikasi', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nama_alat', 'like', '%' . $searchTerm . '%')
                  ->orWhere('merk_type', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%'); // ✅ ikut difilter
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
            'search'    => $request->search,
            'tgl_mulai' => $request->tgl_mulai,
            'status'    => $request->status,
        ];

        $folder = $jenis === 'data-mesin' ? 'data_mesin_admin' : 'alat_ukur_admin';
        $mapView = [
            'data-mesin' => [
                'kania'  => 'dmlKaniaAdmin',
                'kapsel' => 'dmlKapselAdmin',
                'kaprang'=> 'dmlKaprangAdmin',
                'harkan' => 'dmlHarkanAdmin',
                'rekum'  => 'dmlRekumAdmin',
            ],
            'alat-ukur' => [
                'kania'  => 'dauKaniaAdmin',
                'kapsel' => 'dauKapselAdmin',
                'kaprang'=> 'dauKaprangAdmin',
                'harkan' => 'dauHarkanAdmin',
                'rekum'  => 'dauRekumAdmin',
            ],
        ];

        $view = $mapView[$jenis][$divisi] ?? abort(404, 'View tidak ditemukan');
        $divisiLabel = $this->labelMap[$divisi] ?? ucfirst($divisi);

        return view("$folder.$view", compact('data', 'jenis', 'divisi', 'divisiLabel', 'filterParams'));
    }

    public function create($jenis, $divisi)
    {
        $divisiLabel = $this->labelMap[$divisi] ?? ucfirst($divisi);

        if ($jenis === 'data-mesin') {
            return view('data_mesin_admin.dmlCreate', compact('divisi', 'divisiLabel', 'jenis'));
        } elseif ($jenis === 'alat-ukur') {
            return view('alat_ukur_admin.dauCreate', compact('divisi', 'divisiLabel', 'jenis'));
        }

        abort(404, 'Halaman tidak ditemukan');
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
            'kodefikasi'             => 'required|string|max:50',
            'nama_alat'              => 'required|string|max:100',
            'merk_type'              => 'nullable|string|max:100',
            'no_seri'                => 'nullable|string|max:50',
            'range_alat'             => 'nullable|string|max:50',
            'tgl_kalibrasi'          => 'nullable|date',
            'kalibrasi_selanjutnya'  => 'nullable|date',
            'status'                 => 'required|string',
            'description'            => 'nullable|string', // ✅ wajib ada
        ]);

        DB::table($table)->where('id', $id)->update($validated);

        return redirect()->route('admin.divisi', [$jenis, $divisi])
            ->with('success', "Data di $divisiLabel berhasil diupdate");
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

    // =========================
    // 📊 DATA UNTUK CHART
    // =========================
    public function getChartData()
    {
        $divisi = ['rekum', 'kaprang', 'kapsel', 'harkan', 'kania'];

        $dataAlat = [];
        $dataMesin = [];

        foreach ($divisi as $d) {
            $totalAlat   = DB::table("dau_$d")->count();
            $doneAlat    = DB::table("dau_$d")->where('status', 'DONE')->count();
            $recalAlat   = DB::table("dau_$d")->where('status', 'RE CAL')->count();
            $rusakAlat   = DB::table("dau_$d")->where('status', 'RUSAK')->count();

            $totalMesin  = DB::table("dml_$d")->count();
            $doneMesin   = DB::table("dml_$d")->where('status', 'DONE')->count();
            $recalMesin  = DB::table("dml_$d")->where('status', 'RE CAL')->count();
            $rusakMesin  = DB::table("dml_$d")->where('status', 'RUSAK')->count();

            $label = $this->labelMap[$d] ?? ucfirst($d);

            $dataAlat[] = [
                'divisi' => $label,
                'total'  => $totalAlat,
                'done'   => $doneAlat,
                'recal'  => $recalAlat,
                'rusak'  => $rusakAlat,
            ];

            $dataMesin[] = [
                'divisi' => $label,
                'total'  => $totalMesin,
                'done'   => $doneMesin,
                'recal'  => $recalMesin,
                'rusak'  => $rusakMesin,
            ];
        }

        return response()->json([
            'alat'  => $dataAlat,
            'mesin' => $dataMesin,
        ]);
    }

    // =========================
    // 🔧 Helper: Tentukan nama tabel
    // =========================
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
