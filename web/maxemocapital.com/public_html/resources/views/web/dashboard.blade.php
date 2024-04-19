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

<body class="js">
    <div id="preloader"><img src="{{asset('assets/web')}}/asset/img/logo/maxemo-logo.png" alt=""></div>

{{-- @if ($_SERVER['REMOTE_ADDR'] == "122.161.53.172") --}}
@php
if($userloggedData->profilePic)
{
$userProfileURL=asset('/').'/public/'.$userloggedData->profilePic;
}else{
$userProfileURL=asset('assets/web').'/asset/img/newimages/dummy-profile.jpg';
}
@endphp
<link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/sumoselect.min.css">

<div class="tp__headerback">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <h2><a href="{{route('welcomeWeb')}}"><i class="fa-solid fa-arrow-left-long"></i> Back to Home</a></h2>
        </div>
        <div class="col-lg-4 rightbtn_col">
            <div class="dropdown profile_dropdown">
                <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    <div class="userpimg"><img src="{{$userProfileURL}}" alt=""></div>Profile
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal1">Change Password</a>
                    <a class="dropdown-item" href="{{route('webUserLogOut')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>



<link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/app.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/dashboard-css.css">




<section class="dashboard-bb">

    <div class="top-section">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-4">
                    <div class="customerprofile_picture">
                        <div class="pgotoof_customer">
                            <div class="photocircle_cus">
                                <img src="{{$userProfileURL}}" alt="">
                            </div>

                            <div class="profile_address_content">
                                <h2>{{$userloggedData->name}}</h2>
                                <div class="staff-email">Email : {{$userloggedData->email}}</div>
                                <div class="staff-email">Customer Id: {{$userloggedData->customerCode}}</div>
                            </div>
                        </div>

                        <!-- <div class="rightcustomer__id">
                    <h3>Customer ID : ME000076</h3>
                </div> -->

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Loan Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" onclick="userDashboardHtml('application')" role="tab" aria-controls="pills-profile" aria-selected="false">KYC</a>
                                </li>
                                <!-- <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                        </li> -->
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group form_gp ">
                                <label for="#" class="mb-1">Your Loans</label>
                                @if(isset($allLoans) && $allLoans && count($allLoans) > 0)
                                <select class="optgroup_test" id="selectedLoanId" onchange="loanDataShow()">
                                    {{-- <!-- <option value="select">select your loan</option> --> --}}
                                    @php
                                        $previewnamw = '';
                                    @endphp
                                    
                                        @php
                                            
                                            $selectedLoan = session()->get('sessionLoan') ?? $allLoans[0]->id;
                                        @endphp
                                        @foreach ($allLoans as $loan)
                                            @if($previewnamw != $loan->name) <optgroup label="{{$loan->name}}"> @endif
                                                <option {{ $selectedLoan == $loan->id ? 'selected' : '' }} value="{{$loan->id}}">LF0{{$loan->id}}</option>
                                            @php
                                                $previewnamw = $loan->name;
                                            @endphp
                                            @if($previewnamw != $loan->name) </optgroup> @endif
                                        @endforeach
                                    </select>
                                    @else
                                    <select class="optgroup_test" id="selectedLoanId">
                                        <option>No Loan Found !</option>
                                    </select>
                                    @endif
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5  yourkycinfo__">
                    <div class="col-lg-12">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                @if(isset($allLoans) && $allLoans  && count($allLoans) > 0)
                                <div class="business" id="userLoanDetailsHtml">
                                </div>
                                @else
                                    <div class="loan_apply mt-4" style="display: block;">
                                        <div class="img_box my-2">
                                            <img src="{{asset('assets/web')}}/asset/img/apply-loan-123.png" alt="">
                                        </div>
                                        <div class="apply_loan_btn__">
                                            <p>No Loan Found !</p>
                                          <a href="{{route('applyNow')}}">Apply Loan</a>
                                        </div>
                                    </div>
                                    @endif
                            </div>
                            <!-- tabpane end -->
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" >
                                <div id="userDashboardRequestedHtml" class="maindetails_cardd">
                                    
        
                                </div>
                            </div>
                            <!-- tab-pane end -->
                            <!-- <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div> -->
                        </div>
                    </div>
                    
                    
             
            

        </div>


    </div>

</section>



<!-- modal disbursement request -->

<!-- Modal -->
<div class="modal fade modal_disbursement" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Disbursement Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Request Amount</label>
                        <input type="text" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Date</label>
                        <input type="date" class="form-control" id="exampleInputPassword1">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class=" btn-secondary pop_clbtn" data-dismiss="modal">Close</button>
                <button type="button" id="changePasswordBtn" class=" btn-primary btnpop_frmsubmit">Save Change</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal_disbursement" id="disbursementRequestModal" tabindex="-1" aria-labelledby="disbursementRequestModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="disbursementRequestForRawMaterial" action="{{ route("disburseRequestForRawMaterialAppliedLoans") }}" enctype="multipart/form-data">   
                @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Disbursement Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                           
                    <input type="hidden" id="loanRequestId" name="loanRequestId" value="" >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="requestAmount">Request Amount</label>
                                <input type="number" class="form-control" id="requestAmount" name="requestAmount" >
                                <span class="text-danger" id="requestAmountAlert"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="invoice_file">Invoice File</label>
                                <input type="file"  class="form-control" id="invoice_file" name="invoice_file" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="drawdownForm">Draw Down Form</label>
                                <input type="file"  class="form-control" id="drawdownForm" name="drawdownForm">
                            </div>
                        </div>
                    </div>
                   
                    {{--<div class="form-group">
                        <label for="tenure">Tenure</label>
                        <select name="approveTenure" id="approveTenure" class="form-control">
                            <option value="">Select</option>
                            <?php /* if(count($tenures)){ ?>
                                <?php foreach($tenures as $trow){ ?>
                                    <option value="{{$trow->id}}">{{$trow->name}}</option>
                                <?php } ?>
                            <?php } */ ?>
                        </select>
                    </div>--}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary pop_clbtn" data-dismiss="modal">Close</button>
                <button type="submit" id="disbursementRequestForRawMaterialBtn" class="btn-primary btnpop_frmsubmit" >Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#">
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
                                <input id="newPassword" class="form-input pwd-change peer w-full  border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="New Password" type="password">
                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <i class="fa-regular fa-user text-base"></i>
                                </span>
                            </span>
                        </label>

                    </div>
                    <div class="grid mt-2 editform_start">
                        <label class="block">
                            <span>Confirm Password</span>
                            <span class="relative mt-1.5 flex">
                                <input id="newPasswordC" class="form-input pwd-change peer w-full  border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Confirm Password" type="password">
                                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <i class="fa-regular fa-user text-base"></i>
                                </span>
                            </span>
                        </label>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="changePassword();" class="btn btn-primary px-3">Save changes</button>
            </div>
        </div>
    </div>
</div>

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
<script src="{{asset('assets/web')}}/asset/js/jquery.sumoselect.min.js"></script>
<script>
    $('.optgroup_test').SumoSelect({
        okCancelInMulti: true,
        triggerChangeCombined: true,
        forceCustomRendering: true
    });
</script>
<script>

function openDisbursementRequestModal(loanId)
{
    $('#loanRequestId').val(loanId);
    $('#disbursementRequestModal').modal('show');
}

$("#disbursementRequestForRawMaterial").submit(function(e){

    e.preventDefault();
    let form_data =  new FormData(this);
    var loanRequestId=$('#loanRequestId').val();
    var requestAmount=$('#requestAmount').val();
    var invoice_file=$('#invoice_file').val();
    var drawdownForm=$('#drawdownForm').val();
    $("#disbursementRequestForRawMaterialBtn").attr('disabled',true);
    // var approveTenure=$('#approveTenure').val();
    if(!parseInt(loanRequestId)){
        alertMessage('Error!', 'Invalid Request, Please try again', 'error', 'yes');
        $("#disbursementRequestForRawMaterialBtn").attr('disabled',false);
        return false;
    }

    if(!parseInt(requestAmount)){
        alertMessage('Error!', 'Please enter amount.', 'error', 'no');
        $("#disbursementRequestForRawMaterialBtn").attr('disabled',false);
        return false;
    }else if(invoice_file == ""){
        alertMessage('Error!', 'Please Upload Invoice File.', 'error', 'no');
        $("#disbursementRequestForRawMaterialBtn").attr('disabled',false);
        return false;
    }else if(drawdownForm == ""){
        alertMessage('Error!', 'Please Upload Drawdown Form File.', 'error', 'no');
        $("#disbursementRequestForRawMaterialBtn").attr('disabled',false);
        return false;
    }else{
        // waitForProcess();
        $.ajax({
            type:'POST',
            url: "{{route('disburseRequestForRawMaterialAppliedLoans')}}",
            data:form_data,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    alertMessage('Success!', obj.message, 'success', 'yes');
                    return false;
                }else{
                    $("#disbursementRequestForRawMaterialBtn").attr('disabled',false);
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }
})

    function summary_btn(){
        $('.showtable__').toggle();
    }

    $(document).ready(function() {
        $('.showtable__').hide();
    })

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
</script>
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




<script>
    
    function loanDataShow(filterType = ''){
        let pathurl = '{{route('userLoanDetailsHtml')}}';
        if(filterType == 'all' || filterType == 'credit' || filterType == 'debit' || filterType == 'due'){
            pathurl = '{{route('userLoanDetailsHtml')}}?filterType='+filterType;
        }

        let selectedloan = $("#selectedLoanId").find(":selected").val();
        $.post(pathurl,{
            "_token": "{{ csrf_token() }}",
            selectedloan:selectedloan,
        },function (data){
            $('#userLoanDetailsHtml').html(data);
            $('.is-hoverable').DataTable();
            let avalableAmount = $("#availableLimit").text();
            if(avalableAmount){
                $("#requestAmountAlert").text(`Available Limit : ${avalableAmount}`);
                $("#requestAmount").attr('max',avalableAmount);
            }

        });
    }
    
    $(document).ready(function(){
      $('select').niceSelect();
    });
</script>

{{-- @if(isset($allLoans) && $allLoans  && count($allLoans) > 0) --}}
<script>
    $(document).ready(function(){
      loanDataShow();
    })
</script>
{{-- @endif --}}

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
        function userDashboardHtml(requestType)
{   
    $('#userDashboardRequestedHtml').html('<center><img src="{{env('LOADERIMG')}}" style="margin-top:20px;" /></center>');
    $.post('{{route('userDashboardHtml')}}',{
        "_token": "{{ csrf_token() }}",
        requestType:requestType,
    },function (data){
       $('#userDashboardRequestedHtml').html(data);
    });
}

$(document).ready(function(){
    userDashboardHtml('application');
});
    </script>
    <div style="/* position: absolute; */ bottom: 0px; width: 100%; z-index: 10000; text-align: center;">
        <h6 style="padding: 18px 30px; background-color: aliceblue; margin: 0px;">Feel free to contact us in case of any queries. Helpline Number - 7827218200</h6>
    </div>
    </body>

    </html>
