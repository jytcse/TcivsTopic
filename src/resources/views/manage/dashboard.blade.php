@extends('layouts.admin-basic')
@section('title')
    儀錶板
@endsection
@section('style')
    {{--  儀錶板css  --}}
    <link href="{{ asset('css/manageDashboard.css')}}" rel="stylesheet">
    {{--  Sidebar css  --}}
    <link href="{{ asset('css/sidebar.css')}}" rel="stylesheet">
@endsection

@section('body')
    <main>
        <div class="container">
            <div class="d-flex dashboard_container justify-content-center align-items-center">
                <div class="row dashboard_row">
                    <div class="col-3 left_side px-0">
                        @include('components.sidebar')
                    </div>
                    <div class="col-9 right_side">
                        1231231
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        // const left_side = document.querySelector('.left_side');
        // const right_side = document.querySelector('.right_side');
        // left_side.addEventListener('click', function () {
        //     // console.log('123');
        //     // this.classList.toggle('col-3');
        //     // this.classList.toggle('d-none');
        //     // right_side.classList.toggle('col-12');
        //     // this.classList.toggle('w-0');
        // });
        const custom_dropdown = document.querySelectorAll('.custom_dropdown')
        custom_dropdown.forEach((element) => {
            element.addEventListener('click', () => {
                element.classList.toggle('show');
            })
        });
    </script>
@endsection
