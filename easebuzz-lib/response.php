<?php
function updateTransactionHistory($loanId,$collectionAmount,$payment_modeCredit,$transactionIdCredit,$collectionDate)
{
    $params="loanId=".$loanId."&&debitRecordId=0&&collectionAmount=".urlencode($collectionAmount)."&&payment_modeCredit=".urlencode($payment_modeCredit)."&&transactionIdCredit=".$transactionIdCredit."&&collectionDate=".urlencode($collectionDate);
    
    $url=BASE_URL."sattle-raw-material-txn-auto-custom-curl?".$params;

    //  Initiate curl
    $ch = curl_init();

    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);

    // Execute
    $response=curl_exec($ch);
    
    $errors=curl_error($ch);
    
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    // Closing
    curl_close($ch);

    if (empty($response)){
        return $httpcode;
    }else{
        return json_decode($response);
    }
}

function sendSms($mobileNumber,$textMessage)
{
    $senderId='MAXEMO';
    //$textMessage= urlencode($textMessage);
    $textMessage= urlencode($textMessage);
    $url="http://125.16.147.178/VoicenSMS/webresources/CreateSMSCampaignGet?ukey=9LFUsDnRk5KwlLM0Zv0AZU5V9&msisdn=".$mobileNumber."&language=0&credittype=7&senderid=".$senderId."&templateid=0&message=".$textMessage."&filetype=2";

    $curl_handle=curl_init();
    curl_setopt($curl_handle,CURLOPT_URL,$url);

    curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
    curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
    $response = curl_exec($curl_handle);

    $errors=curl_error($curl_handle);
    $httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
    curl_close($curl_handle);
    if (empty($response)){
        return $httpcode;
    }else{
        return json_decode($response);
    }
}
    
?>
<?php
    // include file
    include_once('./config.php');
    include_once('easebuzz_payment_gateway.php');

    // salt for testing env
    $SALT = SALT;
    $today=date('Y-m-d H:i:s');
    
    $easebuzzObj = new Easebuzz($MERCHANT_KEY = null, $SALT, $ENV = null);
    
    $result = $easebuzzObj->easebuzzResponse( $_POST );
    $response=json_decode($result);
    //echo '<pre>'; print_r($response); exit;
    
    $paymentStatus='failed';
    $transactionIdCredit='';
    $paymentSuccess=0;
    if(isset($response->status))
    {
        if($response->status==1)
        {
            if(isset($response->data->status))
            {
                if($response->data->status=='success')
                {
                    $paymentStatus='success';
                    $collectionAmount=$response->data->amount;
                    $transactionDate=date('Y-m-d',strtotime($response->data->addedon));
                    $payment_modeCredit='Online '.$response->data->card_type;
                    $transactionIdCredit=$response->data->easepayid;
                    $loanId=$response->data->udf1;
                    $userId=$response->data->udf2;
                    $orderId=$response->data->txnid;
                    $paymentSuccess=1;
                    
                    $sqlQryU="SELECT * FROM users where id='$userId'";
                    $runU=mysqli_query($conn,$sqlQryU);
                    $rowCountU=mysqli_num_rows($runU);
                    if($rowCountU)
                    {
                        $row= mysqli_fetch_assoc($runU);
                        $mobileNumber=$row['mobile'];
//                        echo $mobileNumber;exit;
                        $textMessage='Dear Customer, Payment of Rs. '.$collectionAmount.' has been received towards your loan ID '.LOANID_PRE.$loanId.' on '.date('d m, Y',strtotime($transactionDate)).', Thank you- Team Maxemo';
                        sendSms($mobileNumber,$textMessage);
                    }
                    
                    $sqlQryChk="SELECT * FROM pg_transaction_histories where userId='$userId' AND loanId='$loanId' AND orderId='$orderId' AND paymentStatus='pending'";
                    $run=mysqli_query($conn,$sqlQryChk);
                    $rowCount=mysqli_num_rows($run);
                    //echo $rowCount;exit;
                    if($rowCount==1){
                        $resCurl=updateTransactionHistory($loanId,$collectionAmount,$payment_modeCredit,$transactionIdCredit,$transactionDate);
                    }
                    
                    
                    
                    //echo 'H'; echo '<pre>';print_r($resCurl); exit;
                }
            }
        }
    }
    
    $sqlQry="UPDATE pg_transaction_histories set txnId='$transactionIdCredit',paymentStatus='$paymentStatus',responseData='$result',updated_at='$today' where userId='$userId' AND loanId='$loanId' AND orderId='$orderId'";
    mysqli_query($conn,$sqlQry);
//    echo '<pre>';print_r(json_decode($result));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MAXEMO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body> 
 
<div class="container">
    <center>
        <br>
        <div class="card">
          <div class="card-body">
              <?php if($paymentSuccess==1){ ?>
              <center><h2>Transaction Success</h2>
                  <img src="https://www.architecturaldigest.in/wp-content/themes/cntraveller/images/check-circle.gif" style="height: 200px;" />
                  <br>
                  Dear <?php echo $response->data->firstname ?>,<br> Your transaction has been success of <?=$response->data->amount?>.<br>
                  <b>Transaction Id : <?=$response->data->easepayid?></b><br>
                  <b>Amount : <?=$response->data->amount?></b><br>
                  <a href="<?php echo BASE_URL.'user/dashboard' ?>" style="cursor: pointer;color: blue;">Go to dashboard Click Here</a>
              </center>
              <?php }else{ ?>
              <center><h2>Transaction Failed</h2>
                  <img src="http://craftizen.org/wp-content/uploads/2019/02/global_hint_failure_595796.png" style="height: 200px;" />
                  <br>
                  Dear User,<br> Your transaction has been failed, Please try again.<br>
                  <a href="<?php echo BASE_URL.'user/dashboard' ?>" style="cursor: pointer;color: blue;">Go to dashboard Click Here</a>
              </center>
              <?php } ?> 
          </div>
        </div>
    </center>
</div>

</body>
</html>


