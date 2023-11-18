<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
     
        $store_id      = 'aamarpaytest';
        $signature_kay = 'dbb74894e82415a2f7ff0ec3a97e4183';

        $transaction_id = rand(000000000000, 999999999999);

        $price = $request->total_price;

        $url = 'https://sandbox.aamarpay.com/jsonpost.php';
        //For Live Transection Use "https://secure.aamarpay.com/jsonpost.php"


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "store_id": "'.$store_id.'",
            "tran_id": "'.$transaction_id.'",
            "success_url": "'.route('success').'",
            "fail_url": "'.route('fail').'",
            "cancel_url": "'.route('cancel').'",
            "amount": '.$price.',
            "currency": "BDT",
            "signature_key": "'.$signature_kay.'",
            "desc": "Merchant Registration Payment",
            "cus_name": "Nazmul",
            "cus_email": "nazmul@gmail.com",
            "cus_add1": "House A-55 Road 10",
            "cus_add2": "Jhenaidah, Khulna, Bangladesh",
            "cus_city": "Jhenaidah",
            "cus_state": "Jhenaidah",
            "cus_postcode": "7200",
            "cus_country": "Bangladesh",
            "cus_phone": "+88001700000001",
            "type": "json"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $responseObject = json_decode($response, true);

        if (isset($responseObject['payment_url']) && $responseObject['payment_url'] != null) {
            return redirect()->away($responseObject['payment_url']);
        }else{
            return redirect()->route('home')->with('error', 'Payment Url Generation Failed!');
        }

    }

    //Get success response
    public function success(Request $request)
    {

        $request_id    = $request['mer_txnid'];
        $store_id      = config('amarpay.store_id');
        $signature_kay = config('amarpay.signature_kay');

        

        $url = "https://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=$store_id&signature_key=$signature_kay&type=json";
        //For Live Transection Use "http://secure.aamarpay.com/api/v1/trxcheck/request.php"

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
        return redirect()->route('home')->with('success', 'Order placed successfully');
    }

    //get failure response
    public function fail(Request $request)
    {
        return redirect()->route('home')->with('error', 'Order Failed!');
    }

    //
    public function cancel(Request $request)
    {
        return redirect()->route('home')->with('warning', 'Order cancelled!');
    }
}
