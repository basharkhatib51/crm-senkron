<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Menu;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        app()->languages = Language::all();
        Paginator::useBootstrap();
        $setting = new Setting();
        $menu = Menu::whereNull('menu_id')->get();
        $slider = Slider::where('name', 'home')->first();
        $sections = new Section();
        View::share('setting', $setting);
        View::share('menu', $menu);
        View::share('sliders', $slider?->slider_elements);
        View::share('sections', $sections);


    }
}
