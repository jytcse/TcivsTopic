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
                    {{--123--}}
                    <ul class="col-3 left_side">
                        {{--                        123--}}
                        <li><a href="{{ route('dashboard') }}">儀錶板</a></li>
                        <ul>組別
                            <li><a href="{{ route('dashboard') }}"></a></li>
                            <li><a href="{{ route('dashboard') }}"></a></li>
                        </ul>

                        <li><a href="{{ route('logout') }}">登出</a></li>
                    </ul>
                    <div class="col-9 right_side">
                        123
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')

@endsection
