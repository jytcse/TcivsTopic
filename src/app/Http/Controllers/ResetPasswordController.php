<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    //驗證使用者給的值，並用該信箱寄驗證信
    public function forget_password_post(Request $request)
    {
        if (auth()->id() == null) {
            return redirect()->route('login');
        }
        $request->validate(['email' => 'required|email']);

        $token = Str::random(150);
        $email_code = Str::random(5);
        DB::table('password_resets')->where(['user_id' => auth()->id()])->delete();
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'user_id' => auth()->id(),
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.reset-password-email', ['token' => $token, 'id' => auth()->id(), 'name' => auth()->user()->name, 'email_code' => $email_code], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('更改密碼驗證');
            $message->cc(env('MAIL_COPY_TO', null));
        });
        return back()->with(['mail_success' => ['email' => $request->email, 'code' => $email_code]]);

    }

    //從信箱點擊信件，回傳重置密碼頁面
    public function reset_password_page($id, $token)
    {
        return view('reset-password', ['token' => $token, 'id' => $id]);
    }

    public function reset_password(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'id' => 'required|numeric',
            'password' => 'required|min:8|max:20|confirmed',
        ]);


        $reset_password_query = DB::table('password_resets')->where([['user_id', '=', $request->id], ['token', '=', $request->token]]);
        if ($reset_password_query->count() == 0) {
            return back()->withInput()->with('error', '未驗證的token!');
        }
        $user_id = $reset_password_query->pluck('user_id')[0];
        $user_query = User::query()->where('id', '=', $user_id);
        if ($user_query->count() == 0) {
            return back()->withInput()->with('error', '未驗證的token!');
        }
        DB::beginTransaction();
        try {
            $user_query->update(['password' => Hash::make($request->password)]);
            $email = $reset_password_query->pluck('email')[0];
            DB::table('password_resets')->where(['user_id' => $request->id])->delete();
            DB::commit();
            Auth::logout();

            Mail::send('email.reset-password-success', ['name' => $user_query->pluck('name')[0]], function ($message) use ($email) {
                $message->to($email);
                $message->subject('更改密碼成功');
                $message->cc(env('MAIL_COPY_TO', null));
            });
            return redirect()->route('login')->with('message', '已成功修改密碼!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', '與資料庫互動時發生錯誤!');
        }
    }
}
