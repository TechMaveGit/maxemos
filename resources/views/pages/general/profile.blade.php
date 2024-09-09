@extends('layout.master')

@section('content')
    <?php
    $userPermissions=App\Providers\AppServiceProvider::checkDecodePermissions();
    ?>
    <style>
        .checkedDocs{
            background: #82eb82;
            color: black;
            padding: 5px;
            border-radius: 10px;
            font-size: 13px;
            width: 25% !important;
        }

        .uncheckedDocs{
            background: #455298 !important;
            color: #fff;
            padding: 5px;
            border-radius: 10px;
            font-size: 13px;
            width: 25% !important;
        }

        .btn-secondary{
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
    <main >
        <div class="breadcrums_area breadcrums">

            <div class="common_pagetitle">Customer Profile</div>
            
            <div class="flex items-center space-x-4  lg:py-6 breadcrum_right">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl breadcrum_largetitle">
                    Dashboard
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="{{route('adminDashboard')}}">Home</a>
                        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li>Customer Profile</li>
                </ul>
            </div>
        </div>
        
        <!-- breadcrums end -->

        <!-- page title -->
        <div class="main_page_title">
            <div class="common_pagetitlebig">Customer Profile</div>
            <div class="btns_rightimport">
                {{--
                <button data-bs-toggle="modal" data-bs-target="#editbank_modal" class="btn bg-error edit_prbtn font-medium text-white hover:bg-error-focus hover:shadow-lg hover:shadow-error/50 focus:bg-error-focus focus:shadow-lg focus:shadow-error/50 active:bg-error-focus/90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                    </svg>
                    Edit Profile
                </button>
                --}}
            </div>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
            </div>
            @elseif(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
                @php
                    Session::forget('error');
                @endphp
            </div>
            @endif
        <!-- page title end-->
        @php
            if($userDtl->profilePic){
                $profilePic=env('APP_URL').'public/'.$userDtl->profilePic;
            }else{
                $profilePic='https://www.computerhope.com/jargon/g/guest-user.jpg';
            }

        $verificationReviewDone=0;
        if($userDtl->viewKycDetails && $userDtl->viewPersonalDetails && $userDtl->viewBankDetails){
            $verificationReviewDone=1;
        }
        @endphp
        <section class="dash_right_tophead">
            <div class="card hr-card-body hrcardtop_profile">
                <div class="row aligncuscard_row">
                    <div class="col-lg-6 right_borderdashed">
                        <div class="row profile_marketingexu hr-profile_marketingexu">
                            <div class="col-lg-4">
                                <div class="profile_circle hr_profile_circle">
                                    <img class="rounded-full" style="width: 114px;height: 114px;object-fit: cover;"  src="{{$profilePic}}" alt="avatar">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="content_profile hr-content_profile">
                                    <h3 class="hr-user-name m-t-0 mb-0">{{ucwords($userDtl->name)}}</h3>
                                    <div class="staff-id">Customer ID : {{$userDtl->customerCode}}</div>
                                    <h2>DOB : {{(strtotime($userDtl->dateOfBirth)) ? date('d/m/Y',strtotime($userDtl->dateOfBirth)) : 'NA'}}</h2>
                                    @if($pageNameStr=='kyc-verified-customers' || $pageNameStr=='final-credit-assessment')
                                        <div class="staff-id">Deviation : <a href="javascript:;" style="color: blue;" onclick="$('#daviationAnalysisModal').modal('show')">Click Here</a></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pro-edit"></div>
                        <ul class="hr-personal-info topcard_rightpadding">
                            <li style="margin-top: 23px;">
                                <div class="title"> Customer Mobile Number:</div>
                                <div class="text">{{(!empty($userDtl)) ? $userDtl->mobile : 'NA'}}</div>
                            </li>
                            <li style="margin-top: 23px;">
                                <div class="title"> Customer Email:</div>
                                <div class="text">{{(!empty($userDtl)) ? $userDtl->email : 'NA'}}</div>
                            </li>
                            <li style="margin-top: 23px;">
                                <div class="title"> Customer ID:</div>
                                <div class="text">{{(!empty($userDtl)) ? $userDtl->customerCode : 'NA'}}</div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </section>

        <div class="row" id="employee_tabstable">
           
            <div class="col-lg-12" id="hr_tabsprofilestart">
                <div class="card">
                    <ul class="nav nav-tabs formtabs_menu hrprogilemain_tabs" id="overflow_tabs">
                        <li class="nav-item m-l-10">
                            <a class="nav-link active" data-bs-toggle="tab" href="javascript:;" onclick="getProfileDetailsHtml('customerinfo')">Customer Info</a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link" data-bs-toggle="tab" href="javascript:;" onclick="getProfileDetailsHtml('coApplicantDetails')">Co Applicant<br>(Guarantor) Info</a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link " data-bs-toggle="tab" id="companyTabBtn" href="javascript:;" onclick="getProfileDetailsHtml('businessDetails')">Business/Company Details</a>
                        </li>

                        <li class="nav-item m-l-10">
                            <a class="nav-link" data-bs-toggle="tab" href="javascript:;" onclick="getProfileDetailsHtml('kycDetails')">KYC</a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link" data-bs-toggle="tab" href="javascript:;" onclick="getProfileDetailsHtml('bankinfo')">Customer Bank Information</a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link" data-bs-toggle="tab" href="javascript:;" onclick="getProfileDetailsHtml('beureuReport')" >Beureu Reports</a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link" data-bs-toggle="tab" href="javascript:;" onclick="getProfileDetailsHtml('customerLoansList')" >Customer Loans</a>
                        </li>
                    </ul>
                    <div class="tab-content empform_tabcontent" id="hrdash_profiletab_content">
                        
                        

                    </div>
                    <div class="tab-content empform_tabcontent">
                        <div class="row mt-5">
                            <div class="col-md-12 row">
                                <div class="col-md-6">&nbsp;</div>
                                <div class="col-md-3">
                                    @if($userDtl->kycStatus=='approved')
                                        <label class="btn btn-success btn-xs" style="float: right;cursor: default;">KYC Approved </label>
                                    @elseif($userDtl->kycStatus=='rejected')
                                        <label class="btn btn-danger btn-xs" style="float: right;cursor: default;">KYC Rejected  </label>
                                    @endif
                                </div>

                                
                            </div>
                            
                            <div class="col-md-12 row">
                                @if(!empty($userEmploymentHistory) && ($pageNameStr=='employment-verification' || $pageNameStr=='employment-verification-rejected'))
                                    @if($userEmploymentHistory->status=='pending')
                                        <div class="col-md-3">
                                            @if($verificationReviewDone)
                                                <a href="javascript:;" onclick="approveUserEmployment({{$userEmploymentHistory->id}},1);" class="btn btn-success btn-icon-text"> <i class="btn-icon-prepend" data-feather="check-square"></i> Approve For Credit Assessment </a>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <a href="javascript:;" onclick="approveUserEmployment({{$userEmploymentHistory->id}},2);" class="btn btn-danger btn-icon-text"> Reject For Credit Assessment<i class="btn-icon-append" data-feather="x"></i></a>
                                        </div>
                                    @elseif($userEmploymentHistory->status=='rejected')
                                        {{--<a href="javascript:;" onclick="approveUserEmployment({{$userEmploymentHistory->id}},1);" class="btn btn-success btn-icon-text"> <i class="btn-icon-prepend" data-feather="check-square"></i> Approve for Employment </a>--}}
                                    @endif
                                @endif
                            </div>

                        </div>

                    </div>
                    
                </div>
            </div>
        </div>

    </main>

    <div class="modal fade" id="rejectKycModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectKycModalHeading">Reject KYC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="rejectUser">
                        <input type="hidden" id="rejectVerifyType">
                        <div class="col-lg-12">
                            <label>Enter Remark</label>
                            <textarea name="rejectReason" id="rejectReason" class="form-control" rows="8"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="javascript:void(0);" onclick="rejectKyc();" id="rejectKycBtn" class="btn btn-danger">Reject KYC</a>
                    <a href="javascript:void(0);" onclick="approveKyc();" id="approveKycBtn" class="btn btn-success">Approve KYC</a>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectKycModalDisbursement" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectKycModalDisbursementHeading">Reject Disbursement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="rejectUserDisbursement">
                        <input type="hidden" id="rejectLoanIdDisbursement">
                        <div class="col-lg-12">
                            <label>Enter Remark</label>
                            <textarea name="rejectReasonDisbursement" id="rejectReasonDisbursement" class="form-control" rows="8"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="javascript:void(0);" onclick="rejectDisbursement();" class="btn btn-danger">Reject Disbursement</a>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectEmploymentModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectEmploymentModalHeading">Reject Employment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="rejectUserEmployment">
                        <div class="col-lg-12">
                            <label>Enter Remark</label>
                            <textarea name="rejectReasonEmployment" id="rejectReasonEmployment" class="form-control" rows="8"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="javascript:void(0);" onclick="rejectEmployment();" id="rejectEmploymentBtn" class="btn btn-danger">Reject For Credit Assessment</a>
                    <a href="javascript:void(0);" onclick="approveEmployment();" id="approveEmploymentBtn" class="btn btn-success">Approve For Credit Assessment</a>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmAmountForDisbursementModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Review Loan Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div id="confirmAmountForDisbursementModalHtml">

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="disburseAmountModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1142px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Review Loan Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div id="disburseAmountModalHtml">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateEmpInfoModal" tabindex="-1" aria-labelledby="updateEmpInfoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Employment Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body" id="updateEmpInfoModalHtml">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="javascript:void(0);" onclick="updateEmpInfoModalBtn();" class="btn btn-success updateEmpInfoModalBtn">Update Info</a>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="adUpdatePersonalDiscussionInfoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                        Personal Discusstion Info.
                    </h3>
                    <button @click="showModal = !showModal" data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="form_boxmodal">

                    <div class="form-wizard">
                        <div class="myContainer">
                            <div class="form-container animated">
                                <div class="head_ledtright">
                                    <h2 class="text-center form-title">Personal Information</h2>
                                </div>
                                <div class="personalDiscusstionInfoHtml">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- wizard end -->
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="initiateApplyLoanModal" tabindex="-1" aria-labelledby="updateEmpInfoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apply Loan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                </div>

                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="sendForCustomerConsentFrm">
                        <input type="hidden" id="initiateApplyLoanUserId" name="initiateApplyLoanUserId">
                        @csrf
                        <div id="initiateApplyLoanModalBody"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="cashFlowAnalysisModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                            Cash Flow Analysis
                        </h3>
                        <button @click="showModal = !showModal" data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="form_boxmodal">

                        <div class="form-wizard">
                            <div class="myContainer">
                                <div class="form-container animated">
{{--                                    <div class="head_ledtright">--}}
{{--                                        <h2 class="text-center form-title">Cash Flow Analysis</h2>--}}
{{--                                    </div>--}}
                                    <div class="cashFlowAnalysisModalHtml row">
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Source Of Income</span>
                                                <input id="sourceOfIncome" name="sourceOfIncome" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Sale</span>
                                                <input id="cfaSale" name="cfaSale" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Margin %</span>
                                                <input id="cfaMargin" name="cfaMargin" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Gross Margin</span>
                                                <input id="cfaGrossMargin" name="cfaGrossMargin" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Amount Available</span>
                                                <input id="cfaAmountAvailable" name="cfaAmountAvailable" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Electricity Bill Of Residence</span>
                                                <input id="cfaElectricityBillOfResidence" name="cfaElectricityBillOfResidence" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Electricity Bill Of Business</span>
                                                <input id="cfaElectricityBillOfBusiness" name="cfaElectricityBillOfBusiness" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Residence/ Business Premises Rent</span>
                                                <input id="cfaResidenceBusinessPermissesRent" name="cfaResidenceBusinessPermissesRent" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Household Expense</span>
                                                <input id="cfaHouseHoldExpense" name="cfaHouseHoldExpense" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Salary</span>
                                                <input id="cfaSalary" name="cfaSalary" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Misc. Expenses </span>
                                                <input id="cfaMiscExpenses" name="cfaMiscExpenses" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>School Fees</span>
                                                <input id="cfaSchoolFee" name="cfaSchoolFee" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Gross Amount Available</span>
                                                <input id="cfaGrossAmountAvailable" name="cfaGrossAmountAvailable" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Running EMI</span>
                                                <input id="cfaRunningEmi" name="cfaRunningEmi" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Credit Card EMI</span>
                                                <input id="cfaCreditCardEMi" name="cfaCreditCardEMi" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Proposed EMI</span>
                                                <input id="cfaProposedEmi" name="cfaProposedEmi" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Net Amount Available</span>
                                                <input id="cfaNetAmountAvailable" name="cfaNetAmountAvailable" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>FOIR</span>
                                                <input id="cfaFOIR" name="cfaFOIR" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>Net Monthly Income</span>
                                                <input id="cfaNetMonthlyIncome" name="cfaNetMonthlyIncome" disabled style="cursor: not-allowed" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- wizard end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="daviationAnalysisModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                            Deviation Records
                        </h3>
                        
                        <button @click="showModal = !showModal" data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="form_boxmodal">

                        <div class="form-wizard">
                            <div class="myContainer">
                                <div class="form-container animated">
                                    <div class="daviationAnalysisModalHtml row">
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>
                                                <input id="deviationLoanAmount" value="yes" <?php if(!empty($DeviationRecord)) { if($DeviationRecord->deviationLoanAmount=='yes'){ echo 'checked'; } } ?> name="deviationLoanAmount"  type="checkbox">
                                                &nbsp;Loan Amount not beyond 60 lacs</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>
                                                <input id="deviationLoanTenure" value="yes" <?php if(!empty($DeviationRecord)) { if($DeviationRecord->deviationLoanTenure=='yes'){ echo 'checked'; } } ?> name="deviationLoanTenure" type="checkbox">
                                                &nbsp;Tenure not beyond 12 months</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>
                                                <input id="deviationNegativePD" value="yes" <?php if(!empty($DeviationRecord)) { if($DeviationRecord->deviationNegativePD=='yes'){ echo 'checked'; } } ?> name="deviationNegativePD" type="checkbox">
                                                &nbsp;Negative PD</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>
                                                <input id="deviationNegativeCibil" value="yes" <?php if(!empty($DeviationRecord)) { if($DeviationRecord->deviationNegativeCibil=='yes'){ echo 'checked'; } } ?> name="deviationNegativeCibil" type="checkbox">
                                                &nbsp;Negative Cibil</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>
                                                <input id="deviationNegativeCpvFI" value="yes" <?php if(!empty($DeviationRecord)) { if($DeviationRecord->deviationNegativeCpvFI=='yes'){ echo 'checked'; } } ?> name="deviationNegativeCpvFI" type="checkbox">
                                                &nbsp;Negative CPV / FI</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>
                                                <input id="deviationNegativeEligibility" value="yes" <?php if(!empty($DeviationRecord)) { if($DeviationRecord->deviationNegativeEligibility=='yes'){ echo 'checked'; } } ?> name="deviationNegativeEligibility" type="checkbox">
                                                &nbsp;Negative Eligibility </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="block">
                                                <span>
                                                <input id="deviationNegativeProfile"  value="yes" <?php if(!empty($DeviationRecord)) { if($DeviationRecord->deviationNegativeProfile=='yes'){ echo 'checked'; } } ?> name="deviationNegativeProfile" type="checkbox">
                                                &nbsp;Negative Profile</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <label class="block">
                                                Deviation Remark
                                            </label>
                                            <textarea class="form-control" rows="5" id="overAllDeviationRemark" name="overAllDeviationRemark"><?php if(!empty($DeviationRecord)) { echo $DeviationRecord->overAllDeviationRemark; } ?></textarea>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- wizard end -->
                    </div>
                    <div class="modal-footer">
                         <button type="button" onclick="saveDeviationInfo();" class="btn bg-info btn-info text-white">Save Deviation</button>
                         <button type="button" onclick="$('#daviationAnalysisModal').modal('hide')" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="rejectForCustomerConsentModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject For Customer Consent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="rejectForCustomerConsentLoanId">
                            <label>Reason</label>
                            <textarea class="form-control" id="rejectForCustomerConsentRemark" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger bg-danger" onclick="rejectForCustomerConsentBtn();">Reject</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newCoApplicant" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                        New Co-Applicant
                    </h3>
                    <button @click="showModal = !showModal" data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="form_boxmodal">

                    <div class="form-wizard">
                        <div class="myContainer">
                            <div class="form-container animated">
                                <form id="personalFormCoApplicantEdit" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="recordId" id="coApplicantOdUserId" class="" value="{{$userDtl->id}}">
                                    <input type="hidden" name="actionTrigger" id="actionTrigger" class="" value="save">
                                    @csrf
                                    <div class="mainfrm_box">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Title</span>
                                                    <select id="nameTitleCoApp" name="nameTitleCoApp" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="">Select</option>
                                                        <option value="Mr.">Mr. </option>
                                                        <option value="Ms.">Ms. </option>
                                                        <option value="Mrs.">Mrs. </option>
                                                        <option value="Smt.">Smt. </option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Name</span>
                                                    <input id="customerNameCoApp" name="customerNameCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder=" " type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Gender</span>
                                                    <select id="genderCoApp" name="genderCoApp"
                                                            class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    >
                                                        <option value="">Select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="customdateinp">
                                                    <span>DOB</span>
                                                    <input id="dateOfBirthECoApp" name="dateOfBirthCoApp" x-flatpickr="" class="form-input mt-1.5 peer w-full rounded-lg border border-slate-300 bg-transparent py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input" placeholder="Choose date..." type="text" readonly="readonly">
                                                    <div class="pointer-events-none absolute calender_iconinp flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Religion</span>
                                                    <input id="religionCoApp" name="religionCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Education Status</span>
                                                    <input id="educationStatusCoApp" name="educationStatusCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Father Name</span>
                                                    <input id="fatherNameCoApp" name="fatherNameCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Mother Name</span>
                                                    <input id="motherNameCoApp" name="motherNameCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Marital Status</span>
                                                    <select id="maritalStatusCoApp" name="maritalStatusCoApp" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="">Select</option>
                                                        <option value="Married">Married </option>
                                                        <option value="Unmarried">Unmarried </option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Relation With Applicant</span>
                                                    <input id="relationWithApplicantCoApp" name="relationWithApplicantCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Cibil Score</span>
                                                    <input id="cibilScoreCoApp" name="cibilScoreCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group text-right mar-b-0 nextbtn_brx personalFormBtnNECoApp" style="display: none;">
                                        <input type="button" id="personalFormBtnNEApp" value="NEXT" class="btn btn-primary next btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    </div>
                                    <div class="form-group text-right mar-b-0">
                                        <input type="reset" onclick="$('#newCoApplicant').modal('hide')" value="Close" class="btn btn-default back btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                        <button type="submit" name="personalFormBtnApp" id="personalFormBtnEApp" class="btn btn-primary btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- wizard end -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payEmiModal" tabindex="-1" aria-labelledby="payEmiModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pay Emi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                </div>
 
                <div class="modal-body">
                    <input type="hidden" id="payEmiId" name="payEmiId">
                        <input type="hidden" id="payEmiLoanId" name="payEmiLoanId">
                        <div class="form-group text-center mb-3">
                            <label id="payEmiIdTxt"></label>
                        </div>
                        <div class="form-group mb-3">
                            <label>EMI collected date</label>
                            <input type="date" id="emiTransactionDate" class="form-control">
                        </div>
                         <div class="form-group mb-3">
                            <label>Payment Mode</label>
                            <input type="text" id="emiPayMode" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Transaction Id</label>
                            <input type="text" id="emiTxnId" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Late Charge</label>
                            <input type="number" id="emiLateCharges" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success bg-success" onclick="markAsPaidThisEmi();">Mark As Paid</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="disbursedDocsUpload" tabindex="-1" role="dialog" aria-labelledby="disbursedDocsUploadTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="disbursedDocsUploadForm" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Disbursed Document Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="recordId" value="{{$userDtl->id}}">
            <div class="row mb-5">
                <div class="col-md-12" id="disbursedDocsFieldAdd">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Document Title</label>
                                <input type="text" name="disbursed_title[]" class="form-control">
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Document </label>
                                <input type="file" name="disbursed_file[]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2 text-right">
                    <button type="button" onclick="docsAddMore();" class="btn btn-warning bg-warning float-right">Add More Other Docs</button>
                    <!-- <button type="button" onclick="docsRemoveLast();" class="btn btn-danger bg-danger">Remove</button> -->
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" style="background:#0d6efd;">Save</button>
            </div>
            </div>
        </form>
        </div>
        </div>
@endsection

@section('scripts')
    <script>
    $(document).ready(function(){
        @if(($pageNameStr=='kyc-verified-customers' || $pageNameStr=='final-credit-assessment') && $deviationShow)
            $('#daviationAnalysisModal').modal('show');
        @endif
    });
    
    function rejectForCustomerConsent(loanId)
    {
        $('#rejectForCustomerConsentLoanId').val(loanId);
        $('#rejectForCustomerConsentModal').modal('show');
    }

    function payEmiModalOpen(emiId,loanId)
        {
            $('#payEmiId').val(emiId);
            $('#payEmiLoanId').val(loanId);
            $('#payEmiIdTxt').html('Please enter the following details to mark as paid for emi Id '+$('#emiPayBtn'+emiId).attr('data-emiid')).css('color','red');
            $('#payEmiModal').modal('show');
            $('#emiDetails').modal('hide');
        }

        function markAsPaidThisEmi()
        {
            var payEmiId=$('#payEmiId').val();
            var payEmiLoanId=$('#payEmiLoanId').val();
            var emiPayMode=$('#emiPayMode').val();
            var transactionDate=$('#emiTransactionDate').val();
            var emiTxnId=$('#emiTxnId').val();
            var emiLateCharges=$('#emiLateCharges').val();
            if(!payEmiId || !payEmiLoanId)
            {
                alertMessage('Error!', 'Invalid request.', 'error', 'no');
                return false;
            }else if(!transactionDate)
            {
                alertMessage('Error!', 'Please select emi colleted date.', 'error', 'no');
                return false;
            }else if(!emiPayMode)
            {
                alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
                return false;
            }else if(!emiTxnId)
            {
                alertMessage('Error!', 'Please enter transaction Id.', 'error', 'no');
                return false;
            }else{
                waitForProcess();
                $.post('{{route('markAsPaidThisEmi')}}',{
                    "_token": "{{ csrf_token() }}",
                    payEmiId:payEmiId,
                    emiPayMode:emiPayMode,
                    emiTxnId:emiTxnId,
                    emiLateCharges:emiLateCharges,
                    transactionDate:transactionDate,
                },function (data){
                    var obj = JSON.parse(data);
                    
                    if(obj.status=='success')
                    {          
                        getLoanEmiDetails(payEmiLoanId);
                        $('#payEmiModal').modal('hide');
                        alertMessage('Success!', obj.message, 'success', 'no');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }
    
        function rejectForCustomerConsentBtn()
        {
            var rejectForCustomerConsentLoanId=$('#rejectForCustomerConsentLoanId').val();
            var rejectForCustomerConsentRemark=$('#rejectForCustomerConsentRemark').val();
            
            if(!parseInt(rejectForCustomerConsentLoanId))
            {
                alertMessage('Error!', "Invalid Reques, Please try again.", 'error', 'no');
                return false;
            }else if(!$.trim(rejectForCustomerConsentRemark))
            {
                alertMessage('Error!', "Please enter the reason for reject.", 'error', 'no');
                return false;
            }else{
                $.post('{{route('rejectForCustomerConsent')}}',{
                    "_token": "{{ csrf_token() }}",
                    rejectForCustomerConsentLoanId:rejectForCustomerConsentLoanId,
                    rejectForCustomerConsentRemark:rejectForCustomerConsentRemark,
                },function (data){
                    var obj = JSON.parse(data);
                    if(obj.status=='success')
                    {
                        alertMessage('Success!', obj.message, 'success', 'no');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });   
            }
        }
        
        function saveDeviationInfo()
        {
            
            var deviationLoanAmount=$('#deviationLoanAmount:checked').val();
            var deviationLoanAmountR=$('#deviationLoanAmountR').val();
            var deviationLoanTenure=$('#deviationLoanTenure:checked').val();
            var deviationLoanTenureR=$('#deviationLoanTenureR').val();
            var deviationNegativePD=$('#deviationNegativePD:checked').val();
            var deviationNegativePDR=$('#deviationNegativePDR').val();
            var deviationNegativeCibil=$('#deviationNegativeCibil:checked').val();
            var deviationNegativeCibilR=$('#deviationNegativeCibilR').val();
            var deviationNegativeCpvFI=$('#deviationNegativeCpvFI:checked').val();
            var deviationNegativeCpvFIR=$('#deviationNegativeCpvFIR').val();
            var deviationNegativeEligibility=$('#deviationNegativeEligibility:checked').val();
            var deviationNegativeEligibilityR=$('#deviationNegativeEligibilityR').val();
            var deviationNegativeProfile=$('#deviationNegativeProfile:checked').val();
            var deviationNegativeProfileR=$('#deviationNegativeProfileR').val();
            var overAllDeviationRemark=$('#overAllDeviationRemark').val();

            $.post('{{route('saveDeviationInfo')}}',{
                "_token": "{{ csrf_token() }}",
                userId:'{{$userDtl->id}}',
                deviationLoanAmount:deviationLoanAmount,
                deviationLoanAmountR:deviationLoanAmountR,
                deviationLoanTenure:deviationLoanTenure,
                deviationLoanTenureR:deviationLoanTenureR,
                deviationNegativePD:deviationNegativePD,
                deviationNegativePDR:deviationNegativePDR,
                deviationNegativeCibil:deviationNegativeCibil,
                deviationNegativeCibilR:deviationNegativeCibilR,
                deviationNegativeCpvFI:deviationNegativeCpvFI,
                deviationNegativeCpvFIR:deviationNegativeCpvFIR,
                deviationNegativeEligibility:deviationNegativeEligibility,
                deviationNegativeEligibilityR:deviationNegativeEligibilityR,
                deviationNegativeProfile:deviationNegativeProfile,
                deviationNegativeProfileR:deviationNegativeProfileR,
                overAllDeviationRemark:overAllDeviationRemark,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success')
                {
                    alertMessage('Success!', obj.message, 'success', 'no');
                    return false;
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
            
        }
        
        function approveUserKyc(userId,status,verifytype='business')
        {
            if(status==1)
            {
                $('#rejectUser').val(userId);
                $('#rejectReason').val('');
                $('#rejectVerifyType').val(verifytype)
                $('#rejectKycModalHeading').html('Approve Kyc');
                $('#rejectKycBtn').hide();
                $('#approveKycBtn').show();
                $('#rejectKycModal').modal('show');
            }else{
                $('#rejectKycModalHeading').html('Reject Kyc');
                $('#rejectUser').val(userId);
                $('#rejectReason').val('');
                $('#rejectVerifyType').val(verifytype)
                $('#approveKycBtn').hide();
                $('#rejectKycBtn').show();
                $('#rejectKycModal').modal('show');
            }
        }

        function rejectKyc()
        {
            var userId=$('#rejectUser').val();
            var rejectReason=$('#rejectReason').val();
            if(!parseInt(userId)){
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!$.trim(rejectReason)){
                alertMessage('Error!', 'Please enter the reason for reject.', 'error', 'no');
                return false;
            }else{
                swal({
                    title: 'Warning!',
                    //text: 'Are you sure want to reject this KYC details?',
                    text: 'Are you sure want to reject file for employment verification?',
                    icon: 'warning',
                    buttons:true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        saveKycStatus(userId,2,rejectReason);
                    }
                });
            }
        }

        function excludePlateformFeeAmount(){
            let excludePlateformFee = parseInt($("#excludePlateformFee").val());
            var approvedAmount= parseInt($('#approvedAmount').val());
            var plateformFee= parseInt($('#plateformFee').val());
            var insurance= parseInt($('#insurance').val());

            if($("#excludePlateformFee").prop('checked') == true){
                $("#netDisbursementAmount").val(approvedAmount - (plateformFee+insurance));
            }else{
                $("#netDisbursementAmount").val(approvedAmount);
            }
        }

        function approveKyc()
        {
            var userId=$('#rejectUser').val();
            var rejectReason=$('#rejectReason').val();
            var verifytype = $("#rejectVerifyType").val();
            if(!parseInt(userId)){
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else{

                swal({
                    title: 'Warning!',
                    //text: 'Are you sure want to approve this KYC details?',
                    text: 'Are you sure want to approve file for business verification?',
                    icon: 'warning',
                    buttons:true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        saveKycStatus(userId,1,rejectReason,verifytype);
                    }
                });
            }
        }

        function saveKycStatus(userId,status,remark,verifyType='business')
        {
            waitForProcess();
            $.post('{{route('saveKycStatus')}}',{
                "_token": "{{ csrf_token() }}",
                userId:userId,
                status:status,
                remark:remark,
                verifyType:verifyType,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success')
                {
                    $('#rejectUser').val('');
                    $('#rejectReason').val('');
                    $('#rejectKycModalHeading').html('');
                    $('#rejectKycModal').modal('hide');
                    alertMessage('Success!', obj.message, 'success', 'yes');
                    return false;
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }

        function approveUserEmployment(userId,status)
        {
            if(status==1)
            {
                $('#rejectUserEmployment').val(userId);
                $('#rejectReasonEmployment').val('');
                $("#rejectEmploymentBtn").hide();
                $("#approveEmploymentBtn").show();
                $('#rejectEmploymentModalHeading').html('Approve Business');
                $('#rejectEmploymentModal').modal('show');
            }else{
                $('#rejectUserEmployment').val(userId);
                $('#rejectReasonEmployment').val('');
                $("#approveEmploymentBtn").hide();
                $("#rejectEmploymentBtn").show();
                $('#rejectEmploymentModalHeading').html('Reject Business');
                $('#rejectEmploymentModal').modal('show');
            }
        }


        function approveEmployment()
        {
            var userId=$('#rejectUserEmployment').val();
            var rejectReason=$('#rejectReasonEmployment').val();
            if(!parseInt(userId)){
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else{
                swal({
                    title: 'Warning!',
                    //text: 'Are you sure want to approve this Professional details?',
                    text: 'Are you sure want to approve business & send file for credit assessment?',
                    icon: 'warning',
                    buttons:true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        saveEmploymentStatus(userId,1,rejectReason);
                    }
                });
            }
        }

        function rejectEmployment()
        {
            var userId=$('#rejectUserEmployment').val();
            var rejectReason=$('#rejectReasonEmployment').val();
            if(!parseInt(userId)){
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!$.trim(rejectReason)){
                alertMessage('Error!', 'Please enter the reason for reject.', 'error', 'no');
                return false;
            }else{
                swal({
                    title: 'Warning!',
                    //text: 'Are you sure want to reject this Employment details?',
                    text: 'Are you sure want to reject file for business?',
                    icon: 'warning',
                    buttons:true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        saveEmploymentStatus(userId,2,rejectReason);
                    }
                });
            }
        }

        function saveEmploymentStatus(userId,status,remark)
        {
            waitForProcess();
            $.post('{{route('saveEmploymentStatus')}}',{
                "_token": "{{ csrf_token() }}",
                userId:userId,
                status:status,
                remark:remark,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success')
                {
                    $('#rejectUserEmployment').val('');
                    $('#rejectReasonEmployment').val('');
                    $('#rejectEmploymentModal').modal('hide');
                    alertMessage('Success!', obj.message, 'success', 'yes');
                    return false;
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }

        function approveUserDisbursement(userId,loanId,status)
        {
            if(status==1)
            {
                var approvedROI=$('#approvedROI').val();
                var approvedAmount=$('#approvedAmount').val();
                var approveTenure=$('#approveTenure').val();
                if(!parseInt(loanId)){
                    alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                    return false;
                }else if(!$.trim(approvedAmount)){
                    alertMessage('Error!', 'Please enter amount to be approved.', 'error', 'no');
                    return false;
                }else if(!$.trim(approvedROI))
                {
                    alertMessage('Error!', 'Please enter rate of interest to be approved.', 'error', 'no');
                    return false;
                }else if(!$.trim(approveTenure))
                {
                    alertMessage('Error!', 'Please select tenure.', 'error', 'no');
                    return false;
                }else{
                    swal({
                        title: 'Warning!',
                        text: 'Are you sure want to send for customer approval?',
                        icon: 'warning',
                        buttons:true,
                        closeOnClickOutside: false,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.post('{{route('sendLoanForCustomerApproval')}}',{
                                "_token": "{{ csrf_token() }}",
                                userId:userId,
                                status:status,
                                loanId:loanId,
                                approvedROI:approvedROI,
                                approvedAmount:approvedAmount,
                                approveTenure:approveTenure,
                            },function (data){
                                var obj = JSON.parse(data);
                                if(obj.status=='success')
                                {
                                    $('#confirmAmountForDisbursementModal').modal('hide');
                                    alertMessage('Success!', obj.message, 'success', 'yes');
                                    return false;
                                }else{
                                    alertMessage('Error!', obj.message, 'error', 'no');
                                    return false;
                                }
                            });
                        }
                    });
                }
            }else{
                $('#rejectUserDisbursement').val(userId);
                $('#rejectLoanIdDisbursement').val(loanId);
                $('#rejectReasonDisbursement').val('');
                $('#rejectKycModalDisbursement').modal('show');
            }
        }

        function rejectDisbursement()
        {
            var userId=$('#rejectUserDisbursement').val();
            var loanId=$('#rejectLoanIdDisbursement').val();
            var rejectReason=$('#rejectReasonDisbursement').val();
            if(!parseInt(userId)){
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!$.trim(rejectReason)){
                alertMessage('Error!', 'Please enter the reason for reject.', 'error', 'no');
                return false;
            }else{
                swal({
                    title: 'Warning!',
                    text: 'Are you sure want to reject for disbursement?',
                    icon: 'warning',
                    buttons:true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        saveDisbursementStatus(userId,loanId,2,rejectReason);
                    }
                });
            }
        }

        function saveDisbursementStatus(userId,loanId,status,remark)
        {
            waitForProcess();
            $.post('{{route('saveDisbursementStatus')}}',{
                "_token": "{{ csrf_token() }}",
                userId:userId,
                loanId:loanId,
                status:status,
                remark:remark,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success')
                {
                    $('#rejectUserDisbursement').val('');
                    $('#rejectLoanIdDisbursement').val('');
                    $('#rejectReasonDisbursement').val('');
                    $('#rejectKycModalDisbursement').modal('hide');
                    alertMessage('Success!', obj.message, 'success', 'yes');
                    return false;
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }

        function scheduleDisburse(userId)
        {
            var loanIdDisburse=$('#loanIdDisburse').val();
            var productIdDisburse=$('#productIdDisburse').val();
            var disburseDate=$('#disburseDate').val();
            if($("#includeExtraDaysData").is(':checked')){
                var includeExtraDaysData= 1;
            }else{
                var includeExtraDaysData= 0;
            }
            if(!parseInt(loanIdDisburse)){
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!parseInt(productIdDisburse)){
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!$.trim(disburseDate)){
                alertMessage('Error!', 'Please select disburse date.', 'error', 'no');
                return false;
            }else{
                swal({
                    title: 'Warning!',
                    text: 'Are you sure want to schedule disbursement for '+disburseDate+' date?',
                    icon: 'warning',
                    buttons:true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.post('{{route('scheduleLoanDisburse')}}',{
                            "_token": "{{ csrf_token() }}",
                            userId:userId,
                            loanId:loanIdDisburse,
                            productId:productIdDisburse,
                            disburseDate:disburseDate,
                            includeExtraDaysData:includeExtraDaysData
                        },function (data){
                            var obj = JSON.parse(data);
                            if(obj.status=='success')
                            {
                                $('#disburseAmountModal').modal('hide');
                                alertMessage('Success!', obj.message, 'success', 'yes');
                                return false;
                            }else{
                                alertMessage('Error!', obj.message, 'error', 'no');
                                return false;
                            }
                        });
                    }
                });
            }
        }

        function previewScheduleDisburse(loanId){
            let current_month = $("#disburseDate").val();
            let productIdDisburse = $("#productIdDisburse").val();
            $.post('{{route('previewEMIDetails')}}',{
                "_token": "{{ csrf_token() }}",
                current_month:current_month,
                loanId:loanId,
                productId:productIdDisburse
            },function (data){
                $("#scheduleDisbursePreviewData").html(data.htmldata);
                $("#includeextraDays").css({"display": "block"});
                $("#includeExtraDaysData").attr('data-eday',data.extradays);
                $("#paidInterestAlr").text('Yes ('+data.paidInterest+')');
                includeExtraDaysAmount(loanId);
            });

        }

        function includeExtraDaysAmount(loanId){
            let extradaysamount = $("#includeExtraDaysData").attr('data-eday');
            let netdamount =  $("#previewNetDisbursAmount").text();
            let final_netdamount = parseFloat($("#includeExtraDaysData").attr('data-netd'));
            if($("#includeExtraDaysData").is(':checked')){
                let totalnetd = final_netdamount-parseFloat(extradaysamount);
               $("#previewNetDisbursAmount").text(totalnetd.toFixed(2));
            }else{
               $("#previewNetDisbursAmount").text(final_netdamount.toFixed(2));
            }
        }


        function displayMpin()
        {
            <?php if(in_array('all',$userPermissions) || in_array('view-mpin',$userPermissions)){ ?>
            swal({
                title: "MPIN : <?=($userDtl->userMpin) ? $userDtl->userMpin : 'NA'?>",
                icon: 'info',
                closeOnClickOutside: false,
            });
            <?php }else{ ?>
            swal({
                title: "Sorry!",
                text: "You don't have access to view MPIN.",
                icon: 'error',
                closeOnClickOutside: false,
            });
            <?php } ?>
        }

        function confirmAmountForDisbursement(loanId){
            $('#confirmAmountForDisbursementModalHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
            $('#confirmAmountForDisbursementModal').modal('show');
            $.post('{{route('confirmAmountForDisbursement')}}',{
                "_token": "{{ csrf_token() }}",
                loanId:loanId,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success')
                {
                    $('#confirmAmountForDisbursementModalHtml').html(obj.data);
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    $('#confirmAmountForDisbursementModal').modal('hide');
                    return false;
                }
            });
        }

        function getLoanDetailsForScheduleDisbursement(loanId){
            $('#disburseAmountModalHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
            $('#disburseAmountModal').modal('show');
            $.post('{{route('getLoanDetailsForScheduleDisbursement')}}',{
                "_token": "{{ csrf_token() }}",
                loanId:loanId,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success')
                {
                    $('#disburseAmountModalHtml').html(obj.data);
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    $('#disburseAmountModal').modal('hide');
                    return false;
                }
            });
        }

        

        function getUserEmploymentInfo(userId)
        {
            $('#updateEmpInfoModalHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
            $('#updateEmpInfoModal').modal('show');
            $.post('{{route('getUserEmploymentInfoForUpdate')}}',{
                "_token": "{{ csrf_token() }}",
                userId:userId,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('.updateEmpInfoModalBtn').show();
                    $('#updateEmpInfoModalHtml').html(obj.data);
                    $('#updateEmpInfoModal').modal('show');
                }else{
                    $('#updateEmpInfoModal').modal('hide');
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }

        function getUserCashFlowAnalysisDetailsByUser(userId)
        {
            $.post('{{route('getUserCashFlowAnalysisDetailsByUser')}}',{
                "_token": "{{ csrf_token() }}",
                userId:userId,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#sourceOfIncome').val(obj.cashFlowAnalysisDetails.sourceOfIncome);
                    $('#cfaSale').val(obj.cashFlowAnalysisDetails.cfaSale);
                    $('#cfaMargin').val(obj.cashFlowAnalysisDetails.cfaMargin);
                    $('#cfaGrossMargin').val(obj.cashFlowAnalysisDetails.cfaGrossMargin);
                    $('#cfaAmountAvailable').val(obj.cashFlowAnalysisDetails.cfaAmountAvailable);
                    $('#cfaElectricityBillOfResidence').val(obj.cashFlowAnalysisDetails.cfaElectricityBillOfResidence);
                    $('#cfaElectricityBillOfBusiness').val(obj.cashFlowAnalysisDetails.cfaElectricityBillOfBusiness);
                    $('#cfaResidenceBusinessPermissesRent').val(obj.cashFlowAnalysisDetails.cfaResidenceBusinessPermissesRent);
                    $('#cfaHouseHoldExpense').val(obj.cashFlowAnalysisDetails.cfaHouseHoldExpense);
                    $('#cfaSalary').val(obj.cashFlowAnalysisDetails.cfaSalary);
                    $('#cfaMiscExpenses').val(obj.cashFlowAnalysisDetails.cfaMiscExpenses);
                    $('#cfaSchoolFee').val(obj.cashFlowAnalysisDetails.cfaSchoolFee);
                    $('#cfaGrossAmountAvailable').val(obj.cashFlowAnalysisDetails.cfaGrossAmountAvailable);
                    $('#cfaRunningEmi').val(obj.cashFlowAnalysisDetails.cfaRunningEmi);
                    $('#cfaCreditCardEMi').val(obj.cashFlowAnalysisDetails.cfaCreditCardEMi);
                    $('#cfaProposedEmi').val(obj.cashFlowAnalysisDetails.cfaProposedEmi);
                    $('#cfaNetAmountAvailable').val(obj.cashFlowAnalysisDetails.cfaNetAmountAvailable);
                    $('#cfaFOIR').val(obj.cashFlowAnalysisDetails.cfaFOIR);
                    $('#cfaNetMonthlyIncome').val(obj.cashFlowAnalysisDetails.cfaNetMonthlyIncome);
                    $('#cashFlowAnalysisModal').modal('show');
                }else{
                    $('#cashFlowAnalysisModal').modal('hide');
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }

        function getUserEmploymentInfoWithAdminUpdate(userId)
        {
            $('#personalDiscusstionInfoHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
            $('#adUpdatePersonalDiscussionInfoModal').modal('show');
            $('#personalDiscusstionBtn').hide();
            $.post('{{route('getUserEmploymentInfoWithAdminUpdates')}}',{
                "_token": "{{ csrf_token() }}",
                userId:userId,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#personalDiscusstionInfoHtml').html(obj.data);
                    $('#adUpdatePersonalDiscussionInfoModal').modal('show');
                }else{
                    $('#adUpdatePersonalDiscussionInfoModal').modal('hide');
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }

        function getPersonalDiscussionDetails(userId)
        {
            $('#updateEmpInfoModalHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
            $('#updateEmpInfoModal').modal('show');
            $('.updateEmpInfoModalBtn').hide();
            $.post('{{route('getPersonalDiscussionDetailsWithAdminUpdate')}}',{
                "_token": "{{ csrf_token() }}",
                userId:userId,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#updateEmpInfoModalHtml').html(obj.data);
                    $('#updateEmpInfoModal').modal('show');
                    $('#personalDiscussionInfoFrm').submit(function(e) {
                        e.preventDefault();

                        var formData = new FormData(this);

                        var recordId=$('#recordId').val();

                        if(!recordId) {
                            alertMessage('Error!', 'Invalid Request.', 'error', 'no');
                            return false;
                        }else{
                            $('#personalDiscusstionBtn').text('Please Wait...').attr('disabled','disabled');
                            $.ajax({
                                type:'POST',
                                url: "{{route('savePersonalDiscussionInfo')}}",
                                data: formData,
                                cache:false,
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    var obj = JSON.parse(data);
                                    if(obj.status=='success')
                                    {
                                        alertMessage('Success!', obj.message, 'success', 'yes');
                                        return false;
                                    }else{
                                        $('#personalDiscusstionBtn').text('Submit').removeAttr('disabled');
                                        alertMessage('Error!', obj.message, 'error', 'no');
                                        return false;
                                    }
                                },
                                error: function(data){
                                    $('#personalDiscusstionBtn').text('Submit').removeAttr('disabled');
                                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                                    return false;
                                    //console.log(data);
                                }
                            });
                        }
                    });
                }else{
                    $('#updateEmpInfoModal').modal('hide');
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }

        function updateEmpInfoModalBtn()
        {
            var employerName=$('#em'+'employerName').val();
            var joiningDate=$('#em'+'joiningDate').val();
            var employeeId=$('#em'+'employeeId').val();
            var type=$('#em'+'type').val();
            var designation=$('#em'+'designation').val();
            var department=$('#em'+'department').val();
            var grossSalery=$('#em'+'grossSalery').val();
            var emailId=$('#em'+'emailId').val();
            var mobileNo=$('#em'+'mobileNo').val();
            var address=$('#em'+'address').val();
            var district=$('#em'+'district').val();
            var state=$('#em'+'state').val();
            var pincode=$('#em'+'pincode').val();
            var experienceInCurrentCompany=$('#em'+'experienceInCurrentCompany').val();
            $('.updateEmpInfoModalBtn').attr('disabled','disabled').text('Please Wait...');
            $.post('{{route('employmentInfoForUpdate')}}',{
                "_token": "{{ csrf_token() }}",
                userId:'{{$userDtl->id}}',
                employerName:employerName,
                joiningDate:joiningDate,
                employeeId:employeeId,
                type:type,
                designation:designation,
                department:department,
                grossSalery:grossSalery,
                emailId:emailId,
                mobileNo:mobileNo,
                address:address,
                district:district,
                state:state,
                pincode:pincode,
                experienceInCurrentCompany:experienceInCurrentCompany,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#updateEmpInfoModal').modal('hide');
                    alertMessage('Success!', obj.message, 'success', 'yes');
                    return false;
                }else{
                    $('.updateEmpInfoModalBtn').removeAttr('disabled').text('Update Info');
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }

        function roiTypeUpdate(){
            let paidFullInterest = $(".paidFullInterest");
            let loanCategory = $("#loanCategory").val();
            
            if((loanCategory=="1" || loanCategory=="2") && ($("#roiType").val() == 'reducing_roi' || $("#roiType").val() == 'fixed_interest_roi')){
                if(paidFullInterest.val() == undefined){
                $("#roiType").after(`<div class="paidFullInterest form-check">
                    <input class="form-check-input"  name="paidFullInterest" type="checkbox" value="1" id="paidFullInterest">
                    <label class="form-check-label" for="paidFullInterest">
                        Already Paid Full Interest
                    </label>
                </div>`);
            }
            }else{
                if(paidFullInterest){
                    paidFullInterest.remove();
                }
            }
        }
        setInterval(() => {
            roiTypeUpdate();
        }, 1500);

        function initiateApplyLoanEditForCustomerConsent(loanId)
        {
            $.post('{{route('initiateApplyLoanEditForCustomerConsent')}}',{
                "_token": "{{ csrf_token() }}",
                loanId:loanId,
                pageNameStr:'{{$pageNameStr}}',
            },function(data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#initiateApplyLoanModalBody').html(obj.data);
                    $('#initiateApplyLoanUserId').val(loanId);
                    $('#initiateApplyLoanModal').modal('show');

                    $('#sendForCustomerConsentFrm').submit(function(e) {
                        e.preventDefault();

                        var formData = new FormData(this);

                        var userId=$('#initiateApplyLoanUserId').val();
                        var loanCategory=$('#loanCategory').val();
                        var productName=$('#productName').val();
                        var approveTenure=$('#approveTenure').val();
                        var approvedAmount=$('#approvedAmount').val();
                        var approvedRoi=$('#approvedRoi').val();
                        var invoiceFile=$('#invoiceFile').val();
                        var validFromDate=$('#validFromDate').val();
                        var validToDate=$('#validToDate').val();
                        var plateformFee=$('#plateformFee').val();
                        var insurance=$('#insurance').val();
                        var invoiceFileOld=$('#invoiceFileOld').val();
                        var roiType=$('#roiType').val();
                        
                        if(!userId){
                            alertMessage('Error!', 'Invalid Request, Please try again', 'error', 'yes');
                            return false;
                        }else if(!loanCategory){
                            alertMessage('Error!', 'Please select category name.', 'error', 'no');
                            return false;
                        }else if(loanCategory!='3' && loanCategory!='4' && loanCategory!='8' && !productName){
                            alertMessage('Error!', 'Please select product name.', 'error', 'no');
                            return false;
                        }else if(loanCategory=='3' && !invoiceFile && !invoiceFileOld){
                            alertMessage('Error!', 'Please upload bill.', 'error', 'no');
                            return false;
                        }else if(loanCategory=='4' && !invoiceFile && !invoiceFileOld){
                            alertMessage('Error!', 'Please upload invoice.', 'error', 'no');
                            return false;
                        }else if(loanCategory=='3' && (!validFromDate || !validToDate)){
                            alertMessage('Error!', 'Please select valid from & valid to date.', 'error', 'no');
                            return false;
                        }else if(loanCategory!='3' && loanCategory!='4' && !roiType){
                            alertMessage('Error!', 'Please select ROI type.', 'error', 'no');
                            return false;
                        }else if(!approveTenure){
                            alertMessage('Error!', 'Please select tenure.', 'error', 'no');
                            return false;
                        }else if(!approvedAmount){
                            alertMessage('Error!', 'Please enter approved amount.', 'error', 'no');
                            return false;
                        }else if(!approvedRoi){
                            alertMessage('Error!', 'Please enter rate of interest.', 'error', 'no');
                            return false;
                        }else{
                            $('#initiateApplyLoanBtnFnBtn').text('Please Wait...').attr('disabled','disabled');
                            $('#initiateApplyLoanFrmResetBtn').text('Please Wait...').attr('disabled','disabled');
                            $.ajax({
                                type:'POST',
                                url: "{{route('sendForCustomerConsent')}}",
                                data: formData,
                                cache:false,
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    var obj = JSON.parse(data);
                                    if(obj.status=='success'){
                                        alertMessage('Success!', obj.message, 'success', 'yes');
                                        initiateApplyLoan(userId);
                                        return false;
                                    }else{
                                        $('#initiateApplyLoanBtnFnBtn').text('Send For Admin Approval').removeAttr('disabled');
                                        $('#initiateApplyLoanFrmResetBtn').text('Cancel').removeAttr('disabled');
                                        alertMessage('Error!', obj.message, 'error', 'no');
                                        return false;
                                    }
                                },
                                error: function(data){
                                    $('#initiateApplyLoanBtnFnBtn').text('Send For Admin Approval').removeAttr('disabled');
                                    $('#initiateApplyLoanFrmResetBtn').text('Cancel').removeAttr('disabled');
                                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                                    return false;
                                    //console.log(data);
                                }
                            });
                        }
                    });

                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }

        function initiateApplyLoanEditForAdminConsentRaw(loanId){
            $("#initiateApplyLoanEditForAdminConsentRaw").text('Please Wait...').attr('disabled','disabled');
            $.post("{{route('initiateApplyLoanEditForAdminConsentRaw')}}",{
                    "_token": "{{ csrf_token() }}",
                    loanId:loanId
                },function(data) {
                    var obj = JSON.parse(data);
                    if(obj.status=='success'){
                        alertMessage('Success!', obj.message, 'success', 'yes');
                        initiateApplyLoan(userId);
                        return false;
                    }else{
                        $('#initiateApplyLoanFrmResetBtn').text('Cancel').removeAttr('disabled');
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                    $("#initiateApplyLoanEditForAdminConsentRaw").text('Send For Super Admin Consent').removeAttr('disabled');
                }
            );
        }

        function initiateApplyLoanEditForAdminConsent(loanId)
        {
            $.post('{{route('initiateApplyLoanEditForCustomerConsent')}}',{
                "_token": "{{ csrf_token() }}",
                loanId:loanId,
                pageNameStr:'{{$pageNameStr}}',
            },function(data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#initiateApplyLoanModalBody').html(obj.data);
                    $('#initiateApplyLoanUserId').val(loanId);
                    $('#initiateApplyLoanModal').modal('show');

                    $('#sendForCustomerConsentFrm').submit(function(e) {
                        e.preventDefault();

                        var formData = new FormData(this);

                        var userId=$('#initiateApplyLoanUserId').val();
                        var loanCategory=$('#loanCategory').val();
                        var productName=$('#productName').val();
                        var approveTenure=$('#approveTenure').val();
                        var approvedAmount=$('#approvedAmount').val();
                        var approvedRoi=$('#approvedRoi').val();
                        var invoiceFile=$('#invoiceFile').val();
                        var validFromDate=$('#validFromDate').val();
                        var validToDate=$('#validToDate').val();
                        var plateformFee=$('#plateformFee').val();
                        var insurance=$('#insurance').val();
                        var invoiceFileOld=$('#invoiceFileOld').val();
                        var roiType=$('#roiType').val();
                        
                        if(!userId){
                            alertMessage('Error!', 'Invalid Request, Please try again', 'error', 'yes');
                            return false;
                        }else if(!loanCategory){
                            alertMessage('Error!', 'Please select category name.', 'error', 'no');
                            return false;
                        }else if(loanCategory!='3' && loanCategory!='4' && loanCategory!='8' && !productName){
                            alertMessage('Error!', 'Please select product name.', 'error', 'no');
                            return false;
                        }else if(loanCategory=='3' && !invoiceFile && !invoiceFileOld){
                            alertMessage('Error!', 'Please upload bill.', 'error', 'no');
                            return false;
                        }else if(loanCategory=='4' && !invoiceFile && !invoiceFileOld){
                            alertMessage('Error!', 'Please upload invoice.', 'error', 'no');
                            return false;
                        }else if(loanCategory=='3' && (!validFromDate || !validToDate)){
                            alertMessage('Error!', 'Please select valid from & valid to date.', 'error', 'no');
                            return false;
                        }else if(loanCategory!='3' && loanCategory!='4' && !roiType){
                            alertMessage('Error!', 'Please select ROI type.', 'error', 'no');
                            return false;
                        }else if(!approveTenure){
                            alertMessage('Error!', 'Please select tenure.', 'error', 'no');
                            return false;
                        }else if(!approvedAmount){
                            alertMessage('Error!', 'Please enter approved amount.', 'error', 'no');
                            return false;
                        }else if(!approvedRoi){
                            alertMessage('Error!', 'Please enter rate of interest.', 'error', 'no');
                            return false;
                        }else{
                            $('#initiateApplyLoanBtnFnBtn').text('Please Wait...').attr('disabled','disabled');
                            $('#initiateApplyLoanFrmResetBtn').text('Please Wait...').attr('disabled','disabled');
                            $.ajax({
                                type:'POST',
                                url: "{{route('initiateApplyLoanEditForAdminConsent')}}",
                                data: formData,
                                cache:false,
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    var obj = JSON.parse(data);
                                    if(obj.status=='success'){
                                        alertMessage('Success!', obj.message, 'success', 'yes');
                                        initiateApplyLoan(userId);
                                        return false;
                                    }else{
                                        $('#initiateApplyLoanBtnFnBtn').text('Send For Admin Approval').removeAttr('disabled');
                                        $('#initiateApplyLoanFrmResetBtn').text('Cancel').removeAttr('disabled');
                                        alertMessage('Error!', obj.message, 'error', 'no');
                                        return false;
                                    }
                                },
                                error: function(data){
                                    $('#initiateApplyLoanBtnFnBtn').text('Send For Admin Approval').removeAttr('disabled');
                                    $('#initiateApplyLoanFrmResetBtn').text('Cancel').removeAttr('disabled');
                                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                                    return false;
                                    //console.log(data);
                                }
                            });
                        }
                    });

                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }

        function sendSmsAlert(userId,mobile,type)
        {
            if(confirm('Are you sure want to send sms alert?')!=true){
                return false;
            }
            $.post('{{route('sendSmsAlertByType')}}',{
                "_token": "{{ csrf_token() }}",
                userId:userId,
                mobile:mobile,
                type:type,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    alertMessage('Success!', obj.message, 'success', 'no');
                    return false;
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }
        
        function checkProductTypeCategory()
        {
            var loanId=$('#loanCategory').val();
            $('#invoiceFile').val('');
            $('#validFromDate').val('');
            $('#validToDate').val('');
            $('#productName').val('');
            $('#roiType').val('');
            $('#approveTenure').val('');
            $('#invoiceFileLabel').html('');
            if(parseInt(loanId)==3){
                $('.validFromDateHtml').show();
                $('.validToDateHtml').show();
                $('.roiTypeHtml').hide();
                $('.netDisbursementHtml').hide();
            }else{
                $('.validFromDateHtml').hide();
                $('.validToDateHtml').hide();
                $('.roiTypeHtml').show();
                $('.netDisbursementHtml').show();
            }

            if(parseInt(loanId)==3 || parseInt(loanId)==4){

                var label=(parseInt(loanId)==4) ? 'Upload Invoice' : 'Upload Bill';
                $('#invoiceFileLabel').html(label);
                $('#invoiceFileHtml').show();
                $('.productNameHtml').hide();
                $('.roiTypeHtml').hide();
            }else{
                $('#invoiceFileHtml').hide();
                $('.productNameHtml').show();
                $('.roiTypeHtml').show();
            }
            
            if(parseInt(loanId)==8){
                $('.productNameHtml').hide();
            }

            getProductsListByCategory(loanId);
            getTenuresListByCategory(loanId);
        }

        function getProductsListByCategory(catId)
        {
            $.post('{{route('getProductsListByCategory')}}',{
                "_token": "{{ csrf_token() }}",
                catId:catId,
            },function(data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#productName').html(obj.data);
                }else{
                    $('#productName').html('');
                }
            });
        }

        function getTenuresListByCategory(catId)
        {
            $.post('{{route('getTenureListByCategory')}}',{
                "_token": "{{ csrf_token() }}",
                catId:catId,
            },function(data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#approveTenure').html(obj.data);
                    if(parseInt(catId)==8){
                        $('.all_loan_type').hide();
                        $('.new_loan_type').show();
                    }else{
                        $('.all_loan_type').show();
                    }
                }else{
                    $('#approveTenure').html('');
                }
            });
        }


        $('#personalFormCoApplicantEdit').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var recordId=$('#coApplicantOdUserId').val();
        var nameTitleCoApp=$('#nameTitleCoApp').val();
        var customerNameCoApp=$('#customerNameCoApp').val();
        var genderCoApp=$('#genderCoApp').val();

        if(!recordId) {
            alertMessage('Error!', 'Invalid Request.', 'error', 'no');
            return false;
        } else if(!nameTitleCoApp) {
            alertMessage('Error!', 'Please select name title.', 'error', 'no');
            return false;
        }else if(!customerNameCoApp) {
            alertMessage('Error!', 'Please enter name.', 'error', 'no');
            return false;
        }else if(!genderCoApp) {
            alertMessage('Error!', 'Please select gender.', 'error', 'no');
            return false;
        }else{
            $('#personalFormBtnECoApp').text('Please Wait...').attr('disabled','disabled');
            $.ajax({
                type:'POST',
                url: "{{route('saveCoApplicantInfo')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
                    $('#personalFormBtnECoApp').text('Submit').removeAttr('disabled');
                    if(obj.status=='success')
                    {
                        alertMessage('Success!', obj.message, 'success', 'yes');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                },
                error: function(data){
                    $('#personalFormBtnECoApp').text('Save').removeAttr('disabled');
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        }
    });

        function openCoApplicantModal()
        {
            $('#newCoApplicant').modal('show');
        }

        function getProfileDetailsHtml(actionType)
        {
            $('#hrdash_profiletab_content').html('<center><img src="{{env('LOADERIMG')}}" style="margin-top:20px;" /> </center>');
            $.post('{{route('getProfileDetailsHtml')}}',{
                "_token": "{{ csrf_token() }}",
                userId:'{{$userId}}',
                actionType:actionType,
                pageNameStr:'{{$pageNameStr}}'
            },function(data){
                $('#hrdash_profiletab_content').html(data);

                $('.docsCheck').click(function(){
                    if($(this)[0].checked)
                    {
                        var userId=$(this).attr('userId');
                        var value=$(this).val();
                        if(userId && value)
                        {
                            $.post('{{route('markDocsAsRead')}}',{
                                "_token": "{{ csrf_token() }}",
                                userId:userId,
                                docsName:value,
                            },function (data){
                                var obj = JSON.parse(data);
                                if(obj.status=='success'){
                                    $('#'+value).attr('disabled','true');
                                    $('.'+value).addClass('checkedDocs');
                                    location.reload();
                                }else{
                                    alertMessage('Error!', obj.message, 'error', 'no');
                                    return false;
                                }
                            });
                        }
                    }
                });
            });
        }


$(document).ready(function(){
    <?php if($pageNameStr=='employment-verification' || $pageNameStr=='employment-verification-rejected'){ ?>
    $('.nav-link').removeClass('active').attr('selected','false');
    $('.tab-pane').removeClass('active');
    $('#personalinfopr').addClass('active').attr('selected','true');
    $('#companyTabBtn').addClass('active show');
    getProfileDetailsHtml('businessDetails');
    <?php }else{ ?>
        getProfileDetailsHtml('customerinfo');
    <?php } ?>
});
        
        
        function checkClickedOnPayOutStanding()
        {
            var checkClickedOnPayOutStandingBtn=$('#checkClickedOnPayOutStandingBtn:checked').val();
            if(checkClickedOnPayOutStandingBtn)
            {
                $('#outstandingPayHtml').show();
            }else{
                $('#outstandingPayHtml').hide();
            }
        }
        
        
        function payOutStandingAmtFn(loanId,userId)
        {
            var payOutStandingAmt1=parseInt($('#payOutStandingAmt1').val());
            var payOutStandingAmt=$('#payOutStandingAmt').val();
            var payOutStandingPayMode=$('#payOutStandingPayMode').val();
            var payOutStandingTxnId=$('#payOutStandingTxnId').val();
            var payOutStandingTxnDate=$('#payOutStandingTxnDate').val();
            
            if(!loanId || !userId)
            {
                alertMessage('Error!', 'Invalid request.', 'error', 'no');
                return false;
            }else if(!payOutStandingAmt)
            {
                alertMessage('Error!', 'Please enter amount whatever you want to pay.', 'error', 'no');
                return false;
            }else if(!payOutStandingPayMode)
            {
                alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
                return false;
            }else if(!payOutStandingTxnId)
            {
                alertMessage('Error!', 'Please enter transaction Id.', 'error', 'no');
                return false;
            }else if(!payOutStandingTxnDate)
            {
                alertMessage('Error!', 'Please select transaction date.', 'error', 'no');
                return false;
            }else if(parseInt(payOutStandingAmt)>payOutStandingAmt1)
            {
                alertMessage('Error!', 'Deposit amount cannot be greater than '+payOutStandingAmt1+' .', 'error', 'no');
                return false;
            }else{
                //waitForProcess();
                $.post('{{route('payOutStandingAmount')}}',{
                    "_token": "{{ csrf_token() }}",
                    loanId:loanId,
                    userId:userId,
                    payOutStandingAmt:payOutStandingAmt,
                    payOutStandingPayMode:payOutStandingPayMode,
                    payOutStandingTxnId:payOutStandingTxnId,
                    payOutStandingTxnDate:payOutStandingTxnDate,
                },function (data){
                    var obj = JSON.parse(data);
                    
                    if(obj.status=='success')
                    {          
                        getLoanEmiDetails(loanId);
                        alertMessage('Success!', obj.message, 'success', 'no');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }

        function deleteOtherDocuments(docid){
            swal({
                        title: 'Warning!',
                        text: 'Are you sure want to delete this document?',
                        icon: 'warning',
                        buttons:true,
                    }).then((willDelete) => {
                        if(willDelete)
                        {
                            $.post('{{route('deleteOtherDocuments')}}',{
                                    "_token": "{{ csrf_token() }}",
                                    docid:docid
                                },function (data){
                                    var obj = data;
                                    
                                    if(obj.status=='success')
                                    {          
                                        swal({
                                            title: 'Success !',
                                            text: obj.message,
                                            icon: 'success',
                                            buttons:true,
                                        });
                                        setInterval(() => {
                        location.reload();
                    }, 2000);
                                        return false;
                                    }else{
                                        swal({
                                            title: 'Error !',
                                            text: obj.message,
                                            icon: 'warning',
                                            buttons:true,
                                        });
                                        return false;
                                    }
                                });
                            }
            });
        }


        function disbursedDocumentUpload(){
            $('#disbursedDocsUpload').modal('show');
        }

        function docsAddMore()
    {
        var maxOtherDocs=parseInt($('#maxOtherDocs').val())+1;

        var docHtml =` <div class="row my-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Document Title</label>
                                <input type="text" name="disbursed_title[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Document </label>
                                <input type="file" name="disbursed_file[]" class="form-control">
                            </div>
                        </div>
                    </div>`;
        $('#disbursedDocsFieldAdd').append(docHtml);
    }

    $("#disbursedDocsUploadForm .close").click(function(e){
        $('#disbursedDocsUpload').modal("hide"); 
    });

    $("#disbursedDocsUploadForm").submit(function(e){
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('_token','{{ csrf_token() }}');
        $.ajax({
            url: '{{route('disbursedDocsUploadData')}}',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response.status == 'success'){
                    swal({
                        title: 'Success !',
                        text: response.message,
                        icon: 'success'
                    });
                    setInterval(() => {
                        location.reload();
                    }, 2000);
                }else{
                    swal({
                        title: 'Error !',
                        text: response.message,
                        icon: 'warning'
                    });
                }
            },
        });
    });

    </script>


@endsection
