<?php

Route::auth();

// See https://laravel.com/docs/5.3/upgrade#upgrade-5.3.0
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index')->name('app.home');
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

Route::get('/api/me', 'ApiController@me')->name('api.me');

//Route::group(['prefix' => 'admin', 'middleware' => ['permission:manage-members']], function() {
//    Route::get('paymentTypes', ['as' => 'admin.paymentTypes.index', 'uses' => 'PaymentTypeController@index']);
//    Route::post('paymentTypes', ['as' => 'admin.paymentTypes.store', 'uses' => 'PaymentTypeController@store']);
//    Route::get('paymentTypes/create', ['as' => 'admin.paymentTypes.create', 'uses' => 'PaymentTypeController@create']);
//    Route::put('paymentTypes/{paymentTypes}', ['as' => 'admin.paymentTypes.update', 'uses' => 'PaymentTypeController@update']);
//    Route::patch('paymentTypes/{paymentTypes}', ['as' => 'admin.paymentTypes.update', 'uses' => 'PaymentTypeController@update']);
//    Route::delete('paymentTypes/{paymentTypes}', ['as' => 'admin.paymentTypes.destroy', 'uses' => 'PaymentTypeController@destroy']);
//    Route::get('paymentTypes/{paymentTypes}', ['as' => 'admin.paymentTypes.show', 'uses' => 'PaymentTypeController@show']);
//    Route::get('paymentTypes/{paymentTypes}/edit', ['as' => 'admin.paymentTypes.edit', 'uses' => 'PaymentTypeController@edit']);
//});
