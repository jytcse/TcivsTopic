<?php

use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\TeamApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    return '123';
//    return '123';
});

//取得可以邀請的使用者
Route::middleware('auth:sanctum')->get('/class/{class_id}/user/available', [UserApiController::class, 'show'])->name('get_available_user');

////取的使用者的邀請
//Route::middleware('auth:sanctum')->get('/user/{user_id}/inbox', [UserApiController::class, 'show_inbox_invite'])->name('get_invite_info');
