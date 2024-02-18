<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingHelper
{
    public static function midtrans_api()
    {

        $midtrans_sanbox     = env('MIDTRANS_SANDBOX');
        $midtrans_production = env('MIDTRANS_PRODUCTION');
        $midtrans_mode       = env('MIDTRANS_MODE');

        if($midtrans_mode == 'sanbox'){
            return $midtrans_sanbox;
        }

        if($midtrans_mode == 'production'){
            return $midtrans_production;
        }
    }
}
