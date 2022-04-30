@extends('layouts.basic')
@section('title')
    首頁
@endsection
@section('style')
    {{--  首頁css  --}}
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    {{--  首頁下方打字區域css  --}}
    <link href="{{ asset('css/homeType.css') }}" rel="stylesheet">
    {{--  首頁輪播區域css  --}}
    <link href="{{ asset('css/homeSlides.css') }}" rel="stylesheet">
    {{--  時間軸css  --}}
    <link href="{{ asset('css/timelineCard.css') }}" rel="stylesheet">
@endsection

@section('body')
    <main class="container-fluid">
        {{-- 輪播元件 slide_times輪播數量  slide_speed輪播速度單位秒 --}}
        @include('components.slides',['slide_times' =>5,'slide_speed'=>8])
        <div class="row justify-content-center align-items-center type_container">
            <div class="col-12">
                <div class="text-center">
                    <div>
                        <h2 class="type_title text-white">中工專題網</h2>
                    </div>
                    <div style="height: 30px">
                        <span id="type" class="type_content"></span>
                    </div>
                </div>
            </div>
        </div>
        @include('components.timeline-card')

    </main>
@endsection
@section('script')
    <script src="{{asset('js/homeType.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min.js"></script>

    <script>
        const custom_card = document.querySelectorAll('.custom_card');

        custom_card.forEach((card, index) => {
            let tl = gsap.timeline({
                scrollTrigger: {
                    trigger: card,
                    toggleActions: "restart none none none"
                }
            })
            if (index % 2 === 0) {
                tl.from(custom_card[index], {
                    x: -100,
                    opacity: 0,
                    duration: 1,
                    stagger: 0.02,
                });
            } else {
                tl.from(custom_card[index], {
                    x: 200,
                    opacity: 0,
                    duration: 1,
                    stagger: 0.02,
                });
            }
        });
        let tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.see_all_btn',
                toggleActions: "restart none none none"
            }
        })
        tl.to('.see_all_btn', {
            clipPath: 'circle(70.7% at 50% 50%)',
            duration: 1.2,
        })
    </script>
@endsection
