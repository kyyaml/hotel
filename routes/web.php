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

    // Authentication
    Route::middleware(['guest'])->group(function () {
        Route::get('/', [AdminController::class, 'formLogin'])->name('admin.formLogin');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    });

    // Authorized Routes
    Route::middleware(['auth:admin'])->group(function () {

        // Common dashboard for both roles
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Role-specific routes:
        Route::group(['middleware' => ['role:kesiswaan']], function () {
            // Pelatih Management
            Route::resource('pelatih', PelatihController::class);
            Route::get('/searchPelatih',[PelatihController::class, 'searchPelatih'])->name('pelatih.search');

            // Siswa Management
            Route::get('/searchSiswa', [SiswaController::class, 'searchSiswa'])->name('siswa.search');
            Route::resource('siswa', SiswaController::class);

            // Ekstrakurikuler Management
            Route::resource('ekstrakurikuler', EkstrakurikulerController::class);
            Route::get('/searchEkstrakurikuler',[EkstrakurikulerController::class, 'searchEkstrakurikuler'])->name('ekstrakurikuler.search');

            // Member Ekstra Management
            Route::get('member-ekstra/{id_ekstra}', [MemberEkstraController::class, 'showMember'])->name('member-ekstra.showMember');
            Route::get('member-ekstra/{id_ekstra}/create', [MemberEkstraController::class, 'create'])->name('member-ekstra.create-form');
            Route::get('/member-ekstra/{id_ekstra}/searchDaftarSiswa', [MemberEkstraController::class, 'searchDaftarSiswa'])->name('member-ekstra.searchDaftarSiswa');
            Route::get('/member-ekstra/{id_ekstra}/searchMember', [MemberEkstraController::class, 'searchMember'])->name('member-ekstra.searchMember');
            Route::delete('member-ekstra/{nis}/{id_ekstra}', [MemberEkstraController::class, 'destroyData'])->name('member-ekstra.destroyData');
            Route::resource('member-ekstra', MemberEkstraController::class);
        });

        Route::group(['middleware' => ['role:pelatih']], function () {
            // Pertemuan Management
            Route::resource('pertemuan', PertemuanController::class);
        });

        // Logout (accessible to both roles)
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});