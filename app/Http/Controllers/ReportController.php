<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplyLoanHistory;
use App\Models\Bank;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReportController extends Controller
{

    public function todayDisbursement()
    {
        $currentDate=date('Y-m-d');
        $pageTitle='Today Disbursement';
        $pageNameStr='today-disbursement';

        return view('pages.loan-management.to-be-disburse',compact('pageTitle','pageNameStr'));
    }

    public function todayRawDisbursement()
    {
        $currentDate=date('Y-m-d');
        $pageTitle='Today / Pending Raw Disbursement';
        $pageNameStr='today-raw-disbursement';

        return view('pages.loan-management.to-be-disburse',compact('pageTitle','pageNameStr'));
    }

    public function pendingDisbursement()
    {
        $currentDate=date('Y-m-d');
        $pageTitle='Pending Disbursement';
        $pageNameStr='pending-disbursement';

        return view('pages.loan-management.to-be-disburse',compact('pageTitle','pageNameStr'));
    }

    public function disbursedLoanList()
    {
        $currentDate=date('Y-m-d');
        $pageTitle='Loan Disbursed';
        $pageNameStr='loan-disbursed';

        return view('pages.loan-management.to-be-disburse',compact('pageTitle','pageNameStr'));
    }

    public function customerEmis()
    {
        $currentDate=date('Y-m-d');
        $pageTitle='Customer Emi';
        $pageNameStr='customer-emi';

        $month=date('m');
        $year=date('Y');
        $SUBQRY=" AND MONTH(ed.emiDate)='$month' AND YEAR(ed.emiDate)='$year'";

        $banks=Bank::where(['status'=>1])->orderBy('name','asc')->get();

        return view('pages.loan-management.to-be-disburse',compact('pageTitle','pageNameStr'));
    }

    //TODO Recived EMI page link
    public function receivedEmis()
    {
        $currentDate=date('Y-m-d');
        $pageTitle='Today\'s Received Emi';
        $pageNameStr='received-emi';


        return view('pages.loan-management.to-be-disburse',compact('pageTitle','pageNameStr'));
    }

    public function todaysEmis()
    {
        $currentDate=date('Y-m-d');
        $pageTitle='Today\'s Pending Emi';
        $pageNameStr='today-emi';

        return view('pages.loan-management.to-be-disburse',compact('pageTitle','pageNameStr'));
    }

    public function overDueEmis()
    {
        $currentDate=date('Y-m-d');
        $pageTitle='Over Due Emi';
        $pageNameStr='over-due-emi';

        return view('pages.loan-management.to-be-disburse',compact('pageTitle','pageNameStr'));
    }

    public function closedLoans()
    {
        $currentDate=date('Y-m-d');
        $pageTitle='Closed Loans';
        $pageNameStr='closed-loans';

        return view('pages.loan-management.to-be-disburse',compact('pageTitle','pageNameStr'));
    }

    public function nocCustomers()
    {
        $currentDate=date('Y-m-d');
        $pageTitle='NOC Customers';
        $pageNameStr='noc-issued';

        return view('pages.loan-management.to-be-disburse',compact('pageTitle','pageNameStr'));
    }

    public function sanctionCustomers($id){
        $app_data = $id;
        return view('pages.app-management.sanction-letter',compact('app_data'));
    }


    public function aumReports()
    {
        $currentDate = date('Y-m-d');
        $pageTitle = 'AUM Report';
        $pageNameStr = 'aum-report';

        $totalApprovedAmount = DB::select("SELECT SUM((alh.netDisbursementAmount)+(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE debitRecordId='0' AND status='success' AND loanId=alh.id)) AS netDisbursementAmount FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE alh.loanCategory=2 OR alh.loanCategory=1 OR alh.loanAmount=8 OR alh.loanAmount=3");

        $totalApprovedAmount = $totalApprovedAmount[0]->netDisbursementAmount;
        $loan12OutStanding = DB::select("SELECT SUM((SELECT IFNULL(balance,0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' ORDER BY loan_emi_details.id DESC LIMIT 1)) AS totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE alh.loanCategory=2 OR alh.loanCategory=1");
        $loan3OutStanding = DB::select("SELECT SUM((SELECT IFNULL(openingBalanceLatest,0) FROM raw_materials_txn_details WHERE loanId=alh.id AND status='success' ORDER BY id ASC LIMIT 1)) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE alh.loanCategory=3 ORDER BY alh.id DESC");
        $loan8OutStanding = DB::select("SELECT SUM((SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId=alh.id AND type='debit')-(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId=alh.id AND type='credit')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE alh.loanCategory=8 ORDER BY alh.id DESC");

        $allOutstandingAmount = $loan12OutStanding[0]->totalOutStanding + $loan3OutStanding[0]->totalOutStanding + $loan8OutStanding[0]->totalOutStanding;

        return view('pages.reports.aum-report-list', compact('pageTitle', 'pageNameStr','allOutstandingAmount','totalApprovedAmount'));
    }
    
    public function filterAumReports(Request $request)
    {

        if (!$request->fromDate || $request->fromDate=="") {
            $request->merge(['fromDate' => '2020-01-01']);
        }
        if (!$request->toDate || $request->toDate=="") {
            $request->merge(['toDate' => date('Y-m-d')]);
        }
        // dd($request->loanreportFilter);
        // $casesPF_extradays = "CASE WHEN apply_loan_histories.exclude_pfif=1 AND apply_loan_histories.include_extradays=0 THEN (apply_loan_histories.netDisbursementAmount - apply_loan_histories.principleCharges) WHEN apply_loan_histories.exclude_pfif=0 AND apply_loan_histories.include_extradays=1 THEN (apply_loan_histories.netDisbursementAmount - apply_loan_histories.extraIntrestAmount) ELSE apply_loan_histories.";
        if($request->loanreportFilter == 1 || $request->loanreportFilter == "none"){
            
            if($request->fromDate && $request->toDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate BETWEEN '$request->fromDate' AND '$request->toDate') OR (apply_loan_histories.disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate')");
              	$allloans = array_unique(array_column($allloan,'a_loanId'));
              
                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId,'loanId'));
              
              	$loanIds = array_merge($allloans,$allloanEmiIds);
            }elseif($request->fromDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate >= '$request->fromDate') OR (apply_loan_histories.disbursedDate >= '$request->fromDate')");
                $allloans = array_unique(array_column($allloan,'a_loanId'));
              
              	$allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate >= '$request->fromDate') ELSE (transactionDate >= '$request->fromDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId,'loanId'));
              
              	$loanIds = array_merge($allloans,$allloanEmiIds);
            }elseif($request->toDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate <= '$request->toDate') OR (apply_loan_histories.disbursedDate <= '$request->toDate')  ");
                $allloans = array_unique(array_column($allloan,'a_loanId'));
              
                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate <= '$request->toDate') ELSE (transactionDate <= '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId,'loanId'));
              
              	$loanIds = array_merge($allloans,$allloanEmiIds);
            }

            $querys = "SELECT alh.id,u.id as userId,alh.disbursedDate,alh.id as aid,u.name,u.customerCode,alh.approvedAmount,(SELECT IFNULL(name,'NA') FROM categories WHERE id=alh.loanCategory) AS loanName,";
            
            if(($request->fromDate || $request->toDate)){

                $subQueryCondi = '1';
                if($request->fromDate && $request->toDate){
                    $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)";
                }else if($request->fromDate){
                    $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate >= '$request->fromDate') ELSE (transactionDate >= '$request->fromDate') END)";
                }else{
                    $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate <= '$request->toDate') ELSE (transactionDate <= '$request->toDate') END)";
                }

                $querys .= "IFNULL((SELECT IFNULL(extraIntrestAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (alh.status='disbursed' OR alh.status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as extraIntrestAmount,IFNULL((SELECT IFNULL(principleCharges,0) FROM apply_loan_histories WHERE id=alh.id AND (alh.status='disbursed' OR alh.status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as principleCharges,IFNULL((SELECT IFNULL(disbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as paidDisbursementAmount,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND  $subQueryCondi) as principleDeposited,(SELECT  IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as interestPaid,IFNULL((SELECT IFNULL(netDisbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";

                if(isset($loanIds) && !empty($loanIds)){
                    $strLoanIds  = implode(',',$loanIds);
                    $querys .= " AND alh.id IN ($strLoanIds)"; 
                }
            }else{
                $querys .= "alh.extraIntrestAmount,alh.principleCharges,alh.netDisbursementAmount,alh.disbursementAmount AS paidDisbursementAmount,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success') as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' ) as interestPaid,(alh.netDisbursementAmount - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";
            }

            $querys .= " AND alh.loanCategory=1  AND (alh.status='disbursed' OR alh.status='closed') ORDER BY alh.id DESC";

            //   echo $querys;

            $results = DB::select($querys); 
        }
        if($request->loanreportFilter == 2 || $request->loanreportFilter == "none"){
            if($request->fromDate && $request->toDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate BETWEEN '$request->fromDate' AND '$request->toDate') OR (apply_loan_histories.disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate')");
                $allloans = array_unique(array_column($allloan,'a_loanId'));
              
                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId,'loanId'));
              
              	$loanIds = array_merge($allloans,$allloanEmiIds);
            }elseif($request->fromDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate >= '$request->fromDate') OR (apply_loan_histories.disbursedDate >= '$request->fromDate')");
                $allloans = array_unique(array_column($allloan,'a_loanId'));
              
                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId,'loanId'));
              
              	$loanIds = array_merge($allloans,$allloanEmiIds);
            }elseif($request->toDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate <= '$request->toDate') OR (apply_loan_histories.disbursedDate <= '$request->toDate')");
                $allloans = array_unique(array_column($allloan,'a_loanId'));
              
                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId,'loanId'));
              
              	$loanIds = array_merge($allloans,$allloanEmiIds);
            }


            $querys = "SELECT alh.id,u.id as userId,alh.disbursedDate,alh.id as aid,u.name,u.customerCode,alh.approvedAmount,(SELECT IFNULL(name,'NA') FROM categories WHERE id=alh.loanCategory) AS loanName,";

            if(($request->fromDate || $request->toDate)){
                $subQueryCondi = '1';
                if($request->fromDate && $request->toDate){
                    $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)";
                }else if($request->fromDate){
                    $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate >= '$request->fromDate') ELSE (transactionDate >= '$request->fromDate') END)";
                }elseif($request->toDate){
                    $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate <= '$request->toDate') ELSE (transactionDate <= '$request->toDate') END)";
                }

                $querys .= "IFNULL((SELECT IFNULL(extraIntrestAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (alh.status='disbursed' OR alh.status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as extraIntrestAmount,IFNULL((SELECT IFNULL(principleCharges,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as principleCharges,IFNULL((SELECT IFNULL(disbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as paidDisbursementAmount,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as interestPaid,(IFNULL((SELECT IFNULL(netDisbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi)) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";
                if(isset($loanIds) && !empty($loanIds)){
                    $strLoanIds  = implode(',',$loanIds);
                    $querys .= " AND alh.id IN ($strLoanIds)"; 
                }
            }else{
                $querys .= "alh.extraIntrestAmount,alh.netDisbursementAmount,alh.disbursementAmount AS paidDisbursementAmount,alh.principleCharges,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success') as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' ) as interestPaid,(alh.netDisbursementAmount - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";
            }

            $querys .= " AND alh.loanCategory=2  AND (alh.status='disbursed' OR alh.status='closed') ORDER BY alh.id DESC";

            // $results->insert(DB::select($querys));
            // dd($results);

            if($request->loanreportFilter == "none"){
                $nowcount = count($results);
                foreach(DB::select($querys) as $rsdata){
                    $results[$nowcount] = new stdClass();
                    $results[$nowcount]->userId = $rsdata->userId ?? null;
                    $results[$nowcount]->aid = $rsdata->aid ?? null;
                    $results[$nowcount]->id = $rsdata->id;
                    $results[$nowcount]->name = $rsdata->name;
                    $results[$nowcount]->loanName = $rsdata->loanName;
                    $results[$nowcount]->customerCode = $rsdata->customerCode;
                    $results[$nowcount]->approvedAmount = $rsdata->approvedAmount;
                    $results[$nowcount]->disbursedDate = $rsdata->disbursedDate;
                    $results[$nowcount]->paidDisbursementAmount = $rsdata->paidDisbursementAmount;
                    $results[$nowcount]->principleCharges = $rsdata->principleCharges;
                    $results[$nowcount]->extraIntrestAmount = $rsdata->extraIntrestAmount;
                    $results[$nowcount]->principleDeposited = $rsdata->principleDeposited;
                    $results[$nowcount]->interestPaid = $rsdata->interestPaid;
                    $results[$nowcount]->totalOutStanding = $rsdata->totalOutStanding;

                    $nowcount++;
                }
            }else{
                $results = DB::select($querys);
            }
        }
        if($request->loanreportFilter == 3 || $request->loanreportFilter == "none"){

            if($request->fromDate && $request->toDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN raw_materials_txn_details ON raw_materials_txn_details.loanId=apply_loan_histories.id  WHERE (raw_materials_txn_details.transactionDate BETWEEN '$request->fromDate' AND '$request->toDate' OR raw_materials_txn_details.id IS NULL) AND apply_loan_histories.loanCategory=3  AND apply_loan_histories.status='customer-approved'");
                $loanIds = array_unique(array_column($allloan,'a_loanId'));
            }elseif($request->fromDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN raw_materials_txn_details ON raw_materials_txn_details.loanId=apply_loan_histories.id  WHERE (raw_materials_txn_details.transactionDate >= '$request->fromDate' OR raw_materials_txn_details.id IS NULL) AND apply_loan_histories.loanCategory=3  AND apply_loan_histories.status='customer-approved'");
                $loanIds = array_unique(array_column($allloan,'a_loanId'));
            }elseif($request->toDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN raw_materials_txn_details ON raw_materials_txn_details.loanId=apply_loan_histories.id  WHERE (raw_materials_txn_details.transactionDate <= '$request->toDate' OR raw_materials_txn_details.id IS NULL) AND apply_loan_histories.loanCategory=3  AND apply_loan_histories.status='customer-approved'");
                $loanIds = array_unique(array_column($allloan,'a_loanId'));
            }

            $querys = "SELECT alh.id,u.id as userId,u.name,u.customerCode,alh.validFromDate as disbursedDate,alh.approvedAmount,(SELECT IFNULL(name,'NA') FROM categories WHERE id=alh.loanCategory) AS loanName,";

            if(($request->fromDate && $request->toDate)){
                $querys .= "IFNULL((SELECT IFNULL(extraIntrestAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (alh.status='disbursed' OR alh.status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as extraIntrestAmount,IFNULL((SELECT IFNULL(SUM(plateform_fee),0) FROM renewal_loans WHERE loanid=alh.id AND txn_date BETWEEN '$request->fromDate' AND '$request->toDate'),0) as principleCharges,(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE status='success' AND loanId=alh.id AND txnType='out' AND transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') as paidDisbursementAmount,(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE debitRecordId!='0' AND status='success'  AND loanId=alh.id AND txnType='in' AND transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') as principleDeposited,(SELECT IFNULL(SUM(interestAmountPayble),0) FROM raw_materials_txn_details WHERE loanId=alh.id AND status='success' AND txnType='in' AND transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') as interestPaid,((SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE  status='success' AND loanId=alh.id AND txnType='out' AND transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') - (SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE debitRecordId!='0' AND status='success'  AND loanId=alh.id AND txnType='in' AND transactionDate BETWEEN '$request->fromDate' AND '$request->toDate')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1";
                if(isset($loanIds) && !empty($loanIds)){
                    $strLoanIds  = implode(',',$loanIds);
                    $querys .= " AND alh.id IN ($strLoanIds)"; 
                }
            }else{
                $querys .= "alh.extraIntrestAmount,IFNULL((SELECT IFNULL(SUM(plateform_fee),0) FROM renewal_loans WHERE loanid=alh.id),0) as principleCharges,(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE status='success' AND loanId=alh.id AND txnType='out') as paidDisbursementAmount,(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE debitRecordId!='0' AND txnType='in' AND status='success'  AND loanId=alh.id) as principleDeposited,(SELECT IFNULL(SUM(interestAmountPayble),0) FROM raw_materials_txn_details WHERE loanId=alh.id AND status='success') as interestPaid,((SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE  status='success' AND txnType='out' AND loanId=alh.id)-(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE debitRecordId!='0' AND status='success' AND txnType='in'  AND loanId=alh.id)) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1";
            }

            $querys .= " AND alh.loanCategory=3  AND alh.status='customer-approved' ORDER BY alh.id DESC";

            if($request->loanreportFilter == "none"){
                $nowcount = count($results);
                foreach(DB::select($querys) as $rsdata){
                    $results[$nowcount] = new stdClass();
                    $results[$nowcount]->userId = $rsdata->userId;
                    $results[$nowcount]->aid = $rsdata->aid ?? null;
                    $results[$nowcount]->id = $rsdata->id;
                    $results[$nowcount]->name = $rsdata->name;
                    $results[$nowcount]->loanName = $rsdata->loanName;
                    $results[$nowcount]->customerCode = $rsdata->customerCode;
                    $results[$nowcount]->approvedAmount = $rsdata->approvedAmount;
                    $results[$nowcount]->disbursedDate = $rsdata->disbursedDate;
                    $results[$nowcount]->paidDisbursementAmount = $rsdata->paidDisbursementAmount;
                    $results[$nowcount]->extraIntrestAmount = $rsdata->extraIntrestAmount;
                    $results[$nowcount]->principleCharges = $rsdata->principleCharges;
                    $results[$nowcount]->principleDeposited = $rsdata->principleDeposited;
                    $results[$nowcount]->interestPaid = $rsdata->interestPaid;
                    $results[$nowcount]->totalOutStanding = $rsdata->totalOutStanding;

                    $nowcount++;
                }
            }else{
                $results = DB::select($querys);
            }
            

        }
        if($request->loanreportFilter == 0 || $request->loanreportFilter == "none"){

            if($request->fromDate && $request->toDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate BETWEEN '$request->fromDate' AND '$request->toDate') OR (apply_loan_histories.disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate')");
                $allloans = array_unique(array_column($allloan,'a_loanId'));
              
                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId,'loanId'));
              
              	$loanIds = array_merge($allloans,$allloanEmiIds);
            }elseif($request->fromDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate >= '$request->fromDate')  OR (apply_loan_histories.disbursedDate >= '$request->fromDate')");
                $allloans = array_unique(array_column($allloan,'a_loanId'));
              
                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId,'loanId'));
              
              	$loanIds = array_merge($allloans,$allloanEmiIds);
            }elseif($request->toDate){
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate <= '$request->toDate')  OR (apply_loan_histories.disbursedDate <= '$request->toDate')");
                $allloans = array_unique(array_column($allloan,'a_loanId'));
              
                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId,'loanId'));
              
              	$loanIds = array_merge($allloans,$allloanEmiIds);
            }

            $querys = "SELECT alh.id,u.id as userId,u.name,u.customerCode,alh.disbursedDate,alh.approvedAmount,(SELECT IFNULL(name,'NA') FROM categories WHERE id=alh.loanCategory) AS loanName,";

            if(($request->fromDate && $request->toDate)){
                $subQueryCondi = '1';
                if($request->fromDate && $request->toDate){
                    $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)";
                }else if($request->fromDate){
                    $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate >= '$request->fromDate') ELSE (transactionDate >= '$request->fromDate') END)";
                }else{
                    $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate <= '$request->toDate') ELSE (transactionDate <= '$request->toDate') END)";
                }
                $querys .= "IFNULL((SELECT IFNULL(principleCharges,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as principleCharges,IFNULL((SELECT IFNULL(disbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as paidDisbursementAmount,(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE type='credit' AND loanId=alh.id AND txnDate BETWEEN '$request->fromDate' AND '$request->toDate') as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as interestPaid,(IFNULL((SELECT IFNULL(netDisbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0)-(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId=alh.id AND type='credit')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1";
               if(isset($loanIds) && !empty($loanIds)){
                $strLoanIds  = implode(',',$loanIds);
                $querys .= " AND alh.id IN ($strLoanIds)"; 
               }
            }else{
                $querys .= "alh.netDisbursementAmount,alh.disbursementAmount AS paidDisbursementAmount,alh.principleCharges,(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE type='credit' AND loanId=alh.id) as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success') as interestPaid,(alh.netDisbursementAmount - (SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE type='credit' AND loanId=alh.id)) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1";
            }

            $querys .= " AND alh.loanCategory=8  AND (alh.status='disbursed' OR alh.status='closed') ORDER BY alh.id DESC";
            
            if($request->loanreportFilter == "none"){
                $nowcount = count($results);
                foreach(DB::select($querys) as $rsdata){
                    $results[$nowcount] = new stdClass();
                    $results[$nowcount]->userId = $rsdata->userId;
                    $results[$nowcount]->aid = $rsdata->aid ?? null;
                    $results[$nowcount]->id = $rsdata->id;
                    $results[$nowcount]->name = $rsdata->name;
                    $results[$nowcount]->loanName = $rsdata->loanName;
                    $results[$nowcount]->customerCode = $rsdata->customerCode;
                    $results[$nowcount]->approvedAmount = $rsdata->approvedAmount;
                    $results[$nowcount]->disbursedDate = $rsdata->disbursedDate;
                    $results[$nowcount]->paidDisbursementAmount = $rsdata->paidDisbursementAmount;
                    $results[$nowcount]->extraIntrestAmount = 0;
                    $results[$nowcount]->principleCharges = $rsdata->principleCharges;
                    $results[$nowcount]->principleDeposited = $rsdata->principleDeposited;
                    $results[$nowcount]->interestPaid = $rsdata->interestPaid;
                    $results[$nowcount]->totalOutStanding = ($rsdata->approvedAmount-$rsdata->principleDeposited);
                    // $results[$nowcount]->totalOutStanding = $rsdata->totalOutStanding;

                    $nowcount++;
                }
            }else{
                $results = DB::select($querys);
            }
        }
        usort($results, fn($a, $b) => $b->id  <=> $a->id);



        $htmlStr = '<table id="mainTbl" class="table table-bordered">
                  <thead>
                  <tr>
                      <th>Sr. No.</th>
                      <th>Customer Code</th>
                      <th>Disbursed Date</th>
                      <th>Customer Name</th>
                      <th>Loan Id</th>
                      <th>Loan Type</th>
                      <th>Loan Amount</th>
                      <th>Processing Fee Received</th>
                      <th>Extra Days Interest</th>
                      <th>Disbursed Amount</th>
                      <th>Principal Deposit</th>
                      <th>Interest Gross CR</th>
                      <th>Out Standing Balance</th>
                  </tr>
                  </thead>';
        if (count($results)) {
            $htmlStr .= '<tbody>';
            $rsr = 1;
            $totalLoanAmount = 0;
            $totalProcessingFee = 0;
            $totalExtraDaysIn = 0;
            $totalDisbursedAmount = 0;
            $totalPrincipalDeposited = 0;
            $totalInterestGross = 0;
            $totalOutStandingBalance = 0;
            foreach ($results as $row) {
                $principleDeposited = $row->principleDeposited != '' ? $row->principleDeposited : 0;
                $interestPaid = $row->interestPaid != '' ? $row->interestPaid : 0;
                $totalOutStanding = $row->totalOutStanding != '' ? $row->totalOutStanding :  $row->netDisbursementAmount;
                $DisbursementAmount = $row->paidDisbursementAmount ? $row->paidDisbursementAmount : number_format(0.00,2);

                $htmlStr .= '<tr>';
                $htmlStr .= '<td>' . $rsr . '</td>';
                $htmlStr .= '<td>' . $row->customerCode . '</td>';
                $htmlStr .= '<td>' . ($row->disbursedDate??'--') . '</td>';
                $htmlStr .= '<td>' . $row->name . '</td>';
                $htmlStr .= '<td>LF0' . $row->id . '</td>';
                $htmlStr .= '<td>' . $row->loanName . '</td>';
                $htmlStr .= '<td>' . number_format($row->approvedAmount,2) . '</td>';
                $htmlStr .= '<td>' . number_format($row->principleCharges,2) . '</td>';
                $htmlStr .= '<td>' . number_format($row->extraIntrestAmount,2) . '</td>';
                $htmlStr .= '<td>' . number_format($DisbursementAmount,2) . '</td>';
                $htmlStr .= '<td>' . number_format($principleDeposited,2) . '</td>';
                $htmlStr .= '<td>' . number_format($interestPaid,2) . '</td>';
                $htmlStr .= '<td>' . number_format($totalOutStanding,2) . '</td>';
                $htmlStr .= '</tr>';
                $rsr++;

                $totalLoanAmount += $row->approvedAmount;
                $totalProcessingFee += $row->principleCharges;
                $totalExtraDaysIn += $row->extraIntrestAmount;
                $totalDisbursedAmount += $row->paidDisbursementAmount;
                $totalPrincipalDeposited += $principleDeposited;
                $totalInterestGross += $interestPaid;
                $totalOutStandingBalance += $totalOutStanding;
            }
            
            $htmlStr .= '</tbody>
            <tfoot>
            <tr>
            <td colspan="6">Total : </td>
            <td id="totalLoanAmount">'.number_format($totalLoanAmount,2).'</td>
            <td id="totalProcessingFee">'.number_format($totalProcessingFee,2).'</td>
            <td id="totalExtraDaysIn">'.number_format($totalExtraDaysIn,2).'</td>
            <td id="totalDisbursedAmount">'.number_format($totalDisbursedAmount,2).'</td>
            <td id="totalPrincipalDeposited">'.number_format($totalPrincipalDeposited,2).'</td>
            <td id="totalInterestGross">'.number_format($totalInterestGross,2).'</td>
            <td id="totalOutStandingBalance">'.number_format($totalOutStandingBalance,2).'</td>
            </tr>
            </tfoot>';
        }
        $htmlStr .= '</table>';
        return $htmlStr;
    }


    public function paymentReports(){
        return view('pages.reports.payment-report');
    }

    public function filterPaymentReports(Request $request){
        if (!$request->fromDate || $request->fromDate=="") {
            $request->merge(['fromDate' => '2019-01-01']);
        }
        if (!$request->toDate || $request->toDate=="") {
            $request->merge(['toDate' => date('Y-m-d')]);
        }
        $payType = $request->payTypereportFilter ?? '0';

        $totalEmiReceable1 = DB::select("SELECT SUM(loan_emi_details.netemiAmount) AS totalAmount FROM loan_emi_details LEFT JOIN users ON users.id=loan_emi_details.userId  LEFT JOIN apply_loan_histories ON apply_loan_histories.id=loan_emi_details.loanId  WHERE loan_emi_details.status='success'")[0]->totalAmount;
        $totalEmiReceable2 = DB::select("SELECT SUM(raw_materials_txn_details.amount+raw_materials_txn_details.interestAmountPayble) AS totalAmount FROM raw_materials_txn_details LEFT JOIN apply_loan_histories ON raw_materials_txn_details.loanId=apply_loan_histories.id LEFT JOIN users ON users.id=raw_materials_txn_details.userId  WHERE raw_materials_txn_details.status='success' AND raw_materials_txn_details.txnType='in'")[0]->totalAmount;
        $totalEmiReceable = $totalEmiReceable1 + $totalEmiReceable2;

        $totalDisbursed1 = DB::select("SELECT SUM(disbursementAmount) AS totalAmount FROM apply_loan_histories  WHERE apply_loan_histories.status IN ('closed','disbursed') AND apply_loan_histories.loanCategory!=3")[0]->totalAmount;
        $totalDisbursed2 = DB::select("SELECT SUM(raw_materials_txn_details.amount) AS totalAmount FROM raw_materials_txn_details LEFT JOIN apply_loan_histories ON raw_materials_txn_details.loanId=apply_loan_histories.id LEFT JOIN users ON users.id=raw_materials_txn_details.userId  WHERE raw_materials_txn_details.status='success' AND raw_materials_txn_details.txnType='out'")[0]->totalAmount;
        $totalDisbursed = $totalDisbursed1 + $totalDisbursed2;

        if($payType == '0'){ // Reciable
            $tname = 'Transaction';
            $results1 = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,users.customerCode,users.name,users.mobile,users.email,categories.name AS cname,loan_emi_details.emiId,loan_emi_details.transactionDate AS t_date,loan_emi_details.netemiAmount AS t_amount FROM loan_emi_details LEFT JOIN users ON users.id=loan_emi_details.userId  LEFT JOIN apply_loan_histories ON apply_loan_histories.id=loan_emi_details.loanId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory   WHERE loan_emi_details.status='success' AND loan_emi_details.transactionDate BETWEEN '$request->fromDate' AND '$request->toDate' ORDER BY loan_emi_details.transactionDate DESC");
            $results2 = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,users.customerCode,users.name,users.mobile,users.email,categories.name AS cname,raw_materials_txn_details.amount AS t_amount,raw_materials_txn_details.interestAmountPayble,raw_materials_txn_details.transactionDate AS t_date FROM raw_materials_txn_details LEFT JOIN apply_loan_histories ON raw_materials_txn_details.loanId=apply_loan_histories.id LEFT JOIN users ON users.id=raw_materials_txn_details.userId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory   WHERE raw_materials_txn_details.status='success' AND raw_materials_txn_details.txnType='in' AND raw_materials_txn_details.transactionDate BETWEEN '$request->fromDate' AND '$request->toDate'");
            // return $allloanEmiId;
        }else{ // disbursed
            $tname = 'Disbursed';
            $results1 = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,users.customerCode,users.name,users.mobile,users.email,categories.name AS cname,apply_loan_histories.disbursedDate AS t_date,apply_loan_histories.disbursementAmount AS t_amount FROM apply_loan_histories LEFT JOIN users ON users.id=apply_loan_histories.userId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory   WHERE apply_loan_histories.status IN ('closed','disbursed') AND apply_loan_histories.disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate' AND apply_loan_histories.loanCategory!=3 ORDER BY apply_loan_histories.disbursedDate DESC");
            $results2 = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,users.customerCode,users.name,users.mobile,users.email,categories.name AS cname,raw_materials_txn_details.amount AS t_amount,raw_materials_txn_details.transactionDate AS t_date FROM raw_materials_txn_details LEFT JOIN apply_loan_histories ON raw_materials_txn_details.loanId=apply_loan_histories.id LEFT JOIN users ON users.id=raw_materials_txn_details.userId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory  WHERE raw_materials_txn_details.status='success' AND raw_materials_txn_details.txnType='out' AND transactionDate BETWEEN '$request->fromDate' AND '$request->toDate'");
            // return $allloanF;
        }
        $results = array_merge($results1, $results2);
        usort($results, function ($a, $b) {
            return strtotime($b->t_date) <=> strtotime($a->t_date);
        });
        $rsr = 1;
        $totalAmount = 0;

        $htmlStr = '<table id="mainTbl" class="table table-bordered">
                  <thead>
                  <tr>
                      <th>Sr. No.</th>
                      <th>Customer Code</th>
                      <th>Customer Name</th>
                      <th>Loan Id</th>';
                      if($payType == '0'){
                        $htmlStr .=   '<th>EMI ID</th>';
                      }

                      $htmlStr .=   '<th>Loan Type</th>
                      <th>Loan Amount</th>
                      <th>'.$tname.' Date</th>
                      <th>'.$tname.' Amount</th>
                  </tr>
                  </thead>';
        if (count($results)) {
            $htmlStr .= '<tbody>';
            foreach ($results as $row) {
                $htmlStr .= '<tr>';
                $htmlStr .= '<td>' . $rsr . '</td>';
                $htmlStr .= '<td>' . $row->customerCode . '</td>';
                $htmlStr .= '<td>' . $row->name . '</td>';
                $htmlStr .= '<td>LF0' . $row->id . '</td>';
                if($payType == '0'){
                    $htmlStr .= '<td>'. ($row->emiId??'-') . '</td>';
                }
                $htmlStr .= '<td>' . $row->cname . '</td>';
                $htmlStr .= '<td>' . number_format($row->approvedAmount,2) . '</td>';
                $htmlStr .= '<td>' . date('Y-m-d',strtotime($row->t_date)) . '</td>';
                if(isset($row->interestAmountPayble) && $row->interestAmountPayble){
                    $totalAmount += ($row->t_amount+$row->interestAmountPayble);
                    $htmlStr .= '<td>' . number_format($row->t_amount+$row->interestAmountPayble,2) . '</td>';
                }else{
                    $totalAmount += $row->t_amount;
                    $htmlStr .= '<td>' . number_format($row->t_amount,2) . '</td>';
                }
                
                $htmlStr .= '</tr>';
                $rsr++;
            }
            $htmlStr .= '</tbody>
            <tfoot>
            <tr>
            <td colspan="7">Total : </td>';
            if($payType == '0'){
                $htmlStr .= '<td colspan="2">'.number_format($totalAmount,2).'</td>';
            }else{
                $htmlStr .= '<td colspan="1">'.number_format($totalAmount,2).'</td>';
            }
            $htmlStr .= '</tr>
            </tfoot>';
        }
        $htmlStr .= '</table>';
        return ['html'=>$htmlStr,'totalDisbursed'=>number_format($totalDisbursed,2),'totalEmiReceable'=>number_format($totalEmiReceable,2)];
    }


    public function nextMonthEmiReports(){
        return view('pages.reports.next-month-emi');
    }

    public function filternextMonthEmiReports(Request $request){

       $loanType = $request->loanTypereportFilter;
       if($request->selected_month){
        $nextMonth = date('m',strtotime($request->selected_month));
        $thisYear = date('Y',strtotime($request->selected_month));
       }else{
        $nextMonth = date('m');
        $thisYear = date('Y');
       }
       
       $SUBQRY = '';
       if($loanType && $loanType != '0'){
        $SUBQRY = ' AND apply_loan_histories.loanCategory='.$loanType;
       }
        $results = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,categories.name AS cname,users.customerCode,users.name,users.mobile,users.email,loan_emi_details.emiId,loan_emi_details.emiDate AS t_date,loan_emi_details.netemiAmount,loan_emi_details.lateCharges AS t_amount FROM loan_emi_details LEFT JOIN users ON users.id=loan_emi_details.userId  LEFT JOIN apply_loan_histories ON apply_loan_histories.id=loan_emi_details.loanId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory  WHERE loan_emi_details.status='pending' AND MONTH(loan_emi_details.emiDate)='$nextMonth' AND YEAR(loan_emi_details.emiDate)='$thisYear' $SUBQRY ORDER BY loan_emi_details.emiDate DESC");
        // $results2 = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,users.customerCode,users.name,users.mobile,users.email,raw_materials_txn_details.amount AS t_amount,raw_materials_txn_details.interestAmountPayble,raw_materials_txn_details.transactionDate AS t_date FROM raw_materials_txn_details LEFT JOIN apply_loan_histories ON raw_materials_txn_details.loanId=apply_loan_histories.id LEFT JOIN users ON users.id=raw_materials_txn_details.userId  WHERE raw_materials_txn_details.status='success' AND raw_materials_txn_details.txnType='in' AND raw_materials_txn_details.transactionDate BETWEEN '$request->fromDate' AND '$request->toDate' '$SUBQRY' ");
       
        $rsr = 1;
        $totalEMIAmount = 0;

        $htmlStr = '<table id="mainTbl" class="table table-bordered">
                  <thead>
                  <tr>
                      <th>Sr. No.</th>
                      <th>Customer Code</th>
                      <th>Customer Name</th>
                      <th>Loan Id</th>
                      <th>EMI ID</th>
                      <th>Loan Type</th>
                      <th>Loan Amount</th>
                      <th>EMI Date</th>
                      <th>Amount</th>
                  </tr>
                  </thead>';
        if (count($results)) {
            $htmlStr .= '<tbody>';
            foreach ($results as $row) {
                $htmlStr .= '<tr>';
                $htmlStr .= '<td>' . $rsr . '</td>';
                $htmlStr .= '<td>' . $row->customerCode . '</td>';
                $htmlStr .= '<td>' . $row->name . '</td>';
                $htmlStr .= '<td>LF0' . $row->id . '</td>
                <td>'. ($row->emiId??'-') . '</td>
                <td>' . $row->cname . '</td>';
                $htmlStr .= '<td>' . number_format($row->approvedAmount,2) . '</td>';
                $htmlStr .= '<td>' . date('Y-m-d',strtotime($row->t_date)) . '</td>';
                if(isset($row->interestAmountPayble) && $row->interestAmountPayble){
                    if($row->loanCategory == 8){
                        $totalEMIAmount += ($row->t_amount+$row->interestAmountPayble+$row->lateCharges); 
                    }else{
                        $totalEMIAmount += ($row->t_amount+$row->interestAmountPayble);
                    }
                    $totalEMIAmount += ($row->t_amount+$row->interestAmountPayble);
                    $htmlStr .= '<td>' . number_format($row->t_amount+$row->interestAmountPayble,2) . '</td>';
                }else{
                    $totalEMIAmount += $row->t_amount;
                    $htmlStr .= '<td>' . number_format($row->t_amount,2) . '</td>';
                }
                
                $htmlStr .= '</tr>';
                $rsr++;
            }
            $htmlStr .= '</tbody>
            <tfoot>
            <tr>
            <td colspan="7">Total : </td>
            <td colspan="2">'.number_format($totalEMIAmount,2).'</td>
            </tr>
            </tfoot>';
        }
        $htmlStr .= '</table>';
        return ['html'=>$htmlStr,'totalEMIAmount'=>number_format($totalEMIAmount,2)];
    }

}