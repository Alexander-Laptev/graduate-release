<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SaloonController;
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
    Route::get('employees/', [EmployeeController::class, 'index'])->name('admin.employees');

    Route::get('employees/create', [EmployeeController::class, 'create'])->name('admin.employees.create');

    Route::post('employees/', [EmployeeController::class, 'store'])->name('admin.employees.store');

    Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('admin.employees.show');

    Route::put('employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('admin.employees.edit');

    Route::delete('employee/{employee}/destroy', [EmployeeController::class, 'destroy'])->name('admin.employees.destroy');

//  Салоны
    Route::get('saloons/', [SaloonController::class, 'index'])->name('admin.saloons');

    Route::get('saloons/create', [SaloonController::class, 'create'])->name('admin.saloons.create');

    Route::post('saloons/', [SaloonController::class, 'store'])->name('admin.saloons.store');

    Route::get('saloons/{saloon}', [SaloonController::class, 'show'])->name('admin.saloons.show');

    Route::put('saloons/{saloon}/edit', [SaloonController::class, 'edit'])->name('admin.saloons.edit');

    Route::delete('saloons/{saloon}/destroy', [SaloonController::class, 'destroy'])->name('admin.saloons.destroy');

//  Должности
    Route::get('posts/', [PostController::class, 'index'])->name('admin.posts');

    Route::get('posts/create', [PostController::class, 'create'])->name('admin.posts.create');

    Route::post('posts/', [PostController::class, 'store'])->name('admin.posts.store');

    Route::get('posts/{post}', [PostController::class, 'show'])->name('admin.posts.show');

    Route::put('posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');

    Route::delete('post/{post}/destroy', [PostController::class, 'destroy'])->name('admin.posts.destroy');
});
