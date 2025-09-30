<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Menggunakan DB::table
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class InstrumentsExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $request;
    protected $tableName; // Variabel untuk menyimpan nama tabel

    /**
     * Menerima request (untuk filter) dan nama tabel dari Controller.
     */
    public function __construct(Request $request, string $tableName)
    {
        $this->request = $request;
        $this->tableName = $tableName;
    }

    /**
     * Method yang menentukan query untuk mengambil data.
     * Menggunakan DB::table() agar sesuai dengan Controller Anda.
     */
    public function query()
    {
        // Menggunakan DB::table() dengan nama tabel dinamis
        $query = DB::table($this->tableName)->select(
            'id', 'kodefikasi', 'nama_alat', 'merk_type',
            'no_seri', 'range_alat', 'tgl_kalibrasi',
            'kalibrasi_selanjutnya', 'status', 'description'
        );

        // --- Menerapkan Logika Filter dari Request (Sama seperti index) ---
        
        if ($this->request->filled('search')) {
            $search = $this->request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('kodefikasi', 'like', "%{$search}%")
                  ->orWhere('nama_alat', 'like', "%{$search}%")
                  ->orWhere('merk_type', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($this->request->filled('tgl_mulai')) {
            $query->whereDate('tgl_kalibrasi', '>=', $this->request->input('tgl_mulai'));
        }

        if ($this->request->filled('status')) {
            $query->where('status', $this->request->input('status'));
        }

        return $query->orderBy('id', 'asc');
    }

    /**
     * Method untuk menentukan header kolom di file Excel.
     */
    public function headings(): array
    {
        return [
            'No',
            'Codification',
            'Machine Name',
            'Brand / Type',
            'Serial Number',
            'Range',
            'Date',
            'Due Date',
            'Status',
            'Description'
        ];
    }
}
