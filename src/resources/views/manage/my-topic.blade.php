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
                    <input type="text" class="topic_data_input form-control" id="topic_name"
                           value="@if(isset($topic_database_data->topic_name)) {{ $topic_database_data->topic_name }} @endif"
                           required>
                    <label for="topic_name">專題名稱</label>
                </div>
                <div class="mb-3">
                    <label for="topic_keyword">關鍵詞 (用,隔開)</label>
                    <input id="topic_keyword" type="text" class="topic_data_input form-control mt-2"
                           placeholder="例如:ESP32,C#"
                           value="@if(isset($topic_database_data->keywords))@foreach($topic_database_data->keywords as $keyword)@if($loop->first){{ trim($keyword->keyword) }}@else,{{trim($keyword->keyword)}}@endif @endforeach @endif">
                </div>
                <div class="mb-3">
                    <label for="topic_motivation">動機</label>
                    <textarea id="topic_motivation" class="topic_data_input form-control mt-2"
                              style="height: 100px">@if(isset($topic_database_data->topic_motivation)){{ $topic_database_data->topic_motivation }}@endif</textarea>
                </div>

            </div>
            <div class="col-lg-6 order-sm-1 order-lg-2 mb-sm-4 mb-lg-0">
                <h2>封面圖</h2>
                <img
                    src="@if(trim($topic_database_data->topic_thumbnail) !=null) {{$topic_database_data->topic_thumbnail}} @else https://fakeimg.pl/440x200/ @endif">
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
                              style="height: 100px">@if(isset($topic_database_data->topic_content)){{ $topic_database_data->topic_content }}@endif</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('components/my-upload-adapter')
    <script>
        const api_token = '{{$api_token}}';
        const target_url = '{{route('home')}}/api/';
        const team_id = '{{ $team_data->team->id  }}';
        const user_id = '{{ auth()->id()  }}';
        const topic_name = document.querySelector('#topic_name');
        const topic_keyword = document.querySelector('#topic_keyword');
        const topic_motivation = document.querySelector('#topic_motivation');
        const topic_data_input = document.querySelectorAll('.topic_data_input');
        let focus_on;
        let topic_data = {};
        let before_data;
        topic_data_input.forEach((item) => {
            item.addEventListener('focusout', (e) => {
                // topic_data[item.id] = item.value;
                send_data(team_id, 'save');
            });
            item.addEventListener('keydown', (e) => {
                before_data = item.value;
            });
            item.addEventListener('keyup', (e) => {
                // console.log(after_data === before_data);
                if (item.value !== before_data) {
                    // typeof item.id;
                    topic_data[item.id] = item.value;
                    send_data(team_id, 'edit');
                    // console.log(typeof item.id)
                    // console.log(changed_data);
                } else {
                    topic_data = null;
                }
            });
        });
        let editor;
        ClassicEditor.create(document.querySelector('#topic_content'), {
            // 這裡可以設定 plugin
            extraPlugins: [MyCustomUploadAdapterPlugin],
            imageRemoveEvent: {
                additionalElementTypes: null, // Add additional element types to invoke callback events. Default is null and it's not required. Already included ['image','imageBlock','inlineImage']
                // additionalElementTypes: ['image', 'imageBlock', 'inlineImage'], // Demo to write additional element types
                callback: (imagesSrc, nodeObjects) => {
                    // imagesSrc
                    send_delete_data(imagesSrc);
                    console.log('callback called', imagesSrc, nodeObjects)
                }
            },
        })
            .then(newEditor => {
                editor = newEditor;
                editor.editing.view.document.on('keyup', (evt, data) => {
                    // console.log(data);
                    topic_data['topic_content'] = editor.getData();
                    send_data(team_id, 'edit');
                });
                editor.editing.view.document.on('blur', (evt, data) => {
                    // console.log(data);
                    console.log('blur');
                    topic_data['topic_content'] = editor.getData();
                    // send_data(team_id, 'edit');
                    send_data(team_id, 'save');
                });
            })
            .catch(err => {
                console.error(err.stack);
            });


        function send_data(team_id, method) {
            let data_body = {
                topic_data,
                'info': {
                    'user_id': user_id,
                    'team_id': team_id,
                }
            };
            fetch(target_url + 'team/' + team_id + '/topic/' + method, {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + api_token,
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data_body),
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (json) {
                    // console.log(json);
                }).catch();
        }

        function send_delete_data(img_path) {
            fetch(target_url + 'ckeditor/image/delete', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + api_token,
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    "path": img_path
                }),
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (json) {
                    console.log(json);
                }).catch();
        }

        function undefinedChecker(value, target) {
            if (value !== undefined) {
                target.value = value;
                topic_data = {};
                return true;
            }
            return false;
        }

        Echo.private('Topic.Edit.{{$team_data->team_id}}')
            .listen('TopicEdit', (e) => {
                // console.log(e);
                if (e.topic.wrapper.info.user_id != user_id) {
                    let remote_topic_data = e.topic.wrapper.topic_data;
                    undefinedChecker(remote_topic_data.topic_name, topic_name);
                    undefinedChecker(remote_topic_data.topic_keyword, topic_keyword);
                    undefinedChecker(remote_topic_data.topic_motivation, topic_motivation);
                    if (remote_topic_data.topic_content !== undefined) {
                        if (remote_topic_data.topic_content == null) {
                            editor.setData('<p><br data-cke-filler="true"></p>');
                        }else{
                        editor.setData(remote_topic_data.topic_content);
                            topic_data = {};
                        }
                    }
                }
            });
    </script>
@endsection
