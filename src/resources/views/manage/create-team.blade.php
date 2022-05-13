@extends('layouts.admin-basic')
{{-- 我的組別模板 --}}
@section('title')
    建立組別
@endsection
@section('style')
    {{--  建立組別css  --}}
    <link href="{{ asset('css/createTeam.css')}}" rel="stylesheet">
@endsection

@section('body')
    <div class="h-100">
        <h3>建立組別</h3>
        <div>
            <div>
                <label for="years">年度:</label>
                <input type="text" id="years" readonly value="{{$user->classmodel->years}}" disabled>
            </div>
            <div class="mt-2">
                <label for="class_type">班別:</label>
                <input type="text" id="class_type" readonly value="{{$user->classmodel->class_type}}" disabled>
            </div>
            <h3 class="d-flex mt-4">組員:
                <!-- Button trigger modal -->
                <button type="button" id="modal_btn" class="d-flex align-items-center ms-2" data-bs-toggle="modal"
                        data-bs-target="#select_teammate_Modal">
                    <span class="material-symbols-outlined ">add</span>
                </button>
            </h3>
            <div class="d-flex">
                <ol id="teammate_container" class="teammate_container list-group list-group-numbered">

                </ol>
            </div>
        </div>
        <div>
            <button>完成建立</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="select_teammate_Modal" tabindex="-1"
         aria-labelledby="select_teammate_ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="select_teammate_ModalLabel">選取組員

                    </h5>

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
                    <div class="alert alert-info mt-2" role="alert">
                        若要選取不同班級的同學，請先完成同一個班級的選取，再切換年度班級。
                    </div>
                    <hr>
                    <div class="list-group h-100" id="user_list_container">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="done_select_btn">完成選取
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        //api info
        const api_token = '{{$api_token}}';
        const target_url = '{{route('home')}}/api/';
        //element info
        const class_select = document.querySelector('#class_select');
        const user_list_container = document.querySelector('#user_list_container');
        //data info
        let teammate_name_array = [];
        let teammate_id_array = [];

        //剛開始先抓一次資料
        fetch_data(class_select.value);

        class_select.addEventListener('change', () => {
            fetch_data(class_select.value);
            //每次點擊選取組員按鈕，就重新抓一次資料
            document.querySelector('#modal_btn').addEventListener('click', () => {
                fetch_data(class_select.value);
            });
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
<input class="form-check-input me-1 teammate_checkbox" type="checkbox" data-student-name="${user_data.name}" value="${user_data.id}">${user_data.student_id + " " + user_data.name}</label>`;
                        });
                        let teammate_checkbox = document.querySelectorAll('.teammate_checkbox');
                        teammate_checkbox.forEach((checkbox) => {
                            //比對之前是否有選取過，有的話就打勾
                            teammate_id_array.forEach((id) => {
                                if (checkbox.value == id) {
                                    checkbox.checked = true;
                                }
                            })
                            checkbox.addEventListener('change', () => {
                                //勾選的加入列表 沒勾選的移出列表
                                if (checkbox.checked) {
                                    teammate_name_array.push(String(checkbox.dataset.studentName))
                                    teammate_id_array.push(checkbox.value)
                                    console.log(teammate_name_array);
                                    console.log(teammate_id_array);
                                } else {
                                    teammate_name_array.push(checkbox.dataset.studentName)
                                    teammate_name_array = teammate_name_array.filter(function (item) {
                                        return item !== checkbox.dataset.studentName
                                    });
                                    teammate_id_array = teammate_id_array.filter(function (item) {
                                        return item !== checkbox.value
                                    });
                                    console.log(teammate_name_array);
                                    console.log(teammate_id_array);
                                }

                            });
                        })
                    } else {
                        user_list_container.innerHTML += `<div class="alert alert-warning" role="alert">
                           ${json.message}
                        </div>`;
                    }
                });
        }


        //完成選取按鈕
        const done_select_btn = document.querySelector('#done_select_btn');
        done_select_btn.addEventListener('click', () => {
            render_list();
        });

        //渲染組員列表
        function render_list() {
            let teammate_container = document.querySelector('#teammate_container');
            teammate_container.innerHTML = '';
            teammate_name_array.forEach((item, index) => {
                //建立li元素，插入資料，並渲染到頁面上
                let new_li = document.createElement('li');
                new_li.className = 'list-group-item teammate_item d-flex align-items-center position-relative';
                new_li.innerHTML = `<p class="m-0">${teammate_name_array[index]}</p>
<div class="ms-4"><span data-student-id="${teammate_id_array[index]}" data-student-name="${teammate_name_array[index]}" class="cancel_icon position-absolute top-50 end-0 me-2 translate-middle-y align-text-bottom material-symbols-outlined">
                                    close
                                    </span></div>`;
                teammate_container.appendChild(new_li);
            });
            let cancel_icon = document.querySelectorAll('.cancel_icon');
            cancel_icon.forEach((item) => {
                item.addEventListener('click', () => {
                    //移除所選元素
                    teammate_id_array = teammate_id_array.filter(function (array_item) {
                        return array_item !== item.dataset.studentId;
                    });
                    teammate_name_array = teammate_name_array.filter(function (array_item) {
                        return array_item !== item.dataset.studentName;
                    });

                    console.log(teammate_name_array);
                    console.log(teammate_id_array);
                    render_list();
                });
            });
        }
    </script>
@endsection
