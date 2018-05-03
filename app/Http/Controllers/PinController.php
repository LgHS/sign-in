<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 26/12/16
 * Time: 12:26
 */

namespace App\Http\Controllers;


use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PinController extends Controller {
	public function index() {
		$member = Auth::user();

		return view('app.pin', ['member' => $member]);
	}

	public function create(Request $request) {
        /** @var User $member */
        $member = Auth::user();

        $validator = Validator::make($request->all(), User::$rules);

        // validate
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $member->pin = $request->get('pin');
        $member->save();

        return back()->with([
            'message' => 'Votre PIN a bien été ajouté.',
            'status' => 'success'
        ]);
	}

	public function update(Request $request) {
        /** @var User $member */
        $member = Auth::user();

        $validator = Validator::make($request->all(), User::$rules);

        // validate
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $member->pin = $request->get('pin');
        $member->save();

        return back()->with([
            'message' => 'Votre PIN a bien été modifié.',
            'status' => 'success'
        ]);
    }
}
