<div
    class="sidebar_name d-flex justify-content-center align-items-center user-select-none position-relative">
    控制面板
</div>
<ul class="sidebar user-select-none">
    <li class="bg-white">
        <a class="item_link d-block w-100 h-100 ps-3 text-decoration-none" href="{{ route('dashboard') }}"
           class=" w-100 h-100">
                                <span class="material-symbols-outlined align-text-bottom">
                                        person
                                    </span>
            我的資訊
        </a>
    </li>
    <li>
        <div class=" position-relative custom_dropdown ps-3">
                                    <span class="material-symbols-outlined align-middle">
                                        group
                                    </span>
            組別
            <div class=" position-absolute  top-50 end-0 translate-middle-y me-3">
                                        <span
                                            class="material-symbols-outlined">
                                        arrow_drop_down
                                    </span>
            </div>
        </div>
        <ul class="sub_ul">
            <li><a class="item_link text-decoration-none"
                   href="{{ route('dashboard') }}">我的組別</a></li>
            <li><a class="item_link text-decoration-none"
                   href="{{ route('dashboard') }}">所有組別</a></li>
        </ul>
    </li>
    <li>
        <div class=" position-relative custom_dropdown ps-3">
                                    <span class="material-symbols-outlined align-middle">
                                    topic
                                    </span>
            專題
            <div class=" position-absolute  top-50 end-0 translate-middle-y me-3">
                                        <span
                                            class="material-symbols-outlined">
                                        arrow_drop_down
                                    </span>
            </div>
        </div>
        <ul class="sub_ul">
            <li><a class="item_link text-decoration-none"
                   href="{{ route('dashboard') }}">我的專題</a></li>
            <li><a class="item_link text-decoration-none"
                   href="{{ route('dashboard') }}">所有專題</a></li>
        </ul>
    </li>
    <li class="bg-white">
        <a href="{{ route('logout') }}"
           class="ps-3 d-block w-100 h-100 item_link text-decoration-none">
            <span class="material-symbols-outlined align-text-bottom">
                logout
            </span>
            登出
        </a>
    </li>
</ul>