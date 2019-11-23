<?php

Route::group([ 'prefix' => 'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

        Route::group(['prefix'  =>   'categories'], function() {

            Route::get('/', 'Admin\CategoryController@index')->name('admin.categories.index');
            Route::get('/create', 'Admin\CategoryController@create')->name('admin.categories.create');
            Route::post('/store', 'Admin\CategoryController@store')->name('admin.categories.store');
            Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('admin.categories.edit');
            Route::post('/update', 'Admin\CategoryController@update')->name('admin.categories.update');
            Route::get('/{id}/delete', 'Admin\CategoryController@delete')->name('admin.categories.delete');
        
        });

        Route::group(['prefix'  =>   'cities'], function() {

            Route::get('/', 'Admin\CityController@index')->name('admin.cities.index');
            Route::get('/create', 'Admin\CityController@create')->name('admin.cities.create');
            Route::post('/store', 'Admin\CityController@store')->name('admin.cities.store');
            Route::get('/{id}/edit', 'Admin\CityController@edit')->name('admin.cities.edit');
            Route::post('/update', 'Admin\CityController@update')->name('admin.cities.update');
            Route::get('/{id}/delete', 'Admin\CityController@delete')->name('admin.cities.delete');
        
        });
    
    });

});