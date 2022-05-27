<div
    class="sidebar_name d-flex justify-content-center align-items-center user-select-none position-relative">
    控制面板

</div>
<ul class="sidebar user-select-none">
    <li class="bg-white @if(Route::currentRouteName()=='dashboard') active @endif">
        <a class="item_link d-block w-100 h-100 ps-3 text-decoration-none" href="{{ route('dashboard') }}"
           class=" w-100 h-100">
                                <span class="material-symbols-outlined align-text-bottom">
                                        person
                                    </span>
            我的資訊
        </a>
    </li>
    @if(auth()->user()->identity_id==1)
    <li class="bg-white @if(Route::currentRouteName()=='inbox') active @endif position-relative">
        <a class="item_link d-block w-100 h-100 ps-3 text-decoration-none" href="{{ route('inbox') }}"
           class=" w-100 h-100">
                                <span class="material-symbols-outlined align-text-bottom">
                             inbox
                                    </span>
            邀請通知
            <span id="inbox_number"
                  class="@if($inbox_number!=0)position-absolute top-50 end-0 translate-middle badge rounded-pill bg-danger @else d-none @endif">
            @if($inbox_number!=0)
                    {{$inbox_number}}
                @endif
                </span>
        </a>
    </li>
    @endif
    <li class="accordion accordion-flush" id="accordionFlush">
        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="flush-headingTeam">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTeam" aria-expanded="false" aria-controls="flush-collapseTeam">
                                      <span class="material-symbols-outlined align-middle pe-1">
                                        group
                                    </span>
                    組別
                </button>
            </h2>
            <div id="flush-collapseTeam"
                 class="accordion-collapse collapse @if(Route::currentRouteName()=='my_team' || Route::currentRouteName()=='teams' ||Route::currentRouteName()=='create_team_page') show @endif"
                 aria-labelledby="flush-headingTeam"
                 data-bs-parent="#accordionFlush">
                <div class="accordion-body p-0">
                    <ul class="list-group">
                        @if(Route::currentRouteName()=='create_team_page' ||auth()->user()->identity_id==2)
                            <li class=" @if(Route::currentRouteName()=='create_team_page') active @endif"><a
                                    class="item_link text-decoration-none"
                                    href="{{ route('create_team_page') }}">建立組別</a></li>
                        @endif
                        @if(auth()->user()->identity_id==1)
                            <li class=" @if(Route::currentRouteName()=='my_team') active @endif"><a
                                    class="item_link text-decoration-none"
                                    href="{{ route('my_team') }}">我的組別</a></li>
                        @endif
                        <li class=" @if(Route::currentRouteName()=='teams') active @endif"><a
                                class="item_link text-decoration-none"
                                href="{{ route('teams') }}">所有組別</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="flush-headingTopic">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTopic" aria-expanded="false" aria-controls="flush-collapseTopic">
                                      <span class="material-symbols-outlined align-middle pe-1">
                                     topic
                                    </span>
                    專題
                </button>
            </h2>
            <div id="flush-collapseTopic"
                 class="accordion-collapse collapse @if(Route::currentRouteName()=='my_topic' ||Route::currentRouteName()=='specified_year_topics') show @endif"
                 aria-labelledby="flush-headingTopic"
                 data-bs-parent="#accordionFlush">
                <div class="accordion-body p-0">
                    <ul class="list-group">
                        @if(auth()->user()->identity_id==1)
                        <li class="@if(Route::currentRouteName()=='my_topic') active @endif"><a
                                class="item_link text-decoration-none "
                                href="{{ route('my_topic') }}">我的專題</a></li>
                        @endif
                        <li class="@if(Route::currentRouteName()=='specified_year_topics') active @endif"><a
                                class="item_link text-decoration-none"
                                href="{{ route('topics') }}">所有專題</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li class="bg-white">
        <a href="{{ route('home') }}"
           class="ps-3 d-block w-100 h-100 item_link text-decoration-none">
            <span class="material-symbols-outlined align-text-bottom">
            home
            </span>
            首頁
        </a>
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

<script>
    const custom_dropdown = document.querySelectorAll('.custom_dropdown')
    custom_dropdown.forEach((element) => {
        element.addEventListener('click', () => {
            element.classList.toggle('show');
        })
    });
</script>
