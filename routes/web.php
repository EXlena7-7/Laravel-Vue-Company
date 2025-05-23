<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    if (Auth::check()) {
        // Si el usuario está autenticado, redirige al dashboard
        return redirect()->route('dashboard');
    }
    // Si no está autenticado, muestra la vista de login
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/login', function () {
//     return Inertia::render('Auth/Login', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
    Route::get('graphic', [EmployeeController::class, 'EmployeeByDepartment'])->name('graphic');
    Route::get('reports', [EmployeeController::class, 'reports'])->name('reports');
});

require __DIR__.'/auth.php';
