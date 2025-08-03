<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;

class SmsController extends Controller
{
    //

    public function sms(){
        $username = 'greenwebapp'; // use 'sandbox' for development in the test environment
        $apiKey   = 'atsk_6a21d18160c9f7cb886c4ac8785a666fc60759e4ce73cd342c581b62c1c50e1b00c950e0'; // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);
        
      
        // Get one of the services
        $sms      = $AT->sms();
        
        // Use the service
        $result   = $sms->send([
            'to'      => '+2540100387330',
            'message' => 'Hello World!'
        ]);
        
        print_r($result);
    }
}
