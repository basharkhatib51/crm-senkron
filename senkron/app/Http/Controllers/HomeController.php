<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use File;
use Image;

class HomeController extends Controller
{

//    public function resize_all_images()
//    {
//        $images = Upload::all();
//        foreach ($images as $image) {
//            $url = explode(".", $image->url);
//            $new_url = $url[0] . '100x100.' . $url[1];
//            if (File::exists($image->url) && !File::exists($new_url)) {
//                $img = Image::make($image->url);
//                $img->resize(100, 100);
//                $img->save($new_url);
//            }
//        }
//        return 'success';
//    }

    public function home()
    {
        $setting = new Setting();
        $models = User::all();
        return view('home.home', [
            'users' => $models,
            'meta_description' => $setting->getByKey('site description'),
            'meta_keywords' => $setting->getByKey('keywords'),
        ]);
    }

    public function contact_us()
    {
        $setting = new Setting();
        return view('home.contact_us', [
            'meta_description' => $setting->getByKey('Phone') . ' ' . $setting->getByKey('email'),
            'meta_keywords' => $setting->getByKey('Phone') . ',' . $setting->getByKey('email'),
        ]);
    }

    public function products()
    {

        $setting = new Setting();
        $products = Product::searchable()->fillter()->paginate(6);
        $products->appends(['search' => request()->search]);
        $products->appends(['category' => request()->category]);
        $categories = Category::where('category_id', request()->category)->get();
        $selected_category = null;
        if (request()->category)
            $selected_category = Category::findOrFail(request()->category);
        return view('home.products', ['products' => $products, 'categories' => $categories, 'selected_category' => $selected_category,
            'meta_description' => $setting->getByKey('site description'),
            'meta_keywords' => $setting->getByKey('keywords'),
        ]);
    }

    public function product(Product $product)
    {

        return view('home.product', ['product' => $product,
            'meta_title' => $product->name,
            'meta_description' => $product->name,
            'meta_keywords' => implode(',', $product->tags->pluck('name')->toArray()) ?? str_replace(' ', ',', $product->name)
        ]);
    }

    public function page($page)
    {
        $page = Page::where('title', $page)->first();
        if (!$page)
            return abort(404);
        if ($page->slider_id != null) {
            $slider = Slider::where('id', $page->slider_id)->first();
            $slider_elements = $slider?->slider_elements;
        } else {
            $slider_elements = null;
        }
        return view('home.page', ['page' => $page, 'slider_elements' => $slider_elements,
            'meta_title' => $page->title,
            'meta_description' => $page->excerpt,
            'meta_keywords' => implode(',', $page->tags->pluck('name')->toArray()) ?? str_replace(' ', ',', $page->excerpt) ?? str_replace(' ', ',', $page->title),
        ]);
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone' => ['nullable'],
            'message' => ['nullable'],
        ]);
        Mail::send('emails.contactForm', ['email' => $validated['email'], 'first_name' => $validated['first_name'], 'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'inquiry' => $validated['message']
        ], function ($m) use ($validated) {
            $m->from('test@layouteam.com', 'Senkron');
            $m->to(Setting::where('key', 'email')->first()->value, 'Contact')->subject('Contact');
        });
        return back();
    }

    public function language(Language $language)
    {
        App::setLocale($language->code);
        Session::put('locale', $language->code);
        return back();
    }


}
