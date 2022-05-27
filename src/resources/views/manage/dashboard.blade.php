@extends('layouts.admin-basic')
@section('title')
    儀錶板
@endsection
@section('style')
    {{--  儀錶板css  --}}
    <link href="{{ asset('css/manageDashboard.css')}}" rel="stylesheet">
@endsection

@section('body')
    <div class="row">
        <div class="@if(auth()->user()->identity_id==1) col-lg-4 @else col-lg-6 @endif">
            <div class="dashboard_items topic">
                @if(auth()->user()->identity_id==1)
                    @if(isset($team->team->topic))
                        <div>
                        <span class="material-symbols-outlined align-middle pe-1">
                                     topic
                                    </span>專題名稱:
                        </div>
                        <div>
                            <h3> {{$team->team->topic->topic_name}}</h3>
                        </div>
                    @else
                        <h3>還沒有專題</h3>
                    @endif
                @else
                    <div>

                    <span class="material-symbols-outlined align-middle pe-1">
                                     topic
                                    </span>專題總數:
                    </div>
                    <div>
                        <h3>
                            {{$topic_number}}
                        </h3>
                    </div>
                @endif
            </div>
        </div>
        <div class="@if(auth()->user()->identity_id==1) col-lg-4 @else col-lg-6 @endif mt-lg-0 mt-4">
            <div class="dashboard_items team">
                @if(auth()->user()->identity_id==1)

                    @if(isset($hasTeam) && !$hasTeam)
                        <h3>還沒有組別</h3>
                    @else
                        <div>
                        <span class="material-symbols-outlined align-middle pe-1">
                            calendar_month
                        </span>
                            <span>組別年度:</span>
                        </div>
                        <h3>
                            {{$team->team->classmodel->years}}年{{$team->team->classmodel->class_type}}班
                        </h3>
                    @endif
                @else
                    <div>

                    <span class="material-symbols-outlined align-middle pe-1">
                                    group
                                    </span>組別總數:
                    </div>
                    <div>
                        <h3>
                            {{$team_number}}
                        </h3>
                    </div>
                @endif
            </div>
        </div>
        @if(auth()->user()->identity_id==1)
        <div class="col-lg-4 mt-lg-0 mt-4">
            <div class="dashboard_items team_positions">
                @if(auth()->user()->identity_id==1)
                    @if(isset($hasTeam) && !$hasTeam)
                        <h3>還沒有組別</h3>
                    @else
                        <div>
                               <span class="material-symbols-outlined align-middle pe-1">
                    visibility
                    </span>職位:
                        </div>

                        <h3>
                            @if($position)
                                組長
                            @else
                                組員
                            @endif
                        </h3>
                    @endif
                @else

                @endif
            </div>
        </div>
        @endif
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="profile px-4 pt-2">
                <h2 class="mt-2">{{auth()->user()->name}} 你好!</h2>
                <div class="row mt-5">
                    <h4>修改密碼</h4>
                    <div class="col-12 mt-2">
                        <div>
                            <form action="{{route('password.send.email')}}" method="post">
                                @csrf
                                <label for="email" class="me-2">電子信箱</label>
                                <input type="email" id="email" name="email"
                                       value="{{auth()->user()->email}}">
                                <div class="mt-3">
                                    <button type="submit" class="px-4 reset_password_btn">重設密碼</button>
                                </div>
                            </form>
                        </div>
                        @if(session()->has('mail_success'))
                            <div class="alert alert-success mt-2" role="alert">
                                已寄出驗證信件，請至 {{ session()->get('mail_success')['email'] }} 查收，驗證碼為:<span style="color: red">{{ session()->get('mail_success')['code'] }}</span>
                                <br>
                                並請驗證信件驗證碼是否符合本網站所提供。
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
