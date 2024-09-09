<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\AppServiceProvider;
use App\Models\User;
use App\Models\UserRole;
use App\Models\EmploymentHistory;
use App\Models\UserBankDetail;
use App\Models\UserDoc;
use App\Models\UserOtp;
use App\Models\ApplyLoanHistory;
use App\Models\CareerPost;
use App\Models\LoanEmiDetail;
use App\Models\Setting;
use App\Models\Faq;
use App\Models\LoanKycOtherPendetail;
use App\Models\TechSupport;
use App\Models\SystemAccessLog;
use Auth;
use DB;
use Illuminate\Support\Facades\Session;
use stdClass;
use Validator;

class CommonController extends Controller
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
        return view('login');
    }


    public function superAdminlogin(Request $request)
    {
        if (auth()->check() && auth()->user()->email != 'admin@gmail.com') {
            Auth::logout();
        }
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->email != "admin@gmail.com") {
            $validator->errors()->add('email', "Invalid Email Address.");
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $password = md5($request->password);
        
        $userDtl = DB::select("SELECT u.* FROM users u  WHERE u.email='$email' AND u.password='$password' AND u.status=1");
        // dd(count($userDtl));
        if (count($userDtl)) {
            $userId = $userDtl[0]->id;
            $loggedIn = Auth::loginUsingId($userId, true);
            // dd($loggedIn);
            if ($loggedIn) {
                $currentDateTime = date('Y-m-d H:i:s');
                $ipAddress = AppServiceProvider::get_client_ip();
                $accessLoginId = SystemAccessLog::insertGetId(['userId' => $userId, 'ipAddress' => $ipAddress, 'loginDateTime' => $currentDateTime, 'created_at' => $currentDateTime, 'updated_at' => $currentDateTime]);
                // session(['userPermissions' => $userDtl[0]->userRolePermissions, 'accessLoginId' => $accessLoginId]);
                // dd('asdasd');
                return redirect()->back();
            } else {
                return redirect()->back()->with('Somthing Went Wrong');
            }
        }
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        $userDtl = DB::select("SELECT u.*,ur.userPermissions as userRolePermissions FROM users u LEFT JOIN user_roles ur ON u.userType=ur.id WHERE u.email='$email' AND u.password='$password' AND u.status=1 AND ur.status=1 AND  ur.id IS NOT NULL");
        if (count($userDtl)) {
            $userId = $userDtl[0]->id;
            $loggedIn = Auth::loginUsingId($userId, true);

            if ($loggedIn) {
                $currentDateTime = date('Y-m-d H:i:s');
                $ipAddress = AppServiceProvider::get_client_ip();
                $accessLoginId = SystemAccessLog::insertGetId(['userId' => $userId, 'ipAddress' => $ipAddress, 'loginDateTime' => $currentDateTime, 'created_at' => $currentDateTime, 'updated_at' => $currentDateTime]);
                session(['userPermissions' => $userDtl[0]->userRolePermissions, 'accessLoginId' => $accessLoginId]);
                //return redirect()->route('adminDashboard');
                echo json_encode(['status' => 'success', 'message' => 'You have logged-in successfully.', 'URL' => route('adminDashboard')]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid credentials, Please try again.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid credentials, Please try again.']);
        }
    }

    public function sendMsgForEmiReminder()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $today = date('Y-m-d');

        $pendingList = DB::select("SELECT ed.*,u.customerCode,u.nameTitle,u.name,u.mobile,u.email FROM loan_emi_details ed LEFT JOIN users u ON ed.userId=u.id WHERE MONTH(ed.emiDueDate)='$currentMonth' AND YEAR(ed.emiDueDate)='$currentYear' AND ed.status !='success'");
        $RES = 0;
        if (count($pendingList)) {
            $sentMsgArr = [];
            foreach ($pendingList as $row) {

                $emiId = $row->id;
                $reminderSent = $row->reminderSent;
                $reminderSentDate = $row->reminderSentDate;
                $emiAmount = $row->emiAmount;
                $mobileNumber = $row->mobile;

                $emiDueMonth = date('F', strtotime($row->emiDueDate));
                $emiDueDate = date('d M, Y', strtotime($row->emiDueDate));

                $paymentLink = '';
                $textMessage = 'Hello ' . $row->name . ', Your payment of Rs. ' . $emiAmount . ' for the EMI of ' . $emiDueMonth . ' is due on ' . $emiDueDate . '. Please pay on time to avoid late payment charges. You can directly pay your EMI just by clicking here. Login & pay now: ' . $paymentLink . ' -Team Maxemo';
                //echo $textMessage; exit;
                if ($reminderSent == 0) {
                    $reminderSent = $reminderSent + 1;
                    if (config('app.env') == "production") {
                        $RES = AppServiceProvider::sendSms($mobileNumber, $textMessage);
                    }
                    $sentMsgArr[] = $mobileNumber;
                } else {
                    if ($today != $reminderSentDate) {
                        $reminderSent = $reminderSent + 1;
                        if (config('app.env') == "production") {
                            $RES = AppServiceProvider::sendSms($mobileNumber, $textMessage);
                        }
                        $sentMsgArr[] = $mobileNumber;
                    }
                }

                if ($RES) {
                    LoanEmiDetail::where('id', $emiId)->update(['reminderSent' => $reminderSent, 'reminderSentDate' => $today]);
                }
            }
        }
        echo ($RES) ? 'Message Sent : ' . implode(',', $sentMsgArr) : 'All Done';
    }

    public function sendLoginOTP(Request $request)
    {
        $mobile = $request->mobile;

        $userDtl = User::where(['mobile' => $mobile, 'status' => 1, 'userType' => 'user'])->first();
        if (!empty($userDtl)) {
            $OTP = $this->generateOTP();
            $userOtpDtl = UserOtp::where(['mobileEmail' => $mobile])->first();
            if (!empty($userOtpDtl)) {
                $save = UserOtp::where(['mobileEmail' => $mobile])->update(['sendOtp' => $OTP]);
            } else {
                $saveUp['mobileEmail'] = $mobile;
                $saveUp['sendOtp'] = $OTP;
                $saveUp['created_at'] = date('Y-m-d H:i:s');
                $saveUp['updated_at'] = date('Y-m-d H:i:s');
                $save = DB::table('user_otps')->insertGetId($saveUp);
            }

            if ($save) {
                $textMessage = $OTP . ' is the OTP to process your Loan Application with Maxemo Capital Services Pvt. Ltd. Valid for 10 mins. DO NOT share with anyone - Team Maxemo';
                if (config('app.env') == "production") {
                    $RES = AppServiceProvider::sendSms($mobile, $textMessage);
                }

                echo json_encode(['status' => 'success', 'message' => 'OTP has been sent successfully.', 'res' => $RES ?? '']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Unable to send otp, Please try again.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Please enter registered mobile number.']);
        }
    }

    public function verifyLoginOTP(Request $request)
    {
        $mobile = $request->mobile;
        $sendOtp = $request->sendOtp;

        $userDtl = User::where(['mobile' => $mobile, 'status' => 1, 'userType' => 'user'])->first();
        if (!empty($userDtl)) {
            $userOtpDtl = UserOtp::where(['mobileEmail' => $mobile, 'sendOtp' => $sendOtp])->first();
            if (!empty($userOtpDtl)) {
                $loggedIn = Auth::loginUsingId($userDtl->id, true);

                UserOtp::where(['mobileEmail' => $mobile])->delete();

                echo json_encode(['status' => 'success', 'message' => 'OTP has been verified successfully.', 'URL' => route('userDashboard')]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid OTP, Please try again.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Please enter registered mobile number.']);
        }
    }

    public function careerPost()
    {
        $allcareers = CareerPost::orderBy('id', 'DESC')->paginate(10);
        return view('pages.carrers.list', compact('allcareers'));
    }

    public function careerPostAdd(Request $request)
    {
        if ($request->isMethod("POST")) {
            $this->validate($request, [
                'title' => 'required|min:5',
                'no_of_postions' => 'required|numeric',
                'joblocation' => 'required',
                'description' => 'required|min:20',
                'jobStartDate' => 'required|date',
                'jobEndDate' => 'nullable|date'
            ]);

            $datasave = CareerPost::create([
                'title' => $request->title,
                'location' => $request->joblocation,
                'no_of_postions' => $request->no_of_postions,
                'details' => $request->description,
                'opening_date' => $request->jobStartDate,
                'closing_date' => $request->jobEndDate,
            ]);

            if ($datasave) {
                return redirect()->route('careerPosts')->with('success', 'Career Post Added Successfully !');
            }
            return redirect()->route('careerPosts')->with('failed', 'Career Post Added Failed !');
        }

        return view('pages.carrers.add');
    }

    public function careerPostEdit(Request $request, $id)
    {
        $careerData = CareerPost::where('id', $id)->first();
        if ($request->isMethod("POST")) {
            $this->validate($request, [
                'title' => 'required|min:5',
                'no_of_postions' => 'required|numeric',
                'joblocation' => 'required',
                'description' => 'required|min:20',
                'jobStartDate' => 'required|date',
                'jobEndDate' => 'nullable|date'
            ]);

            $datasave = CareerPost::where('id', $id)->update([
                'title' => $request->title,
                'location' => $request->joblocation,
                'no_of_postions' => $request->no_of_postions,
                'details' => $request->description,
                'opening_date' => $request->jobStartDate,
                'closing_date' => $request->jobEndDate,
            ]);

            if ($datasave) {
                return redirect()->route('careerPosts')->with('success', 'Career Post Updated Successfully !');
            }
            return redirect()->route('careerPosts')->with('failed', 'Career Post Updated Failed !');
        }

        return view('pages.carrers.edit', compact('careerData'));
    }

    public function generateOTP()
    {
        genOTP:
        $otp = rand(000000, 999999);
        if (strlen($otp) < 6) {
            goto genOTP;
        }
        return $otp;
    }

    public function creditScore()
    {
        AppServiceProvider::checkUserLogin();
        $settings = Setting::where('id', 1)->first();
        return view('pages.system-algorithm.credit-score', compact('settings'));
    }


    public function equifaxReport(Request $request, $user_id)
    {
    
        // dd('--');
   
        try{

        if ($request->loadreport == 1 || $request->type == "user") {
            $userDatan = User::where('id', $user_id)->first();
            $error = 0;
            if ($userDatan->creditscore_apidata) {
                $userData = json_decode($userDatan->creditscore_apidata, FALSE);
                // $error = isset($userData['Error']) ? 1 : 0;
                // dd($userData);
                return view('pages.reports.equifax-report', compact('userData'));
            } else {
                $userData = $userDatan;
            }
        }

        if ($request->loadreport == 2 || $request->type == "company") {
            $companyData = DB::table('employment_histories')->where(['userId' => $user_id, 'status' => 'approved', 'companyType' => 'Pvt. Ltd.'])->first();
            $urData = User::where('id', $user_id)->first();
            $error = 0;
            if ($companyData->company_creditscore_apidata) {
                $userData = json_decode($companyData->company_creditscore_apidata, FALSE);
                // $error = isset($userData['Error']) ? 1 : 0;
                return view('pages.reports.equifax-report', compact('userData'));
            }
        }



        if ($request->loadreport == 3 || $request->type == "partner") {
            $partner = LoanKycOtherPendetail::where(['id' => $user_id])->first();
            $error = 0;
            if ($partner->creditscore_apidata) {
                $userData = json_decode($partner->creditscore_apidata, FALSE);
                // $error = isset($userData['Error']) ? 1 : 0;
                return view('pages.reports.equifax-report', compact('userData'));
            } else {
                $userData = $partner;
            }
        }
        



        if ((($request->loadreport == 1 || $request->loadreport == 2 || $request->loadreport == 3) && (isset($userData) || isset($companyData)))) {
       
            if ($request->loadreport == 1 || $request->loadreport == 3) {
                $customerdata = array();
                $customerdata['name'] = $userData->name;
                $customerdata['addressLine1'] = $userData->addressLine1 ?? '';
                $customerdata['city'] = $userData->city ?? '';
                $customerdata['state'] =  $userData->state_short ?? null;
                $customerdata['pincode'] = $userData->pincode;
                $customerdata['mobile'] = $userData->mobile ?? auth()->user()->mobile;
                $customerdata['email'] = $userData->email ?? auth()->user()->email;
                $customerdata['pancard_no'] = $userData->pancard_no;
                $customerdata['dateOfBirth'] = $userData->dateOfBirth;
                if ($userData->gender == 'Male') {
                    $customerdata['gender'] = 'M';
                } elseif ($userData->gender == 'Female') {
                    $customerdata['gender'] = 'F';
                } else {
                    $customerdata['gender'] = 'O';
                }
                $customerdata['fatherName'] = $userData->fatherName??'';
                if ($request->loadreport == 1) {
                    if (!$customerdata['dateOfBirth']) {
                        return redirect()->back()->with('error', 'Please Fill Customer Date Of Birth');
                    } elseif (!$customerdata['state']) {
                        // dd('--');
                        return redirect()->back()->with('error', 'Please Fill Customer State');
                    } elseif (!$customerdata['pancard_no']) {
                        return redirect()->back()->with('error', 'Please Fill Customer Pancard Number');
                    }
                } else if ($request->loadreport == 3) {
                    if (!$customerdata['dateOfBirth']) {
                        return redirect()->back()->with('error', 'Please Fill Partner Date Of Birth');
                    } elseif (!$customerdata['state']) {
                        // dd('--');
                        return redirect()->back()->with('error', 'Please Fill Partner State');
                    } elseif (!$customerdata['pancard_no']) {
                        return redirect()->back()->with('error', 'Please Fill Partner Pancard Number');
                    }
                }
            } elseif ($request->loadreport == 2) {
            
                $customerdata = array();
                $customerdata['name'] = $companyData->employerName;
                $customerdata['addressLine1'] = $companyData->address ?? '';
                $customerdata['city'] = $companyData->district ?? '';
                $customerdata['state'] =  $companyData->state_short ?? null;
                $customerdata['pincode'] = $companyData->pincode;
                $customerdata['mobile'] = $companyData->mobileNo ?? auth()->user()->mobile;
                $customerdata['email'] = $companyData->emailId ?? auth()->user()->email;
                $customerdata['pancard_no'] = $companyData->companyPan;
                $customerdata['dateOfBirth'] = $urData->dateOfBirth??'';
                if ($urData->gender == 'Male') {
                    $customerdata['gender'] = 'M';
                } elseif ($urData->gender == 'Female') {
                    $customerdata['gender'] = 'F';
                } else {
                    $customerdata['gender'] = 'O';
                }
                $customerdata['fatherName'] = $urData->fatherName??'';
                foreach($this->indianStates as $kk=>$sta){
                    if(strtolower($sta) == strtolower($companyData->state)){
                        $customerdata['state'] = $kk;
                    }
                }
                // dd($companyData);
                if (!$customerdata['dateOfBirth']) {
                    return redirect()->back()->with('error', 'Please Fill Customer Date Of Birth');
                } elseif (!$customerdata['state']) {
                    return redirect()->back()->with('error', 'Please Fill Customer State');
                } elseif (!$customerdata['pancard_no']) {
                    return redirect()->back()->with('error', 'Please Fill Customer Pancard Number');
                }
            }
            $lobObj = new GloadController();
            if ($customerdata) {
                if (config('app.env') == "production") {
                    $equifaxData = $lobObj->eportuatData($customerdata);
                } else {
                    $equifaxData = null;
                }
                $score = 0;
                if (isset($equifaxData['CCRResponse']['CIRReportDataLst'][0]['CIRReportData']) && $equifaxData['CCRResponse']['CIRReportDataLst'][0]['CIRReportData']['ScoreDetails'][0]['Value']) {
                    $score = $equifaxData['CCRResponse']['CIRReportDataLst'][0]['CIRReportData']['ScoreDetails'][0]['Value'];
                } else if (isset($equifaxData['CCRResponse']['CIRReportDataLst'][0]['CIRReportData']) && $equifaxData['CCRResponse']['CIRReportDataLst'][1]['CIRReportData']['ScoreDetails'][0]['Value']) {
                    $score = $equifaxData['CCRResponse']['CIRReportDataLst'][1]['CIRReportData']['ScoreDetails'][0]['Value'];
                }

                if ($request->loadreport == 1) {
                    User::where('id', $user_id)->update(['credit_score' => $score, 'creditscore_apidata' => json_encode($equifaxData)]);
                } elseif ($request->loadreport == 2) {
                    EmploymentHistory::where(['userId' => $user_id, 'status' => 'approved', 'companyType' => 'Pvt. Ltd.'])->update(['company_credit_score' => $score, 'company_creditscore_apidata' => json_encode($equifaxData)]);
                } elseif ($request->loadreport == 3) {
                
                    LoanKycOtherPendetail::where('id', $user_id)->update(['credit_score' => $score, 'creditscore_apidata' => json_encode($equifaxData)]);
                }
                $userData = json_decode(json_encode($equifaxData), FALSE);

                return view('pages.reports.equifax-report', compact('userData'));
            }
        }
        if ($userData && $userData->creditscore_apidata && $userData->credit_score > 0) {
            $userDatan = User::where('id', $user_id)->first();
            $userData = json_decode($userDatan->creditscore_apidata, FALSE);
            return view('pages.reports.equifax-report', compact('userData'));
        } elseif (isset($companyData) && $companyData->company_creditscore_apidata && $companyData->company_credit_score > 0) {
            $companyData = DB::table('employment_histories')->where(['userId' => $user_id, 'status' => 'approved', 'companyType' => 'Pvt. Ltd.'])->first();
            $userData = json_decode($companyData->company_creditscore_apidata, FALSE);
            return view('pages.reports.equifax-report', compact('userData'));
        } else {
            return redirect()->back();
        }
    }catch(\Exception $e){
        dd($e->getMessage());
    }
    }

    public function techSupport()
    {
        AppServiceProvider::checkUserLogin();
        return view('pages.important-links.tech-support');
    }

    public function filterSupportQuery(Request $request)
    {
        AppServiceProvider::checkUserLogin();

        $filterPriority = $request->filterPriority;
        $fromDate = (strtotime($request->fromDate)) ? date('Y-m-d', strtotime($request->fromDate)) : '';
        $toDate = (strtotime($request->toDate)) ? date('Y-m-d', strtotime($request->toDate)) : '';
        $filterStatus = $request->filterStatus;
        $SUBQRY = '';
        if ($filterPriority) {
            $SUBQRY .= " AND priority='$filterPriority'";
        }
        if ($filterStatus) {
            $SUBQRY .= " AND status='$filterStatus'";
        }
        if ($fromDate && $toDate) {
            $SUBQRY .= " AND date(created_at)>='$fromDate' AND date(created_at)<='$toDate'";
        }

        $results = DB::select("SELECT * FROM tech_supports WHERE id>0 $SUBQRY ORDER BY id DESC");
        $htmlStr = '<table class="is-hoverable w-full text-left faq_table" >
                  <thead>
                  <tr>
                      <th class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Ticket ID</th>
                      <th class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Ticket Title</th>
                      <th class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Ticket Date</th>
                      <th class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Description</th>
                      <th class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Priority</th>
                      <th class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Status</th>
                      <th class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Image</th>
                      <th class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Action</th>
                  </tr>
                  </thead>';
        if (count($results)) {
            $htmlStr .= '<tbody>';
            foreach ($results as $row) {
                $TKTPRE = "#TKT";
                if ($row->id < 1000) {
                    $TKTSUF = '000' . $row->id;
                } else if ($row->id < 100) {
                    $TKTSUF = '00' . $row->id;
                } else if ($row->id < 10) {
                    $TKTSUF = '0' . $row->id;
                } else {
                    $TKTSUF = $row->id;
                }

                $TKTNO = $TKTPRE . $TKTSUF;

                $priorityStr = '<div class="dropdown action-label">';
                if ($row->priority == 'High') {
                    $priorityStr .= '<a class="btn btn-white btn-sm btn-rounded dropdown-toggle " href="#" data-bs-toggle="dropdown" aria-expanded="true"><i class="fa fa-dot-circle-o text-danger"></i> High </a>';
                } else if ($row->priority == 'Low') {
                    $priorityStr .= '<a class="btn btn-white btn-sm btn-rounded dropdown-toggle " href="#" data-bs-toggle="dropdown" aria-expanded="true"><i class="fa fa-dot-circle-o text-success"></i> Low </a>';
                } else if ($row->priority == 'Medium') {
                    $priorityStr .= '<a class="btn btn-white btn-sm btn-rounded dropdown-toggle " href="#" data-bs-toggle="dropdown" aria-expanded="true"><i class="fa fa-dot-circle-o text-warning"></i> Medium </a>';
                }

                $priorityStr .= '<div class="dropdown-menu dropdown-menu-right " data-popper-placement="bottom-start">
                            <a class="dropdown-item" href="javascript:;" onclick="changePriorityStatus(' . $row->id . ',3);"><i class="fa fa-dot-circle-o text-danger"></i> High</a>
                            <a class="dropdown-item" href="javascript:;" onclick="changePriorityStatus(' . $row->id . ',2);"><i class="fa fa-dot-circle-o text-warning"></i> Medium</a>
                            <a class="dropdown-item" href="javascript:;" onclick="changePriorityStatus(' . $row->id . ',1);"><i class="fa fa-dot-circle-o text-success"></i> Low</a>
                        </div>
                    </div>';

                $statusStr = '<div class="dropdown action-label">';
                if ($row->status == 'New') {
                    $statusStr .= '<a class="btn btn-white btn-sm btn-rounded dropdown-toggle " href="#" data-bs-toggle="dropdown" aria-expanded="true"><i class="fa fa-dot-circle-o text-danger"></i> New </a>';
                } else if ($row->status == 'Working') {
                    $statusStr .= '<a class="btn btn-white btn-sm btn-rounded dropdown-toggle " href="#" data-bs-toggle="dropdown" aria-expanded="true"><i class="fa fa-dot-circle-o text-warning"></i> Working </a>';
                } else if ($row->status == 'Closed') {
                    $statusStr .= '<a class="btn btn-white btn-sm btn-rounded dropdown-toggle " href="#" data-bs-toggle="dropdown" aria-expanded="true"><i class="fa fa-dot-circle-o text-success"></i> Closed </a>';
                }
                $statusStr .= '<div class="dropdown-menu dropdown-menu-right " data-popper-placement="bottom-start">
                            <a class="dropdown-item" href="javascript:;" onclick="changeTktStatus(' . $row->id . ',1);"><i class="fa fa-dot-circle-o text-danger"></i> New</a>
                            <a class="dropdown-item" href="javascript:;" onclick="changeTktStatus(' . $row->id . ',2);"><i class="fa fa-dot-circle-o text-warning"></i> Working</a>
                            <a class="dropdown-item" href="javascript:;" onclick="changeTktStatus(' . $row->id . ',3);"><i class="fa fa-dot-circle-o text-success"></i> Closed</a>
                        </div>
                    </div>';

                $tktImg = '';
                if ($row->images) {
                    $tktImg = '<a href="' . env('APP_URL') . 'public/' . $row->images . '" target="_blank">
                            <img src="' . env('APP_URL') . 'public/' . $row->images . '" style="width: 80px;height: 80px;object-fit: contain;">
                        </a>';
                }

                $ticketDate = (strtotime($row->ticketDate)) ? date('d M, Y', strtotime($row->ticketDate)) : date('d M, Y', strtotime($row->created_at));
                $htmlStr .= '<tr>
                        <td>' . $TKTNO . '</td>
                        <td>' . $row->title . '</td>
                        <td>' . $ticketDate . '</td>
                        <td>' . $row->description . '</td>

                        <td>
                            ' . $priorityStr . '
                        </td>
                        <td>
                            ' . $statusStr . '
                        </td>
                        <td>' . $tktImg . '</td>
                        <td>
                        <div class="d-flex">
                             <a href="javascript:void(0);" tktTitle="' . $row->title . '" tktDesc="' . $row->description . '" tktPriority="' . $row->priority . '" tktStatus="' . $row->status . '" tktDate="' . $row->ticketDate . '" id="editTkt' . $row->id . '" onclick="editTkt(' . $row->id . ')" class="action-btns1" ><i data-feather="edit-2" class="fas fa-pencil text-success"></i> </a>
                             <!--<a href="javascript:void(0);" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i data-feather="trash-2" class="fas fa-trash text-danger"></i></a>-->
                            </div>
                        </td>
                      </tr>';
            }
            $htmlStr .= '</tbody>';
        }
        $htmlStr .= '</table>';
        echo $htmlStr;
    }

    public function saveTicketDetails(Request $request)
    {
        AppServiceProvider::checkUserLogin();

        $recordId = $request->recordId;
        $tktTitle = $request->tktTitle;
        $tktPriority = $request->tktPriority;
        $tktDate = (strtotime($request->tktDate)) ? date('Y-m-d', strtotime($request->tktDate)) : date('Y-m-d H:i:s');
        $tktStatus = $request->tktStatus;
        $tktDesc = $request->tktDesc;

        $image = '';
        if (!empty($request->myDropify)) {
            $image = AppServiceProvider::uploadImageCustom('myDropify', 'tech-support');
            $upArr['images'] = $image;
        }

        $upArr['title'] = $tktTitle;
        $upArr['priority'] = $tktPriority;
        $upArr['ticketDate'] = $tktDate;
        $upArr['status'] = $tktStatus;
        $upArr['description'] = $tktDesc;

        if (!empty($recordId)) {
            $save = TechSupport::where('id', $recordId)->update($upArr);
        } else {
            $save = TechSupport::create($upArr);
        }

        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Ticket Details has been saved successfully.', 'URL' => route('adminDashboard')]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }

    public function changePriorityStatus(Request $request)
    {
        AppServiceProvider::checkUserLogin();

        $recordId = $request->recordId;
        $status = $request->status;
        $save = TechSupport::where('id', $recordId)->update(['priority' => $status]);
        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Your request has been processed successfully.', 'URL' => route('adminDashboard')]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }

    public function changeTicketStatus(Request $request)
    {
        AppServiceProvider::checkUserLogin();

        $recordId = $request->recordId;
        $status = $request->status;
        $save = TechSupport::where('id', $recordId)->update(['status' => $status]);
        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Your request has been processed successfully.', 'URL' => route('adminDashboard')]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }

    public function saveCibilScore(Request $request)
    {
        AppServiceProvider::checkUserLogin();

        $save = Setting::where('id', 1)->update(['minCibilScoreForApply' => $request->minCibilScoreForApply]);
        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Credit score has been saved successfully.', 'URL' => route('adminDashboard')]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }

    public function privacyPolicy()
    {
        AppServiceProvider::checkUserLogin();

        $settings = Setting::where('id', 1)->first();
        return view('pages.important-links.privacy-policy', compact('settings'));
    }

    public function savePrivacyPolicy(Request $request)
    {
        AppServiceProvider::checkUserLogin();

        $settings = Setting::where('id', 1)->update(['privacyPolicy' => $request->privacyPolicy]);
        return redirect()->route('privacyPolicy');
    }

    public function termsAndConditions()
    {
        AppServiceProvider::checkUserLogin();

        $settings = Setting::where('id', 1)->first();
        return view('pages.important-links.terms-condition', compact('settings'));
    }

    public function saveTermsAndConditions(Request $request)
    {
        AppServiceProvider::checkUserLogin();

        $settings = Setting::where('id', 1)->update(['termsAndConditions' => $request->termsAndConditions]);
        return redirect()->route('termsAndConditions');
    }

    public function faqList(Request $request)
    {
        AppServiceProvider::checkUserLogin();

        $faqs = Faq::orderBy('qnsSort', 'asc')->get();
        return view('pages.important-links.faq', compact('faqs'));
    }

    public function saveFaq(Request $request)
    {
        AppServiceProvider::checkUserLogin();

        $recordId = $request->recordId;
        $qnsTitle = $request->qnsTitle;
        $qnsAns = $request->qnsAns;
        $qnsSort = $request->qnsSort;

        $upArr['qnsTitle'] = $qnsTitle;
        $upArr['qnsAns'] = $qnsAns;
        $upArr['qnsSort'] = $qnsSort;

        if (!empty($recordId)) {
            $save = Faq::where('id', $recordId)->update($upArr);
        } else {
            $save = Faq::create($upArr);
        }

        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Faq Details has been saved successfully.', 'URL' => route('adminDashboard')]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }


    public function customReports($pageName, $pageTitle)
    {
        AppServiceProvider::checkUserLogin();

        $currentDate = date('Y-m-d');
        $pageTitle = urldecode($pageTitle);
        $pageNameStr = strtolower(str_replace([' ', '`', ',', '"', "'", '_', '@', '#', '!', '$', '%', '^', '&', '*', '(', ')', '{', '}', '[', ']'], '-', $pageTitle));

        return view('pages.reports.report-list', compact('pageTitle', 'pageNameStr', 'pageName'));
    }

    public function customReportsFilter(Request $request)
    {
        AppServiceProvider::checkUserLogin();

        $fromDate = (strtotime($request->fromDate)) ? date('Y-m-d', strtotime($request->fromDate)) : '';
        $toDate = (strtotime($request->toDate)) ? date('Y-m-d', strtotime($request->toDate)) : '';

        $pageName = $request->pageName;
        $loanType = $request->loanType??null;

        //        over-due-payments
        //        received-payments
        $loanStatus = '';
        if ($pageName == 'new-customers' || $pageName == 'approved-loans' || $pageName == 'disbursed-loans' || $pageName == 'disbursement-pending') {
            $HTML = $this->loanStatusCustomReport($pageName, $fromDate, $toDate);
        } elseif ($pageName == 'raw-over-due-payments') {
            $HTML = $this->getRawOverDueReport($pageName, $fromDate, $toDate);
        } else {
            $HTML = $this->getEmiStatusReportByType($pageName, $fromDate, $toDate,$loanType);
        }


        echo $HTML;
    }



    public function getRawOverDueReport($pageName, $fromDate, $toDate)
    {

        // $month=(strtotime($fromDate)) ? date('m',strtotime($fromDate)) : date('m');
        // $year=(strtotime($fromDate)) ? date('Y',strtotime($fromDate)) : date('Y');
        $today = date('Y-m-d');
        // if(date('d') > 12){
        //     $lateDueEmi = date("12-m-Y");
        // }else{
        // $lateDueEmi = date("Y-m-d", strtotime("+1 year"));
        // }

        $SUBQRY = '';
        if ($fromDate && $toDate) {
            $SUBQRY .= " AND date(rawl.tenureDueDate) BETWEEN date('$fromDate') AND date('$toDate')";
        } elseif ($fromDate) {
            $SUBQRY .= " AND date(rawl.tenureDueDate) >= date('$fromDate')";
        } elseif ($toDate) {
            $SUBQRY .= " AND date(rawl.tenureDueDate) <= date('$toDate')";
        } else {
            $SUBQRY .= " AND date(rawl.tenureDueDate) <= date('$today')";
        }
        

        if ($pageName == 'raw-over-due-payments') {
            $SUBQRY .= " AND rawl.status ='success' ";
        }

        $results = DB::select("SELECT u.id as userId,u.customerCode,u.name AS uname,u.email,u.mobile,alh.id as loanId,alh.productId,eh.employerName,rawl.openingDate,rawl.amount,rawl.openingBalanceLatest,rawl.status,rawl.tenureDueDate,tenures.name FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id LEFT JOIN raw_materials_txn_details rawl ON alh.id=rawl.loanId LEFT JOIN tenures ON rawl.approvedTenure = tenures.id LEFT JOIN employment_histories AS eh ON eh.userId=u.id WHERE u.id>0  AND rawl.txnType='out' AND rawl.openingBalanceLatest > 0  $SUBQRY  ORDER BY u.id DESC");
        $htmlStr = '<table id="mainTbl" class="table table-bordered">
                  <thead>
                  <tr>
                      <th>Sr. No.</th>
                      <th>Customer Code</th>
                      <th>Customer Name</th>
                      <th>Customer Email</th>
                      <th>Customer Mobile</th>
                      <th>Company Name</th>
                      <th>Withdraw Date</th>
                      <th>Withdraw Amount</th>
                      <th>Tenure</th>
                      <th>Due Amount</th>
                      <th>Due Days</th>
                      <th>Over Due Date</th>';

        $htmlStr .= '</tr></thead>';
        $totalOveDueEmi = 0;
        if (count($results)) {
            $htmlStr .= '<tbody>';
            $rsr = 1;
            foreach ($results as $row) {
                $totalOveDueEmi += $row->amount;

                $openingDate = (strtotime($row->openingDate)) ? date('d m,Y', strtotime($row->openingDate)) : '';
                $tenureDueDate = (strtotime($row->tenureDueDate)) ? date('d m,Y', strtotime($row->tenureDueDate)) : '';

                $to = \Carbon\Carbon::createFromFormat('y-m-d', date('y-m-d'));
                $from = \Carbon\Carbon::createFromFormat('y-m-d', date('y-m-d', strtotime($row->tenureDueDate)));

                $days = $to->diffInDays($from);

                $htmlStr .= '<tr>';
                $htmlStr .= '<td>' . $rsr . '</td>';
                $htmlStr .= '<td>' . $row->customerCode . '</td>';
                $htmlStr .= '<td>' . $row->uname . '</td>';
                $htmlStr .= '<td>' . $row->email . '</td>';
                $htmlStr .= '<td>' . $row->mobile . '</td>';
                $htmlStr .= '<td>' . $row->employerName . '</td>';
                $htmlStr .= '<td>' . $openingDate . '</td>';
                $htmlStr .= '<td>' . $row->amount . '</td>';
                $htmlStr .= '<td>' . $row->name . '</td>';
                $htmlStr .= '<td>' . $row->openingBalanceLatest . '</td>';
                $htmlStr .= '<td>' . $days . ' Day</td>';
                $htmlStr .= '<td>' . $tenureDueDate . '</td>';

                $htmlStr .= '</tr>';
                $rsr++;
            }
            $htmlStr .= '</tbody>';
        }
        $htmlStr .= '</table><span hidden id="overDueAmountHidden">' . number_format($totalOveDueEmi, 2) . '</span>';
        return $htmlStr;
    }

    public function getEmiStatusReportByType($pageName, $fromDate, $toDate,$loanType=null)
    {

        $month = (strtotime($fromDate)) ? date('m', strtotime($fromDate)) : date('m');
        $year = (strtotime($fromDate)) ? date('Y', strtotime($fromDate)) : date('Y');
        $today = date('Y-m-d');
        // if(date('d') > 12){
        $lateDueEmi = date("Y-m-d");
        // }else{
        //     $lateDueEmi = date("Y-m-12", strtotime("-1 months"));
        // }


        $loanStatus = '';

        $SUBQRY = '';
        if ($pageName == 'over-due-payments') {
            if ($fromDate && $toDate) {
                $SUBQRY .= " AND date(led.emiDueDate) BETWEEN date('$fromDate') AND date('$toDate') AND led.status='pending'";
            } elseif ($fromDate) {
                $SUBQRY .= " AND date(led.emiDueDate) >= date('$fromDate') AND led.status='pending'";
            } elseif ($toDate) {
                $SUBQRY .= " AND date(led.emiDueDate) <= date('$toDate') AND led.status='pending'";
            } else {
                $SUBQRY .= " AND date(led.emiDueDate) <= date('$today') AND  led.status='pending'";
            }
            if($loanType){
                $SUBQRY .= " AND alh.loanCategory=$loanType";
            }
        }

        if ($pageName == 'received-payments') {
            $SUBQRY .= " AND MONTH(led.emiDate)='$month' AND YEAR(led.emiDate)='$year' AND led.status='success'";
        }

        // echo "SELECT u.id as userId,u.customerCode,u.name,u.email,u.mobile,alh.id as loanId,alh.productId,alh.loanAmount appliedLoanAmount,alh.tenure as appliedTenureId,alh.approvedTenure as approvedTenureId,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.approvedAmount,alh.status as loanStatus,alh.disbursedDate,alh.remark,led.emiAmount,led.emiDate,led.emiDueDate,led.status,led.transactionId,led.payment_mode,led.transactionDate,led.lateCharges FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id LEFT JOIN loan_emi_details led ON alh.id=led.loanId WHERE u.id>0 $SUBQRY ORDER BY alh.id DESC";


        $results = DB::select("SELECT u.id as userId,u.customerCode,categories.name AS cname,u.name,u.email,u.mobile,alh.id as loanId,alh.productId,alh.loanAmount appliedLoanAmount,alh.tenure as appliedTenureId,alh.approvedTenure as approvedTenureId,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.approvedAmount,alh.status as loanStatus,alh.disbursedDate,alh.remark,alh.loanCategory,led.emiAmount,led.emiDate,led.emiDueDate,led.status,led.transactionId,led.payment_mode,led.transactionDate,led.lateCharges FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id LEFT JOIN loan_emi_details led ON alh.id=led.loanId LEFT JOIN categories ON categories.id=alh.loanCategory WHERE u.id>0 $SUBQRY ORDER BY alh.id DESC");
        $htmlStr = '<table id="mainTbl" class="table table-bordered">
                  <thead>
                  <tr>
                      <th>Sr. No.</th>
                      <th>Customer Code</th>';
        if ($pageName == 'over-due-payments') {
            $htmlStr .=  '<th>Loan Type</th>';
        }
        $htmlStr .=     '<th>Customer Name</th>
                      <th>Customer Email</th>
                      <th>Customer Mobile</th>
                      <th>EMI Amount</th>
                      <th>EMI Date</th>
                      <th>EMI Due Date</th>';
        if ($pageName == 'over-due-payments') {
            $htmlStr .= '<th>Due Days</th>';
        }
        if ($pageName == 'received-payments') {
            $htmlStr .= '<th>Transaction Id</th>
                      <th>Payment Mode</th>';
        }
        if ($pageName != 'over-due-payments') {
            $htmlStr .=  '<th>Late Charges</th>';
        }

        if ($pageName == 'received-payments') {
            $htmlStr .=  '<th>Payment Status</th>
                      <th>Transaction Date</th>';
        }
        $htmlStr .= '</tr></thead>';
        $totalOveDueEmi = 0;
        if (count($results)) {
            $htmlStr .= '<tbody>';
            $rsr = 1;
            foreach ($results as $row) {
                $totaldays =0;
                if($pageName == 'over-due-payments'){
                    $now = strtotime($today);
                    $your_date = strtotime($row->emiDueDate);
                    $datediff = $now - $your_date;
                    $totaldays = abs(round($datediff / (60 * 60 * 24)));
                }

                $totalOveDueEmi += $row->emiAmount;

                $transactionDate = (strtotime($row->transactionDate)) ? date('d/m/Y', strtotime($row->transactionDate)) : '';
                $emiDate = (strtotime($row->emiDate)) ? date('d/m/Y', strtotime($row->emiDate)) : '';
                $emiDueDate = (strtotime($row->emiDueDate)) ? date('d/m/Y', strtotime($row->emiDueDate)) : '';


                $htmlStr .= '<tr>';
                $htmlStr .= '<td>' . $rsr . '</td>';
                $htmlStr .= '<td>' . $row->customerCode . '</td>';
                if ($pageName == 'over-due-payments') {
                    $htmlStr .=  '<td>' . $row->cname . '</td>';
                }
                $htmlStr .= '<td>' . $row->name . '</td>';
                $htmlStr .= '<td>' . $row->email . '</td>';
                $htmlStr .= '<td>' . $row->mobile . '</td>';
                $htmlStr .= '<td>' . $row->emiAmount . '</td>';
                $htmlStr .= '<td>' . $emiDate . '</td>';
                $htmlStr .= '<td>' . $emiDueDate . '</td>';
                if ($pageName == 'over-due-payments') {
                    $htmlStr .=  '<td>' . $totaldays . '</td>';
                }
                if ($pageName == 'received-payments') {
                    $htmlStr .= '<td>' . $row->transactionId . '</td>';
                    $htmlStr .= '<td>' . ucwords($row->payment_mode) . '</td>';
                }
                if ($pageName != 'over-due-payments') {
                    $htmlStr .= '<td>' . $row->lateCharges . '</td>';
                }

                if ($pageName == 'received-payments') {
                    $htmlStr .= '<td>' . ucfirst($row->status) . '</td>';
                    $htmlStr .= '<td>' . $transactionDate . '</td>';
                }
                $htmlStr .= '</tr>';
                $rsr++;
            }
            $htmlStr .= '</tbody>';
            
        }

        $htmlStr .= '</table><span hidden id="overDueAmountHidden">' . number_format($totalOveDueEmi, 2) . '</span>';
        return $htmlStr;
    }

    public function loanStatusCustomReport($pageName, $fromDate, $toDate)
    {
        $loanStatus = 'disburse-scheduled';
        $loanStatus = '';

        $SUBQRY = '';
        if ($pageName == 'new-customers') {
            $SUBQRY .= " AND u.kycStatus='pending'";
        }

        if ($pageName == 'approved-loans') {
            $SUBQRY .= " AND alh.status='customer-approved'";
        }

        if ($pageName == 'disbursed-loans') {
            $SUBQRY .= " AND alh.status='disbursed'";
        }

        if ($pageName == 'disbursement-pending') {
            $SUBQRY .= " AND alh.status='disburse-scheduled'";
        }

        if ($fromDate && $toDate) {
            $SUBQRY .= " AND date(alh.disbursedDate)>='$fromDate' AND date(alh.disbursedDate)<='$toDate'";
        }

        $results = DB::select("SELECT u.id as userId,u.customerCode,u.name,u.email,u.mobile,alh.id as loanId,alh.productId,IFNULL(c.name,'NA') as loanType,IFNULL(alh.loanAmount,'NA') as appliedLoanAmount,IFNULL(alh.tenure,'NA') as appliedTenureId,t1.name as appliedTenure,alh.approvedTenure as approvedTenureId,t2.name as approvedTenure,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.status as loanStatus,alh.disbursedDate,alh.remark,p.productCode,p.productName,p.rateOfInterest as productROI,p.tenure as productTenure,p.amount as productAmount,p.amountTo as productAmountTo,p.numOfEmi as productEMI,p.productType,c.name as categoryName FROM users u LEFT JOIN apply_loan_histories alh ON u.id=alh.userId LEFT JOIN products p ON alh.productId=p.id LEFT JOIN categories c ON p.categoryId=c.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id WHERE u.id>0 $SUBQRY ORDER BY alh.id DESC;");
        $htmlStr = '<table id="mainTbl" class="table table-bordered">
                  <thead>
                  <tr>
                      <th>Sr. No.</th>
                      <th>Customer Code</th>
                      <th>Customer Name</th>
                      <th>Customer Email</th>
                      <th>Customer Mobile</th>
                      <th>Loan Type</th>
                      <th>Applied Amount</th>
                      <th>Applied Tenure</th>
                      <th>Approved Amount</th>
                      <th>Approved Tenure</th>
                      <th>ROI</th>
                      <th>Disburse Date</th>
                  </tr>
                  </thead>';
        if (count($results)) {
            $htmlStr .= '<tbody>';
            $rsr = 1;
            foreach ($results as $row) {

                $disbursedDate = (strtotime($row->disbursedDate)) ? date('d m,Y', strtotime($row->disbursedDate)) : '';
                $htmlStr .= '<tr>';
                $htmlStr .= '<td>' . $rsr . '</td>';
                $htmlStr .= '<td>' . $row->customerCode . '</td>';
                $htmlStr .= '<td>' . $row->name . '</td>';
                $htmlStr .= '<td>' . $row->email . '</td>';
                $htmlStr .= '<td>' . $row->mobile . '</td>';
                $htmlStr .= '<td>' . $row->loanType . '</td>';
                $htmlStr .= '<td>' . $row->appliedLoanAmount . '</td>';
                $htmlStr .= '<td>' . $row->appliedTenure . '</td>';
                $htmlStr .= '<td>' . $row->approvedAmount . '</td>';
                $htmlStr .= '<td>' . $row->approvedTenure . '</td>';
                $htmlStr .= '<td>' . $row->givenROI . '</td>';
                $htmlStr .= '<td>' . $disbursedDate . '</td>';
                $htmlStr .= '</tr>';
                $rsr++;
            }
            $htmlStr .= '</tbody>';
        }
        $htmlStr .= '</table>';
        return $htmlStr;
    }

    public function accessLogs()
    {
        AppServiceProvider::checkUserLogin();

        $pageTitle = 'Access Logs';
        $accesslogs = DB::select("SELECT sl.*,u.name,u.email,u.mobile,ur.name as userRole FROM system_access_logs sl LEFT JOIN users u ON sl.userId=u.id LEFT JOIN user_roles ur ON u.userType=ur.id ORDER BY sl.id DESC");
        return view('pages.system-algorithm.access-logs', compact('accesslogs', 'pageTitle'));
    }

    public function markDocsAsRead(Request $request)
    {
        AppServiceProvider::checkUserLogin();

        //$isValidated=AppServiceProvider::validatePermission('loan-send-for-approval');

        $userId = $request->userId;
        $docsName = $request->docsName;
        $docsValidated = 1;

        if ($docsName == 'viewBankDetails') {
            $docsValidated = 0;
            $bankDetail = UserBankDetail::where('userId', $userId)->first();
            if (!empty($bankDetail)) {
                $accountHolderName = $bankDetail->accountHolderName;
                $ifscCode = $bankDetail->ifscCode;
                $accountNumber = $bankDetail->accountNumber;
                $mobileNumber = '';

                $endPoint = '/payout/v1/authorize';
                $post_data = '';
                $method = 'POST';
                $headers = ['X-Client-Id:' . env('CASH_FREE_CLIENT_ID'), 'X-Client-Secret:' . env('CASH_FREE_SECRET_ID'), 'cache-control:no-cache'];
                $authResponse = AppServiceProvider::curlApisCashFree($endPoint, $post_data, $method, $headers);

                if (isset($authResponse->status)) {
                    if ($authResponse->status == 'SUCCESS') {
                        $token = $authResponse->data->token;

                        $endPoint = '/payout/v1/validation/bankDetails?name=' . urlencode($accountHolderName) . '&phone=' . $mobileNumber . '&bankAccount=' . $accountNumber . '&ifsc=' . $ifscCode;
                        $post_data = '';
                        $method = 'GET';
                        $headers = ['Authorization: Bearer ' . $token, 'cache-control:no-cache'];
                        $bankResponse = AppServiceProvider::curlApisCashFree($endPoint, $post_data, $method, $headers);
                        if (isset($bankResponse->status)) {
                            if ($bankResponse->status == 'SUCCESS') {
                                $docsValidated = 1;
                                UserBankDetail::where('userId', $userId)->update(['apisLog' => json_encode($bankResponse)]);
                            }
                        }
                    }
                }
            }
        }

        $docsValidated = 1;
        if ($userId && $docsName && $docsValidated == 1) {
            $RES = User::where(['id' => $userId, 'userType' => 'user'])->update([$docsName => $docsValidated]);
            if ($RES) {
                echo json_encode(['status' => 'success', 'message' => 'Docs mark as read successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => ($docsValidated == 0) ? 'Some error occurred, Please try again.' : 'Invalid Request, Please try again.']);
        }
    }

    public static function checkAvailableAmountLimitRawMaterial($userId, $loanId)
    {
        $availableLimit = 0;
        $totalCredit = 0;
        $totalDebit = 0;
        $loanDetails = ApplyLoanHistory::where(['id' => $loanId, 'userId' => $userId])->first();
        if (!empty($loanDetails)) {
            $approvedAmount = $loanDetails->approvedAmount;

            $creditDetails = DB::select("SELECT sum(amount) as totalCredit FROM raw_materials_txn_details WHERE loanId='$loanId' AND txnType='in'");
            if (count($creditDetails)) {
                $totalCredit = ($creditDetails[0]->totalCredit) ? $creditDetails[0]->totalCredit : 0;
            }

            $debitDetails = DB::select("SELECT sum(amount) as totalDebit FROM raw_materials_txn_details WHERE loanId='$loanId' AND txnType='out' AND status='success'");
            if (count($debitDetails)) {
                $totalDebit = ($debitDetails[0]->totalDebit) ? $debitDetails[0]->totalDebit : 0;
            }

            $notRecAmount = $totalDebit - $totalCredit;
            $availableLimit = $approvedAmount - $notRecAmount;
        }

        $returnArr = ['availableLimit' => $availableLimit, 'totalCredit' => $totalCredit, 'totalDebit' => $totalDebit];

        return $returnArr;
    }

    public function deleteRole(Request $request)
    {
        $recordId = $request->recordId;
        $isValidated = AppServiceProvider::validatePermission('delete-roles');

        if ($recordId) {
            $save = UserRole::where('id', $recordId)->delete();
            if ($save) {
                echo json_encode(['status' => 'success', 'message' => 'Selected role has been deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }

    public function deleteAdmin(Request $request)
    {
        $recordId = $request->recordId;
        $isValidated = AppServiceProvider::validatePermission('delete-sys-user');

        if ($recordId) {
            $save = User::where('id', $recordId)->delete();
            if ($save) {
                echo json_encode(['status' => 'success', 'message' => 'Selected user has been deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }

    public function delRawHistory(Request $request)
    {
        if ($request->loanId) {
            $loanId = $request->loanId;
            $REs = DB::select("delete from raw_materials_txn_details where loanId='$loanId'");
            echo 'History Deleted';
        } else {
            echo 'Invalid Request';
        }
    }

    public function msgTest(Request $request)
    {
        $mobileNumber = $request->mobile;
        if (empty($mobileNumber)) {
            echo 'Please Enter Mobile Number.';
            exit;
        }
        $textMessage = 'Thank You for your Loan Application LM001. We will contact you shortly to take it further. For queries call us on our helpline number or visit www.maxemocapital.com -Team Maxemo';;
        if (config('app.env') == "production") {
            $RES = AppServiceProvider::sendSms($mobileNumber, $textMessage);
        }

        echo '<pre>';
        print_r($RES);
        exit;
    }

    public function sendSmsAlertByType(Request $request)
    {
        $userId = $request->userId;
        $mobileNumber = $request->mobile;
        $type = $request->type;
        $sent = 0;

        if ($type == 'bank') {
            $textMessage = 'Dear customer, your loan application <Loan application number> is ready to sanction. Kindly complete the bank A/c validation process just by clicking here <Bank A/c validation link> - Team Maxemo';
            if (config('app.env') == "production") {
                $sent = AppServiceProvider::sendSms($mobileNumber, $textMessage);
            }
        } else if ($type == 'docs') {
            $textMessage = 'Dear Customer, some documents (PDDs)in your Loan A/c are pending for submission, kindly arrange for the submission -Team Maxemo';
            if (config('app.env') == "production") {
                $sent = AppServiceProvider::sendSms($mobileNumber, $textMessage);
            }
        }

        if ($sent) {
            echo json_encode(['status' => 'success', 'message' => 'Alert message has been sent successfully.', $mobileNumber => $sent]);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.', 'data' => $sent]);
            exit;
        }
    }

    public function getQuarterlyEmis($month, $roi, $balance, $payment_date, $tds)
    {

        $oneYearInterest = ($balance * $roi) / 100;
        $oneDayInterest = $oneYearInterest / 365;
        $oneMonthInterest = $oneYearInterest / 12;

        $numberOfQuarter = $month / 3;
        $oneQuarterEmi = $oneMonthInterest * 3;
        $emi = $oneQuarterEmi;

        $lastEmi = $emi + $balance;
        $emiArr = [];
        $totalInterest = $numberOfQuarter * $oneQuarterEmi;
        $totalPaybleAmount = $balance + $oneYearInterest;
        // if(strtotime(date('Y-m-d',strtotime($payment_date))) > strtotime(date('Y-m-12'))){
        //     $payment_date = date('Y-m-d',strtotime("+1 month",strtotime($payment_date)));
        // }
        $tdsAmount = (round($oneQuarterEmi) * $tds) / 100;
        $netInterest = round($totalInterest) - $tdsAmount;

        // $emi=($balance+$totalInterest)/$month;   
        $netemi = $emi - $tdsAmount;
        $startEmi = $emi;

        for ($i = 1; $i <= $numberOfQuarter; $i++) {




            $quarterlyDays = ($i % 4 == 0) ? 95 : 90;

            $quarterlyInterestAmount = $oneDayInterest * $quarterlyDays;

            $emiAmount = ($numberOfQuarter == $i) ? $lastEmi : $emi;
            $interest = 0;
            $principal = 0;
            $balance = 0;
            if ($i == 1) {
                $payment_date = date('Y-m-d', strtotime("+1 months", strtotime($payment_date)));
            } else {
                $payment_date = date('Y-m-d', strtotime("+3 months", strtotime($payment_date)));
            }


            $payment_date = $this->showDate($payment_date);

            $emiArr['totalPaybleAmount'] = round($totalPaybleAmount);
            $emiArr['totalInterest'] = round($netInterest);
            $emiArr['emiAmount'] = round($emi);
            $emiArr['rateOfInterest'] = $roi;
            $emiArr['tenureInMonth'] = $month;
            $emiArr['emiList'][] = ['emiSr' => $i, 'payDate' => $payment_date, 'emiAmount' => round($emi), 'netemiAmount' => round($netemi), 'interest' => $interest, 'tdsAmount' => $tdsAmount, 'netInterest' => $netInterest, 'principle' => $principal, 'balance' => round($balance)];

            // $emiArr['emiList'][]=['emiSr'=>$i,'payDate'=>$payment_date,'emiAmount'=>round($emiAmount),'interest'=>round($interest),'tdsAmount'=>$tdsAmount,'netInterest'=>$netInterest,'principle'=>round($principal),'balance'=>round($balance)];

        }

        /*$emi=($balance+$oneYearInterest)/4;

        $emiArr=[];
        $totalInterest=$oneYearInterest;
        $totalPaybleAmount=$balance+$oneYearInterest;
        for($i=1;$i<=4;$i++){

            $quarterlyDays=($i==4) ? 95 : 90;
            
            $quarterlyInterestAmount=$oneDayInterest*$quarterlyDays;

            $interest = $quarterlyInterestAmount;
            $principal = $emi - $interest;
            $balance = $balance - $principal;
            $payment_date = date('Y-m-d',strtotime("+3 months",strtotime($payment_date)));

            $payment_date=$this->showDate($payment_date);

            $emiArr['totalPaybleAmount']=round($totalPaybleAmount);
            $emiArr['totalInterest']=round($totalInterest);
            $emiArr['emiAmount']=round($emi);
            $emiArr['rateOfInterest']=$roi;
            $emiArr['tenureInMonth']=$month;
            $emiArr['emiList'][]=['emiSr'=>$i,'payDate'=>$payment_date,'emiAmount'=>round($emi),'interest'=>round($interest),'principle'=>round($principal),'balance'=>round($balance)];

        }*/

        return $emiArr;
    }

    public function getNumOfDaysBetween2Dates($stateDate, $endDate)
    {
        $datetime1 = date_create($stateDate);
        $datetime2 = date_create($endDate);

        // Calculates the difference between DateTime objects
        $interval = date_diff($datetime1, $datetime2);

        // Display the result
        $numOfDays = $interval->format('%a');
        return $numOfDays;
    }

    public function getFixedInterestDaysWiseEmis($month, $roi, $balance, $payment_date, $interestStartDate, $tds)
    {

        $year = date('Y', strtotime($interestStartDate));
        // if ($year % 4 == 0) {
        //     $oneYearDays = 366;
        // } else {
        $oneYearDays = 365;
        // }

        $oneYearInterest = ($balance * $roi) / 100;

        $oneDayInterest = $oneYearInterest / $oneYearDays;

        $lastDateOfStartDate = date('Y-m-t', strtotime($interestStartDate));
        $currentDayOfMonth = (int)date('d', strtotime($interestStartDate));
        // dd($currentDayOfMonth,$interestStartDate,$payment_date);
        if ($currentDayOfMonth == 4 || $currentDayOfMonth == 5) {
            $extraNumDays = 0;
        } elseif ($currentDayOfMonth < 4) {
            $extraNumDays = 5 - $currentDayOfMonth;
        } else {
            $lastDateOfStartDate = date('Y-m-d', strtotime($lastDateOfStartDate . '+5days'));
            $extraNumDays = $this->getNumOfDaysBetween2Dates($interestStartDate, $lastDateOfStartDate);
            // $interestStartDate = date('Y-m-d',strtotime($interestStartDate.'+1 month'));
        }


        $extraDaysInterest = $oneDayInterest * $extraNumDays;

        $firstEmi = 0;
        $lastEmi = 0;

        $emiArr = [];
        $totalInterest = 0;
        $totalPaybleAmount = 0;

        for ($i = 1; $i <= $month; $i++) {
            $monthTxt = ($i == 1) ? 'Month' : 'Months';

            $nextInterestMonth = date('Y-m-05', strtotime($interestStartDate . ' +' . $i . $monthTxt));
            $nextMonthYear = date('Y', strtotime($nextInterestMonth));
            // if ($nextMonthYear % 4 == 0) {
            //     $oneYearDays = 366;
            // } else {
            $oneYearDays = 365;
            // }
            $oneDayInterest = $oneYearInterest / $oneYearDays;

            $nextInterestMonthLastDate = date('Y-m-t', strtotime($nextInterestMonth));
            $nextInterestMonthLastDate = date('Y-m-d', strtotime($nextInterestMonthLastDate . '+4days'));

            $totalDaysInNextMonth = $this->getNumOfDaysBetween2Dates($nextInterestMonth, $nextInterestMonthLastDate);
            $totalDaysInNextMonth = $totalDaysInNextMonth + 1;
            //$totalDaysInNextMonth = cal_days_in_month(CAL_GREGORIAN,date('m', strtotime($nextInterestMonth)),date('Y', strtotime($nextInterestMonth)));

            $monthInterest = $oneDayInterest * $totalDaysInNextMonth;
            $emi = $monthInterest;

            $extraDays = 0;
            $extraDaysInterestAmt = 0;
            $totalInterestDays = $totalDaysInNextMonth;
            if ($i == 1) {
                $payment_date = date('Y-m-d', strtotime($nextInterestMonth . ' -1 Month'));
                $payment_date = $this->showDate($payment_date);
                $tdsAmount = (round($extraDaysInterest, 2) * $tds) / 100;
                $netInterest = round($extraDaysInterest) - $tdsAmount;

                $emiArr['emiList'][] = ['emiSr' => 0, 'payDate' => $payment_date, 'emiAmount' => round($extraDaysInterest), 'interest' => $extraDaysInterest, 'tds' => round($tds, 2), 'tdsAmount' => $tdsAmount, 'netInterest' => $netInterest, 'principle' => 0.00, 'balance' => round($balance), 'extraDays' => $extraDays, 'extraDaysInterestAmt' => $extraDaysInterestAmt, 'totalInterestDays' => $totalInterestDays];
                // $emi=$extraDaysInterest+$monthInterest;
                // $firstEmi=$emi;
                // $extraDays=$extraNumDays;
                // $extraDaysInterestAmt=$extraDaysInterest;
                $extraDaysInterest = $netInterest;
                $totalInterest += $netInterest;
            }

            // if($i==$month){
            //     $emi=$monthInterest+$balance;
            //     $lastEmi=$emi;
            //     $balance=0;
            // }
            $principal = 0;
            $interest = $emi;

            $payment_date = date('Y-m-d', strtotime($nextInterestMonth));

            $payment_date = $this->showDate($payment_date);
            $tdsAmount = (round($emi, 2) * $tds) / 100;
            $netInterest = round($emi, 2) - $tdsAmount;

            $totalInterest +=  $netInterest;

            $emiArr['totalPaybleAmount'] = round($totalInterest + $balance);
            $emiArr['totalInterest'] = round($totalInterest);
            $emiArr['emiAmount'] = round($emi);
            $emiArr['rateOfInterest'] = $roi;
            $emiArr['tenureInMonth'] = $month;
            $emiArr['extraNumDays'] = $extraNumDays;
            $emiArr['extraDaysInterest'] = $extraDaysInterest;
            $emiArr['emiList'][] = ['emiSr' => $i, 'payDate' => $payment_date, 'emiAmount' => round($emi, 2), 'interest' => $interest, 'tds' => round($tds, 2), 'tdsAmount' => $tdsAmount, 'netInterest' => $netInterest, 'principle' => $principal, 'balance' => round($balance), 'extraDays' => $extraDays, 'extraDaysInterestAmt' => $extraDaysInterestAmt, 'totalInterestDays' => $totalInterestDays];
        }
        return $emiArr;
    }

    public function getQuarterlyDaysWiseEmis($month, $roi, $balance, $payment_date, $interestStartDate, $tds)
    {
        // $interestStartDate = date('Y-m-d',strtotime($interestStartDate.' +1 month'));
        $emiarr = $this->getFixedInterestDaysWiseEmis($month, $roi, $balance, $payment_date, $interestStartDate, $tds);

        $emiArrNew = [];
        if ($emiarr && $emiarr['emiList']) {
            $emiamount = 0;
            $interest = 0;
            $netInterest = 0;
            $totalInterestDays = 0;
            $tdsamount = 0;
            $i = 0;
            foreach ($emiarr['emiList'] as $kk => $emiList) {
                $emiamount += $emiList['emiAmount'];
                $interest += $emiList['interest'];
                $netInterest += $emiList['netInterest'];
                $totalInterestDays += $emiList['totalInterestDays'];
                $tdsamount += round($emiList['tdsAmount'], 2);
                if ($kk == 0 || $kk % 3 == 0) {
                    $emiArrNew[] = ['emiSr' => $i, 'payDate' => date('Y-m-d', strtotime($emiList['payDate'] . ' +1 month')), 'emiAmount' => $emiamount, 'interest' => $interest, 'tds' => $tds, 'tdsAmount' => $tdsamount, 'netInterest' => $netInterest, 'principle' => $emiList['principle'], 'balance' => $emiList['balance'], 'extraDays' => $emiList['extraDays'], 'extraDaysInterestAmt' => $emiList['extraDaysInterestAmt'], 'totalInterestDays' => $totalInterestDays];
                    $emiamount = 0;
                    $interest = 0;
                    $netInterest = 0;
                    $totalInterestDays = 0;
                    $tdsamount = 0;
                    $i++;
                }
            }
        }
        // dd($emiarr);
        $emiarr['emiList'] = $emiArrNew;
        return $emiarr;
        // $year=date('Y');
        // if($year%4==0){
        //     $oneYearDays=366;
        // }else{
        //     $oneYearDays=365;
        // }
        // // dd($interestStartDate);

        // $oneYearInterest=($balance*$roi)/100;

        // $oneDayInterest=$oneYearInterest/$oneYearDays;

        // $numberOfQuarter=$month/3;

        // $lastDateOfStartDate=date('Y-m-t',strtotime($interestStartDate));
        // $lastDateOfStartDate=date('Y-m-d',strtotime($lastDateOfStartDate.'+4days'));

        // $extraNumDays= $this->getNumOfDaysBetween2Dates($interestStartDate,$lastDateOfStartDate);

        // $extraDaysInterest=$oneDayInterest*$extraNumDays;

        // $firstEmi=0;
        // $lastEmi=0;

        // $emiArr=[];
        // $totalInterest=0;
        // $totalPaybleAmount=0;
        // $interestStartDate=$lastDateOfStartDate;

        // for($i=1;$i<=$numberOfQuarter;$i++){



        //     // if($i == 1){
        //         $monthTxt = '2 Months';
        //     // }else{
        //     //     $monthTxt = '3 Months';
        //     // }


        //     $nextInterestMonth = date('Y-m-05',strtotime($interestStartDate . ' +'.$monthTxt));
        //     $nextMonthYear=date('Y',strtotime($nextInterestMonth));
        //     if($nextMonthYear%4==0){
        //         $oneYearDays=366;
        //     }else{
        //         $oneYearDays=365;
        //     }
        //     $oneDayInterest=$oneYearInterest/$oneYearDays;

        //     $nextInterestMonthLastDate=date('Y-m-t',strtotime($nextInterestMonth));
        //     $nextInterestMonthLastDate=date('Y-m-d',strtotime($nextInterestMonthLastDate.'+4days'));

        //     $totalDaysInNextMonth= $this->getNumOfDaysBetween2Dates($interestStartDate,$nextInterestMonthLastDate);
        //     $totalDaysInNextMonth=$totalDaysInNextMonth;
        //     //$totalDaysInNextMonth = cal_days_in_month(CAL_GREGORIAN,date('m', strtotime($nextInterestMonth)),date('Y', strtotime($nextInterestMonth)));

        //     $monthInterest=$oneDayInterest*$totalDaysInNextMonth;
        //     $emi=$monthInterest;

        //     $totalInterest=$totalInterest+$emi;
        //     $totalPaybleAmount=$totalInterest+$balance;

        //     $extraDays=0;
        //     $extraDaysInterestAmt=0;
        //     $totalInterestDays=$totalDaysInNextMonth;
        //     if($i==1){
        //         $payment_date = date('Y-m-d',strtotime($lastDateOfStartDate));

        //         $payment_date=$this->showDate($payment_date);
        //         $tdsAmount= (round($extraDaysInterest)*$tds)/100;
        //         $netInterest = round($extraDaysInterest) - $tdsAmount;

        //         $emiArr['emiList'][]=['emiSr'=>0,'payDate'=>$payment_date,'emiAmount'=>round($extraDaysInterest,2),'interest'=>$extraDaysInterest,'tds'=>$tds,'tdsAmount'=>$tdsAmount,'netInterest'=>$netInterest,'principle'=>0.00,'balance'=>round($balance),'extraDays'=>$extraDays,'extraDaysInterestAmt'=>$extraDaysInterestAmt,'totalInterestDays'=>$totalInterestDays];

        //     }
        //     // if($i == 2){
        //     // dd($emiArr);
        //     // }
        //     // 

        //     // if($i==$numberOfQuarter){
        //     //     $emi=$monthInterest+$balance;
        //     //     $lastEmi=$emi;
        //     //     $balance=0;
        //     // }
        //     // 
        //     $principal=0;
        //     $interest=$emi;

        //     $payment_date = date('Y-m-d',strtotime($nextInterestMonthLastDate));

        //     $payment_date=$this->showDate($payment_date);
        //     $tdsAmount= (round($emi)*$tds)/100;
        //     $netInterest = round($emi) - $tdsAmount;

        //     // echo $nextInterestMonth.'---'.$payment_date."<br>";

        //     $emiArr['totalPaybleAmount']=round($totalPaybleAmount);
        //     $emiArr['totalInterest']=round($totalInterest);
        //     $emiArr['emiAmount']=round($firstEmi);
        //     $emiArr['rateOfInterest']=$roi;
        //     $emiArr['tenureInMonth']=$month;
        //     $emiArr['extraNumDays']=$extraNumDays;
        //     $emiArr['extraDaysInterest']=$extraDaysInterest;
        //     $emiArr['emiList'][]=['emiSr'=>$i,'payDate'=>$payment_date,'emiAmount'=>round($emi,2),'interest'=>$interest,'tds'=>$tds,'tdsAmount'=>$tdsAmount,'netInterest'=>$netInterest,'principle'=>$principal,'balance'=>round($balance),'extraDays'=>$extraDays,'extraDaysInterestAmt'=>$extraDaysInterestAmt,'totalInterestDays'=>$totalInterestDays];



        //     $interestStartDate=$nextInterestMonthLastDate;
        // }
        // // dd($emiArr);

        // return $emiArr;
    }

    public function getFixedInterestEmis($month, $roi, $balance, $payment_date, $tds,$isPaidInterest)
    {

        $emiArr = [];
        $totalInterest = 0;
        $totalPaybleAmount = 0;

        $oneYearInterest = ($balance * $roi) / 100;
        
        $oneMonthInterest = $oneYearInterest / 12;
        
       

        $totalInterest = $oneMonthInterest * $month;
        $tdsAmount = (round($oneMonthInterest) * $tds) / 100;
        $netInterest = round($totalInterest) - $tdsAmount;

        $emi = ($balance + $totalInterest) / $month;
        $netemi = $emi - $tdsAmount;
        $startEmi = $emi;

        if($isPaidInterest){
            $totalPaybleAmount = $balance;
        }else{
            $totalPaybleAmount = $balance + $netInterest;
        }
        $totalInterestnew = 0;
        // if(strtotime(date('Y-m-d',strtotime($payment_date))) > strtotime(date('Y-m-12'))){
        //     $payment_date = date('Y-m-d',strtotime("+1 month",strtotime($payment_date)));
        // }

        for ($i = 1; $i <= $month; $i++) {

            $principleInMonth = $emi - $oneMonthInterest;

            $interest = $oneMonthInterest;

            $netInterest = $interest - $tdsAmount;
            $totalInterestnew = $totalInterestnew + $netInterest;

            if($isPaidInterest){
                $principal = $emi;
            }else{
                $principal = $emi - $interest;
            }
           

            $balance = $balance - $principal;
            $payment_date = date('Y-m-d', strtotime("+1 month", strtotime($payment_date)));

            $payment_date = $this->showDate($payment_date);

            if($isPaidInterest){
                $interest=0;
                $netInterest = 0;
            }

            $emiArr['totalPaybleAmount'] = round($totalPaybleAmount);
            $emiArr['totalInterest'] = round($totalInterestnew);
            $emiArr['emiAmount'] = round($startEmi);
            $emiArr['rateOfInterest'] = $roi;
            $emiArr['tenureInMonth'] = $month;
            $emiArr['emiList'][] = ['emiSr' => $i, 'payDate' => $payment_date, 'emiAmount' => round($emi), 'netemiAmount' => round($netemi), 'interest' => $interest, 'tdsAmount' => $tdsAmount, 'netInterest' => $netInterest, 'principle' => $principal, 'balance' => round($balance)];
        }
        return $emiArr;
    }

    public function getBulletRepaymentEMi($roi, $balance, $disbursedDate, $payment_date)
    {

        $datetime1 = date_create($disbursedDate);
        $datetime2 = date_create($payment_date);

        // Calculates the difference between DateTime objects
        $interval = date_diff($datetime1, $datetime2);

        // Display the result
        $numOfDays = $interval->format('%a');


        $month = $this->converyDaysToMonth($numOfDays);

        $emiArr = [];
        $totalInterest = 0;
        $totalPaybleAmount = 0;

        $oneYearInterest = ($balance * $roi) / 100;
        $oneDayInterest = $oneYearInterest / 365;

        $totalInterest = $oneDayInterest * $numOfDays;
        $emi = $totalInterest;

        $totalPaybleAmount = $balance + $totalInterest;

        for ($i = 1; $i <= 1; $i++) {

            $principleInMonth = 0;

            $interest = $totalInterest;

            $principal = $balance;
            $balance = 0;
            $payment_date = date('Y-m-d', strtotime($payment_date));

            $payment_date = $this->showDate($payment_date);

            $emiArr['totalPaybleAmount'] = round($totalPaybleAmount);
            $emiArr['totalInterest'] = round($totalInterest);
            $emiArr['emiAmount'] = round($emi);
            $emiArr['rateOfInterest'] = $roi;
            $emiArr['principleAmount'] = $principal;
            $emiArr['tenureInMonth'] = $numOfDays . ' Days';
            $emiArr['emiList'][] = ['emiSr' => $i, 'payDate' => $payment_date, 'emiAmount' => round($emi), 'interest' => $interest, 'principle' => $principal, 'balance' => round($balance)];
        }
        return $emiArr;
    }

    public function getDaysInMonth($month, $year) {
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }

    public function getEmisPMT($month, $roi, $balance, $payment_date, $tds,$isPaidInterest)
    {
        $period = $month / 12;
        $preview_payment_date = $payment_date;
        // dd($payment_date);
       
        $emi = $this->PMT($roi, $period, $balance,$isPaidInterest);
        $totalLoanAmount = $balance;

        // dd($emi);
        // $emi  -=$isPaidInterest;
        $emiArr = [];
        $totalInterest = 0;
        $totalPaybleAmount = 0;

        // if(strtotime(date('Y-m-d',strtotime($payment_date))) > strtotime(date('Y-m-12'))){
        //     $payment_date = date('Y-m-d',strtotime("+1 month",strtotime($payment_date)));
        // }

        for ($i = 1; $i <= $month; $i++) {

            $cyear = date('Y',strtotime($preview_payment_date. ' +'.$i.' month'));
            $cmonth = date('m',strtotime($preview_payment_date. ' +'.$i.' month'));

            $days_in_month = $this->getDaysInMonth($cmonth, $cyear);
            // echo $days_in_month.'/'.$cyear.'/'.$cmonth.'--';

            $dbalance = $balance;
            if($isPaidInterest){
                $dbalance = $balance-$emi;
            }

            $interest = $dbalance * ($roi / 100 / 365) * $days_in_month;

            // dd($interest);

            $tdsAmount = 0;
            $netInterest = $interest;
            if ($tds) {
                $tdsAmount = (round($interest) * $tds) / 100;
                $netInterest = round($interest) - $tdsAmount;
            }

            if($isPaidInterest){
                $principal = $emi;
            }else{
                $principal = $emi - $interest;
            }

            
            $netemi  = $emi - $tdsAmount;
            // dd();
            $balance = $balance - $principal;
            $payment_date = date('Y-m-d', strtotime("+1 month", strtotime($payment_date)));

            $payment_date = $this->showDate($payment_date);

            // if($isPaidInterest){
            //     $totalPaybleAmount = $totalPaybleAmount + $principal;
            //     $netemi = 0;
            //     $interest = 0;
            // }else{
                $totalPaybleAmount = $totalPaybleAmount + $interest + $principal;
            // }
            
            $totalInterest = $totalInterest + $netInterest;

            $emiArr['totalPaybleAmount'] = round($totalPaybleAmount);
            $emiArr['totalInterest'] = round($totalInterest);
            $emiArr['emiAmount'] = round($emi);
            $emiArr['rateOfInterest'] = $roi;
            $emiArr['tenureInMonth'] = $month;

            if($isPaidInterest){
                $newemi = $totalLoanAmount/$month;
            }

            $emiArr['emiList'][] = ['emiSr' => $i, 'payDate' => $payment_date, 'emiAmount' => round($newemi??$emi), 'netemiAmount' => round($netemi), 'interest' => round($interest), 'tdsAmount' => $tdsAmount, 'netInterest' => $netInterest, 'principle' => round($principal), 'balance' => round($balance)];
        }
        // dd($emiArr);
        return $emiArr;
    }

    public function PMT($interest, $period, $loan_amount,$isPaidInterest=null)
    {
        $interest = (float)$interest;
        $period = (float)$period;
        $loan_amount = (float)$loan_amount;
        $period = $period * 12;
        $interest = $interest / 1200;

        if($isPaidInterest){
            $amount = $loan_amount/$period;
        }else{
            $amount = $interest * -$loan_amount * pow((1 + $interest), $period) / (1 - pow((1 + $interest), $period));
        }

       
        return $amount;
    }

    public function calculateLateCharges($transactionDate, $tenureDueDate, $amount)
    {
        if (strtotime($transactionDate) > strtotime($tenureDueDate)) {
            $datetime1 = date_create($tenureDueDate);
            $datetime2 = date_create($transactionDate);

            // Calculates the difference between DateTime objects
            $interval = date_diff($datetime1, $datetime2);

            // Display the result
            $numOfDays = $interval->format('%a');
            $daySlabs = str_replace(',', '', number_format(($numOfDays / 15), 2));
            $daySlabsArr = explode('.', $daySlabs);

            $daySlob1 = 0;
            $daySlob2 = 0;
            if (isset($daySlabsArr[0])) {
                $daySlob1 = ($daySlabsArr[0] > 0) ? $daySlabsArr[0] : 0;
            }

            if (isset($daySlabsArr[1])) {
                $daySlob2 = ($daySlabsArr[1] > 0) ? 1 : 0;
            }

            $totalDaySlob = $daySlob1 + $daySlob2;
            $totalFinePercent = $totalDaySlob * 1.5;

            $totalFine = ($amount * $totalFinePercent) / 100;

            $totalFine = (($totalFine * $numOfDays) / 365);

            return ['lateCharges' => $totalFine, 'numOfDaysOfFine' => $numOfDays];
        }
    }

    public function showDate($date)
    {
        //return date('jS F, Y',strtotime($date));
        return date('Y-m-d', strtotime($date));
    }

    public function converyDaysToMonth($convert)
    {
        //$convert = '200'; // days you want to convert

        $years = ($convert / 365); // days / 365 days
        $years = floor($years); // Remove all decimals

        $month = ($convert % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
        $month = floor($month); // Remove all decimals

        $days = ($convert % 365) % 30.5; // the rest of days

        // Echo all information set
        //echo 'DAYS RECEIVE : '.$convert.' days<br>';
        //echo $years.' years - '.$month.' month - '.$days.' days';
        return $month;
    }

    public function loanNoc($id)
    {
        $loanDetails = ApplyLoanHistory::where('id', $id)->where('status', 'closed')->select('id', 'userId', 'loanCategory', 'netDisbursementAmount', 'disbursedDate', 'approvedTenure', 'status')->first();
        if ($loanDetails) {
            $loantype = DB::table('categories')->where('id', $loanDetails->loanCategory)->first();
            $user = User::where('id', $loanDetails->userId)->first()->toArray();
            $totalmonth = DB::table('tenures')->where('id', $loanDetails->approvedTenure)->select('numOfEmis')->first();
            $refnumber = 'Maxemo/' . date('Y', strtotime($loanDetails->disbursedDate)) . '-' . date('y', strtotime($loanDetails->disbursedDate . ' +' . $totalmonth->numOfEmis . ' months')) . '/534' . $loanDetails->id;
            $customerUpload = ['loanId' => $loanDetails->id, 'loanamount' => $loanDetails->netDisbursementAmount, 'refno' => $refnumber, 'user' => $user, 'laonName' => $loantype->name];
            return view('web.noc', compact('customerUpload'));
        }
        return redirect()->back();
    }

    public function logout()
    {
        $accessLoginId = session('accessLoginId');
        if ($accessLoginId) {
            $currentDateTime = date('Y-m-d H:i:s');
            SystemAccessLog::where('id', $accessLoginId)->update(['logoutDateTime' => $currentDateTime, 'updated_at' => $currentDateTime]);
        }
        Auth::logout();
        return redirect()->route('loginA');
    }
}
