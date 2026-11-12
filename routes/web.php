<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{CategoryController, DashboardController, ItemController, ProfileController};

Route::get('/', function () {
    return view('welcome');
});

// Group agar routing wajib authentication dulu
Route::middleware(['auth', 'verified'])->group(function () {

    // Area dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->name('dashboard');

    // Area Category
    Route::get('/categories', [CategoryController::class,'index'])->name('category.index');
    Route::post('/categories', [CategoryController::class,'store'])->name('category.store');
    Route::get('/categories/{param}', [CategoryController::class,'show'])->name('category.show');
    Route::put('/categories/{param}', [CategoryController::class,'update'])->name('category.update');
    Route::delete('/categories/{param}', [CategoryController::class,'delete'])->name('category.delete');

    Route::resource('/items', ItemController::class);


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
