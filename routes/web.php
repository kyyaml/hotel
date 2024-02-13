<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EkstrakurikulerController;
use App\Http\Controllers\Admin\MemberEkstraController;
use App\Http\Controllers\Admin\PelatihController;
use App\Http\Controllers\Admin\PertemuanController;
use App\Http\Controllers\Admin\SiswaController;
use App\Models\MemberEkstra;
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

Route::prefix('admin')->group(function () {

    Route::middleware(['guest'])->group(function () {
        Route::get('/', [AdminController::class, 'formLogin'])->name('admin.formLogin');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    });

    Route::middleware(['isKesiswaan'])->group(function () {

        //pelatih
        Route::resource('pelatih', PelatihController::class);

        //cari siswa 
        Route::get('/searchSiswa', [SiswaController::class, 'searchSiswa'])->name('siswa.search');
        //siswa
        Route::resource('siswa', SiswaController::class);


        //memberEkstra

        //show siswa yang telah terdaftar ekstra
        Route::get('member-ekstra/{id_ekstra}', [MemberEkstraController::class, 'showMember'])->name('member-ekstra.showMember');

        //register ekstra siswa
        Route::get('member-ekstra/{id_ekstra}/create', [MemberEkstraController::class, 'create'])->name('member-ekstra.create-form');
        
        //cari siswa yang belum terdaftar
        Route::get('/member-ekstra/{id_ekstra}/searchDaftarSiswa', [MemberEkstraController::class, 'searchDaftarSiswa'])->name('member-ekstra.searchDaftarSiswa');

        // cari siswa yang telah terdaftar
        Route::get('/member-ekstra/{id_ekstra}/searchMember', [MemberEkstraController::class, 'searchMember'])->name('member-ekstra.searchMember');

        //Hapus siswa dari ekstra
        Route::delete('member-ekstra/{nis}/{id_ekstra}', [MemberEkstraController::class, 'destroyData'])->name('member-ekstra.destroyData');

        Route::resource('member-ekstra', MemberEkstraController::class);


        //ekstra
        Route::resource('ekstrakurikuler', EkstrakurikulerController::class);
    });

    Route::middleware(['isPelatih'])->group(function () {

        //dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        //pertemuan
        Route::resource('pertemuan', PertemuanController::class);



        //logout
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
