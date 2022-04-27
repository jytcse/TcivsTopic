@extends('layouts.basic')
@section('title')
    首頁
@endsection
@section('style')

    {{--    <style>--}}
    {{--        .custom-shape-divider-bottom-1651008530 {--}}
    {{--            position: absolute;--}}
    {{--            bottom: 0;--}}
    {{--            left: 0;--}}
    {{--            width: 100%;--}}
    {{--            overflow: hidden;--}}
    {{--            line-height: 0;--}}
    {{--            transform: rotate(180deg);--}}
    {{--        }--}}

    {{--        .custom-shape-divider-bottom-1651008530 svg {--}}
    {{--            position: relative;--}}
    {{--            display: block;--}}
    {{--            width: calc(172% + 1.3px);--}}
    {{--            height: 141px;--}}
    {{--        }--}}

    {{--        :root {--}}
    {{--            --asdasd: rgb(0, 0, 0);--}}
    {{--        }--}}

    {{--        .custom-shape-divider-bottom-1651008530 .shape-fill {--}}
    {{--            fill: var(--asdasd);--}}
    {{--        }--}}

    {{--    </style>--}}
    {{--  首頁css  --}}
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    {{--  首頁下方打字區域css  --}}
    <link href="{{ asset('css/homeType.css') }}" rel="stylesheet">
    {{--  首頁輪播區域css  --}}
    <link href="{{ asset('css/homeSlider.css') }}" rel="stylesheet">
@endsection

@section('body')
    <main class="container-fluid">
        <div class="row justify-content-center align-items-center overflow-hidden" style="height: 90vh;">
            <div class="col-lg-12  slides_container px-0">
                <div class="custom_slides">
                    {{--渲染五個slide--}}
                    @for($i=0;$i<5;$i++)
                        <div class="custom_slide">
                            <div class="row align-items-center px-5">
                                <article>
                                    <div class="col-lg-6 order-lg-1 pe-lg-5">
                                        <section>
                                            <img src="https://fakeimg.pl/1920x1024/"
                                                 class="custom_slide_img d-block w-100"
                                                 alt="...">
                                            {{--                                        <img src="https://fakeimg.pl/300x300/" class="custom_slide_img d-block w-100"--}}
                                            {{--                                             alt="...">--}}
                                        </section>
                                    </div>
                                    <div class="col-lg-6 order-lg-0 ps-lg-5">
                                        <div class="custom_slide_text mt-3 ps-lg-5">
                                            <section>
                                                {{--  專題名稱 --}}
                                                <h1 class="custom_slide_name mb-2">測試專題</h1>
                                                {{--  專題年度 --}}
                                                <p class="custom_slide_year mb-3">
                                                    <time>108</time>
                                                    學年
                                                </p>
                                                {{--  專題動機 --}}
                                                <p class="custom_slide_content">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad animi
                                                    aperiam
                                                    delectus dignissimos
                                                    ea est et, fugiat impedit nesciunt officia, optio quas repellat
                                                    tempore
                                                    unde,
                                                    veritatis. Cum,
                                                    quasi quia. Delectus?
                                                </p>
                                            </section>
                                            <section>
                                                {{--連結到專題--}}
                                                <a href="#" class="custom_detail_btn mt-3" type="submit">詳細內容</a>
                                            </section>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
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

        {{--    <div style="position: relative">--}}
        {{--        <div class="custom-shape-divider-bottom-1651008530">--}}
        {{--            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">--}}
        {{--                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>--}}
        {{--            </svg>--}}
        {{--        </div>--}}
        {{--    </div>--}}
        {{--    <div style="position: relative;height: 300px;width: 100%;background-color:var(--asdasd);"></div>--}}

        {{--    <div style="position: relative;transform: rotate(180deg)">--}}
        {{--        <div class="custom-shape-divider-bottom-1651008530">--}}
        {{--            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">--}}
        {{--                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>--}}
        {{--            </svg>--}}
        {{--        </div>--}}
        {{--    </div>--}}
    </main>
@endsection
@section('script')
    <script src="{{asset('js/homeSlider.js')}}"></script>
    <script src="{{asset('js/homeType.js')}}"></script>

@endsection
