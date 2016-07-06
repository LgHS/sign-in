<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;

class ValidController extends Controller
{

    public function index($token)
    {
        $user = User::where('token_valid', $token)->firstOrFail();

        if($user) {
            if($user->is_valid) $msg = "Ce comte est déjà activé";
            else {

                $user->is_valid = True;
                $user->save();
                $msg = "Votre comte vien d'etre validé";
            }
        }
        else $msg = "Cette cles n'est associer à aucun conte";

        return view('auth.valid.msg', [ 'msg' => $msg ]);
    }
}
