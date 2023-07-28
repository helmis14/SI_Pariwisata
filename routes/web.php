<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('StaffOperator/home', [App\Http\Controllers\StaffOperatorController::class, 'index'])->name('StaffOperator.home')->middleware('staffoperator');
Route::get('StaffOperator/wisata', [App\Http\Controllers\StaffOperatorController::class, 'wisata'])->name('StaffOperator.wisata')->middleware('staffoperator');
Route::post('StaffOperator/wisata', [App\Http\Controllers\StaffOperatorController::class, 'submit_wisata'])->name('StaffOperator.wisata.submit')->middleware('staffoperator');
Route::patch('StaffOperator/wisata/update', [App\Http\Controllers\StaffOperatorController::class, 'update_wisata'])->name('StaffOperator.wisata.update')->middleware('staffoperator');
Route::post('StaffOperator/wisata/delete/{id}', [App\Http\Controllers\StaffOperatorController::class, 'delete_wisata'])->name('StaffOperator.wisata.delete')->middleware('staffoperator');
Route::get('StaffOperator/ajaxadmin/dataWisata/{id}', 
    [App\Http\Controllers\StaffOperatorController::class, 'getDataWisata']);
Route::get('StaffOperator/akun', [App\Http\Controllers\StaffOperatorController::class, 'akun'])->name('StaffOperator.akun')->middleware('staffoperator');
Route::post('StaffOperator/akun', [App\Http\Controllers\StaffOperatorController::class, 'submit_akun'])->name('StaffOperator.akun.submit')->middleware('staffoperator');
Route::patch('StaffOperator/akun/update', [App\Http\Controllers\StaffOperatorController::class, 'update_akun'])->name('StaffOperator.akun.update')->middleware('staffoperator');
Route::post('StaffOperator/akun/delete/{id}', [App\Http\Controllers\StaffOperatorController::class, 'delete_akun'])->name('StaffOperator.akun.delete')->middleware('staffoperator');
Route::get('StaffOperator/ajaxadmin/dataAkun/{id}', 
    [App\Http\Controllers\StaffOperatorController::class, 'getDataAkun']);
Route::get('StaffTiket/home', [App\Http\Controllers\StaffTiketController::class, 'index'])->name('StaffTiket.home')->middleware('stafftiket');
Route::get('StaffTiket/tiket', [App\Http\Controllers\StaffTiketController::class, 'tiket'])->name('StaffTiket.tiket')->middleware('stafftiket');
Route::post('StaffTiket/tiket', [App\Http\Controllers\StaffTiketController::class, 'submit_tiket'])->name('StaffTiket.tiket.submit')->middleware('stafftiket');
Route::patch('StaffTiket/tiket/update', [App\Http\Controllers\StaffTiketController::class, 'update_tiket'])->name('StaffTiket.tiket.update')->middleware('stafftiket');
Route::post('StaffTiket/tiket/delete/{id}', [App\Http\Controllers\StaffTiketController::class, 'delete_tiket'])->name('StaffTiket.tiket.delete')->middleware('stafftiket');
Route::get('StaffTiket/ajaxadmin/dataTiket/{id}', 
    [App\Http\Controllers\StaffTiketController::class, 'getDataTiket']);
Route::get('StaffTiket/pembayaran', [App\Http\Controllers\StaffTiketController::class, 'pembayaran'])->name('StaffTiket.pembayaran')->middleware('stafftiket');
Route::post('StaffTiket/pembayaran', [App\Http\Controllers\StaffTiketController::class, 'submit_pembayaran'])->name('StaffTiket.pembayaran.submit')->middleware('stafftiket');
Route::patch('StaffTiket/pembayaran/update', [App\Http\Controllers\StaffTiketController::class, 'update_pembayaran'])->name('StaffTiket.pembayaran.update')->middleware('stafftiket');
Route::post('StaffTiket/pembayaran/delete/{id}', [App\Http\Controllers\StaffTiketController::class, 'delete_pembayaran'])->name('StaffTiket.pembayaran.delete')->middleware('stafftiket');
Route::get('StaffTiket/ajaxadmin/dataAkun/{id}', 
    [App\Http\Controllers\StaffTiketController::class, 'getDataPembayaran']);

Route::get('Pengunjung/home', [App\Http\Controllers\PengunjungController::class, 'index'])->name('Pengunjung.home')->middleware('pengunjung');
Route::get('Pengunjung/wisata/{id}', [App\Http\Controllers\PengunjungController::class, 'wisata_terpilih'])->name('Pengunjung.wisata')->middleware('pengunjung');
Route::get('Pengunjung/tiket', [App\Http\Controllers\PengunjungController::class, 'tiket'])->name('Pengunjung.tiket')->middleware('pengunjung');
Route::post('Pengunjung/tiket', [App\Http\Controllers\PengunjungController::class, 'submit_tiket'])->name('Pengunjung.tiket.submit')->middleware('pengunjung');
Route::post('Pengunjung/tiket/pembayaran', [App\Http\Controllers\PengunjungController::class, 'submit_pembayaran'])->name('Pengunjung.pembayaran.submit')->middleware('pengunjung');
