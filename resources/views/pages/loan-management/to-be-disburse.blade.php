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
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="index.php">Customers Management</a>
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
                <a id="exportdatahref" href="{{route('adminExportReports',['page'=>'customer-page-exports'])}}/?pageNameStr={{$pageNameStr}}&customSearch=&fromDate=&toDate=&userStatus=1" class="btn addbtn_right bg-success btn_import font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90"> Export Data</a> 
            </div>
        </div>


        <section class="filters_table">
            <div class="filters">
                <div class="row">
                    <div class="col-lg-7 col-md-12">
                        <div class="row">
                            @if($pageNameStr!='all-loan-list')
                                
                           
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="block">
                                        <span>Filter by Search </span>
                                        <span class="relative mt-1.5 flex">
                                          <input id="customSearch" name="customSearch" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent   placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter name" type="text">
                                          <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                          </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            @endif
                            @if($pageNameStr!='closed-loans')
                                
                            
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
                            @endif
                            @if($pageNameStr=='all-loan-list')
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="block">
                                        <span>Loan Type</span>
                                        <select id="loanType" name="loanType" class="form-select mt-1.5 w-full rounded-full border border-slate-300 bg-white px-4 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                            <option  value="0">All Loan</option>
                                            <option {{ request()->get('loanType') == "1" ? 'selected' : '' }} value="1">Business Loan</option>
                                            <option {{ request()->get('loanType') == "2" ? 'selected' : '' }} value="2">Personal loan</option>
                                            <option {{ request()->get('loanType') == "3" ? 'selected' : '' }} value="3">Raw Material Financing</option>
                                            <option {{ request()->get('loanType') == "8" ? 'selected' : '' }} value="8">Outstanding Loan</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="block">
                                <span>Status</span>
                                <select id="userStatus" name="userStatus" class="form-select mt-1.5 w-full rounded-full border border-slate-300 bg-white px-4 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <span>&nbsp;</span>
                        <div class="form-group without_lablebtn btnsset_sty">
                            <button type="button" onclick="filterUsersListsOther();" class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                Search
                            </button>
                            <a href="javascript:;" onclick="resetFilter();" class="btn btn-warning rounded-full  text-white">Reset Filter</a>
                        </div>
                    </div>
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

   
    <div class="modal fade" id="payEmiModal" tabindex="-1" aria-labelledby="payEmiModal" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">Pay Emi</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
               </div>

               <div class="modal-body">
                   <input type="hidden" id="payEmiId" name="payEmiId">
                       <input type="hidden" id="payEmiLoanId" name="payEmiLoanId">
                       <div class="form-group text-center mb-3">
                           <label id="payEmiIdTxt"></label>
                       </div>
                       <div class="form-group mb-3">
                           <label>EMI collected date</label>
                           <input type="date" id="emiTransactionDate" class="form-control">
                       </div>
                        <div class="form-group mb-3">
                           <label>Payment Mode</label>
                           <input type="text" id="emiPayMode" class="form-control">
                       </div>
                       <div class="form-group mb-3">
                           <label>Transaction Id</label>
                           <input type="text" id="emiTxnId" class="form-control">
                       </div>
                       <div class="form-group mb-3">
                           <label>Late Charge</label>
                           <input type="number" id="emiLateCharges" class="form-control">
                       </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                   <button type="button" class="btn btn-success bg-success" onclick="markAsPaidThisEmi();">Mark As Paid</button>
               </div>
               </form>
           </div>
       </div>
   </div>



   <div class="modal fade" id="initiateApplyLoanModalRaw" tabindex="-1" aria-labelledby="updateEmpInfoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="initiateApplyLoanModalHeading">Disburse Loan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
            </div>

            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="disburseModalAdminFrm">
                    <input type="hidden" id="actionLoanId" name="actionLoanId">
                    @csrf
                    <div id="initiateApplyLoanModalBodyRaw" class="row">
                        <div class="col-lg-12 mt-3">
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
                        <div class="col-lg-12 mt-3">
                            <label><strong>Invoice Number</strong></label>
                            <input type="text" id="invoiceNumber" value="" name="invoiceNumber" class="form-control">
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label><strong>Upload Invoice File</strong> <a class="btn btn-sm btn-link" id="viewinvoiceFile" href="" target="_blank">View File</a></label>
                            <input type="file" id="invoiceFile" value="" name="invoiceFile" class="form-control">
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label><strong>Upload Draw Down Form</strong> <a class="btn btn-sm btn-link"  id="viewdrawDownFormFile" href="" target="_blank">View File</a></label>
                            <input type="file" id="drawDownFormFile" value="" name="drawDownFormFile" class="form-control">
                        </div>

                        <div class="col-lg-6 mt-3">
                            <label><strong>UTR Name</strong> </label>
                            <input type="text" id="utrName" value="" name="utrName" class="form-control">
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label><strong>UTR File</strong> <a class="btn btn-sm btn-link" style="padding: 0px" id="viewUtrFile" href="" target="_blank">View File</a></label>
                            <input type="file" id="utrFile" value="" name="utrFile" class="form-control">
                        </div>

                        
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="rawProceedinitiateApplyLoanModal" class="btn btn-success bg-success" onclick="proceedApplication();">Disburse Now</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>


   <div class="modal fade" id="initiateApplyLoanModal" tabindex="-1" aria-labelledby="updateEmpInfoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Raw Material Financing Accounts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
            </div>

            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="applyLoanAdminFrm">
                    <input type="hidden" id="initiateApplyLoanUserId" name="initiateApplyLoanUserId">
                    @csrf
                    <div id="initiateApplyLoanModalBody"></div>
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

        function disburseRawAmount(loanId,loanAmount,invoiceNumber,invoiceFile,drawDownFormFile){
            $("#initiateApplyLoanModalRaw").modal('show');
            $('#actionLoanId').val(loanId);
            $('#processAmount').val(loanAmount);
            if(invoiceFile != '-'){ $("#invoiceNumber").val(invoiceNumber); }
            $("#viewinvoiceFile").attr('href','{{asset('/')}}public/'+invoiceFile)
            if(invoiceFile == '-'){ $("#viewinvoiceFile").remove(); }
            $("#viewdrawDownFormFile").attr('href','{{asset('/')}}public/'+drawDownFormFile)
            if(drawDownFormFile == '-'){ $("#viewdrawDownFormFile").remove(); }
        }

        function proceedApplication()
    {
        $("#rawProceedinitiateApplyLoanModal").attr('disabled',true);
        var actionType='out';
        var approveTenure=$('#approveTenure').val();
        var actionLoanId=$('#actionLoanId').val();
        var processAmount=$('#processAmount').val();
        var processDate=$('#processDate').val();
        var transactionId=$('#transactionId').val();
        var payment_mode=$('#payment_mode').val();

        if(!actionType || (actionType !='id' && actionType !='out') || !actionLoanId){
            alertMessage('Error!', 'Invalid Request, Please try again', 'error', 'yes');
            return false;
        }

        if(actionType=='out')
        {
            if(!parseInt(processAmount)){
                alertMessage('Error!', 'Please enter amount.', 'error', 'no');
                $("#rawProceedinitiateApplyLoanModal").attr('disabled',false);
                return false;
            }else if(!processDate){
                alertMessage('Error!', 'Please select date.', 'error', 'no');
                $("#rawProceedinitiateApplyLoanModal").attr('disabled',false);
                return false;
            }else if(!transactionId){
                alertMessage('Error!', 'Please enter transaction id.', 'error', 'no');
                $("#rawProceedinitiateApplyLoanModal").attr('disabled',false);
                return false;
            }else if(!payment_mode){
                alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
                $("#rawProceedinitiateApplyLoanModal").attr('disabled',false);
                return false;
            }
            else{
                waitForProcess();
                $('#disburseModalAdminFrm').submit();
            }
        }

    }

    $('#disburseModalAdminFrm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var actionType='out';
        var approveTenure=$('#approveTenure').val();
        var actionLoanId=$('#actionLoanId').val();
        var processAmount=$('#processAmount').val();
        var processDate=$('#processDate').val();
        var transactionId=$('#transactionId').val();
        var payment_mode=$('#payment_mode').val();

            if(!actionType || actionType !='out' || !actionLoanId){
                alertMessage('Error!', 'Invalid Request, Please try again', 'error', 'yes');
                return false;
            }

            if(!parseInt(processAmount)){
                alertMessage('Error!', 'Please enter amount.', 'error', 'no');
                $("#rawProceedinitiateApplyLoanModal").attr('disabled',false);
                return false;
            }else if(!processDate){
                alertMessage('Error!', 'Please select date.', 'error', 'no');
                $("#rawProceedinitiateApplyLoanModal").attr('disabled',false);
                return false;
            }else if(!transactionId){
                alertMessage('Error!', 'Please enter transaction id.', 'error', 'no');
                $("#rawProceedinitiateApplyLoanModal").attr('disabled',false);
                return false;
            }else if(!payment_mode){
                alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
                $("#rawProceedinitiateApplyLoanModal").attr('disabled',false);
                return false;
            }
            else{
            
            $.ajax({
                type:'POST',
                url: "{{route('disburseRawMaterialAppliedLoans')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
                    if(obj.status=='success'){
                        alertMessage('Success!', obj.message, 'success', 'yes');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                },
                error: function(data){
                    $("#rawProceedinitiateApplyLoanModal").attr('disabled',false);
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        }
    });


        function disburseAmount(loanId)
        {
            if(!parseInt(loanId)){
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else{
                swal({
                    title: 'Warning!',
                    text: 'Are you sure want to disburse this loan?',
                    icon: 'warning',
                    buttons:true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        waitForProcess();
                        $.post('{{route('disburseAmountAndCreateEmi')}}',{
                            "_token": "{{ csrf_token() }}",
                            loanId:loanId,
                        },function (data){
                            var obj = JSON.parse(data);
                            if(obj.status=='success')
                            {
                                $('#disburseAmountModal').modal('hide');
                                alertMessage('Success!', obj.message, 'success', 'yes');
                                return false;
                            }else{
                                alertMessage('Error!', obj.message, 'error', 'no');
                                return false;
                            }
                        });
                    }
                });
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

        // TODO Recived Table
        function filterUsersListsOther()
        {
            var customSearch=$('#customSearch').val();
            var fromDate=$('#fromDate').val();
            var toDate=$('#toDate').val();
            var userStatus=$('#userStatus').val();
            var loanType = $('#loanType').val();

            var currentUrl = $("#exportdatahref").attr('href');
            var url = new URL(currentUrl);
            url.searchParams.set("customSearch", customSearch||'');
            url.searchParams.set("userStatus", userStatus||'');

            if(fromDate && fromDate != undefined){
            url.searchParams.set("fromDate", fromDate);
            }
            if(toDate && toDate != undefined){
            url.searchParams.set("toDate", toDate);
            }

            $("#exportdatahref").attr('href',url);

            $('#mainTblHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
            $.post('{{route('filterUsersListsOther')}}',{
                "_token": "{{ csrf_token() }}",
                customSearch:customSearch,
                fromDate:fromDate,
                toDate:toDate,
                userStatus:userStatus,
                loanType:loanType,
                pageNameStr:'{{$pageNameStr}}'
            },function (data){
                $('#mainTblHtml').html(data);
                $('#mainTbl').DataTable();
            });
        }

        function getPaybleAmountBulletRepayment(loanId)
        {
            var bullet_repaymentLoanId=$('#bullet_repaymentLoanId').val();
            var bullet_repaymentCollectDate=$('#bullet_repaymentCollectDate').val();
            if(!parseInt(bullet_repaymentLoanId))
            {
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!bullet_repaymentCollectDate)
            {
                alertMessage('Error!', 'Please select collection date.', 'error', 'no');
                return false;
            }else{
                $.post('{{route('getPaybleAmountBulletRepayment')}}',{
                    "_token": "{{ csrf_token() }}",
                    loanId:bullet_repaymentLoanId,
                    bullet_repaymentCollectDate:bullet_repaymentCollectDate,
                },function (data){
                    var obj = JSON.parse(data);
                    if(obj.status=='success')
                    {
                        $('.bullet_repaymentHtml').show();
                        $('#bullet_repaymentPaybleAmount').val(obj.totalPaybleAmount);
                        $('#bullet_repaymentTotalInterest').val(obj.totalInterest);
                        // $('#bullet_repaymentInterestDays').val(obj.tenureInDays);
                        $('#bullet_repaymentTXNID').val('');
                        $('#bullet_repaymentPaymentMethod').val('');
                        $('#bullet_repaymentCollectDate').attr('disabled','disabled');
                        $('#bullet_repaymentSetButton').attr('onclick','sattleBulletRepaymentTxn();');
                        $('#bullet_repaymentSetButton').text('Sattle Loan');
                    }else{                        
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }
        
        function sattleBulletRepaymentTxn()
        {
            var bullet_repaymentLoanId=$('#bullet_repaymentLoanId').val();
            var bullet_repaymentCollectDate=$('#bullet_repaymentCollectDate').val();
            var bullet_repaymentPaymentMethod=$('#bullet_repaymentPaymentMethod').val();
            var bullet_repaymentTXNID=$('#bullet_repaymentTXNID').val();

            if(!parseInt(bullet_repaymentLoanId) || !bullet_repaymentCollectDate)
            {
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!bullet_repaymentCollectDate)
            {
                alertMessage('Error!', 'Please select collection date.', 'error', 'no');
                return false;
            }else if(!bullet_repaymentPaymentMethod)
            {
                alertMessage('Error!', 'Please enter the payment method.', 'error', 'no');
                return false;
            }else if(!bullet_repaymentTXNID)
            {
                alertMessage('Error!', 'Please enter the transaction id.', 'error', 'no');
                return false;
            }else{

                swal({
                    title: 'Warning!',
                    text: 'Are you sure want to sattle this loan?',
                    icon: 'warning',
                    buttons:true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        waitForProcess();
                        $.post('{{route('sattleBulletRepaymentTxn')}}',{
                            "_token": "{{ csrf_token() }}",
                            loanId:bullet_repaymentLoanId,
                            bullet_repaymentCollectDate:bullet_repaymentCollectDate,
                            transactionId:bullet_repaymentTXNID,
                            payment_mode:bullet_repaymentPaymentMethod,
                        },function (data){
                            var obj = JSON.parse(data);
                            if(obj.status=='success')
                            {
                                $('#emiDetails').modal('hide');
                                alertMessage('Success!', obj.message, 'success', 'yes');
                                return false;
                            }else{
                                alertMessage('Error!', obj.message, 'error', 'no');
                                return false;
                            }
                        });
                    }
                });
            }
        }
        
        function payEmiModalOpen(emiId,loanId)
        {
            $('#payEmiId').val(emiId);
            $('#payEmiLoanId').val(loanId);
            $('#payEmiIdTxt').html('Please enter the following details to mark as paid for emi Id '+$('#emiPayBtn'+emiId).attr('data-emiid')).css('color','red');
            $('#payEmiModal').modal('show');
            $('#emiDetails').modal('hide');
        }
        
        function markAsPaidThisEmi()
        {
            var payEmiId=$('#payEmiId').val();
            var payEmiLoanId=$('#payEmiLoanId').val();
            var emiPayMode=$('#emiPayMode').val();
            var transactionDate=$('#emiTransactionDate').val();
            var emiTxnId=$('#emiTxnId').val();
            var emiLateCharges=$('#emiLateCharges').val();
            if(!payEmiId || !payEmiLoanId)
            {
                alertMessage('Error!', 'Invalid request.', 'error', 'no');
                return false;
            }else if(!transactionDate)
            {
                alertMessage('Error!', 'Please select emi colleted date.', 'error', 'no');
                return false;
            }else if(!emiPayMode)
            {
                alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
                return false;
            }else if(!emiTxnId)
            {
                alertMessage('Error!', 'Please enter transaction Id.', 'error', 'no');
                return false;
            }else{
                waitForProcess();
                $.post('{{route('markAsPaidThisEmi')}}',{
                    "_token": "{{ csrf_token() }}",
                    payEmiId:payEmiId,
                    emiPayMode:emiPayMode,
                    emiTxnId:emiTxnId,
                    emiLateCharges:emiLateCharges,
                    transactionDate:transactionDate,
                },function (data){
                    var obj = JSON.parse(data);
                    
                    if(obj.status=='success')
                    {          
                        getLoanEmiDetails(payEmiLoanId);
                        $('#payEmiModal').modal('hide');
                        alertMessage('Success!', obj.message, 'success', 'no');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }
        
        $(document).ready(function (){
            filterUsersListsOther();
        });
        
        
        function resetFilter()
        {
            
            $('#customSearch').val('');
            $('#fromDate').val('');
            $('#toDate').val('');
            //$('#userStatus').val('');
            
            filterUsersListsOther();
        }
        
        
        function checkClickedOnPayOutStanding()
        {
            var checkClickedOnPayOutStandingBtn=$('#checkClickedOnPayOutStandingBtn:checked').val();
            if(checkClickedOnPayOutStandingBtn)
            {
                $('#outstandingPayHtml').show();
            }else{
                $('#outstandingPayHtml').hide();
            }
        }
        
        
        function payOutStandingAmtFn(loanId,userId)
        {
            var payOutStandingAmt1=parseInt($('#payOutStandingAmt1').val());
            var payOutStandingAmt=$('#payOutStandingAmt').val();
            var payOutStandingPayMode=$('#payOutStandingPayMode').val();
            var payOutStandingTxnId=$('#payOutStandingTxnId').val();
            var payOutStandingTxnDate=$('#payOutStandingTxnDate').val();
            
            if(!loanId || !userId)
            {
                alertMessage('Error!', 'Invalid request.', 'error', 'no');
                return false;
            }else if(!payOutStandingAmt)
            {
                alertMessage('Error!', 'Please enter amount whatever you want to pay.', 'error', 'no');
                return false;
            }else if(!payOutStandingPayMode)
            {
                alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
                return false;
            }else if(!payOutStandingTxnId)
            {
                alertMessage('Error!', 'Please enter transaction Id.', 'error', 'no');
                return false;
            }else if(!payOutStandingTxnDate)
            {
                alertMessage('Error!', 'Please select transaction date.', 'error', 'no');
                return false;
            }else if(parseInt(payOutStandingAmt)>payOutStandingAmt1)
            {
                alertMessage('Error!', 'Deposit amount cannot be greater than '+payOutStandingAmt1+' .', 'error', 'no');
                return false;
            }else{
                //waitForProcess();
                $.post('{{route('payOutStandingAmount')}}',{
                    "_token": "{{ csrf_token() }}",
                    loanId:loanId,
                    userId:userId,
                    payOutStandingAmt:payOutStandingAmt,
                    payOutStandingPayMode:payOutStandingPayMode,
                    payOutStandingTxnId:payOutStandingTxnId,
                    payOutStandingTxnDate:payOutStandingTxnDate,
                },function (data){
                    var obj = JSON.parse(data);
                    
                    if(obj.status=='success')
                    {          
                        getLoanEmiDetails(loanId);
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
    
@endsection

