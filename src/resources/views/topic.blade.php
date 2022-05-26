@extends('layouts.basic')
@section('title')
    專題
@endsection
@section('style')
    {{--  專題頁面css  --}}
    <link href="{{ asset('css/topic.css') }}" rel="stylesheet">
    {{--  Footer css  --}}
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
@endsection

@section('body')
    {{--    @dd($topic_data);--}}
    {{--    @dd($route_parameter);--}}
    <main class="container-fluid px-5">
        <div class="row justify-content-center mt-3">
            <div class="col-lg-2 mb-3">
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action" disabled>專題年度</button>

                    @foreach($class_data as $class)
                        <a href="{{route('single_class_topic',["year"=>$class->years,"class_type"=>$class->class_type])}}"
                           class="list-group-item list-group-item-action @if(isset($route_parameter) &&$route_parameter['year']==$class->years && $route_parameter['type']==$class->class_type) active @endif"
                           aria-current="true">
                            {{$class->years}}年度{{$class->class_type}}班
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-10">
                <div class="row row-cols-sm-1 row-cols-md-2 row-cols-xl-3 row-cols-lg-2">
                    @if(isset($topic_data))
                        @foreach($topic_data as $topic)
                            <div class=" mb-4">
                                <div
                                    class="card user-select-none w-100 @if($topic->topic_thumbnail!=null) h-100 @endif">
                                    @if($topic->topic_thumbnail!=null)

                                        <img class="card-img-top topic_thumbnail mb-2"
                                             src="{{$topic->topic_thumbnail}}">
                                        <hr style="width: 80%;margin: 0 auto">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{$topic->topic_name}}</h5>
                                        <div class="card-keyword mb-1">
                                            @foreach($topic->keywords as $keyword)
                                                @if($loop->index<5)
                                                    <a href=" {{route('specified_keyword_topic',["keyword"=>$keyword->keyword])}}">
                                                        <div class="keyword_container">
                                                        <span class="keyword_text">
                                                            {{$keyword->keyword}}
                                                        </span>
                                                        </div>
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                        <p class="card-text">
                                            @if(mb_strlen( $topic->topic_motivation, "utf-8")>180)
                                                {{mb_substr($topic->topic_motivation,0,180)}}...
                                            @else
                                                {{$topic->topic_motivation}}
                                            @endif
                                        </p>
                                        <a href="{{route('specified_topic',["year"=>$class->years,"class_type"=>$class->class_type,"topic_id"=>$topic->id])}}"
                                           class="btn btn-primary">詳細內容</a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </main>
    {{--    @include('components.footer')--}}
@endsection
@section('script')
@endsection
