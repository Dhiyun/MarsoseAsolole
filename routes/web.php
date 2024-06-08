<?php

use App\Http\Controllers\Admin\KKController as AdminKKController;
use App\Http\Controllers\Admin\WargaController as AdminWargaController;
use App\Http\Controllers\Admin\WelcomeAdminController;
use App\Http\Controllers\Admin\WelcomeController as AdminWelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Super_admin\DetailKriteriaController;
use App\Http\Controllers\Super_admin\KKController;
use App\Http\Controllers\Super_admin\KriteriaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Super_admin\LaporanPengaduanController;
use App\Http\Controllers\Super_admin\LaporanSpkController;
use App\Http\Controllers\Super_admin\RTController;
use App\Http\Controllers\Super_admin\LevelController;
use App\Http\Controllers\Super_admin\AlternatifController;
use App\Http\Controllers\Super_admin\SuratController;
use App\Http\Controllers\User\LaporanPengaduanController as UserLaporanPengaduanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Super_admin\WelcomeController;
use App\Http\Controllers\Super_admin\WargaController;
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





Route::get('/', [LandingPageController::class, 'index']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login_proses', [AuthController::class, 'login_proses'])->name('login_proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => ['cek_login:WRG']], function () {
        Route::prefix('user')->group(function () {
            Route::get('/dashboard', [UserController::class, 'index'])->name('user.index');
            Route::get('/surat_keterangan', [UserController::class, 'surat_keterangan'])->name('user.surat_keterangan');
            Route::get('/surat_pengantar', [UserController::class, 'surat_pengantar'])->name('user.surat_pengantar');
            Route::get('/surat_undangan', [UserController::class, 'surat_undangan'])->name('user.surat_undangan');
            Route::get('/surat_pemberitahuan', [UserController::class, 'surat_pemberitahuan'])->name('user.surat_pemberitahuan');

            Route::prefix('laporan')->group(function () {
                Route::get('/', [UserLaporanPengaduanController::class, 'index'])->name('user-laporan.index');
                Route::get('/create', [UserLaporanPengaduanController::class, 'create'])->name('user-laporan.create');
                Route::post('/store', [UserLaporanPengaduanController::class, 'store'])->name('user-laporan.store');
                Route::get('/history', [UserLaporanPengaduanController::class, 'history'])->name('user-laporan.history');
                Route::get('/all', [LaporanPengaduanController::class, 'showLaporanPengaduan'])->name('user-laporan.all');
            });
        });
    });

    Route::group(['middleware' => ['cek_login:RT']], function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('{rt?}')->group(function () {
                Route::prefix('dashboard')->group(function () {
                    Route::get('/', [AdminWelcomeController::class, 'index'])->name('admin.index');
                });

                Route::prefix('kk')->group(function () {
                    Route::get('/', [AdminKKController::class, 'index'])->name('kk-admin.index');
                    Route::get('/cek_kk', [AdminKKController::class, 'cek_kk'])->name('cek_kk-admin');
                    Route::get('/cek_nik', [WargaController::class, 'cek_nik'])->name('cek_nik');
                    Route::post('/store', [AdminKKController::class, 'store'])->name('kk-admin.store');
                    Route::get('/show/{id}', [AdminKKController::class, 'show'])->name('kk-admin.show');
                    Route::put('/update/{id}', [AdminKKController::class, 'update'])->name('kk-admin.update');
                    Route::delete('/destroy/{id}', [AdminKKController::class, 'destroy'])->name('kk-admin.destroy');
                    Route::post('/delete-selected', [AdminKKController::class, 'deleteSelected'])->name('kk-admin.deleteSelected');
                });

                Route::prefix('warga')->group(function () {
                    Route::get('/', [AdminWargaController::class, 'index'])->name('warga-admin.index');
                    Route::get('/cek_nik', [AdminWargaController::class, 'cek_nik'])->name('cek_nik-admin');
                    Route::get('/cek_kk', [AdminWargaController::class, 'cek_kk'])->name('cek_kk-admin');
                    Route::post('/store', [AdminWargaController::class, 'store'])->name('warga-admin.store');
                    Route::get('/detail/{id}', [AdminWargaController::class, 'show'])->name('warga-admin.show');
                    Route::put('/update/{id}', [AdminWargaController::class, 'update'])->name('warga-admin.update');
                    Route::put('/update-user/{id}', [AdminWargaController::class, 'update_user'])->name('user-admin.update');
                    Route::delete('/destroy/{id}', [AdminWargaController::class, 'destroy'])->name('warga-admin.destroy');
                    Route::post('/delete-selected', [AdminWargaController::class, 'deleteSelected'])->name('warga.deleteSelected');
                });
            });
        });
    });

    Route::group(['middleware' => ['cek_login:RW']], function () {
        Route::prefix('super-admin')->group(function () {

            Route::prefix('dashboard')->group(function () {
                Route::get('/', [WelcomeController::class, 'index'])->name('super-admin.index');
            });

            Route::prefix('level')->group(function () {
                Route::get('/', [LevelController::class, 'index'])->name('level.index');
                Route::post('/list', [LevelController::class, 'list']);
                Route::post('/store', [LevelController::class, 'store']);
                Route::put('/update/{id}', [LevelController::class, 'update'])->name('level.update');
                Route::delete('/destroy/{id}', [LevelController::class, 'destroy']);
                Route::post('/delete-selected', [LevelController::class, 'deleteSelected'])->name('level.deleteSelected');
            });

            Route::prefix('kk')->group(function () {
                Route::get('/', [KKController::class, 'index'])->name('kk.index');
                Route::get('/cek_kk', [KKController::class, 'cek_kk'])->name('cek_kk');
                Route::get('/cek_nik', [WargaController::class, 'cek_nik'])->name('cek_nik');
                Route::post('/store', [KKController::class, 'store'])->name('kk.store');
                Route::get('/show/{id}', [KKController::class, 'show'])->name('kk.show');
                Route::put('/update/{id}', [KKController::class, 'update'])->name('kk.update');
                Route::delete('/destroy/{id}', [KKController::class, 'destroy'])->name('kk.destroy');
                Route::post('/delete-selected', [KKController::class, 'deleteSelected'])->name('kk.deleteSelected');

                //Warga KK
                Route::post('/show/{id}', [KKController::class, 'store_warga'])->name('kkwarga.store');
                Route::get('{id_kk}/warga/{id}', [KKController::class, 'show_warga'])->name('kkwarga.show');

                //User Warga
                Route::put('/update-user/{id}', [UserController::class, 'update'])->name('user.update');
            });

            Route::prefix('warga')->group(function () {
                Route::get('/', [WargaController::class, 'index'])->name('warga.index');
                Route::get('/cek_nik', [WargaController::class, 'cek_nik'])->name('cek_nik');
                Route::get('/cek_kk', [WargaController::class, 'cek_kk'])->name('cek_kk');
                Route::post('/store', [WargaController::class, 'store'])->name('warga.store');
                Route::get('/detail/{id}', [WargaController::class, 'show'])->name('warga.show');
                Route::put('/update/{id}', [WargaController::class, 'update'])->name('warga.update');
                Route::put('/update-user/{id}', [UserController::class, 'update'])->name('user.update');
                Route::delete('/destroy/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');
                Route::post('/delete-selected', [WargaController::class, 'deleteSelected'])->name('warga.deleteSelected');
            });

            Route::prefix('laporan')->group(function () {
                Route::get('/', [LaporanPengaduanController::class, 'index'])->name('laporan.index');
                Route::post('/store', [LaporanPengaduanController::class, 'store'])->name('laporan.store');
                Route::get('/detail/{id}', [LaporanPengaduanController::class, 'show'])->name('laporan.show');
                Route::put('/update/{id}', [LaporanPengaduanController::class, 'update'])->name('laporan.update');
                Route::put('/', [LaporanPengaduanController::class, 'update_status'])->name('laporan.updateStatus');
                Route::delete('/destroy/{id}', [LaporanPengaduanController::class, 'destroy'])->name('laporan.destroy');
                Route::post('/delete-selected', [LaporanPengaduanController::class, 'deleteSelected'])->name('laporan.deleteSelected');
            });

            Route::prefix('surat')->group(function () {
                Route::get('/', [SuratController::class, 'index'])->name('surat.index');
                Route::post('/store', [SuratController::class, 'store'])->name('surat.store');
                Route::get('/detail/{id}', [SuratController::class, 'show'])->name('surat.show');
                Route::put('/update/{id}', [LevelController::class, 'update'])->name('surat.update');
                Route::delete('/destroy/{id}', [LevelController::class, 'destroy'])->name('surat.destroy');
                Route::post('/delete-selected', [LevelController::class, 'deleteSelected'])->name('surat.deleteSelected');
            });

            Route::prefix('spk')->group(function () {
                Route::prefix('alternatif')->group(function () {
                    Route::get('/', [AlternatifController::class, 'index'])->name('alternatif.index');
                    Route::post('/store', [AlternatifController::class, 'store'])->name('alternatif.store');
                    Route::put('/update/{id}', [AlternatifController::class, 'update'])->name('alternatif.update');
                    Route::delete('/destroy/{id}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');
                    Route::post('/delete-selected', [AlternatifController::class, 'deleteSelectedKriteria'])->name('alternatif.deleteSelected');
                });
            });

            Route::prefix('kriteria')->group(function () {
                Route::get('/', [KriteriaController::class, 'index'])->name('kriteria.index');
                Route::post('/store', [KriteriaController::class, 'store'])->name('kriteria.store');
                Route::put('/update/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
                Route::delete('/destroy/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
                Route::post('/delete-selected', [KriteriaController::class, 'deleteSelectedKriteria'])->name('kriteria.deleteSelected');
            });

            Route::prefix('detail_kriteria')->group(function () {
                Route::get('/', [DetailKriteriaController::class, 'index'])->name('detail_kriteria.index');
                Route::post('/store', [DetailKriteriaController::class, 'store'])->name('detail_kriteria.store');
                Route::put('/update/{id}', [DetailKriteriaController::class, 'update'])->name('detail_kriteria.update');
                Route::delete('/destroy/{id}', [DetailKriteriaController::class, 'destroy'])->name('detail_kriteria.destroy');
                Route::post('/delete-selected', [DetailKriteriaController::class, 'deleteSelectedKriteria'])->name('detail_kriteria.deleteSelected');
            });

            Route::prefix('laporan_spk')->group(function () {
                Route::get('/', [LaporanSpkController::class, 'indexLaporanSpk'])->name('laporan_spk.index');
                Route::get('/create', [LaporanSpkController::class, 'createLaporanSpk'])->name('laporan_spk.create');
                Route::post('/store', [LaporanSpkController::class, 'storeLaporanSpk'])->name('laporan_spk.store');
                Route::get('/form', [LaporanSpkController::class, 'showForm'])->name('laporan_spk.form');
                Route::put('/update/{id}', [LaporanSpkController::class, 'updateLaporanSpk'])->name('laporan_spk.update');
                Route::get('/perangkingan', [LaporanSpkController::class, 'calculatePriority'])->name('laporan_spk.priority');
                Route::get('/perangkingan/show/{id}', [LaporanSpkController::class, 'show_calculatePriority'])->name('laporan_spk.show');
                Route::get('/perhitungan', [LaporanSpkController::class, 'displayCalculations'])->name('laporan_spk.perhitungan]');
                Route::get('/chart', [LaporanSpkController::class, 'showChart'])->name('laporan_spk.chart');
                Route::delete('/destroy/{id}', [LaporanSpkController::class, 'destroyLaporanSpk'])->name('laporan_spk.destroy');
                Route::post('/delete-selected', [LaporanSpkController::class, 'deleteSelected'])->name('laporan_spk.deleteSelected');
            });
        });
    });
});

// Route::prefix('rw')->group(function () {
//     Route::get('/', [RTController::class, 'index'])->name('data_rw.index');
//     Route::get('/create', [RTController::class, 'create'])->name('data_rw.create');
//     Route::post('/store', [RTController::class, 'store'])->name('data_rw.store');
//     Route::get('/edit/{No_RT}', [RTController::class, 'edit'])->name('data_rw.edit');
//     Route::put('/update/{No_RT}', [RTController::class, 'update'])->name('data_rw.update');
//     Route::delete('/destroy/{No_RT}', [RTController::class, 'destroy'])->name('data_rw.destroy');
// });

// Route::prefix('rt')->group(function () {
//     Route::get('/', [RTController::class, 'index'])->name('data_rt.index');
//     Route::get('/create', [RTController::class, 'create'])->name('data_rt.create');
//     Route::post('/store', [RTController::class, 'store'])->name('data_rt.store');
//     Route::get('/edit/{No_RT}', [RTController::class, 'edit'])->name('data_rt.edit');
//     Route::put('/update/{No_RT}', [RTController::class, 'update'])->name('data_rt.update');
//     Route::delete('/destroy/{No_RT}', [RTController::class, 'destroy'])->name('data_rt.destroy');
// });
