<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AdminController;
use \App\Http\Controllers\Admin\ServiceController;

Route::prefix('admin')->group( function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

//  Услуги
    Route::get('services/', [ServiceController::class, 'index'])->name('admin.services');

    Route::get('services/create', [ServiceController::class, 'create'])->name('admin.services.create');

    Route::post('services/', [ServiceController::class, 'store'])->name('admin.services.store');

    Route::get('services/{service}', [ServiceController::class, 'show'])->name('admin.services.show');

    Route::put('services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');

    Route::delete('services/{service}/destroy', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

//  Сотрудники
    Route::get('employees/', [ServiceController::class, 'index'])->name('admin.employees');

    Route::get('employees/create', [ServiceController::class, 'create'])->name('admin.employees.create');

    Route::post('employees/', [ServiceController::class, 'store'])->name('admin.employees.store');

    Route::get('employees/{employee}', [ServiceController::class, 'show'])->name('admin.employees.show');

    Route::put('employees/{employee}/edit', [ServiceController::class, 'edit'])->name('admin.employees.edit');

    Route::delete('employee/{employee}/destroy', [ServiceController::class, 'destroy'])->name('admin.employees.destroy');

//  Салоны
    Route::get('saloons/', [ServiceController::class, 'index'])->name('admin.saloons');

    Route::get('saloons/create', [ServiceController::class, 'create'])->name('admin.saloons.create');

    Route::post('saloons/', [ServiceController::class, 'store'])->name('admin.saloons.store');

    Route::get('saloons/{saloon}', [ServiceController::class, 'show'])->name('admin.saloons.show');

    Route::put('saloons/{saloon}/edit', [ServiceController::class, 'edit'])->name('admin.saloons.edit');

    Route::delete('saloons/{saloon}/destroy', [ServiceController::class, 'destroy'])->name('admin.saloons.destroy');

//  Должности
    Route::get('posts/', [ServiceController::class, 'index'])->name('admin.posts');

    Route::get('posts/create', [ServiceController::class, 'create'])->name('admin.posts.create');

    Route::post('posts/', [ServiceController::class, 'store'])->name('admin.posts.store');

    Route::get('posts/{post}', [ServiceController::class, 'show'])->name('admin.posts.show');

    Route::put('posts/{post}/edit', [ServiceController::class, 'edit'])->name('admin.posts.edit');

    Route::delete('post/{post}/destroy', [ServiceController::class, 'destroy'])->name('admin.posts.destroy');
});
