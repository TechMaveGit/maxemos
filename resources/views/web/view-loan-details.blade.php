@if(auth()->user() && auth()->user()->email == "admin@gmail.com") 
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
<style>
    .nice-select .list{
        z-index: 10000 !important;
    }
</style>
<div class="tp__headerback">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <h2><a href="{{route('welcomeWeb')}}">Maxemos</a></h2>
        </div>
        <div class="col-lg-4 rightbtn_col">
            {{-- <div class="dropdown profile_dropdown">
                <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    <div class="userpimg"><img src="{{$userProfileURL}}" alt=""></div>Profile
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal1">Change Password</a>
                    <a class="dropdown-item" href="{{route('webUserLogOut')}}">Logout</a>
                </div>
            </div> --}}
        </div>
    </div>
</div>



<link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/app.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/dashboard-css.css">
<style>
    .nice-select{
        margin: 0px !important;
    }
</style>
<section class="py-4">
    <div class="container  step_form_main">
        <form method="POST" action="{{ route('viewAdminLaonDetailSubmit',['id'=>$loanDetails->id]) }}">
        <div class="row">
            <div class="col-md-12 text-center" style="display: flex;align-items: center;">
                @csrf
                <div style="display: flex;align-items: center; width:80%;">
                        <label for="exampleFormControlInput1" style="width: 34%;margin-bottom: 0%;font-size: 28px;font-weight: bold;" class="form-label">Loan #LF0{{$loanDetails->id}} </label>
                        <select class="contact-one__form-input" id="loanStatusCheck" name="loanData">
                            @if ($rawLoanDetails)
                            <option {{ $rawLoanDetails->isAdminApproved == "approved" ? 'selected' : '' }} value="approved">Approved</option>
                            <option {{ $rawLoanDetails->isAdminApproved == "rejected" ? 'selected' : '' }} value="rejected">Rejected</option>
                            <option {{ $rawLoanDetails->isAdminApproved == "need update" ? 'selected' : '' }} value="need update">Need Update</option>
                            @else
                            <option {{ $loanDetails->isAdminApproved == "approved" ? 'selected' : '' }} value="approved">Approved</option>
                            <option {{ $loanDetails->isAdminApproved == "rejected" ? 'selected' : '' }} value="rejected">Rejected</option>
                            <option {{ $loanDetails->isAdminApproved == "need update" ? 'selected' : '' }} value="need update">Need Update</option>
                            @endif
                        </select>
                </div>
                    <button class="btn btn-primary btn-sm" type="submit"> Submit </button>
                </div>
            </div>
            <div class="col-md-12" id="rejectresion" style="display: none;">
                <label for="exampleFormControlInput1" class="form-label">Explain Here</label>
                <textarea class="form-control" rows="3" placeholder="Enter Here .... " name="rejectionReason"></textarea>
            </div>
        </form>
        <div class="row m-3" style="border: 2px solid #eee;padding: 12px;">
            @if ($rawLoanDetails && $rawLoanDetails->isAdminApproved != "pending")
            <div class="col-md-12">
                <b>Last Updated Date :</b> {{date('d-m-Y',strtotime($rawLoanDetails->created_at))}}
            </div>
                <div class="col-md-4">
                    <b>Checked Status :</b> {{Str::ucfirst($rawLoanDetails->isAdminApproved)}}
                </div>
                @if ($rawLoanDetails->isAdminApproved == 'rejected' || $rawLoanDetails->isAdminApproved == 'need update')
                    <div class="col-md-8">
                        <b>Reason :</b> {{$rawLoanDetails->reject_reason}}
                    </div>
                @endif
            @elseif ($lastrawLoanDetails && $lastrawLoanDetails->isAdminApproved != "pending")
            <div class="col-md-12">
                <b>Last Updated Date :</b> {{date('d-m-Y',strtotime($lastrawLoanDetails->created_at))}}
            </div>
                <div class="col-md-4">
                    <b>Checked Status :</b> {{Str::ucfirst($lastrawLoanDetails->isAdminApproved)}}
                </div>
                @if ($lastrawLoanDetails->isAdminApproved == 'rejected' || $lastrawLoanDetails->isAdminApproved == 'need update')
                    <div class="col-md-8">
                        <b>Reason :</b> {{$lastrawLoanDetails->reject_reason}}
                    </div>
                @endif
            @elseif ($loanDetails->isAdminApproved != "pending")
                <div class="col-md-4">
                    <b>Checked Status :</b> {{Str::ucfirst($loanDetails->isAdminApproved)}}
                </div>
                @if ($loanDetails->isAdminApproved == 'rejected' || $loanDetails->isAdminApproved == 'need update')
                    <div class="col-md-8">
                        <b>Reason :</b> {{$loanDetails->reject_reason}}
                    </div>
                @endif
                
            @endif


            <?php
            if($loanDetails->loanCategory == 3){
            $pendingDisbmentRequest = DB::table('raw_materials_loan_requests')->where(['loanId'=>$loanDetails->id])->orderBy('created_at','DESC')->get(); 
                        // dd($pendingDisbmentRequest);
                        ?>
                        <div class="col-lg-12 card card-body my-4" id="btnhistory">
                            <h3 style="font-size: 21px;text-align: left;font-weight: bold;" class="mb-2">Disbursement History</h3>
                            <table class="w-full dataTable is-hoverable">
                                <thead style="text-align:left;background: antiquewhite;" >
                                    <th>Request Amount</th>
                                    <th>Disburse Date</th>
                                    <th>Admin Approve</th>
                                    <th>Created Date</th>
                                </thead>
                                <tbody>
                               <?php
                               
                               foreach($pendingDisbmentRequest as $disbreq){
                                        if($disbreq->isAdminApproved == 'approved'){
                                            $isadminApprove = '<span class="badge bg-success">Approved</span>';
                                        }else if($disbreq->isAdminApproved == 'rejected'){
                                            $isadminApprove = '<span data-bs-toggle="tooltip" data-bs-placement="top" onclick="alert(\'Rejected Reason : '.$disbreq->reject_reason.'\')" class="badge bg-danger">Rejected</span>';
                                        }else if($disbreq->isAdminApproved == 'need update'){
                                            $isadminApprove = '<span data-bs-toggle="tooltip" data-bs-placement="top" onclick="alert(\'Need Update : '.$disbreq->reject_reason.'\')" class="badge bg-warning">Need Update</span>';
                                        }else{
                                            $isadminApprove = '<span class="badge bg-info">Pending</span>';
                                        } ?>

                                    <tr style="text-align:left;">
                                        <td><?= $disbreq->loanAmount; ?></td>
                                        <td><?= $disbreq->disburse_date; ?></td>
                                        <td><?= $isadminApprove; ?></td>
                                        <td><?= $disbreq->created_at; ?></td>
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <?php } ?>
        </div>


        


    </div>
</section>


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
                                            @if($loanDetails)    
                                                <option {{ $loanDetails->id == $loan->id ? 'selected' : '' }} value="{{$loan->id}}">LF0{{$loan->id}}</option>
                                            @elseif($previewnamw != $loan->name) <optgroup label="{{$loan->name}}"> @endif
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
    $(function () {
        $('.is-hoverable').DataTable();
    });
</script>
<script>
    $("#loanStatusCheck").change(function(){
        $("#rejectresion").css("display","none");
        if($(this).val() != "approved"){
            $("#rejectresion").css("display","block");
        }
    });

    $("#loanStatusCheck").trigger('change');
</script>
<script>



    function summary_btn(){
        $('.showtable__').toggle();
    }

    $(document).ready(function() {
        $('.showtable__').hide();
    })

    
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
            userId:'{{$userloggedData->id}}'
        },function (data){
            $('#userLoanDetailsHtml').html(data);
            $('.is-hoverable').DataTable();
            let avalableAmount = $("#availableLimit").text();
            if(avalableAmount){
                $("#requestAmountAlert").text(`Available Limit : ${avalableAmount}`);
                $("#requestAmount").attr('max',avalableAmount);
            }
            $(".disbursment_btn").css('display','none');

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
        userId:'{{$userloggedData->id}}'
    },function (data){
       $('#userDashboardRequestedHtml').html(data);
       $(".disbursment_btn").css('display','none');
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
    @else 
    <!DOCTYPE html>
    <html>
    <head>
        <title>Maxemocapital | Login Form</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="card" style="width: 40%;text-align: center;">
                <div class="card-body">
                    <img src="{{asset('assets/web')}}/asset/img/logo/maxemo-logo.png" alt="" style="width: 300px;margin: 26px 0px 15px;">
                    <form method="POST" action="{{route('superAdminlogin')}}">
                        @csrf
                        <!-- Form fields go here -->
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
    </html>
    


@endif