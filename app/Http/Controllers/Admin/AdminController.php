<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\TransactionStat;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function services()
    {
        return view('admin.services');
    }

    public function stats() {
        $stats = TransactionStat::orderBy('month', 'desc')->get();
        return view('admin.stats', [
            'stats' => $stats
        ]);
    }
}
