<?php

Route::auth();

// See https://laravel.com/docs/5.3/upgrade#upgrade-5.3.0
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index')->name('app.home');
Route::get('/password/init/{token}', 'Auth\ResetPasswordController@initPassword')->name('password-init');

Route::get('/clients', function() {
   return view('app.clients');
})->middleware(['permission:manage-oauth-clients'])->name('clients');


Route::group(['prefix' => 'members', 'middleware' => ['permission:manage-members']], function() {
    Route::get('', 'Admin\MembersController@index')->name('members.index');
    Route::get('{member}/edit', 'Admin\MembersController@edit')->name('members.edit');
    Route::get('add', 'Admin\MembersController@add')->name('members.add');
    Route::post('', 'Admin\MembersController@store')->name('members.store');
    Route::put('{member}', 'Admin\MembersController@update')->name('members.update');
    Route::delete('{member}', 'Admin\MembersController@delete')->name('members.delete');
    Route::post('{member}/sendResetMail', 'Admin\MembersController@resendMail');
});

Route::group(['prefix' => 'profile', 'middleware' => ['permission:manage-account']], function() {
   Route::get('', 'ProfileController@index')->name('profile.index');
    Route::put('', 'ProfileController@update')->name('profile.update');
});


//Route::get('/oauthtest', function () {
//    $query = http_build_query([
//        'client_id' => 4,
//        'redirect_uri' => 'http://localhost/callback',
//        'response_type' => 'code',
//        'scope' => '',
//    ]);
//
//    return redirect('/oauth/authorize?'.$query);
//});