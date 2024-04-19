<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\LoanEmiDetail;
use App\Models\User;
use App\Models\UserBankDetail;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EaseBuzzApiController extends Controller
{

    protected $MERCHANT_KEY = 'VPGJ1ZK4UZ';
    protected $SALT_KEY = 'BBTX2XUUMH';
    protected $webhookUrl = 'http://maxemocapital.co.in/api/enash-failed';


    public function isUserLoggedIn()
    {
        if (!empty(auth()->user())) {
            if (auth()->user()->userType == 'user') {
                $users = User::where('id',auth()->user()->id)->first();
                return $users;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function enachEMIFirstApi($loanEmiID)
    {
        try {
            $loanEmiDetail = LoanEmiDetail::where('id', $loanEmiID)->first();
            $userId = $loanEmiDetail->userId;
            $userloggedData = User::whereId($userId)->first();
            $userBankDtl = UserBankDetail::where('userId', $userId)->orderBy('id', 'desc')->first();

            $merchant_txn = 'OR' . strtotime(date('Y-m-d H:i:s')) . rand(0000, 9999);
            $sub_merchant_id = 'ORS' . strtotime(date('Y-m-d H:i:s')) . rand(0000, 9999);

            $lateCharges = 0.0;
            $loanAmount = (int)$loanEmiDetail->netemiAmount;
            $max_amount = $loanAmount + $lateCharges;
            $amount = '1.0';

            $emilID = Crypt::encryptString($loanEmiID);

            $hash_sequence = $this->MERCHANT_KEY . "|$merchant_txn|$userloggedData->name|$userloggedData->email|$userloggedData->mobile|$amount|$emilID|$lateCharges|$loanAmount|||Enach Api|" . $this->SALT_KEY;

            $finalHash = hash('sha512', $hash_sequence);
            $final_collection_date = date("d-m-Y", strtotime("+1 day"));
            $expiry_date = date("d-m-Y", strtotime("+1 month"));

            $reqBody = '{
                "merchant_txn": "' . $merchant_txn . '",
                "key": "VPGJ1ZK4UZ",
                "email":"' . $userloggedData->email . '",
                "name":"' . $userloggedData->name . '",
                "amount":"1.0",
                "phone":"' . $userloggedData->mobile . '",
                "udf1":"' . $emilID . '",
                "udf2":"' . $lateCharges . '",
                "udf3":"' . $loanAmount . '",
                "udf4":"",
                "udf5":"",
                "surl":"' . $this->webhookUrl . '",
                "furl":"' . $this->webhookUrl . '",
                "message":"Enach Api",
                "expiry_date": "' . $expiry_date . '",
                "is_auto_debit_link": true,
                "hash": "' . $finalHash . '",
                "auth_details": {
                    "max_debit_amount": ' . $max_amount . ',
                    "auto_debit_type": "ENACH",
                    "final_collection_date": "' . $final_collection_date . '",
                    "holder_account_number": "' . $userBankDtl->accountNumber . '",
                    "holder_account_type": "' . strtoupper($userBankDtl->accountType) . '",
                    "holder_bank_ifsc": "' . strtoupper($userBankDtl->ifscCode) . '",
                    "auth_mode": "NetBanking"
                },
                "operation": [
                    {
                    "type": "sms",
                    "template": "Default sms template"
                    },
                    {
                    "type": "email",
                    "template": "Default email template"
                    },
                    {
                    "type": "whatsapp",
                    "template": "Default whatsapp template"
                    }
                ]
            }';

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://dashboard.easebuzz.in/easycollect/v1/create",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $reqBody,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return false;
            } else {
                $outdata = json_decode($response, true);
                return $outdata['data']['payment_url'] ?? false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function easyCollectionLink($loanEmiID)
    {

        try {

            $client = new Client();
            
            $loanEmiDetail = LoanEmiDetail::where('id', $loanEmiID)->first();
            $userId = $loanEmiDetail->userId;
            $userloggedData = User::whereId($userId)->first();

            $merchant_txn = 'OR' . strtotime(date('Y-m-d H:i:s')) . rand(0000, 9999);

            $lateCharges = 0.0;
            $loanAmount = (int)$loanEmiDetail->netemiAmount;
            $max_amount = $loanAmount + $lateCharges;
            $amount = '1.0';

            $emilID = Crypt::encryptString($loanEmiID);

            $hash_sequence = $this->MERCHANT_KEY . "|$merchant_txn|$userloggedData->name|$userloggedData->email|$userloggedData->mobile|$max_amount|$emilID|$lateCharges|$loanAmount||$max_amount|Loan Maxemos|" . $this->SALT_KEY;

            $finalHash = hash('sha512', $hash_sequence);
            $expiry_date = date("d-m-Y", strtotime("+1 month"));

            $reqBody = '{
                "merchant_txn":"'.$merchant_txn.'",
                "key":"'.$this->MERCHANT_KEY.'",
                "email":"'.$userloggedData->email.'",
                "name" :"'.$userloggedData->name.'",
                "amount" :"'.$max_amount.'",
                "phone" :"'.$userloggedData->mobile.'",
                "udf1":"'.$emilID.'",
                "udf2":"'.$lateCharges.'",
                "udf3":"'.$loanAmount.'",
                "udf4":"",
                "udf5" :"'.$max_amount.'",
                "message" :"Loan Maxemos",
                "hash":"'.$finalHash.'",
                "expiry_date":"'.$expiry_date.'",
                "operation": [
                    {
                    "type": "sms",
                    "template": "Default sms template"
                    },
                    {
                    "type": "email",
                    "template": "Default email template"
                    },
                    {
                    "type": "whatsapp",
                    "template": "Default whatsapp template"
                    }
                ]
            }';
            

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://dashboard.easebuzz.in/easycollect/v1/create",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $reqBody,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            if ($err) {
                return false;
            } else {
                $outdata = json_decode($response, true);
                return $outdata['data']['payment_url'] ?? false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
