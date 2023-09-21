<div class="custom_slide">
    <article>
        <div class="row align-items-center user-select-none px-5">
            <div class="col-lg-6 order-lg-1 ps-lg-0 pe-lg-5">
                <section class="pe-lg-5">
                    <img src=" {{$data->topic_thumbnail}}"
                         class="custom_slide_img d-block w-100 user-select-none"
                         alt="...">
                </section>
            </div>
            <div class="col-lg-6 order-lg-0 ps-lg-5">
                <div class="custom_slide_text mt-3 ps-lg-5">
                    <section class="ps-lg-2">
                        {{--  專題名稱 --}}
                        <h1 class="custom_slide_name mb-2 fw-bold">{{$data->topic_name}}</h1>
                        {{--  專題年度 --}}
                        <p class="custom_slide_year mb-1">
                            <span><time>{{$data->team->classmodel->years}}</time>學年度 {{$data->team->classmodel->class_type}}班 </span>
                        </p>
                        <p class="custom_slide_year mb-3">
                            <span>
                                組長: {{$data->team->teamleader->user->name}}
                            </span>
                        </p>
                        {{--  專題動機 --}}
                        <p class="custom_slide_content">
                            {{$data->topic_motivation}}
                        </p>
                    </section>
                    <section class="ps-lg-2">
                        {{--連結到專題--}}
                        <a href="{{route('specified_topic',["year"=>$data->team->classmodel->years,"class_type"=>$data->team->classmodel->class_type,"topic_id"=>$data->id])}}" class="custom_detail_btn mt-3 user-select-none" type="submit">詳細內容</a>
                    </section>
                </div>
            </div>
        </div>
    </article>
</div>

