<?php

Route::auth();

// See https://laravel.com/docs/5.3/upgrade#upgrade-5.3.0
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index')->name('app.home');
Route::get('/password/init/{token}', 'Auth\ResetPasswordController@initPassword')->name('password-init');

Route::get('/services', function() {
   return view('app.services');
})->middleware(['permission:manage-account'])->name('services');

Route::group(['prefix' => 'members', 'middleware' => ['permission:manage-members']], function() {
    Route::get('', 'Admin\MembersController@index')->name('members.index');
    Route::get('{member}/edit', 'Admin\MembersController@edit')->name('members.edit');
    Route::get('add', 'Admin\MembersController@add')->name('members.add');
    Route::post('', 'Admin\MembersController@store')->name('members.store');
    Route::put('{member}', 'Admin\MembersController@update')->name('members.update');
    Route::delete('{member}', 'Admin\MembersController@delete')->name('members.delete');
    Route::post('{member}/sendResetMail', 'Admin\MembersController@resendMail');
    Route::post('{member}/sendReminder/{transactionType}', 'Admin\MembersController@sendReminder');
});

Route::group(['prefix' => 'profile', 'middleware' => ['permission:manage-account']], function() {
    Route::get('', 'ProfileController@index')->name('profile.index');
    Route::get('edit', 'ProfileController@edit')->name('profile.update');
    Route::get('edit/advanced', 'ProfileController@editMore')->name('profile.update.advanced');

    Route::get('edit/remove/mac_address/{macAddress}', 'MacAddressesController@removeMacAddress')->name('profile.edit.remove.macaddress');
    Route::get('edit/add/mac_address/{macAddress}', 'MacAddressesController@removeMacAddress')->name('profile.edit.remove.macaddress');

    Route::put('edit', 'ProfileController@update')->name('profile.update');
    Route::put('edit/advanced', 'ProfileController@updateMore')->name('profile.update.advanced');
});

Route::post('pamela', 'MacAddressesController@storeMacAddresses')->name('post.pamela');

Route::get('/api/me', 'ApiController@me')->name('api.me');
