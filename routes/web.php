<?php

/**
 * Route for main page.
 */
Route::get('/', 'ProfilesController@index')
    ->name('public.profiles.index');

/**
 * Routes for working with profiles.
 */
Route::group(['middleware' => 'auth'], function() {
    Route::get('/edit/{id_user}', 'ProfilesController@edit')
        ->name('public.profiles.edit');

    Route::post('/edit/{id_user}', 'ProfilesController@editPost')
        ->name('public.profiles.editPost');

    Route::get('/images/index/{id_user}', 'ImagesController@index')
        ->name('public.images.index');

    Route::get('/images/show/{path}', 'ImagesController@show')
        ->name('public.images.show');

    Route::get('/images/delete/{id_user}/{id_upload}', 'ImagesController@delete')
        ->name('public.images.delete');
});


/**
 * Routes for register and login.
 */
Route::get('/register', 'AuthController@register')
    ->name('public.auth.register');

Route::post('/register', 'AuthController@registerPost')
    ->name('public.auth.registerPost');

Route::get('/login', 'AuthController@login')
    ->name('public.auth.login');

Route::post('/login', 'AuthController@loginPost')
    ->name('public.auth.loginPost');

Route::get('/logout', 'AuthController@logout')
    ->name('public.auth.logout');

Route::get('/conditions', 'AuthController@conditions')
    ->name('public.auth.conditions');


/**
 * Routes for file uploading.
 */
Route::get('/upload/{user_id}', 'UploadsController@upload')
    ->name('public.uploads.upload');

Route::post('/upload/{user_id}', 'UploadsController@uploadPost')
    ->name('public.uploads.uploadPost');

