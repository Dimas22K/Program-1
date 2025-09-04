<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KemampuanLabController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel kemampuan_lab
        $data = DB::table('kemampuan_lab')
            ->select('No', 'Kelompok_Pengukuran', 'alat_ukur', 'rentang_ukur')
            ->orderBy('No')
            ->paginate(20);

        // Tampilkan ke view
        return view('kemampuanLab', compact('data'));
    }

    public function indexAdmin()
    {
        $data = DB::table('kemampuan_lab')
            ->select('No', 'Kelompok_Pengukuran', 'alat_ukur', 'rentang_ukur')
            ->orderBy('No')
            ->paginate(20);

        return view('kemampuanLabAdmin', compact('data')); // untuk admin
    }
}