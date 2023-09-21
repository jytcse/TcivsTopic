<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{--  icon  --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Roboto&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Noto Sans TC', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 48
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
    {{--  admin-basic css--}}
    <link href="{{ asset('css/adminBasic.css')}}" rel="stylesheet">
    {{--  Sidebar css  --}}
    <link href="{{ asset('css/sidebar.css')}}" rel="stylesheet">

    <link rel="stylesheet"
          href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <title>@yield('title')-中工資訊專題網</title>
    @yield('style')
</head>
<body>
<main>
    <div class="container" style="height: 100vh">
        <div class="d-flex dashboard_container justify-content-center align-items-center">
            <div class="row dashboard_row">
                <div class="col-3 left_side px-0">
                    @include('components.sidebar')
                </div>
                <div class="col-9 right_side p-4 user-select-none">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>
</main>


@yield('script')
<!-- Bootstrap Js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    Echo.private('User.Message.box.{{ auth()->id() }}')
        .listen('Invite', (e) => {
            console.log(e);
            document.querySelector('#inbox_number').textContent = e.invite_info['inbox_number'] + 1;
            document.querySelector('#inbox_number').classList.remove('d-none');
            document.querySelector('#inbox_number').classList.add('position-absolute', 'top-50', 'end-0', 'translate-middle', 'badge', 'rounded-pill', 'bg-danger');
            @if(Route::currentRouteName()=='inbox')
            console.log(document.querySelectorAll('#inbox_table_body tr').length);
            let team_data = e.invite_info['team_data'];
            let tr = document.createElement('tr');
            tr.innerHTML = `
            <td>
                ${(e.invite_info['inbox_number'] + 1)}
            </td>
            <td>
                ${team_data['classmodel']['years']}年${team_data['classmodel']['class_type']}班
            </td>
            <td>
                ${team_data['teamleader']['user']['name']}
            </td>
            <td>
                無
            </td>
            <td>
                <button type="button" class="btn btn-success action_button" data-bs-toggle="modal"
                        data-type="accept" data-bs-target="#actionModal" value="${team_data['id']}">加入
                </button>
                <button type="button" class="btn btn-danger action_button" data-bs-toggle="modal"
                        data-type="reject" data-bs-target="#actionModal" value="${team_data['id']}">拒絕
                </button>
            </td>
            `;


            document.querySelector('#inbox_table_body').appendChild(tr);
            document.querySelector('#invite_dont_exist').classList.add('d-none');
            const confirm_button = document.querySelector('#confirm_button');
            document.querySelectorAll('.action_button').forEach((btn) => {
                btn.addEventListener('click', () => {
                    action_modal_body.innerText = '';
                    switch (btn.dataset.type) {
                        case 'accept':
                            action_modal_body.innerText = `你確定要 接受 這則邀請嗎?`;
                            confirm_button.dataset.type = 'accept';
                            break;
                        case 'reject':
                            action_modal_body.innerText = `你確定要 拒絕 這則邀請嗎?`;
                            confirm_button.dataset.type = 'reject';
                            break;
                    }
                    confirm_button.dataset.targetId = btn.value;
                });
            });
            @endif
        });
</script>
</body>
</html>
