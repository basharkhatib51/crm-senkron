<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slider;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $this->authorize('dashboard', User::Class);
        $users = DB::table('users')->whereyear('created_at', date('Y'))->select(
            DB::raw('count(id) as `count`'),
            DB::raw('MONTH(created_at) as month')
        )
            ->groupby('month')
            ->get()->pluck('count')->toArray();
        $tags = DB::table('tags')->whereyear('created_at', date('Y'))->select(
            DB::raw('count(id) as `count`'),
            DB::raw(' MONTH(created_at) as month')
        )
            ->groupby('month')
            ->get()->pluck('count')->toArray();
        $products = DB::table('products')->whereyear('created_at', date('Y'))->select(
            DB::raw('count(id) as `count`'),
            DB::raw(' MONTH(created_at) as month')
        )
            ->groupby('month')
            ->get()->pluck('count')->toArray();
        $categories = DB::table('categories')->whereyear('created_at', date('Y'))->select(
            DB::raw('count(id) as `count`'),
            DB::raw(' MONTH(created_at) as month')
        )
            ->groupby('month')
            ->get()->pluck('count')->toArray();
        $languages = DB::table('languages')->whereyear('created_at', date('Y'))->select(
            DB::raw('count(id) as `count`'),
            DB::raw(' MONTH(created_at) as month')
        )
            ->groupby('month')
            ->get()->pluck('count')->toArray();
        $sliders = DB::table('sliders')->whereyear('created_at', date('Y'))->select(
            DB::raw('count(id) as `count`'),
            DB::raw(' MONTH(created_at) as month')
        )
            ->groupby('month')
            ->get()->pluck('count')->toArray();
        $sections = DB::table('sections')->whereyear('created_at', date('Y'))->select(
            DB::raw('count(id) as `count`'),
            DB::raw(' MONTH(created_at) as month')
        )
            ->groupby('month')
            ->get()->pluck('count')->toArray();
        $menus = DB::table('menus')->whereyear('created_at', date('Y'))->select(
            DB::raw('count(id) as `count`'),
            DB::raw(' MONTH(created_at) as month')
        )
            ->groupby('month')
            ->get()->pluck('count')->toArray();
        $pages = DB::table('pages')->whereyear('created_at', date('Y'))->select(
            DB::raw('count(id) as `count`'),
            DB::raw(' MONTH(created_at) as month')
        )
            ->groupby('month')
            ->get()->pluck('count')->toArray();


        $users = array(
            "data" => $users,
            "name" => 'Users'
        );
        $categories = array(
            "data" => $categories,
            "name" => "Categories"
        );
        $tags = array(
            "data" => $tags,
            "name" => "Tags"
        );
        $products = array(
            "data" => $products,
            "name" => "Products"
        );
        $languages = array(
            "data" => $languages,
            "name" => "Languages"
        );
        $sliders = array(
            "data" => $sliders,
            "name" => "Sliders"
        );
        $sections = array(
            "data" => $sections,
            "name" => "Sections"
        );
        $menus = array(
            "data" => $menus,
            "name" => "Menu"
        );
        $pages = array(
            "data" => $pages,
            "name" => "Pages"
        );
        array_unshift($users['data'], 0);
        array_unshift($categories['data'], 0);
        array_unshift($tags['data'], 0);
        array_unshift($products['data'], 0);
        array_unshift($languages['data'], 0);
        array_unshift($sliders['data'], 0);
        array_unshift($sections['data'], 0);
        array_unshift($menus['data'], 0);
        array_unshift($pages['data'], 0);
        $counts = array(
            "users_count" => User::all()->count(),
            "tags_count" => Tag::all()->count(),
            "categories_count" => Category::all()->count(),
            "products_count" => Product::all()->count(),
            "languages_count" => Language::all()->count(),
            "sliders_count" => Slider::all()->count(),
            "sections_count" => Section::all()->count(),
            "menus_count" => Menu::all()->count(),
            "pages_count" => Page::all()->count(),
        );
        return $this->Data(['data' =>
            [
                'users' => $users,
                'categories' => $categories,
                'tags' => $tags,
                'products' => $products,
                'languages' => $languages,
                'sliders' => $sliders,
                'sections' => $sections,
                'menus' => $menus,
                'pages' => $pages,
                'counts' => $counts,
            ]
        ]);
    }
}
