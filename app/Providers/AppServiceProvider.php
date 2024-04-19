<?php

namespace App\Providers;

use App\Models\CreditScoreQuestion;
use App\Models\CreditScoreQuestionAnswer;
use App\Models\CreditScoreUsersAnswer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use DB;
use Storage;
use Illuminate\Support\Facades\Mail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    public static function uploadImageCustom($fileInput,$folderName)
    {
        $destination=$folderName;
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        if ($_FILES[$fileInput]["size"] > 0) {
            //$filename = time().str_replace([" ","(",")","-"], "_", basename($_FILES[$fileInput]["name"]));
            $extension = pathinfo($_FILES[$fileInput]["name"], PATHINFO_EXTENSION);
            $filename=strtotime(date('Y-m-d H:i:s')).rand(00000,99999).'.'.$extension;
            $tempname = $_FILES[$fileInput]["tmp_name"];
            $target_file = $destination . '/'.$filename;
            if (is_uploaded_file($tempname)) {
                Storage::disk('public_upload')->put('public/'.$folderName.'/'.$filename,file_get_contents($tempname));
                return $folderName.'/'.$filename;
            }else{
                return false;
            }
            // if (move_uploaded_file($tempname, $target_file)) {
                // return $folderName.'/'.$filename;
            // }else{
            //     return false;
            // }
        }
    }

    public static function uploadImageCustomMulti($fileInput,$folderName)
    {
        
        $destination=public_path().'/'.$folderName;
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $uploadedFiles=[];
        $fileNames = array_filter($_FILES[$fileInput]['name']);
        if(!empty($fileNames))
        {
            foreach($_FILES[$fileInput]['name'] as $key=>$val){
                if ($_FILES[$fileInput]["size"][$key] > 0) {
                   // $filename = time().str_replace([" ","(",")","-"], "_", basename($_FILES[$fileInput]["name"][$key]));
                   $extension = pathinfo($_FILES[$fileInput]["name"][$key], PATHINFO_EXTENSION);
                   $filename=strtotime(date('Y-m-d H:i:s')).rand(00000,99999).'.'.$extension;
                    $tempname = $_FILES[$fileInput]["tmp_name"][$key];
                    $target_file = $destination . '/'.$filename;
                    if (is_uploaded_file($tempname)) {
                        Storage::disk('public_upload')->put('public/'.$folderName.'/'.$filename,file_get_contents($tempname));
                        $uploadedFiles[]= $folderName.'/'.$filename;
                    }else{
                        return false;
                    }
                }
            }
        }
        return $uploadedFiles;
    }

    public static function sendMail_old($toMail,$toUser,$subject,$body)
    {

        $bodyHtml=AppServiceProvider::htmlTemplet($body);

        // AppServiceProvider::sendEmailSendGrid($toMail,$toUser,$subject,$bodyHtml);

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom('sales@maxemocapital.com', 'maxemocapital');
        $email->setSubject($subject);
        $fromMail=env('SEND_GRID_FROM_EMAIL');
        $email->addTo("$toMail", $toUser);

        
            $email->addContent(
                "text/html", "$bodyHtml"
            );
        

        $sendgrid = new \SendGrid(env('SAND_GRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            return 1;
            /* echo '<pre>';
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";exit;
            */


        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
        /*
        $SUPPORT_EMAIL = env('SUPPORT_EMAIL');

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <'.$SUPPORT_EMAIL.'>' . "\r\n";

        @mail($toMail,$subject,$bodyHtml,$headers);
        */
    }
    
    public static function sendMail($toMail,$toUser,$subject,$body)
    {

        $bodyHtml=AppServiceProvider::htmlTemplet($body);
        $Usermail=[[
            'name' => $toUser??'',
            'email' => $toMail
            ]];
        $subject = $subject;
        
        $mailData['mail'] = $Usermail;
        $mailData['body'] = $body;

        // dd($Usermail);
    
        try {
            
            Mail::send([], [], function ($message) use ($mailData, $subject) {
                $message->to($mailData['mail'])
                        ->from('sales@maxemocapital.com', 'Maxemocapital')
                        ->subject($subject)
                        ->html($mailData['body']); // Set the body as HTML using the html() method
            });
            
            return 1;


        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public static function sendEmailSendGrid_old($toemail,$touser,$subject,$message,$html=1){
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom(env('SEND_GRID_FROM_EMAIL'), env('SEND_GRID_FROM_NAME'));
        $email->setSubject($subject);
        
        if(is_array($toemail)){
            $fromMail=env('SEND_GRID_FROM_EMAIL');
            $bcsr=0;
            $email->addTo("$fromMail", $touser);
            foreach($toemail as $emailu) {
                $email->addBcc("$emailu", $touser);
                $bcsr++;
            }
        }else{
            $email->addTo("$toemail", $touser);
        }


        if($html)
        {
            $email->addContent(
                "text/html", "$message"
            );
        }else{
            $email->addContent("text/plain", "$message");
        }

        $sendgrid = new \SendGrid(env('SAND_GRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            return 1;
            /* echo '<pre>';
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";exit;
            */


        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
    
    public static function sendEmailSendGrid($toemail,$touser,$subject,$message,$html=1){
        $mailData = [];
        $mailData['from']=['email'=>'sales@maxemocapital.com', 'name'=>'Maxemocapital'];
        $mailData['subject'] = $subject;
        $mailData['body'] = $message;
        
        
        if(is_array($toemail)){
            $Usermail=[[
                'name' => $touser??'',
                'email' => $fromMail
            ]];
            foreach($toemail as $emailu) {
                $mailData['cc'][] = ['email'=>$emailu,'name'=>$touser];
            }
        }else{
            $Usermail=[[
                'name' => $touser??'',
                'email' => $toemail
            ]];
        }
        
        $mailData['to'] = $Usermail;
        
        
        try {
            Mail::send([], [], function ($message) use ($mailData) {
                $message->to($mailData['to'])
                        ->cc($mailData['cc'])
                        ->from($mailData['from']) // Add the "from" email address
                        ->subject($mailData['subject'])
                        ->html($mailData['body']);
            });
            return 1;
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public static function htmlTemplet($mailContent)
    {
        $htmlStr ='<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>'.env('APP_NAME').'</title>

                <script src="https://kit.fontawesome.com/66aa7c98b3.js" crossorigin="anonymous"></script>


                <style>
                    @import url(https://fonts.googleapis.com/css?family=Roboto:400,700,400italic,700italic&subset=latin,cyrillic);

            tr, th, td{
            margin-top:16px !important;
            }

            .wrapper {
                display: table;
                table-layout: fixed;
                width: 100%;
                min-width: 620px;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }

            .social-menu ul{

                padding: 0;
                margin: 0;
                display: flex;
                margin-top: 20px;
                justify-content: right;
            }

            .social-menu ul li{
                list-style: none;
                margin: 0 6px;
            }

            .social-menu ul li .fab{
                font-size: 13px;
                line-height: 30px;
                transition: .3s;
                color: #000;
            }

            .social-menu ul li .fab:hover{
                color: #fff;
            }

            .social-menu ul li a{
                position: relative;
            display: block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #fff;
            text-align: center;
            transition: .6s;
            box-shadow: 0 5px 4px rgba(0,0,0,.5);
            }

            .social-menu ul li a:hover{
                transform: translate(0, -10%);
            }

            .social-menu ul li:nth-child(1) a:hover{
                background-color: rgba(5, 181, 224, 0.829);
            }
            .social-menu ul li:nth-child(2) a:hover{
                background-color: #E4405F;
            }
            .social-menu ul li:nth-child(3) a:hover{
                background-color: #0077b5;
            }
            .social-menu ul li:nth-child(4) a:hover{
                background-color: #000;
            }

            body, .wrapper {
                background-color: #ffffff;
            }

            /* Basic */
            table {
                border-collapse: collapse;
                border-spacing: 0;
            }
            table.center {
                margin: 0 auto;
                width: 602px;
            }
            td {
                padding: 0;
                vertical-align: top;
            }

            .spacer,
            .border {
                font-size: 1px;
                line-height: 1px;
            }
            .spacer {
                width: 100%;
                line-height: 16px
            }
            .border {
                background-color: #e0e0e0;
                width: 1px;
            }

            .padded {
                padding: 0 24px;
            }
            img {
                border: 0;
                -ms-interpolation-mode: bicubic;
            }
            .image {
                font-size: 12px;
            }
            .image img {
                display: block;
            }
            strong, .strong {
                font-weight: 700;
            }
            h1,
            h2,
            h3,
            ol,
            ul,
            li {
                margin-top: 0;
            }
            ol,
            ul,
            li {
                padding-left: 0;
            }

            a {
                text-decoration: none;
                color: #616161;
            }
            .btn {
                background-color: #F3614A;
                border:1px solid #F3614A;
                border-radius:2px;
                color:#ffffff;
                display:inline-block;
                font-family:Roboto, Helvetica, sans-serif;
                font-size:14px;
                font-weight:400;
                line-height:36px;
                text-align:center;
                text-decoration:none;
                text-transform:uppercase;
                width:200px;
                height: 36px;
                padding: 0 8px;
                margin: 0;
                outline: 0;
                outline-offset: 0;
                -webkit-text-size-adjust:none;
                mso-hide:all;
            }

            /* Top panel */
            .title {
                text-align: left;
            }

            .subject {
                text-align: right;
            }

            .title, .subject {
                width: 300px;
                padding: 8px 0;
                color: #616161;
                font-family: Roboto, Helvetica, sans-serif;
                font-weight: 400;
                font-size: 12px;
                line-height: 14px;
            }

            /* Header */
            .logo {
                padding: 16px 0;
            }

            /* Main */
            .main {
                -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12), 0 1px 2px 0 rgba(0, 0, 0, 0.24);
                -moz-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12), 0 1px 2px 0 rgba(0, 0, 0, 0.24);
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12), 0 1px 2px 0 rgba(0, 0, 0, 0.24);
            }

            /* Content */
            .columns {
                margin: 0 auto;
                width: 600px;
                background-color: #ffffff;
                font-size: 14px;
            }

            .column {
                text-align: left;
                background-color: #ffffff;
                font-size: 14px;
            }

            .column-top {
                font-size: 24px;
                line-height: 24px;
            }

            .content {
                width: 100%;
            }

            .column-bottom {
                font-size: 8px;
                line-height: 8px;
            }

            .content h1 {
                margin-top: 0;
                margin-bottom: 16px;
                color: #212121;
                font-family: Roboto, Helvetica, sans-serif;
                font-weight: 400;
                font-size: 20px;
                line-height: 28px;
            }

            .content p {
                margin-top: 0;
            margin-bottom: 16px;
            color: #131842;
            font-family: Roboto, Helvetica, sans-serif;
            font-weight: bold;
            line-height: 24px;
            }
            .content .caption {
                color: #616161;
                font-size: 12px;
                line-height: 20px;
            }

            /* Footer */
            .signature, .subscription {
                vertical-align: middle;
                width: 300px;
                padding-top: 8px;
                margin-bottom: 16px;
            }

            .subscription {
                text-align: right;
            }

            @media only screen and (min-width: 0) {
                .wrapper {
                    text-rendering: optimizeLegibility;
                }
            }
            @media only screen and (max-width: 620px) {
                [class=wrapper] {
                    min-width: 302px !important;
                    width: 100% !important;
                }
                [class=wrapper] .block {
                    display: block !important;
                }
                [class=wrapper] .hide {
                    display: none !important;
                }

                [class=wrapper] .top-panel,
                [class=wrapper] .header,
                [class=wrapper] .main,
                [class=wrapper] .footer {
                    width: 302px !important;
                }

                [class=wrapper] .title,
                [class=wrapper] .subject,
                [class=wrapper] .signature,
                [class=wrapper] .subscription {
                    display: block;
                    float: left;
                    width: 300px !important;
                    text-align: center !important;
                }

                [class=wrapper] .subscription {
                    padding-top: 0 !important;
                }

                .title_header{
                    width: calc(850px - 40px )
                }
            }

            @media (max-width:767px){
                .user_details .text_mdleft{
                    padding: 0px !important;
            font-size: 14px !important;
            text-align: left !important;
                }
                .user_details .text_mdright{
                    padding: 0px !important;
            font-size: 14px !important;
            text-align: right !important;
                }

                .user_details_right .text_mdleft{
                    padding: 0px !important;
            font-size: 14px !important;
            text-align: left !important;
                }

                .user_details_right .text_mdright{
                    padding: 0px !important;
            font-size: 14px !important;
            text-align: right !important;
                }

                .title_header{
                    line-height: 27px;
                }

                .social-menu ul {
              justify-content: center;
            }
            [class="wrapper"] .block {
              display: inline-block !important
            }
            .subscription{
                margin-bottom: 0px !important;
                padding-bottom: 0px !important;
            }

            .middle_cont td p{
                padding: 0px 20px !important;
            }

            .middle_cont td h3{
                padding: 0px 20px !important;
            }

            [class="wrapper"] .signature {
              padding-bottom: 20 !important;
              padding-top: 20px !important;
            }
            .main.center{
                width: 100% !important;
            }
            .footer.center{
                width: 100%  !important;
                margin: 0px !important;
            }

            }
                </style>


            </head>
            <body>


                <div class="wrapper">
                    <table class="top-panel center"  border="0" cellspacing="0" cellpadding="0" style="width:850px;">
                        <tbody>
                        <tr>
                            <td class="title title_header" style="padding: 32px;background: #F3614A;text-align: center;font-size: 18px;color: #fff;">Welcome to '.env('APP_NAME').'</td>

                        </tr>



                        </tbody>
                    </table>

                    <table class="main center" style="width:850px;"  border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td class="column">
                                <div class="column-top">&nbsp;</div>
                                <table class="content" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>

                                        <tr>
                                            <td valign="top" align="center">
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                    <tbody>
                                                        <tr>
                                                          <td valign="top" align="center">
                                                              <img class="em_img" alt="" style="display:block;font-family:Arial, sans-serif;font-size:30px;line-height:34px;color:#000000;width: 200px;height: 90px;  margin-bottom: 20px;object-fit:contain;" src="'.asset('assets/admin/images/logos/maxemo-logo.png').'"  border="0">
                                                          </td>
                                                        </tr>
                                                  </tbody>
                                              </table>
                                          </td>
                                      </tr>
                                    <tr>
                                        <td class="padded" >
                                         '.$mailContent.'
                                        </td>
                                    </tr>

                                    <tr class="middle_cont" style="background: url('.asset('assets/mail-img').'/bg2.jpg);
                                    height:300px; position: relative;background-size: cover;background-repeat: no-repeat;">
                                        <td style="position:absolute;
                                        top:50%; left:50%; transform:translate(-50%,-50%); width: 100%; text-align: center;">';
                                            //$htmlStr .='<p style="text-align:center; font-weight: bold; font-size: 26px; margin-bottom: 30px !important;"> A Big Culinary Salute ! </p>';

                                            //$htmlStr .='<h3 style="text-align:center; font-weight: 500; font-size: 16px; color:#1e1e1e; margin-bottom: 9px !important;">Your '.env('APP_NAME').' management account is all set up and ready to go</h3>';

                                              $htmlStr .='<h3 style="text-align:center; font-weight: bold; font-size: 18px; color:#131313;">if you ever need any help in using your '.env('APP_NAME').' account, You Can Email us at</h3>

                                              <a href="mailto:'.env('SUPPORT_EMAIL').'"><h3 style="text-align:center; font-weight: bold; font-size: 18px; color:#123a8b;">'.env('SUPPORT_EMAIL').'</h3></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>';
        $htmlStr .='<table class="footer center" border="0" cellspacing="0" cellpadding="0" style="width:850px;">
                        <tbody>
                        <tr style="background: #F3614A;">
                            <td class="signature" width="300" style="padding: 12px 20px;">

                                <p style="line-height:24px !important; color:#fff; font-size: 14px;margin-bottom: 0px !important;margin-top: 0px !important;">
                    Support: <a class="strong" style="line-height:0px !important ; color:#e0f3fc; font-size: 14px;" href="mailto:#" target="_blank">'.env('SUPPORT_EMAIL').'</a>
                                </p>
                                <p style="line-height:26px !important ; color:#fff; font-size: 14px; margin-bottom: 0px !important;margin-top: 10px !important;">
                    Copyright &copy; '.date('Y').' '.env('APP_NAME').'. All Rights<br>
                                    </p>
                            </td>
                            <td class="subscription" width="300" style="padding: 12px 20px; position: relative;">
                                <!--<div class="social-menu">
                                    <ul>
                                        <li><a href="https://facebook.com/" target="blank"><i class="fab fa-facebook"></i></i></a></li>
                                        <li><a href="https://www.instagram.com/" target="blank"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://www.linkedin.com/" target="blank"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>-->
                                <!--<p>
                                    <a class="strong block" href="##"  style="line-height:0px !important ; color:#e0f3fc; font-size: 14px;">
                    About Us
                </a>
                                    <span class="hide" style="line-height:0px !important ; color:#e0f3fc; font-size: 14px;">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                    <a class="strong block" href="##"  style="line-height:0px !important ; color:#e0f3fc; font-size: 14px;">
                    Contact Us
                </a>
                                </p>-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </center>


            </body>
            </html>';
        return $htmlStr;
    }

    public static function sendSms($mobileNumber,$textMessage)
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
        $reqData = $mobileNumber.' '.$textMessage;
        DB::table('apihits')->insert(['name'=>'smsapi','type'=>'VoicenSMS','api_url'=>$url,'request_data'=>$reqData,'respont_data'=>json_encode($response),'status'=>1]);
        if (empty($response)){
            return $httpcode;
        }else{
            return json_decode($response);
        }
    }
    
    public static function sendSmsDynamic($mobileNumber,$textMessage)
    {
        $senderId='MAXEMO';
        $textMessage='You have missed your payment on Loan ID for the month of . Your Outstanding amount as on today is Rs. .You can click the link https://pay.easebuzz.in/easy_collect/ to pay your due amount and to avoid late payment charges / bad credit score -Team Maxemo';
        //$textMessage= urlencode($textMessage);
        $textMessage= urlencode($textMessage);
        $url="http://125.16.147.178/VoicenSMS/webresources/CreateSMSCampaignGet?ukey=9LFUsDnRk5KwlLM0Zv0AZU5V9&language=0&credittype=7&senderid=".$senderId."&templateid=0&message=".$textMessage."&filetype=1&msisdnlist=phoneno:9871802071,arg1:test1,arg2:test12,arg3:tesdfsd,arg4:asdasd<>";

        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$url);
        
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($curl_handle);

        $errors=curl_error($curl_handle);
        $httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        curl_close($curl_handle);
        $reqData = $mobileNumber.' '.$textMessage;
        DB::table('apihits')->insert(['name'=>'smsapi','type'=>'VoicenSMS','api_url'=>$url,'request_data'=>$reqData,'respont_data'=>json_encode($response),'status'=>1]);
        if (empty($response)){
            return $httpcode;
        }else{
            dd($response,$errors);
            return json_decode($response);
        }
    }
    
    public static function curlApis($endPoint,$post_data,$method,$json=null)
    {
        $clientId='5892118e93ebb5481b760c989984e1b2'; //Test
        $secretId='340ad81d8ffec6ea6cee89f1e94996fa13cc96538a63029c842583df9e25a98a'; //Test
        $url='https://sm-kyc-sandbox.scoreme.in/'.$endPoint; // test

        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$url);
        if($json){
            curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('ClientId:'.$clientId, 'ClientSecret:'.$secretId,'Content-Type:application/json'));
        }else{
            curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('ClientId:'.$clientId, 'ClientSecret:'.$secretId));
        }


        if($method=='POST')
        {
            curl_setopt($curl_handle, CURLOPT_POST, true);
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
        }
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

    public static function curlApisCashFree($endPoint,$post_data,$method,$headers)
    {

        //print_r($headers);exit;
        $url=env('CASH_FREE_API_URL').$endPoint;

        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$url);

        if($headers){
             curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        }


        if($method=='POST')
        {
            curl_setopt($curl_handle, CURLOPT_POST, true);
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_data);
        }
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($curl_handle);

        $errors=curl_error($curl_handle);
        $httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        curl_close($curl_handle);
        if (empty($response)){
            return $response;
        }else{
            return json_decode($response);
        }
    }

    public static function checkDecodePermissions()
    {
        $userPermissionsArr=[];
        $userPermissions=session()->get('userPermissions');
        if(!empty($userPermissions))
        {
            $userPermissionsArr=json_decode($userPermissions,true);
        }
        return $userPermissionsArr;
    }

    public static function validatePermission($permissionStr)
    {
        $userPermissions=AppServiceProvider::checkDecodePermissions();
        if(!in_array('all',$userPermissions) && !in_array($permissionStr,$userPermissions)){
            echo json_encode(['status'=>'error','message'=>'You dont have permission to access this module.']); exit;
        }else{
            return true;
        }
    }

    public static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public static function checkUserLogin()
    {
//        echo '<pre>'; print_r(auth()->user());exit;
        if(empty(auth()->user()) && empty(session('accessLoginId'))){
            // echo '<script>location.href="'.route('login').'"</script>'; //exit;
        }
    }

    public static function sendPushNotificationAll($token, $title, $body, $noti_type, $message, $channel_name)
    {
        $keys=[];
        $arr['to'] = $token;
        if($noti_type=='chat'){
            $arr['notification'] = array("title"=>$title,"body"=>$body,"mutable_content"=>true,"sound"=>"Tri-tone");
        }else{
            $keys['title'] = $title;
        }


        $keys['message'] = $message;
        $keys['notificationType'] = $noti_type;
        if(!empty($agora_token)){
            $keys['agora_token'] = $agora_token;
        }
        if(!empty($channel_name)){
            $keys['channel_name'] = $channel_name;
        }

        $arr['data'] = $keys;
        // echo 'Push Notification: <pre>';print_r($arr);exit;
        //API URL of FCM
        $url = 'https://fcm.googleapis.com/fcm/send';

        $api_key ='AAAAbjOPzdg:APA91bGxW_uIs0Z8g_2pne7NAuHoWM8vrR7RSmMuAr44Eo1TxFmZyKnJzKXHDFynxTmbISMgmdrCOX0hrX-HMewvUBibrNGI3qhooZgv_LfwVeWhxdcNYGUIegEG5GPElhsfs6fegLmt';

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$api_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr));
        $result = curl_exec($ch);
        //print_r($result);exit;
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);

        return $result;
    }

    public static function getROITypeHeading($roiType){
        $roiTypeLabel='';
        if($roiType=='reducing_roi')
        {
            $roiTypeLabel='Reducing ROI';
        }else if($roiType=='quaterly_interest')
        {
            $roiTypeLabel='Quarterly Interest';
        }else if($roiType=='fixed_interest_roi')
        {
            $roiTypeLabel='Fixed Interest ROI';
        }else if($roiType=='bullet_repayment')
        {
            $roiTypeLabel='Bullet Repayment';
        }
        return $roiTypeLabel;
    }
}
