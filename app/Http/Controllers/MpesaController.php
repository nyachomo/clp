<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MpesaSdk\StkPush;

class MpesaController extends Controller
{
    //

    public function mpesa(){
        $stkpush = new StkPush();
        $phone_number="254112758521";
        $amount=1;
        $reference="Mpesa Stk Push";
        $description="Mpesa Payment";
        echo$stkpush->initiate($phone_number, $amount, $reference, $description);

    }
}
