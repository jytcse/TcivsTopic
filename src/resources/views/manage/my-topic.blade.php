@extends('layouts.admin-basic')
{{-- 我的專題模板 --}}
@section('title')
    我的專題
@endsection
@section('style')
    {{--  我的專題css  --}}
    {{--    <link href="{{ asset('css/manageTeams.css')}}" rel="stylesheet">--}}
@endsection

@section('body')
    @if(session()->has('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill"/>
            </svg>
            <div>
                {{ session()->get('success') }}
            </div>
        </div>
    @endif
    <div class="container">
        <h2>我的專題</h2>
        <div class="row mt-3">
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" value="無">
                    <label for="floatingInput">專題名稱</label>
                </div>
                <div class="mb-3">
                    <label for="floatingTextarea2">關鍵詞 (用,隔開)</label>
                    <input type="email" class="form-control mt-2" value="無">
                </div>
                <div class="mb-3">
                    <label for="floatingTextarea2">動機</label>
                    <textarea class="form-control mt-2" style="height: 100px">無</textarea>
                </div>
                <div class=" mb-3">
                    <label for="floatingTextarea2">專題內容</label>
                    <textarea class="form-control mt-2" style="height: 100px">無</textarea>
                </div>
            </div>

            <div class="col-6">
                <img src="https://fakeimg.pl/440x200/">
            </div>
        </div>
    </div>

@endsection
@section('script')

@endsection
