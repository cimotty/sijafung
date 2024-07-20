<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect ('/data-pegawai');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/user/profile', [UserController::class, 'index']);
    Route::get('/data-pegawai', [EmployeeController::class, 'index'])->name('data_pegawai');
});


Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('proses_login', [AuthController::class,'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
