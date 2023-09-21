<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Teammate;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});

//只有有自己可以讀取收件夾
Broadcast::channel('User.Message.box.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});
//專題編輯頻道
Broadcast::channel('Topic.Edit.{team_id}', function ($user, $team_id) {
    //當前使用者沒有組別
    if (Teammate::query()->where('user_id', '=', (int)$user->id)->count() == 0) {
        return false;
    }
    $team_id_data = Teammate::query()->where('user_id', '=', (int)$user->id)->pluck('team_id')[0];
    if ($team_id != $team_id_data) {
        return false;
    }
    return true;
});
