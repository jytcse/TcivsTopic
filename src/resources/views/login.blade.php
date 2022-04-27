@extends('layouts.basic')

@section('title')
    登入
@endsection
@section('style')
    <link rel="stylesheet"
          href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet"
          href="{{ asset('css/loginStyle.css') }}"/>
@endsection


@section('body')
    <main class="container loginFormContainer ">
        <form class="row my-3 px-2" method="post" action="/login">
            @csrf
            <div class="col-md-12 mt-5">
                <div>
                    <h3 class="text-center">登入</h3>
                </div>
            </div>
            <div class=" @error('cantFind') is-invalid @enderror"
                 id="asd"></div>
            <div id="asd" class="invalid-feedback">
                @error('cantFind')
                {{ $message }}
                @enderror
            </div>
            <div class="col-md-12 my-2">
                <label for="studentIdInput" class="form-label align-text-bottom">帳號
                    <span class="material-symbols-outlined align-text-bottom">
                    account_circle
                    </span>
                </label>
                <input type="text" class="form-control @error('student_id') is-invalid @enderror"
                       id="studentIdInput" autofocus name="student_id" value="810612" placeholder="你的帳號"
                       required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div id="studentIdInput" class="invalid-feedback">
                    @error('student_id')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="col-md-12 my-2">
                <label for="password" class="form-label">密碼
                    <span class="material-symbols-outlined align-text-bottom">
                    lock
                    </span>
                </label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" value="123" placeholder="你的密碼" required
                >
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div id="passwordInput" class="invalid-feedback">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="col-12 mt-3 mb-4 text-end">
                <button class="customLoginBtn" type="submit">登入</button>
            </div>
        </form>
    </main>
@endsection
@section('script')

@endsection
