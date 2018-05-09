<?php

namespace App\Http\Controllers;

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
        return view('app.home');
    }

    public function apps()
    {
        return view('app.home');
    }

    public function rfid_cards() {
        return view('app.rfid');
    }
}
