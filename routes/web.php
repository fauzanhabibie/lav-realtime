<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KaryawanController;
use App\Models\Karyawan;

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

Route::get('/employee', [KaryawanController::class, 'index']);
Route::get('/tambah-emp', [KaryawanController::class, 'create']); 
Route::post('/store-employee',[KaryawanController::class,'store'])->name('employee.store'); 




