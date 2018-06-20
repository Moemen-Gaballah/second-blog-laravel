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

Route::get('/', 'PostController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('category', 'CategoryController');
Route::resource('post', 'PostController');
Route::get('/post', 'PostController@showposts');
Route::resource('comment', 'CommentController');
//Route::get('post/{title}', 'PostControler@findByTitle');

Route::get('/search', 'SearchController@search')->name('search');


// Facebook Login
//Route::get('facebookLogin', function (){
//    return Socialite::driver('facebook')->redirect();
//});

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::group(['middleware'=>'auth'],function (){


    // Activate Your Account
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

});
