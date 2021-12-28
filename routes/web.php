<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\ProfesorController;


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
/*
Route::get('/', function () {
    return view('index');
});
*/

Route::get('/', [UsuarioController::class, 'index'])->name('index');
Route::get('/marmo.login', [UsuarioController::class, 'login'])->name('login')->middleware('guest');
Route::post('/marmo.datos', [UsuarioController::class, 'datos'])->name('datos');
Route::get('/marmo.menulog/{nom?}', [UsuarioController::class, 'menulog'])->name('menulog')->middleware('auth');
Route::get('/marmo.logout', [UsuarioController::class, 'logout'])->name('logout');
Route::get('/layouts', [UsuarioController::class, 'layouts']);
Route::resource('/admin', AdminController::class);
Route::resource('/adminc', CamionController::class);
Route::resource('/docente', ProfesorController::class);
