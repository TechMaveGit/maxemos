@extends('web.layout.master')
@section('content')
<style>
    .btn {
        cursor: pointer;
    }

    .nice-select .list{
        height: auto !important;
        max-height: 220px;
        overflow-y: auto;
    }

   .form-group .error_text{
        position: absolute;
        left: 0;
        top: 53px;
    }

    .error_background{
        background-color: #ffe8e8 !important;
        border: 1px solid #ff7272 !important;
    }
    /* .dropify-wrapper{
        height: 100% !important;
    } */
    .businessKycOther .contact-one__form-input {
        margin-bottom:0px !important;
    }

    .progress_innercard{
        width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
    }
    #dynamic{
        width: 70%;
    }
    .verify_docbutton button{
        padding: 4px 25px;
  background: #15d594;
  color: #fff;
  font-size: 13px;
  border-radius: 4px;
    }

    #margin_btcus .progress_innercard{
        margin-top: -17px;
  margin-bottom: 30px;
    }
</style>



@php
     $indianStates = [
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
@endphp
<!-- breadcrums -->
<!-- <div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-left">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcomeWeb')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Apply Now</li>
                    </ol>
                </nav>
                <h2>Apply Now</h2>
            </div>
        </div>
    </div>
</div> -->
<!-- breadcrums end -->
<!-- form section start -->



<section class="step_formsec">
    <img src="{{asset('assets/web')}}/asset/img/feature-shape-1-1.png" alt="" class="feature-one__shape-1">
    <img src="{{asset('assets/web')}}/asset/img/feature-shape-1-2.png" alt="" class="feature-one__shape-2">
    <img src="{{asset('assets/web')}}/asset/img/feature-shape-1-3.png" alt="" class="feature-one__shape-3">
    <div class="container  step_form_main">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title" id="section_heading">
                    <span>Provide Information</span>
                    <h2>Provide your details for loan</h2>
                    {{-- <p>The passages of Lorem Ipsum available but the major have suffered alteration embarrased</p> --}}
                    {{-- @if($errors->any())
                    <span class="text-danger">{{ implode('', $errors->all(':message')) }}</span>
                    @endif --}}
                    

                    {{-- @if(session()->get('error'))
                        <span class="text-danger">{{ session()->get('error') }}</span>
                    @endif --}}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="progress mt-3" style="height: 17px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated"
                    style="font-weight:bold; font-size:15px;" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <div class="card mt-3">
                @if (!$loanData)
                <div class="card-body p-4 step first_stepcd stepFrm0">
                    <div class="radio-group row justify-content-between px-3">
                        <div class="col-auto me-sm-2 mx-1 card-block py-0 radio">
                            <div class="row permission_fields">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="top_bb">
                                                <h1 class="permission">Your Data is 100% safe and secure</h1>
                                                <h3>Permission</h3>
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" value="yes" class="form-check-input"
                                                        id="provideAccessOfGalleryAnFiles">
                                                    <label class="form-check-label"
                                                        for="provideAccessOfGalleryAnFiles"><strong>I agree to provide access to
                                                        client for my loan data</strong></label>
                                                </div>
                                            </div>
                                            <div class="middle__bb">
                                                {{-- <h2 class="boost_title">Boost your business with maxemo</h2> --}}
                                                <p>Maxemo understands that keeping a business up and running is challenging. It’s hard to manage so many things happening at one place, with several sources receiving and giving out payments. These are just a handful of things counted of what goes inside a business, financially. So, we provide customised solutions, quick approvals & disbursals to help all businesses, whether small or large, tackle financial challenges with confidence. </p>
                                            </div>
                                            <div class="bottom__">
                                                <div class="agree_condition">
                                                    <div class="mb-3 form-check">
                                                        <input type="checkbox" class="form-check-input" value="yes"
                                                            id="acceptTermsAndConditions">
                                                        <label class="form-check-label" for="acceptTermsAndConditions"><strong>I
                                                            agree to the <a href="{{route('webTermCondition')}}">terms and condition</a> and <a href="{{route('webPrivacyPolicy')}}">privacy policy</a></strong></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bottom__2 ">
                                                <p class="step_1lastpera">These permissions increase your chances of
                                                    your eligibility</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="ps_lists">
                                                <ul>
                                                    <li>
                                                        <h2>Camera</h2>
                                                        <span>To facilitate KYC process</span>
                                                    </li>
                                                    <li>
                                                        <h2>Contacts</h2>
                                                        <span>To identify fraud within your contacts </span>
                                                    </li>
                                                    <li>
                                                        <h2>Device</h2>
                                                        <span>Register your device as a trusted device</span>
                                                    </li>
                                                    <li>
                                                        <h2>Location</h2>
                                                        <span>To check loan serviceability in your area </span>
                                                    </li>
                                                    <li>
                                                        <h2>SMS</h2>
                                                        <span>To understand yout financial position </span>
                                                    </li>
                                                    <li>
                                                        <h2>Storage</h2>
                                                        <span>Modify and read contents of your storage</span>
                                                    </li>
                                                    <li>
                                                        <h2>Camera</h2>
                                                        <span>To facilitate KYC process</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="filter-records" class="mx-5"></div>
                    <div class="row backprevbtns cart-footer">
                        <button id="nextBtn1" type="button" onclick="nextStepFn(0,1,'next');"
                            class="btn btn-primary btn-sm btn__nextt">Next</button>
                    </div>
                </div>
                @endif
                {{-- <form method="POST" id="allFieldsCustomForm">
                    @csrf --}}
                    <!-- kyc documents -->
                    <div class="card-body p-5 step stepFrm1" style="display: none">
                        <form method="POST" action="{{route('applyloan.step1')}}" id="ApplyLoanStep1" enctype="multipart/form-data"> @csrf
                        <h3>Select Your Requirement</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="loantype_select">
                                    <div class="grid-wrapper grid-col-auto">
                                        <div class="radiocard_row mb-5 row">
                                            @if(count($category))
                                                @php $catsr=1; @endphp
                                                @foreach($category as $catrow)
                                                    <div class="col-md-3 card_box__" onclick="initiateApplyLoan({{$catrow->id}})" >
                                                        <label for="loanType{{$catsr}}" class="radio-card">
                                                            <input type="radio" name="loanType" @if(old('loanType')) {{ old('loanType') == $catrow->id ? 'checked' : ''  }} @else {{ $loanData && $loanData->loanCategory == $catrow->id ? 'checked' : ''  }} @endif  value="{{$catrow->id}}" id="loanType{{$catsr}}" />
                                                            <div class="card-content-wrapper">
                                                                <span class="check-icon"></span>
                                                                <div class="card-content">
                                                                  
                                                                    @if($catrow->description)
                                                                    <div class="wrapper">
																		<i class="fa-solid fa-circle-info"></i>
																		<div class="tooltip">{{$catrow->description}}</div>
																	</div>
                                                                    @endif
                                                                    
                                                                    <img src="{{asset('assets/web').'/'.$catrow->image}}" alt="">
                                                                    <h4>{{$catrow->name}}</h4>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <!-- /.radio-card -->
                                                    </div>
                                                    @php $catsr++; @endphp
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="field_start information__" id="applyLoanOtherInputs">
                                        </div>
                                    </div>
                                    <!-- /.grid-wrapper -->
                                </div>
                            </div>
                        </div>
                        <div class="row backprevbtns card-footer">
                            {{-- <div class="col-auto">
                                <button id="backBtn2" type="button" onclick="nextStepFn(1,0,'prev');"
                                    class="btn btn-danger btn-sm btn__prevv ">Back</button>
                            </div> --}}
                            <div class="col-auto">
                                <button id="nextBtn2" type="button" onclick="nextStepFn(1,2,'next');"
                                    class="btn btn-primary btn-sm btn__nextt ">Next</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- kyc documents -->
                    <!-- personal info -->
                    <div class="card-body p-5 step stepFrm2 information__" style="display: none">
                        <form method="POST" id="ApplyLoanStep2" action="{{ route('applyloan.step2') }}" enctype="multipart/form-data"> @csrf
                        <div class="first_stepcd">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3>KYC</h3>
                                </div>
                            </div>
                        </div>
                        <div class="field_start kycuplods">
                            <div class="row">
                                <div class="col-md-6" id="idProofFrontdiv">
                                    <div class="form-group">
                                        <label>Photo of Emp. identity Card Front @if(!empty($userDocDtl) && $userDocDtl->idProofFront) <a
                                                href="{{asset('public')}}/{{$userDocDtl->idProofFront}}"
                                                target="_blank">(Click Here To View) </a>@endif </label>
                                        <div class="file_upload">
                                            <input type="file" name="idProofFront" id="idProofFront" class="dropify" data-default-file="{{ (!empty($userDocDtl) && $userDocDtl->idProofFront) ? asset('public').'/'.$userDocDtl->idProofFront : '' }}">
                                            <input type="hidden" name="idProofFrontOld" id="idProofFrontOld" value="<?=(!empty($userDocDtl) && $userDocDtl->idProofFront) ? $userDocDtl->idProofFront : ''?>">
                                        </div>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6" id="idProofBackdiv">
                                    <div class="form-group">
                                        <label>Photo of Emp. identity Card Back @if(!empty($userDocDtl) && $userDocDtl->idProofBack) <a
                                                href="{{asset('public')}}/{{$userDocDtl->idProofBack}}"
                                                target="_blank">(Click Here To View) </a>@endif</label>
                                        <div class="file_upload">
                                            <input type="file" name="idProofBack" id="idProofBack" class="dropify" data-default-file="{{ (!empty($userDocDtl) && $userDocDtl->idProofBack) ? asset('public').'/'.$userDocDtl->idProofBack : '' }}" >
                                            <input type="hidden" name="idProofBackOld" id="idProofBackOld" value="<?=(!empty($userDocDtl) && $userDocDtl->idProofFront) ? $userDocDtl->idProofBack : ''?>">
                                        </div>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photo of Pan Card @if(!empty($userDocDtl) && $userDocDtl->panCardFront) <a href="{{asset('public')}}/{{$userDocDtl->panCardFront}}" target="_blank">(Click Here To View) </a>@endif</label>
                                        <div class="file_upload">
                                            <input type="file" name="panCardFront" id="panCardFront" data-default-file="{{ (!empty($userDocDtl) && $userDocDtl->panCardFront) ? asset('public').'/'.$userDocDtl->panCardFront : '' }}" class="dropify">
                                            <input type="hidden" name="panCardFrontOld"  id="panCardFrontOld" value="<?=(!empty($userDocDtl) && $userDocDtl->panCardFront) ? $userDocDtl->panCardFront : ''?>">
                                                <div class="progwt_button">
                                                <div class="progress_innercard">
                                                    <div class="verify_docbutton">
                                                        <button id="verify_orignal_pancard" type="button">Verify</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @if(session()->get('error_pan'))
                                            <span class="text-danger">{{ session()->get('error_aadhr') }}</span>
                                        @endif
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>PDF of Bank Statement @if(!empty($userDocDtl) && $userDocDtl->bankAttachemet) <a
                                                href="{{asset('public')}}/{{$userDocDtl->bankAttachemet}}"
                                                target="_blank">(Click Here To View) </a>@endif</label>
                                        <div class="file_upload">
                                            <input type="file" name="bankAttachemet" id="bankAttachemet"
                                                class="dropify" data-default-file="{{  (!empty($userDocDtl) && $userDocDtl->bankAttachemet) ? asset('public').'/'.$userDocDtl->bankAttachemet : '' }} ">
                                            <input type="hidden" name="bankAttachemetOld" id="bankAttachemetOld"
                                                value="<?=(!empty($userDocDtl) && $userDocDtl->bankAttachemet) ? $userDocDtl->bankAttachemet : ''?>">
                                                <input type="password" class="form-control" name="bankPwd" value="<?=(!empty($userDocDtl) && $userDocDtl->bankAttachemetPwd) ? $userDocDtl->bankAttachemetPwd : ''?>" placeholder="Enter password if statement is password protected.">
                                        </div>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photo of Aadhar Card Front @if(!empty($userDocDtl) && $userDocDtl->addressProofFront) <a
                                                href="{{asset('public')}}/{{$userDocDtl->addressProofFront}}"
                                                target="_blank">(Click Here To View) </a>@endif</label>
                                        <div class="file_upload">
                                            <input type="file" name="addressProofFront" id="addressProofFront"
                                                class="dropify" data-default-file="{{ (!empty($userDocDtl) && $userDocDtl->addressProofFront) ? asset('public').'/'.$userDocDtl->addressProofFront : '' }}">
                                            <input type="hidden" name="addressProofFrontOld" id="addressProofFrontOld"
                                                value="<?=(!empty($userDocDtl) && $userDocDtl->addressProofFront) ? $userDocDtl->addressProofFront : ''?>">
                                        </div>
                                        @if(session()->get('error_aadhr'))
                                            <span class="text-danger">{{ session()->get('error_aadhr') }}</span>
                                        @endif
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photo of Aadhar Card Back @if(!empty($userDocDtl) && $userDocDtl->addressProofBack) <a
                                                href="{{asset('public')}}/{{$userDocDtl->addressProofBack}}"
                                                target="_blank">(Click Here To View) </a>@endif</label>
                                        <div class="file_upload">
                                            <input type="file" name="addressProofBack" id="addressProofBack"
                                                class="dropify" data-default-file="{{ (!empty($userDocDtl) && $userDocDtl->addressProofBack) ? asset('public').'/'.$userDocDtl->addressProofBack : '' }}">
                                            <input type="hidden" name="addressProofBackOld" id="addressProofBackOld"
                                                value="<?=(!empty($userDocDtl) && $userDocDtl->addressProofBack) ? $userDocDtl->addressProofBack : ''?>">
                                        </div>
                                        @if(session()->get('error_aadhr'))
                                            <span class="text-danger">{{ session()->get('error_aadhr') }}</span>
                                        @endif
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-lg-12">
                                    <div class="progwt_button" id="margin_btcus">
                                        <div class="progress_innercard">
                                            <div class="verify_docbutton">
                                                <button id="verify_orignal_aadharcard" type="button">Verify</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                                
                                

                                <div class="col-md-6 businessKycOther" >
                                    <div class="form-group">
                                        <label>Photo of Pan Card Partner 1 (optional)@if(!empty($otherKycDocs) && !empty($otherKycDocs[0]) && $otherKycDocs[0]->pancard_img) <a
                                                href="{{asset('public')}}/{{$otherKycDocs[0]->pancard_img}}"
                                                target="_blank">(Click Here To View) </a>@endif</label>
                                        <div class="file_upload">
                                        
                                            <input type="file" name="kyc1_pancard_img" id="kyc1_pancard_img"
                                                class="dropify" data-default-file="{{  (!empty($otherKycDocs) && !empty($otherKycDocs[0]) && $otherKycDocs[0]->pancard_img) ? asset('public').'/'.$otherKycDocs[0]->pancard_img : '' }} ">
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail11">Email</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail11" name="kyc1_email" value="{{(isset($otherKycDocs[0]) && $otherKycDocs[0]->email) ? $otherKycDocs[0]->email : ''}}"  placeholder="Enter email">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputMobile1">Mobile Number</label>
                                                        <input type="text" class="form-control" id="exampleInputMobile1" value="{{(isset($otherKycDocs[0]) && $otherKycDocs[0]->mobile) ? $otherKycDocs[0]->mobile : ''}}" name="kyc1_mobile"  placeholder="Enter mobile number">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputGender1">Gender</label>
                                                        <select class="contact-one__form-input" id="exampleInputGender1" name="kyc1_gender">
                                                            <option {{(isset($otherKycDocs[0]) && $otherKycDocs[0]->gender == 'Male') ? 'selected' : 'selected'}}  value="Male">Male</option>
                                                            <option {{(isset($otherKycDocs[0]) && $otherKycDocs[0]->gender == 'Female') ? 'selected' : ''}}  value="Female">Female</option>
                                                            <option {{(isset($otherKycDocs[0]) && $otherKycDocs[0]->gender == 'Other') ? 'selected' : ''}}  value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputAddress1">Address</label>
                                                        <input type="text" class="form-control" id="exampleInputAddress1" value="{{(isset($otherKycDocs[0]) && $otherKycDocs[0]->addressLine1) ? $otherKycDocs[0]->addressLine1 : ''}}" name="kyc1_address"  placeholder="Enter address">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputCity1">City</label>
                                                        <input type="text" class="form-control" id="exampleInputCity1" value="{{(isset($otherKycDocs[0]) && $otherKycDocs[0]->city) ? $otherKycDocs[0]->city : ''}}" name="kyc1_city"  placeholder="Enter city">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputState1">State</label>
                                                        <select class="contact-one__form-input" id="exampleInputState1" name="kyc1_state">
                                                            @foreach ($indiaStates as $srt=>$name)
                                                                <option {{(isset($otherKycDocs[0]) && $otherKycDocs[0]->state_short == $srt) ? 'selected' : ''}} value="{{$srt}}">{{$name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputPincode1">Pincode</label>
                                                        <input type="text" class="form-control" id="exampleInputPincode1" value="{{(isset($otherKycDocs[0]) && $otherKycDocs[0]->pincode) ? $otherKycDocs[0]->pincode : ''}}" name="kyc1_pincode"  placeholder="Enter pincode">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="progwt_button mt-2" id="margin_btcus">
                                                        <div class="progress_innercard">
                                                            <div class="verify_docbutton">
                                                                <button id="pancard_partner1" type="button">Verify</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.form-group-->
                                </div>

                                <div class="col-md-6 businessKycOther" >
                                    <div class="form-group">
                                        <label>Photo of Pan Card Partner 2 (optional) @if(!empty($otherKycDocs) && !empty($otherKycDocs[1]) && $otherKycDocs[1]->pancard_img) <a
                                                href="{{asset('public')}}/{{$otherKycDocs[1]->pancard_img}}"
                                                target="_blank">(Click Here To View) </a>@endif</label>
                                        <div class="file_upload">
                                            <input type="file" name="kyc2_pancard_img" id="kyc2_pancard_img"
                                                class="dropify" data-default-file="{{  (!empty($otherKycDocs) && !empty($otherKycDocs[1]) && $otherKycDocs[1]->pancard_img) ? asset('public').'/'.$otherKycDocs[1]->pancard_img : '' }} ">
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="pexampleInputEmail1">Email</label>
                                                            <input type="email" class="form-control" id="pexampleInputEmail1" value="{{(isset($otherKycDocs[1]) && $otherKycDocs[1]->email) ? $otherKycDocs[1]->email : ''}}" name="kyc2_email"  placeholder="Enter email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="pexampleInputMobile">Mobile Number</label>
                                                            <input type="text" class="form-control" id="pexampleInputMobile" value="{{(isset($otherKycDocs[1]) && $otherKycDocs[1]->mobile) ? $otherKycDocs[1]->mobile : ''}}" name="kyc2_mobile"  placeholder="Enter mobile number">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="pexampleInputGender1">Gender</label>
                                                            <select class="contact-one__form-input" id="pexampleInputGender1" name="kyc2_gender">
                                                                <option {{(isset($otherKycDocs[1]) && $otherKycDocs[1]->gender == 'Male') ? 'selected' : 'selected'}}  value="Male">Male</option>
                                                                <option {{(isset($otherKycDocs[1]) && $otherKycDocs[1]->gender == 'Female') ? 'selected' : ''}}  value="Female">Female</option>
                                                                <option {{(isset($otherKycDocs[1]) && $otherKycDocs[1]->gender == 'Other') ? 'selected' : ''}}  value="Other">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="pexampleInputAddress">Address</label>
                                                            <input type="text" class="form-control" id="pexampleInputAddress" value="{{(isset($otherKycDocs[1]) && $otherKycDocs[1]->addressLine1) ? $otherKycDocs[1]->addressLine1 : ''}}" name="kyc2_address"  placeholder="Enter address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="pexampleInputCity">City</label>
                                                            <input type="text" class="form-control" id="pexampleInputCity" value="{{(isset($otherKycDocs[1]) && $otherKycDocs[1]->city) ? $otherKycDocs[1]->city : ''}}" name="kyc2_city"  placeholder="Enter city">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="pexampleInputState">State</label>
                                                            <select class="contact-one__form-input" id="pexampleInputState" name="kyc2_state">
                                                                @foreach ($indiaStates as $srt=>$name)
                                                                    <option {{(isset($otherKycDocs[1]) && $otherKycDocs[1]->state_short == $srt) ? 'selected' : ''}} value="{{$srt}}">{{$name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="pexampleInputPincode">Pincode</label>
                                                            <input type="text" class="form-control" id="pexampleInputPincode" value="{{(isset($otherKycDocs[1]) && $otherKycDocs[1]->pincode) ? $otherKycDocs[1]->pincode : ''}}" name="kyc2_pincode"  placeholder="Enter pincode">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 mt-2">
                                                        <div class="progwt_button" id="margin_btcus">
                                                            <div class="progress_innercard">
                                                                <div class="verify_docbutton">
                                                                    <button id="pancard_partner2"  type="button">Verify</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div><!-- /.form-group-->
                                </div>
                            </div>

                            <div class="row backprevbtns card-footer">
                                <div class="col-auto">
                                    <button id="backBtn2" type="button" onclick="nextStepFn(2,1,'prev');"
                                        class="btn btn-danger btn-sm btn__prevv">Back</button>
                                </div>
                                @if($userDocDtl && $userDocDtl->panCardFront && $userDocDtl->addressProofFront && $userDocDtl->addressProofBack)
                                <div class="col-auto">
                                    <button id="nextBtn2" type="button" onclick="nextStepFn(2,3,'next');"
                                        class="btn btn-primary btn-sm btn__nextt">Next</button>
                                </div>
                                @else
                                <div class="col-auto">
                                    <button  type="button" id="nextBtn222" onclick="showKycPopUp();"
                                        class="btn btn-primary btn-sm btn__nextt">Next</button>
                                </div>
                                @endif
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- personal info end -->
                    <div class="card-body p-5 step stepFrm3 information__" style="display: none">
                        <form method="POST" id="ApplyLoanStep3" action="{{ route('applyloan.step3') }}" enctype="multipart/form-data"> @csrf
                        <div class="first_stepcd">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3>Personal Information</h3>
                                </div>
                            </div>
                        </div>
                        <div class="field_start">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Customer ID </label>
                                        <input type="text" readonly value="{{auth()->user()->customerCode}}"
                                            name="customerCode" id="customerCode"
                                            class="form-control contact-one__form-input" placeholder="Enter ID"
                                            required="">
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <select id="nameTitleCu" name="nameTitleCu" class="contact-one__form-input "
                                            required="">
                                            <option value="">Select</option>
                                            <option value="Mr." <?php if(old('nameTitleCu') == 'Mr.'){ echo 'selected'; }elseif(!empty($userloggedData)){ if($userloggedData->nameTitle=='Mr.'){echo 'selected';} } ?> >Mr. </option>
                                            <option value="Ms." <?php if(old('nameTitleCu') == 'Ms.'){ echo 'selected'; }elseif(!empty($userloggedData)){ if($userloggedData->nameTitle=='Ms.'){echo 'selected';} } ?> >Ms. </option>
                                            <option value="Mrs." <?php if(old('nameTitleCu') == 'Mrs.'){ echo 'selected'; }elseif(!empty($userloggedData)){ if($userloggedData->nameTitle=='Mrs.'){echo 'selected';} } ?> >Mrs. </option>
                                            <option value="Smt." <?php if(old('nameTitleCu') == 'Smt.'){ echo 'selected'; }elseif(!empty($userloggedData)){ if($userloggedData->nameTitle=='Smt.'){echo 'selected';} } ?> >Smt. </option>
                                        </select>
                                        <span id="nameTitleCu_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Customer Name </label>
                                        <input type="text" name="customerName" id="customerName"
                                            value="<?= old('customerName') ?? ((!empty($userloggedData)) ? $userloggedData->name :  '') ?>"
                                            class="form-control contact-one__form-input" placeholder="Enter Name"
                                            required onkeypress="javascript:return isAlphabet(event)">
                                        <span id="customerName_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Customer Email </label>
                                        <input type="email" @if(!empty($userloggedData) && $userloggedData->email) disabled @endif name="customerEmail" id="customerEmail" 
                                            value="<?=(old('customerEmail') ?? (!empty($userloggedData)) ? $userloggedData->email : '') ?>"
                                            class="form-control contact-one__form-input" placeholder="Enter Email"
                                            required>
                                        <span class="validity"></span>
                                        <span id="customerEmail_error" class="error_text text-danger"></span>
                                        @error('customerEmail')
                                            <span id="customerEmail_error" class="error_text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Customer Phone </label>
                                        <input type="text" onkeypress="javascript:return isNumber(event)" @if(!empty($userloggedData) && $userloggedData->mobile) disabled @endif name="customerPhone" id="customerPhone"
                                            value="<?= old('customerPhone') ?? ((!empty($userloggedData)) ? $userloggedData->mobile : '') ?>"
                                            class="form-control contact-one__form-input" placeholder="Enter Phone No."
                                            required="">
                                        <span id="customerPhone_error" class="error_text text-danger"></span>
                                        @error('customerPhone')
                                            <span id="customerEmail_error" class="error_text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Marital Status*</label>
                                        <select name="maritalStatus" id="maritalStatus" class="contact-one__form-input "
                                            required="">
                                            <option value="">Select</option>
                                            <option value="Married" <?php if(old('maritalStatus')=="Married"){ echo 'selected'; }elseif(!empty($userloggedData)){if($userloggedData->maritalStatus=='Married'){echo 'selected';} } ?>>Married </option>
                                            <option value="Unmarried" <?php if(old('maritalStatus')=="Unmarried"){ echo 'selected'; }elseif(!empty($userloggedData)){if($userloggedData->maritalStatus=='Unmarried'){echo 'selected';} } ?>>Unmarried </option>
                                        </select>
                                        <span id="maritalStatus_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class="contact-one__form-input " required="">
                                            <option value="">Select</option>
                                            <option value="Male" <?php if(old('gender')=='Male'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->gender=='Male'){echo 'selected';} } ?> >Male</option>
                                            <option value="Female" <?php if(old('gender')=='Female'){ echo "selected"; }elseif(!empty($userloggedData)){if($userloggedData->gender=='Female'){echo 'selected';} } ?> >Female </option>
                                        </select>
                                        <span id="gender_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="date" name="dateOfBirth" id="dateOfBirth"
                                            value="<?= old('dateOfBirth') ?? ((!empty($userloggedData)) ? $userloggedData->dateOfBirth : '') ?>"
                                            class="form-control contact-one__form-input" placeholder="Year" required="" min="{{ date('Y-m-d',strtotime('-58 year')) }}" max="{{ date('Y-m-d',strtotime('-21 year')) }}">
                                        <span id="dateOfBirth_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" id="address"
                                            value="<?= old('address') ?? ((!empty($userloggedData)) ? $userloggedData->addressLine1 : '') ?>"
                                            class="form-control contact-one__form-input" placeholder="Enter Address"
                                            required="">
                                        <span id="address_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address 2 (Optional)</label>
                                        <input type="text" name="address2" id="address2"
                                            value="<?= old('address2') ?? ((!empty($userloggedData)) ? $userloggedData->addressLine2 : '') ?>"
                                            class="form-control contact-one__form-input"
                                            placeholder="Enter Address 2 (Optional)">
                                        <span id="address2_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>District</label>
                                        <input type="text" name="district" id="district"
                                            value="<?= old('district') ?? ((!empty($userloggedData)) ? $userloggedData->district : '') ?>"
                                            class="form-control contact-one__form-input" placeholder="Enter district"
                                            required onkeypress="javascript:return isAlphabet(event)">
                                        <span id="district_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="city" id="city"
                                            value="<?= old('city') ?? ((!empty($userloggedData)) ? $userloggedData->city : '') ?>"
                                            class="form-control contact-one__form-input" placeholder="Enter City"
                                            required onkeypress="javascript:return isAlphabet(event)">
                                        <span id="city_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control form-select contact-one__form-input" name="state" id="state">
                                            <option value="">Select State</option>
                                            @if($indianStates)
                                                @foreach ($indianStates as $kk=>$statein)
                                                    <option <?php if(old('state')==$kk.'_'.$statein){ echo "selected"; }elseif(!empty($userloggedData) && strtolower($userloggedData->state)==strtolower($statein)){ echo 'selected'; } ?> value="{{$kk}}_{{$statein}}">{{$statein}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="state_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input type="number"  onkeypress="javascript:return isNumber(event)" name="pincode"
                                            id="pincode" 
                                            value="<?= old('pincode') ?? ((!empty($userloggedData)) ? $userloggedData->pincode : '') ?>"
                                            class="form-control contact-one__form-input" placeholder="Enter Pincode"
                                            required>
                                        <span id="pincode_error" class="error_text text-danger"></span>
                                    </div>
                                    
                                    <!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Aadhaar Number</label>
                                        <input type="text" disabled onkeypress="javascript:return isNumber(event)"
                                            name="aadhaar_no" id="aadhaar_no"
                                            value="<?= old('aadhaar_no') ?? ((!empty($userloggedData)) ? $userloggedData->aadhaar_no : '') ?>"
                                            class="form-control contact-one__form-input" placeholder="Aadhaar Number"
                                            required="">
                                        <span id="aadhaar_no_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pan Number</label>
                                        <input type="text" disabled name="pancard_no" id="pancard_no"
                                            class="form-control contact-one__form-input"
                                            value="<?= old('pancard_no') ?? ((!empty($userloggedData)) ? $userloggedData->pancard_no : '') ?>"
                                            placeholder="Enter Pan Number" required="">
                                        <span id="pancard_no_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <!-- /.form-group-->
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <select name="religionCu" id="religionCu" class="contact-one__form-input "
                                            required="">
                                            <option value="">Select</option>
                                            <option value="Hindu" <?php if(old('religionCu')=='Hindu'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->religion=='Hindu'){echo 'selected';} } ?> >Hindu</option>
                                            <option value="Muslim" <?php if(old('religionCu')=='Muslim'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->religion=='Muslim'){echo 'selected';} } ?> >Muslim</option>
                                            <option value="Christian" <?php if(old('religionCu')=='Christian'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->religion=='Christian'){echo 'selected';} } ?> >Christian</option>
                                            <option value="Sikh" <?php if(old('religionCu')=='Sikh'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->religion=='Sikh'){echo 'selected';} } ?> >Sikh</option>
                                            <option value="Jain" <?php if(old('religionCu')=='Jain'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->religion=='Jain'){echo 'selected';} } ?> >Jain</option>
                                            <option value="Parsi" <?php if(old('religionCu')=='Parsi'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->religion=='Parsi'){echo 'selected';} } ?> >Parsi</option>
                                            <option value="Buddhist" <?php if(old('religionCu')=='Buddhist'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->religion=='Buddhist'){echo 'selected';} } ?> >Buddhist</option>
                                            <option value="Jewish" <?php if(old('religionCu')=='Jewish'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->religion=='Jewish'){echo 'selected';} } ?> >Jewish</option>
                                            <option value="Other" <?php if(old('religionCu')=='Other'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->religion=='Other'){echo 'selected';} } ?> >Other</option>

                                        </select>
                                        <span id="religionCu_error" class="error_text text-danger"></span>
                                       
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Education Status</label>
                                        <select name="educationStatusCu" id="educationStatusCu" class="contact-one__form-input "
                                            required="">
                                            <option value="">Select</option>
                                            <option value="High School" <?php if(old('educationStatusCu')=='High School'){ echo "selected";}elseif(!empty($userloggedData)){ if($userloggedData->educationStatus=='High School'){echo 'selected';} }?>>High School and below</option>
                                            <option value="Intermediate" <?php if(old('educationStatusCu')=='Intermediate'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->educationStatus=='Intermediate'){echo 'selected';} } ?>>Intermediate</option>
                                            <option value="Bachelor" <?php if(old('educationStatusCu')=='Bachelor'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->educationStatus=='Bachelor'){echo 'selected';} } ?>>Bachelor / Undergraduate</option>
                                            <option value="Diploma" <?php if(old('educationStatusCu')=='Diploma'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->educationStatus=='Diploma'){echo 'selected';} } ?>>Diploma</option>
                                            <option value="Master" <?php if(old('educationStatusCu')=='Master'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->educationStatus=='Master'){echo 'selected';} } ?>>Master</option>
                                            <option value="Doctorate" <?php if(old('educationStatusCu')=='Doctorate'){ echo "selected"; }elseif(!empty($userloggedData)){ if($userloggedData->educationStatus=='Doctorate'){echo 'selected';} } ?>>Doctorate</option>

                                        </select>
                                        <span id="educationStatusCu_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input type="text" id="fatherNameCu" name="fatherNameCu"
                                            class="form-control contact-one__form-input"
                                            value="<?= old('fatherNameCu') ?? ((!empty($userloggedData)) ? $userloggedData->fatherName : '') ?>"
                                            placeholder="Father Name" required onkeypress="javascript:return isAlphabet(event)">
                                        <span id="fatherNameCu_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mother Name</label>
                                        <input type="text" id="motherNameCu" name="motherNameCu"
                                            class="form-control contact-one__form-input"
                                            value="<?= old('motherNameCu') ?? ((!empty($userloggedData)) ? $userloggedData->motherName : '') ?>"
                                            placeholder="Mother Name" required onkeypress="javascript:return isAlphabet(event)">
                                        <span id="motherNameCu_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Source Person Name</label>
                                        <input type="text" id="sourcePerson" name="sourcePerson"
                                            class="form-control contact-one__form-input"
                                            value="<?= old('sourcePerson') ?? ((!empty($userloggedData)) ? $userloggedData->sourcePerson : '') ?>"
                                            placeholder="Source Person Name" required onkeypress="javascript:return isAlphabet(event)"  >
                                        <span id="sourcePerson_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Upload Profile Photo </label>
                                      <div class="file_upload">
                                        <div class="preview-zone hidden">
                                          <div class="box box-solid">
                                            <div class="box-header with-border">
                                              <div><b>Preview</b></div>
                                              <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-danger btn-xs remove-preview">
                                                  <i class="fa fa-times"></i> Reset This Form
                                                </button>
                                              </div>
                                            </div>
                                            <div class="box-body"></div>
                                          </div>
                                        </div>
                                        <div class="dropzone-wrapper">
                                          <div class="dropzone-desc">
                                            <i class="glyphicon glyphicon-download-alt"></i>
                                            <p>Choose an image file or drag it here.</p>
                                          </div>
                                          <input type="file"  name="profileImg" id="profileImg" class="dropify" data-default-file="{{  (!empty($userloggedData) && $userloggedData->profilePic) ? asset('public').'/'.$userloggedData->profilePic : '' }} ">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        <div class="row backprevbtns card-footer">
                            <div class="col-auto">
                                <button id="backBtn2" type="button" onclick="nextStepFn(3,2,'prev');"
                                    class="btn btn-danger btn-sm btn__prevv">Back</button>
                            </div>
                            <div class="col-auto">
                                <button id="nextBtn2" type="button" onclick="nextStepFn(3,4,'next');"
                                    class="btn btn-primary btn-sm btn__nextt">Next</button>
                            </div>
                        </div>
                        </form>
                        
                    </div>
                    <div id="userinfo" class="card-body p-4 step first_stepcd stepFrm4 select_loan information__" style="display: none">
                        <form method="POST" id="ApplyLoanStep4" action="{{ route('applyloan.step4') }}" enctype="multipart/form-data">@csrf
                        
                        <div class="first_stepcd">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3>Co Applicant / Guarantor Details</h3>
                                </div>
                            </div>
                        </div>
                        <div class="field_start">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <select id="nameTitleCoApp" name="nameTitleCoApp"
                                            class="contact-one__form-input " required="">
                                            <option value="">Select</option>
                                            <option value="Mr." <?php if(old('nameTitleCoApp') && old('nameTitleCoApp') == "Mr."){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->nameTitleCoApp=='Mr.'){echo 'selected';} } ?>>Mr. </option>
                                            <option value="Ms." <?php if(old('nameTitleCoApp') && old('nameTitleCoApp') == "Ms."){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->nameTitleCoApp=='Ms.'){echo 'selected';} } ?>>Ms. </option>
                                            <option value="Mrs." <?php if(old('nameTitleCoApp') && old('nameTitleCoApp') == "Mrs."){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->nameTitleCoApp=='Mrs.'){echo 'selected';} } ?>>Mrs. </option>
                                            <option value="Smt." <?php if(old('nameTitleCoApp') && old('nameTitleCoApp') == "Smt."){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->nameTitleCoApp=='Smt.'){echo 'selected';} } ?>>Smt. </option>
                                        </select>
                                        <span id="nameTitleCoApp_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name </label>
                                        <input type="text" id="customerNameCoApp" name="customerNameCoApp"
                                            value="<?= old('customerNameCoApp') ?? ((!empty($coApplicantDtl)) ? $coApplicantDtl->customerNameCoApp : '')?>"
                                            class="form-control contact-one__form-input" placeholder="Enter Name"
                                            required onkeypress="javascript:return isAlphabet(event)">
                                        <span id="customerNameCoApp_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select id="genderCoApp" name="genderCoApp" class="contact-one__form-input "
                                            required="">
                                            <option value="">Select</option>
                                            <option value="Male" <?php if(old('genderCoApp') && old('genderCoApp') == "Male"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->genderCoApp=='Male'){echo 'selected';} } ?>>Male</option>
                                            <option value="Female" <?php if(old('genderCoApp') && old('genderCoApp') == "Female"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->genderCoApp=='Female'){echo 'selected';} } ?>>Female</option>
                                        </select>
                                        <span id="genderCoApp_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="date" id="dateOfBirthECoApp" name="dateOfBirthCoApp"
                                            value="<?= old('dateOfBirthCoApp') ?? ((!empty($coApplicantDtl)) ? $coApplicantDtl->dateOfBirthCoApp : '') ?>"
                                            class="form-control contact-one__form-input" placeholder="Choose DOB"
                                            required="" min="{{ date('Y-m-d',strtotime('-58 year')) }}" max="{{ date('Y-m-d',strtotime('-21 year')) }}">
                                        <span id="dateOfBirthECoApp_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                
                                <div class="col-md-6">
                                    
                                    <!-- /.form-group-->
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <select id="religionCoApp" name="religionCoApp" class="contact-one__form-input "
                                            required="" value="<?=(!empty($coApplicantDtl)) ? $coApplicantDtl->religionCoApp : ''?>">
                                            <option value="">Select</option>
                                            <option  <?php if(old('religionCoApp') && old('religionCoApp') == "Hindu"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->religionCoApp=='Hindu'){echo 'selected';} } ?> value="Hindu">Hindu</option>
                                            <option  <?php if(old('religionCoApp') && old('religionCoApp') == "Muslim"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->religionCoApp=='Muslim'){echo 'selected';} } ?> value="Muslim">Muslim</option>
                                            <option  <?php if(old('religionCoApp') && old('religionCoApp') == "Christian"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->religionCoApp=='Christian'){echo 'selected';} } ?> value="Christian">Christian</option>
                                            <option  <?php if(old('religionCoApp') && old('religionCoApp') == "Sikh"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->religionCoApp=='Sikh'){echo 'selected';} } ?> value="Sikh">Sikh</option>
                                            <option  <?php if(old('religionCoApp') && old('religionCoApp') == "Jain"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->religionCoApp=='Jain'){echo 'selected';} } ?> value="Jain">Jain</option>
                                            <option  <?php if(old('religionCoApp') && old('religionCoApp') == "Parsi"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->religionCoApp=='Parsi'){echo 'selected';} } ?> value="Parsi">Parsi</option>
                                            <option  <?php if(old('religionCoApp') && old('religionCoApp') == "Buddhist"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->religionCoApp=='Buddhist'){echo 'selected';} } ?> value="Buddhist">Buddhist</option>
                                            <option  <?php if(old('religionCoApp') && old('religionCoApp') == "Jewish"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->religionCoApp=='Jewish'){echo 'selected';} } ?> value="Jewish">Jewish</option>
                                            <option  <?php if(old('religionCoApp') && old('religionCoApp') == "Other"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->religionCoApp=='Other'){echo 'selected';} } ?> value="Other">Other</option>
                                        </select>
                                        <span id="religionCoApp_error" class="error_text text-danger"></span>
                                       
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Education Status</label>
                                        <select id="educationStatusCoApp" name="educationStatusCoApp"
                                            value="<?=(!empty($coApplicantDtl)) ? $coApplicantDtl->educationStatusCoApp : ''?>" class="contact-one__form-input "
                                            required="">
                                            <option value="">Select</option>
                                            <option <?php if(old('educationStatusCoApp') && old('educationStatusCoApp') == "High School"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->educationStatusCoApp=='High School'){echo 'selected';} } ?>  value="High School">High School and below</option>
                                            <option <?php if(old('educationStatusCoApp') && old('educationStatusCoApp') == "Intermediate"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->educationStatusCoApp=='Intermediate'){echo 'selected';} } ?>  value="Intermediate">Intermediate</option>
                                            <option <?php if(old('educationStatusCoApp') && old('educationStatusCoApp') == "Bachelor"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->educationStatusCoApp=='Bachelor'){echo 'selected';} } ?>  value="Bachelor">Bachelor / Undergraduate</option>
                                            <option <?php if(old('educationStatusCoApp') && old('educationStatusCoApp') == "Diploma"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->educationStatusCoApp=='Diploma'){echo 'selected';} } ?>  value="Diploma">Diploma</option>
                                            <option <?php if(old('educationStatusCoApp') && old('educationStatusCoApp') == "Master"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->educationStatusCoApp=='Master'){echo 'selected';} } ?>  value="Master">Master</option>
                                            <option <?php if(old('educationStatusCoApp') && old('educationStatusCoApp') == "Doctorate"){ echo "selected"; }elseif(!empty($coApplicantDtl)){ if($coApplicantDtl->educationStatusCoApp=='Doctorate'){echo 'selected';} } ?>  value="Doctorate">Doctorate</option>

                                        </select>
                                        <span id="educationStatusCoApp_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input type="text" id="fatherNameCoApp" name="fatherNameCoApp"
                                            value="<?= old('fatherNameCoApp') ?? ((!empty($coApplicantDtl)) ? $coApplicantDtl->fatherNameCoApp : '')?>"
                                            class="form-control contact-one__form-input" placeholder="Father Name"
                                            required onkeypress="javascript:return isAlphabet(event)">
                                        <span id="fatherNameCoApp_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mother Name</label>
                                        <input type="text" id="motherNameCoApp" name="motherNameCoApp"
                                            value="<?= old('motherNameCoApp') ?? ((!empty($coApplicantDtl)) ? $coApplicantDtl->motherNameCoApp : '')?>"
                                            class="form-control contact-one__form-input" placeholder="Mother Name"
                                            required onkeypress="javascript:return isAlphabet(event)">
                                        <span id="motherNameCoApp_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Marital Status*</label>
                                        <select id="maritalStatusCoApp" name="maritalStatusCoApp"
                                            class="contact-one__form-input " required="">
                                            <option value="">Select</option>
                                            <option value="Married" <?php if(old('maritalStatusCoApp') && old('maritalStatusCoApp') == "Married"){ echo "selected"; }elseif(!empty($coApplicantDtl)){if($coApplicantDtl->maritalStatusCoApp=='Married'){echo 'selected';} }?> >Married </option>
                                            <option value="Unmarried" <?php if(old('maritalStatusCoApp') && old('maritalStatusCoApp') == "Unmarried"){ echo "selected"; }elseif(!empty($coApplicantDtl)){if($coApplicantDtl->maritalStatusCoApp=='Unmarried'){echo 'selected';} }?>>Unmarried </option>
                                        </select>
                                        <span id="maritalStatusCoApp_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Relation with Applicant</label>
                                        <input type="text" id="relationWithApplicantCoApp"
                                            name="relationWithApplicantCoApp"
                                            value="<?= old('relationWithApplicantCoApp') ?? ((!empty($coApplicantDtl)) ? $coApplicantDtl->relationWithApplicantCoApp : '')?>"
                                            class="form-control contact-one__form-input"
                                            placeholder="Relation with Applicant" required onkeypress="javascript:return isAlphabet(event)">
                                        <span id="relationWithApplicantCoApp_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                            </div>
                            <div class="row backprevbtns card-footer">
                                <div class="col-auto">
                                    <button id="backBtn2" type="button"  onclick="nextStepFn(4,3,'prev');" class="btn btn-sm btn-danger btn__prevv" >Back</button>
                                </div>
                                <div class="col-auto">
                                    <button id="nextBtn2" type="button"  onclick="nextStepFn(4,5,'next');" class="btn btn-primary btn-sm btn__nextt" >Next</button>
                                </div>
                            </div>
                        </div>
                        
                        </form>
                    </div>
                    <div class="card-body card-footer p-5 step stepFrm5 information__" style="display: none">
                        <form method="POST" id="ApplyLoanStep6" action="{{ route('applyloan.step6') }}" enctype="multipart/form-data">@csrf
                        <div id="getBusinessOrEmploymentFormHtml"></div>
                        <div class="row backprevbtns">
                            <div class="col-auto">
                                <button id="backBtn2" type="button" onclick="nextStepFn(5,4,'prev');"
                                    class="btn btn-danger btn-sm btn__prevv">Back</button>
                            </div>
                            <div class="col-auto">
                                <button id="nextBtn2" type="button" onclick="nextStepFn(5,6,'next');"
                                    class="btn btn-primary btn-sm btn__nextt">Next</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                    <!-- Bank info -->
                    <div class="card-body p-5 step stepFrm6 information__" style="display: none">
                        <form method="POST" id="ApplyLoanStep5" action="{{ route('applyloan.step5') }}" enctype="multipart/form-data"> @csrf
                        <div class="first_stepcd">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3>Bank details</h3>
                                </div>
                            </div>
                        </div>
                        <div class="field_start">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Account Holder Name</label>
                                        <input type="text" id="accountHolderName" name="accountHolderName"
                                            value="<?=(!empty($userBankDtl)) ? $userBankDtl->accountHolderName : ''?>"
                                            class="form-control contact-one__form-input" placeholder="Enter Name"
                                            required onkeypress="javascript:return isAlphabet(event)">
                                        <span id="accountHolderName_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" id="bankName" name="bankName"
                                            value="<?=(!empty($userBankDtl)) ? $userBankDtl->bankName : ''?>"
                                            class="form-control contact-one__form-input" placeholder="Enter Name"
                                            required onkeypress="javascript:return isAlphabet(event)">
                                        <span id="bankName_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>IFSC</label>
                                        <input type="text" id="ifscCode" name="ifscCode"
                                            value="<?=(!empty($userBankDtl)) ? $userBankDtl->ifscCode : ''?>"
                                            class="form-control contact-one__form-input" placeholder="Enter IFSC"
                                            required="">
                                            <span id="ifscCode_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Account Type</label>
                                        <select id="accountType" name="accountType" class="contact-one__form-input "
                                            required="">
                                            <option value="">Select </option>
                                            <option value="Savings" <?php if(!empty($userBankDtl)){ if($userBankDtl->
                                                accountType=='Savings'){ echo 'selected'; } } ?> >Savings </option>
                                            <option value="Current" <?php if(!empty($userBankDtl)){ if($userBankDtl->
                                                accountType=='Current'){ echo 'selected'; } } ?> >Current </option>
                                            <option value="CC" <?php if(!empty($userBankDtl)){ if($userBankDtl->
                                                accountType=='CC'){ echo 'selected'; } } ?> >CC </option>
                                            <option value="OD" <?php if(!empty($userBankDtl)){ if($userBankDtl->
                                                accountType=='OD'){ echo 'selected'; } } ?> >OD </option>
                                        </select>
                                        <span id="accountType_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input type="text" id="accountNumber"
                                            onkeypress="javascript:return isNumber(event)" name="accountNumber"
                                            value="<?=(!empty($userBankDtl)) ? $userBankDtl->accountNumber : ''?>"
                                            class="form-control contact-one__form-input" placeholder="Account Number" required="">
                                            <span id="accountNumber_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Account Number</label>
                                        <input type="text" id="accountNumberC"
                                            onkeypress="javascript:return isNumber(event)" name="accountNumberC"
                                            value="<?=(!empty($userBankDtl)) ? $userBankDtl->accountNumber : ''?>"
                                            class="form-control contact-one__form-input" placeholder="Confirm Account Number" required="">
                                            <span id="accountNumberC_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" id="bankAddress" name="bankAddress"
                                            value="<?=(!empty($userBankDtl)) ? $userBankDtl->address : ''?>"
                                            class="form-control contact-one__form-input" placeholder="Enter Address"
                                            required="">
                                            <span id="bankAddress_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" id="bankCity" name="bankCity"
                                            value="<?=(!empty($userBankDtl)) ? $userBankDtl->city : ''?>"
                                            class="form-control contact-one__form-input" placeholder="Enter City"
                                            required onkeypress="javascript:return isAlphabet(event)">
                                            <span id="bankCity_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control form-select contact-one__form-input" name="bankState" id="bankState">
                                            <option value="">Select State</option>
                                            @if($indianStates)
                                                @foreach ($indianStates as $statein)
                                                    <option <?php if(old('bankState')==$statein){ echo "selected"; }elseif(!empty($userBankDtl)){ if(strtolower($userBankDtl->state)==strtolower($statein)){echo 'selected';} } ?> value="{{$statein}}">{{$statein}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="bankState_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input type="number" min="6" max="6" id="bankPincode"
                                            onkeypress="javascript:return isNumber(event)" name="bankPincode"
                                            value="<?=(!empty($userBankDtl)) ? $userBankDtl->pincode : ''?>"
                                            class="form-control contact-one__form-input" placeholder="Enter Pincode"
                                            required >
                                            <span id="bankPincode_error" class="error_text text-danger"></span>
                                    </div><!-- /.form-group-->
                                </div>
                            </div>
                        </div>
                        <div class="row backprevbtns card-footer">
                            <div class="col-auto">
                                <button id="backBtn2" type="button" onclick="nextStepFn(6,5,'prev');"
                                    class="btn btn-danger btn-sm btn__prevv">Back</button>
                            </div>
                            <div class="col-auto">
                                <button id="nextBtn2" type="submit" onclick="nextStepFn(6,7,'next');"
                                    class="btn btn-primary btn-sm btn__nextt">Next</button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <div class="card-body p-5 step stepFrm7" style="display:none;">
                        <div class="first_stepcd">
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="wrapper-1">
                                <div class="wrapper-2">
                                    <h1>Thank you !</h1>
                                    <p>Application has been submitted successfully</p>
                                <a href="{{ route('userDashboard') }}"> <button type="button" class="go-home">
                                    Go to Dashboard
                                    </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bank details end -->
                {{-- </form> --}}
                <div class="card-footer">
                    <!--                    <button class="action back btn okay_btn btn-sm btn-outline-warning btn_backform" style="display: none">Back</button>
                    <button class="btn btn-primary btn-sm" disabled="">Next</button>
                    <button class="action submit btn btn-sm btn-outline-success float-end" type="button" style="display: none">Okay</button>-->
                </div>
            </div>
        </div>
    </div>
    
    
</section>
@endsection
@push('puch-script')

<!-- form end -->



<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

function showKycPopUp(){
    alertMessage('Info!', 'Please verify all kyc documents.', 'error', 'no');
}

var loanApplyStep = 1;
function nextStepFn(current,next,type){
    if(type=='next'){
        //getNextStep(current,next,type);
        //initiateApplyLoan();
        //return 0;
        if(parseInt(current)==0)
        {
            var provideAccessOfGalleryAnFiles=$('#provideAccessOfGalleryAnFiles:checked').val();
            var acceptTermsAndConditions=$('#acceptTermsAndConditions:checked').val();
            if(!provideAccessOfGalleryAnFiles)
            {
                alertMessage('Error!', 'Please allow for gallery & files access.', 'error', 'no');
                return false;
            }else if(!acceptTermsAndConditions)
            {
                alertMessage('Error!', 'Please accept terms & conditions.', 'error', 'no');
                return false;
            }else{
                getNextStep(current,next,type);
            }  
            setProgressBarPercentage(current+1,next);
        }else if(parseInt(current)==1)
        {
            validateApplyLoan(current,next,type);
        }else if(parseInt(current)==2)
        {
            kycdetailsChk(current,next,type);
            
        }else if(parseInt(current)==3){
        //    var dateOfBirth=checkDOB($('#dateOfBirth').val());
        //     if(dateOfBirth<21 || dateOfBirth>58){    
        //         alertMessage('Error!', 'DOB show be 21 to 58 years max.', 'error', 'no');
        //         return false;
        //     }
            personalFormChk(current,next,type);   
           
        }else if(parseInt(current)==4)
        {
            // var dateOfBirthECoApp=checkDOB($('#dateOfBirthECoApp').val());
            // if(dateOfBirthECoApp<21 || dateOfBirthECoApp>58){    
            //     alertMessage('Error!', 'DOB show be 21 to 58 years max.', 'error', 'no');
            //     return false;
            // }
            coApplicantDetailsChk(current,next,type)
        }else if(parseInt(current)==5)
        {
            businessDetailsChk(current,next,type);
        }else if(parseInt(current)==6)
        {
            bankDetailsChk(current,next,type);
        }else{
           return false; 
        } 
        if(type=='save')
        {
            alert('save')
        }
        
    }else{
        $('.step').hide();
        $('.stepFrm'+(parseInt(current)-1)).show();
        // setProgressBarPercentage(next,current);
    }
    
}
function getNextStep(current,next,type)
{
    $('.step').hide();
    $('.stepFrm'+next).show();
}
function kycdetailsChk(current,next,type)
{
    var loantype = parseInt($('input[name="loanType"]:checked').val());
    var idProofFront=$('#idProofFront').val();
    var idProofBack=$('#idProofBack').val();
    var panCardFront=$('#panCardFront').val();
    var addressProofFront=$('#addressProofFront').val();
    var addressProofBack=$('#addressProofBack').val();
    var bankAttachemet=$('#bankAttachemet').val();
    var idProofFrontOld=$('#idProofFrontOld').val();
    var idProofBackOld=$('#idProofBackOld').val();
    var panCardFrontOld=$('#panCardFrontOld').val();
    var addressProofFrontOld=$('#addressProofFrontOld').val();
    var addressProofBackOld=$('#addressProofBackOld').val();
    var bankAttachemetOld=$('#bankAttachemetOld').val();
    if(!idProofFront && !idProofFrontOld && loantype == 2) {
        alertMessage('Error!', 'Please upload id card front.', 'error', 'no');
        return false;
    } else if(!idProofBack && !idProofBackOld && loantype == 2) {
        alertMessage('Error!', 'Please upload id card back.', 'error', 'no');
        return false;
    } else if(!panCardFront && !panCardFrontOld) {
        alertMessage('Error!', 'Please upload pan card.', 'error', 'no');
        return false;
    } else if(!addressProofFront && !addressProofFrontOld) {
        alertMessage('Error!', 'Please upload address proof front.', 'error', 'no');
        return false;
    } else if(!addressProofBack && !addressProofBackOld) {
        alertMessage('Error!', 'Please upload address proof back.', 'error', 'no');
        return false;
    } else if(!bankAttachemet && !bankAttachemetOld) {
        alertMessage('Error!', 'Please upload bank statement PDF.', 'error', 'no');
        return false;
    }else{
        $(".loader").show();
        $("#ApplyLoanStep2").trigger("submit");
    }
}
function personalFormChk(current,next,type) {
    var nameTitleCu=$('#nameTitleCu').val();
    var customerName=$('#customerName').val();
    var customerEmail=$('#customerEmail').val();
    var customerPhone=$('#customerPhone').val();
    var maritalStatus=$('#maritalStatus').val();
    var gender=$('#gender').val();        
    var dateOfBirth=$('#dateOfBirth').val();
    var address=$('#address').val();
    var city=$('#city').val();
    var district=$('#district').val();
    var state=$('#state').val();
    var pincode=$('#pincode').val();
    var aadhaar_no=$('#aadhaar_no').val();
    var pancard_no=$('#pancard_no').val();
    var religionCu=$('#religionCu').val();
    var educationStatusCu=$('#educationStatusCu').val();
    var fatherNameCu=$('#fatherNameCu').val();
    var motherNameCu=$('#motherNameCu').val();
    var cibilScoreCu=$('#cibilScoreCu').val();
    var sourcePerson=$('#sourcePerson').val();
    var branchName2=$('#branchName2').val();

    $('#nameTitleCu_error').text(''); $("#nameTitleCu+.contact-one__form-input").removeClass("error_background");
    $('#customerName_error').text('');             $('#customerName').removeClass('error_background');
    $('#customerEmail_error').text('');            $('#customerEmail').removeClass('error_background');
    $('#customerPhone_error').text('');            $('#customerPhone').removeClass('error_background');
    $('#maritalStatus_error').text('');            $('#maritalStatus+.contact-one__form-input').removeClass('error_background');
    $('#gender_error').text('');                       $('#gender+.contact-one__form-input').removeClass('error_background');        
    $('#dateOfBirth_error').text('');              $('#dateOfBirth').removeClass('error_background');
    $('#address_error').text('');              $('#address').removeClass('error_background');
    $('#city_error').text('');             $('#city').removeClass('error_background');
    $('#district_error').text('');             $('#district').removeClass('error_background');
    $('#state_error').text('');            $('#state').removeClass('error_background');
    $('#pincode_error').text('');              $('#pincode').removeClass('error_background');
    $('#aadhaar_no_error').text('');               $('#aadhaar_no').removeClass('error_background');
    $('#pancard_no_error').text('');               $('#pancard_no').removeClass('error_background');
    $('#religionCu_error').text('');               $('#religionCu+.contact-one__form-input').removeClass('error_background');
    $('#educationStatusCu_error').text('');            $('#educationStatusCu+.contact-one__form-input').removeClass('error_background');
    $('#fatherNameCu_error').text('');             $('#fatherNameCu').removeClass('error_background');
    $('#motherNameCu_error').text('');             $('#motherNameCu').removeClass('error_background');
    $('#cibilScoreCu_error').text('');             $('#cibilScoreCu').removeClass('error_background');
    $('#sourcePerson_error').text('');             $('#sourcePerson').removeClass('error_background');
    $('#branchName2_error').text('');              $('#branchName2').removeClass('error_background');

    var regex = /^(0|91)?[6-9][0-9]{9}$/;
    var dateOfBirth=checkDOB($('#dateOfBirth').val());

    if(!nameTitleCu) {
        $('#nameTitleCu_error').text('Please select customer name title.');
        $("#nameTitleCu+.contact-one__form-input").addClass("error_background");
        $("#nameTitleCu+.contact-one__form-input").focus();
        return false;
    } else if(!customerName) {
        $('#customerName_error').text('Please enter the customer name.');
        $("#customerName").addClass("error_background");
        $("#customerName").focus();
        return false;
    } else if(!customerEmail) {
        $('#customerEmail_error').text('Please enter email id.');
        $("#customerEmail").addClass("error_background");
        $("#customerEmail").focus();
        return false;
    }else if(!customerPhone) {
        $('#customerPhone_error').text('Please enter mobile number.');
         $("#customerEmail").addClass("error_background");
         $("#customerEmail").focus();
        return false;
    }else if(!regex.test(customerPhone)) {
        $('#customerPhone_error').text('Please enter valid mobile number.');
        $("#customerPhone").addClass("error_background");
        $("#customerPhone").focus();
        return false;
    }else if(!maritalStatus) {
        $('#maritalStatus_error').text('Please select marital status.');
        $("#maritalStatus+.contact-one__form-input").addClass("error_background");
        $("#maritalStatus+.contact-one__form-input").focus();
        return false;
    }else if(!gender) {
        $('#gender_error').text('Please select gender.');
        $("#gender+.contact-one__form-input").addClass("error_background");
        $("#gender+.contact-one__form-input").focus();
        return false;
    }else if(!dateOfBirth) {
        $('#dateOfBirth_error').text('Please select date of birth.');
        $("#dateOfBirth").addClass("error_background");
        $("#dateOfBirth").focus();
        return false;
    }else if(dateOfBirth<21 || dateOfBirth>58){
        $('#dateOfBirth_error').text('DOB show be 21 to 58 years max.');
        $("#dateOfBirth").addClass("error_background");
        $("#dateOfBirth").focus();
        return false;
    }else if(!address) {
        $('#address_error').text('Please enter address.');
        $("#address").addClass("error_background");
        $("#address").focus();
        return false;
    }else if(!city) {
        $('#city_error').text('Please enter city.');
        $("#city").addClass("error_background");
        $("#city").focus();
        return false;
    }else if(!state) {
        $("#state_error").text('Please enter state.');
        $("#state").addClass("error_background");
        $("#state").focus();
        return false;
    }else if(!pincode) {
        $("#pincode_error").text('Please enter pincode.');
        $("#pincode").addClass("error_background");
        $("#pincode").focus();
        return false;
    }else if(pincode.length != 6) {
        $("#pincode_error").text('Please enter valid pincode.');
        $("#pincode").addClass("error_background");
        $("#pincode").focus();
        return false;
    }else if(!aadhaar_no) {
        $("#aadhaar_no_error").text('Please enter valid pincode.');
        $("#aadhaar_no").addClass("error_background");
        $("#aadhaar_no").focus();
        return false;
    }else if(aadhaar_no && aadhaar_no.length!=12) {
        $("#aadhaar_no_error").text('Please enter valid aadhaar number.');
        $("#aadhaar_no").addClass("error_background");
        $("#aadhaar_no").focus();
        return false;
    }else if(!pancard_no) {
        $("#pancard_no_error").text('Please enter pan number.');
        $("#pancard_no").addClass("error_background");
        $("#pancard_no").focus();
        return false;
    }else if(pancard_no && pancard_no.length!=10) {
        $("#pancard_no_error").text('Please enter valid pan number.');
        $("#pancard_no").addClass("error_background");
        $("#pancard_no").focus();
        return false;
    }else if(!religionCu) {
        $("#religionCu_error").text('Please enter religion.');
        $("#religionCu+.contact-one__form-input").addClass("error_background");
        $("#religionCu+.contact-one__form-input").focus();
        return false;
    }else if(!educationStatusCu) {
        $("#educationStatusCu_error").text('Please enter education status.');
        $("#educationStatusCu+.contact-one__form-input").addClass("error_background");
        $("#educationStatusCu+.contact-one__form-input").focus();
        return false;
    }else if(!fatherNameCu) {
        $("#fatherNameCu_error").text('Please enter father name.');
        $("#fatherNameCu").addClass("error_background");
        $("#fatherNameCu").focus();
        return false;
    }else if(!motherNameCu) {
        $("#motherNameCu_error").text('Please enter mother name.');
        $("#motherNameCu").addClass("error_background");
        $("#motherNameCu").focus();
        return false;
    }else if(!sourcePerson) {
        $("#sourcePerson_error").text('Please enter source person name.');
        $("#sourcePerson").addClass("error_background");
        $("#sourcePerson").focus();
        return false;
    }else{
        $("#ApplyLoanStep3").trigger("submit");
    }
}
function coApplicantDetailsChk(current,next,type) {
    var nameTitleCoApp=$('#nameTitleCoApp').val();
    var customerNameCoApp=$('#customerNameCoApp').val();
    var genderCoApp=$('#genderCoApp').val();
    var dateOfBirthECoApp=$('#dateOfBirthECoApp').val();
    var religionCoApp=$('#religionCoApp').val();
    var educationStatusCoApp=$('#educationStatusCoApp').val();
    var fatherNameCoApp=$('#fatherNameCoApp').val();
    var motherNameCoApp=$('#motherNameCoApp').val();
    var maritalStatusCoApp=$('#maritalStatusCoApp').val();
    var relationWithApplicantCoApp=$('#relationWithApplicantCoApp').val();
    var cibilScoreCoApp=$('#cibilScoreCoApp').val();

    var dateOfBirthECoApp=checkDOB($('#dateOfBirthECoApp').val());


    $('#nameTitleCoApp_error').text('');                $('#nameTitleCoApp+.contact-one__form-input').removeClass('error_background');
    $('#customerNameCoApp_error').text('');             $('#customerNameCoApp').removeClass('error_background');
    $('#genderCoApp_error').text('');                   $('#genderCoApp+.contact-one__form-input').removeClass('error_background');
    $('#dateOfBirthECoApp_error').text('');             $('#dateOfBirthECoApp').removeClass('error_background');
    $('#religionCoApp_error').text('');                 $('#religionCoApp+.contact-one__form-input').removeClass('error_background');
    $('#educationStatusCoApp_error').text('');          $('#educationStatusCoApp+.contact-one__form-input').removeClass('error_background');
    $('#fatherNameCoApp_error').text('');               $('#fatherNameCoApp').removeClass('error_background');
    $('#motherNameCoApp_error').text('');               $('#motherNameCoApp').removeClass('error_background');
    $('#maritalStatusCoApp_error').text('');            $('#maritalStatusCoApp+.contact-one__form-input').removeClass('error_background');
    $('#relationWithApplicantCoApp_error').text('');    $('#relationWithApplicantCoApp').removeClass('error_background');
    $('#cibilScoreCoApp_error').text('');               $('#cibilScoreCoApp').removeClass('error_background');


    if(!nameTitleCoApp) {
        $('#nameTitleCoApp_error').text('Please select marital status.');
        $("#nameTitleCoApp+.contact-one__form-input").addClass("error_background");
        $("#nameTitleCoApp+.contact-one__form-input").focus();
        // alertMessage('Error!', 'Please select name title.', 'error', 'no');
        return false;
    }else if(!customerNameCoApp) {
        $('#customerNameCoApp_error').text('Please enter name.');
        $("#customerNameCoApp").addClass("error_background");
        $("#customerNameCoApp").focus();
        // alertMessage('Error!', 'Please enter name.', 'error', 'no');
        return false;
    }else if(!genderCoApp) {
        $('#genderCoApp_error').text('Please select gender.');
        $("#genderCoApp+.contact-one__form-input").addClass("error_background");
        $("#genderCoApp+.contact-one__form-input").focus();
        // alertMessage('Error!', 'Please select gender.', 'error', 'no');
        return false;
    }else if(!dateOfBirthECoApp) {
        $('#dateOfBirthECoApp_error').text('Please select date of birth.');
        $("#dateOfBirthECoApp").addClass("error_background");
        $("#dateOfBirthECoApp").focus();
        // alertMessage('Error!', 'Please select date of birth.', 'error', 'no');
        return false;
    }else if(dateOfBirthECoApp<21 || dateOfBirthECoApp>58){   
        $('#dateOfBirthECoApp_error').text('DOB show be 21 to 58 years max.');
        $("#dateOfBirthECoApp").addClass("error_background");
        $("#dateOfBirthECoApp").focus();
    }else if(!religionCoApp) {
        $('#religionCoApp_error').text('Please enter religion.');
        $("#religionCoApp+.contact-one__form-input").addClass("error_background");
        $("#religionCoApp+.contact-one__form-input").focus();
        // alertMessage('Error!', 'Please enter religion.', 'error', 'no');
        return false;
    }else if(!educationStatusCoApp) {
        $('#educationStatusCoApp_error').text('Please select education status.');
        $("#educationStatusCoApp+.contact-one__form-input").addClass("error_background");
        $("#educationStatusCoApp+.contact-one__form-input").focus();
        // alertMessage('Error!', 'Please select education status.', 'error', 'no');
        return false;
    }else if(!fatherNameCoApp) {
        $('#fatherNameCoApp_error').text('Please enter father name.');
        $("#fatherNameCoApp").addClass("error_background");
        $("#fatherNameCoApp").focus();
        // alertMessage('Error!', 'Please enter father name.', 'error', 'no');
        return false;
    }else if(!motherNameCoApp) {
        $('#motherNameCoApp_error').text('Please enter mother name.');
        $("#motherNameCoApp").addClass("error_background");
        $("#motherNameCoApp").focus();
        // alertMessage('Error!', 'Please enter mother name.', 'error', 'no');
        return false;
    }else if(!maritalStatusCoApp) {
        $('#maritalStatusCoApp_error').text('Please select merital status.');
        $("#maritalStatusCoApp+.contact-one__form-input").addClass("error_background");
        $("#maritalStatusCoApp+.contact-one__form-input").focus();
        // alertMessage('Error!', 'Please select merital status.', 'error', 'no');
        return false;
    }else if(!relationWithApplicantCoApp) {
        $('#relationWithApplicantCoApp_error').text('Please enter relation with applicant.');
        $("#relationWithApplicantCoApp").addClass("error_background");
        $("#relationWithApplicantCoApp").focus();
        // alertMessage('Error!', 'Please enter relation with applicant.', 'error', 'no');
        return false;
    }else{
        $("#ApplyLoanStep4").trigger("submit");
    }
}

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

function businessDetailsChk(current,next,type) {
    var employerName=$('#employerName').val();
    var companyMobileNo=$('#companyMobileNo').val();
    var companyEmailId = $('#companyEmailId').val();
    // var companyFaxNo = $('#companyFaxNo').val();
    var companyGstin=$('#companyGstin').val();
    var companyPan=$('#companyPan').val();
    var companyType=$('#companyType').val();
    var companyAddress=$('#companyAddress').val();
    var companyDistrict=$('#companyDistrict').val();
    var companyState=$('#companyState').val();
    var companyPincode=$('#companyPincode').val();
    var loanCategory=parseInt($('input[name="loanType"]:checked').val());
    var totalExpInCurrentCompany=$('#totalExpInCurrentCompany').val();
    var currentSalary=$('#currentSalary').val();
    var regex = /^(0|91)?[6-9][0-9]{9}$/;
    var regexEmail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;  


    $('#employerName_error').text('');                      $('#employerName').removeClass('error_background');
    $('#companyMobileNo_error').text('');                   $('#companyMobileNo').removeClass('error_background');
    $('#companyEmailId_error').text('');                    $('#companyEmailId').removeClass('error_background');
    // $('#companyFaxNo_error').text('');                      $('#companyFaxNo').removeClass('error_background');
    $('#companyGstin_error').text('');                      $('#companyGstin').removeClass('error_background');
    $('#companyPan_error').text('');                        $('#companyPan').removeClass('error_background');
    $('#companyType_error').text('');                       $('#companyType+.contact-one__form-input').removeClass('error_background');
    $('#companyAddress_error').text('');                    $('#companyAddress').removeClass('error_background');
    $('#companyDistrict_error').text('');                   $('#companyDistrict').removeClass('error_background');
    $('#companyState_error').text('');                      $('#companyState').removeClass('error_background');
    $('#companyPincode_error').text('');                    $('#companyPincode').removeClass('error_background');
    $('#totalExpInCurrentCompany_error').text('');          $('#totalExpInCurrentCompany').removeClass('error_background');
    $('#currentSalary_error').text('');                     $('#currentSalary').removeClass('error_background');

    if(!loanCategory){

        alertMessage('Error!', 'Please select loan type first.', 'error', 'no');
        return false;
    }
    if(!employerName) {
        $('#employerName_error').text('Please enter the company name.');
        $("#employerName").addClass("error_background");
        $("#employerName").focus();
        // alertMessage('Error!', 'Please enter the company name.', 'error', 'no');
        return false;
    } else if(!companyMobileNo) {
        $('#companyMobileNo_error').text('Please enter company phone number.');
        $("#companyMobileNo").addClass("error_background");
        $("#companyMobileNo").focus();
        // alertMessage('Error!', 'Please enter company phone number.', 'error', 'no');
        return false;
    }else if(!regex.test(companyMobileNo)) {
        $('#companyMobileNo_error').text('Please enter valid company phone number.');
        $("#companyMobileNo").addClass("error_background");
        $("#companyMobileNo").focus();
        // alertMessage('Error!', 'Please enter valid company phone number.', 'error', 'no');
        return false;
    }else if(!companyEmailId) {
        $('#companyEmailId_error').text('Please enter company email.');
        $("#companyEmailId").addClass("error_background");
        $("#companyEmailId").focus();
        // alertMessage('Error!', 'Please enter company phone number.', 'error', 'no');
        return false;
    }else if(!validateEmail(companyEmailId)){
        $('#companyEmailId_error').text('Please enter valid company email.');
        $("#companyEmailId").addClass("error_background");
        $("#companyEmailId").focus();
        // alertMessage('Error!', 'Please enter company phone number.', 'error', 'no');
        return false;
    }else if(!companyGstin && loanCategory!=2) {
        $('#companyGstin_error').text('Please enter GSTIN.');
        $("#companyGstin").addClass("error_background");
        $("#companyGstin").focus();
        // alertMessage('Error!', 'Please enter GSTIN.', 'error', 'no');
        return false;
    }else if(companyGstin && companyGstin.length!=15 && loanCategory!=2) {
        $('#companyGstin_error').text('Please enter valid GSTIN.');
        $("#companyGstin").addClass("error_background");
        $("#companyGstin").focus();
        // alertMessage('Error!', 'Please enter valid GSTIN.', 'error', 'no');
        return false;
    }else if(!companyPan && loanCategory!=2) {
        $('#companyPan_error').text('Please enter pan number.');
        $("#companyPan").addClass("error_background");
        $("#companyPan").focus();
        // alertMessage('Error!', 'Please enter pan number.', 'error', 'no');
        return false;
    } else if(companyPan && companyPan.length!=10 && loanCategory!=2) {
        $('#companyPan_error').text('Please enter valid pan number.');
        $("#companyPan").addClass("error_background");
        $("#companyPan").focus();
        // alertMessage('Error!', 'Please enter valid pan number.', 'error', 'no');
        return false;
    } else if(!companyType) {
        $('#companyType_error').text('Please select company type.');
        $("#companyType+.contact-one__form-input").addClass("error_background");
        $("#companyType+.contact-one__form-input").focus();
        // alertMessage('Error!', 'Please select company type.', 'error', 'no');
        return false;
    } else if(loanCategory==2 && !totalExpInCurrentCompany) {
        $('#totalExpInCurrentCompany_error').text('Please enter total experience in current company.');
        $("#totalExpInCurrentCompany").addClass("error_background");
        $("#totalExpInCurrentCompany").focus();
        // alertMessage('Error!', 'Please enter total experience in current company.', 'error', 'no');
        return false;
    } else if(loanCategory==2 && !currentSalary) {
        $('#currentSalary_error').text('Please enter your current salary.');
        $("#currentSalary").addClass("error_background");
        $("#currentSalary").focus();
        // alertMessage('Error!', 'Please enter your current salary.', 'error', 'no');
        return false;
    } else if(!companyAddress) {
        $('#companyAddress_error').text('Please enter company address.');
        $("#companyAddress").addClass("error_background");
        $("#companyAddress").focus();
        // alertMessage('Error!', 'Please enter company address.', 'error', 'no');
        return false;
    } else if(!companyDistrict) {
        $('#companyDistrict_error').text('Please enter company district.');
        $("#companyDistrict").addClass("error_background");
        $("#companyDistrict").focus();
        // alertMessage('Error!', 'Please enter company district.', 'error', 'no');
        return false;
    } else if(!companyState) {
        $('#companyState_error').text('Please enter company state.');
        $("#companyState").addClass("error_background");
        $("#companyState").focus();
        // alertMessage('Error!', 'Please enter company state.', 'error', 'no');
        return false;
    } else if(!companyPincode) {
        $('#companyPincode_error').text('Please enter company pincode.');
        $("#companyPincode").addClass("error_background");
        $("#companyPincode").focus();
        // alertMessage('Error!', 'Please enter company pincode.', 'error', 'no');
        return false;
    }else if(companyPincode.length != 6) {
        $('#companyPincode_error').text('Please enter valid pincode.');
        $("#companyPincode").addClass("error_background");
        $("#companyPincode").focus();
        // alertMessage('Error!', 'Please enter valid pincode.', 'error', 'no');
        return false;
    }else{
        $("#ApplyLoanStep6").trigger("submit");
        // getNextStep(current,next,type);
    }
}
function bankDetailsChk(current,next,type) {
    var accountHolderName=$('#accountHolderName').val();
    var bankName=$('#bankName').val();
    var ifscCode=$('#ifscCode').val();
    var accountType=$('#accountType').val();
    var accountNumber=$('#accountNumber').val();
    var accountNumberC=$('#accountNumberC').val();
    var bankAddress=$('#bankAddress').val();
    var bankCity=$('#bankCity').val();
    var bankState=$('#bankState').val();
    var bankPincode=$('#bankPincode').val();


    $('#accountHolderName_error').text('');             $('#accountHolderName').removeClass('error_background');       
    $('#bankName_error').text('');                  $('#bankName').removeClass('error_background');        
    $('#ifscCode_error').text('');                  $('#ifscCode').removeClass('error_background');        
    $('#accountType_error').text('');               $('#accountType+.contact-one__form-input').removeClass('error_background');     
    $('#accountNumber_error').text('');             $('#accountNumber').removeClass('error_background');       
    $('#accountNumberC_error').text('');            $('#accountNumberC').removeClass('error_background');      
    $('#bankAddress_error').text('');               $('#bankAddress').removeClass('error_background');     
    $('#bankCity_error').text('');                  $('#bankCity').removeClass('error_background');        
    $('#bankState_error').text('');                 $('#bankState').removeClass('error_background');       
    $('#bankPincode_error').text('');               $('#bankPincode').removeClass('error_background');     


    var errorData = 0;
    if(!accountHolderName) {
        errorData = 1;
        $('#accountHolderName_error').text('Please enter the account holder name.');
        $("#accountHolderName").addClass("error_background");
        $("#accountHolderName").focus();
        // alertMessage('Error!', 'Please enter the account holder name.', 'error', 'no');
        return false;
    } else if(!bankName) {
        errorData = 1;
        $('#bankName_error').text('Please enter bank name.');
        $("#bankName").addClass("error_background");
        $("#bankName").focus();
        // alertMessage('Error!', 'Please enter bank name.', 'error', 'no');
        return false;
    } else if(!ifscCode) {
        errorData = 1;
        $('#ifscCode_error').text('Please enter IFSC code.');
        $("#ifscCode").addClass("error_background");
        $("#ifscCode").focus();
        // alertMessage('Error!', 'Please enter IFSC code.', 'error', 'no');
        return false;
    } else if(!accountType) {
        errorData = 1;
        $('#accountType_error').text('Please account type.');
        $("#accountType+.contact-one__form-input").addClass("error_background");
        $("#accountType+.contact-one__form-input").focus();
        // alertMessage('Error!', 'Please account type.', 'error', 'no');
        return false;
    }else if(!accountNumber) {
        errorData = 1;
        $('#accountNumber_error').text('Please enter account number.');
        $("#accountNumber").addClass("error_background");
        $("#accountNumber").focus();
        // alertMessage('Error!', 'Please enter account number.', 'error', 'no');
        return false;
    }else if(!$.isNumeric(accountNumber)){
        errorData = 1;
        $('#accountNumber_error').text('Enter valid account number.');
        $("#accountNumber").addClass("error_background");
        $("#accountNumber").focus();
        // alertMessage('Error!', 'Enter valid account number.', 'error', 'no');
        return false;
    }else if(accountNumber.length < 10 || accountNumber.length > 18){
        errorData = 1;
        $('#accountNumber_error').text('Enter valid account number.');
        $("#accountNumber").addClass("error_background");
        $("#accountNumber").focus();
        // alertMessage('Error!', 'Enter valid account number.', 'error', 'no');
        return false;
    }else if(accountNumber !=accountNumberC) {
        errorData = 1;
        $('#accountNumber_error').text('Confirm account number not matched.');
        $("#accountNumber").addClass("error_background");
        $("#accountNumber").focus();
        // alertMessage('Error!', 'Confirm account number not matched.', 'error', 'no');
        return false;
    }else if(!bankAddress) {
        errorData = 1;
        $('#bankAddress_error').text('Please enter bank address.');
        $("#bankAddress").addClass("error_background");
        $("#bankAddress").focus();
        // alertMessage('Error!', 'Please enter bank address.', 'error', 'no');
        return false;
    }else if(!bankCity) {
        errorData = 1;
        $('#bankCity_error').text('Please enter bank city.');
        $("#bankCity").addClass("error_background");
        $("#bankCity").focus();
        // alertMessage('Error!', 'Please enter bank city.', 'error', 'no');
        return false;
    }else if(!bankState) {
        errorData = 1;
        $('#bankState_error').text('Please enter bank state.');
        $("#bankState").addClass("error_background");
        $("#bankState").focus();
        // alertMessage('Error!', 'Please enter bank state.', 'error', 'no');
        return false;
    }else if(!bankPincode) {
        errorData = 1;
        $('#bankPincode_error').text('Please enter bank address pincode.');
        $("#bankPincode").addClass("error_background");
        $("#bankPincode").focus();
        // alertMessage('Error!', 'Please enter bank address pincode.', 'error', 'no');
        return false;
    }else if(bankPincode.length != 6) {
        errorData = 1;
        $('#bankPincode_error').text('Please enter valid bank address pincode.');
        $("#bankPincode").addClass("error_background");
        $("#bankPincode").focus();
        // alertMessage('Error!', 'Please enter valid bank address pincode.', 'error', 'no');
        return false;
    }else{
        if(errorData === 0){
            $("#ApplyLoanStep5").trigger("submit");
            // $('#allFieldsCustomForm').submit();
            waitForProcess();
        }
    }
}
function validateApplyLoan(current,next,type)
{
    var loanCategory=$('input[name="loanType"]:checked').val();
    var productName=$('#productName').val();
    var approveTenure=$('#approveTenure').val();
    var approvedAmount=$('#approvedAmount').val();
    var approvedRoi=$('#approvedRoi').val();
    var invoiceFile=$('#invoiceFile').val();
    var validFromDate=$('#validFromDate').val();
    var validToDate=$('#validToDate').val();
    var plateformFee=$('#plateformFee').val();
    var insurance=$('#insurance').val();
    var roiType=$('#roiType').val();

    $("#idProofFrontdiv").hide();
    $("#idProofBackdiv").hide();
    if(parseInt(loanCategory)==2){
        $("#idProofFrontdiv").show();
        $("#idProofBackdiv").show();
    }
    

    // if(!loanCategory){
    //     alertMessage('Error!', 'Please select category name.', 'error', 'no');
    //     return false;
    // }else if(loanCategory!='3' && loanCategory!='4' && !productName){
    //     alertMessage('Error!', 'Please select product name.', 'error', 'no');
    //     return false;
    // }else if(loanCategory=='3' && !invoiceFile){
    //     alertMessage('Error!', 'Please upload bill.', 'error', 'no');
    //     return false;
    // }else if(loanCategory=='4' && !invoiceFile){
    //     alertMessage('Error!', 'Please upload invoice.', 'error', 'no');
    //     return false;
    // }else if(!approvedRoi){
    //     alertMessage('Error!', 'Please select rate of interest.', 'error', 'no');
    //     return false;
    // }else if(loanCategory=='3' && (!validFromDate || !validToDate)){
    //     alertMessage('Error!', 'Please select valid from & valid to date.', 'error', 'no');
    //     return false;
    // }else if(loanCategory!='3' && loanCategory!='4' && !roiType){
    //     alertMessage('Error!', 'Please select ROI type.', 'error', 'no');
    //     return false;
    // }else if(!approveTenure){
    //     alertMessage('Error!', 'Please select tenure.', 'error', 'no');
    //     return false;
    // }else if(!approvedAmount){
    //     alertMessage('Error!', 'Please enter approved amount.', 'error', 'no');
    //     return false;
    // }else{
        $("#ApplyLoanStep1").trigger("submit");
    // }
}
function setProgressBarPercentage(current,next)
{
    var percent = parseFloat(100 / $(".step").length) * current;
    percent = percent.toFixed();
    $(window).scrollTop(0);
    $(".progress-bar")
      .css("width", percent + "%")
      .html(percent + "%");
}
function checkProductTypeCategory(catId)
{
    var loanId=$('#loanCategory'+catId).val();
    $('#invoiceFile').val('');
    $('#validFromDate').val('');
    $('#validToDate').val('');
    $('#productName').val('');
    $('#productName').val('');
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
        $('.productNameHtml').hide();
        $('.roiTypeHtml').hide();
    }else{
        $('#invoiceFileHtml').hide();
        $('.productNameHtml').show();
        $('.roiTypeHtml').show();
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
        }else{
            $('#approveTenure').html('');
        }
    });
}

var optionsData={};
var changeOption = false;
function initiateApplyLoan(catId)
{
    $.post('{{route('initiateApplyLoanWeb')}}',{
        "_token": "{{ csrf_token() }}",
        catId:catId,
    },function(data){
        var obj = JSON.parse(data);
        if(obj.status=='success'){
            $('#applyLoanOtherInputs').html(obj.data);
            $('select').niceSelect();
            getBusinessOrEmploymentFormForLoanApply(catId);
            $('select').niceSelect();
            $("#approveTenure option").each(function()
            {
                if($(this).val()!=""){
                    optionsData[$(this).text()] = $(this).val();
                }
            });
    
            //$('.dropify').dropify();
        }else{
            $('#applyLoanOtherInputs').html('');
        }
    });
}

function roiTypeSele(that){
    let roiTypeValue = $(that).val();
    
    $("#approveTenure").niceSelect('destroy');
    if(roiTypeValue == "bullet_repayment"){
        $('#approveTenure').empty().append('<option value="">Select</option>');
        $.each(optionsData, function(index, value) 
        {
            let monthArr = index.split('Month');
            let monthCount = monthArr[0].trim();
            if(monthCount == 6 || monthCount == 12){
                $('#approveTenure').append(`<option value="${value}">${index}</option>`);
            }
        });
        changeOption = true;
    }else if(changeOption){
        $('#approveTenure').empty().append('<option value="">Select</option>');
        $.each(optionsData, function(index, value)
        {
            $('#approveTenure').append(`<option value="${value}">${index}</option>`);
        });
    }
    $("#approveTenure").niceSelect();
}


function getBusinessOrEmploymentFormForLoanApply(catId)
{
    $.post('{{route('getBusinessOrEmploymentFormForLoanApply')}}',{
        "_token": "{{ csrf_token() }}",
        catId:catId,
    },function(data){
        $('#getBusinessOrEmploymentFormHtml').html(data);
        $('select').niceSelect();
    });
}
$('#allFieldsCustomForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var employerName=$('#employerName').val();
    var companyMobileNo=$('#companyMobileNo').val();
    var companyPan=$('#companyPan').val();
    var companyGstin=$('#companyGstin').val();
    var companyType=$('#companyType').val();
    var companyAddress=$('#companyAddress').val();
    var companyDistrict=$('#companyDistrict').val();
    var companyState=$('#companyState').val();
    var companyPincode=$('#companyPincode').val();
    if(!employerName) {
        alertMessage('Error!', 'Please enter the company name.', 'error', 'no');
        return false;
    }else{
        $('#allFieldsCustomFormBtn').text('Please Wait...').attr('disabled','disabled');
        $.ajax({
            type:'POST',
            url: "{{route('saveApplyLoanByWebUser')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                var obj = JSON.parse(data);
                $('#allFieldsCustomFormBtn').text('Submit').removeAttr('disabled');
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
                $('#allFieldsCustomFormBtn').text('Save').removeAttr('disabled');
                alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                return false;
                //console.log(data);
            }
        });
    }
});
function checkDOB(enteredDate)
{
    var years = new Date(new Date() - new Date(enteredDate)).getFullYear() - 1970;
    console.log(years)
    return years;
}

function isAlphabet(e){
    var keyCode = e.keyCode || e.which;
    var regex = /^[A-Za-z_ ]+$/;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        alertMessage('Error!', 'Please Enter Alphabet Only.', 'error', 'no');
    }
    return isValid;
}
</script>
@if(old('loanType')) 
<script>
    var loantype = "{{old('loanType')}}";
    initiateApplyLoan({{old('loanType')}});
    getNextStep(0,1,'next');

    $("#idProofFrontdiv").hide();
    $("#idProofBackdiv").hide();
    if(parseInt(loantype)==2){
        $("#idProofFrontdiv").show();
        $("#idProofBackdiv").show();
    }
</script>
@elseif($loanData && isset($loanData->loanCategory))
    <script>
        var loantype = "{{$loanData->loanCategory}}";
        initiateApplyLoan({{$loanData->loanCategory}});
        getNextStep(0,1,'next');

        $("#idProofFrontdiv").hide();
        $("#idProofBackdiv").hide();
        if(parseInt(loantype)==2){
            $("#idProofFrontdiv").show();
            $("#idProofBackdiv").show();
        }
    </script>
@endif

@if(session()->get('step') == 1)
<script>
    if(parseInt(loantype)==2){
        
        $("#idProofFrontdiv").show();
        $("#idProofBackdiv").show();
        $(".businessKycOther").hide();
    }
    getNextStep(1,2,'next');
    setProgressBarPercentage(1,1);
</script>
@elseif(session()->get('step') == 2)
<script>
    if(parseInt(loantype)==2){
        
        $("#idProofFrontdiv").show();
        $("#idProofBackdiv").show();
        $(".businessKycOther").hide();
    }
    getNextStep(2,3,'next');
    setProgressBarPercentage(2,2);
</script>
@elseif(session()->get('step') == 3)
<script>
    getNextStep(3,4,'next');
    setProgressBarPercentage(3,3);
</script>
@elseif(session()->get('step') == 4 && isset($loanData->loanCategory) && $loanData->loanCategory != "2")
<script>
    getNextStep(4,5,'next');
    setProgressBarPercentage(4,4);
    getBusinessOrEmploymentFormForLoanApply({{$loanData->loanCategory}});
    $('select').niceSelect();
</script>
@elseif(session()->get('step') == 4 && isset($loanData->loanCategory) && $loanData->loanCategory == "2")
<script>
    getNextStep(4,5,'next');
    setProgressBarPercentage(4,4);
    getBusinessOrEmploymentFormForLoanApply({{$loanData->loanCategory}});
    
</script>
@elseif(session()->get('step') == 5)
<script>
    // getNextStep(4,5,'next');
    // setProgressBarPercentage(4,4);
    getNextStep(5,6,'next');
    setProgressBarPercentage(5,5);
</script>
@elseif(session()->get('step') == 6)
<script>
    $("#stepFrm7").show();
    getNextStep(6,7,'next');
    setProgressBarPercentage(8,8);
</script>
@elseif(session()->get('step'))
<script>
    getNextStep(6,5,'next');
    setProgressBarPercentage(6,6);
</script>
<!-- <script>
    $(window).load(function() {
   setTimeout(function(){ $('.loader4').fadeOut('slow'); }, 3000);
})
</script> -->
@endif

@error('validToDate')
    <script>
        setTimeout(() => {
        $("#step1_validToDate").text("Valid To Field Is Required.");
    }, 500);
    </script>
@enderror
@error('validFromDate')
    <script>
        setTimeout(() => {
        $("#step1_validFromDate").text("Valid From Field Is Required.");
    }, 500);
    </script>
@enderror
@error('approvedRoi')
    <script>
        setTimeout(() => {
        $("#step1_approvedRoi").text("ROI % Field Is Required.");
    }, 500);
    </script>
@enderror
@error('approvedAmount')
    <script>
        setTimeout(() => {
        $("#step1_approvedAmount").text("Loan Amount Field Is Required.");
    }, 500);
    </script>
@enderror
@error('approveTenure')
    <script>
        setTimeout(() => {
        $("#step1_approveTenure").text("Tenure Field Is Required.");
    }, 500);
    </script>
@enderror
@error('roiType')
    <script>
        setTimeout(() => {
            document.getElementById("step1_roiType").innerHTML = "ROI Type Field Is Required.";
        }, 500);
    </script>
@enderror
@error('invoiceFile')
    <script>
        setTimeout(() => {
        $("#step1_invoiceFile").text("Invoice Field Is Required.");
    }, 500);
    </script>
@enderror
@error('productName')
    <script>
        setTimeout(() => {
        $("#step1_productName").text("Product Name Field Is Required.");
    }, 500);
    </script>
@enderror
@if(session()->get('error'))
    <script>
        alertMessage('Error!', "{{session()->get('error')}}", 'error', 'no');
    </script>
<!-- progressbar js -->
<script>
    $(function() {
  var current_progress = 0;
  var interval = setInterval(function() {
      current_progress += 10;
      $("#dynamic")
      .css("width", current_progress + "%")
      .attr("aria-valuenow", current_progress)
      .text(current_progress + "% Complete");
      if (current_progress >= 100)
          clearInterval(interval);
  }, 1000);
});
</script>




@endif

<script>
    $("#verify_orignal_pancard").click(function(e){
        e.preventDefault();
        $("#verify_orignal_pancard").attr('disabled',true);
        let panCardFrontOld = $('#panCardFrontOld')[0].files;
        let panCardFront = $('#panCardFront')[0].files;
        if(panCardFront && panCardFront.length > 0){
            $("#verify_orignal_pancard").text('Verifying ..');
            let fd = new FormData();
            fd.append('panCardFront',panCardFront[0]);
            fd.append('_token','{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('webPancardVerify') }}",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response){
                    $("#verify_orignal_pancard").attr('disabled',false);
                    let outdata = response;
                    if(outdata.status){
                        $("#verify_orignal_pancard").text('Verified');
                        if($("#verify_orignal_aadharcard").text() == "Verified"){
                            $("#nextBtn222").attr('onclick', "nextStepFn(2,3,'next');");
                        }
                        alertMessage('Success !', outdata.msg,'success', 'no');
                    }else{
                        $("#verify_orignal_pancard").text('Verify');
                        alertMessage('Error!', outdata.msg,'error', 'no');
                    }
                },
                error: function(response){
                    $("#verify_orignal_pancard").attr('disabled',false);
                    $("#verify_orignal_pancard").text('Verify');
                    alertMessage('Error!', JSON.stringify(response),'error', 'no');
                }
            });
        }else{
            $("#verify_orignal_pancard").attr('disabled',false);
            alertMessage('Error!', "Please Upload Photo of Pan Card", 'error', 'no');
        }
    });

    $("#verify_orignal_aadharcard").click(function(e){
        e.preventDefault();
        $("#verify_orignal_aadharcard").attr('disabled',true);
        let addressProofFront = $('#addressProofFront')[0].files;
        let addressProofBack = $('#addressProofBack')[0].files;
        if(addressProofFront && addressProofFront.length > 0 && addressProofBack && addressProofBack.length > 0){
            $("#verify_orignal_aadharcard").text('Verifying ..');
            let fd = new FormData();
            fd.append('addressProofFront',addressProofFront[0]);
            fd.append('addressProofBack',addressProofBack[0]);
            fd.append('_token','{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('webAadharcardVerify') }}",
                method: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response){
                    $("#verify_orignal_aadharcard").attr('disabled',false);
                    let outdata = response;
                    if(outdata.status){
                        $("#verify_orignal_aadharcard").text('Verified');
                        if($("#verify_orignal_pancard").text() == "Verified"){
                            $("#nextBtn222").attr('onclick', "nextStepFn(2,3,'next');");
                        }
                        alertMessage('Success !', outdata.msg,'success', 'no');
                    }else{
                        $("#verify_orignal_aadharcard").text('Verify');
                        alertMessage('Error!', outdata.msg,'error', 'no');
                    }
                },
                error: function(response){
                    $("#verify_orignal_aadharcard").attr('disabled',false);
                    $("#verify_orignal_aadharcard").text('Verify');
                    alertMessage('Error!', JSON.stringify(response),'error', 'no');
                }
            });
        }else{
            $("#verify_orignal_aadharcard").attr('disabled',false);
            alertMessage('Error!', "Please Upload Photo of Aadhar Card", 'error', 'no');
        }
    });

    $("#pancard_partner1").click(function(e){
        e.preventDefault();
       
        let kyc1_pancard_img = $('#kyc1_pancard_img')[0].files;
        if($("#exampleInputEmail11").val() == ""){
            alertMessage('Error!', "Partner 1 Email Address Required.",'error', 'no');
        }else if($("#exampleInputMobile1").val() == ""){
            alertMessage('Error!', "Partner 1 Mobile Number Required.",'error', 'no');
        }else if($("#exampleInputMobile1").val().length < 10  ||  $("#exampleInputMobile1").val().length > 12){
            alertMessage('Error!', "Partner 1 Mobile Number Invalid.",'error', 'no');
        }else if($("#exampleInputGender1").val() == ""){
            alertMessage('Error!', "Partner 1 Gender Required.",'error', 'no');
        }else if($("#exampleInputAddress1").val() == ""){
            alertMessage('Error!', "Partner 1 Address Required.",'error', 'no');
        }else if($("#exampleInputCity1").val() == ""){
            alertMessage('Error!', "Partner 1 City Required.",'error', 'no');
        }else if($("#exampleInputState1").val() == ""){
            alertMessage('Error!', "Partner 1 State Required.",'error', 'no');
        }else if($("#exampleInputPincode1").val() == ""){
            alertMessage('Error!', "Partner 1 Pincode Required.",'error', 'no');
        }else if($("#exampleInputPincode1").val().length != 6){
            alertMessage('Error!', "Partner 1 Pincode Invalid.",'error', 'no');
        }else{
            $("#pancard_partner1").attr('disabled',true);
            if(kyc1_pancard_img.length > 0){
                $("#pancard_partner1").text('Verifying ..');
                let fd = new FormData();
                fd.append('kyc1_pancard_img',kyc1_pancard_img[0]);
                fd.append('kyc1_email',$("#exampleInputEmail11").val());
                fd.append('kyc1_mobile',$("#exampleInputMobile1").val());
                fd.append('kyc1_gender',$("#exampleInputGender1").val());
                fd.append('kyc1_address',$("#exampleInputAddress1").val());
                fd.append('kyc1_city',$("#exampleInputCity1").val());
                fd.append('kyc1_state',$("#exampleInputState1").val());
                fd.append('kyc1_pincode',$("#exampleInputPincode1").val());
                fd.append('_token','{{ csrf_token() }}');

                $.ajax({
                    url: "{{ route('webPancardPatnerOne') }}",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response){
                        $("#pancard_partner1").attr('disabled',false);
                        let outdata = response;
                        if(outdata.status){
                            $("#pancard_partner1").text('Verified');
                            alertMessage('Success !', outdata.msg,'success', 'no');
                        }else{
                            $("#pancard_partner1").text('Verify');
                            alertMessage('Error!', outdata.msg,'error', 'no');
                        }
                    },
                    error: function(response){
                        $("#pancard_partner1").attr('disabled',false);
                        $("#pancard_partner1").text('Verify');
                        alertMessage('Error!', JSON.stringify(response),'error', 'no');
                    }
                });
            }else{
                $("#pancard_partner1").attr('disabled',false);
            }
        }
    });

    $("#pancard_partner2").click(function(e){
        e.preventDefault();
       
        let kyc2_pancard_img = $('#kyc2_pancard_img')[0].files;
        if($("#pexampleInputEmail1").val() == ""){
            alertMessage('Error!', "Partner 2 Email Address Required.",'error', 'no');
        }else if($("#pexampleInputMobile").val() == ""){
            alertMessage('Error!', "Partner 2 Mobile Number Required.",'error', 'no');
        }else if($("#pexampleInputMobile").val().length < 10  ||  $("#pexampleInputMobile").val().length > 12){
            alertMessage('Error!', "Partner 2 Mobile Number Invalid.",'error', 'no');
        }else if($("#pexampleInputGender1").val() == ""){
            alertMessage('Error!', "Partner 2 Gender Required.",'error', 'no');
        }else if($("#exampleInputAddress").val() == ""){
            alertMessage('Error!', "Partner 2 Address Required.",'error', 'no');
        }else if($("#pexampleInputCity").val() == ""){
            alertMessage('Error!', "Partner 2 City Required.",'error', 'no');
        }else if($("#pexampleInputState").val() == ""){
            alertMessage('Error!', "Partner 2 State Required.",'error', 'no');
        }else if($("#pexampleInputPincode").val() == ""){
            alertMessage('Error!', "Partner 2 Pincode Required.",'error', 'no');
        }else if($("#pexampleInputPincode").val().length != 6){
            alertMessage('Error!', "Partner 2 Pincode Invalid.",'error', 'no');
        }else{
            $("#pancard_partner2").attr('disabled',true);
            if(kyc2_pancard_img.length > 0){
                $("#pancard_partner2").text('Verifying ..');
                let fd = new FormData();
                fd.append('kyc2_pancard_img',kyc2_pancard_img[0]);
                fd.append('_token','{{ csrf_token() }}');
                fd.append('kyc2_email',$("#pexampleInputEmail1").val());
                fd.append('kyc2_mobile',$("#pexampleInputMobile").val());
                fd.append('kyc2_gender',$("#pexampleInputGender1").val());
                fd.append('kyc2_address',$("#pexampleInputAddress").val());
                fd.append('kyc2_city',$("#pexampleInputCity").val());
                fd.append('kyc2_state',$("#pexampleInputState").val());
                fd.append('kyc2_pincode',$("#pexampleInputPincode").val());

                $.ajax({
                    url: "{{ route('webPancardPatnerTwo') }}",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response){
                        $("#pancard_partner2").attr('disabled',false);
                        let outdata = response;
                        if(outdata.status){
                            $("#pancard_partner2").text('Verified');
                            alertMessage('Success !', outdata.msg,'success', 'no');
                        }else{
                            $("#pancard_partner2").text('Verify');
                            alertMessage('Error!', outdata.msg,'error', 'no');
                        }
                    },
                    error: function(response){
                        $("#pancard_partner2").attr('disabled',false);
                        $("#pancard_partner2").text('Verify');
                        alertMessage('Error!', JSON.stringify(response),'error', 'no');
                    }
                });
            }else{
                $("#pancard_partner2").attr('disabled',false);
            }
        }
    });
</script>
@endpush