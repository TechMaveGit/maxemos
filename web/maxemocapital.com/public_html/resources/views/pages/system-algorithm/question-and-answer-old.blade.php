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

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
@endpush  

@section('content')

<div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><span class="user_name_title">Question & Answer</span></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">System User Management</li>
                                <li class="breadcrumb-item active">Question & Answer</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

<div class="page-header d-lg-flex d-block qandas_maintitle">
   <div class="page-leftheader">
      <div class="page-title">AdvanX Credit Algo</div>
   </div>

<div class="page-rightheader ms-md-auto">
   <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
      <div class="btn-list">
       <!-- <a href="javascript:void(0);" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#add_User_modal"><i data-feather="plus" class="btn-icon-prepend feather_iconfont"></i> Add New User</a> -->
       <!-- <a href="javascript:void(0);" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </a>
       <a href="javascript:void(0);" class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </a> <a href="javascript:void(0);" class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </a> -->
     </div>
   </div>
</div>
</div>

<section class="questionansser">
    <div class="row">
        <div class="col-lg-12">
            <div class="question_card card">
                <form action="">
                    <div class="row">
                    <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">1) Tenure</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> 
            <option value="" selected>Select</option>
            <option value="AC">3 Months</option>
            <option value="UN"> 6 Months </option>
            <option value="UN"> 9 Months </option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">2) Nature of Loan?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="AC">Unsecured</option>
            <option value="UN"> Secured </option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">3) Purpose of Loan</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Medical Emergency</option>
            <option value="2">  Education Fees </option>
            <option value="3">Wedding</option>
            <option value="4"> Household repair and maintenance </option>
            <option value="5">Consumer Durable</option>
            <option value="6">  Others</option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">4) Gender?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Male</option>
            <option value="2"> Female </option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">5) Age?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1"> Less than 21 years</option>
            <option value="2">  21 years to 35 years </option>
            <option value="3">  35 years to 45 years</option>
            <option value="4"> 45 years to 55 years</option>
            <option value="5">Above 55 years</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">6) Source of Application?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1"> Mobile App</option>
            <option value="2">   Web based Sourcing </option>
            <option value="3">   Telecalling</option>
            <option value="4">  Customer Referral</option>
            <option value="5"> Agent</option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">7) Nature of Application?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">  Employer Partner</option>
            <option value="2">   Retail</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">8) PAN Verification?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1"> Yes</option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">9) Form 60?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1"> Yes</option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">10) Aadhar Verification ?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1"> Yes</option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">11) Personal Discussion - Video KYC</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">  Positive</option>
            <option value="2">Negative</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">12) FCU Check ?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">  Positive</option>
            <option value="2">Negative</option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">13) Other active lending mobile apps?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">14) Nationality Indian ?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">15) Residential Address</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Preferred Location</option>
            <option value="2">Not Preferred Location</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">16) Ownership Status?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Rent </option>
            <option value="2">Owned</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">17) Family Status?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Married with children </option>
            <option value="2">Married without children</option>
            <option value="3">Married with children+Dependent Parents </option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">18) Marital Status?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Single  </option>
            <option value="2">Married</option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">19) No of members?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">< 4</option>
            <option value="2">> 4</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">20) No of dependent members?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">< 2</option>
            <option value="2">> 2</option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">21) Education?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Under Matriculate</option>
            <option value="2">Matriculate</option>
            <option value="3">Graduate</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">22) Employment Background & Verification Status</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Positive </option>
            <option value="2">Matriculate</option>
            <option value="3">Negative</option>
          </select>
        </div>
 </div>


 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">23) Income Validation ?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">24) Payroll Status (Incase of Partner Employer)?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Active </option>
            <option value="2">Resigned</option>
            <option value="2">Terminated</option>
            
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">25) Work Address</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Preferred Location </option>
            <option value="2">Not Preferred Location</option>
            
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">26) Job Stability </label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Less than 1 year</option>
            <option value="2">1 year to 3 years</option>
            <option value="3">3 year to 5 years </option>
            <option value="4">Above 5 years</option>
            
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">27) Overall Experience </label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Less than 5 years </option>
            <option value="2">More than 5 years</option>
            
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">28) Nature of Job </label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Permanent  </option>
            <option value="2">Temporary</option>
            
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">29)  Skill Level </label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Skilled   </option>
            <option value="2">Semi Skilled</option>
            <option value="3">Unskilled</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">30)  Skill Level </label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">100000 to 180000   </option>
            <option value="2">180000 to 300000</option>
            <option value="3">More than 300000</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">31)  Salary Slip for last 3 months </label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">32) Mode of Salary/Wages payment </label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Cash </option>
            <option value="2">Bank Credit</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">33) ITR Filing Status</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">34) Income Validation through EPFO Check</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">35) Eligibility: DSCR (Proposed Loan EMI + other financial commitment)</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1"> </option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">36) One live loan</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">37) Application Previously Rejected</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">38) Current Overdue </label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1"> Write-off, suit-filed settled, wilful Default, restructured in last 24 Months. </option>
            <option value="2">Doubtful/ Substandard/ LSS/SMA in last 24 Months</option>
            <option value="3">60+DPDs in last 12 months </option>
            <option value="4">30+DPD in last 6 months.</option>
            <option value="5"> 15+DPD on term loan in last 3 months with >Rs 1000 overdue.</option>
            <option value="6">Current Overdue for an amount exceeding Rs. 1k.</option>
            <option value="7">Lie PL>=2 to be excluded.</option>
            <option value="8">If >6 enquires (all products) in last 3 months. </option>
            <option value="9">Recent PL>1 in last 3 months to be excluded</option>
            <option value="10">None</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">39) Score Benchmarking</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Below 600 - Poor </option>
            <option value="2">600-650 Average</option>
            <option value="3">650-700 Above average </option>
            <option value="4">700-750 good</option>
            <option value="5">Above 750 excellent </option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">40) SMS Sparsing for income verification?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">41) Bill details</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">42) Banking & Credit History Analysis?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">43) Bank Statement Analysis?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>
<!-- title here for Corporate - Partner Employer Profiling -->

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">44) Name of the Corporate</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">ABCD Limited </option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">45) Nature of Constitution ?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Proprietorship</option>
            <option value="2">Partnership </option>
            <option value="3">Private Limited</option>
            <option value="4">Public Limited</option>
            <option value="5">Government Entity </option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">46) Empanelment Status with AdvanX?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">47) Nature of Industry?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Chemical and Pharmaceutical Industry </option>
            <option value="2">Banking Industry</option>
            <option value="3">Automotive & Ancillary Sector</option>
            <option value="4">Road and Construction Sector</option>
            <option value="5">Logistics</option>
            <option value="6">Hospitality</option>
            <option value="7">Healthcare & Hospitals</option>
            <option value="8">Paper</option>
            <option value="9">Electricals and Electronics</option>
            <option value="10">Others</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">47) Negative Industry Profile ?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Yes </option>
            <option value="2">No</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">48) Business Activity ?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Trader </option>
            <option value="2">Manufacturer</option>
            <option value="3">Services</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">49) Turnover Size?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Less than 500 crores </option>
            <option value="2">more than 500 crores</option>
          </select>
        </div>
 </div>
 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">50) Credit Rating?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">A+and above </option>
            <option value="2">A- to A</option>
            <option value="3">BBB- to BBB+</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">51) Number of Employees?</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">Less than 500 </option>
            <option value="2">More than 500</option>
          </select>
        </div>
 </div>

 <div class="col-lg-4 question_start">
 <div class="form-group">
          <label class="form-label">53) Attrition Risk</label>
          <select class="js-example-basic-single2 form-select" data-width="100%"> <option value="" selected>Select</option>
            <option value="1">High</option>
            <option value="2">Medium</option>
            <option value="3">Low</option>
          </select>
        </div>
 </div>

</div>

<div class="modal-footer mt-3">
              <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
              <a href="question-and-answer"><button type="button" class="btn btn-primary">Save changes</button></a>
            </div>
 
                </form>
            </div>
        </div>
    </div>
</section>




@endsection


@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush

<!-- form elements -->

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


@push('plugin-scripts')
  <script>
    var varyingModal = document.getElementById('varyingModal')
    varyingModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = varyingModal.querySelector('.modal-title')
      var modalBodyInput = varyingModal.querySelector('.modal-body input')

      modalTitle.textContent = 'New message to ' + recipient
      modalBodyInput.value = recipient
    })
  </script>
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
@endpush