<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Product;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Tag;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\LanguagePolicy;
use App\Policies\MenuPolicy;
use App\Policies\PagePolicy;
use App\Policies\ProductPolicy;
use App\Policies\RolePolicy;
use App\Policies\SectionPolicy;
use App\Policies\SettingPolicy;
use App\Policies\SliderPolicy;
use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Setting::class => SettingPolicy::class,
        Product::class => ProductPolicy::class,
        Category::class => CategoryPolicy::class,
        Slider::class => SliderPolicy::class,
        Section::class => SectionPolicy::class,
        Menu::class => MenuPolicy::class,
        Tag::class => TagPolicy::class,
        Page::class => PagePolicy::class,
        Language::class => LanguagePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user, $ability) {
            return $user->hasRole('SuperAdmin') ? true : null;
        });
    }
}
