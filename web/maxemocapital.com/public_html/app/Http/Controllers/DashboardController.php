<?php

namespace App\Http\Controllers;

use App\Providers\AppServiceProvider;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\User;
use App\Models\ApplyLoanHistory;
use App\Models\CreditScoreQuestionsCategory;
use App\Models\CreditScoreQuestion;
use App\Models\CreditScoreQuestionAnswer;
use App\Models\CreditScoreUsersAnswer;
use App\Models\UserRole;
use App\Models\Product;
use App\Models\Tenure;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Session;
use DB;

class DashboardController extends Controller
{
    public function __construct(){

    }


    public function index()
    {
        //echo '<pre>'; print_r(auth()->user());exit;
        $currentDate = date('Y-m-d');
        $month = date('m');
        $year = date('Y');

        $totalApprovedAmount=0;

        $totalLoans = ApplyLoanHistory::count();
        $businessLoans = ApplyLoanHistory::where('loanCategory', 1)->count();
        $persionalLoans = ApplyLoanHistory::where('loanCategory', 2)->count();
        $outStandingLoans = ApplyLoanHistory::where('loanCategory',8)->count();
        $totalRawLoans = ApplyLoanHistory::where('loanCategory',3)->count();
        $rawMaterialFinancingLoans = DB::select("SELECT count(u.id) AS total FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN employment_histories eh ON u.id=eh.userId WHERE u.userType='user' AND u.kycStatus='approved' AND eh.status='approved' AND alh.status='customer-approved' AND alh.loanCategory='3' AND alh.id IS NOT NULL ORDER BY u.id desc")[0]->total;
        $receievablesInvoicingLoans = ApplyLoanHistory::where('productId', 4)->count();
        $totalUserRegistered = User::where(['userType' => 'user'])->get()->count();
        $totalApprovedRES = DB::select("SELECT (IFNULL(SUM(alh.netDisbursementAmount),0))+(((select IFNULL(SUM(rmout.amount),0) from raw_materials_txn_details rmout WHERE rmout.txnType='out' AND rmout.status='success') - (select IFNULL(SUM(rmin.amount),0) from raw_materials_txn_details rmin WHERE rmin.txnType='in' AND rmin.status='success'))) as totalApprovedAmount from apply_loan_histories alh WHERE alh.status='disbursed'");
        if (count($totalApprovedRES)){
            $totalApprovedAmount=$totalApprovedRES[0]->totalApprovedAmount;
        }
        $newUserRes=User::where(['kycStatus'=>'pending','userType'=>'user'])->limit(10)->orderBy('id','desc')->get();
        // $newUserCount=User::where(['kycStatus'=>'pending','userType'=>'user'])->count();

        $toBedisbursedLoans=ApplyLoanHistory::where('status','customer-approved')->count();
        $disbursedLoans=ApplyLoanHistory::where('status','disbursed')->count();
        $closedLoans=ApplyLoanHistory::where('status','closed')->count();
        $nocIssued=ApplyLoanHistory::where('status','noc-issued')->count();
        $repeatCustomers=DB::select("SELECT userId FROM apply_loan_histories GROUP BY userId HAVING COUNT(id)>1");

        $repeatCustomers=count($repeatCustomers);

        $dueUsers=DB::select("SELECT u.id FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN  employment_histories eh ON u.id=eh.userId LEFT JOIN products p ON alh.productId=p.id LEFT JOIN categories c ON p.categoryId=c.id LEFT JOIN subcategories sc ON p.subCategoryId=sc.id LEFT JOIN loan_emi_details ed ON alh.id=ed.loanId WHERE u.userType='user'   AND alh.status='disbursed' AND date(ed.emiDueDate)<'$currentDate' AND ed.status='pending' AND MONTH(ed.emiDate)='$month' AND YEAR(ed.emiDate)='$year' GROUP BY u.id ORDER BY u.id desc");
        $dueUsersOfCurrentMonth=count($dueUsers);

        $userCountArr=[];
        $currentYear=date('Y');
        for($month=1; $month<=12; $month++)
        {
            $userMonthRes=DB::select("SELECT * FROM users WHERE userType='user' AND MONTH(created_at)='$month' AND YEAR(created_at)='$currentYear' order  by id desc limit 10");
            $userCountArr[]=count($userMonthRes);
        }

        $appliedProductId='';
        $totalAppliedCount='';
        $appliedProductName='N/A';
        $totalAppliedPercentage='0';

        // $employment_histories_company = DB::table('employment_histories')->leftJoin('users','employment_histories.userId','users.id')->select('employment_histories.*','users.customerCode','users.name','users.mobile','users.email','users.profilePic','users.kycStatus','users.registeredBy')->where(['employment_histories.status'=>'approved','employment_histories.isBusiness'=>0])->count();
        // $employment_histories_business = DB::table('employment_histories')->leftJoin('users','employment_histories.userId','users.id')->select('employment_histories.*','users.customerCode','users.name','users.mobile','users.email','users.profilePic','users.kycStatus','users.registeredBy')->where(['employment_histories.status'=>'approved','employment_histories.isBusiness'=>1])->count();

        $appliedProduct=DB::select("select alh.productId, count(alh.productId) as totalAppliedCount,c.name as categoryName,p.productName from apply_loan_histories alh LEFT JOIN products p ON alh.productId=p.id LEFT JOIN categories c ON p.categoryId=c.id group by alh.productId,c.name,p.productName order by count(alh.productId) desc limit 1");
        if(count($appliedProduct))
        {
            $appliedProductId=$appliedProduct[0]->productId;
            $totalAppliedCount=$appliedProduct[0]->totalAppliedCount;
            if($appliedProduct[0]->categoryName && $appliedProduct[0]->productName)
            {
                $appliedProductName=$appliedProduct[0]->categoryName.' / '.$appliedProduct[0]->productName;
            }else if($appliedProduct[0]->categoryName)
            {
                $appliedProductName=$appliedProduct[0]->categoryName;
            }else{
                $appliedProductName=$appliedProduct[0]->productName;
            }

            $totalAppliedPercentage=(($totalUserRegistered*$totalAppliedCount)/100);
        }


        $emiAndInterestSumCollected=DB::select("SELECT SUM(emiAmount) as totalEMIAmount,SUM(interest) as totalInterestAmount FROM loan_emi_details WHERE status='success'");
        $totalEMIAmountCollected=($emiAndInterestSumCollected[0]->totalEMIAmount) ? $emiAndInterestSumCollected[0]->totalEMIAmount : 0;
        $totalInterestAmountCollected=($emiAndInterestSumCollected[0]->totalInterestAmount) ? $emiAndInterestSumCollected[0]->totalInterestAmount : 0;
        
        $emiAndInterestSumDue=DB::select("SELECT SUM(emiAmount) as totalEMIAmount,SUM(interest) as totalInterestAmount FROM loan_emi_details WHERE status='pending'");
        $totalEMIAmountDue=($emiAndInterestSumDue[0]->totalEMIAmount) ? $emiAndInterestSumDue[0]->totalEMIAmount : 0;
        $totalInterestAmountDue=($emiAndInterestSumDue[0]->totalInterestAmount) ? $emiAndInterestSumDue[0]->totalInterestAmount : 0;
        
        $customer_managment_query = "SELECT count(u.id) as total FROM users u LEFT JOIN  apply_loan_histories alh ON u.id=alh.userId LEFT JOIN employment_histories eh ON u.id=eh.userId LEFT JOIN categories c ON alh.loanCategory=c.id WHERE u.userType='user'";

       
        $newUserCount = DB::select("$customer_managment_query AND u.kycStatus='pending' ORDER BY u.id desc")[0]->total;
        $employment_verification = DB::select("$customer_managment_query AND u.kycStatus='approved' AND eh.status='pending' ORDER BY u.id desc")[0]->total;

        $kyc_verified_customers =DB::select("$customer_managment_query AND u.kycStatus='approved' AND eh.status='approved' AND alh.id IS NULL  ORDER BY u.id desc")[0]->total;
        $final_credit_assessment =DB::select("$customer_managment_query AND u.kycStatus='approved' AND eh.status='approved' AND alh.status='sent-for-admin-approval' AND alh.id IS NOT NULL  ORDER BY u.id desc")[0]->total;

        $final_approval_for_disbursement =DB::select("$customer_managment_query AND u.kycStatus='approved' AND eh.status='approved' AND alh.status='customer-approved' AND alh.id IS NOT NULL AND alh.loanCategory !='3' ORDER BY u.id desc")[0]->total;
        
        $disbursement_pending_list =DB::select("$customer_managment_query AND u.kycStatus='approved' AND eh.status='approved' AND alh.status='sent-for-customer-approval' AND alh.id IS NOT NULL ORDER BY u.id desc")[0]->total;
        
        // dd($newUserCount);


        $latestDisbursedLoans=DB::select("SELECT alh.*,u.customerCode,u.name,u.mobile,u.email,u.profilePic FROM apply_loan_histories alh LEFT JOIN users u ON alh.userId=u.id where alh.status='disbursed' ORDER BY alh.id DESC LIMIT 10");


        $monthGraphStr='';
        $totalDisbursedAmountStr='';
        $totalInterestAmountStr='';
        $totalEMIAmountStr='';
        $latestLoanSummery=$this->getLatest3MonthsSummery();
        foreach ($latestLoanSummery['loanSummery'] as $key=> $los)
        {
            $monthGraphStr .='"'.$key.'", ';
            $totalDisbursedAmountStr .=$los['totalDisbursedAmount'].', ';
            $totalInterestAmountStr .=$los['totalInterestAmount'].', ';
            $totalEMIAmountStr .=$los['totalEMIAmount'].', ';
        }
        //echo '<pre>'; print_r($totalDisbursedAmountStr); exit;

        $totalApprovedAmount = DB::select("SELECT((SELECT SUM(netDisbursementAmount) FROM apply_loan_histories WHERE loanCategory!=3 AND (status='disbursed' OR status='closed'))+(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE status='success' AND txnType='out')) AS total")[0]->total;
        $perncipalDeposit = DB::select(" SELECT((SELECT IFNULL(SUM(principle),0) FROM loan_emi_details WHERE status='success')+(SELECT IFNULL(SUM(amount),0) FROM raw_materials_txn_details WHERE debitRecordId!='0' AND txnType='in' AND status='success')+(SELECT IFNULL(SUM(amount),0) FROM out_standing_payment_histories WHERE type='credit')) AS total")[0]->total;
        $allOutstandingAmount = $totalApprovedAmount - $perncipalDeposit;
        
        $alluserlist = User::where(['users.status'=>'1','users.userType'=>'user'])->leftJoin('employment_histories','employment_histories.userId','users.id')->select('users.id','users.customerCode','users.name','employment_histories.employerName')->get();
        // $alluserlist = User::where(['status'=>'1','userType'=>'user'])->select('id','customerCode','name')->get();
        // dd($alluserlist->count());
        $graphStr='{
        labels: ['.$monthGraphStr.'],
        datasets: [{
            label: "Disbursed Amount",
            backgroundColor: "#6571ff",
            data: ['.$totalDisbursedAmountStr.']
        }, {
            label: "EMIs",
            backgroundColor: "#ff65a5",
            data: ['.$totalEMIAmountStr.']
        }, {
            label: "Interest",
            backgroundColor: "#219d30",
            data: ['.$totalInterestAmountStr.']
        }]
    }';
        return view('dashboard',compact('graphStr','persionalLoans','totalRawLoans','outStandingLoans','alluserlist','newUserCount','totalLoans','totalUserRegistered','totalApprovedAmount','perncipalDeposit','userCountArr','disbursedLoans','toBedisbursedLoans','closedLoans','nocIssued','repeatCustomers','newUserRes','totalAppliedCount','appliedProductName','totalAppliedPercentage','dueUsersOfCurrentMonth','businessLoans','rawMaterialFinancingLoans','receievablesInvoicingLoans','totalEMIAmountCollected','totalInterestAmountCollected','latestDisbursedLoans','totalEMIAmountDue','totalInterestAmountDue','allOutstandingAmount','employment_verification','kyc_verified_customers','final_credit_assessment','final_approval_for_disbursement','disbursement_pending_list'));
    }

    public function getLatest3MonthsSummery()
    {
        $currentDate=date('Y-m-d');

        $date3=date('Y-m-d',strtotime($currentDate.' -2month'));
        $date2=date('Y-m-d',strtotime($currentDate.' -1month'));
        $date1=$currentDate;

        $month1=date('m',strtotime($date1));
        $year1=date('Y',strtotime($date1));
        $month1D=date('F',strtotime($date1));

        $month2=date('m',strtotime($date2));
        $year2=date('Y',strtotime($date2));
        $month2D=date('F',strtotime($date2));

        $month3=date('m',strtotime($date3));
        $year3=date('Y',strtotime($date3));
        $month3D=date('F',strtotime($date3));

        $totalDisbursedAmountR1=DB::select("SELECT SUM(approvedAmount) as totalDisbursedAmount FROM apply_loan_histories WHERE status='disbursed' AND MONTH(disbursedDate)='$month1' AND YEAR(disbursedDate)='$year1'");
        $totalDisbursedAmount1=($totalDisbursedAmountR1[0]->totalDisbursedAmount) ? $totalDisbursedAmountR1[0]->totalDisbursedAmount : 0;

        $emiAndInterestSum1=DB::select("SELECT SUM(emiAmount) as totalEMIAmount,SUM(interest) as totalInterestAmount FROM loan_emi_details WHERE MONTH(emiDate)='$month1' AND YEAR(emiDate)='$year1'");
        $totalEMIAmount1=($emiAndInterestSum1[0]->totalEMIAmount) ? $emiAndInterestSum1[0]->totalEMIAmount : 0;
        $totalInterestAmount1=($emiAndInterestSum1[0]->totalInterestAmount) ? $emiAndInterestSum1[0]->totalInterestAmount : 0;

        $totalDisbursedAmountR2=DB::select("SELECT SUM(approvedAmount) as totalDisbursedAmount FROM apply_loan_histories WHERE status='disbursed' AND MONTH(disbursedDate)='$month2' AND YEAR(disbursedDate)='$year2'");
        $totalDisbursedAmount2=($totalDisbursedAmountR2[0]->totalDisbursedAmount) ? $totalDisbursedAmountR2[0]->totalDisbursedAmount : 0;

        $emiAndInterestSum2=DB::select("SELECT SUM(emiAmount) as totalEMIAmount,SUM(interest) as totalInterestAmount FROM loan_emi_details WHERE MONTH(emiDate)='$month2' AND YEAR(emiDate)='$year2'");
        $totalEMIAmount2=($emiAndInterestSum2[0]->totalEMIAmount) ? $emiAndInterestSum2[0]->totalEMIAmount : 0;
        $totalInterestAmount2=($emiAndInterestSum2[0]->totalInterestAmount) ? $emiAndInterestSum2[0]->totalInterestAmount : 0;

        $totalDisbursedAmountR3=DB::select("SELECT SUM(approvedAmount) as totalDisbursedAmount FROM apply_loan_histories WHERE status='disbursed' AND MONTH(disbursedDate)='$month3' AND YEAR(disbursedDate)='$year3'");
        $totalDisbursedAmount3=($totalDisbursedAmountR3[0]->totalDisbursedAmount) ? $totalDisbursedAmountR3[0]->totalDisbursedAmount : 0;

        $emiAndInterestSum3=DB::select("SELECT SUM(emiAmount) as totalEMIAmount,SUM(interest) as totalInterestAmount FROM loan_emi_details WHERE MONTH(emiDate)='$month3' AND YEAR(emiDate)='$year3'");
        $totalEMIAmount3=($emiAndInterestSum3[0]->totalEMIAmount) ? $emiAndInterestSum3[0]->totalEMIAmount : 0;
        $totalInterestAmount3=($emiAndInterestSum3[0]->totalInterestAmount) ? $emiAndInterestSum3[0]->totalInterestAmount : 0;

        $returnArr['loanSummery'][$month1D]=['totalDisbursedAmount'=>$totalDisbursedAmount1,'totalInterestAmount'=>$totalInterestAmount1,'totalEMIAmount'=>$totalEMIAmount1];
        $returnArr['loanSummery'][$month2D]=['totalDisbursedAmount'=>$totalDisbursedAmount2,'totalInterestAmount'=>$totalInterestAmount2,'totalEMIAmount'=>$totalEMIAmount2];
        $returnArr['loanSummery'][$month3D]=['totalDisbursedAmount'=>$totalDisbursedAmount3,'totalInterestAmount'=>$totalInterestAmount3,'totalEMIAmount'=>$totalEMIAmount3];
        return $returnArr;
    }

    public function  adminUsers()
    {
        $pageTitle='Manage Users';
        $pageNameStr='manage-users';
        $userRoles=UserRole::where('status',1)->orderBy('name','asc')->get();
        $users=DB::select("SELECT u.*,ur.name as userTypeName FROM users u LEFT JOIN user_roles ur ON u.userType=ur.id where u.userType>0 and u.userType !='superadmin' AND u.id!='1' ORDER BY name ASC");
        return view('user-list',compact('pageTitle','users','pageNameStr','userRoles'));
    }

    public function  saveUserDetails(Request $request)
    {
        $pageTitle='Manage Users';
        $pageNameStr='manage-users';
        $users=DB::select("SELECT * FROM users where userType='admin' and userType!='superadmin' AND id!='1' ORDER BY name ASC");
        return view('user-list',compact('pageTitle','users','pageNameStr'));
    }

    public function  rolesList()
    {
        $pageTitle='Manage Roles';
        $roles=DB::select("SELECT * FROM user_roles where id>0 ORDER BY name ASC");
        return view('pages.los-roles.roles',compact('roles','pageTitle'));
    }

    public function  roleDefaultPermissions($roleId)
    {
        $roles=UserRole::where('id',$roleId)->first();
        $userPermissionsArr=[];
        if($roles->userPermissions){
            $userPermissionsArr=json_decode($roles->userPermissions);
        }

        $pageTitle='Permission Management for '.$roles->name;
        $permissionTo='role';
        return view('pages.los-roles.roles-permissions',compact('roles','roleId','permissionTo','userPermissionsArr','pageTitle'));
    }

    public function saveRoles(Request $request)
    {


        $recordId=$request->recordId;
        if($recordId>0)
        {
            $isValidated=AppServiceProvider::validatePermission('edit-role');
            $saved=UserRole::where('id',$recordId)->update(['name'=>$request->roleType,'description'=>$request->roleDesc]);
        }else{
            $isValidated=AppServiceProvider::validatePermission('add-role');
            $obj=new UserRole();
            $obj->roleId=strtoupper($request->roleType).rand(9999,0000);
            $obj->name=$request->roleType;
            $obj->description=$request->roleDesc;
            $obj->status=1;
            $saved=$obj->save();
        }

        if($saved){
            echo json_encode(['status'=>'success','message'=>'Role details has been saved successfully.']);
        }else{
            echo json_encode(['status'=>'error','message'=>'Something went wrong, Please try again.']);
        }
    }

    public function banksList()
    {
        $banks=Bank::all();
        return view('pages.loan-management.add-bank',compact('banks'));
    }

    public function saveBankDetails(Request $request)
    {
        $recordId=$request->recordId;
        if($recordId)
        {
            $isValidated=AppServiceProvider::validatePermission('edit-bank');
            $save=Bank::where('id',$recordId)->update(['name'=>$request->bankName,'description'=>$request->description,'location'=>$request->bankAddress]);
            if($save){
                echo json_encode(['status'=>'success','message'=>'Bank details has been updated successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }else{
            $isValidated=AppServiceProvider::validatePermission('add-bank');
            $obj=new Bank();
            $obj->name=$request->bankName;
            $obj->description=$request->description;
            $obj->location=$request->bankAddress;
            $obj->status=1;
            if($obj->save()){
                echo json_encode(['status'=>'success','message'=>'Bank details has been saved successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }
    }

    public function deleteBank(Request $request)
    {
        $isValidated=AppServiceProvider::validatePermission('delete-bank');
        $save=Bank::where('id',$request->recordId)->delete();
        if($save){
            echo json_encode(['status'=>'success','message'=>'Bank has been deleted successfully.']);
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
        }
    }

    public function updateAdminProfile(Request $request)
    {
        try{
        $recordId=auth()->user()->id;
        if($recordId) {
            $userEmail = $request->useremail;
            $userMobile=$request->usermobile;
            $upArr['name'] = $request->username;
            $upArr['email'] = $userEmail;
            $upArr['mobile'] = $userMobile;

            $EmailExist = DB::select("select id from users where email='$userEmail' and id !='$recordId'");
            if (count($EmailExist)){
                echo json_encode(['status'=>'error','message'=>'This email id is already registered with us.']); exit;
            }

            $MobileExist = DB::select("select id from users where mobile='$userMobile' and id !='$recordId'");
            if (count($MobileExist)){
                echo json_encode(['status'=>'error','message'=>'This mobile number is already registered with us.']); exit;
            }

            if($request->userpassword){
                $upArr['password']=md5($request->userpassword);
            }

            $image='';
            if(!empty($request->userprofile)){
                $image=AppServiceProvider::uploadImageCustom('userprofile','user-profile');
                $upArr['profilePic']=$image;
            }

            $save=User::where('id',$recordId)->update($upArr);
            if($save){
                echo json_encode(['status'=>'success','message'=>'Profile details has been updated successfully.']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
            }
        }else{
            echo json_encode(['status'=>'error','message'=>'Invalid Request, Please try again.']);
        }
    }catch (\Exception $e) {

        return $e->getMessage();
    }
    }

    public function creditScoreQnsAns($userId)
    {
        $questionsArr=[];
        $optionsArr=[];
        $userDtl=User::getUserDetailsById($userId);
        $creditScoreUserAns=CreditScoreUsersAnswer::where('userId',$userId)->first();
        $categories=CreditScoreQuestionsCategory::where('status',1)->get();

        if(count($categories))
        {
            foreach ($categories as $ctrow)
            {
                $questions=CreditScoreQuestion::where('categoryId',$ctrow->id)->where('status',1)->get();
                if(count($questions))
                {
                    foreach ($questions as $qnrow)
                    {
                        $questionsArr[$ctrow->id][]=$qnrow;
                        if($qnrow->qnsType=='objective')
                        {
                            $answers=CreditScoreQuestionAnswer::where('questionId',$qnrow->id)->where('status',1)->get();
                            if(count($answers))
                            {
                                foreach ($answers as $anrow)
                                {
                                    $optionsArr[$qnrow->id][]=$anrow;
                                }
                            }
                        }
                    }
                }
            }
        }

        $Obj=new CustomerController();
        $AdvanxRes=$Obj->calculateAdvanxSxore($userId);
        $finalAdvanxScore=$AdvanxRes['finalAdvanxScore'];
        $source_of_applicationStr=$AdvanxRes['source_of_applicationStr'];
        $userCibilScoreAnsSummary=$AdvanxRes['userCibilScoreAnsSummary'];

        $products=DB::select("SELECT p.id as productId,p.productName,p.productCode,c.name as categoryName,sc.name as subcategoryName FROM products p LEFT JOIN categories c ON p.categoryId=c.id LEFT JOIN subcategories sc ON p.subCategoryId=sc.id ORDER BY p.productName ASC");
        return view('pages.system-algorithm.question-and-answer',compact('categories','questionsArr','optionsArr','userDtl','creditScoreUserAns','finalAdvanxScore','userCibilScoreAnsSummary','products'));
    }

    public function saveCreditScoreQnsAns(Request $request, $userId)
    {
        $formData=$request->all();
        unset($formData['_token']);
        $formDataStr=json_encode($formData);
        //echo '<pre>'; print_r($formData);exit;
        $userAns=CreditScoreUsersAnswer::where('userId',$userId)->first();
        if(!empty($userAns))
        {
            $save=CreditScoreUsersAnswer::where('userId',$userId)->update(['formData'=>$formDataStr]);
            if($save){
                echo json_encode(['status'=>'success','message'=>'Your request has been processed successfully.']); exit;
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']); exit;
            }
        }else{
            $obj=new CreditScoreUsersAnswer();
            $obj->userId=$userId;
            $obj->formData=$formDataStr;
            $obj->status=1;
            if($obj->save()){
                echo json_encode(['status'=>'success','message'=>'Your request has been processed successfully.']); exit;
            }else{
                echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']); exit;
            }
        }
    }

    public function updateRolesPermissions(Request $request)
    {
        $isValidated=AppServiceProvider::validatePermission('change-permissions');

        $permissionTo=$request->permissionTo;
        $userId=$request->userId;
        $userPermissions=$request->userPermissions;
        $userPermissionsStr=json_encode($userPermissions);
        if($permissionTo=='role')
        {
            $save=UserRole::where('id',$userId)->update(['userPermissions'=>$userPermissionsStr]);
        }else{
            $save=User::where('id',$userId)->update(['userPermissions'=>$userPermissionsStr]);
        }

        if($save){
            echo json_encode(['status'=>'success','message'=>'Your request has been processed successfully.']); exit;
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']); exit;
        }
    }

    public function saveUserProfile(Request $request)
    {
        $userActionId=$request->userActionId;
        $useremail=$request->useremail;

        if($userActionId>0){
            $isValidated=AppServiceProvider::validatePermission('edit-sys-user');
        }else{
            $isValidated=AppServiceProvider::validatePermission('add-sys-user');
        }
        $SUBQRY='';
        if($request->userActionName=='edit'){
            $SUBQRY=" AND id !='$userActionId'";
        }

        $emailExist=DB::select("SELECT * FROM users WHERE email='$useremail' $SUBQRY");
        if(count($emailExist)){
            echo json_encode(['status'=>'error','message'=>'This email is already registered with us.']);exit;
        }

        $saveArr['name']=$request->username;
        $saveArr['email']=$useremail;
        $saveArr['mobile']=$request->mobilenumber;
        if($request->userActionName=='add' || !empty($request->password))
        {
            $saveArr['password']=md5($request->password);
        }

        $saveArr['userType']=$request->userType;
       
        if($request->hasFile('myDropify'))
        {
            $profilePic=AppServiceProvider::uploadImageCustom('myDropify','user-profile');
            $saveArr['profilePic']=$profilePic;
        }

        if($request->userActionName=='add')
        {
            //print_r($saveArr);exit;
            $save=User::create($saveArr);
            $userId=$save->id;
            $customerCode='AES00'.$userId;
            User::where('id',$userId)->update(['customerCode'=>$customerCode,'status'=>1]);

            if($useremail)
            {
                $verifyWith = env('APP_NAME');
                $adminURL=route('login');
                $htmlSt = '<div style="padding-bottom: 15px;"
                        <p>Dear ' . $request->username . ',</p>
                        <p>Congratulations now you are member of '.$verifyWith.', Please find login details are as follows.</p>
                        <p><strong>Login Url : </strong> <a href="'.$adminURL.'" target="_blank">'.$adminURL.'</a> </p>
                        <p><strong>Email : </strong> '.$useremail.'</p>
                        <p><strong>Password : </strong> '.$request->password.'</p>
                        </div>';

                $toMail=$useremail;
                $toUser=$request->username ;
                $subject="Welcome to be member of ".$verifyWith.' - '.$request->username ;

                AppServiceProvider::sendMail($toMail,$toUser,$subject,$htmlSt);
            }

        }else{
            $save=User::where('id',$userActionId)->update($saveArr);
        }

        if($save){
            echo json_encode(['status'=>'success','message'=>'User details has been saved successfully.']);
        }else{
            echo json_encode(['status'=>'error','message'=>'Some error occurred, Please try again.']);
        }

    }

    public function sysUserProfile($userId)
    {

        $userDtl = DB::select("SELECT u.*,ur.userPermissions as userRolePermissions,ur.name as roleName,ur.description as roleDesc FROM users u LEFT JOIN user_roles ur ON u.userType=ur.id WHERE u.id='$userId' AND  ur.id IS NOT NULL");
        if(!count($userDtl)){
            return redirect()->route('adminDashboard');
        }

        $userDtl=$userDtl[0];
        return view('pages.general.admin-profile',compact('userDtl'));
    }

    public function getProductsListByCategory(Request $request)
    {
        $catId=$request->catId;
        $htmlStr='<option value="">Select</option>';
        $products=Product::where(['categoryId'=>$catId,'status'=>1])->orderBy('productName','ASC')->get();
        if(count($products)){
            foreach ($products as $prow) {
                $htmlStr .='<option value="'.$prow->id.'">'.$prow->productName.'</option>';
            }
            
        }
        echo json_encode(['status'=>'success','message'=>'Product List.','data'=>$htmlStr]);
    }

    public function getTenureListByCategory(Request $request)
    {
        $catId=$request->catId;
        $htmlStr='<option value="">Select</option>';
        $products=Tenure::where(['loanCategory'=>$catId,'status'=>1])->orderBy('sortOrder','ASC')->get();
        if(count($products)){
            foreach ($products as $prow) {
                $htmlStr .='<option value="'.$prow->id.'">'.$prow->name.'</option>';
            }
            
        }
        echo json_encode(['status'=>'success','message'=>'Tenure List.','data'=>$htmlStr]);
    }
}
