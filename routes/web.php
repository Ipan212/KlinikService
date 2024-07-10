<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FisikController;
use App\Http\Controllers\KlinikController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PanggilanController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PasienMedisController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\TransaksiController;
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
Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class,'index'])->name('login');
    Route::post('/', [SesiController::class,'login']);
}); 
Route::get('/home', function(){
    return redirect('/admin');
});
Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/pendaftaran', [AdminController::class,'pendaftaran'])->middleware('userAkses:pendaftaran');
    Route::get('/admin/rekme', [AdminController::class,'rekme'])->middleware('userAkses:rekme');
    Route::get('/admin/transaksi', [AdminController::class,'transaksi'])->middleware('userAkses:transaksi');
    Route::get('/logout',[SesiController::class, 'logout']);

    Route::get('/pasien/data', [PasienController::class,'data'])->name('pasien.data');
    Route::post('/pasien/cetak-pasien', [PasienController::class, 'cetakPasien'])->name('pasien.cetak_pasien');
    Route::resource('/pasien', PasienController::class);
    Route::get('pasien/{id}/rekam-medis', [PasienController::class, 'showRekamMedis'])->name('pasien.showRekamMedis');


    Route::get('/klinik/data', [KlinikController::class, 'data'])->name('klinik.data');
    Route::resource('/klinik', KlinikController::class);

    Route::get('/pendaftaran/data', [PendaftaranController::class, 'data'])->name('pendaftaran.data');
    Route::post('pendaftaran/cetak', [PendaftaranController::class, 'cetakPendaftaran'])->name('pendaftaran.cetak_pendaftaran');
    Route::resource('/pendaftaran', PendaftaranController::class);

    Route::get('/obat/data', [ObatController::class, 'data'])->name('obat.data');
    Route::post('/obat/delete-selected', [ObatController::class, 'deleteSelected'])->name('obat.delete_selected');
    Route::resource('/obat', ObatController::class);

    Route::get('/pemeriksaan/data', [PemeriksaanController::class, 'data'])->name('pemeriksaan.data');
    Route::resource('/pemeriksaan', PemeriksaanController::class);

    Route::get('/fisik/data', [FisikController::class, 'data'])->name('fisik.data');
    Route::resource('/fisik', FisikController::class);

    Route::get('/rekam_medis/data', [RekamMedisController::class, 'data'])->name('rekam_medis.data');
    Route::resource('rekam_medis', RekamMedisController::class);

    Route::resource('transaksi', TransaksiController::class);

    Route::get('pemanggilan', [PanggilanController::class, 'index'])->name('pemanggilan.index');
    Route::post('pemanggilan/panggil', [PanggilanController::class, 'panggil'])->name('pemanggilan.panggil');

    Route::get('pemanggilan/called_patients', [PanggilanController::class, 'calledPatientsData'])->name('pemanggilan.called_patients');
    Route::post('pemanggilan/call_again', [PanggilanController::class, 'callAgain'])->name('pemanggilan.call_again');

    // Route::get('/pasien', [PasienMedisController::class, 'index'])->name('pasien.index');
    // Route::get('/pasien/{id}/rekam_medis', [PasienMedisController::class, 'rekamMedis'])->name('pasien.rekam_medis');
});

