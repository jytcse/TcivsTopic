@extends('layouts.admin-basic')
{{-- 邀請通知模板 --}}
@section('title')
    邀請通知
@endsection
@section('style')
    {{--  儀錶板css  --}}
    <link href="{{ asset('css/manageInbox.css')}}" rel="stylesheet">
@endsection

@section('body')
    <div>
        {{--        <select class="w-100" id="class_selector">--}}

        {{--        </select>--}}
        @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill"/>
                </svg>
                <div>{{$errors->first()}}
                </div>
            </div>
        @endif
        @if(session()->has('edit_success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill"/>
                </svg>
                <div>
                    {{ session()->get('edit_success') }}
                </div>
            </div>
        @endif

        <div class="alert alert-primary" role="alert">
            下方是組別對你發送的邀請，你可以在這邊決定是否加入他的組別。
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>年度班級</th>
                <th>組長</th>
                <th>當前組員</th>
                <th>動作</th>
            </tr>
            </thead>
            <tbody class="align-middle">
            {{--            @dd($team_invite);--}}

            @if($team_invite!=null)
                @foreach($team_invite as $team)
                    <tr>
                        <td>
                            {{ $loop->index +1 }}
                        </td>
                        <td>
                            {{--                                        年度班級--}}
                            {{$team->team->classmodel->years}}年{{$team->team->classmodel->class_type}}班
                        </td>
                        <td>
                            {{--                                         組長名稱--}}
                            {{$team->team->teamleader->teammate->user->name}}
                        </td>
                        <td>
                            {{--                                           組員--}}
                            @if(count($team->team->teammates) !=1)
                                @foreach($team->team->teammates as $teammate)
{{--                                    組員姓名 != 組長的名稱--}}
                                    @if($teammate->user->name != $team->team->teamleader->teammate->user->name)
                                        {{ $teammate->user->name}}
                                    @endif
                                @endforeach
                            @else
                                無
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-success action_button" data-bs-toggle="modal"
                                    data-type="accept" data-bs-target="#actionModal" value="{{$team->team_id}}">加入
                            </button>
                            <button type="button" class="btn btn-danger action_button" data-bs-toggle="modal"
                                    data-type="reject" data-bs-target="#actionModal" value="{{$team->team_id}}">拒絕
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center"><h5 class="mb-0">Oops! 這邊好像空空的，晚點再回來看看吧!</h5></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actionModalLabel">二次確認</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning mb-0" id="actionModalBody" role="alert">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                    <button type="button" class="btn btn-primary" id="confirm_button">確認送出</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let action_modal_body = document.querySelector('#actionModalBody');
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

        confirm_button.addEventListener('click', () => {
            let target_url = '{{route('my_team')}}/' + confirm_button.dataset.targetId + '/invite/' + confirm_button.dataset.type;
            window.location.href = target_url;
        });
    </script>
@endsection
