@extends('layouts.admin-basic')
{{-- 所有組別模板 --}}
@section('title')
    所有組別
@endsection
@section('style')
    {{--  儀錶板css  --}}
    <link href="{{ asset('css/manageTeams.css')}}" rel="stylesheet">
@endsection

@section('body')
    <div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>年度班級</th>
                <th>組長</th>
                <th>組員</th>
                <th>動作
                    @if(isset($hasTeam) && $hasTeam)
                        <button>
                            <a href="{{ route('create_team_page') }}">
                                創建組別
                            </a>
                        </button>
                    @endif
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($teams as $team)
                <tr>
                    <td>
                        {{--                        {{  $team->id}}--}}
                        {{ $loop->index +1 }}
                    </td>
                    <td>
                        {{--年度班級   --}}
                        {{$team->classmodel->years}}年{{$team->classmodel->class_type}}班 第{{  $team->team_number}}組
                    </td>
                    <td>
                        {{-- 組長名稱--}}
                        {{$team->teamleader->teammate->user->name}}
                    </td>
                    <td>
                        {{--   組員  --}}
                        @if(count($team->teammates) !=1)
                            @foreach($team->teammates as $teammate)
                                {{--  組員姓名 != 組長的名稱--}}
                                @if($teammate->user->name != $team->teamleader->teammate->user->name)
                                    {{ $teammate->user->name}}
                                @endif
                            @endforeach
                        @else
                            無組員
                        @endif
                    </td>
                    <td>
                        {{--  動作 --}}
                        @if(isset($hasTeam) && $hasTeam)
                            <button>加入</button>
                        @endif
                        <button>查看</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')

@endsection
