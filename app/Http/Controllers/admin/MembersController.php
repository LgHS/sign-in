<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;

class MembersController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$members = User::all();
		return view('admin.members.index', compact('members'));
	}

	public function edit(User $member) {
		return view('admin.members.edit', compact('member'));
	}

	public function add() {
		return view('admin.members.add');
	}
}
