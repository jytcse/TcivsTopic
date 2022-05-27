@extends('layouts.basic')
@section('title')
    @if(Route::currentRouteName()!='specified_keyword_topic')
    專題
    @else
        關鍵詞-{{$route_parameter['keyword']}}
    @endif
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
                <aside class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="year_of_topic_heading">
                            <button class="accordion-button" tabindex="0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#year_of_topic_collapse" aria-expanded="true"
                                    aria-controls="year_of_topic_collapse">
                                專題年度
                            </button>
                        </h2>

                        <div id="year_of_topic_collapse" class="accordion-collapse collapse show"
                             aria-labelledby="year_of_topic_heading">
                            <div class="accordion-body p-0">
                                @foreach($class_data as $class)
                                    <a href="{{route('single_class_topic',["year"=>$class->years,"class_type"=>$class->class_type])}}"
                                       tabindex="0"
                                       class="sub_list_btn @if(Route::currentRouteName()!='specified_keyword_topic')@if(isset($route_parameter) &&$route_parameter['year']==$class->years && $route_parameter['type']==$class->class_type) active @endif @endif"
                                       aria-current="true">
                                        {{$class->years}}年度{{$class->class_type}}班
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if(isset($keyword_data))
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="keyword_heading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#keyword_collapse" aria-expanded="false"
                                        aria-controls="keyword_collapse">
                                    本頁關鍵詞
                                    ({{count($keyword_data)}})
                                </button>

                            </h2>
                            <div id="keyword_collapse" class="accordion-collapse collapse"
                                 aria-labelledby="keyword_heading">
                                <div class="accordion-body p-0">

                                    @if(isset($keyword_data))
                                        @foreach($keyword_data as $keywords)
                                            <a href="{{route('specified_keyword_topic',["keyword"=>$keywords->keyword])}}"
                                               tabindex="0"
                                               class="sub_list_btn @if(!empty($route_parameter['keyword'])&& strtolower($route_parameter['keyword'])==strtolower($keywords->keyword) ) active @endif"
                                               aria-current="true">
                                                {{$keywords->keyword}}
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </aside>
            </div>
            <div class="col-lg-10">
                <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 align-items-stretch">
                    @if(isset($topic_data))
                        @foreach($topic_data as $topic)
                            <div class=" mb-4">
                                <article
                                    class="card user-select-none w-100 position-relative @if($topic->topic_thumbnail!=null) h-100 @endif">
                                    @if($topic->topic_thumbnail!=null)
                                        <section>
                                        <img loading="lazy" class="card-img-top topic_thumbnail mb-2"
                                             src="{{$topic->topic_thumbnail}}">
                                            <hr style="width: 80%;margin: 0 auto">
                                        </section>
                                    @endif
                                    <section class="card-body">
                                        <h5 class="card-title">{{$topic->topic_name}}
                                            <span class="ms-1" style="font-size: 1rem;color: rgb(142,142,142)">組長: {{$topic->team->teamleader->user->name}}</span>
                                        </h5>
                                        <div class="card-keyword mb-3">
                                            @foreach($topic->keywords as $keyword)
                                                @if($loop->index<10)
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
                                        <p class="card-text mb-5">
                                            @if(mb_strlen( $topic->topic_motivation, "utf-8")>180)
                                                {{mb_substr($topic->topic_motivation,0,180)}}...
                                            @else
                                                {{$topic->topic_motivation}}
                                            @endif
                                        </p>
                                        <a href="{{route('specified_topic',["year"=>$class->years,"class_type"=>$class->class_type,"topic_id"=>$topic->id])}}"
                                           class="custom_detail_btn mt-2 position-absolute">完整內容</a>
                                        <time class="topic_year position-absolute">
                                            {{$topic->team->classmodel->years}}
                                            <span>
                                                {{$topic->team->classmodel->class_type}}
                                            </span>
                                        </time>
                                    </section>
                                </article>

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
