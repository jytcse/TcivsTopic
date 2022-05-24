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
        <div class="col-lg-4 ">
            <div class="dashboard_items topic">
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
            </div>
        </div>
        <div class="col-lg-4 mt-lg-0 mt-4">
            <div class="dashboard_items team">
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
            </div>
        </div>
        <div class="col-lg-4 mt-lg-0 mt-4">
            <div class="dashboard_items team_positions">
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
@endsection
@section('script')

@endsection
