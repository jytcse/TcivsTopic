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
        {{--        @dd($select_class_data);--}}
        <select class="w-100 form-select" id="class_selector" >
            @if($select_class_data!=null)
                @foreach($select_class_data as $data)
                    <option data-year="{{$data->years}}"
                            data-class-type="@switch($data->class_type)@case('甲')A @break @case('乙')B @break @endswitch">
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
        let option_dataset = class_selector.options[class_selector.selectedIndex].dataset;

        {{--解析url上選擇的年度和班級 存在javascritp常數裡--}}
        @php
            $path_array = explode('/',url()->current());
        @endphp

        const path_year = '@php echo $path_array[count($path_array)-2]; @endphp';
        const path_type = '@php echo $path_array[count($path_array)-1]; @endphp';

            {{--如果符合url上的班級 預設就selected--}}
        for (let x = 0; x < class_selector.options.length; x++) {
            if (class_selector.options[x].dataset.year.trim() === path_year && class_selector.options[x].dataset.classType.trim() === path_type) {
                console.log(class_selector.options[x]);
                class_selector.options[x].selected = true;
            }
        }

        {{--使用者選擇了其他年度班級，重導向--}}
        class_selector.addEventListener('change', () => {
            option_dataset = class_selector.options[class_selector.selectedIndex].dataset;
            window.location.href = '{{route('teams')}}' + `/${option_dataset.year.trim()}/${option_dataset.classType.trim()}`;
            console.log(option_dataset.classType.trim());
        });
    </script>
@endsection
