<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\HomeController;

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

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'home');
    Route::get('/', 'home')->name('home');
});
Route::controller(TopicController::class)->group(function () {
    Route::get('/topic/all', 'all_topic')->name('all_topic');
    Route::get('/class/{year}/{class_type}/topic/all', 'single_class_topic')->name('single_class_topic');
    Route::get('/topic/keyword/{keyword}', 'specified_keyword_topic')->name('specified_keyword_topic');
    Route::get('/class/{year}/{class_type}/topic/{topic_id}', 'specified_topic')->name('specified_topic');

//    Route::get('/topic/search','search_topic')->name('search_topic');
});


Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('CheckLoginPage');
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
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/inbox', 'inbox')->name('inbox');
    });
    Route::controller(TeamController::class)->group(function () {
        //邀請通知動作處理
        Route::get('/team/{team_id}/invite/{action_type}', 'edit')->name('edit_invite_state');
        //所有組別
        Route::get('/teams/{year?}/{class_type?}', 'index')->name('teams');

        //我的組別
        Route::get('/team', 'my_team_index')->name('my_team');

        //建立組別
        Route::get('/team/create', 'create_team_page')->name('create_team_page');
        Route::post('/team/create', 'store')->name('post_create_team')->middleware('auth:sanctum');
    });
    Route::controller(TopicController::class)->group(function () {
        //我的組別
        Route::get('/topic', 'my_topic')->name('my_topic');
        Route::get('/topic/all', 'topics')->name('topics');
        Route::get('/topic/{year}/all', 'specified_year_topics')->name('specified_year_topics');
    });
});

