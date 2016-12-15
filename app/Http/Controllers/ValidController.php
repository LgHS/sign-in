<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;

class ValidController extends Controller
{

//    public function index($token)
//    {
//        $user = User::where('token_valid', $token)->firstOrFail();
//
//        if($user) {
//            if($user->is_valid) $msg = "Ce compte est déjà activé.";
//            else {
//
//                $user->is_valid = True;
//                $user->save();
//                $msg = "Votre compte vient d'être validé. Bienvenue !";
//            }
//        }
//        else $msg = "Cette clé n'est associée à aucun compte.";
//
//        return view('auth.valid.msg', [ 'msg' => $msg ]);
//    }
}
