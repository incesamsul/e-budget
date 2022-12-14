<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Bendahara;
use App\Http\Controllers\Ketua;
use App\Http\Controllers\General;
use App\Http\Controllers\Home;
use App\Http\Controllers\Pengaju;
use App\Http\Controllers\Penilai;

use App\Http\Controllers\UserController;
use App\Http\Controllers\Yayasan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::post('/postlogin', [LoginController::class, 'postLogin']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/', [LoginController::class, 'login']);


Route::get('/tentang_aplikasi', [Home::class, 'tentangAplikasi']);


Route::group(['middleware' => ['guest']], function () {

    Route::get('/login', [LoginController::class, 'login'])->name('login');
});

// GENERAL CONTROLLER ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:Administrator,pengaju,bendahara,ketua,yayasan']], function () {

    Route::get('/sisa_anggaran', [General::class, 'sisaAnggaran']);
    Route::get('/cetak_laporan_sisa_anggaran', [General::class, 'cetakLaporansisaAnggaran']);
    Route::get('/dashboard', [General::class, 'dashboard']);
    Route::get('/profile', [General::class, 'profile']);
    Route::get('/bantuan', [General::class, 'bantuan']);

    Route::post('/ubah_foto_profile', [General::class, 'ubahFotoProfile']);
    Route::post('/ubah_role', [General::class, 'ubahRole']);
});

// PENGAJU ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:pengaju']], function () {
    Route::group(['prefix' => 'pengaju'], function () {
        // GET REQUEST
        Route::get('/pengajuan', [Pengaju::class, 'pengajuan']);

        // CRUD PENGAJUAN
        Route::post('/create_pengajuan', [Pengaju::class, 'createPengajuan']);
        Route::post('/update_pengajuan', [Pengaju::class, 'updatePengajuan']);
        Route::post('/delete_pengajuan', [Pengaju::class, 'deletePengajuan']);
    });
});


// BENDAHARA ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:bendahara']], function () {
    Route::group(['prefix' => 'bendahara'], function () {
        // GET REQUEST
        Route::get('/pengajuan', [Bendahara::class, 'pengajuan']);

        // POST REQUEST
        Route::post('/terima_pengajuan', [Bendahara::class, 'terimaPengajuan']);
        Route::post('/tolak_pengajuan', [Bendahara::class, 'tolakPengajuan']);
        Route::post('/update_alasan_tolak', [Bendahara::class, 'updateAlasanTolak']);
        Route::post('/update_tgl_pencairan', [Bendahara::class, 'updateTglPencairan']);
    });
});

// KETUA ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:ketua']], function () {
    Route::group(['prefix' => 'ketua'], function () {
        // GET REQUEST
        Route::get('/pengajuan', [Ketua::class, 'pengajuan']);

        // POST REQUEST
        Route::post('/terima_pengajuan', [Ketua::class, 'terimaPengajuan']);
        Route::post('/tolak_pengajuan', [Ketua::class, 'tolakPengajuan']);
        Route::post('/update_alasan_tolak', [Ketua::class, 'updateAlasanTolak']);
    });
});

// YAYASAN ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:yayasan']], function () {
    Route::group(['prefix' => 'yayasan'], function () {
        // GET REQUEST
        Route::get('/log_aktivitas', [Yayasan::class, 'logAktivitas']);
        Route::get('/log_aktivitas/{tanggal}', [Yayasan::class, 'logAktivitas']);
        Route::get('/laporan', [Yayasan::class, 'laporan']);
        Route::get('/cetak_laporan', [Yayasan::class, 'cetakLaporan']);
        Route::get('/cetak_laporan_anggaran_masuk', [Yayasan::class, 'cetakLaporanAnggaranMasuk']);
    });
});


// ADMIN ROUTE
Route::group(['middleware' => ['auth', 'ceklevel:Administrator,bendahara,ketua,yayasan']], function () {
    Route::group(['prefix' => 'admin'], function () {
        // GET REQUEST
        Route::get('/pengguna', [Admin::class, 'pengguna']);
        Route::get('/fetch_data', [Admin::class, 'fetchData']);
        Route::get('/jenis_anggaran', [Admin::class, 'jenisAnggaran']);
        Route::get('/anggaran_terpakai', [Admin::class, 'anggaranTerpakai']);
        Route::get('/tahun_akademik', [Admin::class, 'tahunAkademik']);
        Route::get('/aktifkan_tahun_akademik/{id_tahun_akademik}', [Admin::class, 'aktifkanTahunAkademik']);

        // CRUD TAHUN AJARAN
        Route::post('/create_tahun_akademik', [Admin::class, 'createTahunAkademik']);
        Route::post('/update_tahun_akademik', [Admin::class, 'updateTahunAkademik']);
        Route::post('/delete_tahun_akademik', [Admin::class, 'deleteTahunAkademik']);

        // CRUD JENIS ANGGARAN
        Route::post('/create_jenis_anggaran', [Admin::class, 'createJenisAnggaran']);
        Route::post('/update_jenis_anggaran', [Admin::class, 'updateJenisAnggaran']);
        Route::post('/delete_jenis_anggaran', [Admin::class, 'deleteJenisAnggaran']);

        // CRUD PENGGUNA
        Route::post('/create_pengguna', [Admin::class, 'createPengguna']);
        Route::post('/update_pengguna', [Admin::class, 'updatePengguna']);
        Route::post('/delete_pengguna', [Admin::class, 'deletePengguna']);
    });
});
