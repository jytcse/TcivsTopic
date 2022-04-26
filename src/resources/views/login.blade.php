@extends('layouts.basic')

@section('title')
    登入
@endsection
@section('style')
    <link rel="stylesheet"
          href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0,
            'wght' 300,
            'GRAD' 0,
            'opsz' 20
        }
    </style>
    <style>


        .customLoginBtn {
            border: 1px solid black;
            border-radius: 0;
            width: 100%;
            color: white;
            background-color: black;
        }

        .customLoginBtn:hover {
            color: #000000;
            background-color: #ffffff;
        }

        .form-control.is-invalid:focus, .was-validated .form-control:invalid:focus {
            box-shadow: 0 0 0 0.15rem rgb(220 53 69 / 25%);
        }

        .form-control.is-valid:focus, .was-validated .form-control:valid:focus {
            box-shadow: 0 0 0 0.15rem rgb(25 135 84 / 25%);
        }

        .form-control {
            border-radius: unset;
            border-color: black;
        }

        .form-control:focus {
            box-shadow: none;
        }
        @media screen and (min-width: 1140px ) {
            .loginFormContainer {
                width: 30%;
                position: relative;
                box-shadow: 0 3px 2px -3px rgb(0 0 0 / 20%), 2px 2px 3px 0 rgb(0 0 0 / 20%), -1px 0px 3px 0 rgb(0 0 0 / 20%);

            }
            .customLoginBtn {
                width: 8rem;
                position: relative;
            }
            .customLoginBtn::before{
                content: '';
                background-color: black;
                border: 1px solid black;
                z-index: -1;
                width: 100%;
                height: 100%;
                position: absolute;
                bottom: 0;
                left: 0;
                transition: all 0.25s ease-in-out;
            }
            .customLoginBtn:hover::before{
                bottom: 0.4rem;
                left: 0.3rem;
            }
        }
    </style>
@endsection


@section('body')
    <div class="container loginFormContainer ">
        <form class="row my-3 px-2" method="post" action="/login">
            @csrf
            <div class="col-md-12 mt-5">
                <div>
                    <h3 class="text-center">登入</h3>
                </div>
            </div>
            <div class="col-md-12 my-2">
                <label for="studentIdInput" class="form-label align-text-bottom">帳號
                    <span class="material-symbols-outlined align-text-bottom">
                    account_circle
                    </span>
                </label>
                <input type="text" class="form-control is-valid" id="studentIdInput" value="810612" placeholder="你的帳號"
                       required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div id="studentIdInput" class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
            <div class="col-md-12 my-2">
                <label for="passwordInput" class="form-label">密碼
                    <span class="material-symbols-outlined align-text-bottom">
                    lock
                    </span>
                </label>
                <input type="password" class="form-control is-invalid" id="passwordInput" value="123" placeholder="你的密碼"
                       required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div id="passwordInput" class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>

            <div class="col-12 mt-3 mb-4 text-end">
                <button class="btn customLoginBtn" type="submit">登入</button>
            </div>
        </form>
    </div>
@endsection
@section('script')

@endsection
