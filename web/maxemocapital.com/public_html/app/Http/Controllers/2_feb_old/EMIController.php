<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplyLoanHistory;
use App\Models\Category;
use App\Models\LoanEmiDetail;
use App\Models\LoanPreCloserHistory;
use App\Models\OutStandingPaymentHistory;
use App\Models\Tenure;
use App\Models\User;
use App\Models\UserBankDetail;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\DB;

class EMIController extends Controller
{

    public function previewEMIDetails(Request $request){
        $loanId = $request->loanId;
        $productId = $request->productId;

        $loanDetails=ApplyLoanHistory::where('id',$loanId)->first();

        $disbursedDate= date('d-m-Y',strtotime($request->current_month));
        $currentDayOfMonth=(int)date("d", strtotime($disbursedDate));
        if($currentDayOfMonth == 4 || $currentDayOfMonth == 5){
            $extraAmountDays=0;
            $disbursedDate= date('d-m-Y',strtotime($request->current_month.'-1 month'));
        }elseif($currentDayOfMonth < 4){
            $extraAmountDays=4-$currentDayOfMonth;
            $disbursedDate= date('d-m-Y',strtotime($request->current_month.'-1 month'));
        }else{
            $lastDayOfMonth=date("t", strtotime($disbursedDate))+4;
            $extraAmountDays=$lastDayOfMonth-$currentDayOfMonth;
            
        }
        
        $htmldata = '';

        if(!empty($loanDetails))
        {
            $rateOfInterest=$loanDetails->rateOfInterest;
            $approvedAmount=$loanDetails->approvedAmount;
            $loanCategory=$loanDetails->loanCategory;
            
            
            $roiType=$loanDetails->roiType;
            
            if($roiType=='reducing_roi' || $roiType=='fixed_interest_roi' || $roiType=='bullet_repayment'){
                $skipMonths=' +1 Month';
            }else{
                if($loanDetails->loanCategory == 8){
                $skipMonths=' ';
                }else{
                    $skipMonths=' +3 Months';
                }
            }
            
            if($roiType=='quaterly_interest'){
                $emiLabelMonth='Quarterly Emi';
            }else if($roiType=='reducing_roi'){
                $emiLabelMonth='Monthly EMI';
            }else{
                $emiLabelMonth='EMI';
            }
            
            $monthlyEMI=$loanDetails->monthlyEMI;
            $totalInterest=$loanDetails->totalInterest;

            $approvedTenureText='';
            $tenureDtl=Tenure::where('id',$loanDetails->approvedTenure)->first();
            if(!empty($tenureDtl)){
                $approvedTenureText=$tenureDtl->name;
            }

            $plateformFee=0;
            $insurance=0;
            $principleChargesDetailsStr=$loanDetails->principleChargesDetails;
            $principleChargesDetailsArr=json_decode($principleChargesDetailsStr);
            if(!empty($principleChargesDetailsArr)){
                $plateformFee=$principleChargesDetailsArr->plateformFee;
                $insurance=$principleChargesDetailsArr->insurance;
            }
            $emisDetailsStr = null;
            
            if($loanDetails->loanCategory==8)
            {
                $numOfEmis = $tenureDtl->numOfEmis;
                
                $objComm=new CommonController();
                $payment_date=date('Y-m-12');
                $interestStartDate=$disbursedDate;
                if($roiType=='quaterly_interest')
                {
                    $monthlyEmiLabel='Quarterly EMI';
                    $emisDetailsArr=$objComm->getQuarterlyDaysWiseEmis($numOfEmis,$rateOfInterest,$approvedAmount,$payment_date,$interestStartDate,$loanDetails->tds);
                    $extraIntrestAmount=0;
                    $extraAmountDays=0;
                }else if($roiType=='fixed_interest_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getFixedInterestDaysWiseEmis($numOfEmis,$rateOfInterest,$approvedAmount,$payment_date,$interestStartDate,$loanDetails->tds);
                    $extraIntrestAmount=$emisDetailsArr['extraDaysInterest'];
                    $extraAmountDays=$emisDetailsArr['extraNumDays'];
                }
                // dd($emisDetailsArr,array_sum(array_column($emisDetailsArr['emiList'],'netInterest')));
                
                
                $monthlyEMI=$emisDetailsArr['emiAmount'];
                $totalInterest=$emisDetailsArr['totalInterest'];
                //$netDisbursementAmount=$loanDetails->netDisbursementAmount-$extraIntrestAmount;
                $netDisbursementAmount=$loanDetails->netDisbursementAmount;
                $emisDetailsStr= json_encode($emisDetailsArr);
                // ApplyLoanHistory::where('id',$loanId)->update(['extraAmountDays'=>$extraAmountDays,'extraIntrestAmount'=>$extraIntrestAmount]);
            }else{
                $payment_date=$disbursedDate;
                $totalIneterest=($approvedAmount*$rateOfInterest)/100;
                $oneDayInterest=$totalIneterest/365;

                $extratdsAmount= (round($oneDayInterest*$extraAmountDays)*$loanDetails->tds)/100;

                $extraIntrestAmount=($oneDayInterest*$extraAmountDays)-$extratdsAmount;
                $numOfEmis = $tenureDtl->numOfEmis;
                $objComm=new CommonController();
                if($roiType=='reducing_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getEmisPMT($numOfEmis,$rateOfInterest,$approvedAmount,$payment_date,$loanDetails->tds);
                }else if($roiType=='quaterly_interest')
                {
                    $monthlyEmiLabel='Quarterly EMI';
                    $emisDetailsArr=$objComm->getQuarterlyEmis($numOfEmis,$rateOfInterest,$approvedAmount,$payment_date,$loanDetails->tds);
                }else if($roiType=='fixed_interest_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getFixedInterestEmis($numOfEmis,$rateOfInterest,$approvedAmount,$payment_date,$loanDetails->tds);
                }
                // $netDisbursementAmount=$loanDetails->netDisbursementAmount-$extraIntrestAmount;
                $netDisbursementAmount=$loanDetails->netDisbursementAmount;
                $emisDetailsStr= json_encode($emisDetailsArr);
            }
            ApplyLoanHistory::where('id',$loanId)->update(['extraAmountDays'=>$extraAmountDays,'extraIntrestAmount'=>$extraIntrestAmount]);
            $htmldata .= '<div class="row m-3 text-center" style="border: 4px solid gainsboro;padding: 10px;text-align: center;">
            <div class="col-md-12 mb-3" style="padding: 10px 0px;background: #ecd8ff;"><p style="font-size:22px;font-weight: 600;">Preview</p></div>
            <div class="col-md-6">
                <strong>Breakup Days : </strong> <span style="font-weight: 700;color: #d40808;">'.$extraAmountDays.'</span>
                </div>
                <div class="col-md-6">
                  <strong>  Breakup Interest : </strong><span style="font-weight: 700;color: #d40808;">'.number_format($extraIntrestAmount,2).'</span>
                </div>
            </div>
            <table class="table basic_tablecustom">
            <thead>
                <tr>
                <th scope="col">EMI ID</th>';
                if($loanDetails->roiType =='quaterly_interest'){ $mtxt ='QUARTERLY';}else{$mtxt ='MONTHLY';}
                if($loanDetails->loanCategory == 8){
                    $htmldata .= '<th scope="col">'.$mtxt.' Interest</th>';
                }else{
                    $htmldata .= '<th scope="col">EMI Amount</th>';
                    if($loanDetails->tds > 0 && $loanDetails->loanCategory == 1){
                        $htmldata .= '<th scope="col">NET EMI Amount</th>';
                    }
                }
                $htmldata .= '<th scope="col">PRINCIPLE</th>';
                if($loanDetails->loanCategory != 8){
                $htmldata .='<th scope="col">INTEREST</th>';
                }
                if($loanDetails->tds > 0){
                    $htmldata .= '<th scope="col">TDS %</th>
                    <th scope="col">TDS AMOUNT</th>';
                    if($loanDetails->loanCategory == 8){
                        $htmldata .= '<th scope="col">NET '.$mtxt.' INTEREST</th>';
                    }else{
                        $htmldata .= '<th scope="col">NET INTEREST</th>';
                    }
                }
                $htmldata .= '<th scope="col">BALANCE</th>
                <th scope="col">START DATE</th>
                <th scope="col">DUE DATE</th>
                </tr>
                </thead>
                <tbody>';
            
            $emisDetailsArr=json_decode($emisDetailsStr);

            if(!empty($emisDetailsArr))
            {
                
                $emiList=$emisDetailsArr->emiList;
                if(!empty($emiList))
                {
                    foreach($emiList as $erow)
                    {
                        $emiMonth=date('m',strtotime($erow->payDate.$skipMonths));
                        $emiYear=date('Y',strtotime($erow->payDate.$skipMonths));
                        $emiDate = date($emiYear.'-'.$emiMonth.'-05');
                        $emiDueDate=date($emiYear.'-'.$emiMonth.'-12');



                        $htmldata .= '<tr>
                        <td>EM'.$loanId.'0'.$erow->emiSr.'</td>
                        <td>'. number_format($erow->emiAmount,2).'</td>';
                        if($loanDetails->tds > 0 && $loanDetails->loanCategory == 1){
                            $htmldata .= '<td>'. number_format($erow->netemiAmount,2).'</td>';
                        }
                        $htmldata .='<td>'.number_format($erow->principle,2).'</td>';
                        if($loanDetails->loanCategory != 8){
                            $htmldata .= '<td>'.number_format($erow->interest,2).'</td>';
                        }
                       if($loanDetails->tds > 0){
                            $htmldata .='<td>'.$loanDetails->tds.'</td>';
                            $htmldata .='<td>'.$erow->tdsAmount.'</td>';
                            $htmldata .='<td>'.number_format($erow->netInterest,2).'</td>';
                        }
                            $htmldata .='<td>'.number_format($erow->balance,2).'</td>
                        <td>'.$emiDate.'</td>
                        <td>'.$emiDueDate.'</td>
                        </tr>';
                    }
                }
            }

            $htmldata .= '</tbody></table>';

        }

        return ['htmldata'=>$htmldata,'extradays'=>$extraIntrestAmount];
    }


     //TODO LOan EMI Details
     public function getLoanEmiDetails(Request $request)
     {
         
         $payOutStandingTxnDateMaxDate='';
         $isValidated=AppServiceProvider::validatePermission('view-emi-details');
 
         $loanId=$request->loanId;
 
         $loanDetailsArr=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.id='$loanId' ORDER BY alh.id DESC");
         if(count($loanDetailsArr))
         {
             $loanDetails=$loanDetailsArr[0];
         }
 
         $userId=$loanDetails->userId;
 
         $plateformFee=0;
         $insurance=0;
         $principleChargesDetailsArr=[];
         if($loanDetails->principleChargesDetails)
         {
             $principleChargesDetailsArr=json_decode($loanDetails->principleChargesDetails,true);
             $plateformFee=(isset($principleChargesDetailsArr['plateformFee'])) ? $principleChargesDetailsArr['plateformFee'] : 0;
             $insurance=(isset($principleChargesDetailsArr['insurance'])) ? $principleChargesDetailsArr['insurance'] : 0;
         }
 
         $paybleAmount=$loanDetails->approvedAmount+$loanDetails->totalInterest;
         $extraAmountDays=$loanDetails->extraAmountDays;
         $extraIntrestAmount=$loanDetails->extraIntrestAmount;
         $netDisbursementAmount= $loanDetails->netDisbursementAmount;
         $roiType=$loanDetails->roiType;
         
         $principleDeposited = 0;
         if($loanDetails->loanCategory == 8){
             $principleDepositedold = DB::select("SELECT IFNULL(SUM(amount),0) AS principleDeposited FROM out_standing_payment_histories WHERE type='credit' AND loanId='$loanId'");
             $principleDeposited = $principleDepositedold[0]->principleDeposited;
             $totalIntersetAmount = DB::select("SELECT IFNULL(SUM(netInterest),0) AS principleDeposited FROM loan_emi_details WHERE loanId='$loanId'")[0]->principleDeposited;
             $totalPayIntersetAmount = DB::select("SELECT IFNULL(SUM(netInterest),0) AS principleDeposited FROM loan_emi_details WHERE loanId='$loanId' AND status='success'")[0]->principleDeposited ?? 0;
             $outstandingInter = $totalIntersetAmount - $totalPayIntersetAmount;
         }else{
             $principleDepositedold = DB::select("SELECT IFNULL(SUM(principle),0) AS principleDeposited FROM loan_emi_details WHERE  status='success' AND loanId='$loanId'");
             $principleDeposited = $principleDepositedold[0]->principleDeposited;
         }

         if($roiType=='bullet_repayment' && $loanDetails->status == "closed"){
            $outstanding_amount = 0;
         }else{
            $outstanding_amount =  $netDisbursementAmount - $principleDeposited;
         }
         
 
         $userDtl=User::getUserDetailsById($userId);
 
         $emiDetails=LoanEmiDetail::where(['userId'=>$userId,'loanId'=>$loanId])->orderBy('emiSr','asc')->get();
         $disburseDate=(strtotime($loanDetails->disbursedDate)) ? date('d/m/Y',strtotime($loanDetails->disbursedDate)) : '';
         $htmlStr =' <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card popcolored_card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-start">
                                    <span class="fs-14 font-weight-semibold" style="font-size: 13px;">Customer ID</span>
                                    <h5 class="mb-0 mt-1 mb-2">'.$userDtl->customerCode.'</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="icon1 bg-success my-auto  float-end"> <i data-feather="user" class="btn-icon-prepend"></i></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card popcolored_card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-start">
                                    <span class="fs-14 font-weight-semibold" style="font-size: 13px;">Loan Amount</span>
                                    <h5 class="mb-0 mt-1 mb-2">'.$loanDetails->approvedAmount.'</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="icon1 bg-secondary brround my-auto  float-end"> <i data-feather="dollar-sign" class="btn-icon-prepend  "></i> </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card popcolored_card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mt-0 text-start">
                                    <span class="fs-14 font-weight-semibold" style="font-size: 13px;">Disbursed Date</span>
                                    <h5 class="mb-0 mt-1 mb-2">'.$disburseDate.'</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="icon1 bg-primary my-auto  float-end"> <i data-feather="calendar" class="btn-icon-prepend "></i> </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>';
                    
                    
                            $productStr ='';
                    
                            $productStr .='
                    <div class="col-lg-6 mt-3">
                        <label ><strong>Product Name</strong></label><br>
                        <label>'.$loanDetails->categoryName.'</label>
                    </div>';
                    if($loanDetails->loanCategory!=3)
                    {
                        $roiTypeLabel=AppServiceProvider::getROITypeHeading($roiType);
                        $productStr .='<div class="col-lg-6 mt-3">
                            <label ><strong>ROI Type</strong></label><br>
                            <label>'.$roiTypeLabel.'</label>
                        </div>';   
                    }
                    $productStr .='<div class="col-lg-6 mt-3">
                        <label ><strong>ROI</strong></label><br>
                        <label>'.$loanDetails->rateOfInterest.' %</label>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <label><strong>Loan Amount</strong></label><br>
                        <label>'.$loanDetails->approvedAmount.' </label>
                    </div>';
                    if($loanDetails->roiType !='bullet_repayment')
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                            <label ><strong>Tenure</strong></label><br>
                            <label>'.$loanDetails->approvedTenureD.' </label>
                        </div>';
                    }
                    if($loanDetails->monthlyEMI)
                    {
                        
                        if($roiType=='quaterly_interest'){
                            $emiLabelMonth='Quarterly Emi';
                        }else if($roiType=='reducing_roi'){
                            $emiLabelMonth='Monthly EMI';
                        }else{
                            $emiLabelMonth='EMI';
                        }
                        // $productStr .='<div class="col-lg-6 mt-3">
                        //     <label ><strong>'.$emiLabelMonth.'</strong></label><br>
                        //     <label>'.$loanDetails->monthlyEMI.' </label>
                        // </div>';    
                    }
                    
                    if($loanDetails->monthlyEMI)
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                            <label ><strong>Total Interest</strong></label><br>
                            <label>'.$loanDetails->totalInterest.' </label>
                        </div>'; 
                    }
                    
                    
                    if($plateformFee)
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                            <label ><strong>Plateform Fee</strong></label><br>
                            <label>'.$plateformFee.' </label>
                        </div>';
                    }
                    
                    if($insurance)
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                            <label ><strong>Insurance Fee</strong></label><br>
                            <label>'.$insurance.' </label>
                        </div>';
                    }
                    
                    if($extraAmountDays)
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                            <label ><strong>Extra Days</strong></label><br>
                            <label>'.$extraAmountDays.' </label>
                        </div>';
                    }
                    
                    if($extraIntrestAmount)
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                            <label ><strong>Extra Days Interest</strong></label><br>
                            <label>'.$extraIntrestAmount.' </label>
                        </div>';
                    }
                    
                    if($loanDetails->exclude_pfif && $loanDetails->exclude_pfif == 1)
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                        <label ><strong>Include PF/Insurance Fee </strong></label><br>
                        <label>Yes</label>
                    </div>';
                    }else
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                        <label ><strong>Include PF/Insurance Fee </strong></label><br>
                        <label>No</label>
                    </div>';
                    }

                    if($loanDetails->include_extradays && $loanDetails->include_extradays == 1)
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                        <label ><strong>Include Extradays </strong></label><br>
                        <label>Yes</label>
                    </div>';
                    }else
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                        <label ><strong>Include Extradays </strong></label><br>
                        <label>No</label>
                    </div>';
                    }
                    
                    if($loanDetails->disbursementAmount)
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                            <label ><strong>Net Disbursement Amount</strong></label><br>
                            <label>'. number_format($loanDetails->disbursementAmount,2).' </label>
                        </div>';
                    }
                    
                    
                    if($paybleAmount && $roiType!='bullet_repayment')
                    {
                        $productStr .='<div class="col-lg-6 mt-3">
                            <label ><strong>Payble Amount</strong></label><br>
                            <label>'.$paybleAmount.' </label>
                        </div>';
                    }
                    // if($outstanding_amount){
                        $productStr .='<div class="col-lg-6 mt-3">
                            <label ><strong>Outstanding Amount</strong></label><br>
                            <label>'.number_format($outstanding_amount,2).' </label>
                        </div>';
                    // }
                    if($loanDetails->loanCategory==8){
                        
                        $productStr .='<div class="col-lg-6 mt-3">
                        <label ><strong>Outstanding Interest </strong></label><br>
                        <label>'.number_format($outstandingInter,2).' </label>
                        </div>';
                    }
 
 
            if($roiType=='bullet_repayment' && $loanDetails->status=='disbursed')
            {
            
                $productStr .='<div class="col-lg-12 mt-3"> <hr></div>';
                $productStr .='<div class="col-lg-6 mt-3">
                <input type="hidden" name="bullet_repaymentLoanId" value="'.$loanDetails->id.'" id="bullet_repaymentLoanId">
                    <label ><strong>Collection Date </strong></label><br>
                    <label><input type="date" class="form-control" name="bullet_repaymentCollectDate"  id="bullet_repaymentCollectDate"> </label>
                </div>';
                $productStr .='<div class="col-lg-6 mt-3 bullet_repaymentHtml" style="display:none;">
                    <label ><strong>Total Interest</strong></label><br>
                    <label><input type="number" disabled class="form-control" name="bullet_repaymentTotalInterest" id="bullet_repaymentTotalInterest"> </label>
                </div>';
                $productStr .='<div class="col-lg-6 mt-3 bullet_repaymentHtml" style="display:none;">
                    <label ><strong>Interest Days</strong></label><br>
                    <label><input type="text" disabled disabled class="form-control" name="bullet_repaymentInterestDays" id="bullet_repaymentInterestDays"> </label>
                </div>';
                $productStr .='<div class="col-lg-6 mt-3 bullet_repaymentHtml" style="display:none;">
                    <label ><strong>Payble Amount</strong></label><br>
                    <label><input type="number" disabled class="form-control" name="bullet_repaymentPaybleAmount" id="bullet_repaymentPaybleAmount"> </label>
                </div>';
                $productStr .='<div class="col-lg-6 mt-3 bullet_repaymentHtml" style="display:none;">
                    <label ><strong>Transaction Id</strong></label><br>
                    <label><input type="text" class="form-control" name="bullet_repaymentTXNID" id="bullet_repaymentTXNID"> </label>
                </div>';
                $productStr .='<div class="col-lg-6 mt-3 bullet_repaymentHtml" style="display:none;">
                    <label ><strong>Payment Method</strong></label><br>
                    <label><input type="text" class="form-control" name="bullet_repaymentPaymentMethod" id="bullet_repaymentPaymentMethod"> </label>
                </div>';
                $productStr .='<div class="col-lg-6 mt-3">
                <label ><strong>&nbsp;</strong></label><br>
                    <button type="button" id="bullet_repaymentSetButton" onclick="getPaybleAmountBulletRepayment('.$loanDetails->id.');" class="btn btn-warning bg-warning">Get Payble Amount</button>
                </div>';
            }
 
            if($loanDetails->isPreClosed==1)
            {
                $preClosedHistory=LoanPreCloserHistory::where('id',$loanDetails->preCloserId)->first();
                if(!empty($preClosedHistory))
                {
                    $isWithChargesStr=($preClosedHistory->isWithCharges==1) ? 'With Charges' : 'With Out Charges';
                    $productStr .='
                        <div class="col-lg-12 mt-3">
                        <center><h3>Forecloser Details</h3></center>
                        </div>
                    <div class="col-lg-6 mt-3">
                        <label ><strong>Charge Type</strong></label><br>
                        <label>'.$isWithChargesStr.'</label>
                    </div>';
                    
                    $productStr .='
                    <div class="col-lg-6 mt-3">
                        <label ><strong>Principle O/s</strong></label><br>
                        <label>'.$preClosedHistory->principleDeposit.'</label>
                    </div>';
                    
                    $productStr .='
                    <div class="col-lg-6 mt-3">
                        <label ><strong>Forecloser Charges</strong></label><br>
                        <label>'.$preClosedHistory->posChargePercentage.' % of POS</label>
                    </div>';
                    
                    $productStr .='
                    <div class="col-lg-6 mt-3">
                        <label ><strong>Forecloser Amount</strong></label><br>
                        <label>'.$preClosedHistory->posChargeAmount.'</label>
                    </div>';
                    
                    $productStr .='
                    <div class="col-lg-6 mt-3">
                        <label ><strong>GST- '.$preClosedHistory->gstPercentage.' %</strong></label><br>
                        <label>'.$preClosedHistory->gstAmount.'</label>
                    </div>';
                    
                    $productStr .='
                    <div class="col-lg-6 mt-3">
                        <label ><strong>Total Forecloser Amount</strong></label><br>
                        <label>'.$preClosedHistory->totalPreCloserAmount.'</label>
                    </div>';
                    
                    $productStr .='
                    <div class="col-lg-6 mt-3">
                        <label ><strong>Final Amount Taken</strong></label><br>
                        <label>'.$preClosedHistory->totalPaybleAmount.'</label>
                    </div>';
                }
            }
 
 
         $htmlStr .='<div class="col-lg-12 col-md-12">
                    <div class="card popcolored_card">
                    <div class="card-body">
                        <div class="row">
                            '.$productStr.'
                        </div>
                    </div>
                    </div>
                </div>
            </div>';
 
 
        if($loanDetails->status=='disbursed'){
         
         $totalPinnciple=0;
         $leftEmi=DB::select("SELECT SUM(principle) as totalPinnciple FROM loan_emi_details WHERE loanId=".$loanDetails->id." AND status!='success'");
         if(count($leftEmi))
         {
             $totalPinnciple=($leftEmi[0]->totalPinnciple) ? $leftEmi[0]->totalPinnciple : 0;
         }
         
         if($loanDetails->loanCategory==8){
             $totalOutStandingBal=DB::select("SELECT ((SELECT IFNULL(approvedAmount,0) FROM apply_loan_histories WHERE id='$loanId' AND status='disbursed')-(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='credit')) as totalOutStanding")[0]->totalOutStanding;
             $totalPinnciple=$totalOutStandingBal;
         }
         
         if($totalPinnciple>0){
             
             $foreCloserFee=$totalPinnciple*4/100;
             $gstOfForecloser=$foreCloserFee*18/100;
             $totalForeCloser= $foreCloserFee+$gstOfForecloser;            
             $totalPaybleAmt= number_format($totalPinnciple+$foreCloserFee+$gstOfForecloser,2);
             $totalPaybleAmtNum=$totalPinnciple+$foreCloserFee+$gstOfForecloser;
             
             $preCloserStr=json_encode(['totalPinnciple'=>$totalPinnciple,'foreCloserPercent'=>'4','foreCloserAmount'=>$foreCloserFee,'gstPercentOnForeCloser'=>'18','gstAmountOnForeCloser'=>$gstOfForecloser,'totalForeCloser'=>$totalForeCloser,'totalPaybleAmt'=>$totalPaybleAmtNum]);
             
             $foreCloserFeeWc=0;
             $gstOfForecloserWc=0;
             $totalForeCloserWc= $foreCloserFeeWc+$gstOfForecloserWc;
             $totalPaybleAmtWc= number_format($totalPinnciple+$foreCloserFeeWc+$gstOfForecloserWc,2);
             $totalPaybleAmtNumWc=$totalPinnciple+$foreCloserFeeWc+$gstOfForecloserWc;
             
             $preCloserStrWc=json_encode(['totalPinnciple'=>$totalPinnciple,'foreCloserPercent'=>'4','foreCloserAmount'=>$foreCloserFeeWc,'gstPercentOnForeCloser'=>'18','gstAmountOnForeCloser'=>$gstOfForecloserWc,'totalForeCloser'=>$totalForeCloserWc,'totalPaybleAmt'=>$totalPaybleAmtNumWc]);
             
             $htmlStr .='<div class="col-lg-12 col-md-12">
                     <div class="card popcolored_card">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-4">
                                 <a href="javascript:;" onclick="showCloserTypeHtml();"  class="action-btns1 text-danger"><i class="fa fa-wrench"></i> Sattle Loan </a>
                              </div>
                              <div class="col-md-8">
                                 &nbsp;
                              </div>
                              <textarea style="display:none;" id="totalCalcStr" >'.$preCloserStr.'</textarea>
                              <textarea style="display:none;" id="totalCalcStrWc" >'.$preCloserStrWc.'</textarea>
                              <div class="col-md-8 mt-5 closeTypeHtml" style="display:none;">
                                 <strong>Select Type</strong><br>
                                 <label><input type="radio" name="closeType" onclick="showCLoserCharges(this.value)" value="with-charges"> With Charges</label><br>
                                 <label><input type="radio" name="closeType" onclick="showCLoserCharges(this.value)" value="with-out-charge"> With Out Charges</label><br>
                              </div>
                              <div class="row closercharge with-charges" style="display:none;">
                                 <div class="col-md-6 mt-2">
                                     <strong>Loan Amount Sanction</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'. number_format($loanDetails->approvedAmount,2).'</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>Principle O/s</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'. number_format($totalPinnciple,2).'</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>Foreclosure Charges</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>4% of POS</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>Foreclosure Amount</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'. number_format($foreCloserFee,2).'</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>GST 18%</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'. number_format($gstOfForecloser,2).'</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>Total Foreclosure Amount</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'. number_format($totalForeCloser,2).'</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>Final Amount To Be Taken</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'.$totalPaybleAmt.'</label>
                                  </div>
                             </div>
                             <div class="row closercharge with-out-charge" style="display:none;">
                                 <div class="col-md-6 mt-2">
                                     <strong>Loan Amount Sanction</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'. number_format($loanDetails->approvedAmount,2).'</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>Principle O/s</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'. number_format($totalPinnciple,2).'</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>Foreclosure Charges</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>0% of POS</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>Foreclosure Amount</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'. number_format($foreCloserFeeWc,2).'</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>GST 18%</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'. number_format($gstOfForecloserWc,2).'</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>Total Foreclosure Amount</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'. number_format($totalForeCloserWc,2).'</label>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <strong>Final Amount To Be Taken</strong><br>
                                  </div>
                                  <div class="col-md-6 mt-2">
                                     <label>'.$totalPaybleAmtWc.'</label>
                                  </div>
                             </div>
                             <div class="row closerchargeOther mt-3" style="display:none;">
                                 <div class="col-md-6">
                                     <label>Closing Date</label>
                                     <input type="date" name="closingTransactionDate" id="closingTransactionDate" class="form-control">
                                 </div>
                                 <div class="col-md-6">
                                     <label>Payment Mode</label>
                                     <input type="text" name="closerPayMode" id="closerPayMode" class="form-control">
                                 </div>
                                 <div class="col-md-6">
                                     <label>Txn Id</label>
                                     <input type="text" name="closerTxnId" id="closerTxnId" class="form-control">
                                 </div>
                                 <div class="col-md-6">
                                     <label>Remark</label>
                                     <input type="text" name="closerRemark" id="closerRemark" class="form-control">
                                 </div>
                                 <div class="col-md-6">
                                 <label>&nbsp;</label><br>
                                     <input type="button" id="closerBtn" class="btn btn-danger bg-danger" value="Close Loan" onclick="closeThisLoan('.$loanDetails->id.','.$loanDetails->userId.');">
                                     <input type="button" id="closerBtnCancel" class="btn btn-warning bg-warning" value="Cancel" onclick="cancelCloseThisLoan();">
                                 </div>
                             </div>
                           </div>
                        </div>
                     </div>
                  </div>
             </div>';
         }
         $payOutStandingTxnDateMaxDate=date('Y-m-d');
         if($loanDetails->loanCategory==8)
         {
             $payOutStandingTxnDateMaxDate=date('Y-m-d',strtotime($loanDetails->disbursedDate.' +1 day'));
             
             $loanEmiDetails=LoanEmiDetail::where(['loanId'=>$loanId,'status'=>'success'])->orderBy('id','desc')->first();
             if(!empty($loanEmiDetails))
             {
                 $payOutStandingTxnDateMaxDate=date('Y-m-01',strtotime($loanEmiDetails->emiDate));
             }
             $htmlStr .='<div class="col-lg-12 col-md-12">
                             <div class="card popcolored_card">
                                 <div class="card-body">
                                     <div class="row">
                                         <div class="col-md-4">
                                             <strong>Total Outstanding</strong>
                                             <input type="number" disabled class="form-control mt-1" id="payOutStandingAmt1" value="'.$totalOutStandingBal.'" placeholder="Enter Amount">
                                         </div>
                                         <div class="col-md-6"><br>
                                             <input type="checkbox" onclick="checkClickedOnPayOutStanding()" id="checkClickedOnPayOutStandingBtn" value="yes"> <span class="text-danger">Want to pay outstanding ?</span>
                                         </div>
                                     </div>
                                     <div class="row mt-3" id="outstandingPayHtml" style="display:none;">                                        
                                         <div class="col-md-4">
                                             <strong>Pay Outstanding</strong>
                                             <input type="number" id="payOutStandingAmt" class="form-control mt-1" placeholder="Enter Amount">
                                         </div>
                                         <div class="col-md-4">
                                             <strong>Payment Mode</strong>
                                             <input type="text" id="payOutStandingPayMode" class="form-control mt-1" placeholder="Payment Mode">
                                         </div>
                                         <div class="col-md-4">
                                             <strong>Transaction Id</strong>
                                             <input type="text" id="payOutStandingTxnId" class="form-control mt-1" placeholder="Transaction Id">
                                         </div>
                                         <div class="col-md-4 mt-3">
                                             <strong>Transaction Date</strong>
                                             <input type="text" readonly style="cursor:pointer;" id="payOutStandingTxnDate" class="form-control mt-1" placeholder="Transaction Date">
                                         </div>
                                         <div class="col-md-4 mt-3">
                                         <strong><br></strong>
                                             <button type="button" id="payOutStandingAmtBtn" onclick="payOutStandingAmtFn('.$loanId.','.$userId.');" class="btn btn-warning bg-warning">Pay Now</button>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>';
             
                     
                      
         }
        }
        if($loanDetails->loanCategory==8){
        $outstandingHistory=OutStandingPaymentHistory::where('loanId',$loanId)->where('type','credit')->orderBy('id','DESC')->get();
                     if(count($outstandingHistory))
                     {
                         $htmlStr .='<div class="row mt-5">
                             <div class="col-lg-12">
                                 <center><strong><u>Principle Deposit History</u></strong></center>
                             </div>
                             <div class="col-lg-12">
                             <div class="card-body personal_Details table_card" style="overflow-x: auto;">
                             <table class="table basic_tablecustom" id="emipopup_table">
                               <thead>
                                 <tr>
                                   <th scope="col">DEPOSIT AMOUNT</th>
                                   <th scope="col">PAYMENT MODE</th>
                                   <th scope="col">TRANSACTION ID</th>
                                   <th scope="col">TRANSACTION DATE</th>
                                 </tr>
                               </thead>
                               <tbody>';
                     
                         $srn=1;
                         foreach ($outstandingHistory as $erow)
                         {
                             
                             $transactionDate=(strtotime($erow->txnDate)) ? date('d/m/Y',strtotime($erow->txnDate)) : '';
                             
                             $htmlStr .=' <tr>
                               <td>'.$erow->amount.'</td>
                               <td>'.ucfirst($erow->paymentMode).'</td>
                               <td>'.$erow->txnId.'</td>
                               <td>'.$transactionDate.'</td>
                             </tr>';
                             $srn++;
                         }
                     
                     $htmlStr .='  </tbody>
                         </table></div></div></div>';
                     }}
                     
       if($loanDetails->roiType !='bullet_repayment'){
            $exporturl = route('adminExportReports',['page'=>'emi-card']).'/?loanId='.$loanId;
         $htmlStr .='<div class="row mt-5">
                    <div style="display: flex;justify-content: space-between;" class="col-lg-12 px-4">
                            <strong class="ml-4" style="/*! margin-left: 78%; */"><u>EMI History</u></strong>
                    <div style="display: flex;">
                    <a href="'.$exporturl.'" class="btn btn-primary">Export Data</a>
                    </div>
                </div>
                 <div class="col-lg-12">
                 <div class="card-body personal_Details table_card" style="overflow-x: auto;">
                 <table class="table basic_tablecustom" id="emipopup_table">
                   <thead>
                     <tr>
                       <th scope="col">EMI ID</th>';
                       if($loanDetails->roiType =='quaterly_interest'){ $mtxt ='QUARTERLY';}else{$mtxt ='MONTHLY';}
                     if($loanDetails->loanCategory==8){
                        
                         $htmlStr .= '<th scope="col"> '.$mtxt.' INTEREST</th>';
                     }else{
                         $htmlStr .= '<th scope="col">EMI Amount</th>';
                         if($loanDetails->tds > 0 && $loanDetails->loanCategory == 1){
                             $htmlStr .= '<th scope="col">NET EMI Amount</th>';
                         }
                     }
                     $htmlStr .= '<th scope="col">PRINCIPLE</th>';
                     if($loanDetails->loanCategory!=8){
                         $htmlStr .= '<th scope="col">INTEREST</th>';
                     }
                     if($loanDetails->tds > 0){
                         $htmlStr .= '<th scope="col">TDS %</th>
                         <th scope="col">TDS AMOUNT</th>';
 
                         if($loanDetails->loanCategory == 8){
                             $htmlStr .= '<th scope="col">NET '.$mtxt.' INTEREST</th>';
                         }else{
                             $htmlStr .= '<th scope="col">NET INTEREST</th>';
                         }
                     }
                     if($loanDetails->loanCategory!=8){
                     $htmlStr .= '<th scope="col">PAYBLE AMOUNT</th>';
                     }
                     $htmlStr .= '<th scope="col">BALANCE</th>
                       <th scope="col">START DATE</th>
                       <th scope="col">DUE DATE</th>                      
                       <th scope="col">STATUS</th>
                       <th scope="col">TRANSACTION ID</th>
                       <th scope="col"> TRANSACTION DATE </th>
                       <th scope="col">LATE CHARGES</th>
                     </tr>
                   </thead>
                   <tbody>';
         if(count($emiDetails))
         {
             $todayDate=date('Y-m-d');
             foreach ($emiDetails as $erow)
             {
                 if($erow->status=='pending'){
                     $statusText='<span class="label label-warning">Pending</span>';
                 }elseif($erow->status=='success'){
                     $statusText='<span class="label label-success">Success</span>';
                 }else{
                     $statusText='<span class="label label-danger">Failed</span>';
                 }
                 $EMIID=$erow->emiId;
                 $emiDate=(strtotime($erow->emiDate)) ? date('d/m/Y',strtotime($erow->emiDate)) : '';
                 $emiDueDate=(strtotime($erow->emiDueDate)) ? date('d/m/Y',strtotime($erow->emiDueDate)) : '';
                 $transactionDate=(strtotime($erow->transactionDate)) ? date('d/m/Y',strtotime($erow->transactionDate)) : '';
                 $lateCarges=($erow->lateCharges) ? $erow->lateCharges : '';
                 
                 $totalPaybleAmt= round($erow->netemiAmount+$erow->lateCharges,2);
                 $EmiPayBtn='';
                 if($erow->status=='pending'){
                     $EmiPayBtn='<br><a href="javascript:;" style="color:blue;" data-emiid="'.$EMIID.'" id="emiPayBtn'.$erow->id.'" onclick="payEmiModalOpen('.$erow->id.','.$erow->loanId.')">Mark as paid</a>';
                 }
                 
                 
                 $htmlStr .=' <tr>
                   <td>'.$EMIID.'</td>
                   <td>'.number_format($erow->emiAmount,2).'</td>';
                   if($loanDetails->tds > 0 && $loanDetails->loanCategory == 1){
                     $htmlStr .= '<td>'. number_format($erow->netemiAmount,2).'</td>';
                 }
                 $htmlStr .='<td>'.$erow->principle.'</td>';
                   if($loanDetails->loanCategory!=8){
                     $htmlStr .= '<td>'.$erow->interest.'</td>';
                   }
                   if($loanDetails->tds > 0){
                     $htmlStr .= '<td>'.$loanDetails->tds.'</td>';
                     $htmlStr .= '<td>'.$erow->tdsAmount.'</td>';
                     $htmlStr .= '<td>'.$erow->netInterest.'</td>';
                   }
                   if($loanDetails->loanCategory!=8){
                     $htmlStr .= '<td>'.$totalPaybleAmt.'</td>';
                   }
                   $htmlStr .='<td>'.$erow->balance.'</td>
                   <td>'.$emiDate.'</td>
                   <td>'.$emiDueDate.'</td>
                   <td>'.$statusText.$EmiPayBtn.'</td>
                   <td>'.$erow->transactionId.'</td>
                   <td>'.$transactionDate.'</td>
                   <td>'.$lateCarges.'</td>
                 </tr>';
             }
         }
         $htmlStr .='  </tbody>
             </table></div></div></div>';
        }
         if($htmlStr){
 
             echo json_encode(['status'=>'success','message'=>'EMI Details.','data'=>$htmlStr,'payOutStandingTxnDateMaxDate'=>$payOutStandingTxnDateMaxDate]); exit;
         }else{
             echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']); exit;
         }
     }


     public function createOutStandingForEntry($userId,$loanId,$payOutStandingAmt,$transactionDate)
    {
        $saveUp['userId']=$userId;
        $saveUp['loanId']=$loanId;
        $saveUp['amount']=$payOutStandingAmt;
        $saveUp['txnId']='disburse';
        $saveUp['txnDate']=$transactionDate;
        $saveUp['paymentMode']='disburse';
        $saveUp['type']='debit';
        $saveUp['created_at']=date('Y-m-d H:i:s');
        $saveUp['updated_at']=date('Y-m-d H:i:s');

        $saved=DB::table('out_standing_payment_histories')->insertGetId($saveUp);
        return $saved;
    }

     public function disburseAmountAndCreateEmi(Request $request)
    {
        // dd($request->all());
        $isValidated=AppServiceProvider::validatePermission('loan-disburse');

        $loanId=$request->loanId;
        $cashBank=0;
        $processed=0;
        $loanDetails=ApplyLoanHistory::where('id',$loanId)->first();
             
        $userId=$loanDetails->userId;
        $transactionId='';
        $accountNumber='';
        $gstAmountCollected=0;
        $lfAmountCollected=0;
        $bankDetails=UserBankDetail::where('userId',$userId)->first();
        if(!empty($bankDetails)){
            $accountNumber=substr($bankDetails->accountNumber,strlen($bankDetails->accountNumber)-3,strlen($bankDetails->accountNumber));
        }
        $userDtl=User::getUserDetailsById($userId);
        if (empty($userDtl)){
            echo json_encode(['status'=>'error','message'=>'Invalid Request, Please try again.']); exit;
        }
        $mobileNumber=$userDtl->mobile;
                
        
        

        $disbursedDate=$loanDetails->disbursedDate;
        $currentDayOfMonth=(int)date("d", strtotime($disbursedDate));
        if($currentDayOfMonth == 4 || $currentDayOfMonth == 5){
            $extraAmountDays=0;
            $disbursedDate= date('d-m-Y',strtotime($disbursedDate.'-1 month'));
        }elseif($currentDayOfMonth < 4){
            $extraAmountDays=4-$currentDayOfMonth;
            $disbursedDate= date('d-m-Y',strtotime($disbursedDate.'-1 month'));
        }else{
            $lastDayOfMonth=date("t", strtotime($disbursedDate))+4;
            $extraAmountDays=$lastDayOfMonth-$currentDayOfMonth;
            
        }


        //$lastDayOfMonth=date("t", strtotime($disbursedDate));
        // $lastDayOfMonth=date("t", strtotime($disbursedDate))+4;
        // $extraAmountDays=$lastDayOfMonth-$currentDayOfMonth;
        // dd($disbursedDate);
        if(!empty($loanDetails))
        {
            $rateOfInterest=$loanDetails->rateOfInterest;
            $approvedAmount=$loanDetails->approvedAmount;
            $loanCategory=$loanDetails->loanCategory;
            
            
            $roiType=$loanDetails->roiType;
            $approvedTenureText='';
            $tenureDtl=Tenure::where('id',$loanDetails->approvedTenure)->first();
            if(!empty($tenureDtl)){
                $approvedTenureText=$tenureDtl->name;
            }

            if($roiType!='bullet_repayment'){
            
            if($roiType=='reducing_roi' || $roiType=='fixed_interest_roi'){
                $skipMonths=' +1 Month';
            }else{
                if($loanDetails->loanCategory == 8){
                    $skipMonths=' ';
                }else{
                    $skipMonths=' +3 Months';
                }
            }
            
            if($roiType=='quaterly_interest'){
                $emiLabelMonth='Quarterly Emi';
            }else if($roiType=='reducing_roi'){
                $emiLabelMonth='Monthly EMI';
            }else{
                $emiLabelMonth='EMI';
            }
            
            $monthlyEMI=$loanDetails->monthlyEMI;
            $totalInterest=$loanDetails->totalInterest;

            

            $plateformFee=0;
            $insurance=0;
            $principleChargesDetailsStr=$loanDetails->principleChargesDetails;
            $principleChargesDetailsArr=json_decode($principleChargesDetailsStr);
            if(!empty($principleChargesDetailsArr)){
                $plateformFee=$principleChargesDetailsArr->plateformFee;
                $insurance=$principleChargesDetailsArr->insurance;
            }
            $emisDetailsArr = null;
            
            if($loanDetails->loanCategory==8)
            {
                $numOfEmis = $tenureDtl->numOfEmis;
                
                $objComm=new CommonController();
                $payment_date=date('Y-m-12');
                $interestStartDate=$disbursedDate;
                if($roiType=='quaterly_interest')
                {
                    $monthlyEmiLabel='Quarterly EMI';
                    $emisDetailsArr=$objComm->getQuarterlyDaysWiseEmis($numOfEmis,$rateOfInterest,$approvedAmount,$payment_date,$interestStartDate,$loanDetails->tds);
                    $extraIntrestAmount=0;
                    $extraAmountDays=0;
                }else if($roiType=='fixed_interest_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getFixedInterestDaysWiseEmis($numOfEmis,$rateOfInterest,$approvedAmount,$payment_date,$interestStartDate,$loanDetails->tds);
                    $extraIntrestAmount=$emisDetailsArr['extraDaysInterest'];
                    $extraAmountDays=$emisDetailsArr['extraNumDays'];
                }
                
                
                
                $monthlyEMI=$emisDetailsArr['emiAmount'];
                $totalInterest=$emisDetailsArr['totalInterest'];
                //$netDisbursementAmount=$loanDetails->netDisbursementAmount-$extraIntrestAmount;
                $netDisbursementAmount=$loanDetails->netDisbursementAmount;
                
                $processed=ApplyLoanHistory::where('id',$loanId)->update(['bankId'=>0,'status'=>'disbursed','emisDetailsStr'=>json_encode($emisDetailsArr),'extraAmountDays'=>$extraAmountDays,'extraIntrestAmount'=>$extraIntrestAmount,'totalInterest'=>$totalInterest,'disbursedDate'=>($loanDetails->disbursedDate ?? $disbursedDate)]);
            }else{
                // $totalIneterest=($approvedAmount*$rateOfInterest)/100;
                // $oneDayInterest=$totalIneterest/365;
                // $extraIntrestAmount=$oneDayInterest*$extraAmountDays;
                $payment_date=$disbursedDate;
                $totalIneterest=($approvedAmount*$rateOfInterest)/100;
                $nextMonthYear = date('Y',strtotime($payment_date));

                // if($nextMonthYear%4==0){
                //     $oneYearDays=366;
                // }else{
                    $oneYearDays=365;
                // }
                $oneDayInterest=$totalIneterest/$oneYearDays;
                
                $extratdsAmount= (round($oneDayInterest*$extraAmountDays)*$loanDetails->tds)/100;

                $extraIntrestAmount=($oneDayInterest*$extraAmountDays)-$extratdsAmount;
                $netDisbursementAmount=$loanDetails->netDisbursementAmount-$extraIntrestAmount;
                

                
                
                // $extraIntrestAmount=$oneDayInterest*$extraAmountDays;
                $numOfEmis = $tenureDtl->numOfEmis;
                $objComm=new CommonController();
                if($roiType=='reducing_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getEmisPMT($numOfEmis,$rateOfInterest,$approvedAmount,$payment_date,$loanDetails->tds);
                }else if($roiType=='quaterly_interest')
                {
                    $monthlyEmiLabel='Quarterly EMI';
                    $emisDetailsArr=$objComm->getQuarterlyEmis($numOfEmis,$rateOfInterest,$approvedAmount,$payment_date,$loanDetails->tds);
                }else if($roiType=='fixed_interest_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getFixedInterestEmis($numOfEmis,$rateOfInterest,$approvedAmount,$payment_date,$loanDetails->tds);
                }
               
                $processed=ApplyLoanHistory::where('id',$loanId)->update(['bankId'=>$cashBank,'status'=>'disbursed','extraAmountDays'=>$extraAmountDays,'extraIntrestAmount'=>$extraIntrestAmount,'disbursedDate'=>($loanDetails->disbursedDate ?? $disbursedDate)]);
            }
            
            $loanDetails=ApplyLoanHistory::where('id',$loanId)->first();
            $userId=$loanDetails->userId;
            // $emisDetailsStr=$loanDetails->emisDetailsStr;
            $emisDetailsArr= json_decode(json_encode((object) $emisDetailsArr), FALSE);
            // dd($disbursedDate,$emisDetailsArr);
            if(!empty($emisDetailsArr))
            {
                $emiList=$emisDetailsArr->emiList;
                if(!empty($emiList))
                {
                    foreach($emiList as $erow)
                    {

                        $emiMonth=date('m',strtotime($erow->payDate.$skipMonths));
                        $emiYear=date('Y',strtotime($erow->payDate.$skipMonths));

                        $emiDate = date($emiYear.'-'.$emiMonth.'-05');

                        $emiDueDate=date($emiYear.'-'.$emiMonth.'-12');

                        $emiArr['userId']=$userId;
                        $emiArr['loanId']=$loanId;
                        $emiArr['emiId']='EM'.$loanId.'0'.$erow->emiSr;
                        $emiArr['emiSr']=$erow->emiSr;
                        $emiArr['emiAmount']=$erow->emiAmount;
                        $emiArr['interest']=$erow->interest;
                        if($loanDetails->loanCategory==8 || $loanDetails->loanCategory==1){
                            $emiArr['tdsAmount']=$erow->tdsAmount;
                            $emiArr['netInterest']= $erow->netInterest == 0 ? $erow->emiAmount : $erow->netInterest;
                        }else{
                            $emiArr['netInterest']= $erow->emiAmount;
                        }
                        $netemi  = $erow->emiAmount - ($erow->tdsAmount ?? 0);
                        $emiArr['netemiAmount'] = $netemi ?? $erow->emiAmount;
                        $emiArr['principle']=$erow->principle;
                        $emiArr['balance']=$erow->balance;
                        $emiArr['emiDate']=$emiDate;
                        $emiArr['emiDueDate']=$emiDueDate;
                        $emiArr['status']='pending';
                        $emiArr['created_at']=date('Y-m-d H:i:s');
                        $emiArr['updated_at']=date('Y-m-d H:i:s');
                        // dd($erow,$emiArr);
                        LoanEmiDetail::create($emiArr);
                    }
                }
            }
            // dd("---");
            /*
            $approvedAmount=$loanDetails->approvedAmount;
            $rateOfInterest=$loanDetails->rateOfInterest;
            $approvedTenure=$loanDetails->approvedTenure;
            $principleCharges=$loanDetails->principleCharges;
            $eachEmiAmount=$loanDetails->monthlyEMI;
            $totalInterest=$loanDetails->totalInterest;
            $TenureDetails=CreditScoreQuestionAnswer::where('id',$approvedTenure)->first();
            if(!empty($TenureDetails))
            {
                $numOfEmis=$TenureDetails->otherValueOrDays;

                //echo $eachEmiAmount;exit;
                $fixedDateEveryMonth=5;
                $start = new DateTime(date('Y-m-') . $fixedDateEveryMonth);
                for ($esr = 1; $esr <= $numOfEmis; $esr++) {
                    $start->add(new DateInterval("P1M"));
                    $emiDate = $start->format('Y-m-d');
                    $emiDueDate=date('Y-m-d',strtotime($emiDate.' +7 Days'));


                }

            }
            */
        }else{
            $processed=ApplyLoanHistory::where('id',$loanId)->update(['bankId'=>0,'status'=>'disbursed','disbursedDate'=>($loanDetails->disbursedDate ?? $disbursedDate)]);
        }
            
            if($loanCategory==8){
                $this->createOutStandingForEntry($userId,$loanId,$loanDetails->approvedAmount,$loanDetails->disbursedDate);
            }
            
            if($processed){
                $includePF = ($loanDetails->exclude_pfif && $loanDetails->exclude_pfif == 1) ? 'Yes' : 'No';
                $includeExdays = ($loanDetails->include_extradays && $loanDetails->include_extradays == 1) ? 'Yes' : 'No';
                
                $loanName = Category::where('id',$loanDetails->loanCategory)->pluck('name')->first();
                
                $htmlSt = '<div>
                        <p>Dear ' . $userDtl->name . ',</p>
                        <p>This Loan has been disbursed '.$loanDetails->disbursedDate.'</p>
                        <p>Please check your updated loan summary as follows:-</p>
                        <div>
                            <table style="width: 100%;">
                            <tr>
                    <th style="width: 50%;padding: 6px !important;">Loan Type</th>
                    <th style="width: 50%;padding: 6px !important;">'. $loanName.'</th>
                </tr>
                            <tr>
                        <th style="width: 50%;padding: 6px !important;">Approved Amount</th>
                        <th style="width: 50%;padding: 6px !important;">'. number_format($approvedAmount,2).'</th>
                   </tr><tr>
                        <th style="width: 50%;padding: 6px !important;">Approved Tenure</th>
                        <th style="width: 50%;padding: 6px !important;">'.$approvedTenureText.'</th>
                   </tr><tr>
                        <th style="width: 50%;padding: 6px !important;">Approved ROI</th>
                        <th style="width: 50%;padding: 6px !important;">'.$rateOfInterest.'%</th>
                   </tr><tr>
                            <th style="width: 50%;padding: 6px !important;">TDS % </th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->tds.' %</th>
                       </tr>';
                       if($roiType!='bullet_repayment'){
                        $htmlSt .='<tr>
                        <th style="width: 50%;padding: 6px !important;">Breakup Days</th>
                        <th style="width: 50%;padding: 6px !important;">'.$extraAmountDays.'</th>
                   </tr><tr>
                            <th style="width: 50%;padding: 6px !important;">Breakup Interest </th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($extraIntrestAmount,2).'</th>
                       </tr>
                       <tr style="display:none;" >
                            <th style="width: 50%;padding: 6px !important;">'.$emiLabelMonth.' </th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($monthlyEMI,2).'</th>
                       </tr>
                       <tr>
                            <th style="width: 50%;padding: 6px !important;">Total Interest </th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($totalInterest,2).'</th>
                       </tr>';}
                
                if($plateformFee)
                {
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Plateform Fee </th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($plateformFee,2).'</th>
                       </tr>';
                }
                 
                 
                if($insurance)
                {
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Insurance Fee </th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($insurance,2).'</th>
                       </tr>';
                }
                $htmlSt .='<tr>
                        <th style="width: 50%;padding: 6px !important;">Include Plateform / Insurance Fee In Loan Amount </th>
                        <th style="width: 50%;padding: 6px !important;">'.$includePF.'</th>
                    </tr>';
                $htmlSt .='<tr>
                        <th style="width: 50%;padding: 6px !important;">Include Breakup Interest In Loan Amount </th>
                        <th style="width: 50%;padding: 6px !important;">'.$includeExdays.'</th>
                    </tr>';
                
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Net Disbursement Amount </th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($loanDetails->disbursementAmount,2).'</th>
                       </tr>';
                
                $textStr ='As per your Kyc and employment, maxemo allows you to get the loan amount as mentioned above, if everything is ok please click on accept to approve the loan or reject in case of anything else. please contact assigned credit personnel in caseof any query.';
                $htmlSt .='<tr>
                            <th colspan="2" style="width: 50%;padding: 6px !important;">
                            <strong>
                               '.$textStr.' 
                            </strong>
                            </th>
                       </tr>';

                $htmlSt .='</table>
                        </div>
                     </div>';



                     $htmlStAdmin = '<div>
                     <p>Dear Admin,</p>
                     <p>This Loan has been disbursed at'.$loanDetails->disbursedDate.'</p>
                     <p>Please check updated loan summary as follows:-</p>
                     <div>
                <table style="width: 100%;">
                <tr>
                     <th style="width: 50%;padding: 6px !important;">Customer Name</th>
                     <th style="width: 50%;padding: 6px !important;">'. $userDtl->name.'</th>
                </tr>
                <tr>
                    <th style="width: 50%;padding: 6px !important;">Customer ID</th>
                    <th style="width: 50%;padding: 6px !important;">'. $userDtl->customerCode.'</th>
                </tr>
                <tr>
                    <th style="width: 50%;padding: 6px !important;">Loan Type</th>
                    <th style="width: 50%;padding: 6px !important;">'. $loanName.'</th>
                </tr>
                <tr>
                     <th style="width: 50%;padding: 6px !important;">Approved Amount</th>
                     <th style="width: 50%;padding: 6px !important;">'. number_format($approvedAmount,2).'</th>
                </tr><tr>
                     <th style="width: 50%;padding: 6px !important;">Approved Tenure</th>
                     <th style="width: 50%;padding: 6px !important;">'.$approvedTenureText.'</th>
                </tr><tr>
                     <th style="width: 50%;padding: 6px !important;">Approved ROI</th>
                     <th style="width: 50%;padding: 6px !important;">'.$rateOfInterest.'%</th>
                </tr>
                <tr>
                            <th style="width: 50%;padding: 6px !important;">TDS % </th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->tds.' %</th>
                       </tr>
                <tr>
                     <th style="width: 50%;padding: 6px !important;">Breakup Days</th>
                     <th style="width: 50%;padding: 6px !important;">'.$extraAmountDays.'</th>
                </tr><tr>
                         <th style="width: 50%;padding: 6px !important;">Breakup Interest </th>
                         <th style="width: 50%;padding: 6px !important;">'. number_format($extraIntrestAmount,2).'</th>
                    </tr>
                    <tr style="display:none;" >
                         <th style="width: 50%;padding: 6px !important;">'.$emiLabelMonth.' </th>
                         <th style="width: 50%;padding: 6px !important;">'. number_format($monthlyEMI,2).'</th>
                    </tr>
                    <tr>
                         <th style="width: 50%;padding: 6px !important;">Total Interest </th>
                         <th style="width: 50%;padding: 6px !important;">'. number_format($totalInterest,2).'</th>
                    </tr>';
             
             if($plateformFee)
             {
                 $htmlStAdmin .='<tr>
                         <th style="width: 50%;padding: 6px !important;">Plateform Fee </th>
                         <th style="width: 50%;padding: 6px !important;">'. number_format($plateformFee,2).'</th>
                    </tr>';
             }
              
              
             if($insurance)
             {
                 $htmlStAdmin .='<tr>
                         <th style="width: 50%;padding: 6px !important;">Insurance Fee </th>
                         <th style="width: 50%;padding: 6px !important;">'. number_format($insurance,2).'</th>
                    </tr>';
             }

             $htmlStAdmin .='<tr>
                        <th style="width: 50%;padding: 6px !important;">Include Plateform / Insurance Fee In Loan Amount </th>
                        <th style="width: 50%;padding: 6px !important;">'.$includePF.'</th>
                    </tr><tr>
                    <th style="width: 50%;padding: 6px !important;">Include Breakup Interest In Loan Amount </th>
                    <th style="width: 50%;padding: 6px !important;">'.$includeExdays.'</th>
                </tr>';
             
                 $htmlStAdmin .='<tr>
                         <th style="width: 50%;padding: 6px !important;">Net Disbursement Amount </th>
                         <th style="width: 50%;padding: 6px !important;">'. number_format($loanDetails->disbursementAmount,2).'</th>
                    </tr>';

             $htmlStAdmin .='</table>
                     </div>
                  </div>';
                

                // $verifyWith=env('APP_NAME');
                // $toMail=$userDtl->email;
                // $toUser=$userDtl->name;
                // $subject='Final disbursed loan summary & sanction letter | '.$verifyWith;
                // $subjectAdmin='New Loan Disbursed | '.$verifyWith;
                // if($toMail){
                //     AppServiceProvider::sendMailAttachment($toMail,$toUser,$subject,$htmlSt,'pages.app-management.sanction-letter',$loanId);
                // }

                // if(config('app.env') == "production"){
                // AppServiceProvider::sendMailAttachment("info@maxemocapital.com","Info Maxemo",$subjectAdmin,$htmlStAdmin,'pages.app-management.sanction-letter',$loanId);
                // AppServiceProvider::sendMailAttachment("shorya.mittal@maxemocapital.com","Shorya Mittal",$subjectAdmin,$htmlStAdmin,'pages.app-management.sanction-letter',$loanId);
                // AppServiceProvider::sendMailAttachment("vipul.mittal@maxemocapital.com","Vipul Mittal",$subjectAdmin,$htmlStAdmin,'pages.app-management.sanction-letter',$loanId);
                // AppServiceProvider::sendMailAttachment("vivek.mittal@maxemocapital.com","Vivek Mittal",$subjectAdmin,$htmlStAdmin,'pages.app-management.sanction-letter',$loanId);
                // }else{
                //     AppServiceProvider::sendMailAttachment("raju@techmavesoftware.com","Raju",$subjectAdmin,$htmlStAdmin,'pages.app-management.sanction-letter',$loanId);
                //     AppServiceProvider::sendMailAttachment("basant@techmavesoftware.com","Basant",$subjectAdmin,$htmlStAdmin,'pages.app-management.sanction-letter',$loanId);
                // }
                
                $textMessage='Dear Sir, thank you for choosing Maxemo Capital Services Pvt Ltd for your business/personal needs. Your loan of Rs. '. number_format($approvedAmount,2).'/- has been disbursed into your bank A/c no. ending with ****'.$accountNumber.'. RTGS done on '.date('d M, Y'.strtotime($disbursedDate)).' with transaction ID- '.$transactionId.'. LPF of '.$lfAmountCollected.' +18% GST i.e. '.$gstAmountCollected.' have been deducted from your total loan amount. For any queries related to your loan, please Call us on our helpline number or visit www.maxemocapital.com We are happy to serve you - Team Maxemo';
                if(config('app.env') == "production"){
                $sent=AppServiceProvider::sendSms($mobileNumber,$textMessage);
                }
                echo json_encode(['status'=>'success','message'=>'Disbursement has been processed successfully.']); exit;
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']); exit;
            }
        }else{
            echo json_encode(['status'=>'error','message'=>'Invalid Request, Please try again.']); exit;
        }

    }

    public function markAsPaidThisEmi(Request $request)
    {
        $payEmiId=$request->payEmiId;
        $emiPayMode=$request->emiPayMode;
        $lateCharges=($request->emiLateCharges) ? $request->emiLateCharges : 0;
        $transactionDate=($request->transactionDate) ? date('Y-m-d',strtotime($request->transactionDate)) : '';
        $emiTxnId=$request->emiTxnId;
        
        $saved=LoanEmiDetail::where('id',$payEmiId)->update(['lateCharges'=>$lateCharges,'payment_mode'=>$emiPayMode,'transactionId'=>$emiTxnId,'transactionDate'=>$transactionDate,'status'=>'success']);
        if(!empty($saved)){
            echo json_encode(['status'=>'success','message'=>'EMI mark as paid successfully.']);
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, please try again.']);
        }       
    }
}