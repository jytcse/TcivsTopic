<div class="row card_col position-relative overflow-hidden">
    <div class="line">
    </div>
    @for($card_counter=0;$card_counter<6;$card_counter++)
        <div class="col-12 position-relative custom_card_col">
            <div
                class="card custom_card position-relative @if($card_counter % 2 ==0) custom_card_odd me-lg-auto @else custom_card_even ms-lg-auto @endif mt-5">
                <img loading="lazy" src="https://fakeimg.pl/1920x1024/"
                     class="custom_card_img user-select-none d-block w-100 card-img-top"
                     alt="...">
                <div class="card-body custom_card_body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk
                        of the
                        card's content.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam autem blanditiis
                        dignissimos eius error impedit incidunt, nisi nobis perferendis possimus quae quam
                        quibusdam quod, repudiandae sit, tempore temporibus unde voluptatibus.
                    </p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

        </div>
    @endfor
    <div class="d-flex justify-content-center my-5 see_all_btn_container">
        <a class="see_all_btn" href="/all">瀏覽全部</a>
    </div>
</div>
