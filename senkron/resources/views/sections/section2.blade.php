<div class="container my-5 section-2">
    <div class="row my-5 justify-content-center">
        <div class="col my-5 col-12 text-center">
            <h1>{{$sections->getById(2)?->name}}</h1>
        </div>
        @foreach($sections->getById(2)?->elements as $section)
            <div class="col my-5 col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card border-danger text-center">
                    <div class="row justify-content-center">
                        <div class="col col-auto card-icon text-danger"><i class="{{$section->pack}} fa-{{$section->icon}} fs-1"></i></div>
                        <div class="col col-12 my-5">
                            <h4 class="py-3">{{$section->title}}</h4>
                            {{$section->description}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
