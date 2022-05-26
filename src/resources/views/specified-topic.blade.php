@extends('layouts.basic')
@section('title')
    專題-{{$topic_data->topic_name}}
@endsection
@section('style')
    {{--  指定專題頁面css  --}}
{{--        <link href="{{ asset('css/specifiedTopic.css') }}" rel="stylesheet">--}}
    {{--  Footer css  --}}
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
{{--                <img src="{{$topic_data->topic_thumbnail}}" style="height: 100%" alt="">--}}
            </div>
            <div class="col">

            </div>
        </div>
    </div>
{{--@dd($topic_data);--}}
@endsection
@section('script')
@endsection
