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
                            <a class="nav-link active" data-bs-toggle="tab" href="#customerInfo">Customer Info</a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link" data-bs-toggle="tab" href="#coApplicantDetails">Co Applicant<br>(Guarantor) Info</a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link " data-bs-toggle="tab" id="companyTabBtn" href="#businessDetails">Business Details</a>
                        </li>

                        <li class="nav-item m-l-10">
                            <a class="nav-link" data-bs-toggle="tab" href="#kycDetails">KYC</a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link" data-bs-toggle="tab" href="#bankinfo">Customer Bank Information</a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link" data-bs-toggle="tab" href="#beureuReport">Beureu Reports</a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link" data-bs-toggle="tab" href="#customerLoansList">Customer Loans</a>
                        </li>
                    </ul>
                    <div class="tab-content empform_tabcontent" id="hrdash_profiletab_content">
                        <div class="tab-pane body active" id="customerInfo">
                            <div class="tabform_mainb">
                                <form action="">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Name Title: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->nameTitle : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Full Name: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->name : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Date of Birth: </label>
                                                        <span>{{(strtotime($userDtl->dateOfBirth)) ? date('d/m/Y',strtotime($userDtl->dateOfBirth)) : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Gender: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->gender : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Marital Status: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->maritalStatus : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Religion: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->religion : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Education Status: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->educationStatus : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Father Name: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->fatherName : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Mother Name: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->motherName : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Cibil Score: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->cibilScore : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">Address: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->addressLine1 : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Address Optional:  </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->addressLine2 : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-5">


                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> City: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->city : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">District: </label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->district : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">State:</label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->state : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">PinCode:</label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->pincode : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">Aadhaar Number:</label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->aadhaar_no : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">PAN Number:</label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->pancard_no : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">Personal Discussion:</label>
                                                        <span>
                                                            <a href="javascript:;" style="color:blue;font-weight: bold;" onclick="getPersonalDiscussionDetails({{$userDtl->id}});" class="">
                                                                Click Here
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">Source Person Name:</label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->sourcePerson : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">Branch Name:</label>
                                                        <span>{{(!empty($userDtl)) ? $userDtl->branchName : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">&nbsp;</div>
                                        <div class="col-md-4 viewPersonalDetails {{($userDtl->viewPersonalDetails) ? 'checkedDocs' : 'uncheckedDocs'}}">
                                            <input type="checkbox" class="docsCheck" {{($userDtl->viewPersonalDetails) ? 'checked disabled' : ''}} userId="{{$userDtl->id}}" name="docsCheck" id="viewPersonalDetails" class="docsCheck" value="viewPersonalDetails"> Personal Details Checked
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane body " id="coApplicantDetails">
                            <div class="tabform_mainb">
                                <form action="">
                                    @if(count($coApplicantDtlARR))
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a href="javascript:;" onclick="openCoApplicantModal();" style="background: red;color: #fff;padding: 5px;border-radius: 10px;font-size: 12px;">Add New Co-Applicant</a>
                                        </div>
                                    </div>
                                        @foreach($coApplicantDtlARR as $coApplicantDtl)
                                            <div class="row mt-4"> <hr style="margin-bottom: 10px !important;">
                                                <div class="col-lg-4">
                                                    <div class="row">
                                                        <div class="col-lg-12 mr_removecol">
                                                            <div class="form-group flex_col">
                                                                <label for=""> Name Title: </label>
                                                                <span>{{(!empty($coApplicantDtl)) ? $coApplicantDtl->nameTitleCoApp : 'NA'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 mr_removecol">
                                                            <div class="form-group flex_col">
                                                                <label for=""> Full Name: </label>
                                                                <span>{{(!empty($coApplicantDtl)) ? $coApplicantDtl->customerNameCoApp : 'NA'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 mr_removecol">
                                                            <div class="form-group flex_col">
                                                                <label for=""> Date of Birth: </label>
                                                                <span>{{(strtotime($coApplicantDtl->dateOfBirthCoApp)) ? date('d/m/Y',strtotime($coApplicantDtl->dateOfBirthCoApp)) : 'NA'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 mr_removecol">
                                                            <div class="form-group flex_col">
                                                                <label for=""> Gender: </label>
                                                                <span>{{(!empty($coApplicantDtl)) ? $coApplicantDtl->genderCoApp : 'NA'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 mr_removecol">
                                                            <div class="form-group flex_col">
                                                                <label for=""> Marital Status: </label>
                                                                <span>{{(!empty($coApplicantDtl)) ? $coApplicantDtl->maritalStatusCoApp : 'NA'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 mr_removecol">
                                                            <div class="form-group flex_col">
                                                                <label for=""> Religion: </label>
                                                                <span>{{(!empty($coApplicantDtl)) ? $coApplicantDtl->religionCoApp : 'NA'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="row">
                                                        <div class="col-lg-12 mr_removecol">
                                                            <div class="form-group flex_col">
                                                                <label for=""> Education Status: </label>
                                                                <span>{{(!empty($coApplicantDtl)) ? $coApplicantDtl->educationStatusCoApp : 'NA'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 mr_removecol">
                                                            <div class="form-group flex_col">
                                                                <label for=""> Father Name: </label>
                                                                <span>{{(!empty($coApplicantDtl)) ? $coApplicantDtl->fatherNameCoApp : 'NA'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 mr_removecol">
                                                            <div class="form-group flex_col">
                                                                <label for=""> Mother Name: </label>
                                                                <span>{{(!empty($coApplicantDtl)) ? $coApplicantDtl->motherNameCoApp : 'NA'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 mr_removecol">
                                                            <div class="form-group flex_col">
                                                                <label for=""> Relation With Applicant: </label>
                                                                <span>{{(!empty($coApplicantDtl)) ? $coApplicantDtl->relationWithApplicantCoApp : 'NA'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 mr_removecol">
                                                            <div class="form-group flex_col">
                                                                <label for=""> Cibil Score: </label>
                                                                <span>{{(!empty($coApplicantDtl)) ? $coApplicantDtl->cibilScoreCoApp : 'NA'}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane body " id="businessDetails">
                            <div class="tabform_mainb">
                                @if(!empty($userEmploymentHistory))
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">Company Name: </label>
                                                        <span>{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->employerName : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">Company Phone: </label>
                                                        <span>{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->mobileNo : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">Telephone No.: </label>
                                                        <span>{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyTeleNo : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">Fax No.: </label>
                                                        <span>{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyFaxNo : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> GSTIN </label>
                                                        <span>{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyGstin : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Pan Number </label>
                                                        <span>{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyPan : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Company Type </label>
                                                        <span>{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->companyType : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Address </label>
                                                        <span>{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->address : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> District </label>
                                                        <span>{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->district : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> State </label>
                                                        <span>{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->state : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Pincode </label>
                                                        <span>{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->pincode : 'NA'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Cash Flow Analysis </label>
                                                        <span><a href="javascript:;" onclick="getUserCashFlowAnalysisDetailsByUser({{$userDtl->id}});" style="color: blue;font-weight: bold;">Click Here</a> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                     @if($pageNameStr=='employment-verification' || $pageNameStr=='employment-verification-rejected')
                                    <div class="row">
                                        <div class="col-md-8">&nbsp;</div>
                                        <div class="col-md-4 mb-3 viewProfessionalDetails {{($userDtl->viewProfessionalDetails) ? 'checkedDocs' : 'uncheckedDocs'}}">
                                            <input type="checkbox" class="docsCheck" {{($userDtl->viewProfessionalDetails) ? 'checked disabled' : ''}} userId="{{$userDtl->id}}" name="docsCheck" id="viewProfessionalDetails" class="docsCheck" value="viewProfessionalDetails"> Professional Details Checked
                                        </div>
                                    </div>
                                     @endif
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane body " id="kycDetails">
                            <div class="tabform_mainb">
                                <form action="">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card" id="orderList_header">
                                                <div class="card-header  border-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="card-title mb-0 flex-grow-1">Documents</h5>
                                                        <div class="flex-shrink-0">
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <!--end col-->
                                    </div>

                                    @if(!empty($userDocDtl))
                                        <div class="row gallery-wrapper">
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="document_title_type">Photo of Emp identity Card</div>
                                                </div>
                                                <div class="row">

                                                    <div class="element-item  col-lg-6 col-sm-6">
                                                        @if($userDocDtl->idProofFront)
                                                            <div class="gallery-box card">
                                                                <div class="gallery-container">
                                                                    <a class="image-popup" title="" target="_blank" href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->idProofFront : ''}}">
                                                                        <img class="gallery-img img-fluid mx-auto" src="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->idProofFront : ''}}" alt="">
                                                                        <div class="gallery-overlay">
                                                                            <h5 class="overlay-caption"></h5>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="box-content">
                                                                    <div class="d-flex align-items-center mt-1">
                                                                        <div class="flex-grow-1 text-muted"><a  target="_blank" href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->idProofFront : ''}}" class="text-body text-truncate">Front</a></div>
                                                                        <div class="flex-shrink-0">
                                                                            <div class="d-flex gap-3">
                                                                                <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                                    <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> {{(strtotime($userDocDtl->created_at)) ? date('M Y',strtotime($userDocDtl->created_at)) : 'NA'}}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <!-- end col -->
                                                    <div class="element-item  col-lg-6 col-sm-6 ">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="image-popup" target="_blank" href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->idProofBack : ''}}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->idProofBack : ''}}" alt="">
                                                                    <div class="gallery-overlay">
                                                                        <h5 class="overlay-caption"></h5>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="box-content">
                                                                <div class="d-flex align-items-center mt-1">
                                                                    <div class="flex-grow-1 text-muted"><a  target="_blank" href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->idProofBack : ''}}" class="text-body text-truncate">Back</a></div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-3">
                                                                            <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                                <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> {{(strtotime($userDocDtl->created_at)) ? date('M Y',strtotime($userDocDtl->created_at)) : 'NA'}}
                                                                            </button>
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
                                                                <a class="image-popup" title="" target="_blank" href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->panCardFront : ''}}">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->panCardFront : ''}}" alt="">
                                                                    <div class="gallery-overlay">
                                                                        <h5 class="overlay-caption"></h5>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="box-content">
                                                                <div class="d-flex align-items-center mt-1">
                                                                    <div class="flex-grow-1 text-muted"><a href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->panCardFront : ''}}" target="_blank" class="text-body text-truncate">Front</a></div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-3">
                                                                            <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                                <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> {{(strtotime($userDocDtl->created_at)) ? date('M Y',strtotime($userDocDtl->created_at)) : 'NA'}}
                                                                            </button>
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


                                        <div class="row gallery-wrapper mt-4">
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="document_title_type">Photo of Address Proof</div>
                                                </div>
                                                <div class="row">
                                                    <div class="element-item  col-lg-6 col-sm-6">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="image-popup" title="" target="_blank" href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->addressProofFront : ''}}">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->addressProofFront : ''}}" alt="">
                                                                    <div class="gallery-overlay">
                                                                        <h5 class="overlay-caption"></h5>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="box-content">
                                                                <div class="d-flex align-items-center mt-1">
                                                                    <div class="flex-grow-1 text-muted"><a href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->addressProofFront : ''}}" target="_blank" class="text-body text-truncate">Front</a></div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-3">
                                                                            <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                                <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> {{(strtotime($userDocDtl->created_at)) ? date('M Y',strtotime($userDocDtl->created_at)) : 'NA'}}
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div class="element-item  col-lg-6 col-sm-6 ">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="image-popup" target="_blank" href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->addressProofBack : ''}}" title="">
                                                                    <img class="gallery-img img-fluid mx-auto" src="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->addressProofBack : ''}}" alt="">
                                                                    <div class="gallery-overlay">
                                                                        <h5 class="overlay-caption"></h5>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="box-content">
                                                                <div class="d-flex align-items-center mt-1">
                                                                    <div class="flex-grow-1 text-muted"><a href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->addressProofBack : ''}}" target="_blank" class="text-body text-truncate">Back</a></div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-3">
                                                                            <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                                <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> {{(strtotime($userDocDtl->created_at)) ? date('M Y',strtotime($userDocDtl->created_at)) : 'NA'}}
                                                                            </button>
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
                                                    <div class="document_title_type">Others documents </div>
                                                </div>
                                                <?php if(count($otherKycDocs)){ ?>
                                                
                                                    @foreach($otherKycDocs as $otherRow)        
                                                        <div class="row mb-2" style="padding: 5px;">
                                                            <div class="col-lg-6 col-sm-6">{{$otherRow->title}}</div>
                                                            <div class="col-lg-6 col-sm-6">
                                                            <a class="btn btn-warning" title="" target="_blank" href="{{(!empty($otherRow->docsUrl)) ? env('APP_URL').'public/'.$otherRow->docsUrl : ''}}">
                                                                        View Document
                                                                    </a>
                                                                </div>
                                                        </div>
                                                    @endforeach
                                                    
                                                    <!-- end col -->
                                                </div>
                                                <?php } ?>
                                            </div>
                                            {{--<div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="document_title_type"><?=(!empty($userDocDtl->otherDocumentTitle)) ? $userDocDtl->otherDocumentTitle : 'Others documents <span style="font-size: 10px;color: red;">(IT RETURN,GSt return,balance sheet PNL)</span>'?>  </div>
                                                </div>
                                                <?php if($userDocDtl->otherDocument){ ?>
                                                <div class="row">
                                                    <div class="element-item  col-lg-6 col-sm-6">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="image-popup btn btn-warning" title="" target="_blank" href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->otherDocument : ''}}">
                                                                    View Document
                                                                </a>
                                                            </div>
                                                            <div class="box-content">
                                                                <div class="d-flex align-items-center mt-1">
                                                                    <div class="flex-grow-1 text-muted"><a href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->otherDocument : ''}}" target="_blank" class="text-body text-truncate">&nbsp;</a></div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-3">
                                                                            <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                             
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                </div>
                                                <?php } ?>
                                            </div>--}}
                                            {{--
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="document_title_type">My About Kyc Video</div>
                                                </div>
                                                <?php if($userDocDtl->userAboutVideo){ ?>
                                                <div class="row">
                                                    <div class="element-item  col-lg-6 col-sm-6">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="image-popup btn btn-warning" title="" target="_blank" href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->userAboutVideo : ''}}">
                                                                    View Video
                                                                </a>
                                                            </div>
                                                            <div class="box-content">
                                                                <div class="d-flex align-items-center mt-1">
                                                                    <div class="flex-grow-1 text-muted"><a href="{{(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->userAboutVideo : ''}}" target="_blank" class="text-body text-truncate">Front</a></div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-3">
                                                                            <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                                <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> {{(strtotime($userDocDtl->created_at)) ? date('M Y',strtotime($userDocDtl->created_at)) : 'NA'}}
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                </div>
                                                <?php } ?>
                                            </div>
                                            --}}
                                            {{--
                                            <div class="col-lg-12">
                                                <div class="col-lg-12">
                                                    <div class="document_title_type">Photo of Salary Slip - 3 Months </div>
                                                </div>

                                                @php
                                                    $salarySlip1='';
                                                         if(!empty($userDocDtl->salerySlip1))
                                                         {
                                                             $salarySlip1Arr=explode('.',$userDocDtl->salerySlip1);
                                                             if(strtolower($salarySlip1Arr[1])=='pdf'){
                                                                 $salarySlip1='<a href="'.env('APP_URL').'public/'.$userDocDtl->salerySlip1.'" class="btn btn-danger" target="_blank">View PDF</a>';
                                                             }else{
                                                                 $salarySlip1='<img class="gallery-img img-fluid mx-auto" src="'.env('APP_URL').'public/'.$userDocDtl->salerySlip1.'" alt="">';
                                                             }
                                                         }

                                                     $salarySlip2='';
                                                         if(!empty($userDocDtl->salerySlip2))
                                                         {
                                                             $salarySlip2Arr=explode('.',$userDocDtl->salerySlip2);
                                                             if(strtolower($salarySlip2Arr[1])=='pdf'){
                                                                 $salarySlip2='<a href="'.env('APP_URL').'public/'.$userDocDtl->salerySlip2.'" class="btn btn-danger" target="_blank">View PDF</a>';
                                                             }else{
                                                                 $salarySlip2='<img class="gallery-img img-fluid mx-auto" src="'.env('APP_URL').'public/'.$userDocDtl->salerySlip2.'" alt="">';
                                                             }
                                                         }

                                                     $  ='';
                                                         if(!empty($userDocDtl->salerySlip3))
                                                         {
                                                             $salarySlip3Arr=explode('.',$userDocDtl->salerySlip3);
                                                             if(strtolower($salarySlip3Arr[1])=='pdf'){
                                                                 $salarySlip3='<a href="'.env('APP_URL').'public/'.$userDocDtl->salerySlip3.'" class="btn btn-danger" target="_blank">View PDF</a>';
                                                             }else{
                                                                 $salarySlip3='<img class="gallery-img img-fluid mx-auto" src="'.env('APP_URL').'public/'.$userDocDtl->salerySlip3.'" alt="">';
                                                             }
                                                         }

                                                @endphp
                                                <div class="row">
                                                    @if($salarySlip1)
                                                        <div class="element-item  col-lg-4 col-sm-4">
                                                            <div class="gallery-box card">
                                                                <div class="gallery-container">
                                                                    <a class="image-popup" title="" href="{{env('APP_URL').'public/'.$userDocDtl->salerySlip1}}" target="_blank">
                                                                        <?=$salarySlip1?>
                                                                        <div class="gallery-overlay">
                                                                            <h5 class="overlay-caption"></h5>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="box-content">
                                                                    <div class="d-flex align-items-center mt-1">
                                                                        <div class="flex-grow-1 text-muted"><a href="{{env('APP_URL').'public/'.$userDocDtl->salerySlip1}}" target="_blank" class="text-body text-truncate">Salary Slip 1</a></div>
                                                                        <div class="flex-shrink-0">
                                                                            <div class="d-flex gap-3">
                                                                                <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                                    <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> {{(strtotime($userDocDtl->created_at)) ? date('M Y',strtotime($userDocDtl->created_at)) : 'NA'}}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($salarySlip2)
                                                        <div class="element-item  col-lg-4 col-sm-4">
                                                            <div class="gallery-box card">
                                                                <div class="gallery-container">
                                                                    <a class="image-popup" title="" target="_blank" href="{{env('APP_URL').'public/'.$userDocDtl->salerySlip2}}">
                                                                        <?=$salarySlip2?>
                                                                        <div class="gallery-overlay">
                                                                            <h5 class="overlay-caption"></h5>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="box-content">
                                                                    <div class="d-flex align-items-center mt-1">
                                                                        <div class="flex-grow-1 text-muted"><a href="{{env('APP_URL').'public/'.$userDocDtl->salerySlip2}}" target="_blank" class="text-body text-truncate">Salary Slip 2</a></div>
                                                                        <div class="flex-shrink-0">
                                                                            <div class="d-flex gap-3">
                                                                                <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                                    <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> {{(strtotime($userDocDtl->created_at)) ? date('M Y',strtotime($userDocDtl->created_at)) : 'NA'}}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($salarySlip3)
                                                        <div class="element-item  col-lg-4 col-sm-4">
                                                            <div class="gallery-box card">
                                                                <div class="gallery-container">
                                                                    <a class="image-popup" title="" target="_blank" href="{{env('APP_URL').'public/'.$userDocDtl->salerySlip3}}">
                                                                        <?=$salarySlip3?>
                                                                    </a>
                                                                </div>
                                                                <div class="box-content">
                                                                    <div class="d-flex align-items-center mt-1">
                                                                        <div class="flex-grow-1 text-muted"><a href="{{env('APP_URL').'public/'.$userDocDtl->salerySlip3}}" target="_blank" class="text-body text-truncate">Salary Slip 3</a></div>
                                                                        <div class="flex-shrink-0">
                                                                            <div class="d-flex gap-3">
                                                                                <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                                    <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> {{(strtotime($userDocDtl->created_at)) ? date('M Y',strtotime($userDocDtl->created_at)) : 'NA'}}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            </div>
                                            --}}
                                        

                                        <div class="row gallery-wrapper mt-4">
                                            <div class="col-lg-9">
                                                <div class="col-lg-12">
                                                    <div class="document_title_type">Photo/PDF of Bank Statement</div>
                                                </div>
                                                <div class="row">
                                                    @php
                                                    $bankdoc='';
                                                        $bankAttachemet='';
                                                            if(!empty($userDocDtl->bankAttachemet))
                                                            {
                                                                $bankAttachemetArr=explode('.',$userDocDtl->bankAttachemet);
                                                                if(strtolower($bankAttachemetArr[1])=='pdf'){
                                                                    $bankdoc='pdf';
                                                                    $bankAttachemet='<a href="'.env('APP_URL').'public/'.$userDocDtl->bankAttachemet.'" class="btn btn-danger" target="_blank">View PDF</a>';
                                                                }else{
                                                                    $bankAttachemet='<img class="gallery-img img-fluid mx-auto" src="'.env('APP_URL').'public/'.$userDocDtl->bankAttachemet.'" alt="">';
                                                                }
                                                            }
                                                    @endphp
                                                    <div class="element-item  col-lg-9 col-sm-9">
                                                        <div class="gallery-box card">
                                                            <div class="gallery-container">
                                                                <a class="image-popup" title="" target="_blank" href="{{env('APP_URL').'public/'.$userDocDtl->bankAttachemet}}">
                                                                    <?=$bankAttachemet?>
                                                                    <div class="<?=($bankdoc=='pdf') ? '' :'gallery-overlay'?>">
                                                                        <h5 class="overlay-caption"></h5>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="box-content">
                                                                <div class="d-flex align-items-center mt-1">
                                                                    <div class="flex-grow-1 text-muted"><a href="{{env('APP_URL').'public/'.$userDocDtl->bankAttachemet}}" target="_blank" class="text-body text-truncate">Bank Statement</a></div>
                                                                    <div class="flex-shrink-0">
                                                                        <div class="d-flex gap-3">
                                                                            <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0 shadow-none">
                                                                                <i class=" ri-calendar-2-line  text-muted align-bottom me-1"></i> {{(strtotime($userDocDtl->created_at)) ? date('M Y',strtotime($userDocDtl->created_at)) : 'NA'}}
                                                                            </button>
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
                                            <div class="row col-lg-12 " >
                                                <div class="col-md-9">&nbsp;</div>
                                                <div class="col-md-3 viewKycDetails {{($userDtl->viewKycDetails) ? 'checkedDocs' : 'uncheckedDocs'}}">
                                                    <input type="checkbox" class="docsCheck" {{($userDtl->viewKycDetails) ? 'checked disabled' : ''}} userId="{{$userDtl->id}}" name="docsCheck" id="viewKycDetails" class="docsCheck" value="viewKycDetails"> KYC Checked
                                                </div>
                                                <div class="col-md-6">&nbsp;</div>
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane body" id="customerLoansList">
                            <div class="tabform_mainb">

                                <?php
                                foreach ($loanDetails as $lrow)
                                {
                                    $disburseDate=(strtotime($lrow->disbursedDate)) ? date('d M, Y',strtotime($lrow->disbursedDate)) : '';
                                    $applyDate=(strtotime($lrow->created_at)) ? date('d M, Y',strtotime($lrow->created_at)) : '';
                                    $loanAccountNumber=env('LOANID_PRE').'0'.$lrow->id;

                                    $rawMaterialLoanAccountDetailsURL=route('rawMaterialLoanAccountDetails',$lrow->id);

                                    $buttons='';
                                    $loanStatus=strtoupper($lrow->status);

                                    $productNameStr='';
                                    if($lrow->categoryName && $lrow->productName){
                                        $productNameStr=$lrow->categoryName.' / '.$lrow->productName;
                                    }else if($lrow->productName){
                                        $productNameStr=$lrow->productName;
                                    }else if($lrow->categoryName){
                                        $productNameStr=$lrow->categoryName;
                                    }

                                $plateformFee=0;
                                    $insurance=0;
                                    $principleChargesDetailsArr=[];
                                    if($lrow->principleChargesDetails)
                                    {
                                        $principleChargesDetailsArr=json_decode($lrow->principleChargesDetails,true);
                                        $plateformFee=(isset($principleChargesDetailsArr['plateformFee'])) ? $principleChargesDetailsArr['plateformFee'] : 0;
                                        $insurance=(isset($principleChargesDetailsArr['insurance'])) ? $principleChargesDetailsArr['insurance'] : 0;
                                    }
                                    
                                    $netDisbursementAmount=$lrow->netDisbursementAmount;
                                    $roiType=App\Providers\AppServiceProvider::getROITypeHeading($lrow->roiType);

                                    echo '<div class="row">
                                        <div class="col-lg-4">
                                        <div class="row ">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Status: </label>
                                                        <span  class="bg-warning" style="padding: 5px;border-radius: 10px;font-size: 12px;color: black;">'.strtoupper($lrow->status).'</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Loan ID: </label>
                                                        <span>'.$loanAccountNumber.'</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> ROI Type: </label>
                                                        <span>'.$roiType.'</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Amount: </label>
                                                        <span>'.$lrow->approvedAmount.'</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Product Name: </label>
                                                        <span>'.$productNameStr.'</span>
                                                    </div>
                                                </div>
                                            </div>';
                                                if($lrow->loanCategory!=3)
                                                {
                                                    echo '<div class="row">
                                                            <div class="col-lg-12 mr_removecol">
                                                                <div class="form-group flex_col">
                                                                    <label for=""> Tenure : </label>
                                                                    <span>'.$lrow->approvedTenureD.'</span>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }
                                        echo '<div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">Interest:</label>
                                                        <span>'.$lrow->rateOfInterest.'%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">';

                                            if($lrow->monthlyEMI && $lrow->loanCategory!=3)
                                            {
                                            echo '<div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Monthly EMI : </label>
                                                        <span>'.$lrow->monthlyEMI.'</span>
                                                    </div>
                                                </div>
                                            </div>';
                                            echo '<div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for=""> Total Interest : </label>
                                                        <span>'.$lrow->totalInterest.'</span>
                                                    </div>
                                                </div>
                                            </div>';
                                            }

                                            if($plateformFee)
                                            {
                                                echo '<div class="row">
                                                    <div class="col-lg-12 mr_removecol">
                                                        <div class="form-group flex_col">
                                                            <label for=""> Plateform Fee : </label>
                                                            <span>'.$plateformFee.'</span>
                                                        </div>
                                                    </div>
                                                </div>';
                                            }

                                            if($insurance)
                                            {
                                                echo '<div class="row">
                                                    <div class="col-lg-12 mr_removecol">
                                                        <div class="form-group flex_col">
                                                            <label for=""> Insurance Fee : </label>
                                                            <span>'.$insurance.'</span>
                                                        </div>
                                                    </div>
                                                </div>';
                                            }
                                            
                                            if($netDisbursementAmount && $lrow->loanCategory!=3)
                                            {
                                                echo '<div class="row">
                                                    <div class="col-lg-12 mr_removecol">
                                                        <div class="form-group flex_col">
                                                            <label for=""> Net Disbursement Amount : </label>
                                                            <span>'.$netDisbursementAmount.'</span>
                                                        </div>
                                                    </div>
                                                </div>';
                                            }

                                            if($lrow->status=='disburse-scheduled' || $lrow->status=='disbursed')
                                            {
                                                $disbursedDateLbl=($lrow->status=='disburse-scheduled') ? 'Disbursement Date' : 'Disbursed date';

                                                echo '<div class="row">
                                                    <div class="col-lg-12 mr_removecol">
                                                        <div class="form-group flex_col">
                                                            <label for=""> '.$disbursedDateLbl.' : </label>
                                                            <span>'.date('d M, Y',strtotime($lrow->disbursedDate)).'</span>
                                                        </div>
                                                    </div>
                                                </div>';
                                            }

                                            if($lrow->loanCategory==4 || $lrow->loanCategory==3)
                                            {
                                            echo '<div class="row">
                                                <div class="col-lg-12 mr_removecol">
                                                    <div class="form-group flex_col">
                                                        <label for="">Invoice:</label>
                                                        <span><a href="'.asset('/').'public/'.$lrow->invoiceFile.'" target="_blank"><img src="'.asset('/').'public/'.$lrow->invoiceFile.'" style="width:100px; height: 100px;object-fit: contain;" /></a></span>
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
                                    </div>
                                    ';
                                    ?>

                                    <div class="col-lg-12" id="btnhistory">

                                        @if($lrow->loanCategory!=3 && $lrow->status=='customer-approved')
                                            <button type="button" onclick="getLoanDetailsForScheduleDisbursement({{$lrow->id}});" class="btn bg-warning btn-warning">Schedule Disburse</button>
                                        @endif
                                        @if($lrow->loanCategory==3 && $lrow->status=='customer-approved')
                                            <button onclick="location.href='<?=$rawMaterialLoanAccountDetailsURL?>'" Type="button"  class="btn bg-success btn_import2 font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                                                <i class="fa-solid fa-eye"></i>
                                                View Loan History
                                            </button>
                                        @endif

                                            @if($lrow->status=='sent-for-admin-approval')
                                                <button onclick="rejectForCustomerConsent({{$lrow->id}});" Type="button"  class="btn bg-danger btn-danger text-white">
                                                    <i class="fa fa-cancel"></i>
                                                    Reject For Customer Consent
                                                </button>
                                                <button onclick="initiateApplyLoanEditForCustomerConsent({{$lrow->id}});" Type="button"  class="btn bg-warning btn-warning text-white">
                                                    <i class="fa fa-check"></i>
                                                    Send For Customer Consent
                                                </button>
                                            @endif

                                    </div>
                                    <?php } ?>


                            </div>
                        </div>
                        <div class="tab-pane body" id="beureuReport">
                            <div class="tabform_mainb">
                                <form action="">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card" id="orderList_header">
                                                <div class="card-header  border-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="card-title mb-0 flex-grow-1">Credit Score</h5>
                                                        <div class="flex-shrink-0">
                                                            <!-- <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                                                id="create-btn" data-bs-target="#showModal"><i data-feather="plus" class="btn-icon-prepend feather_iconfont"></i> Add
                                                                New</button> -->
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <a href="javascript:void(0);"><button type="button" class="btn btn-primary">Print</button></a>
                                                            <a href="javascript:void(0);"><button type="button" class="btn btn-primarydl">Download</button></a>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <!--end col-->
                                    </div>
                                    <div class="row gallery-wrapper">
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


                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane body" id="bankinfo">
                            @if(!empty($userBankDtl))
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> Account Holder Name: </label>
                                                    <span>{{(!empty($userBankDtl)) ? $userBankDtl->accountHolderName : 'NA'}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> Bank Name: </label>
                                                    <span>{{(!empty($userBankDtl)) ? $userBankDtl->bankName : 'NA'}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> IFSC: </label>
                                                    <span>{{(!empty($userBankDtl)) ? $userBankDtl->ifscCode : 'NA'}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> Account Type: </label>
                                                    <span>{{(!empty($userBankDtl)) ? $userBankDtl->accountType : 'NA'}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> Account Number:</label>
                                                    <span>{{(!empty($userBankDtl)) ? $userBankDtl->accountNumber : 'NA'}}</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-5">
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> Address: </label>
                                                    <span>{{(!empty($userBankDtl)) ? $userBankDtl->address : 'NA'}}</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> City: </label>
                                                    <span>{{(!empty($userBankDtl)) ? $userBankDtl->city : 'NA'}}</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> State: </label>
                                                    <span>{{(!empty($userBankDtl)) ? $userBankDtl->state : 'NA'}}</span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mr_removecol">
                                                <div class="form-group flex_col">
                                                    <label for=""> Pin Code: </label>
                                                    <span>{{(!empty($userBankDtl)) ? $userBankDtl->pincode : 'NA'}}</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">&nbsp;</div>
                                    <div class="col-md-4 mb-3 viewBankDetails {{($userDtl->viewBankDetails) ? 'checkedDocs' : 'uncheckedDocs'}}">
                                        <input type="checkbox" class="docsCheck" {{($userDtl->viewBankDetails) ? 'checked disabled' : ''}} userId="{{$userDtl->id}}" name="docsCheck" id="viewBankDetails" class="docsCheck" value="viewBankDetails"> Bank Details Checked
                                    </div>
                                </div>
                            @endif
                        </div>


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

                                <div class="col-md-3">
                                    @if(!empty($userEmploymentHistory))
                                        @if($userEmploymentHistory->status=='approved')
                                            <label class="btn btn-success btn-xs" style="float: right;cursor: default;">Business Approved </label>
                                        @elseif($userEmploymentHistory->status=='rejected')
                                            <label class="btn btn-danger btn-xs" style="float: right;cursor: default;">Business Rejected  </label>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 row">
                                <div class="col-md-6">&nbsp;</div>
                                @if($userDtl->kycStatus=='pending')
                                    <div class="col-md-3">
                                        @if($verificationReviewDone)
                                            <a href="javascript:;" onclick="approveUserKyc({{$userDtl->id}},1);" class="btn btn-success btn-icon-text"> <i class="btn-icon-prepend" data-feather="check-square"></i> Send for business verification </a>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:;" onclick="approveUserKyc({{$userDtl->id}},2);" class="btn btn-danger btn-icon-text"> Reject for business verification  <i class="btn-icon-append" data-feather="x"></i></a>
                                    </div>
                                @endif
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
        <div class="modal-dialog modal-dialog-centered">
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
    

@section('scripts')
    <script>

        
    $(document).ready(function(){
        @if(($pageNameStr=='kyc-verified-customers' || $pageNameStr=='final-credit-assessment') && $deviationShow)
            $('#daviationAnalysisModal').modal('show');
        @endif
    });
    

    function docsAddMore()
    {
        var maxOtherDocs=parseInt($('#maxOtherDocs').val())+1;

        var docHtml =`<div class="row col-lg-12 mb-5" id="otherRow`+maxOtherDocs+`">
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
        </div>`;
        $('#otherDocsHtml').append(docHtml);
        $('#maxOtherDocs').val(maxOtherDocs)
    }

    function rejectForCustomerConsent(loanId)
    {
        $('#rejectForCustomerConsentLoanId').val(loanId);
        $('#rejectForCustomerConsentModal').modal('show');
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
        
        function approveUserKyc(userId,status)
        {
            if(status==1)
            {
                $('#rejectUser').val(userId);
                $('#rejectReason').val('');
                $('#rejectKycModalHeading').html('Approve Kyc');
                $('#rejectKycBtn').hide();
                $('#approveKycBtn').show();
                $('#rejectKycModal').modal('show');
            }else{
                $('#rejectKycModalHeading').html('Reject Kyc');
                $('#rejectUser').val(userId);
                $('#rejectReason').val('');
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

        function approveKyc()
        {
            var userId=$('#rejectUser').val();
            var rejectReason=$('#rejectReason').val();
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
                        saveKycStatus(userId,1,rejectReason);
                    }
                });
            }
        }

        function saveKycStatus(userId,status,remark)
        {
            waitForProcess();
            $.post('{{route('saveKycStatus')}}',{
                "_token": "{{ csrf_token() }}",
                userId:userId,
                status:status,
                remark:remark,
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

        
        $(document).ready(function(){
            <?php if($pageNameStr=='employment-verification' || $pageNameStr=='employment-verification-rejected'){ ?>
            $('.nav-link').removeClass('active').attr('selected','false');
            $('.tab-pane').removeClass('active');
            $('#personalinfopr').addClass('active').attr('selected','true');
            $('#companyTabBtn').addClass('active show');
            <?php } ?>
        });

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
                        }else if(loanCategory!='3' && loanCategory!='4' && !productName){
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
                        }else if(loanCategory!='3' && !roiType){
                            alertMessage('Error!', 'Please select ROI type.', 'error', 'no');
                            return false;
                        }else if(loanCategory!='3' && !approveTenure){
                            alertMessage('Error!', 'Please select tenure.', 'error', 'no');
                            return false;
                        }else if(!approvedAmount){
                            alertMessage('Error!', 'Please enter approved amount.', 'error', 'no');
                            return false;
                        }else if(!approvedRoi){
                            alertMessage('Error!', 'Please enter rate of interest.', 'error', 'no');
                            return false;
                        }else if(!parseInt(plateformFee)){
                            alertMessage('Error!', 'Please enter plateform fee.', 'error', 'no');
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
                $('.approveTenureHtml').hide();
            }else{
                $('.validFromDateHtml').hide();
                $('.validToDateHtml').hide();
                $('.approveTenureHtml').show();
            }

            if(parseInt(loanId)==3 || parseInt(loanId)==4){

                var label=(parseInt(loanId)==4) ? 'Upload Invoice' : 'Upload Bill';
                $('#invoiceFileLabel').html(label);
                $('#invoiceFileHtml').show();
                //$('.productNameHtml').hide();
            }else{
                $('#invoiceFileHtml').hide();
                //$('.productNameHtml').show();
            }

            getProductsListByCategory(loanId);
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
    </script>
@endsection
