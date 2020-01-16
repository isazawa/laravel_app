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
  ここで、アプリケーションのWebルートを登録できます。これら
  ルートは、グループ内のRouteServiceProviderによってロードされます
 「web」ミドルウェアグループが含まれます。
*/
//routes/web.phpファイルからルート定義を始める。
Route::get('/', function () {
    return view('welcome');
});
Route::resource('todo','TodoController');//複数のルートがこの１定義で生成される。

Auth::routes();//vendor/laravel/framework/src/Illuminate/Routing/Router.phpに記述されているauthメソッドを呼び出して、route:listに追加。

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('URI','middleware') ブラウザからhomeでアクセスされるとHomeController@indexが実行される。nameはhomeですよ。
