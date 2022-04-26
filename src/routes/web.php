<?php

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

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/all', function () {
    return view('all');
});
Route::get('/search', function () {
    return view('search');
});

Route::get('/login', function () {
    return view('login');
})->name('loginPage');
Route::post('/login', function () {
//    return ;
});
