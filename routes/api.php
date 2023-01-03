<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessagesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return ('api working');
});

Route::post('/register', [RegisterController::class, 'store'])->name('store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/change', [LoginController::class, 'change'])->name('change');
Route::post('/reset/{useremail}', [LoginController::class, 'reset'])->name('reset');
Route::get('/clients-read/{query?}', [ClientController::class, 'read'])->name('read');
Route::post('/order-create', [OrderController::class, 'store'])->name('store');
Route::post('/client-create', [ClientController::class, 'store'])->name('store');
Route::get('/orders-read/{query?}', [OrderController::class, 'read'])->name('read');
Route::get('/order-start/{id}', [OrderController::class, 'start'])->name('start');
Route::get('/order-complete/{id}', [OrderController::class, 'complete'])->name('complete');
Route::get('/order-cancel/{id}', [OrderController::class, 'cancel'])->name('cancel');
Route::get('/order-tracker/{order_number}', [OrderController::class, 'tracker'])->name('tracker');
Route::get('/dashboard', [DashboardController::class, 'read'])->name('read');
Route::get('/sendmail', [MailController::class, 'index'])->name('index');
Route::post('/message-create', [MessagesController::class, 'store'])->name('store');
Route::get('/message-read', [MessagesController::class, 'read'])->name('read');
Route::get('/download/{id}', [OrderController::class, 'download'])->name('download');
Route::get('/delete/{id}', [OrderController::class, 'destroy'])->name('destroy');
Route::get('/message-readView/{id}', [MessagesController::class, 'readView'])->name('readView');
Route::get('/message-deleteView/{id}', [MessagesController::class, 'destroy'])->name('destroy');

Route::get('/orders-read-completed/{query?}', [OrderController::class, 'completed'])->name('completed');
Route::get('/orders-read-pending/{query?}', [OrderController::class, 'pending'])->name('pending');
Route::get('/orders-read-cancelled/{query?}', [OrderController::class, 'cancelled'])->name('cancelled');

Route::middleware(['auth:sanctum'])->group(function () {    
});


    
    
    