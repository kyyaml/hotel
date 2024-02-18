<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Pertemuan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('Admin.Laporan.index', ['ekstrakurikuler' => $ekstrakurikuler]);
    }

    public function pilihLaporan($id_ekstra)
    {
        return view('Admin.Laporan.pilihLaporan', ['id_ekstra' => $id_ekstra]);
    }

    public function laporanKegiatan($id_ekstra)
    {
        return view('Admin.Laporan.laporanKegiatan', ['id_ekstra' => $id_ekstra]);
    }

    public function cariKegiatan(Request $request, $id_ekstra)
    {
        // Ambil nilai dari input tanggal pertama dan kedua
        $start = $request->input('start');
        $end = $request->input('end');

        // Query untuk mencari pertemuan berdasarkan tanggal dan ID ekstrakurikuler
        $pertemuan = Pertemuan::where('id_ekstra', $id_ekstra)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        // Kirim data pertemuan yang ditemukan ke view
        return view('Admin.Laporan.laporanKegiatan', ['pertemuan' => $pertemuan,'id_ekstra' => $id_ekstra]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
