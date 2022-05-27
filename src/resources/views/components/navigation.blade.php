<header>
    <nav class="navbar navbar-expand-lg sticky-top bg-white user-select-none">
        <div class="container-fluid mt-3">
            <a class="navbar-brand align-items-center ms-4 pt-1" href="{{route('home')}}">
                <img src="{{ asset('/img/cseLogo.jpg') }}" alt="" width="35" height="35"
                     class="d-inline-block align-text-bottom ms-3">
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
                        <a class="nav-link {{(Request::path()=='/')?'active':''}}" aria-current="page"
                           href="{{route('home')}}">首頁</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link {{(Request::path()=='all')?'active':''}}"
                           href="{{  route('all_topic') }}">專題</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link {{(Request::path()=='search')?'active':''}}"
                           href="{{ route('search_topic') }}">搜尋</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                {{\Illuminate\Support\Facades\Auth::user()->name}}

                                @if(\Illuminate\Support\Facades\Auth::user()->identity_id===1)
                                    同學
                                @elseif(\Illuminate\Support\Facades\Auth::user()->identity_id===2)
                                    老師
                                @endif
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">前往後臺</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">把我登出</a></li>
                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item ms-3">
                            {{--                    @if(Request::path()!='login')--}}
                            <a class="nav-link {{(Request::path()=='login')?'active':''}}"
                               href="{{route('login')}}">登入</a>
                            {{--                    @endif--}}
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
