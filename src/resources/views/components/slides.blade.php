<div class="row  align-items-center overflow-hidden" style="height: 90vh;">
    <div class="col-lg-12 position-relative slides_container px-0">
        <div class="custom_slide_left d-none d-lg-inline-block position-absolute top-50 translate-middle-y">
            <button
                class="custom_slide_btn custom_slide_pre_btn d-flex justify-content-center align-items-center border-0  ">
                <span class="material-symbols-outlined">
                    navigate_before
                </span>
            </button>
        </div>
        <div class="custom_slides">
            {{--渲染五個slide--}}
            @for($i=0;$i<$slide_times;$i++)
                <div class="custom_slide">
                    <article>
                        <div class="row align-items-center px-5">
                            <div class="col-lg-6 order-lg-1 ps-lg-0 pe-lg-5">
                                <section class="pe-lg-5">
                                    <img src="https://fakeimg.pl/1920x1024/"
                                         class="custom_slide_img d-block w-100"
                                         alt="...">
                                    {{--                                        <img src="https://fakeimg.pl/300x300/" class="custom_slide_img d-block w-100"--}}
                                    {{--                                             alt="...">--}}
                                </section>
                            </div>
                            <div class="col-lg-6 order-lg-0 ps-lg-5">
                                <div class="custom_slide_text mt-3 ps-lg-5">
                                    <section class="ps-lg-2">
                                        {{--  專題名稱 --}}
                                        <h1 class="custom_slide_name mb-2">測試專題{{$i+1}}</h1>
                                        {{--  專題年度 --}}
                                        <p class="custom_slide_year mb-3">
                                            <time>108</time>
                                            學年
                                        </p>
                                        {{--  專題動機 --}}
                                        <p class="custom_slide_content">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad animi
                                            aperiam
                                            delectus dignissimos
                                            ea est et, fugiat impedit nesciunt officia, optio quas repellat
                                            tempore
                                            unde,
                                            veritatis. Cum,
                                            quasi quia. Delectus?
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab atque
                                            dignissimos ex incidunt iusto nihil nostrum omnis perspiciatis quae, quaerat
                                            quo repellendus suscipit voluptatibus? Cumque eaque facere maxime quisquam
                                            repudiandae.
                                        </p>
                                    </section>
                                    <section class="ps-lg-2">
                                        {{--連結到專題--}}
                                        <a href="#" class="custom_detail_btn mt-3" type="submit">詳細內容</a>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            @endfor
        </div>
        <div class="custom_slide_right d-none d-lg-inline-block position-absolute top-50 translate-middle-y">
            <button
                class="custom_slide_btn custom_slide_next_btn d-flex justify-content-center align-items-center border-0 ">
                <span class="material-symbols-outlined">
                    navigate_next
                </span>
            </button>
        </div>
        {{--    輪播邏輯    --}}
        <script>
            const slide = document.querySelectorAll('.custom_slide');
            const slide_pre_btn = document.querySelector('.custom_slide_pre_btn');
            const slide_next_btn = document.querySelector('.custom_slide_next_btn');
            let offset_unit = -100;
            let offset_value = 0;
            slide[0].style.marginLeft = 0 + 'vw';

            function slide_offset(offset_value) {
                slide[0].style.marginLeft = offset_value + 'vw';
            }

            //檢查往左或往右有沒有超過，超過就loop
            function slide_check_offset(value) {
                //往左是+100
                if (value > 0) {
                    offset_value = (slide.length - 1) * offset_unit;
                    slide_offset(offset_value);
                    // console.log(offset_value + '往左超過了');
                }
                //往右是-100
                else if (value < (slide.length - 1) * offset_unit) {
                    offset_value = 0;
                    slide_offset(offset_value);
                    // console.log(offset_value + '往右超過了');
                } else {
                    slide_offset(offset_value);
                }
            }

            //監聽器 往左+100
            slide_pre_btn.addEventListener('click', () => {
                offset_value -= offset_unit;
                slide_check_offset(offset_value);
            });
            //往右-100
            slide_next_btn.addEventListener('click', () => {
                offset_value += offset_unit;
                slide_check_offset(offset_value);
            });




            {{--            @if($slide_switch)--}}
            //自動輪播 方法是對第一個slide使用margin-left 後面的slide會自動補上 每次輪播位移單位-100vw
            setInterval(() => {
                offset_value += offset_unit;
                if (offset_value < (slide.length - 1) * offset_unit) {
                    //輪播到最後一個，重置位移量 (讓第一個slide歸位
                    offset_value = 0;
                    slide_offset(offset_value);
                }
                console.log(offset_value);
                slide_offset(offset_value);
            }, {{$slide_speed*1000}});
            {{--                        @endif--}}


        </script>
    </div>
</div>

