@if($sliders?->count()>0)
    <div id="iframe-youtube">
        <div id="iframe-youtube-close" class="video-iframe-close">
        <button class="btn btn-danger">close</button></div>
        <iframe
            class="video-iframe"
            width="560" height="315" src="null" static-src="https://www.youtube.com/embed/2XUs1JBRl0A" title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>
    <div class="container-fluid d-none d-lg-block full-slider min-h-700 mt-0">
        <div class="sliders-elements carousel slide" id="homeSlider" data-ride="carousel">
            <div class="slider-element carousel-inner">
                <div class="carousel-indicators carousel-indicators-full">
                    <div class="row">
                        <div class="col col-6 text-center">
                            <a id="play-youtube">
                                <img class="play" src="/images/play.png">
                            </a>
                        </div>
                        <div class="col col-6 align-self-center">
                            <div class="row controls">
                                @foreach(range(0, $sliders->count()-1) as $a)
                                    <div class="col col-auto"><a data-bs-target="#homeSlider" data-bs-slide-to="{{$a}}"
                                                                 {{$a==0?'aria-current=true':''}} aria-label="Slide {{$a}}"
                                                                 class="{{$a==0?'active':''}}"><i
                                                class="fas fa-bolt fa-lg"></i></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($sliders as $key=>$slider)
                    @if($slider->background?->url)
                        <div class="carousel-item  {{$key==0?'active':''}}">
                            <img src="/{{$slider->background?->url}}" class="d-block w-100 slide-img"
                                 alt="{{$slider->background?->name}}">
                            @if($slider->title || $slider->content)
                                <div class="slider-content">
                                    <div class="row justify-content-evenly">
                                        <div class="col-auto slider-text">
                                            <h5>{{$slider->title}}</h5>
                                            <span>{{$slider->content}}</span>
                                        </div>
                                        @if($slider->image)
                                            <div class="col-auto">
                                                <img
                                                    {{--                                                    class="slider-single-image"--}}
                                                    src="{{$slider->image?->url}}" width="300px">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
            <button class="d-none d-lg-block carousel-control-prev" type="button" data-bs-target="#homeSlider"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="d-none d-lg-block carousel-control-next" type="button" data-bs-target="#homeSlider"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container-fluid d-block d-lg-none full-slider">
        <div class="row">
            <div class="col col-12 m-0 p-0">
                <div id="mobileHomeSlider" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <div class="row controls justify-content-center">
                            @foreach(range(0, $sliders->count()-1) as $a)
                                <div class="col col-auto"><a data-bs-target="#mobileHomeSlider"
                                                             data-bs-slide-to="{{$a}}"
                                                             {{$a==0?'aria-current=true':''}} aria-label="Slide {{$a}}"
                                                             class="{{$a==0?'active':''}}"><i
                                            class="fas fa-bolt fa-lg"></i></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="carousel-inner">
                        @foreach($sliders as $key=>$slider)
                            @if($slider->background?->url)
                                <div class="carousel-item {{$key==0?'active':''}} mobile-carousel-item">
                                    <img src="/{{$slider->background?->url}}" class="d-block w-100 slide-img mobile-slide-img"
                                         style="height: 450px!important;" alt="{{$slider->background?->name}}">
                                    @if($slider->title || $slider->content)
                                        <div class="slider-mobile-content ">
                                            <div class="row text-center justify-content-center">
                                                <div class="col-12 slider-mobile-text mt-3 py-2">
                                                    <h5>{{$slider->title}}</h5>
                                                    <span>{{$slider->content}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#mobileHomeSlider"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#mobileHomeSlider"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

