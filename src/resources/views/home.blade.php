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
    </main>
@endsection
@section('script')
    <script src="{{asset('js/homeType.js')}}"></script>
@endsection
