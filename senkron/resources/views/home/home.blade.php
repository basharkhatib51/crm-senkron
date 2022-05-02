@extends('layout.app')
@section('slider')
    @include('components.slider')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-6  col-md-4 col-xl-3 logo-transform-container">
                <img class="logo-transform" src="/images/logo-empty.png">
            </div>
        </div>
        <div class="col col-12 my-5">
            @include('sections.section1')
        </div>
        <div class="col col-12 p-0">
            <img class="w-100" src="/images/breacklines.png" alt="breacklines">
        </div>
        <div data-aos="zoom-in-down" class="col col-12 my-5 section3-parent">
            @include('sections.section3')
        </div>
        <div data-aos="zoom-in-down" class="col col-12 my-5">
            @include('sections.section4')
        </div>
        <div class="col col-12 mt-5 p-0">
            <img class="w-100" style="transform: rotate(180deg);" src="/images/breacklines.png" alt="breacklines">
        </div>
        <div data-aos="zoom-in-down" class="col col-12 my-5">
            @include('sections.section2')
        </div>
    </div>
@endsection
