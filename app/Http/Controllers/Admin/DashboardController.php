<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\MemberEkstra;
use App\Models\Pelatih;
use App\Models\Pertemuan;
use App\Models\Presensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function kesiswaan()
    {
        $pelatih = Pelatih::WhereNotIn('role', ['kesiswaan'])->count();
        $ekstrakurikuler = Ekstrakurikuler::all()->count();
        $siswa = Siswa::all()->count();

        return view('Admin.DashboardKesiswaan.index', ['pelatih' => $pelatih, 'ekstrakurikuler' => $ekstrakurikuler, 'siswa' => $siswa]);
    }
    
    public function pelatih()
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

        // Dapatkan ID ekstrakurikuler
        $id_ekstra = $ekstrakurikuler->id_ekstra;

        // Dapatkan jumlah anggota ekstrakurikuler yang terdaftar pada ekstrakurikuler yang dilatih oleh pelatih
        $member = MemberEkstra::where('id_ekstra', $id_ekstra)->count();

        // Dapatkan jumlah pertemuan
        $pertemuan = Pertemuan::where('id_ekstra', $id_ekstra)->count();

        // Dapatkan jumlah presensi yang belum divalidasi
        $validasi = Presensi::whereHas('pertemuan', function ($query) use ($id_ekstra) {
            $query->where('id_ekstra', $id_ekstra);
        })->where('status', 'proses')->count();

        return view('Admin.DashboardPelatih.index', ['member' => $member, 'pertemuan' => $pertemuan, 'validasi' => $validasi]);
    }
}
