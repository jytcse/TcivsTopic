@extends('layouts.admin-basic')
{{-- 我的組別模板 --}}
@section('title')
    建立組別
@endsection
@section('style')
    {{--  建立組別css  --}}
    {{--    <link href="{{ asset('css/createTeam.css')}}" rel="stylesheet">--}}
@endsection

@section('body')
    <div class="h-100">
        <h3>建立組別</h3>
        <div>
            <div>
                <label for="years">年度:</label>
                <input type="text" id="years" readonly value="{{$user->classmodel->years}}" disabled>
            </div>
            <div>
                <label for="class_type">班別:</label>
                <input type="text" id="class_type" readonly value="{{$user->classmodel->class_type}}" disabled>
            </div>
            <div>
                組員:
                <!-- Button trigger modal -->
                <button type="button" class="d-flex" data-bs-toggle="modal"
                        data-bs-target="#select_teammate_Modal">
                    <span class="material-symbols-outlined">add</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="select_teammate_Modal" tabindex="-1"
                     aria-labelledby="select_teammate_ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="select_teammate_ModalLabel">選取組員</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body ">
                                <select id="class_select">
                                    @foreach($class_data as $data)
                                        <option @if($loop->index ==0) selected="selected"
                                                @endif value="{{$data->id}}">{{$data->years}}年{{$data->class_type}}班
                                        </option>
                                    @endforeach
                                </select>
                                <hr>
                                <div class="list-group h-100" id="user_list_container">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                                <button type="button" class="btn btn-primary">完成選取</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--        @dd($user->classmodel)--}}
    </div>

@endsection
@section('script')
    <script>
        const api_token = '{{$api_token}}';
        const target_url = '{{route('home')}}/api/';
        const class_select = document.querySelector('#class_select');
        const user_list_container = document.querySelector('#user_list_container');
        fetch_data(class_select.value);
        class_select.addEventListener('change', () => {
            fetch_data(class_select.value);
        });

        function fetch_data(class_id) {
            fetch(target_url + 'class/' + class_id + '/user/available', {
                headers: {
                    'Authorization': 'Bearer ' + api_token
                }
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (json) {
                    console.log(json);
                    user_list_container.innerHTML = '';
                    if (json.success) {
                        json.data.forEach((user_data) => {
                            user_list_container.innerHTML += `<label class="list-group-item">
<input class="form-check-input me-1" type="checkbox" value="${user_data.id}">${user_data.student_id + " " + user_data.name}</label>`;
                        });
                    } else {
                        user_list_container.innerHTML += `<div class="alert alert-warning" role="alert">
                           ${json.message}
                        </div>`;
                    }
                });
        }

        console.log(api_token);
    </script>
@endsection
