<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\MembersController;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $members = new MembersController();
        $countMembers = $members->countMembersInSpace();
        $members = $members->getMembersInSpace();

        return view('app.home', compact("members", "countMembers"));
    }

    public function apps()
    {
        return view('app.home');
    }

}
