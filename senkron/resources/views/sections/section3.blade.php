<div class="row text-center d-none d-lg-flex section-3">
    @foreach($sections->getById(3)?->elements as $section)
        <div class="col col-4">
            <a class="plus" href="{{$section->url}}">
                <i class="fas fa-plus"></i>
            </a>
            <div class="polygon-back" style="  background-image: url('/{{$section->image?->url}}');">
            </div>
            <div class="text-card">{{$section->title}}</div>
            <div class="bolt"><i class="fas fa-bolt"></i></div>
        </div>
    @endforeach
</div>
<div class="row text-center  d-block d-lg-none section-min-3">
    @foreach($sections->getById(3)?->elements as $section)
        <div class="col col-12">
            <a class="plus" href="{{$section->url}}">
                <i class="fas fa-plus"></i>
            </a>
            <div class="polygon-back" style="  background-image: url('/{{$section->image?->url}}');">
            </div>
            <div class="text-card">{{$section->title}}</div>
            <div class="bolt"><i class="fas fa-bolt"></i></div>
        </div>
    @endforeach
</div>
