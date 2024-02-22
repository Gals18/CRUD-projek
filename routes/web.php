<?php

use App\Http\Controllers\BarangController;
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
    return view('welcome');
});

//router untuk menampilkan form tambah barang
Route::get('/form-barang', [BarangController::class, 'create']);

//router untuk proses tambah data barang
Route::post('/aksi-tambah', [BarangController::class, 'store']);

// router untuk menampilkan list tabel barang
Route::get('/list-barang',[BarangController::class, 'index']);

// router untuk menampilkan data berdasarkan id barang
Route::get('/detail/{barang}',[BarangController::class, 'show']);

Route::post('/add-to-cart', [BarangController::class, 'addToCart']);