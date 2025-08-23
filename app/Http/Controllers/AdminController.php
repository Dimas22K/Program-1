<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
            ->where('password', $request->password) // ⚠️ sebaiknya pakai hash
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
    public function index($jenis, $divisi)
    {
        $table = $this->getTableName($jenis, $divisi);
        $data = DB::table($table)->paginate(20);

        // tentukan folder & file view sesuai struktur
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

        return view("$folder.$view", compact('data', 'jenis', 'divisi'));
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
        DB::table($table)->insert($request->except('_token'));
        return redirect()->route('admin.divisi', [$jenis, $divisi])
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($jenis, $divisi, $id)
    {
        $table = $this->getTableName($jenis, $divisi);
        $row = DB::table($table)->find($id);

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
        DB::table($table)->where('id', $id)->update($request->except('_token', '_method'));
        return redirect()->route('admin.divisi', [$jenis, $divisi])
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($jenis, $divisi, $id)
    {
        $table = $this->getTableName($jenis, $divisi);
        DB::table($table)->where('id', $id)->delete();
        return redirect()->route('admin.divisi', [$jenis, $divisi])
            ->with('success', 'Data berhasil dihapus');
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
}
