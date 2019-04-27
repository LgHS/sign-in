<?php

Route::get('me', 'ApiController@me')
    ->name('api.me')
    ->middleware('auth:api');

Route::get('users', 'ApiController@users')
    ->name('api.users')
    ->middleware('client:list-users');
