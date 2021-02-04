<?php

use App\Http\Controllers\BillController;
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

Route::get('/', [BillController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::resource('/bills',BillController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
