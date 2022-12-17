
# Laravel Paytabs Class

Simple easy class to intgrate with Paytabs Gateway

## Config
First create config/paytabs.php and add array
```javascript

return [

    /*
    |--------------------------------------------------------------------------
    | Paytabs  Settings
    
    */

    'profile_id' => '12345',

    'server_key' => 'SLJND9BR62-JDKL2MG9NZ-xxxxxxxxxx',

    'currency' => 'USD',

    'region' => 'SAU',
    
];

```
## Usage/Examples
#### Create Payment Page
```javascript
use App\Services\PayTabService;

$data = [
            'cart_id' => 'cart_12345',
            'cart_description' =>'description',
            'cart_amount' => 399,
            'return' => 'example.com/return/url'
        ];

$invoice = PayTabService::createPaymentPage($data);

return redirect($invoice->redirect_url);

```


#### Check Payment
```javascript

$tran_ref = $order->tran_ref

$response = PayTabService::query_transaction($tran_ref);

$status = $response->payment_result->response_status;

if ($status == "A") {
    return "Payment Success";
    }
    else {
         return "Payment Faild";
         }

```


## Authors

- [@sahlwole](https://www.github.com/sahlowle)

