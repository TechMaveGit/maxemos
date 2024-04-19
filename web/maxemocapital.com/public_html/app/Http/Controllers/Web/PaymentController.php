<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Providers\AppServiceProvider;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GloadController;
use App\Models\ApplyLoanHistory;
use App\Models\TempApplyLoan;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\UserBankDetail;

class PaymentController extends Controller
{


    public function isUserLoggedIn()
    {
        if (!empty(auth()->user())) {
            if (auth()->user()->userType == 'user') {
                return auth()->user();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function enachApi(Request $request, $userid)
    {
        // dd($request->all());
        $userloggedData = $this->isUserLoggedIn();
        $userId = $userloggedData->id;
        $userBankDtl = UserBankDetail::where('userId', $userId)->orderBy('id', 'desc')->first();

        // dd($userBankDtl);

        $merchant_txn = 'OR' . strtotime(date('Y-m-d H:i:s')) . rand(0000, 9999);
        $sub_merchant_id = 'ORS' . strtotime(date('Y-m-d H:i:s')) . rand(0000, 9999);

        //$hash_sequence = "key|merchant_txn|name|email|phone|amount|udf1|udf2|udf3|udf4|udf5|message|salt";

        // $amount=(int)$request->amount;
        // $amount = '1.0';

        $MERCHANT_KEY = 'VPGJ1ZK4UZ';
        $SALT_KEY = 'BBTX2XUUMH';

        // $hash_sequence = $MERCHANT_KEY . "|$merchant_txn|$userloggedData->name|$userloggedData->email|$userloggedData->mobile|$amount||||||Enach Api|" . $SALT_KEY;

        // $finalHash = hash('sha512', $hash_sequence);
        // //echo $hash_sequence.'<br>'.$finalHash.'<br>';

        // $reqBody = '{
        //     "merchant_txn": "' . $merchant_txn . '",
        //     "key": "' . $MERCHANT_KEY . '",
        //     "email": "' . $userloggedData->email . '",
        //     "name": "' . $userloggedData->name . '",
        //     "amount": "' . $amount . '",
        //     "phone": "' . $userloggedData->mobile . '",
        //     "udf1": "",
        //     "udf2": "",
        //     "udf3": "",
        //     "udf4": "",
        //     "udf5": "",
        //     "message": "Enach Api",
        //     "expiry_date": "25-08-2023",
        //     "sub_merchant_id": "' . $sub_merchant_id . '",
        //     "is_auto_debit_link":true,
        //     "is_auto_debit_seamless":true,
        //     "auth_details": {
        //       "max_debit_amount": 11,
        //       "auto_debit_type": "ENACH",
        //       "final_collection_date": "17-08-2023",
        //       "holder_account_number": "' . $userBankDtl->accountNumber . '",
        //       "holder_account_type": "' . $userBankDtl->accountType . '",
        //       "holder_bank_ifsc": "' . $userBankDtl->ifscCode . '",
        //       "auth_mode": "NetBanking"
        //     },
        //     "operation": [
        //       {
        //         "type": "sms",
        //         "template": "Default sms template"
        //       },
        //       {
        //         "type": "email",
        //         "template": "Default email template"
        //       },
        //       {
        //         "type": "whatsapp",
        //         "template": "Default whatsapp template"
        //       }
        //     ],
        //     "hash": "' . $finalHash . '"
        //   }';

        // //echo $reqBody; exit;
        // $curl = curl_init();

        // curl_setopt_array($curl, [
        //     CURLOPT_URL => "https://dashboard.easebuzz.in/easycollect/v1/create",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => $reqBody,
        //     CURLOPT_HTTPHEADER => [
        //         "Content-Type: application/json"
        //     ],
        // ]);

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);

        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     echo $response;
        // }




        $client = new Client();

        $response = $client->post('https://stoplight.io/mocks/easebuzz/payment-gateway/157238993/payment/initiateDirectDebitRequest/', [
            'headers' => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'key' => "VPGJ1ZK4UZ",
                'txnid' => 'asdasdasd',
                'amount' => 10,
                'productinfo' => 'asdasd',
                'firstname' => 'asdads',
                'phone' => '9871802071',
                'email' => 'basant@gmail.com',
                'surl' => 'https://maxemocapital.com/maxemolms/web',
                'furl' => 'https://maxemocapital.com/maxemolms/web',
                'hash' => '',
                'udf1' => '',
                'udf2' => '',
                'udf3' => '',
                'udf4' => '',
                'udf5' => '',
                'udf6' => '',
                'udf7' => '',
                'udf8' => '',
                'udf9' => '',
                'udf10' => '',
                'address1' => 'asdasd',
                'address2' => 'asdasd',
                'city' => 'asdads',
                'state' => 'asdasd',
                'country' => 'asdasd',
                'zipcode' => '121212',
                'customer_authentication_id' => '',
                'merchant_debit_id' => '',
                'auto_debit_access_key' => '',
                'sub_merchant_id' => ''
            ]
        ]);
        $content = json_decode($response->getBody()->getContents());
        dd($content);
    }
}
