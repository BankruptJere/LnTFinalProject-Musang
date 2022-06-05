<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();



Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'PageController@index');

    // Item ROUTES
    Route::get('/item', 'ItemController@index')->name('indexItem');
    Route::delete('/item/delete/{id}', 'ItemController@destroy')->name('deleteItem');

    // AUTH ROUTES
    Route::get('/home', 'HomeController@index')->name('home');

    // ROLEADMIN ROUTES
    Route::group(['middleware' => 'RoleAdmin'], function () {
        Route::get('/admin', 'HomeController@admin');

        // 1. Categories Routes
        Route::get('/categories', 'CategoryController@index')->name('indexCategory');
        Route::post('/categories', 'CategoryController@store')->name('storeCategory');
        Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('editCategory');
        Route::put('/categories/edit/{id}', 'CategoryController@update')->name('updateCategory');
        Route::delete('/categories/delete/{id}', 'CategoryController@destroy')->name('deleteCategory');
        Route::post('/item', 'ItemController@store')->name('storeItem');
        Route::get('/item/edit/{id}', 'ItemController@edit')->name('editItem');
        Route::put('/item/edit/{id}', 'ItemController@update')->name('updateItem');
    });

    // ROLEMEMBER ROUTES
    Route::group(['middleware' => 'RoleMember'], function () {
        Route::get('/member', 'HomeController@member');
        Route::get('/cartIndex', 'CartController@index')->name('indexCart');
        Route::post('/cart', 'CartController@store')->name('storeCart');
        Route::get('/cart/edit/{id}', 'CartController@edit')->name('editCart');
        Route::put('/cart/edit/{id}', 'CartController@update')->name('updateCart');
        Route::get('/cart/edit/{id}', 'CartController@destroy')->name('editCart');
        Route::delete('/cart/delete/{id}', 'CartController@destroy')->name('deleteCart');
    });
});
