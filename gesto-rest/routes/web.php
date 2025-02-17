<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddTablesController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas web de tu aplicación.
| Todas las rutas están asignadas al grupo "web" middleware.
|
*/

// -----------------------------WELCOME----------------------------------------//
Route::get('/', function () {
    return view('welcome');
})->middleware('guest'); // O middleware('redirect.if.authenticated')


// -----------------------------LOGIN----------------------------------------//
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// -----------------------------DASHBOARD----------------------------------------//
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// -----------------------------MESAS----------------------------------------//
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/tables/create', [AddTablesController::class, 'create'])->name('tables.create');
    Route::post('/admin/tables/store', [AddTablesController::class, 'store'])->name('tables.store');
});

// -----------------------------ESPACIOS----------------------------------------//
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/spaces/create', [SpaceController::class, 'create'])->name('spaces.create');
    Route::post('/admin/spaces/store', [SpaceController::class, 'store'])->name('spaces.store');
    Route::resource('spaces', \App\Http\Controllers\SpaceController::class);
});

// -----------------------------RESERVAS----------------------------------//
Route::middleware(['auth'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/index/reservations', [ReservationController::class, 'index'])->name('reservations.list');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
});

// -----------------------------USUARIOS----------------------------------------//
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/create-user', [UserController::class, 'create'])->name('admin.createUser');
    Route::post('/admin/create-user', [UserController::class, 'store'])->name('admin.storeUser');
});
