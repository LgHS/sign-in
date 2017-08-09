<?php

namespace App\Http\Controllers;

use App\MacAddresses;
use Illuminate\Http\Request;

class MacAddressesController extends Controller
{
    public static function getMacAddresses()
    {
        $macAddresses = MacAddresses::get(['mac_address', 'alias', 'user_id'])->toArray();

        $simpleMacAddresses = [];
        foreach ($macAddresses as $key => $value){
            $simpleMacAddresses[] .= $value->mac_addresses;
        }
        return $simpleMacAddresses;
    }

    public static function getAvailableMacAddresses()
    {
        $availableMacAddresses = MacAddresses
                                    ::where('user_id', 0)
                                    ->get(['mac_address', 'alias', 'user_id'])
                                    ->toArray();
//        $simpleAvailableMacAddresses = [];
//        foreach ($availableMacAddresses as $key => $value){
//            $simpleAvailableMacAddresses[] .= $value->mac_address;
//        }

        return $availableMacAddresses;
    }

    public static function getMyMacAddresses($request)
    {
        $myAddress = MacAddresses::where('user_id', $request->user()->id)->get(['mac_address', 'alias', 'user_id'])->toArray();
//        $simpleMacAddresses = [];
//        foreach ($myAddress as $key => $value){
//            $simpleMacAddresses[] .= $value->mac_address;
//        }

        return $myAddress;
    }

    public static function claimMacAddresses($request)
    {
        $insert = MacAddresses::where('mac_address',$request->all()["mac_address"])->firstOrFail();

        $insert->user_id = $request->user()->id;
        $insert->alias = $request->all()["mac_address_alias"];
        $insert->save();

    }

    public function removeMacAddress($macAddress)
    {
        $insert = MacAddresses::where('mac_address', $macAddress)->firstOrFail();
        $insert->user_id = 0;
        $insert->save();

        return redirect()->route('profile.update.advanced');

    }
}
