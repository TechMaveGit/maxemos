<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\AppServiceProvider;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Product;
use App\Models\RawMaterialsTxnDetail;
use App\Models\Tenure;
use App\Models\User;
use App\Models\EmploymentHistory;
use App\Models\UserBankDetail;
use App\Models\UserDoc;
use App\Models\UserOtp;
use App\Models\EmployerMaster;
use App\Models\EmployerTypeMaster;
use App\Models\UserActivityHistory;
use App\Models\CreditScoreQuestion;
use App\Models\CreditScoreQuestionAnswer;
use App\Models\CreditScoreUsersAnswer;
use App\Models\CreditScoreQuestionsCategory;
use App\Models\LoanEmiDetail;
use App\Http\Controllers\GloadController;
use App\Models\CoApplicantDetail;
use App\Models\PersonalDiscussionOnCall;
use App\Models\CashFlowAnalysi;
use App\Models\DeviationRecord;
use App\Models\OtherKycDoc;
use App\Models\ApplyLoanHistory;
use App\Models\LoanPreCloserHistory;
use App\Models\OutStandingPaymentHistory;
use App\Models\LoanKycOtherPendetail;
use DateTime;
use DatePeriod;
use DateInterval;
use DB;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{

    public $indianStates = [
        'AP' => 'Andhra Pradesh',
        'AR' => 'Arunachal Pradesh',
        'AS' => 'Assam',
        'AN' => 'Andaman and Nicobar Islands',
        'BR' => 'Bihar',
        'CT' => 'Chhattisgarh',
        'CH' => 'Chandigarh',
        'DN' => 'Dadra and Nagar Haveli',
        'DD' => 'Daman and Diu',
        'DL' => 'Delhi',
        'GA' => 'Goa',
        'GJ' => 'Gujarat',
        'HR' => 'Haryana',
        'HP' => 'Himachal Pradesh',
        'JK' => 'Jammu and Kashmir',
        'JH' => 'Jharkhand',
        'KA' => 'Karnataka',
        'KL' => 'Kerala',
        'LD' => 'Lakshadweep',
        'MP' => 'Madhya Pradesh',
        'MH' => 'Maharashtra',
        'MN' => 'Manipur',
        'ML' => 'Meghalaya',
        'MZ' => 'Mizoram',
        'NL' => 'Nagaland',
        'OR' => 'Odisha',
        'PB' => 'Punjab',
        'PY' => 'Puducherry',
        'RJ' => 'Rajasthan',
        'SK' => 'Sikkim',
        'TN' => 'Tamil Nadu',
        'TG' => 'Telangana',
        'TR' => 'Tripura',
        'UP' => 'Uttar Pradesh',
        'UT' => 'Uttarakhand',
        'WB' => 'West Bengal'
    ];

    public function index()
    {
        $pageTitle = 'New Customers';
        $pageNameStr = 'customers-list';

        return view('pages.customers.customers-list', compact('pageTitle', 'pageNameStr'));
    }

    public function allcustomer()
    {
        $pageTitle = 'All Customer List';
        $pageNameStr = 'all-customers-list';

        return view('pages.customers.customers-list', compact('pageTitle', 'pageNameStr'));
    }

    public function generateCustomerCode()
    {
        $customerRes = DB::select("select id,customerCode from users where customerCode IS NOT NULL AND customerCode !='' AND userType='user' order by id desc limit 1");
        if (count($customerRes)) {
            $customerCodeOld = $customerRes[0]->customerCode;
            $customerCodeOldNew = (int)str_replace(env('CID_PRE'), '', $customerCodeOld);
            if ($customerCodeOldNew < 9) {
                $customerCodeInt = $customerCodeOldNew + 1;
                $customerCode = env('CID_PRE') . '00000' . $customerCodeInt;
            } else if ($customerCodeOldNew < 99) {
                $customerCodeInt = $customerCodeOldNew + 1;
                $customerCode = env('CID_PRE') . '0000' . $customerCodeInt;
            } else if ($customerCodeOldNew < 999) {
                $customerCodeInt = $customerCodeOldNew + 1;
                $customerCode = env('CID_PRE') . '000' . $customerCodeInt;
            } else if ($customerCodeOldNew < 9999) {
                $customerCodeInt = $customerCodeOldNew + 1;
                $customerCode = env('CID_PRE') . '00' . $customerCodeInt;
            } else if ($customerCodeOldNew < 99999) {
                $customerCodeInt = $customerCodeOldNew + 1;
                $customerCode = env('CID_PRE') . '0' . $customerCodeInt;
            } else {
                $customerCodeInt = $customerCodeOldNew + 1;
                $customerCode = env('CID_PRE') . $customerCodeInt;
            }
        } else {
            $customerCode = env('CID_PRE') . '000001';
        }
        return $customerCode;
    }

    public function getUserAllDetails(Request $request)
    {
        $userId = $request->userId;

        $userDetails = User::where('id', $userId)->first();
        $employmentDetails = EmploymentHistory::where('userId', $userId)->first();
        $bankDetails = UserBankDetail::where('userId', $userId)->first();
        $kycDetails = UserDoc::where('userId', $userId)->first();
        $coApplicantDetails = CoApplicantDetail::where('userId', $userId)->first();
        $cashFlowAnalysisDetails = CashFlowAnalysi::where('userId', $userId)->first();
        $loankyc1 = LoanKycOtherPendetail::where('userId', $userId)->first();
        $loankyc2 = LoanKycOtherPendetail::where('userId', $userId)->skip(1)->first();

        $OtherKycDoc = OtherKycDoc::where('userId', $userId)->orderBy('id', 'ASC')->get();
        $maxOtherCount = count($OtherKycDoc);

        $otherDocHtml = '';
        if ($maxOtherCount) {
            $otherDocHtml .= '<input type="hidden" name="maxOtherDocs" id="maxOtherDocs" value="' . $maxOtherCount . '">';
            $otherSr = 1;
            foreach ($OtherKycDoc as $otherRow) {
                $docURL = asset('/') . 'public/' . $otherRow->docsUrl;

                $otherDocHtml .= '<div class="row col-lg-12 mb-5" id="otherRow' . $otherSr . '">
                        <label class="block">
                            <span>Others documents <span style="font-size: 10px;color: red;">(IT RETURN,GSt return,balance sheet PNL)</span></span><a href="' . $docURL . '" id="bankAttachemetV" target="_blank" style="color: blue;">( Click Here to View )</a>
                        </label>
                        <div class="col-lg-5">
                            <input type="hidden" name="otherDocumentIds[]" value="' . $otherRow->id . '">
                            <input name="otherDocumentTitle[]" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Document Name" type="text" value="' . $otherRow->title . '">
                        </div>
                        <div class="col-lg-1">&nbsp;</div>
                        <div class="col-lg-6">
                            <input name="otherDocumentExist[]" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                            <input type="file" hidden name="otherDocument[]">
                            </div>
                    </div>';
                $otherSr++;
            }
        } else {
            $otherDocHtml .= '<input type="hidden" name="maxOtherDocs" id="maxOtherDocs" value="1">
                <div class="row col-lg-12 mb-5" id="otherRow1">
                    <label class="block">
                        <span>Others documents <span style="font-size: 10px;color: red;">(IT RETURN,GSt return,balance sheet PNL)</span></span>
                        
                    </label>
                    <div class="col-lg-5">
                        <input name="otherDocumentTitle[]" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Document Name" type="text">
                    </div>
                    <div class="col-lg-1">&nbsp;</div>
                    <div class="col-lg-6">
                        <input name="otherDocument[]" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                    </div>
                </div>';
        }

        if ($userDetails) {
            echo json_encode(['status' => 'success', 'message' => 'Request has been processed successfully.', 'userId' => $userId, 'user' => (!empty($userDetails)) ? $userDetails : '', 'employment' => (!empty($employmentDetails)) ? $employmentDetails : '', 'bank' => (!empty($bankDetails)) ? $bankDetails : '', 'kycDetails' => (!empty($kycDetails)) ? $kycDetails : '', 'coApplicantDetails' => (!empty($coApplicantDetails)) ? $coApplicantDetails : '', 'cashFlowAnalysisDetails' => (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails : '', 'otherDocHtml' => $otherDocHtml, 'loanKyc1' => (!empty($loankyc1) ? $loankyc1 : ''), 'loanKyc2' => (!empty($loankyc2) ? $loankyc2 : '')]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }

    public function getUserCashFlowAnalysisDetailsByUser(Request $request)
    {
        $userId = $request->userId;

        $cashFlowAnalysisDetails = CashFlowAnalysi::where('userId', $userId)->first();

        if (!empty($cashFlowAnalysisDetails)) {
            echo json_encode(['status' => 'success', 'message' => 'Request has been processed successfully.', 'cashFlowAnalysisDetails' => (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails : '']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No Record Found.']);
        }
    }

    public function saveCustomerInfo(Request $request)
    {
        $recordId = $request->recordId;
        if ($recordId > 0) {
            $isValidated = AppServiceProvider::validatePermission('edit-customers');
        } else {
            $isValidated = AppServiceProvider::validatePermission('add-customers');
        }


        $customerPhone = $request->customerPhone;
        $customerEmail = $request->customerEmail;
        $EXISTCHKSUBQRY = "";
        if ($recordId) {
            $EXISTCHKSUBQRY = " AND id !='$recordId'";
        }

        $emailExist = DB::select("SELECT * FROM users WHERE email='$customerEmail' $EXISTCHKSUBQRY");
        if (count($emailExist)) {
            echo json_encode(['status' => 'error', 'message' => 'This emailid is already registered with us.']);
            exit;
        }

        $mobileExist = DB::select("SELECT * FROM users WHERE mobile='$customerPhone' $EXISTCHKSUBQRY");
        if (count($mobileExist)) {
            echo json_encode(['status' => 'error', 'message' => 'This mobile number is already registered with us.']);
            exit;
        }

        $dateOfBirth = (strtotime($request->dateOfBirth)) ? date('Y-m-d', strtotime($request->dateOfBirth)) : NULL;
        if ($dateOfBirth) {
            $dobYear = $this->getYearDiffInTwoDates($dateOfBirth);
            if ($dobYear < 21 || $dobYear > 58) {
                echo json_encode(['status' => 'error', 'message' => 'Applicant age must be greater than 21 years & less than 58 years.']);
                exit;
            }
        }

        $lobObj = new GloadController();

        if (config('app.env') == "production" && !isset($request->skipadddharcheck)) {
            $aadhaar = $lobObj->adhaar_verification($request->aadhaar_no);
            if ($aadhaar && $aadhaar->status != 1) {
                echo json_encode(['status' => 'error', 'message' => $aadhaar->msg]);
                exit;
            }
        }

        if (config('app.env') == "production" && !isset($request->skippencheck)) {
            $pancard_no = $lobObj->pancard_verification($request->pancard_no);
            // dd($pancard_no);
            if ($pancard_no && $pancard_no->status != 1) {
                echo json_encode(['status' => 'error', 'message' => $pancard_no->msg]);
                exit;
            }
        }
        // dd($aadhaar);
        $image = '';
        if ($request->hasFile('profileImg')) {
            $image = AppServiceProvider::uploadImageCustom('profileImg', 'users');
        }
        // dd($image);

        if (!$recordId) {
            $saveUp['customerCode'] = $this->generateCustomerCode();
        }

        $userState = explode('_', $request->state);
        $state = $userState[1] ?? $request->state;
        $short_state = $userState[0] ?? $request->state;

        $saveUp['nameTitle'] = $request->nameTitleCu;
        $saveUp['name'] = $request->customerName;
        $saveUp['email'] = $request->customerEmail;
        $saveUp['mobile'] = $request->customerPhone;
        $saveUp['maritalStatus'] = $request->maritalStatus;
        $saveUp['gender'] = $request->gender;
        $saveUp['dateOfBirth'] = $dateOfBirth;
        $saveUp['addressLine1'] = $request->address;
        $saveUp['addressLine2'] = $request->address2;
        $saveUp['city'] = $request->city;
        $saveUp['district'] = $request->district;
        $saveUp['state'] = $state;
        $saveUp['state_short'] = $short_state;
        $saveUp['pincode'] = $request->pincode;
        $saveUp['aadhaar_no'] = $request->aadhaar_no;
        $saveUp['pancard_no'] = $request->pancard_no;
        $saveUp['religion'] = $request->religionCu;
        $saveUp['educationStatus'] = $request->educationStatusCu;
        $saveUp['fatherName'] = $request->fatherNameCu;
        $saveUp['motherName'] = $request->motherNameCu;
        $saveUp['sourcePerson'] = $request->sourcePerson;
        $saveUp['sourcePersonNumber'] = $request->sourcePersonNumber;
        $saveUp['branchName'] = $request->branchName;
        $saveUp['cibilScore'] = $request->cibilScoreCu;
        $saveUp['userType'] = 'user';
        if ($request->password) {
            $saveUp['password'] = md5($request->password);
        }


        if ($image) {
            $saveUp['profilePic'] = $image;
        }
        $saveUp['status'] = '1';

        if ($recordId > 0) {

            $saveUp['updated_at'] = date('Y-m-d H:i:s');
            $save = User::where('id', $recordId)->update($saveUp);
        } else {
            $saveUp['registeredBy'] = 'admin';
            $saveUp['kycStatus'] = 'pending';
            $saveUp['created_at'] = date('Y-m-d H:i:s');
            $saveUp['updated_at'] = date('Y-m-d H:i:s');

            $initialConcentData = 'We agree to submit, sign and execute all such agreements and other docs as may be prescribed and required by Maxemo Capital Services Pvt. Ltd. 
            We also authorize, Maxemo Capital and agree not to hold Maxemo responsible for any disclosure at any time of any information relating to Me/Firm and our facilities including to repayment history, defaults in payment to credit bureaus, Banks, financial institutions and or any third party engaged by Maxemo Capital. I/we hereby acknowledge and authorize Maxemo, its affiliates and associate financing partners to conduct necessary due diligence with respect to my application, as per their process including CIBIL/other necessary bureau checks of the applicant, its promoters, directors/partners and/or key managerial&nbsp;personnels.';

            $saveUp['initialConcentData'] = $initialConcentData;

            $save = DB::table('users')->insertGetId($saveUp);


            $acceptURL = route('acceptConsentByCustomer', [1, md5($save)]);
            $rejectURL = route('acceptConsentByCustomer', [2, md5($save)]);

            $htmlSt = '<div>
                        <p>Dear ' . $request->customerName . ',</p>
                    <div>
                    <table style="width: 100%;">
                        <tr>
                            <td colspan="2"> ' . $initialConcentData . ' </td>
                        </tr>';
            $htmlSt .= '<tr>
                                <th style="width: 50%;padding: 6px !important;">
                                    <p>
                                        <center><a href="' . $acceptURL . '" target="_blank" style="color: blue;font-size: 22px;font-weight: bold;">Click Here To Accept</a></center>
                                    </p>
                                </th>
                                <th style="width: 50%;padding: 6px !important;">
                                     <p style="margin-top:20px !important;">
                                        <center><a href="' . $rejectURL . '" target="_blank" style="color: red;font-size: 22px;font-weight: bold;">Click Here To Reject</a></center>
                                    </p>
                                </th>
                           </tr>';
            $htmlSt .= '</table>
                </div>
            </div>';
            $verifyWith = env('APP_NAME');
            $toMail = $request->customerEmail;
            $toUser = $request->customerName;
            $subject = 'Need Approval For Consent ' . $verifyWith;



            AppServiceProvider::sendMail($toMail, $toUser, $subject, $htmlSt);

            $htmlStAdmin = '<div>
                    <p>Dear Admin,</p>
                    <table style="width:100%;">
                    <tr>
                        <td colspan="2">' . $request->customerName . ' (' . $saveUp['customerCode'] . ') has been onboard on maxemo software.</td>
                    </tr>
                    <tr>
                    
                    </tr>
                    </table>
                <div><br/><br/><br/></div></div>';
            if (config('app.env') == "production") {
                $bccMail = config('mail.prodAdminMail');
                AppServiceProvider::sendMail("info@maxemocapital.com", "Info Maxemo", "New Customer Onboard | " . $verifyWith, $htmlStAdmin,$bccMail);
            } else {
                $bccMail = config('mail.testMail');
                AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "New Customer Onboard | " . $verifyWith, $htmlStAdmin,$bccMail);
            }
        }
        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Customer details has been saved successfully.', 'userId' => (!$recordId) ? $save : '']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
   
    }



    //TODO Customer Management List
    public function filterUsersCustomerManagement(Request $request)
    {
        try{
        $customSearch = $request->customSearch;
        $fromDate = (strtotime($request->fromDate)) ? date('Y-m-d', strtotime($request->fromDate)) : '';
        $toDate = (strtotime($request->toDate)) ? date('Y-m-d', strtotime($request->toDate)) : '';
        $userStatus = $request->userStatus;

        $pageNameStr = $request->pageNameStr;

        $SUBQRY = '';
        if ($pageNameStr == 'customers-list') {
            $SUBQRY .= " AND u.kycStatus='pending'";
        } else if ($pageNameStr == 'all-customers-list') {
            // $SUBQRY .=" ";
            if ($request->kycStatus && $request->kycStatus != '0') {
                $SUBQRY .= " AND u.kycStatus='$request->kycStatus'";
            }
            if ($request->businessStatus && $request->businessStatus != '0') {
                $SUBQRY .= " AND eh.status='$request->businessStatus'";
            }
        } else if ($pageNameStr == 'rejected-customers') {
            $SUBQRY .= " AND u.kycStatus='rejected'";
        } else if ($pageNameStr == 'employment-verification') {
            $SUBQRY .= " AND u.kycStatus='approved' AND eh.status='pending'";
        } else if ($pageNameStr == 'employment-verification-rejected') {
            $SUBQRY .= " AND u.kycStatus='approved' AND eh.status='rejected'";
        } else if ($pageNameStr == 'kyc-verified-customers') {
            $SUBQRY .= " AND u.kycStatus='approved' AND eh.status='approved' AND alh.id IS NULL";
        } else if ($pageNameStr == 'final-credit-assessment') {
            $SUBQRY .= " AND u.kycStatus='approved' AND eh.status='approved' AND alh.status='sent-for-admin-approval' AND alh.id IS NOT NULL";
        } else if ($pageNameStr == 'final-approval-for-disbursement') {
            $SUBQRY .= " AND u.kycStatus='approved' AND eh.status='approved' AND alh.status='customer-approved' AND alh.id IS NOT NULL AND alh.loanCategory !='3'";
        } else if ($pageNameStr == 'disbursement-pending-list') {
            $SUBQRY .= " AND u.kycStatus='approved' AND eh.status='approved' AND alh.status='sent-for-customer-approval' AND alh.id IS NOT NULL";
        } else if ($pageNameStr == 'disbursement-rejected-list') {
            $SUBQRY .= " AND u.kycStatus='approved' AND eh.status='approved' AND alh.status='rejected' AND alh.id IS NOT NULL";
        }

        if ($pageNameStr != 'all-customers-list') {
            if ($userStatus == 1 || $userStatus == 0) {
                $SUBQRY .= " AND u.status='$userStatus'";
            }
        }

        if ($fromDate != "" && $toDate != "") {
            $SUBQRY .= " AND date(u.created_at)>='$fromDate' AND date(u.created_at)<='$toDate'";
        }

        if ($customSearch) {
            $SUBQRY .= " AND (u.customerCode LIKE '%$customSearch%' OR u.name LIKE '%$customSearch%' OR u.email LIKE '%$customSearch%' OR u.mobile LIKE '%$customSearch%')";
        }

        //$customers=User::where(['userType'=>'user','kycStatus'=>'pending','disbursementStatus'=>'pending'])->orderBy('id','desc')->get();
        //$customers=DB::select("SELECT * FROM users WHERE userType='user' $SUBQRY ORDER BY id desc");
        if ($pageNameStr == 'all-customers-list') {
            // echo "SELECT u.*,eh.id as employmentHistoryId,eh.status as employmentStatus FROM users u LEFT JOIN employment_histories eh ON u.id=eh.userId WHERE u.userType='user' $SUBQRY ORDER BY u.id desc";
            $customers = DB::select("SELECT DISTINCT u.*,eh.id as employmentHistoryId,alh.isAdminApproved,alh.reject_reason,eh.status as employmentStatus FROM users u LEFT JOIN employment_histories eh ON u.id=eh.userId LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId WHERE u.userType='user' $SUBQRY ORDER BY u.id desc");
        } else {
            $customers = DB::select("SELECT DISTINCT u.*,c.name as loanCategoryD,alh.id as loanId,alh.isAdminApproved,alh.reject_reason,eh.id as employmentHistoryId,alh.status as loanStatus,eh.status as employmentStatus FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN employment_histories eh ON u.id=eh.userId LEFT JOIN categories c ON alh.loanCategory=c.id WHERE u.userType='user' $SUBQRY ORDER BY u.id desc");
        }
        // dd('--');

        $TBLLTHCLS = 'whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
        $htmlStr = '<table class="is-hoverable w-full text-left dataTable no-footer overflow-x-auto">
            <thead>
                  <tr>
                        <th class="' . $TBLLTHCLS . '">Profile</th>
                        <th class="' . $TBLLTHCLS . '">Cust. ID</th>
                        <th class="' . $TBLLTHCLS . '">Name</th>
                        <th class="' . $TBLLTHCLS . '">Email</th>
                        <th class="' . $TBLLTHCLS . '">Mobile No.</th>';
        if ($pageNameStr != 'all-customers-list') {
            $htmlStr .= '<th class="' . $TBLLTHCLS . '">Loan Type</th>';
        }
        $htmlStr .= '<th class="' . $TBLLTHCLS . '">Date</th>';
        if ($pageNameStr == 'all-customers-list') {
            $htmlStr .= '<th class="' . $TBLLTHCLS . '">KYC Status</th>';
            $htmlStr .= '<th class="' . $TBLLTHCLS . '">Business Status</th>';
        }
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
                                <td>' . $crow->mobile . '</td>';
                if ($pageNameStr != 'all-customers-list') {
                    $htmlStr .= '<td>' . $crow->loanCategoryD . '</td>';
                }
                $htmlStr .= '<td>' . $createdDate . '</td>';
                if ($pageNameStr == 'all-customers-list') {
                    if ($crow->kycStatus == 'approved') {
                        $htmlStr .= '<td><span class="badge badge-success-light">Approved</span></td>';
                    } else if ($crow->kycStatus == 'rejected') {
                        $htmlStr .= '<td><span style="background-color: #f44;" class="badge badge-danger-light">Rejected</span></td>';
                    } else {
                        $htmlStr .= '<td><span class="badge badge-warning-light">Pending</span></td>';
                    }
                }
                if ($pageNameStr == 'all-customers-list') {
                    if ($crow->employmentStatus == 'approved') {
                        $htmlStr .= '<td><span class="badge badge-success-light">Approved</span></td>';
                    } else if ($crow->employmentStatus == 'rejected') {
                        $htmlStr .= '<td><span style="background-color: #f44;" class="badge badge-danger-light">Rejected</span></td>';
                    } else {
                        $htmlStr .= '<td><span class="badge badge-warning-light">Pending</span></td>';
                    }
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

                $buttons = '<a href="' . route('profileDetails', [$pageNameStr, $crow->id]) . '" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"><i data-feather="eye" class="fa fa-eye text-primary"></i></a>';
                $buttons .= '<button type="button" onclick="editCustomerProfile(' . $crow->id . ');" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                    <i class="fa fa-edit"></i>
                </button>';
                $buttons .= '<button type="button" onclick="editCustomerBusiness(' . $crow->id . ');" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                    <i class="fa fa-bank"> </i>
                </button>';

                /*$buttons .= '<button class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                    <i class="fa fa-trash-alt"></i>
                </button>';*/

                if ($pageNameStr == 'kyc-verified-customers' || $pageNameStr == 'disbursement-pending-list' || $pageNameStr == 'disbursement-rejected-list') {
                    $buttons .= '<button onclick="return initiateApplyLoan(' . $crow->id . ');" class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                        <i class="fa fa-inr"></i>
                    </button>';
                }


                $htmlStr .= '</td>
                                <td>
                                    <div class="d-flex">
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

    public function profileDetails($pageNameStr, $userId)
    {

        $userDtl = User::getUserDetailsById($userId);
        $userBankDtl = UserBankDetail::where('userId', $userId)->orderBy('id', 'desc')->first();
        $userDocDtl = UserDoc::where('userId', $userId)->orderBy('id', 'desc')->first();
        $userEmploymentHistory = EmploymentHistory::where('userId', $userId)->where('fromAdmin', 0)->where('status', 'pending')->orderBy('id', 'desc')->first();
        $tenure = CreditScoreQuestionAnswer::where('questionId', 3)->where('status', 1)->select('id', 'ansTitle', 'otherValueOrDays')->get();


        $userEmploymentHistoryAdmin = EmploymentHistory::where('userId', $userId)->where('fromAdmin', 1)->orderBy('id', 'desc')->first();

        $loanDetails = ApplyLoanHistory::getAllAppliedLoans($userId);

        $coApplicantDtlARR = CoApplicantDetail::where('userId', $userId)->orderBy('id', 'asc')->get();
        $DeviationRecord = DeviationRecord::where(['userId' => $userId])->first();

        $deviationShow = 0;
        $deviationShowArr = (array)session('deviationShowArr');
        if (!in_array($userId, $deviationShowArr)) {
            $deviationShowArr = $deviationShowArr[] = $userId;
            session(['deviationShowArr' => $deviationShowArr]);
            $deviationShow = 1;
        }

        $otherKycDocs = OtherKycDoc::where('userId', $userId)->orderBy('id', 'ASC')->get();

        // print_r($deviationShowArr);exit;
        return view('pages.general.profile', compact('userDtl', 'DeviationRecord', 'deviationShow', 'coApplicantDtlARR', 'tenure', 'userBankDtl', 'userDocDtl', 'userEmploymentHistory', 'pageNameStr', 'userEmploymentHistoryAdmin', 'loanDetails', 'otherKycDocs', 'userId'));
    }

    public function confirmAmountForDisbursement(Request $request)
    {
        $isValidated = AppServiceProvider::validatePermission('loan-send-for-approval');

        $loanId = $request->loanId;
        $tenure = CreditScoreQuestionAnswer::where('questionId', 3)->where('status', 1)->select('id', 'ansTitle', 'otherValueOrDays')->get();
        $loanDetailsArr = DB::select("SELECT alh.id as loanId,alh.userId,alh.productId,alh.loanAmount appliedLoanAmount,alh.tenure as appliedTenureId,csqa.ansTitle as appliedTenure,alh.approvedTenure as approvedTenureId,csqa2.ansTitle as approvedTenure,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.approvedAmount,alh.status as loanStatus,alh.remark,p.productCode,p.productName,p.rateOfInterest as productROI,p.tenure as productTenure,p.amount as productAmount,p.amountTo as productAmountTo,p.numOfEmi as productEMI,p.productType,c.name as categoryName,sc.name as subCategoryName FROM apply_loan_histories alh LEFT JOIN products p ON alh.productId=p.id LEFT JOIN categories c ON p.categoryId=c.id LEFT JOIN subcategories sc ON p.subCategoryId=sc.id LEFT JOIN credit_score_question_answers csqa ON alh.tenure=csqa.id LEFT JOIN credit_score_question_answers csqa2 ON alh.approvedTenure=csqa2.id WHERE alh.id='$loanId' ORDER BY alh.id DESC");
        if (!count($loanDetailsArr)) {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
            exit;
        }
        $loanDetails = $loanDetailsArr[0];
        $htmlStr = '';
        $htmlStr .= '<div class="modal-body">
            <div class="row">
                <input type="hidden" id="loanId" name="loanId" value="' . $loanDetails->loanId . '">
                <div class="col-lg-12">
                    <center><h4>Product Details</h4></center>
                    <hr>
                </div>';

        $htmlStr .= '<div class="col-lg-6 mt-3">
                    <label ><strong>Product Name</strong></label><br>
                    <label>' . $loanDetails->productName . '</label>
                </div>';

        /*
        $htmlStr .='<div class="col-lg-6 mt-3">
            <label ><strong>Product Amount</strong></label><br>';
            if($loanDetails->productType==0)
            {
                $htmlStr .='<label>'.$loanDetails->productAmount.'</label>';
            }else{
                $htmlStr .='<label>'.$loanDetails->productAmount.' - '.$loanDetails->productAmountTo.'</label>';
            }
        $htmlStr .='</div>';
        $htmlStr .='<div class="col-lg-6 mt-3">
            <label ><strong>Product ROI</strong></label><br>
            <label>'.$loanDetails->productROI.' %</label>
        </div>';
        */
        $htmlStr .= '<div class="col-lg-6 mt-3">
                    <label ><strong>Product No. Of. EMI</strong></label><br>
                    <label>' . $loanDetails->productEMI . ' </label>
                </div>
                <div class="col-lg-6 mt-3">
                    <label><strong>Applied Loan Amount</strong></label><br>
                    <label>' . $loanDetails->appliedLoanAmount . ' </label>
                </div>
                <div class="col-lg-6 mt-3">
                    <label ><strong>Applied Tenure</strong></label><br>
                    <label>' . $loanDetails->appliedTenure . ' </label>
                </div>';
        $tenureStyle = ($loanDetails->productType == 0) ? 'style="display:none"' : '';

        $htmlStr .= '<div class="col-lg-12 mt-3 approveTenureHtml" ' . $tenureStyle . ' >
                    <label><strong>Approve Tenure</strong></label>
                    <select class="js-example-basic-single2 form-select" id="approveTenure" data-width="100%">
                        <option value="">Select Tenure</option>';
        if (count($tenure)) {
            foreach ($tenure as $trow) {
                $selectedTenure = '';
                if ($loanDetails->appliedTenureId == $trow->id) {
                    $selectedTenure = 'selected';
                }
                $htmlStr .= '<option value="' . $trow->id . '" ' . $selectedTenure . ' datamonth="' . $trow->otherValueOrDays . '">' . $trow->ansTitle . '</option>';
            }
        }
        $htmlStr .= '</select>
                </div>
                <div class="col-lg-12 mt-3">
                    <label><strong>Approve Amount</strong></label>
                    <input type="text" onkeypress="javascript:return isNumber(event)" id="approvedAmount" value="' . $loanDetails->appliedLoanAmount . '" class="form-control">
                </div>
                <div class="col-lg-12 mt-3">
                    <label><strong>Approve ROI</strong></label>
                    <input type="text" onkeypress="javascript:return isNumber(event)" id="approvedROI" value="' . $loanDetails->productROI . '" class="form-control">
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="javascript:void(0);" onclick="approveUserDisbursement(' . $loanDetails->userId . ',' . $loanDetails->loanId . ',1);" class="btn btn-warning">Send For Customer Approval</a>
        </div>';

        echo json_encode(['status' => 'success', 'message' => 'Product Details.', 'data' => $htmlStr]);
        exit;
    }

    public function getLoanDetailsForScheduleDisbursement(Request $request)
    {
        $isValidated = AppServiceProvider::validatePermission('schedule-disbursement');

        $loanId = $request->loanId;
        $loanDetailsArr = DB::select("SELECT alh.*,c.id as productId,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.id='$loanId' ORDER BY alh.id DESC");
        if (!count($loanDetailsArr)) {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
            exit;
        }

        $loanDetails = $loanDetailsArr[0];

        $productNameStr = '';
        if ($loanDetails->categoryName && $loanDetails->productName) {
            $productNameStr = $loanDetails->categoryName . ' / ' . $loanDetails->productName;
        } else if ($loanDetails->productName) {
            $productNameStr = $loanDetails->productName;
        } else if ($loanDetails->categoryName) {
            $productNameStr = $loanDetails->categoryName;
        }

        $htmlStr = '';
        $htmlStr .= '<div class="modal-body">
            <div class="row">
                <input type="hidden" id="loanIdDisburse" name="loanIdDisburse" value="' . $loanDetails->id . '">
                <input type="hidden" id="productIdDisburse" name="productIdDisburse" value="' . $loanDetails->productId . '">
                <div class="col-lg-12">
                    <center><h4>Product Details</h4></center>
                    <hr>
                </div>';

        $htmlStr .= '<div class="col-lg-4 mt-3">
                    <label ><strong>Product Name</strong></label><br>
                    <label>' . $productNameStr . '</label>
                </div>';
        $htmlStr .= '
                <div class="col-lg-4 mt-3">
                    <label ><strong>Approved Tenure</strong></label><br>
                    <label>' . $loanDetails->approvedTenureD . ' </label>
                </div>
                 <div class="col-lg-4 mt-3">
                    <label><strong>Approved Amount</strong></label><br>
                    <label>' . $loanDetails->approvedAmount . ' </label>
                </div>';
        if ($loanDetails->loanCategory != 3) {
            $roiTypeLabel = AppServiceProvider::getROITypeHeading($loanDetails->roiType);
            $htmlStr .= '<div class="col-lg-4 mt-3">
                        <label ><strong>ROI Type</strong></label><br>
                        <label>' . $roiTypeLabel . '</label>
                    </div>';
        }

        if ($loanDetails->monthlyEMI) {
            $htmlStr .= '<div class="col-lg-4 mt-3">
                    <label ><strong>Product ROI</strong></label><br>
                    <label><span>' . $loanDetails->rateOfInterest . '</span>%</label>
                </div><div class="col-lg-4 mt-3" style="display:none;">
                    <label ><strong>Emi Amount</strong></label><br>
                    <label>' . $loanDetails->monthlyEMI . ' </label>
                </div>
                <div class="col-lg-4 mt-3" style="display:none;">
                    <label ><strong>Total Interest</strong></label><br>
                    <label>' . $loanDetails->totalInterest . ' </label>
                </div>';
        }

        if ($loanDetails->disbursementAmount) {
            $htmlStr .= '<div class="col-lg-4 mt-3">
                    <label ><strong>Net Disbursement Amount</strong></label><br>
                    <label id="previewNetDisbursAmount">' . $loanDetails->disbursementAmount . ' </label>
                </div>';
        }

        $htmlStr .= '<div class="col-lg-4 mt-3">
                    <label><strong>Is Interest Already Paid</strong></label><br>';
        if ($loanDetails->paidInterest && (int)$loanDetails->paidInterest != 0){
            $htmlStr .= '<label id="paidInterestAlr">Yes ('.$loanDetails->paidInterest.')</label>';
        }else{
            $htmlStr .= '<label>No</label>';
        }
        $htmlStr .='</div>';

        $htmlStr .= '<div class="col-lg-4 mt-3">
                    <label><strong>Disburse Date</strong></label>
                    <input type="date" style="cursor: pointer;" ';
        if ($loanDetails->roiType != "bullet_repayment") $htmlStr .= ' onchange="previewScheduleDisburse(' . $loanId . ')" ';
        $htmlStr .= 'id="disburseDate" value="" class="form-control">
                </div>
                <div class="col-lg-12 mt-3" style="display:none;" id="includeextraDays">
                    <div class="form-check">
                        <input class="form-check-input" data-eday="0" data-netd="' . $loanDetails->disbursementAmount . '"  onChange="includeExtraDaysAmount(' . $loanId . ')" name="includeExtraDays" type="checkbox" value="1" id="includeExtraDaysData">
                        <label class="form-check-label" for="includeExtraDaysData">
                            Include Extra Days Amount From Loan Amount
                        </label>
                    </div>
                </div>';

        $htmlStr .= '    </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="javascript:void(0);"  onclick="scheduleDisburse(' . $loanDetails->userId . ');" class="btn btn-warning">Submit</a>
                </div>
                <div id="scheduleDisbursePreviewData" ></div>';

        echo json_encode(['status' => 'success', 'message' => 'Product Details.', 'data' => $htmlStr]);
        exit;
    }

    public function saveEmploymentStatus(Request $request)
    {
        $isValidated = AppServiceProvider::validatePermission('approve-reject-employment');

        $userId = $request->userId;
        $status = $request->status;
        $remark = $request->remark;

        $empDtl = EmploymentHistory::where('id', $userId)->first();
        $userDtl = User::getUserDetailsById($empDtl->userId);
        if (empty($userDtl)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid Request, Please try again.']);
            exit;
        }

        $statusText = '';
        if ($status == 1) {
            $statusText = 'approved';
            $remark = ($remark) ? $remark : 'Employment has been approved successfully.';

            $title = 'Employment Approved';
            $body = 'Your employment details has been approved successfully.';
            $message = 'Your employment details has been approved successfully.';
            $notificationType = 'employment-approved';
        } else if ($status == 2) {
            $statusText = 'rejected';

            $title = 'Employment Rejected';
            $body = 'Your employment details has been rejected, Please contact to support.';
            $message = 'Your employment details has been rejected, Please contact to support.';
            $notificationType = 'employment-rejected';
        }

        $userUp = EmploymentHistory::where('id', $userId)->update(['status' => $statusText, 'remark' => $remark]);

        if ($userUp) {

            echo json_encode(['status' => 'success', 'message' => 'Your request has been processed successfully.']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
            exit;
        }
    }

    public function saveDisbursementStatus(Request $request)
    {
        $isValidated = AppServiceProvider::validatePermission('loan-send-for-approval');

        $userId = $request->userId;
        $loanId = $request->loanId;
        $status = $request->status;
        $remark = $request->remark;
        $statusText = '';
        if ($status == 1) {
            $statusText = 'approved';
        } else if ($status == 2) {
            $statusText = 'rejected';
        }

        //$userUp=User::where('id',$userId)->update(['disbursementStatus'=>$statusText]);
        $userUp = ApplyLoanHistory::where('id', $loanId)->update(['status' => $statusText]);
        if ($status == 2 && $remark) {
            $obj = new UserActivityHistory();
            $obj->userId = $userId;
            $obj->type = 'disbursement';
            $obj->remark = $remark;
            $obj->save();
        }

        if ($userUp) {
            echo json_encode(['status' => 'success', 'message' => 'Your request has been processed successfully.']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
            exit;
        }
    }

    public function scheduleLoanDisburse(Request $request)
    {
        $isValidated = AppServiceProvider::validatePermission('schedule-disbursement');
        $userId = $request->userId;
        $loanId = $request->loanId;
        $productId = $request->productId;

        $userDtl = User::getUserDetailsById($userId);
        if (empty($userDtl)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid Request, Please try again.']);
            exit;
        }
        $loanDetails = ApplyLoanHistory::where('id', $loanId)->first();
        $loanCategory = Category::where('id',$loanDetails->loanCategory)->first()->name;
        $disburseDate = date('Y-m-d', strtotime($request->disburseDate));
        $includeExtraDaysData = $request->includeExtraDaysData;
        if ($includeExtraDaysData == 1) {
            $disbursementAmount =  $loanDetails->disbursementAmount - $loanDetails->extraIntrestAmount;
        } else {
            $disbursementAmount =  $loanDetails->disbursementAmount;
        }
        $save = ApplyLoanHistory::where('id', $loanId)->update(['status' => 'disburse-scheduled', 'disbursedDate' => $disburseDate, 'include_extradays' => $includeExtraDaysData, 'disbursementAmount' => $disbursementAmount]);
        
        
        if ($save) {
            

            echo json_encode(['status' => 'success', 'message' => 'Disbursement has been scheduled successfully.']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
            exit;
        }
    }



    public function closeLoanAllTime(Request $request)
    {

        if ($request->loanId) {
            $loanPendingCount = LoanEmiDetail::where(['loanId' => $request->loanId, 'status' => 'pending'])->count() ?? 0;
            if ($loanPendingCount == 0) {
                ApplyLoanHistory::where('id', $request->loanId)->update(['status' => 'closed','closed_date'=>$request->closed_date]);
                return json_encode(['status' => 'success', 'message' => 'Loan Closed Successfully.']);
            }
        } else {
            return json_encode(['status' => 'error', 'message' => 'Please check EMI card of this loan some payment is still in pending.']);
        }
    }

    public function markLoanAsClosedOnPreCloser(Request $request)
    {
        $loanId = $request->loanId;
        $userId = $request->userId;
        $closerPayMode = $request->closerPayMode;
        $closerTxnId = $request->closerTxnId;
        $closerRemark = $request->closerRemark;
        $closeType = $request->closeType;
        $transactionDate = ($request->transactionDate) ? date('Y-m-d', strtotime($request->transactionDate)) : '';
        if ($closeType == 'with-charges') {
            $totalCalcArr = json_decode($request->totalCalcStr);
            $isWithCharges = 1;
        } else if ($closeType == 'with-out-charge') {
            $totalCalcArr = json_decode($request->totalCalcStrWc);
            $isWithCharges = 0;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request, Please try again.']);
            exit;
        }

        $currentDate = date('Y-m-d H:i:s');
        $saveArr['userId'] = $userId;
        $saveArr['loanId'] = $loanId;
        $saveArr['isWithCharges'] = $isWithCharges;
        $saveArr['principleDeposit'] = $totalCalcArr->totalPinnciple;
        $saveArr['posChargePercentage'] = $totalCalcArr->foreCloserPercent;
        $saveArr['posChargeAmount'] = $totalCalcArr->foreCloserAmount;
        $saveArr['gstPercentage'] = $totalCalcArr->gstPercentOnForeCloser;
        $saveArr['gstAmount'] = $totalCalcArr->gstAmountOnForeCloser;
        $saveArr['totalPreCloserAmount'] = $totalCalcArr->totalForeCloser;
        $saveArr['totalPaybleAmount'] = $totalCalcArr->totalPaybleAmt;
        $saveArr['paymentMode'] = $closerPayMode;
        $saveArr['txnId'] = $closerTxnId;
        $saveArr['remark'] = $closerRemark;
        $saveArr['transactionDate'] = $transactionDate;

        $saveArr['created_at'] = $currentDate;
        $saveArr['updated_at'] = $currentDate;

        $preCloserId = DB::table('loan_pre_closer_histories')->insertGetId($saveArr);
        $saved0 = ApplyLoanHistory::where('id', $loanId)->update(['isPreClosed' => 1, 'status' => 'closed', 'preCloserId' => $preCloserId]);
        $saved = LoanEmiDetail::where('loanId', $loanId)->where('status', 'pending')->update(['preCloserId' => $preCloserId, 'status' => 'success', 'transactionId' => $closerTxnId, 'payment_mode' => $closerPayMode, 'remark' => $closerRemark, 'transactionDate' => $transactionDate]);

        if ($preCloserId && $saved && $saved0) {
            echo json_encode(['status' => 'success', 'message' => 'Loan has been closed successfully.']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unable to process your request, Please try again.']);
            exit;
        }
    }

    // TODO Recived Emi Table
    public function filterUsersListsOther(Request $request)
    {
        $customSearch = $request->customSearch;
        $fromDate = (strtotime($request->fromDate)) ? date('Y-m-d', strtotime($request->fromDate)) : '';
        $toDate = (strtotime($request->toDate)) ? date('Y-m-d', strtotime($request->toDate)) : '';
        $userStatus = $request->userStatus;

        $pageNameStr = $request->pageNameStr;

        $currentDate = date('Y-m-d');
        $month = date('m');
        $year = date('Y');

        // 3=>Raw Material Financing
        $SUBQRY = "";
        $EXSUBQRY = "";
        if ($pageNameStr != 'all-loan-list') {
            $EXSUBQRY = " AND alh.id !='3'";
            $SUBQRY = " AND u.kycStatus='approved' AND eh.status='approved' ";
        }

        if ($pageNameStr == 'today-disbursement') {
            $SUBQRY .= " AND alh.status='disburse-scheduled' AND date(alh.disbursedDate)='$currentDate' $EXSUBQRY";
        } else if ($pageNameStr == 'pending-disbursement') {
            $SUBQRY .= "  AND alh.status='disburse-scheduled' $EXSUBQRY";
        } else if ($pageNameStr == 'loan-disbursed') {
            $SUBQRY .= " AND alh.status='disbursed'";
        } else if ($pageNameStr == 'all-loan-list') {
            if ($fromDate && $toDate) {
                $SUBQRY .= "  AND date(alh.disbursedDate)>='$fromDate' AND date(alh.disbursedDate)<='$toDate' ";
            }
            if ($request->loanType) {
                $loanTypes = $request->loanType;
                $SUBQRY .= "  AND alh.loanCategory='$loanTypes'";
            }
        } else if ($pageNameStr == 'customer-emi') {
            $SUBQRY .= " AND alh.status='disbursed' AND MONTH(ed.emiDate)='$month' AND YEAR(ed.emiDate)='$year' AND ed.status='success' AND ed.id IS NOT NULL  $EXSUBQRY";
        } else if ($pageNameStr == 'today-emi') {

            if ($fromDate && $toDate) {

                $SUBQRY .= " AND alh.status='disbursed' AND date(ed.emiDate)>='$fromDate' AND  date(ed.emiDate)<='$toDate' AND ed.status = 'pending' AND ed.id IS NOT NULL $EXSUBQRY";
            } else {
                if (date('d') > 4 && date('d') < 13) {
                    $startdatetime = new DateTime();
                    $enddatetime = new DateTime();
                    $startdatetime->setDate(date('Y'), date('m'), 05);
                    $enddatetime->setDate(date('Y'), date('m'), 12);
                    $sdate = $startdatetime->format('Y-m-d');
                    $edate = $enddatetime->format('Y-m-d');
                    $SUBQRY .= " AND alh.status='disbursed' AND date(ed.emiDate) BETWEEN '$sdate' AND '$edate'  AND MONTH(ed.emiDate)='$month' AND YEAR(ed.emiDate)='$year' AND ed.status = 'pending'  $EXSUBQRY";
                } else {
                    $SUBQRY .= " AND alh.status='disburseded'";
                }
            }
        } else if ($pageNameStr == 'over-due-emi') {

            if ($fromDate && $toDate) {
                $SUBQRY .= " AND alh.status='disbursed' AND date(ed.emiDueDate)>date('$fromDate') AND  date(ed.emiDueDate)<=date('$toDate') AND ed.status = 'pending' AND ed.id IS NOT NULL $EXSUBQRY";
            } else {
                // if(date('d') > 12){
                $lateDueEmi = date("Y-m-d");
                // }else{
                //     $lateDueEmi = date("Y-m-d", strtotime("-1 months"));
                // }
                $SUBQRY .= " AND alh.status='disbursed' AND date(ed.emiDueDate)<date('$lateDueEmi') AND ed.status = 'pending'  $EXSUBQRY";
            }
        } else if ($pageNameStr == 'closed-loans') {
            $SUBQRY .= " AND alh.status='closed'";
        } else if ($pageNameStr == 'noc-issued') {
            $SUBQRY .= " AND alh.status='disbursed' AND alh.status='noc-issued'";
        } else if ($pageNameStr == 'received-emi') {

            if ($fromDate && $toDate) {
                $SUBQRY .= "  AND (alh.loanCategory != 3 AND alh.status='disbursed' AND ed.userId = alh.userId AND ed.status='success' AND date(ed.transactionDate)>='$fromDate' AND date(ed.transactionDate)<='$toDate' ) OR (alh.loanCategory=3 AND alh.id IN (SELECT rmtd.loanId FROM raw_materials_txn_details AS rmtd WHERE rmtd.loanId = alh.id AND rmtd.txnType ='in' AND date(rmtd.transactionDate)>='$fromDate' AND date(rmtd.transactionDate)<='$toDate' )) ";
            } else {
                $SUBQRY .= "  AND (alh.loanCategory != 3 AND alh.status='disbursed' AND ed.userId = alh.userId AND ed.status='success' AND date(ed.transactionDate)='$currentDate') OR (alh.loanCategory=3 AND alh.id IN (SELECT rmtd.loanId FROM raw_materials_txn_details AS rmtd WHERE rmtd.loanId = alh.id AND rmtd.txnType ='in' AND date(rmtd.transactionDate)='$currentDate')) ";
            }
        }

        if ($userStatus == 1 || $userStatus == 0) {
            $SUBQRY .= " AND u.status='$userStatus'";
        }

        if (!in_array($pageNameStr, array('all-loan-list', 'received-emi', 'today-emi', 'over-due-emi')) && $fromDate && $toDate) {
            $SUBQRY .= " AND date(u.created_at)>='$fromDate' AND date(u.created_at)<='$toDate'";
        }

        if ($customSearch) {
            $SUBQRY .= " AND (u.customerCode LIKE '%$customSearch%' OR u.name LIKE '%$customSearch%' OR u.email LIKE '%$customSearch%' OR u.mobile LIKE '%$customSearch%')";
        }
        // echo $SUBQRY;
        $banks = Bank::where(['status' => 1])->orderBy('name', 'asc')->get();
        $userColumns = "u.id,u.customerCode,u.name,u.mobile,u.email,u.gender,u.profilePic,u.dateOfBirth,u.maritalStatus,u.addressLine1,u.addressLine2,u.city,u.state,u.district,u.pincode,u.userMpin,u.aadhaar_no,u.pancard_no,u.userType,u.status,u.kycStatus,u.created_at,u.updated_at,alh.disbursedDate,alh.loanCategory";
        if ($pageNameStr == 'all-loan-list') {
            $customers = DB::select("SELECT $userColumns,alh.id as loanId,alh.bankId as loanFromBank,alh.isAdminApproved,alh.reject_reason,alh.loanAmount appliedLoanAmount,alh.tenure as appliedTenure,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.approvedAmount,alh.status as loanStatus,alh.remark,p.productCode,p.productName,p.rateOfInterest as productROI,p.tenure as productTenure,p.amount as productAmount,p.amountTo as productAmountTo,p.numOfEmi as productEMI,p.productType,c.name as categoryName,sc.name as subCategoryName FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN  employment_histories eh ON u.id=eh.userId LEFT JOIN products p ON alh.productId=p.id LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN subcategories sc ON p.subCategoryId=sc.id WHERE u.userType='user' AND alh.id IS NOT NULL   $SUBQRY GROUP BY $userColumns,alh.id,alh.bankId,alh.loanAmount,alh.tenure,alh.rateOfInterest,alh.approvedAmount,alh.approvedAmount,alh.status,alh.remark,p.productCode,p.productName,p.rateOfInterest,p.tenure,p.amount,p.amountTo,p.numOfEmi,p.productType,c.name,sc.name ORDER BY u.id desc");
        } elseif ($pageNameStr == 'today-raw-disbursement') {
            $customers = DB::select("SELECT $userColumns,alh.id as loanId,alh.bankId as loanFromBank,rlr.isAdminApproved,rlr.reject_reason,alh.loanAmount appliedLoanAmount,alh.tenure as appliedTenure,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.approvedAmount,alh.remark,p.productCode,p.productName,p.rateOfInterest as productROI,p.tenure as productTenure,p.amount as productAmount,p.amountTo as productAmountTo,p.numOfEmi as productEMI,p.productType,c.name as categoryName,sc.name as subCategoryName,rlr.loanAmount,rlr.disburse_date AS disbursedDate,rlr.status as loanStatus,rlr.drawDownFormFile as rldrawDownFormFile,rlr.invoiceNumber as rlinvoiceNumber,rlr.invoiceFile as rlinvoiceFile,rlr.isAdminApproved FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN raw_materials_loan_requests rlr ON rlr.loanId=alh.id LEFT JOIN  employment_histories eh ON u.id=eh.userId LEFT JOIN products p ON alh.productId=p.id LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN subcategories sc ON p.subCategoryId=sc.id WHERE u.userType='user' AND rlr.status='disburse-scheduled'  $SUBQRY GROUP BY $userColumns,alh.id,alh.bankId,alh.loanAmount,alh.tenure,alh.rateOfInterest,alh.approvedAmount,alh.approvedAmount,alh.status,alh.remark,p.productCode,p.productName,p.rateOfInterest,p.tenure,p.amount,p.amountTo,p.numOfEmi,p.productType,c.name,sc.name ORDER BY u.id desc");
            //echo "SELECT $userColumns,alh.id as loanId,alh.bankId as loanFromBank,alh.loanAmount appliedLoanAmount,alh.tenure as appliedTenure,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.approvedAmount,alh.remark,p.productCode,p.productName,p.rateOfInterest as productROI,p.tenure as productTenure,p.amount as productAmount,p.amountTo as productAmountTo,p.numOfEmi as productEMI,p.productType,c.name as categoryName,sc.name as subCategoryName,rlr.loanAmount,rlr.disburse_date AS disbursedDate,rlr.status as loanStatus,rlr.drawDownFormFile as rldrawDownFormFile,rlr.invoiceNumber as rlinvoiceNumber,rlr.invoiceFile as rlinvoiceFile FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN raw_materials_loan_requests rlr ON rlr.loanId=alh.id LEFT JOIN  employment_histories eh ON u.id=eh.userId LEFT JOIN products p ON alh.productId=p.id LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN subcategories sc ON p.subCategoryId=sc.id WHERE u.userType='user' AND rlr.status='disburse-scheduled'  $SUBQRY GROUP BY $userColumns,alh.id,alh.bankId,alh.loanAmount,alh.tenure,alh.rateOfInterest,alh.approvedAmount,alh.approvedAmount,alh.status,alh.remark,p.productCode,p.productName,p.rateOfInterest,p.tenure,p.amount,p.amountTo,p.numOfEmi,p.productType,c.name,sc.name ORDER BY u.id desc";
        } else {
            $customers = DB::select("SELECT $userColumns,alh.id as loanId,alh.bankId as loanFromBank,alh.isAdminApproved,alh.reject_reason,alh.loanAmount appliedLoanAmount,alh.tenure as appliedTenure,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.approvedAmount,alh.status as loanStatus,alh.remark,p.productCode,p.productName,p.rateOfInterest as productROI,p.tenure as productTenure,p.amount as productAmount,p.amountTo as productAmountTo,p.numOfEmi as productEMI,p.productType,c.name as categoryName,sc.name as subCategoryName,alh.isAdminApproved FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN  employment_histories eh ON u.id=eh.userId LEFT JOIN products p ON alh.productId=p.id LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN subcategories sc ON p.subCategoryId=sc.id LEFT JOIN loan_emi_details ed ON alh.id=ed.loanId WHERE u.userType='user'  $SUBQRY GROUP BY $userColumns,alh.id,alh.bankId,alh.loanAmount,alh.tenure,alh.rateOfInterest,alh.approvedAmount,alh.approvedAmount,alh.status,alh.remark,p.productCode,p.productName,p.rateOfInterest,p.tenure,p.amount,p.amountTo,p.numOfEmi,p.productType,c.name,sc.name ORDER BY u.id desc");
        }


        $TBLLTHCLS = 'whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
        $htmlStr = '<table id="mainTbl" class="is-hoverable w-full text-left">
            <thead>
              <tr>
                <th ' . $TBLLTHCLS . '>Profile </th>
                <th ' . $TBLLTHCLS . '>Cust. ID </th>';
        if ($pageNameStr == 'closed-loans' || $pageNameStr == 'all-loan-list' || $pageNameStr == 'pending-disbursement' || $pageNameStr == 'today-raw-disbursement' || $pageNameStr == 'today-disbursement') {
            $htmlStr .= '<th ' . $TBLLTHCLS . '>Loan ID</th>';
        }
        $htmlStr .= '<th ' . $TBLLTHCLS . '>Name</th>
                <th ' . $TBLLTHCLS . '>Email</th>
                <th ' . $TBLLTHCLS . '>Mobile No.</th>
                <th ' . $TBLLTHCLS . '>Loan Type</th>';
        if ($pageNameStr == 'all-loan-list' || $pageNameStr == 'pending-disbursement' || $pageNameStr == 'today-raw-disbursement' || $pageNameStr=='today-disbursement') {
            if($pageNameStr=='today-raw-disbursement'){
                $htmlStr .= '<th ' . $TBLLTHCLS . '>Request Amount</th>';
            }
            $htmlStr .= '<th ' . $TBLLTHCLS . '>Disbursed Date</th>
            <th ' . $TBLLTHCLS . '>Admin Approve</th>';
        } else {
            $htmlStr .= '<th ' . $TBLLTHCLS . '>Date</th>';
        }

        $htmlStr .= '<th ' . $TBLLTHCLS . '>Status</th>
                <th ' . $TBLLTHCLS . '>Action</th>
              </tr>
            </thead>
            <tbody>';
        if (count($customers)) {
            foreach ($customers as $crow) {

                if ($crow->profilePic) {
                    $profilePic = env('APP_URL') . 'public/' . $crow->profilePic;
                } else {
                    $profilePic = 'https://media.istockphoto.com/vectors/male-face-silhouette-or-icon-man-avatar-profile-unknown-or-anonymous-vector-id1087531642?k=20&m=1087531642&s=612x612&w=0&h=D6OBNUY7ZxQTAHNVtL9mm2wbHb_dP6ogIsCCWCqiYQg=';
                }
                $isadminApprove = '<span class="badge badge-warning-light">Pending</span>';
                if ($pageNameStr == 'today-raw-disbursement' || $pageNameStr == 'pending-disbursement' || $pageNameStr == 'all-loan-list' || $pageNameStr=='today-disbursement') {
                        if($crow->isAdminApproved == 'approved'){
                            $isadminApprove = '<span class="badge badge-success-light">Approved</span>';
                        }else if($crow->isAdminApproved == 'rejected'){
                            $isadminApprove = '<span data-bs-toggle="tooltip" data-bs-placement="top" onclick="alert(\'Rejected Reason : '.$crow->reject_reason.'\')" class="badge bg-danger">Rejected</span>';
                        }else if($crow->isAdminApproved == 'need update'){
                            $isadminApprove = '<span data-bs-toggle="tooltip" data-bs-placement="top" onclick="alert(\'Need Update : '.$crow->reject_reason.'\')" class="badge bg-danger">Need Update</span>';
                        }
                    $createdDate = (strtotime($crow->disbursedDate)) ? date('d/m/Y', strtotime($crow->disbursedDate)) : 'N/A';
                } else {
                    $createdDate = (strtotime($crow->created_at)) ? date('d/m/Y', strtotime($crow->created_at)) : '';
                }
                $htmlStr .= ' <tr>

                                <td class="">
                                    <img src="' . $profilePic . '" style="height: 50px;width: 50px;object-fit: contain;" alt="image">
                                </td>
                                <td>' . $crow->customerCode . '</td>';
                if ($pageNameStr == 'closed-loans' || $pageNameStr == 'all-loan-list' || $pageNameStr == 'pending-disbursement' || $pageNameStr == 'today-raw-disbursement' || $pageNameStr=='today-disbursement') {
                    $htmlStr .= '<td>LF0' . $crow->loanId . '</td>';
                }
                $htmlStr .= '<td>' . $crow->name . '</td>
                                <td>' . $crow->email . '</td>
                                <td>' . $crow->mobile . '</td>
                                <td>' . $crow->categoryName . '</td>';
                                if($pageNameStr=='today-raw-disbursement'){
                                    $htmlStr .= '<td >' . $crow->loanAmount . '</td>';
                                }

                $htmlStr .= '<td>' . $createdDate . '</td>';
                if($pageNameStr == 'all-loan-list' || $pageNameStr == 'pending-disbursement' || $pageNameStr == 'today-raw-disbursement'){
                    $htmlStr .= '<td>' . $isadminApprove . '</td>';
                }

                $htmlStr .= '<td>';
                $loanStatus = ucwords(str_replace('-',' ',$crow->loanStatus));

                if($loanStatus == 'Disbursed' || ($loanStatus == 'Customer Approved' && $crow->loanCategory == 3)){
                    $htmlStr .= '<span class="badge bg-success">'.$loanStatus.'</span>';
                }else if ($loanStatus == 'Disburse Scheduled' || $loanStatus == 'Customer Approved') {
                    $htmlStr .= '<span class="badge bg-warning">'.$loanStatus.'</span>';
                } else {
                    $htmlStr .= '<span class="badge bg-info">'.$loanStatus.'</span>';
                }

                $htmlStr .= '</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="' . route('profileDetails', [$pageNameStr, $crow->id]) . '" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"><i data-feather="eye" class="fa fa-eye text-primary"></i></a>';
                if ($crow->loanCategory == 3 && $crow->loanStatus == 'disburse-scheduled' && $crow->isAdminApproved == 'approved') {
                    $invoiceNumber = $crow->rlinvoiceNumber??'-';
                    $invoiceFile = $crow->rlinvoiceFile??'-';
                    $drawDownFormFile= $crow->rldrawDownFormFile??'-';
                    $htmlStr .= '&nbsp;&nbsp;<a href="javascript:;" onclick="disburseRawAmount(' . $crow->loanId . ',' . $crow->loanAmount . ',\''.$invoiceNumber .'\',\''. $invoiceFile.'\',\''.$drawDownFormFile.'\');" class="action-btns1 text-danger">Disburse Now </a>';
                } elseif ($crow->loanStatus == 'disburse-scheduled' && $crow->isAdminApproved == 'approved') {
                    $htmlStr .= '&nbsp;&nbsp;<a href="javascript:;" onclick="disburseAmount(' . $crow->loanId . ');" class="action-btns1 text-danger">Disburse Now </a>';
                }

                if ($crow->loanStatus == 'disbursed' || $crow->loanStatus == 'closed') {

                    $htmlStr .= '&nbsp; &nbsp;<a href="javascript:;" onclick="getLoanEmiDetails(' . $crow->loanId . ');"  class="action-btns1 text-info">EMI Card </a>';
                }
                if ($pageNameStr == 'closed-loans') {
                    $htmlStr .= '&nbsp; &nbsp;<a href="' . route('loan-noc', ['id' => $crow->loanId]) . '"  class="action-btns1 btn btn-primary">NOC </a>';
                }
                if ($crow->loanStatus != 'disburse-scheduled' && $crow->loanCategory == 3 && $crow->loanStatus == 'customer-approved') {
                    $htmlStr .= '<button onclick="return rewMaterialAppliedLoans(' . $crow->id . ');" class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                        <i class="fa fa-inr"></i>
                    </button>';
                }
                $htmlStr .= '</div>
                                </td>
                            </tr>';
            }
        }
        $htmlStr .= '</tbody>
          </table>';
        echo $htmlStr;
    }

    public function getUserEmploymentInfoForUpdate(Request $request)
    {
        $isValidated = AppServiceProvider::validatePermission('approve-reject-employment');
        $userId = $request->userId;
        $userEmploymentHistory = EmploymentHistory::where('userId', $userId)->where('fromAdmin', 0)->orderBy('id', 'desc')->first();
        $userEmploymentHistoryAdmin = EmploymentHistory::where('userId', $userId)->where('fromAdmin', 1)->orderBy('id', 'desc')->first();
        $htmlStr = '';
        if (!empty($userEmploymentHistory)) {
            $readonly = '';
            if (!empty($userEmploymentHistoryAdmin)) {
                $readonly = 'readonly';
            }
            $htmlStr .= '<div class="row">
                <div class="col-lg-12">
                    <div class="details_listview">
                        <ul>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Employer Name:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->employerName . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="ememployerName" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Date of Joining:</label>
                                    <p class="text-muted">' . date('d/m/Y', strtotime($userEmploymentHistory->joiningDate)) . '</p>
                                    <p class="text-muted"><input type="date" style="width: 190px;" ' . $readonly . ' id="emjoiningDate" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Employee ID:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->employeeId . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="ememployeeId" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Type:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->type . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="emtype" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Designation:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->designation . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="emdesignation" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Department:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->department . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="emdepartment" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Gross Salary - PA:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->grossSalery . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="emgrossSalery" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                             <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Email ID:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->emailId . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="ememailId" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Phone Number:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->mobileNo . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="emmobileNo" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Address:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->address . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="emaddress" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">District:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->district . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="emdistrict" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">State:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->state . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="emstate" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">PinCode:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->pincode . '</p>
                                    <p class="text-muted"><input type="text" onkeypress="javascript:return isNumber(event)" ' . $readonly . ' id="empincode" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Experience in Current Company:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->experienceInCurrentCompany . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' id="emexperienceInCurrentCompany" class="form-control" placeholder=""> </p>
                                </div>
                                </li>
                        </ul>
                    </div>
                </div></div>';
        }

        if ($htmlStr) {
            echo json_encode(['status' => 'success', 'message' => 'Employment Details.', 'data' => $htmlStr]);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unable to process your request, Please try again.']);
            exit;
        }
    }

    public function getUserEmploymentInfoWithAdminUpdates(Request $request)
    {
        $isValidated = AppServiceProvider::validatePermission('approve-reject-employment');
        $userId = $request->userId;
        $userEmploymentHistory = EmploymentHistory::where('userId', $userId)->where('fromAdmin', 0)->orderBy('id', 'desc')->first();
        $userEmploymentHistoryAdmin = EmploymentHistory::where('userId', $userId)->where('fromAdmin', 1)->orderBy('id', 'desc')->first();
        $htmlStr = '';
        if (!empty($userEmploymentHistory)) {
            $readonly = '';
            if (!empty($userEmploymentHistoryAdmin)) {
                $readonly = 'readonly';
            }
            $htmlStr .= '<div class="row">
                <div class="col-lg-12">
                    <div class="details_listview">
                        <ul>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Employer Name:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->employerName . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->employerName . '" id="ememployerName" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Date of Joining:</label>
                                    <p class="text-muted">' . date('d/m/Y', strtotime($userEmploymentHistory->joiningDate)) . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->joiningDate . '" id="emjoiningDate" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Employee ID:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->employeeId . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->employeeId . '" id="ememployeeId" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Type:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->type . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->type . '" id="emtype" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Designation:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->designation . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->designation . '" id="emdesignation" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Department:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->department . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->department . '" id="emdepartment" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Gross Salary - PA:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->grossSalery . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->grossSalery . '" id="emgrossSalery" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                             <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Email ID:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->emailId . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->emailId . '" id="ememailId" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Phone Number:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->mobileNo . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->mobileNo . '" id="emmobileNo" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Address:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->address . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->address . '" id="emaddress" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">District:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->district . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->district . '" id="emdistrict" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">State:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->state . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->state . '" id="emstate" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">PinCode:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->pincode . '</p>
                                    <p class="text-muted"><input type="text" onkeypress="javascript:return isNumber(event)" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->pincode . '" id="empincode" class="form-control" placeholder=""> </p>
                                </div>
                            </li>
                            <li>
                                <div class="detail_flex">
                                    <label class="tx-11 fw-bolder mb-0 detail_title">Experience in Current Company:</label>
                                    <p class="text-muted">' . $userEmploymentHistory->experienceInCurrentCompany . '</p>
                                    <p class="text-muted"><input type="text" ' . $readonly . ' value="' . $userEmploymentHistoryAdmin->experienceInCurrentCompany . '" id="emexperienceInCurrentCompany" class="form-control" placeholder=""> </p>
                                </div>
                                </li>
                        </ul>
                    </div>
                </div></div>';
        }

        if ($htmlStr) {
            echo json_encode(['status' => 'success', 'message' => 'Employment Details.', 'data' => $htmlStr]);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unable to process your request, Please try again.']);
            exit;
        }
    }

    public function employmentInfoForUpdate(Request $request)
    {
        $isValidated = AppServiceProvider::validatePermission('approve-reject-employment');

        $userId = $request->userId;
        $obj = new EmploymentHistory;
        $obj->userId = $userId;
        $obj->employerName = $request->employerName;
        $obj->joiningDate = $request->joiningDate;
        $obj->employeeId = $request->employeeId;
        $obj->type = $request->type;
        $obj->designation = $request->designation;
        $obj->department = $request->department;
        $obj->grossSalery = $request->grossSalery;
        $obj->emailId = $request->emailId;
        $obj->mobileNo = $request->mobileNo;
        $obj->address = $request->address;
        $obj->district = $request->district;
        $obj->state = $request->state;
        $obj->pincode = $request->pincode;
        $obj->fromAdmin = 1;
        $obj->status = 'approved';
        $obj->experienceInCurrentCompany = $request->experienceInCurrentCompany;
        $save = $obj->save();
        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Employment Details has been updated successfully.']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unable to process your request, Please try again.']);
            exit;
        }
    }

    public function getPersonalDiscussionDetailsWithAdminUpdate(Request $request)
    {
        $isValidated = AppServiceProvider::validatePermission('approve-reject-employment');
        $userId = $request->userId;
        $PDHistory = PersonalDiscussionOnCall::where('userId', $userId)->orderBy('id', 'desc')->first();
        $htmlStr = '';
        $residentialAddressFromHowTimeLiving = '';
        $presentAddressISParmanentAdd = '';
        $businessVintageProof = '';
        $businessDesctiotion = '';
        $hasABoardingOrOnboarding = '';
        $businessDetails = '';
        $businessPics = '';
        $kmBusinessHowLongFromBranch = '';
        $existingCustomer = '';
        $pdDoneBy = '';
        $pdDoneDate = '';
        $avgBankBalance = '';
        $creditSummation = '';
        $creditTransaction = '';
        $overAllStatus = '';
        if (!empty($PDHistory)) {
            $residentialAddressFromHowTimeLiving = $PDHistory->residentialAddressFromHowTimeLiving;
            $presentAddressISParmanentAdd = $PDHistory->presentAddressISParmanentAdd;
            $businessVintageProof = $PDHistory->businessVintageProof;
            $businessDesctiotion = $PDHistory->businessDesctiotion;
            $hasABoardingOrOnboarding = $PDHistory->hasABoardingOrOnboarding;
            $businessDetails = $PDHistory->businessDetails;
            $businessPics = $PDHistory->businessPics;
            $kmBusinessHowLongFromBranch = $PDHistory->kmBusinessHowLongFromBranch;
            $existingCustomer = $PDHistory->existingCustomer;
            $pdDoneBy = $PDHistory->pdDoneBy;
            $pdDoneDate = $PDHistory->pdDoneDate;
            $avgBankBalance = $PDHistory->avgBankBalance;
            $creditSummation = $PDHistory->creditSummation;
            $creditTransaction = $PDHistory->creditTransaction;
            $overAllStatus = $PDHistory->overAllStatus;
        }

        $businessVintageProofStr = '';
        if ($businessVintageProof) {
            $businessVintageProofStr = '<span style="font-size:10px;color:red;" ><a href="' . asset('public') . '/' . $businessVintageProof . '" target="_blank">Click To View</a></span>';
        }

        $businessPicsStr = '';
        if ($businessPics) {
            $businessPicsStr = '<span style="font-size:10px;color:red;" ><a href="' . asset('public') . '/' . $businessPics . '" target="_blank">Click  To View</a></span>';
        }

        $htmlStr .= ' <form id="personalDiscussionInfoFrm" method="POST" enctype="multipart/form-data">
                                ' . csrf_field() . '
                                    <input type="hidden" name="recordId" id="recordId" class="recordId" value="' . $userId . '">
                            <div class="mainfrm_box">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Confirm Residential Address from how long living</span>
                                        <input id="residentialAddressFromHowTimeLiving" name="residentialAddressFromHowTimeLiving" value="' . $residentialAddressFromHowTimeLiving . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder=" " type="text">
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Present address is a Permanent address Y/N</span>
                                        <input id="presentAddressISParmanentAdd" name="presentAddressISParmanentAdd" value="' . $presentAddressISParmanentAdd . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder=" " type="text">
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Business Vintage Proof ' . $businessVintageProofStr . '</span>
                                        <input id="businessVintageProof"  name="businessVintageProof" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                                    </label>
                                </div>


                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Business Description</span>
                                        <input id="businessDesctiotion" name="businessDesctiotion" value="' . $businessDesctiotion . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Has a hoarding/boarding</span>
                                        <input id="hasABoardingOrOnboarding" name="hasABoardingOrOnboarding" value="' . $hasABoardingOrOnboarding . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Business Details</span>
                                        <input id="businessDetails" name="businessDetails" value="' . $businessDetails . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Business Pics ' . $businessPicsStr . '</span>
                                        <input id="businessPics" name="businessPics" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Km Business how long from branch</span>
                                        <input id="kmBusinessHowLongFromBranch" name="kmBusinessHowLongFromBranch" value="' . $kmBusinessHowLongFromBranch . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Existing Customer Y/N</span>
                                        <input id="existingCustomer" name="existingCustomer" value="' . $existingCustomer . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>PD Done by</span>
                                        <input id="pdDoneBy"  name="pdDoneBy" value="' . $pdDoneBy . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="customdateinp">
                                        <span>PD Done Date</span>
                                        <input id="pdDoneDate" name="pdDoneDate" value="' . $pdDoneDate . '" x-flatpickr="" class="form-input mt-1.5 peer w-full rounded-lg border border-slate-300 bg-transparent py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input" placeholder="Choose date..." type="text" readonly="readonly">
                                        <div class="pointer-events-none absolute calender_iconinp flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent ">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Average Bank Balance</span>
                                        <input id="avgBankBalance" name="avgBankBalance" value="' . $avgBankBalance . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Credit summation</span>
                                        <input id="creditSummation" name="creditSummation" value="' . $creditSummation . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Credit transaction</span>
                                        <input id="creditTransaction" name="creditTransaction" value="' . $creditTransaction . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <label class="block">
                                        <span>Overall status : satisfactory and Non satisfactory</span>
                                        <input id="overAllStatus" name="overAllStatus" value="' . $overAllStatus . '" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="form-group text-right mar-b-0">
                            <button type="submit" name="personalDiscusstionBtn" id="personalDiscusstionBtn" class="btn btn-primary btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                Save
                            </button>
                        </div></form>';


        if ($htmlStr) {
            echo json_encode(['status' => 'success', 'message' => 'PD Details.', 'data' => $htmlStr]);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unable to process your request, Please try again.']);
            exit;
        }
    }

    public function savePersonalDiscussionInfo(Request $request)
    {
        $recordId = $request->recordId;


        $businessVintageProof = '';
        if (!empty($request->businessVintageProof)) {
            $businessVintageProof = AppServiceProvider::uploadImageCustom('businessVintageProof', 'personal-discussion-docs');
        }

        $businessPics = '';
        if (!empty($request->businessPics)) {
            $businessPics = AppServiceProvider::uploadImageCustom('businessPics', 'personal-discussion-docs');
        }
        $saveUp['userId'] = $recordId;
        $saveUp['residentialAddressFromHowTimeLiving'] = $request->residentialAddressFromHowTimeLiving;
        $saveUp['presentAddressISParmanentAdd'] = $request->presentAddressISParmanentAdd;

        if ($businessVintageProof) {
            $saveUp['businessVintageProof'] = $businessVintageProof;
        }

        $saveUp['businessDesctiotion'] = $request->businessDesctiotion;
        $saveUp['hasABoardingOrOnboarding'] = $request->hasABoardingOrOnboarding;
        $saveUp['businessDetails'] = $request->businessDetails;

        if ($businessPics) {
            $saveUp['businessPics'] = $businessPics;
        }

        $saveUp['kmBusinessHowLongFromBranch'] = $request->kmBusinessHowLongFromBranch;
        $saveUp['existingCustomer'] = $request->existingCustomer;
        $saveUp['pdDoneBy'] = $request->pdDoneBy;
        $saveUp['pdDoneDate'] = (strtotime($request->pdDoneDate)) ? date('Y-m-d', strtotime($request->pdDoneDate)) : NULL;
        $saveUp['avgBankBalance'] = $request->avgBankBalance;
        $saveUp['creditSummation'] = $request->creditSummation;
        $saveUp['creditTransaction'] = $request->creditTransaction;
        $saveUp['overAllStatus'] = $request->overAllStatus;

        $ifExist = PersonalDiscussionOnCall::where('userId', $recordId)->first();

        if (!empty($ifExist)) {
            $saveUp['updated_at'] = date('Y-m-d H:i:s');
            $save = PersonalDiscussionOnCall::where('userId', $recordId)->update($saveUp);
        } else {
            $saveUp['created_at'] = date('Y-m-d H:i:s');
            $saveUp['updated_at'] = date('Y-m-d H:i:s');
            $save = DB::table('personal_discussion_on_calls')->insertGetId($saveUp);
        }

        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Personal discussion details has been saved successfully.', 'userId' => (!$recordId) ? $save : '']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }



    public function saveDeviationInfo(Request $request)
    {
        $userId = $request->userId;

        $saveArr = [];
        $saveArr['userId'] = $request->userId;
        $saveArr['deviationLoanAmount'] = $request->deviationLoanAmount;
        $saveArr['deviationLoanAmountR'] = $request->deviationLoanAmountR;
        $saveArr['deviationLoanTenure'] = $request->deviationLoanTenure;
        $saveArr['deviationLoanTenureR'] = $request->deviationLoanTenureR;
        $saveArr['deviationNegativePD'] = $request->deviationNegativePD;
        $saveArr['deviationNegativePDR'] = $request->deviationNegativePDR;
        $saveArr['deviationNegativeCibil'] = $request->deviationNegativeCibil;
        $saveArr['deviationNegativeCibilR'] = $request->deviationNegativeCibilR;
        $saveArr['deviationNegativeCpvFI'] = $request->deviationNegativeCpvFI;
        $saveArr['deviationNegativeCpvFIR'] = $request->deviationNegativeCpvFIR;
        $saveArr['deviationNegativeEligibility'] = $request->deviationNegativeEligibility;
        $saveArr['deviationNegativeEligibilityR'] = $request->deviationNegativeEligibilityR;
        $saveArr['deviationNegativeProfile'] = $request->deviationNegativeProfile;
        $saveArr['deviationNegativeProfileR'] = $request->deviationNegativeProfileR;
        $saveArr['overAllDeviationRemark'] = $request->overAllDeviationRemark;

        $isExist = DeviationRecord::where(['userId' => $userId])->first();
        if (!empty($isExist)) {
            $saveArr['updated_at'] = date('Y-m-d H:i:s');
            DeviationRecord::where(['userId' => $userId])->update($saveArr);
            $save = 1;
        } else {
            $saveArr['created_at'] = date('Y-m-d H:i:s');
            $saveArr['updated_at'] = date('Y-m-d H:i:s');
            $save = DB::table('deviation_records')->insertGetId($saveArr);
        }

        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Deviation details has been saved successfully.']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
            exit;
        }
    }

    public function rejectForCustomerConsent(Request $request)
    {
        $rejectForCustomerConsentLoanId = $request->rejectForCustomerConsentLoanId;
        $rejectForCustomerConsentRemark = $request->rejectForCustomerConsentRemark;

        $loanData = ApplyLoanHistory::where('id', $rejectForCustomerConsentLoanId)->select('loanAmount', 'loanCategory', 'userId')->first();
        $purpose = Category::where('id', $loanData->loanCategory)->select('name')->first();
        $userData = User::where('id', $loanData->userId)->select('name', 'email', 'sourcePerson', 'sourcePersonNumber')->first();
        $employHis = EmploymentHistory::where('userId', $loanData->userId)->first();
        $verifyWith = env('APP_NAME');

        $commonHtml =   '<table style="width:100%;">
                    <tr>
                        <td> After reviewing your loan application id LF0' . $rejectForCustomerConsentLoanId . ' I regret to inform you that we are unable to loan you the requested ' . $loanData->loanAmount . ' for ' . $purpose->name . '</td>
                    </tr>
                    <tr>
                       <td> The reason for the denial is ' . $rejectForCustomerConsentRemark . '.</td>
                    </tr>
                    <tr>
                    <td>Thank you for thinking of our institution for your lending needs. Please don\'t hesitate to approach us in the future. Also, our lending officer ' . $userData->sourcePerson . ' would be happy to talk with you about other financing options. You can be reached at ' . $userData->sourcePersonNumber . '.</td>
                    </tr>
                    <tr>
                    
                    </tr>
                    </table>
                <div><br/><br/><br/></div></div>';

        $htmlStClient = '<div>
                <p>Dear ' . $userData->name . ',</p>' . $commonHtml;

        $htmlStAdmin = '<div>
                            <p>Dear Admin,</p><p>Client Name : ' . $userData->customerCode . '</p><p>Company Name : ' . $employHis->employerName . '</p>' . $commonHtml;

        AppServiceProvider::sendMail($userData->email, $userData->name, "Loan Rejected | " . $verifyWith, $htmlStClient);

        if (config('app.env') == "production") {
            $bccMail = config('mail.prodAdminMail');
            AppServiceProvider::sendMail("info@maxemocapital.com", "Info Maxemo", "Loan Rejected | " . $verifyWith, $htmlStAdmin,$bccMail);
        } else {
            $bccMail = config('mail.testMail');
            AppServiceProvider::sendMail("basant@techmavesoftware.com", "Raju", "Loan Rejected | " . $verifyWith, $htmlStAdmin,$bccMail);
        }

        $save = ApplyLoanHistory::where('id', $rejectForCustomerConsentLoanId)->update(['status' => 'rejected', 'remark' => $rejectForCustomerConsentRemark]);
        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Selected Loan has been rejected successfully.']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
            exit;
        }
    }

    public function getYearDiffInTwoDates($dob)
    {
        // Creates DateTime objects
        $datetime1 = date_create($dob);
        $datetime2 = date_create(date('Y-m-d'));

        // Calculates the difference between DateTime objects
        $interval = date_diff($datetime1, $datetime2);

        // Printing result in years & months format
        //echo $interval->format('%R%y years %m months');
        $years = $interval->format('%y');
        return $years;
    }

    public function getPaybleAmountBulletRepayment(Request $request)
    {
        $loanId = $request->loanId;
        $payment_date = (strtotime($request->bullet_repaymentCollectDate)) ? date('Y-m-d', strtotime($request->bullet_repaymentCollectDate)) : '';
        if ($loanId && $payment_date) {
            $totalInterest = 0;
            $totalPaybleAmount = 0;
            $tenureInMonth = 0;
            $loanDetails = ApplyLoanHistory::where('id', $loanId)->first();
            if (!empty($loanDetails)) {
                $disbursedDate = $loanDetails->disbursedDate;
                $approvedAmount = $loanDetails->approvedAmount;
                $approvedROI = $loanDetails->rateOfInterest;

                $datetime1 = date_create($disbursedDate);
                $datetime2 = date_create($payment_date);

                // Calculates the difference between DateTime objects
                $interval = date_diff($datetime1, $datetime2);

                // Display the result
                $numOfDays = $interval->format('%a');



                $oneYearInterest = ($approvedAmount * $approvedROI) / 100;
                $oneDayInterest = $oneYearInterest / 365;

                $totalInterest = $oneDayInterest * $numOfDays;
                $totalPaybleAmount = $approvedAmount + $totalInterest;
                $tenureInMonth = $numOfDays;
            }
            // $objComm=new CommonController();
            // $emisDetailsArr=$objComm->getBulletRepaymentEMi($approvedROI,$approvedAmount,$disbursedDate,$payment_date);

            if ($totalPaybleAmount > 0) {
                echo json_encode(['status' => 'success', 'message' => 'You request has been processed successfully.', 'totalPaybleAmount' => $totalPaybleAmount, 'totalInterest' => $totalInterest, 'tenureInDays' => $tenureInMonth]);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Required parameters missing, Please try again.']);
            exit;
        }
    }

    public function sattleBulletRepaymentTxn(Request $request)
    {
        $loanId = $request->loanId;
        $payment_date = (strtotime($request->bullet_repaymentCollectDate)) ? date('Y-m-d', strtotime($request->bullet_repaymentCollectDate)) : '';
        $transactionId = $request->transactionId;
        $payment_mode = $request->payment_mode;

        if ($loanId && $payment_date && $transactionId && $payment_mode) {

            $loanDetails = ApplyLoanHistory::where('id', $loanId)->first();
            if (!empty($loanDetails)) {
                $userId = $loanDetails->userId;
                $disbursedDate = $loanDetails->disbursedDate;
                $approvedAmount = $loanDetails->approvedAmount;
                $approvedROI = $loanDetails->rateOfInterest;
            }
            // $objComm=new CommonController();
            // $emisDetailsArr=$objComm->getBulletRepaymentEMi($approvedROI,$approvedAmount,$disbursedDate,$payment_date);

            // if(!empty($emisDetailsArr))
            // {
            // $totalPaybleAmount=$emisDetailsArr['totalPaybleAmount'];
            // $totalInterest=$emisDetailsArr['totalInterest'];
            // $tenureInMonth=$emisDetailsArr['tenureInMonth'];
            // $principleAmount=$emisDetailsArr['principleAmount'];


            // $emiArr['userId']=$userId;
            // $emiArr['loanId']=$loanId;
            // $emiArr['emiId']='EM'.$loanId.'01';
            // $emiArr['emiSr']=1;
            // $emiArr['emiAmount']=$totalPaybleAmount;
            // $emiArr['interest']=$totalInterest;
            // $emiArr['principle']=$principleAmount;
            // $emiArr['balance']=0;
            // $emiArr['emiDate']=$payment_date;
            // $emiArr['emiDueDate']=$payment_date;
            // $emiArr['transactionId']=$transactionId;
            // $emiArr['payment_mode']=$payment_mode;
            // $emiArr['transactionDate']=$payment_date;
            // $emiArr['status']='success';
            // $emiArr['created_at']=date('Y-m-d H:i:s');
            // $emiArr['updated_at']=date('Y-m-d H:i:s');
            // LoanEmiDetail::create($emiArr);
            $disbursedDate = $loanDetails->disbursedDate;
            $approvedAmount = $loanDetails->approvedAmount;
            $approvedROI = $loanDetails->rateOfInterest;

            $datetime1 = date_create($disbursedDate);
            $datetime2 = date_create($payment_date);

            // Calculates the difference between DateTime objects
            $interval = date_diff($datetime1, $datetime2);

            // Display the result
            $numOfDays = $interval->format('%a');



            $oneYearInterest = ($approvedAmount * $approvedROI) / 100;
            $oneDayInterest = $oneYearInterest / 365;

            $totalInterest = $oneDayInterest * $numOfDays;

            $emisDetailsStr = json_encode($request->all());

            $saved = ApplyLoanHistory::where('id', $loanId)->update(['status' => 'closed', 'totalInterest' => $totalInterest, 'emisDetailsStr' => $emisDetailsStr, 'closed_date' => $payment_date, 'remark' => 'Closed on ' . date('d M, Y', strtotime($payment_date))]);

            if ($saved) {
                echo json_encode(['status' => 'success', 'message' => 'You request has been processed successfully.']);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
                exit;
            }
            // }else{
            //     echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']); exit;
            // }

        } else {
            echo json_encode(['status' => 'error', 'message' => 'Required parameters missing, Please try again.']);
            exit;
        }
    }

    public function importusersByCSV(Request $request)
    {
        $data = array();
        //  file validation
        $request->validate([
            "userData" => "required",
        ]);

        $file = $request->file("userData");
        $csvData = file_get_contents($file);

        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);

        $leadData = [];
        foreach ($rows as $row) {

            if (isset($row[0])) {
                if ($row[0] != "") {

                    $row = array_combine($header, $row);

                    $customerEmail = $row['email'];
                    $customerPhone = $row['mobile'];
                    $emailAlreadyExist = 0;
                    $emailExist = DB::select("SELECT * FROM users WHERE email='$customerEmail'");
                    if (count($emailExist)) {
                        $emailAlreadyExist = 1;
                    }

                    $mobileAlreadyExist = 0;
                    $mobileExist = DB::select("SELECT * FROM users WHERE mobile='$customerPhone'");
                    if (count($mobileExist)) {
                        $mobileAlreadyExist = 1;
                    }

                    $dateOfBirth = (strtotime($request->dob)) ? date('Y-m-d', strtotime($request->dob)) : NULL;



                    // master lead data
                    $leadData = array(
                        "customerCode" => $this->generateCustomerCode(),
                        "nameTitle" => '',
                        "name" => $row['name'],
                        "mobile" => $customerPhone,
                        "email" => $customerEmail,
                        "password" => md5('maxemo@123'),
                        "gender" => $row['gender'],
                        "date_of_birth" => $dateOfBirth,
                        "maritalStatus" => $row['maritalstatus'],
                        "addressLine1" => $row['address1'],
                        "addressLine2" => $row['address2'],
                        "city" => $row['city'],
                        "state" => $row['state'],
                        "district" => $row['district'],
                        "pincode" => $row['pincode'],
                        "aadhaar_no" => $row['aadhaarnumber'],
                        "pancard_no" => $row['pannumber'],
                        "religion" => $row['religion'],
                        "educationStatus" => $row['educationStatus'],
                        "fatherName" => $row['fathername'],
                        "motherName" => $row['mothername'],
                        "sourcePerson" => $row['sourcePerson'],
                        "branchName" => $row['branchName'],
                        "cibilScore" => ($row['cibilscore']) ? $row['cibilscore'] : 0,
                        'status' => 1,
                        'kycStatus' => 'pending',
                        "branchName" => $row['branchName'],
                        'userType' => 'user',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                    if (!$mobileAlreadyExist && !$emailAlreadyExist) {
                        $saved = User::create($leadData);
                    }
                }
            }
        }

        if (!empty($saved)) {
            echo json_encode(["status" => 'success', "message" => 'Users added successfully.']);
            exit;
        } else {
            echo json_encode(["status" => 'error', "message" => 'Some error occured, Invalid data.']);
            exit;
        }
    }

    public function getProfileDetailsHtml(Request $request)
    {
        $userId = $request->userId;
        $actionType = $request->actionType;
        $pageNameStr = $request->pageNameStr;

        if ($actionType == 'customerinfo') {
            $this->getProfileDetailsHtmlCustomerInfo($userId, $pageNameStr);
        } else if ($actionType == 'coApplicantDetails') {
            $this->getProfileDetailsHtmlCoApplicantInfo($userId, $pageNameStr);
        } else if ($actionType == 'businessDetails') {
            $this->getProfileDetailsHtmlBusinessDetails($userId, $pageNameStr);
        } else if ($actionType == 'kycDetails') {
            $this->getProfileDetailsHtmlKycDetails($userId, $pageNameStr);
        } else if ($actionType == 'bankinfo') {
            $this->getProfileDetailsHtmlCustomerBankDetails($userId, $pageNameStr);
        } else if ($actionType == 'customerLoansList') {
            $this->getProfileDetailsHtmlCustomerLoanList($userId, $pageNameStr);
        } else if ($actionType == 'beureuReport') {
            $this->getProfileDetailsHtmlCustomerBeureuReport($userId, $pageNameStr);
        }
    }

    public function getProfileDetailsHtmlCustomerInfo($userId, $pageNameStr)
    {

        $userDtl = User::getUserDetailsById($userId);
?>
        <div class="tab-pane body active" id="customerInfo">
            <div class="tabform_mainb">
                <form action="">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Name Title: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->nameTitle : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Full Name: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->name : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Date of Birth: </label>
                                        <span><?= (strtotime($userDtl->dateOfBirth)) ? date('d/m/Y', strtotime($userDtl->dateOfBirth)) : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Gender: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->gender : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Marital Status: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->maritalStatus : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Religion: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->religion : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Education Status: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->educationStatus : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Father Name: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->fatherName : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Mother Name: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->motherName : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Cibil Score: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->cibilScore : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for="">Address: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->addressLine1 : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Address Optional: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->addressLine2 : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-5">


                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> City: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->city : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for="">District: </label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->district : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for="">State:</label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->state : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for="">PinCode:</label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->pincode : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for="">Aadhaar Number:</label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->aadhaar_no : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for="">PAN Number:</label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->pancard_no : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php if ($pageNameStr != 'customers-list' && $pageNameStr != 'rejected-customers' && $pageNameStr != 'employment-verification' && $pageNameStr != 'employment-verification-rejected') {  ?>
                                <div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group flex_col">
                                            <label for="">Personal Discussion:</label>
                                            <span>
                                                <a href="javascript:;" style="color:blue;font-weight: bold;" onclick="getPersonalDiscussionDetails(<?= $userDtl->id ?>);" class="">
                                                    Click Here
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for="">Source Person Name:</label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->sourcePerson : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for="">Source Person Mobile Number:</label>
                                        <span><?= (!empty($userDtl) && $userDtl->sourcePersonNumber) ? $userDtl->sourcePersonNumber : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for="">Branch Name:</label>
                                        <span><?= (!empty($userDtl)) ? $userDtl->branchName : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-8">&nbsp;</div>
                        <div class="col-md-4 viewPersonalDetails <?= ($userDtl->viewPersonalDetails) ? 'checkedDocs' : 'uncheckedDocs' ?>">
                            <input type="checkbox" class="docsCheck" <?= ($userDtl->viewPersonalDetails) ? 'checked disabled' : '' ?> userId="<?= $userDtl->id ?>" name="docsCheck" id="viewPersonalDetails" class="docsCheck" value="viewPersonalDetails"> Personal Details Checked
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
    }

    public function getProfileDetailsHtmlCoApplicantInfo($userId, $pageNameStr)
    {

        $coApplicantDtlARR = CoApplicantDetail::where('userId', $userId)->orderBy('id', 'asc')->get();

    ?>
        <div class="tab-pane body active" id="coApplicantDetails">
            <div class="tabform_mainb">
                <form action="">
                    <?php if (count($coApplicantDtlARR)) { ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="javascript:;" onclick="openCoApplicantModal();" style="background: red;color: #fff;padding: 5px;border-radius: 10px;font-size: 12px;">Add New Co-Applicant</a>
                            </div>
                        </div>
                        <?php foreach ($coApplicantDtlARR as $coApplicantDtl) { ?>
                            <div class="row mt-4">
                                <hr style="margin-bottom: 10px !important;">
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Name Title: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->nameTitleCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Full Name: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->customerNameCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Date of Birth: </label>
                                                <span><?= (strtotime($coApplicantDtl->dateOfBirthCoApp)) ? date('d/m/Y', strtotime($coApplicantDtl->dateOfBirthCoApp)) : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Gender: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->genderCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Marital Status: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->maritalStatusCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Religion: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->religionCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Education Status: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->educationStatusCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Father Name: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->fatherNameCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Mother Name: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->motherNameCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Relation With Applicant: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->relationWithApplicantCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Cibil Score: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->cibilScoreCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </form>
            </div>
        </div>
    <?php
    }

    public function getProfileDetailsHtmlBusinessDetails($userId, $pageNameStr)
    {
        $userDtl = User::getUserDetailsById($userId);
        $userEmploymentHistoryArr = EmploymentHistory::where('userId', $userId)->where('fromAdmin', 0)->orderBy('id', 'desc')->get();

        $verificationReviewDone = 0;
        if ($userDtl->viewKycDetails && $userDtl->viewPersonalDetails && $userDtl->viewBankDetails) {
            $verificationReviewDone = 1;
        }
    ?>
        <div class="tab-pane body active" id="businessDetails">
            <?php
            if (count($userEmploymentHistoryArr)) {
                foreach ($userEmploymentHistoryArr as $userEmploymentHistory) {
                    $isBusiness = $userEmploymentHistory->isBusiness;
            ?>
                    <div class="tabform_mainb my-3">
                        <?php if (!empty($userEmploymentHistory)) { ?>
                            <div class="row">
                                <div class="col-lg-12" style="text-align: center;background: #455298 !important;color: #fff;padding: 10px;margin-bottom: 6px;border-radius: 10px;">
                                    <?= ($isBusiness == 1) ? 'Business Details' : 'Company Details' ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for="">Company Name: </label>
                                                <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->employerName : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for="">Company Phone: </label>
                                                <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->mobileNo : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($isBusiness == 1) { ?>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for="">Telephone No.: </label>
                                                    <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyTeleNo : 'NA' ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for="">Fax No.: </label>
                                                    <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyFaxNo : 'NA' ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> GSTIN </label>
                                                    <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyGstin : 'NA' ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> Pan Number </label>
                                                    <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyPan : 'NA' ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> Total Experience In Current Company </label>
                                                    <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->totalExpInCurrentCompany : 'NA' ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> Current Salary </label>
                                                    <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->currentSalary : 'NA' ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Company Type </label>
                                                <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyType : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">

                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Address </label>
                                                <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->address : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> District </label>
                                                <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->district : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> State </label>
                                                <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->state : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Pincode </label>
                                                <span><?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->pincode : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($isBusiness == 1 && $pageNameStr != 'customers-list' && $pageNameStr != 'rejected-customers' && $pageNameStr != 'employment-verification' && $pageNameStr != 'employment-verification-rejected') {  ?>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> Cash Flow Analysis </label>
                                                    <span><a href="javascript:;" onclick="getUserCashFlowAnalysisDetailsByUser(<?= $userDtl->id ?>);" style="color: blue;font-weight: bold;">Click Here</a> </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                            <?php if ($pageNameStr == 'employment-verification' || $pageNameStr == 'employment-verification-rejected') { ?>
                                <div class="row">
                                    <div class="col-md-8">&nbsp;</div>
                                    <div class="col-md-4 mb-3 viewProfessionalDetails <?= ($userDtl->viewProfessionalDetails) ? 'checkedDocs' : 'uncheckedDocs' ?>">
                                        <input type="checkbox" class="docsCheck" <?= ($userDtl->viewProfessionalDetails) ? 'checked disabled' : '' ?> userId="<?= $userDtl->id ?>" name="docsCheck" id="viewProfessionalDetails" class="docsCheck" value="viewProfessionalDetails"> Professional Details Checked
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-12 row">
                                <div class="col-md-6">&nbsp;</div>
                                <?php if ($userEmploymentHistory->status == 'pending') { ?>
                                    <div class="col-md-3">
                                        <?php if ($verificationReviewDone) { ?>
                                            <a href="javascript:;" onclick="approveUserKyc(<?= $userDtl->id ?>,1,'<?= ($isBusiness == 1) ? 'business' : 'company' ?>');" class="btn btn-success btn-icon-text"> <i class="btn-icon-prepend" data-feather="check-square"></i> Send for <?= ($isBusiness == 1) ? 'business' : 'company' ?> verification </a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:;" onclick="approveUserKyc(<?= $userDtl->id ?>,2,'<?= ($isBusiness == 1) ? 'business' : 'company' ?>');" class="btn btn-danger btn-icon-text"> Reject for <?= ($isBusiness == 1) ? 'business' : 'company' ?> verification <i class="btn-icon-append" data-feather="x"></i></a>
                                    </div>
                                <?php } ?>

                                <div class="col-md-3">
                                    <?php if (!empty($userEmploymentHistory)) { ?>
                                        <?php if ($userEmploymentHistory->status == 'approved') { ?>
                                            <label class="btn btn-success btn-xs" style="float: right;cursor: default;"><?= ($isBusiness == 1) ? 'Business' : 'Company' ?> Approved </label>
                                        <?php } elseif ($userEmploymentHistory->status == 'rejected') { ?>
                                            <label class="btn btn-danger btn-xs" style="float: right;cursor: default;"><?= ($isBusiness == 1) ? 'Business' : 'Company' ?> Rejected </label>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
            <?php
                }
            }
            ?>

        </div>
    <?php
    }

    public function getProfileDetailsHtmlKycDetails($userId, $pageNameStr)
    {

        $userDtl = User::getUserDetailsById($userId);
        $userDocDtl = UserDoc::where('userId', $userId)->orderBy('id', 'desc')->first();
        $userDocDtlKyc = LoanKycOtherPendetail::where('userId', $userId)->orderBy('id', 'desc')->get();
        // dd($userDocDtlKyc);
        $otherKycDocs = OtherKycDoc::where('userId', $userId)->orderBy('id', 'ASC')->get();
    ?>
        <div class="tab-pane body active" id="kycDetails">
            <div class="tabform_mainb">
                <form action="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" id="orderList_header">
                                <div class="card-header  border-0">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1">Documents</h5>
                                        <div class="flex-shrink-0">
                                            <a href="javascript:;" onclick="sendSmsAlert('<?= $userId ?>','<?= $userDtl->mobile ?>','docs');" style="background: red;color: #fff;padding: 5px;border-radius: 10px;font-size: 12px;">Send KYC Docs Alert</a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <!--end col-->
                    </div>

                    <?php if (!empty($userDocDtl)) { ?>
                        <div class="row gallery-wrapper">
                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="document_title_type">Photo of Emp identity Card</div>
                                </div>
                                <div class="row">

                                    <div class="element-item  col-lg-6 col-sm-6">
                                        <?php if ($userDocDtl->idProofFront) { ?>
                                            <div class="gallery-box card">
                                                <div class="gallery-container">
                                                    <a class="image-popup" title="" target="_blank" href="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->idProofFront : '' ?>">
                                                        <img class="gallery-img img-fluid mx-auto" src="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->idProofFront : '' ?>" alt="">
                                                        <div class="gallery-overlay">
                                                            <h5 class="overlay-caption"></h5>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="box-content">
                                                    <div class="d-flex align-items-center mt-1">
                                                        <div class="flex-grow-1 text-muted">
                                                            <a target="_blank" href="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->idProofFront : '' ?>" class="text-body text-truncate">Front</a> :
                                                            <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> <?= (strtotime($userDocDtl->created_at)) ? date('M Y', strtotime($userDocDtl->created_at)) : 'NA' ?>
                                                            </button>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div class="d-flex gap-3">
                                                                <!-- <button type="button" style="background: #dc3545;" class="btn btn-sm btn-danger">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <!-- end col -->
                                    <div class="element-item  col-lg-6 col-sm-6 ">
                                        <div class="gallery-box card">
                                            <div class="gallery-container">
                                                <a class="image-popup" target="_blank" href="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->idProofBack : '' ?>" title="">
                                                    <img class="gallery-img img-fluid mx-auto" src="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->idProofBack : '' ?>" alt="">
                                                    <div class="gallery-overlay">
                                                        <h5 class="overlay-caption"></h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="box-content">
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="flex-grow-1 text-muted">
                                                        <a target="_blank" href="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->idProofBack : '' ?>" class="text-body text-truncate">Back</a> :
                                                        <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                            <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> <?= (strtotime($userDocDtl->created_at)) ? date('M Y', strtotime($userDocDtl->created_at)) : 'NA' ?>
                                                        </button>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="d-flex gap-3">

                                                            <!-- <button type="button" style="background: #dc3545;" class="btn btn-sm btn-danger">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="document_title_type">Photo of Pan Card</div>
                                </div>
                                <div class="row">
                                    <div class="element-item  col-lg-6 col-sm-6">
                                        <div class="gallery-box card">
                                            <div class="gallery-container">
                                                <a class="image-popup" title="" target="_blank" href="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->panCardFront : '' ?>">
                                                    <img class="gallery-img img-fluid mx-auto" src="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->panCardFront : '' ?>" alt="">
                                                    <div class="gallery-overlay">
                                                        <h5 class="overlay-caption"></h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="box-content">
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="flex-grow-1 text-muted">
                                                        <a href="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->panCardFront : '' ?>" target="_blank" class="text-body text-truncate">Front</a> :
                                                        <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                            <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> <?= (strtotime($userDocDtl->created_at)) ? date('M Y', strtotime($userDocDtl->created_at)) : 'NA' ?>
                                                        </button>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="d-flex gap-3">
                                                            <!-- <button type="button" style="background: #dc3545;" class="btn btn-sm btn-danger">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="element-item  col-lg-6 col-sm-6 ">
                                        &nbsp;
                                    </div>
                                    <!-- end col -->
                                </div>
                            </div>
                        </div>

                      <?php  if($userDocDtlKyc){ ?>
                        <div class="row gallery-wrapper mt-4">
                            
                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="document_title_type">Partner 1 Pancard</div>
                                </div>
                                <?php if(isset($userDocDtlKyc[0])){ ?>
                                <div class="row">
                                    <div class="element-item   col-12">
                                        <div class="gallery-box card">
                                            <div class="gallery-container">
                                                <a class="image-popup" title="" target="_blank" href="<?= (!empty($userDocDtlKyc[0])) ? env('APP_URL') . 'public/' . $userDocDtlKyc[0]->pancard_img : '' ?>">
                                                    <img class="gallery-img img-fluid mx-auto" style="width: 211px;" src="<?= (!empty($userDocDtlKyc[0])) ? env('APP_URL') . 'public/' . $userDocDtlKyc[0]->pancard_img : '' ?>" alt="">
                                                    <div class="gallery-overlay">
                                                        <h5 class="overlay-caption"></h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="box-content">
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="flex-grow-1 text-muted">
                                                        <a href="<?= (!empty($userDocDtlKyc[0])) ? env('APP_URL') . 'public/' . $userDocDtlKyc[0]->pancard_img : '' ?>" target="_blank" class="text-body text-truncate">Image</a> :
                                                        <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                            <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> <?= (strtotime($userDocDtlKyc[0]->created_at)) ? date('M Y', strtotime($userDocDtlKyc[0]->created_at)) : 'NA' ?>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }  ?>
                            </div>
                           
                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="document_title_type">Partner 2 Pancard</div>
                                </div>
                                <?php if(isset($userDocDtlKyc[1])){ ?>
                                <div class="row">
                                    <div class="element-item  col-lg-6 col-sm-6">
                                        <div class="gallery-box card">
                                            <div class="gallery-container">
                                                <a class="image-popup" title="" target="_blank" href="<?= (!empty($userDocDtlKyc[1])) ? env('APP_URL') . 'public/' . $userDocDtlKyc[1]->pancard_img : '' ?>">
                                                    <img class="gallery-img img-fluid mx-auto" style="width: 211px;" src="<?= (!empty($userDocDtlKyc[1])) ? env('APP_URL') . 'public/' . $userDocDtlKyc[1]->pancard_img : '' ?>" alt="">
                                                    <div class="gallery-overlay">
                                                        <h5 class="overlay-caption"></h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="box-content">
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="flex-grow-1 text-muted">
                                                        <a href="<?= (!empty($userDocDtlKyc[1])) ? env('APP_URL') . 'public/' . $userDocDtlKyc[1]->pancard_img : '' ?>" target="_blank" class="text-body text-truncate">Front</a> :
                                                        <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                            <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> <?= (strtotime($userDocDtlKyc[1]->created_at)) ? date('M Y', strtotime($userDocDtlKyc[1]->created_at)) : 'NA' ?>
                                                        </button>
                                                    </div>
                                                    <!-- <div class="flex-shrink-0">
                                                            <div class="d-flex gap-3">
                                                                <button type="button" style="background: #dc3545;" class="btn btn-sm btn-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    
                                    <!-- end col -->
                                </div>
                                <?php }else{ ?>

                                <?php } ?>
                            </div>

                        </div>
                        <?php } ?>

                        <div class="row gallery-wrapper mt-4">
                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="document_title_type">Photo of Address Proof</div>
                                </div>
                                <div class="row">
                                    <div class="element-item  col-lg-6 col-sm-6">
                                        <div class="gallery-box card">
                                            <div class="gallery-container">
                                                <a class="image-popup" title="" target="_blank" href="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->addressProofFront : '' ?>">
                                                    <img class="gallery-img img-fluid mx-auto" src="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->addressProofFront : '' ?>" alt="">
                                                    <div class="gallery-overlay">
                                                        <h5 class="overlay-caption"></h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="box-content">
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="flex-grow-1 text-muted">
                                                        <a href="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->addressProofFront : '' ?>" target="_blank" class="text-body text-truncate">Front</a> :
                                                        <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                            <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> <?= (strtotime($userDocDtl->created_at)) ? date('M Y', strtotime($userDocDtl->created_at)) : 'NA' ?>
                                                        </button>
                                                    </div>
                                                    <!-- <div class="flex-shrink-0">
                                                            <div class="d-flex gap-3">
                                                                <button type="button" style="background: #dc3545;" class="btn btn-sm btn-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="element-item  col-lg-6 col-sm-6 ">
                                        <div class="gallery-box card">
                                            <div class="gallery-container">
                                                <a class="image-popup" target="_blank" href="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->addressProofBack : '' ?>" title="">
                                                    <img class="gallery-img img-fluid mx-auto" src="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->addressProofBack : '' ?>" alt="">
                                                    <div class="gallery-overlay">
                                                        <h5 class="overlay-caption"></h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="box-content">
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="flex-grow-1 text-muted">
                                                        <a href="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->addressProofBack : '' ?>" target="_blank" class="text-body text-truncate">Back</a> :
                                                        <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                            <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> <?= (strtotime($userDocDtl->created_at)) ? date('M Y', strtotime($userDocDtl->created_at)) : 'NA' ?>
                                                        </button>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="d-flex gap-3">
                                                            <!-- <button type="button" style="background: #dc3545;" class="btn btn-sm btn-danger">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                            </div>




                            <!-- TODO Others Documnet View -->
                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="document_title_type">Others documents </div>
                                </div>
                                <?php if (count($otherKycDocs)) { ?>

                                    <?php foreach ($otherKycDocs as $otherRow) { ?>
                                        <div class="row mb-2" style="padding: 5px;">
                                            <div class="col-lg-6 col-sm-6"><?= $otherRow->title ?></div>
                                            <div class="col-lg-6 col-sm-6">
                                                <a class="btn btn-warning" title="" target="_blank" href="<?= (!empty($otherRow->docsUrl)) ? env('APP_URL') . 'public/' . $otherRow->docsUrl : '' ?>">
                                                    View Document
                                                </a>
                                                <button type="button" class="btn btn-danger" style="background: red;" onclick="deleteOtherDocuments('<?= $otherRow->id ?>')"> Delete</button>

                                            </div>
                                        </div>
                                    <?php } ?>
                            </div>
                        <?php } ?>
                        </div>


                        <div class="row gallery-wrapper mt-4">
                            <div class="col-lg-9">
                                <div class="col-lg-12">
                                    <div class="document_title_type">Photo/PDF of Bank Statement</div>
                                </div>
                                <div class="row">
                                    <?php
                                    $bankdoc = '';
                                    $bankAttachemet = '';
                                    if (!empty($userDocDtl->bankAttachemet)) {
                                        $bankAttachemetArr = explode('.', $userDocDtl->bankAttachemet);
                                        if (strtolower($bankAttachemetArr[1]) == 'pdf') {
                                            $fileviewpdf = env('APP_URL') . 'public/' . $userDocDtl->bankAttachemet;
                                            $lobObj = new GloadController();
                                            $bankEid = $userDocDtl->bank_entity_id;
                                            if (!$bankEid) {
                                                if (config('app.env') == "production") {
                                                    $lobObj->finboxurlPdfupload($fileviewpdf, $userDocDtl->userId, $userDocDtl->bankAttachemetPwd);
                                                }
                                                $bankEid = DB::table('user_docs')->where('userId', $userDocDtl->userId)->pluck('bank_entity_id')->first();
                                            }
                                            if (config('app.env') == "production") {
                                                $viewLink = $lobObj->finboxexcleReport($bankEid);
                                            } else {
                                                $viewLink =  null;
                                            }
                                            $bankdoc = 'pdf';

                                            $password_text = "";
                                            if ($userDocDtl->bankAttachemetPwd) {
                                                $password_text = '| Password : ' . $userDocDtl->bankAttachemetPwd;
                                            }

                                            $bankAttachemet = '<a href="' . $fileviewpdf . '" class="btn btn-danger" target="_blank">View PDF ' . $password_text . '</a>';
                                            if ($viewLink) {
                                                $bankAttachemet .= '<a href="' . $viewLink . '" class="btn btn-primary my-2" target="_blank">Download Bank Monthly Analysis Sheet</a>';
                                            } else {
                                                $bankAttachemet .= '<a href="#" onclick="location.reload()" class="btn btn-info my-2" >Load Bank Monthly Analysis Sheet</a>';
                                            }
                                        } else {
                                            $bankAttachemet = '<img class="gallery-img img-fluid mx-auto" src="' . env('APP_URL') . 'public/' . $userDocDtl->bankAttachemet . '" alt="">';
                                        }
                                    }
                                    ?>
                                    <div class="element-item  col-lg-9 col-sm-9">
                                        <div class="gallery-box card">
                                            <div class="gallery-container">
                                                <a class="image-popup" title="" target="_blank" href="<?= env('APP_URL') . 'public/' . $userDocDtl->bankAttachemet ?>">
                                                    <?= $bankAttachemet ?>
                                                    <div class="<?= ($bankdoc == 'pdf') ? '' : 'gallery-overlay' ?>">
                                                        <h5 class="overlay-caption"></h5>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="box-content">
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="flex-grow-1 text-muted">
                                                        <a href="<?= env('APP_URL') . 'public/' . $userDocDtl->bankAttachemet ?>" target="_blank" class="text-body text-truncate">Bank Statement</a> :
                                                        <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                            <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> <?= (strtotime($userDocDtl->created_at)) ? date('M Y', strtotime($userDocDtl->created_at)) : 'NA' ?>
                                                        </button>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="d-flex gap-3">

                                                            <!-- <button type="button" style="background: #dc3545;" class="btn btn-sm btn-danger">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row gallery-wrapper mt-4">
                            <div class="row col-lg-12 ">
                                <div class="col-md-9">&nbsp;</div>
                                <div class="col-md-3 viewKycDetails <?= ($userDtl->viewKycDetails) ? 'checkedDocs' : 'uncheckedDocs' ?>">
                                    <input type="checkbox" class="docsCheck" <?= ($userDtl->viewKycDetails) ? 'checked disabled' : '' ?> userId="<?= $userDtl->id ?>" name="docsCheck" id="viewKycDetails" class="docsCheck" value="viewKycDetails"> KYC Checked
                                </div>
                                <div class="col-md-6">&nbsp;</div>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    <?php
    }

    public function deleteOtherDocuments(Request $request)
    {
        if (OtherKycDoc::where('id', $request->docid)->delete()) {
            return array('status' => 'success', 'message' => 'Document Removed !');
        } else {
            return array('status' => 'error', 'message' => 'Something Went Wrong !');
        }
    }

    public function getProfileDetailsHtmlCustomerLoanList($userId, $pageNameStr)
    {
        $userDtl = User::getUserDetailsById($userId);
        $loanDetails = ApplyLoanHistory::getAllAppliedLoans($userId);
    ?>
        <div class="tab-pane body active" id="customerLoansList">
            <div class="tabform_mainb">
                <?php
                foreach ($loanDetails as $lrow) {
                    $todauYdate = date('Y-m-d');
                    $totalMonthPayAmount = DB::select("SELECT SUM(netemiAmount) AS tamount FROM loan_emi_details WHERE loanId=$lrow->id AND status='pending' AND emiDueDate <= date('$todauYdate')")[0]->tamount ?? 0;

                    $monthlyEmi = DB::select("SELECT netemiAmount FROM loan_emi_details WHERE loanId=$lrow->id AND status='pending' AND emiDueDate >= date('$todauYdate') AND emiDate <= date('$todauYdate')")[0] ?? 0;

                    $monthLoanApay = ($monthlyEmi && $monthlyEmi->netemiAmount) ? $monthlyEmi->netemiAmount : 0;

                    $loanPendingCount = LoanEmiDetail::where(['loanId' => $lrow->id, 'status' => 'pending'])->count() ?? 0;
                    $disburseDate = (strtotime($lrow->disbursedDate)) ? date('d M, Y', strtotime($lrow->disbursedDate)) : '';
                    $applyDate = (strtotime($lrow->created_at)) ? date('d M, Y', strtotime($lrow->created_at)) : '';
                    $loanAccountNumber = 'LF0' . $lrow->id;

                    $rawMaterialLoanAccountDetailsURL = route('rawMaterialLoanAccountDetails', $lrow->id);

                    $buttons = '';
                    $loanStatus = strtoupper($lrow->status);

                    $productNameStr = '';
                    if ($lrow->categoryName && $lrow->productName) {
                        $productNameStr = $lrow->categoryName . ' / ' . $lrow->productName;
                    } else if ($lrow->productName) {
                        $productNameStr = $lrow->productName;
                    } else if ($lrow->categoryName) {
                        $productNameStr = $lrow->categoryName;
                    }

                    $plateformFee = 0;
                    $insurance = 0;
                    $principleChargesDetailsArr = [];
                    if ($lrow->principleChargesDetails) {
                        $principleChargesDetailsArr = json_decode($lrow->principleChargesDetails, true);
                        $plateformFee = (isset($principleChargesDetailsArr['plateformFee'])) ? $principleChargesDetailsArr['plateformFee'] : 0;
                        $insurance = (isset($principleChargesDetailsArr['insurance'])) ? $principleChargesDetailsArr['insurance'] : 0;
                    }

                    $netDisbursementAmount = $lrow->disbursementAmount;
                    $roiType = AppServiceProvider::getROITypeHeading($lrow->roiType);

                    echo '<div class="row  my-3">
                            <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12 mr_removecol" >
                                    <div class="form-group flex_col" style="background-color: #e5e5e5;padding: 8px;border-radius: 3px;">
                                        <label for="" style="font-size:18px;"> Loan ID: </label>
                                        <span style="font-size:18px;">' . $loanAccountNumber . '</span>
                                    </div>
                                </div>
                            </div>
                            
                                ';
                    if ($lrow->loanCategory != 3) {
                        echo '<div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> ROI Type: </label>
                                                <span>' . $roiType . '</span>
                                            </div>
                                        </div>
                                    </div>';
                    }
                    echo '<div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group flex_col">
                                            <label for=""> Amount: </label>
                                            <span>' . $lrow->approvedAmount . '</span>
                                        </div>
                                    </div>
                                </div>';

                    echo '<div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Product Name: </label>
                                                <span>' . $productNameStr . '</span>
                                            </div>
                                        </div>
                                    </div>';

                    if ($lrow->loanCategory) {
                        echo '<div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Tenure : </label>
                                                        <span>' . $lrow->approvedTenureD . '</span>
                                                    </div>
                                                </div>
                                            </div>';
                    }
                    echo '<div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group flex_col">
                                            <label for="">Interest:</label>
                                            <span>' . $lrow->rateOfInterest . '%</span>
                                        </div>
                                    </div>
                                </div>
                            ';

                    if ($lrow->monthlyEMI && $lrow->loanCategory != 3) {
                        //     if($lrow->roiType=='quaterly_interest'){
                        //         $emiLabelMonth='Quarterly Emi';
                        //     }else if($lrow->roiType=='reducing_roi'){
                        //         $emiLabelMonth='Monthly EMI';
                        //     }else{
                        //         $emiLabelMonth='EMI';
                        //     }
                        // echo '<div class="row">
                        //     <div class="col-lg-12 mr_removecol">
                        //         <div class="form-group flex_col">
                        //             <label for="">'.$emiLabelMonth.' : </label>
                        //             <span>'.$lrow->monthlyEMI.'</span>
                        //         </div>
                        //     </div>
                        // </div>';
                        echo '<div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group flex_col">
                                            <label for=""> Total Interest : </label>
                                            <span>' . $lrow->totalInterest . '</span>
                                        </div>
                                    </div>
                                </div>';
                    }
                    if ($lrow->status == 'disburse-scheduled' || $lrow->status == 'disbursed') {
                        $disbursedDateLbl = ($lrow->status == 'disburse-scheduled') ? 'Disbursement Date' : 'Disbursed date';

                        echo '<div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> ' . $disbursedDateLbl . ' : </label>
                                                <span>' . date('d M, Y', strtotime($lrow->disbursedDate)) . '</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Extra Days : </label>
                                                <span>' . $lrow->extraAmountDays . '</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Extradays Amount : </label>
                                                <span>' . $lrow->extraIntrestAmount . '</span>
                                            </div>
                                        </div>
                                    </div>';
                    }

                    if ($lrow->isAdminApproved == "pending" || $lrow->isAdminApproved == "need update") {
                        if($lrow->isAdminApproved == "need update"){
                        echo '</div>
                        <div class="col-lg-4">
                        <div class="row ">
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for=""> Status: </label>
                                    <span  class="bg-warning" style="padding: 5px;border-radius: 10px;font-size: 12px;color: black;">Send For Super Admin Approval</span>
                                </div>
                            </div>
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for="">Admin Status: </label>
                                    <span  class="bg-info" style="padding: 5px;border-radius: 10px;font-size: 12px;color: black;">Need Updated</span>
                                </div>
                            </div>
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for="">Remark: </label>
                                    <span >'.$lrow->reject_reason.'</span>
                                </div>
                            </div>
                        </div>';
                        }else{
                            echo '</div>
                            <div class="col-lg-4">
                            <div class="row ">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group flex_col">
                                        <label for=""> Status: </label>
                                        <span  class="bg-warning" style="padding: 5px;border-radius: 10px;font-size: 12px;color: black;">Send For Super Admin Approval</span>
                                    </div>
                                </div>
                            </div>';
                        }
                    }else{
                    echo '</div>
                                <div class="col-lg-4">
                                <div class="row ">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group flex_col">
                                            <label for=""> Status: </label>
                                            <span  class="bg-warning" style="padding: 5px;border-radius: 10px;font-size: 12px;color: black;">' . strtoupper($lrow->status) . '</span>
                                        </div>
                                    </div>
                                </div>';
                    }
                                if($lrow->status == "closed"){
                                    echo '<div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group flex_col">
                                            <label for=""> Close Date : </label>
                                            <span>' . date('d/m/Y',strtotime($lrow->closed_date)) . '</span>
                                        </div>
                                    </div>
                                </div>';
                                }
                    if ($plateformFee) {
                        echo '<div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Plateform Fee : </label>
                                                <span>' . $plateformFee . '</span>
                                            </div>
                                        </div>
                                    </div>';
                    }

                    if ($insurance) {
                        echo '<div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Insurance Fee : </label>
                                                <span>' . $insurance . '</span>
                                            </div>
                                        </div>
                                    </div>';
                    }

                    if ($netDisbursementAmount && $lrow->loanCategory != 3) {
                        echo '<div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Net Disbursement Amount : </label>
                                                <span>' . number_format($netDisbursementAmount) . '</span>
                                            </div>
                                        </div>
                                    </div>';
                    }

                    if ($lrow->exclude_pfif && $lrow->exclude_pfif == "1") {

                        echo '<div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Include PF/Insurance Fee : </label>
                                                <span>Yes</span>
                                            </div>
                                        </div>
                                    </div>';
                    } else if ($plateformFee) {
                        echo '<div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group flex_col">
                                            <label for=""> Include PF/Insurance Fee : </label>
                                            <span>No</span>
                                        </div>
                                    </div>
                                </div>';
                    }

                    if ($lrow->include_extradays && $lrow->include_extradays == "1") {

                        echo '<div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group flex_col">
                                                <label for=""> Include Extradays : </label>
                                                <span>Yes</span>
                                            </div>
                                        </div>
                                    </div>';
                    } else if ($plateformFee) {
                        echo '<div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group flex_col">
                                            <label for=""> Include Extradays : </label>
                                            <span>No</span>
                                        </div>
                                    </div>
                                </div>';
                    }



                    if ($lrow->loanCategory == 4 || $lrow->loanCategory == 3) {
                        echo '<div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group flex_col">
                                            <label for="">Invoice:</label>
                                            <span><a href="' . asset('/') . 'public/' . $lrow->invoiceFile . '" target="_blank"><img src="' . asset('/') . 'public/' . $lrow->invoiceFile . '" style="width:100px; height: 100px;object-fit: contain;" /></a></span>
                                        </div>
                                    </div>
                                </div>';
                    }
                    echo '<!--<div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group flex_col">
                                            <label for=""> No of EMI: </label>
                                            <span>8</span>

                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        
                        
                        ';
                ?>

                    <div class="col-lg-12 mb-4" id="btnhistory">
                        <?php if ($lrow->status == 'disbursed') { ?>
                            <span><strong class="text-danger mr-2">Total Due Amount : <?php if ($lrow->roiType != 'bullet_repayment') {
                                                                                            echo $totalMonthPayAmount;
                                                                                        } else {
                                                                                            echo $lrow->approvedAmount;
                                                                                        } ?></strong></span>
                            <?php if ($lrow->roiType != 'bullet_repayment') { ?><span><strong class="text-info mr-2">Month Pay Amount : <?= $monthLoanApay ?></strong></span> <?php } ?>
                             <!-- <a class="btn btn-dark btn-sm" target="_blank" href="<?= route('sanctionCustomers',['id'=>$lrow->id]) ?>">Sanction Letter</a>  -->
                        <?php } ?>
                        <?php if ($lrow->loanCategory != 3 && $lrow->status == 'customer-approved') { ?>
                            <button type="button" onclick="getLoanDetailsForScheduleDisbursement(<?= $lrow->id ?>);" class="btn bg-warning btn-warning">Schedule Disburse</button>
                           
                        <?php } ?>
                        <?php if ($lrow->loanCategory == 3 && $lrow->status == 'customer-approved') { ?>
                            <button onclick="location.href='<?= $rawMaterialLoanAccountDetailsURL ?>'" Type="button" class="btn bg-success btn_import2 font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                                <i class="fa-solid fa-eye"></i>
                                View Loan History
                            </button>
                             <!-- <a class="btn btn-dark btn-sm" target="_blank" href="<?= route('sanctionCustomers',['id'=>$lrow->id]) ?>">Sanction Letter</a> -->
                        <?php } ?>
                        <?php if ($lrow->status == 'disbursed' || ($lrow->loanCategory == 3 && $lrow->status == 'customer-approved')) { ?>
                            <a href="javascript:;" onclick="disbursedDocumentUpload()" class="btn bg-primary  text-white" style="background-color:#0d6efd;">Disbursed Document Upload</a>
                        <?php } ?>
                        <?php if ($lrow->loanCategory != 3 && $lrow->status == 'disbursed' || $lrow->status == 'closed') { ?>
                            <a href="javascript:;" onclick="getLoanEmiDetails(<?= $lrow->id ?>);" class="btn bg-info btn-info text-white"><?php if ($lrow->roiType != 'bullet_repayment') { ?> EMI <?php } else { ?> Loan <?php } ?> Card</a>
                        <?php }
                        if ($loanPendingCount == 0 && $lrow->status == 'disbursed') { ?>
                            <?php if ($lrow->roiType != 'bullet_repayment') { ?> <a href="javascript:;" onclick="closeLoanAllTime(<?= $lrow->id ?>);" class="btn bg-danger btn-danger text-white">Close Loan</a> <?php } ?>
                        <?php } ?>
                        <?php if ($lrow->isAdminApproved == 'pending' || $lrow->isAdminApproved == 'need update') { ?>
                            <button onclick="initiateApplyLoanEditForAdminConsent(<?= $lrow->id ?>);" Type="submit" class="btn bg-warning btn-warning text-white">
                                <i class="fa fa-check"></i>
                                Send For Super Admin Consent
                            </button>
                        <?php }else if ($lrow->status == 'sent-for-admin-approval' || $lrow->isAdminApproved == 'rejected') { ?>
                            
                            <button onclick="rejectForCustomerConsent(<?= $lrow->id ?>);" Type="button" class="btn bg-danger btn-danger text-white">
                                <i class="fa fa-cancel"></i>
                                Reject For Customer Consent
                            </button>
                            <button onclick="initiateApplyLoanEditForCustomerConsent(<?= $lrow->id ?>);" Type="button" class="btn bg-warning btn-warning text-white">
                                <i class="fa fa-check"></i>
                                Send For Customer Consent
                            </button>
                        <?php } ?>
                    </div>
                    <?php if ($lrow->loanCategory == 3 && $lrow->status == 'customer-approved') { ?>
                        <?php $pendingDisbmentRequest = DB::table('raw_materials_loan_requests')->where(['loanId'=>$lrow->id,'status'=>'disburse-scheduled'])->first(); 
                        // dd($pendingDisbmentRequest);
                        if($pendingDisbmentRequest){
                        ?>
                        <div class="col-lg-12 card card-body mb-4" id="btnhistory" style="background: antiquewhite;">
                            <table class="w-full dataTable ">
                                <thead style="text-align:left;background: antiquewhite;" >
                                    <th>Request Amount</th>
                                    <th>Disburse Date</th>
                                    <th>Admin Approve</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                               <?php if($pendingDisbmentRequest->isAdminApproved == 'approved'){
                                            $isadminApprove = '<span class="badge bg-success">Approved</span>';
                                        }else if($pendingDisbmentRequest->isAdminApproved == 'rejected'){
                                            $isadminApprove = '<span data-bs-toggle="tooltip" data-bs-placement="top" onclick="alert(\'Rejected Reason : '.$pendingDisbmentRequest->reject_reason.'\')" class="badge bg-danger">Rejected</span>';
                                        }else if($pendingDisbmentRequest->isAdminApproved == 'need update'){
                                            $isadminApprove = '<span data-bs-toggle="tooltip" data-bs-placement="top" onclick="alert(\'Need Update : '.$pendingDisbmentRequest->reject_reason.'\')" class="badge bg-warning">Need Update</span>';
                                        }else{
                                            $isadminApprove = '<span class="badge bg-info">Pending</span>';
                                        } 
                                ?>
                                    <tr style="text-align:left;">
                                        <td><?= $pendingDisbmentRequest->loanAmount; ?></td>
                                        <td><?= $pendingDisbmentRequest->disburse_date; ?></td>
                                        <td><?= $isadminApprove; ?></td>
                                        <td><?= $pendingDisbmentRequest->created_at; ?></td>
                                        <td><button id="initiateApplyLoanEditForAdminConsentRaw" onclick="initiateApplyLoanEditForAdminConsentRaw(<?= $pendingDisbmentRequest->loanId ?>);" Type="submit" class="btn bg-warning btn-warning text-white">
                                <i class="fa fa-check"></i>
                                Send For Super Admin Consent
                            </button></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <?php }} ?>
            </div>
            <hr>
        <?php } ?>
        <?php if ($lrow->status == 'disbursed' || ($lrow->loanCategory == 3 && $lrow->status == 'customer-approved')) { ?>
            <?php $alldisbusteddocumets = DB::table('other_kyc_docs')->where(['doc_type' => '1', 'userId' => $userId])->get(); ?>
            <div class="col-lg-12 mt-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="document_title_type">Disbursed Document </div>
                    </div>
                    <div class="row mb-2" style="padding: 5px;">

                        <?php
                        if ($alldisbusteddocumets) {
                            foreach ($alldisbusteddocumets as $disdocs) { ?>
                                <div class="col-md-6 ">
                                    <div class="row border-2 p-2">
                                        <div class="col-lg-6 col-sm-6"><?= $disdocs->title ?></div>
                                        <div class="col-lg-6 col-sm-6">
                                            <a class="btn btn-warning" title="<?= $disdocs->title ?>" target="_blank" href="<?= $disdocs->docsUrl ? env('APP_URL') . 'public/' . $disdocs->docsUrl : '' ?>">View Document</a>
                                            <button type="button" class="btn btn-danger" style="background: red;" onclick="deleteOtherDocuments(<?= $disdocs->id ?>)"> Delete</button>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>

                    </div>
                </div>
            </div>
        <?php } ?>

        </div>
        </div>
    <?php
    }


    public function disbursedDocsUploadData(Request $request)
    {
        $newSave = [];
        if (!empty($request->disbursed_title)) {
            $title = $request->disbursed_title;
            $docsUrlArr = AppServiceProvider::uploadImageCustomMulti('disbursed_file', 'user-docs');

            if (count($docsUrlArr)) {
                $osr = 0;
                foreach ($title as $otherRow) {
                    if ($otherRow) {
                        $newSave[] = ['userId' => $request->recordId, 'title' => $otherRow, 'doc_type' => '1', 'docsUrl' => (isset($docsUrlArr[$osr])) ? $docsUrlArr[$osr] : ''];
                    }

                    $osr++;
                }
                //print_r($newSave);exit;

            }
        }

        $save =  OtherKycDoc::insert($newSave);

        if ($save) {
            return ['status' => 'success', 'message' => 'Customer disbursed document has been saved successfully.'];
        } else {
            return ['status' => 'error', 'message' => 'Some error occurred, Please try again.'];
        }
    }

    public function getProfileDetailsHtmlCustomerBankDetails($userId, $pageNameStr)
    {
        $userDtl = User::getUserDetailsById($userId);
        $userBankDtl = UserBankDetail::where('userId', $userId)->orderBy('id', 'desc')->first();
    ?>
        <div class="tab-pane body active" id="bankinfo">
            <?php if (!empty($userBankDtl)) { ?>
                <div class="row">
                    <!--<div class="col-lg-12 mb-3">
                                        <a href="javascript:;" onclick="sendSmsAlert('<?= $userId ?>','<?= $userDtl->mobile ?>','bank');" style="background: red;color: #fff;padding: 5px;border-radius: 10px;font-size: 12px;">Send Bank Details Alert</a>
                                    </div>-->
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for=""> Account Holder Name: </label>
                                    <span><?= (!empty($userBankDtl)) ? $userBankDtl->accountHolderName : 'NA' ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for=""> Bank Name: </label>
                                    <span><?= (!empty($userBankDtl)) ? $userBankDtl->bankName : 'NA' ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for=""> IFSC: </label>
                                    <span><?= (!empty($userBankDtl)) ? $userBankDtl->ifscCode : 'NA' ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for=""> Account Type: </label>
                                    <span><?= (!empty($userBankDtl)) ? $userBankDtl->accountType : 'NA' ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for=""> Account Number:</label>
                                    <span><?= (!empty($userBankDtl)) ? $userBankDtl->accountNumber : 'NA' ?></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for=""> Address: </label>
                                    <span><?= (!empty($userBankDtl)) ? $userBankDtl->address : 'NA' ?></span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for=""> City: </label>
                                    <span><?= (!empty($userBankDtl)) ? $userBankDtl->city : 'NA' ?></span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for=""> State: </label>
                                    <span><?= (!empty($userBankDtl)) ? $userBankDtl->state : 'NA' ?></span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mr_removecol">
                                <div class="form-group flex_col">
                                    <label for=""> Pin Code: </label>
                                    <span><?= (!empty($userBankDtl)) ? $userBankDtl->pincode : 'NA' ?></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">&nbsp;</div>
                    <div class="col-md-4 mb-3 viewBankDetails <?= ($userDtl->viewBankDetails) ? 'checkedDocs' : 'uncheckedDocs' ?>">
                        <input type="checkbox" class="docsCheck" <?= ($userDtl->viewBankDetails) ? 'checked disabled' : '' ?> userId="<?= $userDtl->id ?>" name="docsCheck" id="viewBankDetails" class="docsCheck" value="viewBankDetails"> Bank Details Checked
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php
    }

    public function getProfileDetailsHtmlCustomerBeureuReport($userId, $pageNameStr)
    {
        $userData = DB::table('users')->where('id', $userId)->first();
        $companyData = DB::table('employment_histories')->where(['userId' => $userId, 'status' => 'approved', 'companyType' => 'Pvt. Ltd.'])->first();
        $userDocDtlKyc = LoanKycOtherPendetail::where('userId', $userId)->orderBy('id', 'desc')->get();
        $creditData = null;
        if ($userData->creditscore_apidata) {
            $creditData = json_decode($userData->creditscore_apidata, true);
        }
    ?>
        <div class="tab-pane body active" id="beureuReport">
            <div class="tabform_mainb">
                <form action="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" id="orderList_header">
                                <div class="card-header  border-0">
                                    <div class="my-2 d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1">Customer Credit Score : <?= $userData->credit_score; ?></h5>
                                        <div class="flex-shrink-0">
                                            <?php if ((!$creditData)) { ?> <a class="btn btn-primarydl" href="<?= route('equifaxReport', ['user_id' => $userId]) ?>?loadreport=1">Load Report</a> <?php } elseif ($creditData && isset($creditData['CCRResponse']['CIRReportDataLst'][0]['Error'])) { ?> <span class="text-dark">Response : </span> <?= $creditData['CCRResponse']['CIRReportDataLst'][0]['Error']['ErrorDesc'] ?> <?php } ?>
                                            <!-- <a href="{{ route('') }}" class="btn btn-secondary" >Close</a> -->
                                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <a href="javascript:void(0);"><button type="button" class="btn btn-primary">Print</button></a> -->
                                            <?php if ($userData->credit_score) { ?> <a href="<?= route('equifaxReport', ['user_id' => $userId]) ?>?type=user"><button type="button" class="btn btn-primarydl">View Report</button></a> <?php } ?>
                                            
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>

                        </div>
                        <?php if($userDocDtlKyc) {  
                            foreach($userDocDtlKyc as $kk=>$ukyc){ 
                                $creditData = null;
                                if ($ukyc->creditscore_apidata) {
                                    $creditData = json_decode($ukyc->creditscore_apidata, true);
                                } ?>
                                <div class="col-lg-12">
                                    <div class="card" id="orderList_header">
                                        <div class="card-header  border-0">
                                        <div class="my-2 d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1">Customer Partner <?= $kk+1 ?> Credit Score : <?= $ukyc->credit_score; ?></h5>
                                        <div class="flex-shrink-0">
                                            <?php if ($ukyc->credit_score) { ?> <a href="<?= route('equifaxReport', ['user_id' => $ukyc->id]) ?>?type=partner"><button type="button" class="btn btn-primarydl">View Partner <?= $kk+1 ?> Report </button></a> <?php } ?>
                                            <?php if ((!$creditData) || isset($creditData['Error'])) { ?> <a class="btn btn-primarydl" href="<?= route('equifaxReport', ['user_id' => $ukyc->id]) ?>?loadreport=3&type=partner">Load Partner <?= $kk+1 ?> Report</a> <?php } elseif ($creditData && isset($creditData['CCRResponse']['CIRReportDataLst'][0]['Error'])) { ?> <span class="text-dark">Response : </span> <?= $creditData['CCRResponse']['CIRReportDataLst'][0]['Error']['ErrorDesc'] ?> <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php  }  } ?>
                        <?php if ($companyData && $companyData->employerName) {
                            $companyCreditData = null;
                            if ($companyData->company_creditscore_apidata) {
                                $companyCreditData = json_decode($companyData->company_creditscore_apidata, true);
                            }
                        ?>
                            <div class="col-lg-12">
                                <div class="card" id="orderList_header">
                                    <div class="card-header  border-0">
                                        <div class="d-flex align-items-center">
                                            <h5 class="card-title mb-0 flex-grow-1">Company Credit Score : <?= $companyData->company_credit_score; ?></h5>
                                            <div class="flex-shrink-0">
                                                <?php if ((!$companyCreditData && $userData->viewKycDetails) || isset($companyCreditData['Error'])) { ?> <a class="btn btn-primarydl" href="<?= route('equifaxReport', ['user_id' => $userId]) ?>?loadreport=2">Load Report</a> <?php } elseif ($companyCreditData && isset($companyCreditData['CCRResponse']['CIRReportDataLst'][0]['Error'])) { ?> <span class="text-dark">Response : </span> <?= $companyCreditData['CCRResponse']['CIRReportDataLst'][0]['Error']['ErrorDesc'] ?> <?php } ?>
                                                <!-- <a href="{{ route('') }}" class="btn btn-secondary" >Close</a> -->
                                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <a href="javascript:void(0);"><button type="button" class="btn btn-primary">Print</button></a> -->
                                                <?php if ($companyData->company_credit_score) { ?> <a href="<?= route('equifaxReport', ['user_id' => $userId]) ?>?type=company"><button type="button" class="btn btn-primarydl">View Report</button></a> <?php } ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        <?php } ?>
                        <!--end col-->
                    </div>
                    <?php /* <div class="row gallery-wrapper">
                                        <div class="col-lg-6">
                                            <div class="col-lg-12">
                                                <div class="document_title_type">Photo of Emp identity Card</div>
                                            </div>
                                            <div class="row">
                                                <div class="element-item  col-lg-12 col-sm-12">
                                                    <div class="gallery-box card">
                                                        <div class="gallery-container">
                                                            <a class="image-popup" title="">
                                                                <img class="gallery-img img-fluid mx-auto" src="images/document1.jpg" alt="">
                                                                <div class="gallery-overlay">
                                                                    <h5 class="overlay-caption"></h5>
                                                                </div>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- end col -->

                                            </div>
                                        </div>


                                    </div> */ ?>
                </form>
            </div>
        </div>
        <?php
    }

    public function getBusinessOrCompanyDetails(Request $request)
    {
        $userId = $request->userId;
        $isBusiness = $request->isBusiness;
        $pageNameStr = $request->pageNameStr;

        $employmentDetails = EmploymentHistory::where(['userId' => $userId, 'isBusiness' => $isBusiness])->first();
        $cashFlowAnalysisDetails = CashFlowAnalysi::where('userId', $userId)->first();
        $userEmploymentHistory = $employmentDetails;
        if ($isBusiness == 1) {
        ?>
            <div class="row">
                <div class="col-lg-6">
                    <label class="block">
                        <span>Company Name</span>
                        <input id="employerName" name="employerName" value="<?= (!empty($employmentDetails)) ? $employmentDetails->employerName : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                    </label>
                </div>
                <div class="col-lg-6">
                    <label class="block">
                        <span>Company Phone No.</span>
                        <input id="companyMobileNo" onkeypress="javascript:return isNumber(event)" name="companyMobileNo" value="<?= (!empty($employmentDetails)) ? $employmentDetails->mobileNo : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="number">
                    </label>
                </div>
                <div class="col-lg-6">
                    <label class="block">
                        <span>Telephone No.</span>
                        <input id="companyTeleNo" onkeypress="javascript:return isNumber(event)" name="companyTeleNo" value="<?= (!empty($employmentDetails)) ? $employmentDetails->companyTeleNo : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="number">
                    </label>
                </div>
                <div class="col-lg-6">
                    <label class="block">
                        <span>Email Id</span>
                        <input id="companyEmailId" name="companyEmailId" value="<?= (!empty($employmentDetails)) ? $employmentDetails->emailId : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="email">
                    </label>
                </div>
                <div class="col-lg-6">
                    <label class="block">
                        <span>Fax No.</span>
                        <input id="companyFaxNo" name="companyFaxNo" value="<?= (!empty($employmentDetails)) ? $employmentDetails->companyFaxNo : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                    </label>
                </div>

                <div class="col-lg-6">
                    <label class="block">
                        <span>GSTIN</span>
                        <input id="companyGstin" maxlength="15" name="companyGstin" value="<?= (!empty($employmentDetails)) ? $employmentDetails->companyGstin : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                    </label>
                </div>

                <div class="col-lg-6">
                    <label class="block">
                        <span>PAN No.</span>
                        <input id="companyPan" maxlength="10" name="companyPan" value="<?= (!empty($employmentDetails)) ? $employmentDetails->companyPan : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                    </label>
                </div>
                <div class="col-lg-6">
                    <label class="block">
                        <span>Company Type</span>
                        <select id="companyType" name="companyType" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                            <option value="">Select </option>
                            <option value="Partnership" <?php if (!empty($employmentDetails)) {
                                                            if ($employmentDetails->companyType == 'Partnership') {
                                                                echo 'selected';
                                                            }
                                                        } ?>>Partnership </option>
                            <option value="Propritorship" <?php if (!empty($employmentDetails)) {
                                                                if ($employmentDetails->companyType == 'Propritorship') {
                                                                    echo 'selected';
                                                                }
                                                            } ?>>Propritorship </option>
                            <option value="Pvt. Ltd." <?php if (!empty($employmentDetails)) {
                                                            if ($employmentDetails->companyType == 'Pvt. Ltd.') {
                                                                echo 'selected';
                                                            }
                                                        } ?>>Pvt. Ltd. </option>
                        </select>
                    </label>
                </div>
                <div class="col-lg-6">
                    <label class="block">
                        <span>Address</span>
                        <input id="companyAddress" name="companyAddress" value="<?= (!empty($employmentDetails)) ? $employmentDetails->address : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                    </label>
                </div>
                <div class="col-lg-6">
                    <label class="block">
                        <span>District</span>
                        <input id="companyDistrict" name="companyDistrict" value="<?= (!empty($employmentDetails)) ? $employmentDetails->district : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                    </label>
                </div>
                <div class="col-lg-6">
                    <label class="block">
                        <span>State</span>
                        <select class="form-control form-select contact-one__form-input" name="companyState" id="companyState">
                            <option value="">Select State</option>
                            <?php if ($this->indianStates) {
                                foreach ($this->indianStates as $kk => $statein) { ?>
                                    <option <?php if (old('companyState') == $statein) {
                                                echo "selected";
                                            } elseif (!empty($employmentDetails)) {
                                                if ($employmentDetails->state == $statein) {
                                                    echo 'selected';
                                                }
                                            } ?> value="<?= $statein ?>"><?= $statein ?></option>
                            <?php }
                            } ?>
                        </select>
                    </label>
                </div>

                <div class="col-lg-6">
                    <label class="block">
                        <span>Pincode</span>
                        <input id="companyPincode" onkeypress="javascript:return isNumber(event)" name="companyPincode" value="<?= (!empty($employmentDetails)) ? $employmentDetails->pincode : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                    </label>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Company Name </label>
                        <input type="text" name="employerName" id="employerName" value="<?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->employerName : '' ?>" class="form-control contact-one__form-input" placeholder="" required="">
                    </div><!-- /.form-group-->
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Company Phone No.</label>
                        <input type="text" id="companyMobileNo" onkeypress="javascript:return isNumber(event)" name="companyMobileNo" value="<?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->mobileNo : '' ?>" class="form-control contact-one__form-input" placeholder="Enter No." required="">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Company Email </label>
                        <input type="email" id="companyEmailId" name="companyEmailId" value="<?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->emailId : '' ?>" class="form-control contact-one__form-input" placeholder="" required="">
                    </div><!-- /.form-group-->
                </div>

                <div class="col-lg-6">
                    <label class="block">
                        <span>Company Type</span>
                        <select id="companyType" name="companyType" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                            <option value="">Select </option>
                            <option value="Partnership" <?php if (!empty($userEmploymentHistory)) {
                                                            if ($userEmploymentHistory->companyType == 'Partnership') {
                                                                echo 'selected';
                                                            }
                                                        } ?>>Partnership </option>
                            <option value="Propritorship" <?php if (!empty($userEmploymentHistory)) {
                                                                if ($userEmploymentHistory->companyType == 'Propritorship') {
                                                                    echo 'selected';
                                                                }
                                                            } ?>>Propritorship </option>
                            <option value="Pvt. Ltd." <?php if (!empty($userEmploymentHistory)) {
                                                            if ($userEmploymentHistory->companyType == 'Pvt. Ltd.') {
                                                                echo 'selected';
                                                            }
                                                        } ?>>Pvt. Ltd. </option>
                        </select>
                    </label>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Total Experience In Current Company</label>
                        <input type="text" id="totalExpInCurrentCompany" name="totalExpInCurrentCompany" value="<?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->totalExpInCurrentCompany : '' ?>" class="form-control contact-one__form-input" placeholder="Total Experience In Current Company" required="">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Current Salary </label>
                        <input type="number" id="currentSalary" name="currentSalary" value="<?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->currentSalary : '' ?>" class="form-control contact-one__form-input" placeholder="Current Salary" required="">
                    </div><!-- /.form-group-->
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" id="companyAddress" name="companyAddress" value="<?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->address : '' ?>" class="form-control contact-one__form-input" placeholder="Enter Address" required="">
                    </div><!-- /.form-group-->
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>District</label>
                        <input type="text" id="companyDistrict" name="companyDistrict" value="<?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->district : '' ?>" class="form-control contact-one__form-input" placeholder="Enter District" required="">
                    </div><!-- /.form-group-->
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control form-select contact-one__form-input" name="companyState" id="companyState">
                            <option value="">Select State</option>
                            <?php if ($this->indianStates) {
                                foreach ($this->indianStates as $kk => $statein) { ?>
                                    <option <?php if (old('companyState') == $statein) {
                                                echo "selected";
                                            } elseif (!empty($userEmploymentHistory)) {
                                                if ($userEmploymentHistory->state == $statein) {
                                                    echo 'selected';
                                                }
                                            } ?> value="<?= $statein ?>"><?= $statein ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div><!-- /.form-group-->
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pincode</label>
                        <input type="text" id="companyPincode" onkeypress="javascript:return isNumber(event)" name="companyPincode" value="<?= (!empty($userEmploymentHistory)) ? $userEmploymentHistory->pincode : '' ?>" class="form-control contact-one__form-input" placeholder="Enter Pincode" required="">
                    </div><!-- /.form-group-->
                </div>
            </div>
        <?php
        }

        ?>
        <?php $cashFLowStyle = 'style="display:none;"';
        if ($pageNameStr != 'customers-list' && $pageNameStr != 'rejected-customers' && $pageNameStr != 'employment-verification' && $pageNameStr != 'employment-verification-rejected') {
            $cashFLowStyle = '';
        } ?>

        <div class="row col-md-12" <?= $cashFLowStyle ?>>
            <div class="col-lg-12 mt-3 mb-3">
                <center>
                    <h3 style="font-size: 22px;font-weight: 700;">Cash Flow Analysis</h3>
                </center>
                <hr>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Source Of Income</span>
                    <input id="sourceOfIncome" name="sourceOfIncome" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->sourceOfIncome : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Sale</span>
                    <input id="cfaSale" name="cfaSale" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaSale : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Margin %</span>
                    <input id="cfaMargin" name="cfaMargin" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaMargin : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Gross Margin</span>
                    <input id="cfaGrossMargin" readonly name="cfaGrossMargin" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaGrossMargin : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Amount Available</span>
                    <input id="cfaAmountAvailable" readonly name="cfaAmountAvailable" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaAmountAvailable : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Electricity Bill Of Residence</span>
                    <input id="cfaElectricityBillOfResidence" name="cfaElectricityBillOfResidence" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaElectricityBillOfResidence : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Electricity Bill Of Business</span>
                    <input id="cfaElectricityBillOfBusiness" name="cfaElectricityBillOfBusiness" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaElectricityBillOfBusiness : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Residence/ Business Premises Rent</span>
                    <input id="cfaResidenceBusinessPermissesRent" name="cfaResidenceBusinessPermissesRent" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaResidenceBusinessPermissesRent : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Household Expense</span>
                    <input id="cfaHouseHoldExpense" name="cfaHouseHoldExpense" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaHouseHoldExpense : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Salary</span>
                    <input id="cfaSalary" name="cfaSalary" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaSalary : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Misc. Expenses </span>
                    <input id="cfaMiscExpenses" name="cfaMiscExpenses" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaMiscExpenses : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>School Fees</span>
                    <input id="cfaSchoolFee" name="cfaSchoolFee" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaSchoolFee : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Gross Amount Available</span>
                    <input id="cfaGrossAmountAvailable" readonly name="cfaGrossAmountAvailable" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaGrossAmountAvailable : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Running EMI</span>
                    <input id="cfaRunningEmi" name="cfaRunningEmi" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaRunningEmi : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Credit Card EMI</span>
                    <input id="cfaCreditCardEMi" name="cfaCreditCardEMi" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaCreditCardEMi : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Proposed EMI</span>
                    <input id="cfaProposedEmi" name="cfaProposedEmi" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaProposedEmi : '' ?>" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Net Amount Available</span>
                    <input id="cfaNetAmountAvailable" readonly name="cfaNetAmountAvailable" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaNetAmountAvailable : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>FOIR % </span>
                    <input id="cfaFOIR" readonly name="cfaFOIR" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaFOIR : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
            <div class="col-lg-6">
                <label class="block">
                    <span>Net Monthly Income</span>
                    <input id="cfaNetMonthlyIncome" readonly name="cfaNetMonthlyIncome" value="<?= (!empty($cashFlowAnalysisDetails)) ? $cashFlowAnalysisDetails->cfaNetMonthlyIncome : '' ?>" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                </label>
            </div>
        </div>
        </div>
<?php
    }


    public function payOutStandingAmount(Request $request)
    {
        $loanId = $request->loanId;
        $userId = $request->userId;
        $payOutStandingPayMode = $request->payOutStandingPayMode;
        $payOutStandingAmt = ($request->payOutStandingAmt) ? $request->payOutStandingAmt : 0;
        $transactionDate = ($request->payOutStandingTxnDate) ? date('Y-m-d', strtotime($request->payOutStandingTxnDate)) : '';
        $payOutStandingTxnId = $request->payOutStandingTxnId;

        $totalOutStandingNow = DB::select("SELECT ((SELECT IFNULL(approvedAmount,0) FROM apply_loan_histories WHERE id='$loanId' AND status='disbursed')-(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='credit')) as totalOutStanding")[0]->totalOutStanding;
        // echo json_encode(['status'=>$payOutStandingAmt,'message'=>$totalOutStandingNow]);
        // die();
        if ($payOutStandingAmt > $totalOutStandingNow) {
            echo json_encode(['status' => 'error', 'message' => 'You can not pay principle greater than ' . $totalOutStandingNow]);
            exit;
        }



        if ($loanId && $userId && $payOutStandingAmt && $payOutStandingPayMode && $payOutStandingTxnId && $transactionDate) {
            /*$if1StEmiPaid=LoanEmiDetail::where(['loanId'=>$loanId,'status'=>'success'])->first();
            if(empty($if1StEmiPaid)){
                echo json_encode(['status'=>'error','message'=>'You have to pay atleast 1 emi before submit outstanding.']); exit;
            }*/

            $loanDetails = ApplyLoanHistory::where('id', $loanId)->first();
            $disbursedDate = $loanDetails->disbursedDate;

            $lastCreditDate = '';
            $lastCreditDtl = DB::select("SELECT max(txnDate) as lastCreditDate FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='credit'");
            if (count($lastCreditDtl)) {
                $lastCreditDate = (strtotime($lastCreditDtl[0]->lastCreditDate)) ? $lastCreditDtl[0]->lastCreditDate : $disbursedDate;
            }


            if (strtotime($disbursedDate) > strtotime($transactionDate)) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid collection date.']);
                exit;
            }

            if ($lastCreditDate) {
                if (strtotime($lastCreditDate) > strtotime($transactionDate)) {
                    echo json_encode(['status' => 'error', 'message' => 'Collection date should be greater than ' . date('d M, Y', strtotime($lastCreditDate)) . '.']);
                    exit;
                }
            }

            $pendingEMiDate0 = '';
            $pendingEMiDate = '';
            $pendingEMiDateDtl = DB::select("SELECT emiDate, emiDueDate FROM loan_emi_details WHERE loanId='$loanId' AND status !='success' ORDER BY id ASC");

            $paidEMiDateDtl = DB::select("SELECT count(id) AS idc FROM loan_emi_details WHERE loanId='$loanId' AND status ='success' ORDER BY id ASC")[0]->idc;

            if (count($pendingEMiDateDtl)) {
                $pendingEMiDate = (strtotime($pendingEMiDateDtl[0]->emiDueDate)) ? $pendingEMiDateDtl[0]->emiDueDate : '';
                $pendingEMiDate0 = (strtotime($pendingEMiDateDtl[0]->emiDate)) ? $pendingEMiDateDtl[0]->emiDate : '';
            }
            if ($paidEMiDateDtl == 0) {
                echo json_encode(['status' => 'error', 'message' => 'Please pay first pending emi before .']);
                exit;
            }

            // dd($pendingEMiDate,$transactionDate,$paidEMiDateDtl);
            if ($pendingEMiDate) {
                if (strtotime($pendingEMiDate0) < strtotime($transactionDate) || strtotime($pendingEMiDate) < strtotime($transactionDate)) {
                    echo json_encode(['status' => 'error', 'message' => 'Please pay pending emi before this date ' . date('d M, Y', strtotime($transactionDate)) . '.']);
                    exit;
                }
            }


            $saveUp['userId'] = $userId;
            $saveUp['loanId'] = $loanId;
            $saveUp['amount'] = $payOutStandingAmt;
            $saveUp['txnId'] = $payOutStandingTxnId;
            $saveUp['txnDate'] = $transactionDate;
            $saveUp['paymentMode'] = $payOutStandingPayMode;
            $saveUp['type'] = 'credit';
            $saveUp['created_at'] = date('Y-m-d H:i:s');
            $saveUp['updated_at'] = date('Y-m-d H:i:s');

            $saved = DB::table('out_standing_payment_histories')->insertGetId($saveUp);

            if (!empty($saved)) {
                $this->updateOtherEmisAmountAfterPayOutstanding($loanId, $transactionDate);
                echo json_encode(['status' => 'success', 'message' => 'Outstanding amount paid successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Some error occurred, please try again.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, please try again.']);
        }
    }

    public function updateOtherEmisAmountAfterPayOutstanding($loanId, $transactionDate)
    {
        $loanDetails = ApplyLoanHistory::where('id', $loanId)->first();
        $userId = $loanDetails->userId;
        $roiType = $loanDetails->roiType;
        $rateOfInterest = $loanDetails->rateOfInterest;
        $balance = $loanDetails->approvedAmount;


        $tenureDtl = Tenure::where('id', $loanDetails->approvedTenure)->first();
        $numOfEmis = $tenureDtl->numOfEmis;

        $totalOutStandingBeforeSubmit = DB::select("SELECT ((SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='debit')-(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='credit' AND date(txnDate)<'$transactionDate')) as totalOutStanding")[0]->totalOutStanding;
        $totalOutStandingNow = DB::select("SELECT ((SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='debit')-(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='credit')) as totalOutStanding")[0]->totalOutStanding;

        // dd($totalOutStandingBeforeSubmit,$totalOutStandingNow);
        $oneYearInterest = ($totalOutStandingBeforeSubmit * $rateOfInterest) / 100;
        $oneYearInterestNow = ($totalOutStandingNow * $rateOfInterest) / 100;

        $year = date('Y', strtotime($transactionDate));
        $month = date('m', strtotime($transactionDate));

        $objComm = new CommonController();

        $ifFirstEmiDtl = LoanEmiDetail::where('loanId', $loanId)->orderBy('id', 'ASC')->first();

        $emiStatus = $ifFirstEmiDtl->status;
        if ($emiStatus == 'success') {
            $oldInterests = DB::select("SELECT IFNULL(SUM(amount),0) as totalInterest,txnDate FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='main-interest' AND MONTH(txnDate)='$month' AND YEAR(txnDate)='$year' GROUP BY amount,txnDate ORDER BY id DESC");
            if (count($oldInterests)) {
                $oldTotalInterest = $oldInterests[0]->totalInterest;
                $oldInterestStartDate = ($oldInterests[0]->txnDate) ? $oldInterests[0]->txnDate : date('Y-m-05', strtotime($transactionDate));
            } else {
                $oldTotalInterest = 0;
                $oldInterestStartDate = date('Y-m-05', strtotime($transactionDate));
            }
            //echo $oldInterestStartDate.' = '.$transactionDate;
            $oldInterestDays = $objComm->getNumOfDaysBetween2Dates($oldInterestStartDate, $transactionDate);

            $totalDaysInTxnMonth = $objComm->getNumOfDaysBetween2Dates($transactionDate, date('Y-m-t', strtotime($transactionDate)));
            $totalDaysInTxnMonth = ($totalDaysInTxnMonth) + 5;
            $newInterestDays = $totalDaysInTxnMonth;
            // dd($oldInterestStartDate,$transactionDate,$oldInterestDays,'===',$transactionDate,date('Y-m-t',strtotime($transactionDate)),$newInterestDays);

        } else {

            $oldInterests = DB::select("SELECT IFNULL(SUM(amount),0) as totalInterest,txnDate FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='main-interest' AND MONTH(txnDate)<='$month' AND YEAR(txnDate)<='$year' GROUP BY amount,txnDate ORDER BY id DESC");
            if (count($oldInterests)) {
                $oldTotalInterest = $oldInterests[0]->totalInterest;
                $oldInterestStartDate = ($oldInterests[0]->txnDate) ? $oldInterests[0]->txnDate : date('Y-m-d', strtotime($loanDetails->disbursedDate));
            } else {
                $oldTotalInterest = 0;
                $oldInterestStartDate = date('Y-m-d', strtotime($loanDetails->disbursedDate));
            }

            $oldInterestEndDate = date('Y-m-05', strtotime($ifFirstEmiDtl->emiDueDate . ' -1 Month'));

            $oldInterestDaysBefore1Emi = $objComm->getNumOfDaysBetween2Dates($oldInterestStartDate, $transactionDate);

            $oldInterestDays = $oldInterestDaysBefore1Emi;

            $totalDaysInTxnMonth = $objComm->getNumOfDaysBetween2Dates($transactionDate, date('Y-m-t', strtotime($oldInterestEndDate)));
            $totalDaysInTxnMonth = ($totalDaysInTxnMonth) + 4;
            $newInterestDays = $totalDaysInTxnMonth;
        }

        if ($roiType == 'fixed_interest_roi') {
            //$LeftEmis=DB::select("SELECT * FROM loan_emi_details WHERE loanId='$loanId' AND status !='success' AND date(emiDate)>='$transactionDate' ORDER BY emiSr ASC");
            $LeftEmis = DB::select("SELECT * FROM loan_emi_details WHERE loanId='$loanId' AND status !='success' ORDER BY emiSr ASC");
            $totalEMis = count($LeftEmis);

            //echo $startMonthEmi.'<br>'.$totalInterestStartDays.'<br>'.$totalInterestEndDays.'<br>'.$emiAmount; exit;
            $srn = 1;
            foreach ($LeftEmis as $lrow) {
                $skipMonths = ' -1 Month';
                $interestStartDate = $lrow->emiDate;


                $nextInterestMonth = date('Y-m-05', strtotime($interestStartDate . $skipMonths));
                $nextMonthYear = date('Y', strtotime($nextInterestMonth));
                // if ($nextMonthYear % 4 == 0) {
                //     $oneYearDays = 366;
                // } else {
                    $oneYearDays = 365;
                // }
                $oneDayInterest = $oneYearInterest / $oneYearDays;
                $oneDayInterestNow = $oneYearInterestNow / $oneYearDays;

                $oldDaysInterestAmount = $oldInterestDays * $oneDayInterest;
                $newDaysInterestAmount = $newInterestDays * $oneDayInterestNow;


                $emiId = $lrow->id;
                if ($srn == 1) {
                    $emiAmount = $oldTotalInterest + $oldDaysInterestAmount + $newDaysInterestAmount;
                    $balance = $totalOutStandingNow;
                    $interest = $emiAmount;
                    $newEmiAmount = $emiAmount;
                    $saveUp['userId'] = $userId;
                    $saveUp['loanId'] = $loanId;
                    $saveUp['amount'] = $oldDaysInterestAmount;
                    $saveUp['txnId'] = '';
                    $saveUp['txnDate'] = $transactionDate;
                    $saveUp['paymentMode'] = '';
                    $saveUp['emiDetailsStr'] = json_encode(['oldDaysInterestAmt' => $oldDaysInterestAmount, 'oldInterestDays' => $oldInterestDays, 'oneDayInterest' => $oneDayInterest]);
                    $saveUp['type'] = 'main-interest';
                    $saveUp['created_at'] = date('Y-m-d H:i:s');
                    $saveUp['updated_at'] = date('Y-m-d H:i:s');

                    $saved = DB::table('out_standing_payment_histories')->insertGetId($saveUp);

                    $saveUp['userId'] = $userId;
                    $saveUp['loanId'] = $loanId;
                    $saveUp['amount'] = $newDaysInterestAmount;
                    $saveUp['txnId'] = '';
                    $saveUp['txnDate'] = $transactionDate;
                    $saveUp['paymentMode'] = '';
                    $saveUp['emiDetailsStr'] = json_encode(['newDaysInterestAmount' => $newDaysInterestAmount, 'newInterestDays' => $newInterestDays, 'oneDayInterest' => $oneDayInterestNow]);
                    $saveUp['type'] = 'new-interest';
                    $saveUp['created_at'] = date('Y-m-d H:i:s');
                    $saveUp['updated_at'] = date('Y-m-d H:i:s');

                    $saved = DB::table('out_standing_payment_histories')->insertGetId($saveUp);
                } else {

                    $nextInterestMonthLastDate = date('Y-m-t', strtotime($nextInterestMonth));
                    $nextInterestMonthLastDate = date('Y-m-d', strtotime($nextInterestMonthLastDate . '+4days'));

                    $totalDaysInNextMonth = $objComm->getNumOfDaysBetween2Dates($nextInterestMonth, $nextInterestMonthLastDate);
                    $totalDaysInNextMonth = $totalDaysInNextMonth + 1;

                    //$totalDaysInNextMonth = cal_days_in_month(CAL_GREGORIAN,date('m', strtotime($nextInterestMonth)),date('Y', strtotime($nextInterestMonth)));

                    $monthInterest = $oneDayInterestNow * $totalDaysInNextMonth;

                    $emiAmount = $monthInterest;
                    $interest = $monthInterest;
                    $balance = $totalOutStandingNow;
                }

                // if($srn==$totalEMis){
                //     $interest=$monthInterest;
                //     $emiAmount=$balance+$monthInterest;
                //     $balance=0;
                // }

                $tdsAmount = (round($emiAmount) * $loanDetails->tds) / 100;
                $netInterest = round($emiAmount) - $tdsAmount;


                LoanEmiDetail::where('id', $emiId)->update(['emiAmount' => $emiAmount, 'netemiAmount' => ($emiAmount - $tdsAmount), 'tdsAmount' => $tdsAmount, 'netInterest' => $netInterest, 'interest' => $interest, 'balance' => $balance]);
                $srn++;
            }

            DB::select("UPDATE apply_loan_histories set totalInterest=(SELECT IFNULL(SUM(interest),0) FROM loan_emi_details WHERE loanId='$loanId'), monthlyEMI='$newEmiAmount' WHERE id='$loanId'");
        } else {
            $lastEmiSubmit = LoanEmiDetail::where(['loanId' => $loanId, 'status' => 'success'])->orderBy('emiSr', 'DESC')->first();
            $firstEmiToBeSubmit = LoanEmiDetail::where(['loanId' => $loanId])->where('status', '!=', 'success')->orderBy('emiSr', 'ASC')->first();
            if (!empty($lastEmiSubmit) && $firstEmiToBeSubmit) {
                $startDate = date('Y-m-01', strtotime($lastEmiSubmit->emiDate));
                $endDateOfMonth = date('Y-m-01', strtotime($firstEmiToBeSubmit->emiDate));

                $LeftEmis = DB::select("SELECT * FROM loan_emi_details WHERE loanId='$loanId' AND status !='success' AND date(emiDate)>='$transactionDate' ORDER BY emiSr ASC");
                $totalEMis = count($LeftEmis);
                // dd($LeftEmis);
                $objComm = new CommonController();
                if ($loanDetails->loanCategory = '8' && $roiType == 'quaterly_interest') {

                    foreach ($LeftEmis as $kk => $lrow) {
                        $emi = 0;
                        $tdsAmount = 0;
                        $netInterest = 0;
                        for ($i = 1; $i <= 3; $i++) {
                            $nextInterestMonth = date('Y-m-05', strtotime($lrow->emiDate . ' -' . $i . ' month'));
                            $nextMonthYear = date('Y', strtotime($nextInterestMonth));
                            // if ($nextMonthYear % 4 == 0) {
                            //     $oneYearDays = 366;
                            // } else {
                                $oneYearDays = 365;
                            // }
                            $oneDayInterest = $oneYearInterest / $oneYearDays;
                            $oneDayInterestNow = $oneYearInterestNow / $oneYearDays;

                            $oldDaysInterestAmount = $oldInterestDays * $oneDayInterest;
                            $newDaysInterestAmount = $newInterestDays * $oneDayInterestNow;


                            $emiId = $lrow->id;
                            if (date('m', strtotime($transactionDate)) == date('m', strtotime($nextInterestMonth)) && $kk == 0) {
                                $emiAmount = $oldTotalInterest + $oldDaysInterestAmount + $newDaysInterestAmount;
                                $balance = $totalOutStandingNow;
                                $interest = $emiAmount;
                                $newEmiAmount = $emiAmount;
                                $saveUp['userId'] = $userId;
                                $saveUp['loanId'] = $loanId;
                                $saveUp['amount'] = $oldDaysInterestAmount;
                                $saveUp['txnId'] = '';
                                $saveUp['txnDate'] = $transactionDate;
                                $saveUp['paymentMode'] = '';
                                $saveUp['emiDetailsStr'] = json_encode(['oldDaysInterestAmt' => $oldDaysInterestAmount, 'oldInterestDays' => $oldInterestDays, 'oneDayInterest' => $oneDayInterest]);
                                $saveUp['type'] = 'main-interest';
                                $saveUp['created_at'] = date('Y-m-d H:i:s');
                                $saveUp['updated_at'] = date('Y-m-d H:i:s');

                                $saved = DB::table('out_standing_payment_histories')->insertGetId($saveUp);

                                $saveUp['userId'] = $userId;
                                $saveUp['loanId'] = $loanId;
                                $saveUp['amount'] = $newDaysInterestAmount;
                                $saveUp['txnId'] = '';
                                $saveUp['txnDate'] = $transactionDate;
                                $saveUp['paymentMode'] = '';
                                $saveUp['emiDetailsStr'] = json_encode(['newDaysInterestAmount' => $newDaysInterestAmount, 'newInterestDays' => $newInterestDays, 'oneDayInterest' => $oneDayInterestNow]);
                                $saveUp['type'] = 'new-interest';
                                $saveUp['created_at'] = date('Y-m-d H:i:s');
                                $saveUp['updated_at'] = date('Y-m-d H:i:s');

                                $saved = DB::table('out_standing_payment_histories')->insertGetId($saveUp);

                                $monthInterest = ($oldDaysInterestAmount) + ($newDaysInterestAmount);
                                $emi += $monthInterest;

                                $tdsAmount += (round($monthInterest, 2) * $loanDetails->tds) / 100;
                                $netInterest += round($monthInterest, 2) - ((round($monthInterest, 2) * $loanDetails->tds) / 100);

                                $oldjsonEMI = ['monthEMI' => $monthInterest, 'emi' => $emi, 'tdsamount' => $tdsAmount, 'netInterest' => $netInterest];
                                Storage::disk('local')->put('emi_' . $nextInterestMonth . '.json', json_encode($oldjsonEMI));
                            } else {
                                if (strtotime($transactionDate) < strtotime($nextInterestMonth)) {
                                    $oneDayInterest = $oneYearInterestNow / $oneYearDays;
                                } else {
                                    $oneDayInterest = $oneYearInterest / $oneYearDays;
                                }

                                $nextInterestMonthLastDate = date('Y-m-t', strtotime($nextInterestMonth));
                                $nextInterestMonthLastDate = date('Y-m-d', strtotime($nextInterestMonthLastDate . '+4days'));
                                $totalDaysInNextMonth = $objComm->getNumOfDaysBetween2Dates($nextInterestMonth, $nextInterestMonthLastDate);
                                $totalDaysInNextMonth = $totalDaysInNextMonth + 1;

                                $monthInterest = $oneDayInterest * $totalDaysInNextMonth;
                                $emi += $monthInterest;

                                $tdsAmount += (round($monthInterest, 2) * $loanDetails->tds) / 100;
                                $netInterest += round($monthInterest, 2) - ((round($monthInterest, 2) * $loanDetails->tds) / 100);

                                $oldjsonEMI = ['monthEMI' => $monthInterest, 'emi' => $emi, 'tdsamount' => $tdsAmount, 'netInterest' => $netInterest];
                                Storage::disk('local')->put('emi_' . $nextInterestMonth . '.json', json_encode($oldjsonEMI));
                            }
                        }
                        $newEmiAmount = $emi;

                        // dd(['emiAmount'=>$emi,'netemiAmount'=>($emi-$tdsAmount),'tdsAmount'=>$tdsAmount,'netInterest'=>$netInterest,'interest'=>$emi,'balance'=>$balance]);
                        LoanEmiDetail::where('id', $lrow->id)->update(['emiAmount' => $emi, 'netemiAmount' => ($emi - $tdsAmount), 'tdsAmount' => $tdsAmount, 'netInterest' => $netInterest, 'interest' => $emi, 'balance' => $totalOutStandingNow]);
                    }
                } else {

                    $datetime1 = date_create($startDate);
                    $datetime2 = date_create($transactionDate);
                    $interval = date_diff($datetime1, $datetime2);
                    // Display the result
                    $numOfDaysStart = $interval->format('%a');


                    $datetime1 = date_create($transactionDate);
                    $datetime2 = date_create($endDateOfMonth);
                    $interval = date_diff($datetime1, $datetime2);
                    // Display the result
                    $numOfDaysEnd = $interval->format('%a');

                    //echo $numOfDaysStart.' => '.$numOfDaysEnd;exit;

                    // For next months emi excluding submit outstanding amount month
                    $oneYearInterest = ($totalOutStandingNow * $rateOfInterest) / 100;
                    $oneMonthInterest = $oneYearInterest / 12;
                    $oneQuarterlyInterest = $oneYearInterest / 4;
                    $oneDayInterestN = $oneYearInterest / 365;

                    $month = ($totalEMis - 1);
                    $totalInterest = $oneQuarterlyInterest * $month;
                    $emiAmount = $totalInterest / $month;
                    $newEmiAmount = $emiAmount;
                    // End For next months emi excluding submit outstanding amount month


                    // For current month emi submit outstanding amount month
                    $oneYearInterest = ($totalOutStandingBeforeSubmit * $rateOfInterest) / 100;
                    $oneMonthInterest = $oneYearInterest / 12;
                    $oneDayInterestP = $oneYearInterest / 365;

                    $totalInterestStartDays = $oneDayInterestP * $numOfDaysStart; // For start days
                    $totalInterestEndDays = $oneDayInterestN * $numOfDaysEnd; // For End days
                    $startMonthEmi = $totalInterestStartDays + $totalInterestEndDays; // 1st emi
                    // For current month emi submit outstanding amount month

                    //echo $startMonthEmi.'<br>'.$totalInterestStartDays.'<br>'.$totalInterestEndDays.'<br>'.$emiAmount; exit;
                    $srn = 1;
                    foreach ($LeftEmis as $lrow) {
                        $emiId = $lrow->id;
                        if ($srn == 1) {
                            $emiAmount = $startMonthEmi;
                            $balance = $totalOutStandingNow;
                            $interest = $emiAmount;
                        } else {
                            $emiAmount = $newEmiAmount;
                            $interest = $emiAmount;
                            $balance = $totalOutStandingNow;
                        }

                        // if($srn==$totalEMis){
                        //     $interest=$newEmiAmount;
                        //     $emiAmount=$balance+$newEmiAmount;
                        //     $balance=0;
                        // }

                        $tdsAmount = (round($emiAmount) * $loanDetails->tds) / 100;
                        $netInterest = round($emiAmount) - $tdsAmount;

                        LoanEmiDetail::where('id', $emiId)->update(['emiAmount' => $emiAmount, 'netemiAmount' => ($emiAmount - $tdsAmount), 'tdsAmount' => $tdsAmount, 'netInterest' => $netInterest, 'interest' => $interest, 'balance' => $balance]);
                        $srn++;
                    }
                }

                DB::select("UPDATE apply_loan_histories set totalInterest=(SELECT IFNULL(SUM(interest),0) FROM loan_emi_details WHERE loanId='$loanId'), monthlyEMI='$newEmiAmount' WHERE id='$loanId'");
            }
        }
        return true;
        //OutStandingPaymentHistory::
    }

    public function updateOtherEmisAmountAfterPayOutstanding_before_remove_1st_emi($loanId, $transactionDate)
    {
        $loanDetails = ApplyLoanHistory::where('id', $loanId)->first();
        $userId = $loanDetails->userId;
        $roiType = $loanDetails->roiType;
        $rateOfInterest = $loanDetails->rateOfInterest;
        $balance = $loanDetails->approvedAmount;


        $tenureDtl = Tenure::where('id', $loanDetails->approvedTenure)->first();
        $numOfEmis = $tenureDtl->numOfEmis;

        $totalOutStandingBeforeSubmit = DB::select("SELECT ((SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='debit')-(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='credit' AND date(txnDate)<'$transactionDate')) as totalOutStanding")[0]->totalOutStanding;
        $totalOutStandingNow = DB::select("SELECT ((SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='debit')-(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE loanId='$loanId' AND type='credit')) as totalOutStanding")[0]->totalOutStanding;

        $oneYearInterest = ($totalOutStandingBeforeSubmit * $rateOfInterest) / 100;
        $oneYearInterestNow = ($totalOutStandingNow * $rateOfInterest) / 100;

        $year = date('Y', strtotime($transactionDate));
        $month = date('m', strtotime($transactionDate));

        $oldInterests = DB::select("SELECT IFNULL(SUM(amount),0) as totalInterest,txnDate FROM out_standing_payment_histories WHERE type='main-interest' AND MONTH(txnDate)='$month' AND YEAR(txnDate)='$year' GROUP BY amount,txnDate ORDER BY id DESC");
        if (count($oldInterests)) {
            $oldTotalInterest = $oldInterests[0]->totalInterest;
            $oldInterestStartDate = ($oldInterests[0]->txnDate) ? $oldInterests[0]->txnDate : date('Y-m-05', strtotime($transactionDate));
        } else {
            $oldTotalInterest = 0;
            $oldInterestStartDate = date('Y-m-05', strtotime($transactionDate));
        }


        $objComm = new CommonController();
        $oldInterestDays = $objComm->getNumOfDaysBetween2Dates($oldInterestStartDate, $transactionDate);

        $totalDaysInTxnMonth = $objComm->getNumOfDaysBetween2Dates($transactionDate, date('Y-m-t', strtotime($transactionDate)));
        $totalDaysInTxnMonth = ($totalDaysInTxnMonth + 1) + 4;
        $newInterestDays = $totalDaysInTxnMonth;

        if ($roiType == 'fixed_interest_roi') {
            $LeftEmis = DB::select("SELECT * FROM loan_emi_details WHERE loanId='$loanId' AND status !='success' AND date(emiDate)>='$transactionDate' ORDER BY emiSr ASC");
            $totalEMis = count($LeftEmis);

            //echo $startMonthEmi.'<br>'.$totalInterestStartDays.'<br>'.$totalInterestEndDays.'<br>'.$emiAmount; exit;
            $srn = 1;
            foreach ($LeftEmis as $lrow) {
                $skipMonths = ' -1 Month';
                $interestStartDate = $lrow->emiDate;


                $nextInterestMonth = date('Y-m-05', strtotime($interestStartDate . $skipMonths));
                $nextMonthYear = date('Y', strtotime($nextInterestMonth));
                // if ($nextMonthYear % 4 == 0) {
                //     $oneYearDays = 366;
                // } else {
                    $oneYearDays = 365;
                // }
                $oneDayInterest = $oneYearInterest / $oneYearDays;
                $oneDayInterestNow = $oneYearInterestNow / $oneYearDays;

                $oldDaysInterestAmount = $oldInterestDays * $oneDayInterest;
                $newDaysInterestAmount = $newInterestDays * $oneDayInterestNow;


                $emiId = $lrow->id;
                if ($srn == 1) {
                    $emiAmount = $oldTotalInterest + $oldDaysInterestAmount + $newDaysInterestAmount;
                    $balance = $totalOutStandingNow;
                    $interest = $emiAmount;
                    $newEmiAmount = $emiAmount;
                    $saveUp['userId'] = $userId;
                    $saveUp['loanId'] = $loanId;
                    $saveUp['amount'] = $oldDaysInterestAmount;
                    $saveUp['txnId'] = '';
                    $saveUp['txnDate'] = $transactionDate;
                    $saveUp['paymentMode'] = '';
                    $saveUp['emiDetailsStr'] = json_encode(['oldDaysInterestAmt' => $oldDaysInterestAmount, 'oldInterestDays' => $oldInterestDays, 'oneDayInterest' => $oneDayInterest]);
                    $saveUp['type'] = 'main-interest';
                    $saveUp['created_at'] = date('Y-m-d H:i:s');
                    $saveUp['updated_at'] = date('Y-m-d H:i:s');

                    $saved = DB::table('out_standing_payment_histories')->insertGetId($saveUp);

                    $saveUp['userId'] = $userId;
                    $saveUp['loanId'] = $loanId;
                    $saveUp['amount'] = $newDaysInterestAmount;
                    $saveUp['txnId'] = '';
                    $saveUp['txnDate'] = $transactionDate;
                    $saveUp['paymentMode'] = '';
                    $saveUp['emiDetailsStr'] = json_encode(['newDaysInterestAmount' => $newDaysInterestAmount, 'newInterestDays' => $newInterestDays, 'oneDayInterest' => $oneDayInterestNow]);
                    $saveUp['type'] = 'new-interest';
                    $saveUp['created_at'] = date('Y-m-d H:i:s');
                    $saveUp['updated_at'] = date('Y-m-d H:i:s');

                    $saved = DB::table('out_standing_payment_histories')->insertGetId($saveUp);
                } else {

                    $nextInterestMonthLastDate = date('Y-m-t', strtotime($nextInterestMonth));
                    $nextInterestMonthLastDate = date('Y-m-d', strtotime($nextInterestMonthLastDate . '+4days'));

                    $totalDaysInNextMonth = $objComm->getNumOfDaysBetween2Dates($nextInterestMonth, $nextInterestMonthLastDate);
                    $totalDaysInNextMonth = $totalDaysInNextMonth + 1;

                    //$totalDaysInNextMonth = cal_days_in_month(CAL_GREGORIAN,date('m', strtotime($nextInterestMonth)),date('Y', strtotime($nextInterestMonth)));

                    $monthInterest = $oneDayInterestNow * $totalDaysInNextMonth;

                    $emiAmount = $monthInterest;
                    $interest = $monthInterest;
                    $balance = $totalOutStandingNow;
                }

                // if($srn==$totalEMis){
                //     $interest=$monthInterest;
                //     $emiAmount=$balance+$monthInterest;
                //     $balance=0;
                // }

                $tdsAmount = (round($emiAmount) * $loanDetails->tds) / 100;
                $netInterest = round($emiAmount) - $tdsAmount;

                LoanEmiDetail::where('id', $emiId)->update(['emiAmount' => $emiAmount, 'netemiAmount' => ($emiAmount - $tdsAmount), 'tdsAmount' => $tdsAmount, 'netInterest' => $netInterest, 'interest' => $interest, 'balance' => $balance]);
                $srn++;
            }

            DB::select("UPDATE apply_loan_histories set totalInterest=(SELECT IFNULL(SUM(interest),0) FROM loan_emi_details WHERE loanId='$loanId'), monthlyEMI='$newEmiAmount' WHERE id='$loanId'");
        } else {
            $lastEmiSubmit = LoanEmiDetail::where(['loanId' => $loanId, 'status' => 'success'])->orderBy('emiSr', 'DESC')->first();
            $firstEmiToBeSubmit = LoanEmiDetail::where(['loanId' => $loanId])->where('status', '!=', 'success')->orderBy('emiSr', 'ASC')->first();
            if (!empty($lastEmiSubmit) && $firstEmiToBeSubmit) {
                $startDate = date('Y-m-01', strtotime($lastEmiSubmit->emiDate));
                $endDateOfMonth = date('Y-m-01', strtotime($firstEmiToBeSubmit->emiDate));

                $LeftEmis = DB::select("SELECT * FROM loan_emi_details WHERE loanId='$loanId' AND status !='success' AND date(emiDate)>='$transactionDate' ORDER BY emiSr ASC");
                $totalEMis = count($LeftEmis);

                $datetime1 = date_create($startDate);
                $datetime2 = date_create($transactionDate);
                $interval = date_diff($datetime1, $datetime2);
                // Display the result
                $numOfDaysStart = $interval->format('%a');


                $datetime1 = date_create($transactionDate);
                $datetime2 = date_create($endDateOfMonth);
                $interval = date_diff($datetime1, $datetime2);
                // Display the result
                $numOfDaysEnd = $interval->format('%a');

                //echo $numOfDaysStart.' => '.$numOfDaysEnd;exit;

                // For next months emi excluding submit outstanding amount month
                $oneYearInterest = ($totalOutStandingNow * $rateOfInterest) / 100;
                $oneMonthInterest = $oneYearInterest / 12;
                $oneQuarterlyInterest = $oneYearInterest / 4;
                $oneDayInterestN = $oneYearInterest / 365;

                $month = ($totalEMis - 1);
                $totalInterest = $oneQuarterlyInterest * $month;
                $emiAmount = $totalInterest / $month;
                $newEmiAmount = $emiAmount;
                // End For next months emi excluding submit outstanding amount month


                // For current month emi submit outstanding amount month
                $oneYearInterest = ($totalOutStandingBeforeSubmit * $rateOfInterest) / 100;
                $oneMonthInterest = $oneYearInterest / 12;
                $oneDayInterestP = $oneYearInterest / 365;

                $totalInterestStartDays = $oneDayInterestP * $numOfDaysStart; // For start days
                $totalInterestEndDays = $oneDayInterestN * $numOfDaysEnd; // For End days
                $startMonthEmi = $totalInterestStartDays + $totalInterestEndDays; // 1st emi
                // For current month emi submit outstanding amount month

                //echo $startMonthEmi.'<br>'.$totalInterestStartDays.'<br>'.$totalInterestEndDays.'<br>'.$emiAmount; exit;
                $srn = 1;
                foreach ($LeftEmis as $lrow) {
                    $emiId = $lrow->id;
                    if ($srn == 1) {
                        $emiAmount = $startMonthEmi;
                        $balance = $totalOutStandingNow;
                        $interest = $emiAmount;
                    } else {
                        $emiAmount = $newEmiAmount;
                        $interest = $emiAmount;
                        $balance = $totalOutStandingNow;
                    }

                    // if($srn==$totalEMis){
                    //     $interest=$newEmiAmount;
                    //     $emiAmount=$balance+$newEmiAmount;
                    //     $balance=0;
                    // }
                    $tdsAmount = (round($emiAmount) * $loanDetails->tds) / 100;
                    $netInterest = round($emiAmount) - $tdsAmount;

                    LoanEmiDetail::where('id', $emiId)->update(['emiAmount' => $emiAmount, 'netemiAmount' => ($emiAmount - $tdsAmount), 'tdsAmount' => $tdsAmount, 'netInterest' => $netInterest, 'interest' => $interest, 'balance' => $balance]);
                    $srn++;
                }

                DB::select("UPDATE apply_loan_histories set totalInterest=(SELECT IFNULL(SUM(interest),0) FROM loan_emi_details WHERE loanId='$loanId'), monthlyEMI='$newEmiAmount' WHERE id='$loanId'");
            }
        }
        return true;
        //OutStandingPaymentHistory::
    }

    public function ocr_adhaar_verification()
    {
        $obj = new GloadController();
        // $RES=$obj->ocr_adhaar_verification(7);
        echo '<pre>';
        print_r($RES);
        exit;
    }
}
