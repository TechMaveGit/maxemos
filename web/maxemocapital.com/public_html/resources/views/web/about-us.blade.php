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


<section class="whowearesec">

    <div class="container">

        <div class="row">

            <div class="col-lg-6">

                <div class="whoweare_left">

                    <div class="prelements-heading style4">

                        <div class="title-inner">

                            <h2 class="title"><span class="watermark"></span>Get to know us!</h2>

                        </div>

                    </div>



                    <p>Maxemo Capital Services Pvt. ltd., incorporated on 20th March, 2019, is a Delhi based NBFC-ND Company that aims to provide customized financial assistance solutions using technology and efficiency in operations.</p>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="whoweare_right">



                    <p> Since inception, their main area of focus has been toward customized MSME loans and working capital financing for targeted industries and markets.</p>
                    <p>It also provides personal loans for salaried and self employed individual</p>
                    
                    <div class="gpsnumber">
                        <h5>Maxemo Capital Services Private Limited</h5>
                        <span>GSTIN : 07AAMCM5365R1ZJ</span>
                    </div>
                </div>

            </div>

        </div>

    </div>

</section>





<section class="valuetabs">

    <div class="container">

        <div class="row">

            <div class="col-lg-6">

                <div class="ab__image">

                    <img src="{{asset('assets/web')}}/asset/img/newimages/service-image.jpg" alt="">

                </div>

                <div class="rotateimg_ab">

                    <img src="{{asset('assets/web')}}/asset/img/newimages/circlerotate.png" alt="">

                </div>



            </div>



            <div class="col-lg-6">

                <div class="right_tab__main">

                    <div class="prelements-heading style4">

                        <div class="title-inner">

                            <h2 class="title"><span class="watermark"></span>About Maxemo Capital</h2>

                        </div>

                    </div>





                    <div class="tab__section">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item">

                                <a class="nav-link active" id="inspections-tab" data-toggle="tab" href="#inspections"

                                    role="tab" aria-controls="inspections" aria-selected="true">Our Mission</a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link" id="mortgage-tab" data-toggle="tab" href="#mortgage" role="tab"

                                    aria-controls="mortgage" aria-selected="false">Our Vision</a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link" id="overspending-tab" data-toggle="tab" href="#overspending"

                                    role="tab" aria-controls="overspending" aria-selected="false">core value</a>

                            </li>

                        </ul>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="inspections" role="tabpanel"

                                aria-labelledby="inspections-tab">



                                <p>To deliver innovative financial products and services…</p>

                                <ul class="check-arrow">

                                    <li>Growing needs of an Aspirational India, serving both indivdual & Business

                                        Clients. </li>

                                    <li>To enable technology and process oriented structure for employee empowerment.

                                    </li>

                                    <li>To be the most preffered financial services provider, providing excellent

                                        customer satisfaction. </li>

                                </ul>



                            </div>

                            <div class="tab-pane fade" id="mortgage" role="tabpanel" aria-labelledby="mortgage-tab">



                                <p>Our Vision is to see ourselves as a systematically important NBFC in the country that

                                    offers plethora of financial services.</p>



                            </div>

                            <div class="tab-pane fade" id="overspending" role="tabpanel"

                                aria-labelledby="overspending-tab">

                                <p>The company and its Management are commited to conduct its business in accordance

                                    with applicable laws, rules and regulations and highest standards of transparency.

                                    To develop a relationship of trust and truthfulness within the ecosystem of MCS.</p>



                            </div>

                        </div>

                    </div>



                </div>

            </div>

        </div>

    </div>

</section>







<section class="services_yopcards boutofr__products mt-5" id="offer__products">

    <div class="container">

        <div class="row">

            <div class="col-md-12 text-center">

                <div class="section-title sec_titleprdf" id="section_heading">

                    <span>Products We Offers</span>

                    <h2>Choose Your Product</h2>

                    <p>provides new-age customized financing products for your business needs</p>

                </div>

            </div>

        </div>



        <div class="row loancards_rownpj">

            <div class="col-12 col-md-6 col-lg-3">

                <div class="cs-services-list__item  bottom-to-top animated is-active"

                    data-cs-st="bottom-to-top" data-cs-de="250" data-cs-du="700"

                    style="animation-duration: 700ms; transition-duration: 700ms; animation-delay: 250ms; transition-delay: 250ms;">

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

                    <div class="cs-services-list__content">

                        <p>Businesses require an adequate amount of capital...</p>

                    </div>

                    <div class="viewmore_content">

                        <a href="{{route('WebBusinessLoan')}}">View More</a>

                    </div>

                </div>

            </div>

            <div class="col-12 col-md-6 col-lg-3">

                <div class="cs-services-list__item bottom-to-top animated is-active" data-cs-st="bottom-to-top" data-cs-de="500"

                    data-cs-du="700"

                    style="animation-duration: 700ms; transition-duration: 700ms; animation-delay: 500ms; transition-delay: 500ms;">

                    <div class="cs-services-list__bg" style="color: #46d599"></div>

                    <div class="cs-services-list__shadows"></div>

                    <div class="cs-services-list__count">2</div>

                    <div class="cs-services-list__icon" style="color: #46d599">

                        <div class="icon">

                            <img src="{{asset('assets/web')}}/asset/img/newimages/icon1.jpg" alt="">

                        </div>

                        <span></span>

                    </div>

                    <h5 class="cs-services-list__title">Personal Loan</h5>

                    <div class="cs-services-list__content">

                        <p>A multipurpose consumer loan which you can use to meet...</p>

                    </div>

                    <div class="viewmore_content">

                        <a href="{{route('WebPersonalLoan')}}">View More</a>

                    </div>

                </div>

            </div>

           

            <div class="col-12 col-md-6 col-lg-3">

                <div class="cs-services-list__item bottom-to-top animated is-active" data-cs-st="bottom-to-top" data-cs-de="1000"

                    data-cs-du="700"

                    style="animation-duration: 700ms; transition-duration: 700ms; animation-delay: 1000ms; transition-delay: 1000ms;">

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

                    <div class="cs-services-list__content">

                        <p>Raw material financing is a type... </p>

                    </div>

                    <div class="viewmore_content">

                        <a href="{{route('WebRawLoan')}}">View More</a>

                    </div>

                </div>

            </div>

            <div class="col-12 col-md-6 col-lg-3">

                <div class="cs-services-list__item bottom-to-top animated is-active" data-cs-st="bottom-to-top" data-cs-de="1000"

                    data-cs-du="700"

                    style="animation-duration: 700ms; transition-duration: 700ms; animation-delay: 1000ms; transition-delay: 1000ms;">

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

                    <div class="cs-services-list__content">

                        <p>The basic process of a receivables invoicing loan...</p>

                    </div>

                    <div class="viewmore_content">

                        <a href="{{route('WebReceivableLoan')}}">View More</a>

                    </div>

                </div>

            </div>

        </div>



    </div>

</section>

@endsection