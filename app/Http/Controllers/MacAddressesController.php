<?php

namespace App\Http\Controllers;

use App\MacAddresses;
use Illuminate\Http\Request;

class MacAddressesController extends Controller
{
    public static function getMacAddresses()
    {
        $macAddresses = MacAddresses::get();

        $simpleMacAddresses = [];
        foreach ($macAddresses as $key => $value){
            $simpleMacAddresses[] .= $value->mac_addresses;
        }
        return $simpleMacAddresses;
    }

    public static function getAvailableMacAddresses($request)
    {
        $availableMacAddresses = MacAddresses::where('user_id', 0)->get();

        $simpleAvailableMacAddresses = [];
        foreach ($availableMacAddresses as $key => $value){
            $simpleAvailableMacAddresses[] .= $value->mac_addresses;
        }

        return $simpleAvailableMacAddresses;
    }

    public static function getMyMacAddresses($request)
    {
        $myAddress = MacAddresses::where('user_id', $request->user()->id)->get();
        $simpleMacAddresses = [];
        foreach ($myAddress as $key => $value){
            $simpleMacAddresses[] .= $value->mac_addresses;
        }

        return $simpleMacAddresses;
    }

    public static function claimMacAddresses($request, $macAddresses)
    {

        $insert = MacAddresses::where('mac_addresses', $macAddresses)->firstOrFail();

        $insert->user_id = $request->user()->id;
        $insert->save();

    }

    public function removeMacAddress($macAddress)
    {
        $insert = MacAddresses::where('mac_addresses', $macAddress)->firstOrFail();
        dd("not finished yet");
        $insert->user_id = 0;
        $insert->save();

        return redirect()->route('profile.edit.remove.macaddress');

    }
}
