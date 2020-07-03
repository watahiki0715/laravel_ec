<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', 'IndexController@index');

Route::post('/index', 'IndexController@cart');

Route::get('/cart', 'CartController@index');

Route::post('/cart', 'CartController@post');

Route::get('/finish', 'FinishController@index');

Route::get('/history', 'HistoryController@index');

Route::get('/history_detail', 'History_detailController@index');

Route::get('/item_detail', 'Item_detailController@index');

Route::post('/item_detail', 'Item_detailController@post');

Route::get('/review_edit', 'Review_editController@index');

Route::post('/review_edit', 'Review_editController@post');

Route::get('/test/jq', function () {
    return view('test.jq');
});

Route::get('/test/bs', function () {
    return view('test.bs');
});

Route::get('/test/bs-2', function () {
    return view('test.bs-2');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function(){

    //home
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
    //login logout   
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    //register
    Route::get('register', 'Admin\Auth\RegisterController@showRegisterForm')->name('admin.register');
    Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin.register');
    
});

    // admin認証が必要なページ
Route::middleware('auth:admin')->group(function () {
    Route::get('admin/index', 'Admin\IndexController@index');
    Route::post('admin/index', 'Admin\IndexController@post');
    
});
