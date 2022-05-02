<div class="container fluid">
    <div class="row text-center section-5 my-5">
        <div class="col col-12 col-md-6 align-self-center">
            @if($setting->getByKey('Country'))
                <b><h1>{{$setting->getByKey('Country')}}/{{$setting->getByKey('City')}}</h1></b>
                {!!   $setting->getByKey('Address') !!}
            @endif
            <br>
            <button class="btn btn-danger my-5">open location</button>
        </div>
        <div class="col col-12 col-md-6">
            @if($setting->getByKey('map'))
                <iframe
                    src="{{$setting->getByKey('map')}}"
                    width="600" height="450" style="border-radius:20px;" allowfullscreen="" loading="lazy"></iframe>
            @endif
        </div>
    </div>
</div>
