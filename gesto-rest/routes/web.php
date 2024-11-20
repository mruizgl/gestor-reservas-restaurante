<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddTablesController;
use App\Http\Controllers\SpaceController;

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


// -----------------------------WELCOME----------------------------------------//
Route::get('/', function () {
    return view('welcome');
})->name('home');

// -----------------------------LOGIN----------------------------------------//
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//----------------------------AÑADIR MESAS DEL DÍA -------------------------------------//

Route::get('/admin/tables/create', [AddTablesController::class, 'create'])->name('tables.create');
Route::post('/admin/tables/store', [AddTablesController::class, 'store'])->name('tables.store');
// Route::get('/mesas/preview', [AddTablesController::class, 'preview'])->name('addTables.preview');


//----------------------------ESPACIOS--------------------------------------------------------//
Route::get('/admin/spaces/create', [SpaceController::class, 'create'])->name('spaces.create');
Route::post('/admin/spaces/store', [SpaceController::class, 'store'])->name('spaces.store');


Route::middleware(['auth', 'admin'])->group(function () {
    // Ruta para el dashboard de admin
    // Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Ruta para gestionar reservas
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::resource('reservations', ReservationController::class);

    // Ruta para crear un nuevo usuario
    Route::get('/admin/create-user', [UserController::class, 'create'])->name('admin.createUser');
    Route::post('/admin/create-user', [UserController::class, 'store'])->name('admin.storeUser');
});

//--------------------------RESERVATION-----------------------------------------------------------------//
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::resource('reservations', ReservationController::class);


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [LoginController::class, 'index'])->name('admin.dashboard');
});
