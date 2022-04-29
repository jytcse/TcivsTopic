<div class="row  align-items-center overflow-hidden" style="height: 90vh;">
    <div class="col-lg-12 position-relative slides_container px-0">
        <div class="custom_slides">
            <div class="custom_slide_left d-none d-lg-inline-block position-absolute top-50 translate-middle-y">
                <button
                    class="custom_slide_btn custom_slide_pre_btn d-flex justify-content-center align-items-center border-0  ">
                <span class="material-symbols-outlined">
                    navigate_before
                </span>
                </button>
            </div>
            {{--渲染五個slide--}}
            @for($i=0;$i<$slide_times;$i++)
                @include('components/slide')
            @endfor
            <div class="custom_slide_right d-none d-lg-inline-block position-absolute top-50 translate-middle-y">
                <button
                    class="custom_slide_btn custom_slide_next_btn d-flex justify-content-center align-items-center border-0 ">
                <span class="material-symbols-outlined">
                    navigate_next
                </span>
                </button>
            </div>
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
            let active = false;

            function auto_play(second) {
                if (!active) {
                    active = setInterval(() => {
                        offset_value += offset_unit;
                        if (offset_value < (slide.length - 1) * offset_unit) {
                            //輪播到最後一個，重置位移量 (讓第一個slide歸位
                            offset_value = 0;
                            slide_offset(offset_value);
                        }
                        slide_offset(offset_value);
                    }, second);
                }
            }

            //第一次判斷網頁寬度>=992的話就autoplay
            if (window.innerWidth >= 992) {
                auto_play({{$slide_speed*1000}});
            }
            {{--auto_play({{$slide_speed*1000}});--}}
            window.addEventListener('resize', () => {
                //lg size
                if (window.innerWidth >= 992) {
                    auto_play({{$slide_speed*1000}});
                } else {
                    clearInterval(active);
                    active = false;
                }
            });
            {{--                        @endif--}}


        </script>
    </div>
</div>

