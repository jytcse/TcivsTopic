@extends('layouts.admin-basic')
{{-- 我的專題模板 --}}
@section('title')
    我的專題
@endsection
@section('style')
    {{--  我的專題css  --}}
        <link href="{{ asset('css/manageMyTopic.css')}}" rel="stylesheet">
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

        <div class="row mt-3">
            <div class="col-lg-6 order-sm-2 order-lg-2">
                <h2>我的專題</h2>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" value="無" required>
                    <label for="floatingInput">專題名稱</label>
                </div>
                <div class="mb-3">
                    <label for="floatingTextarea2">關鍵詞 (用,隔開)</label>
                    <input type="email" class="form-control mt-2" placeholder="例如:ESP32,C#" value="無">
                </div>
                <div class="mb-3">
                    <label for="floatingTextarea2">動機</label>
                    <textarea class="form-control mt-2" style="height: 100px">無</textarea>
                </div>

            </div>
            <div class="col-lg-6 order-sm-1 order-lg-2 mb-sm-4 mb-lg-0">
                <h2>封面圖</h2>
                <img src="https://fakeimg.pl/440x200/">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="topic_content">專題內容</label>
                    <textarea class="form-control mt-2 ckeditor "
                              id="topic_content"
                              style="height: 100px">無</textarea>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#topic_content'), {
            // 這裡可以設定 plugin
        })
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>
@endsection
