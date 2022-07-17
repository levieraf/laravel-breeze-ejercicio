<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AlumnoController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tutor', function () {
    return Inertia::render('Tutor');
})->middleware(['auth', 'verified'])->name('tutor');

Route::get('/alumno', function () {
    return Inertia::render('Alumno');
})->middleware(['auth', 'verified'])->name('alumno');

Route::post('/alumno/subir-actividad', [AlumnoController::class, 'store'])->middleware(['auth'])->name('alumno.subir-actividad');

Route::get('/jurado', function () {
    return Inertia::render('Jurado');
})->middleware(['auth', 'verified'])->name('jurado');

Route::get('/director', function () {
    return Inertia::render('Director');
})->middleware(['auth', 'verified'])->name('director');

require __DIR__.'/auth.php';
