<?php

use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\TeamApiController;
use App\Http\Controllers\Api\TopicApiController;
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


Route::middleware('auth:sanctum')->post('/team/{team_id}/topic/edit', [TopicApiController::class, 'edit'])->name('topic_edit');
Route::middleware('auth:sanctum')->post('/team/{team_id}/topic/save', [TopicApiController::class, 'save'])->name('topic_save');
Route::middleware('auth:sanctum')->post('/team/{team_id}/topic/thumbnail/save', [TopicApiController::class, 'upload_thumbnail'])->name('topic_thumbnail_upload');
Route::middleware('auth:sanctum')->post('/team/{team_id}/topic/doc/save', [TopicApiController::class, 'upload_doc'])->name('topic_doc_upload');

Route::middleware('auth:sanctum')->post('/ckeditor/image/upload',[\App\Http\Controllers\ImageController::class,'ckeditor_store'])->name('ckeditor_image_upload');
Route::middleware('auth:sanctum')->post('/ckeditor/image/delete',[\App\Http\Controllers\ImageController::class,'ckeditor_destroy'])->name('ckeditor_image_delete');
////取的使用者的邀請
//Route::middleware('auth:sanctum')->get('/user/{user_id}/inbox', [UserApiController::class, 'show_inbox_invite'])->name('get_invite_info');
