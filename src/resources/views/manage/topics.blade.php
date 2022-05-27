@extends('layouts.admin-basic')
{{-- 所有專題模板 --}}
@section('title')
    所有專題
@endsection
@section('style')
    {{--  儀錶板css  --}}
    <link href="{{ asset('css/manageTeams.css')}}" rel="stylesheet">
@endsection

@section('body')
    <div>
        <select class="w-100 form-select" id="class_selector">
            @if($select_class_data!=null)
                @foreach($select_class_data as $data)
                    <option data-year="{{$data->years}}"
                            data-class-type="{{$data->class_type}}"
                            @if($route_parameter['year']==$data->years &&$route_parameter['type']==$data->class_type) selected @endif>
                        {{$data->years}}年{{$data->class_type}}班
                    </option>
                @endforeach
            @else
                <option disabled selected="selected">沒有任何年度班級</option>
            @endif
        </select>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>年度班級</th>
                <th>專題名稱</th>
                <th>組員</th>
                @if(auth()->user()->identity_id!=1)
                    <th>動作</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @if(isset($topic_data) && $topic_data!=null)
                @foreach($topic_data as $topic)
                    <tr>
                        <td>
                            {{ $loop->index +1 }}
                        </td>
                        <td>
                            {{--                            年度班級--}}
                            {{$topic->team->classmodel->years}}年{{$topic->team->classmodel->class_type}}班
                        </td>
                        <td>
                            {{--                            專題名稱--}}
                            {{$topic->topic_name}}
                        </td>
                        <td>
                            {{--                            組員--}}
                            @if(count($topic->team->teammates) !=1)
                                @foreach($topic->team->teammates as $teammate)
                                    {{ $teammate->user->name}}
                                @endforeach
                            @else
                                無組員
                            @endif
                        </td>
                        <td>
                            @if(auth()->user()->identity_id==2)
                                <button>查看</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center"><h4 class="mb-0">沒有任何專題</h4></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

@endsection
@section('script')
    <script>
        const class_selector = document.querySelector('#class_selector');
        {{--使用者選擇了其他年度班級，重導向--}}
        class_selector.addEventListener('change', () => {
            option_dataset = class_selector.options[class_selector.selectedIndex].dataset;
            window.location.href = '  {{route('my_topic')}}' + `/${option_dataset.year.trim()}/${option_dataset.classType.trim()}/all`;
        });
    </script>
@endsection
