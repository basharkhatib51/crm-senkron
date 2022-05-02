@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row mb-5">
            @if($selected_category)
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" style="order:1"><a href="{{ request()->fullUrlWithQuery(['category' => null])}}">Products</a></li>
                            @php
                                $parent = $selected_category?->parent_category;
                                $order=1;
                            @endphp
                            @while($parent)
                                <li class="breadcrumb-item" style="order:calc(99 - {{$order}})">
                                    <a href="{{ request()->fullUrlWithQuery(['category' => $parent?->id])}}">
                                        {{$parent->name}}</a></li>
                                @php
                                    $parent = $parent?->parent_category;
                                    $order++;
                                @endphp
                            @endwhile
                            <li class="breadcrumb-item active" style="order:99" aria-current="page">{{$selected_category->name}}</li>
                        </ol>
                    </nav>
                </div>
            @endif
            <div class="col-12 col-lg-3">
                <ul class="list-group">
                    @foreach($categories as $category)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a class="w-100" href="{{ request()->fullUrlWithQuery(['category' => $category->id])}}">
                                {{$category->name}}
                                <span class="float-right ms-5 badge bg-primary rounded-pill">{{$category->children_categories->count()}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-lg-9">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 mt-3 mt-lg-0">
                        <form method="get" action="/products">
                            <div class="row justify-content-center">
                                <div class="col-8">
                                    <input value="{{request()->search}}" placeholder="{{lang('Search')}}" name="search" type="search" class="form-control" id="Search"
                                           aria-describedby="SearchHelp">
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-danger">
                                        {{lang('Search')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="row d-flex justify-content-start products-list">
                    @foreach($products as $product)
                        <div class="col-12 col-md-6 col-lg-6 col-xl-4 d-flex justify-content-center my-5">
                            <a href="/product/{{$product->id}}" class="mx-1 w-100">
                                <div class="card product-card" style="width: 100%;">
                                    <img src="/{{$product->image?->url}}" class="card-img-top" alt="{{$product->image?->name}}">
                                    <div class="card-body">
                                        <p class="card-text">
                                            {{ $product->name }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-6 my-5">

                        @if($products->count()<=0)
                            <div class="alert alert-danger text-center" role="alert">
                                {{lang('There are no products found!')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12 product-pagination d-flex justify-content-end text-end">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
