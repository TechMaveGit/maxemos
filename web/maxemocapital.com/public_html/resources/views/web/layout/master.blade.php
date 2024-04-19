<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('assets/web')}}/asset/img/logo/favicon.png" type="image/gif">
     <meta name="description" content="Maxemo">
    <meta name="keywords" content="Maxemo, Loan Product, Personal Loan">
    <title>Maxemo</title>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- slick -->
   <link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/slick.css">
   <link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/slick-theme.css">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/reset.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/nice-select.css">
    <link href="{{asset('assets/web')}}/lighttheme/uicss/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/responsive.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('assets/web')}}/asset/css/custom.css">
</head>
<!-- loader start -->
<div class="loader" style="display: none;">
  <div class="loader4"></div>
  <p>Please hold, your KYC details is getting verify</p>
</div> 
  <!-- loader end -->
<body class="js">
    <div id="preloader" style="display: none;">
      <img src="{{asset('assets/web')}}/asset/img/logo/maxemo-logo.png" alt="">
      <p>Please hold, your KYC details is getting verify</p>
    </div>


   


    <!-- start header area -->
    <div class="second-topbar">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-left">
                    <div class="left-topbar">
                        <ul>
                            <!-- <li><i class="fa-solid fa-location-crosshairs"></i> Maxemo S24, NY 12321, Mumbai </li> -->
                            <li><i class="fa-regular fa-envelope"></i> <a href="contact@maxemocapital.com">contact@maxemocapital.com</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="second-social">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <!-- <a href="#" class="fab fa-google-plus-g"></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of topbar area -->


    <nav class="navbar customnavigation navbar-expand-lg navbar-light bg-light sticky-header" id="customnavigation">
   <div class="container">
   <div class="second-logo">
                        <a href="{{route('welcomeWeb')}}">
                            <img src="{{asset('assets/web')}}/asset/img/logo/maxemo-logo.png" alt="">
                            <h6>RBI Registered NBFC</h6>
                        </a>
                    </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"><img src="{{asset('assets/web')}}/asset/img/hamburger.png" alt=""></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('welcomeWeb')}}">Home</a>
      </li>
    
      <li class="nav-item dropdown">
       
        <a class="nav-link dropdown-toggle" href="{{ route('WebAboutUs') }}" data-toggle="dropdown" role="button"  aria-expanded="false">About us </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{route('WebAboutUs')}}">About Maxemo </a>

          <a class="dropdown-item" href="{{route('WebOurteam')}}">Our Team</a>
        </div>
      </li>

      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="servicesjavascript:void(0);" data-toggle="dropdown" role="button"  aria-expanded="false">Products</a>
       <div class="dropdown-menu">
        <a class="dropdown-item" href="{{route('WebBusinessLoan')}}">Business Loan</a>
        <a class="dropdown-item" href="{{route('WebPersonalLoan')}}">Personal loan</a>
        <a class="dropdown-item" href="{{route('WebRawLoan')}}">Raw Material Financing</a>
        <a class="dropdown-item" href="{{route('WebReceivableLoan')}}">Receivables Invoicing</a>
       </div>
     </li>

     <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="servicesjavascript:void(0);" data-toggle="dropdown" role="button"  aria-expanded="false">Investor Corner</a>
       <div class="dropdown-menu">
      <a class="dropdown-item" href="{{route('WebCodeOfConduct')}}">Code of Conduct</a>
                                       <a class="dropdown-item" href="{{route('WebFairPractice')}}">Fair Practice Code</a>
                                     <a class="dropdown-item" href="{{route('WebGrievance')}}">Grievance Redressal Mechanism</a>
                                      <a class="dropdown-item" href="{{route('WebInterestRate')}}">Interest Rate Policy</a>
                                    <a class="dropdown-item" href="{{route('WebKycPolicy')}}">Kyc Policy</a>
       </div>
     </li>
      
   <li><a class="nav-link" href="{{route('WebCareer')}}">Career </a></li>
     <li><a class="nav-link" href="{{route('WebContact')}}">Contact us</a></li>

    </ul>

   
    
  </div>

  <div class="rightbtn_col">
                    <!-- <a href="apply-now.php" class=" btn-primary btn_headersignup btnheader btn_apply_loan"> Apply Loan</a> -->
                    @if(!auth()->check() || auth()->user()->userType != 'user')
                    <a href="{{ route('webUserLogin') }}" class="login_now__">Login Now</a>
                    @endif
                    <!-- <div class="button btnheader" id="button-7">
                        <div id="dub-arrow">Sign up<i class="fa-solid fa-arrow-right-long"></i></div>
                        <a href="signup.php">Sign Up</a>
                    </div> -->
                    <!-- <a href="signup.php" class="btn btn-primary btn_headersignin btnheader"> Sign Up</a> -->
                    @if(auth()->check() && auth()->user()->userType == 'user')
                    <div class="dropdown profile_dropdown">
                    @php
                            if(auth()->user()->profilePic)
                            {
                                $userProfileURL=asset('/').'public/'.auth()->user()->profilePic;
                            }else{
                                $userProfileURL= asset('assets/web').'/asset/img/newimages/dummy-profile.jpg';
                            }
                        @endphp
                    <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        <div class="userpimg"><img src="{{$userProfileURL}}" alt=""></div>Profile
                    </button>
                    
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('userDashboard')}}">Dashboard</a>
                        <a class="dropdown-item" href="{{route('webUserLogOut')}}">Logout</a>
                    </div>
                </div>
                @endif
                </div>
   </div>
</nav>


   
    <!-- end of logo menu area -->

    <div id="content" class="home_content_main">
        @yield('content')
    </div>
    
    <a href="#" id="scroll" style="display: none;"><span></span></a>

<section class="check-rate-btn-area" id="check_rate_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="check-your-rate-text">
                        <h4>Feel free to contact us in case of any queries. Helpline Number - 7827218200</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="check-your-rate-btn">
                        <a href="{{route('WebContact')}}" class="btn btn-default btn-sm">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- start footer area -->
    <section class="footer-area footer-two section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="footer-widget">
                        <div class="footer-title">
                            <div class="ftlogo"><img src="{{asset('assets/web')}}/asset/img/logo/maxemo-logo.png" alt=""></div>
                        </div>
                        <p>Maxemo Capital Services Pvt. Ltd. is a Private Limited Company under the Companies Act, 2013 with the aim to do Non-banking financial activities by way of grant of loan under type-II (NBFC-ND).</p>
                       
                       <div class="socialBlock">
                       <div class="titleBlock"><h3 class="heading h3">FOLLOW US</h3></div>
                       <div class="footer-two-social">
                            <a href="https://www.facebook.com/maxemocapital?mibextid=ZbWKwL" target="_blank" class="fa fa-facebook-f"></a>
                            <a href="https://www.instagram.com/maxemocapital/?igshid=OGQ5ZDc2ODk2ZA%3D%3D" target="_blank" class="fa fa-instagram"></a>
                            <a href="https://www.linkedin.com/company/maxemo-capital/" target="_blank" class="fa fa-linkedin"></a>
                        </div>
                       </div>
                       
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="footer-widget pages-widget loan_productsft">
                        <div class="footer-title">
                            <h4>Get a Loan</h4>
                        </div>
                        <ul>
                            <li><a href="{{route('WebBusinessLoan')}}">Business Loan</a></li>
                            <li><a href="{{route('WebPersonalLoan')}}">Personal Loan</a></li>
                            <li><a href="{{route('WebRawLoan')}}">Raw Material Financing</a></li>
                            <li><a href="{{route('WebReceivableLoan')}}">Receivables Financing</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-lg-3">
                    <div class="footer-widget pages-widget loan_productsft">
                        <div class="footer-title">
                            <h4>Quick Links</h4>
                        </div>
                        <ul>
                            <li><a href="{{route('welcomeWeb')}}">Home</a></li>
                            <li><a href="{{route('WebAboutUs')}}">About Us</a></li>
                            <li><a href="{{route('WebOurteam')}}">Our Team</a></li>
                            <li><a href="{{route('WebCareer')}}">Career</a></li>
                            <li><a href="{{route('WebContact')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-title">
                            <h4>Contact us</h4>
                        </div>
                        <div class="contact-widget">
                            <ul class="ft_locations">
                                <li>
                                    <div class="icon">
                                        {{-- <!-- <img src="{{asset('assets/web')}}/asset/img/map-pin.png" alt=""> --> --}}
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <div class="content">
                                        <p>1102-A, 11th floor, d-mall, Netaji subhash place, pitampura, delhi, north west delhi, delhi-110034</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                    <i class="fa-regular fa-envelope"></i></div>
                                    <div class="content">
                                        <p><a href="mailto:contact@maxemocapital.com">contact@maxemocapital.com</a> 
                                            {{-- <!-- <span>reply within 2 Hours</span></p> --> --}}
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                    <i class="fa-solid fa-phone"></i>
                                   </div>
                                    <div class="content">
                                        <p><a href="tel:+91 7827218200 ">+91 7827218200 </a>
                                          </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="copy-right-section second-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-left">
                    <div class="copyright-text">
                        <p><i class="fa fa-copyright"></i> <span id="autodate"></span> Maxemo Capital All Rights Reserved | Developed by <a href="https://techmavesoftware.com/" target="_blank">TechMave Software</a></p>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <ul class="footer-nav">
                      
                        <li><a href="{{route('webTermCondition')}}">Terms & Conditions</a></li>
                        <li><a href="{{route('webPrivacyPolicy')}}">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end of footer area -->
    <!-- Optional JavaScript -->
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn4uayw359fjMh4P9i2rKKZYHzXaqTRNs"></script> --}}
    <script src="{{asset('assets/web')}}/asset/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('assets/web')}}/lighttheme\uijs/jquery.easing.min.js"></script>
    <script src="{{asset('assets/web')}}/lighttheme\uijs/jquery-ui.js"></script>
    <script src="{{asset('assets/web')}}/asset/js/popper.min.js"></script>
    <script src="{{asset('assets/web')}}/asset/js/bootstrap.min.js"></script>
    {{-- <script src="{{asset('assets/web')}}/asset/js/gmap.js"></script> --}}
    <script src="{{asset('assets/web')}}/asset/js/jquery.nice-select.js"></script>
    <script src="{{asset('assets/web')}}/asset/js/menumaker.js"></script>
    <script src="{{asset('assets/web')}}/asset/js/owl.carousel.min.js"></script>
    <script src="{{asset('assets/web')}}/asset/js/slider.js"></script>
    <script src="{{asset('assets/web')}}/asset/js/calculator.js"></script>
    {{-- <script src="{{asset('assets/web')}}/asset/js/active.js"></script> --}}
    {{-- <script src="{{asset('assets/web')}}/asset/js/wizard.js"></script> --}}
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script src="{{asset('assets/web')}}/asset/js/slick.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    $(function () {
        $('#tableId').DataTable();
    });
</script>
    <script>
      $('.dropify').dropify();
    </script>
	<script>
	$(window).scroll(function() {
		if ($(this).scrollTop() > 50){  
			$('.second-header').addClass("sticky");
		}
		else{
			$('.second-header').removeClass("sticky");
		}
	});	

  // setTimeout(() => {
    $("#preloader").fadeOut(2000);
  // }, 3000);
	</script>



<script>
       
       $(document).ready(function(){ 
           $(window).scroll(function(){ 
               if ($(this).scrollTop() > 100) { 
                   $('#scroll').fadeIn(); 
               } else { 
                   $('#scroll').fadeOut(); 
               } 
           }); 
           $('#scroll').click(function(){ 
               $("html, body").animate({ scrollTop: 0 }, 600); 
               return false; 
           }); 
       });
           </script>


<!-- wizard form -->
{{-- 
<script>
    var data = [
  { id:"1", fname:"Tiger", lname:"Noxx", team:'Team 1', address:'Ryecroft Field',   tel:'0494645879'},
  { id:"2", fname:"Garrett", lname:"Pellens", team:'Team 2', address:'Kiln Circus',      tel:'0493658746' },
  { id:"3", fname:"Ashton", lname:"Fox", team:'Team 1', address:'Thurne View',      tel:'0498532546' },
  { id:"4", fname:"Melissa", lname:"Perenboom", team:'Team 3', address:'Thornton Glade',   tel:'0499454891' },
  { id:"5",  fname:"Frankie", lname:"Winters", team:'Team 2', address:'Drayton Brae',     tel:'0494678943' },
  { id:"6", fname:"Benoist", lname:"Muniz", team:'Team 4', address:'Foxglove Lane',    tel:'0492884618' },
  { id:"7", fname:"Kelly", lname:"London", team:'Team 2', address:'Doxford Park Way', tel:'0497978945' },
  { id:"8", fname:"Hope", lname:"Gilmore", team:'Team 3', address:'Bradford Manor',   tel:'0499894125' },
  { id:"9", fname:"Muriel", lname:"Smith", team:'Team 3', address:'Wardle Street',    tel:'0491484215' },
  { id:"10", fname:"Gary", lname:"Hendren", team:'Team 4', address:'Church Street',    tel:'0493596488' },
];

$('#txt-search').keyup(function(){
    $('.next').prop('disabled', true);
    var searchField = $(this).val();
    if(searchField === '')  {
      $('#filter-records').html('');
      return;
    }
    var regex = new RegExp(searchField, "i");
    var output = '';
    $.each(data, function(key, val){
      var fullname = val.fname +' '+ val.lname;
      if ((fullname.search(regex) != -1)) {
        output += '<li id="' +val.id +'" class="li-search">'+ val.fname +' '+ val.lname +'</li>';
      }
    });
    $('#filter-records').html(output);
});

$(document).on("click", ".li-search", function () {
  $("#txt-search").val($(this).html());
  setFormFields($(this).attr("id"));
  $("#filter-records").html("");
  $(".next").prop("disabled", false);
});

$(".radio-group .radio").on("click", function () {
  $(".selected .fa").removeClass("fa-check");
  $(".radio").removeClass("selected");
  $(this).addClass("selected");
  if ($("#suser").hasClass("selected") == true) {
    $(".next").prop("disabled", true);
    $(".searchfield").show();
  } else {
    setFormFields(false);
    $(".next").prop("disabled", false);
    $("#filter-records").html("");
    $(".searchfield").hide();
  }
});
var step = 1;
$(document).ready(function () { stepProgress(step); });

$(".next").on("click", function () {
  var nextstep = false;
  if (step == 2) {
    nextstep = checkForm("userinfo");
  } else {
    nextstep = true;
  }
  if (nextstep == true) {
    if (step < $(".step").length) {
      $(".step").show();
      $(".step")
        .not(":eq(" + step++ + ")")
        .hide();
      stepProgress(step);
    }
    hideButtons(step);
  }
});

// ON CLICK BACK BUTTON
$(".back").on("click", function () {
  if (step > 1) {
    step = step - 2;
    $(".next").trigger("click");
  }
  hideButtons(step);
});

// CALCULATE PROGRESS BAR
stepProgress = function (currstep) {
  var percent = parseFloat(100 / $(".step").length) * currstep;
  percent = percent.toFixed();
  $(".progress-bar")
    .css("width", percent + "%")
    .html(percent + "%");
};

// DISPLAY AND HIDE "NEXT", "BACK" AND "SUMBIT" BUTTONS
hideButtons = function (step) {
  var limit = parseInt($(".step").length);
  $(".action").hide();
  if (step < limit) {
    $(".next").show();
  }
  if (step > 1) {
    $(".back").show();
  }
  if (step == limit) {
    $(".next").hide();
    $(".submit").show();
  }
};

function setFormFields(id) {
  if (id != false) {
    // FILL STEP 2 FORM FIELDS
    d = data.find(x => x.id === id);
    $('#fname').val(d.fname);
    $('#lname').val(d.lname);
    $('#team').val(d.team);
    $('#address').val(d.address);
    $('#tel').val(d.tel);
  } else {
    // EMPTY USER SEARCH INPUT
    $("#txt-search").val('');
    // EMPTY STEP 2 FORM FIELDS
    $('#fname').val('');
    $('#lname').val('');
    $('#team').val('');
    $('#address').val('');
    $('#tel').val('');
  }
}

function checkForm(val) {
  // CHECK IF ALL "REQUIRED" FIELD ALL FILLED IN
  var valid = true;
  $("#" + val + " input:required").each(function () {
    if ($(this).val() === "") {
      $(this).addClass("is-invalid");
      valid = false;
    } else {
      $(this).removeClass("is-invalid");
    }
  });
  return valid;
}

</script> --}}


<script>
  $(document).ready(function(){
    $('select').niceSelect();
  })
</script>

<!-- dropzone js -->
<script>
  function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      var htmlPreview =
        '<img width="200" src="' + e.target.result + '" />' +
        '<p>' + input.files[0].name + '</p>';
      var wrapperZone = $(input).parent();
      var previewZone = $(input).parent().parent().find('.preview-zone');
      var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

      wrapperZone.removeClass('dragover');
      previewZone.removeClass('hidden');
      boxZone.empty();
      boxZone.append(htmlPreview);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
}

$(".dropzone").change(function() {
  readFile(this);
});

$('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
});

$('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
});

</script>

<!-- time circle -->


<!-- summary table hide show -->
<script>
   $(document).ready(function(){
      $(".summarybtn").click(function(){
        $("#emidt_tablemain").toggleClass("showtable");
      })
   })
</script>

{{-- <script>
  $(document).ready(function(){
   $(".bussiness_loan").hide();
   $(".raw_material").hide();
   $(".recivables_form").hide();

   $(".radiobx_1").click(function(){
    $(".dropdown_cards").show();
    $(".bussiness_loan").hide();
   $(".raw_material").hide();
   $(".recivables_form").hide();
   
    })
    $(".radiobx_2").click(function(){
      $(".dropdown_cards").hide();
      $(".bussiness_loan").show();
      $(".raw_material").hide();
    })
    $(".radiobx_3").click(function(){
      $(".dropdown_cards").hide();
      $(".bussiness_loan").hide();
      $(".raw_material").show();
      $(".recivables_form").hide();
    })
    $(".radiobx_4").click(function(){
      $(".recivables_form").show();
      $(".bussiness_loan").hide();
      $(".raw_material").hide();
      $(".dropdown_cards").hide();
    })
  })
</script> --}}
<script src="{{ asset('assets/sweetalert.min.js') }}"></script>
    <script>
        function alertMessage(textH, textMessage, textIcon, action) {
            swal({
                title: textH,
                text: textMessage,
                icon: textIcon,
                closeOnClickOutside: false,
            }).then((willDelete) => {
                if (willDelete && action == 'yes') {
                    location.reload();
                }
            });
        }

        function waitForProcess() {
            swal("Please wait while processing..", {
                title: 'Please Wait!.',
                buttons: false,
                closeOnClickOutside: false,
            });
        }

        function wip() {
            swal("Thanks for patience, It will available soon.", {
                title: 'Work in progress!',
                closeOnClickOutside: false,
            });
        }

        function isNumber(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

    </script>

    <script>
      $('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
    </script>


<!-- stickey header -->
<script>
        // Get the header element
const header = document.querySelector('.sticky-header');

// Function to add the 'sticky' class to the header when the user scrolls and remove it when they scroll back to the top
function handleScroll() {
  if (window.pageYOffset > 0) {
    header.classList.add('sticky');
  } else {
    header.classList.remove('sticky');
  }
}

// Listen for the 'scroll' event and call the handleScroll function
window.addEventListener('scroll', handleScroll);
    </script>


<!-- button effect -->



<!-- job modal deils hide -->
<script>
    
    $(document).ready(function() {
       $(".jobsubmit__btn a").click(function(){
           $(".modal__job_details").hide();
           $(".modal-backdrop").hide();
          
       })
});
</script>


<!-- auto year get -->

<script>
  
// Create a new function called newDate()
function newDate() {
  //return a new Date() -- returns the current calendar year.
  return new Date().getFullYear();
}
// after everything else has loaded on the page, load this command: find the element (like a <span>) with the ID of 'autoupdate' and insert the dash '-' and the result of the newDate() function that returns the current calendar year.  (ie. '-2017' or whatever the current calendar year is)
document.onload = document.getElementById("autodate").innerHTML = '-' + newDate();

</script>

@stack('puch-script')

</body>

</html>