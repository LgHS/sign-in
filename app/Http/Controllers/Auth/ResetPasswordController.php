<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/
	use ResetsPasswords;

	protected $redirectTo = '/';

	public function __construct()
	{
		$this->middleware('guest');
	}

	public function initPassword(Request $request, $token) {
		return view('auth.passwords.init', [
			'token' => $token,
			'email' => $request->get('email')
		]);
	}

	protected function getResetValidationRules() {
		return [
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed|min:8',
		];
	}
}