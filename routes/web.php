<?php

use App\Http\Controllers\Admin\BloqueoController;
use App\Http\Controllers\Admin\CitaController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\EspecialidadController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\ServicioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::get('/citas', [HomeController::class, 'citas'])->name('citas');
Route::get('/pacientes/buscar', [HomeController::class, 'buscarPaciente'])->middleware('throttle:pacientes-buscar')->name('pacientes.buscar');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/pacientes', [CitaController::class, 'pacientes'])->name('pacientes.index');
    Route::post('/citas/{cita}/estado', [CitaController::class, 'changeStatus'])->name('citas.change-status');

    Route::get('/especialidades', [EspecialidadController::class, 'index'])->name('especialidades.index');
    Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
    Route::get('/doctores', [DoctorController::class, 'index'])->name('doctores.index');
    Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios.index');
    Route::get('/bloqueos', [BloqueoController::class, 'index'])->name('bloqueos.index');
});
