<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplyLoanHistory;
use App\Models\User;
use App\Models\Bank;
use App\Models\RawMaterialsTxnDetail;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReportController extends Controller
{

    public function todayDisbursement()
    {
        $currentDate = date('Y-m-d');
        $pageTitle = 'Today Disbursement';
        $pageNameStr = 'today-disbursement';

        return view('pages.loan-management.to-be-disburse', compact('pageTitle', 'pageNameStr'));
    }

    public function todayRawDisbursement()
    {
        $currentDate = date('Y-m-d');
        $pageTitle = 'Today / Pending Raw Disbursement';
        $pageNameStr = 'today-raw-disbursement';

        return view('pages.loan-management.to-be-disburse', compact('pageTitle', 'pageNameStr'));
    }

    public function pendingDisbursement()
    {
        $currentDate = date('Y-m-d');
        $pageTitle = 'Pending Disbursement';
        $pageNameStr = 'pending-disbursement';

        return view('pages.loan-management.to-be-disburse', compact('pageTitle', 'pageNameStr'));
    }

    public function disbursedLoanList()
    {
        $currentDate = date('Y-m-d');
        $pageTitle = 'Loan Disbursed';
        $pageNameStr = 'loan-disbursed';

        return view('pages.loan-management.to-be-disburse', compact('pageTitle', 'pageNameStr'));
    }

    public function customerEmis()
    {
        $currentDate = date('Y-m-d');
        $pageTitle = 'Customer Emi';
        $pageNameStr = 'customer-emi';

        $month = date('m');
        $year = date('Y');
        $SUBQRY = " AND MONTH(ed.emiDate)='$month' AND YEAR(ed.emiDate)='$year'";

        $banks = Bank::where(['status' => 1])->orderBy('name', 'asc')->get();

        return view('pages.loan-management.to-be-disburse', compact('pageTitle', 'pageNameStr'));
    }

    //TODO Recived EMI page link
    public function receivedEmis()
    {
        $currentDate = date('Y-m-d');
        $pageTitle = 'Today\'s Received Emi';
        $pageNameStr = 'received-emi';


        return view('pages.loan-management.to-be-disburse', compact('pageTitle', 'pageNameStr'));
    }

    public function todaysEmis()
    {
        $currentDate = date('Y-m-d');
        $pageTitle = 'Today\'s Pending Emi';
        $pageNameStr = 'today-emi';

        return view('pages.loan-management.to-be-disburse', compact('pageTitle', 'pageNameStr'));
    }

    public function overDueEmis()
    {
        $currentDate = date('Y-m-d');
        $pageTitle = 'Over Due Emi';
        $pageNameStr = 'over-due-emi';

        return view('pages.loan-management.to-be-disburse', compact('pageTitle', 'pageNameStr'));
    }

    public function closedLoans()
    {
        $currentDate = date('Y-m-d');
        $pageTitle = 'Closed Loans';
        $pageNameStr = 'closed-loans';

        return view('pages.loan-management.to-be-disburse', compact('pageTitle', 'pageNameStr'));
    }

    public function nocCustomers()
    {
        $currentDate = date('Y-m-d');
        $pageTitle = 'NOC Customers';
        $pageNameStr = 'noc-issued';

        return view('pages.loan-management.to-be-disburse', compact('pageTitle', 'pageNameStr'));
    }


    public function rawPendingFileReports(){
        return view('pages.reports.raw-pending-file');
    }

    public function filterRawPendingFileReport(Request $request){
        try{
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
            }else{
                $fromDate = Carbon::now()->subDays(7)->startOfDay();
                $toDate = Carbon::now()->endOfDay();
                $SUBQRY .= " AND date(u.created_at)>='$fromDate' AND date(u.created_at)<='$toDate'";
            }
    
            $customers = DB::select("SELECT DISTINCT u.*,c.name as loanCategoryD,alh.id as loanId,alh.isAdminApproved,alh.reject_reason,eh.id as employmentHistoryId,alh.status as loanStatus,eh.status as employmentStatus FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN employment_histories eh ON u.id=eh.userId LEFT JOIN categories c ON alh.loanCategory=c.id WHERE u.userType='user' $SUBQRY ORDER BY u.id desc");
            $totalCust = count($customers??[])??0;
    
            $TBLLTHCLS = 'whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
            $htmlStr = '<table class="is-hoverable w-full text-left dataTable no-footer overflow-x-auto">
                <thead>
                      <tr>
                            <th class="' . $TBLLTHCLS . '">Profile</th>
                            <th class="' . $TBLLTHCLS . '">Cust. ID</th>
                            <th class="' . $TBLLTHCLS . '">Name</th>
                            <th class="' . $TBLLTHCLS . '">Email</th>
                            <th class="' . $TBLLTHCLS . '">Mobile No.</th>';
           
                $htmlStr .= '<th class="' . $TBLLTHCLS . '">Loan Type</th>';
            
            $htmlStr .= '<th class="' . $TBLLTHCLS . '">Date</th>';
            
                $htmlStr .= '<th class="' . $TBLLTHCLS . '">KYC Status</th>';
                $htmlStr .= '<th class="' . $TBLLTHCLS . '">Business Status</th>';
            
            $htmlStr .= '<th class="' . $TBLLTHCLS . '">Admin Approve</th>';
            $htmlStr .= '<th class="' . $TBLLTHCLS . '">Status</th>
                            <th class="' . $TBLLTHCLS . '">Action</th>
                      </tr>
                </thead>
                <tbody>';
            if (count($customers)) {
                foreach ($customers as $crow) {
    
                    if($crow->isAdminApproved == 'approved'){
                        $isadminApprove = '<span class="badge bg-success">Approved</span>';
                    }else if($crow->isAdminApproved == 'rejected'){
                        $isadminApprove = '<span data-bs-toggle="tooltip" data-bs-placement="top" onclick="alert(\'Rejected Reason : '.$crow->reject_reason.'\')" class="badge bg-danger">Rejected</span>';
                    }else if($crow->isAdminApproved == 'need update'){
                        $isadminApprove = '<span data-bs-toggle="tooltip" data-bs-placement="top" onclick="alert(\'Need Update : '.$crow->reject_reason.'\')" class="badge bg-warning">Need Update</span>';
                    }else{
                        $isadminApprove = '<span class="badge bg-info">Pending</span>';
                    }
    
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
                                    <td>' . $crow->loanCategoryD . '</td>
                                    <td>' . $createdDate . '</td>';
                    
                        if ($crow->kycStatus == 'approved') {
                            $htmlStr .= '<td><span class="badge badge-success-light">Approved</span></td>';
                        } else if ($crow->kycStatus == 'rejected') {
                            $htmlStr .= '<td><span style="background-color: #f44;" class="badge badge-danger-light">Rejected</span></td>';
                        } else {
                            $htmlStr .= '<td><span class="badge badge-warning-light">Pending</span></td>';
                        }
                    
                    
                        if ($crow->employmentStatus == 'approved') {
                            $htmlStr .= '<td><span class="badge badge-success-light">Approved</span></td>';
                        } else if ($crow->employmentStatus == 'rejected') {
                            $htmlStr .= '<td><span style="background-color: #f44;" class="badge badge-danger-light">Rejected</span></td>';
                        } else {
                            $htmlStr .= '<td><span class="badge badge-warning-light">Pending</span></td>';
                        }
                    
    
                        $htmlStr .= '<td>'.$isadminApprove.'</td>';
                    
                    $htmlStr .= '<td>';
    
    
                    if ($crow->status == 1) {
                        $htmlStr .= '<span class="badge badge-success-light">Active</span>';
                    } else if ($crow->status == 2) {
                        $htmlStr .= '<span class="badge badge-danger">Rejected</span>';
                    } else {
                        $htmlStr .= '<span class="badge badge-danger">Deactive</span>';
                    }
    
                    $buttons = '<a href="' . route('profileDetails', ['all-customers-list', $crow->id]) . '" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"><i data-feather="eye" class="fa fa-eye text-primary"></i></a>';
                    $buttons .= '<button type="button" onclick="editCustomerProfile(' . $crow->id . ');" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                        <i class="fa fa-edit"></i>
                    </button>';
                    $buttons .= '<button type="button" onclick="editCustomerBusiness(' . $crow->id . ');" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                        <i class="fa fa-bank"> </i>
                    </button>';
    
                    if ('all-customers-list' == 'kyc-verified-customers' || 'all-customers-list' == 'disbursement-pending-list' || 'all-customers-list' == 'disbursement-rejected-list') {
                        $buttons .= '<button onclick="return initiateApplyLoan(' . $crow->id . ');" class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                            <i class="fa fa-inr"></i>
                        </button>';
                    }
                    $htmlStr .= '</td>
                                    <td>
                                        <div class="d-flex">
                                        <span id="totalCust" hidden>'.$totalCust.'</span>
                                            ' . $buttons . '
                                        </div>
                                    </td>
                                </tr>';
                }
            }
            $htmlStr .= '</tbody>
              </table>';
            echo $htmlStr;
        } catch (\Exception $e) {
    
            return $e->getMessage();
        }
    }


    public function newCustomReports(){
        $fromDate = Carbon::now()->subDays(7)->startOfDay();
        $toDate = Carbon::now()->endOfDay();
        return view('pages.reports.daily-customer',compact('fromDate','toDate'));
    }


    public function filterNewCustomerReport(Request $request){
        try{
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
            }else{
                $fromDate = Carbon::now()->subDays(7)->startOfDay();
                $toDate = Carbon::now()->endOfDay();
                $SUBQRY .= " AND date(u.created_at)>='$fromDate' AND date(u.created_at)<='$toDate'";
            }
    
            $customers = DB::select("SELECT DISTINCT u.*,c.name as loanCategoryD,alh.id as loanId,alh.isAdminApproved,alh.reject_reason,eh.id as employmentHistoryId,alh.status as loanStatus,eh.status as employmentStatus FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN employment_histories eh ON u.id=eh.userId LEFT JOIN categories c ON alh.loanCategory=c.id WHERE u.userType='user' $SUBQRY ORDER BY u.id desc");
            $totalCust = count($customers??[])??0;
    
            $TBLLTHCLS = 'whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
            $htmlStr = '<table class="is-hoverable w-full text-left dataTable no-footer overflow-x-auto">
                <thead>
                      <tr>
                            <th class="' . $TBLLTHCLS . '">Profile</th>
                            <th class="' . $TBLLTHCLS . '">Cust. ID</th>
                            <th class="' . $TBLLTHCLS . '">Name</th>
                            <th class="' . $TBLLTHCLS . '">Email</th>
                            <th class="' . $TBLLTHCLS . '">Mobile No.</th>';
           
                $htmlStr .= '<th class="' . $TBLLTHCLS . '">Loan Type</th>';
            
            $htmlStr .= '<th class="' . $TBLLTHCLS . '">Date</th>';
            
                $htmlStr .= '<th class="' . $TBLLTHCLS . '">KYC Status</th>';
                $htmlStr .= '<th class="' . $TBLLTHCLS . '">Business Status</th>';
            
            $htmlStr .= '<th class="' . $TBLLTHCLS . '">Admin Approve</th>';
            $htmlStr .= '<th class="' . $TBLLTHCLS . '">Status</th>
                            <th class="' . $TBLLTHCLS . '">Action</th>
                      </tr>
                </thead>
                <tbody>';
            if (count($customers)) {
                foreach ($customers as $crow) {
    
                    if($crow->isAdminApproved == 'approved'){
                        $isadminApprove = '<span class="badge bg-success">Approved</span>';
                    }else if($crow->isAdminApproved == 'rejected'){
                        $isadminApprove = '<span data-bs-toggle="tooltip" data-bs-placement="top" onclick="alert(\'Rejected Reason : '.$crow->reject_reason.'\')" class="badge bg-danger">Rejected</span>';
                    }else if($crow->isAdminApproved == 'need update'){
                        $isadminApprove = '<span data-bs-toggle="tooltip" data-bs-placement="top" onclick="alert(\'Need Update : '.$crow->reject_reason.'\')" class="badge bg-warning">Need Update</span>';
                    }else{
                        $isadminApprove = '<span class="badge bg-info">Pending</span>';
                    }
    
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
                                    <td>' . $crow->loanCategoryD . '</td>
                                    <td>' . $createdDate . '</td>';
                    
                        if ($crow->kycStatus == 'approved') {
                            $htmlStr .= '<td><span class="badge badge-success-light">Approved</span></td>';
                        } else if ($crow->kycStatus == 'rejected') {
                            $htmlStr .= '<td><span style="background-color: #f44;" class="badge badge-danger-light">Rejected</span></td>';
                        } else {
                            $htmlStr .= '<td><span class="badge badge-warning-light">Pending</span></td>';
                        }
                    
                    
                        if ($crow->employmentStatus == 'approved') {
                            $htmlStr .= '<td><span class="badge badge-success-light">Approved</span></td>';
                        } else if ($crow->employmentStatus == 'rejected') {
                            $htmlStr .= '<td><span style="background-color: #f44;" class="badge badge-danger-light">Rejected</span></td>';
                        } else {
                            $htmlStr .= '<td><span class="badge badge-warning-light">Pending</span></td>';
                        }
                    
    
                        $htmlStr .= '<td>'.$isadminApprove.'</td>';
                    
                    $htmlStr .= '<td>';
    
    
                    if ($crow->status == 1) {
                        $htmlStr .= '<span class="badge badge-success-light">Active</span>';
                    } else if ($crow->status == 2) {
                        $htmlStr .= '<span class="badge badge-danger">Rejected</span>';
                    } else {
                        $htmlStr .= '<span class="badge badge-danger">Deactive</span>';
                    }
    
                    $buttons = '<a href="' . route('profileDetails', ['all-customers-list', $crow->id]) . '" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"><i data-feather="eye" class="fa fa-eye text-primary"></i></a>';
                    $buttons .= '<button type="button" onclick="editCustomerProfile(' . $crow->id . ');" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                        <i class="fa fa-edit"></i>
                    </button>';
                    $buttons .= '<button type="button" onclick="editCustomerBusiness(' . $crow->id . ');" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                        <i class="fa fa-bank"> </i>
                    </button>';
    
                    if ('all-customers-list' == 'kyc-verified-customers' || 'all-customers-list' == 'disbursement-pending-list' || 'all-customers-list' == 'disbursement-rejected-list') {
                        $buttons .= '<button onclick="return initiateApplyLoan(' . $crow->id . ');" class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                            <i class="fa fa-inr"></i>
                        </button>';
                    }
                    $htmlStr .= '</td>
                                    <td>
                                        <div class="d-flex">
                                        <span id="totalCust" hidden>'.$totalCust.'</span>
                                            ' . $buttons . '
                                        </div>
                                    </td>
                                </tr>';
                }
            }
            $htmlStr .= '</tbody>
              </table>';
            echo $htmlStr;
        } catch (\Exception $e) {
    
            return $e->getMessage();
        }
    }

    public function sanctionCustomers($id)
    {
        $app_data = $id;
        return view('pages.app-management.sanction-letter', compact('app_data'));
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

        return view('pages.reports.aum-report-list', compact('pageTitle', 'pageNameStr', 'allOutstandingAmount', 'totalApprovedAmount'));
    }

    public function filterAumReports(Request $request)
    {

        if (!$request->fromDate || $request->fromDate == "") {
            $request->merge(['fromDate' => '2020-01-01']);
        }
        if (!$request->toDate || $request->toDate == "") {
            $request->merge(['toDate' => date('Y-m-d')]);
        }
        // dd($request->loanreportFilter);
        // $casesPF_extradays = "CASE WHEN apply_loan_histories.exclude_pfif=1 AND apply_loan_histories.include_extradays=0 THEN (apply_loan_histories.netDisbursementAmount - apply_loan_histories.principleCharges) WHEN apply_loan_histories.exclude_pfif=0 AND apply_loan_histories.include_extradays=1 THEN (apply_loan_histories.netDisbursementAmount - apply_loan_histories.extraIntrestAmount) ELSE apply_loan_histories.";
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

                $querys .= "IFNULL((SELECT IFNULL(extraIntrestAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (alh.status='disbursed' OR alh.status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as extraIntrestAmount,IFNULL((SELECT IFNULL(principleCharges,0) FROM apply_loan_histories WHERE id=alh.id AND (alh.status='disbursed' OR alh.status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as principleCharges,alh.principleChargesDetails,IFNULL((SELECT IFNULL(disbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as paidDisbursementAmount,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND  $subQueryCondi) as principleDeposited,(SELECT  IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as interestPaid,IFNULL((SELECT IFNULL(netDisbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";

                if (isset($loanIds) && !empty($loanIds)) {
                    $strLoanIds  = implode(',', $loanIds);
                    $querys .= " AND alh.id IN ($strLoanIds)";
                }
            } else {
                $querys .= "alh.extraIntrestAmount,alh.principleCharges,alh.principleChargesDetails,alh.netDisbursementAmount,alh.disbursementAmount AS paidDisbursementAmount,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success') as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' ) as interestPaid,(alh.netDisbursementAmount - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";
            }

            $querys .= " AND alh.loanCategory=1  AND (alh.status='disbursed' OR alh.status='closed') ORDER BY alh.id DESC";

            //   echo $querys;

            $results = DB::select($querys);
        }
        if ($request->loanreportFilter == 2 || $request->loanreportFilter == "none") {
            if ($request->fromDate && $request->toDate) {
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate BETWEEN '$request->fromDate' AND '$request->toDate') OR (apply_loan_histories.disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate')");
                $allloans = array_unique(array_column($allloan, 'a_loanId'));

                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId, 'loanId'));

                $loanIds = array_merge($allloans, $allloanEmiIds);
            } elseif ($request->fromDate) {
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate >= '$request->fromDate') OR (apply_loan_histories.disbursedDate >= '$request->fromDate')");
                $allloans = array_unique(array_column($allloan, 'a_loanId'));

                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId, 'loanId'));

                $loanIds = array_merge($allloans, $allloanEmiIds);
            } elseif ($request->toDate) {
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate <= '$request->toDate') OR (apply_loan_histories.disbursedDate <= '$request->toDate')");
                $allloans = array_unique(array_column($allloan, 'a_loanId'));

                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
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
                } elseif ($request->toDate) {
                    $subQueryCondi = "(CASE WHEN `transactionDate` IS NULL THEN (emiDate <= '$request->toDate') ELSE (transactionDate <= '$request->toDate') END)";
                }

                $querys .= "IFNULL((SELECT IFNULL(extraIntrestAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (alh.status='disbursed' OR alh.status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as extraIntrestAmount,IFNULL((SELECT IFNULL(principleCharges,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as principleCharges,alh.principleChargesDetails,IFNULL((SELECT IFNULL(disbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as paidDisbursementAmount,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as interestPaid,(IFNULL((SELECT IFNULL(netDisbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi)) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";
                if (isset($loanIds) && !empty($loanIds)) {
                    $strLoanIds  = implode(',', $loanIds);
                    $querys .= " AND alh.id IN ($strLoanIds)";
                }
            } else {
                $querys .= "alh.extraIntrestAmount,alh.netDisbursementAmount,alh.disbursementAmount AS paidDisbursementAmount,alh.principleCharges,alh.principleChargesDetails,(SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success') as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' ) as interestPaid,(alh.netDisbursementAmount - (SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE loanId=alh.id AND status='success')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1 ";
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
                    $results[$nowcount]->principleChargesDetails = $rsdata->principleChargesDetails??null;
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

            if ($request->fromDate && $request->toDate) {
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN raw_materials_txn_details ON raw_materials_txn_details.loanId=apply_loan_histories.id  WHERE (raw_materials_txn_details.transactionDate BETWEEN '$request->fromDate' AND '$request->toDate' OR raw_materials_txn_details.id IS NULL) AND apply_loan_histories.loanCategory=3  AND apply_loan_histories.status='customer-approved'");
                $loanIds = array_unique(array_column($allloan, 'a_loanId'));
            } elseif ($request->fromDate) {
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN raw_materials_txn_details ON raw_materials_txn_details.loanId=apply_loan_histories.id  WHERE (raw_materials_txn_details.transactionDate >= '$request->fromDate' OR raw_materials_txn_details.id IS NULL) AND apply_loan_histories.loanCategory=3  AND apply_loan_histories.status='customer-approved'");
                $loanIds = array_unique(array_column($allloan, 'a_loanId'));
            } elseif ($request->toDate) {
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN raw_materials_txn_details ON raw_materials_txn_details.loanId=apply_loan_histories.id  WHERE (raw_materials_txn_details.transactionDate <= '$request->toDate' OR raw_materials_txn_details.id IS NULL) AND apply_loan_histories.loanCategory=3  AND apply_loan_histories.status='customer-approved'");
                $loanIds = array_unique(array_column($allloan, 'a_loanId'));
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

            if ($request->fromDate && $request->toDate) {
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate BETWEEN '$request->fromDate' AND '$request->toDate') OR (apply_loan_histories.disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate')");
                $allloans = array_unique(array_column($allloan, 'a_loanId'));

                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId, 'loanId'));

                $loanIds = array_merge($allloans, $allloanEmiIds);
            } elseif ($request->fromDate) {
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate >= '$request->fromDate')  OR (apply_loan_histories.disbursedDate >= '$request->fromDate')");
                $allloans = array_unique(array_column($allloan, 'a_loanId'));

                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId, 'loanId'));

                $loanIds = array_merge($allloans, $allloanEmiIds);
            } elseif ($request->toDate) {
                $allloan = DB::select("SELECT apply_loan_histories.id as a_loanId FROM apply_loan_histories LEFT JOIN loan_emi_details ON loan_emi_details.loanId=apply_loan_histories.id  WHERE (loan_emi_details.emiDate <= '$request->toDate')  OR (apply_loan_histories.disbursedDate <= '$request->toDate')");
                $allloans = array_unique(array_column($allloan, 'a_loanId'));

                $allloanEmiId = DB::select("SELECT loanId FROM loan_emi_details WHERE status='success' AND (CASE WHEN `transactionDate` IS NULL THEN (emiDate BETWEEN '$request->fromDate' AND '$request->toDate') ELSE (transactionDate BETWEEN '$request->fromDate' AND '$request->toDate') END)");
                $allloanEmiIds = array_unique(array_column($allloanEmiId, 'loanId'));

                $loanIds = array_merge($allloans, $allloanEmiIds);
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
                $querys .= "IFNULL((SELECT IFNULL(principleCharges,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as principleCharges,alh.principleChargesDetails,IFNULL((SELECT IFNULL(disbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0) as paidDisbursementAmount,(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE type='credit' AND loanId=alh.id AND txnDate BETWEEN '$request->fromDate' AND '$request->toDate') as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success' AND $subQueryCondi) as interestPaid,(IFNULL((SELECT IFNULL(netDisbursementAmount,0) FROM apply_loan_histories WHERE id=alh.id AND (status='disbursed' OR status='closed') AND disbursedDate BETWEEN '$request->fromDate' AND '$request->toDate'),0)-(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId=alh.id AND type='credit')) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1";
                if (isset($loanIds) && !empty($loanIds)) {
                    $strLoanIds  = implode(',', $loanIds);
                    $querys .= " AND alh.id IN ($strLoanIds)";
                }
            } else {
                $querys .= "alh.netDisbursementAmount,alh.disbursementAmount AS paidDisbursementAmount,alh.principleCharges,alh.principleChargesDetails,(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE type='credit' AND loanId=alh.id) as principleDeposited,(SELECT IF(tdsAmount>0, IFNULL(SUM(netInterest),0), IFNULL(SUM(interest),0)) FROM loan_emi_details WHERE loanId=alh.id AND status='success') as interestPaid,(alh.netDisbursementAmount - (SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE type='credit' AND loanId=alh.id)) as totalOutStanding FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id WHERE 1";
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
                    $results[$nowcount]->principleChargesDetails = $rsdata->principleChargesDetails??null;
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

                $principleChargesDetails = isset($row->principleChargesDetails) ? json_decode($row->principleChargesDetails,true) : null;
                $insurace = $principleChargesDetails ? $principleChargesDetails['insurance'] : 0;

                $principleDeposited = $row->principleDeposited != '' ? $row->principleDeposited : 0;
                $interestPaid = $row->interestPaid != '' ? $row->interestPaid : 0;
                $totalOutStanding = $row->totalOutStanding != '' ? $row->totalOutStanding :  $row->netDisbursementAmount;
                $DisbursementAmount = $row->paidDisbursementAmount ? $row->paidDisbursementAmount : number_format(0.00, 2);
                $principleCharges = ($row->principleCharges && $row->principleCharges !=0) ? $row->principleCharges-$insurace : 0;

                $htmlStr .= '<tr>';
                $htmlStr .= '<td>' . $rsr . '</td>';
                $htmlStr .= '<td>' . $row->customerCode . '</td>';
                $htmlStr .= '<td>' . ($row->disbursedDate ?? '--') . '</td>';
                $htmlStr .= '<td>' . $row->name . '</td>';
                $htmlStr .= '<td>LF0' . $row->id . '</td>';
                $htmlStr .= '<td>' . $row->loanName . '</td>';
                $htmlStr .= '<td>' . number_format($row->approvedAmount, 2) . '</td>';
                $htmlStr .= '<td>' . number_format($principleCharges, 2) . '</td>';
                $htmlStr .= '<td>' . number_format($row->extraIntrestAmount, 2) . '</td>';
                $htmlStr .= '<td>' . number_format($DisbursementAmount, 2) . '</td>';
                $htmlStr .= '<td>' . number_format($principleDeposited, 2) . '</td>';
                $htmlStr .= '<td>' . number_format($interestPaid, 2) . '</td>';
                $htmlStr .= '<td>' . number_format($totalOutStanding, 2) . '</td>';
                $htmlStr .= '</tr>';
                $rsr++;

                $totalLoanAmount += $row->approvedAmount;
                $totalProcessingFee += $principleCharges;
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
            <td id="totalLoanAmount">' . number_format($totalLoanAmount, 2) . '</td>
            <td id="totalProcessingFee">' . number_format($totalProcessingFee, 2) . '</td>
            <td id="totalExtraDaysIn">' . number_format($totalExtraDaysIn, 2) . '</td>
            <td id="totalDisbursedAmount">' . number_format($totalDisbursedAmount, 2) . '</td>
            <td id="totalPrincipalDeposited">' . number_format($totalPrincipalDeposited, 2) . '</td>
            <td id="totalInterestGross">' . number_format($totalInterestGross, 2) . '</td>
            <td id="totalOutStandingBalance">' . number_format($totalOutStandingBalance, 2) . '</td>
            </tr>
            </tfoot>';
        }
        $htmlStr .= '</table>';
        return $htmlStr;
    }


    public function paymentReports()
    {
        return view('pages.reports.payment-report');
    }

    public function filterPaymentReports(Request $request)
    {
        if (!$request->fromDate || $request->fromDate == "") {
            $request->merge(['fromDate' => '2019-01-01']);
        }
        if (!$request->toDate || $request->toDate == "") {
            $request->merge(['toDate' => date('Y-m-d')]);
        }
        $payType = $request->payTypereportFilter ?? '0';

        $totalEmiReceable1 = DB::select("SELECT SUM(loan_emi_details.netemiAmount) AS totalAmount FROM loan_emi_details LEFT JOIN users ON users.id=loan_emi_details.userId  LEFT JOIN apply_loan_histories ON apply_loan_histories.id=loan_emi_details.loanId  WHERE loan_emi_details.status='success'")[0]->totalAmount;
        $totalEmiReceable2 = DB::select("SELECT SUM(raw_materials_txn_details.amount+raw_materials_txn_details.interestAmountPayble) AS totalAmount FROM raw_materials_txn_details LEFT JOIN apply_loan_histories ON raw_materials_txn_details.loanId=apply_loan_histories.id LEFT JOIN users ON users.id=raw_materials_txn_details.userId  WHERE raw_materials_txn_details.status='success' AND raw_materials_txn_details.txnType='in'")[0]->totalAmount;
        $totalEmiReceable = $totalEmiReceable1 + $totalEmiReceable2;

        $totalDisbursed1 = DB::select("SELECT SUM(disbursementAmount) AS totalAmount FROM apply_loan_histories  WHERE apply_loan_histories.status IN ('closed','disbursed') AND apply_loan_histories.loanCategory!=3")[0]->totalAmount;
        $totalDisbursed2 = DB::select("SELECT SUM(raw_materials_txn_details.amount) AS totalAmount FROM raw_materials_txn_details LEFT JOIN apply_loan_histories ON raw_materials_txn_details.loanId=apply_loan_histories.id LEFT JOIN users ON users.id=raw_materials_txn_details.userId  WHERE raw_materials_txn_details.status='success' AND raw_materials_txn_details.txnType='out'")[0]->totalAmount;
        $totalDisbursed = $totalDisbursed1 + $totalDisbursed2;

        if ($payType == '0') { // Reciable
            $tname = 'Transaction';
            $results1 = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,users.customerCode,users.name,users.mobile,users.email,categories.name AS cname,loan_emi_details.emiId,loan_emi_details.transactionDate AS t_date,loan_emi_details.netemiAmount AS t_amount FROM loan_emi_details LEFT JOIN users ON users.id=loan_emi_details.userId  LEFT JOIN apply_loan_histories ON apply_loan_histories.id=loan_emi_details.loanId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory   WHERE loan_emi_details.status='success' AND loan_emi_details.transactionDate BETWEEN '$request->fromDate' AND '$request->toDate' ORDER BY loan_emi_details.transactionDate DESC");
            $results2 = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,users.customerCode,users.name,users.mobile,users.email,categories.name AS cname,raw_materials_txn_details.amount AS t_amount,raw_materials_txn_details.interestAmountPayble,raw_materials_txn_details.transactionDate AS t_date FROM raw_materials_txn_details LEFT JOIN apply_loan_histories ON raw_materials_txn_details.loanId=apply_loan_histories.id LEFT JOIN users ON users.id=raw_materials_txn_details.userId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory   WHERE raw_materials_txn_details.status='success' AND raw_materials_txn_details.txnType='in' AND raw_materials_txn_details.transactionDate BETWEEN '$request->fromDate' AND '$request->toDate'");
            // return $allloanEmiId;
        } else { // disbursed
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
        if ($payType == '0') {
            $htmlStr .=   '<th>EMI ID</th>';
        }

        $htmlStr .=   '<th>Loan Type</th>
                      <th>Loan Amount</th>
                      <th>' . $tname . ' Date</th>
                      <th>' . $tname . ' Amount</th>
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
                if ($payType == '0') {
                    $htmlStr .= '<td>' . ($row->emiId ?? '-') . '</td>';
                }
                $htmlStr .= '<td>' . $row->cname . '</td>';
                $htmlStr .= '<td>' . number_format($row->approvedAmount, 2) . '</td>';
                $htmlStr .= '<td>' . date('Y-m-d', strtotime($row->t_date)) . '</td>';
                if (isset($row->interestAmountPayble) && $row->interestAmountPayble) {
                    $totalAmount += ($row->t_amount + $row->interestAmountPayble);
                    $htmlStr .= '<td>' . number_format($row->t_amount + $row->interestAmountPayble, 2) . '</td>';
                } else {
                    $totalAmount += $row->t_amount;
                    $htmlStr .= '<td>' . number_format($row->t_amount, 2) . '</td>';
                }

                $htmlStr .= '</tr>';
                $rsr++;
            }
            $htmlStr .= '</tbody>
            <tfoot>
            <tr>
            <td colspan="7">Total : </td>';
            if ($payType == '0') {
                $htmlStr .= '<td colspan="2">' . number_format($totalAmount, 2) . '</td>';
            } else {
                $htmlStr .= '<td colspan="1">' . number_format($totalAmount, 2) . '</td>';
            }
            $htmlStr .= '</tr>
            </tfoot>';
        }
        $htmlStr .= '</table>';
        return ['html' => $htmlStr, 'totalDisbursed' => number_format($totalDisbursed, 2), 'totalEmiReceable' => number_format($totalEmiReceable, 2)];
    }


    public function nextMonthEmiReports()
    {
        return view('pages.reports.next-month-emi');
    }

    public function filternextMonthEmiReports(Request $request)
    {

        $loanType = $request->loanTypereportFilter;
        
        if ($request->selected_month) {
            $nextMonth = date('m', strtotime($request->selected_month));
            $thisYear = date('Y', strtotime($request->selected_month));
        } else {
            $nextMonth = date('m', strtotime('+1 month'));
            $thisYear = date('Y');
        }

        $SUBQRY = '';
        if ($loanType && $loanType != '0') {
            $SUBQRY = ' AND apply_loan_histories.loanCategory=' . $loanType;
        }

        $results = DB::select("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,categories.name AS cname,users.customerCode,users.name,users.mobile,users.email,loan_emi_details.emiId,loan_emi_details.emiDate AS t_date,loan_emi_details.netemiAmount AS t_amount FROM loan_emi_details LEFT JOIN users ON users.id=loan_emi_details.userId  LEFT JOIN apply_loan_histories ON apply_loan_histories.id=loan_emi_details.loanId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory  WHERE loan_emi_details.status='pending' AND MONTH(loan_emi_details.emiDate)='$nextMonth' AND YEAR(loan_emi_details.emiDate)='$thisYear' $SUBQRY ORDER BY loan_emi_details.emiDate DESC");

        // dd("SELECT apply_loan_histories.id,apply_loan_histories.loanCategory,apply_loan_histories.approvedAmount,categories.name AS cname,users.customerCode,users.name,users.mobile,users.email,loan_emi_details.emiId,loan_emi_details.emiDate AS t_date,loan_emi_details.netemiAmount AS t_amount FROM loan_emi_details LEFT JOIN users ON users.id=loan_emi_details.userId  LEFT JOIN apply_loan_histories ON apply_loan_histories.id=loan_emi_details.loanId LEFT JOIN categories ON categories.id=apply_loan_histories.loanCategory  WHERE loan_emi_details.status='pending' AND MONTH(loan_emi_details.emiDate)='$nextMonth' AND YEAR(loan_emi_details.emiDate)='$thisYear' $SUBQRY ORDER BY loan_emi_details.emiDate DESC");

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

                $tamount = $row->t_amount;
                if (isset($row->interestAmountPayble) && $row->interestAmountPayble) {
                    $tamount = $row->t_amount + $row->interestAmountPayble;
                }


                $htmlStr .= '<tr>';
                $htmlStr .= '<td>' . $rsr . '</td>';
                $htmlStr .= '<td>' . $row->customerCode . '</td>';
                $htmlStr .= '<td>' . $row->name . '</td>';
                $htmlStr .= '<td>LF0' . $row->id . '</td>
                <td>' . ($row->emiId ?? '-') . '</td>
                <td>' . $row->cname . '</td>';
                $htmlStr .= '<td>' . number_format($row->approvedAmount, 2) . '</td>';
                $htmlStr .= '<td>' . date('Y-m-d', strtotime($row->t_date)) . '</td>';
                if (isset($row->interestAmountPayble) && $row->interestAmountPayble) {
                    if ($row->loanCategory == 8) {
                        $totalEMIAmount += ($row->t_amount + $row->interestAmountPayble + $row->lateCharges);
                    } else {
                        $totalEMIAmount += ($row->t_amount + $row->interestAmountPayble);
                    }
                    $totalEMIAmount += ($row->t_amount + $row->interestAmountPayble);
                    $htmlStr .= '<td>' . number_format($row->t_amount + $row->interestAmountPayble, 2) . '</td>';
                } else {
                    $totalEMIAmount += $row->t_amount;
                    $htmlStr .= '<td>' . number_format($row->t_amount, 2) . '</td>';
                }

                $htmlStr .= '</tr>';
                $rsr++;
            }
            $htmlStr .= '</tbody>
            <tfoot>
            <tr>
            <td colspan="7">Total : </td>
            <td colspan="2">' . number_format($totalEMIAmount, 2) . '</td>
            </tr>
            </tfoot>';
        }
        $htmlStr .= '</table>';
        return ['html' => $htmlStr, 'totalEMIAmount' => number_format($totalEMIAmount, 2)];
    }

    public function quaturlyData() {
    $output = array();
    $currentMonth = date("n"); // Current month as a number (1-12)
    $currentYear = date("Y"); // Current year

    // Define the quarter start months
    $quarterStartMonths = [1, 4, 7, 10];

    // Find the current quarter start month and index
    $currentQuarterIndex = null;
    foreach ($quarterStartMonths as $index => $month) {
        if ($currentMonth >= $month && $currentMonth < $month + 3) {
            $currentQuarterIndex = $index;
            break;
        }
    }

    // Exclude the current incomplete quarter
    if ($currentMonth % 3 != 0) {
        $currentQuarterIndex = ($currentQuarterIndex - 1 + 4) % 4;
    }

    // Generate the quarter date ranges in descending order
    $quarters = [];
    $year = $currentYear;
    for ($i = 0; $i < 4; $i++) {
        $quarterIndex = ($currentQuarterIndex - $i + 4) % 4;
        $startMonth = $quarterStartMonths[$quarterIndex];
        $endMonth = $quarterStartMonths[($quarterIndex + 1) % 4] - 1;
        if ($endMonth == 0) {
            $endMonth = 12;
        }
        $quarterYear = $year;
        if ($currentQuarterIndex - $i < 0) {
            $quarterYear--;
        }
        $startDate = date("F Y", mktime(0, 0, 0, $startMonth, 1, $quarterYear));
        $endDate = date("F Y", mktime(0, 0, 0, $endMonth, date("t", mktime(0, 0, 0, $endMonth, 1, $quarterYear)), $quarterYear));
        $quarters[] = $startDate . " - " . $endDate;
    }

    return $quarters;
}




    public function accrudWorkingReports()
    {
        $output = $this->quaturlyData();
        return view('pages.reports.accrud-working', compact('output'));
    }



    public function filterAccrudWorkingReports(Request $request)
    {

        if ($request->quarterlyFilter) {
            $rdata = explode('-', $request->quarterlyFilter);
            $startDate = date('Y-m-1', strtotime($rdata[0]));
            $endDate = date('Y-m-t', strtotime($rdata[1]));
            $mon1tartDate = date('Y-m-1', strtotime('-1 month', strtotime($rdata[0])));
        }

        $loanType = $request->loanTypereportFilter;


          $SUBQRY = '';
        if ($loanType && $loanType == '3') {
            $SUBQRY .= " AND date(rawl.openingDate) <= date('$endDate')";
            $results = DB::select("SELECT alh.id,alh.rateOfInterest,rawl.interestAmount,u.id as userId,u.customerCode,u.name,u.email,u.mobile,alh.id as loanId,alh.productId,eh.employerName,rawl.openingDate AS t_date,rawl.amount ,rawl.interestAmountPayble,rawl.interestStartDate,(SELECT SUM(CASE WHEN txnType = 'out' THEN amount ELSE 0 END) - SUM(CASE WHEN txnType = 'in' THEN amount ELSE 0 END) FROM raw_materials_txn_details WHERE loanId = alh.id AND openingDate = rawl.openingDate AND date(transactionDate) <= date('$endDate')) AS netemiAmount,categories.name AS cname,rawl.status,tenures.name AS tname FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId = u.id LEFT JOIN raw_materials_txn_details rawl ON alh.id = rawl.loanId LEFT JOIN tenures ON rawl.approvedTenure = tenures.id LEFT JOIN employment_histories AS eh ON eh.userId = u.id LEFT JOIN categories ON categories.id = alh.loanCategory WHERE u.id > 0 AND rawl.status = 'success' $SUBQRY AND rawl.txnType = 'out' GROUP BY u.id, alh.id, rawl.openingDate HAVING netemiAmount <> 0 ORDER BY u.id, rawl.openingDate DESC");
            
        } elseif ($loanType && $loanType == '8') {
        $results = DB::select("SELECT alh.id, alh.loanCategory, alh.approvedAmount, alh.rateOfInterest, led.emiId, CASE WHEN led.status = 'success' AND led.emiAmount != 0 AND led.transactionDate IS NOT NULL THEN CASE WHEN DATE(led.transactionDate) BETWEEN '$startDate' AND '$endDate' THEN led.emiDate ELSE led.emiDate END WHEN led.emiAmount = 0 AND led.emiSr = 0 THEN COALESCE(alh.disbursedDate, '$endDate') ELSE alh.disbursedDate END AS t_date, c.name AS cname, u.customerCode, u.name, u.mobile, u.email, CASE WHEN( SELECT COUNT(*) FROM loan_emi_details WHERE loanId = alh.id AND STATUS = 'pending' AND DATE(emiDate) <= '$endDate' ) > 0 THEN( SELECT balance - COALESCE(SUM(principle), 0) FROM loan_emi_details WHERE loanId = alh.id AND STATUS = 'pending' AND DATE(emiDate) <= '$endDate' ) ELSE( SELECT balance FROM loan_emi_details WHERE loanId = alh.id ORDER BY id DESC LIMIT 1 ) END AS netemiAmount FROM apply_loan_histories AS alh LEFT JOIN( SELECT led.* FROM loan_emi_details led INNER JOIN( SELECT loanId, MAX(id) AS max_id FROM loan_emi_details WHERE emiDate BETWEEN '$startDate' AND '$endDate' OR status='pending' GROUP BY loanId ) AS mled ON led.id = mled.max_id ) AS led ON led.loanId = alh.id LEFT JOIN users AS u ON u.id = alh.userId LEFT JOIN categories AS c ON c.id = alh.loanCategory WHERE alh.loanCategory = 8 AND( DATE(alh.disbursedDate) <= '$endDate' OR( led.id IS NOT NULL AND DATE(led.transactionDate) <= '$endDate' AND DATE(led.emiDate) <= '$endDate' AND( ( led.status = 'success' AND led.emiAmount != 0 AND led.transactionDate IS NOT NULL ) OR( alh.loanAmount - COALESCE( ( SELECT SUM(principle) FROM loan_emi_details WHERE loanId = alh.id AND DATE(emiDate) <= '$endDate' ), 0 ) > 0 ) ) ) ) HAVING netemiAmount > 0 AND emiId IS NOT NULL AND( t_date BETWEEN '$mon1tartDate' AND '$endDate' ) ORDER BY alh.id DESC");

           
        }elseif ($loanType) {
            $SUBQRY = ' AND alh.loanCategory=' . $loanType;
            $results = DB::select("SELECT alh.id, alh.loanCategory, alh.approvedAmount, alh.rateOfInterest, led.emiId, CASE WHEN led.status = 'success' AND led.emiAmount != 0 AND led.transactionDate IS NOT NULL THEN COALESCE( ( SELECT MAX(emiDate) FROM loan_emi_details WHERE loanId = alh.id AND status = 'success' AND emiAmount != 0 AND transactionDate IS NOT NULL AND DATE(emiDate) <= '$endDate'), DATE_FORMAT(DATE_ADD(alh.disbursedDate, INTERVAL 0 MONTH), '%Y-%m-05'), '$endDate' ) WHEN led.emiAmount = 0 AND led.emiSr = 0 THEN COALESCE( DATE_FORMAT(DATE_ADD(alh.disbursedDate, INTERVAL 1 MONTH), '%Y-%m-05'), '$endDate' ) ELSE led.emiDate END AS t_date, c.name AS cname, u.customerCode, u.name, u.mobile, u.email, CASE WHEN led.status = 'success' AND DATE(led.emiDate) <= '$endDate' AND led.emiAmount != 0 AND led.transactionDate IS NOT NULL THEN led.balance - COALESCE( ( SELECT SUM(principle) FROM loan_emi_details WHERE loanId = alh.id AND DATE(emiDate) <= '$endDate' ), 0 ) ELSE alh.loanAmount - COALESCE( ( SELECT SUM(principle) FROM loan_emi_details WHERE loanId = alh.id AND DATE(emiDate) <= '$endDate' ), 0 ) END AS netemiAmount FROM apply_loan_histories AS alh LEFT JOIN ( SELECT * FROM loan_emi_details WHERE id IN ( SELECT MAX(id) FROM loan_emi_details WHERE status = 'success' AND transactionDate IS NOT NULL GROUP BY loanId ) ) AS led ON led.loanId = alh.id LEFT JOIN users AS u ON u.id = alh.userId LEFT JOIN categories AS c ON c.id = alh.loanCategory WHERE alh.loanCategory = $loanType AND ( DATE(alh.disbursedDate) <= '$endDate' OR ( led.id IS NOT NULL AND DATE(led.transactionDate) <= '$endDate' AND DATE(led.emiDate) <= '$endDate' AND ( ( led.status = 'success' AND led.emiAmount != 0 AND led.transactionDate IS NOT NULL ) OR ( alh.loanAmount - COALESCE( ( SELECT SUM(principle) FROM loan_emi_details WHERE loanId = alh.id AND DATE(emiDate) <= '$endDate' ), 0 ) > 0 ) ) ) ) HAVING netemiAmount > 0 AND emiId IS NOT NULL  ORDER BY alh.id DESC");
        } else {
            $SUBQRY .= " AND date(rawl.openingDate) BETWEEN date('$startDate') AND date('$endDate')";
            $results = DB::select("SELECT alh.id,alh.rateOfInterest,rawl.interestAmount,u.id as userId,u.customerCode,u.name,u.email,u.mobile,alh.id as loanId,alh.productId,eh.employerName,rawl.openingDate AS t_date,rawl.amount ,rawl.interestAmountPayble,rawl.interestStartDate,(SELECT SUM(CASE WHEN txnType = 'out' THEN amount ELSE 0 END) - SUM(CASE WHEN txnType = 'in' THEN amount ELSE 0 END) FROM raw_materials_txn_details WHERE loanId = alh.id AND openingDate = rawl.openingDate AND date(transactionDate) BETWEEN date('$startDate') AND date('$endDate')) AS netemiAmount,categories.name AS cname,rawl.status,tenures.name AS tname FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId = u.id LEFT JOIN raw_materials_txn_details rawl ON alh.id = rawl.loanId LEFT JOIN tenures ON rawl.approvedTenure = tenures.id LEFT JOIN employment_histories AS eh ON eh.userId = u.id LEFT JOIN categories ON categories.id = alh.loanCategory WHERE u.id > 0 AND rawl.status = 'success' $SUBQRY AND rawl.txnType = 'out' GROUP BY u.id, alh.id, rawl.openingDate HAVING netemiAmount <> 0 ORDER BY u.id, rawl.openingDate DESC");
        }




        $rsr = 1;
        $totalAmount = 0;
        $totalINTERESTAmount = 0;


        $htmlStr = '<table id="mainTbl" class="table table-bordered">
                   <thead>
                   <tr>
                       <th>Sr. No.</th>
                       <th>Customer Code</th>
                       <th>Customer Name</th>
                       <th>Loan Id</th>
                       <th>Loan Type</th>
                       <th>Start Date</th>
                       <th>Closing Date</th>
                       <th>ROI %</th>
                       <th>No Of Days</th>
                       <th>O/S AMOUNT (Sum)</th>
                       <th>ACCRUD INTEREST (Sum)</th>
                   </tr>
                   </thead>';
        if (count($results)) {


            $htmlStr .= '<tbody>';
            foreach ($results as $row) {
                $sdate = date('Y-m-d', strtotime($row->t_date));

                $datetime1 = new DateTime($sdate);
                $datetime2 = new DateTime($endDate);
                $interval = $datetime1->diff($datetime2);
                $totalDays = $interval->days;

                $roiwidth = ($row->rateOfInterest / 100) * $row->netemiAmount;

                $interstCal = round(($roiwidth/365)*$totalDays,2);

                $htmlStr .= '<tr>';
                $htmlStr .= '<td>' . $rsr . '</td>';
                $htmlStr .= '<td>' . $row->customerCode . '</td>';
                $htmlStr .= '<td>' . $row->name . '</td>';
                $htmlStr .= '<td>LF0' . $row->id . '</td>
                 <td>' . $row->cname . '</td>
                 <td>' . ($sdate) . '</td>
                 <td>' . ($endDate) . '</td>
                 <td>' . ($row->rateOfInterest) . '</td>
                 <td>' . ($totalDays) . '</td>';
                $htmlStr .= '<td>' . number_format($row->netemiAmount, 2) . '</td>';
                $htmlStr .= '<td>' . ($interstCal) . '</td>';
                $totalINTERESTAmount += $interstCal;
                $totalAmount += $row->netemiAmount;



                $htmlStr .= '</tr>';
                $rsr++;
            }
            $htmlStr .= '</tbody>
             <tfoot>
             <tr>
             <td colspan="9">Total : </td>
             <td>' . number_format($totalAmount, 2) . '</td>
             <td>' . number_format($totalINTERESTAmount, 2) . '</td>
             </tr>
             </tfoot>';
        }
        $htmlStr .= '</table>';
        return ['html' => $htmlStr, 'totalEMIAmount' => number_format($totalAmount, 2), 'totalINTERESTAmount' => number_format($totalINTERESTAmount, 2)];
    }


    public function interestCalculator()
    {
        $allcustomers = User::select('id', 'customerCode', 'name', 'mobile', 'email')->with('pendingloans:id,userId,loanCategory,status')->has('pendingloans')->get()->map(function ($customer) {
            foreach ($customer->pendingloans as $loan) {
                if ($loan['loanCategory'] == 3) {
                    $loan['status'] = 'customer-approved';
                } 
                // else {
                //     $loan['status'] = 'disbursed';
                // }
            }
            return $customer;
        })->toArray();
        return view('pages.reports.interest-calculator', compact('allcustomers'));
    }

    public function interestCalculatorData(Request $request)
    {
        $loanId = $request->loan;
        $collectionAmount = $request->payamount;
        $objComm = new CommonController();

        $collectionDate = (strtotime($request->transactionDate)) ? date('Y-m-d', strtotime($request->transactionDate)) : '';
        session(['collectionAmount' => $collectionAmount]);
        session(['totalInterest' => []]);

        $loopchk = 0;
        $totalInterestSum = [];
        startSattleTxn:
        $collectionAmount = session('collectionAmount');
        $loanDetails = ApplyLoanHistory::where(['id' => $loanId])->first();
        // dd($loanDetails);
        if (!empty($loanDetails)) {
            $rateOfInterest = $loanDetails->rateOfInterest;
            $amountDetails = RawMaterialsTxnDetail::where(['loanId' => $loanId, 'isFullSettled' => 0, 'txnType' => 'out'])->orderBY('id', 'asc')->first();
            $rawLoanDetails = RawMaterialsTxnDetail::where(['loanId' => $loanId])->orderBY('id', 'asc')->first();
            if (!empty($amountDetails) && $collectionAmount > 0) {

                $transactionDate = date('Y-m-d', strtotime($amountDetails->interestStartDate));
                $amount = $amountDetails->openingBalanceLatest;
                $tenureDueDate = $amountDetails->tenureDueDate;

                $lateCharges = 0;
                $newLateTenureDueDate = date('Y-m-d', strtotime($tenureDueDate . ' + 10 days'));
                if (strtotime($collectionDate) > strtotime($newLateTenureDueDate)) {

                    if ($collectionAmount > $amount) {
                        $lateCharesArr = $objComm->calculateLateCharges($collectionDate, $newLateTenureDueDate, $amount);
                    } else {
                        $lateCharesArr = $objComm->calculateLateCharges($collectionDate, $newLateTenureDueDate, $collectionAmount);
                    }
                    $lateCharges = $lateCharesArr['lateCharges'];

                    $collectionAmount = $collectionAmount - $lateCharges;
                }

                $openingBalance = $amount;


                if ($collectionAmount > $openingBalance) {
                    $calcRes = $this->getInterestAndPaybleAmountRawMaterial($loanDetails->tenure, $transactionDate, $collectionDate, $openingBalance, $rateOfInterest);
                } else {
                    $calcRes = $this->getInterestAndPaybleAmountRawMaterial($loanDetails->tenure, $transactionDate, $collectionDate, $collectionAmount, $rateOfInterest);
                }

                $totalInterestSum[] = $calcRes;
                // echo '<pre>'; print_r($calcRes);exit;
                $rateOfInterest = $calcRes['rateOfInterest'];
                $interestPayble = $calcRes['interestPayble'];

                $leftUserAmount = $collectionAmount - $interestPayble;
                $baseAmountCredit = $leftUserAmount;
                
                if ($leftUserAmount >= $amount) {
                    $baseAmountCredit = $amount;
                    $leftUserAmount = round($leftUserAmount - $amount);
                    $collectionAmount = $amount + $interestPayble;
                    session(['collectionAmount' => $leftUserAmount]);
                } else {
                    $baseAmountCredit = $leftUserAmount;
                    $collectionAmount = $leftUserAmount + $interestPayble;
                    session(['collectionAmount' => 0]);
                }
                $baseAmountCredit = ($baseAmountCredit > 0) ? $baseAmountCredit : 0;
                $loopchk++;
                goto startSattleTxn;
            }else{
                $rateOfInterest = $loanDetails->rateOfInterest;

                $transactionDate = date('Y-m-d', strtotime($request->transactionDate));
                $amount = $collectionAmount;
                $calcRes = $this->getInterestAndPaybleAmountRawMaterial($loanDetails->tenure, $transactionDate, $collectionDate, $collectionAmount, $rateOfInterest);

                $totalInterestSum[] = $calcRes;
                $rateOfInterest = $calcRes['rateOfInterest'];
                $interestPayble = $calcRes['interestPayble'];

                $leftUserAmount = $collectionAmount - $interestPayble;

                if ($leftUserAmount >= $amount) {
                    $leftUserAmount = round($leftUserAmount - $amount);
                    $collectionAmount = $amount + $interestPayble;
                    session(['collectionAmount' => $leftUserAmount]);
                } else {
                    $collectionAmount = $leftUserAmount + $interestPayble;
                    session(['collectionAmount' => 0]);
                }
            }
            echo json_encode(['totalInterest'=>$totalInterestSum]);
            exit;
        }
        echo json_encode(['totalInterest'=>$totalInterestSum]);
        exit;
    }

    public function getInterestAndPaybleAmountRawMaterial($tenureId, $transactionDate, $collectionDate, $amount, $rateOfInterest)
    {
        $tenuverMonth = DB::table('tenures')->whereId($tenureId)->pluck('name')->first();

        $tmonth = 2;
        if ($tenuverMonth) {
            $newData = explode('Days', $tenuverMonth);
            $tmonth = (int)trim($newData[0]) ?? 2;
        }

        $datetime1 = date_create($transactionDate);
        $datetime2 = date_create($collectionDate);

        // Calculates the difference between DateTime objects
        $interval = date_diff($datetime1, $datetime2);

        // Display the result
        $numOfDays = $interval->format('%a');
        if ($tmonth == 30 && $numOfDays <= 7) {
            $numOfDays = 7;
        } elseif ($tmonth > 30 && $numOfDays <= 15) {
            $numOfDays = 15;
        }

        $oneYearInterest = ($amount * $rateOfInterest) / 100;
        $oneDayInterest = $oneYearInterest / 365;
        $totalInterest = $oneDayInterest * $numOfDays;

        $tdsPercent = 10;
        $tdsAmount = ($totalInterest * $tdsPercent) / 100;
        $interestPayble = $totalInterest - $tdsAmount;
        $playbleLoanAmount = round($amount + $interestPayble);
        $returnArr = ['numOfDays' => $numOfDays, 'rateOfInterest' => $rateOfInterest, 'loanAmount' => round($amount), 'playbleLoanAmount' => $playbleLoanAmount, 'totalInterest' => round($totalInterest), 'interestPayble' => round($interestPayble), 'tdsPercent' => round($tdsPercent), 'tdsAmount' => round($tdsAmount)];
        return $returnArr;
    }
}
