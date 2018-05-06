<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 6/05/18
 * Time: 01:01
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Validator;

class MemberPinController extends Controller {
    public function index($member_id) {
        $member = User::with('roles')->where('id', $member_id)->first();
        return view('admin.members.pin', compact('member'));
    }

    public function update(Request $request, User $member) {
        $validator = Validator::make($request->all(), User::$rules);

        // validate
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $member->pin = Hash::make($request->get('pin'));
        $member->save();

        return Redirect::to('/members')->with([
            'flash_notification.message' => 'Le code PIN du membre a bien été modifié, n\'oublie pas de le prévenir.',
            'flash_notification.level' => 'success'
        ]);
    }
}
