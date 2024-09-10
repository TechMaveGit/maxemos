<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplyLoanHistory;
use App\Models\CashFlowAnalysi;
use App\Models\Category;
use App\Models\CoApplicantDetail;
use App\Models\EmploymentHistory;
use App\Models\LoanKycOtherPendetail;
use App\Models\OtherKycDoc;
use App\Models\Product;
use App\Models\RawMaterialsLoanRequest;
use App\Models\RawMaterialsTxnDetail;
use App\Models\Tenure;
use App\Models\User;
use App\Models\UserActivityHistory;
use App\Models\UserBankDetail;
use App\Models\UserDoc;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\DB;
use Auth;

class ApplyLoanController extends Controller
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

    public function viewAdminLaonDetail(Request $request){
            if(auth()->check() && auth()->user()->email != 'admin@gmail.com'){        
                Auth::logout();
            }
            $id = $request->id;
            $loanDetails=ApplyLoanHistory::where(DB::raw('md5(id)'), $id)->first();
            $rawLoanDetails=RawMaterialsLoanRequest::where('loanId', $loanDetails->id)->where('status','disburse-scheduled')->first() ?? null;
        // if($loanDetails->isAdminApproved != "pending"){
            $lastrawLoanDetails=RawMaterialsLoanRequest::where('loanId', $loanDetails->id)->where('status','!=','disburse-scheduled')->orderBy('id','DESC')->first() ?? null;
            // dd($lastrawLoanDetails,$rawLoanDetails);
            $userloggedData = User::whereId($loanDetails->userId)->first();
            $userId = $loanDetails->userId;
            $userBankDtl = UserBankDetail::where('userId', $userId)->orderBy('id', 'desc')->first();
            $userDocDtl = UserDoc::where('userId', $userId)->orderBy('id', 'desc')->first();
            $userKycDocDtl = LoanKycOtherPendetail::where('userId', $userId)->orderBy('id', 'desc')->get();
            $otherKycDocs = OtherKycDoc::where('userId', $userId)->orderBy('id', 'ASC')->get();
            $userEmploymentHistoryArr = EmploymentHistory::where('userId', $userId)->where('fromAdmin', 0)->orderBy('id', 'desc')->get();
            $coApplicantDtlARR = CoApplicantDetail::where('userId', $userId)->orderBy('id', 'asc')->get();

            $newUserRes = User::where(['kycStatus' => 'pending', 'userType' => 'user'])->limit(10)->orderBy('id', 'desc')->get();
            $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();

            $tenures = Tenure::where('loanCategory', 3)->orderBy('sortOrder', 'ASC')->get();

            $allLoans = DB::table('apply_loan_histories')->leftJoin('categories', 'categories.id', 'apply_loan_histories.loanCategory')->where('userId', $userId)->orderBy('apply_loan_histories.loanCategory')->get(['apply_loan_histories.id', 'categories.name']);
            // dd($allLoans);
            return view('web/view-loan-details',compact('loanDetails','allLoans', 'userloggedData', 'tenures', 'newUserRes', 'userBankDtl', 'userDocDtl','userKycDocDtl', 'userEmploymentHistoryArr', 'coApplicantDtlARR', 'otherKycDocs', 'categories','rawLoanDetails','lastrawLoanDetails'));
        // }else{
        //     echo '<center><h3>You already Loan already .</h3></center>';
        // }
    }

    public function viewAdminLaonDetailSubmit(Request $request){
        $id = $request->id;
        $loanStatus = $request->loanData;
        $rejectionReason = $loanStatus == 'approved' ? null : $request->rejectionReason;
        $loanData = ApplyLoanHistory::where('id',$id)->first();
        $rawLoanDetails=RawMaterialsLoanRequest::where('loanId', $id)->first() ?? null;
        if($loanData->loanCategory == 3){
            if($loanStatus == "rejected"){
                DB::table('raw_materials_loan_requests')->where(['loanId'=>$id,'status'=>'disburse-scheduled'])->update(['isAdminApproved'=>$loanStatus,'reject_reason'=>$rejectionReason,'status'=>'rejected']);
            }else{
                DB::table('apply_loan_histories')->where(['id'=>$id])->update(['isAdminApproved'=>$loanStatus,'reject_reason'=>$rejectionReason]);
                DB::table('raw_materials_loan_requests')->where(['loanId'=>$id,'status'=>'disburse-scheduled'])->update(['isAdminApproved'=>$loanStatus,'reject_reason'=>$rejectionReason]);
            }
        }else{
            ApplyLoanHistory::where('id',$id)->update(['isAdminApproved'=>$loanStatus,'reject_reason'=>$rejectionReason]);
        }
        echo '<center><h3>Thanks to review loan.</h3></center>';
        // return 1;
    }

    public function saveCoApplicantInfo(Request $request)
    {

        $recordId=$request->recordId;
        $actionTrigger=$request->actionTrigger;
            //        if($recordId>0){
            //            $isValidated=AppServiceProvider::validatePermission('edit-customers');
            //        }else{
            //            $isValidated=AppServiceProvider::validatePermission('add-customers');
            //        }

        $saveUp['userId']=$recordId;
        $saveUp['nameTitleCoApp']=$request->nameTitleCoApp;
        $saveUp['customerNameCoApp']=$request->customerNameCoApp;
        $saveUp['genderCoApp']=$request->genderCoApp;
        $saveUp['dateOfBirthCoApp']=(strtotime($request->dateOfBirthCoApp)) ? date('Y-m-d',strtotime($request->dateOfBirthCoApp)) : NULL;
        $saveUp['religionCoApp']=$request->religionCoApp;
        $saveUp['educationStatusCoApp']=$request->educationStatusCoApp;
        $saveUp['fatherNameCoApp']=$request->fatherNameCoApp;
        $saveUp['motherNameCoApp']=$request->motherNameCoApp;
        $saveUp['maritalStatusCoApp']=$request->maritalStatusCoApp;
        $saveUp['relationWithApplicantCoApp']=$request->relationWithApplicantCoApp;
        $saveUp['cibilScoreCoApp']=$request->cibilScoreCoApp;
        $saveUp['status']='1';

        if($actionTrigger=='save'){
            goto saveCoApplicantInfo;
        }

        $ifExist=CoApplicantDetail::where('userId',$recordId)->first();
        if(!empty($ifExist)){

            $saveUp['updated_at']=date('Y-m-d H:i:s');
            $save=CoApplicantDetail::where('userId',$recordId)->update($saveUp);
        }else{
            saveCoApplicantInfo: 
            
            $saveUp['created_at']=date('Y-m-d H:i:s');
            $saveUp['updated_at']=date('Y-m-d H:i:s');
            $save=DB::table('co_applicant_details')->insertGetId($saveUp);
        }
        if($save){
            echo json_encode(['status'=>'success','message'=>'Co Applicant details has been saved successfully.','userId'=>(!$recordId) ? $save : '']);
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
        }
    }


    public function saveCashFlowAnalysisInfo($request)
    {
        //print_r($request);exit;
        $recordId=$request['recordId'];

        $saveUp['userId']=$recordId;
        $saveUp['sourceOfIncome']=$request['sourceOfIncome'];
        $saveUp['cfaSale']=$request['cfaSale'];
        $saveUp['cfaMargin']=$request['cfaMargin'];
        $saveUp['cfaGrossMargin']=$request['cfaGrossMargin'];
        $saveUp['cfaAmountAvailable']=$request['cfaAmountAvailable'];
        $saveUp['cfaElectricityBillOfResidence']=$request['cfaElectricityBillOfResidence'];
        $saveUp['cfaElectricityBillOfBusiness']=$request['cfaElectricityBillOfBusiness'];
        $saveUp['cfaResidenceBusinessPermissesRent']=$request['cfaResidenceBusinessPermissesRent'];
        $saveUp['cfaHouseHoldExpense']=$request['cfaHouseHoldExpense'];
        $saveUp['cfaSalary']=$request['cfaSalary'];
        $saveUp['cfaMiscExpenses']=$request['cfaMiscExpenses'];
        $saveUp['cfaSchoolFee']=$request['cfaSchoolFee'];
        $saveUp['cfaGrossAmountAvailable']=$request['cfaGrossAmountAvailable'];
        $saveUp['cfaRunningEmi']=$request['cfaRunningEmi'];
        $saveUp['cfaCreditCardEMi']=$request['cfaCreditCardEMi'];
        $saveUp['cfaProposedEmi']=$request['cfaProposedEmi'];
        $saveUp['cfaNetAmountAvailable']=$request['cfaNetAmountAvailable'];
        $saveUp['cfaFOIR']=$request['cfaFOIR'];
        $saveUp['cfaNetMonthlyIncome']=$request['cfaNetMonthlyIncome'];

        $ifExist=CashFlowAnalysi::where('userId',$recordId)->first();

        if(!empty($ifExist)){
            $saveUp['updated_at']=date('Y-m-d H:i:s');
            $save=CashFlowAnalysi::where('userId',$recordId)->update($saveUp);
        }else{
            $saveUp['created_at']=date('Y-m-d H:i:s');
            $saveUp['updated_at']=date('Y-m-d H:i:s');
            $save=DB::table('cash_flow_analysis')->insertGetId($saveUp);
        }

        if($save){
            //echo json_encode(['status'=>'success','message'=>'Personal discussion details has been saved successfully.','userId'=>(!$recordId) ? $save : '']);
            return true;
        }else{
            //echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            return false;
        }
    }

    //TODO KYC Controller savekyc
    public function saveKycDetails(Request $request)
    {
        $recordId=$request->recordId;

        $saveUp['userId']=$recordId;

        

        $lobObj=new GloadController();

        

        if(!empty($request->idProofFront) && !empty($request->idProofBack)){
            $image=AppServiceProvider::uploadImageCustom('idProofFront','user-docs');
            $saveUp['idProofFront']=$image;

            $image=AppServiceProvider::uploadImageCustom('idProofBack','user-docs');
            $saveUp['idProofBack']=$image;

            if(config('app.env') == "production" || config('app.env') == "testing"){
                $aadhaar=$lobObj->ocr_adhaar_verification(1);
                if(empty($aadhaar)){
                    //echo json_encode(['status'=>'error','message'=>'Invalid id proof, Please try again.']); exit;
                }
            }
            //print_r($aadhaar);exit;
        }

        if(!empty($request->panCardFront)){
            $image=AppServiceProvider::uploadImageCustom('panCardFront','user-docs');
            $saveUp['panCardFront']=$image;

            if(config('app.env') == "production" || config('app.env') == "testing"){
                $pancheck=$lobObj->ocr_adhaar_verification(3,'panCardFront');
                if(empty($pancheck)){
                    //echo json_encode(['status'=>'error','message'=>'Invalid id proof, Please try again.']); exit;
                }
            }
        }


        $kyc1_others = [];

        $loanDetailsData = LoanKycOtherPendetail::where('userId',$recordId)->select('pancard_no')->get();

        $kyc1_pancard_no = (isset($loanDetailsData) && isset($loanDetailsData[0])) ? $loanDetailsData[0]->pancard_no : null;
       
        
        if((config('app.env') == "production" || config('app.env') == "testing") && $request->hasFile('kyc1_pancard_img')){
            $kyc1pancard=$lobObj->ocr_adhaar_verification(3,'kyc1_pancard_img');
            // dd($kyc1pancard);
            if(empty($kyc1pancard) || !isset($kyc1pancard->msg->father_name)){
                return redirect()->back()->with('error','Invalid Photo of Pan Card Partner 1.');
            }
            $kyc1_pancard_img=AppServiceProvider::uploadImageCustom('kyc1_pancard_img','user-docs');
            $kyc1_others['fatherName']= isset($kyc1pancard->msg->father_name) && $kyc1pancard->msg->father_name ?  $kyc1pancard->msg->father_name : null;
            $kyc1_pancard_no= $kyc1pancard->msg->doc_id ? $kyc1pancard->msg->doc_id : null;
            $kyc1_others['dateOfBirth']= isset($kyc1pancard->msg->dob)  ? date('Y-m-d',strtotime(str_replace('/','-',$kyc1pancard->msg->dob))) : null ;
            $kyc1_others['name']= isset($kyc1pancard->msg->name) && $kyc1pancard->msg->name ?  $kyc1pancard->msg->name : null;
            $kyc1_others['pancard_img']= $kyc1_pancard_img;
        }
        
        $kyc1_others['gender']=  $request->kyc1_gender ?? 'Male';
        $kyc1_others['mobile']= $request->kyc1_mobile ?? null;
        $kyc1_others['email']= $request->kyc1_email ?? null;
        $kyc1_others['addressLine1']= $request->kyc1_address ?? null;
        $kyc1_others['city']= $request->kyc1_city ?? null;
        $kyc1_others['state_short']= $request->kyc1_state ?? null;
        $kyc1_others['state']= $this->indianStates[$request->kyc1_state];
        $kyc1_others['pincode']= $request->kyc1_pincode ?? null;
        if($kyc1_pancard_no && $request->kyc1_mobile && $request->kyc1_email && $request->kyc1_state && $request->kyc1_pincode && $request->kyc1_gender){
            LoanKycOtherPendetail::UpdateOrCreate(['pancard_no'=>$kyc1_pancard_no,'userId'=>$recordId],$kyc1_others);
        }
        
        $kyc2_others = [];
        $kyc2_pancard_no = (isset($loanDetailsData) && isset($loanDetailsData[1])) ? $loanDetailsData[1]->pancard_no : null;
        if((config('app.env') == "production" || config('app.env') == "testing") && $request->hasFile('kyc2_pancard_img')){
            $kyc2pancard=$lobObj->ocr_adhaar_verification(3,'kyc2_pancard_img');
            if(empty($kyc2pancard) || !isset($kyc2pancard->msg->father_name)){
                return redirect()->back()->with('error','Invalid Photo of Pan Card Partner 2.');
            }
            $kyc2_pancard_img=AppServiceProvider::uploadImageCustom('kyc2_pancard_img','user-docs');
            $kyc2_others['fatherName']= isset($kyc2pancard->msg->father_name) && $kyc2pancard->msg->father_name ?  $kyc2pancard->msg->father_name : null;
            $kyc2_pancard_no= $kyc2pancard->msg->doc_id ? $kyc2pancard->msg->doc_id : null;
            $kyc2_others['dateOfBirth']= isset($kyc2pancard->msg->dob)  ? date('Y-m-d',strtotime(str_replace('/','-',$kyc2pancard->msg->dob))) : null ;
            $kyc2_others['name']= isset($kyc2pancard->msg->name) && $kyc2pancard->msg->name ?  $kyc2pancard->msg->name : null;
            $kyc2_others['pancard_img']= $kyc2_pancard_img;
        }
        $kyc2_others['gender']= $request->kyc2_gender ?? null;
        $kyc2_others['mobile']= $request->kyc2_mobile ?? null;
        $kyc2_others['email']= $request->kyc2_email ?? null;
        $kyc2_others['addressLine1']= $request->kyc2_address ?? null;
        $kyc2_others['city']= $request->kyc2_city ?? null;
        $kyc2_others['state_short']= $request->kyc2_state ?? null;
        $kyc2_others['state']= $this->indianStates[$request->kyc2_state];
        $kyc2_others['pincode']= $request->kyc2_pincode ?? null;
        if($kyc2_pancard_no && $request->kyc2_mobile && $request->kyc2_email && $request->kyc2_state && $request->kyc2_pincode && $request->kyc2_gender){
            LoanKycOtherPendetail::UpdateOrCreate(['pancard_no'=>$kyc2_pancard_no,'userId'=>$recordId],$kyc2_others);
        }





        if(!empty($request->addressProofFront)){
            $image=AppServiceProvider::uploadImageCustom('addressProofFront','user-docs');
            $saveUp['addressProofFront']=$image;
        }

        if(!empty($request->addressProofBack)){
            $image=AppServiceProvider::uploadImageCustom('addressProofBack','user-docs');
            $saveUp['addressProofBack']=$image;
        }

        if(!empty($request->salerySlip1)){
            $image=AppServiceProvider::uploadImageCustom('salerySlip1','user-docs');
            $saveUp['salerySlip1']=$image;
        }

        if(!empty($request->salerySlip2)){
            $image=AppServiceProvider::uploadImageCustom('salerySlip2','user-docs');
            $saveUp['salerySlip2']=$image;
        }

        if(!empty($request->salerySlip3)){
            $image=AppServiceProvider::uploadImageCustom('salerySlip3','user-docs');
            $saveUp['salerySlip3']=$image;
        }

        if(!empty($request->bankAttachemet)){
            $image=AppServiceProvider::uploadImageCustom('bankAttachemet','user-docs');
            $saveUp['bankAttachemet']=$image;
        }

        /*if(!empty($request->otherDocument)){
            $image=AppServiceProvider::uploadImageCustom('otherDocument','user-docs');
            $saveUp['otherDocument']=$image;
        }
        
        if(!empty($request->otherDocumentTitle)){
            $saveUp['otherDocumentTitle']=$request->otherDocumentTitle;
        }*/
        
        if($request->otherDocumentTitle){
            $otherDocumentTitle = explode(",",$request->otherDocumentTitle);
        }else{
            $otherDocumentTitle = $request->otherDocumentTitle;
        }

        if($request->otherDocumentIds){
            $otherDocumentIds = explode(",",$request->otherDocumentIds);
        }else{
            $otherDocumentIds = null;
        }
        
        
        if($otherDocumentIds){
            $indt = 0;
            $docsUrlArr=AppServiceProvider::uploadImageCustomMulti('otherDocumentExist','user-docs');
            foreach($otherDocumentIds as $kk=>$vv){
                $otherRow = $otherDocumentTitle[$kk];
                if ($request->hasFile('otherDocumentExist')) {
                    $newSave[]=['userId'=>$recordId,'title'=>$otherRow,'docsUrl'=>(isset($docsUrlArr[$indt])) ? $docsUrlArr[$indt] : ''];
                    OtherKycDoc::where(['id'=>$vv,"userId"=>$recordId])->update(['title'=>$otherRow,'docsUrl'=>(isset($docsUrlArr[$indt])) ? $docsUrlArr[$indt] : '']);
                }else{
                    OtherKycDoc::where(['id'=>$vv,"userId"=>$recordId])->update(['title'=>$otherRow]);
                }
                unset($otherDocumentTitle[$kk]);
               
                $indt++;
            }
        }

        $request->merge(['otherDocumentTitle' => $otherDocumentTitle]);

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
                        $newSave[]=['userId'=>$recordId,'title'=>$otherRow,'docsUrl'=>(isset($docsUrlArr[$osr])) ? $docsUrlArr[$osr] : '','created_at'=>$currentDate,'updated_at'=>$currentDate];
                    }
                    
                    $osr++;
                }
                //print_r($newSave);exit;
                OtherKycDoc::insert($newSave);
            }
        }

        



        $ifExist=UserDoc::where('userId',$recordId)->first();

        if(!empty($ifExist)){
            $saveUp['updated_at']=date('Y-m-d H:i:s');
            $save=UserDoc::where('userId',$recordId)->update($saveUp);
        }else{
            $saveUp['created_at']=date('Y-m-d H:i:s');
            $saveUp['updated_at']=date('Y-m-d H:i:s');
            $save=DB::table('user_docs')->insertGetId($saveUp);
        }
        if($save){
            echo json_encode(['status'=>'success','message'=>'Customer KYC details has been saved successfully.','userId'=>(!$recordId) ? $save : '']);
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
        }
    }

    public function saveProfessionalDetails(Request $request)
    {
        $recordId=$request->recordId;

        $saveUp['userId']=$recordId;
        $saveUp['employerName']=$request->employerName;
        $saveUp['companyTeleNo']=$request->companyTeleNo;
        $saveUp['mobileNo']=$request->companyMobileNo;
        $saveUp['emailId']=$request->companyEmailId;
        $saveUp['companyFaxNo']=$request->companyFaxNo;
        $saveUp['companyGstin']=$request->companyGstin;
        $saveUp['companyPan']=$request->companyPan;
        $saveUp['companyType']=$request->companyType;
        $saveUp['state']=$request->companyState;
        $saveUp['district']=$request->companyDistrict;
        $saveUp['address']=$request->companyAddress;
        $saveUp['pincode']=$request->companyPincode;        
        $saveUp['currentSalary']=($request->currentSalary) ? $request->currentSalary : '0';
        $saveUp['totalExpInCurrentCompany']=($request->totalExpInCurrentCompany) ? $request->totalExpInCurrentCompany : '0';
        $saveUp['isBusiness']=$request->isBusiness;
        


        $ifExist=EmploymentHistory::where('userId',$recordId)->where('isBusiness', $request->isBusiness)->first();

        $this->saveCashFlowAnalysisInfo($request->all());
        if(!empty($ifExist)){
            $saveUp['updated_at']=date('Y-m-d H:i:s');
            $save=EmploymentHistory::where('userId',$recordId)->where('isBusiness', $request->isBusiness)->update($saveUp);
        }else{
            $saveUp['status']='pending';
            $saveUp['created_at']=date('Y-m-d H:i:s');
            $saveUp['updated_at']=date('Y-m-d H:i:s');
            $save=DB::table('employment_histories')->insertGetId($saveUp);
        }
        if($save){
            echo json_encode(['status'=>'success','message'=>'Employment details has been saved successfully.','userId'=>(!$recordId) ? $save : '']);
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
        }
    }

    public function saveUserBankDetails(Request $request)
    {
        $recordId=$request->recordId;

        $saveUp['userId']=$recordId;
        $saveUp['accountHolderName']=$request->accountHolderName;
        $saveUp['bankName']=$request->bankName;
        $saveUp['ifscCode']=$request->ifscCode;
        $saveUp['accountType']=$request->accountType;
        $saveUp['accountNumber']=$request->accountNumber;
        $saveUp['address']=$request->bankAddress;
        $saveUp['state']=$request->bankState;
        $saveUp['city']=$request->bankCity;
        $saveUp['pincode']=$request->bankPincode;


        $ifExist=UserBankDetail::where('userId',$recordId)->first();

        if(!empty($ifExist)){
            $saveUp['updated_at']=date('Y-m-d H:i:s');
            $save=UserBankDetail::where('userId',$recordId)->update($saveUp);
        }else{
            $saveUp['created_at']=date('Y-m-d H:i:s');
            $saveUp['updated_at']=date('Y-m-d H:i:s');
            $save=DB::table('user_bank_details')->insertGetId($saveUp);
        }

        if($save){
            echo json_encode(['status'=>'success','message'=>'Bank details has been saved successfully.','userId'=>(!$recordId) ? $save : '']);
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
        }
    }

    public function applyLoanByAdmin(Request $request)
    {

        $isValidated=AppServiceProvider::validatePermission('send-for-admin-approval');

        $userId=$request->initiateApplyLoanUserId;
        $productName=$request->productName;
        $loanCategory=$request->loanCategory;
        $approveTenure=($request->approveTenure) ? $request->approveTenure : 0;
        $approvedAmount=$request->approvedAmount;
        $approvedRoi=$request->approvedRoi;
        $plateformFee=$request->plateformFee;
        $insurance=$request->insurance;
        $roiType=$request->roiType;

        $validFromDate=(strtotime($request->validFromDate)) ? date('Y-m-d',strtotime($request->validFromDate)) : '';
        $validToDate=(strtotime($request->validToDate)) ? date('Y-m-d',strtotime($request->validToDate)) : '';

        $validFromDateD=(strtotime($request->validFromDate)) ? date('d M, Y',strtotime($request->validFromDate)) : '';
        $validToDateD=(strtotime($request->validToDate)) ? date('d M, Y',strtotime($request->validToDate)) : '';

        $employmentDetails=EmploymentHistory::where(['userId'=>$userId])->first();
        if(!empty($employmentDetails) && $loanCategory==1){
            $companyGstin=trim(strtolower($employmentDetails->companyGstin));
            $companyGstinNew=str_replace(['na','n/a',''],"",$companyGstin);
            if(empty($companyGstinNew)){
                echo json_encode(['status'=>'error','message'=>'GST number is mandatory for business loan.']); exit;
            }
        }

        $currentDate=date('Y-m-d H:i:s');

        $userDtl=User::getUserDetailsById($userId);
        if(empty($userDtl)){
            echo json_encode(['status'=>'error','message'=>'Invalid Request, Please try again.']); exit;
        }

        $image='';
        if(!empty($request->invoiceFile)){
            $image=AppServiceProvider::uploadImageCustom('invoiceFile','invoice-loan');
        }


        $principleChargesArr['gst']=0;
        $principleChargesArr['premium']=0;
        $principleChargesArr['processingFee']=0;
        $principleChargesArr['insurance']=$insurance;
        $principleChargesArr['verificationCharges']=0;
        $principleChargesArr['collectionFee']=0;
        $principleChargesArr['plateformFee']=$plateformFee;
        $principleChargesArr['convenienceFee']=0;
        $principleChargesArr['principleAmount']=0;
        $principleChargesArr['pfPercentage']=0;

        $principleChargesStr=json_encode($principleChargesArr);
        $principleCharges=$plateformFee+$insurance;

        $saveArr['userId']=$userId;
        $saveArr['productId']=($productName) ? $productName : 0;
        $saveArr['loanCategory']=$loanCategory;
        $saveArr['loanAmount']=$approvedAmount;
        $saveArr['approvedAmount']=$approvedAmount;
        $saveArr['tenure']=$approveTenure;
        $saveArr['approvedTenure']=$approveTenure;
        $saveArr['rateOfInterest']=$approvedRoi;
        $saveArr['invoiceFile']=$image;
        $saveArr['principleChargesDetails']=$principleChargesStr;
        $saveArr['principleCharges']=$principleCharges;
        //$saveArr['netDisbursementAmount']=($approvedAmount-$principleCharges);
        $saveArr['netDisbursementAmount']=($approvedAmount);
        $saveArr['roiType']=$roiType;

        if($validFromDate && $validToDate){
            $saveArr['validFromDate']=$validFromDate;
            $saveArr['validToDate']=$validToDate;
        }

        $saveArr['status']='sent-for-admin-approval';
        $saveArr['created_at']=$currentDate;
        $saveArr['updated_at']=$currentDate;

        $loanId = DB::table('apply_loan_histories')->insertGetId($saveArr);
        

        if($loanId){
            echo json_encode(['status'=>'success','message'=>'Loan has been sent for admin approval.']); exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Something went wrong, Please try again.']); exit;
        }

    }


    public function sendLoanForCustomerApproval(Request $request)
    {
        dd('--');
        $isValidated=AppServiceProvider::validatePermission('loan-send-for-approval');

        $userId=$request->userId;
        $approvedROI=$request->approvedROI;
        $approvedAmount=$request->approvedAmount;
        $loanId=$request->loanId;
        $approveTenure=$request->approveTenure;

        $acceptURL=route('acceptLoanByCustomer',[1,md5($loanId)]);
        $rejectURL=route('acceptLoanByCustomer',[2,md5($loanId)]);
        $userDtl=User::getUserDetailsById($userId);
        $RES=ApplyLoanHistory::where('id',$loanId)->update(['approvedTenure'=>$approveTenure,'approvedAmount'=>$approvedAmount,'rateOfInterest'=>$approvedROI,'status'=>'sent-for-customer-approval']);

        $loanDetails=DB::select("SELECT alh.id as loanId,alh.userId,alh.loanAmount appliedLoanAmount,alh.tenure as appliedTenure,alh.rateOfInterest as givenROI,alh.approvedAmount,alh.approvedAmount,alh.status as loanStatus,alh.remark,p.productCode,p.productName,p.rateOfInterest as productROI,p.tenure as productTenure,p.amount as productAmount,p.amountTo as productAmountTo,p.numOfEmi as productEMI,p.gst,p.premium,p.processingFee,p.insurance,p.verificationCharges,p.collectionFee,p.plateformFee,p.convenienceFee,p.principleAmount,p.productType,p.pfPercentage,c.name as categoryName,sc.name as subCategoryName FROM apply_loan_histories alh LEFT JOIN products p ON alh.productId=p.id LEFT JOIN categories c ON p.categoryId=c.id LEFT JOIN subcategories sc ON p.subCategoryId=sc.id WHERE alh.status='sent-for-customer-approval' and alh.userId='$userId' AND alh.id='$loanId' ORDER BY alh.id DESC limit 1");
        if(count($loanDetails)) {
            $loanDetails = $loanDetails[0];

            $principleChargesArr['gst']=$loanDetails->gst;
            $principleChargesArr['premium']=0;
            $principleChargesArr['processingFee']=0;
            $principleChargesArr['insurance']=$loanDetails->insurance;
            $principleChargesArr['verificationCharges']=$loanDetails->verificationCharges;
            $principleChargesArr['collectionFee']=0;
            $principleChargesArr['plateformFee']=$loanDetails->plateformFee;
            $principleChargesArr['convenienceFee']=0;
            $principleChargesArr['principleAmount']=$loanDetails->principleAmount;
            $principleChargesArr['pfPercentage']=$loanDetails->pfPercentage;

            $principleChargesStr=json_encode($principleChargesArr);
            ApplyLoanHistory::where('id',$loanId)->update(['principleCharges'=>$loanDetails->principleAmount,'principleChargesDetails'=>$principleChargesStr]);

            $verifyWith = env('APP_NAME');

            $htmlSt = '<div>
                        <p>Dear ' . $userDtl->name . ',</p>
                        <p>Please check your loan details as follows:-</p>
                        <div>
                            <table style="width: 100%;">';

            $htmlSt .= '<tr>
                            <th style="width: 50%;padding: 6px !important;">Product Name</th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->productName.'</th>
                       </tr>';
            $htmlSt .='<tr>
                        <th style="width: 50%;padding: 6px !important;">Appiled Amount</th>
                        <th style="width: 50%;padding: 6px !important;">'. number_format($loanDetails->appliedLoanAmount,2).'</th>
                   </tr>';
            $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Approved Amount</th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($approvedAmount,2).'</th>
                       </tr>';
            $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Approved ROI</th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($approvedROI,2).'</th>
                       </tr>';

            if($loanDetails->gst){
                $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">GST</th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->gst.'</th>
                       </tr>';
            }

            /*
            if($loanDetails->processingFee){
                $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Processing Fee</th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->processingFee.'</th>
                       </tr>';
            }
            */

            if($loanDetails->insurance){
                $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Insurance</th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($loanDetails->insurance,2).'</th>
                       </tr>';
            }

            /*
            if($loanDetails->collectionFee){
                $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Collection Fee</th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->collectionFee.'</th>
                       </tr>';
            }
            */

            if($loanDetails->plateformFee){
                $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Platform Fee</th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($loanDetails->plateformFee,2).'</th>
                       </tr>';
            }

            /*
            if($loanDetails->convenienceFee){
                $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Convenience Fee</th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->convenienceFee.'</th>
                       </tr>';
            }
            */

            if($loanDetails->pfPercentage){
                $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">PF (%)</th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->pfPercentage.'</th>
                       </tr>';
            }

            if($loanDetails->principleAmount){
                $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Principle Amount</th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($loanDetails->principleAmount,2).'</th>
                       </tr>';
            }

            $htmlSt .='<tr>
                            <th colspan="2" style="width: 50%;padding: 6px !important;">
                            <strong>
                                '.$verifyWith.'  has been approved abouve mentioned loan amount & rate of interest (ROI), Please accept this letter to get this loan.
                            </strong>
                            </th>
                       </tr>';
            $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">
                                <p>
                                    <center><a href="'.$acceptURL.'" target="_blank" style="color: blue;font-size: 22px;font-weight: bold;">Click Here To Accept</a></center>
                                </p>
                            </th>
                            <th style="width: 50%;padding: 6px !important;">
                                 <p style="margin-top:20px !important;">
                                    <center><a href="'.$rejectURL.'" target="_blank" style="color: blue;font-size: 22px;font-weight: bold;">Click Here To Reject</a></center>
                                </p>
                            </th>
                       </tr>';

            $htmlSt .='</table>
                        </div>
                     </div>';


            $toMail=$userDtl->email;
            $toUser=$userDtl->name;
            $subject='Need Approval For Loan '.$verifyWith;

            if($RES){
                AppServiceProvider::sendMail($toMail,$toUser,$subject,$htmlSt);

                echo json_encode(['status'=>'success','message'=>'Your request has been processed successfully.','data'=>$htmlSt]); exit;
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']); exit;
            }
        }else{
            echo json_encode(['status'=>'error','message'=>'Invalid Request, Please try again.']); exit;
        }
    }

    public function acceptLoanByCustomer($status,$id)
    {
        $loanDetails=ApplyLoanHistory::where(DB::raw('md5(id)'), $id)->first();
        $userDtl=User::getUserDetailsById($loanDetails->userId);
        if(empty($userDtl)){
            echo '<center><h1>Invalid Request</h1></center>'; exit;
        }

        if(!empty($loanDetails))
        {
            if($status==1){
                $statusText='customer-approved';
                $title='Loan Accepted';
                $body='Loan has been accepted by you, Please wait for disburse.';
                $message='Loan has been accepted by you, Please wait for disburse.';
                $notificationType='customer-approved';
                
                if($loanDetails->loanCategory == 3){

                $loaddata_json = json_decode($loanDetails->principleChargesDetails); 
                
                
                $htmlSt = '<div>
                        <p>Dear Admin,</p>
                        <p>Please check loan details as follows:-</p>
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
                        <th style="width: 50%;padding: 6px !important;">Appiled Amount</th>
                        <th style="width: 50%;padding: 6px !important;">'. number_format($loanDetails->loanAmount,2).'</th>
                   </tr>
                   <tr>
                        <th style="width: 50%;padding: 6px !important;">Approved Amount</th>
                        <th style="width: 50%;padding: 6px !important;">'. number_format($loanDetails->approvedAmount,2).'</th>
                   </tr><tr>
                            <th style="width: 50%;padding: 6px !important;">ROI % </th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->rateOfInterest.'%</th>
                       </tr>';
                if(isset($loaddata_json->plateformFee))
                {
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Plateform Fee </th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($loaddata_json->plateformFee,2).'</th>
                       </tr>';
                }

                if(isset($loaddata_json->insurance))
                {
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Insurance Fee </th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($loaddata_json->insurance,2).'</th>
                       </tr>';
                }
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Valid From </th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->validFromDate.'</th>
                       </tr><tr>
                            <th style="width: 50%;padding: 6px !important;">Valid To </th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->validToDate.'</th>
                       </tr>
                       </table>
                        </div>
                     </div>';

                     $verifyWith = env('APP_NAME');

                     $renewal_from = $loanDetails->validFromDate;
                     $renewal_to = $loanDetails->validToDate;

                     DB::table('renewal_loans')->insert(["loanid"=>$loanDetails->id,"userId"=>$loanDetails->userId,"plateform_fee"=>$loaddata_json->plateformFee,"renewal_from"=>$renewal_from,"renewal_to"=>$renewal_to,"txn_date"=>$renewal_from]);

                     if(config('app.env') == "production"){
                        AppServiceProvider::sendMail("info@maxemocapital.com","Info Maxemo","New Raw Material Financing Loan Approved  | ".$verifyWith,$htmlSt);
                        AppServiceProvider::sendMail("shorya.mittal@maxemocapital.com","Shorya Mittal","New Raw Material Financing Loan Approved  | ".$verifyWith,$htmlSt);
                        AppServiceProvider::sendMail("vipul.mittal@maxemocapital.com","Vipul Mittal","New Raw Material Financing Loan Approved  | ".$verifyWith,$htmlSt);
                        AppServiceProvider::sendMail("vivek.mittal@maxemocapital.com","Vivek Mittal","New Raw Material Financing Loan Approved  | ".$verifyWith,$htmlSt);
                     }else if(config('app.env') == "testing"){
                        AppServiceProvider::sendMail("anjali.negi@maxemocapital.com","Anjali","New Raw Material Financing Loan Approved  | ".$verifyWith,$htmlSt);
                     }
                     else{
                        AppServiceProvider::sendMail("basant@techmavesoftware.com","Basant","New Raw Material Financing Loan Approved  | ".$verifyWith,$htmlSt);
                     }
                }
                
            }else{
                $statusText='rejected';
                $title='Loan Rejected';
                $body='Loan rejected by you we will not take any action on this.';
                $message='Loan rejected by you we will not take any action on this.';
                $notificationType='customer-rejected';
            }

            $RES=ApplyLoanHistory::where(DB::raw('md5(id)'),$id)->update(['status'=>$statusText]);
            if($RES){
                
                echo '<center><h1>Your request has been processed successfully.</h1></center>'; exit;
            }else{
                echo '<center><h1>Some error occurred, Please try again.</h1></center>'; exit;
            }
        }else{
            echo '<center><h1>Invalid Request</h1></center>'; exit;
        }
    }

    public function acceptConsentByCustomer($status,$id)
    {
        $userDetails=User::where(DB::raw('md5(id)'), $id)->first();
        if(empty($userDetails)){
            echo '<center><h1>Invalid Request</h1></center>'; exit;
        }

        if(!empty($userDetails) && ($status==1 || $status==2))
        {

            if($userDetails->initialConcentApproval!=0)
            {
                echo '<center><h1>Invalid Request</h1></center>'; exit;
            }else{
                $RES=User::where(DB::raw('md5(id)'),$id)->update(['initialConcentApproval'=>$status]);
                if($RES){
                    
                    echo '<center><h1>Your request has been processed successfully.</h1></center>'; exit;
                }else{
                    echo '<center><h1>Some error occurred, Please try again.</h1></center>'; exit;
                }
            }
        }else{
            echo '<center><h1>Invalid Request</h1></center>'; exit;
        }
    }

    public function saveKycStatus(Request $request)
    {
        $isValidated=AppServiceProvider::validatePermission('approverejectkyc');

        $userId=$request->userId;
        $status=$request->status;
        $remark=$request->remark;
        $verifyType=$request->verifyType;

        $userDtl=User::getUserDetailsById($userId);
        if (empty($userDtl)){
            echo json_encode(['status'=>'error','message'=>'Invalid Request, Please try again.']); exit;
        }

        $statusText='';
        if($status==1){
            $statusText='approved';
            $remark=($remark) ? $remark : 'Kyc has been approved successfully.';

            $title='KYC Approved';
            $body='Your kyc has been approved successfully.';
            $message='Your kyc has been approved successfully.';
            $notificationType='kyc-approved';

        }else if($status==2){
            $statusText='rejected';

            $title='KYC Rejected';
            $body='Your kyc has been rejected, Please contact to support team.';
            $message='Your kyc has been rejected, Please contact to support team.';
            $notificationType='kyc-rejected';
        }

        $isBusiness = 0;
        if($verifyType == 'business'){
            $isBusiness = 1;
        }
        // dd($request->all());
        DB::table('employment_histories')->where(['userId'=>$userId,'isBusiness'=>$isBusiness])->update(['status'=>$statusText]);

        $userUp=User::where(['id'=>$userId])->update(['kycStatus'=>$statusText]);
        // if(!DB::table('employment_histories')->where(['userId'=>$userId,'status'=>'pending'])->exists()){
        //     $userUp=User::where(['id'=>$userId])->update(['kycStatus'=>'approved']);
        // }elseif(DB::table('employment_histories')->where(['userId'=>$userId,'status'=>'rejected'])->count() == DB::table('employment_histories')->where(['userId'=>$userId])->count()){
        //     $userUp=User::where(['id'=>$userId])->update(['kycStatus'=>'rejected']);
        // }else{
        //     $userUp = false;
        // }

        
        if($remark)
        {
            $obj=new UserActivityHistory();
            $obj->userId=$userId;
            $obj->type='kyc';
            $obj->remark=$remark;
            $obj->save();
        }

        if($userUp){
            
            echo json_encode(['status'=>'success','message'=>'Your request has been processed successfully.']); exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']); exit;
        }
    }


    public function sendLoanForCustomerApprovalExceptRawMaterial($userId,$approvedROI,$approvedAmount,$loanId,$approveTenure,$plateformFee,$insurance,$netDisbursementAmount,$roiType,$tds,$isPaidInterest)
    {
        
        $loanDetails=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.userId='$userId' AND alh.id='$loanId' ORDER BY alh.id DESC");
        if(!count($loanDetails)){
            echo json_encode(['status'=>'error','message'=>'Something went wrong, Please try again.']); exit;
        }
        $loanDetails=$loanDetails[0];
        
       

        $acceptURL=route('acceptLoanByCustomer',[1,md5($loanId)]);
        $rejectURL=route('acceptLoanByCustomer',[2,md5($loanId)]);
        $userDtl=User::getUserDetailsById($userId);

        $emisDetailsArr=[];
        $monthlyEMI=0;
        $totalInterest=0;
        $approvedTenureStr='';
        $monthlyEmiLabel='';
        $TenureDetails=Tenure::where('id',$approveTenure)->first();
        if(!empty($TenureDetails)) {
            $numOfEmis = $TenureDetails->numOfEmis;
            $payment_date=date('Y-m-12');
            $approvedTenureStr=$TenureDetails->name;

            $objComm=new CommonController();
            
            if($loanDetails->loanCategory==8)
            {
                $interestStartDate=date('Y-m-d');
                if($roiType=='quaterly_interest')
                {
                    $monthlyEmiLabel='Quarterly EMI';
                    $emisDetailsArr=$objComm->getQuarterlyDaysWiseEmis($numOfEmis,$approvedROI,$approvedAmount,$payment_date,$interestStartDate,$tds);
                }else if($roiType=='fixed_interest_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getFixedInterestDaysWiseEmis($numOfEmis,$approvedROI,$approvedAmount,$payment_date,$interestStartDate,$tds);
                }
            }else{
                if($loanDetails->loanCategory== 2){
                    $tds = null;
                }
                if($roiType=='reducing_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getEmisPMT($numOfEmis,$approvedROI,$approvedAmount,$payment_date,$tds,$isPaidInterest);
                }else if($roiType=='quaterly_interest')
                {
                    $monthlyEmiLabel='Quarterly EMI';
                    $emisDetailsArr=$objComm->getQuarterlyEmis($numOfEmis,$approvedROI,$approvedAmount,$payment_date,$tds);
                }else if($roiType=='fixed_interest_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getFixedInterestEmis($numOfEmis,$approvedROI,$approvedAmount,$payment_date,$tds,$isPaidInterest);
                }
            }
            

            if(!empty($emisDetailsArr))
            {
                $monthlyEMI=$emisDetailsArr['emiAmount'];
                $totalInterest=$emisDetailsArr['totalInterest'];
            }
            
        }

        $paidInterest = 0;
        if($isPaidInterest){
            $paidInterest=$totalInterest;
        }
        $emisDetailsStr=(!empty($emisDetailsArr)) ? json_encode($emisDetailsArr) : '';

        ApplyLoanHistory::where('id',$loanId)->update(['monthlyEMI'=>$monthlyEMI,'paidInterest'=>$paidInterest,'totalInterest'=>$totalInterest,'emisDetailsStr'=>$emisDetailsStr]);


        
        if($loanDetails)
        {
           
                $productNameStr='';

            if($loanDetails->categoryName && $loanDetails->productName){
                $productNameStr=$loanDetails->categoryName.' / '.$loanDetails->productName;
            }else if($loanDetails->productName){
                $productNameStr=$loanDetails->productName;
            }else if($loanDetails->categoryName){
                $productNameStr=$loanDetails->categoryName;
            }

            $verifyWith = env('APP_NAME');
            $includePF = ($loanDetails->exclude_pfif && $loanDetails->exclude_pfif == 1) ? 'Yes' : 'No';

            $htmlSt = '<div>
                        <p>Dear ' . $userDtl->name . ',</p>
                        <p>Please check your loan details as per your application are as follow:</p>
                        <div>
                            <table style="width: 100%;">';
            $htmlSt .= '<tr>
                            <th style="width: 50%;padding: 6px !important;">Product Name</th>
                            <th style="width: 50%;padding: 6px !important;">'.$productNameStr.'</th>
                       </tr>';
            $htmlSt .='<tr>
                        <th style="width: 50%;padding: 6px !important;">Approved Amount</th>
                        <th style="width: 50%;padding: 6px !important;">'. number_format($loanDetails->approvedAmount,2).'</th>
                   </tr>';
            if($loanDetails->approvedTenureD) {
                $htmlSt .= '<tr>
                            <th style="width: 50%;padding: 6px !important;">Approved Tenure </th>
                            <th style="width: 50%;padding: 6px !important;">' .$loanDetails->approvedTenureD. ' </th>
                       </tr>';
            }
            $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Approved ROI </th>
                            <th style="width: 50%;padding: 6px !important;">'.$approvedROI.' %</th>
                       </tr>';
            $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">TDS % </th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->tds.' %</th>
                       </tr>';

            if($totalInterest) {
                $htmlSt .= '<tr>
                            <th style="width: 50%;padding: 6px !important;">Total Interest </th>
                            <th style="width: 50%;padding: 6px !important;">' . number_format($totalInterest, 2) . ' </th>
                       </tr>';
            }
            // if($monthlyEMI && $monthlyEmiLabel) {
            //     $htmlSt .= '<tr>
            //                 <th style="width: 50%;padding: 6px !important;">'.$monthlyEmiLabel.' </th>
            //                 <th style="width: 50%;padding: 6px !important;">' . number_format($monthlyEMI, 2) . ' </th>
            //            </tr>';
            // }

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
           
           if($netDisbursementAmount)
                {
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Net Disbursement Amount </th>
                            <th style="width: 50%;padding: 6px !important;">'. number_format($netDisbursementAmount,2).'</th>
                       </tr>';
                }

            $userBank=UserBankDetail::where(['userId'=>$userId])->first();
            if(!empty($userBank))
            {
                $htmlSt .='<tr>
                        <th style="width: 100%;padding: 6px !important;" colspan="2"><b>Bank Details</b></th>
                   </tr>';

                if($userBank->accountHolderName){
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Account Holder Name</th>
                            <th style="width: 50%;padding: 6px !important;">'.$userBank->accountHolderName.'</th>
                       </tr>';
                }

                if($userBank->bankName){
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Bank Name</th>
                            <th style="width: 50%;padding: 6px !important;">'.$userBank->bankName.'</th>
                       </tr>';
                }

                if($userBank->ifscCode){
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">IFSC Code</th>
                            <th style="width: 50%;padding: 6px !important;">'.$userBank->ifscCode.'</th>
                       </tr>';
                }

                if($userBank->accountType){
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Account Type</th>
                            <th style="width: 50%;padding: 6px !important;">'.$userBank->accountType.'</th>
                       </tr>';
                }

                if($userBank->accountNumber){
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Account Number</th>
                            <th style="width: 50%;padding: 6px !important;">'.$userBank->accountNumber.'</th>
                       </tr>';
                }

                if($userBank->state){
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">State</th>
                            <th style="width: 50%;padding: 6px !important;">'.$userBank->state.'</th>
                       </tr>';
                }

                if($userBank->city){
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">City</th>
                            <th style="width: 50%;padding: 6px !important;">'.$userBank->city.'</th>
                       </tr>';
                }

                if($userBank->address){
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Address</th>
                            <th style="width: 50%;padding: 6px !important;">'.$userBank->address.'</th>
                       </tr>';
                }

                if($userBank->pincode){
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Pincode</th>
                            <th style="width: 50%;padding: 6px !important;">'.$userBank->pincode.'</th>
                       </tr>';
                }

            }


            //$textStr =$verifyWith.'  has been approved above mentioned loan amount & rate of interest (ROI), Please accept this letter to get this loan.';
                $textStr ='As per your Kyc and employment, maxemo allows you to get the loan amount as mentioned above, if everything is ok please click on accept to approve the loan or reject in case of anything else. please contact assigned credit personnel in case&nbsp;ofany&nbsp;query.';
                $htmlSt .='<tr>
                            <th colspan="2" style="width: 50%;padding: 6px !important;">
                            <strong>
                               '.$textStr.' 
                            </strong>
                            </th>
                       </tr>';
            $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">
                                <p>
                                    <center><a href="'.$acceptURL.'" target="_blank" style="color: green !important;font-size: 22px;font-weight: bold;">Click Here To Accept</a></center>
                                </p>
                            </th>
                            <th style="width: 50%;padding: 6px !important;">
                                 <p style="margin-top:20px !important;">
                                    <center><a href="'.$rejectURL.'" target="_blank" style="color: red !important;;font-size: 22px;font-weight: bold;">Click Here To Reject</a></center>
                                </p>
                            </th>
                       </tr>';

            $htmlSt .='</table>
                        </div>
                     </div>';


            $toMail=$userDtl->email;
            $toUser=$userDtl->name;
            $subject='Need Approval For Loan '.$verifyWith;

            AppServiceProvider::sendMail($toMail,$toUser,$subject,$htmlSt);

            echo json_encode(['status'=>'success','message'=>'Your request has been processed successfully.','data'=>$htmlSt]); exit;

        }else{
            echo json_encode(['status'=>'error','message'=>'Invalid Request, Please try again.']); exit;
        }
    }


    public function sendForCustomerConsent(Request $request)
    {

        $isValidated=AppServiceProvider::validatePermission('send-for-customer-assessment');

        $loanId=$request->initiateApplyLoanUserId;
        $loanDtl=ApplyLoanHistory::where('id',$loanId)->first();
        if(empty($loanDtl)){
            echo json_encode(['status'=>'error','message'=>'Invalid Request, Please try again.']); exit;
        }

        $userId=$loanDtl->userId;
        $productName=$request->productName;
        $loanCategory=$request->loanCategory;
        $approveTenure=($request->approveTenure) ? $request->approveTenure : 0;
        $approvedAmount=$request->approvedAmount;
        $approvedRoi=$request->approvedRoi;
        $plateformFee=$request->plateformFee;
        $insurance=$request->insurance;
        $roiType=$request->roiType;
        $tds = isset($request->tds) ? $request->tds  : 0;
        $isPaidInterest = $request->paidFullInterest ?? 0;

        $validFromDate=(strtotime($request->validFromDate)) ? date('Y-m-d',strtotime($request->validFromDate)) : '';
        $validToDate=(strtotime($request->validToDate)) ? date('Y-m-d',strtotime($request->validToDate)) : '';

        $validFromDateD=(strtotime($request->validFromDate)) ? date('d M, Y',strtotime($request->validFromDate)) : '';
        $validToDateD=(strtotime($request->validToDate)) ? date('d M, Y',strtotime($request->validToDate)) : '';

        $employmentDetails=EmploymentHistory::where(['userId'=>$userId])->first();
        if(!empty($employmentDetails) && $loanCategory==1){
            $companyGstin=trim(strtolower($employmentDetails->companyGstin));
            $companyGstinNew=str_replace(['na','n/a',''],"",$companyGstin);
            if(empty($companyGstinNew)){
                echo json_encode(['status'=>'error','message'=>'GST number is mandatory for business loan.']); exit;
            }
        }

        $currentDate=date('Y-m-d H:i:s');

        $userDtl=User::getUserDetailsById($userId);
        if(empty($userDtl)){
            echo json_encode(['status'=>'error','message'=>'Invalid Request, Please try again.']); exit;
        }

        $image='';
        if(!empty($request->invoiceFile)){
            $image=AppServiceProvider::uploadImageCustom('invoiceFile','invoice-loan');
        }else{
            $image=$request->invoiceFileOld;
        }

        $exclude_pfif = 0;
        if($request->excludePlateformFee){
            $exclude_pfif = 1;
        }


        $principleChargesArr['gst']=0;
        $principleChargesArr['premium']=0;
        $principleChargesArr['processingFee']=0;
        $principleChargesArr['insurance']=$insurance;
        $principleChargesArr['verificationCharges']=0;
        $principleChargesArr['collectionFee']=0;
        $principleChargesArr['plateformFee']=$plateformFee;
        $principleChargesArr['convenienceFee']=0;
        $principleChargesArr['principleAmount']=0;
        $principleChargesArr['pfPercentage']=0;

        $principleChargesStr=json_encode($principleChargesArr);
        $principleCharges=$plateformFee+$insurance;
        //$netDisbursementAmount=$approvedAmount-$principleCharges;
        // $netDisbursementAmount=$approvedAmount;
        
        $saveArr['userId']=$userId;
        $saveArr['productId']=($productName) ? $productName : 0;
        $saveArr['loanCategory']=$loanCategory;
        $saveArr['loanAmount']=$approvedAmount;
        $saveArr['approvedAmount']=$approvedAmount;
        $saveArr['tenure']=$approveTenure;
        $saveArr['approvedTenure']=$approveTenure;
        $saveArr['rateOfInterest']=$approvedRoi;
        $saveArr['invoiceFile']=$image;
        $saveArr['principleChargesDetails']=$principleChargesStr;
        $saveArr['principleCharges']=$principleCharges;
        if($exclude_pfif == 1){
            $netDisbursementAmount= $approvedAmount - $principleCharges;
        }else{
            $netDisbursementAmount=  $approvedAmount;
        }
        $saveArr['netDisbursementAmount']= ($loanCategory!=3) ? $saveArr['loanAmount'] : 0;
        $saveArr['disbursementAmount'] = ($loanCategory!=3) ? $netDisbursementAmount : 0;
        $saveArr['roiType']=$roiType;
        $saveArr['exclude_pfif'] = $exclude_pfif;
        $saveArr['tds'] = $tds;
        

        if($validFromDate && $validToDate){
            $saveArr['validFromDate']=$validFromDate;
            $saveArr['validToDate']=$validToDate;
        }

        $saveArr['status']='sent-for-customer-approval';
        $saveArr['updated_at']=$currentDate;

        ApplyLoanHistory::where('id',$loanId)->update($saveArr);

        $verifyWith=env('APP_NAME');
        $acceptURL=route('acceptLoanByCustomer',[1,md5($loanId)]);
        $rejectURL=route('acceptLoanByCustomer',[2,md5($loanId)]);

        $loanDetails=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.userId='$userId' AND alh.id='$loanId' ORDER BY alh.id DESC");
        $productNameStr='';
        if(count($loanDetails))
        {
            $loanDetails=$loanDetails[0];

            if($loanDetails->categoryName && $loanDetails->productName){
                $productNameStr=$loanDetails->categoryName.' / '.$loanDetails->productName;
            }else if($loanDetails->productName){
                $productNameStr=$loanDetails->productName;
            }else if($loanDetails->categoryName){
                $productNameStr=$loanDetails->categoryName;
            }
        }

        $netDisbursementAmount=$loanDetails->disbursementAmount;
        
        if($loanId && $loanCategory!=3)
        {
            $this->sendLoanForCustomerApprovalExceptRawMaterial($userId,$approvedRoi,$approvedAmount,$loanId,$approveTenure,$plateformFee,$insurance,$netDisbursementAmount,$roiType,$tds,$isPaidInterest);
        }
        else{
            if($loanId){

                $htmlSt = '<div>
                        <p>Dear ' . $userDtl->name . ',</p>
                        <p>Please check your loan details as follows:-</p>
                        <div>
                            <table style="width: 100%;">';
                /*$htmlSt .='<tr>
                        <th style="width: 50%;padding: 6px !important;">Product Name</th>
                        <th style="width: 50%;padding: 6px !important;">'.$productNameStr.'</th>
                   </tr>';*/
                $htmlSt .='<tr>
                        <th style="width: 50%;padding: 6px !important;">Appiled Amount</th>
                        <th style="width: 50%;padding: 6px !important;">'. number_format($loanDetails->loanAmount,2).'</th>
                   </tr>';
                /*$htmlSt .='<tr>
                        <th style="width: 50%;padding: 6px !important;">Appiled Tenure</th>
                        <th style="width: 50%;padding: 6px !important;">'.$loanDetails->appliedTenureD.'</th>
                   </tr>';*/
                $htmlSt .='<tr>
                        <th style="width: 50%;padding: 6px !important;">Approved Amount</th>
                        <th style="width: 50%;padding: 6px !important;">'. number_format($loanDetails->approvedAmount,2).'</th>
                   </tr>';
                /*$htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Approved Tenure</th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->approvedTenureD.'</th>
                       </tr>';*/
                $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">ROI % </th>
                            <th style="width: 50%;padding: 6px !important;">'.$loanDetails->rateOfInterest.'%</th>
                       </tr>';
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
                
                /*if($netDisbursementAmount)
                {
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Net Disbursement Amount </th>
                            <th style="width: 50%;padding: 6px !important;">'.$netDisbursementAmount.'</th>
                       </tr>';
                }*/
                if($loanCategory==3)
                {
                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Valid From </th>
                            <th style="width: 50%;padding: 6px !important;">'.$validFromDateD.'</th>
                       </tr>';

                    $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">Valid To </th>
                            <th style="width: 50%;padding: 6px !important;">'.$validToDateD.'</th>
                       </tr>';
                }


                //$textStr =$verifyWith.'  has been approved above mentioned loan amount & rate of interest (ROI), Please accept this letter to get this loan.';
                $textStr ='As per your Kyc and employment, maxemo allows you to get the loan amount as mentioned above, if everything is ok please click on accept to approve the loan or reject in case of anything else. please contact assigned credit personnel in case&nbsp;of&nbsp;anyquery.';
                $htmlSt .='<tr>
                            <th colspan="2" style="width: 50%;padding: 6px !important;">
                            <strong>
                               '.$textStr.' 
                            </strong>
                            </th>
                       </tr>';
                $htmlSt .='<tr>
                            <th style="width: 50%;padding: 6px !important;">
                                <p>
                                    <center><a href="'.$acceptURL.'" target="_blank" style="color: green;font-size: 22px;font-weight: bold;">Click Here To Accept</a></center>
                                </p>
                            </th>
                            <th style="width: 50%;padding: 6px !important;">
                                 <p style="margin-top:20px !important;">
                                    <center><a href="'.$rejectURL.'" target="_blank" style="color: red;font-size: 22px;font-weight: bold;">Click Here To Reject</a></center>
                                </p>
                            </th>
                       </tr>';

                $htmlSt .='</table>
                        </div>
                     </div>';

                    
                        $toMail=$userDtl->email;
                        $toUser=$userDtl->name;
                        $subject='Need Approval For Loan '.$verifyWith;
                        if (config('app.env') == "production") {
                            if($toMail){
                                AppServiceProvider::sendMail($toMail,$toUser,$subject,$htmlSt);
                            }
                        }else if(config('app.env') == "testing"){
                            AppServiceProvider::sendMail("anjali.negi@maxemocapital.com",$toUser,$subject,$htmlSt);
                         }else{
                            AppServiceProvider::sendMail("basant@techmavesoftware.com",$toUser,$subject,$htmlSt);
                        }

                echo json_encode(['status'=>'success','message'=>'Loan has been sent for customer consent.']); exit;
            }else{
                echo json_encode(['status'=>'error','message'=>'Something went wrong, Please try again.']); exit;
            }
        }
    }

    public function initiateApplyLoanEditForCustomerConsent(Request $request)
    {
        $loanId=$request->loanId;
        $pageNameStr=$request->pageNameStr;
        $categories=Category::where(['status'=>1])->get();

        $loanDetailsArr=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.id='$loanId' ORDER BY alh.id DESC");
        if(count($loanDetailsArr)){
            $loanDetails=$loanDetailsArr[0];
        }else{
            echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
        }

        $loanCategory=$loanDetails->loanCategory;

        $tenures=Tenure::where(['loanCategory'=>$loanCategory,'status'=>1])->orderBy('sortOrder','ASC')->get();

        $loanStyleInvoiceTxt='Invoice';
        $loanStyleInvoice='style="display:none;"';
        $loanStyleValidFrom='style="display:none;"';
        $loanStyleValidTo='style="display:none;"';
        $roiTypeStyle='';
        $loanStyleTenure='';
        if($loanCategory==3){
            $loanStyleValidFrom='';
            $loanStyleValidTo='';
            $loanStyleInvoiceTxt='Bill';
            $roiTypeStyle='style="display:none;"';
        }

        $productNameStyle='';
        if($loanCategory==3 || $loanCategory==4 || $loanCategory==8){
            if($loanCategory!=8){
                $loanStyleInvoice='';
            }
            
            $productNameStyle='style="display:none;"';
        }
        
        $netDisbursementStyle='';
        if($loanCategory==3){
            $netDisbursementStyle='style="display:none;"';
        }

        $validFromDate=(strtotime($loanDetails->validFromDate)) ? date('Y-m-d',strtotime($loanDetails->validFromDate)) : '';
        $validToDate=(strtotime($loanDetails->validToDate)) ? date('Y-m-d',strtotime($loanDetails->validToDate)) : '';

        $plateformFee=0;
        $insurance=0;
        $principleChargesDetailsArr=[];
        if($loanDetails->principleChargesDetails)
        {
            $principleChargesDetailsArr=json_decode($loanDetails->principleChargesDetails,true);
            $plateformFee=(isset($principleChargesDetailsArr['plateformFee'])) ? $principleChargesDetailsArr['plateformFee'] : 0;
            $insurance=(isset($principleChargesDetailsArr['insurance'])) ? $principleChargesDetailsArr['insurance'] : 0;
        }

        $netDisbursementAmount=$loanDetails->disbursementAmount;
        
        $catId=$loanCategory;
        $productStr='<option value="">Select</option>';
        $products=Product::where(['categoryId'=>$catId,'status'=>1])->orderBy('productName','ASC')->get();
        if(count($products)){
            foreach ($products as $prow) {
                $pselected='';
                if($prow->id==$loanDetails->productId){
                    $pselected='selected';
                }
                $productStr .='<option value="'.$prow->id.'" '.$pselected.'>'.$prow->productName.'</option>';
            }
        }
        $htmlStr='';

        $reducing_roiSel = ($loanDetails->roiType=='reducing_roi') ? 'selected' : '';
        $fixed_interest_roiSel = ($loanDetails->roiType=='fixed_interest_roi') ? 'selected' : '';
        $quaterly_interestSel = ($loanDetails->roiType=='quaterly_interest') ? 'selected' : '';
        $bullet_repaymentSel = ($loanDetails->roiType=='bullet_repayment') ? 'selected' : '';
        
        $reducing_roiSelDis = ($loanCategory==8) ? 'style="display:none;"' : '';
        $fixed_interest_roiSelDis = ($loanCategory==8) ? '' : '';
        $quaterly_interestSelDis = ($loanCategory==8) ? '' : '';
        $bullet_repaymentSelDis = ($loanCategory==8) ? 'style="display:none;"' : '';

        if($pageNameStr) {
            $htmlStr .= '<div class="row">';
            $htmlStr .= '<div class="col-lg-6 mt-3">
                        <label class="block">
                            <span>Category</span>
                            <select id="loanCategory" name="loanCategory" onchange="checkProductTypeCategory();" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">';
            $htmlStr .= '<option value="">Select</option>';
            if (count($categories)) {
                foreach ($categories as $crow) {
                    $selected='';
                    if($loanCategory==$crow->id){
                        $selected='selected';
                    }
                    $htmlStr .= '<option value="' . $crow->id . '" '.$selected.'>' . $crow->name . '</option>';
                }
            }
            $htmlStr .= '</select>
            </label>
        </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3 productNameHtml" '.$productNameStyle.'>
                        <label class="block">
                            <span>Product Name</span>
                            <select id="productName" name="productName" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">';
            $htmlStr .= $productStr;
            $htmlStr .= '</select>
            </label>
        </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3" id="invoiceFileHtml" '.$loanStyleInvoice.'>
                    <label class="block">
                        <span id="invoiceFileLabel">Upload '.$loanStyleInvoiceTxt.' <a style="font-size:10px;color:blue;" href="'.asset('public').'/'.$loanDetails->invoiceFile.'" target="_blank">Click Here To View</a></span>
                        <input type="hidden" name="invoiceFileOld" id="invoiceFileOld" value="'.$loanDetails->invoiceFile.'">
                        <input id="invoiceFile" name="invoiceFile" class="form-control" placeholder="" type="file">
                    </label>
                </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3 roiTypeHtml" '.$roiTypeStyle.'>
                    <label class="block">
                        <span>ROI Type</span>
                        <select id="roiType" name="roiType" onchange="roiTypeUpdate(this)" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">';
                        $htmlStr .= '<option value="">Select</option>';
                        $htmlStr .= '<option value="reducing_roi" '.$reducing_roiSel.' '.$reducing_roiSelDis.' class="all_loan_type" >Reducing ROI</option>';
                        $htmlStr .= '<option value="fixed_interest_roi"'.$fixed_interest_roiSel.' '.$fixed_interest_roiSelDis.' class="all_loan_type new_loan_type" >Fixed Interest ROI</option>';
                        $htmlStr .= '<option value="quaterly_interest"'.$quaterly_interestSel.' '.$quaterly_interestSelDis.' class="all_loan_type new_loan_type" >Quarterly Interest</option>';
                        $htmlStr .= '<option value="bullet_repayment"'.$bullet_repaymentSel.' '.$bullet_repaymentSelDis.' class="all_loan_type" >Bullet Repayment</option>';
                                                    
                    $htmlStr .= '</select>';

                    if((int)$loanDetails->paidInterest != 0){
                        $htmlStr .= '<div class="paidFullInterest form-check">
                            <input class="form-check-input" checked name="paidFullInterest" type="checkbox" value="1" id="paidFullInterest">
                            <label class="form-check-label" for="paidFullInterest">
                                Already Paid Full Interest
                            </label>
                        </div>';
                    }


                    $htmlStr .= '</label>
                </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3 approveTenureHtml" '.$loanStyleTenure.'>
                        <label class="block">
                            <span>Tenure</span>
                            <select id="approveTenure" name="approveTenure" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">';
            $htmlStr .= '<option value="">Select</option>';
            if (count($tenures)) {
                foreach ($tenures as $trow) {
                    $selTenure='';
                    if($trow->id==$loanDetails->approvedTenure){
                        $selTenure='selected';
                    }
                    $htmlStr .= '<option value="' . $trow->id . '" '.$selTenure.'>' . $trow->name . '</option>';
                }
            }
            $htmlStr .= '</select>
            </label>
        </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3">
                    <label class="block">
                        <span>Loan Amount</span>
                        <input id="approvedAmount" oninput="calcNetDisburseAmount();" value="'.$loanDetails->approvedAmount.'" onkeypress="javascript:return isNumber(event)" name="approvedAmount" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="number">
                    </label>
                </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3">
                    <label class="block">
                        <span>ROI %</span>
                        <input id="approvedRoi" value="'.$loanDetails->rateOfInterest.'" name="approvedRoi" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" step="any" type="number">
                    </label>
                </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3 validFromDateHtml" '.$loanStyleValidFrom.'>
                    <label class="block">
                        <span>Valid From</span>
                        <input id="validFromDate"value="'.$validFromDate.'"  name="validFromDate" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="date">
                    </label>
                </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3 validToDateHtml" '.$loanStyleValidTo.'>
                    <label class="block">
                        <span>Valid To</span>
                        <input id="validToDate"value="'.$validToDate.'"  name="validToDate" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="date">
                    </label>
                </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3">
                    <label class="block">
                        <span>Plateform Fee</span>
                        <input id="plateformFee" oninput="calcNetDisburseAmount();" value="'.$plateformFee.'" onkeypress="javascript:return isNumber(event)" name="plateformFee" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="number">
                    </label>
                </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3">
                    <label class="block">
                        <span>Insurance Fee</span>
                        <input id="insurance" oninput="calcNetDisburseAmount();" value="'.$insurance.'" onkeypress="javascript:return isNumber(event)" name="insurance" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="number">
                    </label>
                </div>';
                
                $htmlStr .= '<div class="col-lg-6 mt-3 netDisbursementHtml" '.$netDisbursementStyle.'>
                    <label class="block">
                        <span>Net Disbursement Amount</span>
                        <input id="netDisbursementAmount" value="'.$netDisbursementAmount.'" readonly onkeypress="javascript:return isNumber(event)" name="netDisbursementAmount" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="number">
                    </label>
                </div>';

                if(($loanCategory==8 || $loanCategory==1) && $loanDetails->roiType!='bullet_repayment'){
                    $htmlStr .= '<div class="col-lg-6 mt-3 " >
                    <label class="block">
                        <span>TDS %</span>
                        <select name="tds" id="tds" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                            <option selected value="0">0 %</option>
                            <option value="10">10 %</option>
                        </select>
                    </label>
                </div>';
                    }

                 $htmlStr .= '<div class="col-lg-12 mt-3">
                <div class="form-check">
                    <input class="form-check-input" onChange="excludePlateformFeeAmount()" name="excludePlateformFee" type="checkbox" value="1" id="excludePlateformFee">
                    <label class="form-check-label" for="excludePlateformFee">
                        Include Plateform Fee From Loan Amount
                    </label>
                </div>
            </div>';
                
            $htmlStr .= '</div>';
            if ($loanDetails->isAdminApproved == 'pending' || $loanDetails->isAdminApproved == 'need update') { 
                $htmlStr .= '<div class="row mt-4">
                <div class="col-md-6"></div>
                <div class="col-lg-6">
                    <button type="submit" id="initiateApplyLoanBtnFnBtn" class="btn text-white bg-success">Send For Super Admin Consent</button>
                </div>';
                
            }else if($loanDetails->status == 'sent-for-admin-approval'){
            $htmlStr .= '<div class="row mt-4">
                <div class="col-md-6"></div>
                <div class="col-lg-6">
                    <button type="submit" id="initiateApplyLoanBtnFnBtn" class="btn text-white bg-success">Send For Customer Consent</button>
                </div>';
            }
                $htmlStr .= '</div>';
        }

        if($htmlStr){
            echo json_encode(['status'=>'success','message'=>'Loan Details.','data'=>$htmlStr]); exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
        }
    }

    public function initiateApplyLoanEditForAdminConsentRaw(Request $request){
        $loanId=$request->loanId;
        $applyLoan=ApplyLoanHistory::where('id',$loanId)->first();
        $lastloanRequest = DB::table('raw_materials_loan_requests')->where(['loanId'=>$loanId,'status'=>'disburse-scheduled'])->first();
        $loanCategory = Category::where('id',$applyLoan->loanCategory)->first()->name;
        $userDtl = User::whereId($applyLoan->userId)->first();
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
        <p>Disbursement Request Loan Amount: '.$lastloanRequest->loanAmount.'</p><br/>
        <p>Requested Disbursed Date: '.$lastloanRequest->disburse_date.'</p><br/>
        <center><a href="' . $acceptURL . '" target="_blank" style="color: blue;font-size: 22px;font-weight: bold;">Click Here To View Loan</a></center>
        </div>';
        $verifyWith = env('APP_NAME');
        if (config('app.env') == "production") {
            AppServiceProvider::sendMail("shorya.mittal@maxemocapital.com", "Shorya Mittal", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
            AppServiceProvider::sendMail("vipul.mittal@maxemocapital.com", "Vipul Mittal", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
              
            AppServiceProvider::sendMail("ashish.kumar@maxemocapital.com", "Ashish Kumar", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
            AppServiceProvider::sendMail("raju@techmavesoftware.com", "Basant", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
        } else if(config('app.env') == "testing"){
            AppServiceProvider::sendMail("anjali.negi@maxemocapital.com","Anjali", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
         }else {
            AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
            // AppServiceProvider::sendMail("raju@techmavesoftware.com", "Basant", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
        }
        echo json_encode(['status'=>'success','message'=>'Loan has been sent for admin approval.']); exit;
    }

    public function initiateApplyLoanEditForAdminConsent(Request $request)
    {

        $loanId=$request->initiateApplyLoanUserId;
        $loanDtl=ApplyLoanHistory::where('id',$loanId)->first();
        if(empty($loanDtl)){
            echo json_encode(['status'=>'error','message'=>'Invalid Request, Please try again.']); exit;
        }

        $userId=$loanDtl->userId;
        $productName=$request->productName;
        $loanCategory=$request->loanCategory;
        $approveTenure=($request->approveTenure) ? $request->approveTenure : 0;
        $approvedAmount=$request->approvedAmount;
        $approvedRoi=$request->approvedRoi;
        $plateformFee=$request->plateformFee;
        $insurance=$request->insurance;
        $roiType=$request->roiType;
        $isPaidInterest = $request->paidFullInterest ?? 0;
        $tds = isset($request->tds) ? $request->tds  : 0;

        $validFromDate=(strtotime($request->validFromDate)) ? date('Y-m-d',strtotime($request->validFromDate)) : '';
        $validToDate=(strtotime($request->validToDate)) ? date('Y-m-d',strtotime($request->validToDate)) : '';

        $validFromDateD=(strtotime($request->validFromDate)) ? date('d M, Y',strtotime($request->validFromDate)) : '';
        $validToDateD=(strtotime($request->validToDate)) ? date('d M, Y',strtotime($request->validToDate)) : '';

        $employmentDetails=EmploymentHistory::where(['userId'=>$userId])->first();
        if(!empty($employmentDetails) && $loanCategory==1){
            $companyGstin=trim(strtolower($employmentDetails->companyGstin));
            $companyGstinNew=str_replace(['na','n/a',''],"",$companyGstin);
            if(empty($companyGstinNew)){
                echo json_encode(['status'=>'error','message'=>'GST number is mandatory for business loan.']); exit;
            }
        }

        $currentDate=date('Y-m-d H:i:s');

        $userDtl=User::getUserDetailsById($userId);
        if(empty($userDtl)){
            echo json_encode(['status'=>'error','message'=>'Invalid Request, Please try again.']); exit;
        }

        $image='';
        if(!empty($request->invoiceFile)){
            $image=AppServiceProvider::uploadImageCustom('invoiceFile','invoice-loan');
        }else{
            $image=$request->invoiceFileOld;
        }

        $exclude_pfif = 0;
        if($request->excludePlateformFee){
            $exclude_pfif = 1;
        }


        $principleChargesArr['gst']=0;
        $principleChargesArr['premium']=0;
        $principleChargesArr['processingFee']=0;
        $principleChargesArr['insurance']=$insurance;
        $principleChargesArr['verificationCharges']=0;
        $principleChargesArr['collectionFee']=0;
        $principleChargesArr['plateformFee']=$plateformFee;
        $principleChargesArr['convenienceFee']=0;
        $principleChargesArr['principleAmount']=0;
        $principleChargesArr['pfPercentage']=0;

        $principleChargesStr=json_encode($principleChargesArr);
        $principleCharges=$plateformFee+$insurance;
        //$netDisbursementAmount=$approvedAmount-$principleCharges;
        // $netDisbursementAmount=$approvedAmount;
        
        $saveArr['userId']=$userId;
        $saveArr['productId']=($productName) ? $productName : 0;
        $saveArr['loanCategory']=$loanCategory;
        $saveArr['loanAmount']=$approvedAmount;
        $saveArr['approvedAmount']=$approvedAmount;
        $saveArr['tenure']=$approveTenure;
        $saveArr['approvedTenure']=$approveTenure;
        $saveArr['rateOfInterest']=$approvedRoi;
        
        $saveArr['invoiceFile']=$image;
        $saveArr['principleChargesDetails']=$principleChargesStr;
        $saveArr['principleCharges']=$principleCharges;
        if($exclude_pfif == 1){
            $netDisbursementAmount= $approvedAmount - $principleCharges;
        }else{
            $netDisbursementAmount=  $approvedAmount;
        }
        $saveArr['netDisbursementAmount']= ($loanCategory!=3) ? $saveArr['loanAmount'] : 0;
        $saveArr['disbursementAmount'] = ($loanCategory!=3) ? $netDisbursementAmount : 0;
        $saveArr['roiType']=$roiType;
        $saveArr['exclude_pfif'] = $exclude_pfif;
        $saveArr['tds'] = $tds;
        

        if($validFromDate && $validToDate){
            $saveArr['validFromDate']=$validFromDate;
            $saveArr['validToDate']=$validToDate;
        }
        $saveArr['updated_at']=$currentDate;

        ApplyLoanHistory::where('id',$loanId)->update($saveArr);

        $verifyWith=env('APP_NAME');
        $acceptURL=route('acceptLoanByCustomer',[1,md5($loanId)]);
        $rejectURL=route('acceptLoanByCustomer',[2,md5($loanId)]);

        $loanDetails=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.userId='$userId' AND alh.id='$loanId' ORDER BY alh.id DESC");
        $productNameStr='';
        if(count($loanDetails))
        {
            $loanDetails=$loanDetails[0];

            if($loanDetails->categoryName && $loanDetails->productName){
                $productNameStr=$loanDetails->categoryName.' / '.$loanDetails->productName;
            }else if($loanDetails->productName){
                $productNameStr=$loanDetails->productName;
            }else if($loanDetails->categoryName){
                $productNameStr=$loanDetails->categoryName;
            }
        }

        $netDisbursementAmount=$loanDetails->disbursementAmount;
        
        if($loanId && $loanCategory!=3)
        {
            $loanDetails=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.userId='$userId' AND alh.id='$loanId' ORDER BY alh.id DESC");
        if(!count($loanDetails)){
            echo json_encode(['status'=>'error','message'=>'Something went wrong, Please try again.']); exit;
        }
        $loanDetails=$loanDetails[0];
        
        $acceptURL=route('acceptLoanByCustomer',[1,md5($loanId)]);
        $rejectURL=route('acceptLoanByCustomer',[2,md5($loanId)]);
        $userDtl=User::getUserDetailsById($userId);

        $emisDetailsArr=[];
        $monthlyEMI=0;
        $totalInterest=0;
        $approvedTenureStr='';
        $monthlyEmiLabel='';
        $TenureDetails=Tenure::where('id',$approveTenure)->first();
        if(!empty($TenureDetails)) {
            $numOfEmis = $TenureDetails->numOfEmis;
            $payment_date=date('Y-m-12');
            $approvedTenureStr=$TenureDetails->name;

            $objComm=new CommonController();
            
            if($loanDetails->loanCategory==8)
            {
                $interestStartDate=date('Y-m-d');
                if($roiType=='quaterly_interest')
                {
                    $monthlyEmiLabel='Quarterly EMI';
                    $emisDetailsArr=$objComm->getQuarterlyDaysWiseEmis($numOfEmis,$approvedRoi,$approvedAmount,$payment_date,$interestStartDate,$tds);
                }else if($roiType=='fixed_interest_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getFixedInterestDaysWiseEmis($numOfEmis,$approvedRoi,$approvedAmount,$payment_date,$interestStartDate,$tds);
                }
            }else{
                if($loanDetails->loanCategory== 2){
                    $tds = null;
                }
                if($roiType=='reducing_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getEmisPMT($numOfEmis,$approvedRoi,$approvedAmount,$payment_date,$tds,$isPaidInterest);
                }else if($roiType=='quaterly_interest')
                {
                    $monthlyEmiLabel='Quarterly EMI';
                    $emisDetailsArr=$objComm->getQuarterlyEmis($numOfEmis,$approvedRoi,$approvedAmount,$payment_date,$tds);
                }else if($roiType=='fixed_interest_roi')
                {
                    $monthlyEmiLabel='Monthly EMI';
                    $emisDetailsArr=$objComm->getFixedInterestEmis($numOfEmis,$approvedRoi,$approvedAmount,$payment_date,$tds,$isPaidInterest);
                }
            }
            

            if(!empty($emisDetailsArr))
            {
                $monthlyEMI=$emisDetailsArr['emiAmount'];
                $totalInterest=$emisDetailsArr['totalInterest'];
            }
            
        }
        $paidInterest=0;
        if($isPaidInterest){
            $paidInterest=$totalInterest;
        }

        $emisDetailsStr=(!empty($emisDetailsArr)) ? json_encode($emisDetailsArr) : '';

        ApplyLoanHistory::where('id',$loanId)->update(['monthlyEMI'=>$monthlyEMI,'totalInterest'=>$totalInterest,'paidInterest'=>$paidInterest,'emisDetailsStr'=>$emisDetailsStr]);

        }

        
        $applyLoan = ApplyLoanHistory::whereId($loanId)->first();
        $loanCategory = Category::where('id',$applyLoan->loanCategory)->first()->name;
        $userDtl = User::whereId($applyLoan->userId)->first();
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
        <p>Loan Type: '.$loanCategory.'</p><br/>
        <p>Disbursement Request Loan Amount: '.$applyLoan->approvedAmount.'</p><br/>
        <p>ROI: '.$applyLoan->rateOfInterest.'%</p><br/>
        <center><a href="' . $acceptURL . '" target="_blank" style="color: blue;font-size: 22px;font-weight: bold;">Click Here To View Loan</a></center>
        </div>';
        $verifyWith = env('APP_NAME');
        if (config('app.env') == "production") {
            AppServiceProvider::sendMail("shorya.mittal@maxemocapital.com", "Shorya Mittal", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
            // AppServiceProvider::sendMail("vipul.mittal@maxemocapital.com", "Vipul Mittal", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
            AppServiceProvider::sendMail("ashish.kumar@maxemocapital.com", "Ashish Kumar", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
           // AppServiceProvider::sendMail("raju@techmavesoftware.com", "Basant", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
        } else if(config('app.env') == "testing"){
            AppServiceProvider::sendMail("anjali.negi@maxemocapital.com","Anjali", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
         }else {
            AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
            //AppServiceProvider::sendMail("raju@techmavesoftware.com", "Basant", "Loan Request #LF0".$loanId." (".$loanCategory.") | " . $verifyWith, $htmlStAdmin);
        }
        echo json_encode(['status'=>'success','message'=>'Loan has been sent for admin approval.']); exit;
    }


    public function initiateApplyLoan(Request $request)
    {
        $userId=$request->userId;
        $pageNameStr=$request->pageNameStr;
        $categories=Category::where(['status'=>1])->get();
        $tenures=Tenure::where(['status'=>1])->get();
        $loanDetails=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.userId='$userId' ORDER BY alh.id DESC");

        $htmlStr='';

        if($pageNameStr=='kyc-verified-customers') {
            $htmlStr .= '<div class="row">';
            $htmlStr .= '<div class="col-lg-6 mt-3">
                        <label class="block">
                            <span>Category</span>
                            <select id="loanCategory" name="loanCategory" onchange="checkProductTypeCategory();" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">';
            $htmlStr .= '<option value="">Select</option>';
            if (count($categories)) {
                foreach ($categories as $crow) {
                    $htmlStr .= '<option value="' . $crow->id . '">' . $crow->name . '</option>';
                }
            }
            $htmlStr .= '</select>
            </label>
        </div>';

        $htmlStr .= '<div class="col-lg-6 mt-3 productNameHtml" >
                        <label class="block">
                            <span>Product Name</span>
                            <select id="productName" name="productName" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">';
            $htmlStr .= '<option value="">Select</option>';
            $htmlStr .= '</select>
            </label>
        </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3" id="invoiceFileHtml" style="display: none;">
                    <label class="block">
                        <span id="invoiceFileLabel">Upload Invoice</span>
                        <input id="invoiceFile" name="invoiceFile" class="form-control" placeholder="" type="file">
                    </label>
                </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3 roiTypeHtml">
                        <label class="block">
                            <span>ROI Type</span>
                            <select id="roiType" onchange="validateIfTenureApplicable();" name="roiType" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">';
                            $htmlStr .= '<option value="">Select</option>';
                            $htmlStr .= '<option value="reducing_roi" class="all_loan_type">Reducing ROI</option>';
                            $htmlStr .= '<option value="fixed_interest_roi" class="all_loan_type new_loan_type">Fixed Interest ROI</option>';
                            $htmlStr .= '<option value="quaterly_interest" class="all_loan_type new_loan_type">Quarterly Interest</option>';
                            $htmlStr .= '<option value="bullet_repayment" class="all_loan_type">Bullet Repayment</option>';
                        $htmlStr .= '</select>
                        </label>
                    </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3 roiTenureHtml">
                        <label class="block">
                            <span>Tenure</span>
                            <select id="approveTenure" name="approveTenure" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">';
                            $htmlStr .= '<option value="">Select</option>';
                            // if (count($tenures)) {
                            //     foreach ($tenures as $trow) {
                            //         $htmlStr .= '<option value="' . $trow->id . '">' . $trow->name . '</option>';
                            //     }
                            // }
                            $htmlStr .= '</select>
                            </label>
                        </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3">
                    <label class="block">
                        <span>Loan Amount</span>
                        <input id="approvedAmount" onkeypress="javascript:return isNumber(event)" name="approvedAmount" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="number">
                    </label>
                </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3">
                    <label class="block">
                        <span>ROI %</span>
                        <input id="approvedRoi" name="approvedRoi" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" step="any" type="number">
                    </label>
                </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3 validFromDateHtml" style="display: none;">
                    <label class="block">
                        <span>Valid From</span>
                        <input id="validFromDate" name="validFromDate" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="date">
                    </label>
                </div>';

            $htmlStr .= '<div class="col-lg-6 mt-3 validToDateHtml" style="display: none;">
                    <label class="block">
                        <span>Valid To</span>
                        <input id="validToDate" name="validToDate" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="date">
                    </label>
                </div>';

                 $htmlStr .= '<div class="col-lg-6 mt-3">
                    <label class="block">
                        <span>Plateform Fee</span>
                        <input id="plateformFee" onkeypress="javascript:return isNumber(event)" name="plateformFee" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="number">
                    </label>
                </div>';

                 $htmlStr .= '<div class="col-lg-6 mt-3">
                    <label class="block">
                        <span>Insurance Fee</span>
                        <input id="insurance" onkeypress="javascript:return isNumber(event)" name="insurance" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="number">
                    </label>
                </div>';
            $htmlStr .= '</div>';

            $htmlStr .= '<div class="row mt-4">
                <div class="col-md-6"><button type="button" onclick="initiateApplyLoanFrmReset();" style="float: right;" id="initiateApplyLoanFrmResetBtn" class="btn text-white bg-danger">Cancel</button></div>
                <div class="col-lg-6">
                    <button type="submit" id="initiateApplyLoanBtnFnBtn" class="btn text-white bg-success">Send For Admin Approval</button>
                </div>
        </div>';
        }


        if($pageNameStr=='disbursement-pending-list' || $pageNameStr=='disbursement-rejected-list')
        {
        $TBLLTHCLS='whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
        $htmlStr .='<div class="row mt-5" style="overflow-x: auto;"><table class="is-hoverable w-full text-left">
            <thead>
              <tr>
                <th class="'.$TBLLTHCLS.'">Sr. No.</th>
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

                $buttons='';
                $loanStatus=strtoupper($lrow->status);
                $htmlStr .='<tr>
                        <td>'.$lsr.'</td>
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
        }
        if($htmlStr){
            echo json_encode(['status'=>'success','message'=>'Loan Details.','data'=>$htmlStr]); exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Unable to process your request, Please try again.']); exit;
        }
    }

    
}