<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class MembersController extends Controller
{
	protected $rules = [
		'username' => 'required|max:255|unique:users',
		'email' => 'required|email|max:255|unique:users',
		'lastName' => '',
		'firstName' => '',
		'date_of_birth' => 'date_format:d/m/Y',
		'member_since' => 'date_format:d/m/Y',
		'gender' => '',
		'address' => '',
		'postcode' => '',
		'city' => '',
		'country' => '',
		'phone' => '',
		'member_roles' => 'required',
	];

	public function __construct()
	{
	}

	public function index() {
		$members = User::all();
		return view('admin.members.index', compact('members'));
	}

	public function edit($member_id) {
		$member = User::with('roles')->where('id', $member_id)->first();
		return view('admin.members.edit', compact('member'));
	}

	public function add() {
		return view('admin.members.add');
	}

	public function store(Request $request) {
		$this->validate($request, $this->rules);

		$user = new User();

		$user->username = $request->get('username');
		$user->email = $request->get('email');
		$user->lastName = $request->get('lastName');
		$user->firstName = $request->get('firstName');
		$user->date_of_birth = $user->date_of_birth ? Carbon::createFromFormat('d/m/Y', $request->get('date_of_birth'))->toDateTimeString() : null;
		$user->gender = $request->get('gender');
		$user->address = $request->get('address');
		$user->postcode = $request->get('postcode');
		$user->city = $request->get('city');
		$user->country = $request->get('country');
		$user->phone = $request->get('phone');
		$user->is_public = $request->get('is_public');
		$user->is_active = $request->get('is_active');
		$user->member_since = $user->member_since ? Carbon::createFromFormat('d/m/Y', $request->get('member_since'))->toDateTimeString() : null;
		$user->uuid = Uuid::generate();

		$user->save();
		$user->attachRole(Role::where('name', $request->get('member_roles')[0])->first());

        $this->_sendInitMail($user);

		return redirect('members')->with([
			'message' => 'Membre ajouté ! Bravo beau gosse !',
			'status' => 'success'
		]);
	}

	public function update(Request $request, User $member) {
		$this->validate($request, array_merge($this->rules, [
			'username' => 'required|max:255|unique:users,username,' . $member->id,
			'email' => 'required|email|max:255|unique:users,email,' . $member->id,
		]));

		$request->merge(array(
			'date_of_birth' => $request->get('date_of_birth') ? Carbon::createFromFormat('d/m/Y', $request->get('date_of_birth'))->toDateTimeString() : null,
			'member_since' => $request->get('member_since') ? Carbon::createFromFormat('d/m/Y', $request->get('member_since'))->toDateTimeString() : null,
		));

		if($request->get('username') != $member->username) {
			$member->username = $request->get('username');
		}
		if($request->get('email') != $member->email) {
			$member->email = $request->get('email');
		}

		$member->update($request->all());
		$member->detachRoles($member->roles);
		$member->attachRole(Role::where('name', $request->get('member_roles')[0])->first());

		return back()->with([
			'message' => 'Membre updaté ! On est en forme je vois ?',
			'status' => 'success'
		]);
	}

	public function delete(User $member) {
		$member->delete();
		return back()->with([
			'message' => 'Membre supprimé.',
			'status' => 'success'
		]);
	}

	public function resendMail(User $member) {
		if($this->_sendInitMail($member)) {
			return back()->with([
				'message' => 'Mail envoyé ! Yay !',
				'status' => 'success'
			]);
		} else {
			return back()->with([
				'message' => 'Il y a eu une erreur, le mail n\'est pas parti :(',
				'status' => 'danger'
			]);
		}
	}



	private function _sendInitMail(User $member) {
		$token = Password::createToken($member);
		if($token) {
			$member->sendPasswordInitNotification($token);
			return true;
		} else {
			return false;
		}
	}
}
