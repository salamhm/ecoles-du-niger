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

        Route::group(['prefix'  =>   'levels'], function() {

            Route::get('/', 'Admin\LevelController@index')->name('admin.levels.index');
            Route::get('/create', 'Admin\LevelController@create')->name('admin.levels.create');
            Route::post('/store', 'Admin\LevelController@store')->name('admin.levels.store');
            Route::get('/{id}/edit', 'Admin\LevelController@edit')->name('admin.levels.edit');
            Route::post('/update', 'Admin\LevelController@update')->name('admin.levels.update');
            Route::get('/{id}/delete', 'Admin\LevelController@delete')->name('admin.levels.delete');
        
        });

        Route::group(['prefix'  =>   'institution-types'], function() {

            Route::get('/', 'Admin\InstitutionTypeController@index')->name('admin.institution-types.index');
            Route::get('/create', 'Admin\InstitutionTypeController@create')->name('admin.institution-types.create');
            Route::post('/store', 'Admin\InstitutionTypeController@store')->name('admin.institution-types.store');
            Route::get('/{id}/edit', 'Admin\InstitutionTypeController@edit')->name('admin.institution-types.edit');
            Route::post('/update', 'Admin\InstitutionTypeController@update')->name('admin.institution-types.update');
            Route::get('/{id}/delete', 'Admin\InstitutionTypeController@delete')->name('admin.institution-types.delete');
        
        });

        Route::group(['prefix'  =>   'institutions'], function() {

            Route::get('/', 'Admin\InstitutionController@index')->name('admin.institutions.index');
            Route::get('/create', 'Admin\InstitutionController@create')->name('admin.institutions.create');
            Route::post('/store', 'Admin\InstitutionController@store')->name('admin.institutions.store');
            Route::get('/{id}/edit', 'Admin\InstitutionController@edit')->name('admin.institutions.edit');
            Route::post('/update', 'Admin\InstitutionController@update')->name('admin.institutions.update');
            Route::get('/{id}/delete', 'Admin\InstitutionController@delete')->name('admin.institutions.delete');

            Route::post('get-contacts', 'Admin\InstitutionContactController@getContacts');
            Route::post('add-contact', 'Admin\InstitutionContactController@addContact');
            Route::post('update-contact', 'Admin\InstitutionContactController@updateContact');
            Route::post('delete-contact', 'Admin\InstitutionContactController@deleteContact');
        
        });
    
    });

});