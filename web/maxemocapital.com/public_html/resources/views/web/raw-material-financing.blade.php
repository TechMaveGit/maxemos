@extends('web.layout.master')

@section('content')


<style>
    body{
        padding-top: 76px;
  background: url("{{asset('assets/web')}}/asset/img/newimages/perfectwhite2.png");
background-repeat: no-repeat;
background-size: cover;
background-position: center top, center bottom;
background-position-y: -300px;
}
</style>



    <div class="inner__banner__area commeinner_area">
        <div class="bannercustom__container">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                      <div class="bannerinner__details">
                        <div class="gredient_heading">
                            <h2>Maxemo Capital</h2>
                        </div>
                          <h1>Raw Material Financing</h1>
                          <p>Working Capital Financing is when a business borrows money to cover day-to-day operations and payroll rather than purchasing equipment or investment.</p>
                      <div class="btninner__banner">
                      <a href="{{ auth()->check() && auth()->user()->userType == 'user'  ? route('applyNow') : route('webUserLogin')}}" class=""> <button class="custom-btn btn-11">Apply Loan<div class="dot"></div></button></a>

                     

                      </div>
                        </div>
                </div>

                <div class="col-lg-6">
                  
                    <div class="elementor-widget-container">
   <div class="obelisk-image obelisk-tooltip style-1">
      <div class="img sizxl" data-tooltip-tit="Digital Marketing" data-tooltip-sub="Agency ">
         <img src="{{asset('assets/web')}}/asset/img/newimages/rawloan.jpeg" alt="" class="imago wow animated" style="visibility: visible;">
      </div>
   </div>
</div>

                </div>
            </div>
        </div>
        </div>
    </div>


<div class="bannercustom__container">
    <section class="about_loan_sec">
          <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="loan_innersec_heading">
                    <h1>Know about Raw Material Financing </h1>
         <p>Working Capital Financing is when a business borrows money to cover day-to-day operations and payroll rather than purchasing equipment or investment. Working capital financing is a common practice for businesses with an inconsistent cash flow. Whether your business is facing cash flow issues or not, having extra cash in reserves is always good to secure yourself during unexpected circumstances. Working capital financing lets firms fulfil their short-term or urgent cash flow shortfalls. For example, a large business with steady cash flow may apply for a working capital loan to finance the expansion of operations into a new region, scale up. In this, the loan will act as a buffer until the new region becomes self-sufficient. Similarly, a small business may require working capital finance to bridge the gap between cash inflows and outflows while the business grows.</p>
        
                    </div>
                </div>
            </div>
          </div>
    </section>

   
</div>

<div class="breakgrediet__line"></div>


<div class="bannercustom__container">
    <section class="loan_benefits">
          <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="loan_innersec_heading">
                    <h1>Raw Material Financing Benefits</h1>
                    </div>

                    <div class="benifits__cards">
                         <div class="row">
                            <div class="col-lg-3">
                                <div class="benifits_item">
                                    <div class="icon_nenifits_card">
                                        <img src="{{asset('assets/web')}}/asset/img/newimages/iconcus1.png" alt="">
                                    </div>
                                    <h3>Easy Access – easy to access and offers quick solutions for short term operational requirements</h3>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="benifits_item">
                                <div class="icon_nenifits_card iconshort_2">
                                        <img src="{{asset('assets/web')}}/asset/img/newimages/iconcus2.png" alt="">
                                    </div>
                                    <h3>Savings on trade margin</h3>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="benifits_item">
                                <div class="icon_nenifits_card">
                                        <img src="{{asset('assets/web')}}/asset/img/newimages/iconcus3.png" alt="">
                                    </div>
                                    <h3>Flexible repayments – multiple tenure option for easing your loan repayment</h3>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="benifits_item">
                                <div class="icon_nenifits_card">
                                        <img src="{{asset('assets/web')}}/asset/img/newimages/iconcus4.png" alt="">
                                    </div>
                                    <h3>Fulfill short term or urgent cash flow shortfalls</h3>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-5">
                                <div class="benifits_item">
                                <div class="icon_nenifits_card">
                                        <img src="{{asset('assets/web')}}/asset/img/newimages/iconcus5.png" alt="">
                                    </div>
                                    <h3>Maintain Gap between cash inflows and outflows while the business grows</h3>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
          </div>
    </section>

   
</div>

<div class="bannercustom__container">
    <section class="eligibility_section">
          <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="loan_innersec_heading">
                    <h1>Eligibility:</h1>
                    </div>

                    <div class="eligibility_item">


                    <div class="info-box style-6">
   <div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/eligibilityicon.png" alt=""></div>
   </div>
   <h6>Applicant must have a business vintage of a minimum of 2 Years</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>


<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/eligibilityicon.png" alt=""></div>
   </div>
   <h6>The applicant should have permanent resident of the area</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>


<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/eligibilityicon.png" alt=""></div>
   </div>
   <h6>Profitability for 3 consequent years</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>

<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/eligibilityicon.png" alt=""></div>
   </div>
   <h6>Should show upward trend Y-O-Y basis </h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>

<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/eligibilityicon.png" alt=""></div>
   </div>
   <h6>Balance sheet should be audited by a registered CA</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>

<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/eligibilityicon.png" alt=""></div>
   </div>
   <h6>Applicant’s 2 years of ITR and audited balance sheet </h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>


                    </div>
                </div>
            </div>
          </div>
    </section>
</div>

<div class="bannercustom__container whymaexmo_section">
 <div class="container">
    <div class="row">
        <div class="col-lg-12">
        <div class="whyus__section">
                <div class="content_area_whyus">
                     <h1>Why Maxemo</h1>
                     <ul>
                        <li>Business based customized financial assistance </li>
                        <li>Guiding CIBIL score enhancement</li>
                        <li>Providing industry guidance for growth </li>
                        <li>Convenient repayment methods </li>
                        <li>Quick disbursal</li>
                     </ul>
                </div>

                <img src="{{asset('assets/web')}}/asset/img/newimages/whymaxemovector.png" alt="">
          </div>
        </div>
    </div>
 </div>
</div>

<div class="bannercustom__container loan_processsection">
 <div class="container">
    <div class="process_mainstart">
    <div class="row">
        <div class="col-lg-7">
           <div class="tatsu-column">
                   <div class="tatsu-column-pad">
                       <h1>Our Application Process</h1>

                       <ol>
                        <li> 
                            <div class="tatsu-list-inner">
                            <p>Loan Application </p>
                            </div> 
                        </li>
                        <li> <div class="tatsu-list-inner">
                            <p>Application Processing </p>
                            </div>   </li>
                        <li><div class="tatsu-list-inner">
                            <p>Underwriting Process</p>
                            </div>
                             </li>
                        <li><div class="tatsu-list-inner">
                            <p>Credit decision </p>
                            </div>
                            </li>
                        <li><div class="tatsu-list-inner">
                            <p>Final quality check </p>
                            </div>
                            </li>
                        <li><div class="tatsu-list-inner">
                            <p>Bank a/c Validation </p>
                            </div>
                            </li>
                        <li><div class="tatsu-list-inner">
                            <p>Loan Funding / Disbursement </p>
                            </div>
                            </li>
                        <li><div class="tatsu-list-inner">
                            <p>Collection </p>
                            </div>
                            </li>
                        <span class="tatsu-lists-timeline-element" style="height: 100%; top: 0px;"></span>
                       </ol>
                   </div>
           </div>
        </div>

        <div class="col-lg-5">
            <div class="process__imagearea">
                  <h2>Fast & Easy Application Process</h2>
                  <p>Maxemo understands that keeping a business up and running is challenging. It’s hard to manage so many things happening at one place, with several sources receiving and giving out payments.</p>
                  <div class="btninner__banner">
                      <a href="{{ auth()->check() && auth()->user()->userType == 'user'  ? route('applyNow') : route('webUserLogin')}}" class=""> <button class="custom-btn btn-11">Apply Loan<div class="dot"></div></button></a>

                     

                      </div>
            </div>
        </div>
    </div>
    </div>
 </div>
</div>

<div class="bannercustom__container">
    <section class="eligibility_section">
          <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="loan_innersec_heading">
                    <h1>Required Documents:</h1>
                    </div>

                    <div class="eligibility_item" id="documsnts__items">


                    <div class="info-box style-6">
   <div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/docicon1.png" alt=""></div>
   </div>
   <h6>Promoter's Aadhar Card</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>


<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/docicon2.png" alt=""></div>
   </div>
   <h6>Promoter's PAN Card</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>


<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/docicon3.png" alt=""></div>
   </div>
   <h6>Business PAN</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>

<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/docicon4.png" alt=""></div>
   </div>
   <h6>Business address proof</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>

<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/docicon5.png" alt=""></div>
   </div>
   <h6>GST certificate</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>

<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/docicon6.png" alt=""></div>
   </div>
   <h6>Bank statement- Last 6 months</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>

<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/docicon7.png" alt=""></div>
   </div>
   <h6>Audited financial statements -Latest 3 yrs</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>

<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/docicon8.png" alt=""></div>
   </div>
   <h6>ITR with computation of taxes- 3 Yrs</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>

<div class="info-box style-6">
<div class="icon_eligibility">
      <div class="icon"><img src="{{asset('assets/web')}}/asset/img/newimages/docicon9.png" alt=""></div>
   </div>
   <h6>GST return (3B, GST R1) -last 4 qtrs.</h6>
   <div class="dots">
      <span></span>
      <span></span>
      <span></span>
   </div>
</div>

                    </div>
                </div>
            </div>
          </div>
    </section>
</div>


{{-- 


    <section class="single_titleloan">

        <div class="container">

            <div class="row">

                <div class="col-lg-9">

                <div class="prelements-heading style4">

                        <div class="title-inner"><h2 class="title"><span class="watermark"></span>Raw Material Financing</h2></div>

                        <a href="{{ auth()->check() && auth()->user()->userType == 'user'  ? route('applyNow') : route('webUserLogin')}}" class="apply_loan_utc">Apply Loan</a>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <section class="services-page inr__pagepadding">

        <div class="container">

            <div class="row">

                <div class="col-md-8 col-lg-9">

                    <div class="services-details">

                        <div class="services-thumb-lg">

                            <img src="{{asset('assets/web')}}/asset/img/newimages/raw-loan.jpg" alt="">

                        </div>

                        <h2 class="title_details">Raw Material Financing</h2>

                       <p>Working Capital Financing is when a business borrows money to cover day-to-day operations and payroll rather than purchasing equipment or investment. Working capital financing is a common practice for businesses with an inconsistent cash flow. Whether your business is facing cash flow issues or not, having extra cash in reserves is always good to secure yourself during unexpected circumstances. Working capital financing lets firms fulfil their short-term or urgent cash flow shortfalls. For example, a large business with steady cash flow may apply for a working capital loan to finance the expansion of operations into a new region, scale up. In this, the loan will act as a buffer until the new region becomes self-sufficient. Similarly, a small business may require working capital finance to bridge the gap between cash inflows and outflows while the business grows.</p>

                    </div>

                </div>

                <div class="col-md-4 col-lg-3">

                    <div class="sidebar-area">

                        <div class="single-sidebar">

                            <div class="services">

                                <ul>

                                <li><a href="{{route('WebBusinessLoan')}}"><i class="fa fa-long-arrow-right"></i>Business Loan</a></li>

                                    <li><a href="{{route('WebPersonalLoan')}}"><i class="fa fa-long-arrow-right"></i>personal Loan</a></li>

                                    <li><a href="{{route('WebRawLoan')}}" class="active__tab"><i class="fa fa-long-arrow-right"></i>Raw Material Financing</a></li>

                                    <li><a href="{{route('WebReceivableLoan')}}" ><i class="fa fa-long-arrow-right"></i>Receivables Invoicing</a></li>

                                </ul>

                            </div>

                        </div>

                       

                        <div class="single-sidebar">

                           <div class="sidebar-get-in-touch">

                               <h4>Get in Touch with us</h4>

                               <p>You can also send us an email

and we’ll get in touch shortly, or Toll Free Number</p>

                                <ul class="connect_sidebar">

                                    <li><span><img src="{{asset('assets/web')}}/asset/img/scall.png" alt=""></span>(+91) - 7827218200</li>

                                    <li><span><img src="{{asset('assets/web')}}/asset/img/senvelope.png" alt=""></span>contact@maxemocapital.com</li>

                                </ul>

                           </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    --}}

    <section class="services_yopcards">
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


@endsection