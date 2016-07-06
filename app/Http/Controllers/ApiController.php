<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('oauth');
    }
    public function me()
    {
        $user = User::findOrFail(Authorizer::getResourceOwnerId());
        $data = [
            "uuid" => $user->uuid,
            "name" => $user->name,
            "email" => $user->email
        ];

        return  $data;
    }
}
