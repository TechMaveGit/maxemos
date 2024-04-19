@extends('layout.master')

@section('content')
    <main >
        <div class="breadcrums_area breadcrums">

            <div class="common_pagetitle">{{(strlen($pageTitle)>18) ? substr($pageTitle,0,18).'...' : $pageTitle}}</div>

            <div class="flex items-center space-x-4  lg:py-6 breadcrum_right">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl breadcrum_largetitle">
                    Dashboard
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="javascript:;">Customers Management</a>
                        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li>{{(strlen($pageTitle)>18) ? substr($pageTitle,0,18).'...' : $pageTitle}}</li>
                </ul>
            </div>
        </div>

        <div class="main_page_title">
            <div class="common_pagetitlebig">{{$pageTitle}}</div>
            <div class="btns_rightimport">
            </div>
        </div>

        <section class="filters_table">
            <div class="filters">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="block">
                                        <span>From</span>
                                        <span class="relative mt-1.5 flex">
                                          <input x-flatpickr="" id="fromDate" name="fromDate" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input active" placeholder="Choose date..." type="text" readonly="readonly">
                                          <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                          </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="block">
                                        <span>To</span>
                                        <span class="relative mt-1.5 flex">
                                          <input x-flatpickr="" id="toDate" name="toDate" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input active" placeholder="Choose date..." type="text" readonly="readonly">
                                          <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                          </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <span>&nbsp;</span>
                        <div class="form-group without_lablebtn">
                            <button type="button" onclick="filterUsersCustomerManagement();" class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4 mt-2"><strong>Account Name : {{$userDtl->name}}</strong> </div>
                <div class="col-md-4 mt-2"><strong>Mobile : {{$userDtl->mobile}}</strong> </div>
                <div class="col-md-4 mt-2"><strong>Email : {{$userDtl->email}}</strong> </div>
                <div class="col-md-4 mt-2"><strong>Loan Type : {{$loanDetails->categoryName}}</strong> </div>
                <div class="col-md-4 mt-2"><strong>Applied Amount : {{$loanDetails->loanAmount}}</strong> </div>
                <div class="col-md-4 mt-2"><strong>Applied Tenure : {{$loanDetails->appliedTenureD}}</strong> </div>
                <div class="col-md-4 mt-2"><strong>Approved Amount : {{$loanDetails->approvedAmount}}</strong> </div>
                <div class="col-md-4 mt-2"><strong>Approved Tenure : {{$loanDetails->approvedTenureD}}</strong> </div>
                <div class="col-md-4 mt-2"><strong>ROI % : {{$loanDetails->rateOfInterest}}</strong> </div>

                <div class="col-md-4 mt-2"><strong style="color: red;">Available : {{$availableLimit}}</strong> </div>
            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-3">
                    <button type="button" onclick="disburseRawMaterialAmount();"
                            class="btn addbtn_right bg-danger font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                        Disburse Amount
                    </button>
                </div>
                <div class="col-md-3">
                    <button type="button" onclick="collectRawMaterialAmount();"
                            class="btn addbtn_right bg-success font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                        <i class="fa-solid fa-plus"></i>
                        Collect Amount
                    </button>
                </div>
            </div>
            <div class="table_mainstart">
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div class="card mt-3">
                                <div id="mainTblHtml" class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table end -->
        </section>
    </main>


    <div class="modal fade" id="initiateApplyLoanModal" tabindex="-1" aria-labelledby="updateEmpInfoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="initiateApplyLoanModalHeading"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                </div>

                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="applyLoanAdminFrm">
                        <input type="hidden" id="actionLoanId" name="actionLoanId">
                        <input type="hidden" id="actionUserId" name="actionUserId">
                        <input type="hidden" id="actionType" name="actionType">
                        @csrf
                        <div id="initiateApplyLoanModalBody"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success bg-success" onclick="proceedApplication();">Proceed</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    function filterUsersCustomerManagement()
    {
        var fromDate=$('#fromDate').val();
        var toDate=$('#toDate').val();

        $('#mainTblHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
        $.post('{{route('rewMaterialAppliedLoansTxnHistory')}}',{
            "_token": "{{ csrf_token() }}",
            fromDate:fromDate,
            toDate:toDate,
            loanId:'{{$loanId}}',
            pageNameStr:'{{$pageNameStr}}'
        },function (data){
            var obj = JSON.parse(data);
            if(obj.status=='success'){
                $('#mainTblHtml').html(obj.data);
                $('.is-hoverable').DataTable();
            }else{
                alertMessage('Error!', obj.message, 'error', 'no');
                return false;
            }
        });
    }

    $(document).ready(function (){
        $('#customerCodeHtml').hide();
        filterUsersCustomerManagement();
    });

    function collectRawMaterialAmount(){
wip();
return 0;
        $('#initiateApplyLoanModalHeading').html('Collect Loan Amount');

        var htmlStr =`<div class="col-lg-12 mt-3">
            <label><strong>Disburse Amount</strong></label>
            <input type="number" id="processAmount" name="processAmount" value="" class="form-control">
        </div>
        <div class="col-lg-12 mt-3">
            <label><strong>Date</strong></label>
            <input type="date" id="processDate" value="" name="processDate" class="form-control">
        </div>`;

        $('#initiateApplyLoanModalBody').html(htmlStr);
        $('#actionType').val('in');
        $('#actionLoanId').val('{{$loanDetails->id}}');
        $('#actionUserId').val('{{$loanDetails->userId}}');
        $('#initiateApplyLoanModal').modal('show');
    }

    function disburseRawMaterialAmount(){

        $('#initiateApplyLoanModalHeading').html('Disburse Loan Amount');

        var htmlStr =`<div class="col-lg-12 mt-3">
            <label><strong>Disburse Amount</strong></label>
            <input type="number" id="processAmount" name="processAmount" value="" class="form-control">
        </div>
        <div class="col-lg-12 mt-3">
            <label><strong>TXN Date</strong></label>
            <input type="date" id="processDate" value="" name="processDate" class="form-control">
        </div>
        <div class="col-lg-12 mt-3">
            <label><strong>TXN ID</strong></label>
            <input type="text" id="transactionId" value="" name="transactionId" class="form-control">
        </div>
        <div class="col-lg-12 mt-3">
            <label><strong>Payment Mode</strong></label>
            <input type="text" id="payment_mode" value="" name="payment_mode" class="form-control">
        </div>
        `;


        $('#initiateApplyLoanModalBody').html(htmlStr);
        $('#actionType').val('out');
        $('#actionLoanId').val('{{$loanDetails->id}}');
        $('#actionUserId').val('{{$loanDetails->userId}}');
        $('#initiateApplyLoanModal').modal('show');
    }

    function proceedApplication()
    {
        var actionType=$('#actionType').val();
        var actionLoanId=$('#actionLoanId').val();
        var actionUserId=$('#actionUserId').val();
        var processAmount=$('#processAmount').val();
        var processDate=$('#processDate').val();
        var transactionId=$('#transactionId').val();
        var payment_mode=$('#payment_mode').val();

        if(!actionType || (actionType !='id' && actionType !='out') || !actionLoanId || !actionUserId){
            alertMessage('Error!', 'Invalid Request, Please try again', 'error', 'yes');
            return false;
        }

        if(actionType=='out')
        {
            if(!parseInt(processAmount)){
                alertMessage('Error!', 'Please enter amount.', 'error', 'no');
                return false;
            }else if(!processDate){
                alertMessage('Error!', 'Please select date.', 'error', 'no');
                return false;
            }else if(!transactionId){
                alertMessage('Error!', 'Please enter transaction id.', 'error', 'no');
                return false;
            }else if(!payment_mode){
                alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
                return false;
            }else{
                waitForProcess();
                $.post('{{route('disburseRawMaterialAppliedLoans')}}',{
                    "_token": "{{ csrf_token() }}",
                    loanId:actionLoanId,
                    userId:actionUserId,
                    amount:processAmount,
                    processDate:processDate,
                    transactionId:transactionId,
                    payment_mode:payment_mode,
                },function (data){
                    var obj = JSON.parse(data);
                    if(obj.status=='success'){
                        alertMessage('Success!', obj.message, 'success', 'yes');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }

    }

    $('#applyLoanAdminFrm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var userId=$('#initiateApplyLoanUserId').val();
        var loanCategory=$('#loanCategory').val();
        var approveTenure=$('#approveTenure').val();
        var approvedAmount=$('#approvedAmount').val();
        var approvedRoi=$('#approvedRoi').val();
        var invoiceFile=$('#invoiceFile').val();

        if(!userId){
            alertMessage('Error!', 'Invalid Request, Please try again', 'error', 'yes');
            return false;
        }else if(!loanCategory){
            alertMessage('Error!', 'Please select product name.', 'error', 'no');
            return false;
        }else if(loanCategory=='4' && !invoiceFile){
            alertMessage('Error!', 'Please upload invoice.', 'error', 'no');
            return false;
        }else if(!approveTenure){
            alertMessage('Error!', 'Please select tenure.', 'error', 'no');
            return false;
        }else if(!approvedAmount){
            alertMessage('Error!', 'Please enter approved amount.', 'error', 'no');
            return false;
        }else if(!approvedRoi){
            alertMessage('Error!', 'Please enter rate of interest.', 'error', 'no');
            return false;
        }else{
            $('#initiateApplyLoanBtnFnBtn').text('Please Wait...').attr('disabled','disabled');
            $('#initiateApplyLoanFrmResetBtn').text('Please Wait...').attr('disabled','disabled');
            $.ajax({
                type:'POST',
                url: "{{route('applyLoanByAdmin')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
                    if(obj.status=='success'){
                        alertMessage('Success!', obj.message, 'success', 'no');
                        initiateApplyLoan(userId);
                        return false;
                    }else{
                        $('#initiateApplyLoanBtnFnBtn').text('Proceed').removeAttr('disabled');
                        $('#initiateApplyLoanFrmResetBtn').text('Cancel').removeAttr('disabled');
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                },
                error: function(data){
                    $('#initiateApplyLoanBtnFnBtn').text('Proceed').removeAttr('disabled');
                    $('#initiateApplyLoanFrmResetBtn').text('Cancel').removeAttr('disabled');
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        }
    });

    function initiateApplyLoanFrmReset()
    {
        $('#loanCategory').val('');
        $('#approveTenure').val('');
        $('#approvedAmount').val('');
        $('#approvedRoi').val('');
    }

    function checkProductTypeCategory()
    {
        var loanId=$('#loanCategory').val();
        $('#invoiceFile').val('');
        if(parseInt(loanId)==4){
            $('#invoiceFileHtml').show();
        }else{
            $('#invoiceFileHtml').hide();
        }
    }

    function rewMaterialAppliedLoans(userId)
    {
        $.post('{{route('rewMaterialAppliedLoans')}}',{
            "_token": "{{ csrf_token() }}",
            userId:userId,
        },function(data){
            var obj = JSON.parse(data);
            if(obj.status=='success'){
                $('#initiateApplyLoanModalBody').html(obj.data);
                $('#initiateApplyLoanUserId').val(userId);
                $('#initiateApplyLoanModal').modal('show');
            }else{
                alertMessage('Error!', obj.message, 'error', 'no');
                return false;
            }
        });
    }
</script>
@endsection
