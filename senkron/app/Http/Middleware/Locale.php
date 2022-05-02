<?php namespace App\Http\Middleware;

use App\Models\Translation;
use Closure;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class Locale
{

    public function handle($request, Closure $next)
    {
        if (Session::get('locale'))
            App::setLocale(Session::get('locale'));
        $translations = Translation::all()->pluck('content_translations.' . app()->getLocale(), 'content');
        View::share('trans', $translations);
        return $next($request);
    }


}

