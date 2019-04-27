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

        $member->pin = Hash::make($request->get('pin'));
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

        // pin validation
        $validator->after(function($validator) use ($request, $member) {
            // one field is filled but not the other
            if($request->get('old_pin') && ! $request->get('pin')) {
                $validator->errors()->add('pin', 'Si vous voulez changer de PIN, il faut le définir');
            }
            // one field is filled but not the other
            if( ! $request->get('old_pin') && $request->get('pin')) {
                $validator->errors()->add('old_pin', 'Entrez votre PIN actuel');
            }

            if($request->get('old_pin') && $request->get('pin')) {
                // Old pin don't match
                if( ! Hash::check($request->get('old_pin'), $member->pin)) {
                    $validator->errors()->add('old_pin', 'Ce code PIN ne correspond pas à votre code PIN actuel');
                }
            }
        });

        // validate
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $member->pin = Hash::make($request->get('pin'));
        $member->save();

        return back()->with([
            'message' => 'Votre code PIN a bien été modifié.',
            'status' => 'success'
        ]);
    }
}
