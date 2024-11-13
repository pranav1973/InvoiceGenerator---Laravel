<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    // Route::get('invoices/create', [InvoicesController::class, 'create'])->name('invoices.create');

    Route::resource('invoices', InvoicesController::class);
    Route::get('invoices/download/{id}', [InvoicesController::class, 'download'])->name('invoices.download');
    Route::resource('customers', CustomersController::class);
    Route::resource('products', ProductController::class);
});
