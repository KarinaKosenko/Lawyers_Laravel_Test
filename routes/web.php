<?php


Route::get('/', function () {
        return view('layouts.single', [
            'page' => 'pages.index',
        ]);
    })
    ->name('public.index');

/**
 * Routes for register and login
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


/**
 * Routes for files uploading
 */

Route::get('/upload/{user_id}', 'UploadsController@upload')
    ->name('public.uploads.upload');

Route::post('/upload/{user_id}', 'UploadsController@uploadPost')
    ->name('public.uploads.uploadPost');

