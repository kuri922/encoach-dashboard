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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->middleware('auth:admins');
Route::get('login', 'Dashboard\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Dashboard\Auth\LoginController@login')->name('login');



// 管理者
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
    Route::resource('/dashboard/products', 'Dashboard\ProductController');
});

// スーパー管理者
Route::group(['middleware' => ['auth', 'can:system-only']], function () {
      
    Route::resource('/dashboard/categories','Dashboard\CategoryController');

    Route::resource('/dashboard/major_categories','Dashboard\MajorCategoryController')
    ;

    Route::resource('/dashboard/users','Dashboard\UserController');

    Route::resource('/dashboard/admins', 'Dashboard\AdminslistController');

});

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}