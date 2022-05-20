@extends('layouts.admin-basic')
{{-- 我的專題模板 --}}
@section('title')
    我的專題
@endsection
@section('style')
    {{--  我的專題css  --}}
    <link href="{{ asset('css/manageMyTopic.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        {{--@dd($team_data)--}}
        <div class="row mt-3">
            <div class="col-lg-6 order-sm-2 order-lg-2">
                <h2>我的專題</h2>
                <div class="form-floating mb-3">
                    <input type="text" class="topic_data_input form-control" id="topic_name" required>
                    <label for="topic_name">專題名稱</label>
                </div>
                <div class="mb-3">
                    <label for="topic_keyword">關鍵詞 (用,隔開)</label>
                    <input id="topic_keyword" type="text" class="topic_data_input form-control mt-2"
                           placeholder="例如:ESP32,C#" value="無">
                </div>
                <div class="mb-3">
                    <label for="topic_motivation">動機</label>
                    <textarea id="topic_motivation" class="topic_data_input form-control mt-2"
                              style="height: 100px">無</textarea>
                </div>

            </div>
            <div class="col-lg-6 order-sm-1 order-lg-2 mb-sm-4 mb-lg-0">
                <h2>封面圖</h2>
                <img src="https://fakeimg.pl/440x200/">
                <div class="alert alert-info mt-3" role="alert">
                    A simple info alert—check it out!
                </div>
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
        let editor;
        ClassicEditor.create(document.querySelector('#topic_content'), {
            // 這裡可以設定 plugin
        })
            .then(newEditor => {
                editor = newEditor;
                // console.log('Editor was initialized', newEditor);
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>
    <script>
        const api_token = '{{$api_token}}';
        const target_url = '{{route('home')}}/api/';
        const team_id = '{{ $team_data->team->id  }}';
        const user_id = '{{ auth()->id()  }}';
        const topic_name = document.querySelector('#topic_name');
        const topic_keyword = document.querySelector('#topic_keyword');
        const topic_motivation = document.querySelector('#topic_motivation');
        const topic_data_input = document.querySelectorAll('.topic_data_input');
        topic_data_input.forEach((item) => {
            // console.log(item);
            $counter = 0;
            item.addEventListener('keyup', (e) => {
                // console.log(item.value);
                // if ($counter == 5) {
                //
                send_data(team_id);
                // $counter = 0;
                // } else {
                //     $counter += 1;
                // }

            });
        });
        editor.model.document.on('change:data', () => {

            send_data(team_id);

        });
        // document.querySelector('#topic_content').addEventListener('keyup', () => {
        //     console.log(this.value);
        // });

        function send_data(team_id) {
            fetch(target_url + 'team/' + team_id + '/topic/edit', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + api_token,
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    'topic_data': {
                        'topic_name': topic_name.value,
                        'topic_keyword': topic_keyword.value,
                        'topic_motivation': topic_motivation.value,
                        'topic_content': editor.getData(),
                    },
                    'info': {
                        'user_id': user_id,
                        'team_id': team_id,
                    }
                })
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (json) {
                    console.log(json);
                }).catch();
        }
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        Echo.private('Topic.Edit.{{$team_data->team_id}}')
            .listen('TopicEdit', (e) => {
                console.log(e);
                if (e.topic.wrapper.info.user_id != user_id) {
                    topic_name.value = e.topic.wrapper.topic_data.topic_name;
                    topic_keyword.value = e.topic.wrapper.topic_data.topic_keyword;
                    topic_motivation.value = e.topic.wrapper.topic_data.topic_motivation;
                }
            });
    </script>
@endsection
