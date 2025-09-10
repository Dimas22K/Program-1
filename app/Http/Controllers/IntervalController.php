<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IntervalKalibrasi; // pakai model yang benar

class IntervalController extends Controller
{
    // tampilkan semua data
    public function index()
    {
        $intervals = IntervalKalibrasi::all();
        return view('interval.index', compact('intervals'));
    }

    // form tambah data
    public function create()
    {
        return view('interval.create');
    }

    // simpan data baru
    public function store(Request $request)
    {
        IntervalKalibrasi::create([
            'nama_alat' => $request->nama_alat,
            'interval_bulan' => $request->interval_bulan,
        ]);

        return redirect()->route('interval.index')->with('success', 'Data berhasil ditambahkan');
    }

    // form edit data
    public function edit($id)
    {
        $interval = IntervalKalibrasi::findOrFail($id);
        return view('interval.edit', compact('interval'));
    }

    // update data
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_alat' => 'required|string|max:255',
        'interval_bulan' => 'required|integer',
    ]);

    $interval = IntervalKalibrasi::findOrFail($id);
    $interval->nama_alat = $request->nama_alat;
    $interval->interval_bulan = $request->interval_bulan;
    $interval->save();

    return redirect()->route('interval.index')->with('success', 'Data berhasil diupdate!');
}


    // hapus data
    public function destroy($id)
    {
        $interval = IntervalKalibrasi::findOrFail($id);
        $interval->delete();

        return redirect()->route('interval.index')->with('success', 'Data berhasil dihapus');
    }
}
