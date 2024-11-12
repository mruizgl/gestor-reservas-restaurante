<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/crearEmpleado', [FormularioController::class, 'CrearEmpleadoIndex'])->name('crearEmpleado.index');
Route::post('/crearEmpleado', [FormularioController::class, 'formulario'])->name('formulario');

Route::get('/home', [HomeController::class, 'indexHome'])->name('home.index');
Route::post('/home', [HomeController::class, 'home'])->name('home');

Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
Route::post('/reservas', [ReservaController::class, 'imagen'])->name('imagen');
