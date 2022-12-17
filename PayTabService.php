<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class PayTabService
{
    /*
    |--------------------------------------------------------------------------
    | Create Page Payment
    |--------------------------------------------------------------------------
    */
    public static function createPaymentPage($data)
    {
        $sett_data = self::getSettings([
            "tran_type"=>"sale",
            "cart_id"=>$data['cart_id']
        ]);

        $payload  = array_merge($sett_data, $data);

        $request = self::makeRequest();

        $response = $request->post('request',$payload);

        return $response->object();
    }
    
    /*
    |--------------------------------------------------------------------------
    | Verify Payment
    |--------------------------------------------------------------------------
    */
    public static function query_transaction($trans_ref)
    {
        $fields = [
            "profile_id" => config('paytabs.profile_id'),
            'tran_ref' => $trans_ref// example
        ];

        $response = Http::withHeaders([
            'authorization' =>  config('paytabs.server_key'),
            'Content-type' => 'application/json'
        ])->post('https://secure-global.paytabs.com/payment/query', $fields);

        return $response->object();
    }
    
    /*
    |--------------------------------------------------------------------------
    | Make Request
    |--------------------------------------------------------------------------
    */
    public static function makeRequest()
	{
        define("PAY_TAB_URL", "https://secure-global.paytabs.com/payment/");

        $url = PAY_TAB_URL;

		$request = Http::baseUrl($url)->withHeaders([
		    
            'authorization' => config('paytabs.server_key'),
            
            'Content-type' => 'application/json'
            
        ]);

		return $request;
	}

    /*
    |--------------------------------------------------------------------------
    | get Settings
    |--------------------------------------------------------------------------
    */
    public static function getSettings($data)
    {
        $setting = [];

        $setting = [
            "profile_id" => config('paytabs.profile_id'),
            "cart_currency" => config('paytabs.currency'),
            "currency" => config('paytabs.currency'),
            'tran_type' => $data["tran_type"],
            'tran_class' => 'ecom',
        ];

        return $setting;
    }
}
