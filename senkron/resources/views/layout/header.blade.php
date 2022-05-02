<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{in_array(app()->getLocale(),['ar','arc','dv','fa','ha','he','khw','ks','ku','ps','ur','yi'])?'rtl':'ltr'}}">
<head>
    <meta name="theme-color" content="#E2010E"/>
    <meta property="og:image" content="{{env('APP_URL')}}/images/logox200.png">
    <meta name="twitter:image" content="{{env('APP_URL')}}/images/logox200.png"/>
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="66">
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{env('APP_URL')}}"/>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(isset($meta_description))
        <meta property="og:description" content="{{$meta_description}}"/>
        <meta name="description" content="{{$meta_description}}">
    @else
        <meta property="og:description" content="{{$setting->getByKey('site description')}}"/>
        <meta name="description" content="{{$setting->getByKey('site description')}}">
    @endif
    @if(isset($meta_keywords))
        <meta name="keywords" content="{{$meta_keywords}}">
    @endif
    @if(isset($meta_title))
        <title>{{$meta_title}}</title>
        <meta property="og:title" content="{{$meta_title}}"/>
    @else
        <meta property="og:title" content="{{$setting->getByKey('site name')}}"/>
        <title>{{$setting->getByKey('site name')}}</title>
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ url(mix('/css/app.css')) }}?v=10.1" rel="stylesheet">
    <link id="favicon" rel="shortcut icon" type="image/png" href="/images/slogo.png" src="/images/slogo.png">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript" src="/js/app.js?v=10.1"></script>
    <!-- Fonts Awesome -->
</head>
<body>
@include('components.navbar')

