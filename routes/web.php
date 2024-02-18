<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnggotaEkstraController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EkstrakurikulerController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MemberEkstraController;
use App\Http\Controllers\Admin\PelatihController;
use App\Http\Controllers\Admin\PertemuanController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\ValidasiController;
use App\Http\Controllers\User\PresensiController;
use App\Http\Controllers\User\UserController;
use App\Models\MemberEkstra;
use App\Models\Presensi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//user
Route::get('/', [UserController::class, 'index'])->name('user.index');

Route::middleware(['guest'])->group(function () {
    //Login User
    Route::post('/login', [UserController::class, 'login'])->name('user.login');
});

Route::middleware(['isSiswa'])->group(function () {
    Route::post('/presensi/{id_pertemuan}/store', [PresensiController::class, 'store'])->name('presensi.storeAbsen');
    Route::get('/presensi/create/{id_pertemuan}', [PresensiController::class, 'create'])->name('presensi.createAbsen');
    Route::get('/presensi/{id_ekstra}/show-absen', [PresensiController::class, 'showAbsen'])->name('show.absen');
    Route::resource('presensi', PresensiController::class);
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});


//admin
Route::prefix('admin')->group(function () {

    // Authentication
    Route::middleware(['guest'])->group(function () {
        Route::get('/', [AdminController::class, 'formLogin'])->name('admin.formLogin')->middleware('guest');;
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login')->middleware('guest');;
    });

    // Authorized Routes
    Route::middleware(['auth:admin'])->group(function () {

        // Common dashboard for both roles
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Role-specific routes:
        Route::group(['middleware' => ['role:kesiswaan']], function () {
            // Pelatih Management
            Route::resource('pelatih', PelatihController::class);
            Route::get('/searchPelatih', [PelatihController::class, 'searchPelatih'])->name('pelatih.search');

            // Siswa Management
            Route::get('/searchSiswa', [SiswaController::class, 'searchSiswa'])->name('siswa.search');
            Route::resource('siswa', SiswaController::class);

            // Ekstrakurikuler Management
            Route::resource('ekstrakurikuler', EkstrakurikulerController::class);
            Route::get('/searchEkstrakurikuler', [EkstrakurikulerController::class, 'searchEkstrakurikuler'])->name('ekstrakurikuler.search');

            // Member Ekstra Management
            Route::get('member-ekstra/{id_ekstra}', [MemberEkstraController::class, 'showMember'])->name('member-ekstra.showMember');
            Route::get('member-ekstra/{id_ekstra}/create', [MemberEkstraController::class, 'create'])->name('member-ekstra.create-form');
            Route::get('/member-ekstra/{id_ekstra}/searchDaftarSiswa', [MemberEkstraController::class, 'searchDaftarSiswa'])->name('member-ekstra.searchDaftarSiswa');
            Route::get('/member-ekstra/{id_ekstra}/searchMember', [MemberEkstraController::class, 'searchMember'])->name('member-ekstra.searchMember');
            Route::delete('member-ekstra/{nis}/{id_ekstra}', [MemberEkstraController::class, 'destroyData'])->name('member-ekstra.destroyData');
            Route::resource('member-ekstra', MemberEkstraController::class);

            //Laporan
            Route::resource('laporan',LaporanController::class);
        });

        Route::group(['middleware' => ['role:pelatih']], function () {
            // Pertemuan Management
            Route::resource('pertemuan', PertemuanController::class);
            Route::get('/searchPertemuan', [PertemuanController::class, 'searchPertemuan'])->name('pertemuan.search');

            //MemberEkstra
            Route::get('/searchNamaSiswa', [AnggotaEkstraController::class, 'searchNamaSiswa'])->name('anggota.searchSiswa');
            Route::get('/searchAnggota', [AnggotaEkstraController::class, 'searchAnggota'])->name('anggota.searchAnggota');
            Route::delete('/anggota/{nis}/{id_ekstra}', [AnggotaEkstraController::class, 'destroyAnggota'])->name('anggota.destroyAnggota');
            route::resource('anggota', AnggotaEkstraController::class);

            //Validasi
            Route::get('/validasi/{id_pertemuan}', [ValidasiController::class, 'validasi'])->name('validasiAbsen');
            Route::put('/validasi/terima/{id_presensi}', [ValidasiController::class, 'terima'])->name('validasi.terima');
            Route::put('/validasi/tolak/{id_presensi}', [ValidasiController::class, 'tolak'])->name('validasi.tolak');
            Route::resource('validasi', ValidasiController::class);

            //Absensi
            Route::get('/absensi/searchPertemuan', [AbsensiController::class, 'searchPertemuan'])->name('absensi.searchPertemuan');
            Route::get('/absensi/{id_pertemuan}/searchKehadiran', [AbsensiController::class, 'searchKehadiran'])->name('absensi.searchKehadiran');
            Route::get('/absensiSiswa/{id_pertemuan}', [AbsensiController::class, 'presensi'])->name('absensiSiswa');
            Route::get('/showKehadiran/{id_pertemuan}', [AbsensiController::class, 'showKehadiran'])->name('showKehadiran');
            Route::resource('absensi', AbsensiController::class);
        });

        // Logout (accessible to both roles)
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
