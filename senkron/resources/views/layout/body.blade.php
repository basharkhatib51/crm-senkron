@hasSection('slider')
    @yield('slider')
@endif
@sectionMissing('slider')
    <div class="min-slider">
    </div>
@endif

<div class="content-margin">
    @yield('content')
</div>
