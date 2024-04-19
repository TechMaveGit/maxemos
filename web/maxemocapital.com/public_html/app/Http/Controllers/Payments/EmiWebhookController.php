<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\LoanEmiDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmiWebhookController extends Controller
{
    
    public function easebuzzEmiWebhook(Request $request){
        
        Storage::disk('local')->put('enash-failed-method.txt', $request->method());
        Storage::disk('local')->put('enash-failed'.time().'.txt', $request->getContent());
        Storage::disk('local')->put('enash-failed'.time().'.json', $request->getContent());

        $apidata = urldecode($request->getContent());

        $dataShow = explode('&',$apidata);

        $keyvalue = [];
        foreach($dataShow as $prod){
            $data = explode('=',$prod);
            $keyvalue[$data[0]] = $data[1] ?? '';
        }
    

        try{
        if($keyvalue){
            $loemiid = Crypt::decryptString($keyvalue['udf1']);
            $loandetail = LoanEmiDetail::where(['id'=>$loemiid,'netemiAmount'=>$keyvalue['udf3']])->first();

            if($loandetail){
                DB::table('loan_emidetail_payhistories')->insert(['userId'=>$loandetail->userId,'loanId'=>$loandetail->loanId,'loan_emidetail_id'=>$loemiid,'txnid'=>$keyvalue['txnid'],'amount'=>$keyvalue['udf5'],'pay_link'=>$loandetail->payment_links,'status_msg'=>$keyvalue['error_Message'],'status'=>$keyvalue['status'],'full_response'=>json_encode($keyvalue)]);
            }

            if($keyvalue['status'] == 'success'){
                $lateCharges=($request->emiLateCharges) ? $request->emiLateCharges : 0;
                $transactionDate=date('Y-m-d');
                $emiTxnId=$request->emiTxnId;
            
                LoanEmiDetail::where(['id'=>$loemiid,'netemiAmount'=>$keyvalue['udf3']])->update(['lateCharges'=>$keyvalue['udf2'],'payment_mode'=>$keyvalue['payment_source'],'transactionId'=>$keyvalue['txnid'],'transactionDate'=>$transactionDate,'status'=>'success']);
                return  response()->json([
                    'status' => $keyvalue['status'],
                    'data' => $keyvalue['udf1'],
                    'amount' => $keyvalue['udf5'],
                    'late charges'=>$keyvalue['udf2']
                ]);
            }else{
                return  response()->json([
                    'status' => $keyvalue['status'],
                    'data' => $keyvalue['udf1'],
                    'amount' => $keyvalue['udf5']
                ]);
            }
        }

        return  response()->json([
            'status' => 'failed'
        ]);
    }catch(Exception){
            return  response()->json([
                'status' => 'failed'
            ]);
        }
    }
}
