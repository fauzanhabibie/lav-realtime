<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [ProdukController::class, 'index']);
Route::get('/produk', [ProdukController::class, 'create']); 
Route::post('/tambahproduk',[ProdukController::class,'store'])->name('produk.store'); 
Route::get('/tes-notifikasi', [ProdukController::class, 'tesnotif']);

