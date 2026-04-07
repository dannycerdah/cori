<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CitaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::get('/citas', [HomeController::class, 'citas'])->name('citas');
Route::post('/citas', [HomeController::class, 'storeCita'])->name('citas.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/pacientes', [CitaController::class, 'pacientes'])->name('pacientes.index');
    Route::post('/citas/{cita}/estado', [CitaController::class, 'changeStatus'])->name('citas.change-status');
});
