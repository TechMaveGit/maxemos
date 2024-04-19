<?php

namespace App\Console\Commands;

use App\Models\LoanEmiDetail;
use App\Providers\AppServiceProvider;
use Illuminate\Console\Command;
use DB;

class EmiRemainder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emiRemainder:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'emi remainder description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        
        $currentMonth=date('m');
        $currentYear=date('Y');
        $twoDaysBack = date('Y-m-d',strtotime(date('Y-m-d').' +2 days'));
        $today = date('Y-m-d');
        
        $remainderLists=DB::select("SELECT ed.*,u.customerCode,u.nameTitle,u.name,u.mobile,u.email FROM loan_emi_details ed LEFT JOIN users u ON ed.userId=u.id WHERE MONTH(ed.emiDate)='$currentMonth' AND YEAR(ed.emiDate)='$currentYear' AND date(ed.emiDate)<=date('$twoDaysBack') AND ed.status !='success' AND reminderSent='0' LIMIT 10");
        
        if(!empty($remainderLists)){
            foreach($remainderLists as $rlist){
                
                $loanid = 'LF0'.$rlist->loanId;
                $fdate = date('d F Y',strtotime($rlist->emiDate));
                $amount = $rlist->netemiAmount;
                // dd($fdate);
                $mobileNumber = $rlist->mobile;
                // $mobileNumber = '9871802071';
                $userMail = $rlist->email;
                // $userMail = "basant@techmavesoftware.com";

                $textMessage= 'Hello from Maxemo Team, This is a reminder for your Loan ID '.$loanid.', your payment due date is '.$fdate.' Amount INR '.$amount.' kindly pay on due date. Regards, Maxemo Capital';

                $textMessageMail = 'Hello from Maxemo Team,<br> This is a reminder for your Loan ID '.$loanid.', your payment due date is '.$fdate.' Amount INR '.$amount.' kindly pay on due date.<br> Regards,<br> Maxemo Capital';

                // echo $textMessage.'<br>';
                AppServiceProvider::sendMail($userMail,$rlist->name,"EMI Remainder | Maxemo Capital",$textMessageMail);
                $RES=AppServiceProvider::sendSms($mobileNumber, $textMessage);

                if($RES){
                    LoanEmiDetail::where('id',$rlist->id)->update(['reminderSent'=>1,'reminderSentDate'=>$today]);
                }
            }
        }
        return Command::SUCCESS;
    }
}
