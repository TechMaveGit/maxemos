<?php

namespace App\Http\Controllers;

use App\Models\LoanEmiDetail;
use DateTime;
use DB;
use stdClass;
use Illuminate\Http\Request;

class ExportController extends Controller
{

    public function excelReport(Request $request, $page)
    {
        // dd("--");
        $fileName = 'All_Loan-' . date('Y-m-d');

        $content = '';

        if ($page == "aum-report") {

            if (!$request->fromDate || $request->fromDate == "") {
                $request->merge(['fromDate' => '2020-01-01']);
            }
            if (!$request->toDate || $request->toDate == "") {
                $request->merge(['toDate' => date('Y-m-d')]);
            }
            if ($request->loanreportFilter == 1 || $request->loanreportFilter == "none") {

                if ($request->fromDate && $request->toDate) {
                    $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate BETWEEN '$request->fromDate' AND '$request->toDate') OR (apply_loan_histories.disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate')");
                    $allloans = array_unique(array_column($allloan, 'a_loanId'));

                    $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                    $allloanEmiIds = array_unique(array_column($allloanEmiId, 'loanId'));

                    $loanIds = array_merge($allloans, $allloanEmiIds);
                } elseif ($request->fromDate) {
                    $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate >= '$request->fromDate') OR (apply_loan_histories.disbursedDate >= '$request->fromDate')");
                    $allloans = array_unique(array_column($allloan, 'a_loanId'));

                    $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate >= '$request->fromDate') ELSE (transactionDate >= '$request->fromDate') END)");
                    $allloanEmiIds = array_unique(array_column($allloanEmiId, 'loanId'));

                    $loanIds = array_merge($allloans, $allloanEmiIds);
                } elseif ($request->toDate) {
                    $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate <= '$request->toDate') OR (apply_loan_histories.disbursedDate <= '$request->toDate')  ");
                    $allloans = array_unique(array_column($allloan, 'a_loanId'));

                    $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate <= '$request->toDate') ELSE (transactionDate <= '$request->toDate') END)");
                    $allloanEmiIds = array_unique(array_column($allloanEmiId, 'loanId'));

                    $loanIds = array_merge($allloans, $allloanEmiIds);
                }

                $querys = "SELECT alh.id,u.id as userId,alh.disbursedDate,alh.id as aid,u.name,u.customerCode,alh.approvedAmount,(SELECT IFNULL(name,'NA') FROM categories WHERE id=alh.loanCategory) AS loanName,";

                if (($request->fromDate || $request->toDate)) {

                    $subQueryCondi = '1';
                    if ($request->fromDate && $request->toDate) {
                        $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)";
                    } else if ($request->fromDate) {
                        $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate >= '$request->fromDate') ELSE (transactionDate >= '$request->fromDate') END)";
                    } else {
                        $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate <= '$request->toDate') ELSE (transactionDate <= '$request->toDate') END)";
                    }

                    $querys .= "IFNULL((SELECT IFNULL(extraIntrestAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (alh.status='disbursed' OR alh.status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as extraIntrestAmount,IFNULL((SELECT IFNULL(principleCharges,0) FROM apply_loan_histories WHERE id=alh.id AND (alh.status='disbursed' OR alh.status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as principleCharges,IFNULL((SELECT IFNULL(disbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as paidDisbursementAmount,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND  $subQueryCondi) as principleDeposited,(SELECT  IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as interestPaid,IFNULL((SELECT IFNULL(netDisbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";

                    if (isset($loanIds) && !empty($loanIds)) {
                        $strLoanIds  = implode(',', $loanIds);
                        $querys .= " AND alh.id IN ($strLoanIds)";
                    }
                } else {
                    $querys .= "alh.extraIntrestAmount,alh.principleCharges,alh.netDisbursementAmount,alh.disbursementAmount AS paidDisbursementAmount,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success') as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' ) as interestPaid,(alh.netDisbursementAmount - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";
                }

                $querys .= " AND alh.loanCategory=1  AND (alh.status='disbursed' OR alh.status='closed') ORDER BY alh.id DESC";

                //   echo $querys;

                $results = DB::select($querys);
            }
            if ($request->loanreportFilter == 2 || $request->loanreportFilter == "none") {
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

                if (($request->fromDate && $request->toDate)) {
                    $subQueryCondi = '1';
                    if ($request->fromDate && $request->toDate) {
                        $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)";
                    } else if ($request->fromDate) {
                        $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate >= '$request->fromDate') ELSE (transactionDate >= '$request->fromDate') END)";
                    } else {
                        $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate <= '$request->toDate') ELSE (transactionDate <= '$request->toDate') END)";
                    }

                    $querys .= "IFNULL((SELECT IFNULL(extraIntrestAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (alh.status='disbursed' OR alh.status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as extraIntrestAmount,IFNULL((SELECT IFNULL(principleCharges,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as principleCharges,IFNULL((SELECT IFNULL(disbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as paidDisbursementAmount,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as interestPaid,(IFNULL((SELECT IFNULL(netDisbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi)) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";
                    if (isset($loanIds) && !empty($loanIds)) {
                        $strLoanIds  = implode(',', $loanIds);
                        $querys .= " AND alh.id IN ($strLoanIds)";
                    }
                } else {
                    $querys .= "alh.extraIntrestAmount,alh.netDisbursementAmount,alh.disbursementAmount AS paidDisbursementAmount,alh.principleCharges,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success') as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' ) as interestPaid,(alh.netDisbursementAmount - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";
                }

                $querys .= " AND alh.loanCategory=2  AND (alh.status='disbursed' OR alh.status='closed') ORDER BY alh.id DESC";

                // $results->insert(DB::select($querys));
                // dd($results);

                if ($request->loanreportFilter == "none") {
                    $nowcount = count($results);
                    foreach (DB::select($querys) as $rsdata) {
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
                } else {
                    $results = DB::select($querys);
                }
            }
            if ($request->loanreportFilter == 3 || $request->loanreportFilter == "none") {

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

                if (($request->fromDate && $request->toDate)) {
                    $querys .= "IFNULL((SELECT IFNULL(extraIntrestAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (alh.status='disbursed' OR alh.status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as extraIntrestAmount,IFNULL((SELECT IFNULL(SUM(plateform_fee),0) FROM renewal_loans WHERE loanid=alh.id AND txn_date BETWEEN '$request->fromDate' AND '$request->toDate'),0) as principleCharges,(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE status='success' AND loanId=alh.id AND txnType='out' AND transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') as paidDisbursementAmount,(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE debitRecordId!='0' AND status='success'  AND loanId=alh.id AND txnType='in' AND transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') as principleDeposited,(SELECT IFNULL(SUM(interestAmountPayble),0) FROM raw_materials_txn_details WHERE loanId=alh.id AND status='success' AND txnType='in' AND transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') as interestPaid,((SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE  status='success' AND loanId=alh.id AND txnType='out' AND transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') - (SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE debitRecordId!='0' AND status='success'  AND loanId=alh.id AND txnType='in' AND transactionDate BETWEEN '$request->fromDate' AND '$request->toDate')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1";
                    if (isset($loanIds) && !empty($loanIds)) {
                        $strLoanIds  = implode(',', $loanIds);
                        $querys .= " AND alh.id IN ($strLoanIds)";
                    }
                } else {
                    $querys .= "alh.extraIntrestAmount,IFNULL((SELECT IFNULL(SUM(plateform_fee),0) FROM renewal_loans WHERE loanid=alh.id),0) as principleCharges,(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE status='success' AND loanId=alh.id AND txnType='out') as paidDisbursementAmount,(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE debitRecordId!='0' AND txnType='in' AND status='success'  AND loanId=alh.id) as principleDeposited,(SELECT IFNULL(SUM(interestAmountPayble),0) FROM raw_materials_txn_details WHERE loanId=alh.id AND status='success') as interestPaid,((SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE  status='success' AND txnType='out' AND loanId=alh.id)-(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE debitRecordId!='0' AND status='success' AND txnType='in'  AND loanId=alh.id)) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1";
                }

                $querys .= " AND alh.loanCategory=3  AND alh.status='customer-approved' ORDER BY alh.id DESC";

                if ($request->loanreportFilter == "none") {
                    $nowcount = count($results);
                    foreach (DB::select($querys) as $rsdata) {
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
                } else {
                    $results = DB::select($querys);
                }
            }
            if ($request->loanreportFilter == 0 || $request->loanreportFilter == "none") {

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

                if (($request->fromDate && $request->toDate)) {
                    $subQueryCondi = '1';
                    if ($request->fromDate && $request->toDate) {
                        $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)";
                    } else if ($request->fromDate) {
                        $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate >= '$request->fromDate') ELSE (transactionDate >= '$request->fromDate') END)";
                    } else {
                        $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate <= '$request->toDate') ELSE (transactionDate <= '$request->toDate') END)";
                    }
                    $querys .= "IFNULL((SELECT IFNULL(principleCharges,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as principleCharges,IFNULL((SELECT IFNULL(disbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as paidDisbursementAmount,(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE type='credit' AND loanId=alh.id AND txnDate BETWEEN '$request->fromDate' AND '$request->toDate') as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as interestPaid,(IFNULL((SELECT IFNULL(netDisbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0)-(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId=alh.id AND type='credit')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1";
                    if (isset($loanIds) && !empty($loanIds)) {
                        $strLoanIds  = implode(',', $loanIds);
                        $querys .= " AND alh.id IN ($strLoanIds)";
                    }
                } else {
                    $querys .= "alh.netDisbursementAmount,alh.disbursementAmount AS paidDisbursementAmount,alh.principleCharges,(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE type='credit' AND loanId=alh.id) as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success') as interestPaid,(alh.netDisbursementAmount - (SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE type='credit' AND loanId=alh.id)) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1";
                }

                $querys .= " AND alh.loanCategory=8  AND (alh.status='disbursed' OR alh.status='closed') ORDER BY alh.id DESC";

                if ($request->loanreportFilter == "none") {
                    $nowcount = count($results);
                    foreach (DB::select($querys) as $rsdata) {
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
                        $results[$nowcount]->totalOutStanding = ($rsdata->approvedAmount - $rsdata->principleDeposited);
                        // $results[$nowcount]->totalOutStanding = $rsdata->totalOutStanding;

                        $nowcount++;
                    }
                } else {
                    $results = DB::select($querys);
                }
            }
            usort($results, fn ($a, $b) => $b->id  <=> $a->id);


            $content = 'Sr. No., Customer Code, Disbursed Date, Customer Name, Loan Type, Loan Amount, Processing Fee Received, Extra Days Interest, Disbursed Amount, Principal Deposit, Interest Gross CR, Out Standing Balance' . "\r\n";

            $totalLoanAmount = 0;
            $totalProcessingFee = 0;
            $totalExtraDaysIn = 0;
            $totalDisbursedAmount = 0;
            $totalPrincipalDeposited = 0;
            $totalInterestGross = 0;
            $totalOutStandingBalance = 0;
            $disbursedDateRow = '--';

            foreach ($results as $k => $row) {
                $principleDeposited = $row->principleDeposited != '' ? $row->principleDeposited : 0;
                $interestPaid = $row->interestPaid != '' ? $row->interestPaid : 0;
                $totalOutStanding = $row->totalOutStanding != '' ? $row->totalOutStanding :  $row->netDisbursementAmount;
                $DisbursementAmount = $row->paidDisbursementAmount ? $row->paidDisbursementAmount : number_format(0.00, 2);
                $disbursedDateRow = $row->disbursedDate;

                $content .= ($k + 1) . ',' . $row->customerCode . ',' . $disbursedDateRow . ',' . $row->name . ',' .  $row->loanName . ','  .  $row->approvedAmount . ',' . $row->principleCharges . ',' . $row->extraIntrestAmount . ',' . $DisbursementAmount . ',' . $principleDeposited . ',' . $interestPaid . ',' . $totalOutStanding . "\r\n";

                $totalLoanAmount += $row->approvedAmount;
                $totalProcessingFee += $row->principleCharges;
                $totalDisbursedAmount += $DisbursementAmount;
                $totalPrincipalDeposited += $principleDeposited;
                $totalInterestGross += $interestPaid;
                $totalOutStandingBalance += $totalOutStanding;
                $totalExtraDaysIn += $row->extraIntrestAmount;
            }
            $content .= ',,,,,,,,' . "\r\n";
            $content .= ', TOTAL, , , ,' .  $totalLoanAmount . ',' .  $totalProcessingFee . ',' .  $totalExtraDaysIn . ',' .  $totalDisbursedAmount . ',' .  $totalPrincipalDeposited . ',' .  $totalInterestGross . ',' .  $totalOutStandingBalance . "\r\n";
        } elseif ($page == "customer-page-exports") {


            $customSearch = $request->customSearch;
            $fromDate = (strtotime($request->fromDate)) ? date('Y-m-d', strtotime($request->fromDate)) : '';
            $toDate = (strtotime($request->toDate)) ? date('Y-m-d', strtotime($request->toDate)) : '';
            $userStatus = $request->userStatus;

            $pageNameStr = $request->pageNameStr;

            $currentDate = date('Y-m-d');
            $month = date('m');
            $year = date('Y');

            $EXSUBQRY = " AND alh.id !='3'"; // 3=>Raw Material Financing
            $SUBQRY = " AND u.kycStatus='approved' AND eh.status='approved' ";

            if ($pageNameStr == 'today-disbursement') {
                $fileName = 'today-disbursement-' . date('Y-m-d');
                $SUBQRY .= " AND alh.status='disburse-scheduled' AND date(alh.disbursedDate)='$currentDate' $EXSUBQRY";
            } else if ($pageNameStr == 'pending-disbursement') {
                $fileName = 'pending-disbursement-' . date('Y-m-d');
                $SUBQRY .= "  AND alh.status='disburse-scheduled' AND date(alh.disbursedDate)!='$currentDate' $EXSUBQRY";
            } else if ($pageNameStr == 'loan-disbursed') {
                $fileName = 'loan-disbursed-' . date('Y-m-d');
                $SUBQRY .= " AND alh.status='disbursed'";
            } else if ($pageNameStr == 'customer-emi') {
                $fileName = 'customer-emi-' . date('Y-m-d');
                $SUBQRY .= " AND alh.status='disbursed' AND MONTH(ed.emiDate)='$month' AND YEAR(ed.emiDate)='$year' AND ed.status='success' AND ed.id IS NOT NULL  $EXSUBQRY";
            } else if ($pageNameStr == 'today-emi') {
                $fileName = 'today-emi-' . date('Y-m-d');
                if ($fromDate && $toDate) {

                    $SUBQRY .= " AND alh.status='disbursed' AND date(ed.emiDate)>='$fromDate' AND  date(ed.emiDate)<='$toDate' AND ed.status = 'pending' AND ed.id IS NOT NULL $EXSUBQRY";
                } else {
                    $startdatetime = new DateTime();
                    $enddatetime = new DateTime();
                    $startdatetime->setDate(date('Y'), date('m'), 05);
                    $enddatetime->setDate(date('Y'), date('m'), 12);
                    $sdate = $startdatetime->format('Y-m-d');
                    $edate = $enddatetime->format('Y-m-d');
                    $SUBQRY .= " AND alh.status='disbursed' AND date(ed.emiDate)>='$sdate' AND  date(ed.emiDate)<='$edate'  AND MONTH(ed.emiDate)='$month' AND YEAR(ed.emiDate)='$year' AND ed.status = 'pending'  $EXSUBQRY";
                }
            } else if ($pageNameStr == 'over-due-emi') {
                $fileName = 'over-due-emi-' . date('Y-m-d');
                if ($fromDate && $toDate) {
                    $SUBQRY .= " AND alh.status='disbursed' AND date(ed.emiDate)>='$fromDate' AND  date(ed.emiDate)<='$toDate' AND ed.status = 'pending' AND ed.id IS NOT NULL $EXSUBQRY";
                } else {
                    $today = date('Y-m-d');
                    $startdatetime = new DateTime();
                    $startdatetime->setDate(date('Y'), date('m'), 12);
                    $sdate = $startdatetime->format('Y-m-d');
                    $SUBQRY .= " AND alh.status='disbursed' AND date(ed.emiDueDate)<date('$today') AND MONTH(ed.emiDate)<='$month' AND YEAR(ed.emiDate)<='$year' AND ed.status = 'pending'  $EXSUBQRY";
                }
            } else if ($pageNameStr == 'closed-loans') {
                $fileName = 'closed-loans-' . date('Y-m-d');
                $SUBQRY .= " AND alh.status='closed'";
            } else if ($pageNameStr == 'noc-issued') {
                $fileName = 'noc-issued-' . date('Y-m-d');
                $SUBQRY .= " AND alh.status='disbursed' AND alh.status='noc-issued'";
            } else if ($pageNameStr == 'received-emi') {
                $fileName = 'received-emi-' . date('Y-m-d');
                if ($fromDate && $toDate) {
                    $SUBQRY .= "  AND (alh.loanCategory != 3 AND alh.status='disbursed' AND ed.userId = alh.userId AND ed.status='success' AND date(ed.transactionDate)>='$fromDate' AND date(ed.transactionDate)<='$toDate' ) OR (alh.loanCategory=3 AND alh.id IN (SELECT rmtd.loanId FROM raw_materials_txn_details AS rmtd WHERE rmtd.loanId = alh.id AND rmtd.txnType ='in' AND date(rmtd.transactionDate)>='$fromDate' AND date(rmtd.transactionDate)<='$toDate' )) ";
                } else {
                    $SUBQRY .= "  AND (alh.loanCategory != 3 AND alh.status='disbursed' AND ed.userId = alh.userId AND ed.status='success' AND date(ed.transactionDate)='$currentDate') OR (alh.loanCategory=3 AND alh.id IN (SELECT rmtd.loanId FROM raw_materials_txn_details AS rmtd WHERE rmtd.loanId = alh.id AND rmtd.txnType ='in' AND date(rmtd.transactionDate)='$currentDate')) ";
                }
            }else if ($pageNameStr == 'all-loan-list'){
                if ($fromDate && $toDate) {
                    $SUBQRY .= "  AND date(alh.disbursedDate)>='$fromDate' AND date(alh.disbursedDate)<='$toDate' ";
                }
                if ($request->loanType) {
                    $loanTypes = $request->loanType;
                    $SUBQRY .= "  AND alh.loanCategory='$loanTypes'";
                }
            }

            if ($userStatus == 1 || $userStatus == 0) {
                $SUBQRY .= " AND u.status='$userStatus'";
            }

            if (!in_array($pageNameStr, array('all-loan-list','received-emi', 'today-emi', 'over-due-emi')) && $fromDate && $toDate) {
                $SUBQRY .= " AND date(u.created_at)>='$fromDate' AND date(u.created_at)<='$toDate'";
            }

            if ($customSearch) {
                $SUBQRY .= " AND (u.customerCode LIKE '%$customSearch%' OR u.name LIKE '%$customSearch%' OR u.email LIKE '%$customSearch%' OR u.mobile LIKE '%$customSearch%')";
            }

            // $banks=BanK::where(['status'=>1])->orderBy('name','asc')->get();
            $userColumns = "u.id,u.customerCode,u.name,u.mobile,u.email,u.gender,u.profilePic,u.dateOfBirth,u.maritalStatus,u.addressLine1,u.addressLine2,u.city,u.state,u.district,u.pincode,u.userMpin,u.aadhaar_no,u.pancard_no,u.userType,u.status,u.kycStatus,u.created_at,u.updated_at";
            if ($pageNameStr == 'all-loan-list') {
                $customers = DB::select("SELECT $userColumns,alh.id as loanId,alh.bankId as loanFromBank,alh.isAdminApproved,alh.reject_reason,alh.loanAmount appliedLoanAmount,alh.tenure as appliedTenure,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.approvedAmount,alh.status as loanStatus,alh.remark,p.productCode,p.productName,p.rateOfInterest as productROI,p.tenure as productTenure,p.amount as productAmount,p.amountTo as productAmountTo,p.numOfEmi as productEMI,p.productType,c.name as categoryName,sc.name as subCategoryName FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN  employment_histories eh ON u.id=eh.userId LEFT JOIN products p ON alh.productId=p.id LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN subcategories sc ON p.subCategoryId=sc.id WHERE u.userType='user' AND alh.id IS NOT NULL   $SUBQRY GROUP BY $userColumns,alh.id,alh.bankId,alh.loanAmount,alh.tenure,alh.rateOfInterest,alh.approvedAmount,alh.approvedAmount,alh.status,alh.remark,p.productCode,p.productName,p.rateOfInterest,p.tenure,p.amount,p.amountTo,p.numOfEmi,p.productType,c.name,sc.name ORDER BY u.id desc");
            } else{
                $customers = DB::select("SELECT $userColumns,alh.id as loanId,alh.bankId as loanFromBank,alh.loanAmount appliedLoanAmount,alh.tenure as appliedTenure,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.approvedAmount,alh.status as loanStatus,alh.remark,p.productCode,p.productName,p.rateOfInterest as productROI,p.tenure as productTenure,p.amount as productAmount,p.amountTo as productAmountTo,p.numOfEmi as productEMI,p.productType,c.name as categoryName,sc.name as subCategoryName FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN  employment_histories eh ON u.id=eh.userId LEFT JOIN products p ON alh.productId=p.id LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN subcategories sc ON p.subCategoryId=sc.id LEFT JOIN loan_emi_details ed ON alh.id=ed.loanId WHERE u.userType='user'  $SUBQRY GROUP BY $userColumns,alh.id,alh.bankId,alh.loanAmount,alh.tenure,alh.rateOfInterest,alh.approvedAmount,alh.approvedAmount,alh.status,alh.remark,p.productCode,p.productName,p.rateOfInterest,p.tenure,p.amount,p.amountTo,p.numOfEmi,p.productType,c.name,sc.name ORDER BY u.id desc");
            }
            if ($pageNameStr == 'closed-loans' || $pageNameStr == 'all-loan-list') {
                $content = 'Sr. No., Cust. ID, Loan ID, Name, Email, Mobile No., Loan Type, Date, Status' . "\r\n";
            } else {
                $content = 'Sr. No., Cust. ID, Name, Email, Mobile No., Loan Type, Date, Status' . "\r\n";
            }

            foreach ($customers as $k => $row) {
                $createdDate = (strtotime($row->created_at)) ? date('d/m/Y', strtotime($row->created_at)) : '';
                $statusdata = 'Deactive';
                if ($row->status == 1) {
                    $statusdata = 'Active';
                } else if ($row->status == 2) {
                    $statusdata = 'Rejected';
                }
                if ($pageNameStr == 'closed-loans' || $pageNameStr == 'all-loan-list') {
                    $content .= ($k + 1) . ',' . $row->customerCode . ',LF0' . $row->loanId . ',' . $row->name . ',' .  $row->email . ','  .  $row->mobile . ',' . $row->categoryName . ',' . $createdDate . ',' . $statusdata . "\r\n";
                } else {
                    $content .= ($k + 1) . ',' . $row->customerCode . ',' . $row->name . ',' .  $row->email . ','  .  $row->mobile . ',' . $row->categoryName . ',' . $createdDate . ',' . $statusdata . "\r\n";
                }
            }
        } elseif ($page == 'over-due-payments') {
            $fileName = 'OverDueReport-' . date('Y-m-d');
            $content = 'Sr. No., Customer Code, Customer Name, Customer Email, Customer Mobile, Loan Type, EMI Amount, EMI Date, EMI Due Date, Due Days' . "\r\n";
            
            $today = date('Y-m-d');
            $previewCode = '';
            $fromDate = (strtotime($request->fromDate)) ? date('Y-m-d', strtotime($request->fromDate)) : null;
            $toDate = (strtotime($request->toDate)) ? date('Y-m-d', strtotime($request->toDate)) : null;
            $SUBQRY = '';
        
            if ($fromDate && $toDate) {
                $SUBQRY .= " AND date(led.emiDueDate) BETWEEN date('$fromDate') AND date('$toDate') AND led.status='pending'";
            } elseif ($fromDate) {
                $SUBQRY .= " AND date(led.emiDueDate) >= date('$fromDate') AND led.status='pending'";
            } elseif ($toDate) {
                $SUBQRY .= " AND date(led.emiDueDate) <= date('$toDate') AND led.status='pending'";
            } else {
                $SUBQRY .= " AND date(led.emiDueDate) <= date('$today') AND  led.status='pending'";
            }
            if($request->loanType != 0){
                $SUBQRY .= " AND alh.loanCategory=$request->loanType";
            }

            $results = DB::select("SELECT u.id as userId,u.customerCode,u.name,u.email,u.mobile,categories.name AS cname,u.name,u.email,u.mobile,alh.id as loanId,alh.productId,alh.loanAmount appliedLoanAmount,alh.tenure as appliedTenureId,alh.approvedTenure as approvedTenureId,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.approvedAmount,alh.status as loanStatus,alh.disbursedDate,alh.remark,alh.loanCategory,led.emiAmount,led.emiDate,led.emiDueDate,led.status,led.transactionId,led.payment_mode,led.transactionDate,led.lateCharges FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id LEFT JOIN loan_emi_details led ON alh.id=led.loanId LEFT JOIN categories ON categories.id=alh.loanCategory WHERE u.id>0 $SUBQRY ORDER BY alh.id DESC");
            foreach ($results as $k => $row) {
                $totaldays =0;
                $now = strtotime($today);
                $your_date = strtotime($row->emiDueDate);
                $datediff = $now - $your_date;
                $totaldays = abs(round($datediff / (60 * 60 * 24)));
                

                $transactionDate = (strtotime($row->transactionDate)) ? date('d-m-Y', strtotime($row->transactionDate)) : '';
                $emiDate = (strtotime($row->emiDate)) ? date('d-m-Y', strtotime($row->emiDate)) : '';
                $emiDueDate = (strtotime($row->emiDueDate)) ? date('d-m-Y', strtotime($row->emiDueDate)) : '';

                $content .= ($k + 1) . ',' . $row->customerCode . ',' . $row->name . ',' .  $row->email . ','  .  $row->mobile. ','  .  $row->cname . ',' . $row->emiAmount . ',' . $emiDate . ',' . $emiDueDate. ',' . $totaldays . "\r\n";
                
            }
        } elseif ($page == 'all-customers-list') {
            $fileName = 'Customers-' . date('Y-m-d');
            $content = 'Sr. No., Cust. ID, Customer Name, Customer Email, Customer Mobile, Onboarding Date, KYC Status, Business Status' . "\r\n";

            $fromDate = (strtotime($request->fromDate)) ? date('Y-m-d', strtotime($request->fromDate)) : '';
            $toDate = (strtotime($request->toDate)) ? date('Y-m-d', strtotime($request->toDate)) : '';
            $SUBQRY = '';

            if ($request->kycStatus && $request->kycStatus != '0') {
                $SUBQRY .= " AND u.kycStatus='$request->kycStatus'";
            }
            if ($request->businessStatus && $request->businessStatus != '0') {
                $SUBQRY .= " AND eh.status='$request->businessStatus'";
            }
            if ($fromDate != "" && $toDate != "") {
                $SUBQRY .= " AND date(u.created_at)>='$fromDate' AND date(u.created_at)<='$toDate'";
            }
            $results = DB::select("SELECT u.*,eh.id as employmentHistoryId,eh.status as employmentStatus FROM users u LEFT JOIN employment_histories eh ON u.id=eh.userId WHERE u.userType='user' $SUBQRY ORDER BY u.id desc");
            foreach ($results as $k => $row) {
                $createdDate = (strtotime($row->created_at)) ? date('d/m/Y', strtotime($row->created_at)) : '';
                $content .= ($k + 1) . ',' . $row->customerCode . ',' . $row->name . ',' .  $row->email . ','  .  $row->mobile . ',' . $createdDate . ',' . ucfirst($row->kycStatus) . ',' . ucfirst($row->employmentStatus) . "\r\n";
            }
        } elseif ($page == 'raw-over-due-payments') {
            $fileName = 'RawOverDueReport-' . date('Y-m-d');
            $content = 'Sr. No., Customer Code, Customer Name, Customer Email, Customer Mobile,Company Name, Withdraw Date, Withdraw Amount, Tenure, Due Amount,Due Days,Over Due Date' . "\r\n";
            $today = date('Y-m-d');
            $SUBQRY = '';
            if ($request->fromDate) {
                $SUBQRY .= " AND date(rawl.tenureDueDate) BETWEEN date('$request->fromDate') AND date('$request->toDate')";
            } else {
                $SUBQRY .= " AND date(rawl.tenureDueDate) < date('$today')";
            }
            $results = DB::select("SELECT u.id as userId,u.customerCode,u.name AS uname,u.email,u.mobile,alh.id as loanId,alh.productId,eh.employerName,rawl.openingDate,rawl.amount,rawl.openingBalanceLatest,rawl.status,rawl.tenureDueDate,tenures.name FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id LEFT JOIN raw_materials_txn_details rawl ON alh.id=rawl.loanId LEFT JOIN tenures ON rawl.approvedTenure = tenures.id LEFT JOIN employment_histories AS eh ON eh.userId=u.id  WHERE u.id>0 AND rawl.txnType='out' AND rawl.openingBalanceLatest > 0  $SUBQRY  ORDER BY u.id DESC");
            $previewCode = '';
            foreach ($results as $k => $row) {

                $openingDate = (strtotime($row->openingDate)) ? date('d-m-Y', strtotime($row->openingDate)) : '';
                $tenureDueDate = (strtotime($row->tenureDueDate)) ? date('d-m-Y', strtotime($row->tenureDueDate)) : '';
                $to = \Carbon\Carbon::createFromFormat('y-m-d', date('y-m-d'));
                $from = \Carbon\Carbon::createFromFormat('y-m-d', date('y-m-d', strtotime($row->tenureDueDate)));

                $days = $to->diffInDays($from);

                if ($row->customerCode == $previewCode) {
                    $content .= ($k + 1) . ', , , , , ,' . $openingDate . ',' . $row->amount . ',' . $row->name . ',' . $row->openingBalanceLatest . ',' . $days . ',' . $tenureDueDate . "\r\n";
                } else {
                    $content .= ($k + 1) . ',' . $row->customerCode . ',' . trim($row->uname) . ',' .  trim($row->email) . ','  .  trim($row->mobile) . ','  .  trim($row->employerName) . ',' . $openingDate . ',' . $row->amount . ',' . $row->name . ',' . $row->openingBalanceLatest . ',' . $days . ',' . $tenureDueDate . "\r\n";
                }
                $previewCode = $row->customerCode;
            }
        }elseif ($page == 'payment-report') {
            $fileName = 'PaymentReport-' . date('Y-m-d');
            $payType = $request->payTypereportFilter ?? '0';
            $coladd = 'EMI ID,';
            $tname = 'Disbursed';
            if($payType != '0'){
                $coladd = '';
                $tname = 'Transaction';
            }

            $content = 'Sr. No., Customer Code, Customer Name, Customer Email, Customer Mobile,Loan Type, Loan Id, '.$coladd.' Loan Amount,'.$tname.' Date,'.$tname.' Amount' . "\r\n";
            if (!$request->fromDate || $request->fromDate=="") {
                $request->merge(['fromDate' => '2019-01-01']);
            }
            if (!$request->toDate || $request->toDate=="") {
                $request->merge(['toDate' => date('Y-m-d')]);
            }
            $payType = $request->payTypereportFilter ?? '0';
    
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
            foreach ($results as $k => $row) {
                $addcontent = '';
                if($payType == '0'){
                    $addcontent = ',' .($row->emiId??'-');
                }
                $tamount = $row->t_amount;
                if(isset($row->interestAmountPayble) && $row->interestAmountPayble){
                    $tamount = $row->t_amount+$row->interestAmountPayble;
                }
                $content .= ($k + 1) . ',' . $row->customerCode . ',' . trim($row->name) . ',' .  trim($row->email) . ','  .  trim($row->mobile) . ','  .  trim($row->cname) . ',LF0' . $row->id .$addcontent. ',' . $row->approvedAmount . ',' . date('Y-m-d',strtotime($row->t_date)) . ',' . $tamount . "\r\n";
                
            }
        }elseif ($page == 'next-month-emi') {
            $fileName = 'NextMonthEMI-' . date('Y-m-d');
            // dd($request->all());

            $content = 'Sr. No., Customer Code, Customer Name, Customer Email, Customer Mobile,Loan Type, Loan Id, EMI ID, Loan Amount,EMI Date,EMI Amount' . "\r\n";
            $loanType = $request->loanTypereportFilter;
            $nextMonth = date('m', strtotime('+1 month'));
            $thisYear = date('Y');
            $SUBQRY = '';
            if($loanType && $loanType != '0'){
                $SUBQRY = ' AND apply_loan_histories.loanCategory='.$loanType;
            }
            
            $results = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,categories.name AS cname,users.customerCode,users.name,users.mobile,users.email,loan_emi_details.emiId,loan_emi_details.emiDate AS t_date,loan_emi_details.netemiAmount AS t_amount FROM loan_emi_details LEFT JOIN users ON users.id=loan_emi_details.userId  LEFT JOIN apply_loan_histories ON apply_loan_histories.id=loan_emi_details.loanId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory  WHERE loan_emi_details.status='pending' AND MONTH(loan_emi_details.emiDate)='$nextMonth' AND YEAR(loan_emi_details.emiDate)='$thisYear' $SUBQRY ORDER BY loan_emi_details.emiDate DESC");
            foreach ($results as $k => $row) {

                $tamount = $row->t_amount;
                if(isset($row->interestAmountPayble) && $row->interestAmountPayble){
                    $tamount = $row->t_amount+$row->interestAmountPayble;
                }
                
                $content .= ($k + 1) . ',' . $row->customerCode . ',' . trim($row->name) . ',' .  trim($row->email) . ','  .  trim($row->mobile) . ','  .  trim($row->cname) . ',LF0' . $row->id . ','. ($row->emiId??'-') . ',' . $row->approvedAmount . ',' . date('Y-m-d',strtotime($row->t_date)) . ',' . $tamount . "\r\n";
                
            }
        } else if ($page == 'raw-material-financing-loans') {
            $fileName = 'RawMaterialFinancingLoans-' . date('Y-m-d');
            $content = 'Sr. No., Customer Code, Customer Name, Customer Email, Customer Mobile, Approved Amount, Open Limit, Out Standing Amount' . "\r\n";
            $today = date('Y-m-d');

            $customSearch = $request->customSearch;
            $fromDate = (strtotime($request->fromDate)) ? date('Y-m-d', strtotime($request->fromDate)) : '';
            $toDate = (strtotime($request->toDate)) ? date('Y-m-d', strtotime($request->toDate)) : '';
            $userStatus = $request->userStatus;

            $pageNameStr = $request->pageNameStr;

            $SUBQRY = '';
            $SUBQRY .= " AND u.kycStatus='approved' AND eh.status='approved' AND alh.status='customer-approved' AND alh.loanCategory='3' AND alh.id IS NOT NULL";


            if ($userStatus == 1 || $userStatus == 0) {
                $SUBQRY .= " AND u.status='$userStatus'";
            }

            if ($fromDate && $toDate) {
                $SUBQRY .= " AND date(u.created_at)>='$fromDate' AND date(u.created_at)<='$toDate'";
            }

            if ($customSearch) {
                $SUBQRY .= " AND (u.customerCode LIKE '%$customSearch%' OR u.name LIKE '%$customSearch%' OR u.email LIKE '%$customSearch%' OR u.mobile LIKE '%$customSearch%')";
            }
            $results = DB::select("SELECT u.name,u.customerCode,u.mobile,u.email,alh.id as loanId,eh.id as employmentHistoryId,alh.status as loanStatus,eh.status as employmentStatus,alh.approvedAmount,(SELECT IFNULL(SUM(openingBalanceLatest),0) FROM raw_materials_txn_details WHERE status='success' AND loanId=alh.id AND txnType='out') as netDisbursementAmount FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN employment_histories eh ON u.id=eh.userId WHERE u.userType='user' $SUBQRY ORDER BY u.id desc");

            // dd($results);
            foreach ($results as $k => $row) {
                $content .= ($k + 1) . ',' . $row->customerCode . ',' . $row->name . ',' .  $row->email . ','  .  $row->mobile . ',' . $row->approvedAmount . ',' . ($row->approvedAmount - $row->netDisbursementAmount) . ',' . $row->netDisbursementAmount . "\r\n";
            }
        } else if ($page == 'customer-rawmaterial-dataexport') {
            $fileName = 'RawMaterialFinancingLoans-' . date('Y-m-d');
            $filterType = $request->filterData ?? 'all';
            $loanId = $request->loanId;

            if ($filterType == 'all') {
                $content = 'Sr. No., Opening Date, Opening Amount, Closing Date, Closing Amount, Withdraw Amount, Deposit, Interest Days, Total Interest, TDS %, TDS Amount, Net Interest, Late Charge, No. of days of late charges, Principle Deposit, Tenure, Invoice No., Status, Created Date' . "\r\n";
                $selQry = "SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.loanId='$loanId' AND rmc.status='success' ORDER BY rmc.id DESC";
            } else if ($filterType == 'credit') {
                $content = 'Sr. No., Amount, Transaction Id, Payment Mode, Transaction Date, Tenure, Invoice No., Status, Created Date' . "\r\n";
                $selQry = "SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.txnType='out' AND rmc.loanId='$loanId' AND rmc.status='success' ORDER BY rmc.id DESC";
            } else if ($filterType == 'debit') {
                $content = 'Sr. No., Opening Date, Opening Amount, Closing Date, Closing Amount, Deposit, Interest Days, Total Interest, TDS %, TDS Amount, Net Interest, Late Charge, No. of days of late charges, Principle Deposit, Tenure, Status, Created Date' . "\r\n";
                $selQry = "SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.txnType='in' AND rmc.loanId='$loanId' AND rmc.status='success' ORDER BY rmc.id DESC";
            } else if ($filterType == 'due') {
                $content = 'Sr. No., Amount, Opening Date, Due Date, Due Amount, Invoice No., Status, Created Date' . "\r\n";
                $selQry = "SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.loanId='$loanId' AND rmc.status='success' AND rmc.txnType='out' AND rmc.openingBalanceLatest != 0 ORDER BY rmc.id DESC";
            }
            $loanDetails_raw = DB::select($selQry);
            if ($loanDetails_raw && count($loanDetails_raw) > 0) {
                foreach ($loanDetails_raw as $kk => $lrow) {
                    $applyDate = (strtotime($lrow->created_at)) ? date('d-M-Y', strtotime($lrow->created_at)) : '';
                    $transactionDate = (strtotime($lrow->transactionDate)) ? date('d-M-Y', strtotime($lrow->transactionDate)) : '';
                    $openingdate = (strtotime($lrow->openingDate)) ? date('d-M-Y', strtotime($lrow->openingDate)) : '';
                    $closingDate = $transactionDate;
                    $debitStatus = strtoupper($lrow->status);
                    $tenureDueDate = (strtotime($lrow->tenureDueDate)) ? date('d M, Y', strtotime($lrow->tenureDueDate)) : '';

                    $content .= ($kk + 1) . ',';
                    if ($filterType == 'all') {
                        if ($lrow->txnType == 'in') {
                            $content .= $openingdate . ',' . $lrow->openingBalance . ',' . $closingDate . ',' . $lrow->outstandingBalance . ', ,' . ($lrow->totalAmount + $lrow->lateCharges) . ',' . $lrow->numOfDays . ',' . $lrow->interestAmount . ',' . $lrow->tdsPercent . ',' . $lrow->tdsAmount . ',' . $lrow->interestAmountPayble . ',' . $lrow->lateCharges . ',' . $lrow->numOfDaysOfFine . ',' . $lrow->amount . ', , ,' . $debitStatus;
                        } else {
                            $invNumber = ($lrow->invoiceNumber) ? $lrow->invoiceNumber : '';
                            $content .= $openingdate . ', , , ,' . $lrow->amount . ', , , , , , , , , ,' . $lrow->tenureName . ',' . ($lrow->drawDownFormFile ? env('APP_URL') . 'public/' . $lrow->drawDownFormFile : '') . ',' . $debitStatus;
                        }
                    } elseif ($filterType == 'credit') {
                        $invNumber = ($lrow->invoiceNumber) ? $lrow->invoiceNumber : '';
                        $content .= $lrow->amount . ',' . $lrow->transactionId . ',' . strtoupper($lrow->payment_mode) . ',' . $transactionDate . ',' . $lrow->tenureName . ',' . ($lrow->drawDownFormFile ? env('APP_URL') . 'public/' . $lrow->drawDownFormFile : '') . ',' . $debitStatus;
                    } else if ($filterType == 'debit') {
                        $content .= $openingdate . ',' . $lrow->openingBalance . ',' . $closingDate . ',' . $lrow->outstandingBalance . ', ,' . ($lrow->totalAmount + $lrow->lateCharges) . ',' . $lrow->numOfDays . ',' . $lrow->interestAmount . ',' . $lrow->tdsPercent . ',' . $lrow->tdsAmount . ',' . $lrow->interestAmountPayble . ',' . $lrow->lateCharges . ',' . $lrow->numOfDaysOfFine . ',' . $lrow->amount . ',' . $lrow->tenureName . ',' . $debitStatus;
                    } else if ($filterType == 'due') {
                        $invNumber = ($lrow->invoiceNumber) ? $lrow->invoiceNumber : '';
                        $content .= $lrow->amount . ',' . $openingdate . ',' . $tenureDueDate . ',' . $lrow->openingBalanceLatest . ',' . ($lrow->drawDownFormFile ? env('APP_URL') . 'public/' . $lrow->drawDownFormFile : '') . ',' . $debitStatus;
                    }
                    $content .= ',' . $applyDate . "\r\n";
                }
            }
        }else if($page == 'emi-card'){

            $fileName = 'EmiData-' . date('Y-m-d');
            $loanId=$request->loanId;
            $content = 'EMI ID., Customer Code, Customer Name, Customer Email, Customer Mobile,Company Name, Withdraw Date, Withdraw Amount, Tenure, Due Amount,Due Days,Over Due Date' . "\r\n";
            $loanDetailsArr=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.id='$loanId' ORDER BY alh.id DESC");
            if(count($loanDetailsArr))
            {
                $loanDetails=$loanDetailsArr[0];
            }
            $emiDetails=LoanEmiDetail::where(['loanId'=>$loanId])->orderBy('emiSr','asc')->get();
            // $loanId = $request->loanId;
            // $loanDetailsArr=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.id='$loanId' ORDER BY alh.id DESC");
            // if(count($loanDetailsArr))
            // {
            //     $loanDetails=$loanDetailsArr[0];
            // }
            // $emiDetails=LoanEmiDetail::where(['loanId'=>$loanId])->orderBy('emiSr','asc')->get();
            // if($loanDetails->roiType =='quaterly_interest'){ $mtxt ='QUARTERLY';}else{$mtxt ='MONTHLY';}
            //          if($loanDetails->loanCategory==8){
                        
            //              $htmlStr .= '<th scope="col"> '.$mtxt.' INTEREST</th>';
            //          }else{
            //              $htmlStr .= '<th scope="col">EMI Amount</th>';
            //              if($loanDetails->tds > 0 && $loanDetails->loanCategory == 1){
            //                  $htmlStr .= '<th scope="col">NET EMI Amount</th>';
            //              }
            //          }
        }else if($page == 'accrud-working'){

            $fileName = 'AccrudWorking-' . date('Y-m-d');
            $content = 'Sr. No.,Customer Code,Customer Name,Loan Id,Loan Type,Start Date,Closing Date,ROI %,No Of Dates,O/S AMOUNT (Sum),ACCRUD INTEREST (Sum)' . "\r\n";


            if($request->quarterlyFilter){
                $rdata = explode('-',$request->quarterlyFilter) ;
                $startDate = date('Y-m-1',strtotime($rdata[0]));
                $endDate = date('Y-m-t', strtotime($rdata[1]));
            }
    
            $loanType = $request->loanTypereportFilter;
           
    
            $SUBQRY = '';
            if($loanType && $loanType == '3'){
                $SUBQRY .= " AND date(rawl.tenureDueDate) BETWEEN date('$startDate') AND date('$endDate')";
                $results = DB::select("SELECT alh.id,alh.rateOfInterest,rawl.interestAmount,u.id as userId,u.customerCode,u.name,u.email,u.mobile,alh.id as loanId,alh.productId,eh.employerName,rawl.openingDate,rawl.amount as netemiAmount,rawl.openingBalanceLatest,rawl.interestAmountPayble,categories.name AS cname,rawl.status,rawl.tenureDueDate AS t_date,tenures.name AS tname FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id LEFT JOIN raw_materials_txn_details rawl ON alh.id=rawl.loanId LEFT JOIN tenures ON rawl.approvedTenure = tenures.id LEFT JOIN employment_histories AS eh ON eh.userId=u.id LEFT JOIN categories ON categories.id=alh.loanCategory  WHERE u.id>0 AND rawl.txnType='out' AND rawl.openingBalanceLatest > 0  $SUBQRY  ORDER BY u.id DESC");
            }elseif ($loanType && $loanType != '0') {
                $SUBQRY = ' AND apply_loan_histories.loanCategory=' . $loanType;
                $results = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,apply_loan_histories.rateOfInterest,categories.name AS cname,users.customerCode,users.name,users.mobile,users.email,loan_emi_details.emiId,loan_emi_details.emiDate AS t_date,loan_emi_details.netemiAmount,loan_emi_details.emiAmount,loan_emi_details.lateCharges AS t_amount FROM loan_emi_details LEFT JOIN users ON users.id=loan_emi_details.userId  LEFT JOIN apply_loan_histories ON apply_loan_histories.id=loan_emi_details.loanId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory  WHERE loan_emi_details.status='pending' AND DATE(loan_emi_details.emiDate) BETWEEN '$startDate' AND '$endDate' $SUBQRY ORDER BY loan_emi_details.emiDate,users.customerCode DESC");
            }else{
                $results = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,apply_loan_histories.rateOfInterest,categories.name AS cname,users.customerCode,users.name,users.mobile,users.email,loan_emi_details.emiId,loan_emi_details.emiDate AS t_date,loan_emi_details.netemiAmount,loan_emi_details.emiAmount,loan_emi_details.lateCharges AS t_amount FROM loan_emi_details LEFT JOIN users ON users.id=loan_emi_details.userId  LEFT JOIN apply_loan_histories ON apply_loan_histories.id=loan_emi_details.loanId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory  WHERE loan_emi_details.status='pending' AND DATE(loan_emi_details.emiDate) BETWEEN '$startDate' AND '$endDate' $SUBQRY ORDER BY loan_emi_details.emiDate,users.customerCode DESC");
    
            }
            

            if (count($results)) {
                foreach ($results as $k=>$row) {
                    $sdate = date('Y-m-d', strtotime($row->t_date));
    
                    $datetime1 = new DateTime($sdate);
                    $datetime2 = new DateTime($endDate);
                    $interval = $datetime1->diff($datetime2);
                    $totalDays = $interval->days;
    
                    $tdataInterst = ($row->netemiAmount - $row->emiAmount);
                    if($loanType == '3'){
                        $tdataInterst =  ($row->interestAmountPayble);
                    }
    
                    $content .= ($k + 1) . ',' . $row->customerCode . ',' . $row->name . ',' .  'LF0' . $row->id . ','  .  $row->cname. ','  .  $sdate. ','  .  $endDate . ',' . $row->rateOfInterest . ',' . $totalDays . ',' . $row->netemiAmount. ',' . $tdataInterst . "\r\n";
                    
                }
            }

        } else {
            return redirect()->back();
        }


        return response($content)->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename=' . $fileName . '.csv')
            ->header('Pragma', 'no-cache')
            ->header("Expires", '0');
    }
}
