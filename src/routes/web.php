<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
})->name('home');
Route::get('/home', function () {
    return view('home');
});
Route::get('/topic', function () {
    return view('topic');
})->name('all_topic');

Route::get('/search', function () {
    return view('search');
})->name('search_topic');


Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('CheckLoginPage');;
Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->name('logout');
});
//需驗證登入狀態
Route::middleware('CheckLogin')->prefix('/manage')->group(function () {
    //後台首頁
    //dashboard = 個人資料 修改密碼 顯示所屬組別的專題
    //team = 列出所有隊伍 可建立隊伍 建立隊伍者為 隊長
    //topic = 創立專題
    Route::get('/', function () {
        return view('manage.dashboard');
    });
    Route::get('/dashboard', function () {
        return view('manage.dashboard');
    })->name('dashboard');
//    Route::get('/topic', function () {
//        return view('manage.dashboard');
//    })->name('topic');
//    Route::get('/team', function () {
//        return view('manage.team');
//    });

//    Route::get('/topic', function () {
//        return view('manage.topic');
//    });

});
