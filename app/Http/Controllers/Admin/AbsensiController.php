<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $id_pelatih = Auth::guard('admin')->user()->id_pelatih;

        $ekstrakurikuler = Ekstrakurikuler::where('id_pelatih', $id_pelatih)->pluck('id_ekstra');

        $pertemuan = Pertemuan::whereIn('id_ekstra', $ekstrakurikuler)->latest()->get();

        return view('Admin.Absensi.index', ['pertemuan' => $pertemuan]);
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
                // Lakukan pencarian berdasarkan judul atau kegiatan
                $query->where('judul_pertemuan', 'like', "%$keyword%")
                    ->orWhere('kegiatan', 'like', "%$keyword%");
            }
        }

        // Ambil pertemuan yang terkait dengan ekstrakurikuler yang dilatih oleh pelatih tersebut
        $pertemuan = $query->latest()->get();

        return view('Admin.Absensi.index', ['pertemuan' => $pertemuan]);
    }


    public function searchKehadiran(Request $request, $id_pertemuan)
    {
        // Mendapatkan data pertemuan yang diklik
        $pertemuan = Pertemuan::findOrFail($id_pertemuan);

        // Memeriksa apakah pelatih yang sedang login memiliki akses ke pertemuan ini
        $id_pelatih = Auth::guard('admin')->user()->id_pelatih;
        if ($pertemuan->ekstrakurikuler->id_pelatih !== $id_pelatih) {
            abort(403, 'Anda tidak memiliki akses ke pertemuan ini.');
        }

        // Mendapatkan data presensi yang memiliki status "proses" dan terkait dengan pertemuan yang diklik
        $presensis = Presensi::where('id_pertemuan', $id_pertemuan)
            ->where('status', 'diterima')
            ->join('siswa', 'presensi.nis', '=', 'siswa.nis');

        if ($request->has('search')) {
            $keyword = $request->input('search');
            $presensis->where('siswa.nama', 'like', "%$keyword%");
        }

        $presensi = $presensis->get();

        // Kirim data presensi ke view validasi
        return view('Admin.Absensi.showKehadiran', ['presensi' => $presensi, 'id_pertemuan' => $id_pertemuan]);
    }


    public function showKehadiran($id_pertemuan)
    {
        // Mendapatkan data pertemuan yang diklik
        $pertemuan = Pertemuan::findOrFail($id_pertemuan);

        // Memeriksa apakah pelatih yang sedang login memiliki akses ke pertemuan ini
        $id_pelatih = Auth::guard('admin')->user()->id_pelatih;
        if ($pertemuan->ekstrakurikuler->id_pelatih !== $id_pelatih) {
            abort(403, 'Anda tidak memiliki akses ke pertemuan ini.');
        }

        // Mendapatkan data presensi yang memiliki status "proses" dan terkait dengan pertemuan yang diklik
        $presensi = Presensi::where('id_pertemuan', $id_pertemuan)
            ->where('status', 'diterima')
            ->get();


        // Kirim data presensi ke view validasi
        return view('Admin.Absensi.showKehadiran', ['presensi' => $presensi, 'id_pertemuan' => $id_pertemuan]);
    }

    public function presensi($id_pertemuan)
    {
        // Mendapatkan data pertemuan yang dipilih
        $pertemuan = Pertemuan::findOrFail($id_pertemuan);

        // Memeriksa apakah pelatih yang sedang login memiliki akses ke pertemuan ini
        $id_pelatih = Auth::guard('admin')->user()->id_pelatih;
        if ($pertemuan->ekstrakurikuler->id_pelatih !== $id_pelatih) {
            abort(403, 'Anda tidak memiliki akses ke pertemuan ini.');
        }

        // Mendapatkan siswa yang terdaftar pada ekstrakurikuler tersebut
        $siswa_terdaftar = $pertemuan->ekstrakurikuler->siswa;

        // Mendapatkan data presensi siswa pada pertemuan yang dipilih
        $presensi_siswa = Presensi::where('id_pertemuan', $id_pertemuan)->pluck('nis')->toArray();

        // Mendapatkan data siswa yang belum absen
        $siswa = $siswa_terdaftar->whereNotIn('nis', $presensi_siswa);

        // Kirim data siswa yang belum absen ke view presensi
        return view('Admin.Absensi.presensi', ['siswa' => $siswa,'id_pertemuan' => $id_pertemuan]);
    }


    /**
     * 
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
        $data = $request->all();

        $validate = Validator::make($data, [
            'id_pertemuan' => 'required',
            'nis'          => 'required',
            'keterangan'   => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $now = Carbon::now()->format('H:i');

        Presensi::create([
            'id_pertemuan' => $data['id_pertemuan'],
            'nis' => $data['nis'],
            'time' => $now,
            'keterangan' => $data['keterangan'],
            'status' => 'diterima',
        ]);

        return redirect()->back()->with('success', 'Presensi berhasil disimpan.');
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
