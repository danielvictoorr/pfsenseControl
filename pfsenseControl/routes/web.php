<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/firewall', [\App\Http\Controllers\FirewallController::class, 'index'])->name('firewall');

Route::get('/users', function () {
    return view('users');
})->name('users');

Route::get('/users', [UserController::class, 'index'])->name('users');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');


Route::post('/firewall', [\App\Http\Controllers\FirewallController::class, 'store'])->name('firewall.store');




