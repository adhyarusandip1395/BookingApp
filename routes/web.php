<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register',[CustomerController::class,'register'])->name('customer.register');
Route::post('/login',[CustomerController::class,'login'])->name('customer.login');

Route::get('/verify/{id}/{hash}', [CustomerController::class, 'verify'])->name('verify');

Route::group(['middleware' => ['auth']], function () {
   
    Route::get('/dashboard', [BookingController::class, 'list'])->name('booking.list');

    Route::get('/booking/add',[BookingController::class,'add'])->name('booking.add');

    Route::post('/booking/store',[BookingController::class,'store'])->name('booking.store');

    Route::get('/logout', [CustomerController::class, 'logout'])->name('customer.logout');
});
