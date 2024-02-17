<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingHelper
{
    public static function midtrans_api()
    {
        
        $midtrans_client_key = env('MIDTRANS_CLIENT_KEY');
        $midtrans_server_key = env('MIDTRANS_SERVER_KEY');
        $midtrans_merchant   = env('MIDTRANS_MERCHANT_ID');
        $midtrans_sanbox     = env('MIDTRANS_SANDBOX');
        $midtrans_production = env('MIDTRANS_PRODUCTION');
        $midtrans_mode       = env('MIDTRANS_MODE');

        if($midtrans_mode == 'sanbox'){
            // $data = [
            //     'client' => $midtrans_client_key,
            //     'server' => $midtrans_server_key,
            // ]
            // return $data;
            return $midtrans_sanbox;
        }
        
        if($midtrans_mode == 'production'){
            return $midtrans_production;
        }
    }
}
