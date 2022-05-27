@extends('layouts.basic')

@section('title')
    重置密碼
@endsection
@section('style')
    <link rel="stylesheet"
          href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet"
          href="{{ asset('css/loginStyle.css') }}"/>
@endsection


@section('body')
    <main class="container loginFormContainer ">

        <form class="row my-3 px-2" method="post" action="{{route('password.reset')}}">
            @csrf
            <div class="col-md-12 mt-5">
                <div>
                    <h3 class="text-center">重置密碼</h3>
                </div>
            </div>
            <div class=" @error('cantFind') is-invalid @enderror"
                 id="asd"></div>
            <div id="asd" class="invalid-feedback">
                @error('cantFind')
                {{ $message }}
                @enderror
            </div>
            @if(session()->has('error'))
                <div class="alert alert-warning" role="alert">
                    {{session()->get('error')}}
                </div>
            @endif
            <div class="col-md-12 my-2">
                <label for="password" class="form-label">新密碼
                    <span class="material-symbols-outlined align-text-bottom">
                    lock
                    </span>
                </label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" placeholder="新密碼" required
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
            <div class="col-md-12 my-2">
                <label for="password" class="form-label">確認密碼
                    <span class="material-symbols-outlined align-text-bottom">
                    check_circle
                    </span>
                </label>
                <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror"
                       id="password_confirmation" placeholder="再輸入一次新密碼" required
                >
                <div class="valid-feedback">
                    Looks good!
                </div>
                <input type="hidden" name="id" value="{{$id}}">
                <div id="passwordInput" class="invalid-feedback">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
                <input type="hidden" name="token" value="{{$token}}">

            </div>

            <div class="col-12 mt-3 mb-4 text-end">
                <button class="customLoginBtn" type="submit">送出</button>
            </div>
        </form>
    </main>
@endsection
@section('script')

@endsection
