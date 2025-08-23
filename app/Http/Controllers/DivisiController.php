<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisiController extends Controller
{
    public function index($jenis, $divisi)
    {
        // Normalisasi: ganti minus (-) jadi underscore (_)
        $jenis = str_replace('-', '_', $jenis);
    }

    public function show($jenis, $divisi, Request $request)
    {
        // Normalisasi input dari URL
        $jenis  = strtolower($jenis);   // data-mesin | alat-ukur
        $divisi = strtolower($divisi);  // kania | kapsel | kaprang | harkan | rekum

        // Validasi sederhana
        $allowedJenis  = ['data-mesin', 'alat-ukur'];
        $allowedDivisi = ['kania', 'kapsel', 'kaprang', 'harkan', 'rekum'];
        if (!in_array($jenis, $allowedJenis) || !in_array($divisi, $allowedDivisi)) {
            abort(404);
        }

        // Tentukan prefix tabel & nama tabel
        $prefix = $jenis === 'data-mesin' ? 'dml' : 'dau';
        $table  = "{$prefix}_{$divisi}";    // contoh: dml_kania, dau_harkan, dst.

        // Ambil data dari tabel sesuai
        $query = DB::table($table);

        // 🔹 Gabungkan semua filter jadi satu blok
        $query->where(function($q) use ($request) {

            // --- Filter by Search (gabungan kodefikasi, nama_alat, merk_type) ---
            if ($request->filled('search')) {
                $search = $request->search;
                $q->where(function($qq) use ($search) {
                    $qq->where('kodefikasi', 'like', "%{$search}%")
                       ->orWhere('nama_alat', 'like', "%{$search}%")
                       ->orWhere('merk_type', 'like', "%{$search}%");
                });
            }

            // --- Filter by Status ---
            if ($request->filled('status')) {
                $q->where('status', $request->status);
            }

            // --- Filter tanggal kalibrasi (hanya tgl_mulai) ---
            if ($request->filled('tgl_mulai')) {
                $q->whereDate('tgl_kalibrasi', $request->tgl_mulai);
            }

        });

        // Pakai paginate supaya view yang pakai $data->links() tetap jalan
        $data = $query->paginate(20)->appends($request->all());

        // Tentukan view sesuai folder & nama file yang kamu punya
        $view = $jenis === 'data-mesin'
            ? "data_mesin.dml" . ucfirst($divisi)
            : "alat_ukur.dau" . ucfirst($divisi);

        if (!view()->exists($view)) {
            abort(404, "View {$view}.blade.php tidak ditemukan.");
        }

        return view($view, compact('data', 'jenis', 'divisi'));
    }
}
