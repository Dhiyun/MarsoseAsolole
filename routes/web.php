<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KKController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LaporanPengaduanController;
use App\Http\Controllers\LaporanSpkController;
use App\Http\Controllers\RTController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WargaController;
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
Route::get('/', [LandingPageController::class, 'index'])->name('index');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login_proses', [AuthController::class, 'login_proses'])->name('login_proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::group(['middleware' => ['cek_login:WRG']], function() {
        Route::prefix('user')->group(function () {
            Route::get('/dashboard', [UserController::class, 'index'])->name('user.index');
            Route::get('/laporan', [UserController::class, 'laporan'])->name('user.laporan');
            Route::get('/createlaporan', [UserController::class, 'createlaporan'])->name('user.createlaporan');
            Route::get('/surat_keterangan', [UserController::class, 'surat_keterangan'])->name('user.surat_keterangan');
            Route::get('/surat_pengantar', [UserController::class, 'surat_pengantar'])->name('user.surat_pengantar');
            Route::get('/surat_undangan', [UserController::class, 'surat_undangan'])->name('user.surat_undangan');
            Route::get('/surat_pemberitahuan', [UserController::class, 'surat_pemberitahuan'])->name('user.surat_pemberitahuan'); 
        });
    });

    Route::group(['middleware' => ['cek_login:RW']], function() {
        Route::prefix('admin')->group(function () {

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
            
            // Route::prefix('datauser')->group(function () {
            //     Route::get('/', [UserController::class, 'index'])->name('user.index');
            //     Route::post('/list', [UserController::class, 'list']);
            //     Route::post('/store', [UserController::class, 'store']);
            //     Route::get('/edit/{id}', [UserController::class, 'edit']);
            //     Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
            //     Route::delete('/destroy/{id}', [UserController::class, 'destroy']);
            //     Route::post('/delete-selected', [UserController::class, 'deleteSelected'])->name('user.deleteSelected');
            // });
            
            Route::prefix('kk')->group(function () {
                Route::get('/', [KKController::class, 'index'])->name('kk.index');
                Route::get('/cek_rt', [KKController::class, 'cek_rt'])->name('cek_rt');
                Route::get('/cek_kk', [KKController::class, 'cek_kk'])->name('cek_kk');
                Route::get('/cek_nik', [WargaController::class, 'cek_nik'])->name('cek_nik');
                Route::post('/list', [KKController::class, 'list']);
                Route::post('/store', [KKController::class, 'store']);
                Route::post('/show/{id}', [KKController::class, 'store_warga'])->name('kkwarga.store');
                Route::get('/show/{id}', [KKController::class, 'show'])->name('kk.show');
                Route::put('/update/{id}', [KKController::class, 'update'])->name('kk.update');
                Route::delete('/destroy/{id}', [KKController::class, 'destroy']);
                Route::post('/delete-selected', [KKController::class, 'deleteSelected'])->name('kk.deleteSelected');
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
                Route::post('/store', [LaporanPengaduanController::class, 'store']);
                Route::get('/edit/{id}', [LaporanPengaduanController::class, 'edit']);
                Route::put('/update/{id}', [LaporanPengaduanController::class, 'update'])->name('laporan.update');
                Route::delete('/destroy/{id}', [LaporanPengaduanController::class, 'destroy']);
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
            
            Route::prefix('laporan_spk')->group(function () {
                Route::get('/', [LaporanSpkController::class, 'index'])->name('laporan_spk.index');
                Route::get('/create', [LaporanSpkController::class, 'create'])->name('laporan_spk.create');
                Route::post('/store', [LaporanSpkController::class, 'store'])->name('laporan_spk.store');
                Route::get('/priority', [LaporanSpkController::class, 'calculatePriority'])->name('laporan_spk.priority');
                Route::get('/chart', [LaporanSpkController::class, 'showChart'])->name('laporan_spk.chart');
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