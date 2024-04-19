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
                @elseif ($pageTitle=='Raw Material Financing Loans')
                    <a id="exportdatahref" href="{{route('adminExportReports',['page'=>'raw-material-financing-loans'])}}" class="btn btn-info mt-4 text-white"> Raw Material Loan Open Limit Export Data</a> 
                
                @endif

            </div>
        </div>

        <section class="filters_table">
            
            <div class="filters" @if($pageNameStr=='due-renewal-raw-material-financing-loans') hidden @endif>
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="block">
                                        <span>Filter by Search</span>
                                        <span class="relative mt-1.5 flex">
                                          <input id="customSearch" name="customSearch" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent   placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter name" type="text">
                                          <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                          </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
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
                    <div class="col-lg-2 col-md-12">
                        <span>&nbsp;</span>
                        <div class="form-group without_lablebtn">
                            <button type="button" onclick="filterUsersCustomerManagement();" class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                Search
                            </button>
                        </div>
                    </div>
                    
                    {{-- <div class="col-lg-2 col-md-12">
                        <span>&nbsp;</span>
                        <div class="form-group without_lablebtn">
                            <button type="button" onclick="filterUsersCustomerManagement();" class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                Export
                            </button>
                        </div>
                    </div> --}}
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
    function filterUsersCustomerManagement()
    {
        var customSearch=$('#customSearch').val();
        var fromDate=$('#fromDate').val();
        var toDate=$('#toDate').val();
        var userStatus=$('#userStatus').val();

        var currentUrl = $("#exportdatahref").attr('href');
        if(currentUrl){
        var url = new URL(currentUrl);

        if(fromDate){
        url.searchParams.set("fromDate", fromDate);
        }
        if(toDate){
        url.searchParams.set("toDate", toDate);
        }
        if(customSearch){
        url.searchParams.set("customSearch", customSearch);
        }
        if(userStatus){
        url.searchParams.set("userStatus", userStatus);
        }
    }

        $("#exportdatahref").attr('href',url);


        $('#mainTblHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
        $.post('{{route('filterCustomerForRawMaterialFinancingLoans')}}',{
            "_token": "{{ csrf_token() }}",
            customSearch:customSearch,
            fromDate:fromDate,
            toDate:toDate,
            userStatus:userStatus,
            pageNameStr:'{{$pageNameStr}}'
        },function (data){
            $('#mainTblHtml').html(data);
            $('.is-hoverable').DataTable();
        });
    }

    $(document).ready(function (){
        $('#customerCodeHtml').hide();
        filterUsersCustomerManagement();
    });

    function initiateApplyLoan(userId)
    {
        $.post('{{route('initiateApplyLoan')}}',{
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
</script>
@endsection
