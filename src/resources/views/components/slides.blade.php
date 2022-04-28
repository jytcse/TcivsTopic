<div class="row justify-content-center align-items-center overflow-hidden" style="height: 90vh;">
    <div class="col-lg-12  slides_container px-0">
        <div class="custom_slides">
            {{--渲染五個slide--}}
            @for($i=0;$i<$slide_times;$i++)
                <div class="custom_slide">
                    <article>
                        <div class="row align-items-center px-5">
                            <div class="col-lg-6 order-lg-1 pe-lg-5">
                                <section>
                                    <img src="https://fakeimg.pl/1920x1024/"
                                         class="custom_slide_img d-block w-100"
                                         alt="...">
                                    {{--                                        <img src="https://fakeimg.pl/300x300/" class="custom_slide_img d-block w-100"--}}
                                    {{--                                             alt="...">--}}
                                </section>
                            </div>
                            <div class="col-lg-6 order-lg-0 ps-lg-5">
                                <div class="custom_slide_text mt-3 ps-lg-5">
                                    <section>
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
                                        </p>
                                    </section>
                                    <section>
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
        <script>
            const slide = document.querySelectorAll('.custom_slide');
            let offset_value = -100;
            slide[0].style.marginLeft = 0 + 'vw';

            //每五秒自動輪播 方法是對第一個slide使用margin-left 後面的slide會自動補上 每次輪播位移單位-100vw
            function slide_offset(offset_value) {
                slide[0].style.marginLeft = offset_value + 'vw';
            }

            setInterval(() => {
                slide_offset(offset_value);
                //輪播到最後一個，重置位移量 (讓第一個slide歸位
                if (offset_value === (slide.length) * -100) {
                    offset_value = 0;
                    slide_offset(offset_value);
                }
                offset_value -= 100;
            }, {{$slide_speed*1000}});
        </script>
    </div>
</div>

