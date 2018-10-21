<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\TransactionStat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }


    public function index() {
        return view('app.home');
    }

    public function apps() {
        return view('app.home');
    }

    public function stats() {
        $stats = TransactionStat::orderBy('month', 'desc')->get();
        return view('app.stats', [
            'stats' => $stats
        ]);
    }
}
