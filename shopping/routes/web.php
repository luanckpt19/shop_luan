<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

//Route::get('/admin','App\Http\Controllers\AdminController@loginAdmin')->name('login');
//Route::post('/admin','App\Http\Controllers\AdminController@postLoginAdmin');


//Route::post('/admin', [
//    'as' =>'login',
//    'uses' => 'App\Http\Controllers\AdminController@postLoginAdmin'
//
//]);


Route::get('/home', function () {
    return view('home');
});

Route::prefix('admin')->group(function () {

    Route::get('/', [
        'as' => 'admin.login',
        'uses' => 'App\Http\Controllers\AdminController@loginAdmin'
    ]);
    Route::post('/', [
        'as' => 'admin.post-login',
        'uses' => 'App\Http\Controllers\AdminController@postLoginAdmin'
    ]);

    Route::get('/logout', [
        'as' => 'admin.logout',
        'uses' => 'App\Http\Controllers\AdminController@logout'
    ]);



    Route::prefix('categories')->group(function () {
        Route::get('/create', [
            'as' =>'admin.categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create',
            'middleware'=> 'can:category-add'

        ]);
        Route::get('/', [
            'as' =>'admin.categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index',
            'middleware'=> 'can:category-list'

        ]);
        Route::post('/store', [
            'as' =>'admin.categories.store',
            'uses' => 'App\Http\Controllers\CategoryController@store'

        ]);
        Route::get('/edit/{id}', [
            'as' =>'admin.categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit',
            'middleware'=> 'can:category-edit'

        ]);
        Route::post('/update/{id}', [
            'as' =>'admin.categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update'

        ]);
        Route::get('/delete/{id}', [
            'as' =>'admin.categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete',
            'middleware'=> 'can:category-delete'

        ]);
    });

    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' =>'admin.menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index',
             'middleware'=> 'can:menu-list'

        ]);
        Route::get('/create', [
            'as' =>'admin.menus.create',
            'uses' => 'App\Http\Controllers\MenuController@create',
            'middleware'=> 'can:menu-add'

        ]);
        Route::post('/store', [
            'as' =>'admin.menus.store',
            'uses' => 'App\Http\Controllers\MenuController@store'


        ]);
        Route::get('/edit/{id}', [
            'as' =>'admin.menus.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit',
            'middleware'=> 'can:menu-edit'

        ]);
        Route::post('/update/{id}', [
            'as' =>'admin.menus.update',
            'uses' => 'App\Http\Controllers\MenuController@update',


        ]);
        Route::get('/delete/{id}', [
            'as' =>'admin.menus.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete',
            'middleware'=> 'can:menu-delete'

        ]);
    });



    //Product

    Route::prefix('product')->group(function () {
        Route::get('/', [
            'as' =>'admin.product.index',
            'uses' => 'App\Http\Controllers\AdminProductController@index',
            'middleware'=> 'can:product-list'

        ]);
        Route::get('/search', [
            'as' => 'product.search',
            'uses' => 'App\Http\Controllers\AdminProductController@search'
        ]);

        Route::get('/create', [
            'as' =>'admin.product.create',
            'uses' => 'App\Http\Controllers\AdminProductController@create',
            'middleware'=> 'can:product-add'


        ]);
        Route::get('/edit/{id}', [
            'as' =>'admin.product.edit',
            'uses' => 'App\Http\Controllers\AdminProductController@edit',


        ]);
        Route::post('/store', [
            'as' =>'admin.product.store',
            'uses' => 'App\Http\Controllers\AdminProductController@store'

        ]);
        Route::post('/update/{id}', [
            'as' =>'admin.product.update',
            'uses' => 'App\Http\Controllers\AdminProductController@update',
            'middleware'=> 'can:product-edit,id'

        ]);

        Route::get('/delete/{id}', [
            'as' =>'admin.product.delete',
            'uses' => 'App\Http\Controllers\AdminProductController@delete',
            'middleware'=> 'can:product-delete'

        ]);

    });


    //Slider

    Route::prefix('slider')->group(function () {
        Route::get('/', [
            'as' =>'admin.slider.index',
            'uses' => 'App\Http\Controllers\AdminSliderController@index',
            'middleware'=> 'can:slider-list'

        ]);
        Route::get('/create', [
            'as' =>'admin.slider.create',
            'uses' => 'App\Http\Controllers\AdminSliderController@create',
            'middleware'=> 'can:slider-add'

        ]);
        Route::post('/store', [
            'as' =>'admin.slider.store',
            'uses' => 'App\Http\Controllers\AdminSliderController@store'

        ]);
        Route::get('/edit/{id}', [
            'as' =>'admin.slider.edit',
            'uses' => 'App\Http\Controllers\AdminSliderController@edit',
            'middleware'=> 'can:slider-edit'

        ]);
        Route::post('/update/{id}', [
            'as' =>'admin.slider.update',
            'uses' => 'App\Http\Controllers\AdminSliderController@update'

        ]);
        Route::get('/delete/{id}', [
            'as' =>'admin.slider.delete',
            'uses' => 'App\Http\Controllers\AdminSliderController@delete',
            'middleware'=> 'can:slider-delete'

        ]);


    });

    //Settings

    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' =>'admin.settings.index',
            'uses' => 'App\Http\Controllers\AdminSettingController@index',
            'middleware'=> 'can:setting-list'

        ]);
        Route::get('/create', [
            'as' =>'admin.settings.create',
            'uses' => 'App\Http\Controllers\AdminSettingController@create',
            'middleware'=> 'can:setting-add'

        ]);
        Route::post('/store', [
            'as' =>'admin.settings.store',
            'uses' => 'App\Http\Controllers\AdminSettingController@store'

        ]);
        Route::get('/edit/{id}', [
            'as' =>'admin.settings.edit',
            'uses' => 'App\Http\Controllers\AdminSettingController@edit',
            'middleware'=> 'can:setting-edit'

        ]);
        Route::post('/update/{id}', [
            'as' =>'admin.settings.update',
            'uses' => 'App\Http\Controllers\AdminSettingController@update'

        ]);
        Route::get('/delete/{id}', [
            'as' =>'admin.settings.delete',
            'uses' => 'App\Http\Controllers\AdminSettingController@delete',
            'middleware'=> 'can:setting-delete'

        ]);

    });

    //Users

    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' =>'admin.users.index',
            'uses' => 'App\Http\Controllers\AdminUserController@index',
            'middleware'=> 'can:user-list'
        ]);
        Route::get('/create', [
            'as' =>'admin.users.create',
            'uses' => 'App\Http\Controllers\AdminUserController@create',
            'middleware'=> 'can:user-add'
        ]);
        Route::post('/store', [
            'as' =>'admin.users.store',
            'uses' => 'App\Http\Controllers\AdminUserController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' =>'admin.users.edit',
            'uses' => 'App\Http\Controllers\AdminUserController@edit',
            'middleware'=> 'can:user-edit'
        ]);
        Route::post('/update/{id}', [
            'as' =>'admin.users.update',
            'uses' => 'App\Http\Controllers\AdminUserController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' =>'admin.users.delete',
            'uses' => 'App\Http\Controllers\AdminUserController@delete',
            'middleware'=> 'can:user-delete'
        ]);
    });

    //Roles

    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' =>'admin.roles.index',
            'uses' => 'App\Http\Controllers\AdminRoleController@index',
            'middleware'=> 'can:role-list'
        ]);
        Route::get('/create', [
            'as' =>'admin.roles.create',
            'uses' => 'App\Http\Controllers\AdminRoleController@create',
            'middleware'=> 'can:role-add'
        ]);
        Route::post('/store', [
            'as' =>'admin.roles.store',
            'uses' => 'App\Http\Controllers\AdminRoleController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' =>'admin.roles.edit',
            'uses' => 'App\Http\Controllers\AdminRoleController@edit',
            'middleware'=> 'can:role-edit'
        ]);
        Route::post('/update/{id}', [
            'as' =>'admin.roles.update',
            'uses' => 'App\Http\Controllers\AdminRoleController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' =>'admin.roles.delete',
            'uses' => 'App\Http\Controllers\AdminRoleController@delete',
            'middleware'=> 'can:role-delete'
        ]);
    });

    //Permissions

    Route::prefix('permissions')->group(function () {
        Route::get('/create', [
            'as' =>'admin.permissions.create',
            'uses' => 'App\Http\Controllers\AdminPermissionController@create'
        ]);
        Route::post('/store', [
            'as' =>'admin.permissions.store',
            'uses' => 'App\Http\Controllers\AdminPermissionController@store'
        ]);
    });


    //Orders

    Route::prefix('orders')->group(function () {
        Route::get('/', [
            'as' =>'admin.orders.index',
            'uses' => 'App\Http\Controllers\AdminOrderController@index'
        ]);
        Route::get('/create', [
            'as' =>'admin.orders.create',
            'uses' => 'App\Http\Controllers\AdminOrderController@create'
        ]);
        Route::get('/store', [
            'as' =>'admin.orders.store',
            'uses' => 'App\Http\Controllers\AdminOrderController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' =>'admin.orders.edit',
            'uses' => 'App\Http\Controllers\AdminOrderController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' =>'admin.orders.update',
            'uses' => 'App\Http\Controllers\AdminOrderController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' =>'admin.orders.delete',
            'uses' => 'App\Http\Controllers\AdminOrderController@delete'
        ]);

        Route::post('/admin/orders/searchProduct', "Backend\OrderController@searchProduct")->middleware('backendauth');
        Route::post('/admin/orders/ajaxSingleProduct', "Backend\OrderController@ajaxSingleProduct")->middleware('backendauth');


    });




});



