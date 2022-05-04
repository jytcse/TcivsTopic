@extends('layouts.admin-basic')
@section('title')
    儀錶板
@endsection
@section('style')
    {{--  儀錶板css  --}}
    <link href="{{ asset('css/manageDashboard.css')}}" rel="stylesheet">
@endsection

@section('body')
    <main>
        <div class="container">
            <div class="d-flex dashboard_container justify-content-center align-items-center">
                <div class="row dashboard_row">
                    <div class="col-3 left_side px-0">
                        <div class="text-center sidebar_name  user-select-none position-relative">
                            控制面板
                            {{--                            <div class="position-absolute top-50 end-0 translate-middle-y me-3">--}}
                            {{--                                <span class="material-symbols-outlined">--}}
                            {{--                                    arrow_left--}}
                            {{--                                </span>--}}
                            {{--                            </div>--}}
                        </div>

                        <ul class="sidebar user-select-none">
                            <li class="ps-4">
                                <a href="{{ route('dashboard') }}" class=" w-100 h-100">
                                <span class="material-symbols-outlined">
                                        person
                                    </span>
                                    我的資訊
                                </a>
                            </li>
                            <li>
                                <div class=" position-relative custom_dropdown show">
                                    <span class="material-symbols-outlined">
                                        group
                                    </span>
                                    組別
                                    <div class=" position-absolute  top-50 end-0 translate-middle-y me-3">
                                        <span
                                            class="material-symbols-outlined">
                                        arrow_drop_down
                                    </span>
                                    </div>
                                </div>
                                <ul class="sub_ul">
                                    <li><a href="{{ route('dashboard') }}">我的組別</a></li>
                                    <li><a href="{{ route('dashboard') }}">所有組別</a></li>
                                </ul>
                            </li>
                            <li>
                                <div class=" position-relative custom_dropdown show">
                                    <span class="material-symbols-outlined">
                                    topic
                                    </span>
                                    專題
                                    <div class=" position-absolute  top-50 end-0 translate-middle-y me-3">
                                        <span
                                            class="material-symbols-outlined">
                                        arrow_drop_down
                                    </span>
                                    </div>
                                </div>
                                <ul class="sub_ul">
                                    <li><a href="{{ route('dashboard') }}">我的專題</a></li>
                                    <li><a href="{{ route('dashboard') }}">所有組別</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('logout') }}" class="d-block w-100 h-100">
                                <span class="material-symbols-outlined">
                                    logout
                                </span>登出
                                </a>
                            </li>
                        </ul>
                    </div>


                    {{--                    <ul class="col-3 left_side">控制面板--}}
                    {{--                        <li><a href="{{ route('dashboard') }}">儀錶板</a></li>--}}
                    {{--                                            <ul>組別--}}
                    {{--                                                <li><a href="{{ route('dashboard') }}">我的組別</a></li>--}}
                    {{--                                                <li><a href="{{ route('dashboard') }}">所有組別</a></li>--}}
                    {{--                                            </ul>--}}
                    {{--                                            <ul>專題--}}
                    {{--                                                <li><a href="{{ route('dashboard') }}">我的專題</a></li>--}}
                    {{--                                                <li><a href="{{ route('dashboard') }}">所有組別</a></li>--}}
                    {{--                                            </ul>--}}
                    {{--                        <li><a href="{{ route('logout') }}">登出</a></li>--}}
                    {{--                    </ul>--}}


                    <div class="col-9 right_side">
                        1231231
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        // const left_side = document.querySelector('.left_side');
        // const right_side = document.querySelector('.right_side');
        // left_side.addEventListener('click', function () {
        //     // console.log('123');
        //     // this.classList.toggle('col-3');
        //     // this.classList.toggle('d-none');
        //     // right_side.classList.toggle('col-12');
        //     // this.classList.toggle('w-0');
        // });
        const custom_dropdown = document.querySelectorAll('.custom_dropdown')
        custom_dropdown.forEach((element) => {
            element.addEventListener('click', () => {

                // console.log(e.target);
                element.classList.toggle('show');
            })
        });
    </script>
@endsection
