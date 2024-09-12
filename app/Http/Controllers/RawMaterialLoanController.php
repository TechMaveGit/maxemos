<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplyLoanHistory;
use App\Models\RawMaterialsTxnDetail;
use App\Models\RenewalLoan;
use App\Models\Tenure;
use App\Models\User;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RawMaterialLoanController extends Controller
{

    public function rewMaterialAppliedLoans(Request $request)
    {
        $userId=$request->userId;
        $loanDetails=ApplyLoanHistory::getRawMaterialAppliedLoans($userId);

        $htmlStr='';

        $TBLLTHCLS='whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
        $htmlStr .='<div class="row mt-5" style="overflow-x: auto;"><table class="is-hoverable w-full text-left">
            <thead>
              <tr>
                <th class="'.$TBLLTHCLS.'">Loan Account No.</th>
                <th class="'.$TBLLTHCLS.'">Product Name</th>
                <th class="'.$TBLLTHCLS.'">Applied Amount</th>
                <th class="'.$TBLLTHCLS.'">Applied Tenure</th>
                <th class="'.$TBLLTHCLS.'">Approved Amount </th>
                <th class="'.$TBLLTHCLS.'">Approved Tenure</th>
                <th class="'.$TBLLTHCLS.'">ROI</th>
                <th class="'.$TBLLTHCLS.'">Loan Date</th>
                <th class="'.$TBLLTHCLS.'">Apply Date</th>
                <th class="'.$TBLLTHCLS.'">Status</th>
                <th class="'.$TBLLTHCLS.'">Action</th>
              </tr>
            </thead>
            <tbody>';
        if(count($loanDetails))
        {
            $lsr=1;
            foreach ($loanDetails as $lrow)
            {
                $disburseDate=(strtotime($lrow->disbursedDate)) ? date('d M, Y',strtotime($lrow->disbursedDate)) : '';
                $applyDate=(strtotime($lrow->created_at)) ? date('d M, Y',strtotime($lrow->created_at)) : '';
                $loanAccountNumber=env('LOANID_PRE').'0'.$lrow->id;

                $rawMaterialLoanAccountDetailsURL=route('rawMaterialLoanAccountDetails',$lrow->id);

                $buttons='';
                $loanStatus=strtoupper($lrow->status);
                $htmlStr .='<tr>
                        <td><a href="'.$rawMaterialLoanAccountDetailsURL.'" target="_blank">'.$loanAccountNumber.'</a></td>
                        <td>'.$lrow->categoryName.'</td>
                        <td>'.$lrow->loanAmount.'</td>
                        <td>'.$lrow->appliedTenureD.'</td>
                        <td>'.$lrow->approvedAmount.'</td>
                        <td>'.$lrow->approvedTenureD.'</td>
                        <td>'.$lrow->rateOfInterest.'</td>
                        <td>'.$disburseDate.'</td>
                        <td>'.$applyDate.'</td>
                        <td>'.$loanStatus.'</td>
                        <td>'.$buttons.'</td>
                </tr>';
                $lsr++;
            }
        }
        $htmlStr .='</table></div>';

        if($htmlStr){
            echo json_encode(['status'=>'success','message'=>'Loan Details.','data'=>$htmlStr]); exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
        }
    }


    public function rawMaterialLoanTenuresUpdate(Request $request){
        $tenuresId = $request->tenuresId;
        $tenuresName = DB::table('tenures')->whereId($tenuresId)->first()->name;
        $totalDays = str_replace('Days','',(int)trim($tenuresName));
    
        $tloanId = $request->actiontLoanId;
    
        $rawDueLoan = DB::select("SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.loanId='$tloanId' AND rmc.status='success' AND rmc.txnType='out' AND rmc.openingBalanceLatest != 0 ORDER BY rmc.id DESC");
        $applyLoanDetails = DB::select("SELECT * FROM apply_loan_histories where id='$tloanId'")[0];
        $loanRequest = (array)DB::select("SELECT * FROM raw_materials_loan_requests where loanId='$tloanId' ORDER BY id DESC");
    
        // dd($rawDueLoan);
        $applyLoanDetailsArray = (array) $applyLoanDetails;
        $filteredApplyLoanDetails = Arr::except($applyLoanDetailsArray, ['id']);
        $filteredApplyLoanDetails['tenure'] = $tenuresId;
        $filteredApplyLoanDetails['approvedTenure'] = $tenuresId;
        $loanID = DB::table('apply_loan_histories')->insertGetId($filteredApplyLoanDetails);
    
        $loanRequestSave = [];
        $rawMaterialsTxnDetailSave=[];
    
        if($rawDueLoan &&  !empty($rawDueLoan)){
            foreach($rawDueLoan as $rawDue){
    
                $date = Carbon::createFromFormat('Y-m-d', $rawDue->interestStartDate);
                $newDate = $date->addDays($totalDays);
                $tenureDueDate = $newDate->toDateString();
    
    
                if($rawDue->amount == $rawDue->openingBalanceLatest){
                    DB::table('raw_materials_txn_details')->whereId($rawDue->id)->update(['loanId'=>$loanID,'approvedTenure'=>$tenuresId,'tenureDueDate'=>$tenureDueDate]);
                    foreach($loanRequest as $kk=>$lreq){
                        if((float)$lreq->loanAmount == (float)$rawDue->amount){
                            DB::table('raw_materials_loan_requests')->whereId($lreq->id)->update(['loanId'=>$loanID]);
                            unset($loanRequest[$kk]);
                            break;
                        }
                    }
                }else{
                    $remainingAmount = $rawDue->amount - $rawDue->openingBalanceLatest;
    
                    $applyLoanDetailsArrayRawLoan = (array) $rawDue;
                    $filteredApplyLoanDetailsRawLoan = Arr::except($applyLoanDetailsArrayRawLoan, ['id','tenureName']);
                    $filteredApplyLoanDetailsRawLoan['loanId'] = $loanID;
                    $filteredApplyLoanDetailsRawLoan['amount'] = $rawDue->openingBalanceLatest;
                    $filteredApplyLoanDetailsRawLoan['openingBalanceLatest'] = $rawDue->openingBalanceLatest;
                    $filteredApplyLoanDetailsRawLoan['openingBalance'] = 0;
                    $filteredApplyLoanDetailsRawLoan['approvedTenure'] = $tenuresId;
                    $filteredApplyLoanDetailsRawLoan['tenureDueDate'] = $tenureDueDate;
                    // DB::table('raw_materials_txn_details')->insert($filteredApplyLoanDetailsRawLoan);
                    DB::table('raw_materials_txn_details')->whereId($rawDue->id)->update($filteredApplyLoanDetailsRawLoan);
    
                    foreach($loanRequest as $kk=>$lreq){
                        if((float)$lreq->loanAmount == (float)$rawDue->amount){
                            $newReq = (array)$lreq;
                            $newReq['loanAmount'] = $rawDue->openingBalanceLatest;
                            $newReq['approvedAmount'] = $rawDue->openingBalanceLatest;
                            $newReq['loanId'] = $loanID;
                            $loanRequestSave[] = Arr::except($newReq, ['id']);
                            DB::table('raw_materials_loan_requests')->whereId($lreq->id)->update(['loanId'=>$loanID,'loanAmount'=>$remainingAmount,'approvedAmount'=>$remainingAmount]);
                            break;
                        }
                    }

                    DB::table('raw_materials_txn_details')->where(['openingBalance'=>$rawDue->amount,'txnType'=>'in','openingDate'=>$rawDue->openingDate])->update(['openingBalance'=>$remainingAmount,'openingBalanceLatest'=>0,'outstandingBalance'=>0]);
                    
                    $applyLoanDetailsArrayRawLoan01 = (array) $rawDue;
                    $applyLoanDetailsArrayRawLoan01 = Arr::except($applyLoanDetailsArrayRawLoan01, ['id','tenureName']);
                    $applyLoanDetailsArrayRawLoan01['amount'] = $remainingAmount;
                    $applyLoanDetailsArrayRawLoan01['openingBalanceLatest'] = 0;
                    $applyLoanDetailsArrayRawLoan01['openingBalance'] = 0;
                    $applyLoanDetailsArrayRawLoan01['outstandingBalance'] = $remainingAmount;
                    $applyLoanDetailsArrayRawLoan01['isFullSettled'] = 1;
                    DB::table('raw_materials_txn_details')->insert($applyLoanDetailsArrayRawLoan01);

                    // DB::table('raw_materials_txn_details')->whereId($rawDue->id)->update(['amount'=>$remainingAmount,'openingBalance'=>0,'openingBalanceLatest'=>0,'outstandingBalance'=>$remainingAmount,"isFullSettled"=>1]);
    
                }
            }
        }
        DB::table('raw_materials_loan_requests')->insert($loanRequestSave);
        return redirect()->back()->with('success','New Loan Created Successfully !');
    }



    public function rawMaterialLoanAccountDetails($loanId)
    {
        $pageTitle='Raw Material Financing Loan Account Details';
        $pageNameStr='raw-material-financing-loan-account-details';

        $loanDetails=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.id='$loanId' and alh.loanCategory='3' AND (alh.status='customer-approved' OR alh.status='closed' OR alh.status='noc-issued') ORDER BY alh.id DESC");
        if(!count($loanDetails)){
            return redirect()->route('rawMaterialFinancingLoans');
        }
        $loanDetails=$loanDetails[0];
        $userId=$loanDetails->userId;
        $userDtl=User::getUserDetailsById($userId);

        if(empty($userDtl)){
            return redirect()->route('rawMaterialFinancingLoans');
        }

        $tenures=Tenure::where('loanCategory',3)->orderBy('sortOrder','ASC')->get();
        
        $netDisbursementAmount01 = DB::select("SELECT IFNULL(SUM(amount),0) AS netDisbursementAmount FROM raw_materials_txn_details WHERE debitRecordId='0' AND status='success' AND loanId='$loanId'");
        $principleDeposited01 = DB::select("SELECT IFNULL(SUM(amount),0) AS principleDeposited FROM raw_materials_txn_details WHERE debitRecordId!='0' AND status='success'  AND loanId='$loanId'");

        $netDisbursementAmount =0;
        $principleDeposited=0;
        if($netDisbursementAmount01){
            $netDisbursementAmount = $netDisbursementAmount01[0]->netDisbursementAmount;
        }
        if($principleDeposited01){
            $principleDeposited= $principleDeposited01[0]->principleDeposited;
        }


        $OutStandingAmount = $netDisbursementAmount - $principleDeposited;

        $credHistoryArr=CommonController::checkAvailableAmountLimitRawMaterial($userId,$loanId);

        $availableLimit=$credHistoryArr['availableLimit'];
        $totalCredit=$credHistoryArr['totalCredit'];
        $totalDebit=$credHistoryArr['totalDebit'];

        $tenureHtmlStr ='<div class="col-lg-12 mt-3" >
                    <label><strong>Tenure</strong></label>
                    <select class="js-example-basic-single2 form-select" id="approveTenure" data-width="100%">
                        <option value="">Select Tenure</option>';
        if(count($tenures))
        {
            foreach($tenures as $trow)
            {
                $tenureHtmlStr .='<option value="'.$trow->id.'" datamonth="'.$trow->numOfMonths.'">'.$trow->name.'</option>';
            }
        }
        $tenureHtmlStr .='</select>
                </div>';

        return view('pages.loan-management.raw-material-finance-txn-list',compact('pageTitle','pageNameStr','loanId','loanDetails','userDtl','availableLimit','totalCredit','totalDebit','tenureHtmlStr','OutStandingAmount','tenures'));
    }

    public function rewMaterialAppliedLoansTxnHistory(Request $request)
    {
        $loanId=$request->loanId;
        $filterType=$request->filterType;
        $SUBQRY='';

        if($filterType=='credit'){
            $SUBQRY .=" AND rmc.id IS NOT NULL";
        }

        /*
        $fromDate=(strtotime($request->fromDate)) ? date('Y-m-d',strtotime($request->fromDate)) : '';
        $toDate=(strtotime($request->toDate)) ? date('Y-m-d',strtotime($request->toDate)) : '';
        */
        /*if($fromDate && $toDate){
            $SUBQRY .=" AND date(rmtd.created_at)>='$fromDate' AND date(rmtd.created_at)<='$toDate'";
        }*/



        //$loanDetails=DB::select("SELECT * FROM raw_materials_txn_details rmtd WHERE rmtd.id>0 AND rmtd.loanId='$loanId' $SUBQRY ORDER BY rmtd.id desc");

            if($filterType=='all')
            {
                $selQry="SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.loanId='$loanId' AND rmc.status='success' ORDER BY rmc.id DESC";
            }else if($filterType=='debit'){
                $selQry="SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.txnType='out' AND rmc.loanId='$loanId' AND rmc.status='success' ORDER BY rmc.id DESC";
            }else if($filterType=='credit'){
                $selQry="SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.txnType='in' AND rmc.loanId='$loanId' AND rmc.status='success' ORDER BY rmc.id DESC";
            }else if($filterType=='due'){
                $selQry="SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.loanId='$loanId' AND rmc.status='success' AND rmc.txnType='out' AND rmc.openingBalanceLatest != 0 ORDER BY rmc.id DESC";
            }

        //$loanDetails=DB::select("SELECT rmd.id as debitRecordId,rmd.created_at as debitProcessSysDate,rmd.amount as loanAmount,rmd.transactionDate as openingdate,rmd.status as debitStatus,rmd.transactionId as debitTxnId,rmd.payment_mode as debitPaymentMode,rmd.transactionDate as debitTxnDate,rmc.* FROM raw_materials_txn_details rmd LEFT JOIN raw_materials_txn_details rmc ON rmd.id=rmc.debitRecordId WHERE rmd.txnType='out' AND rmd.loanId='$loanId' $SUBQRY ORDER BY rmd.id ASC");

        $loanDetails=DB::select($selQry);
        // dd($selQry);

        $htmlStr='';

        $TBLLTHCLS='whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
        $htmlStr .='<div  class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1" style="overflow-x: auto;"><table class="is-hoverable is-hoverabletd w-full text-left table-bordered">
            <thead>
              <tr>
                <th class="'.$TBLLTHCLS.'">Sr. No.</th>';
                    if($filterType=='all')
                    {
                        $htmlStr .=' <th class="'.$TBLLTHCLS.'">Opening Date</th>
                            <th class="'.$TBLLTHCLS.'">Opening Amount</th>
                            <th class="'.$TBLLTHCLS.'">Closing Date</th>
                            <th class="'.$TBLLTHCLS.'">Closing Amount</th>
                            <th class="'.$TBLLTHCLS.'">Withdraw Amount</th>
                            <th class="'.$TBLLTHCLS.'">Deposit </th>
                            <th class="'.$TBLLTHCLS.'">Interest Days</th>
                            <th class="'.$TBLLTHCLS.'">Total Interest</th>
                            <th class="'.$TBLLTHCLS.'">TDS %</th>
                            <th class="'.$TBLLTHCLS.'">TDS Amount</th>
                            <th class="'.$TBLLTHCLS.'">Net Interest</th>                                
                            <th class="'.$TBLLTHCLS.'">Late Charge</th>
                            <th class="'.$TBLLTHCLS.'">No. of days of late charges</th>                                
                            <th class="'.$TBLLTHCLS.'">Principle Deposit</th>
                            <th class="'.$TBLLTHCLS.'">Tenure </th>';
                        $htmlStr .='<th class="'.$TBLLTHCLS.'">Invoice No. </th>
                        <th class="'.$TBLLTHCLS.'">Customer UTR </th>';
                    }else if($filterType=='debit'){
                        $htmlStr .=' <th class="'.$TBLLTHCLS.'">Amount</th>
                            <th class="'.$TBLLTHCLS.'">Transaction Id</th>
                            <th class="'.$TBLLTHCLS.'">Payment Mode</th>
                            <th class="'.$TBLLTHCLS.'">Transaction Date </th>
                            <th class="'.$TBLLTHCLS.'">Tenure </th>
                            <th class="'.$TBLLTHCLS.'">Status </th>';
                        $htmlStr .='<th class="'.$TBLLTHCLS.'">Invoice No. </th>
                        <th class="'.$TBLLTHCLS.'">Customer UTR </th>';
                    }else if($filterType=='credit'){
                        $htmlStr .=' <th class="'.$TBLLTHCLS.'">Opening Date</th>
                            <th class="'.$TBLLTHCLS.'">Opening Amount</th>
                            <th class="'.$TBLLTHCLS.'">Closing Date</th>
                            <th class="'.$TBLLTHCLS.'">Closing Amount</th>
                            <th class="'.$TBLLTHCLS.'">Deposit </th>
                            <th class="'.$TBLLTHCLS.'">Interest Days</th>
                            <th class="'.$TBLLTHCLS.'">Total Interest</th>
                            <th class="'.$TBLLTHCLS.'">TDS %</th>
                            <th class="'.$TBLLTHCLS.'">TDS Amount</th>
                            <th class="'.$TBLLTHCLS.'">Net Interest</th>
                            <th class="'.$TBLLTHCLS.'">Late Charge</th>
                            <th class="'.$TBLLTHCLS.'">No. of days of late charges
                            <th class="'.$TBLLTHCLS.'">Principle Deposit</th>
                            <th class="'.$TBLLTHCLS.'">Tenure </th>';
                    }else if($filterType=='due'){
                        $htmlStr .=' <th class="'.$TBLLTHCLS.'">Amount</th>
                            <th class="'.$TBLLTHCLS.'">Opening Date</th>
                            <th class="'.$TBLLTHCLS.'">Due Date</th>
                            <th class="'.$TBLLTHCLS.'">Due Amount </th>';
                        $htmlStr .='<th class="'.$TBLLTHCLS.'">Invoice No. </th>
                        <th class="'.$TBLLTHCLS.'">Customer UTR </th>';
                    }
             $htmlStr .='<th class="'.$TBLLTHCLS.'">Created Date</th>
              </tr>
            </thead>
            <tbody>';
        if(count($loanDetails))
        {
            $lsr=1;
            foreach ($loanDetails as $lrow)
            {

                $applyDate=(strtotime($lrow->created_at)) ? date('d M, Y',strtotime($lrow->created_at)) : '';
                

                $transactionDate=(strtotime($lrow->transactionDate)) ? date('d M, Y',strtotime($lrow->transactionDate)) : '';

                $openingdate=(strtotime($lrow->openingDate)) ? date('d M, Y',strtotime($lrow->openingDate)) : '';
                $tenureDueDate=(strtotime($lrow->tenureDueDate)) ? date('d M, Y',strtotime($lrow->tenureDueDate)) : '';

                $closingDate=$transactionDate;

                $debitTxnDate=$transactionDate;

                // $statusText=strtoupper($lrow->status);
                $debitStatus=strtoupper($lrow->status);
                // $txnType=strtoupper($lrow->txnType);
                // if($txnType=='IN'){
                //     $txnType='Credit';
                // }else if($txnType=='OUT'){
                //     $txnType='Debit';
                // }

                $buttons='';
                $loanStatus=strtoupper($lrow->status);
                $totalDepositAmount=$lrow->totalAmount+$lrow->lateCharges;
                $htmlStr .='<tr>
                        <td>'.$lsr.'</td>';
                            if($filterType=='all')
                            {
                                if($lrow->txnType=='in')
                                {
                                    $htmlStr .='<td>'.$openingdate.'</td>
                                        <td>'. number_format($lrow->openingBalance,2).'</td>
                                        <td>'.$closingDate.'</td>
                                        <td>'. number_format($lrow->outstandingBalance,2).'</td>
                                        <td></td>
                                        <td>'. number_format($totalDepositAmount,2).'</td>
                                        <td>'.$lrow->numOfDays.'</td>
                                        <td>'. number_format($lrow->interestAmount,2).'</td>
                                        <td>'. number_format($lrow->tdsPercent,2).'</td>
                                        <td>'. number_format($lrow->tdsAmount,2).'</td>
                                        <td>'. number_format($lrow->interestAmountPayble,2).'</td>
                                        <td>'. number_format($lrow->lateCharges,2).'</td>
                                        <td>'.$lrow->numOfDaysOfFine.'</td>
                                        <td>'. number_format($lrow->amount,2).'</td>
                                        <td></td>
                                        <td></td>';
                                }else{
                                    $htmlStr .='<td>'.$openingdate.'</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>'. number_format($lrow->amount,2).'</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>'.$lrow->tenureName.'</td>';
                                        $invNumber=($lrow->invoiceNumber) ? $lrow->invoiceNumber : '';
                                        if($invNumber){
                                            $htmlStr .='<td><a href="javascript:;" style="color:blue;" data-invoiceNumber="'.$lrow->invoiceNumber.'" data-invoiceFile="'.$lrow->invoiceFile.'" data-drawDownFormFile="'.$lrow->drawDownFormFile.'" data-utrName="'.$lrow->utr_name.'" data-utrFile="'.$lrow->utr_file.'"  id="rawFile'.$lrow->id.'" onclick="openInvFiles('.$lrow->id.');" >'.$invNumber.'</a></td>';
                                        }else{
                                            $htmlStr .='<td></td>';
                                        }

                                        $utr_name=($lrow->utr_name) ? $lrow->utr_name : '';
                                        if($utr_name){
                                            $htmlStr .='<td><a href="javascript:;" style="color:blue;" data-invoiceNumber="'.$lrow->invoiceNumber.'" data-invoiceFile="'.$lrow->invoiceFile.'" data-drawDownFormFile="'.$lrow->drawDownFormFile.'" data-utrName="'.$lrow->utr_name.'" data-utrFile="'.$lrow->utr_file.'"  id="rawFile'.$lrow->id.'" onclick="openInvFiles('.$lrow->id.');" >'.$lrow->utr_name.'</a></td>';
                                        }else{
                                            $htmlStr .='<td></td>';
                                        }
                                        
                                    
                                }
                                
                            }else if($filterType=='debit'){
                                $htmlStr .='
                                    <td>'. number_format($lrow->amount,2).'</td>
                                    <td>'.$lrow->transactionId.'</td>
                                    <td>'.strtoupper($lrow->payment_mode).'</td>
                                    <td>'.$transactionDate.'</td>
                                    <td>'.$lrow->tenureName.'</td>
                                    <td>'.$debitStatus.'</td>';
                                    $invNumber=($lrow->invoiceNumber) ? $lrow->invoiceNumber : '';
                                    if($invNumber){
                                        $htmlStr .='<td><a href="javascript:;" style="color:blue;" data-invoiceNumber="'.$lrow->invoiceNumber.'" data-invoiceFile="'.$lrow->invoiceFile.'" data-drawDownFormFile="'.$lrow->drawDownFormFile.'" data-utrName="'.$lrow->utr_name.'" data-utrFile="'.$lrow->utr_file.'" id="rawFile'.$lrow->id.'" onclick="openInvFiles('.$lrow->id.');" >'.$invNumber.'</a></td>';
                                    }else{
                                        $htmlStr .='<td></td>';
                                    }

                                    $utr_name=($lrow->utr_name) ? $lrow->utr_name : '';
                                    if($utr_name){
                                        $htmlStr .='<td><a href="javascript:;" style="color:blue;" data-invoiceNumber="'.$lrow->invoiceNumber.'" data-invoiceFile="'.$lrow->invoiceFile.'" data-drawDownFormFile="'.$lrow->drawDownFormFile.'" data-utrName="'.$lrow->utr_name.'" data-utrFile="'.$lrow->utr_file.'"  id="rawFile'.$lrow->id.'" onclick="openInvFiles('.$lrow->id.');" >'.$lrow->utr_name.'</a></td>';
                                    }else{
                                        $htmlStr .='<td></td>';
                                    }
                            }else if($filterType=='credit'){
                                $htmlStr .='<td>'.$openingdate.'</td>
                                        <td>'. number_format($lrow->openingBalance,2).'</td>
                                        <td>'.$closingDate.'</td>
                                        <td>'. number_format($lrow->outstandingBalance,2).'</td>
                                        <td>'. number_format($totalDepositAmount,2).'</td>
                                        <td>'.$lrow->numOfDays.'</td>
                                        <td>'. number_format($lrow->interestAmount,2).'</td>
                                        <td>'. number_format($lrow->tdsPercent,2).'</td>
                                        <td>'. number_format($lrow->tdsAmount,2).'</td>
                                        <td>'. number_format($lrow->interestAmountPayble,2).'</td>
                                        <td>'. number_format($lrow->lateCharges,2).'</td>
                                        <td>'.$lrow->numOfDaysOfFine.'</td>
                                        <td>'. number_format($lrow->amount,2).'</td>
                                        <td>'.$lrow->tenureName.'</td>';
                                
                            }else if($filterType=='due'){
                                $htmlStr .='<td>'. number_format($lrow->amount,2).'</td>
                                <td>'.$openingdate.'</td>
                                <td>'.$tenureDueDate.'</td>
                                <td>'. number_format($lrow->openingBalanceLatest,2).'</td>';
                                $invNumber=($lrow->invoiceNumber) ? $lrow->invoiceNumber : '';
                                if($invNumber){
                                    $htmlStr .='<td><a href="javascript:;" style="color:blue;" data-invoiceNumber="'.$lrow->invoiceNumber.'" data-invoiceFile="'.$lrow->invoiceFile.'" data-drawDownFormFile="'.$lrow->drawDownFormFile.'" id="rawFile'.$lrow->id.'" onclick="openInvFiles('.$lrow->id.');" >'.$invNumber.'</a></td>';
                                }else{
                                    $htmlStr .='<td></td>';
                                }
                                $utr_name=($lrow->utr_name) ? $lrow->utr_name : '';
                                if($utr_name){
                                    $htmlStr .='<td><a href="javascript:;" style="color:blue;" data-utrName="'.$lrow->utr_name.'" data-utrFile="'.$lrow->utr_file.'"  id="rawFile'.$lrow->id.'" onclick="openInvFiles('.$lrow->id.');" >'.$lrow->utr_name.'</a></td>';
                                }else{
                                    $htmlStr .='<td></td>';
                                }
                            }
                $htmlStr .='<td>'.$applyDate.'</td>
                </tr>';
                $lsr++;
            }
        }
        $htmlStr .='</tbody></table></div>';

        if($htmlStr){
            echo json_encode(['status'=>'success','message'=>'Loan Details.','data'=>$htmlStr]); exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
        }
    }

    public function disburseRequestRawMaterialAppliedLoans(Request $request){
        $loanId=$request->actionLoanId;
        $userId=$request->actionUserId;
        $amount=$request->processAmount;

        

        if(DB::table('raw_materials_loan_requests')->where(['loanId'=>$loanId,'userId'=>$userId,'status'=>'disburse-scheduled'])->exists()){

            echo json_encode(['status'=>'error','message'=>'Disburse scheduled request has already exists with this loan.']); exit;
        }else{

            $availableArr=CommonController::checkAvailableAmountLimitRawMaterial($userId,$loanId);
            $availableLimit=$availableArr['availableLimit'];
            if($amount>$availableLimit){
                echo json_encode(['status'=>'error','message'=>'Please enter the amount lower than available limit.']); exit;
            }

            $invoiceFile='';
            if(!empty($request->invoiceFile)){
                $invoiceFile=AppServiceProvider::uploadImageCustom('invoiceFile','raw-materials');
            }
            
            $drawDownFormFile='';
            if(!empty($request->drawDownFormFile)){
                $drawDownFormFile=AppServiceProvider::uploadImageCustom('drawDownFormFile','raw-materials');
            }

            $disburseDate=(strtotime($request->disburseDate)) ? date('Y-m-d',strtotime($request->disburseDate)) : '';
            $saveArr['loanId'] = $loanId;
            $saveArr['loanAmount'] = $amount;
            $saveArr['disburse_date'] = $disburseDate;
            $saveArr['invoiceFile'] = $invoiceFile;
            $saveArr['drawDownFormFile'] = $drawDownFormFile;
            $saveArr['invoiceNumber'] = $request->invoiceNumber;
            $saveArr['userId'] = $userId;
            $saveArr['status'] = 'disburse-scheduled';
            

            $save=DB::table('raw_materials_loan_requests')->insertGetId($saveArr);
            if($save){
                $userDtl = User::getUserDetailsById($userId);
                if (empty($userDtl)) {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid Request, Please try again.']);
                    exit;
                }
                $acceptURL =   route('viewAdminLaonDetail', ['id'=>md5($loanId)]);
                $htmlStAdmin = '<div style="font-weight: normal;">
                    <br>Dear Admin,</p>
                    <p>Kindly review this loan details.This loan application has been approved and is set for disbursement.To proceed with the disbursement, please confirm your acceptance of the loan.</p>
                    <br/> <br/>
                    <p style="font-weight: bold;">Loan Summary:</p>
                    </br>
                    <p>Customer Name: '.$userDtl->name.'</p><br/>
                    <p>Customer ID: '.$userDtl->customerCode.'</p><br/>
                    <p>Loan ID: #LF0'.$loanId.'</p><br/>
                    <p>Loan Type: Raw Materials Loan</p><br/>
                    <p>Disbursement Request Loan Amount: '.$amount.'</p><br/>
                    <p>Requested Disbursed Date: '.$disburseDate.'</p><br/>
                    <center><a href="' . $acceptURL . '" target="_blank" style="color: blue;font-size: 22px;font-weight: bold;">Click Here To View Loan</a></center>
                </div>';
                $verifyWith = env('APP_NAME');
                if (config('app.env') == "production") {
                    // AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "Loan Disbursement Request #LF0".$loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    AppServiceProvider::sendMail("shorya.mittal@maxemocapital.com", "Shorya Mittal", "Loan Disbursement Request #LF0".$loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    // AppServiceProvider::sendMail("vipul.mittal@maxemocapital.com", "Vipul Mittal", "Loan Disbursement Request #LF0".$loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    AppServiceProvider::sendMail("raju@techmavesoftware.com", "Basant", "Loan Disbursement Request #LF0".$loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    AppServiceProvider::sendMail("ashish.kumar@maxemocapital.com", "Ashish Kumar", "Loan Disbursement Request #LF0".$loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    
                    // AppServiceProvider::sendMail("vivek.mittal@maxemocapital.com", "Vivek Mittal", "Loan Rejected | " . $verifyWith, $htmlStAdmin);
                }else if(config('app.env') == "testing"){
                    AppServiceProvider::sendMail("anjali.negi@maxemocapital.com","Anjali","Loan Disbursement Request #LF0".$loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                 } else {
                    AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "Loan Disbursement Request #LF0".$loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    // AppServiceProvider::sendMail("raju@techmavesoftware.com", "Basant", "Loan Disbursement Request #LF0".$loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    // AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "Loan Rejected | " . $verifyWith, $htmlStAdmin);
                }
                echo json_encode(['status'=>'success','message'=>'Disburse request has been schedule successfully.']); exit;
            }else{
                echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
            }
        }
    }

    
    public function disburseRawMaterialAppliedLoans(Request $request)
    {
        // dd($request->all());
        try{
            $loanId=$request->actionLoanId;
            
            $isValidated=AppServiceProvider::validatePermission('rawmaterial-disburse-amount');
            $amount=$request->processAmount;
            $transactionId=$request->transactionId;
            $payment_mode=$request->payment_mode;
            //$approvedTenure=$request->approveTenure;

            $processDate=(strtotime($request->processDate)) ? date('Y-m-d',strtotime($request->processDate)) : '';

            $loanDtl=ApplyLoanHistory::where('id',$loanId)->first();
            $approvedTenure=$loanDtl->approvedTenure;
            $userId=$loanDtl->userId;
            $tenureDtl=Tenure::where('id',$approvedTenure)->first();

            $availableArr=CommonController::checkAvailableAmountLimitRawMaterial($userId,$loanId);
            $availableLimit=$availableArr['availableLimit'];
            if($amount>$availableLimit){
                echo json_encode(['status'=>'error','message'=>'Please enter the amount lower than available limit.']); exit;
            }

            $tenureDueDate='';
            if(!empty($tenureDtl))
            {
                $tenureDueDate=date('Y-m-d',strtotime($processDate .' +'.$tenureDtl->numOfMonths));
            }
            $lastloanRequest = DB::table('raw_materials_loan_requests')->where(['loanId'=>$loanId,'status'=>'disburse-scheduled'])->orderBy('updated_at','DESC')->first();
            
            
            $invoiceFile=$lastloanRequest->invoiceFile??'';
            if(!empty($request->invoiceFile)){
                $invoiceFile=AppServiceProvider::uploadImageCustom('invoiceFile','raw-materials');
            }
            
            $drawDownFormFile=$lastloanRequest->drawDownFormFile??'';
            if(!empty($request->drawDownFormFile)){
                $drawDownFormFile=AppServiceProvider::uploadImageCustom('drawDownFormFile','raw-materials');
            }

            $utrFile=$lastloanRequest->utr_file??'';
            if(!empty($request->utrFile)){
                $utrFile=AppServiceProvider::uploadImageCustom('utrFile','raw-materials');
            }

            $currentDate=date('Y-m-d H:i:s');
            $saveArr['loanId']=$loanId;
            $saveArr['userId']=$userId;
            $saveArr['amount']=$amount;
            $saveArr['status']='success';
            $saveArr['transactionId']=$transactionId;
            $saveArr['payment_mode']=$payment_mode;
            $saveArr['transactionId']=$transactionId;
            $saveArr['openingDate']=$processDate;
            $saveArr['transactionDate']=$processDate;
            $saveArr['outstandingBalance']=$amount;
            $saveArr['openingBalanceLatest']=$amount;
            $saveArr['interestStartDate']=$processDate;
            $saveArr['approvedTenure']=$approvedTenure;
            $saveArr['tenureDueDate']=$tenureDueDate;
            $saveArr['invoiceNumber']=($request->invoiceNumber) ? $request->invoiceNumber : $lastloanRequest->invoiceNumber;
            $saveArr['invoiceFile']=$invoiceFile;
            $saveArr['drawDownFormFile']=$drawDownFormFile;
            $saveArr['utr_name']=$request->utrName??null;
            $saveArr['utr_file']=$utrFile;
            $saveArr['txnType']='out';
            $saveArr['created_at']=$currentDate;
            $saveArr['updated_at']=$currentDate;

            $save=DB::table('raw_materials_txn_details')->insertGetId($saveArr);
            if($save){
                
                $verifyWith = env('APP_NAME');
                $userDtl = User::whereId($userId)->first();
                $htmlStAdmin = "Dear ".$userDtl->name.",<br>Your disbursement request of amount ".$lastloanRequest->loanAmount." INR has been approved for Raw material loan (LF0".$loanId.").Amount ".$amount." INR will be disburse into your account at ".$lastloanRequest->disburse_date.".<br><br>";
                
                if (config('app.env') == "production") {
                    AppServiceProvider::sendMail($userDtl->email, $userDtl->name,$amount." INR | Disbursement request approved Raw loan #LF0".$loanId." | ". $verifyWith, $htmlStAdmin);
                }else if(config('app.env') == "testing"){
                    AppServiceProvider::sendMail("anjali.negi@maxemocapital.com","Anjali",$amount." INR | Disbursement request approved Raw loan #LF0".$loanId." | ". $verifyWith, $htmlStAdmin);
                 } else{
                    AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant Singh",$amount." INR | Disbursement request approved Raw loan #LF0".$loanId." | ". $verifyWith, $htmlStAdmin);
                    // AppServiceProvider::sendMail("raju@techmavesoftware.com", "Basant Singh",$loanRaw->amount." INR | Disbursement request approved Raw loan #LF0".$loanId." | ". $verifyWith, $htmlStAdmin);
                 }
                

                DB::table('raw_materials_loan_requests')->where('loanId',$loanId)->update(['invoiceNumber'=>$saveArr['invoiceNumber'],'invoiceFile'=>$invoiceFile,'drawDownFormFile'=>$drawDownFormFile,'approvedAmount'=>$amount,'status'=>'disbursed']);
                echo json_encode(['status'=>'success','message'=>'Disbursement Request Approved Successfully.']); exit;
            }else{
                echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
            }
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function rawMaterialDisbursementPendingList(Request $request)
    {
        $pageTitle='Raw Material Disbursement Web Requests';
        $pageNameStr='raw-material-disbursement-pending-list';

        return view('pages.loan-management.raw-material-disbursement-pending-list',compact('pageTitle','pageNameStr'));
    }

    public function filterRawMaterialDisbursementPendingList(Request $request)
    {

        $selQry= "SELECT rmc.*,u.customerCode,u.name as userName, u.email as userEmail, u.mobile as userMobile FROM raw_materials_loan_requests rmc LEFT JOIN users u ON rmc.userId=u.id WHERE rmc.status='customer-request' ORDER BY rmc.id DESC";

        $loanDetails=DB::select($selQry);

        $htmlStr='';

        $TBLLTHCLS='whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
        $htmlStr .='<div  class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1" style="overflow-x: auto;"><table class="is-hoverable w-full text-left table-bordered">
            <thead>
              <tr>
                    <th class="'.$TBLLTHCLS.'">Sr. No.</th>
                    <th class="'.$TBLLTHCLS.'">Customer Code</th>
                    <th class="'.$TBLLTHCLS.'">Name</th>
                    <th class="'.$TBLLTHCLS.'">Email</th>
                    <th class="'.$TBLLTHCLS.'">Amount</th>
                    <th class="'.$TBLLTHCLS.'">Invoice / Draw Down Form File </th>
                    <th class="'.$TBLLTHCLS.'">Status </th>
                    <th class="'.$TBLLTHCLS.'">Action </th>';
                $htmlStr .='<th class="'.$TBLLTHCLS.'">Created Date</th>
              </tr>
            </thead>
            <tbody>';
        if(count($loanDetails))
        {
            $lsr=1;
            foreach ($loanDetails as $lrow)
            {

                $applyDate=(strtotime($lrow->created_at)) ? date('d M, Y',strtotime($lrow->created_at)) : '';
                $buttons='<a href="javascript:;" class="btn btn-sm btn-primary"  amount="'.$lrow->loanAmount.'" id="actionBtn'.$lrow->id.'" onclick="disbursementRequestModalOpen('.$lrow->id.',\'approved\');"><i class="fa fa-check"></i> Approve</a>
                <a href="javascript:;" class="btn btn-sm btn-danger"  amount="'.$lrow->loanAmount.'" id="actionRejectBtn'.$lrow->id.'" onclick="disbursementRequestModalOpen('.$lrow->id.',\'rejected\');"><i class="fa fa-times"></i> Reject</a>';
                
                $htmlStr .='<tr>
                        <td>'.$lsr.'</td>';
                        $htmlStr .='
                            <td>'.$lrow->customerCode.'</td>
                            <td>'.$lrow->userName.'</td>
                            <td>'.$lrow->userEmail.'<br>'.$lrow->userMobile.'</td>
                            <td>'. number_format($lrow->loanAmount,2).'</td>';
                            if($lrow->invoiceFile){
                                $htmlStr .='<td><a href="javascript:;" style="color:blue;"  data-invoiceFile="'.$lrow->invoiceFile.'" data-drawDownFormFile="'.$lrow->drawDownFormFile.'" id="rawFile'.$lrow->id.'" onclick="openInvFiles('.$lrow->id.');" >View Documents</a></td>';
                            }else{
                                $htmlStr .='<td></td>';
                            }
                            $htmlStr .='<td>Pending</td>';
                            $htmlStr .='<td>'.$buttons.'</td>
                            <td>'.$applyDate.'</td>
                </tr>';
                $lsr++;
            }
        }
        $htmlStr .='</tbody></table></div>';

        if($htmlStr){
            echo json_encode(['status'=>'success','message'=>'Loan Details.','data'=>$htmlStr]); exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
        }
    }

    public function rawMaterialFinancingLoans()
    {
        $pageTitle='Raw Material Financing Loans';
        $pageNameStr='raw-material-financing-loans';
        //$isValidated=AppServiceProvider::validatePermission('rawmaterial-loan-list');

        return view('pages.loan-management.raw-material-finance-list',compact('pageTitle','pageNameStr'));
    }

    public function dueRenewalRawMaterialFinancingLoans()
    {
        $pageTitle='Due Renewal Raw Material Financing Loans';
        $pageNameStr='due-renewal-raw-material-financing-loans';
        //$isValidated=AppServiceProvider::validatePermission('rawmaterial-loan-list');

        return view('pages.loan-management.raw-material-finance-list',compact('pageTitle','pageNameStr'));
    }

    public function filterCustomerForRawMaterialFinancingLoans(Request $request)
    {
        $customSearch=$request->customSearch;
        $fromDate=(strtotime($request->fromDate)) ? date('Y-m-d',strtotime($request->fromDate)) : '';
        $toDate=(strtotime($request->toDate)) ? date('Y-m-d',strtotime($request->toDate)) : '';
        $userStatus=$request->userStatus;

        $pageNameStr=$request->pageNameStr;

        $SUBQRY='';
        if($pageNameStr=='raw-material-financing-loans'){
            $SUBQRY .=" AND u.kycStatus='approved' AND eh.status='approved' AND alh.status='customer-approved' AND alh.loanCategory='3' AND alh.id IS NOT NULL";
        }

        if($pageNameStr == 'due-renewal-raw-material-financing-loans'){
            $SUBQRY .=" AND u.kycStatus='approved' AND eh.status='approved' AND alh.status='customer-approved' AND alh.loanCategory='3' AND date(alh.validToDate) < date('".date('Y-m-d')."') ";
        }

        if($userStatus==1 || $userStatus==0){
            $SUBQRY .=" AND u.status='$userStatus'";
        }

        if($fromDate && $toDate){
            $SUBQRY .=" AND date(u.created_at)>='$fromDate' AND date(u.created_at)<='$toDate'";
        }

        if($customSearch){
            $SUBQRY .=" AND (u.customerCode LIKE '%$customSearch%' OR u.name LIKE '%$customSearch%' OR u.email LIKE '%$customSearch%' OR u.mobile LIKE '%$customSearch%')";
        }

        $customers=DB::select("SELECT u.*,alh.id as loanId,eh.id as employmentHistoryId,alh.status as loanStatus,eh.status as employmentStatus FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN employment_histories eh ON u.id=eh.userId WHERE u.userType='user' $SUBQRY ORDER BY u.id desc");

        $TBLLTHCLS='whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
        $htmlStr ='<table class="is-hoverable w-full text-left">
            <thead>
                  <tr>
                        <th class="'.$TBLLTHCLS.'">Profile</th>
                        <th class="'.$TBLLTHCLS.'">Cust. ID</th>
                        <th class="'.$TBLLTHCLS.'">Name</th>
                        <th class="'.$TBLLTHCLS.'">Email</th>
                        <th class="'.$TBLLTHCLS.'">Mobile No.</th>
                        <th class="'.$TBLLTHCLS.'">Date</th>
                        <th class="'.$TBLLTHCLS.'">Status</th>
                        <th class="'.$TBLLTHCLS.'">Action</th>
                  </tr>
            </thead>
            <tbody>';
        if (count($customers))
        {
            foreach ($customers as $crow) {

                if ($crow->profilePic) {
                    $profilePic = env('APP_URL') . 'public/' . $crow->profilePic;
                } else {
                    $profilePic = 'https://media.istockphoto.com/vectors/male-face-silhouette-or-icon-man-avatar-profile-unknown-or-anonymous-vector-id1087531642?k=20&m=1087531642&s=612x612&w=0&h=D6OBNUY7ZxQTAHNVtL9mm2wbHb_dP6ogIsCCWCqiYQg=';
                }
                $createdDate = (strtotime($crow->created_at)) ? date('d/m/Y', strtotime($crow->created_at)) : '';
                $htmlStr .= ' <tr>

                                <td class="">
                                    <div class="avatar flex h-10 w-10">
                                        <img class="mask is-squircle" src="' . $profilePic . '" style="height: 50px;width: 50px;object-fit: contain;" alt="image">
                                    </div>
                                </td>
                                <td>' . $crow->customerCode . '</td>
                                <td>' . $crow->name . '</td>
                                <td>' . $crow->email . '</td>
                                <td>' . $crow->mobile . '</td>
                                <td>' . $createdDate . '</td>
                                <td>';

                if ($crow->status == 1) {
                    $htmlStr .= '<span class="badge badge-success-light">Active</span>';
                } else if ($crow->status == 2) {
                    $htmlStr .= '<span class="badge badge-danger">Rejected</span>';
                } else {
                    $htmlStr .= '<span class="badge badge-danger">Deactive</span>';
                }

                if($pageNameStr == 'due-renewal-raw-material-financing-loans'){
                    $buttons = '<a href="' . route('rawMaterialLoanAccountDetails',$crow->loanId) . '" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"><i data-feather="eye" class="fa fa-eye text-primary"></i></a>';
                }else{
                    $buttons = '<a href="' . route('profileDetails', [$pageNameStr, $crow->id]) . '" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"><i data-feather="eye" class="fa fa-eye text-primary"></i></a>';

                    if ($pageNameStr){
                        $buttons .='<button onclick="return rewMaterialAppliedLoans('.$crow->id.');" class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                            <i class="fa fa-inr"></i>
                        </button>';
                        $buttons .= '<a href="' . route('rawMaterialLoanAccountDetails', ['id' => $crow->loanId]) . '" class="btn h-8 w-8 p-0 text-primary hover:bg-info/20 focus:bg-info/20 active:bg-info/25">Loan</a>';
                    }
                }

                


                $htmlStr .='</td>
                                <td>
                                    <div class="d-flex">
                                        '.$buttons.'
                                    </div>
                                </td>
                            </tr>';
            }
        }
        $htmlStr .='</tbody>
          </table>';
        echo $htmlStr;
    }

    public function approveDisbursementRequest(Request $requset)
    {
       if($requset->reject_reason != ''){
            $disbursementRequestId=$requset->disbursementRequestId;
            $lastloanRequest = DB::table('raw_materials_loan_requests')->whereId($disbursementRequestId)->update(['status'=>'rejected','reject_reason'=>$requset->reject_reason]);
            if($lastloanRequest){
                echo json_encode(['status'=>'success','message'=>'Disbursement request rejected.']); exit;
            }else{
                echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
            }
       }else{
            $disbursementRequestId=$requset->disbursementRequestId;
            $lastloanRequestData = DB::table('raw_materials_loan_requests')->whereId($disbursementRequestId)->first();
            $disbursementTxndate=date('Y-m-d',strtotime($requset->disbursementTxndate));
            if(DB::table('raw_materials_loan_requests')->where(['loanId'=>$lastloanRequestData->loanId,'status'=>'disburse-scheduled'])->exists()){
                echo json_encode(['status'=>'error','message'=>'Disburse schedule request has already exists with this loan.']); exit;
            }else{
                $lastloanRequest = DB::table('raw_materials_loan_requests')->whereId($disbursementRequestId)->update(['disburse_date'=>$disbursementTxndate]);
                
                // $upArr['status']='success';
                // $upArr['openingDate']=$disbursementTxndate;
                $upArr['disburse_date']=$disbursementTxndate;
                $upArr['status'] = 'disburse-scheduled';

                $saved=DB::table('raw_materials_loan_requests')->where('id',$disbursementRequestId)->update($upArr);
                if($saved){
                    $userDtl = User::getUserDetailsById($lastloanRequestData->userId);
                    $acceptURL =   route('viewAdminLaonDetail', ['id'=>md5($lastloanRequestData->loanId)]);
                $htmlStAdmin = '<div style="font-weight: normal;">
                    <br>Dear Admin,</p>
                    <p>Kindly review this loan details.This loan application has been approved and is set for disbursement.To proceed with the disbursement, please confirm your acceptance of the loan.</p>
                    <br/> <br/>
                    <p style="font-weight: bold;">Loan Summary:</p>
                    </br>
                    <p>Customer Name: '.$userDtl->name.'</p><br/>
                    <p>Customer ID: '.$userDtl->customerCode.'</p><br/>
                    <p>Loan ID: #LF0'.$lastloanRequestData->loanId.'</p><br/>
                    <p>Loan Type: Raw Materials Loan</p><br/>
                    <p>Disbursement Request Loan Amount: '.$lastloanRequestData->loanAmount.'</p><br/>
                    <p>Requested Disbursed Date: '.$lastloanRequestData->disburse_date.'</p><br/>
                    <center><a href="' . $acceptURL . '" target="_blank" style="color: blue;font-size: 22px;font-weight: bold;">Click Here To View Loan</a></center>
                </div>';
                $verifyWith = env('APP_NAME');
                if (config('app.env') == "production") {
                    // AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "Loan Disbursement Request #LF0".$lastloanRequestData->loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    AppServiceProvider::sendMail("shorya.mittal@maxemocapital.com", "Shorya Mittal", "Loan Disbursement Request #LF0".$lastloanRequestData->loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    // AppServiceProvider::sendMail("vipul.mittal@maxemocapital.com", "Vipul Mittal", "Loan Disbursement Request #LF0".$lastloanRequestData->loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    AppServiceProvider::sendMail("raju@techmavesoftware.com", "Basant", "Loan Disbursement Request #LF0".$lastloanRequestData->loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    AppServiceProvider::sendMail("ashish.kumar@maxemocapital.com", "Ashish Kumar", "Loan Disbursement Request #LF0".$lastloanRequestData->loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    
                    // AppServiceProvider::sendMail("vivek.mittal@maxemocapital.com", "Vivek Mittal", "Loan Rejected | " . $verifyWith, $htmlStAdmin);
                }else if(config('app.env') == "testing"){
                    AppServiceProvider::sendMail("anjali.negi@maxemocapital.com","Anjali","Loan Disbursement Request #LF0".$lastloanRequestData->loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                 } else {
                    AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "Loan Disbursement Request #LF0".$lastloanRequestData->loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    // AppServiceProvider::sendMail("raju@techmavesoftware.com", "Basant", "Loan Disbursement Request #LF0".$lastloanRequestData->loanId." (Raw Materials Loan) | " . $verifyWith, $htmlStAdmin);
                    // AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "Loan Rejected | " . $verifyWith, $htmlStAdmin);
                }
                    echo json_encode(['status'=>'success','message'=>'Disburse request has been schedule successfully.']); exit;
                }else{
                    echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
                }
            }
        }
    }

    public function collectRawMaterialAmount(Request $request)
    {
        $isValidated=AppServiceProvider::validatePermission('rawmaterial-collect-amount');

        $loanId=$request->loanId;
        $loanAmount=DB::select("SELECT rmd.* FROM raw_materials_txn_details rmd LEFT JOIN raw_materials_txn_details rmc ON rmd.id=rmc.debitRecordId WHERE rmd.txnType='out' AND rmd.loanId='$loanId' AND rmc.id IS NULL ORDER BY rmd.id ASC limit 1");
        $htmlStr ='<div class="row">';

        $htmlStr .='<div class="col-lg-12 mt-3">
            <label><strong>Collect Date</strong></label>
            <input type="date" id="collectionDate" data-date="" data-date-format="DD MMMM YYYY" value="" name="collectionDate" class="form-control">
        </div>';

        $htmlStr .='<div class="col-lg-12 mt-3">
            <label><strong>Collect Amount</strong></label>
            <input type="text" id="collectionAmount" value="" name="collectionAmount" class="form-control">
        </div>';

        $htmlStr .='<div class="col-lg-6 mt-3">
            <label><strong>TXN ID</strong></label>
            <input type="text" id="transactionIdCredit" value="" name="transactionIdCredit" class="form-control">
        </div>
        <div class="col-lg-6 mt-3">
            <label><strong>Payment Mode</strong></label>
            <input type="text" id="payment_modeCredit" value="" name="payment_modeCredit" class="form-control">
        </div>';

        $htmlStr .= '<div class="col-lg-8 mt-3">&nbsp;</div>
            <div class="col-lg-4 mt-3">
            <label><strong>&nbsp;</strong></label>
            <button type="button" onclick="sattleRawMatetialsTxnAutoCustom(this);" class="btn bg-warning btn-warning">Settle Amount</button>
        </div>';

        $htmlStr .='</div>';

        if($htmlStr){
            echo json_encode(['status'=>'success','message'=>'Request has been processed successfully.','data'=>$htmlStr]); exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
        }
    }


    public function sattleRawMatetialsTxnAutoCustom(Request $request)
    {
        $loanId=$request->loanId;
        $debitRecordId=$request->debitRecordId;
        $collectionAmount=$request->collectionAmount;
        $payment_modeCredit=$request->payment_modeCredit;
        $transactionIdCredit=$request->transactionIdCredit;
        //print_r($request->all());exit;
        $objComm=new CommonController();
        
        $collectionDate=(strtotime($request->collectionDate)) ? date('Y-m-d',strtotime($request->collectionDate)) : '';
        session(['collectionAmount'=>$collectionAmount]);

        $currentDate=date('Y-m-d');
        $txnGroupId=strtotime(date('Y-m-d H:i:s')).'|'.$loanId;
        $loopchk=0;
       startSattleTxn:
        $collectionAmount=session('collectionAmount');
        $isFullSettled=0;
        $loanDetails=ApplyLoanHistory::where(['id'=>$loanId])->first();
        if(!empty($loanDetails))
        {
            $rateOfInterest=$loanDetails->rateOfInterest;
            $amountDetails=RawMaterialsTxnDetail::where(['loanId'=>$loanId,'isFullSettled'=>0,'txnType'=>'out'])->orderBY('id','asc')->first();
        //    echo json_encode(['amount'=>$collectionAmount,'amountDetails'=>$amountDetails]);
            if(!empty($amountDetails) && $collectionAmount>0)
            {
                
                $openingDate=$amountDetails->openingDate;

                $transactionDate=date('Y-m-d',strtotime($amountDetails->interestStartDate));
                $amount=$amountDetails->openingBalanceLatest;
                $tenureDueDate=$amountDetails->tenureDueDate;
                           
                $lateCharges=0;
                $numOfDaysOfFine=0;
                $newLateTenureDueDate = date('Y-m-d', strtotime($tenureDueDate. ' + 10 days'));
                if(strtotime($collectionDate)>strtotime($newLateTenureDueDate)){
                    
                    if($collectionAmount>$amount){
                        $lateCharesArr=$objComm->calculateLateCharges($collectionDate,$newLateTenureDueDate,$amount);
                    }else{
                        $lateCharesArr=$objComm->calculateLateCharges($collectionDate,$newLateTenureDueDate,$collectionAmount);
                    }
                    
                    
                    $lateCharges=$lateCharesArr['lateCharges'];
                    $numOfDaysOfFine=$lateCharesArr['numOfDaysOfFine'];
                    
                    $collectionAmount=$collectionAmount-$lateCharges;
                }
               
                $openingBalance=$amount;
                
                $debitRecordId=$amountDetails->id;
                
                if($collectionAmount>$openingBalance){
                    $calcRes=$this->getInterestAndPaybleAmountRawMaterial($loanDetails->tenure,$transactionDate,$collectionDate,$openingBalance,$rateOfInterest);
                    
                }else{
                    $calcRes=$this->getInterestAndPaybleAmountRawMaterial($loanDetails->tenure,$transactionDate,$collectionDate,$collectionAmount,$rateOfInterest);
                }
                
                //echo '<pre>'; print_r($calcRes);exit;
                $numOfDays=$calcRes['numOfDays'];
                $rateOfInterest=$calcRes['rateOfInterest'];
                $loanAmount=$calcRes['loanAmount'];
                $playbleLoanAmount=$calcRes['playbleLoanAmount'];
                $totalInterest=$calcRes['totalInterest'];
                $interestPayble=$calcRes['interestPayble'];
                $tdsPercent=$calcRes['tdsPercent'];
                $tdsAmount=$calcRes['tdsAmount'];
                    
                $leftUserAmount=$collectionAmount-$interestPayble;

                $outstandingBalance=round($amount-$leftUserAmount);
                $interestStartDate=$transactionDate;
                $baseAmountCredit=$leftUserAmount;
                $extraForwardedAmount=0;

                if($leftUserAmount >= $amount){
                    $isFullSettled=1;
                    $outstandingBalance=0;
                    $interestStartDate=NULL;

                    $baseAmountCredit=$amount;

                    $leftUserAmount=round($leftUserAmount-$amount);
                    $collectionAmount=$amount+$interestPayble;
                    $extraForwardedAmount=$leftUserAmount;
                    session(['collectionAmount'=>$leftUserAmount]);
                }else{

                    //$interestStartDate=date('Y-m-d',strtotime($collectionDate.' +1Day'));
                    $baseAmountCredit=$leftUserAmount;

                    $outstandingBalance=$amount-$leftUserAmount;
                    $collectionAmount=$leftUserAmount+$interestPayble;
                    $extraForwardedAmount=($leftUserAmount>=$amount) ? round($leftUserAmount-$amount) : 0;
                    session(['collectionAmount'=>0]);
                }
                $baseAmountCredit =($baseAmountCredit>0) ? $baseAmountCredit : 0;
                

                $this->sattleRawMaterialTxnCustom($loanId,$openingBalance,$openingDate,$debitRecordId,$payment_modeCredit,$transactionIdCredit,$collectionDate,$baseAmountCredit,$totalInterest,$interestPayble,$tdsPercent,$tdsAmount,$numOfDays,$collectionAmount,$outstandingBalance,$interestStartDate,$isFullSettled,$txnGroupId,$lateCharges,$numOfDaysOfFine,$extraForwardedAmount);
                RawMaterialsTxnDetail::where('id',$debitRecordId)->update(['openingBalanceLatest'=>$outstandingBalance,'interestStartDate'=>$interestStartDate,'isFullSettled'=>$isFullSettled]);


                /*if($leftUserAmount>=$amount || $outstandingBalance==0){
                    $isFullSettled=1;
                    $outstandingBalance=0;
                    $interestStartDate=NULL;
                }

                if($amount>=$leftUserAmount)
                {
                    $this->sattleRawMaterialTxnCustom($loanId,$debitRecordId,$payment_modeCredit,$transactionIdCredit,$collectionDate,$baseAmountCredit,$totalInterest,$interestPayble,$tdsPercent,$tdsAmount,$numOfDays,$collectionAmount,$outstandingBalance,$interestStartDate,$isFullSettled);
                    RawMaterialsTxnDetail::where('id',$debitRecordId)->update(['outstandingBalance'=>$outstandingBalance,'interestStartDate'=>$interestStartDate]);
                    session(['collectionAmount'=>0]);
                }else{

                    $this->sattleRawMaterialTxnCustom($loanId,$debitRecordId,$payment_modeCredit,$transactionIdCredit,$collectionDate,$baseAmountCredit,$totalInterest,$interestPayble,$tdsPercent,$tdsAmount,$numOfDays,$collectionAmount,$outstandingBalance,$interestStartDate,$isFullSettled);
                    RawMaterialsTxnDetail::where('id',$debitRecordId)->update(['outstandingBalance'=>$outstandingBalance,'interestStartDate'=>$interestStartDate]);

                    $leftUserAmount=$leftUserAmount-$amount;
                    session(['collectionAmount'=>$leftUserAmount]);
                }
                */
                $loopchk++;
                //if($loopchk==2){exit;}
                goto startSattleTxn;

            }
            echo json_encode(['status'=>'success','message'=>'Transaction has been settled successfully.']); exit;
        }
        echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
    }


    public function getInterestAndPaybleAmountRawMaterial($tenureId,$transactionDate,$collectionDate,$amount,$rateOfInterest)
    {
        $tenuverMonth = DB::table('tenures')->whereId($tenureId)->pluck('name')->first();

        $tmonth = 2;
        if($tenuverMonth){
            $newData = explode('Days',$tenuverMonth);
            $tmonth = (int)trim($newData[0]) ?? 2;
        }

        $datetime1 = date_create($transactionDate);
        $datetime2 = date_create($collectionDate);

        // Calculates the difference between DateTime objects
        $interval = date_diff($datetime1, $datetime2);

        // Display the result
        $numOfDays=$interval->format('%a');
        if($tmonth == 30 && $numOfDays <= 7){
            $numOfDays = 7;
        }elseif($tmonth > 30 && $numOfDays <= 15){
            $numOfDays = 15;
        }

        $oneYearInterest=($amount*$rateOfInterest)/100;
        $oneDayInterest=$oneYearInterest/365;
        $totalInterest=$oneDayInterest*$numOfDays;

        $tdsPercent=10;
        $tdsAmount=($totalInterest*$tdsPercent)/100;
        $interestPayble=$totalInterest-$tdsAmount;
        $playbleLoanAmount=round($amount+$interestPayble);
        $returnArr=['numOfDays'=>$numOfDays,'rateOfInterest'=>$rateOfInterest,'loanAmount'=>round($amount),'playbleLoanAmount'=>$playbleLoanAmount,'totalInterest'=>round($totalInterest),'interestPayble'=>round($interestPayble),'tdsPercent'=>round($tdsPercent),'tdsAmount'=>round($tdsAmount)];
        return $returnArr;
    }


    public function sattleRawMaterialTxn(Request $request)
    {
        $loanId=$request->loanId;
        $loanDetails=ApplyLoanHistory::where(['id'=>$loanId])->first();
        $userId=0;
        if(!empty($loanDetails)){
            $userId=$loanDetails->userId;
        }
        $debitRecordId=$request->debitRecordId;
        $collectionDate=(strtotime($request->collectionDate)) ? date('Y-m-d',strtotime($request->collectionDate)) : '';

        $currentDate=date('Y-m-d H:i:s');
        $baseAmountCredit=$request->baseAmountCredit;
        $transactionIdCredit=$request->transactionIdCredit;
        $payment_modeCredit=$request->payment_modeCredit;
        $interestAmountCredit=$request->interestAmountCredit;
        $numOfDaysCredit=$request->numOfDaysCredit;
        $paybleAmountCredit=$request->paybleAmountCredit;
        $tdsPercentCredit=$request->tdsPercentCredit;
        $tdsAmountCredit=$request->tdsAmountCredit;
        $interestAmountPaybleCredit=$request->interestAmountPaybleCredit;

        $saveArr['userId']=$userId;
        $saveArr['loanId']=$loanId;
        $saveArr['debitRecordId']=$debitRecordId;
        $saveArr['payment_mode']=$payment_modeCredit;
        $saveArr['transactionId']=$transactionIdCredit;
        $saveArr['transactionDate']=$collectionDate;
        $saveArr['amount']=$baseAmountCredit;
        $saveArr['interestAmount']=$interestAmountCredit;
        $saveArr['interestAmountPayble']=$interestAmountPaybleCredit;
        $saveArr['tdsPercent']=$tdsPercentCredit;
        $saveArr['tdsAmount']=$tdsAmountCredit;
        $saveArr['numOfDays']=$numOfDaysCredit;
        $saveArr['totalAmount']=$paybleAmountCredit;
        $saveArr['txnType']='in';
        $saveArr['status']='success';
        $saveArr['created_at']=$currentDate;
        $saveArr['updated_at']=$currentDate;
        $save=DB::table('raw_materials_txn_details')->insertGetId($saveArr);
        if($save){
            echo json_encode(['status'=>'success','message'=>'Requested transaction has been settled successfully.']); exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
        }
    }

    public function sattleRawMaterialTxnCustom($loanId,$openingBalance,$openingDate,$debitRecordId,$payment_modeCredit,$transactionIdCredit,$collectionDate,$baseAmountCredit,$interestAmountCredit,$interestAmountPaybleCredit,$tdsPercentCredit,$tdsAmountCredit,$numOfDaysCredit,$paybleAmountCredit,$outstandingBalance,$interestStartDate,$isFullSettled,$txnGroupId,$lateCharges,$numOfDaysOfFine,$extraForwardedAmount)
    {

        $loanDetails=ApplyLoanHistory::where(['id'=>$loanId])->first();
        $userId=0;
        if(!empty($loanDetails)){
            $userId=$loanDetails->userId;
        }

        $collectionDate=(strtotime($collectionDate)) ? date('Y-m-d',strtotime($collectionDate)) : '';

        $currentDate=date('Y-m-d H:i:s');

        $saveArr['userId']=$userId;
        $saveArr['loanId']=$loanId;
        $saveArr['debitRecordId']=$debitRecordId;
        $saveArr['payment_mode']=$payment_modeCredit;
        $saveArr['transactionId']=$transactionIdCredit;
        $saveArr['transactionDate']=$collectionDate;
        $saveArr['amount']=$baseAmountCredit;
        $saveArr['openingDate']=$openingDate;
        $saveArr['openingBalance']=$openingBalance;
        $saveArr['interestAmount']=$interestAmountCredit;
        $saveArr['interestAmountPayble']=$interestAmountPaybleCredit;
        $saveArr['tdsPercent']=$tdsPercentCredit;
        $saveArr['tdsAmount']=$tdsAmountCredit;
        $saveArr['numOfDays']=$numOfDaysCredit;
        $saveArr['totalAmount']=$paybleAmountCredit;
        $saveArr['outstandingBalance']=$outstandingBalance;
        $saveArr['interestStartDate']=$interestStartDate;
        $saveArr['isFullSettled']=$isFullSettled;
        $saveArr['txnGroupId']=$txnGroupId;        
        $saveArr['lateCharges']=$lateCharges;
        $saveArr['numOfDaysOfFine']=$numOfDaysOfFine;
        $saveArr['extraForwardedAmount']=$extraForwardedAmount;
        $saveArr['txnType']='in';
        $saveArr['status']='success';
        $saveArr['created_at']=$currentDate;
        $saveArr['updated_at']=$currentDate;
        $save=DB::table('raw_materials_txn_details')->insertGetId($saveArr);
        if($save){
           return true;
        }else{
            return false;
        }
    }


    public function increateCreditLimitRawmaterial(Request $request)
    {
        $loanIdCreditLimit=$request->loanIdCreditLimit;
        $maxLimitAmount=$request->maxLimitAmount;
        $platformFee = $request->platformFee;

        $loanData = ApplyLoanHistory::where('id',$loanIdCreditLimit)->first();
        $rawLoanData = RenewalLoan::where('id',$loanIdCreditLimit)->first();
        $renewal_from = $rawLoanData->renewal_from ?? $loanData->validFromDate;
        $renewal_to = $rawLoanData->renewal_to ?? $loanData->validToDate;
        $newLimit = $maxLimitAmount+$loanData->approvedAmount;
        
        $save=ApplyLoanHistory::where('id',$loanIdCreditLimit)->update(['approvedAmount'=>$newLimit]);
        if($save){
            $rawData = ['userId'=>$loanData->userId,'loanid'=>$loanIdCreditLimit,'plateform_fee'=>$platformFee,'renewal_from'=>$renewal_from,'renewal_to'=>$renewal_to,'txn_date'=>date('Y-m-d'),'type_renewal'=>'pf','updatedAmount'=>$newLimit,'lastAmount'=>$loanData->approvedAmount];
            RenewalLoan::insert($rawData);
            echo json_encode(['status'=>'success','message'=>'You request has been processed successfully.']); exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']); exit;
        }
        
    }




    public function renewalRawMaterialAppliedLoans(Request $request){
        $this->validate($request,[
            "actionLoanId" => "required",
            "actionUserId" => "required",
            "renewalAmount" => "required",
            "renewtxndate" => "required|date"
        ]);

        $loanDetail =  DB::table('apply_loan_histories')->where('id',$request->actionLoanId)->first();

        $validFrom = $loanDetail->validFromDate;
        $validToRenew = $loanDetail->validToDate;
        $validTo = date('Y-m-d',strtotime('+1 year', strtotime($loanDetail->validToDate)));
        // DB::table('renewal_loans')->insert(['loanid'=>$request->actionLoanId,'userId'=>$request->actionUserId,'plateform_fee'=>$request->renewalAmount,'renewal_from'=>$validFrom,'renewal_to'=>$validToRenew,'txn_date'=>$request->renewtxndate]);
        DB::table('renewal_loans')->insert(['loanid'=>$request->actionLoanId,'userId'=>$request->actionUserId,'plateform_fee'=>$request->renewalAmount,'renewal_from'=>$validToRenew,'renewal_to'=>$validTo,'txn_date'=>$request->renewtxndate]);
        DB::table('apply_loan_histories')->where('id',$request->actionLoanId)->update(['validToDate'=>$validTo]);

        return redirect()->back()->with('success','Loan Renewed Successfully !');
    }



    public function getRawMaterialLoanCalcOnTxn_old(Request $request)
    {
        $loanId=$request->loanId;
        $debitRecordId=$request->debitRecordId;
        $collectionDate=(strtotime($request->collectionDate)) ? date('Y-m-d',strtotime($request->collectionDate)) : '';

        $loanDetails=ApplyLoanHistory::where(['id'=>$loanId])->first();
        if(!empty($loanDetails))
        {
            $rateOfInterest=$loanDetails->rateOfInterest;
            $amountDetails=RawMaterialsTxnDetail::where(['id'=>$debitRecordId,'txnType'=>'out'])->first();
            if(!empty($amountDetails))
            {
                $transactionDate=date('Y-m-d',strtotime($amountDetails->transactionDate));
                $amount=$amountDetails->amount;

                $calcRes=$this->getInterestAndPaybleAmountRawMaterial($loanDetails->tenure,$transactionDate,$collectionDate,$amount,$rateOfInterest);
                if($calcRes){
                    echo json_encode(['status'=>'success','message'=>'Request has been processed successfully.','data'=>$calcRes]); exit;
                }else{
                    echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
                }
            }
        }
        echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
    }
}