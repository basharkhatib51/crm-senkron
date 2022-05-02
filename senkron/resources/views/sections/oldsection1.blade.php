<div class="container">
    <div class="row my-5">
        <div class="col col-12 my-5 my-lg-0 text-center text-lg-start">
            <h2>
                <i class="fas fa-plug"></i>
                {{$sections->getById(1)?->name}}
            </h2>
        </div>
        <div class="col col-12 my-5">
            <div class="row text-center justify-content-center section-1">
                @foreach($sections->getById(1)?->elements as $section)
                    <div class="col col-12 col-md-6 col-lg-4 col-xl-3">
                        <a
                        href="{{$section->url??'#'}}"
                        >
                        <img  src="/{{$section->image?->url}}">
                        <h4 class="py-3">{{$section->title}}</h4>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
