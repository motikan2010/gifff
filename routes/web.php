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

Route::get('/', 'IndexController@index')->name('login');

// マイページ
Route::get('account', 'AccountController@indexPage');
Route::get('account/token', 'AccountController@tokenPage');
Route::post('account/token', 'AccountController@createToken');

// ログイン
Route::get('login', 'Auth\LoginController@index');
Route::get('login/github', 'Auth\GitHubLoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\GitHubLoginController@handleProviderCallback');

// 画像
Route::group(['prefix' => 'image'], function () {
    Route::get('upload', 'ImageController@uploadPage');
    Route::post('upload', 'ImageController@upload');
    Route::get('list', 'ImageController@listPage');
    Route::get('create', 'ImageController@createGifPage');
});


/**
 * API
 */

// ファイル
Route::group(['prefix' => 'api'], function () {
    Route::post('image/upload', 'Api\ImageController@upload');
});
