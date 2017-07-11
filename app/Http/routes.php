<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

use App\Entity\Member;

//Route::get('/', function () {
//    return view('index');
//    //return Member::all();
//});
Route::get('/', 'View\IndexController@getAllBook');



Route::get('/login', 'View\MemberController@toLogin');
Route::get('/register', 'View\MemberController@toRegister');

Route::get('/category', 'View\BookController@toCategory');
Route::get('/book/category_id/{category_id}', 'View\BookController@toBook');
Route::get('/book/{book_id}', 'View\BookController@toBookContent');

Route::get('/cart', 'View\CartController@toCart');

Route::get('/pay', function() {
    return view('alipay');
});

Route::group(['middleware' => 'check.login'], function() {
    Route::post('/order_commit', 'View\OrderController@toOrderCommit');
    Route::get('/order_list', 'View\OrderController@toOrderList');
});

Route::group(['prefix' => 'service'], function () {
    Route::get('validate_code/create', 'Service\ValidateController@create');
    Route::post('validate_phone/send', 'Service\ValidateController@sendSMS');
//    Route::post('validate_email','Service\ValidateController@validateEmail');
    Route::post('register', 'Service\MemberController@register');
    Route::post('login', 'Service\MemberController@login');

    //支付宝相关路由
    Route::post('alipay', 'Service\PayController@aliPay');
    Route::post('pay/notify', 'Service\PayController@aliNotify');
    Route::get('pay/call_back', 'Service\PayController@aliResult');
    Route::get('pay/merchant', 'Service\PayController@aliMerchant');

    //微信支付相关内容
    Route::post('wxpay', 'Service\PayController@wxPay');
    Route::get('openid/get', 'Service\PayController@getOpenId');

    Route::get('category/parent_id/{parent_id}', 'Service\BookController@getCategoryByParentId');
    Route::get('cart/add/{book_id}', 'Service\CartController@addCart');
    Route::get('cart/delete', 'Service\CartController@deleteCart');
});



/* * *********************************后台相关********************************** */
Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'service'], function () {
        
        Route::post('upload/{type}', 'Service\UploadController@uploadFile');
        Route::post('login', 'Admin\IndexController@login');

        Route::post('category/add', 'Admin\CategoryController@CategoryAdd');
        Route::post('category/del', 'Admin\CategoryController@CategoryDel');
        Route::post('category/edit', 'Admin\CategoryController@CategoryEdit');

        Route::post('book/add', 'Admin\BookController@bookAdd');
        Route::post('book/del', 'Admin\BookController@bookDel');
        Route::post('book/edit', 'Admin\BookController@bookEdit');

        Route::post('member/edit', 'Admin\MemberController@memberEdit');

        Route::post('order/edit', 'Admin\OrderController@orderEdit');
    });

    Route::get('index', 'Admin\IndexController@toIndex');
    Route::get('login', 'Admin\IndexController@toLogin');
    Route::get('welcome', 'Admin\IndexController@welcome');

    Route::get('category', 'Admin\CategoryController@toCategory');
    Route::get('category_add', 'Admin\CategoryController@toCategoryAdd');
    Route::get('category_edit', 'Admin\CategoryController@toCategoryEdit');

    Route::get('book', 'Admin\BookController@toBook');
    Route::get('book_info', 'Admin\BookController@toBookInfo');
    Route::get('book_add', 'Admin\BookController@toBookAdd');
    Route::get('book_edit', 'Admin\BookController@toBookEdit');

    Route::get('member', 'Admin\MemberController@toMember');
    Route::get('member_edit', 'Admin\MemberController@toMemberEdit');

    Route::get('order', 'Admin\OrderController@toOrder');
    Route::get('order_edit', 'Admin\OrderController@toOrderEdit');
});
