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

<!-- 



<div class="page-header">

        <div class="container">

            <div class="row">

                <div class="col-md-12 text-center">

                    <h2>Contact</h2>

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">contact</li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

    </div> -->



    <section class="contact__area">

        <div class="container">

        <div class="row">

 

        <div class="col-lg-12">

        <div class="title-inner"><h2 class="title"><span class="watermark"></span>Our Address</h2></div>

        </div>

             <div class="col-md-6 col-lg-4">

                 <div class="single-contact-info ad_box__mtop">

                     <div class="icon address-icon">

                     <i class="fa-solid fa-location-dot"></i>

                     </div>

                     <div class="address-text">

                         <div class="text">

                              <span class="label">Address</span> 

                              <span class="des"> 1102-A, 11th floor, d-mall,

 Netaji subhash place, pitampura, delhi,

 north west delhi, delhi-110034 </span>

                             </div>

                     </div>

                 </div>

             </div>

             <div class="col-md-6 col-lg-4">

                 <div class="single-contact-info ad_box__mtop">

                 <div class="icon address-icon">

                 <i class="fa-regular fa-envelope"></i>

                     </div>

 

                     <div class="address-text">

                         <div class="text">

                              <span class="label">Email </span> 

 

                              <div class="ext_details">

                                 <h5>For Contact</h5>

                                 <span class="des"> 

 contact@maxemocapital.com</span>

                              </div>

                              <div class="ext_details">

                                 <h5>For issue and query</h5>

                                 <span class="des">helpticket@maxemocapital.com </span>
                                 <br>
                                 <span class="des">customercare@maxemocapital.com </span>

                              </div>

                             

                             </div>

                     </div>

                 </div>

             </div>

             <div class="col-md-12 col-lg-4">

                 <div class="single-contact-info ad_box__mtop">

                 <div class="icon address-icon">

                 <i class="fa-solid fa-phone"></i>

                     </div>

 

                     <div class="address-text">

                         <div class="text">

                              <span class="label">Phone </span> 

                              <div class="ext_details">

                                 <span class="des"> 

                                 +91 7827218200 <br> 011-45654453 </span>

                              </div>

                             </div>

                     </div>

                 </div>

             </div>

         </div>

        </div>

     </section>

 

 

     <section class="contact__form contact-us-padding">

     <div class="container">

 

     

         <div class="row">

             <div class="col-md-6 no--padding">

                 <div class="cn__img">

                     <img src="{{asset('assets/web')}}/asset/img/newimages/contact.jpg" alt="">

                 </div>

             </div>

             <div class="col-md-6 no--padding">

                 <div class="main_conform_start">

                 <div class="get-in-touch">

                     <h2>Get in Touch</h2>

                 </div>

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

                        <textarea  class="form-control" id="" name="message" aria-describedby="" rows="4">{{old('message')}}</textarea>

                        

                    </div>

                    </div>

            

                    </div>

            

              <button type="submit" class="btn btn-primary btnform_bsubmit">Submit</button>

                 </form>

                 </div>

             </div>

         </div>

         

         

     </div>

 </section>

 

 <section class="map__area">

 <iframe src="https://www.google.com/maps/embed?pb=!1m19!1m8!1m3!1d447988.9777712191!2d77.1506734!3d28.6922224!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x390d03ecec5ca3bd%3A0x3b889cd36d03e481!2sMaxemo%20Capital%20Services%20Private%20Limited%201102%20-%20D%20Mall%20Pitampura%20Netaji%20Subhash%20Place%20Delhi%2C%20110034!3m2!1d28.6922224!2d77.1506734!5e0!3m2!1sen!2sin!4v1683024202127!5m2!1sen!2sin" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

 </section>

 

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

@endpush