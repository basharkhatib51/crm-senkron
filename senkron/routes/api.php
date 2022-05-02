<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('authorize')->namespace('Authenticate')->group(function () {
//    Route::get('{provider}/redirect', 'SocialAuthController@redirectToProvider')->name('api.social.redirect');
//    Route::get('{provider}/callback', 'SocialAuthController@handleProviderCallback')->name('api.social.callback');
    Route::post('/login', "AuthenticateController@login");
//    Route::post('/register', "AuthenticateController@register");
//    Route::post('/signup', "AuthenticateController@signUp");
    Route::post('/forget_password', "AuthenticateController@forget_password");
    Route::post('/reset_password', "AuthenticateController@reset_password");
    Route::post('/check_code', "AuthenticateController@check_code");

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', "AuthenticateController@logout");
        Route::post('/get_auth', "AuthenticateController@get_auth");
        Route::post('/change_language', "AuthenticateController@change_language");
        Route::post('/change_password', "AuthenticateController@change_password");
        Route::post('/add_serial_number', "AuthenticateController@add_serial_number");
        Route::get('/get_my_products', "AuthenticateController@get_my_products");
        Route::get('/get_my_tickets/{sell}', "AuthenticateController@get_my_tickets");
        Route::get('/get_my_ticket/{ticket}', "AuthenticateController@get_my_ticket");
        Route::post('/create_message', "AuthenticateController@create_message");
        Route::post('/create_ticket', "AuthenticateController@create_ticket");
        Route::delete('/delete_message/{message}', "AuthenticateController@delete_message");
        Route::delete('/delete_ticket/{ticket}', "AuthenticateController@delete_ticket");
        Route::post('/update_profile', "AuthenticateController@update_profile");
    });
});
Route::middleware('auth:sanctum')->group(function () {
    Route::namespace('User')->group(function () {
        Route::get('user/trashed', "UserController@get_trashed");
        Route::put('user/restore/{trashed_user}', "UserController@restore")->withTrashed();
        Route::post('user/change_status/{user}', "UserController@change_status");
        Route::post('user/change_password/{user}', "UserController@change_password");
        Route::post('user/change_role/{user}', "UserController@change_role");
        Route::resource('user', "UserController");
    });

    Route::namespace('Role')->group(function () {
        Route::get('permissions', "RoleController@permissions");
        Route::resource('role', "RoleController");
    });

    Route::prefix('upload')->namespace('Upload')->group(function () {
        Route::post('image', "UploadController@upload_image");
        Route::post('images', "UploadController@upload_images");
        Route::get('image/{upload}', "UploadController@image");
        Route::get('images', "UploadController@images");
        Route::post('description/{upload}', "UploadController@description");
    });

    Route::namespace('Page')->group(function () {
        Route::get('pages/trashed', "PageController@get_trashed");
        Route::put('pages/restore/{trashed_page}', "PageController@restore");
        Route::resource('pages', "PageController");
    });

    Route::namespace('Tag')->group(function () {
        Route::get('tags/trashed', "TagController@get_trashed");
        Route::put('tags/restore/{trashed_tag}', "TagController@restore");
        Route::resource('tags', "TagController");
    });

    Route::namespace('Product')->group(function () {
        Route::get('product/trashed', "ProductController@get_trashed");
        Route::put('product/restore/{trashed_product}', "ProductController@restore");
        Route::resource('product', "ProductController");
    });

    Route::namespace('Category')->group(function () {
        Route::get('category/trashed', "CategoryController@get_trashed");
        Route::put('category/restore/{trashed_cat}', "CategoryController@restore");
        Route::resource('category', "CategoryController");
    });
    Route::namespace('ServiceCategory')->group(function () {
        Route::get('service_category/trashed', "ServiceCategoryController@get_trashed");
        Route::put('service_category/restore/{trashed_cat}', "ServiceCategoryController@restore");
        Route::resource('service_category', "ServiceCategoryController");
    });

    Route::namespace('Menu')->group(function () {
        Route::get('menu/trashed', "MenuController@get_trashed");
        Route::put('menu/restore/{trashed_cat}', "MenuController@restore");
        Route::resource('menu', "MenuController");
    });

    Route::namespace('Section')->group(function () {
        Route::resource('section', "SectionController")->only(['index', 'update']);
    });
    Route::namespace('Translation')->group(function () {
        Route::resource('translation', "TranslationController")->only(['index', 'update']);
    });

    Route::namespace('Language')->group(function () {
        Route::get('language/model/{model}', "LanguageController@get_model_data");
        Route::get('language/trashed', "LanguageController@get_trashed");
        Route::put('language/restore/{trashed_lang}', "LanguageController@restore");
        Route::resource('language', "LanguageController");
    });

    Route::namespace('Slider')->group(function () {
        Route::get('slider/trashed', "SliderController@get_trashed");
        Route::put('slider/restore/{trashed_slider}', "SliderController@restore");
        Route::resource('slider', "SliderController");
    });

    Route::namespace('Setting')->group(function () {
        Route::get('settings/groups', "SettingController@groups");
        Route::put('settings/update', "SettingController@save_setting");
    });

    Route::namespace('Dashboard')->group(function () {
        Route::get('analytics', "DashboardController@index");
    });
});
