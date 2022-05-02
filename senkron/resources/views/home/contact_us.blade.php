@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row mt-5 mb-5">
            @if($setting->getByKey('map'))
                <div class="col-12">
                    <div class="card bg-white p-4 mb-5">
                        <div class="text-start mb-3">
                            <h3><b>{{lang('GENEL MERKEZ')}}</b></h3>
                        </div>

                        <iframe
                            style="border: white 0 !important; height: 350px"
                            src="{{$setting->getByKey('map')}}">
                        </iframe>
                    </div>
                </div>
            @endif
            @if($setting->getByKey('sube'))
                <div class="col-12">
                    <div class="card bg-white p-4 mb-5">
                        <div class="text-start mb-3">
                            <h3><b>{{lang('ŞUBE')}}</b></h3>
                        </div>
                        @if($setting->getByKey('sube'))
                            <iframe
                                style="border: white 0 !important; height: 350px"
                                src="{{$setting->getByKey('map')}}">
                            </iframe>
                        @endif
                    </div>
                </div>
            @endif
            <div class="col-12">
                <div class="card bg-white p-4">
                    <div class="card-title">
                        <h4>{{lang('Contact Us')}}</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <form method="post" action="/contact">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label for="exampleInputEmail1"
                                               class="form-label">{{lang('Email address')}}</label>
                                        <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                                               aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="exampleInputEmail1"
                                               class="form-label">{{lang('First Name')}}</label>
                                        <input name="first_name" type="text" class="form-control"
                                               id="exampleInputEmail1"
                                               aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="exampleInputEmail1" class="form-label">{{lang('Last Name')}}</label>
                                        <input name="last_name" type="text" class="form-control"
                                               id="exampleInputEmail1"
                                               aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="exampleInputEmail1"
                                               class="form-label">{{lang('Phone Number')}}</label>
                                        <input name="phone" type="tel" class="form-control" id="exampleInputEmail1"
                                               aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-12 mt-3">
                                <textarea name="message" class="form-control" placeholder="Your Message..."
                                          id="floatingTextarea2"
                                          style="height: 100px"></textarea>
                                    </div>
                                    <div class="col-12 mt-3 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-danger w-100">{{lang('Submit')}}</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-12 col-lg-6 mt-4 mt-lg-0 align-self-center">
                            <img src="../../images/contact.svg">
                        </div>
                        <div class="col-12">
                            <div class="row mt-5">
                                <div class="col-6 col-lg-3 mt-5">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <i class="far fa-envelope text-danger fs-1"></i>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            {{ $setting->getByKey('email') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 mt-5">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <i class="fas fa-phone text-danger fs-1"></i>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-1">
                                            {{ $setting->getByKey('Phone') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 mt-5">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <i class="fas fa-fax text-danger fs-1"></i>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-1">
                                            {{ $setting->getByKey('Fax') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-3 mt-5 text-center">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <i class="fas fa-map-marker-alt text-danger fs-1"></i>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-1">
                                            {!! $setting->getByKey('Address') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
