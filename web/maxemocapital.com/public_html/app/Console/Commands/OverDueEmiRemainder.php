<?php

namespace App\Console\Commands;

use App\Http\Controllers\Payments\EaseBuzzApiController;
use App\Models\LoanEmiDetail;
use App\Providers\AppServiceProvider;
use Illuminate\Console\Command;
use DB;

class OverDueEmiRemainder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'overDueEmiRemainder:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'over due emi remainder description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $currentMonth=date('m');
        $currentYear=date('Y');
        $today = date('Y-m-d');
        
        if(in_array(date('d'),array('13','14','15','16','17','18','20','24','28','30'))){

        $remainderLists=DB::select("SELECT ed.loanId,SUM(ed.netemiAmount) AS netemiAmount,u.customerCode,u.nameTitle,u.name,u.mobile,u.email FROM loan_emi_details ed LEFT JOIN users u ON ed.userId=u.id WHERE date(ed.emiDueDate)<date('$today') AND MONTH(ed.emiDate)<='$currentMonth' AND YEAR(ed.emiDate)<='$currentYear' AND ed.status = 'pending' AND ed.netemiAmount>0 GROUP BY loanId");
        
        if(!empty($remainderLists)){
            foreach($remainderLists as $rlist){
                

                // $EaseBuzzApiController = new EaseBuzzApiController();
                // if($rlist->payment_links){
                //     $paylink_url_old =$rlist->payment_links;
                // }else{
                //     $paylink_url_old = $EaseBuzzApiController->easyCollectionLink($rlist->id);
                // }
                // $paylink_url = str_replace('https://pay.easebuzz.in/easy_collect/','',$paylink_url_old);
                // dd($paylink_url);
                
                $loanid = 'LF0'.$rlist->loanId;
                // $fdate = date('F Y',strtotime($rlist->emiDueDate));
                $amount = $rlist->netemiAmount;
                $mobileNumber = $rlist->mobile;
                // $mobileNumber = '9871802071';
                // $userMail = $rlist->email;
                // $userMail = "basant@techmavesoftware.com";

                $textMessage= 'Dear customer, you have missed your payment of Loan ID #'.$loanid.'. Your Outstanding amount as on today is Rs '.$amount.'. Kindly pay your due amount to avoid late payment charges / bad credit score - Team Maxemo';

                // dd($textMessage);
                $textMessageMail = 'Dear customer, you have missed your payment of Loan ID #'.$loanid.'. Your Outstanding amount as on today is Rs '.$amount.'. Kindly pay your due amount to avoid late payment charges / bad credit score - Team Maxemo <br> <br>';

                // echo $textMessage.'<br>';
                AppServiceProvider::sendMail($userMail,$rlist->name,"EMI Remainder | Maxemo Capital",$textMessageMail);
                // AppServiceProvider::sendMail("basant@techmavesoftware.com",$rlist->name,"EMI Remainder | Maxemo Capital",$textMessageMail);
                $RES=AppServiceProvider::sendSms($mobileNumber, $textMessage);
                // dd($RES);
                if($RES){
                    LoanEmiDetail::where('id',$rlist->id)->update(['reminderSent'=>1,'reminderSentDate'=>$today]);
                }
            }
        }
        }
        return Command::SUCCESS;
    }
}
