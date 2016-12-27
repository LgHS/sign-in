<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/';
	protected $redirectPath = '/';
	protected $username = 'username';

	public function __construct()
	{
		$this->middleware('guest', ['except' => 'logout']);
	}

	public function username() {
		return 'username';
	}

	protected function credentials(Request $request) {
		$field = filter_var($request->input($this->username()), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		$request->merge([$field => $request->input($this->username())]);
		return $request->only($field, 'password');
	}

}