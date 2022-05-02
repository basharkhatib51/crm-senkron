<div class="container-fluid app-navbar d-none d-lg-block mt-0">
    <div class="row">
        <div class="col col-3 px-5">
            <a href="/">
                <img class="logo" src="/images/logo.png">
            </a>
        </div>
        <div class="col col-9 nav-bar-menus">
            <div class="row text-light py-2">
                <div class="col col-6">
                    <div class="row justify-content-around">
                        @if($setting->getByKey('Phone'))
                            <div class="col col-auto">
                                <a href="tel://{{$setting->getByKey('Phone')}}">
                                    <i class="fas fa-phone"></i> {{$setting->getByKey('Phone')}}
                                </a>
                            </div>
                        @endif
                        @if($setting->getByKey('email'))
                            <div class="col col-auto">
                                <a href="mailto:{{$setting->getByKey('email')}}">
                                    <i class="fas fa-envelope"></i>
                                    {{$setting->getByKey('email')}}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col col-6">
                    <div class="row justify-content-end px-4 text-light">
                        @if($setting->getByKey('Whatsapp'))
                            <div class="col col-auto"><a
                                    href="whatsapp://send?phone={{$setting->getByKey('Whatsapp')}}"><i
                                        class="fab fa-whatsapp"></i></a></div>@endif
                        @if($setting->getByKey('Facebook'))
                            <div class="col col-auto"><a href="{{$setting->getByKey('Facebook')}}"><i
                                        class="fab fa-facebook-f"></i></a></div>@endif
                        @if($setting->getByKey('Instagram'))
                            <div class="col col-auto"><a href="{{$setting->getByKey('Instagram')}}"><i
                                        class="fab fa-instagram"></i></a></div>@endif
                        @if($setting->getByKey('Twitter'))
                            <div class="col col-auto"><a href="{{$setting->getByKey('Twitter')}}"><i
                                        class="fab fa-twitter"></i></a></div>@endif
                        @if($setting->getByKey('Linkedin'))
                            <div class="col col-auto"><a href="{{$setting->getByKey('Linkedin')}}"><i
                                        class="fab fa-linkedin"></i></a></div>@endif
                        @if($setting->getByKey('Youtube'))
                            <div class="col col-auto"><a href="{{$setting->getByKey('Youtube')}}"><i
                                        class="fab fa-youtube"></i></a></div>@endif
                    </div>
                </div>
            </div>
            <div class="row my-3 py-2 nav-bar-menu justify-content-center">
                @foreach($menu as $el)
                    <div class="col col-auto px-1">
                        <a href="{{$el->value}}"
                           class="{{$el->children_menus->count()>0?'dropdown-toggle':''}} {{$el->value==Request::url()?'active':''}}"
                           id="{{$el->id.'menu'}}"
                            {{$el->children_menus->count()>0?'type=button data-bs-toggle=dropdown aria-expanded=false':''}}
                        >
                            {{$el->name}}
                        </a>
                        @if($el->children_menus->count()>0)
                            <ul class="dropdown-menu" aria-labelledby="{{$el->id.'menu'}}">
                                @foreach($el->children_menus as $sub_el)
                                    <li><a href="{{$sub_el->value}}"
                                           class="dropdown-item text-dark {{$sub_el->value==Request::url()?'active':''}}"
                                           id="{{$sub_el->id.'menu'}}"
                                            {{$el->children_menus->count()>0?'type="button" data-bs-toggle="dropdown" aria-expanded="false"':''}}>
                                            {{$sub_el->name}}
                                            {!! $sub_el->children_menus->count()>0?"&raquo;":''!!}
                                        </a>
                                        @if($sub_el->children_menus->count()>0)
                                            <ul class="dropdown-menu dropdown-submenu"
                                                aria-labelledby="{{$sub_el->id.'menu'}}">
                                                @foreach($sub_el->children_menus as $sub2_el)
                                                    <li>
                                                        <a href="{{$sub2_el->value}}"
                                                           class="dropdown-item text-dark {{$sub2_el->value==Request::url()?'active':''}}">
                                                            {{$sub2_el->name}}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
                <div class="col col-auto px-1">
                    <a href="#" class="dropdown-toggle"
                       id="lang_menu"
                       type=button data-bs-toggle=dropdown aria-expanded=false
                    >
                        <img class="mx-1" width="30px"
                             src="/{{app()->languages->where('code',app()->getLocale())->first()?->image?->url}}">
                        {{app()->languages->where('code',app()->getLocale())->first()?->name}}
                    </a>
                    <ul class="dropdown-menu lang-menu" aria-labelledby="lang_menu">
                        @foreach(app()->languages->where('code','!=',app()->getLocale()) as $el)
                            <li>
                                <a href="/language/{{$el->id}}" class="dropdown-item text-dark">
                                    <img class="mx-1" width="30px" src="/{{$el->image?->url}}">{{$el->name}}
                                </a>
                            </li>
                            <hr>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid app-navbar-sm d-block d-lg-none mt-0">
    <div class="row justify-content-between">
        <div class="col col-9">
            <a href="/">
                <img class="logo" src="/images/logo.png">
            </a>
        </div>
        <div class="col col-3 align-self-center text-light menu-button">
            <a href="#" id="open-menu">
                <i class="fas fa-bars"></i>
            </a>
        </div>
    </div>
</div>
<div id="MobilMenu" class="container-fluid mobil-menu">
    <div class="row">
        <div class="col col-12 text-end h4 p-3">
            <a href="#" id="close-menu"> <i class="fas fa-times"></i></a>
        </div>
        <div class="col col-12">
            <ul>

                @foreach($menu as $el)
                    <li class="{{$el->children_menus->count()>0?'sub-menu':''}}">
                        <a href="{{$el->value}}">{{$el->name}}</a>
                        @if($el->children_menus->count()>0)
                            <div class="fa fa-caret-down right"></div>
                            <ul>
                                @foreach($el->children_menus as $sub_el)
                                    <li class="{{$sub_el->children_menus->count()>0?'sub-menu':''}}">
                                        <a href="{{$sub_el->value}}">{{$sub_el->name}}</a>
                                        @if($sub_el->children_menus->count()>0)
                                            <div class="fa fa-caret-down right"></div>
                                            <ul>
                                                @foreach($sub_el->children_menus as $sub_el2)
                                                    <li>
                                                        <a href="{{$sub_el2->value}}">{{$sub_el2->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
                <li>
                    <a href="#" class="dropdown-toggle"
                       id="lang_menu"
                       type=button data-bs-toggle=dropdown aria-expanded=false
                    >
                        <img class="mx-1" width="30px"
                             src="/{{app()->languages->where('code',app()->getLocale())->first()?->image?->url}}">
                        {{app()->languages->where('code',app()->getLocale())->first()?->name}}
                    </a>
                    <ul class="dropdown-menu lang-menu" aria-labelledby="lang_menu">
                        @foreach(app()->languages->where('code','!=',app()->getLocale()) as $el)
                            <li>
                                <a href="/language/{{$el->id}}" class="dropdown-item text-dark">
                                    <img class="mx-1" width="30px" src="/{{$el->image?->url}}">{{$el->name}}
                                </a>
                            </li>
                            <hr>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
