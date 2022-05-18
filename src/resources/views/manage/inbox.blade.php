@extends('layouts.admin-basic')
{{-- 邀請通知模板 --}}
@section('title')
    邀請通知
@endsection
@section('style')
    {{--  儀錶板css  --}}
    <link href="{{ asset('css/manageInbox.css')}}" rel="stylesheet">
@endsection

@section('body')
    <div>
        {{--        <select class="w-100" id="class_selector">--}}

        {{--        </select>--}}
        <div class="alert alert-primary" role="alert">
            下方是組別對你發送的邀請，你可以在這邊決定是否加入他的組別。
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>年度班級</th>
                <th>組長</th>
                <th>當前組員</th>
                <th>動作</th>
            </tr>
            </thead>
            <tbody class="align-middle">
            {{--            @dd($team_invite);--}}

            @if($team_invite!=null)
                @foreach($team_invite as $team)
                    <tr>
                        <td>
                            {{ $loop->index +1 }}
                        </td>
                        <td>
                            {{--                                        年度班級--}}
                            {{$team->team->classmodel->years}}年{{$team->team->classmodel->class_type}}班
                        </td>
                        <td>
                            {{--                                         組長名稱--}}
                            {{$team->team->teamleader->teammate->user->name}}
                        </td>
                        <td>
                            {{--                                           組員--}}
                            @if(count($team->team->teammates) !=1)
                                @foreach($team->team->teammates as $teammate)
                                    組員姓名 != 組長的名稱
                                    @if($teammate->user->name != $team->team->teamleader->teammate->user->name)
                                        {{ $teammate->user->name}}
                                    @endif
                                @endforeach
                            @else
                                無
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" value="{{$team->team_id}}">加入</button>
                            <button type="button" class="btn btn-danger" value="{{$team->team_id}}">拒絕</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center"><h5 class="mb-0">Oops! 這邊好像空空的，晚點再回來看看吧!</h5></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

@endsection
@section('script')

@endsection
