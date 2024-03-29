@extends('layouts.admin-basic')
{{-- 所有組別模板 --}}
@section('title')
    所有組別
@endsection
@section('style')
    {{--  儀錶板css  --}}
    <link href="{{ asset('css/manageTeams.css')}}" rel="stylesheet">
@endsection

@section('body')
    <div>
        <select class="w-100 form-select" id="class_selector" >
            @if($select_class_data!=null)
                @foreach($select_class_data as $data)
                    <option data-year="{{$data->years}}"
                            data-class-type="{{$data->class_type}}" @if($route_parameter['year']==$data->years &&$route_parameter['type']==$data->class_type) selected @endif>
                        {{$data->years}}年{{$data->class_type}}班
                    </option>
                @endforeach
            @else
                <option disabled selected="selected">沒有任何班級有組別</option>
            @endif
        </select>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>年度班級</th>
                <th>組長</th>
                <th>組員</th>
            </tr>
            </thead>
            <tbody>
            @if($teams!=null)
                @foreach($teams as $team)
                    <tr>
                        <td>
                            {{ $loop->index +1 }}
                        </td>
                        <td>
                            {{--年度班級   --}}
                            {{$team->classmodel->years}}年{{$team->classmodel->class_type}}班
                        </td>
                        <td>
                            {{-- 組長名稱--}}
                            {{$team->teamleader->teammate->user->name}}
                        </td>
                        <td>
                            {{--   組員  --}}
                            @if(count($team->teammates) !=1)
                                @foreach($team->teammates as $teammate)
                                    {{--  組員姓名 != 組長的名稱--}}
                                    @if($teammate->user->name != $team->teamleader->teammate->user->name)
                                        {{ $teammate->user->name}}
                                    @endif
                                @endforeach
                            @else
                                無組員
                            @endif
                        </td>
{{--                        <td>--}}
                            {{--  動作 --}}
{{--                            @if(isset($hasTeam) && $hasTeam && auth()->user()->identity_id==1)--}}
{{--                                <button>加入</button>--}}
{{--                            @endif--}}
{{--                            <button>查看</button>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center"><h4 class="mb-0">沒有任何組別</h4></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

@endsection
@section('script')
    <script>
        let class_selector = document.querySelector('#class_selector');
        {{--使用者選擇了其他年度班級，重導向--}}
        class_selector.addEventListener('change', () => {
            option_dataset = class_selector.options[class_selector.selectedIndex].dataset;
            window.location.href = '{{route('teams')}}' + `/${option_dataset.year.trim()}/${option_dataset.classType.trim()}`;
            console.log(option_dataset.classType.trim());
        });
    </script>
@endsection
