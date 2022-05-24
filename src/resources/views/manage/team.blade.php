@extends('layouts.admin-basic')
{{-- 我的組別模板 --}}
@section('title')
    我的組別
@endsection
@section('style')
    {{--  我的組別css  --}}
    {{--    <link href="{{ asset('css/manageTeams.css')}}" rel="stylesheet">--}}
@endsection

@section('body')
    @if(isset($hasTeam) && !$hasTeam)
        <div class="d-flex justify-content-center align-items-center h-100">
            <div>
                <h3>你還沒有任何組別哦!</h3>
                <button>
                    瀏覽組別
                </button>
                <button>
                    <a href="{{ route('create_team_page') }}">
                        建立組別
                    </a>
                </button>
            </div>
        </div>
    @else
        @if(session()->has('insert_success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill"/>
                </svg>
                <div>
                    {{ session()->get('insert_success') }}
                </div>
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3>我的組別</h3>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" disabled
                               value="{{$team->team->teamleader->user->name}}">
                        <label for="floatingInput">組長</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" disabled
                               value="{{count($team->team->teammates)}}">
                        <label for="floatingInput">組員人數</label>
                    </div>
                </div>
                <div class="col-6">
                    <h3>組員列表</h3>
                    <ol class="list-group list-group-numbered">
                        @foreach($team->team->teaminvite as $invite_data)
                            @switch($invite_data->state)
                                @case('accept')
                                <li class="list-group-item">{{$invite_data->user->name}}<span
                                        id="invite_state_{{$invite_data->user->id}}">(已加入)</span></li>
                                @break
                                @case('pending')
                                <li class="list-group-item">{{$invite_data->user->name}}<span
                                        id="invite_state_{{$invite_data->user->id}}">(邀請中)</span></li>
                                @break;
                                @case('reject')
                                <li class="list-group-item">{{$invite_data->user->name}}<span
                                        id="invite_state_{{$invite_data->user->id}}">(已拒絕)</span></li>
                                @break;
                            @endswitch
                        @endforeach
                    </ol>
                </div>
            </div>
{{--            @dd($team)--}}
            <div class="row mt-5">
                <div class="col-6">
                    <h3>專題</h3>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" disabled value="@if(isset($team->team->topic)){{$team->team->topic->topic_name}} @else 無 @endif">
                        <label for="floatingInput">專題名稱</label>
                    </div>

                    <div class="mt-2">
                        <label for="floatingTextarea2">專題動機</label>
                        <textarea class="form-control" disabled style="height: 200px">@if(isset($team->team->topic->topic_motivation)){{$team->team->topic->topic_motivation}} @else 無 @endif</textarea>
                    </div>
                </div>

{{--                <div class="col-6">--}}
{{--                    @if(auth()->id() === $team->team->teamleader->teammate->user_id)--}}
{{--                        <h3>組別設定</h3>--}}
{{--                        <button type="button" class="btn btn-danger" value="{{$team->team->id}}">刪除組別</button>--}}
{{--                    @endif--}}
{{--                </div>--}}
            </div>
        </div>
    @endif
@endsection
@section('script')

@endsection
