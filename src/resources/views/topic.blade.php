@extends('layouts.basic')
@section('title')
    專題
@endsection
@section('style')
    {{--  首頁css  --}}
{{--    <link href="{{ asset('css/home.css') }}" rel="stylesheet">--}}
    {{--  Footer css  --}}
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
@endsection

@section('body')
    <main class="container-fluid px-5">
        <div class="row justify-content-center mt-3">
            <div class="col-lg-2 mb-3">
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action" disabled>專題年度</button>
{{--                    <button type="button" class="list-group-item list-group-item-action active" aria-current="true">--}}
{{--                        The current button--}}
{{--                    </button>--}}
                    <button type="button" class="list-group-item list-group-item-action">111年度</button>
                    <button type="button" class="list-group-item list-group-item-action">110年度</button>
                    <button type="button" class="list-group-item list-group-item-action">109年度</button>
                </div>
            </div>

            <div class="col-lg-10">
                <div class="row row-cols-sm-1 row-cols-md-2 row-cols-xl-3 row-cols-lg-2">
                    @for($i=0;$i<14;$i++)
                    <div class=" mb-4">
                        <div class="card w-100" >
                            <img class="card-img-top" src="https://fakeimg.pl/1920x1080/">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">詳細內容</a>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

        </div>
    </main>
{{--    @include('components.footer')--}}
@endsection
@section('script')
@endsection
