<?php
Route::group(['prefix' => 'admin', 'middleware' => ['permission:manage-members']], function() {
    Route::get('', 'AdminController@index')->name('admin.index');
    Route::get('services', 'AdminController@services')->name('admin.services');
    Route::get('stats', 'AdminController@stats')->name('admin.stats');
    Route::get('notifications', 'NotificationsController@index')->name('admin.notifications.index');

    Route::get('paymentTypes', ['as' => 'admin.paymentTypes.index', 'uses' => 'PaymentTypeController@index']);
    Route::post('paymentTypes', ['as' => 'admin.paymentTypes.store', 'uses' => 'PaymentTypeController@store']);
    Route::get('paymentTypes/create', ['as' => 'admin.paymentTypes.create', 'uses' => 'PaymentTypeController@create']);
    Route::put('paymentTypes/{paymentTypes}', ['as' => 'admin.paymentTypes.update', 'uses' => 'PaymentTypeController@update']);
    Route::patch('paymentTypes/{paymentTypes}', ['as' => 'admin.paymentTypes.update', 'uses' => 'PaymentTypeController@update']);
    Route::delete('paymentTypes/{paymentTypes}', ['as' => 'admin.paymentTypes.destroy', 'uses' => 'PaymentTypeController@destroy']);
    Route::get('paymentTypes/{paymentTypes}', ['as' => 'admin.paymentTypes.show', 'uses' => 'PaymentTypeController@show']);
    Route::get('paymentTypes/{paymentTypes}/edit', ['as' => 'admin.paymentTypes.edit', 'uses' => 'PaymentTypeController@edit']);

    Route::get('admin/transactionTypes', ['as'=> 'admin.transactionTypes.index', 'uses' => 'TransactionTypeController@index']);
    Route::post('admin/transactionTypes', ['as'=> 'admin.transactionTypes.store', 'uses' => 'TransactionTypeController@store']);
    Route::get('admin/transactionTypes/create', ['as'=> 'admin.transactionTypes.create', 'uses' => 'TransactionTypeController@create']);
    Route::put('admin/transactionTypes/{transactionTypes}', ['as'=> 'admin.transactionTypes.update', 'uses' => 'TransactionTypeController@update']);
    Route::patch('admin/transactionTypes/{transactionTypes}', ['as'=> 'admin.transactionTypes.update', 'uses' => 'TransactionTypeController@update']);
    Route::delete('admin/transactionTypes/{transactionTypes}', ['as'=> 'admin.transactionTypes.destroy', 'uses' => 'TransactionTypeController@destroy']);
    Route::get('admin/transactionTypes/{transactionTypes}', ['as'=> 'admin.transactionTypes.show', 'uses' => 'TransactionTypeController@show']);
    Route::get('admin/transactionTypes/{transactionTypes}/edit', ['as'=> 'admin.transactionTypes.edit', 'uses' => 'TransactionTypeController@edit']);

    Route::get('admin/transactions', ['as'=> 'admin.transactions.index', 'uses' => 'TransactionController@index']);
    Route::post('admin/transactions', ['as'=> 'admin.transactions.store', 'uses' => 'TransactionController@store']);
    Route::get('admin/transactions/create', ['as'=> 'admin.transactions.create', 'uses' => 'TransactionController@create']);
    Route::put('admin/transactions/{transactions}', ['as'=> 'admin.transactions.update', 'uses' => 'TransactionController@update']);
    Route::patch('admin/transactions/{transactions}', ['as'=> 'admin.transactions.update', 'uses' => 'TransactionController@update']);
    Route::delete('admin/transactions/{transactions}', ['as'=> 'admin.transactions.destroy', 'uses' => 'TransactionController@destroy']);
    Route::get('admin/transactions/{transactions}', ['as'=> 'admin.transactions.show', 'uses' => 'TransactionController@show']);
    Route::get('admin/transactions/{transactions}/edit', ['as'=> 'admin.transactions.edit', 'uses' => 'TransactionController@edit']);
});
