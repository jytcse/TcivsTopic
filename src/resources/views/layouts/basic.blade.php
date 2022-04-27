<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Roboto&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Noto Sans TC', sans-serif;
        }
    </style>
    <style>
        .navbar-brand span {
            font-size: 1.6rem;
            color: rgba(0, 0, 0, 0.87);
            /*font-weight: bold;*/
        }

        .nav-link {
            font-size: 1.1rem;
            color: rgba(0, 0, 0, 0.87);
            font-weight: bold;
            position: relative;
        }
        /*下畫線動畫*/
        .nav-link:not(.active)::before {
            content: '';
            position: absolute;
            height: 0.1rem;
            background-color: black;
            bottom: 0;
            left: 0;
            right: 0;
            transform: scale(0);
            transition: transform .3s ease-in-out;
        }

        .nav-link:hover::before {
            transform: scale(1);
        }

        .nav-link.active {
            color: #6c757d;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e")

        }
        .dropdown-menu{
            min-width: 5rem;
        }
    </style>
    <title>@yield('title')-中工資訊專題網</title>
    @yield('style')
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top bg-white">
    <div class="container-fluid mt-3">
        <a class="navbar-brand align-items-center ms-4 pt-1" href="/">
            <img src="/img/cseLogo.jpg" alt="" width="35" height="35" class="d-inline-block align-text-bottom">
            <p style="display: inline-block">
                <span style="font-weight: bold">中工資訊</span>
{{--                <span>專題網</span>--}}
            </p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 me-5 mb-lg-0">
                <li class="nav-item mx-3">
                    <a class="nav-link {{(Request::path()=='/')?'active':''}}" aria-current="page" href="/">首頁</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link {{(Request::path()=='all')?'active':''}}" href="/all">專題</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link {{(Request::path()=='search')?'active':''}}" href="/search">搜尋</a>
                </li>
                @auth
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{\Illuminate\Support\Facades\Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/dashboard">前往後臺</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/logout">把我登出</a></li>
                        </ul>
                    </li>
                @endauth
                @guest

                    <li class="nav-item ms-3">
                        {{--                    @if(Request::path()!='login')--}}
                        <a class="nav-link {{(Request::path()=='login')?'active':''}}" href="{{route('login')}}">登入</a>
                        {{--                    @endif--}}
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@yield('body')


@yield('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
