<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SaloonController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\Service_EmployeeController;
use App\Http\Controllers\Admin\ViewController;
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

//  Города
    Route::get('cities/', [CityController::class, 'index'])->name('admin.cities');

    Route::get('cities/create', [CityController::class, 'create'])->name('admin.cities.create');

    Route::post('cities/', [CityController::class, 'store'])->name('admin.cities.store');

    Route::get('cities/{city}', [CityController::class, 'show'])->name('admin.cities.show');

    Route::put('cities/{city}/edit', [CityController::class, 'edit'])->name('admin.cities.edit');

    Route::delete('cities/{city}/destroy', [CityController::class, 'destroy'])->name('admin.cities.destroy');

//  Роли
    Route::get('roles/', [RoleController::class, 'index'])->name('admin.roles');

    Route::get('roles/create', [RoleController::class, 'create'])->name('admin.roles.create');

    Route::post('roles/', [RoleController::class, 'store'])->name('admin.roles.store');

    Route::get('roles/{role}', [RoleController::class, 'show'])->name('admin.roles.show');

    Route::put('roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');

    Route::delete('roles/{role}/destroy', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

// Типы
    Route::get('views/', [ViewController::class, 'index'])->name('admin.views');

    Route::get('views/create', [ViewController::class, 'create'])->name('admin.views.create');

    Route::post('views/', [ViewController::class, 'store'])->name('admin.views.store');

    Route::get('views/{view}', [ViewController::class, 'show'])->name('admin.views.show');

    Route::put('views/{view}/edit', [ViewController::class, 'edit'])->name('admin.views.edit');

    Route::delete('views/{view}/destroy', [ViewController::class, 'destroy'])->name('admin.views.destroy');

// Сотрудники_Услуги
    Route::get('service_employees/', [Service_EmployeeController::class, 'index'])->name('admin.service_employees');

    Route::get('service_employees/create', [Service_EmployeeController::class, 'create'])->name('admin.service_employees.create');

    Route::post('service_employees/', [Service_EmployeeController::class, 'store'])->name('admin.service_employees.store');

    Route::get('service_employees/{service_employee}', [Service_EmployeeController::class, 'show'])->name('admin.service_employees.show');

    Route::put('service_employees/{service_employee}/edit', [Service_EmployeeController::class, 'edit'])->name('admin.service_employees.edit');

    Route::delete('service_employees/{service_employee}/destroy', [Service_EmployeeController::class, 'destroy'])->name('admin.service_employees.destroy');
});
