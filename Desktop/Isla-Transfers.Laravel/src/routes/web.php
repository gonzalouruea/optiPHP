<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ParticularController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VehicleController;
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

// Rutas de la pagina principal (FrontEnd estático)
Route::get('/', function () {
    return view('welcome'); // Aquí se cargará la vista de la pagina principal.
})->name('home');

// Rutas para viajeros
Route::get('/viajero/register', [ViajeroController::class, 'create'])->name('viajero.create');
Route::post('/viajero/register', [ViajeroController::class, 'store'])->name('viajero.store');

// Rutas de autenticación (Registro y Login)
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas para el perfil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rutas del Panel de Administración (protegidas por autenticación y rol)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Rutas para las reservas
    Route::get('/reservations', [ReservationController::class, 'index'])->name('admin.reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('admin.reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('admin.reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('admin.reservations.show');
    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('admin.reservations.edit');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('admin.reservations.update');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('admin.reservations.destroy');
    // Ruta para el calendario
    Route::get('/reservations/calendar', [ReservationController::class, 'calendar'])->name('admin.reservations.calendar');
    // Rutas para los hoteles
    Route::resource('hotels', HotelController::class);
    // Rutas para los vehiculos
    Route::resource('vehicles', VehicleController::class);
});

// Rutas del Panel de Usuario Particular (protegidas por autenticación y rol)
Route::middleware(['auth', 'role:usuario'])->prefix('particular')->group(function () {
    Route::get('/dashboard', [ParticularController::class, 'index'])->name('particular.dashboard');
    // Rutas para las reservas
    Route::get('/reservations', [ReservationController::class, 'index'])->name('particular.reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('particular.reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('particular.reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('particular.reservations.show');
});
