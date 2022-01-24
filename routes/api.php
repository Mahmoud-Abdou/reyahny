<?php

use Illuminate\Http\Request;

Route::group([
    'middleware' => ['FakeApiAuth'],
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('forget-password', 'AuthController@forgetPassword');
    Route::post('reset-code', 'AuthController@resetCode');
    Route::post('reset-password', 'AuthController@resetPassword');
    Route::post('social-login', 'AuthController@social_login');
    
    
});

Route::group([
    'middleware' => ['auth','activate'],
], function ($router) {
    
    
    Route::post('logout', 'AuthController@logout')->name('api_logout');
});
Route::get('get-sliders', 'API\SliderController@get_sliders');
Route::get('get-videos', 'API\VideoController@get_videos');
Route::get('get-services', 'API\ServiceController@get_services');
Route::get('get-products', 'API\ProductController@get_products');

Route::get('get-orders', 'API\OrderController@get_orders');

Route::get('get-connection-types', 'API\CartController@get_connection_types');
Route::get('get-details', 'API\OrderController@get_details');

Route::post('add-details', 'API\OrderController@add_details');
Route::post('add-billimages', 'API\CartController@add_billimages');

Route::post('add-cart', 'API\CartController@add_cart');
Route::post('add-order', 'API\OrderController@add_order');
