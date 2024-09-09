<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Providers\AppServiceProvider;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\GloadController;
use App\Models\ApplyLoanHistory;
use App\Models\Category;
use App\Models\CoApplicantDetail;
use App\Models\EmploymentHistory;
use App\Models\LoanKycOtherPendetail;
use App\Models\OtherKycDoc;
use App\Models\TempApplyLoan;
use App\Models\User;
use App\Models\UserBankDetail;
use App\Models\UserDoc;
use DB;

class ApplyController extends Controller
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

    public function loanTypeAmount(Request $request)
    {
        // dd($request->all());
        // session()->put('step',0);
        if ($request->loanType == 1 || $request->loanType == 8) {
            $this->validate($request, [
                'loanType' => 'required|exists:categories,id',
                'roiType' => 'required',
                'productName' => 'required',
                'approveTenure' => 'required|numeric',
                'approvedAmount' => 'required|numeric'
            ]);
        } elseif ($request->loanType == 2) {
            $this->validate($request, [
                'loanType' => 'required|exists:categories,id',
                'roiType' => 'required',
                'approveTenure' => 'required|numeric',
                'approvedAmount' => 'required|numeric'
            ]);
        } elseif ($request->loanType == 3) {
            $this->validate($request, [
                'loanType' => 'required|exists:categories,id',
                'approveTenure' => 'required|numeric',
                'approvedAmount' => 'required|numeric'
            ]);
        } else {
            $this->validate($request, [
                'loanType' => 'required|exists:categories,id'
            ]);
        }
        // dd($request->all());
        $loanApply = new CustomerController();
        $alldata = json_decode($loanApply->applyLoanByWebUserPrivate($request), true);
        // dd($alldata);

        $allKYCdetails = DB::table('user_docs')->where('userId', auth()->user()->id)->first();
        if (!isset($allKYCdetails)) {
            session()->put('step', 1);
        } elseif ($request->loanType == 2 && ($allKYCdetails->idProofFront == "" || $allKYCdetails->idProofBack == "")) {
            session()->put('step', 1);
        } elseif ($allKYCdetails->panCardFront == "" || $allKYCdetails->addressProofFront == "" || $allKYCdetails->addressProofBack == "") {
            session()->put('step', 1);
        } elseif (auth()->user()->religion == "") {
            session()->put('step', 2);
        } elseif (!CoApplicantDetail::where('userId', auth()->user()->id)->exists()) {
            session()->put('step', 3);
        } elseif (!EmploymentHistory::where(['userId' => auth()->user()->id])->exists()) {
            session()->put('step', 4);
        } elseif ($request->loanType != 2 && !EmploymentHistory::where(['userId' => auth()->user()->id, 'isBusiness' => 1])->exists()) {
            session()->put('step', 4);
        } elseif ($request->loanType == 2 && !EmploymentHistory::where(['userId' => auth()->user()->id, 'isBusiness' => 0])->exists()) {
            session()->put('step', 4);
        } elseif ($alldata && $alldata['status'] == "error" && $alldata['message'] == "GST number is mandatory for business loan.") {
            session()->put('step', 4);
        } elseif (!UserBankDetail::where('userId', auth()->user()->id)->exists()) {
            session()->put('step', 5);
        } else {
            $loanid = ApplyLoanHistory::where(['status' => 'pending', 'userId' => auth()->user()->id])->first();
            ApplyLoanHistory::where('id', $loanid->id)->update(['status' => 'sent-for-admin-approval']);
            session()->put('step', 6);
            session()->put('done', 1);

            $userData = User::where('id', auth()->user()->id)->first();
            $employment_histories = DB::table('employment_histories')->where('userId', auth()->user()->id)->first();

            $verifyWith = env('APP_NAME');

            $userAge = '-';
            if ($userData->dateOfBirth) {
                $userAge = (date('Y') - date('Y', strtotime($userData->dateOfBirth)));
            }


            if ($employment_histories->isBusiness == 1) {
                $CBdetails = "<tr></tr><tr><td><h4>Business Details</h4></td></tr>
                <tr><td>Company Name : " . $employment_histories->employerName . " " . $employment_histories->companyType . "</td></tr>
                <tr><td>Company Email : " . $employment_histories->emailId . "</td></tr>
                <tr><td>Company Mobile : " . $employment_histories->mobileNo . "</td></tr>
                <tr><td>Company GSTIN : " . $employment_histories->companyGstin . "</td></tr>
                <tr><td>Company FaxNo : " . $employment_histories->companyFaxNo . "</td></tr>
                <tr><td>Company Pan Number : " . $employment_histories->companyPan . "</td></tr>
                <tr><td>Company Address : " . $employment_histories->address . "</td></tr>
                <tr><td>Company District : " . $employment_histories->district . "</td></tr>
                <tr><td>Company State : " . $employment_histories->state . "</td></tr>
                <tr><td>Company Pincode : " . $employment_histories->pincode . "</td></tr>";
            } else {
                $CBdetails = "<tr></tr><tr><td><h4>Employer Details</h4></td></tr>
                <tr><td>Company Name : " . $employment_histories->employerName . " " . $employment_histories->companyType . "</td></tr>
                <tr><td>Company Mobile : " . $employment_histories->mobileNo . "</td></tr>
                <tr><td>Total Experience In Current Company : " . $employment_histories->totalExpInCurrentCompany . "</td></tr>
                <tr><td>Current Salary : " . $employment_histories->currentSalary . "</td></tr>
                <tr><td>Company Address : " . $employment_histories->address . "</td></tr>
                <tr><td>Company District : " . $employment_histories->district . "</td></tr>
                <tr><td>Company State : " . $employment_histories->state . "</td></tr>
                <tr><td>Company Pincode : " . $employment_histories->pincode . "</td></tr>";
            }

            $htmlStAdmin = '<div>
                    <p>Dear Admin,</p>
                    <table style="width:100%;">
                    <tr>
                        <td colspan="2">' . $userData->name . ' (' . $userData->customerCode . ') has been applied a loan of Rs. ' . $loanid->loanAmount . '</td>
                    </tr>
                    <tr><td>Mobile Number : ' . $userData->mobile . '</td></tr>
                    <tr><td>Age : ' . $userAge . '</td></tr>' . $CBdetails . '
                    
                    <tr><td>Source : Web</td></tr>
                    <tr><td>Source Person : ' . ($userData->sourcePerson ?? 'N/A') . '</td></tr>
                    <tr><td>Source Person Number : ' . ($userData->sourcePersonNumber ?? 'N/A') . '</td></tr>
                    <tr>
                    
                    </tr>
                    
                    </table>
                <div><br/><br/><br/></div></div>';

            if (config('app.env') == "production") {
                AppServiceProvider::sendMail("info@maxemocapital.com", "Info Maxemo", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
                AppServiceProvider::sendMail("shorya.mittal@maxemocapital.com", "Shorya Mittal", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
                AppServiceProvider::sendMail("vipul.mittal@maxemocapital.com", "Vipul Mittal", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
                AppServiceProvider::sendMail("vivek.mittal@maxemocapital.com", "Vivek Mittal", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
            } else {

                // AppServiceProvider::sendMail("raju@techmavesoftware.com", "Raju", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
                AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
            }
        }
        // dd($request->all(),$allKYCdetails);
        // dd(session()->get('step'));

        return redirect()->back()->with('data_message', 'Loan Type Selected !');
    }


    public function webPancardVerify(Request $request)
    {
        //return $request->all();
        $lobObj = new GloadController();
        $user_id = auth()->user()->id;
        $saveUp = [];
        $saveUpDocs = [];
       
        if ($request->hasFile('panCardFront')) {
            
            $pancard = $lobObj->ocr_adhaar_verification(3);
            if (empty($pancard) || !isset($pancard->msg->father_name)) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Invalid Pancard.'
                ]);
                // redirect()->back()->with('error','Invalid Pan Card Photo.');
            }
            $image = AppServiceProvider::uploadImageCustom('panCardFront', 'user-docs');
            $saveUpDocs['panCardFront'] = $image;
            $saveUp['dateOfBirth'] = isset($pancard->msg->dob)  ? date('Y-m-d', strtotime(str_replace('/', '-', $pancard->msg->dob))) : auth()->user()->dateOfBirth;
            $saveUp['fatherName'] = isset($pancard->msg->father_name) && $pancard->msg->father_name == "" ? auth()->user()->fatherName :  $pancard->msg->father_name;
            $saveUp['pancard_no'] = $pancard->msg->doc_id == "" ? auth()->user()->pancard_no :  $pancard->msg->doc_id;
        }
        if (!empty($saveUp)) {
            UserDoc::where('userId', $user_id)->update($saveUpDocs);
            User::where('id', $user_id)->update($saveUp);
            return  response()->json([
                'status' => true,
                'msg' => 'Pancard Verified.'
            ]);
        } else {
            return  response()->json([
                'status' => false,
                'msg' => 'Invalid Photo of Pan Card.'
            ]);
        }
    }

    public function webAadharcardVerify(Request $request)
    {
        $lobObj = new GloadController();
        $user_id = auth()->user()->id;
        $saveUp = [];
        $saveUpDocs = [];
        if ($request->hasFile('addressProofFront') && $request->hasFile('addressProofBack')) {
            $addressProof = $lobObj->ocr_adhaar_verification(4);

            if (!isset($addressProof->msg) || $addressProof->msg->doc_id == "") {
                return  response()->json([
                    'status' => false, 'msg' => 'Invalid Photo of Aadhar Card.00'
                ]);
            }
            
            if ($addressProof->msg->doc_id) {
                $aadhaar = $lobObj->adhaar_verification(str_replace(' ', '', $addressProof->msg->doc_id));
                // print_r($aadhaar);
                if ($aadhaar && $aadhaar->status != 1) {
                    return  response()->json([
                        'status' => false, 'msg' => 'Invalid Photo of Aadhar Card.--'
                    ]);
                }
                // if (!$aadhaar) {
                //     return  response()->json([
                //         'status' => false, 'msg' => 'Invalid Photo of Aadhar Card.++'
                //     ]);
                // }
            }

            $short_state = 'DL';
            $saveUp['name'] = $addressProof->msg->name == "" ? auth()->user()->name :  $addressProof->msg->name;
            $saveUp['gender'] = $addressProof->msg->gender == "" ? auth()->user()->gender :  $addressProof->msg->gender;
            $saveUp['addressLine1'] = $addressProof->msg->street_address == "" ? auth()->user()->addressLine1 :  $addressProof->msg->street_address;
            $saveUp['district'] = $addressProof->msg->district == "" ? auth()->user()->district :  $addressProof->msg->district;
            $saveUp['state'] = $addressProof->msg->state == "" ? auth()->user()->state :  $addressProof->msg->state;
            $saveUp['pincode'] = $addressProof->msg->pincode == "" ? auth()->user()->pincode :  $addressProof->msg->pincode;
            $saveUp['aadhaar_no'] = $addressProof->msg->doc_id == "" ? auth()->user()->aadhaar_no :  str_replace(' ', '', $addressProof->msg->doc_id);
            $saveUp['updated_at'] = date('Y-m-d H:i:s');

            foreach ($this->indianStates as $kk => $state) {
                if (strtolower($state) == strtolower($saveUp['state'])) {
                    $short_state = $kk;
                    break;
                }
            }
            $saveUp['state_short'] = $short_state;

            if (!empty($request->addressProofFront)) {
                $image = AppServiceProvider::uploadImageCustom('addressProofFront', 'user-docs');
                $saveUpDocs['addressProofFront'] = $image;
            }

            if (!empty($request->addressProofBack)) {
                $image = AppServiceProvider::uploadImageCustom('addressProofBack', 'user-docs');
                $saveUpDocs['addressProofBack'] = $image;
            }
        }
        if (!empty($saveUp)) {
            User::where('id', $user_id)->update($saveUp);
            if($saveUpDocs && !empty($saveUpDocs)){
                UserDoc::where('userId', $user_id)->update($saveUpDocs);
            }
            return  response()->json([
                'status' => true,
                'msg' => 'Aadhar Card Verified.'
            ]);
        } else {
            return  response()->json([
                'status' => false,
                'msg' => 'Invalid Photo of Aadhar Card.'
            ]);
        }
    }

    public function webPancardPatnerOne(Request $request)
    {
        
        $lobObj = new GloadController();
        $user_id = auth()->user()->id;
        $userData = User::where('id', $user_id)->first();
        if(!$userData->pancard_no){
            return  response()->json([
                'status' => false,
                'msg' => 'Please upload ** Photo of Pan Card ** first.'
            ]);
        }
        $kyc1_others = [];
        $kyc1_pancard_no_new = LoanKycOtherPendetail::where('userId', $user_id)->first() ?? null;
        $kyc1_pancard_no = $kyc1_pancard_no_new ? $kyc1_pancard_no_new->pancard_no : null;
        $kyc1_pancard_img = null;
        if ($request->hasFile('kyc1_pancard_img')) {
            $kyc1pancard = $lobObj->ocr_adhaar_verification(3, 'kyc1_pancard_img');
            if (empty($kyc1pancard) || !isset($kyc1pancard->msg->father_name)) {
                return  response()->json([
                    'status' => false,
                    'msg' => 'Invalid Photo of Pan Card Partner 1.'
                ]);
            }
            $kyc1_pancard_img = AppServiceProvider::uploadImageCustom('kyc1_pancard_img', 'user-docs');
            $kyc1_others['fatherName'] = isset($kyc1pancard->msg->father_name) && $kyc1pancard->msg->father_name ?  $kyc1pancard->msg->father_name : null;
            $kyc1_pancard_no = $kyc1pancard->msg->doc_id ? $kyc1pancard->msg->doc_id : null;
            $kyc1_others['dateOfBirth'] = isset($kyc1pancard->msg->dob)  ? date('Y-m-d', strtotime(str_replace('/', '-', $kyc1pancard->msg->dob))) : null;
            $kyc1_others['name'] = isset($kyc1pancard->msg->name) && $kyc1pancard->msg->name ?  $kyc1pancard->msg->name : null;
        }
        if($userData->pancard_no == $kyc1_pancard_no){
            return  response()->json([
                'status' => false,
                'msg' => 'Your pancard and partner 1 pancard are same.'
            ]);
        }

        $kyc1_others['pancard_img'] = $kyc1_pancard_img;
        $kyc1_others['gender'] =  $request->kyc1_gender ?? 'Male';
        $kyc1_others['mobile'] = $request->kyc1_mobile ?? null;
        $kyc1_others['email'] = $request->kyc1_email ?? null;
        $kyc1_others['addressLine1'] = $request->kyc1_address ?? null;
        $kyc1_others['city'] = $request->kyc1_city ?? null;
        $kyc1_others['state_short'] = $request->kyc1_state ?? null;
        $kyc1_others['state'] = $this->indianStates[$request->kyc1_state];
        $kyc1_others['pincode'] = $request->kyc1_pincode ?? null;
        try {
            if ($kyc1_pancard_no && $request->kyc1_mobile && $request->kyc1_email && $request->kyc1_state && $request->kyc1_pincode && $request->kyc1_gender) {
                $dataUpload = LoanKycOtherPendetail::UpdateOrCreate(['pancard_no' => $kyc1_pancard_no, 'userId' => $user_id], $kyc1_others);
                if($dataUpload){
                    return  response()->json([
                        'status' => true,
                        'msg' => 'Verified'
                    ]);
                }else{
                    return  response()->json([
                        'status' => false,
                        'msg' => 'Invalid Photo of Patner 1 Pancard.'
                    ]);
                }
            } else {
                return  response()->json([
                    'status' => false,
                    'msg' => 'Invalid Photo of Patner 1 Pancard.'
                ]);
            }
        } catch (\Exception $e) {
            return  response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function webPancardPatnerTwo(Request $request)
    {
        $lobObj = new GloadController();
        $user_id = auth()->user()->id;
        $userData = User::where('id', $user_id)->first();
        if(!$userData->pancard_no){
            return  response()->json([
                'status' => false,
                'msg' => 'Please upload ** Photo of Pan Card ** first.'
            ]);
        }
        $kyc2_others = [];
        $kyc2_pancard_no_new = LoanKycOtherPendetail::where('userId', $user_id)->skip(1)->first() ?? null;
        $kyc2_pancard_no = $kyc2_pancard_no_new ? $kyc2_pancard_no_new->pancard_no : null;
        $kyc2_pancard_img = null;
        if ($request->hasFile('kyc2_pancard_img')) {
            $kyc2pancard = $lobObj->ocr_adhaar_verification(3, 'kyc2_pancard_img');
            if (empty($kyc2pancard) || !isset($kyc2pancard->msg->father_name)) {
                return  response()->json([
                    'status' => false,
                    'msg' => 'Invalid Photo of Pan Card Partner 2.'
                ]);
            }
            $kyc2_pancard_img = AppServiceProvider::uploadImageCustom('kyc2_pancard_img', 'user-docs');
            $kyc2_others['fatherName'] = isset($kyc2pancard->msg->father_name) && $kyc2pancard->msg->father_name ?  $kyc2pancard->msg->father_name : null;
            $kyc2_pancard_no = $kyc2pancard->msg->doc_id ? $kyc2pancard->msg->doc_id : null;
            $kyc2_others['dateOfBirth'] = isset($kyc2pancard->msg->dob)  ? date('Y-m-d', strtotime(str_replace('/', '-', $kyc2pancard->msg->dob))) : null;
            $kyc2_others['name'] = isset($kyc2pancard->msg->name) && $kyc2pancard->msg->name ?  $kyc2pancard->msg->name : null;
        }
        $kyc2_others['pancard_img'] = $kyc2_pancard_img;
        $kyc2_others['gender'] = $request->kyc2_gender ?? null;
        $kyc2_others['mobile'] = $request->kyc2_mobile ?? null;
        $kyc2_others['email'] = $request->kyc2_email ?? null;
        $kyc2_others['addressLine1'] = $request->kyc2_address ?? null;
        $kyc2_others['city'] = $request->kyc2_city ?? null;
        $kyc2_others['state_short'] = $request->kyc2_state ?? null;
        $kyc2_others['state'] = $this->indianStates[$request->kyc2_state];
        $kyc2_others['pincode'] = $request->kyc2_pincode ?? null;
        if($userData->pancard_no == $kyc2_pancard_no){
            return  response()->json([
                'status' => false,
                'msg' => 'Your pancard and partner 2 pancard are same.'
            ]);
        }

        if ($kyc2_pancard_no && $request->kyc2_mobile && $request->kyc2_email && $request->kyc2_state && $request->kyc2_pincode && $request->kyc2_gender) {
            LoanKycOtherPendetail::UpdateOrCreate(['pancard_no' => $kyc2_pancard_no, 'userId' => $user_id], $kyc2_others);
            return  response()->json([
                'status' => true,
                'msg' => 'Verified'
            ]);
        } else {
            return  response()->json([
                'status' => false,
                'msg' => 'Invalid Photo of Patner 2 Pancard.'
            ]);
        }
    }

    public function kycdetails(Request $request)
    {
        $loanApply = new CustomerController();
        $lobObj = new GloadController();
        $user_id = auth()->user()->id;

        $saveUp = [];
        if (config('app.env') == "production" && $request->hasFile('idProofFront') && $request->hasFile('idProofBack')) {
            $idproof = $lobObj->ocr_adhaar_verification(1);
            if (empty($idproof)) {
                return redirect()->back()->with('error', 'Invalid Photo of Emp. identity Card !');
            }
        }

        if (config('app.env') == "production" && $request->hasFile('bankAttachemet')) {
            $bankdata = $lobObj->bankstatementData($request->file('bankAttachemet'), $request->bankPwd);

            if ($bankdata && isset($bankdata->identity) && isset($bankdata->identity->account_number)) {
                $saveUp_bank = array();
                $saveUp_bank['userId'] = $user_id;
                $saveUp_bank['accountHolderName'] = $bankdata->identity->name;
                $saveUp_bank['bankName'] = $bankdata->bank_name;
                $saveUp_bank['accountNumber'] = $bankdata->identity->account_number;
                $saveUp_bank['address'] = $bankdata->identity->address;
                $saveUp_bank['ifscCode'] = $bankdata->identity->ifsc;
                // dd($bankdata,$saveUp_bank);

                $ifExist = UserBankDetail::where('userId', $user_id)->first();

                if (!empty($ifExist)) {
                    $saveUp_bank['updated_at'] = date('Y-m-d H:i:s');
                    $save = UserBankDetail::where('userId', $user_id)->update($saveUp_bank);
                } else {
                    $saveUp_bank['created_at'] = date('Y-m-d H:i:s');
                    $saveUp_bank['updated_at'] = date('Y-m-d H:i:s');
                    $save = DB::table('user_bank_details')->insertGetId($saveUp_bank);
                }
            } else {
                return redirect()->back()->with('error', 'Invalid Bank Statement Or Statement Is Password Protected.');
            }
        }

        session()->put('step', 2);
        if (!empty($saveUp)) {
            User::where('id', $user_id)->update($saveUp);
        }
        if ($loanApply->saveKycDetailsPrivate($request)) {
            if (auth()->user()) {

                $userData = User::where('id', auth()->user()->id)->first();
                $customerdata = array();
                $customerdata['name'] = $userData->name;
                $customerdata['addressLine1'] = $userData->addressLine1 ?? '';
                $customerdata['city'] = $userData->city ?? '';
                $customerdata['state'] =  $userData->state_short;
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
                $customerdata['fatherName'] = $userData->fatherName;
                // dd($customerdata);
                if (config('app.env') == "production") {
                    $equifaxData = $lobObj->eportuatData($customerdata);
                } else {
                    $equifaxData = null;
                }
                // dd($equifaxData);
                $score = 'NA';
                if (isset($equifaxData['CCRResponse']['CIRReportDataLst'][0]['CIRReportData']) && $equifaxData['CCRResponse']['CIRReportDataLst'][0]['CIRReportData']['ScoreDetails'][0]['Value']) {
                    $score = $equifaxData['CCRResponse']['CIRReportDataLst'][0]['CIRReportData']['ScoreDetails'][0]['Value'];
                } else if (isset($equifaxData['CCRResponse']['CIRReportDataLst'][0]['CIRReportData']) && $equifaxData['CCRResponse']['CIRReportDataLst'][1]['CIRReportData']['ScoreDetails'][0]['Value']) {
                    $score = $equifaxData['CCRResponse']['CIRReportDataLst'][1]['CIRReportData']['ScoreDetails'][0]['Value'];
                }
                $userDataSave = User::where('id', auth()->user()->id)->first();
                $userDataSave->credit_score = $score;
                $userDataSave->creditscore_apidata = json_encode($equifaxData);
                $userDataSave->save();
            }
        }

        if(!empty($request->otherDocumentTitle)){
            $otherDocumentTitle=$request->otherDocumentTitle;
            $docsUrlArr=AppServiceProvider::uploadImageCustomMulti('otherDocument','user-docs');

            if(count($docsUrlArr))
            {
                $newSave=[];
                $osr=0;
                $currentDate=date('Y-m-d H:i:s');
                foreach($otherDocumentTitle as $otherRow)
                {   
                    //print_r($docsUrlArr[$osr]);exit;
                    if($otherRow)
                    {
                        $newSave[]=['userId'=>$user_id,'title'=>$otherRow,'docsUrl'=>(isset($docsUrlArr[$osr])) ? $docsUrlArr[$osr] : '','created_at'=>$currentDate,'updated_at'=>$currentDate];
                    }
                    
                    $osr++;
                }
                //print_r($newSave);exit;
                OtherKycDoc::insert($newSave);
            }
        }
        return redirect()->back()->with('data_message', 'KYC Documents Uploaded!');
    }

    public function PersonalInformation(Request $request)
    {
        // dd("adsasdasd");
        // $mobileNumber=auth()->user()->mobile;
        // $emailAddress=auth()->user()->email;
        // $this->validate($request,[
        //     "customerEmail" => 'unique:users,email,'.auth()->user()->id,
        //     "customerPhone" => 'unique:users,mobile,'.auth()->user()->id,
        // ]);
        // dd($mobileNumber,$emailAddress);
        $loanApply = new CustomerController();
        $loanApply->saveCustomerInfoPrivate($request);

        session()->put('step', 3);
        return redirect()->back()->with('data_message', 'Personal Information Added!');
    }

    public function saveCoApplicantInfoPrivate(Request $request)
    {
        $loanApply = new CustomerController();
        $loanApply->saveCoApplicantInfoPrivate($request);
        session()->put('step', 4);
        return redirect()->back()->with('data_message', 'Co-Applicant Information Updated!');
    }


    public function saveUserBankDetailsPrivate(Request $request)
    {
        $loanApply = new CustomerController();
        $loanApply->saveUserBankDetailsPrivate($request);
        session()->put('step', 6);
        session()->put('done', 1);
        $applyLoan = ApplyLoanHistory::where(['userId' => auth()->user()->id, 'status' => 'pending'])->first();
        $applyLoan->status = "sent-for-admin-approval";
        $applyLoan->save();
        $loanId = env('LOANID_PRE') . $applyLoan->id;
        $loanid = $applyLoan;
        $mobileNumber = auth()->user()->mobile;

        $userData = User::where('id', auth()->user()->id)->first();
        $employment_histories = DB::table('employment_histories')->where('userId', auth()->user()->id)->first();

        $verifyWith = env('APP_NAME');

        $userAge = '-';
        if ($userData->dateOfBirth) {
            $userAge = (date('Y') - date('Y', strtotime($userData->dateOfBirth)));
        }


        if ($employment_histories->isBusiness == 1) {
            $CBdetails = "<tr></tr><tr><td><h4>Business Details</h4></td></tr>
                <tr><td>Company Name : " . $employment_histories->employerName . " " . $employment_histories->companyType . "</td></tr>
                <tr><td>Company Email : " . $employment_histories->emailId . "</td></tr>
                <tr><td>Company Mobile : " . $employment_histories->mobileNo . "</td></tr>
                <tr><td>Company GSTIN : " . $employment_histories->companyGstin . "</td></tr>
                <tr><td>Company FaxNo : " . $employment_histories->companyFaxNo . "</td></tr>
                <tr><td>Company Pan Number : " . $employment_histories->companyPan . "</td></tr>
                <tr><td>Company Address : " . $employment_histories->address . "</td></tr>
                <tr><td>Company District : " . $employment_histories->district . "</td></tr>
                <tr><td>Company State : " . $employment_histories->state . "</td></tr>
                <tr><td>Company Pincode : " . $employment_histories->pincode . "</td></tr>";
        } else {
            $CBdetails = "<tr></tr><tr><td><h4>Employer Details</h4></td></tr>
                <tr><td>Company Name : " . $employment_histories->employerName . " " . $employment_histories->companyType . "</td></tr>
                <tr><td>Company Mobile : " . $employment_histories->mobileNo . "</td></tr>
                <tr><td>Total Experience In Current Company : " . $employment_histories->totalExpInCurrentCompany . "</td></tr>
                <tr><td>Current Salary : " . $employment_histories->currentSalary . "</td></tr>
                <tr><td>Company Address : " . $employment_histories->address . "</td></tr>
                <tr><td>Company District : " . $employment_histories->district . "</td></tr>
                <tr><td>Company State : " . $employment_histories->state . "</td></tr>
                <tr><td>Company Pincode : " . $employment_histories->pincode . "</td></tr>";
        }

        $htmlStAdmin = '<div>
                    <p>Dear Admin,</p>
                    <table style="width:100%;">
                    <tr>
                        <td colspan="2">' . $userData->name . ' (' . $userData->customerCode . ') has been applied a loan of Rs. ' . $loanid->loanAmount . '</td>
                    </tr>
                    <tr><td>Mobile Number : ' . $userData->mobile . '</td></tr>
                    <tr><td>Age : ' . $userAge . '</td></tr>' . $CBdetails . '
                    <tr><td>Source : Web</td></tr>
                    <tr><td>Source Person : ' . ($userData->sourcePerson ?? 'N/A') . '</td></tr>
                    <tr><td>Source Person Number : ' . ($userData->sourcePersonNumber ?? 'N/A') . '</td></tr>
                    <tr>
                    
                    </tr>
                    
                    </table>
                <div><br/><br/><br/></div></div>';

        if (config('app.env') == "production") {
            AppServiceProvider::sendMail("info@maxemocapital.com", "Info Maxemo", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
            AppServiceProvider::sendMail("shorya.mittal@maxemocapital.com", "Shorya Mittal", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
            AppServiceProvider::sendMail("vipul.mittal@maxemocapital.com", "Vipul Mittal", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
            AppServiceProvider::sendMail("vivek.mittal@maxemocapital.com", "Vivek Mittal", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
        } else {

            // AppServiceProvider::sendMail("raju@techmavesoftware.com", "Raju", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
            AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "New Loan Applied | " . $verifyWith, $htmlStAdmin);
        }


        
        // $textMessage='Thank You for your Loan Application '.$loanId.'. We will contact you shortly to take it further. For queries call us on our helpline number or visit www.maxemocapital.com -Team Maxemo';
        // AppServiceProvider::sendSms($mobileNumber,$textMessage);

        // $textMessage='Your loan application no '.$loanId.' for business/personal loan of '. number_format($request->approvedAmount,2).' is under process and we will notify you shortly once it is approved - Team Maxemo';
        // AppServiceProvider::sendSms($mobileNumber,$textMessage);
        return redirect()->back()->with('data_message', 'Bank Details Updated Successfully!.');
    }

    public function saveProfessionalDetailsPrivate(Request $request)
    {
        $loanApply = new CustomerController();
        $loanApply->saveProfessionalDetailsPrivate($request);
        session()->put('step', 5);
        return redirect()->back()->with('data_message', 'Professional Details Updated!');
    }

    public function contactdata(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:10|numeric',
            'message' => 'required|min:10'
        ]);
        
        $name = htmlspecialchars($request->name);
        $email = htmlspecialchars($request->email);
        $phone = htmlspecialchars($request->phone);
        $message = htmlspecialchars($request->message);

        $contactdata = DB::table('contactus')->insert(['name' => $name, 'email' => $email, 'phone' => $phone, 'message' => $message]);
        if ($contactdata) {
            return redirect()->back()->with('success', 'Your Contact Message Submitted Successfully!');
        }
        return redirect()->back()->with('error', 'Your Contact Message Submitted Failed!');
    }

    public function testCases(Request $request)
    {
        if ($request->isMethod('POST')) {
            $lobObj = new GloadController();
            // $aadhaar=$lobObj->ocr_adhaar_verification(5);
            // dd($aadhaar);
        } else {
            return view('web.test');
        }
    }

    public function equifaxDataAPI($userpost)
    {
        $results = [];

        if ($_POST) {
            $name           = $userpost['name'];
            $dob            = $userpost['dob'];
            $addressLine1   = $userpost['addressLine1'];
            $state          = $userpost['state_code'];
            $postal         = $userpost['zip'];
            $phone          = $userpost['phone'];
            $pan_number     = $userpost['pan_number'];
            $father_name    = $userpost['father_name'];
            $customer_id    = $userpost['customer_id'];
            $customerData = $this->db->select('complete_address')->where('customer_id', $customer_id)->get('customer')->result_array();
            // $category = $this->Category_model->getCategory($category_id);
            $customerData = $customerData[0]['complete_address'];
            // $template_type  = $category->template_type;

            $rules = $this->rules_register();

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == FALSE) {
                $results = ['status' => 0, 'message' => strip_tags(validation_errors()), 'data' => []];
            } else {

                $requestData = [];

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://eportuat.equifax.co.in/cir360Report/cir360Report",
                    //   CURLOPT_URL => "https://ists.equifax.co.in/cir360service/cir360report",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    // CURLOPT_POSTFIELDS => $data,
                    CURLOPT_POSTFIELDS => "{\r\n    \"RequestHeader\": {\r\n        \"CustomerId\": \"8784\",\r\n        \"UserId\": \"STS_SALCCR\",\r\n        \"Password\": \"W3#QeicsB\",\r\n        \"MemberNumber\": \"006FZ00574\",\r\n        \"SecurityCode\": \"6SZ\",\r\n        \"CustRefField\": \"123456\",\r\n        \"ProductCode\": [\r\n            \"CCR\"\r\n        ]\r\n    },\r\n    \"RequestBody\": {\r\n        \"InquiryPurpose\": \"05\",\r\n        \"FirstName\": \"$name\",\r\n        \"MiddleName\": \"\",\r\n        \"LastName\": \"\",\r\n        \"DOB\": \"$dob\",\r\n        \"InquiryAddresses\": [\r\n            {\r\n                \"seq\": \"1\",\r\n                \"AddressType\": [\r\n                    \"H\"\r\n                ],\r\n                \"AddressLine1\": \"$customerData\",\r\n                \"State\": \"$state\",\r\n                \"Postal\": \"$postal\"\r\n            }\r\n        ],\r\n        \"InquiryPhones\": [\r\n            {\r\n                \"seq\": \"1\",\r\n                \"Number\": \"$phone\",\r\n                \"PhoneType\": [\r\n                    \"M\"\r\n                ]\r\n            },\r\n            {\r\n                \"seq\": \"2\",\r\n                \"Number\": \"\",\r\n                \"PhoneType\": [\r\n                    \"M\"\r\n                ]\r\n            }\r\n        ],\r\n        \"IDDetails\": [\r\n            {\r\n                \"seq\": \"1\",\r\n                \"IDType\": \"T\",\r\n                \"IDValue\": \"$pan_number\",\r\n                \"Source\": \"Inquiry\"\r\n            },\r\n            {\r\n                \"seq\": \"2\",\r\n                \"IDType\": \"P\",\r\n                \"IDValue\": \"\",\r\n                \"Source\": \"Inquiry\"\r\n            },\r\n            {\r\n                \"seq\": \"3\",\r\n                \"IDType\": \"V\",\r\n                \"IDValue\": \"\",\r\n                \"Source\": \"Inquiry\"\r\n            },\r\n            {\r\n                \"seq\": \"4\",\r\n                \"IDType\": \"D\",\r\n                \"IDValue\": \"\",\r\n                \"Source\": \"Inquiry\"\r\n            },\r\n            {\r\n                \"seq\": \"5\",\r\n                \"IDType\": \"M\",\r\n                \"IDValue\": \"\",\r\n                \"Source\": \"Inquiry\"\r\n            }\r\n        ],\r\n        \"MFIDetails\": {\r\n            \"FamilyDetails\": [\r\n                {\r\n                    \"seq\": \"1\",\r\n                    \"AdditionalNameType\": \"K02\",\r\n                    \"AdditionalName\": \"$father_name\"\r\n                }\r\n            ]\r\n        }\r\n    },\r\n    \"Score\": [\r\n        {\r\n            \"Type\": \"ERS\",\r\n            \"Version\": \"3.1\"\r\n        }\r\n    ]\r\n}",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Cookie: TS0185b412=0191ea91a4967760b41c3e578bc6002c6206f8c24631e7e4ec03f6b3ba0a95d1a3d345440b166a58bb20d4e0c8e4dcfc3f11bcab30",
                        "CustomerId:21",
                        "UserId:UAT_MAXEMO",
                        "Password:V2*Pdhbr",
                        "MemberNumber:027BB02400",
                        "SecurityCode:N42",
                        "CustRefField:123456",
                        "ProductCode:PCS"
                    ),
                ));


                $response = json_decode(curl_exec($curl));
                curl_close($curl);
                // $credit_score = $response->data->list->ScoreDetails[0]->Value;
                // die;
                //    $data = [];
                $score = 'NA';
                if ($response->CCRResponse->CIRReportDataLst[0]->CIRReportData->ScoreDetails[0]->Value) {
                    $score = $response->CCRResponse->CIRReportDataLst[0]->CIRReportData->ScoreDetails[0]->Value;
                } else if ($response->CCRResponse->CIRReportDataLst[1]->CIRReportData->ScoreDetails[0]->Value) {
                    $score = $response->CCRResponse->CIRReportDataLst[1]->CIRReportData->ScoreDetails[0]->Value;
                }
                $save_score = [
                    // 'credit_score'  => ($response->CCRResponse->CIRReportDataLst[0]->CIRReportData->ScoreDetails[0]->Value) ? $response->CCRResponse->CIRReportDataLst[0]->CIRReportData->ScoreDetails[0]->Value : NA,
                    'credit_score' => $score,
                    'credit_score_data'   => serialize($response),
                    'credit_score_data_1'   => serialize($response)
                ];

                // $this->db->where('customer_id', $customer_id);
                // $this->db->update('customer', $save_score);

                $results = ['status' => 1, 'message' => "Credit Report.", 'data' => $response->CCRResponse->CIRReportDataLst[0]->CIRReportData->ScoreDetails, 'whole_data' => $response];

                // $results = $data;
            }
        }
    }
}
