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

    Route::get('service/', [RecordController::class, 'service'])->name('record.service');

    Route::post('service/', [RecordController::class, 'serviceStore'])->name('record.service.store');

    Route::get('employee/', [RecordController::class, 'employee'])->name('record.employee');

    Route::post('employee/', [RecordController::class, 'employeeStore'])->name('record.employee.store');

    Route::get('saloon/', [RecordController::class, 'saloon'])->name('record.saloon');

    Route::post('saloon/', [RecordController::class, 'saloonStore'])->name('record.saloon.store');

});
