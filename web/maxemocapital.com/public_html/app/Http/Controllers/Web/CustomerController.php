<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Providers\AppServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Product;
use App\Models\RawMaterialsTxnDetail;
use App\Models\Tenure;
use App\Models\User;
use App\Models\EmploymentHistory;
use App\Models\UserBankDetail;
use App\Models\UserDoc;
use App\Models\OtherKycDoc;
use App\Models\UserOtp;
use App\Models\ApplyLoanHistory;
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
use App\Models\UserRole;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Payments\EaseBuzzApiController;
use App\Models\CareerRequest;
use App\Models\LoanKycOtherPendetail;
use DateTime;
use DatePeriod;
use DateInterval;
use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Session;

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
        $userloggedData = $this->isUserLoggedIn();

        // dd($userloggedData);
        return view('web.welcome', compact('userloggedData'));
    }


    public function userLogin()
    {
        return view('web.login');
    }

    public function signUp()
    {
        return view('web.sign-up');
    }

    public function forgetPassword()
    {
        return view('web.forget-password');
    }

public function careerForm(Request $request){
        $this->validate($request,[
            "applied_for" => 'required',
            "fullname"=>'required',
            "email" => 'required|email',
            "phone_number" => 'required',
            "work_experience" => 'required|min:50',
            "file1" => 'required'
        ]);

        $image='';
        if ($request->hasFile('file1')) {
            $image=AppServiceProvider::uploadImageCustom('file1','resume');
        }
        

        CareerRequest::create([
            "career_post_id"=>$request->applied_for,
            "full_name"=>$request->fullname,
            "email"=>$request->email,
            "mobile"=>$request->phone_number,
            "describe_work"=>$request->work_experience,
            "cv"=>$image
        ]);

        return redirect()->back()->with('success','Your Application Submitted Successfully !');
    }

    public function userDashboard()
    {
        if(session()->get('done') == 1){
            session()->forget('step');
        }
        $userloggedData = $this->isUserLoggedIn();
        $userId = $userloggedData->id;
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
        return view('web.dashboard', compact('allLoans', 'userloggedData', 'tenures', 'newUserRes', 'userBankDtl', 'userDocDtl','userKycDocDtl', 'userEmploymentHistoryArr', 'coApplicantDtlARR', 'otherKycDocs', 'categories'));
    }

    public function userLoanDetailsHtml(Request $request)
    {
        $loanId = $request->selectedloan;
        session()->put('sessionLoan',$loanId);
        $loanD = ApplyLoanHistory::whereId($loanId)->first();
        $userloggedData = $this->isUserLoggedIn();
        if(isset($request->userId) && $request->userId) {
            $userId = $request->userId;
        }else{
            $userId = $userloggedData->id;
        }
        
        
        $loanDetails = DB::table('apply_loan_histories')->leftJoin('tenures', 'tenures.id', 'apply_loan_histories.tenure')->select('apply_loan_histories.*', 'tenures.name')->where('apply_loan_histories.id', $loanId)->first();
        $emiDetails = LoanEmiDetail::where(['userId' => $userId, 'loanId' => $loanId])->orderBy('emiSr', 'asc')->get();
        $principleChargesDetails = json_decode($loanDetails->principleChargesDetails);
        if ($loanD->loanCategory != 3) { ?>
        
            <div class="row">
            <div class="col-md-12 text-right"><strong>Loan Status : </strong><span class="badge badge-primary" style="font-size: 15px;"><?php if($loanD->isAdminApproved == "rejected"){ ?> Rejected <?php }else{ ?></php> <?=  ucwords(str_replace('-',' ',$loanD->status))  ?> <?php } ?></span></div>
                <div class="col-lg-4">
                    <div class="business_card_a">
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Loan ID</h6>
                            </div>
                            <div class="data_">
                                <p>LF0<?= $loanId ?></p>
                            </div>
                        </div>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>ROI Type:</h6>
                            </div>
                            <div class="data_">
                                <p><?= ucwords(str_replace('_', ' ', $loanDetails->roiType)) ?></p>
                            </div>
                        </div>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Loan Amount : </h6>
                            </div>
                            <div class="data_">
                                <p><?= $loanDetails->loanAmount ?></p>
                            </div>
                        </div>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Approved Amount:</h6>
                            </div>
                            <div class="data_">
                                <p>
                                <?php if($loanDetails->status == "disbursed"){ ?> 
                                    <?= $loanDetails->approvedAmount ?>
                                    <?php }else{ echo 0; } ?>
                                </p>
                            </div>
                        </div>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Tenure:</h6>
                            </div>
                            <div class="data_">
                                <p><?= $loanDetails->name  ?></p>
                            </div>
                        </div>
                        

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="business_card_a">
                        
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Interest:</h6>
                            </div>
                            <div class="data_">
                                <p><?= $loanDetails->rateOfInterest ?>%</p>
                            </div>
                        </div>
                        <?php if($loanD->loanCategory != '8'){ ?>
                         <div class="detail_a" style="display:none;">
                            <div class="title_">
                                <h6>Monthly EMI :</h6>
                            </div>
                            <div class="data_">
                                <p><?= $loanDetails->monthlyEMI ?></p>
                            </div>
                        </div>  
                        <?php } ?>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Total Interest : </h6>
                            </div>
                            <div class="data_">
                                <p><?= $loanDetails->totalInterest ?></p>
                            </div>
                        </div>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Extra Days : </h6>
                            </div>
                            <div class="data_">
                                <p><?= $loanDetails->extraAmountDays ?> Days</p>
                            </div>
                        </div>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Extra Days Amount : </h6>
                            </div>
                            <div class="data_">
                                <p><?= $loanDetails->extraIntrestAmount ?></p>
                            </div>
                        </div>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Plateform Fee :</h6>
                            </div>
                            <div class="data_">
                                <p><?= $principleChargesDetails->plateformFee ?? 0 ?></p>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="business_card_a">
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Insurance Fee :</h6>
                            </div>
                            <div class="data_">
                                <p><?= $principleChargesDetails->insurance ?? 0 ?></p>
                            </div>
                        </div>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Include PF/Insurance Fee : </h6>
                            </div>
                            <div class="data_">
                                <p><?php if($loanDetails->exclude_pfif && $loanDetails->exclude_pfif==1) echo 'Yes'; else echo 'No'; ?></p>
                            </div>
                        </div>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Include Extradays Amount : </h6>
                            </div>
                            <div class="data_">
                                <p><?php if($loanDetails->include_extradays && $loanDetails->include_extradays==1) echo 'Yes'; else echo 'No'; ?></p>
                            </div>
                        </div>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Disbursed <?php if(isset($request->userId) && $request->userId) {echo 'scheduled';} ?> date : </h6>
                            </div>
                            <div class="data_">
                                <p><?= $loanDetails->disbursedDate ?></p>
                            </div>
                        </div>
                        <div class="detail_a">
                            <div class="title_">
                                <h6>Net Disbursement Amount : </h6>
                            </div>
                            <div class="data_">
                                <p>
                                <?php if($loanDetails->status == "disbursed"){ ?>    
                                <?php echo $loanDetails->exclude_pfif == '0' ? $loanDetails->netDisbursementAmount : $loanDetails->disbursementAmount; ?>
                            <?php }else { ?>
                                0
                                <?php } ?>
                            </p>
                            </div>
                        </div>
                        


                    </div>
                </div>
            </div>

            <div class="col-lg-12 px-0 text-end mt-3">
                <!-- <a href="#">View Summary</a> -->
                <button type="button" class="btn creditamt_btn summary_btn" onclick="summary_btn()">
                    View Summary
                </button>
            </div>
            <div class="table_mainstart showtable__" id="emidt_tablemain">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tablecard" style="overflow-x: scroll;">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            EMI ID
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                         <?php if($loanDetails->loanCategory==8){ ?> MONTHLY INTEREST <?php }else{ ?> EMI AMOUNT  <?php } ?>
                                        </th>
                                       <?php if($loanDetails->tds > 0 && $loanDetails->loanCategory == 1){ ?>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">NET EMI Amount</th>
                                        <?php } ?>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        PRINCIPLE
                                        </th>
                                        
                                        <?php if ($loanDetails->loanCategory != 8) { ?>
                                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                INTEREST
                                            </th>
                                        <?php  } ?>
                                        <?php if($loanDetails->tds > 0){ ?>
                                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                TDS %
                                            </th>
                                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                TDS AMOUNT
                                            </th>
                                        <?php if($loanDetails->loanCategory == 8){ ?>
                                                <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">NET MONTHLY INTEREST</th>
                                        <?php  }else{ ?>
                                                <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">NET INTEREST</th>
                                        <?php  }} ?>
                                        <?php if($loanDetails->loanCategory!=8){ ?>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            PAYBLE AMOUNT
                                        </th>
                                        <?php } ?>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            BALANCE
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            START DATE
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            DUE DATE
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            TANSACTION IDS
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            TANSACTION DATE
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            LATE CHARGES
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            STATUS
                                        </th>
                                        <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            PAY STATUS
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($emiDetails)) {
                                        $todayDate = date('Y-m-d');
                                        $alreadyPay = 0;
                                        foreach ($emiDetails as $erow) {
                                            if ($erow->status == 'pending') {
                                                $statusText = '<span class="label label-warning">Pending</span>';
                                            } elseif ($erow->status == 'success') {
                                                $statusText = '<span class="label label-success">Success</span>';
                                            } else {
                                                $statusText = '<span class="label label-danger">Failed</span>';
                                            }
                                            $EMIID = $erow->emiId;
                                            $emiDate = (strtotime($erow->emiDate)) ? date('d/m/Y', strtotime($erow->emiDate)) : '';
                                            $emiDueDate = (strtotime($erow->emiDueDate)) ? date('d/m/Y', strtotime($erow->emiDueDate)) : '';
                                            $transactionDate = (strtotime($erow->transactionDate)) ? date('d/m/Y', strtotime($erow->transactionDate)) : '';
                                            $lateCarges = ($erow->lateCharges) ? $erow->lateCharges : '';
                                            $totalPaybleAmt= round($erow->netemiAmount+$erow->lateCharges,2);
                                            $EaseBuzzApiController = new EaseBuzzApiController();
                                            
                                            if($erow->payment_links){
                                                $alreadyPay = 1;
                                            }

                                            if ($erow->status == 'pending' && !isset($dd)) {
                                                $dd = 1;
                                                if(!$erow->payment_links){
                                                    if($alreadyPay == 1){
                                                        $paylink_url = $EaseBuzzApiController->easyCollectionLink($erow->id);
                                                    }else{
                                                        $paylink_url = $EaseBuzzApiController->enachEMIFirstApi($erow->id);
                                                    }
                                                    DB::table('loan_emi_details')->where('id',$erow->id)->update(['payment_links'=>$paylink_url]);
                                                }else{
                                                    $paylink_url = $erow->payment_links;
                                                }
                                            }
                                    ?>
                                            <tr>
                                                <td><?= $EMIID ?></td>
                                                <td><?= $erow->emiAmount ?></td>
                                               <?php if($loanDetails->tds > 0 && $loanDetails->loanCategory == 1){ ?>
                                                    <td><?= number_format($erow->netemiAmount,2) ?></td>
                                               <?php } ?>
                                                <td><?= $erow->principle ?></td>
                   
                                                <?php if ($loanDetails->loanCategory != 8) { ?>
                                                    <td><?= $erow->interest ?></td>
                                                <?php  } ?>
                                               <?php if($loanDetails->tds > 0){ ?>
                                                    <td><?=$loanDetails->tds ?></td>
                                                    <td><?=$erow->tdsAmount ?></td>
                                                    <td><?=$erow->netInterest ?></td>
                                               <?php } ?>
                                               <?php if($loanDetails->loanCategory!=8){ ?>
                                                    <td><?=$totalPaybleAmt ?></td>
                                                <?php } ?>
                                                <td><?= $erow->balance ?></td>
                                                <td><?= $emiDate ?></td>
                                                <td><?= $emiDueDate ?></td>
                                                <td><?= $erow->transactionId ?></td>
                                                <td><?= $transactionDate ?></td>
                                                <td><?= $lateCarges ?></td>
                                                <td><?= $statusText ?></td>
                                                <td>
                                                    <?php if ($erow->transactionId) { ?>
                                                        <lable class="bg-success" style="width:80px;line-height:22px;font-weight: normal;color: white;padding: 5px 22px;border-radius: 10px;">Paid</lable>
                                                        <?php } else {
                                                        if (isset($paylink_url)) { ?>
                                                            <a href="<?= $paylink_url ?>" target="_blank" class="btn btn-primary btn-sm" style="width:80px;color: white;cursor: pointer;line-height:22px;font-weight: normal;">Pay Now</a>
                                                        <?php unset($paylink_url);
                                                        } else { ?>
                                                            ---
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <!-- <button class="btn btn-primary btn-sm" style="width:80px;line-height:22px;font-weight: normal;">Pay Now</button> -->
                                                </td>
                                            </tr>
                                    <?php  }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else {
            $loanDetails = DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.id='$loanId' and alh.loanCategory='3'  ORDER BY alh.id DESC");
            // echo json_encode(['data'=>$loanDetails]);
            // dd($loanDetails);
            if($loanDetails){
            $loanDetails = $loanDetails[0];
            }
            $userId = $loanDetails->userId;
            $userDtl = User::getUserDetailsById($userId);
            $tenures = Tenure::where('loanCategory', 3)->orderBy('sortOrder', 'ASC')->get();

            $netDisbursementAmount01 = DB::select("SELECT IFNULL(SUM(amount),0) AS netDisbursementAmount FROM raw_materials_txn_details WHERE debitRecordId='0' AND status='success' AND loanId='$loanId'");
            $principleDeposited01 = DB::select("SELECT IFNULL(SUM(amount),0) AS principleDeposited FROM raw_materials_txn_details WHERE debitRecordId!='0' AND status='success'  AND loanId='$loanId'");

            $netDisbursementAmount = 0;
            $principleDeposited = 0;
            if ($netDisbursementAmount01) {
                $netDisbursementAmount = $netDisbursementAmount01[0]->netDisbursementAmount;
            }
            if ($principleDeposited01) {
                $principleDeposited = $principleDeposited01[0]->principleDeposited;
            }


            $OutStandingAmount = $netDisbursementAmount - $principleDeposited;

            $credHistoryArr = CommonController::checkAvailableAmountLimitRawMaterial($userId, $loanId);

            $availableLimit = $credHistoryArr['availableLimit'];
            $totalCredit = $credHistoryArr['totalCredit'];
            $totalDebit = $credHistoryArr['totalDebit'];
            $filterType = $request->filterType ?? 'all';
            if($filterType=='all')
            {
                $selQry="SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.loanId='$loanId' AND rmc.status='success' ORDER BY rmc.id DESC";
            }else if($filterType=='credit'){
                $selQry="SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.txnType='out' AND rmc.loanId='$loanId' AND rmc.status='success' ORDER BY rmc.id DESC";
            }else if($filterType=='debit'){
                $selQry="SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.txnType='in' AND rmc.loanId='$loanId' AND rmc.status='success' ORDER BY rmc.id DESC";
            }else if($filterType=='due'){
                $selQry="SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.loanId='$loanId' AND rmc.status='success' AND rmc.txnType='out' AND rmc.openingBalanceLatest != 0 ORDER BY rmc.id DESC";
            }

        //$loanDetails=DB::select("SELECT rmd.id as debitRecordId,rmd.created_at as debitProcessSysDate,rmd.amount as loanAmount,rmd.transactionDate as openingdate,rmd.status as debitStatus,rmd.transactionId as debitTxnId,rmd.payment_mode as debitPaymentMode,rmd.transactionDate as debitTxnDate,rmc.* FROM raw_materials_txn_details rmd LEFT JOIN raw_materials_txn_details rmc ON rmd.id=rmc.debitRecordId WHERE rmd.txnType='out' AND rmd.loanId='$loanId' $SUBQRY ORDER BY rmd.id ASC");

            $loanDetails_raw=DB::select($selQry);
            // $loanDetails_raw = DB::select("SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.loanId='$loanId' AND rmc.status='success' ORDER BY rmc.id DESC");
           
            $paymentURL = route('initiateRawMaterialPayment', base64_encode($loanId));
            // dd($loanDetails_raw);
            if (!empty($loanDetails)) {
            ?>
            <div class="row">
            <div class="col-md-12 text-right mb-4"><strong>Loan Status : </strong><span class="badge badge-primary" style="font-size: 15px;"> <?=  ucwords(str_replace('-',' ',$loanD->status))  ?></span></div>
                <div class="col-lg-4">
                    <div class="loan_card">
                        <?php if($loanDetails->status == 'customer-approved'){ ?>
                        <div class="content_headerloan">
                            <h1>Loan Amount</h1>
                            <h4>₹<?= $loanDetails->approvedAmount ?></h4>
                        </div>
                        <?php }else{ ?>
                            <div class="content_headerloan">
                            <h1>Request Loan Amount</h1>
                            <h4>₹<?= $loanDetails->approvedAmount ?></h4>
                        </div>
                            <?php } ?>
                            <?php if($loanDetails->rateOfInterest) { ?>
                        <div class="card_number">
                            <p><strong>Rate of Interest</strong> <span><?= $loanDetails->rateOfInterest ?>%</span></p>
                        </div>
                        <?php } ?>
                        <div class="loan_cdfooter">
                            <div class="card_holder holder_details">
                                <h1>Customer Name</h1>
                                <p><?= $userDtl->name ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="amount_limit">
                        <h5>Limit</h5>
                        
                        <?php if($loanDetails->status == 'customer-approved'){ ?>
                        <div class="progress h-3 bg-slate-150 dark:bg-navy-500">
                            <div class="w-5/12 rounded-full bg-primary dark:bg-accent"></div>
                        </div>
                        <div class="limit_amount">
                            <p><span id="availableLimit"><?= $availableLimit ?></span><span> / <?= $loanDetails->approvedAmount ?> </span></p>
                        </div>
                        <?php }else { ?>
                            <div class="progress h-3 bg-slate-150 dark:bg-navy-500">
                                <div class="w-0/12 rounded-full bg-primary dark:bg-accent"></div>
                            </div>
                            <div class="limit_amount">
                            <p>₹<span id="availableLimit">0</span><span> / ₹0 </span></p>
                        </div>
                            <?php } ?>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="right_lddt">
                        <div class="credit_debit_details">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="debitcard cd_details">
                                        <h1>Amount Debit</h1>
                                        <p>₹<?= $totalCredit ?></p>
                                        <div class="arrow_icon"><img src="https://maxemocapital.co.in/maxemolms/assets/admin/images/uparrow.png" alt=""></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="creditcard cd_details">
                                        <h1>Amount Credit</h1>
                                        <p>₹<?= $totalDebit ?></p>
                                        <div class="arrow_icon"><img src="https://maxemocapital.co.in/maxemolms/assets/admin/images/downarrow.png" alt=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="loanmore_details">
                            <div class="lm_title">More Information</div>
                            <div class="lmcard_customerdetails">
                                <ul>
                                    <li>
                                        <h1>Tenure</h1>
                                        <p><?= $loanDetails->approvedTenureD ?></p>
                                    </li>
                                    <?php /* <li>
                                    <h1>Out Standing Amount</h1>
                                    <p>₹<?= number_format($OutStandingAmount,2) ?></p>
                                </li> */ ?>
                                    <li>
                                        <h1>Valid From</h1>
                                        <p><?= (strtotime($loanDetails->validFromDate)) ? date('d M, Y', strtotime($loanDetails->validFromDate)) : '' ?></p>
                                    </li>
                                    <li>
                                        <h1>Valid To</h1>
                                        <p><?= (strtotime($loanDetails->validToDate)) ? date('d M, Y', strtotime($loanDetails->validToDate)) : '' ?></p>
                                    </li>
                                    <?php /* <li>
                                     <h1>Invoice</h1>
                                    <a href="<?= asset('/') ?>public/<?= $loanDetails->invoiceFile ?>" target="_blank"><img src="<?= asset('/') ?>public/<?= $loanDetails->invoiceFile ?>" style="width:100px; height: 100px;object-fit: contain;" /></a>
                                    </li> */ ?>

                                </ul>
                            </div>
                            <?php if (count($loanDetails_raw) > 0 || $loanD->status == "customer-approved") { ?>
                                <div class="col-lg-12" id="btnhistory">

                                    <div class="row">
                                        <div class="col-md-12">
                                        <?php if (count($loanDetails_raw) > 0) { ?>
                                            <a type="button" class="btn creditamt_btn" href="<?= $paymentURL ?>">
                                                <i class="fa-solid fa-money-bill-transfer"></i>
                                                Credit Amount
                                            </a>
                                            <?php } ?>
                                            <button type="button" class="btn disbursment_btn" onclick="openDisbursementRequestModal('<?= $loanDetails->id ?>');">
                                                <i class="fa-solid fa-money-bill-transfer"></i>
                                                Disbursement Request
                                            </button>
                                            <?php if (count($loanDetails_raw) > 0) { ?>
                                            <a type="button" class="btn btn-danger creditamt_btn" href="<?php echo route('adminExportReports',['page'=>'customer-rawmaterial-dataexport']); ?>/?loanId=<?php echo $loanId;?>&filterData=<?php echo $filterType; ?>">
                                                <i class="fa-solid fa-money-bill-transfer"></i>
                                                Export Data
                                            </a>
                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="maindetails_cardd table_card">
                <div class="statement-dropdown">
                    <h1>Transaction</h1>
                    <select name="" style="display: none;">
                        <option value="all">All Statement</option>
                        <option value="credit" selected>Credit</option>
                        <option value="debit">Debit</option>
                        <option value="due">Due</option>
                    </select>
                    <div class="nice-select" tabindex="0">
                        <span class="current"><?php if($filterType == "all") echo 'All Statement'; elseif($filterType == "credit") echo 'Credit' ; elseif($filterType == "debit") echo 'Debit' ; elseif($filterType == "due") echo 'Due' ; ?> </span>
                        <ul class="list" style="z-index: 1000 !important;">
                            <li onclick="loanDataShow('all')" data-value="" class="option <?php if($filterType == "all") echo "selected"; ?>">All Statement</li>
                            <li onclick="loanDataShow('credit')" data-value="" class="option <?php if($filterType == "credit") echo "selected"; ?>">Credit</li>
                            <li onclick="loanDataShow('debit')" data-value="" class="option <?php if($filterType == "debit") echo "selected"; ?>">Debit</li>
                            <li onclick="loanDataShow('due')" data-value="" class="option <?php if($filterType == "due") echo "selected"; ?>">Due Summary</li>
                        </ul>
                    </div>
                </div>

                <div class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1" style="overflow-x: auto;">
                    <table class="is-hoverable w-full text-left table-bordered">
                        
                            <thead>
              <tr>
                <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Sr. No.</th>
                  <?php  if($filterType=='all')
                    { ?>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Opening Date</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Opening Amount</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Closing Date</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Closing Amount</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Withdraw Amount</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Deposit </th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Interest Days</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Total Interest</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">TDS %</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">TDS Amount</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Net Interest</th>                                
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Late Charge</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">No. of days of late charges</th>                                
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Principle Deposit</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Tenure </th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Invoice No. </th>
                  <?php  }else if($filterType=='credit'){ ?>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Amount</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Transaction Id</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Payment Mode</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Transaction Date </th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Tenure </th>
                            
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Invoice No. </th>
                  <?php  }else if($filterType=='debit'){ ?>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Opening Date</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Opening Amount</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Closing Date</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Closing Amount</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Deposit </th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Interest Days</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Total Interest</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">TDS %</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">TDS Amount</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Net Interest</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Late Charge</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">No. of days of late charges
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Principle Deposit</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Tenure </th>
                  <?php  }else if($filterType=='due'){ ?>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Amount</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Opening Date</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Due Date</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Due Amount</th>
                            <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Invoice No. </th>
                  <?php  } ?>
                  <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Status </th>
             <th class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Created Date</th>
              </tr>
            </thead>
                            
                        <tbody>
                            <?php
                            if ($loanDetails_raw) {


                                if (count($loanDetails_raw) > 0) {
                                    $lsr = 1;
                                    foreach ($loanDetails_raw as $kk => $lrow) {
                                        $applyDate = (strtotime($lrow->created_at)) ? date('d M, Y', strtotime($lrow->created_at)) : '';


                                        $transactionDate = (strtotime($lrow->transactionDate)) ? date('d M, Y', strtotime($lrow->transactionDate)) : '';

                                        $openingdate = (strtotime($lrow->openingDate)) ? date('d M, Y', strtotime($lrow->openingDate)) : '';

                                        $closingDate = $transactionDate;

                                        $debitTxnDate = $transactionDate;

                                        // $statusText=strtoupper($lrow->status);
                                        $debitStatus = strtoupper($lrow->status);
                                        // $txnType=strtoupper($lrow->txnType);
                                        // if($txnType=='IN'){
                                        //     $txnType='Credit';
                                        // }else if($txnType=='OUT'){
                                        //     $txnType='Debit';
                                        // }
                                        $tenureDueDate=(strtotime($lrow->tenureDueDate)) ? date('d M, Y',strtotime($lrow->tenureDueDate)) : '';
                                        $buttons = '';
                                        $loanStatus = strtoupper($lrow->status);
                                        $totalDepositAmount = $lrow->totalAmount + $lrow->lateCharges;
                            ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1"><?= ($kk + 1) ?></td>
   
                                            <?php if ($filterType == 'all') {
                                                if ($lrow->txnType == 'in') { ?>
                                                    <td><?= $openingdate ?></td>
                                                    <td><?= number_format($lrow->openingBalance, 2) ?></td>
                                                    <td><?= $closingDate ?></td>
                                                    <td><?= number_format($lrow->outstandingBalance, 2) ?></td>
                                                    <td></td>
                                                    <td><?= number_format($lrow->totalAmount + $lrow->lateCharges, 2) ?></td>
                                                    <td><?= $lrow->numOfDays ?></td>
                                                    <td><?= number_format($lrow->interestAmount, 2) ?></td>
                                                    <td><?= number_format($lrow->tdsPercent, 2) ?></td>
                                                    <td><?= number_format($lrow->tdsAmount, 2) ?></td>
                                                    <td><?= number_format($lrow->interestAmountPayble, 2) ?></td>
                                                    <td><?= number_format($lrow->lateCharges, 2) ?></td>
                                                    <td><?= $lrow->numOfDaysOfFine ?></td>
                                                    <td><?= number_format($lrow->amount, 2) ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?= $debitStatus ?></td>
                                                <?php  } else { ?>
                                                    <td><?= $openingdate ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?= number_format($lrow->amount, 2) ?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?= $lrow->tenureName ?></td>
                                                    <?php $invNumber = ($lrow->invoiceNumber) ? $lrow->invoiceNumber : '';
                                                    if ($invNumber) { ?>
                                                        <td><a href="javascript:;" style="color:blue;" data-invoiceNumber="<?= $lrow->invoiceNumber ?>" data-invoiceFile="<?= $lrow->invoiceFile ?>" data-drawDownFormFile="<?= $lrow->drawDownFormFile ?>" id="rawFile<?= $lrow->id ?>" onclick="openInvFiles(<?= $lrow->id ?>);"><?= $invNumber ?></a></td>
                                                    <?php } else { ?>
                                                        <td></td>
                                                    <?php  } ?>
                                                    <td><?= $debitStatus ?></td>
                                                <?php  }
                                            } else if ($filterType == 'credit') { ?>

                                                <td><?= number_format($lrow->amount, 2) ?></td>
                                                <td><?= $lrow->transactionId ?></td>
                                                <td><?= strtoupper($lrow->payment_mode) ?></td>
                                                <td><?= $transactionDate ?></td>
                                                <td><?= $lrow->tenureName ?></td>
                                                <?php $invNumber = ($lrow->invoiceNumber) ? $lrow->invoiceNumber : '';
                                                if ($invNumber) { ?>
                                                    <td><a href="javascript:;" style="color:blue;" data-invoiceNumber="<?= $lrow->invoiceNumber ?>" data-invoiceFile="<?= $lrow->invoiceFile ?>" data-drawDownFormFile="<?= $lrow->drawDownFormFile ?>" id="rawFile<?= $lrow->id ?>" onclick="openInvFiles(<?= $lrow->id ?>);"><?= $invNumber ?></a></td>
                                                <?php   } else { ?>
                                                    <td></td>
                                                <?php  } ?>
                                                <td><?= $debitStatus ?></td>
                                            <?php } else if ($filterType == 'debit') { ?>
                                                <td><?= $openingdate ?></td>
                                                <td><?= number_format($lrow->openingBalance, 2) ?></td>
                                                <td><?= $closingDate ?></td>
                                                <td><?= number_format($lrow->outstandingBalance, 2) ?></td>
                                                <td><?= number_format($lrow->totalAmount + $lrow->lateCharges, 2) ?></td>
                                                <td><?= $lrow->numOfDays ?></td>
                                                <td><?= number_format($lrow->interestAmount, 2) ?></td>
                                                <td><?= number_format($lrow->tdsPercent, 2) ?></td>
                                                <td><?= number_format($lrow->tdsAmount, 2) ?></td>
                                                <td><?= number_format($lrow->interestAmountPayble, 2) ?></td>
                                                <td><?= number_format($lrow->lateCharges, 2) ?></td>
                                                <td><?= $lrow->numOfDaysOfFine ?></td>
                                                <td><?= number_format($lrow->amount, 2) ?></td>
                                                <td><?= $lrow->tenureName ?></td>
                                                <td><?= $debitStatus ?></td>

                                            <?php }else if($filterType == 'due'){ ?>
                                                <td><?= number_format($lrow->amount,2) ?></td>
                                                <td><?= $openingdate ?></td>
                                                <td><?= $tenureDueDate ?></td>
                                                <td><?= number_format($lrow->openingBalanceLatest,2) ?></td>
                                                <?php $invNumber = ($lrow->invoiceNumber) ? $lrow->invoiceNumber : '';
                                                 if ($invNumber) { ?>
                                                    <td><a href="javascript:;" style="color:blue;" data-invoiceNumber="<?= $lrow->invoiceNumber ?>" data-invoiceFile="<?= $lrow->invoiceFile ?>" data-drawDownFormFile="<?= $lrow->drawDownFormFile ?>" id="rawFile<?= $lrow->id ?>" onclick="openInvFiles(<?= $lrow->id ?>);"><?= $invNumber ?></a></td>
                                                <?php   } else { ?>
                                                    <td></td>
                                                <?php  } ?>
                                                <td><?= $debitStatus ?></td>
                                            <?php } ?>
                                            <td><?= $applyDate ?></td>



                                        </tr>
                            <?php
                                    }
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php  }
        }
    }

    public function userDashboardHtml(Request $request)
    {
        $requestType = $request->requestType;
        $userloggedData = $this->isUserLoggedIn();
        if(isset($request->userId) && $request->userId) {
            $userId = $request->userId;
        }else{
            $userId = $userloggedData->id;
        }

        if ($requestType == 'application') {
            $this->getUserDashboardApplicationHtml($userId);
        } else if ($requestType == 'loanHistory') {
            $this->getUserDashboardLoanHistoryHtml();
        } else if ($requestType == 'changepass') {
            $this->getUserDashboardChangePasswordHtml();
        }
    }

    public function getUserDashboardApplicationHtml($userId)
    {
        if($userId){
            $userloggedData = User::whereId($userId)->first();
            $companyData = DB::table('employment_histories')->where(['userId' => $userId, 'status' => 'approved', 'companyType' => 'Pvt. Ltd.'])->first();
            $creditData = null;
            if ($userloggedData->creditscore_apidata) {
                $creditData = json_decode($userloggedData->creditscore_apidata, true);
            }
        }else{
            $userloggedData = $this->isUserLoggedIn();
        }
        $userId = $userloggedData->id;
        $userBankDtl = UserBankDetail::where('userId', $userId)->orderBy('id', 'desc')->first();
        $userDocDtl = UserDoc::where('userId', $userId)->orderBy('id', 'desc')->first();
        $otherKycDocs = OtherKycDoc::where('userId', $userId)->orderBy('id', 'ASC')->get();
        $userEmploymentHistoryArr = EmploymentHistory::where('userId', $userId)->where('fromAdmin', 0)->orderBy('id', 'desc')->get();
        $coApplicantDtlARR = CoApplicantDetail::where('userId', $userId)->orderBy('id', 'asc')->get();
        $userDocDtlKyc = LoanKycOtherPendetail::where('userId', $userId)->orderBy('id', 'desc')->get()
        ?>
        <div class="maindetails_cardd">
            <form action="">
                <div class="header__cstitle">
                    <h1>Your KYC Info</h1>
                </div>
                <div class="cscard__bodystart">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Name Title: </label>
                                        <span><?= $userloggedData->nameTitle ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Full Name: </label>
                                        <span><?= $userloggedData->name ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Email: </label>
                                        <span><?= $userloggedData->email ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Mobile Number: </label>
                                        <span><?= $userloggedData->mobile ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Date of Birth: </label>
                                        <span><?= (strtotime($userloggedData->dateOfBirth)) ? date('d M, Y', strtotime($userloggedData->dateOfBirth)) : '' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Gender: </label>
                                        <span><?= $userloggedData->gender ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Marital Status: </label>
                                        <span><?= $userloggedData->maritalStatus ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Religion: </label>
                                        <span><?= $userloggedData->religion ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for="">Education Status: </label>
                                        <span><?= $userloggedData->educationStatus ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Branch Name: </label>
                                        <span><?= $userloggedData->branchName ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Source Person Name: </label>
                                        <span><?= $userloggedData->sourcePerson ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Father Name: </label>
                                        <span><?= $userloggedData->fatherName ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Mother Name: </label>
                                        <span><?= $userloggedData->motherName ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for="">Address</label>
                                        <span><?= $userloggedData->addressLine1 ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for=""> Address Optional: </label>
                                        <span><?= $userloggedData->addressLine2 ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for="">City</label>
                                        <span><?= $userloggedData->city ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for="">District: </label>
                                        <span><?= $userloggedData->district ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for="">State:</label>
                                        <span><?= $userloggedData->state ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for="">PinCode:</label>
                                        <span><?= $userloggedData->pincode ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for="">Aadhaar Number:</label>
                                        <span><?= $userloggedData->aadhaar_no ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mr_removecol">
                                    <div class="form-group ">
                                        <label for="">PAN Number:</label>
                                        <span><?= $userloggedData->pancard_no ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    
                </div>
            </form>
        </div>
        <form action="" class="my-3">
            <div class="header__cstitle">
                <h1>Beureu Reports</h1>
            </div>
            <div class="cscard__bodystart">
                <div class="row">
                    <?php if(isset($creditData)) {  ?>
                        <div class="col-lg-12">
                            <div class="card" id="orderList_header">
                                <div class="card-header  border-0">
                                    <div class="my-2 d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1" style="width: 30%;">Customer Credit Score : <?= $userloggedData->credit_score; ?></h5>
                                        <div class="flex-shrink-0" style="text-align: right;width: 70%;">
                                            <?php if ((!$creditData && $userloggedData->viewKycDetails) || isset($creditData['Error'])) { ?> <a class="btn btn-primary btn-sm" href="<?= route('equifaxReport', ['user_id' => $userId]) ?>?loadreport=1">Load Report</a> <?php } elseif ($creditData && isset($creditData['CCRResponse']['CIRReportDataLst'][0]['Error'])) { ?> <span class="text-dark">Response : </span> <?= $creditData['CCRResponse']['CIRReportDataLst'][0]['Error']['ErrorDesc'] ?> <?php } ?>
                                            <!-- <a href="{{ route('') }}" class="btn btn-secondary" >Close</a> -->
                                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <a href="javascript:void(0);"><button type="button" class="btn btn-primary">Print</button></a> -->
                                            <?php if ($userloggedData->credit_score) { ?> <a href="<?= route('equifaxReport', ['user_id' => $userId]) ?>?type=user"><button type="button" class="btn btn-primary btn-sm">View Report</button></a> <?php } ?>
                                            
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
                                        <h5 class="card-title mb-0 flex-grow-1" style="width: 30%;">Customer Partner <?= $kk+1 ?> Credit Score : <?= $ukyc->credit_score; ?></h5>
                                        <div class="flex-shrink-0" style="text-align: right;width: 70%;">
                                            <?php if ($ukyc->credit_score) { ?> <a href="<?= route('equifaxReport', ['user_id' => $ukyc->id]) ?>?type=partner"><button type="button" class="btn btn-primary btn-sm">View Partner <?= $kk+1 ?> Report </button></a> <?php } ?>
                                            <?php if ((!$creditData) || isset($creditData['Error'])) { ?> <a class="btn btn-primary btn-sm" href="<?= route('equifaxReport', ['user_id' => $ukyc->id]) ?>?loadreport=3&type=partner">Load Partner <?= $kk+1 ?> Report</a> <?php } elseif ($creditData && isset($creditData['CCRResponse']['CIRReportDataLst'][0]['Error'])) { ?> <span class="text-dark">Response : </span> <?= $creditData['CCRResponse']['CIRReportDataLst'][0]['Error']['ErrorDesc'] ?> <?php } ?>
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
                                            <h5 class="card-title mb-0 flex-grow-1"  style="width: 30%;">Company Credit Score : <?= $companyData->company_credit_score; ?></h5>
                                            <div class="flex-shrink-0" style="text-align: right;width: 70%;">
                                                <?php if ((!$companyCreditData && $userloggedData->viewKycDetails) || isset($companyCreditData['Error'])) { ?> <a class="btn btn-primary btn-sm" href="<?= route('equifaxReport', ['user_id' => $userId]) ?>?loadreport=2">Load Report</a> <?php } elseif ($companyCreditData && isset($companyCreditData['CCRResponse']['CIRReportDataLst'][0]['Error'])) { ?> <span class="text-dark">Response : </span> <?= $companyCreditData['CCRResponse']['CIRReportDataLst'][0]['Error']['ErrorDesc'] ?> <?php } ?>
                                                <!-- <a href="{{ route('') }}" class="btn btn-secondary" >Close</a> -->
                                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <a href="javascript:void(0);"><button type="button" class="btn btn-primary">Print</button></a> -->
                                                <?php if ($companyData->company_credit_score) { ?> <a href="<?= route('equifaxReport', ['user_id' => $userId]) ?>?type=company"><button type="button" class="btn btn-primary btn-sm">View Report</button></a> <?php } ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        <?php } }else{ ?>
                            No Report Found
                        <?php } ?>
                </div>
            </div>
        </form>
        <div class="maindetails_cardd">
        <?php if (count($coApplicantDtlARR)) { ?>
            <form action="">
                <div class="header__cstitle">
                    <h1>Guarantor Info</h1>
                </div>
                <div class="cscard__bodystart">
                    
                        <?php foreach ($coApplicantDtlARR as $coApplicantDtl) { ?>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Name Title: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->nameTitleCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Full Name: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->customerNameCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Date of Birth: </label>
                                                <span><?= (strtotime($coApplicantDtl->dateOfBirthCoApp)) ? date('d/m/Y', strtotime($coApplicantDtl->dateOfBirthCoApp)) : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Gender: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->genderCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Marital Status: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->maritalStatusCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Religion: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->religionCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">

                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Education Status: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->educationStatusCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Father Name: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->fatherNameCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Mother Name: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->motherNameCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Relation With Applicant: </label>
                                                <span><?= (!empty($coApplicantDtl)) ? $coApplicantDtl->relationWithApplicantCoApp : 'NA' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                     ?>
                </div>
            </form>
            <?php } ?>
        </div>
        <div class="maindetails_cardd">
        <?php if (count($userEmploymentHistoryArr)) { ?>
            <form action="">
                <div class="header__cstitle">
                    <h1>Business/Company Details</h1>
                    <!-- <a href="##"  class="btngreenasuccess"> <button type="button" class="commonbntstyle"> <i class="fa-solid fa-plus"></i> Add New Co-Applicant</button></a> -->
                </div>
                <div class="cscard__bodystart">
                    
                        <?php foreach ($userEmploymentHistoryArr as $userEmploymentHistory) { ?>
                            <div class="row">
                            <div class="col-lg-12" style="text-align: center;background: #455298 !important;color: #fff;padding: 10px;margin-bottom: 6px;border-radius: 10px;">
                                <?=($userEmploymentHistory->isBusiness==1) ? 'Business Details' : 'Company Details'?>
                            </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for="">Company Name: </label>
                                                <span><?= $userEmploymentHistory->employerName ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for="">Company Email: </label>
                                                <span><?= $userEmploymentHistory->emailId ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for="">Company Phone: </label>
                                                <span><?= $userEmploymentHistory->mobileNo ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <?php if ($userEmploymentHistory->isBusiness == 1) { ?>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group ">
                                                    <label for="">Telephone No.: </label>
                                                    <span><?= $userEmploymentHistory->companyTeleNo ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group ">
                                                    <label for="">Fax No.: </label>
                                                    <span><?= $userEmploymentHistory->companyFaxNo ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group ">
                                                    <label for=""> Pan Number </label>
                                                    <span><?= $userEmploymentHistory->companyPan ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group ">
                                                    <label for=""> GSTIN </label>
                                                    <span><?= $userEmploymentHistory->companyGstin ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else {  ?>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group ">
                                                    <label for="">Total Experience In Current Company: </label>
                                                    <span><?= $userEmploymentHistory->totalExpInCurrentCompany ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group ">
                                                    <label for="">Current Salary : </label>
                                                    <span><?= $userEmploymentHistory->currentSalary ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php   } ?>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Company Type </label>
                                                <span><?= $userEmploymentHistory->companyType ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Address </label>
                                                <span><?= $userEmploymentHistory->address ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> District </label>
                                                <span><?= $userEmploymentHistory->district ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> State </label>
                                                <span><?= $userEmploymentHistory->state ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mr_removecol">
                                            <div class="form-group ">
                                                <label for=""> Pincode </label>
                                                <span><?= $userEmploymentHistory->pincode ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php } ?>
                </div>
            </form>
            <?php } ?>
        </div>
        <div class="maindetails_cardd">
            <?php if (!empty($userBankDtl)) { ?>
                <form action="">
                    <div class="header__cstitle">
                        <h1>Customer Bank Information</h1>
                        <!-- <a href="##"  class="btngreenasuccess"> <button type="button" class="commonbntstyle"> <i class="fa-solid fa-plus"></i> Add New Co-Applicant</button></a> -->
                    </div>
                    <div class="cscard__bodystart">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group ">
                                            <label for=""> Account Holder Name: </label>
                                            <span><?= $userBankDtl->accountHolderName ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group ">
                                            <label for=""> Bank Name: </label>
                                            <span><?= $userBankDtl->bankName ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group ">
                                            <label for=""> IFSC: </label>
                                            <span><?= $userBankDtl->ifscCode ?></span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                                <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group ">
                                            <label for=""> Account Type: </label>
                                            <span><?= $userBankDtl->accountType ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group ">
                                            <label for=""> Account Number:</label>
                                            <span><?= $userBankDtl->accountNumber ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group ">
                                            <label for=""> Address: </label>
                                            <span><?= $userBankDtl->address ?></span>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="col-lg-4">
                            <div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group ">
                                            <label for=""> City: </label>
                                            <span><?= $userBankDtl->city ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group ">
                                            <label for=""> State: </label>
                                            <span><?= $userBankDtl->state ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mr_removecol">
                                        <div class="form-group ">
                                            <label for=""> Pin Code: </label>
                                            <span><?= $userBankDtl->pincode ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
        <div class="maindetails_cardd mb-5">
            <?php if (!empty($userDocDtl)) { ?>
                <form action="">
                    <div class="header__cstitle">
                        <h1>KYC</h1>
                        <!-- <a href="##"  class="btngreenasuccess"> <button type="button" class="commonbntstyle"> <i class="fa-solid fa-plus"></i> Add New Co-Applicant</button></a> -->
                    </div>
                    <div class="cscard__bodystart">
                        <div class="row gallery-wrappernew">
                        <?php if($userDocDtl->idProofFront || $userDocDtl->idProofBack){ ?>
                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="document_title_new">Photo of Emp identity Card</div>
                                </div>
                                
                                <div class="row">
                                    <?php if($userDocDtl->idProofFront){ ?>
                                    <div class="col-lg-6">
                                        <div class="card documents__cardsitems">
                                            <div class="document__imgg">
                                                <img src="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->idProofFront : '' ?>" class="card-img-top" alt="...">
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title">Front</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if($userDocDtl->idProofBack){ ?>
                                    <div class="col-lg-6">
                                        <div class="card documents__cardsitems">
                                            <div class="document__imgg">
                                                <img src="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->idProofBack : '' ?>" class="card-img-top" alt="...">
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title">Back</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="document_title_new">Photo of Address Proof </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card documents__cardsitems">
                                            <div class="document__imgg">
                                                <img src="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->addressProofFront : '' ?>" class="card-img-top" alt="...">
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title">Front</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card documents__cardsitems">
                                            <div class="document__imgg">
                                                <img src="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->addressProofBack : '' ?>" class="card-img-top" alt="...">
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title">Back</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 <?php if($userDocDtl->idProofFront && $userDocDtl->idProofBack){ ?> mt-4 <?php } ?>">
                                <div class="col-lg-12">
                                    <div class="document_title_new <?php if($userDocDtl->idProofFront && $userDocDtl->idProofBack){ ?> mt-4 <?php } ?>">Photo of Pan Card</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card documents__cardsitems">
                                            <div class="document__imgg">
                                                <img src="<?= (!empty($userDocDtl)) ? env('APP_URL') . 'public/' . $userDocDtl->panCardFront : '' ?>" class="card-img-top" alt="...">
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title">Front</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 <?php if($userDocDtl->idProofFront && $userDocDtl->idProofBack){ ?> mt-4 <?php } ?>">
                                <div class="col-lg-12">
                                    <div class="document_title_new <?php if($userDocDtl->idProofFront && $userDocDtl->idProofBack){ ?> mt-4 <?php } ?>">Photo/PDF of Bank Statement</div>
                                </div>
                                <?php
                                $bankdoc = '';
                                $bankAttachemet = '';
                                if (!empty($userDocDtl->bankAttachemet)) {
                                    $bankAttachemetArr = explode('.', $userDocDtl->bankAttachemet);
                                    if (strtolower($bankAttachemetArr[1]) == 'pdf') {
                                        $bankdoc = 'pdf';
                                        $bankAttachemet = '<a href="' . env('APP_URL') . 'public/' . $userDocDtl->bankAttachemet . '" class="btn btn-danger" target="_blank">View PDF</a>';
                                    } else {
                                        $bankAttachemet = '<img class="gallery-img img-fluid mx-auto" src="' . env('APP_URL') . 'public/' . $userDocDtl->bankAttachemet . '" alt="">';
                                    }
                                }
                                ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card documents__cardsitems">
                                            <div class="document__imgg">
                                                <a href="<?= env('APP_URL') . 'public/' . $userDocDtl->bankAttachemet ?>" target="_blank" class="viewpdf_btn"><button type="button" class="commonbntstyle">View
                                                        PDF</button></a>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title">Bank Statement </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="col-lg-12">
                                    <div class="document_title_new mt-4">Others documents </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card documents__cardsitems" id="otherdoc__box">
                                            <div class="document__imgg">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Document name</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (count($otherKycDocs)) { ?>
                                                            <?php foreach ($otherKycDocs as $kk => $otherRow) { ?>
                                                                <tr>
                                                                    <th scope="row">(<?php echo ($kk + 1); ?>)</th>
                                                                    <td><?= $otherRow->title ?></td>
                                                                    <td>
                                                                        <a class=" view_documentss" title="" target="_blank" href="<?= (!empty($otherRow->docsUrl)) ? env('APP_URL') . 'public/' . $otherRow->docsUrl : '' ?>">
                                                                            <i data-feather="eye" class="fa fa-eye text-primary"></i>
                                                                            View Document
                                                                        </a>

                                                                    </td>
                                                                </tr>
                                                        <?php }
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                        </div>
                        <?php  if($userDocDtlKyc){ ?>
                        <div class="row gallery-wrapper mt-4">
                            
                            <div class="col-lg-6">
                            <?php if(isset($userDocDtlKyc[0])){ ?>
                                <div class="col-lg-12">
                                    <div class="document_title_type">Partner 1 Pancard</div>
                                </div>
                                
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
                            <?php if(isset($userDocDtlKyc[1])){ ?>
                                <div class="col-lg-12">
                                    <div class="document_title_type">Partner 2 Pancard</div>
                                </div>
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
                                                $bankAttachemet .= '';
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
                    </div>
                </form>
            <?php } ?>
        </div>
    <?php
        /*
        <a href="" class="deletedocuments"
                                                                                onclick="deleteOtherDocuments('<?= $otherRow->id ?>')"><i
                                                                                    class="fa-solid fa-trash-can"></i>
                                                                                Delete</a> */
    }

    public function getUserDashboardLoanHistoryHtml()
    {
        $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();

        $tenures = Tenure::where('loanCategory', 3)->orderBy('sortOrder', 'ASC')->get();
    ?>
        <div class="tab-pane fade show active text-left text-light" id="loanHistory" role="tabpanel" aria-labelledby="loan-tab">
            <div class="tb_head">
                <h1>Loan History</h1>
            </div>

            <div class="tabs active" id="loanhis_tabsin">
                <?php
                if (count($categories)) {
                    foreach ($categories as $crow) {
                        echo '<input type="radio" name="tabs" id="tabone' . $crow->id . '" >
                                <label for="tabone' . $crow->id . '" onclick="getLoanHistoryByUser(' . $crow->id . ');">' . $crow->name . '</label>';
                    }
                }
                ?>
            </div>
            <div class="tab">
                <section class="filters_table" id="loanHistoryHtml">

                </section>
            </div>
        </div>
    <?php
    }

    public function getUserDashboardChangePasswordHtml()
    {
    ?>
        <div class="tab-pane fade show active text-left text-light" id="changepass" role="tabpanel" aria-labelledby="pass-tab">
            <div class="tb_head">
                <h1>Change Password</h1>
            </div>
            <div class="card p-4 sm:p-5">
                <form action="">
                    <div class="grid  editform_start">
                        <label class="block">
                            <span>Old Password</span>
                            <span class="relative mt-1.5 flex">
                                <input id="oldPassword" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Old Password" type="password">
                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <i class="fa-regular fa-user text-base"></i>
                                </span>
                            </span>
                        </label>

                    </div>
                    <div class="grid  editform_start">
                        <label class="block">
                            <span>New Password</span>
                            <span class="relative mt-1.5 flex">
                                <input id="newPassword" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="New Password" type="password">
                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <i class="fa-regular fa-user text-base"></i>
                                </span>
                            </span>
                        </label>

                    </div>
                    <div class="grid  editform_start">
                        <label class="block">
                            <span>Confirm New Password</span>
                            <span class="relative mt-1.5 flex">
                                <input id="newPasswordC" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Confirm New Password" type="password">
                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <i class="fa-regular fa-user text-base"></i>
                                </span>
                            </span>
                        </label>

                    </div>

                    <div class="saveform_btn col-md-4">
                        <button type="button" id="changePasswordBtn" class="btn btn-primary bg-primary btn-lg" onclick="changePassword();">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }

    public function applyNow()
    {
        $userloggedData = $this->isUserLoggedIn();
        $userId = $userloggedData->id;
        

        $userBankDtl = UserBankDetail::where('userId', $userId)->orderBy('id', 'desc')->first();
        $userDocDtl = UserDoc::where('userId', $userId)->orderBy('id', 'desc')->first();
        $otherKycDocs = LoanKycOtherPendetail::where('userId', $userId)->orderBy('id', 'ASC')->get();

        $coApplicantDtl = CoApplicantDetail::where('userId', $userId)->orderBy('id', 'asc')->first();

        $loanData = DB::table('apply_loan_histories')->where('userId', $userId)->where('status', 'pending')->first();
        $empHistory = EmploymentHistory::where('userId', $userId)->first();

        $personaloan = DB::table('apply_loan_histories')->where('loanCategory',2)->where('status','!=','pending')->where('userId',$userId)->count() ?? 0;
        $nonpersonaloan = DB::table('apply_loan_histories')->where('loanCategory','!=',2)->where('status','!=','pending')->where('userId',$userId)->count() ?? 0;

        // dd();

        // if($personaloan == 0 && $nonpersonaloan == 0){
            $category = Category::where(['status' => 1])->orderBY('name', 'asc')->get();
        // }else if($personaloan > 0){
        //     $category = Category::where('status',"1")->where("id",2)->orderBY('name', 'asc')->get();
        // }else{
        //     $category = Category::where('status',"1")->where("id","!=",2)->orderBY('name', 'asc')->get();
        // }

        // dd($userloggedData);

        // if($_SERVER['REMOTE_ADDR'] == "122.161.49.21"){
        //     dd(session()->all());
        // }
        // if(session()->get('done') == 1){
        //     session()->forget('step');
        // }
        // dd(session()->all());
        $indiaStates=$this->indianStates;
        

        return view('web.apply-now', compact('category', 'userloggedData', 'userBankDtl', 'userDocDtl', 'otherKycDocs', 'coApplicantDtl', 'empHistory', 'loanData','indiaStates'));
    }

    public function initiateApplyLoanWeb(Request $request)
    {
        $userId = auth()->user()->id;
        $loanType = $request->catId;
        $pageNameStr = 'apply-loan';
        $categories = Category::where(['status' => 1])->get();
        $tenures = Tenure::where(['status' => 1])->orderBy('sortOrder', 'ASC')->get();
        $loanDetails = DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.userId='$userId' ORDER BY alh.id DESC");

        $loanData = DB::table('apply_loan_histories')->where('userId', $userId)->where('status', 'pending')->first();

        $htmlStr = '';

        if ($pageNameStr) {

            $productStyle = '';
            $invoiceStyle = 'style="display:none"';
            $validDateStyle = 'style="display:none"';
            $tenureStyle = '';
            $roiTypeStyle = '';
            $invoiceText = '';
            $productStr = '<option value="">Select</option>';
            if ($loanType == 3 || $loanType == 4) {
                $productStyle = 'style="display:none"';
                $roiTypeStyle = 'style="display:none"';

                $invoiceStyle = '';
                if ($loanType == 3) {
                    $validDateStyle = '';
                }
                $invoiceText = ($loanType == 3) ? 'Bill' : 'Invoice';
            }

            $products = Product::where(['categoryId' => $loanType, 'status' => 1])->orderBy('productName', 'ASC')->get();
            if (count($products)) {
                foreach ($products as $prow) {
                    if ($loanData && $loanData->productId == $prow->id) {
                        $productStr .= '<option value="' . $prow->id . '" selected>' . $prow->productName . '</option>';
                    } else {
                        $productStr .= '<option value="' . $prow->id . '">' . $prow->productName . '</option>';
                    }
                }
            }


            $tenureStr = '<option value="">Select</option>';
            $tenures = Tenure::where(['loanCategory' => $loanType, 'status' => 1])->orderBy('sortOrder', 'ASC')->get();
            if (count($tenures)) {
                foreach ($tenures as $trow) {
                    if ($loanData && $loanData->approvedTenure == $trow->id) {
                        $tenureStr .= '<option selected value="' . $trow->id . '">' . $trow->name . '</option>';
                    } else {

                        $tenureStr .= '<option value="' . $trow->id . '">' . $trow->name . '</option>';
                    }
                }
            }


            
            $htmlStr .= '<div class="row">';
            if($loanType != 2){
                $htmlStr .= '<div class="col-md-6 productNameHtml" ' . $productStyle . '>
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <select id="productName" name="productName" class="contact-one__form-input " >
                                      ' . $productStr . '
                                    </select>
                                    <span id="step1_productName" class="text-danger error__hh "></span>
                                   

                                </div><!-- /.form-group-->
                            </div>';
            }
                            if($loanType != 3){
                                $htmlStr .= '<div class="col-md-6" id="invoiceFileHtml" ' . $invoiceStyle . '>
                                <div class="form-group">
                                    <label id="invoiceFileLabel">Upload ' . $invoiceText . ' </label>
                                    <input type="file" id="invoiceFile" name="invoiceFile" class="form-control">
                                    <span id="step1_invoiceFile" class="text-danger error__hh"></span>
                                </div><!-- /.form-group-->
                            </div>';
                            

                           
                            $htmlStr .= '<div class="col-md-6 roiTypeHtml" ' . $roiTypeStyle . '>
                                <div class="form-group">
                                    <label>ROI Type</label>
                                    <select onChange="roiTypeSele(this)" id="roiType" name="roiType" class="contact-one__form-input "  >';

                            $htmlStr .= '<option value="">Select</option>';
                            if ($loanType != 8) {
                                $htmlStr .= '<option ';
                                if ($loanData && $loanData->roiType == "reducing_roi") {
                                    $htmlStr .= 'selected';
                                }
                                $htmlStr .= ' value="reducing_roi">Reducing ROI</option>';
                            }
                            $htmlStr .= '<option ';
                            if ($loanData && $loanData->roiType == "fixed_interest_roi") {
                                $htmlStr .= 'selected';
                            }
                            $htmlStr .= ' value="fixed_interest_roi">Fixed Interest ROI</option>';

                            $htmlStr .= '<option ';
                            if ($loanData && $loanData->roiType == "quaterly_interest") {
                                $htmlStr .= 'selected';
                            }
                            $htmlStr .= ' value="quaterly_interest">Quarterly Interest</option>';
                            if ($loanType != 3) {
                                $htmlStr .= '<option ';
                                if ($loanData && $loanData->roiType == "bullet_repayment") {
                                    $htmlStr .= 'selected';
                                }
                                $htmlStr .= ' value="bullet_repayment">Bullet Repayment</option>';
                            }
                            $htmlStr .= ' </select>
                                   <span id="step1_roiType" class="text-danger error__hh"></span>
                                </div><!-- /.form-group-->
                            </div>';
                            }
                            $htmlStr .= '<div class="col-md-6 roiTenureHtml" ' . $tenureStyle . '>
                                <div class="form-group">
                                    <label>Tenure</label>
                                    <select id="approveTenure" name="approveTenure"  class="contact-one__form-input " >
                                        ' . $tenureStr . '
                                    </select>
                                    <span id="step1_approveTenure" class="text-danger error__hh"></span>
                                </div><!-- /.form-group-->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Loan Amount </label>
                                    <input type="number" id="approvedAmount" onkeypress="javascript:return isNumber(event)" name="approvedAmount" value="';
            if ($loanData && $loanData->approvedAmount) {
                $htmlStr .= $loanData->approvedAmount;
            }
            $htmlStr .= '" class="form-control contact-one__form-input" placeholder="Enter Amount" >
                                    <span id="step1_approvedAmount" class="text-danger error__hh"></span>
                                </div><!-- /.form-group-->
                            </div>';
                            // if($loanType != 3){
            //                     <div class="col-md-6">
            //                     <div class="form-group">
            //                         <label>ROI % </label>
            //                         <select id="approvedRoi" name="approvedRoi" class="contact-one__form-input "  >';
            // $htmlStr .= '<option value="">Select</option>';
            // for ($roi = 18; $roi <= 30; $roi++) {
            //     $htmlStr .= '<option ';
            //     if ($loanData && $loanData->rateOfInterest == $roi) {
            //         $htmlStr .= 'selected';
            //     }
            //     $htmlStr .= ' value="' . $roi . '">' . $roi . ' %</option>';
            // }
            // $htmlStr .= ' </select>
            //                        <span id="step1_approvedRoi" class="text-danger error__hh"></span>
            //                     </div><!-- /.form-group-->
            //                 </div>
                            
            //                 $htmlStr .='<div class="col-md-6 validFromDateHtml" ' . $validDateStyle . '>
            //                     <div class="form-group">
            //                         <label>Valid From </label>
            //                         <input type="date" id="validFromDate" name="validFromDate" value="';
            // if ($loanData && $loanData->validFromDate) {
            //     $htmlStr .= $loanData->validFromDate;
            // }
            // $htmlStr .= '" class="form-control contact-one__form-input" placeholder="Enter Name" >
            //                         <span id="step1_validFromDate" class="text-danger error__hh"></span>
            //                     </div><!-- /.form-group-->
            //                 </div>
            //                 <div class="col-md-6 validToDateHtml" ' . $validDateStyle . '>
            //                     <div class="form-group">
            //                         <label>Valid To</label>
            //                         <input type="date" id="validToDate" name="validToDate" value="';
            // if ($loanData && $loanData->validToDate) {
            //     $htmlStr .= $loanData->validToDate;
            // }
            // $htmlStr .= '" class="form-control contact-one__form-input" placeholder="Enter Email" >
            //                         <span id="step1_validToDate" class="text-danger error__hh"></span>
            //                     </div><!-- /.form-group-->
            //                 </div>

            //             </div>';
        // }
        }


        if ($htmlStr) {
            echo json_encode(['status' => 'success', 'message' => 'Loan Details.', 'data' => $htmlStr]);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unable to process your request, Please try again.']);
            exit;
        }
    }

    public function webUserLoginCheck(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        $userDtl = DB::select("SELECT u.* FROM users u WHERE u.email='$email' AND u.password='$password' AND u.status=1 AND userType='user'");
        if (count($userDtl)) {
            $userId = $userDtl[0]->id;
            $loggedIn = Auth::loginUsingId($userId, true);

            if ($loggedIn) {
                session()->forget('step');
                echo json_encode(['status' => 'success', 'message' => 'You have logged-in successfully.', 'URL' => route('userDashboard')]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid credentials, Please try again.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid credentials, Please try again.']);
        }
    }

    public function saveCustomerInfoWebSignUp(Request $request)
    {

        $customerEmail = $request->email;
        $mobileNumber = $request->mobileNumber;
        $EXISTCHKSUBQRY = "";

        $emailExist = DB::select("SELECT * FROM users WHERE email='$customerEmail' $EXISTCHKSUBQRY");
        if (count($emailExist)) {
            echo json_encode(['status' => 'error', 'message' => 'This emailid is already registered with us.']);
            exit;
        }

        $mobileExist = DB::select("SELECT * FROM users WHERE mobile='$mobileNumber' $EXISTCHKSUBQRY");
        if (count($mobileExist)) {
            echo json_encode(['status' => 'error', 'message' => 'This mobile number is already registered with us.']);
            exit;
        }

        $saveUp['customerCode'] = $this->generateCustomerCode();


        $saveUp['nameTitle'] = '';
        $saveUp['name'] = $request->name;
        $saveUp['email'] = $request->email;
        $saveUp['mobile'] = $mobileNumber;
        $saveUp['userType'] = 'user';
        $saveUp['registeredBy'] = 'web';
        $saveUp['password'] = md5($request->password);

        $saveUp['status'] = '1';

        $saveUp['kycStatus'] = 'pending';
        $saveUp['created_at'] = date('Y-m-d H:i:s');
        $saveUp['updated_at'] = date('Y-m-d H:i:s');

        $initialConcentData = 'We agree to submit, sign and execute all such agreements and other docs as may be prescribed and required by Maxemo Capital Services Pvt. Ltd. 
    We also authorize, Maxemo Capital and agree not to hold Maxemo responsible for any disclosure at any time of any information relating to Me/Firm and our facilities including to repayment history, defaults in payment to credit bureaus, Banks, financial institutions and or any third party engaged by Maxemo Capital. I/we hereby acknowledge and authorize Maxemo, its affiliates and associate financing partners to conduct necessary due diligence with respect to my application, as per their process including CIBIL/other necessary bureau checks of the applicant, its promoters, directors/partners and/or key managerial personnels.';

        $saveUp['initialConcentData'] = $initialConcentData;

        $save = DB::table('users')->insertGetId($saveUp);

        $loggedIn = Auth::loginUsingId($save, true);
        $acceptURL = route('acceptConsentByCustomer', [1, md5($save)]);
        $rejectURL = route('acceptConsentByCustomer', [2, md5($save)]);

        $htmlSt = '<div>
                        <p>Dear ' . $request->name . ',</p>
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
        $toMail = $request->email;
        $toUser = $request->name;
        $subject = 'Need Approval For Consent ' . $verifyWith;



        AppServiceProvider::sendMail($toMail, $toUser, $subject, $htmlSt);

        $htmlStAdmin = '<div>
                    <p>Dear Admin,</p>
                    <table style="width:100%;">
                    <tr>
                        <td colspan="2">' . $request->name . ' (' . $saveUp['customerCode'] . ') has been onboard on maxemo software.</td>
                    </tr>
                    <tr>
                    
                    </tr>
                    
                    </table>
                <div><br/><br/><br/></div></div>';

                if(config('app.env') == "production"){
         AppServiceProvider::sendMail("info@maxemocapital.com", "Info Maxemo", "New Customer Onboard | " . $verifyWith, $htmlStAdmin);
         AppServiceProvider::sendMail("shorya.mittal@maxemocapital.com", "Shorya Mittal", "New Customer Onboard | " . $verifyWith, $htmlStAdmin);
         AppServiceProvider::sendMail("vipul.mittal@maxemocapital.com", "Vipul Mittal", "New Customer Onboard | " . $verifyWith, $htmlStAdmin);
         AppServiceProvider::sendMail("vivek.mittal@maxemocapital.com", "Vivek Mittal", "New Customer Onboard | " . $verifyWith, $htmlStAdmin);
                }else{
        AppServiceProvider::sendMail("raju@techmavesoftware.com","Raju", "New Customer Onboard | " . $verifyWith, $htmlStAdmin);
        AppServiceProvider::sendMail("basant@techmavesoftware.com","Basant", "New Customer Onboard | " . $verifyWith, $htmlStAdmin);
                }
        if ($save) {
            echo json_encode(['status' => 'success', 'message' => 'Congratulations you have registered successfully.', 'userId' => $save, 'URL' => route('userDashboard')]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
        }
    }

    public function generateCustomerCode()
    {
        $customerRes = DB::select("select id,customerCode from users where customerCode IS NOT NULL AND customerCode !='' AND userType='user' order by id desc limit 1");
        if (count($customerRes)) {
            $customerCodeOld = $customerRes[0]->customerCode;
            $customerCodeOldNew = (int)str_replace(env('CID_PRE'), '', $customerCodeOld);
            if ($customerCodeOldNew < 10) {
                $customerCodeInt = $customerCodeOldNew + 1;
                $customerCode = env('CID_PRE') . '00000' . $customerCodeInt;
            } else if ($customerCodeOldNew < 100) {
                $customerCodeInt = $customerCodeOldNew + 1;
                $customerCode = env('CID_PRE') . '0000' . $customerCodeInt;
            } else if ($customerCodeOldNew < 1000) {
                $customerCodeInt = $customerCodeOldNew + 1;
                $customerCode = env('CID_PRE') . '000' . $customerCodeInt;
            } else if ($customerCodeOldNew < 10000) {
                $customerCodeInt = $customerCodeOldNew + 1;
                $customerCode = env('CID_PRE') . '00' . $customerCodeInt;
            } else if ($customerCodeOldNew < 100000) {
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

    public function changePasswordWeb(Request $request)
    {
        $userId = auth()->user()->id;
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $newPasswordC = $request->newPasswordC;
        if (!$oldPassword || !$oldPassword || !$oldPassword) {
            echo json_encode(['status' => 'error', 'message' => 'Required parameters missing, Please try again.']);
            exit;
        } else if ($newPassword != $newPasswordC) {
            echo json_encode(['status' => 'error', 'message' => 'Confirm password not matched.']);
            exit;
        } else {
            $ifValid = User::where(['id' => $userId, 'password' => md5($oldPassword)])->first();
            if (!empty($ifValid)) {
                $save = User::where(['id' => $userId, 'password' => md5($oldPassword)])->update(['password' => md5($newPassword)]);
                if ($save) {
                    echo json_encode(['status' => 'success', 'message' => 'Your password has been changed successfully.']);
                    exit;
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.']);
                    exit;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Old password is invalid, Please try again.']);
                exit;
            }
        }
    }

    public function saveApplyLoanByWebUser(Request $request)
    {
        $recordId = auth()->user()->id;

        $customer = $this->saveCustomerInfoPrivate($request);
        $saveApplicant = $this->saveCoApplicantInfoPrivate($request);
        $saveKyc = $this->saveKycDetailsPrivate($request);
        $saveProfesional = $this->saveProfessionalDetailsPrivate($request);
        $saveBank = $this->saveUserBankDetailsPrivate($request);
        $applyLoan = $this->applyLoanByWebUserPrivate($request);

        $save = 0;
        if ($customer && $saveApplicant && $saveKyc && $saveProfesional && $applyLoan) {
            $save = 1;
        }

        $returnArr = ['customer' => $customer, 'saveApplicant' => $saveApplicant, 'saveKyc' => $saveKyc, 'saveProfessional' => $saveProfesional, 'saveBank' => $saveBank, 'applyLoan' => $applyLoan];
        if ($save) {
            $loanId = env('LOANID_PRE') . $applyLoan;
            $mobileNumber = $request->customerPhone;

            if(config('app.env') == "production"){
            $textMessage = 'Thank You for your Loan Application ' . $loanId . '. We will contact you shortly to take it further. For queries call us on our helpline number or visit www.maxemocapital.com -Team Maxemo';
            AppServiceProvider::sendSms($mobileNumber, $textMessage);

            $textMessage = 'Your loan application no ' . $loanId . ' for business/personal loan of ' . number_format($request->approvedAmount, 2) . ' is under process and we will notify you shortly once it is approved - Team Maxemo';
            AppServiceProvider::sendSms($mobileNumber, $textMessage);
            }
            echo json_encode(['status' => 'success', 'message' => 'Your loan has been applied successfully.', 'data' => $returnArr]);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Some error occurred, Please try again.', 'data' => $returnArr]);
            exit;
        }
    }

    public function saveCustomerInfoPrivate(Request $request)
    {
        $recordId = auth()->user()->id;

        $customerPhone = $request->customerPhone ?? auth()->user()->mobile;
        $customerEmail = $request->customerEmail ?? auth()->user()->email;
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


        $image = '';
        if ($request->hasFile('profileImg')) {
            $image = AppServiceProvider::uploadImageCustom('profileImg', 'users');
        }
        // dd($image);
        $userState = explode('_',$request->state);
        $state = $userState[1] ?? $request->state;
        $short_state = $userState[0] ?? $request->state;

        $saveUp['nameTitle'] = $request->nameTitleCu;
        $saveUp['name'] = $request->customerName;
        $saveUp['email'] = $request->customerEmail??auth()->user()->email;
        $saveUp['mobile'] = $request->customerPhone??auth()->user()->mobile;
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
        $saveUp['aadhaar_no'] = $request->aadhaar_no ?? auth()->user()->aadhaar_no;
        $saveUp['pancard_no'] = $request->pancard_no ?? auth()->user()->pancard_no;
        $saveUp['religion'] = $request->religionCu;
        $saveUp['educationStatus'] = $request->educationStatusCu;
        $saveUp['fatherName'] = $request->fatherNameCu;
        $saveUp['motherName'] = $request->motherNameCu;
        $saveUp['sourcePerson'] = $request->sourcePerson;
        $saveUp['branchName'] = $request->branchName;
        //$saveUp['cibilScore']=$request->cibilScoreCu;

        if ($image) {
            $saveUp['profilePic'] = $image;
        }
        $saveUp['status'] = '1';
        //print_r($saveUp); exit;
        $saveUp['updated_at'] = date('Y-m-d H:i:s');
        $save = User::where('id', $recordId)->update($saveUp);

        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    public function saveCoApplicantInfoPrivate(Request $request)
    {

        $recordId = auth()->user()->id;
        $actionTrigger = $request->actionTrigger;

        $saveUp['userId'] = $recordId;
        $saveUp['nameTitleCoApp'] = $request->nameTitleCoApp;
        $saveUp['customerNameCoApp'] = $request->customerNameCoApp;
        $saveUp['genderCoApp'] = $request->genderCoApp;
        $saveUp['dateOfBirthCoApp'] = (strtotime($request->dateOfBirthCoApp)) ? date('Y-m-d', strtotime($request->dateOfBirthCoApp)) : NULL;
        $saveUp['religionCoApp'] = $request->religionCoApp;
        $saveUp['educationStatusCoApp'] = $request->educationStatusCoApp;
        $saveUp['fatherNameCoApp'] = $request->fatherNameCoApp;
        $saveUp['motherNameCoApp'] = $request->motherNameCoApp;
        $saveUp['maritalStatusCoApp'] = $request->maritalStatusCoApp;
        $saveUp['relationWithApplicantCoApp'] = $request->relationWithApplicantCoApp;
        //$saveUp['cibilScoreCoApp']=$request->cibilScoreCoApp;
        $saveUp['status'] = '1';

        if ($actionTrigger == 'save') {
            goto saveCoApplicantInfo;
        }

        $ifExist = CoApplicantDetail::where('userId', $recordId)->first();
        if (!empty($ifExist)) {

            $saveUp['updated_at'] = date('Y-m-d H:i:s');
            $save = CoApplicantDetail::where('userId', $recordId)->update($saveUp);
        } else {
            saveCoApplicantInfo:

            $saveUp['created_at'] = date('Y-m-d H:i:s');
            $saveUp['updated_at'] = date('Y-m-d H:i:s');
            $save = DB::table('co_applicant_details')->insertGetId($saveUp);
        }
        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    public function saveKycDetailsPrivate(Request $request)
    {
        $recordId = auth()->user()->id;

        $saveUp['userId'] = $recordId;

        //$lobObj=new GloadController();



        if (!empty($request->idProofFront) && !empty($request->idProofBack)) {
            $image = AppServiceProvider::uploadImageCustom('idProofFront', 'user-docs');
            $saveUp['idProofFront'] = $image;

            $image = AppServiceProvider::uploadImageCustom('idProofBack', 'user-docs');
            $saveUp['idProofBack'] = $image;

            //            $aadhaar=$lobObj->ocr_adhaar_verification(1);
            //            if(empty($aadhaar)){
            //                //echo json_encode(['status'=>'error','message'=>'Invalid id proof, Please try again.']); exit;
            //            }
            //print_r($aadhaar);exit;
        }

        if (!empty($request->panCardFront)) {
            $image = AppServiceProvider::uploadImageCustom('panCardFront', 'user-docs');
            $saveUp['panCardFront'] = $image;

            //            $pancheck=$lobObj->ocr_adhaar_verification(3);
            //            if(empty($pancheck)){
            //                //echo json_encode(['status'=>'error','message'=>'Invalid id proof, Please try again.']); exit;
            //            }
            //print_r($pancheck);exit;
        }

        if (!empty($request->addressProofFront)) {
            $image = AppServiceProvider::uploadImageCustom('addressProofFront', 'user-docs');
            $saveUp['addressProofFront'] = $image;
        }

        if (!empty($request->addressProofBack)) {
            $image = AppServiceProvider::uploadImageCustom('addressProofBack', 'user-docs');
            $saveUp['addressProofBack'] = $image;
        }

        if (!empty($request->salerySlip1)) {
            $image = AppServiceProvider::uploadImageCustom('salerySlip1', 'user-docs');
            $saveUp['salerySlip1'] = $image;
        }

        if (!empty($request->salerySlip2)) {
            $image = AppServiceProvider::uploadImageCustom('salerySlip2', 'user-docs');
            $saveUp['salerySlip2'] = $image;
        }

        if (!empty($request->salerySlip3)) {
            $image = AppServiceProvider::uploadImageCustom('salerySlip3', 'user-docs');
            $saveUp['salerySlip3'] = $image;
        }

        if (!empty($request->bankAttachemet)) {
            $image = AppServiceProvider::uploadImageCustom('bankAttachemet', 'user-docs');
            $saveUp['bankAttachemet'] = $image;
            $saveUp['bankAttachemetPwd'] = $request->bankPwd ?? null;
        }

        /*if(!empty($request->otherDocument)){
            $image=AppServiceProvider::uploadImageCustom('otherDocument','user-docs');
            $saveUp['otherDocument']=$image;
        }
        
        if(!empty($request->otherDocumentTitle)){
            $saveUp['otherDocumentTitle']=$request->otherDocumentTitle;
        }*/

        if (!empty($request->otherDocumentTitle)) {
            $otherDocumentTitle = $request->otherDocumentTitle;
            $docsUrlArr = AppServiceProvider::uploadImageCustomMulti('otherDocument', 'user-docs');

            if (count($docsUrlArr)) {
                $newSave = [];
                $osr = 0;
                $currentDate = date('Y-m-d H:i:s');
                foreach ($otherDocumentTitle as $otherRow) {
                    //print_r($docsUrlArr[$osr]);exit;
                    if ($otherRow) {
                        $newSave[] = ['userId' => $recordId, 'title' => $otherRow, 'docsUrl' => (isset($docsUrlArr[$osr])) ? $docsUrlArr[$osr] : '', 'created_at' => $currentDate, 'updated_at' => $currentDate];
                    }

                    $osr++;
                }
                //print_r($newSave);exit;
                OtherKycDoc::insert($newSave);
            }
        }


        $ifExist = UserDoc::where(['userId'=>$recordId])->first();

        if (!empty($ifExist)) {
            $saveUp['updated_at'] = date('Y-m-d H:i:s');
            $save = UserDoc::where('userId', $recordId)->update($saveUp);
        } else {
            $saveUp['created_at'] = date('Y-m-d H:i:s');
            $saveUp['updated_at'] = date('Y-m-d H:i:s');
            $save = DB::table('user_docs')->insertGetId($saveUp);
        }
        if ($save) {

            return true;
        } else {
            return false;
        }
    }

    public function saveProfessionalDetailsPrivate(Request $request)
    {
        $recordId = auth()->user()->id;
        $loanData = DB::table('apply_loan_histories')->where('userId', $recordId)->where('status', 'pending')->first();
        $loanCategory = $loanData->loanCategory;
        $isBusiness = 0;
        if ($loanCategory != 2) {
            $isBusiness = 1;
        }

        $saveUp['userId'] = $recordId;
        $saveUp['employerName'] = $request->employerName;
        $saveUp['companyTeleNo'] = ($isBusiness) ? $request->companyTeleNo : '';
        $saveUp['mobileNo'] = $request->companyMobileNo;
        $saveUp['emailId'] = $request->companyEmailId;
        $saveUp['companyFaxNo'] = ($isBusiness) ? $request->companyFaxNo : '';
        $saveUp['companyGstin'] = ($isBusiness) ? $request->companyGstin : '';
        $saveUp['companyPan'] = ($isBusiness) ? $request->companyPan : '';

        // $aadhaar=$lobObj->adhaar_verification($request->aadhaar_no);
        // if($aadhaar && $aadhaar->status != 1){
        //     echo json_encode(['status'=>'error','message'=>$aadhaar->msg]); exit;
        // }

        $saveUp['companyType'] = $request->companyType;
        $saveUp['state'] = $request->companyState;
        $saveUp['district'] = $request->companyDistrict;
        $saveUp['address'] = $request->companyAddress;
        $saveUp['pincode'] = $request->companyPincode;

        $saveUp['isBusiness'] = $isBusiness;
        $saveUp['totalExpInCurrentCompany'] = ($isBusiness == 0) ? $request->totalExpInCurrentCompany : '';
        $saveUp['currentSalary'] = ($isBusiness == 0) ? $request->currentSalary : '0';


        $ifExist = EmploymentHistory::where(['userId'=>$recordId,'isBusiness'=>$isBusiness])->exists();

        // dd($ifExist,$saveUp);
        //$this->saveCashFlowAnalysisInfo($request->all());
        if ($ifExist) {
            $saveUp['updated_at'] = date('Y-m-d H:i:s');
            $save = EmploymentHistory::where(['userId'=>$recordId,'isBusiness'=>$isBusiness])->update($saveUp);
        } else {
            $saveUp['status'] = 'pending';
            $saveUp['created_at'] = date('Y-m-d H:i:s');
            $saveUp['updated_at'] = date('Y-m-d H:i:s');
            $save = DB::table('employment_histories')->insertGetId($saveUp);
        }
        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    public function saveUserBankDetailsPrivate(Request $request)
    {
        $recordId = auth()->user()->id;

        $saveUp['userId'] = $recordId;
        $saveUp['accountHolderName'] = $request->accountHolderName;
        $saveUp['bankName'] = $request->bankName;
        $saveUp['ifscCode'] = $request->ifscCode;
        $saveUp['accountType'] = $request->accountType;
        $saveUp['accountNumber'] = $request->accountNumber;
        $saveUp['address'] = $request->bankAddress;
        $saveUp['state'] = $request->bankState;
        $saveUp['city'] = $request->bankCity;
        $saveUp['pincode'] = $request->bankPincode;


        $ifExist = UserBankDetail::where('userId', $recordId)->first();

        if (!empty($ifExist)) {
            $saveUp['updated_at'] = date('Y-m-d H:i:s');
            $save = UserBankDetail::where('userId', $recordId)->update($saveUp);
        } else {
            $saveUp['created_at'] = date('Y-m-d H:i:s');
            $saveUp['updated_at'] = date('Y-m-d H:i:s');
            $save = DB::table('user_bank_details')->insertGetId($saveUp);
        }

        if ($save) {
            return true;
        } else {
            return false;
        }
    }

    public function applyLoanByWebUserPrivate(Request $request)
    {
        $userId = auth()->user()->id;
        $productName = $request->productName;
        $loanCategory = $request->loanType;
        $approveTenure = ($request->approveTenure) ? $request->approveTenure : 0;
        $approvedAmount = $request->approvedAmount;
        $approvedRoi = $request->approvedRoi;
        $plateformFee = ($request->plateformFee) ? $request->plateformFee : 0;
        $insurance = ($request->insurance) ? $request->insurance : 0;
        $roiType = $request->roiType;

        $validFromDate = (strtotime($request->validFromDate)) ? date('Y-m-d', strtotime($request->validFromDate)) : '';
        $validToDate = (strtotime($request->validToDate)) ? date('Y-m-d', strtotime($request->validToDate)) : '';

        $validFromDateD = (strtotime($request->validFromDate)) ? date('d M, Y', strtotime($request->validFromDate)) : '';
        $validToDateD = (strtotime($request->validToDate)) ? date('d M, Y', strtotime($request->validToDate)) : '';

        $loanLastPending = ApplyLoanHistory::where(['status' => 'pending', 'userId' => $userId])->pluck('id')->first();

        $employmentDetails = EmploymentHistory::where(['userId' => $userId])->first();
        // if (!empty($employmentDetails) && $loanCategory == 1) {
        //     $companyGstin = trim(strtolower($employmentDetails->companyGstin));
        //     $companyGstinNew = str_replace(['na', 'n/a', ''], "", $companyGstin);
        //     if (empty($companyGstinNew)) {
        //         return json_encode(['status' => 'error', 'message' => 'GST number is mandatory for business loan.']);
        //         // exit;
        //     }
        // }

        $currentDate = date('Y-m-d H:i:s');

        $image = '';
        if (!empty($request->invoiceFile)) {
            $image = AppServiceProvider::uploadImageCustom('invoiceFile', 'invoice-loan');
        }

        $principleChargesArr['gst'] = 0;
        $principleChargesArr['premium'] = 0;
        $principleChargesArr['processingFee'] = 0;
        $principleChargesArr['insurance'] = $insurance;
        $principleChargesArr['verificationCharges'] = 0;
        $principleChargesArr['collectionFee'] = 0;
        $principleChargesArr['plateformFee'] = $plateformFee;
        $principleChargesArr['convenienceFee'] = 0;
        $principleChargesArr['principleAmount'] = 0;
        $principleChargesArr['pfPercentage'] = 0;

        $principleChargesStr = json_encode($principleChargesArr);
        $principleCharges = $plateformFee + $insurance;

        // $saveArr['userId']=$userId;
        $saveArr['productId'] = ($productName) ? $productName : 0;
        $saveArr['loanCategory'] = $loanCategory;
        $saveArr['loanAmount'] = $approvedAmount;
        $saveArr['approvedAmount'] = $approvedAmount;
        $saveArr['tenure'] = $approveTenure;
        $saveArr['approvedTenure'] = $approveTenure;
        $saveArr['rateOfInterest'] = $approvedRoi;
        $saveArr['invoiceFile'] = $image;
        $saveArr['principleChargesDetails'] = $principleChargesStr;
        $saveArr['principleCharges'] = $principleCharges;
        $saveArr['netDisbursementAmount'] = ($approvedAmount - $principleCharges);
        $saveArr['roiType'] = $roiType;

        if ($validFromDate && $validToDate) {
            $saveArr['validFromDate'] = $validFromDate;
            $saveArr['validToDate'] = $validToDate;
        }

        
        $saveArr['created_at'] = $currentDate;
        $saveArr['updated_at'] = $currentDate;
        // dd($saveArr);

        // $loanId = ApplyLoanHistory::create($saveArr);
        if($loanLastPending){
            $loanId = ApplyLoanHistory::updateOrCreate(['status' => 'pending', 'userId' => $userId], $saveArr);
        }else{
            $saveArr['status']='pending';
            $saveArr['userId']=$userId;
            $loanId = ApplyLoanHistory::create($saveArr);
        }
        //  DB::table('apply_loan_histories')->insertGetId($saveArr);


        if ($loanId) {
            return $loanId;
        } else {
            return false;
        }
    }

    public function getBusinessOrEmploymentFormForLoanApply(Request $request)
    {
        $catId = $request->catId;
        $userId = auth()->user()->id;

        $isBusiness = 0;
        if ($catId != 2) {
            // Except Persoanl Loan
            $isBusiness = 1;
        }
        $userEmploymentHistory = EmploymentHistory::where('userId', $userId)->where('fromAdmin', 0)->where('isBusiness', $isBusiness)->orderBy('id', 'desc')->first();

        if ($isBusiness > 0) {
        ?>
            <div class="first_stepcd">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Business Details </h3>
                    </div>
                </div>
            </div>
            <div class="field_start">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="employerName" placeholder="Enter Company Name" id="employerName" value="<?= old('employerName') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->employerName : '') ?>" class="form-control contact-one__form-input" placeholder="" required="">
                            <span id="employerName_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Phone No.</label>
                            <input type="text" id="companyMobileNo" placeholder="Enter Company Phone No." onkeypress="javascript:return isNumber(event)" name="companyMobileNo" value="<?= old('companyMobileNo') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->mobileNo : '') ?>" class="form-control contact-one__form-input"  required="">
                            <span id="companyMobileNo_error" class="error_text text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telephone No.</label>
                            <input type="text" id="companyTeleNo" placeholder="Enter Telephone No." onkeypress="javascript:return isNumber(event)" name="companyTeleNo" value="<?= old('companyTeleNo') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyTeleNo : '') ?>" class="form-control contact-one__form-input"  required="">
                            <span id="companyTeleNo_error" class="error_text text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Email </label>
                            <input type="email" id="companyEmailId" placeholder="Enter Company Email" name="companyEmailId" value="<?= old('companyEmailId') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->emailId : '') ?>" class="form-control contact-one__form-input" placeholder="" required="">
                            <span id="companyEmailId_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fax No. </label>
                            <input type="text" id="companyFaxNo" placeholder="Enter Fax No." name="companyFaxNo" value="<?= old('companyFaxNo') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyFaxNo : '') ?>" class="form-control contact-one__form-input" placeholder=" " required onkeypress="javascript:return isNumber(event)">
                            <span id="companyFaxNo_error" class="error_text text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>GSTIN</label>
                            <input type="text" id="companyGstin" maxlength="15" placeholder="Enter GSTIN" name="companyGstin" value="<?= old('companyGstin') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyGstin : '') ?>" class="form-control contact-one__form-input" placeholder="" required="">
                            <span id="companyGstin_error" class="error_text text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Pan Number</label>
                            <input type="text" id="companyPan" maxlength="10" name="companyPan" value="<?= old('companyPan') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyPan : '') ?>" class="form-control contact-one__form-input" placeholder="Enter Pan Number" required="">
                            <span id="companyPan_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div><!-- /.col-md-6-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Type</label>
                            <select id="companyType" name="companyType" class="contact-one__form-input " required="">
                                <option value="">Select </option>
                                <option value="Partnership" <?php if (old('companyType') && old('companyType') == 'Partnership') { echo 'selected';}elseif (!empty($userEmploymentHistory) && $userEmploymentHistory->companyType == 'Partnership') { echo 'selected';}?>>Partnership </option>
                                <option value="Propritorship" <?php if (old('companyType') && old('companyType') == 'Partnership') { echo 'selected';}elseif (!empty($userEmploymentHistory) && $userEmploymentHistory->companyType == 'Propritorship') { echo 'selected';}?>>Propritorship </option>
                                <option value="Pvt. Ltd." <?php if (old('companyType') && old('companyType') == 'Partnership') { echo 'selected';}elseif (!empty($userEmploymentHistory) && $userEmploymentHistory->companyType == 'Pvt. Ltd.') { echo 'selected';}?>>Pvt. Ltd. </option>
                            </select>
                            <span id="companyType_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" id="companyAddress" name="companyAddress" value="<?= old('companyAddress') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->address : '') ?>" class="form-control contact-one__form-input" placeholder="Enter Address" required="">
                            <span id="companyAddress_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>District</label>
                            <input type="text" id="companyDistrict" name="companyDistrict" value="<?= old('companyDistrict') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->district : '') ?>" class="form-control contact-one__form-input" placeholder="Enter District" required onkeypress="javascript:return isAlphabet(event)">
                            <span id="companyDistrict_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>State</label>
                            <select class="form-control form-select contact-one__form-input" name="companyState" id="companyState">
                                <option value="">Select State</option>
                                <?php if($this->indianStates){
                                    foreach ($this->indianStates as $kk=>$statein){ ?>
                                        <option <?php if(old('companyState')==$statein){ echo "selected"; }elseif(!empty($userEmploymentHistory)){ if($userEmploymentHistory->state==$statein){echo 'selected';} } ?> value="<?= $statein ?>"><?= $statein ?></option>
                                    <?php } 
                                } ?>
                            </select>
                            <span id="companyState_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pincode</label>
                            <input type="number" id="companyPincode" onkeypress="javascript:return isNumber(event)" name="companyPincode" value="<?= old('companyPincode') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->pincode : '') ?>" class="form-control contact-one__form-input" placeholder="Enter Pincode" required="">
                            <span id="companyPincode_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>

                </div>

            </div>
        <?php
        } else {
        ?>
            <div class="first_stepcd">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Employer Details</h3>
                    </div>
                </div>
            </div>
            <div class="field_start">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Name </label>
                            <input type="text" name="employerName" id="employerName" value="<?= old('employerName') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->employerName : '') ?>" class="form-control contact-one__form-input" placeholder="Enter Company Name" required="">
                            <span id="employerName_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Phone No.</label>
                            <input type="text" id="companyMobileNo" onkeypress="javascript:return isNumber(event)" name="companyMobileNo" value="<?= old('companyMobileNo') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->mobileNo : '') ?>" class="form-control contact-one__form-input" placeholder="Enter Company Phone No." required="">
                            <span id="companyMobileNo_error" class="error_text text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Email </label>
                            <input type="email" id="companyEmailId" name="companyEmailId" value="<?= old('companyEmailId') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->emailId : '') ?>" class="form-control contact-one__form-input" placeholder="Enter Company Email" required="">
                            <span id="companyEmailId_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Type</label>
                            <select id="companyType" name="companyType" class="contact-one__form-input " required="">
                                <option value="">Select </option>
                                <option value="Partnership" <?php if (old('companyType') && old('companyType') == 'Partnership') { echo 'selected';}elseif (!empty($userEmploymentHistory) && $userEmploymentHistory->companyType == 'Partnership') { echo 'selected';}?>>Partnership </option>
                                <option value="Propritorship" <?php if (old('companyType') && old('companyType') == 'Partnership') { echo 'selected';}elseif (!empty($userEmploymentHistory) && $userEmploymentHistory->companyType == 'Propritorship') { echo 'selected';}?>>Propritorship </option>
                                <option value="Pvt. Ltd." <?php if (old('companyType') && old('companyType') == 'Partnership') { echo 'selected';}elseif (!empty($userEmploymentHistory) && $userEmploymentHistory->companyType == 'Pvt. Ltd.') { echo 'selected';}?>>Pvt. Ltd. </option>
                            </select>
                            <span id="companyType_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Total Experience In Current Company</label>
                            <input type="text" id="totalExpInCurrentCompany" name="totalExpInCurrentCompany" value="<?= old('totalExpInCurrentCompany') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->totalExpInCurrentCompany : '') ?>" class="form-control contact-one__form-input" placeholder="Total Experience In Current Company" required="">
                            <span id="totalExpInCurrentCompany_error" class="error_text text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Current Salary </label>
                            <input type="number" id="currentSalary" name="currentSalary" value="<?= old('currentSalary') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->currentSalary : '') ?>" class="form-control contact-one__form-input" placeholder="Current Salary" required="">
                            <span id="currentSalary_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" id="companyAddress" name="companyAddress" value="<?= old('companyAddress') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->address : '') ?>" class="form-control contact-one__form-input" placeholder="Enter Address" required="">
                            <span id="companyAddress_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>District</label>
                            <input type="text" id="companyDistrict" name="companyDistrict" value="<?= old('companyDistrict') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->district : '') ?>" class="form-control contact-one__form-input" placeholder="Enter District" required="">
                            <span id="companyDistrict_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>State</label>
                            <select class="form-control form-select contact-one__form-input" name="companyState" id="companyState">
                                <option value="">Select State</option>
                                <?php if($this->indianStates){
                                    foreach ($this->indianStates as $kk=>$statein){ ?>
                                        <option <?php if(old('companyState')==$statein){ echo "selected"; }elseif(!empty($userEmploymentHistory)){ if($userEmploymentHistory->state==$statein){echo 'selected';} } ?> value="<?= $statein ?>"><?= $statein ?></option>
                                    <?php } 
                                } ?>
                            </select>
                            <span id="companyState_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pincode</label>
                            <input type="text" id="companyPincode" onkeypress="javascript:return isNumber(event)" name="companyPincode" value="<?= old('companyPincode') ?? ((!empty($userEmploymentHistory)) ? $userEmploymentHistory->pincode : '') ?>" class="form-control contact-one__form-input" placeholder="Enter Pincode" required="">
                            <span id="companyPincode_error" class="error_text text-danger"></span>
                        </div><!-- /.form-group-->
                    </div>

                </div>

            </div>
<?php
        }
    }

    public function getLoanHistoryByUserWeb(Request $request)
    {
        $userDtl = $this->isUserLoggedIn();
        if (empty($userDtl)) {
            return redirect()->route('webUserLogin');
        }
        $loanCategory = $request->loanType;
        $userId = $userDtl->id;
        $htmlStr = '';

        $loanHistory = DB::select("SELECT alh.*,t.name as appliedTenureText,t2.name as approvedTenureD,c.name as categoryName,p.productName FROM apply_loan_histories alh LEFT JOIN tenures t ON alh.tenure=t.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id WHERE alh.userId='$userId' and alh.loanCategory='$loanCategory' ORDER BY alh.id ASC");
        if (count($loanHistory)) {
            if ($loanCategory == 3) {
                $tenures = Tenure::where('loanCategory', 3)->orderBy('sortOrder', 'ASC')->get();
                $newLoanArr = [];
                foreach ($loanHistory as $lrow) {

                    $userDtl = User::getUserDetailsById($userId);

                    $loanId = $lrow->id;
                    $approvedAmount = $lrow->approvedAmount;
                    $rateOfInterest = $lrow->rateOfInterest;

                    $credHistoryArr = CommonController::checkAvailableAmountLimitRawMaterial($userId, $loanId);

                    $availableLimit = $credHistoryArr['availableLimit'];
                    $totalCredit = $credHistoryArr['totalCredit'];
                    $totalDebit = $credHistoryArr['totalDebit'];
                    
                    $leftamount = $availableLimit/$approvedAmount;
                    $leftamount = $leftamount*100;
                    $paymentURL = "'" . route('initiateRawMaterialPayment', base64_encode($loanId)) . "'";
                    $htmlStr .= '<div class="row">
                        <div class="col-lg-12">
                            <div class="tp_cardmain">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="loan_card">
                                            <div class="content_headerloan">
                                                <h1>Approved Loan Amount</h1>
                                                <h4> ' . $approvedAmount . '</h4>
                                            </div>
                                            <div class="card_number">
                                                <p><strong>Rate of Interest</strong> <span>' . $rateOfInterest . '%</span></p>
                                            </div>
                                        </div>

                                        <div class="amount_limit">
                                            <h5>Limit</h5>
                                            <div class="progress h-3 bg-slate-150 dark:bg-navy-500">
                                                <div style="width:'.$leftamount.'%" class=" rounded-full bg-primary dark:bg-accent"></div>
                                            </div>
                                            <div class="limit_amount">
                                                <p> ' . $approvedAmount . '<span> /  ' . $availableLimit . ' </span></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-7">
                                        <div class="right_lddt">
                                            <div class="credit_debit_details">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="debitcard cd_details">
                                                            <h1>Amount Debit</h1>
                                                            <p>₹ ' . $totalDebit . '</p>
                                                            <div class="arrow_icon"><img src="' . asset('/') . 'assets/admin/images/uparrow.png" alt=""></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="creditcard cd_details">
                                                            <h1>Amount Credit</h1>
                                                            <p>₹ ' . $totalCredit . '</p>
                                                            <div class="arrow_icon"><img src="' . asset('/') . 'assets/admin/images/downarrow.png" alt=""></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="loanmore_details">
                                                <div class="lm_title">Customer Information</div>
                                                <div class="lmcard_customerdetails">
                                                    <ul>
                                                        <li>
                                                            <h1>Valid From</h1>
                                                            <p>' . date('d M, Y', strtotime($lrow->validFromDate)) . '</p>
                                                        </li>
                                                        <li>
                                                            <h1>Valid To</h1>
                                                            <p>' . date('d M, Y', strtotime($lrow->validToDate)) . '</p>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="row" id="btnhistory">';
                    if ($lrow->status == 'customer-approved') {
                        $htmlStr .= '<div class="col-md-6">
                                                            <button onclick="location.href=' . $paymentURL . '" style="padding: 5px;font-size: 11px;border-radius: 5px;" class="bg-warning" >
                                                                <i class="fa-solid fa-money-bill-transfer"></i>
                                                                Credit Amount
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="button" style="padding: 5px;font-size: 11px;border-radius: 5px;" class="bg-primary" onclick="openDisbursementRequestModal(' . $lrow->id . ');">
                                                                <i class="fa-solid fa-money-bill-transfer"></i>
                                                                Disbursement Request
                                                            </button>
                                                        </div>
                                                        <!--<div class="col-md-6">
                                                            <button onclick="location.href=' . "'" . route('enachApi', $userId) . "'" . '" style="padding: 5px;font-size: 11px;border-radius: 5px;" class="bg-warning" >
                                                                <i class="fa-solid fa-money-bill-transfer"></i>
                                                                Enash
                                                            </button>
                                                        </div>-->';
                    }
                    $htmlStr .= '</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="transition_details">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tabs flex flex-col">
                                    <div class="is-scrollbar-hidden">
                                        <div class="tabs-list flex px-1.5 py-1">
                                            <select class="form-control" onchange="filterRawMaterialTxnHistory(' . $lrow->id . ');" id="rawFilterType' . $lrow->id . '" data-width="100%">
                                                <option value="all">All Statement</option>
                                                <option value="credit">Credit</option>
                                                <option value="debit">Debit</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>';
                    $Res = $this->rewMaterialAppliedLoansTxnHistory($userId, $lrow->id, 'all');
                    $htmlStr .= '<div id="rawTxnDetails' . $lrow->id . '">' . $Res . '</div>';
                }
            } else {
                foreach ($loanHistory as $loanDetails) {
                    $loanId = $loanDetails->id;

                    $plateformFee = 0;
                    $insurance = 0;
                    $principleChargesDetailsArr = [];
                    if ($loanDetails->principleChargesDetails) {
                        $principleChargesDetailsArr = json_decode($loanDetails->principleChargesDetails, true);
                        $plateformFee = (isset($principleChargesDetailsArr['plateformFee'])) ? $principleChargesDetailsArr['plateformFee'] : 0;
                        $insurance = (isset($principleChargesDetailsArr['insurance'])) ? $principleChargesDetailsArr['insurance'] : 0;
                    }

                    $paybleAmount = $loanDetails->approvedAmount + $loanDetails->totalInterest;
                    $extraAmountDays = $loanDetails->extraAmountDays;
                    $extraIntrestAmount = $loanDetails->extraIntrestAmount;
                    $netDisbursementAmount = number_format($loanDetails->netDisbursementAmount - $extraIntrestAmount, 2);
                    $roiType = $loanDetails->roiType;

                    $emiDetails = LoanEmiDetail::where(['userId' => $userId, 'loanId' => $loanId])->orderBy('emiSr', 'asc')->get();
                    $disburseDate = (strtotime($loanDetails->disbursedDate)) ? date('d/m/Y', strtotime($loanDetails->disbursedDate)) : '';
                    if ($loanDetails->roiType == 'quaterly_interest') {
                        $emiLabelMonth = 'Quarterly Emi';
                    } else if ($loanDetails->roiType == 'reducing_roi') {
                        $emiLabelMonth = 'Monthly EMI';
                    } else {
                        $emiLabelMonth = 'EMI';
                    }
                    $htmlStr .= ' <div class="row">
            <div class="col-lg-4 col-md-12">
               <div class="card popcolored_card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-8">
                           <div class="mt-0 text-start">
                              <span class="fs-14 font-weight-semibold">Customer ID</span>
                              <h5 class="mb-0 mt-1 mb-2">' . $userDtl->customerCode . '</h5>
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
                              <span class="fs-14 font-weight-semibold">Loan Amount</span>
                              <h5 class="mb-0 mt-1 mb-2">' . $loanDetails->approvedAmount . '</h5>
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
                              <span class="fs-14 font-weight-semibold">Loan Date</span>
                              <h5 class="mb-0 mt-1 mb-2">' . $disburseDate . '</h5>
                           </div>
                        </div>
                        <div class="col-4">
                           <div class="icon1 bg-primary my-auto  float-end"> <i data-feather="calendar" class="btn-icon-prepend "></i> </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>';


                    $productStr = '';

                    $productStr .= '
            <div class="col-lg-6 mt-3">
                <label ><strong>Product Name</strong></label><br>
                <label>' . $loanDetails->categoryName . '</label>
            </div>';
                    if ($loanDetails->loanCategory != 3) {
                        $roiTypeLabel = AppServiceProvider::getROITypeHeading($roiType);
                        $productStr .= '<div class="col-lg-6 mt-3">
                    <label ><strong>ROI Type</strong></label><br>
                    <label>' . $roiTypeLabel . '</label>
                </div>';
                    }
                    $productStr .= '<div class="col-lg-6 mt-3">
                <label ><strong>ROI</strong></label><br>
                <label>' . $loanDetails->rateOfInterest . ' %</label>
            </div>
            <div class="col-lg-6 mt-3">
                <label><strong>Loan Amount</strong></label><br>
                <label>' . $loanDetails->approvedAmount . ' </label>
            </div>';
                    if ($loanDetails->roiType != 'bullet_repayment') {
                        $productStr .= '<div class="col-lg-6 mt-3">
                    <label ><strong>Tenure</strong></label><br>
                    <label>' . $loanDetails->approvedTenureD . ' </label>
                </div>';
                    }
                //     if ($loanDetails->monthlyEMI) {
                //         $productStr .= '<div class="col-lg-6 mt-3">
                //     <label ><strong>' . $emiLabelMonth . '</strong></label><br>
                //     <label>' . $loanDetails->monthlyEMI . ' </label>
                // </div>';
                //     }

                    if ($loanDetails->monthlyEMI) {
                        $productStr .= '<div class="col-lg-6 mt-3">
                    <label ><strong>Total Interest</strong></label><br>
                    <label>' . $loanDetails->totalInterest . ' </label>
                </div>';
                    }


                    if ($plateformFee) {
                        $productStr .= '<div class="col-lg-6 mt-3">
                    <label ><strong>Plateform Fee</strong></label><br>
                    <label>' . $plateformFee . ' </label>
                </div>';
                    }

                    if ($insurance) {
                        $productStr .= '<div class="col-lg-6 mt-3">
                    <label ><strong>Insurance Fee</strong></label><br>
                    <label>' . $insurance . ' </label>
                </div>';
                    }

                    if ($extraAmountDays) {
                        $productStr .= '<div class="col-lg-6 mt-3">
                    <label ><strong>Extra Days</strong></label><br>
                    <label>' . $extraAmountDays . ' </label>
                </div>';
                    }

                    if ($extraIntrestAmount) {
                        $productStr .= '<div class="col-lg-6 mt-3">
                    <label ><strong>Extra Days Interest</strong></label><br>
                    <label>' . $extraIntrestAmount . ' </label>
                </div>';
                    }

                    if ($netDisbursementAmount) {
                        $productStr .= '<div class="col-lg-6 mt-3">
                    <label ><strong>Net Disbursement Amount</strong></label><br>
                    <label>' . $netDisbursementAmount . ' </label>
                </div>';
                    }


                    if ($paybleAmount && $roiType != 'bullet_repayment') {
                        $productStr .= '<div class="col-lg-6 mt-3">
                    <label ><strong>Payble Amount</strong></label><br>
                    <label>' . $paybleAmount . ' </label>
                </div>';
                    }


                    if ($roiType == 'bullet_repayment' && $loanDetails->status == 'disbursed') {

                        $productStr .= '<div class="col-lg-12 mt-3"> <hr></div>';
                        $productStr .= '<div class="col-lg-6 mt-3">
                <input type="hidden" name="bullet_repaymentLoanId" value="' . $loanDetails->id . '" id="bullet_repaymentLoanId">
                    <label ><strong>Collection Date</strong></label><br>
                    <label><input type="date" class="form-control" name="bullet_repaymentCollectDate" id="bullet_repaymentCollectDate"> </label>
                </div>';
                        $productStr .= '<div class="col-lg-6 mt-3 bullet_repaymentHtml" style="display:none;">
                    <label ><strong>Total Interest</strong></label><br>
                    <label><input type="number" disabled class="form-control" name="bullet_repaymentTotalInterest" id="bullet_repaymentTotalInterest"> </label>
                </div>';
                        $productStr .= '<div class="col-lg-6 mt-3 bullet_repaymentHtml" style="display:none;">
                    <label ><strong>Interest Days</strong></label><br>
                    <label><input type="text" disabled disabled class="form-control" name="bullet_repaymentInterestDays" id="bullet_repaymentInterestDays"> </label>
                </div>';
                        $productStr .= '<div class="col-lg-6 mt-3 bullet_repaymentHtml" style="display:none;">
                    <label ><strong>Payble Amount</strong></label><br>
                    <label><input type="number" disabled class="form-control" name="bullet_repaymentPaybleAmount" id="bullet_repaymentPaybleAmount"> </label>
                </div>';
                        $productStr .= '<div class="col-lg-6 mt-3 bullet_repaymentHtml" style="display:none;">
                    <label ><strong>Transaction Id</strong></label><br>
                    <label><input type="text" class="form-control" name="bullet_repaymentTXNID" id="bullet_repaymentTXNID"> </label>
                </div>';
                        $productStr .= '<div class="col-lg-6 mt-3 bullet_repaymentHtml" style="display:none;">
                    <label ><strong>Payment Method</strong></label><br>
                    <label><input type="text" class="form-control" name="bullet_repaymentPaymentMethod" id="bullet_repaymentPaymentMethod"> </label>
                </div>';
                        $productStr .= '<div class="col-lg-6 mt-3">
                <label ><strong>&nbsp;</strong></label><br>
                    <button type="button" id="bullet_repaymentSetButton" onclick="getPaybleAmountBulletRepayment('.$loanDetails->id.');" class="btn btn-warning bg-warning">Get Payble Amount</button>
                </div>';
                    }


                    $htmlStr .= '<div class="col-lg-12 col-md-12">
               <div class="card popcolored_card">
                  <div class="card-body">
                     <div class="row">
                        ' . $productStr . '
                     </div>
                  </div>
               </div>
            </div>
                        </div>
            ';


                    $TBLLTHCLS = 'class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"';
                    $htmlStr .= '<div class="table_mainstart" id="tablecc_card">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tablecard">
                        <table class="is-hoverable w-full table-dark">
                          <thead>
                            <tr>
                              <th ' . $TBLLTHCLS . '>EMI ID</th>
                              <th ' . $TBLLTHCLS . '>EMI AMOUNT</th>
                              <th ' . $TBLLTHCLS . '>PRINCIPLE</th>
                              <th ' . $TBLLTHCLS . '>INTEREST</th>
                              <th ' . $TBLLTHCLS . '>BALANCE</th>
                              <th ' . $TBLLTHCLS . '>START DATE</th>
                              <th ' . $TBLLTHCLS . '>DUE DATE</th>                      
                              <th ' . $TBLLTHCLS . '>STATUS</th>
                              <th ' . $TBLLTHCLS . '>TRANSACTION ID</th>
                              <th ' . $TBLLTHCLS . '> TRANSACTION DATE </th>
                              <th ' . $TBLLTHCLS . '>LATE CHARGERS</th>
                            </tr>
                          </thead>
                          <tbody>';
                    if (count($emiDetails)) {
                        foreach ($emiDetails as $erow) {
                            if ($erow->status == 'pending') {
                                $statusText = '<span class="label label-warning">Pending</span>';
                            } elseif ($erow->status == 'success') {
                                $statusText = '<span class="label label-success">Success</span>';
                            } else {
                                $statusText = '<span class="label label-danger">Failed</span>';
                            }
                            $EMIID = $erow->emiId;
                            $emiDate = (strtotime($erow->emiDate)) ? date('d/m/Y', strtotime($erow->emiDate)) : '';
                            $emiDueDate = (strtotime($erow->emiDueDate)) ? date('d/m/Y', strtotime($erow->emiDueDate)) : '';
                            $transactionDate = (strtotime($erow->transactionDate)) ? date('d/m/Y', strtotime($erow->transactionDate)) : '';
                            $lateCarges = ($erow->lateCharges) ? $erow->lateCharges : '';
                            $htmlStr .= ' <tr>
                          <td>' . $EMIID . '</td>
                          <td>' . number_format($erow->emiAmount, 2) . '</td>
                          <td>' . number_format($erow->principle, 2) . '</td>
                          <td>' . number_format($erow->interest, 2) . '</td>
                          <td>' . number_format($erow->balance, 2) . '</td>
                          <td>' . $emiDate . '</td>
                          <td>' . $emiDueDate . '</td>
                          <td>' . $statusText . '</td>
                          <td>' . $erow->transactionId . '</td>
                          <td>' . $transactionDate . '</td>
                          <td>' . $lateCarges . '</td>
                        </tr>';
                        }
                    }
                    $htmlStr .= '  </tbody>
                    </table></div></div></div></div>';
                }
            }
        }

        echo $htmlStr;
    }

    public function filterRawMaterialTxnHistory(Request $request)
    {
        $userDtl = $this->isUserLoggedIn();
        if (empty($userDtl)) {
            return redirect()->route('webUserLogin');
        }
        $filterType = $request->rawFilterType;
        $loanId = $request->loanId;

        $result = $this->rewMaterialAppliedLoansTxnHistory($userDtl->id, $loanId, $filterType);
        echo $result;
    }

    public function rewMaterialAppliedLoansTxnHistory($userId, $loanId, $filterType)
    {
        $SUBQRY = '';

        if ($filterType == 'credit') {
            $SUBQRY .= " AND rmc.id IS NOT NULL";
        }

        if ($filterType == 'all') {
            $selQry = "SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.loanId='$loanId' ORDER BY rmc.id DESC";
        } else if ($filterType == 'debit') {
            $selQry = "SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.txnType='out' AND rmc.loanId='$loanId' ORDER BY rmc.id DESC";
        } else if ($filterType == 'credit') {
            $selQry = "SELECT rmc.*,t.name as tenureName FROM raw_materials_txn_details rmc left join tenures t on rmc.approvedTenure=t.id WHERE rmc.txnType='in' AND rmc.loanId='$loanId' ORDER BY rmc.id DESC";
        }

        $loanDetails = DB::select($selQry);

        $htmlStr = '';

        $TBLLTHCLS = 'whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
        $htmlStr .= '<div class="table_mainstart" id="tablecc_card">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tablecard">
            <table class="is-hoverable w-full table-dark">
            <thead>
              <tr>
                <th class="' . $TBLLTHCLS . '">Sr. No.</th>';
        if ($filterType == 'all') {
            $htmlStr .= ' <th class="' . $TBLLTHCLS . '">Opening Date</th>
                            <th class="' . $TBLLTHCLS . '">Opening Amount</th>
                            <th class="' . $TBLLTHCLS . '">Closing Date</th>
                            <th class="' . $TBLLTHCLS . '">Closing Amount</th>
                            <th class="' . $TBLLTHCLS . '">Withdraw Amount</th>
                            <th class="' . $TBLLTHCLS . '">Deposit </th>
                            <th class="' . $TBLLTHCLS . '">Interest Days</th>
                            <th class="' . $TBLLTHCLS . '">Total Interest</th>
                            <th class="' . $TBLLTHCLS . '">TDS %</th>
                            <th class="' . $TBLLTHCLS . '">TDS Amount</th>
                            <th class="' . $TBLLTHCLS . '">Net Interest</th>                                
                            <th class="' . $TBLLTHCLS . '">Late Charge</th>
                            <th class="' . $TBLLTHCLS . '">No. of days of late charges</th>                                
                            <th class="' . $TBLLTHCLS . '">Principle Deposit</th>
                            <th class="' . $TBLLTHCLS . '">Tenure </th>
                            <th class="' . $TBLLTHCLS . '">Invoice Number </th>
                            <th class="' . $TBLLTHCLS . '">Status </th>';
        } else if ($filterType == 'debit') {
            $htmlStr .= ' <th class="' . $TBLLTHCLS . '">Amount</th>
                            <th class="' . $TBLLTHCLS . '">Transaction Id</th>
                            <th class="' . $TBLLTHCLS . '">Payment Mode</th>
                            <th class="' . $TBLLTHCLS . '">Transaction Date </th>
                            <th class="' . $TBLLTHCLS . '">Tenure </th>
                            <th class="' . $TBLLTHCLS . '">Invoice Number </th>
                            <th class="' . $TBLLTHCLS . '">Status </th>';
        } else if ($filterType == 'credit') {
            $htmlStr .= ' <th class="' . $TBLLTHCLS . '">Opening Date</th>
                            <th class="' . $TBLLTHCLS . '">Opening Amount</th>
                            <th class="' . $TBLLTHCLS . '">Closing Date</th>
                            <th class="' . $TBLLTHCLS . '">Closing Amount</th>
                            <th class="' . $TBLLTHCLS . '">Deposit </th>
                            <th class="' . $TBLLTHCLS . '">Interest Days</th>
                            <th class="' . $TBLLTHCLS . '">Total Interest</th>
                            <th class="' . $TBLLTHCLS . '">TDS %</th>
                            <th class="' . $TBLLTHCLS . '">TDS Amount</th>
                            <th class="' . $TBLLTHCLS . '">Net Interest</th>
                            <th class="' . $TBLLTHCLS . '">Late Charge</th>
                            <th class="' . $TBLLTHCLS . '">No. of days of late charges
                            <th class="' . $TBLLTHCLS . '">Principle Deposit</th>
                            <th class="' . $TBLLTHCLS . '">Tenure </th>
                            <th class="' . $TBLLTHCLS . '">Status </th>';
        }
        $htmlStr .= '<th class="' . $TBLLTHCLS . '">Created Date</th>
              </tr>
            </thead>
            <tbody>';
        if (count($loanDetails)) {
            $lsr = 1;
            foreach ($loanDetails as $lrow) {

                $applyDate = (strtotime($lrow->created_at)) ? date('d M, Y', strtotime($lrow->created_at)) : '';


                $transactionDate = (strtotime($lrow->transactionDate)) ? date('d M, Y', strtotime($lrow->transactionDate)) : '';

                $openingdate = (strtotime($lrow->openingDate)) ? date('d M, Y', strtotime($lrow->openingDate)) : '';

                $closingDate = $transactionDate;

                $debitTxnDate = $transactionDate;

                // $statusText=strtoupper($lrow->status);
                $debitStatus = strtoupper($lrow->status);
                // $txnType=strtoupper($lrow->txnType);
                // if($txnType=='IN'){
                //     $txnType='Credit';
                // }else if($txnType=='OUT'){
                //     $txnType='Debit';
                // }

                $buttons = '';
                $loanStatus = strtoupper($lrow->status);
                $htmlStr .= '<tr>
                        <td>' . $lsr . '</td>';
                if ($filterType == 'all') {
                    if ($lrow->txnType == 'in') {
                        $htmlStr .= '<td>' . $openingdate . '</td>
                                        <td>' . number_format($lrow->openingBalance, 2) . '</td>
                                        <td>' . $closingDate . '</td>
                                        <td>' . number_format($lrow->outstandingBalance, 2) . '</td>
                                        <td></td>
                                        <td>' . number_format($lrow->totalAmount + $lrow->lateCharges, 2) . '</td>
                                        <td>' . $lrow->numOfDays . '</td>
                                        <td>' . number_format($lrow->interestAmount, 2) . '</td>
                                        <td>' . number_format($lrow->tdsPercent, 2) . '</td>
                                        <td>' . number_format($lrow->tdsAmount, 2) . '</td>
                                        <td>' . number_format($lrow->interestAmountPayble, 2) . '</td>
                                        <td>' . number_format($lrow->lateCharges, 2) . '</td>
                                        <td>' . $lrow->numOfDaysOfFine . '</td>
                                        <td>' . number_format($lrow->amount, 2) . '</td>
                                        <td></td>
                                        <td></td>
                                        <td>' . $debitStatus . '</td>';
                    } else {
                        $htmlStr .= '<td>' . $openingdate . '</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>' . number_format($lrow->amount, 2) . '</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>' . $lrow->tenureName . '</td>';
                        $invNumber = ($lrow->invoiceNumber) ? $lrow->invoiceNumber : '';
                        if ($invNumber) {
                            $htmlStr .= '<td><a href="javascript:;" style="color:blue;" data-invoiceNumber="' . $lrow->invoiceNumber . '" data-invoiceFile="' . $lrow->invoiceFile . '" data-drawDownFormFile="' . $lrow->drawDownFormFile . '" id="rawFile' . $lrow->id . '" onclick="openInvFiles(' . $lrow->id . ');" >' . $invNumber . '</a></td>';
                        } else {
                            $htmlStr .= '<td></td>';
                        }
                        $htmlStr .= '<td>' . $debitStatus . '</td>';
                    }
                } else if ($filterType == 'debit') {
                    $htmlStr .= '
                                    <td>' . number_format($lrow->amount, 2) . '</td>
                                    <td>' . $lrow->transactionId . '</td>
                                    <td>' . strtoupper($lrow->payment_mode) . '</td>
                                    <td>' . $transactionDate . '</td>
                                    <td>' . $lrow->tenureName . '</td>';
                    $invNumber = ($lrow->invoiceNumber) ? $lrow->invoiceNumber : '';
                    if ($invNumber) {
                        $htmlStr .= '<td><a href="javascript:;" style="color:blue;" data-invoiceNumber="' . $lrow->invoiceNumber . '" data-invoiceFile="' . $lrow->invoiceFile . '" data-drawDownFormFile="' . $lrow->drawDownFormFile . '" id="rawFile' . $lrow->id . '" onclick="openInvFiles(' . $lrow->id . ');" >' . $invNumber . '</a></td>';
                    } else {
                        $htmlStr .= '<td></td>';
                    }
                    $htmlStr .= '<td>' . $debitStatus . '</td>';
                } else if ($filterType == 'credit') {
                    $htmlStr .= '<td>' . $openingdate . '</td>
                                        <td>' . number_format($lrow->openingBalance, 2) . '</td>
                                        <td>' . $closingDate . '</td>
                                        <td>' . number_format($lrow->outstandingBalance, 2) . '</td>
                                        <td>' . number_format($lrow->totalAmount + $lrow->lateCharges, 2) . '</td>
                                        <td>' . $lrow->numOfDays . '</td>
                                        <td>' . number_format($lrow->interestAmount, 2) . '</td>
                                        <td>' . number_format($lrow->tdsPercent, 2) . '</td>
                                        <td>' . number_format($lrow->tdsAmount, 2) . '</td>
                                        <td>' . number_format($lrow->interestAmountPayble, 2) . '</td>
                                        <td>' . number_format($lrow->lateCharges, 2) . '</td>
                                        <td>' . $lrow->numOfDaysOfFine . '</td>
                                        <td>' . number_format($lrow->amount, 2) . '</td>
                                        <td>' . $lrow->tenureName . '</td>
                                        <td>' . $debitStatus . '</td>';
                }
                $htmlStr .= '<td>' . $applyDate . '</td>
                </tr>';
                $lsr++;
            }
        }
        $htmlStr .= '</tbody></table></div></div></div></div>';

        return $htmlStr;
    }

    public function disburseRequestForRawMaterialAppliedLoans(Request $request)
    {
        // dd("-----");
        $userDtl = $this->isUserLoggedIn();

        if ($request->loanRequestId) {
            $loanId = $request->loanRequestId;
        } else {
            $loanId = $request->loanId;
        }
        $userId = $userDtl->id;
        if ($request->requestAmount) {
            $amount = $request->requestAmount;
        } else {
            $amount = $request->amount;
        }


        $availableArr = CommonController::checkAvailableAmountLimitRawMaterial($userId, $loanId);
        $availableLimit = $availableArr['availableLimit'];
        if ($amount > $availableLimit) {
            echo json_encode(['status' => 'error', 'message' => 'Please enter the amount lower than available limit.']);
            exit;
        }


        $invoiceFile = '';
        if (!empty($request->invoice_file)) {
            $invoiceFile = AppServiceProvider::uploadImageCustom('invoice_file', 'raw-materials');
        }

        $drawDownFormFile = '';
        if (!empty($request->drawdownForm)) {
            $drawDownFormFile = AppServiceProvider::uploadImageCustom('drawdownForm', 'raw-materials');
        }

        $currentDate = date('Y-m-d H:i:s');
        $saveArr['loanId'] = $loanId;
        $saveArr['userId'] = $userId;
        $saveArr['loanAmount'] = $amount;
        $saveArr['status'] = 'customer-request';
        $saveArr['invoiceNumber'] = ($request->invoiceNumber) ? $request->invoiceNumber : '';
        $saveArr['invoiceFile'] = $invoiceFile;
        $saveArr['drawDownFormFile'] = $drawDownFormFile;

        $save = DB::table('raw_materials_loan_requests')->insertGetId($saveArr);
        if ($save) {
            $verifyWith = env('APP_NAME');
            $htmlStAdmin = "Dear Admin,<br>".$userDtl->name." (".$userDtl->customerCode.") has sent amount request of ".$amount." INR for RAW loan (LF00".$loanId.") at ".$currentDate.".<br><br>";
            
            if(config('app.env') == "production"){
                AppServiceProvider::sendMail("info@maxemocapital.com", "Info Maxemo", "Raw loan #LF0".$loanId." disbursement Request | " . $verifyWith, $htmlStAdmin);
                AppServiceProvider::sendMail("shorya.mittal@maxemocapital.com", "Shorya Mittal", "Raw loan #LF0".$loanId." disbursement Request | " . $verifyWith, $htmlStAdmin);
                AppServiceProvider::sendMail("vipul.mittal@maxemocapital.com", "Vipul Mittal", "Raw loan #LF0".$loanId." disbursement Request | " . $verifyWith, $htmlStAdmin);
                AppServiceProvider::sendMail("vivek.mittal@maxemocapital.com", "Vivek Mittal", "Raw loan #LF0".$loanId." disbursement Request | " . $verifyWith, $htmlStAdmin);
            }else{
                AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant Singh", "Raw loan #LF0".$loanId." disbursement Request | " . $verifyWith, $htmlStAdmin);
                AppServiceProvider::sendMail("raju@techmavesoftware.com", "Raju", "Raw loan #LF0".$loanId." disbursement Request | " . $verifyWith, $htmlStAdmin);
            }

            echo json_encode(['status' => 'success', 'message' => 'Disbursement request has been sent successfully.']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unable to process your request, Please try again.']);
            exit;
        }
    }

    public function sendMailForForgetPassword(Request $request)
    {
        $userEmail = $request->userEmail;
        $userDtl = User::where(['email' => $userEmail, 'userType' => 'user'])->first();
        if (!empty($userDtl)) {

            $length = 8; // Change the length as needed
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+[]{}|;:,.<>?';
            $password = substr(str_shuffle($characters), 0, $length);

            User::where(['email' => $userEmail, 'userType' => 'user'])->update(['password' => md5($password)]);
            $htmlSt = '<div>
                        <p>Dear ' . $userDtl->name . ',</p>
                    <div>
                    <table style="width: 100%;">
                        <tr>
                            <td colspan="2"> Please find your updated password  : <b>' . $password . '</b> </td>
                        </tr>';
            $htmlSt .= '</table>
                </div>
            </div><br><br>';
            $verifyWith = env('APP_NAME');
            $toMail = $userEmail;
            $toUser = $userDtl->name;
            $subject = 'New Password For ' . $verifyWith;



            AppServiceProvider::sendMail($toMail, $toUser, $subject, $htmlSt);
            echo json_encode(['status' => 'success', 'message' => 'Password has been sent on your mail.']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'This email is not registered with us, Please try again.']);
            exit;
        }
    }


    public function initiateRawMaterialPayment($loanId)
    {
        $loanId = (base64_decode($loanId)) ? base64_decode($loanId) : 0;
        $userloggedData = $this->isUserLoggedIn();
        $loanDetails = ApplyLoanHistory::where(['userId' => $userloggedData->id, 'id' => $loanId, 'loanCategory' => 3])->first();
        if (empty($loanDetails)) {
            return redirect()->route('userDashboard');
        }

        return view('web.payment.index', compact('loanDetails', 'userloggedData'));
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

    public function isUserLoggedIn()
    {
        if (!empty(auth()->user())) {
            if (auth()->user()->userType == 'user') {
                $users = DB::table('users')->where('id',auth()->user()->id)->first();
                return $users;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function webUserLogOut()
    {
        Auth::logout();
        return redirect()->route('webUserLogin');
    }
}
