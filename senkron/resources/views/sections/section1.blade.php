<div class="container my-5">
    <div class="row my-5 d-flex justify-content-center">
        <div class="col my-5 col-12 text-center">
            <h1>{{$sections->getById(1)?->name}}</h1>
        </div>
        @foreach($sections->getById(1)?->elements as $section)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center my-5 section-1" data-aos="zoom-in-down">
                <div class="card border-danger text-center w-100 position-relative">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center mt-5"><i style="font-size: 60px" class="{{$section->pack}} fa-{{$section->icon}}"></i></div>
                        <div class="col-12 my-5">
                            <h4 class="mt-3">{{$section->title}}</h4>
                            {{$section->description}}
                        </div>
                        <div class="col-12 text-end bottom-0 w-100 position-absolute">
                            <a>
                            {{lang('More')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
