<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_pelatih = Auth::guard('admin')->user()->id_pelatih;

        $ekstrakurikuler = Ekstrakurikuler::where('id_pelatih', $id_pelatih)->first();

        if (!$ekstrakurikuler) {
            // Jika ekstrakurikuler tidak ditemukan, gunakan abort
            abort(403);
        }

        $id_ekstra = $ekstrakurikuler->id_ekstra;

        $pertemuan = Pertemuan::where('id_ekstra',$id_ekstra)->latest()->get();

        return view('Admin.Validasi.index', ['pertemuan' => $pertemuan]);
    }
    /**
     * Show the form for creating a new resource.
     */

    public function validasi(Request $request, $id_pertemuan)
    {
        // Mendapatkan data pertemuan yang diklik
        $pertemuan = Pertemuan::findOrFail($id_pertemuan);

        // Memeriksa apakah pelatih yang sedang login memiliki akses ke pertemuan ini
        $id_pelatih = Auth::guard('admin')->user()->id_pelatih;
        if ($pertemuan->ekstrakurikuler->id_pelatih !== $id_pelatih) {
            abort(403, 'Anda tidak memiliki akses ke pertemuan ini.');
        }

        // Mendapatkan data presensi yang memiliki status "proses" dan terkait dengan pertemuan yang diklik
        $query = Presensi::where('id_pertemuan', $id_pertemuan)
            ->where('status', 'proses');

        // Mengecek apakah ada pencarian berdasarkan nama siswa
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('siswa', function ($query) use ($search) {
                $query->where('nama', 'like', "%$search%");
            });
        }

        // Mengambil data presensi
        $presensi = $query->get();

        // Kirim data presensi ke view validasi
        return view('Admin.Validasi.validasi', ['presensi' => $presensi, 'id_pertemuan'=>$id_pertemuan] );



        // Kirim data presensi ke view validasi
        return view('Admin.Validasi.validasi', ['presensi' => $presensi]);
    }


    public function terima(Request $request, $id_presensi)
    {
        // Temukan presensi berdasarkan id_presensi
        $presensi = Presensi::findOrFail($id_presensi);



        // Ubah status presensi menjadi "diterima" dengan metode update
        $presensi->update(['status' => 'diterima']);

        // Redirect atau kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Presensi berhasil diterima.');
    }

    public function tolak(Request $request, $id_presensi)
    {
        // Temukan presensi berdasarkan id_presensi
        $presensi = Presensi::findOrFail($id_presensi);



        // Ubah status presensi menjadi "ditolak" dengan metode update
        $presensi->update(['status' => 'ditolak']);

        // Redirect atau kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Presensi berhasil ditolak.');
    }


    public function searchPertemuan(Request $request)
    {
        // Ambil id pelatih yang sedang login
        $id_pelatih = Auth::guard('admin')->user()->id_pelatih;

        // Ambil ekstrakurikuler yang dilatih oleh pelatih tersebut
        $ekstrakurikuler = Ekstrakurikuler::where('id_pelatih', $id_pelatih)->pluck('id_ekstra');

        // Query awal pertemuan
        $query = Pertemuan::whereIn('id_ekstra', $ekstrakurikuler);

        // Cek apakah ada query pencarian
        if ($request->has('searchPertemuan')) {
            // Ambil keyword pencarian
            $keyword = $request->input('searchPertemuan');

            // Jika keyword pencarian tidak kosong, lakukan pencarian
            if (!empty($keyword)) {

                $query->where(function ($query) use ($keyword) {
                    $query->where('judul_pertemuan', 'like', "%$keyword%")
                        ->orWhere('kegiatan', 'like', "%$keyword%");
                });
            }
        }

        // Ambil pertemuan yang terkait dengan ekstrakurikuler yang dilatih oleh pelatih tersebut
        $pertemuan = $query->latest()->get();

        return view('Admin.Validasi.index', ['pertemuan' => $pertemuan]);
    }

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
