@extends('layouts.basic')
@section('title')
    首頁
@endsection
@section('style')
    {{--  首頁css  --}}
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    {{--  首頁下方打字區域css  --}}
    <link href="{{ asset('css/homeType.css') }}" rel="stylesheet">
    {{--  首頁輪播區域css  --}}
    <link href="{{ asset('css/homeSlides.css') }}" rel="stylesheet">
@endsection

@section('body')
    <main class="container-fluid">
        {{-- 輪播元件 slide_times輪播數量  slide_speed輪播速度單位秒 --}}
        @include('components.slides',['slide_times' =>5,'slide_speed'=>8])
        <div class="row justify-content-center align-items-center" style="background-color: #282c34;height: 20vh;">
            <div class="col-12">
                <div class="text-center">
                    <div>
                        <h2 class="type_title text-white">中工專題網</h2>
                    </div>
                    <div style="height: 30px">
                        <span id="type" class="type_content"></span>
                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="my-5">--}}
        {{--            <div class="custom_card">--}}
        {{--                <div class="custom_card_img_container">--}}
        {{--                                    <img loading="lazy" src="https://fakeimg.pl/1920x1024/"--}}
        {{--                                         class="custom_card_img d-block w-100"--}}
        {{--                                         alt="...">--}}
        {{--                </div>--}}
        {{--                <div class="custom_card_text_container">--}}
        {{--                    <h1>測試專題1</h1>--}}
        {{--                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque culpa deleniti dolor,--}}
        {{--                        dolorem ea eaque esse fugit illum in incidunt minima molestias nobis porro quia reprehenderit--}}
        {{--                        veritatis, voluptatem voluptatum!</p>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="row">
            <div class="col position-relative">
                @for($card_counter=0;$card_counter<6;$card_counter++)
                    <div
                        class="card custom_card @if($card_counter % 2 ==0) custom_card_odd me-lg-auto @else custom_card_even ms-lg-auto @endif mt-5">
                        <img loading="lazy" src="https://fakeimg.pl/1920x1024/"
                             class="custom_card_img user-select-none d-block w-100 card-img-top"
                             alt="...">
                        <div class="card-body custom_card_body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the
                                card's content.
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam autem blanditiis
                                dignissimos eius error impedit incidunt, nisi nobis perferendis possimus quae quam
                                quibusdam quod, repudiandae sit, tempore temporibus unde voluptatibus.
                            </p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                @endfor
                <div class="d-flex justify-content-center my-5">
                    <a href="/all">瀏覽全部</a>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script src="{{asset('js/homeType.js')}}"></script>
@endsection
