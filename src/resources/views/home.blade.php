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
    <style>
        /*.carousel-control-prev, .carousel-control-next {*/

        /*}*/

        .custombtn {
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ffffff;

        }

        .customDetailBtn {
            border: 1px solid black;
            border-radius: 0;
            width: 100%;
            color: white;
            background-color: black;
        }

        .customDetailBtn:hover {
            color: #000000;
            background-color: #ffffff;
        }

        .customDetailBtn {
            width: 8rem;
            position: relative;
        }

        .customDetailBtn::before {
            content: '';
            background-color: black;
            border: 1px solid black;
            z-index: -1;
            width: 100%;
            height: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            transition: all 0.25s ease-in-out;
        }

        .customDetailBtn:hover::before {
            bottom: 0.4rem;
            left: 0.3rem;
        }
    </style>
    <style>
        .type_content {
            color: #98c379;
            border-right: 4px solid #c5c5c5;
            display: inline-block;
            /*text-align: center;*/
            animation: blink 1.5s infinite;
            font-family: CourierNewPSMT, Courier New;
            font-size: 2rem;
        }

        .type_title {
            font-size: 2.5rem;
        }

        @keyframes blink {
            50% {
                border-right: none;
            }
        }
    </style>
@endsection

@section('navbar')
@endsection
@section('body')
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center overflow-hidden">
            <div class="row justify-content-center align-items-center " style="height: 80vh;">
                <div class="col-lg-5 col-md-12 order-lg-0 pe-5">
                    <h1 class="banner_topic_name mb-2">測試專題</h1>
                    <p class="banner_topic_year mb-4" style="color: #808080">108學年</p>
                    <p class="banner_topic_content">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad animi aperiam delectus dignissimos
                        ea est et, fugiat impedit nesciunt officia, optio quas repellat tempore unde, veritatis. Cum,
                        quasi quia. Delectus?
                    </p>
                    <a href="#" class="btn customDetailBtn my-3" type="submit">詳細內容</a>
                </div>
                <div class="col-lg-5 col-md-12 order-lg-1">
                    <div id="carouselExampleControls" class="carousel " data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://fakeimg.pl/250x101/" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://fakeimg.pl/500x302/" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://fakeimg.pl/250x103/" class="d-block w-100" alt="...">
                            </div>
                        </div>
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

        @endsection
        @section('script')
            <script>
                let i = 0;
                let content = "許多創意專題等著你!!";
                setInterval(function () {
                    document.querySelector('#type').textContent += content.charAt(i);
                    i++
                    if (i == content.length) {

                        setTimeout(() => {
                            document.querySelector('#type').textContent = '';
                            i = 0;
                        }, 2000)
                    }
                }, 200);

            </script>
@endsection
