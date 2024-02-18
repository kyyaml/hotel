<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\MemberEkstra;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnggotaEkstraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dapatkan ID pelatih yang sedang login menggunakan guard 'admin'
        $id_pelatih = auth()->guard('admin')->user()->id_pelatih;

        // Temukan ekstrakurikuler yang terkait dengan ID pelatih yang sedang login
        $ekstrakurikuler = Ekstrakurikuler::where('id_pelatih', $id_pelatih)->first();

        // Pastikan ekstrakurikuler ditemukan
        if (!$ekstrakurikuler || $ekstrakurikuler->id_pelatih != $id_pelatih) {
            // Jika ekstrakurikuler tidak ditemukan atau tidak sesuai dengan pelatih yang sedang login, gunakan abort
            abort(403, 'Akses Ditolak');
        }

        // Dapatkan ID ekstrakurikuler
        $id_ekstra = $ekstrakurikuler->id_ekstra;

        // Dapatkan daftar siswa yang terdaftar pada ekstrakurikuler yang dilatih oleh pelatih
        $siswa = $ekstrakurikuler->siswa;

        // Tampilkan data siswa
        return view('Admin.Anggota.index', ['siswa' => $siswa, 'ekstrakurikuler' => $ekstrakurikuler, 'id_ekstra' => $id_ekstra]);
    }


    public function searchAnggota(Request $request){
        
        $query = $request->input('searchAnggota');

        $id_pelatih = auth()->guard('admin')->user()->id_pelatih;

        $ekstrakurikuler = Ekstrakurikuler::where('id_pelatih', $id_pelatih)->first();

        if (!$ekstrakurikuler || $ekstrakurikuler->id_pelatih != $id_pelatih) {
            // Jika ekstrakurikuler tidak ditemukan atau tidak sesuai dengan pelatih yang sedang login, gunakan abort
            abort(403, 'Akses Ditolak');
        }

        $id_ekstra = $ekstrakurikuler->id_ekstra;

        $siswa = $ekstrakurikuler->siswa()->where('nama', 'like', '%' . $query . '%')->get();

        return view('Admin.Anggota.index', ['siswa' => $siswa, 'ekstrakurikuler' => $ekstrakurikuler, 'id_ekstra' => $id_ekstra]);

    }

    public function searchNamaSiswa(Request $request)
    {
        $search = $request->input('searchSiswa');
        // Dapatkan ID pelatih yang sedang login menggunakan guard 'admin'
        $id_pelatih = auth()->guard('admin')->user()->id_pelatih;

        // Temukan ekstrakurikuler yang terkait dengan ID pelatih yang sedang login
        $ekstrakurikuler = Ekstrakurikuler::where('id_pelatih', $id_pelatih)->first();

        // Pastikan ekstrakurikuler ditemukan
        if (!$ekstrakurikuler) {
            // Jika ekstrakurikuler tidak ditemukan, gunakan abort
            abort(403, 'Akses Ditolak');
        }

        $id_ekstra = $ekstrakurikuler->id_ekstra;

        // Dapatkan daftar siswa yang belum terdaftar pada ekstrakurikuler yang dilatih oleh pelatih
        $siswa = Siswa::whereDoesntHave('ekstrakurikuler', function ($query) use ($id_ekstra) {
            $query->where('ekstrakurikuler.id_ekstra', $id_ekstra);
        })->where('nama', 'like', "%$search%")->get();

        // Tampilkan halaman tambah member ekstrakurikuler dengan daftar siswa yang belum terdaftar
        return view('Admin.Anggota.create', ['siswa' => $siswa, 'ekstrakurikuler'=>$ekstrakurikuler]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Dapatkan ID pelatih yang sedang login menggunakan guard 'admin'
        $id_pelatih = auth()->guard('admin')->user()->id_pelatih;

        // Temukan ekstrakurikuler yang terkait dengan ID pelatih yang sedang login
        $ekstrakurikuler = Ekstrakurikuler::where('id_pelatih', $id_pelatih)->first();

        // Pastikan ekstrakurikuler ditemukan
        if (!$ekstrakurikuler) {
            // Jika ekstrakurikuler tidak ditemukan, gunakan abort
            abort(403, 'Akses Ditolak');
        }

        $id_ekstra = $ekstrakurikuler->id_ekstra;

        // Dapatkan daftar siswa yang belum terdaftar pada ekstrakurikuler yang dilatih oleh pelatih
        $siswa = Siswa::whereDoesntHave('ekstrakurikuler', function ($query) use ($id_ekstra) {
            $query->where('ekstrakurikuler.id_ekstra', $id_ekstra);
        })->get();

        // Tampilkan halaman tambah member ekstrakurikuler dengan daftar siswa yang belum terdaftar
        return view('Admin.Anggota.create', ['siswa' => $siswa, 'ekstrakurikuler'=>$ekstrakurikuler]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validate = Validator::make($data, [
            'id_ekstra' => 'required',
            'nis' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $member_ekstra = MemberEkstra::create([
            'id_ekstra' => $data['id_ekstra'],
            'nis' => $data['nis'],
        ]);


        if ($member_ekstra) {
            return redirect()->route('anggota.index')->with(['member_ekstra' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['member_ekstra' => 'Gagal terkirim!', 'type' => 'danger']);
        }
    }


    public function destroyAnggota($nis, $id_ekstra)
    {
        // Temukan siswa berdasarkan NIS
        $siswa = Siswa::where('nis', $nis)->first();

        if (!$siswa) {
            return redirect()->back()->with(['message' => 'Siswa tidak ditemukan.', 'type' => 'error']);
        }

        // Hapus anggota ekstrakurikuler dari ekstrakurikuler yang sesuai dengan ID yang diterima
        $siswa->memberEkstra()->where('id_ekstra', $id_ekstra)->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with(['success' => 'Siswa berhasil dihapus dari daftar anggota ekstrakurikuler']);
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
}
