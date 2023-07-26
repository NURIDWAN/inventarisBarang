<?php

use App\Http\Livewire\BarangKeluarr;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/barangmasuk', BarangKeluarr::class)->name('kelola.laporan');
});

Route::get('/', function () {
    return redirect()->to('/admin');
})->name('login');
