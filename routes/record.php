<?php

use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\AdminController;
use \App\Http\Controllers\Admin\ServiceController;

Route::prefix('record')->group( function () {
    Route::get('/', [RecordController::class, 'index'])->name('record');

//  Города
    Route::get('city/', [RecordController::class, 'city'])->name('record.city');

    Route::post('city/', [RecordController::class, 'cityStore'])->name('record.city.store');

//  Услуги
    Route::get('service/', [RecordController::class, 'service'])->name('record.service');

    Route::post('service/', [RecordController::class, 'serviceStore'])->name('record.service.store');

//  Сотрудники
    Route::get('employee/', [RecordController::class, 'employee'])->name('record.employee');

    Route::post('employee/', [RecordController::class, 'employeeStore'])->name('record.employee.store');

//  Салоны
    Route::get('saloon/', [RecordController::class, 'saloon'])->name('record.saloon');

    Route::post('saloon/', [RecordController::class, 'saloonStore'])->name('record.saloon.store');

//  Дата и время
    Route::get('date/', [RecordController::class, 'date'])->name('record.date');

    Route::post('date/', [RecordController::class, 'dateStore'])->name('record.date.store');

// Заказ
    Route::get('order/', [RecordController::class, 'order'])->name('record.order');

    Route::post('order/', [RecordController::class, 'orderStore'])->name('record.order.store');

});
