@extends('web.layout.master')

@section('content')
    <style>
        body {
            padding-top: 76px;
            background: url("{{ asset('assets/web') }}/asset/img/newimages/perfectwhite2.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center top, center bottom;
            background-position-y: -300px;
        }

        .appplyjob_form_main{
          height: auto !important;
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
                            <h1>Career</h1>
                            <p>Growth is imperative for a business. Without increasing revenue and profit, a business cannot
                                survive in this competitive climate. </p>
                            <div class="btninner__banner">


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">

                        <div class="elementor-widget-container">
                            <div class="obelisk-image obelisk-tooltip style-1">
                                <div class="img sizxl" data-tooltip-tit="Digital Marketing" data-tooltip-sub="Agency ">
                                    <img src="{{ asset('assets/web') }}/asset/img/newimages/business-loanimg.jpg"
                                        alt="" class="imago wow animated" style="visibility: visible;">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
      $allcareers = DB::table('career_posts')->where('closing_date','>=',date('Y-m-d'))->orderBy('opening_date','ASC')->get();
    @endphp



    <div class="bannercustom__container" id="jobs__area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title sec_titleprdf" id="section_heading">
                        <span>Jobs</span>
                        <h2>Trending Opportunities</h2>
                        <p>Join the Maxemo team!</p>
                    </div>
                </div>

                <div class="row row_joncard">


                    @if($allcareers)
                      @foreach ($allcareers as $career)
                        
                      <div class="col-xl-6 col-md-6 col-12 my-2">
                        <div class="job__card">
                            <div class="job_card_details">
                                <div class="employer-logo">
                                    <img src="https://maxemocapital.co.in/maxemolms/assets/web/asset/img/logo/favicon.png" alt="">
                                </div>
                                <div class="job-list-content">
                                    <div class="job__title">
                                        <h2>{{ $career->title }}</h2>
                                        <div class="job-metas">
                                            <div class="job-location with-icon"><i class="fa-solid fa-location-dot"></i>{{ $career->location }}</div>
                                            <div class="job-deadline with-icon"><i class="fa-regular fa-calendar"></i>{{ $career->opening_date }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobcard__footer">
                                <div class="positions_job">
                                    <h2>No of Positions: <span>{{ $career->no_of_postions }}</span></h2>
                                </div>

                                <div class="view_detail_jobbtn">
                                    <a href="##" data-toggle="modal" data-target="#staticBackdrop{{$career->id}}"><button class="custom-btn btn-11">Apply Now<div class="dot"></div></button></a>
                                </div>
                            </div>
                        </div>




                        <!-- Modal -->
                        <div class="modal fade modal__job_details" id="staticBackdrop{{$career->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Apply for this job</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form_jobdetails">
                                            <div class="flex_between_modal">
                                                <div class="job-pos">
                                                    <h3>{{$career->title}}</h3>
                                                    <span>{{$career->location}}</span>
                                                </div>

                                                <div class="apply-btn jobsubmit__btn">
                                                    <a href="##" id="jobsubmit__btnform" data-fid="{{$career->id}}" data-toggle="modal" data-target="#staticBackdropForm"><button class="custom-btn btn-11">Apply Now<div class="dot"></div></button></a>
                                                </div>
                                                <div></div>
                                            </div>
                                            <div class="description__areajon">
                                                <h1>Job description</h1>
                                                {!! $career->details !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- #post-## -->
                    </div>

                      @endforeach
                    @endif
                    



                    <!-- #post-## -->
                </div>
            </div>
        </div>
    </div>


    <!-- job detail modal -->
    


    <!-- apply form -->
    <!-- Modal -->
    <div class="modal fade apply_modal_start" id="staticBackdropForm" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <form action="{{ route('WebCareerFormSubmit') }}" method="POST" >
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Apply Now</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="appplyjob_form_main">
                          

                            <div class="row">
                              <input type="hidden" id="applied_for" name="applied_for">
                                <div class="form-group col-md-12">
                                    <label for="">Full Name</label>
                                    <input type="text" required id="" name="fullname" placeholder="Enter full name" value="{{ old('fullname') }}">
                                    @error('fullname')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Email</label>
                                    <input type="email" id="" required name="email" placeholder="Enter email address" value="{{ old('email') }}">
                                    @error('email')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="">Phone Number</label>
                                    <input type="phone" id="" required name="phone_number" placeholder="Enter phone number " value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="">Describe your work experience (Must Write Minimum. 50 Characters)</label>
                                    <textarea id="work_experience" required name="work_experience" minlength="50" rows="4" cols="50">{{ old('work_experience') }}</textarea>
                                    @error('work_experience')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="">Upload Resume/CV</label>
                                    <div class="dropify_resumeupload">
                                      <input name="file1" type="file" required class="dropify" data-height="100" />
                                    </div>
                                    @error('file1')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                    </div>
                </div>
                <div class="modal-footer applyfooter_btnarea">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </div>
    </div>
@endsection
@push('puch-script')
  <script>
    $("#jobsubmit__btnform").click(function(e){
      let dataForm = $(this).data('fid');
      $("#applied_for").val(dataForm);
    });
  </script>
@endpush
