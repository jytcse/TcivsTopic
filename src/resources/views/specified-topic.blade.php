@extends('layouts.basic')
@section('title')
    專題-{{$topic_data->topic_name}}
@endsection
@section('style')
    {{--  指定專題頁面css  --}}
    <link href="{{ asset('css/specifiedTopic.css') }}" rel="stylesheet">
    {{--  ckeditor5 css  --}}
    <link href="{{ asset('css/ckeditor5.css') }}" rel="stylesheet">
    {{--  Footer css  --}}
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
@endsection

@section('body')
    {{--        @dd($topic_data)--}}
    <div class="container h-100 mt-3 user-select-none mb-5">

        <div class="row">
            <div class="col-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item pt-0"><h1>{{$topic_data->topic_name}}</h1></li>
                    <li class="list-group-item"> 年度:
                        {{ $topic_data->team->classmodel->years}}
                        {{ $topic_data->team->classmodel->class_type}}班
                    </li>
                    <li class="list-group-item">組長: {{$topic_data->team->teamleader->user->name}}</li>
                    <li class="list-group-item">成員:
                        @foreach($topic_data->team->teammates as $teammates)

                            <span>{{$teammates->user->name}}</span>
                        @endforeach</li>
                    <li class="list-group-item keyword_wrapper">

                        關鍵詞:
                        @foreach($topic_data->keywords as $keywords)
                            <a href=" {{route('specified_keyword_topic',["keyword"=>$keywords->keyword])}}">
                                <div class="keyword_container">
                                    <span class="keyword_text">
                                        {{$keywords->keyword}}
                                    </span>
                                </div>
                            </a>
                            {{--                            <span>{{$keywords->keyword}}</span>--}}
                        @endforeach
                    </li>
                    {{--                    <li class="list-group-item">--}}
                    {{--                        動機: {{$topic_data->topic_motivation}}--}}
                    {{--                    </li>--}}
                </ul>
            </div>
            <div class="col-8">
                <img class="topic_thumbnail" src="{{$topic_data->topic_thumbnail}}" alt="">
            </div>
        </div>
        <hr>
        <div class="row px-3">
            <div class="col">
                <h1>研究動機</h1>
                <div class="topic_motivation">
                    {{ $topic_data->topic_motivation}}
                </div>
            </div>
        </div>
        <hr>
        <div class="row px-3">
            <h1>內容</h1>
            <div class="ck-content">
                {!! $topic_data->topic_content !!}
            </div>
        </div>
    </div>

        @include('components.footer')
    {{--@dd($topic_data);--}}
@endsection
@section('script')
@endsection
