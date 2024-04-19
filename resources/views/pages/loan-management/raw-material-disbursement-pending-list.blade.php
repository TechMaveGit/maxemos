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
                @if($pageNameStr=='customers-list')
                <button data-bs-toggle="modal" data-bs-target="#addbank_modal"
                        class="btn addbtn_right bg-success btn_import font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                    <i class="fa-solid fa-plus"></i>
                    Add Customer
                </button>
                @endif
            </div>
        </div>

        <section class="filters_table">
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


    <div class="modal fade" id="disbursementRequestModal" tabindex="-1" aria-labelledby="disbursementRequestModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltitlechange">Approve Disbursement Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                </div>

                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="applyLoanAdminFrm">
                        <input type="hidden" id="disbursementRequestId" name="disbursementRequestId">
                        @csrf
                        <div class="row mt-3" id="approvedRawLoanDiv">
                            <div class="col-md-12">
                                <label>Request Disbursement Amount</label>
                                <input type="number" value="" name="disbursementAmount" id="disbursementAmount" readonly class="form-control">
                            </div>
                            <div class="col-md-12" >
                                <label>Disbursement Date</label>
                                <input type="date" value="" name="disbursementTxndate" id="disbursementTxndate" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3" id="rejectRawLoanDiv">
                            <div class="col-md-12" >
                                <label>Rejection Reason</label>
                                <textarea name="reject_reason" id="reject_reason" class="form-control"></textarea>
                            </div>
                        </div>
                        {{-- <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Transaction Id</label>
                                <input type="text" value="" name="disbursementTxnId" id="disbursementTxnId" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Payment Mode</label>
                                <input type="text" value="" name="disbursementPayMode" id="disbursementPayMode" class="form-control">
                            </div>
                        </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="approveDisbursementRequestBtn" class="btn btn-success bg-success" onclick="approveDisbursementRequest();">Schedule Disbursement</button>&nbsp;
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<div class="modal fade" id="rawDocsModal" tabindex="-1" aria-labelledby="rawDocsModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Uploaded Docs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
            </div>

            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row mt-3" style="display: none;">
                        <div class="col-md-12">
                            <strong>Invoice Number</strong><br>
                            <strong id="invoiceNumberV">View Invoice</strong>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <strong>Invoice File</strong><br>
                            <a href="" style="color:blue;" target="_blank" id="invoiceFileV">View Invoice</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <strong>Draw Down Form</strong><br>
                            <a href="" style="color:blue;" target="_blank" id="drawDownFormFileV">View Draw Down Form</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
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
        $('#mainTblHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
        $.post('{{route('filterRawMaterialDisbursementPendingList')}}',{
            "_token": "{{ csrf_token() }}",
            pageNameStr:'{{$pageNameStr}}'
        },function (data){
            var obj = JSON.parse(data);
            $('#mainTblHtml').html(obj.data);
            $('.is-hoverable').DataTable();
        });
    }

    $(document).ready(function (){
        $('#customerCodeHtml').hide();
        filterUsersCustomerManagement();
    });
    
    function disbursementRequestModalOpen(loanId,status)
    {
        var amount=$('#actionBtn'+loanId).attr('amount');
        $('#disbursementAmount').val(amount);
        $('#disbursementRequestId').val(loanId);
        if(status == 'rejected'){
            $("#modaltitlechange").text('Reject Disbursement Request');
            $("#approveDisbursementRequestBtn").text('Reject');
            $("#rejectRawLoanDiv").show();
            $("#approvedRawLoanDiv").hide();
        }else{
            $("#modaltitlechange").text('Approve Disbursement Request');
            $("#approveDisbursementRequestBtn").text('Schedule Disbursement');
            $("#reject_reason").val();
            $("#approvedRawLoanDiv").show();
            $("#rejectRawLoanDiv").hide();
        }
        $('#disbursementRequestModal').modal('show');
    }

    function approveDisbursementRequest(userId)
    {
        
        var disbursementRequestId=$('#disbursementRequestId').val();
        var disbursementAmount=$('#disbursementAmount').val();
        var reject_reason = $("#reject_reason").val();
        // var disbursementRequestTenure=$('#disbursementRequestTenure').val();
        var disbursementTxndate=$('#disbursementTxndate').val();
        // var disbursementTxnId=$('#disbursementTxnId').val();
        // var disbursementPayMode=$('#disbursementPayMode').val();
        if(reject_reason != ''){
            $.post('{{route('approveDisbursementRequest')}}',{
                "_token": "{{ csrf_token() }}",
                disbursementRequestId:disbursementRequestId,
                status:'rejected',
                reject_reason:reject_reason
            },function(data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    alertMessage('Success !', obj.message, 'success', 'yes');
                    return false;
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }else{
            if(!parseInt(disbursementRequestId))
            {
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!parseInt(disbursementAmount))
            {
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!disbursementTxndate)
            {
                alertMessage('Error!', 'Please select transaction date.', 'error', 'no');
                return false;
            }
            // else if(!disbursementTxnId)
            // {
            //     alertMessage('Error!', 'Please enter transaction id.', 'error', 'no');
            //     return false;
            // }else if(!disbursementPayMode)
            // {
            //     alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
            //     return false;
            // }
            else{
                $.post('{{route('approveDisbursementRequest')}}',{
                    "_token": "{{ csrf_token() }}",
                    disbursementRequestId:disbursementRequestId,
                    disbursementAmount:disbursementAmount,
                    disbursementTxndate:disbursementTxndate,
                },function(data){
                    var obj = JSON.parse(data);
                    if(obj.status=='success'){
                        alertMessage('Success !', obj.message, 'success', 'yes');
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
        alert("adsasdasd");

        var formData = new FormData(this);

        var userId=$('#initiateApplyLoanUserId').val();
        // var loanCategory=$('#loanCategory').val();
        // var approveTenure=$('#approveTenure').val();
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
        $('#invoiceFile').val('');
        $('#validFromDate').val('');
        $('#validToDate').val('');
    }

    function checkProductTypeCategory()
    {
        var loanId=$('#loanCategory').val();
        $('#invoiceFile').val('');
        $('#validFromDate').val('');
        $('#validToDate').val('');
        console.log(parseInt(loanId))
        if(parseInt(loanId)==3){
            $('.validFromDateHtml').show();
            $('.validToDateHtml').show();
        }else{
            $('.validFromDateHtml').hide();
            $('.validToDateHtml').hide();
        }

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
    
    function openInvFiles(loanIdDisburseId)
    {
        var invoiceNumber=$('#rawFile'+loanIdDisburseId).attr('data-invoiceNumber');
        var invoiceFile=$('#rawFile'+loanIdDisburseId).attr('data-invoiceFile');
        var drawDownFormFile=$('#rawFile'+loanIdDisburseId).attr('data-drawDownFormFile');
        
        $('#invoiceNumberV').html(invoiceNumber);
        $('#invoiceFileV').attr('href','{{asset('/')}}public/'+invoiceFile);
        $('#drawDownFormFileV').attr('href','{{asset('/')}}public/'+drawDownFormFile);
        $('#rawDocsModal').modal('show');
    }
</script>
@endsection
