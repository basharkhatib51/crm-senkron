@extends('layout.app')
@section('slider')
    <div class="min-slider" style="background-image:url('/{{$page->upload_background?->url}}'); opacity: 0.6 ">
    </div>
@endsection
@section('content')
    <div class="{{$page->layout=='full'?'container-fluid':'container'}}">
        <div class="row mb-5 mx-5">
            <div class="col-12">
                <h2>{{$page->title}}</h2>
            </div>
            <div class="{{$page->upload_image == null && $slider_elements?->count()==0 ?'col-12':'col-12 col-xl-8'}}">
                {!! $page->content !!}
            </div>
            @if($slider_elements?->count()>0)
                <div class="col-12 col-xl-4 mt-5 mt-xl-0">
                    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($slider_elements as $element)
                                <div class="carousel-item {{$element == $slider_elements[0]?'active':''}}">
                                    <img style="height: 400px" src="/{{$element->image?->url}}" class="d-block w-100">
                                </div>
                            @endforeach
                        </div>
                        @if($slider_elements?->count()>1)
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls"
                                    data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleControls"
                                    data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                </div>
            @else
                @if($page->upload_image != null)
                    <div class="col-12 col-xl-4 mt-5 mt-xl-0 text-end">
                        <img class="w-100" src="/{{$page->upload_image?->url}}">
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

