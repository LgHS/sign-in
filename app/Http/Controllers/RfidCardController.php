<?php

namespace App\Http\Controllers;

use App\RfidCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RfidCardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $cards = RfidCard::where(['user_id' => Auth::user()->id])->get();
        return response()->json([
            'rfid_cards' => $cards
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, RfidCard::$rules);

        $card = new RfidCard([
            'uid' => request('uid'),
            'name' => request('name')
        ]);

        $card->user()->associate(Auth::user());
        $card->save();

        return response()->json([
            'rfid_card' => $card,
            'message' => 'Carte enregistrée'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RfidCard $rfidCard
     * @return \Illuminate\Http\Response
     */
    public function show(RfidCard $rfidCard) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RfidCard $rfidCard
     * @return \Illuminate\Http\Response
     */
    public function edit(RfidCard $rfidCard) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\RfidCard $rfidCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RfidCard $rfidCard) {
        $this->validate($request, RfidCard::$rules);

        $rfidCard->uid = request('uid');
        $rfidCard->name = request('name');
        $rfidCard->save();

        return response()->json([
            'message' => 'La carte rfid a bien été mise à jour'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RfidCard $rfidCard
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(RfidCard $rfidCard) {
        $rfidCard->delete();
        return response()->json([
            'message' => 'La carte a bien été supprimée'
        ], 200);
    }
}
