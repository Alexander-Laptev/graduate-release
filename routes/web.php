<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Profile\OrderController;
use App\Http\Controllers\Profile\ProfileController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

//Route::get('/dashboard', function () {
//    return view('record');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('profile')->group(function () {

    //Профиль
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Заказы пользователя
    Route::get('/orders', [OrderController::class, 'index'])->name('profile.orders');

    Route::delete('orders/{order}/destroy', [OrderController::class, 'destroy'])->name('profile.orders.destroy');

});

require __DIR__.'/auth.php';
