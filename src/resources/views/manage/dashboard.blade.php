@extends('layouts.admin-basic')
@section('title')
    儀錶板
@endsection
@section('style')
    {{--  儀錶板css  --}}
    <link href="{{ asset('css/manageDashboard.css')}}" rel="stylesheet">
    {{--  Sidebar css  --}}
    <link href="{{ asset('css/sidebar.css')}}" rel="stylesheet">
@endsection

@section('body')
    <main>
        <div class="container">
            <div class="d-flex dashboard_container justify-content-center align-items-center">
                <div class="row dashboard_row">
                    <div class="col-3 left_side px-0">
                        @include('components.sidebar')
                    </div>
                    <div class="col-9 right_side p-4 user-select-none">
                        <div class="row">
                            <div class="col-lg-4 ">
                                <div class="dashboard_items topic">
                                    還沒有專題
                                </div>
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-4">
                                <div class="dashboard_items team">
                                    還沒有組別
                                </div>
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-4">
                                <div class="dashboard_items team_positions">
                                    還沒有職位
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="profile px-4 pt-2">
                                    <h2 class="mt-2">{{\Illuminate\Support\Facades\Auth::user()->name}} 你好!</h2>
                                    <div class="row mt-5">
                                        <h4>忘記密碼了?</h4>
                                        <div class="col-12 mt-2">
                                            <div>
                                                <form action="/resetPassword" method="post">
                                                    <label for="email" class="me-2">電子信箱</label>
                                                    <input type="email" id="email"
                                                           value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                                                    <div class="mt-3">
                                                        <button type="submit" class="px-4 reset_password_btn">重設密碼</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')

@endsection
