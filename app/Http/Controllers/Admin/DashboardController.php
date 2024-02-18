<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Pelatih;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $pelatih = Pelatih::WhereNotIn('role',['kesiswaan'])->count();
        $ekstrakurikuler = Ekstrakurikuler::all()->count();
        $siswa = Siswa::all()->count();

        return view('Admin.Dashboard.index',['pelatih'=>$pelatih, 'ekstrakurikuler'=>$ekstrakurikuler, 'siswa'=>$siswa]);
    }
}
