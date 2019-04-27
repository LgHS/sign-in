<?php

Route::auth();

// See https://laravel.com/docs/5.3/upgrade#upgrade-5.3.0
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index')->name('app.home');
Route::get('/stats', 'HomeController@stats')->name('app.stats');
Route::get('/password/init/{token}', 'Auth\ResetPasswordController@initPassword')->name('password-init');

Route::get('/services', function () {
    return view('app.services');
})->middleware(['permission:manage-account'])->name('services');


Route::group(['prefix' => 'members', 'middleware' => ['permission:manage-members']], function () {
    Route::get('', 'Admin\MembersController@index')->name('members.index');
    Route::get('{member}/edit', 'Admin\MembersController@edit')->name('members.edit');
    Route::get('add', 'Admin\MembersController@add')->name('members.add');
    Route::post('', 'Admin\MembersController@store')->name('members.store');
    Route::put('{member}', 'Admin\MembersController@update')->name('members.update');
    Route::delete('{member}', 'Admin\MembersController@delete')->name('members.delete');
    Route::post('{member}/sendResetMail', 'Admin\MembersController@resendMail');
    Route::post('{member}/sendReminder/{transactionType}', 'Admin\MembersController@sendReminder');
    Route::get('{member}/pin', 'Admin\MemberPinController@index')->name('members.pin.index');
    Route::put('{member}/pin', 'Admin\MemberPinController@update')->name('members.pin.update');
});

Route::group(['prefix' => 'profile', 'middleware' => ['permission:manage-account']], function () {
    Route::get('', 'ProfileController@index')->name('profile.index');
    Route::put('', 'ProfileController@update')->name('profile.update');
});

Route::group(['prefix' => 'pin', 'middleware' => ['permission:manage-account']], function () {
    Route::get('', 'PinController@index')->name('pin.index');
    Route::post('', 'PinController@create')->name('pin.create');
    Route::put('', 'PinController@update')->name('pin.update');
});


Route::get('/rfid', 'HomeController@rfid_cards')->name('app.rfid');
Route::resource('rfid_cards', 'RfidCardController');

