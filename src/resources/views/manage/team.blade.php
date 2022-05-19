@extends('layouts.admin-basic')
{{-- 我的組別模板 --}}
@section('title')
    我的組別
@endsection
@section('style')
    {{--  我的組別css  --}}
    {{--    <link href="{{ asset('css/manageTeams.css')}}" rel="stylesheet">--}}
@endsection

@section('body')
    @if(isset($hasTeam) && !$hasTeam)
        <div class="d-flex justify-content-center align-items-center h-100">
            <div>
                <h3>你還沒有任何組別哦!</h3>
                <button>
                    瀏覽組別
                </button>
                <button>
                    <a href="{{ route('create_team_page') }}">
                        建立組別
                    </a>
                </button>
            </div>
        </div>
    @else
        @if(session()->has('insert_success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill"/>
                </svg>
                <div>
                    {{ session()->get('insert_success') }}
                </div>
            </div>
        @endif
    @endif
@endsection
@section('script')

@endsection
