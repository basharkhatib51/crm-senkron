{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>--}}
<div class="container-fluid footer">
    <div class="row">
        <div class="col col-12 p-0">
            <img class="w-100" src="/images/footerbreacklines.png" alt="breacklines">
        </div>
        <div class="col col-12 lights">
            <div class='light x1'></div>
            <div class='light x2'></div>
            <div class='light x3'></div>
            <div class='light x4'></div>
            <div class='light x5'></div>
            <div class='light x6'></div>
            <div class='light x7'></div>
            <div class='light x8'></div>
            <div class='light x9'></div>
        </div>
        <div class="col col-12 my-5" data-aos="zoom-in-down">
            <div class="container-fluid">
                <div class="row text-center text-light d-flex justify-content-around align-items-center">
                    <div class="col col-12 col-lg-3 mb-lg-0 mb-5">
                        <div class="row justify-content-center py-4 text-light">
                            <div class="col col-12 py-1"><h1>{{lang('CONTACT')}}</h1></div>
                            @if($setting->getByKey('Phone'))
                                <div class="col col-12 py-1"><a href="tel://{{$setting->getByKey('Phone')}}"> <i class="fas fa-phone"></i> {{$setting->getByKey('Phone')}} </a></div>
                            @endif
                            @if($setting->getByKey('Fax'))
                                <div class="col col-12 py-1"><a href="tel://{{$setting->getByKey('Fax')}}"> <i class="fas fa-fax"></i> {{$setting->getByKey('Fax')}} </a></div>
                            @endif
                            @if($setting->getByKey('email'))
                                <div class="col col-12 py-1"><a href="mailto:{{$setting->getByKey('email')}}"> <i class="fas fa-envelope"></i> {{$setting->getByKey('email')}} </a></div>
                            @endif
                            <div class="col col-12 py-1">
                                <div class="row justify-content-center">
                                    @if($setting->getByKey('Whatsapp'))
                                        <div class="col col-auto"><a href="whatsapp://send?phone={{$setting->getByKey('Whatsapp')}}"><i class="fab fa-whatsapp"></i></a></div>@endif
                                    @if($setting->getByKey('Facebook'))
                                        <div class="col col-auto"><a href="{{$setting->getByKey('Facebook')}}"><i class="fab fa-facebook-f"></i></a></div>@endif
                                    @if($setting->getByKey('Instagram'))
                                        <div class="col col-auto"><a href="{{$setting->getByKey('Instagram')}}"><i class="fab fa-instagram"></i></a></div>@endif
                                    @if($setting->getByKey('Twitter'))
                                        <div class="col col-auto"><a href="{{$setting->getByKey('Twitter')}}"><i class="fab fa-twitter"></i></a></div>@endif
                                    @if($setting->getByKey('Linkedin'))
                                        <div class="col col-auto"><a href="{{$setting->getByKey('Linkedin')}}"><i class="fab fa-linkedin"></i></a></div>@endif
                                    @if($setting->getByKey('Youtube'))
                                        <div class="col col-auto"><a href="{{$setting->getByKey('Youtube')}}"><i class="fab fa-youtube"></i></a></div>@endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-3 mb-lg-0 mb-5">
                        @if($setting->getByKey('Country'))
                            {!!   $setting->getByKey('Address') !!}
                        @endif
                    </div>
                    <div class="col col-12 col-lg-4 mb-lg-0 mb-5">
                        @if($setting->getByKey('map'))
                            <iframe
                                src="{{$setting->getByKey('map')}}"
                                width="600" height="450" style="border-radius:20px;" allowfullscreen="" loading="lazy"></iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-12 footer-nav vertical-align-end text-center py-3 text-light">
            © {{date("Y")}} {{$setting->getByKey('site name')}}. {{lang('All rights reserved')}}.
            <br>
            {{lang('Developed By')}} <a href="https://layouteam.com">LAYOUTEAM</a>
        </div>
    </div>
</div>

</body>
</html>
