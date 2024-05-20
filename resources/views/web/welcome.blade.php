@extends('web.layout.main')
@section('content')
<style>
    .userpimg img{
        width: 32px;
        height: 32px;
    }
</style>

<section class="banner__area">

    

    <div class="bannermain_box">
    <div class="container">
 <div class="row">
    <div class="col-lg-8">
    <div class="bannerBlock innerBanner includeForm">
      <div class="bannerContent">
         <div class="titleBlock">
            <h1 class="h1">Boost your working capital needs with 
<span class="span">Maxemo Capital</span></h1>
            <h2 class="h2">We are one stop solution for all your financing needs.</h2>
         </div>

         <div class="lits__loansbanner">
            <ul>
                <li><a href="{{route('WebBusinessLoan')}}"><img src="{{asset('assets/web')}}/asset/img/newimages/business-loan1.png" alt=""> Business Loan</a></li>
                <li><a href="{{route('WebPersonalLoan')}}"><img src="{{asset('assets/web')}}/asset/img/newimages/raw-material.png" alt=""> Personal loan</a></li>
                <li><a href="{{route('WebRawLoan')}}"><img src="{{asset('assets/web')}}/asset/img/newimages/working-capital-loan.png" alt=""> Raw Material Financing</a></li>
                <li><a href="{{route('WebReceivableLoan')}}"><img src="{{asset('assets/web')}}/asset/img/newimages/receivables-financing.png" alt=""> Receivables Invoicing</a></li>
            </ul>
         </div>

         
         <div class="welcome-button btnbanner_np" data-animation-in="fadeInDown" data-animation-out="animate-out fadeOutDown">
            <a href="{{ auth()->check() && auth()->user()->userType == 'user'  ? route('applyNow') : route('webUserLogin')}}" class="btn btn-default button-primary">Apply Loan</a>
            <a href="https://wa.me/+918929723334" class="btn wp-btn"><img src="{{asset('assets/web')}}/asset/img/newimages/whatsapp-icon.png" alt=""> Chat With Us</a>
        </div>

       
      </div>
      
   </div>

   
    </div>

    <div class="col-lg-4">
        <div class="rightban_form">
        <form action="{{ route('contactdata') }}" method="POST">@csrf
        <div class="row">
            <div class="col-lg-12">
            <div class="form-group">
            <label for="exampleInputEmail1">Name @error('name')
                <span class="text-danger"> # {{ $message }}</span>
                @enderror</label>
            <input type="text" class="form-control" id="" name="name" value="@if(old('name')) {{old('name')}} @else {{ auth()->user() &&  auth()->user()->name ? auth()->user()->name : '' }} @endif" aria-describedby="">
            
        </div>
            </div>
        <div class="col-lg-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Phone @error('phone')
                <span class="text-danger"> # {{ $message }}</span>
                @enderror</label>
            <input type="tel" class="form-control" id="" value="@if(old('phone')){{old('phone')}}@else {{ auth()->user() &&  auth()->user()->mobile ? auth()->user()->mobile : '' }} @endif" name="phone" aria-describedby="">
            
        </div>
        </div>
        <div class="col-lg-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Email @error('email')
                <span class="text-danger"> # {{ $message }}</span>
                @enderror</label>
            <input type="email" class="form-control" value="@if(old('email')) {{old('email')}} @else {{ auth()->user() &&  auth()->user()->email ? auth()->user()->email : '' }} @endif" id="" name="email" aria-describedby="emailHelp">
            
        </div>
        </div>


        <div class="col-lg-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Message @error('message')
                <span class="text-danger"> # {{ $message }}</span>
                @enderror</label>
            <textarea  class="form-control" id="" name="message" aria-describedby="" rows="3">{{old('message')}}</textarea>
            
        </div>
        </div>

        </div>

  <button type="submit" class="btn btn-primary btnform_bsubmit">Submit</button>
</form>

        </div>
        <!-- <div class="banner_rightimg">
            <img src="{{asset('assets/web')}}/asset/img/newimages/bannerimg-r.png" alt="">
        </div> -->
    </div>
 </div>
</div>

<div class="feature">
       <div class="container">
        <h5>Our Features</h5>
        <p class="w-50 feature_description_">Maxemo offers a plethora of solutions and all solutions
            offer the following features that help MSME's achieve
            highest growth potentials with minimum finance costs.</p>
            <div class="feature_slider">
                <!-- <div class="slide_box">
                    <div class="inner_slider gradient1">
                        <div class="content">
                        <h1>NO HIDDEN COSTS</h1>
                        <p>Maxemo offers a plethora of solutions and all solutions
offer the following features that help MSME's achieve
highest growth potentials with minimum finance costs.</p> 
                        </div>
                        <div class="feature_img">
                            <img src="{{asset('assets/web')}}/asset/img/newimages/immediate-access-funds.png" alt="">
                        </div>
                    </div>
                   </div> -->
                <div class="slide_box">
                     <div class="inner_slider gradient2">
                        <div class="content">
                        <h1>SHORT TERM FINANCING</h1>
                        <p>Avail short term financing limits
and loans starting from 3 months
and going upto one year.</p> 
                        </div>
                        <div class="feature_img">
                            <img src="{{asset('assets/web')}}/asset/img/newimages/short-term.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="slide_box">
                    <div class="inner_slider gradient3">
                        <div class="content">
                        <h1>UPTO 60 LAKHS*</h1>
                        <p>Avail financing upto 60 lakhs
based on choice of product and
credit appraisal.</p> 
                        </div>
                        <div class="feature_img">
                            <img src="{{asset('assets/web')}}/asset/img/newimages/cash-flow12.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="slide_box">
                    <div class="inner_slider gradient4">
                        <div class="content">
                        <h1>EASY KYC</h1>
                        <p>Self origination from equipped
with automated KYC for instant
approval and disbursal</p> 
                        </div>
                        <div class="feature_img">
                            <img src="{{asset('assets/web')}}/asset/img/newimages/down-intrestrate.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="slide_box">
                    <div class="inner_slider gradient5">
                        <div class="content">
                        <h1>FLEXIBLE REPAYMENTS</h1>
                        <p>Multiple tenure options are
available for ease of repayment
that can be customised to
convenience.</p> 
                        </div>
                        <div class="feature_img">
                            <img src="{{asset('assets/web')}}/asset/img/newimages/hassle2.png" alt="">
                        </div>
                    </div>
                </div>

                <div class="slide_box">
                    <div class="inner_slider gradient5">
                        <div class="content">
                        <h1>NO PREPAYMENT/EXTRA
CHARGES</h1>
                        <p>No prepayment or preclosure or
committment charges are
places. You pay for the money,
for the duration used.</p> 
                        </div>
                        <div class="feature_img">
                            <img src="{{asset('assets/web')}}/asset/img/newimages/nofee-hidden.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
    </div>



    </section>

     
    <section class="services_yopcards" id="hm__services__cards">
        <div class="container">
        <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title sec_titleprdf" id="section_heading">
                        <span>Products We Offers</span>
                        <h2>Working Capital Finance </h2>
                        <p>Provides new-age customized financing
products for your business needs</p>
                    </div>
                </div>
            </div>

            <div class="row loancards_rownpj">
   <div class="col-12 col-md-6 col-lg-3">
      <div class="cs-services-list__item  bottom-to-top animated is-active" data-cs-st="bottom-to-top" data-cs-de="250" data-cs-du="700" style="animation-duration: 700ms; transition-duration: 700ms; animation-delay: 250ms; transition-delay: 250ms;">
         <div class="cs-services-list__bg" style="color: #737de8"></div>
         <div class="cs-services-list__shadows"></div>
         <div class="cs-services-list__count">1</div>
         <div class="cs-services-list__icon" style="color: #737de8">
         <div class="icon">
                                <img src="{{asset('assets/web')}}/asset/img/newimages/icon2.png" alt="">
                            </div>
            <span></span>
         </div>
         <h5 class="cs-services-list__title">Business Loan</h5>
         <div class="cs-services-list__content"><p>Businesses require an adequate amount of capital...</p>
         </div>
         <div class="viewmore_content">
            <a href="{{route('WebBusinessLoan')}}">View More</a>
         </div>
      </div>
   </div>
   <div class="col-12 col-md-6 col-lg-3">
      <div class="cs-services-list__item  bottom-to-top animated is-active" data-cs-st="bottom-to-top" data-cs-de="250" data-cs-du="700" style="animation-duration: 700ms; transition-duration: 700ms; animation-delay: 250ms; transition-delay: 250ms;">
         <div class="cs-services-list__bg" style="color: #737de8"></div>
         <div class="cs-services-list__shadows"></div>
         <div class="cs-services-list__count">2</div>
         <div class="cs-services-list__icon" style="color: #737de8">
         <div class="icon">
                                <img src="{{asset('assets/web')}}/asset/img/newimages/icon1.jpg" alt="">
                            </div>
            <span></span>
         </div>
         <h5 class="cs-services-list__title">Personal Loan</h5>
         <div class="cs-services-list__content"><p>A multipurpose consumer loan which you can use to...</p>
         </div>
         <div class="viewmore_content">
            <a href="{{route('WebPersonalLoan')}}">View More</a>
         </div>
      </div>
   </div>
   <!-- <div class="col-12 col-md-6 col-lg-3">
      <div class="cs-services-list__item bottom-to-top animated" data-cs-st="bottom-to-top" data-cs-de="500" data-cs-du="700" style="animation-duration: 700ms; transition-duration: 700ms; animation-delay: 500ms; transition-delay: 500ms;">
         <div class="cs-services-list__bg" style="color: #46d599"></div>
         <div class="cs-services-list__shadows"></div>
         <div class="cs-services-list__count">2</div>
         <div class="cs-services-list__icon" style="color: #46d599">
         <div class="icon"></div>
                                <img src="{{asset('assets/web')}}/asset/img/newimages/icon1.jpg" alt="">
                            </div>
            <span></span>
         </div>
         <h5 class="cs-services-list__title">Personal Loan</h5>
         <div class="cs-services-list__content"><p>A multipurpose consumer loan which you can use to...</p>
         </div>
         <div class="viewmore_content">
            <a href="{{route('WebPersonalLoan')}}">View More</a>
         </div>
      </div> -->
   
   <!-- <div class="col-12 col-md-6 col-lg-3">
      <div class="cs-services-list__item bottom-to-top is-active animated" data-cs-st="bottom-to-top" data-cs-de="750" data-cs-du="700" style="animation-duration: 700ms; transition-duration: 700ms; animation-delay: 750ms; transition-delay: 750ms;">
         <div class="cs-services-list__bg" style="color: #2ac6ff"></div>
         <div class="cs-services-list__shadows"></div>
         <div class="cs-services-list__count">3</div>
         <div class="cs-services-list__icon" style="color: #2ac6ff">
         <div class="icon">
                                <img src="{{asset('assets/web')}}/asset/img/newimages/icon3.webp" alt="">
                            </div>
            <span></span>
         </div>
         <h5 class="cs-services-list__title">Working Capital</h5>
         <div class="cs-services-list__content"><p>Working capital financing lets firms fulfil their...</p>
         </div>
         <div class="viewmore_content">
            <a href="{{route('WebRawLoan')}}">View More</a>
         </div>
      </div>
   </div> -->
   <div class="col-12 col-md-6 col-lg-3">
      <div class="cs-services-list__item bottom-to-top is-active animated" data-cs-st="bottom-to-top" data-cs-de="1000" data-cs-du="700" style="animation-duration: 700ms; transition-duration: 700ms; animation-delay: 1000ms; transition-delay: 1000ms;">
         <div class="cs-services-list__bg" style="color: #737de8"></div>
         <div class="cs-services-list__shadows"></div>
         <div class="cs-services-list__count">4</div>
         <div class="cs-services-list__icon" style="color: #737de8">
         <div class="icon">
         <img src="{{asset('assets/web')}}/asset/img/newimages/icon4.webp" alt="">
                            </div>
            <span></span>
         </div>
         <h5 class="cs-services-list__title">Raw Material Financing</h5>
         <div class="cs-services-list__content"><p>Raw material financing is a type... </p> </div>
         <div class="viewmore_content">
            <a href="{{route('WebRawLoan')}}">View More</a>
         </div>
        </div>
   </div>
   <div class="col-12 col-md-6 col-lg-3">
      <div class="cs-services-list__item bottom-to-top is-active animated" data-cs-st="bottom-to-top" data-cs-de="1000" data-cs-du="700" style="animation-duration: 700ms; transition-duration: 700ms; animation-delay: 1000ms; transition-delay: 1000ms;">
         <div class="cs-services-list__bg" style="color: #737de8"></div>
         <div class="cs-services-list__shadows"></div>
         <div class="cs-services-list__count">5</div>
         <div class="cs-services-list__icon" style="color: #737de8">
         <div class="icon">
         <img src="{{asset('assets/web')}}/asset/img/newimages/icon5.webp" alt="">
                            </div>
            <span></span>
         </div>
         <h5 class="cs-services-list__title">Receivables Invoicing </h5>
         <div class="cs-services-list__content"><p>The basic process of a receivables invoicing loan...</p> </div>
         <div class="viewmore_content">
            <a href="{{route('WebReceivableLoan')}}">View More</a>
         </div>
        </div>
   </div>
</div>
</div>
        </div>
    </section>

    <div id="projectFacts" class="sectionClass">
    <div class="fullWidth eight columns">
        <div class="projectFactsWrap ">
            <div class="item" data-number="820">
                <div class="box_count">
                <h2 id="number1" class="number">820 </h2>
                <span>+</span>
                
            </div>
              
                <p>Clients</p>
                <span class="line"></span>
            </div>
            <div class="item" data-number="60">
            <div class="box_count">
                <h2 id="number2" class="number">60</h2>
                <span> Cr</span>
  
            </div>
               
                <p>Disbursed</p>
                <span class="line"></span>
            </div>
            <div class="item" data-number="1800" >
               <div class="box_count">
                 <h2 id="number3" class="number">1,600 </h2>
                <span>+</span>
                
               </div>
             
                <p>Applications</p>
                <span class="line"></span>
            </div>
            <!-- <div class="item wow fadeInUpBig animated animated" data-number="246" style="visibility: visible;">
                <i class="fa fa-camera"></i>
                <p id="number4" class="number">246</p>
                <span></span>
                <p>Photos taken</p>
            </div> -->
     </div>
    </div>
</div>
    <!-- start second about area -->
    <section class="second-about-area boostybusiness">
        <div class="container">
            <div class="row row__aligncenter justify-content-between">
                <div class="col-md-12 col-lg-6">
                    <div class="second-about-content">
                        <h2>Boost your business with maxemo </h2>
                        {{-- <p>Are you looking for a loan, mortgage, or lіnе оf credit? You are in the right place.</p> --}}
                        <p>Maxemo understands that keeping a business up and running is challenging. It’s hard to manage so many things happening at one place, with several sources receiving and giving out payments. These are just a handful of things counted of what goes inside a business, financially. So, we provide customised solutions, quick approvals & disbursals to help all businesses, whether small or large, tackle financial challenges with confidence.</p>
                       
                        <!-- <div class="about-cradit-list">
                        <h2>Our Features</h2>
                        <ul>
                            <li>Immediate access to funds</li>
                            <li>No collateral</li>
                            <li>Improved your cash flow</li>
                            <li>Attractive interest rate</li>
                            <li>Hassle free loan</li>
                        </ul>
                    </div> -->
                        <a href="{{route('WebContact')}}" class="btn btn-default btn-sm abt_contbtn">CONTACT US</a>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                     <div class="max_videosec">
                        <img src="{{asset('assets/web')}}/asset/img/newimages/loanbusiness.jpg" alt="">
                     </div>
                </div>
            </div>
            <!-- <div class="second-brand-slider brand-slider-two owl-carousel">
                <div class="single-brand">
                    <img src="{{asset('assets/web')}}/asset/img/brand-6.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="{{asset('assets/web')}}/asset/img/brand-7.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="{{asset('assets/web')}}/asset/img/brand-8.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="{{asset('assets/web')}}/asset/img/brand-9.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="{{asset('assets/web')}}/asset/img/brand-10.png" alt="">
                </div>
            </div> -->
        </div>
    </section>

    <!-- <section class="third-about-us section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="single-third-about-us topimage">
                        <div class="about-thumb">
                            <img src="{{asset('assets/web')}}/asset/img/portfolio-1.jpg" alt="">
                        </div>
                        <h2>Why Choose Us</h2>
                        <p>If уоu’rе іn thе mаrkеt for a lоаn, wе encourage уоu to gіvе uѕ a саll оr come іn fоr a сhаt. If уоu prefer tо соmmunсtе еlесtrоnісаllу, рlеаѕе fіll оut thіѕ оntсt fоrm, and a bank rерrееntаtіvе wіll gеt n tоuh wіth уоu shortly. At Lоаnрluѕ, wе undеrѕtаnd thе lосаl аnd іntеrnаtіоnаl mаrkеt аnd wе саrе аbut оur сuѕtоmеrѕ.</p>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="single-third-about-us bottomimage">
                        <h2>Our loan Advisor specialist</h2>
                        <p>We understand that we аr ореrtіng in a dynamic environment аnd hаvе evolved our strategy tо maximize the opportunity іn аn іnсrеаѕіnglу digital global world. Wіth our full wоrldwіdе network, wе are еvоlvіng tо mееt thе changing nееdѕ оf millions of сuѕtоmеrѕ асrоѕѕ different borders.</p>
                        <div class="about-thumb">
                            <img src="{{asset('assets/web')}}/asset/img/portfolio-2.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- end of second about area -->
    <!-- start loan options checking section -->
    <section class="loan-options-checking">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 checkingbg1 text-center">
                    <div class="single-loan-checking-options">
                        <div class="icon">
                            <img src="{{asset('assets/web')}}/asset/img/edom.png" alt="">
                        </div>
                        <div class="content">
                            <h4>Receive Funds</h4>
                            <p>Get disbursements within <br> 2 days of sanction</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 checkingbg2 text-center">
                    <div class="single-loan-checking-options">
                        <div class="icon">
                            <img src="{{asset('assets/web')}}/asset/img/document.png" alt="">
                        </div>
                        <div class="content">
                            <h4>Less Documents</h4>
                            <p>We will evaluate your application and <br> propose a fair sanction</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 checkingbg3 text-center">
                    <div class="single-loan-checking-options">
                        <div class="icon">
                            <img src="{{asset('assets/web')}}/asset/img/bripcase.png" alt="">
                        </div>
                        <div class="content">
                            <h4>Submit Application</h4>
                            <p>Complete a 100% online <br> application form</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of loan options checking section -->
    
    <!-- .start loan process second -->
    <section class="second-loan-process section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title" id="section_heading">
                        <h2>Fast & Easy Application Process</h2>
                        {{-- <p>Suspendisse aliquet varius nunc atcibus lacus sit amet coed portaeri sque mami luctus viveed congue lobortis faucibus.</p> --}}
                    </div>
                </div>
            </div>
            <div class="row process-list">
                <div class="col-md-3 second-process">
                    <div class="second-single-loan-process">
                        
                        <div class="icon process_step_ico">
                            <img src="{{asset('assets/web')}}/asset/img/newimages/ico1.png" alt="">
                        </div>
                        <h4>Choose Amount</h4>
                    </div>
                </div>
                <div class="col-md-3 second-process">
                    <div class="second-single-loan-process">
                      
                        <div class="icon process_step_ico">
                        <img src="{{asset('assets/web')}}/asset/img/newimages/ico2.png" alt="">
                        </div>
                        <h4>Provide Document</h4>
                    </div>
                </div>
                <div class="col-md-3 second-process">
                    <div class="second-single-loan-process">
                       
                        <div class="icon process_step_ico">
                        <img src="{{asset('assets/web')}}/asset/img/newimages/ico3.png" alt="">
                        </div>
                        <h4>Approved Loan</h4>
                    </div>
                </div>
                <div class="col-md-3 second-process">
                    <div class="second-single-loan-process">
                        
                        <div class="icon process_step_ico">
                        <img src="{{asset('assets/web')}}/asset/img/newimages/ico4.png" alt="">
                        </div>
                        <h4>Get your Money</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of loan process two -->

    <!-- .start check your rate button -->
    
    <!-- end of check your rate button -->
    <!-- start services section -->
   
    <!-- end of services section -->
    <!-- start calculator  -->
   
    <!-- end of calculator -->
    <!-- start dream quote  -->
    <!-- <section class="dream-quote section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="dream-quote-text">
                        
                        <h2>Make any dream a reality with one
<br>of our loan plans</h2>
                        <a href="{{route('WebBusinessLoan')}}" class="btn btn-default btn-sm">OUR SERVICES</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- end of dream quote -->
    <!-- start customer faq section -->
    <section class="custom-faq section-padding" id="faq_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title sec_heading_space" id="section_heading">
                    <!-- <span>Faq's</span> -->
                        <h2>Frequently Asked Questions</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-pills mb-3 faq_tab_ul" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Business Loan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Personal Loan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Working Capital Loan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-vpc-tab" data-toggle="pill" href="#pills-vpc" role="tab" aria-controls="pills-vpc" aria-selected="false">Raw material financing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-receive-tab" data-toggle="pill" href="#pills-receive" role="tab" aria-controls="pills-receive" aria-selected="false">Receivables Financing</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content faq_tab" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="accordion">
                                                                  
                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What is a business loan?
</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>A business loan is a type of loan provided by financial institutions, such as banks and credit unions, to businesses that need funds to finance their activities.</p>
                                </div>
                                </div>
                                                                  
                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Who can apply for a business loan?<span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Small-business owners, partnerships, or corporations can apply for a business loan.</p>
                                </div>
                                </div>
                                                                  
                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What is the interest rate on a business loan?<span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The interest rate on a business loan varies depending on factors such as the lender, the creditworthiness of the borrower, and the type of loan.</p>
                                </div>
                                </div>
                                                                  
                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">How much can I borrow through a business loan?<span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The amount you can borrow through a business loan varies depending on factors such as your creditworthiness, the purpose of the loan, and the size and profitability of your business.</p>
                                </div>
                                </div>
                                                                  
                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What can I use a business loan for?<span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Business loans are typically used to finance various aspects of a business, such as purchasing equipment, hiring employees, expanding operations, or covering short-term cash flow needs.</p>
                                </div>
                                </div>

                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What are the types of business loans available?<span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The types of business loans available include term loans, lines of credit, invoice financing, equipment financing, SBA loans, and more.</p>
                                </div>
                                </div>

                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">How long does it take to get approved for a business loan?<span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The time it takes to get approved for a business loan varies depending on many factors such as the application process, and the complexity of the loan. It can take anywhere from a few days to a few weeks.</p>
                                </div>
                                </div>

                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Do I need collateral to get a business loan?<span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>It depends on the type of loan. Some loans may require collateral while others may not.</p>
                                </div>
                                </div>

                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What are the repayment terms for a business loan?<span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The repayment terms for a business loan can range from a few months to several years, with interest rates and payment amounts varying accordingly.</p>
                                </div>
                                </div>
                                

                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">How do I apply for a business loan?<span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>To apply for a business loan, you need to gather necessary documents, complete the application process, and wait for approval. The application process typically involves filling out an application form, submitting financial statements, and providing collateral if necessary. Click on apply loan to know more.</p>
                                </div>
                                </div>
                            
                            
                            
                            </div>

                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="accordion">
                                                            <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What is a personal loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>A personal loan is a type of loan that you can take out from a bank or a financial institution to cover various expenses, such as medical bills, home renovation, wedding expenses or vacations. Unlike secured loans, like car loans, personal loans do not require collateral.</p>
                                </div>
                                </div>


                                 <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">How much can I borrow with a personal loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>: The amount you can borrow with a personal loan varies on your credit score, it can range from anywhere between 2 lakhs to 30 lakhs.</p>
                                </div>
                                </div>

                                  <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What is the interest rate for a personal loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The interest rate for a personal loan varies depending on your credit score and other related documents. Click on apply loan to know your eligibility and interest rate offered.</p>
                                </div>
                                </div>

                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">How do I apply for a personal loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>To apply for a personal loan, you need to apply loan from our website, fill application form, provide documentation like proof of income, employment, and identification, and wait for approval.</p>
                                </div>
                                </div>

                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">How long does it take to get approved for a personal loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The time it takes to get approved for a personal loan varies depending on your creditworthiness and documents uploaded.</p>
                                </div>
                                </div>

                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What is the repayment term for a personal loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The repayment term for a personal loan typically ranges from few months to 3 years but may vary depending on the tenure applied and loan amount.</p>
                                </div>
                                </div>

                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Can I use a personal loan for anything?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Yes, you can use a personal loan for almost anything, such as home remodels, car repairs or purchases, weddings, vacations, medical bills, or debt consolidation.</p>
                                </div>
                                </div>

                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Can I repay the personal loan early?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Yes, you can repay a personal loan early. However, some we may charge a prepayment penalty. Please go through ourloan agreement carefully and understand the terms and conditions of early repayment.</p>
                                </div>
                                </div>

                                


                                
                            </div>
                        
                        </div>

                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="accordion">
                                                            <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What is a working capital loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>A working capital loan is a type of business loan that provides funding to cover the day-to-day operational expenses of a company, such as payroll, inventory, rent, and utility bills.</p>
                                </div>
                                </div>

                              <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">How much working capital can I borrow?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The amount of working capital you can borrow depends on your business needs. </p>
                                </div>
                                </div>


                              
                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What are the eligibility requirements for a working capital loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Eligibility requirements for a working capital loan will require you to have good credit, a steady stream of revenue, and a business plan.</p>
                                </div>
                                </div>


                                   <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Can I use a working capital loan for any business expenses?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Yes, you can use a working capital loan for any business expenses, including payroll, rent, inventory, marketing, and equipment purchases.</p>
                                </div>
                                </div>
                                                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-vpc" role="tabpanel" aria-labelledby="pills-vpc-tab">
                        <div class="accordion">
                                                            <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What is raw material financing?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Raw material financing is a type of financing that is used to support the acquisition of raw materials that are required for manufacturing or producing goods.</p>
                                </div>
                                </div>
                                                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Who is eligible for raw material financing?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Usually, manufacturers, traders and retailers who need raw materials to produce goods are eligible for raw material financing.</p>
                                </div>
                                </div>
                                                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title"> What are the benefits of raw material financing?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Raw material financing provides a number of benefits, including the ability to purchase raw materials in bulk, which can result in cost savings, improved cash flow, and increased production capacity.</p>
                                </div>
                                </div>


                                 <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What types of raw materials can be financed?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Raw materials that can be financed include but are not limited to, plastics, metals, minerals, chemicals, agricultural commodities, and textiles.</p>
                                </div>
                                </div>

                                
                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What is the repayment term for raw material financing?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The repayment term for row material financing depends on the working capital cycle of the borrower.</p>
                                </div>
                                </div>
                                                                
                                </div>
                        </div>

                        <div class="tab-pane fade" id="pills-receive" role="tabpanel" aria-labelledby="pills-receive-tab">
                        <div class="accordion">
                                                            <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What is the Receivables Financing loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The Receivables Invoicing loan is a type of loan that allows businesses to use their unpaid invoices as collateral to secure financing.</p>
                                </div>
                                </div>
                                                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Who is eligible for a Receivables Invoicing loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Businesses that have unpaid invoices from creditworthy customers are typically eligible for a Receivables Invoicing loan.</p>
                                </div>
                                </div>

                                  <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">What are the benefits of a Receivables Invoicing loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>The benefits of a Receivables Invoicing loan include improved cash flow, the ability to access financing without using personal assets as collateral, and the ability to manage cash flow more effectively.</p>
                                </div>
                                </div>
                                                                <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">How long does it take to receive funding from a Receivables Invoicing loan?</span><span class="icon" aria-hidden="true"></span></button>
                                <div class="accordion-content">
                                    <p>Funding can typically be received within a few days after the maxemo team has received and processed the required documentation.
                                </p>
                                </div>
                                </div>
                                                                
                                                            </div>
                        </div>


                    </div>
                    <div class="view_more_btn_or_less_box text-end">
                    <a href="javascript:void(0);" class="view_more_btn">View More</a>
                    </div>
                    
                </div>
            </div>
          
        </div>
    </section>
    <!-- end of customer faq section -->

            <section class="chs_testimonial__">
            <span>What Client Say About Us?</span>
  <h1>testimonials</h1>
  <div class="cards">
    <div class="card active" data-id="content1">
      <img src="{{asset('assets/web')}}/asset/img/newimages/1.png" alt="">
      <div>
        <h3>Sanjeev</h3>
        <p>Style my home business</p>
      </div>
      <div class="gradient"></div>
    </div>
    <div class="card" data-id="content2">
      <img src="{{asset('assets/web')}}/asset/img/newimages/2.png" alt="">
      <div>
        <h3>Kapil Sharma</h3>
        <!-- <p>sales manager, slack</p> -->
      </div>
      <div class="gradient"></div>
    </div>
    <div class="card" data-id="content3">
      <img src="{{asset('assets/web')}}/asset/img/newimages/3.png" alt="">
      <div>
        <h3>Rajat Oberoi</h3>
        <!-- <p>sales manager, slack</p> -->
      </div>
      <div class="gradient"></div>
    </div>
  </div>
  <div class="content">
    <div class="contentBox active" id="content1">
      <div class="text">
        <h2>Sanjeev</h2>
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
        </span>
        <p>My wife & I started an e-Commerce business a few years back. At every growth stage, there’s cash flow obstacle since its capital intensive and payment cycles are long. We tried to raise funds through Banks but it was a clumsy experience even with a Cibil score of above 750. Their checklist does not suit a new Business.</p>
        <p>That’s where Maxemo attempted to understand our Business model and offered a customized plan that suits our payment cycle and that too at competitive costs.</p>
        <p>Frankly, now I can focus more on creating value & growth in my Business.</p>
      </div>
    </div>
    <div class="contentBox" id="content2">
      <div class="text">
        <h2>Kapil Sharma</h2>
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
        </span>

        <p>Maxemo has helped us unlock the potential of our business receivables by shortening our cash-to-cash cycle and allowing us to work more efficiently as business owners.”</p>

      </div>
    </div>
    <div class="contentBox" id="content3">
      <div class="text">
        <h2>
        Rajat Oberoi</h2>
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
        </span>
        <p>When it comes to investing, my main concerns are that my money will be safe and that I will receive a reasonable return.And Maxemo has delivered on that promise.The investment period with Maxemo is substantially shorter, which means your money isn’t locked up for as long and you have more liquidity.</p>

      </div>
    </div>
  </div>
</section>

       
            <!-- <div class="second-testimonial-slider owl-carousel">
                <div class="second-single-testimonial">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-12">
                            <div class="left-qoute"></div>
                            <p>“ 

My wife & I started an e-Commerce business a few years back. At every growth stage, there’s cash flow obstacle since its capital intensive and payment cycles are long. We tried to raise funds through Banks but it was a clumsy experience even with a Cibil score of above 750. Their checklist does not suit a new Business.

That’s where Maxemo attempted to understand our Business model and offered a customized plan that suits our payment cycle and that too at competitive costs.

Frankly, now I can focus more on creating value & growth in my Business.
”</p>

<div class="client_tesi_img">
                                <img src="{{asset('assets/web')}}/asset/img/newimages/1.png" alt="">
                            </div>

                            <div class="testimonaol-info">
                                <h4>Sanjeev</h4>
                          
                            </div>
                        </div>
                    </div>
                </div>
                <div class="second-single-testimonial">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-12">
                            <div class="left-qoute">“</div>
                            <p>“ Maxemo has helped us unlock the potential of our business receivables by shortening our cash-to-cash cycle and allowing us to work more efficiently as business owners.”</p>
                           
                            <div class="client_tesi_img">
                                <img src="{{asset('assets/web')}}/asset/img/newimages/2.png" alt="">
                            </div>
                           
                            <div class="testimonaol-info">
                                <h4>Kapil Sharma</h4>
                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="second-single-testimonial">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-12">
                            <div class="left-qoute"></div>
                            <p>“ When it comes to investing, my main concerns are that my money will be safe and that I will receive a reasonable return.And Maxemo has delivered on that promise.The investment period with Maxemo is substantially shorter, which means your money isn’t locked up for as long and you have more liquidity.”</p>
                            
                            <div class="client_tesi_img">
                                <img src="{{asset('assets/web')}}/asset/img/newimages/3.png" alt="">
                            </div>
                            <div class="testimonaol-info">
                                <h4>Rajat Oberoi</h4>
                         
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->








    <!-- start latest article section -->
    <section class="latest-article-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title" id="section_heading">
                        <span>Partners</span>
                        <h2>OUR FINTECH PARTNERS</h2>
                        <!-- <p>The passages of Lorem Ipsum available but the majority have suffered alteration embarrased</p> -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                <div class="partners__area">
           <div class="partners_img">
           <img src="{{asset('assets/web')}}/asset/img/newimages/partners1.png" alt="" class="partner1__">
            <img src="{{asset('assets/web')}}/asset/img/newimages/partners2.png" alt="">
           </div>
        </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- end of latest article section -->
    <!-- start google map area -->
    <!-- <div class="googlemap-area">
        <div class="gmap" id="gmap"></div>
    </div> -->
    <!-- end of google map area -->
@endsection
@push('puch-script')

@if(session()->get('success'))
<script>
    alertMessage('Success !', "{{session()->get('success')}}", 'success', 'yes');
</script>
@elseif(session()->get('error'))
<script>
    alertMessage('Error !', "{{session()->get('error')}}", 'error', 'no');
</script>
@endif
    
<!-- site-main end -->
<script>
    const items = document.querySelectorAll(".accordion button");

function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');
  
  for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }
  
  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
}

items.forEach(item => item.addEventListener('click', toggleAccordion));
</script>

    <script>
        $.fn.jQuerySimpleCounter = function( options ) {
	    var settings = $.extend({
	        start:  0,
	        end:    100,
	        easing: 'swing',
	        duration: 400,
	        complete: ''
	    }, options );

	    var thisElement = $(this);

	    $({count: settings.start}).animate({count: settings.end}, {
			duration: settings.duration,
			easing: settings.easing,
			step: function() {
				var mathCount = Math.ceil(this.count);
				thisElement.text(mathCount);
			},
			complete: settings.complete
		});
	};


$('#number1').jQuerySimpleCounter({end: 820,duration: 3000});
$('#number2').jQuerySimpleCounter({end: 60,duration: 3000});
$('#number3').jQuerySimpleCounter({end: 1600,duration: 2000});
// $('#number4').jQuerySimpleCounter({end: 246,duration: 2500});
    </script>

    <script>
        $('.testimonial-widget').slick({
  centerMode: true,
  slidesToShow: 1,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '0px',
        slidesToShow: 1
      }
    },
    {
        breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
      }
    },
    {
        breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
      }
    }
  ]
});
    </script>
<script>
    $(document).ready(function(){
        $('.feature_slider').slick({
        dots: false,
        infinite: true,
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: false,
        responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
       
    });
    });
</script>

<!-- custom testimonial -->
<script>
    let card = document.querySelectorAll(".card");
let contentBox = document.querySelectorAll(".contentBox");

for (let i = 0; i < card.length; i++) {
  card[i].addEventListener("mouseover", function () {
    for (let i = 0; i < contentBox.length; i++) {
      contentBox[i].className = "contentBox";
    }
    document.getElementById(this.dataset.id).className = "contentBox active";

    for (let i = 0; i < card.length; i++) {
      card[i].className = "card";
    }
    this.className = "card active";
  });
}



</script>
<script>

    $(document).ready(function(){
       $('.view_more_btn').click(function(){
        $('.faq_tab').toggleClass("height_auto");
        // $(this).html("karo ya maro");
        if($(".faq_tab").hasClass("height_auto"))
       {
       		$(".view_more_btn").html("View Less");
       	  }
       else{
        $(".view_more_btn").html("View more");
       }
       });  
    });
</script>

<!-- <script>

    $(document).ready(function(){
       $('.faq_tab').hasClass("height_auto"){
        $('.view_more_btn').html("View More");
       }
    });
</script> -->

@endpush
