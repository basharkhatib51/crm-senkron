@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 col-xl-9 my-5 my-xl-0">
                <div class="card p-3 bg-light product-card">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <h2>
                                        <div class="badge badge-light bg-danger">
                                            {{$product->name}}
                                        </div>
                                    </h2>
                                </div>
                                <hr class="bg-danger">
                            </div>
                        </div>
                        <div class="col-12 col-xl-6 text-center mb-5">
                            <img id="product_image" src="/{{$product->image?->url}}">
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="row">
                                @if($product->product_details->count()>0)
                                    <div class="col-12">
                                        <ul class="list-group product-details">
                                            @foreach($product->product_details as $detail)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{$detail->key}}
                                                    <span
                                                        class="badge bg-success rounded-pill">{{$detail->value}}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if($product->description)
                                    <div class="row mt-5">
                                        <div class="col-12 text-right">
                                            @if($product->product_details->count()==0)
                                                <span class="small-description">
                                            {!! $product->description !!}
                                                <div class="small-description-bottom"></div>
                                            </span>
                                            @endif
                                            <a href="#more-details"
                                               class="btn btn-outline-danger w-100">{{lang('More details')}} <i
                                                    class="fas fa-arrow-down"></i></a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                        @if($product->product_images->count()>0)
                            <div class="col-12 mt-5">
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img class="w-100" id="product_image_show" src="/{{$product->image?->url}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-images-list customer-logos slider">
                                    @foreach($product->product_images as $image)
                                        <div class="slide product_images" url_data="/{{$image->url}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><img
                                                src="/{{$image->url}}"></div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-12 col-xl-3">
                <div class="card p-3 bg-light product-card">
                    <div class="row">
                        <div class="col-12">
                            <b>{{lang("Share this product")}}</b>
                            <hr class="bg-danger">
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <div class="col-auto my-1 px-1">
                                    <!-- Twitter (url, text, @mention) -->
                                    <a href="https://twitter.com/share?url={{url()->full()}}&text={{$product->name}}">
                                        <button type="button" class="btn btn-primary bg-twitter">
                                            <i class="fab fa-twitter"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-auto my-1 px-1">
                                    <!-- Facebook (url) -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->full()}}">
                                        <button type="button" class="btn btn-primary"><i class="fab fa-facebook"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-auto my-1 px-1">
                                    <!-- LinkedIn (url, title, summary, source url) -->
                                    <a href="https://www.linkedin.com/shareArticle?url={{url()->full()}}&title={{$product->name}}&summary={{$product->description}}&source={{url()->full()}}">
                                        <button type="button" class="btn btn-primary"><i class="fab fa-linkedin"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-auto my-1 px-1">
                                    <!-- whatsapp (url, title, summary, source url) -->
                                    <a href="https://web.whatsapp.com/send?text={{$product->name}}%0A{{url()->full()}}">
                                        <button type="button" class="btn btn-success bg-whatsapp"><i
                                                class="fab fa-whatsapp"></i>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-auto my-1 px-1">
                                    <a href="mailto:{{$setting->getByKey('email')}}?subject={{$product->name}}&body={{$product->name}}%0A{{url()->full()}}"
                                       target="_blank">
                                        <button type="button" class="btn btn-danger">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <b>
                                {{lang("Request this product")}}
                            </b>
                            <hr class="bg-danger">
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-center">
                                <div class="col-12 d-flex justify-content-center">
                                    <a
                                        class="w-100"
                                        href="https://wa.me/{{$setting->getByKey('Phone')}}/?text={{$product->name}}%0A{{url()->full()}}%0A{{lang('Hello. I need this product.')}}"
                                    >
                                        <button type="button" class="w-100 btn btn-danger"><i
                                                class="fab fa-whatsapp mx-1"></i>
                                            {{lang("Request Product")}}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($product->description)
            <div id="more-details" class="col-12 mt-5 mb-5">
                <div class="card bg-light p-3 product-card">
                    <div class="row">
                        <div class="col-12">
                            <h5>
                                <div class="badge bg-danger">  {{lang("product description")}}</div>
                            </h5>
                        </div>
                        <div class="col-12">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
