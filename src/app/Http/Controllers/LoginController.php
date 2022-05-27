<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'student_id' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $token = User::query()->where('id', '=', Auth::id())->get()[0]->createToken('x-accessToken');
            return redirect()->route('dashboard')->cookie('x-access-token', $token->plainTextToken);
        }
        return back()->withErrors([
            'cantFind' => '帳號或密碼錯誤',
        ])->onlyInput('student_id');
    }

    public function logout(Request $request)
    {
        if ($request->user() != null) {
            $request->user()->tokens()->delete();
        }
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        //
    }
}
