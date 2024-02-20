<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportAbsen;
use App\Exports\ExportKegiatan;
use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Pertemuan;
use App\Models\Presensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPelatihController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.LaporanPelatih.index');
    }


    public function laporanKegiatan()
    {
        $id_pelatih = Auth::guard('admin')->user()->id_pelatih;
        $ekstrakurikuler = Ekstrakurikuler::where('id_pelatih', $id_pelatih)->first();

        $id_ekstra = $ekstrakurikuler->id_ekstra;

        return view('Admin.LaporanPelatih.laporanKegiatan' , ['id_ekstra'=>$id_ekstra]);

    }

    public function cariKegiatan(Request $request)
    {

        
        $start = $request->input('start');
        $end = $request->input('end');

        $id_pelatih = Auth::guard('admin')->user()->id_pelatih;

        $ekstrakurikuler = Ekstrakurikuler::where('id_pelatih', $id_pelatih)->first();


        $id_ekstra = $ekstrakurikuler->id_ekstra;

        // Query untuk mencari pertemuan berdasarkan tanggal dan ID ekstrakurikuler
        $pertemuan = Pertemuan::where('id_ekstra', $id_ekstra)
            ->whereBetween('tgl_pertemuan', [$start, $end])
            ->get();

        // Kirim data pertemuan yang ditemukan ke view
        return view('Admin.LaporanPelatih.laporanKegiatan', ['pertemuan' => $pertemuan, 'id_ekstra' => $id_ekstra, 'start' => $start, 'end' => $end]);

    }

    
    public function exportLaporanKegiatan($id_ekstra, $start, $end)
    {
        $pertemuan = Pertemuan::where('id_ekstra', $id_ekstra)
            ->whereBetween('tgl_pertemuan', [$start, $end])
            ->get();

        return Excel::download(new ExportKegiatan($pertemuan), 'kegiatan.xlsx');
    }

    public function laporanAbsen()
    {
        $id_pelatih = Auth::guard('admin')->user()->id_pelatih;
        $ekstrakurikuler = Ekstrakurikuler::where('id_pelatih', $id_pelatih)->first();

        $id_ekstra = $ekstrakurikuler->id_ekstra;

        return view('Admin.LaporanPelatih.laporanAbsen' , ['id_ekstra'=>$id_ekstra]);
    }


    public function cariAbsen(Request $request)
    {
        // Ambil nilai dari input tanggal pertama dan kedua
    $start = $request->input('start');
    $end = $request->input('end');

    $id_pelatih = Auth::guard('admin')->user()->id_pelatih;
    $ekstrakurikuler = Ekstrakurikuler::where('id_pelatih', $id_pelatih)->first();

    $id_ekstra = $ekstrakurikuler->id_ekstra;

    // Ambil semua siswa yang terdaftar dalam ekstrakurikuler tertentu
    $siswa = Siswa::whereHas('ekstrakurikuler', function ($query) use ($id_ekstra) {
        $query->where('ekstrakurikuler.id_ekstra', $id_ekstra);
    })->get();


    // Ambil semua pertemuan yang terkait dengan ekstrakurikuler tersebut
    $pertemuan = Pertemuan::where('id_ekstra', $id_ekstra)
    ->whereBetween('tgl_pertemuan', [$start, $end])
    ->get();

    // Ambil semua presensi dengan keterangan "hadir" dan status "diterima" 

    // yang memiliki id pertemuan yang sesuai dan rentang tanggal yang diminta
    $presensi = Presensi::whereHas('pertemuan', function ($query) use ($id_ekstra) {
        $query->where('id_ekstra', $id_ekstra);
    })->where('keterangan', 'hadir')
      ->where('status', 'diterima')
      ->whereBetween(DB::raw("DATE(created_at)"), [$start, $end])
      ->get();

    // Menghitung jumlah kehadiran masing-masing siswa
    $jumlahKehadiran = [];
    foreach ($siswa as $student) {
        $jumlahKehadiran[$student->nama] = $presensi->where('nis', $student->nis)
        ->count();
    }

    $jumlahPertemuan = $pertemuan->count();

    // Contoh penggunaan:
    return view('Admin.LaporanPelatih.laporanAbsen', [
        'siswa' => $siswa,
        'jumlahKehadiran' => $jumlahKehadiran,
        'jumlahPertemuan' => $jumlahPertemuan,
        'id_ekstra' =>$id_ekstra,
        'start' => $start,
        'end' => $end,
    ]);
     
    }

    public function exportLaporanAbsen($id_ekstra, $start, $end)
    {
        // Ambil semua siswa yang terdaftar dalam ekstrakurikuler tertentu
        $siswa = Siswa::whereHas('ekstrakurikuler', function ($query) use ($id_ekstra) {
            $query->where('ekstrakurikuler.id_ekstra', $id_ekstra);
        })->get();


        // Ambil semua pertemuan yang terkait dengan ekstrakurikuler tersebut
        $pertemuan = Pertemuan::where('id_ekstra', $id_ekstra)
            ->whereBetween('tgl_pertemuan', [$start, $end])
            ->get();

        
        // Ambil semua presensi dengan keterangan "hadir" dan status "diterima" 

        // yang memiliki id pertemuan yang sesuai dan rentang tanggal yang diminta
        $presensi = Presensi::whereHas('pertemuan', function ($query) use ($id_ekstra) {
            $query->where('id_ekstra', $id_ekstra);
        })->where('keterangan', 'hadir')
            ->where('status', 'diterima')
            ->whereBetween(DB::raw("DATE(created_at)"), [$start, $end])
            ->get();

        // Menghitung jumlah kehadiran masing-masing siswa
        $jumlahKehadiran = [];
        foreach ($siswa as $student) {
            $jumlahKehadiran[$student->nama] = $presensi->where('nis', $student->nis)
                ->count();
        }

        $jumlahPertemuan = $pertemuan->count();

        // Return hasil ekspor menggunakan kelas ExportAbsen
        return Excel::download(new ExportAbsen($siswa, $jumlahKehadiran, $jumlahPertemuan), 'absen.xlsx');
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
