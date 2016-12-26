<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 26/12/16
 * Time: 17:26
 */

namespace App\Providers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider {
	public function boot() {
		Validator::extend('secure', function($attribute, $value, $parameters, $validator) {
			return 1 === preg_match('/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[\p{P}\p{S}]).*$/', $value);
		});
	}

	public function register() {
	}
}