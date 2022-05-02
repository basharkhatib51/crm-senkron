<div class="row text-center section-4 my-5">
    <div class="col col-12 my-5">
        <h1>  {{$sections->getById(4)?->name}}</h1>
    </div>
    <div class="col col-12">
        <div class="container dir-initial">
            <section class="customer-logos slider">
                @foreach($sections->getById(4)?->elements as $section)
                    <div class="slide"><img src="/{{$section->image?->url}}"></div>
                @endforeach
            </section>
        </div>
    </div>
</div>
