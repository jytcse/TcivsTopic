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
            <div class="col position-relative  ccc">
                <div class="line_container">
                    {{--                    <svg viewBox="0 0 212 3921" fill="none" preserveAspectRatio="xMidYMax meet">--}}
                    {{--                        --}}{{--                        <path--}}
                    {{--                        --}}{{--                            d="M123.5 0V349.5M123.5 349.5H0M123.5 349.5V984.5M123.5 984.5H211.5M123.5 984.5V1639.5M123.5 1639.5H3M123.5 1639.5V2271.5M123.5 2271.5H195M123.5 2271.5V2888M123.5 2888H8M123.5 2888V3584.5M123.5 3584.5H203.5M123.5 3584.5V3920.5"--}}
                    {{--                        --}}{{--                            stroke="#282C34" stroke-width="5"/>--}}



                    {{--                    </svg>--}}
                    {{--                    <svg viewBox="0 0 243 3889" fill="none" preserveAspectRatio="xMidYMax meet">--}}
                    {{--                        <path--}}
                    {{--                            d="M158.5 0.5L3.5 369L239.5 985L25.5 1627L239.5 2272.5L125.25 2589.75L11 2907L239.5 3574.5L129 3888"--}}
                    {{--                            stroke="#282C34" stroke-width="5"/>--}}
                    {{--                    </svg>--}}

                    <svg preserveAspectRatio="xMidYMax meet" viewBox="0 0 6 4024" fill="none">
                        <path d="M3 0C3 1164 3 3167.33 3 4023.5" stroke="#282C34" stroke-width="5"/>
                    </svg>

                </div>
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
    <script>

        let ccc = document.querySelector('.ccc');
        let path = document.querySelector('path');
        let path_length = path.getTotalLength();
        path.style.strokeDasharray = path_length + ' ' + path_length;
        path.style.strokeDashoffset = path_length;
        console.log(ccc);
        // offsetTop

        //document.documentElement.scrollTop 網頁scroll最上方的高度
        // document.documentElement.scrollHeight 整個網頁總高度
        //document.documentElement.clientHeight 用戶視窗高度
        window.addEventListener('scroll', () => {

            //當前滾到的高度 - ccc區塊與上方的距離 + 用戶視窗高度 / 這個區塊的高度
            // if (document.documentElement.scrollTop > ccc.offsetTop) {
            // console.log(document.documentElement.scrollTop);
            //                                       1000
            // let totalHeight = (document.documentElement.scrollHeight - document.documentElement.clientHeight) + 500
            // if (document.documentElement.scrollTop > (document.documentElement.scrollHeight - totalHeight)) {
            // console.log('start at'+ document.documentElement.scrollTop)
            //總高度
            // console.log(totalHeight);
            // let scrollPercentage = (document.documentElement.scrollTop) / (totalHeight - document.documentElement.clientHeight);
            // console.log((document.documentElement.scrollTop + (document.documentElement.scrollHeight - totalHeight)));
            // let scrollPercentage = (document.documentElement.scrollTop + (document.documentElement.scrollHeight - totalHeight)) / (totalHeight);
            // console.log(scrollPercentage);
            // console.log(scrollPercentage.toFixed(3));
            // }
            let scrollPercentage = (document.documentElement.scrollTop) / (document.documentElement.scrollHeight - document.documentElement.clientHeight);
            let drawLength = path_length * scrollPercentage;

            path.style.strokeDashoffset = path_length - drawLength;
            // }
            // let drawLength = path_length * scrollPercentage;
            // path.style.strokeDashoffset = path_length - drawLength;
            // console.log(document.documentElement.scrollT op);
            // console.log(scrollPercentage);
            // }


        });
    </script>
    <script src="{{asset('js/homeType.js')}}"></script>
@endsection
