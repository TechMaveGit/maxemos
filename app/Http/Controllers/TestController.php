<?php

namespace App\Http\Controllers;

use DateTime;
use DB;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class TestController extends Controller
{

public function index(){

$results = DB::select("SELECT 
    alh.id,
    alh.loanCategory,
    alh.approvedAmount,
    alh.rateOfInterest,
    led.emiId,
    CASE
        WHEN led.status = 'success' AND led.emiAmount != 0 AND led.transactionDate IS NOT NULL
            THEN (
                SELECT MAX(transactionDate)
                FROM loan_emi_details
                WHERE loanId = alh.id AND status = 'success' AND emiAmount != 0 AND transactionDate IS NOT NULL AND DATE(transactionDate) <= '2024-03-31'
            )
        WHEN led.emiAmount = 0 AND led.emiSr = 0 THEN alh.disbursedDate
        ELSE led.emiDate
    END AS t_date,
    c.name AS cname,
    u.customerCode,
    u.name,
    u.mobile,
    u.email,
    CASE
        WHEN led.status = 'success' AND led.emiAmount != 0 AND led.transactionDate IS NOT NULL
            THEN led.balance - COALESCE((SELECT SUM(principle) FROM loan_emi_details WHERE loanId = alh.id AND DATE(emiDate) <= '2024-03-31'), 0)
        ELSE alh.loanAmount - COALESCE((SELECT SUM(principle) FROM loan_emi_details WHERE loanId = alh.id AND DATE(emiDate) <= '2024-03-31'), 0)
    END AS netemiAmount
FROM 
    apply_loan_histories AS alh
    LEFT JOIN (
        SELECT *
        FROM loan_emi_details
        WHERE id IN (
            SELECT MAX(id)
            FROM loan_emi_details
            WHERE status = 'success' AND transactionDate IS NOT NULL
            GROUP BY loanId
        )
    ) AS led ON led.loanId = alh.id
    LEFT JOIN users AS u ON u.id = alh.userId
    LEFT JOIN categories AS c ON c.id = alh.loanCategory
WHERE 
    alh.loanCategory = 8
    AND (
        DATE(alh.disbursedDate) <= '2024-03-31'
        OR (
            led.id IS NOT NULL
            AND DATE(led.transactionDate) <= '2024-03-31'
            AND DATE(led.emiDate) <= '2024-03-31'
            AND (
                (led.status = 'success' AND led.emiAmount != 0 AND led.transactionDate IS NOT NULL)
                OR (
                    alh.loanAmount - COALESCE((SELECT SUM(principle) FROM loan_emi_details WHERE loanId = alh.id AND DATE(emiDate) <= '2024-03-31'), 0) > 0
                )
            )
        )
    )
HAVING
    netemiAmount != 0
ORDER BY 
    alh.id DESC;");
dd($results);
        return $customerRes[0]->customerCode.'----'.$customerCode;

}

    public function eashInhert(){
        $client = new Client();
        try{
           
            $key ="VPGJ1ZK4UZ";
            $salt = "BBTX2XUUMH";

            $txnId = time();
            $hash_sequence = $key.'|'.$txnId.'|1|maxemos|basant|sbasant12345@gmail.com|||||6||||||'.$salt;
       
            $finalHash = hash('sha512', $hash_sequence);

            $final_collection_date = date("d/m/Y", strtotime("+2 day"));
            $expiry_date = date("d-m-Y", strtotime("+1 month"));

            $response = $client->request('POST', 'https://pay.easebuzz.in/payment/initiateLink', [
              'form_params' => [
                'key' => $key,
                'txnid' => $txnId,
                'amount' => 1,
                'productinfo' => 'maxemos',
                'firstname' => 'basant',
                'phone' => '+91-9871802071',
                'email' => 'sbasant12345@gmail.com',
                'surl' => 'http://maxemocapital.co.in/enash-success',
                'furl' => 'http://maxemocapital.co.in/enash-failed',
                'hash' => $finalHash,
                'udf1' => '',
                'udf2' => '',
                'udf3' => '',
                'udf4' => '',
                'udf5' => 6,
                'udf6' => '',
                'udf7' => '',
                'udf8' => '',
                'udf9' => '',
                'udf10' => '',
                'address1' => '123 xyz colony',
                'address2' => '',
                'city' => 'Delhi',
                'state' => 'Delhi',
                'country' => 'INDIA',
                'zipcode' => '208301',
                'customer_authentication_id' => md5('a'),
                'show_payment_mode' => 'EN',
                'sub_merchant_id' => '',
                'request_flow' => 'SEAMLESS',
                'final_collection_date' => $final_collection_date
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            ]);
    
            dd(json_decode($response->getBody(),true));
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }


    public function autoDebitAuth(){
        $client = new Client();
        try{
            // $key ="2PBP7IABZ2";
            // $salt = "DAH88E3UWQ";
            $key ="VPGJ1ZK4UZ";
            $salt = "BBTX2XUUMH";

            $response = $client->request('POST', 'https://pay.easebuzz.in/initiate_seamless_payment/', [
            'form_params' => [
                'access_key' => 'd4166b426ee19a5f177f6b49142372837cea88310932cafa90a0e28dc1c5354d',
                'payment_mode' => 'EN',
                'ifsc' => 'ICIC0001794',
                'account_type' => 'SAVINGS',
                'account_no' => '179401001658',
                'auth_mode' => 'NetBanking',
                'bank_code' => 'ICICIB'
            ],
            'headers' => [
              'Accept' => 'application/json',
              'Content-Type' => 'application/x-www-form-urlencoded',
            ],
          ]);

        }catch(Exception $e){
            dd($e->getMessage());
        }
          dd($response);
          dd(json_decode($response->getBody(),true));
    }

    public function eashautoPay(){
        // 462caf28cd167f14854676fedaefe48fa52aa6931d1c69d3d7e3f7e7854cb4e7

        $client = new Client();
        try{
            // $key ="2PBP7IABZ2";
            // $salt = "DAH88E3UWQ";

            $key ="VPGJ1ZK4UZ";
            $salt = "BBTX2XUUMH";

            $hash_sequence = $key.'|DSFET342G|1|maxemos|basant|basant@techmavesoftware.com|||||||||||'.$salt;
       
            $finalHash = hash('sha512', $hash_sequence);
            $final_collection_date = date("d-m-Y", strtotime("+1 day"));
            $expiry_date = date("d-m-Y", strtotime("+1 month"));

            $response = $client->request('POST', 'https://pay.easebuzz.in/payment/initiateDirectDebitRequest/', [
              'form_params' => [
                'key' => $key,
                'txnid' => '1233wfwe423',
                'amount' => 1,
                'productinfo' => 'maxemos',
                'firstname' => 'basant',
                'phone' => '9871802071',
                'email' => 'basant@techmavesoftware.com',
                'surl' => 'http://maxemocapital.co.in/maxemolms/enash-success',
                'furl' => 'http://maxemocapital.co.in/maxemolms/enash-failed',
                'hash' => $finalHash,
                'udf1' => '',
                'udf2' => '',
                'udf3' => '',
                'udf4' => '',
                'udf5' => '',
                'address1' => '123 xyz colony',
                'address2' => '',
                'city' => 'Delhi',
                'state' => 'Delhi',
                'country' => 'INDIA',
                'zipcode' => '208301',
                'customer_authentication_id'=>'77',
                'merchant_debit_id'=>"SDSDF234FG",
                'auto_debit_access_key'=>'462caf28cd167f14854676fedaefe48fa52aa6931d1c69d3d7e3f7e7854cb4e7'
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            ]);
    
            dd(json_decode($response->getBody(),true));
        }catch(Exception $e){
            dd($e);
        }
    }





}