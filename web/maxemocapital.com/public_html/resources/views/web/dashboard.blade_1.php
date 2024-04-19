@extends('web.layout.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/app.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/dashboard-css.css">



<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Dashboard</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcomeWeb')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="maindash_form">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">

                @php
                if($userloggedData->profilePic)
                {
                $userProfileURL=asset('/').'/public/'.$userloggedData->profilePic;
                }else{
                $userProfileURL=asset('assets/web').'/asset/img/avtar/avatar-1.jpg';
                }
                @endphp
                <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
                    <div class="col-span-12 lg:col-span-4">
                        <div class="card p-4 sm:p-5">
                            <div class="flex items-center space-x-4">
                                <div class="avatar h-14 w-14">
                                    <img class="rounded-full" src="{{$userProfileURL}}" alt="avatar">
                                </div>
                                <div>
                                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                                        {{$userloggedData->name}} <br> ({{$userloggedData->customerCode}})
                                    </h3>
                                    <p class="text-xs+"></p>
                                </div>
                            </div>

                            <div class="lefttabs__verti">
                                <ul class="nav nav-pills flex-column" id="experienceTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="application-tab" data-toggle="tab" href="#application" role="tab" aria-controls="application" aria-selected="true">My Application</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                      <a class="nav-link " id="dash-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="home" aria-selected="false">Dashboard</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link" id="loan-tab" data-toggle="tab" href="#loanHistory" role="tab" aria-controls="loanHistory" aria-selected="false">Loan History</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pass-tab" data-toggle="tab" href="#changepass" role="tab" aria-controls="changepass" aria-selected="false">Change Password</a>
                                    </li>
                                    <li><a href="{{route('webUserLogOut')}}">Logout</a></li>
                                </ul>


                            </div>
                            <!-- /.col-md-4 -->
                        </div>
                    </div>


                    <div class="col-span-12 lg:col-span-8">
                        <section class="emidetails">

                            <div class="">
                                <div class="tab-content" id="experienceTabContent">


                                    <div class="tab-pane fade show active text-left text-light" id="application" role="tabpanel" aria-labelledby="application-tab">

                                        <div class="tab_container">
                                            <input id="tab1" type="radio" name="tabs" checked>
                                            <label for="tab1" class="cs_tabs"><span>Customer Info</span></label>

                                            <input id="tab2" type="radio" name="tabs">
                                            <label for="tab2" class="cs_tabs"><span>Guarantor Info</span></label>

                                            <input id="tab3" type="radio" name="tabs">
                                            <label for="tab3" class="cs_tabs"><span>Business Details</span></label>

                                            <input id="tab4" type="radio" name="tabs">
                                            <label for="tab4" class="cs_tabs"><span>KYC</span></label>

                                            <input id="tab5" type="radio" name="tabs">
                                            <label for="tab5" class="cs_tabs"><span>Bank Information</span></label>

                                            <section id="content1" class="tab-content">
                                                <form action="">
                                                    <div class="row inner_formdata">
                                                        <div class="col-lg-4">
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Name Title: </label>
                                                                        <span>{{$userloggedData->nameTitle}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Email: </label>
                                                                        <span>{{$userloggedData->email}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Mobile: </label>
                                                                        <span>{{$userloggedData->mobile}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Full Name: </label>
                                                                        <span>{{$userloggedData->name}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Date of Birth: </label>
                                                                        <span>{{(strtotime($userloggedData->dateOfBirth)) ? date('d M, Y',strtotime($userloggedData->dateOfBirth)) : ''}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Gender: </label>
                                                                        <span>{{$userloggedData->gender}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Marital Status: </label>
                                                                        <span>{{$userloggedData->maritalStatus}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for="">Source Person Name:</label>
                                                                        <span>{{$userloggedData->sourcePerson}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for="">Branch Name:</label>
                                                                        <span>{{$userloggedData->branchName}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">

                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Religion: </label>
                                                                        <span>{{$userloggedData->religion}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Education Status: </label>
                                                                        <span>{{$userloggedData->educationStatus}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Father Name: </label>
                                                                        <span>{{$userloggedData->fatherName}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Mother Name: </label>
                                                                        <span>{{$userloggedData->motherName}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Cibil Score: </label>
                                                                        <span>{{$userloggedData->cibilScore}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for="">Address: </label>
                                                                        <span>{{$userloggedData->addressLine1}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Address Optional:  </label>
                                                                        <span>{{$userloggedData->addressLine2}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-4">


                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> City: </label>
                                                                        <span>{{$userloggedData->city}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for="">District: </label>
                                                                        <span>{{$userloggedData->district}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for="">State:</label>
                                                                        <span>{{$userloggedData->state}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for="">PinCode:</label>
                                                                        <span>{{$userloggedData->pincode}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for="">Aadhaar Number:</label>
                                                                        <span>{{$userloggedData->aadhaar_no}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for="">PAN Number:</label>
                                                                        <span>{{$userloggedData->pancard_no}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>




                                                        </div>

                                                    </div>

                                                </form>
                                            </section>

                                            <section id="content2" class="tab-content">
                                                <?php if(count($coApplicantDtlARR)){ ?>
                                                    <?php foreach($coApplicantDtlARR as $coApplicantDtl){ ?>
                                                            <div class="row inner_formdata mt-3">
                                                                <div class="col-lg-6">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Name Title: </label>
                                                                                <span><?=(!empty($coApplicantDtl)) ? $coApplicantDtl->nameTitleCoApp : 'NA'?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Full Name: </label>
                                                                                <span><?=(!empty($coApplicantDtl)) ? $coApplicantDtl->customerNameCoApp : 'NA'?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Date of Birth: </label>
                                                                                <span><?=(strtotime($coApplicantDtl->dateOfBirthCoApp)) ? date('d/m/Y',strtotime($coApplicantDtl->dateOfBirthCoApp)) : 'NA'?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Gender: </label>
                                                                                <span><?=(!empty($coApplicantDtl)) ? $coApplicantDtl->genderCoApp : 'NA'?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Marital Status: </label>
                                                                                <span><?=(!empty($coApplicantDtl)) ? $coApplicantDtl->maritalStatusCoApp : 'NA'?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Religion: </label>
                                                                                <span><?=(!empty($coApplicantDtl)) ? $coApplicantDtl->religionCoApp : 'NA'?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Education Status: </label>
                                                                                <span><?=(!empty($coApplicantDtl)) ? $coApplicantDtl->educationStatusCoApp : 'NA'?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Father Name: </label>
                                                                                <span><?=(!empty($coApplicantDtl)) ? $coApplicantDtl->fatherNameCoApp : 'NA'?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Mother Name: </label>
                                                                                <span><?=(!empty($coApplicantDtl)) ? $coApplicantDtl->motherNameCoApp : 'NA'?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Relation With Applicant: </label>
                                                                                <span><?=(!empty($coApplicantDtl)) ? $coApplicantDtl->relationWithApplicantCoApp : 'NA'?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Cibil Score: </label>
                                                                                <span><?=(!empty($coApplicantDtl)) ? $coApplicantDtl->cibilScoreCoApp : 'NA'?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                <hr style="background: red;">
                                                    <?php } ?>
                                                <?php } ?>
                                            </section>
                                            
                                            
                                            <section id="content3" class="tab-content">
                                                @if(count($userEmploymentHistoryArr))
                                                    @foreach($userEmploymentHistoryArr as $userEmploymentHistory)
                                                        <form action="">
                                                            <div class="row inner_formdata">
                                                                <div class="col-lg-12" style="text-align: center; padding: 10px; background: #455299; margin-bottom: 10px; border-radius: 10px; color: #fff; font-weight: 700;">
                                                                    <?php
                                                                        $empApprovalStatus=ucfirst($userEmploymentHistory->status);
                                                                        if($userEmploymentHistory->isBusiness==1){                                                                            
                                                                            //echo 'Business Details'.' ('.$empApprovalStatus.')';
                                                                            echo 'Business Details';
                                                                        }else{
                                                                            //echo 'Company Details'.' ('.$empApprovalStatus.')';
                                                                            echo 'Company Details';
                                                                        }
                                                                    ?>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for="">Company Name: </label>
                                                                                <span>{{$userEmploymentHistory->employerName}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for="">Company Email: </label>
                                                                                <span>{{$userEmploymentHistory->emailId}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for="">Company Phone: </label>
                                                                                <span>{{$userEmploymentHistory->mobileNo}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($userEmploymentHistory->isBusiness==1)
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for="">Telephone No.: </label>
                                                                                <span>{{$userEmploymentHistory->companyTeleNo}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for="">Fax No.: </label>
                                                                                <span>{{$userEmploymentHistory->companyFaxNo}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Pan Number </label>
                                                                                <span>{{$userEmploymentHistory->companyPan}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> GSTIN </label>
                                                                                <span>{{$userEmploymentHistory->companyGstin}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                        <div class="row">
                                                                            <div class="col-lg-12 mr_removecol">
                                                                                <div class="form-group ">
                                                                                    <label for="">Total Experience In Current Company: </label>
                                                                                    <span>{{$userEmploymentHistory->totalExpInCurrentCompany}}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 mr_removecol">
                                                                                <div class="form-group ">
                                                                                    <label for=""> Current Salary </label>
                                                                                    <span>{{$userEmploymentHistory->currentSalary}}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif


                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Company Type </label>
                                                                                <span>{{$userEmploymentHistory->companyType}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Address </label>
                                                                                <span>{{$userEmploymentHistory->address}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> District </label>
                                                                                <span>{{$userEmploymentHistory->district}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> State </label>
                                                                                <span>{{$userEmploymentHistory->state}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-lg-12 mr_removecol">
                                                                            <div class="form-group ">
                                                                                <label for=""> Pincode </label>
                                                                                <span>{{$userEmploymentHistory->pincode}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </form>
                                                    @endforeach
                                                @endif
                                            </section>

                                            <section id="content4" class="tab-content">
                                                <?php if(!empty($userDocDtl)){ ?>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card" id="orderList_header">
                                                                <div class="card-header  border-0">
                                                                    <div class="d-flex align-items-center">
                                                                        <h5 class="card-title mb-0 flex-grow-1">Documents</h5>

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

                                                                <div class="element-item  col-lg-6 col-sm-6">
                                                                    <div class="gallery-box card">
                                                                        <div class="gallery-container">
                                                                            <a class="image-popup" title="" target="_blank" href="<?=(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->idProofFront : ''?>">
                                                                                <img class="gallery-img img-fluid mx-auto" src="<?=(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->idProofFront : ''?>" alt="">
                                                                                <div class="gallery-overlay">
                                                                                    <h5 class="overlay-caption"></h5>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div class="identity_content">
                                                                            <p>Front</p>
                                                                            <div class="date_carddd">
                                                                                <?=(strtotime($userDocDtl->created_at)) ? date('d M Y',strtotime($userDocDtl->created_at)) : 'NA'?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end col -->
                                                                <div class="element-item  col-lg-6 col-sm-6 ">
                                                                    <div class="gallery-box card">
                                                                        <div class="gallery-container">
                                                                            <a class="image-popup" target="_blank" href="<?=(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->idProofBack : ''?>" title="">
                                                                                <img class="gallery-img img-fluid mx-auto" src="<?=(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->idProofBack : ''?>" alt="">
                                                                                <div class="gallery-overlay">
                                                                                    <h5 class="overlay-caption"></h5>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div class="identity_content">
                                                                            <p>Back</p>
                                                                            <div class="date_carddd">
                                                                                <?=(strtotime($userDocDtl->created_at)) ? date('d M Y',strtotime($userDocDtl->created_at)) : 'NA'?>
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
                                                                            <a class="image-popup" title="" target="_blank" href="<?=(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->panCardFront : ''?>">
                                                                                <img class="gallery-img img-fluid mx-auto" src="<?=(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->panCardFront : ''?>" alt="">
                                                                                <div class="gallery-overlay">
                                                                                    <h5 class="overlay-caption"></h5>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div class="identity_content">
                                                                            <p>Front</p>
                                                                            <div class="date_carddd">
                                                                                22 Nov 2022
                                                                            </div>
                                                                        </div>
                                                                    </div>
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
                                                                            <a class="image-popup" title="" target="_blank" href="<?=(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->addressProofFront : ''?>">
                                                                                <img class="gallery-img img-fluid mx-auto" src="<?=(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->addressProofFront : ''?>" alt="">
                                                                                <div class="gallery-overlay">
                                                                                    <h5 class="overlay-caption"></h5>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div class="identity_content">
                                                                            <p>Front</p>
                                                                            <div class="date_carddd">
                                                                                22 Nov 2022
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end col -->
                                                                <div class="element-item  col-lg-6 col-sm-6 ">
                                                                    <div class="gallery-box card">
                                                                        <div class="gallery-container">
                                                                            <a class="image-popup" target="_blank" href="<?=(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->addressProofBack : ''?>" title="">
                                                                                <img class="gallery-img img-fluid mx-auto" src="<?=(!empty($userDocDtl)) ? env('APP_URL').'public/'.$userDocDtl->addressProofBack : ''?>" alt="">
                                                                                <div class="gallery-overlay">
                                                                                    <h5 class="overlay-caption"></h5>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div class="identity_content">
                                                                            <p>Back</p>
                                                                            <div class="date_carddd">
                                                                                22 Nov 2022
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end col -->
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="col-lg-12">
                                                                <div class="document_title_type">Others documents  </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="element-item  col-lg-12 col-sm-12">
                                                                    <?php if(count($otherKycDocs)){ ?>                                    
                                                                        <?php foreach($otherKycDocs as $otherRow){ ?>        
                                                                            <div class="row mb-2" style="padding: 5px;">
                                                                                <div class="col-lg-6 col-sm-6"><center><?=$otherRow->title?></center></div>
                                                                                <div class="col-lg-6 col-sm-6">
                                                                                <a class="btn btn-warning" title="" target="_blank" href="<?=(!empty($otherRow->docsUrl)) ? env('APP_URL').'public/'.$otherRow->docsUrl : ''?>">
                                                                                            View Document
                                                                                        </a>
                                                                                    </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <!-- end col -->
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <!-- end col -->
                                                            </div>
                                                    </div> 

                                                    <div class="row gallery-wrapper mt-4">
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-12">
                                                                <div class="document_title_type">Photo/PDF of Bank Statement</div>
                                                            </div>
                                                            <?php
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
                                                            ?>
                                                            <div class="row">
                                                                <div class="element-item col-lg-12 col-sm-12 " id="padding_custom">
                                                                    <div class="gallery-box card">
                                                                        <div class="gallery-container">
                                                                            <a class="btn btn-danger bg-danger" title="" target="_blank" href="<?=env('APP_URL').'public/'.$userDocDtl->bankAttachemet?>">
                                                                                View Bank Statement
                                                                            </a>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                <?php } ?>
                                            </section>
                                            
                                            
                                            <section id="content5" class="tab-content">
                                                @if(!empty($userBankDtl))
                                                <form action="">
                                                    <div class="row inner_formdata">
                                                        <div class="col-lg-6">
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Account Holder Name: </label>
                                                                        <span>{{$userBankDtl->accountHolderName}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Bank Name: </label>
                                                                        <span>{{$userBankDtl->bankName}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> IFSC: </label>
                                                                        <span>{{$userBankDtl->ifscCode}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Account Type: </label>
                                                                        <span>{{$userBankDtl->accountType}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Address: </label>
                                                                        <span>{{$userBankDtl->address}}</span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> City: </label>
                                                                        <span>{{$userBankDtl->city}}</span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> State: </label>
                                                                        <span>{{$userBankDtl->state}}</span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Pin Code: </label>
                                                                        <span>{{$userBankDtl->pincode}}</span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mr_removecol">
                                                                    <div class="form-group ">
                                                                        <label for=""> Account Number:</label>
                                                                        <span>{{$userBankDtl->accountNumber}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                @endif
                                            </section>
                                            
                                        </div>
                                        <!-- end -->

                                    </div>


                                    <div class="tab-pane fade text-left text-light" id="loanHistory" role="tabpanel" aria-labelledby="loan-tab">
                                            <div class="tb_head">
                                                <h1>Loan History</h1>
                                            </div>
                                        
                                            <div class="tabs active" id="loanhis_tabsin">
                                                <?php
                                                    if(count($categories))
                                                    {
                                                        foreach($categories as $crow)
                                                        {
                                                            echo '<input type="radio" name="tabs" id="tabone'.$crow->id.'" >
                                                            <label for="tabone'.$crow->id.'" onclick="getLoanHistoryByUser('.$crow->id.');">'.$crow->name.'</label>';
                                                        }
                                                    }
                                                ?>
                                            </div>
                                            <div class="tab">
                                                 <section class="filters_table" id="loanHistoryHtml">

                                                </section>
                                            </div>
                                    </div>
                                    <div class="tab-pane fade text-left text-light" id="changepass" role="tabpanel" aria-labelledby="pass-tab">
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
                                    <!--</div>-->
                                </div><!--tab content end-->
                                
                            </div><!-- col-md-8 end -->
                        </section>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- modal disbursement request -->

<!-- Modal -->
<div class="modal fade modal_disbursement" id="disbursementRequestModal" tabindex="-1" aria-labelledby="disbursementRequestModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Disbursement Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                
                    <input type="hidden" id="loanRequestId" name="loanRequestId" value="" >
                    <div class="form-group">
                        <label for="requestAmount">Request Amount</label>
                        <input type="number" class="form-control" id="requestAmount" name="requestAmount" >
                    </div>
                    {{--<div class="form-group">
                        <label for="tenure">Tenure</label>
                        <select name="approveTenure" id="approveTenure" class="form-control">
                            <option value="">Select</option>
                            <?php if(count($tenures)){ ?>
                                <?php foreach($tenures as $trow){ ?>
                                    <option value="{{$trow->id}}">{{$trow->name}}</option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>--}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary pop_clbtn" data-dismiss="modal">Close</button>
                <button type="button" class="btn-primary btnpop_frmsubmit" onclick="disbursementRequestForRawMaterial();">Save changes</button>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
function changePassword()
{
    var oldPassword=$('#oldPassword').val();
    var newPassword=$('#newPassword').val();
    var newPasswordC=$('#newPasswordC').val();
    if(!oldPassword) {
        alertMessage('Error!', 'Please enter old password.', 'error', 'no');
        return false;
    } else if(!newPassword) {
        alertMessage('Error!', 'Please enter new password.', 'error', 'no');
        return false;
    } else if(!newPasswordC) {
        alertMessage('Error!', 'Please please enter confirm password.', 'error', 'no');
        return false;
    } else if(newPassword != newPasswordC) {
        alertMessage('Error!', 'Confirm password not matched.', 'error', 'no');
        return false;
    }else{
        $('#changePasswordBtn').text('Please Wait...').attr('disabled','disabled');
        $.post('{{route('changePasswordWeb')}}',{
            "_token": "{{ csrf_token() }}",
            oldPassword:oldPassword,
            newPassword:newPassword,
            newPasswordC:newPasswordC,
        },function(data){
            var obj = JSON.parse(data);
            $('#changePasswordBtn').text('Save').removeAttr('disabled');
            if(obj.status=='success'){
                $('#oldPassword').val('');
                $('#newPassword').val('');
                $('#newPasswordC').val('');
                alertMessage('Success!', obj.message, 'success', 'no');
                return false;
            }else{
                alertMessage('Error!', obj.message, 'error', 'no');
                return false;
            }
        });
    }
}

function getLoanHistoryByUser(loanType)
{
    $('#changePasswordBtn').text('Please Wait...').attr('disabled','disabled');
    $.post('{{route('getLoanHistoryByUserWeb')}}',{
        "_token": "{{ csrf_token() }}",
        loanType:loanType,
    },function(data){
        $('#loanHistoryHtml').html(data);
    });
}

function filterRawMaterialTxnHistory(loanId)
{
    var rawFilterType=$('#rawFilterType'+loanId).val();
    $('#changePasswordBtn').text('Please Wait...').attr('disabled','disabled');
    $.post('{{route('filterRawMaterialTxnHistory')}}',{
        "_token": "{{ csrf_token() }}",
        loanId:loanId,
        rawFilterType:rawFilterType,
    },function(data){
        $('#rawTxnDetails'+loanId).html(data);
    });
}

function openDisbursementRequestModal(loanId)
{
    $('#loanRequestId').val(loanId);
    $('#disbursementRequestModal').modal('show');
}

function disbursementRequestForRawMaterial()
{
    var loanRequestId=$('#loanRequestId').val();
    var requestAmount=$('#requestAmount').val();
    var approveTenure=$('#approveTenure').val();

    if(!parseInt(loanRequestId)){
        alertMessage('Error!', 'Invalid Request, Please try again', 'error', 'yes');
        return false;
    }

    if(!parseInt(requestAmount)){
        alertMessage('Error!', 'Please enter amount.', 'error', 'no');
        return false;
    }/*else if(!approveTenure){
        alertMessage('Error!', 'Please select tenure.', 'error', 'no');
        return false;
    }*/else{
        waitForProcess();
        $.post('{{route('disburseRequestForRawMaterialAppliedLoans')}}',{
            "_token": "{{ csrf_token() }}",
            loanId:loanRequestId,
            amount:requestAmount,
            approveTenure:approveTenure,
        },function (data){
            var obj = JSON.parse(data);
            if(obj.status=='success'){
                alertMessage('Success!', obj.message, 'success', 'yes');
                return false;
            }else{
                alertMessage('Error!', obj.message, 'error', 'no');
                return false;
            }
        });
    }
}
</script>
@endsection
