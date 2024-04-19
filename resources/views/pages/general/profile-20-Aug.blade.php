@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <?php
    $userPermissions=App\Providers\AppServiceProvider::checkDecodePermissions();
    ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Customer Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <!-- <li class="breadcrumb-item active">Customer Management</li>
                        <li class="breadcrumb-item active">Customers</li> -->
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--
    <div class="page-header d-lg-flex d-block">
       <div class="page-leftheader">
          <div class="page-title"> Amiah Burton</div>
       </div>
    </div>
     -->

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="position-relative">
                    <figure class="overflow-hidden profile_coverimage mb-0 d-flex justify-content-center">
                        <img  src="{{ env('APP_URL')}}/assets/images/users/cover.jpg" class="rounded-top" alt="profile cover">
                    </figure>
                    <div class="d-flex justify-content-between align-items-center position-absolute top-90 w-100 px-2 px-md-4 progile_detailcovep">
                        <div>
                            @php
                                if($userDtl->profilePic){
                                    $profilePic=env('APP_URL').'public/'.$userDtl->profilePic;
                                }else{
                                    $profilePic='https://www.computerhope.com/jargon/g/guest-user.jpg';
                                }
                            @endphp

                            <img class=" user_pimg rounded-circle" style="width: 114px;height: 114px;object-fit: cover;"  src="{{$profilePic}}" alt="profile">
                            <span class="h4 ms-3 text-dark profileuser_title">{{ucwords($userDtl->name)}}</span>
                        </div>
                        <div class="d-none d-md-block">
                            <button class="btn  crd_btn btn-icon-text mpin_colorbg" onclick="displayMpin();"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="View MPIN">
                                <i data-feather="" class="btn-icon-prepend"></i> MPin : ******
                            </button>
                            <a class="btn  crd_btn btn-icon-text" href="{{route('customerCard',$userDtl->id)}}"  data-bs-toggle="tooltip" target="_blank" data-bs-placement="bottom" title="Customer Card">
                                <i data-feather="" class="btn-icon-prepend"></i> Customer Card
                            </a>
                            <a href="{{ route('creditScoreQnsAns',$userDtl->id) }}"> <button class="btn  crd_btn btn-icon-text">
                                    <i data-feather="git-branch" class="btn-icon-prepend"></i> AdvanX Score ({{$finalAdvanxScore}})
                                </button></a>
                            <button class="btn  crd_btn btn-icon-text" onclick="sourceOfApplication();"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Source">
                                <i data-feather="globe" class="btn-icon-prepend"></i> Source
                            </button>
                            <button class="btn  crd_btn btn-icon-text"  data-bs-toggle="modal" data-bs-target="#credit_score_modal" >
                                <i data-feather="activity" class="btn-icon-prepend"></i> Bureau Credit Score
                            </button>
                            <button class="btn btn-primary btn-icon-text"  data-bs-toggle="modal" data-bs-target="#add_User_modal2">
                                <i data-feather="edit" class="btn-icon-prepend"></i> Edit profile
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-3 col-lg-3 left-wrapper">
            <div class="card rounded profilecard">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="card-title mb-0">Customer Details</h6>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 detail_title">Customer Name:</label>
                        <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->name : ''}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 detail_title">Customer ID:</label>
                        <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->customerCode : ''}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 detail_title">Customer Email:</label>
                        <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->email : ''}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 detail_title">Customer Mobile Number:</label>
                        <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->mobile : ''}}</p>
                    </div>

                </div>
            </div>

            <div class="card rounded profilecard">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="card-title mb-0">Applied Loan Details</h6>
                    </div>
                    @if(count($loanDetailsArr))
                        @php
                            $loansr=1;
                        @endphp
                        <div class="accordion mt-4 custom_profileaccordian" id="accordionExample">
                            @foreach($loanDetailsArr as $loanDetails)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne{{$loansr}}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$loansr}}" aria-expanded="true" aria-controls="collapseOne{{$loansr}}">
                                            {{($loanDetails->categoryName) ? $loanDetails->categoryName : $loanDetails->productName}}
                                        </button>
                                    </h2>
                                    <div id="collapseOne{{$loansr}}" class="accordion-collapse collapse " aria-labelledby="headingOne{{$loansr}}" data-bs-parent="#accordionExample{{$loansr}}">
                                        <div class="accordion-body">
                                            <div class="mt-3">
                                                <label class="tx-11 fw-bolder mb-0 detail_title">Loan ID:</label>
                                                <p class="text-muted">{{env('LOANID_PRE')}}{{$loanDetails->loanId}}</p>
                                            </div>
                                            <div class="mt-3">
                                                <label class="tx-11 fw-bolder mb-0 detail_title">Amount:</label>
                                                <p class="text-muted">{{($loanDetails->approvedAmount) ? number_format($loanDetails->approvedAmount,2) : number_format($loanDetails->appliedLoanAmount,2)}}</p>
                                            </div>
                                            @if($loanDetails->categoryName)
                                                <div class="mt-3">
                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Loan Type:</label>
                                                    <p class="text-muted">{{$loanDetails->categoryName}}/{{$loanDetails->subCategoryName}}</p>
                                                </div>
                                            @endif

                                            @if($loanDetails->appliedTenure)
                                                <div class="mt-3">
                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Tenure :</label>
                                                    <p class="text-muted">{{$loanDetails->appliedTenure}}</p>
                                                </div>
                                            @endif
                                            @if($loanDetails->givenROI)
                                                <div class="mt-3">
                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Interest:</label>
                                                    <p class="text-muted">{{$loanDetails->givenROI}}%</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $loansr++;
                                @endphp
                                @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-9 col-lg-9 middle-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="customer_detailstab">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">KYC</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="false">Personal Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" role="tab" aria-controls="contact" aria-selected="false">Professional Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link kyc_management" id="kyc_management_tab" data-bs-toggle="tab" data-bs-target="#kyc_management" role="tab" aria-controls="kyc_management" aria-selected="false">Bank Details</a>
                            </li>
                        </ul>
                        <div class="tab-content border border-top-0 p-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class=" profile-box flex-fill">
                                    <div class="card-body personal_Details">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card" id="orderList">
                                                    <div class="card-header  border-0">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="card-title mb-0 flex-grow-1">Documents</h5>
                                                            <div class="flex-shrink-0">
                                                                <button type="button" class="btn btn-info"><i data-feather="download-cloud" class="btn-icon-prepend feather_iconfont"></i> Export</button>

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

                                                         $salarySlip3='';
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

                                            <div class="row gallery-wrapper mt-4">
                                                <div class="col-lg-9">
                                                    <div class="col-lg-12">
                                                        <div class="document_title_type">Photo/PDF of Bank Statement</div>
                                                    </div>
                                                    <div class="row">
                                                        @php
                                                            $bankAttachemet='';
                                                                if(!empty($userDocDtl->bankAttachemet))
                                                                {
                                                                    $bankAttachemetArr=explode('.',$userDocDtl->bankAttachemet);
                                                                    if(strtolower($bankAttachemetArr[1])=='pdf'){
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
                                                                        <div class="gallery-overlay">
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
                                        @endif

                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                <div class=" profile-box flex-fill">
                                    <div class="card-body personal_Details table_card">
                                        <h3 class="card-title">Customer Personal Details <a href="#" class=""></a></h3>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="details_listview">
                                                    <ul>
                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">Full Name:</label>
                                                                <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->name : 'NA'}}</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">Date of Birth:</label>
                                                                <p class="text-muted">{{(strtotime($userDtl->dateOfBirth)) ? date('d/m/Y',strtotime($userDtl->dateOfBirth)) : 'NA'}}</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">Gender:</label>
                                                                <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->gender : 'NA'}}</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">Marital Status:</label>
                                                                <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->maritalStatus : 'NA'}}</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">Address:</label>
                                                                <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->addressLine1 : 'NA'}}</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">Address Optional:</label>
                                                                <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->addressLine2 : 'NA'}}</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">City:</label>
                                                                <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->city : 'NA'}}</p>
                                                            </div>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="details_listview">
                                                    <ul>

                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">District:</label>
                                                                <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->district : 'NA'}}</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">State:</label>
                                                                <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->state : 'NA'}}</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">PinCode:</label>
                                                                <p class="text-muted">{{(!empty($userDtl)) ? $userDtl->pincode : 'NA'}}</p>
                                                            </div>
                                                        </li>
                                                        <?php
                                                            $aadhaarNumber='';
                                                            $permanentAccountNumber='';
                                                            if(!empty($userDocDtl)){
                                                                $aadhaarLog="";
                                                                if($userDocDtl->aadhaarLog){
                                                                    $aadhaarLog=json_decode($userDocDtl->aadhaarLog);
                                                                    $aadhaarNumber=(isset($aadhaarLog->data_from_validation->aadhaarNumber)) ? $aadhaarLog->data_from_validation->aadhaarNumber : '';
                                                                }
                                                                $userDocDtl->aadhaarLog=$aadhaarLog;

                                                                $pancardLog="";
                                                                if($userDocDtl->pancardLog){
                                                                    $pancardLog=json_decode($userDocDtl->pancardLog);
                                                                    $permanentAccountNumber=(isset($pancardLog->data_from_validation->panNumber)) ? $pancardLog->data_from_validation->panNumber : '';
                                                                }
                                                            }
                                                        ?>
                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">Aadhaar Number:</label>
                                                                <p class="text-muted">{{($aadhaarNumber) ? $aadhaarNumber : 'NA'}}</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="detail_flex">
                                                                <label class="tx-11 fw-bolder mb-0 detail_title">Pan Number:</label>
                                                                <p class="text-muted">{{($permanentAccountNumber) ? $permanentAccountNumber : 'NA'}}</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                                <div class=" profile-box flex-fill">
                                    <div class="card-body personal_Details table_card">
                                        <h3 class="card-title">Employment Information   <a href="#" class=""></a></h3>
                                        @if(!empty($userEmploymentHistory))
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="details_listview">
                                                        <ul>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Employer Name:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->employerName : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Date of Joining:</label>
                                                                    <p class="text-muted">{{(strtotime($userEmploymentHistory->joiningDate)) ? date('d/m/Y',strtotime($userEmploymentHistory->joiningDate)) : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Employee ID:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->employeeId : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Type:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->type : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Designation:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->designation : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Department:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->department : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Gross Salary - PA:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->grossSalery : 'NA'}}</p>
                                                                </div>
                                                            </li>


                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="details_listview">
                                                        <ul>

                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Email ID:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->emailId : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Phone Number:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->mobileNo : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Address:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->department : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">District:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->district : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">State:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->state : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">PinCode:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->pincode : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Experience in Current Company:</label>
                                                                    <p class="text-muted">{{(!empty($userEmploymentHistory)) ? $userEmploymentHistory->experienceInCurrentCompany : 'NA'}}</p>
                                                                </div>


                                                        </ul>
                                                    </div>
                                                </div>
                                                @if($pageNameStr=='employment-verification' || $pageNameStr=='employment-verification-rejected')
                                                <div class="col-lg-12">
                                                    <div class="{{($userEmploymentHistory->status!='approved') ? 'col-md-12' : 'col-md-6'}}" <?=($userEmploymentHistory->status=='approved') ? 'style="float:right;"' : ''?> >
                                                        <div class="approved_or_rejectbtn" >
                                                            @if($userEmploymentHistory->status=='pending')
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <a href="javascript:;" onclick="approveUserEmployment({{$userEmploymentHistory->id}},1);" class="btn btn-success btn-icon-text"> <i class="btn-icon-prepend" data-feather="check-square"></i> Approve for Employment </a>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <a href="javascript:;" onclick="approveUserEmployment({{$userEmploymentHistory->id}},2);" class="btn btn-danger btn-icon-text"> Reject for Employment<i class="btn-icon-append" data-feather="x"></i></a>
                                                                    </div>
                                                                </div>

                                                            @elseif($userEmploymentHistory->status=='approved')
                                                                <label class="label label-success">Employment Approved </label>
                                                            @elseif($userEmploymentHistory->status=='rejected')
                                                                <label class="label label-danger">Employment Rejected  </label>
                                                                <a href="javascript:;" onclick="approveUserEmployment({{$userEmploymentHistory->id}},1);" class="btn btn-success btn-icon-text"> <i class="btn-icon-prepend" data-feather="check-square"></i> Approve for Employment </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kyc_management" role="tabpanel" aria-labelledby="kyc_management_tab">
                                <div class=" profile-box flex-fill">
                                    <div class="card-body personal_Details table_card">
                                        <h3 class="card-title">Customer Bank Information<a href="#" class=""></a></h3>

                                        @if(!empty($userBankDtl))
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="details_listview">
                                                        <ul>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Bank Name:</label>
                                                                    <p class="text-muted">{{(!empty($userBankDtl)) ? $userBankDtl->bankName : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">IFSC:</label>
                                                                    <p class="text-muted">{{(!empty($userBankDtl)) ? $userBankDtl->ifscCode : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Account Type:</label>
                                                                    <p class="text-muted">{{(!empty($userBankDtl)) ? $userBankDtl->accountType : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Account Number:</label>
                                                                    <p class="text-muted">{{(!empty($userBankDtl)) ? $userBankDtl->accountNumber : 'NA'}}</p>
                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="details_listview">
                                                        <ul>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Address:</label>
                                                                    <p class="text-muted">{{(!empty($userBankDtl)) ? $userBankDtl->address : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">City:</label>
                                                                    <p class="text-muted">{{(!empty($userBankDtl)) ? $userBankDtl->city : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">State:</label>
                                                                    <p class="text-muted">{{(!empty($userBankDtl)) ? $userBankDtl->state : 'NA'}}</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="detail_flex">
                                                                    <label class="tx-11 fw-bolder mb-0 detail_title">Pin Code:</label>
                                                                    <p class="text-muted">{{(!empty($userBankDtl)) ? $userBankDtl->pincode : 'NA'}}</p>
                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row col-lg-12 " >
                    <div class="col-md-6">&nbsp;</div>
                    <div class="{{($userDtl->kycStatus!='approved') ? 'col-md-6' : 'col-md-3'}}">
                        <div class="approved_or_rejectbtn" >
                            @if($userDtl->kycStatus=='pending')
                                <a href="javascript:;" onclick="approveUserKyc({{$userDtl->id}},1);" class="btn btn-success btn-icon-text"> <i class="btn-icon-prepend" data-feather="check-square"></i> Approved for KYC Verification </a>
                                <a href="javascript:;" onclick="approveUserKyc({{$userDtl->id}},2);" class="btn btn-danger btn-icon-text"> Reject <i class="btn-icon-append" data-feather="x"></i></a>
                            @elseif($userDtl->kycStatus=='approved')
                                <label class="label label-success">KYC Approved </label>
                            @elseif($userDtl->kycStatus=='rejected')
                                <a href="javascript:;" class="btn btn-danger btn-icon-text"> <i class="btn-icon-append" data-feather="x"></i></a>
                                <label class="label label-danger">KYC Rejected  </label>
                                <a href="javascript:;" onclick="approveUserKyc({{$userDtl->id}},1);" class="btn btn-success btn-icon-text"> <i class="btn-icon-prepend" data-feather="check-square"></i> Approved for KYC Verification </a>
                            @endif
                        </div>
                    </div>
                    @if(!empty($loanDetails))
                    <?=($loanDetails->loanStatus=='pending') ? '<div class="col-md-4">&nbsp;</div>' : ''?>
                    <div class="{{($loanDetails->loanStatus=='pending') ? 'col-md-8' : 'col-md-3'}}" >
                            <div class="approved_or_rejectbtn" >
                                @if($userDtl->kycStatus=='approved' && $loanDetails->loanStatus=='pending')
                                    @if($userDtl->disbursementStatus=='pending' && $pageNameStr=='kyc-verified-customers')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="javascript:;" onclick="$('#confirmAmountForDisbursementModal').modal('show');" class="btn btn-success btn-icon-text"> <i class="btn-icon-prepend" data-feather="check-square"></i> Approve for Disbursement </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="javascript:;" onclick="approveUserDisbursement({{$userDtl->id}},2);" class="btn btn-danger btn-icon-text"> Reject Disbursement<i class="btn-icon-append" data-feather="x"></i></a>
                                            </div>
                                        </div>

                                    @elseif($userDtl->disbursementStatus=='approved')
                                        <label class="label label-success">Disbursement Approved  </label>
                                    @elseif($userDtl->disbursementStatus=='rejected' && $pageNameStr=='kyc-verified-customers')
                                        <label class="label label-danger">Disbursement Rejected </label>
                                        <a href="javascript:;" onclick="$('#confirmAmountForDisbursementModal').modal('show');" class="btn btn-success btn-icon-text"> <i class="btn-icon-prepend" data-feather="check-square"></i> Approve for Disbursement </a>
                                    @endif
                                @elseif($loanDetails->loanStatus=='customer-approved' && $pageNameStr=='final-approval-for-disbursement')
                                    <a href="javascript:;" onclick="$('#disburseAmountModal').modal('show');" class="btn btn-warning">Schedule Disburse </a>
                                @endif
                                @if($loanDetails->loanStatus=='sent-for-customer-approval' || $loanDetails->loanStatus=='disburse-scheduled' || $loanDetails->loanStatus=='disbursed')
                                    <label class="label label-warning">{{strtoupper($loanDetails->loanStatus)}} </label>
                                @endif

                            </div>
                    </div>
                    @endif
                </div>


            </div>
        </div>
        <!-- middle wrapper end -->

    </div>



    <!-- edit profile modal start -->
    <div class="example add_User_modalstart">
        <!-- Modal -->
        <div class="modal fade" id="add_User_modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="forms-sample">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Customer ID</label>
                                        <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="#AE6754">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Customer Name</label>
                                        <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Amiah Burton">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Customer Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="advanX@gmail.com">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="+91-9878675487">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Update Profile Picture</h6>
                                                <input type="file" id="myDropify"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row end -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="profile"><button type="button" class="btn btn-primary">Save changes</button></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- check credit score pdf  modal start -->
    <div class="example add_customer_modalstart">
        <!-- Modal -->
        <div class="modal fade" id="credit_score_modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Credit Score</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="forms-sample">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="credir_score_pdf">
                                        <img class="pdf_printanddownload"  src="{{ env('APP_URL')}}/assets/images/customer-attachements/gstbill1.jpg" alt="profile">

                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="javascript:void(0);"><button type="button" class="btn btn-primary">Print</button></a>
                        <a href="javascript:void(0);"><button type="button" class="btn btn-primary">Download</button></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="example add_customer_modalstart">
        <!-- Modal -->
        <div class="modal fade" id="rejectKycModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Reject KYC</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="rejectUser">
                            <div class="col-lg-12">
                                <label>Enter Reason</label>
                                <textarea name="rejectReason" id="rejectReason" class="form-control" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="javascript:void(0);" onclick="rejectKyc();" class="btn btn-danger">Reject KYC</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="example add_customer_modalstart">
        <!-- Modal -->
        <div class="modal fade" id="rejectKycModalDisbursement" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Reject Disbursement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="rejectUserDisbursement">
                            <div class="col-lg-12">
                                <label>Enter Reason</label>
                                <textarea name="rejectReasonDisbursement" id="rejectReasonDisbursement" class="form-control" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="javascript:void(0);" onclick="rejectDisbursement();" class="btn btn-danger">Reject KYC</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectEmploymentModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Reject Employment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="rejectUserEmployment">
                        <div class="col-lg-12">
                            <label>Enter Reason</label>
                            <textarea name="rejectReasonEmployment" id="rejectReasonEmployment" class="form-control" rows="8"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="javascript:void(0);" onclick="rejectEmployment();" class="btn btn-danger">Reject Employment</a>
                </div>
                </form>
            </div>
        </div>
    </div>

    @if(!empty($loanDetails))
        <!-- Modal -->
        <div class="modal fade" id="confirmAmountForDisbursementModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Review Loan Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="loanId" name="loanId" value="{{$loanDetails->loanId}}">
                            <div class="col-lg-12">
                                <center><h4>Product Details</h4></center>
                                <hr>
                            </div>
                            @if($loanDetails->productType==0)
                                <div class="col-lg-6 mt-3">
                                    <label ><strong>Loan Type</strong></label><br>
                                    <label>{{$loanDetails->categoryName}}/{{$loanDetails->subCategoryName}}</label>
                                </div>
                            @endif
                            <div class="col-lg-6 mt-3">
                                <label ><strong>Product Name</strong></label><br>
                                <label>{{$loanDetails->productName}}</label>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label ><strong>Product Amount</strong></label><br>
                                @if($loanDetails->productType==0)
                                    <label>{{$loanDetails->productAmount}}</label>
                                @else
                                    <label>{{$loanDetails->productAmount}} - {{$loanDetails->productAmountTo}}</label>
                                @endif
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label ><strong>Product ROI</strong></label><br>
                                <label>{{$loanDetails->productROI}} %</label>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label ><strong>Product No. Of. EMI</strong></label><br>
                                <label>{{$loanDetails->productEMI}} </label>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label><strong>Applied Loan Amount</strong></label><br>
                                <label>{{$loanDetails->appliedLoanAmount}} </label>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label ><strong>Applied Tenure</strong></label><br>
                                <label>{{$loanDetails->appliedTenure}} </label>
                            </div>
                            <div class="col-lg-12 mt-3" {{($loanDetails->productType==0) ? 'style="display:none"' : ''}}>
                                <label><strong>Approve Tenure</strong></label>
                                <select class="js-example-basic-single2 form-select" id="approveTenure" data-width="100%">
                                    <option value="">Select Tenure</option>
                                    @if(count($tenure))
                                        @foreach($tenure as $trow)
                                            @php
                                                $selectedTenure='';
                                                    if($loanDetails->appliedTenureId==$trow->id){
                                                        $selectedTenure='selected';
                                                    }
                                            @endphp
                                            <option value="{{$trow->id}}" {{$selectedTenure}} datamonth="{{$trow->otherValueOrDays}}">{{$trow->ansTitle}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label><strong>Approve Amount</strong></label>
                                <input type="text" id="approvedAmount" value="{{$loanDetails->appliedLoanAmount}}" class="form-control">
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label><strong>Approve ROI</strong></label>
                                <input type="text" id="approvedROI" value="{{$loanDetails->productROI}}" class="form-control">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="javascript:void(0);" onclick="approveUserDisbursement({{$userDtl->id}},1);" class="btn btn-warning">Send For Customer Approval</a>
                    </div>
                    </form>
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
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <center><h4>Product Details</h4></center>
                                <hr>
                            </div>
                            <input type="hidden" id="loanIdDisburse" name="loanId" value="{{$loanDetails->loanId}}">
                            <input type="hidden" id="productIdDisburse" value="{{$loanDetails->productId}}">
                            @if($loanDetails->productType==0)
                                <div class="col-lg-6 mt-3">
                                    <label ><strong>Loan Type</strong></label><br>
                                    <label>{{$loanDetails->categoryName}}/{{$loanDetails->subCategoryName}}</label>
                                </div>
                            @endif
                            <div class="col-lg-6 mt-3">
                                <label ><strong>Product Name</strong></label><br>
                                <label>{{$loanDetails->productName}}</label>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label ><strong>Product Amount</strong></label><br>
                                @if($loanDetails->productType==0)
                                    <label>{{$loanDetails->productAmount}}</label>
                                @else
                                    <label>{{$loanDetails->productAmount}} - {{$loanDetails->productAmountTo}}</label>
                                @endif
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label ><strong>Product ROI</strong></label><br>
                                <label>{{$loanDetails->productROI}} %</label>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label ><strong>Product No. Of. EMI</strong></label><br>
                                <label>{{$loanDetails->productEMI}} </label>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label><strong>Applied Loan Amount</strong></label><br>
                                <label>{{$loanDetails->appliedLoanAmount}} </label>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label ><strong>Applied Tenure</strong></label><br>
                                <label>{{$loanDetails->appliedTenure}} </label>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label><strong>Approved Amount</strong></label><br>
                                <label>{{$loanDetails->approvedAmount}}</label>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label><strong>Disburse Date</strong></label>
                                <input type="date" style="cursor: pointer;" id="disburseDate" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="javascript:void(0);" onclick="scheduleDisburse({{$userDtl->id}});" class="btn btn-warning">Submit</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @push('plugin-scripts')
        <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
    @endpush

    @push('custom-scripts')
        <script src="{{ asset('assets/js/form-validation.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
        <script src="{{ asset('assets/js/inputmask.js') }}"></script>
        <script src="{{ asset('assets/js/select2.js') }}"></script>
        <script src="{{ asset('assets/js/typeahead.js') }}"></script>
        <script src="{{ asset('assets/js/tags-input.js') }}"></script>
        <script src="{{ asset('assets/js/dropzone.js') }}"></script>
        <script src="{{ asset('assets/js/dropify.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/timepicker.js') }}"></script>
    @endpush
@endsection
@section('scripts')
    <script>
        function approveUserKyc(userId,status)
        {
            if(status==1)
            {
                swal({
                    title: 'Warning!',
                    text: 'Are you sure want to approve this KYC details?',
                    icon: 'warning',
                    buttons:true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        saveKycStatus(userId,status,'');
                    }
                });
            }else{
                $('#rejectUser').val(userId);
                $('#rejectReason').val('');
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
                    text: 'Are you sure want to reject this KYC details?',
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
                swal({
                    title: 'Warning!',
                    text: 'Are you sure want to approve this Professional details?',
                    icon: 'warning',
                    buttons:true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        saveEmploymentStatus(userId,status,'');
                    }
                });
            }else{
                $('#rejectUserEmployment').val(userId);
                $('#rejectReasonEmployment').val('');
                $('#rejectEmploymentModal').modal('show');
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
                    text: 'Are you sure want to reject this Employment details?',
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

        function approveUserDisbursement(userId,status)
        {
            if(status==1)
            {
                var loanId=$('#loanId').val();
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
                $('#rejectReasonDisbursement').val('');
                $('#rejectKycModalDisbursement').modal('show');
            }
        }

        function rejectDisbursement()
        {
            var userId=$('#rejectUserDisbursement').val();
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
                        saveDisbursementStatus(userId,2,rejectReason);
                    }
                });
            }
        }

        function saveDisbursementStatus(userId,status,remark)
        {
            waitForProcess();
            $.post('{{route('saveDisbursementStatus')}}',{
                "_token": "{{ csrf_token() }}",
                userId:userId,
                status:status,
                remark:remark,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success')
                {
                    $('#rejectUserDisbursement').val('');
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

        function sourceOfApplication()
        {
            swal({
                title: 'Source of application',
                text: '{{$source_of_applicationStr}}',
                icon: 'info',
                closeOnClickOutside: false,
            });
        }

        $(document).ready(function(){
            <?php if($pageNameStr=='employment-verification' || $pageNameStr=='employment-verification-rejected'){ ?>
                $('.nav-link').removeClass('active').attr('selected','false');
                $('.tab-pane').removeClass('active');
                $('#contact-tab').addClass('active show').attr('selected','true');
                $('#contact').addClass('active show');
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
    </script>
@endsection
