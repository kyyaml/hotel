<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Pertemuan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $siswa = Auth::guard('siswa')->user();

        // Mendapatkan data ekstrakurikuler yang diikuti oleh siswa tersebut
        $ekstrakurikuler = $siswa->ekstrakurikuler;

        return view('User.Presensi.index', ['ekstrakurikuler' => $ekstrakurikuler]);
    }

    public function showAbsen($id_ekstra)
    {
        // Mengambil pertemuan terkait dengan id_ekstra
        $pertemuans = Pertemuan::where('id_ekstra', $id_ekstra)->latest()->get();

        // Mendapatkan waktu saat ini
        $now = Carbon::now();

        // Menyiapkan array untuk menyimpan status absen masing-masing pertemuan
        $statusAbsen = [];

        foreach ($pertemuans as $pertemuan) {
            // Mengubah string menjadi objek waktu
            $start_time = Carbon::parse($pertemuan->start_time);
            $end_time = Carbon::parse($pertemuan->end_time);

            // Menentukan apakah waktu saat ini berada dalam jangka waktu pertemuan ini
            $absen = $now->between($start_time, $end_time);

            // Menambahkan status absen ke dalam array
            $statusAbsen[$pertemuan->id_pertemuan] = $absen;
        }

        // Kirim data pertemuan dan status absen ke tampilan
        return view('User.Presensi.showAbsen', ['pertemuans' => $pertemuans, 'statusAbsen' => $statusAbsen]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_pertemuan)
    {
        // Mendapatkan informasi pertemuan berdasarkan id
        $pertemuan = Pertemuan::findOrFail($id_pertemuan);


        // Periksa apakah siswa sudah melakukan absensi pada pertemuan ini
        $siswa = Auth::guard('siswa')->user();
        $sudahAbsen = Presensi::where('id_pertemuan', $id_pertemuan)
            ->where('nis', $siswa->nis)
            ->exists();

        return view('User.Presensi.create', ['pertemuan' => $pertemuan, 'sudahAbsen' => $sudahAbsen]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_pertemuan)
    {
        $data = $request->all();

        $pertemuan = Pertemuan::findOrFail($id_pertemuan);

        $validate = Validator::make($data, [
            'keterangan' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $now = Carbon::now()->format('H:i');
        $nis = Auth::guard('siswa')->user()->nis;

        Presensi::create([
            'nis' => $nis,
            'time' => $now,
            'id_pertemuan' => $id_pertemuan,
            'keterangan' => $data['keterangan'],
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
