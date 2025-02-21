<?php

use App\Http\Controllers\admin\CarreraController;
use App\Http\Controllers\admin\EstudianteController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\admin\ProyectoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home.index');
    Route::get('carrera', [CarreraController::class, 'index'])->name('carrera.index');
    Route::post('carrera', [CarreraController::class, 'store'])->name('carrera.store');
    Route::put('carrera/{id}', [CarreraController::class, 'update'])->name('carrera.update');
    Route::delete('carrera/{id}', [CarreraController::class, 'destroy'])->name('carrera.destroy');


    Route::get('estudiante', [EstudianteController::class, 'index'])->name('estudiante.index');
    Route::post('estudiante', [EstudianteController::class, 'store'])->name('estudiante.store');
    Route::put('estudiante/{id}', [EstudianteController::class, 'update'])->name('estudiante.update');
    Route::delete('estudiante/{id}', [EstudianteController::class, 'destroy'])->name('estudiante.destroy');
    
    Route::get('proyecto', [ProyectoController::class, 'index'])->name('proyecto.index');
    Route::post('proyecto', [ProyectoController::class, 'store'])->name('proyecto.store');
    Route::put('proyecto/{id}', [ProyectoController::class, 'update'])->name('proyecto.update');
    Route::delete('proyecto/{id}', [ProyectoController::class, 'destroy'])->name('proyecto.destroy');
    
    
});

require __DIR__.'/auth.php';
