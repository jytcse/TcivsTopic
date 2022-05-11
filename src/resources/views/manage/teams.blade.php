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

{{--        <table class="table table-striped table-hover">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>#</th>--}}
{{--                <th>班級年度</th>--}}
{{--                <th>姓名</th>--}}
{{--                <th>動作</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($teams as $team)--}}
{{--                <tr>--}}
{{--                    <td>--}}
{{--                        {{  $team->id}}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {{$team->classmodel->years}}年{{$team->classmodel->class_type}}班 {{  $team->team_number}}組--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {{$team->user->name}}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
    </div>
@endsection
@section('script')

@endsection
