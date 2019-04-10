<?php

Route::get('me', 'ApiController@me')->name('api.me');

Route::get('users', 'ApiController@users')->name('api.users');
//Route::get('rfid_users', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
//    return User::orderBy("id")->with('rfidCards')->get();
//});
