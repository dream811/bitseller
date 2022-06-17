<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/we', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');

Auth::routes();


Route::get('/home_admin', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
