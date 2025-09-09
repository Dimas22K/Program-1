<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\IntervalKalibrasi;


class AdminController extends Controller
{
    // =========================
    // 🔑 AUTH (login, logout, dashboard)
    // =========================
    public function showLogin()
    {
        return view('admin.login'); 
    }

    public function login(Request $request)
    {
        $admin = DB::table('admins')
            ->where('nama', $request->nama)
            ->where('password', $request->password) 
            ->first();

        if ($admin) {
            Session::put('admin_id', $admin->id);
            Session::put('admin_nama', $admin->nama);
            return redirect()->route('admin')->with('success', 'Login berhasil');
        } else {
            return redirect()->back()->with('error', 'Nama atau Password salah');
        }
    }

    public function dashboard()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('login')->with('error', 'Silakan login dulu');
        }
        return view('admin.dashboard'); 
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }

    // =========================
    // 👨‍💼 CRUD DATA MESIN / ALAT UKUR PER DIVISI
    // =========================
    public function index($jenis, $divisi, Request $request)
    {
        $table = $this->getTableName($jenis, $divisi);
        
        // Mulai query dengan filter
        $query = DB::table($table);
        
        // 🔍 FILTER: Search (kodefikasi, nama alat, merk/type)
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('kodefikasi', 'like', '%'.$searchTerm.'%')
                  ->orWhere('nama_alat', 'like', '%'.$searchTerm.'%')
                  ->orWhere('merk_type', 'like', '%'.$searchTerm.'%');
            });
        }
        
        // 📅 FILTER: Tanggal Kalibrasi (mulai dari)
        if ($request->has('tgl_mulai') && !empty($request->tgl_mulai)) {
            $query->where('tgl_kalibrasi', '>=', $request->tgl_mulai);
        }
        
        // 🟢 FILTER: Status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        
        // Order by id secara default
        $query->orderBy('id', 'asc');
        
        $data = $query->paginate(20);
        
        // Simpan parameter filter untuk keperluan view
        $filterParams = [
            'search' => $request->search,
            'tgl_mulai' => $request->tgl_mulai,
            'status' => $request->status
        ];

        // Tentukan folder & file view sesuai struktur
        $folder = $jenis === 'data-mesin' ? 'data_mesin_admin' : 'alat_ukur_admin';

        $mapView = [
            'data-mesin' => [
                'kania'   => 'dmlKaniaAdmin',
                'kapsel'  => 'dmlKapselAdmin',
                'kaprang' => 'dmlKaprangAdmin',
                'harkan'  => 'dmlHarkanAdmin',
                'rekum'   => 'dmlRekumAdmin',
            ],
            'alat-ukur' => [
                'kania'   => 'dauKaniaAdmin',
                'kapsel'  => 'dauKapselAdmin',
                'kaprang' => 'dauKaprangAdmin',
                'harkan'  => 'dauHarkanAdmin',
                'rekum'   => 'dauRekumAdmin',
            ]
        ];

        $view = $mapView[$jenis][$divisi] ?? abort(404, 'View tidak ditemukan');

        return view("$folder.$view", compact('data', 'jenis', 'divisi', 'filterParams'));
    }

    public function create($jenis, $divisi)
    {
        if ($jenis === 'data-mesin') {
            return view('data_mesin_admin.dmlCreate', compact('divisi', 'jenis'));
        } elseif ($jenis === 'alat-ukur') {
            return view('alat_ukur_admin.dauCreate', compact('divisi', 'jenis'));
        }

        abort(404, 'Halaman tidak ditemukan');
    }

public function store(Request $request, $jenis, $divisi)
{
    $table = $this->getTableName($jenis, $divisi);

    // Validasi input (tanpa kalibrasi_selanjutnya & status karena otomatis)
    $request->validate([
        'kodefikasi' => 'required',
        'nama_alat' => 'required',
        'merk_type' => 'required',
        'no_seri' => 'required',
        'range_alat' => 'required',
        'tgl_kalibrasi' => 'required|date',
    ]);

    // Ambil interval dari tabel referensi
    $interval = IntervalKalibrasi::where('nama_alat', $request->nama_alat)
        ->value('interval_bulan') ?? 6;

    // Hitung kalibrasi selanjutnya
    $tglKalibrasi = $request->tgl_kalibrasi ? Carbon::parse($request->tgl_kalibrasi) : null;
    $kalibrasiSelanjutnya = $tglKalibrasi ? $tglKalibrasi->copy()->addMonths($interval) : null;

    // ✅ Tentukan status otomatis (per tanggal, bukan jam)
    // - null/ kosong  -> RUSAK
    // - < hari ini    -> RE CAL (sudah lewat)
    // - >= hari ini   -> DONE   (masih/tepat hari ini)
    if (!$kalibrasiSelanjutnya) {
        $status = 'RUSAK';
    } elseif ($kalibrasiSelanjutnya->lt(Carbon::today())) {
        $status = 'RE CAL';
    } else {
        $status = 'DONE';
    }
    // Simpan ke database
    DB::table($table)->insert([
    'kodefikasi'              => $request->kodefikasi,
    'nama_alat'               => $request->nama_alat,
    'merk_type'               => $request->merk_type,
    'no_seri'                 => $request->no_seri,
    'range_alat'              => $request->range_alat,
    'tgl_kalibrasi'           => $request->tgl_kalibrasi,
    'kalibrasi_selanjutnya'   => $kalibrasiSelanjutnya ? $kalibrasiSelanjutnya->toDateString() : null,
    'status'                  => $status,
    ]);


    return redirect()->route('admin.divisi', [$jenis, $divisi])
        ->with('success', 'Data berhasil ditambahkan');
}

    public function edit($jenis, $divisi, $id)
    {
        $table = $this->getTableName($jenis, $divisi);
        $row = DB::table($table)->find($id);

        if (!$row) {
            return redirect()->route('admin.divisi', [$jenis, $divisi])
                ->with('error', 'Data tidak ditemukan');
        }

        if ($jenis === 'data-mesin') {
            return view('data_mesin_admin.dmlEdit', compact('row', 'jenis', 'divisi'));
        } elseif ($jenis === 'alat-ukur') {
            return view('alat_ukur_admin.dauEdit', compact('row', 'jenis', 'divisi'));
        }

        abort(404, 'Halaman tidak ditemukan');
    }

public function update(Request $request, $jenis, $divisi, $id)
{
    $table = $this->getTableName($jenis, $divisi);

    // Validasi input (tanpa kalibrasi_selanjutnya & status karena otomatis)
    $request->validate([
        'kodefikasi' => 'required',
        'nama_alat' => 'required',
        'merk_type' => 'required',
        'no_seri' => 'nullable',
        'range_alat' => 'nullable',
        'tgl_kalibrasi' => 'required|date',
    ]);

    // Ambil interval dari tabel referensi
    $interval = IntervalKalibrasi::where('nama_alat', $request->nama_alat)
        ->value('interval_bulan') ?? 6;

    // Hitung kalibrasi selanjutnya
    $tglKalibrasi = $request->tgl_kalibrasi ? Carbon::parse($request->tgl_kalibrasi) : null;
    $kalibrasiSelanjutnya = $tglKalibrasi ? $tglKalibrasi->copy()->addMonths($interval) : null;

    // ✅ Tentukan status otomatis (per tanggal, bukan jam)
    if (!$kalibrasiSelanjutnya) {
        $status = 'RUSAK';
    } elseif ($kalibrasiSelanjutnya->lt(Carbon::today())) {
        $status = 'RE CAL';
    } else {
        $status = 'DONE';
    }


    // Update ke database
    DB::table($table)->where('id', $id)->update([
    'kodefikasi'              => $request->kodefikasi,
    'nama_alat'               => $request->nama_alat,
    'merk_type'               => $request->merk_type,
    'no_seri'                 => $request->no_seri,
    'range_alat'              => $request->range_alat,
    'tgl_kalibrasi'           => $request->tgl_kalibrasi,
    'kalibrasi_selanjutnya'   => $kalibrasiSelanjutnya ? $kalibrasiSelanjutnya->toDateString() : null,
    'status'                  => $status,
]);


    return redirect()->route('admin.divisi', [$jenis, $divisi])
        ->with('success', 'Data berhasil diupdate');
}



    public function destroy($jenis, $divisi, $id)
    {
        $table = $this->getTableName($jenis, $divisi);
        
        $deleted = DB::table($table)->where('id', $id)->delete();
        
        if ($deleted) {
            return redirect()->route('admin.divisi', [$jenis, $divisi])
                ->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('admin.divisi', [$jenis, $divisi])
                ->with('error', 'Data gagal dihapus atau tidak ditemukan');
        }
    }

    // =========================
    // 🔧 Helper mapping table
    // =========================
    private function getTableName($jenis, $divisi)
    {
        $map = [
            'data-mesin' => [
                'kania' => 'dml_kania',
                'kapsel' => 'dml_kapsel',
                'kaprang' => 'dml_kaprang',
                'harkan' => 'dml_harkan',
                'rekum' => 'dml_rekum',
            ],
            'alat-ukur' => [
                'kania' => 'dau_kania',
                'kapsel' => 'dau_kapsel',
                'kaprang' => 'dau_kaprang',
                'harkan' => 'dau_harkan',
                'rekum' => 'dau_rekum',
            ]
        ];

        return $map[$jenis][$divisi] ?? abort(404, 'Tabel tidak ditemukan');
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
        // Hitung alat ukur
        $totalAlat = DB::table("dau_$d")->count();
        $doneAlat = DB::table("dau_$d")->where('status', 'DONE')->count();
        $recalAlat = DB::table("dau_$d")->where('status', 'RE CAL')->count();
        $rusakAlat = DB::table("dau_$d")->where('status', 'RUSAK')->count();

        // Hitung mesin las
        $totalMesin = DB::table("dml_$d")->count();
        $doneMesin = DB::table("dml_$d")->where('status', 'DONE')->count();
        $recalMesin = DB::table("dml_$d")->where('status', 'RE CAL')->count();
        $rusakMesin = DB::table("dml_$d")->where('status', 'RUSAK')->count();

        $dataAlat[] = [
            'divisi' => ucfirst($d),
            'total' => $totalAlat,
            'done' => $doneAlat,
            'recal' => $recalAlat,
            'rusak' => $rusakAlat
        ];

        $dataMesin[] = [
            'divisi' => ucfirst($d),
            'total' => $totalMesin,
            'done' => $doneMesin,
            'recal' => $recalMesin,
            'rusak' => $rusakMesin
        ];
    }

    return response()->json([
        'alat' => $dataAlat,
        'mesin' => $dataMesin
    ]);
}
}