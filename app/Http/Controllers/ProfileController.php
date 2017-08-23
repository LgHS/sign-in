<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 26/12/16
 * Time: 12:26
 */

namespace App\Http\Controllers;


use App\MacAddresses;
use App\SocialTags;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller {
	public function index(Request $request)
    {
        $member = Auth::user();
        $mac_addresses = MacAddressesController::getMyMacAddresses($request);
        return view('app.profil', compact('member', 'mac_addresses'));
    }

    public function edit()
    {
		$member = Auth::user();
		return view('app.profil-edit', ['member' => $member]);
	}

    public function editMore(Request $request)
    {
        $member = Auth::user();

        $mac_addresses = MacAddressesController::getAvailableMacAddresses();
        $my_mac_addresses = MacAddressesController::getMyMacAddresses($request);

        return view('app.profil-edit-more', compact('member', 'mac_addresses', 'my_mac_addresses'));
    }

    public function update(Request $request)
    {
		/** @var User $member */
		$member = Auth::user();

		$validator = Validator::make($request->all(), [
			'username' => 'required|max:255|unique:users,username,' . $member->id,
			'email' => 'required|email|max:255|unique:users,email,' . $member->id,
			'new_password' => 'min:8',
			'lastName' => 'required',
			'firstName' => 'required',
			'date_of_birth' => 'required|date_format:d/m/Y',
			'address' => 'required',
			'postcode' => 'required',
			'city' => 'required',
			'country' => 'required',
			'phone' => 'required',
		], [
			'new_password.min' => 'Le mot de passe doit contenir au moins :min caractères',
			'new_password.regex' => 'hello'
		]);

		// password validation
		$validator->after(function($validator) use ($request, $member) {
			// one field is filled but not the other
			if($request->get('old_password') && ! $request->get('new_password')) {
				$validator->errors()->add('new_password', 'Si vous voulez changer de mot de passe, il faut le définir');

				return;
			}
			// one field is filled but not the other
			if( ! $request->get('old_password') && $request->get('new_password')) {
				$validator->errors()->add('old_password', 'Remplissez votre mot de passe actuel');

				return;
			}

			if($request->get('old_password') && $request->get('new_password')) {
				// Old password don't match
				if( ! Hash::check($request->get('old_password'), $member->getAuthPassword())) {
					$validator->errors()->add('old_password', 'Ce mot de passe ne correspond pas à votre mot de passe actuel');
				}

				// OK !
				$member->password = Hash::make($request->get('new_password'));
			}
		});

		// validate
		if($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}

		// change date format
		$request->merge(array(
			'date_of_birth' => Carbon::createFromFormat('d/m/Y', $request->get('date_of_birth'))->toDateTimeString(),
		));

		if($request->get('username') != $member->username) {
			$member->username = $request->get('username');
		}
		if($request->get('email') != $member->email) {
			$member->email = $request->get('email');
		}

		$member->update($request->all());

		return back()->with([
			'message' => 'Votre profil a été mis à jour.',
			'status' => 'success'
		]);
	}

    public function updateMore(Request $request)
    {
        /** @var User $member */
        $member = Auth::user();

//        $request->all()['social'] = $this->parseSocial($request->all());
        $newRequest = $request->all();

//        $newRequest['social'] = $this->parseSocial($request->all());

        $validator = Validator::make($newRequest, [
            'quote' => 'max:240'
        ]);

        // validate
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $member->update($newRequest);
        $socialController = new SocialTagsController;
        $socialController->store($request);
        MacAddressesController::claimMacAddresses($request);

        return back()->with([
            'message' => 'Votre profil a été mis à jour.',
            'status' => 'success'
        ]);
    }

    private function parseSocial($request)
    {
        $response =
            [
                'facebook'  => $request['social_facebook'],
                'twitter'   => $request['social_twitter'],
                'instagram' => $request['social_instagram'],
                'github'    => $request['social_github'],
                'bitbucket' => $request['social_bitbucket'],
                'dribbble'  => $request['social_dribbble'],
                'mastodon'  => $request['social_mastodon'],
                'behance'   => $request['social_behance'],
                'codepen'   => $request['social_codepen'],
                'jsfiddle'  => $request['social_jsfiddle'],
                'diaspora'  => $request['social_diaspora'],
                'tumblr'    => $request['social_tumblr'],
            ];

        unset($request['social_facebook']);
        unset($request['social_twitter']);
        unset($request['social_instagram']);
        unset($request['social_github']);
        unset($request['social_bitbucket']);
        unset($request['social_dribbble']);
        unset($request['social_mastodon']);
        unset($request['social_behance']);
        unset($request['social_codepen']);
        unset($request['social_jsfiddle']);
        unset($request['social_diaspora']);
        unset($request['social_tumblr']);

        $response = json_encode($response);
        return $response;
    }

    private function getLogs()
    {
        $logs = $this->getUrlContent('http://wiki.lghs.be/feed.php');
        $logs = simplexml_load_string($logs);
//        $logs = json_encode($logs);

        dd($logs);
    }


    private function getUrlContent($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ($httpcode>=200 && $httpcode<300) ? $data : false;
    }


}