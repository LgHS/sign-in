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
    Route::get('edit', 'ProfileController@edit')->name('profile.edit');
    Route::get('edit/more', 'ProfileController@editMore')->name('profile.edit.more');

    Route::put('', 'ProfileController@update')->name('profile.update');
    Route::put('', 'ProfileController@updateMore')->name('profile.update.more');
});

Route::get('/api/me', 'ApiController@me')->name('api.me');
