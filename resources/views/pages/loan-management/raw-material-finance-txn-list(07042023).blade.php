@extends('layout.master')

@section('content')
    <main>
        <div class="breadcrums_area breadcrums">

            <div class="common_pagetitle">{{(strlen($pageTitle)>18) ? substr($pageTitle,0,18).'...' : $pageTitle}} </div>

            <div class="flex items-center space-x-4  lg:py-6 breadcrum_right">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl breadcrum_largetitle">
                    Dashboard
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="index.php">Home</a>
                        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li>{{(strlen($pageTitle)>18) ? substr($pageTitle,0,18).'...' : $pageTitle}} </li>
                </ul>
            </div>
        </div>

        <div class="main_page_title">
            <div class="common_pagetitlebig">{{$pageTitle}} </div>
            <div class="btns_rightimport">
            </div>
        </div>

        <section class="filters_table">

            <div class="row">
                <div class="col-lg-12">
                    <div class="tp_cardmain">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="loan_card">
                                    <div class="content_headerloan">
                                        <h1>Approved Loan Amount</h1>
                                        <h4>₹{{$loanDetails->approvedAmount}}</h4>
                                    </div>
                                    <div class="card_number">
                                        <p><strong>Rate of Interest</strong> <span>{{$loanDetails->rateOfInterest}}%</span></p>
                                    </div>
                                    <div class="loan_cdfooter">
                                        <div class="card_holder holder_details">
                                            <h1>Customer Name</h1>
                                            <p>{{$userDtl->name}}</p>
                                        </div>
                                        {{--<div class="current_due holder_details">
                                            <h1>Credit Days</h1>
                                            <p>90 Days</p>
                                        </div>--}}
                                    </div>
                                </div>

                                <div class="amount_limit">
                                    <h5>Limit</h5>
                                    <div class="progress h-3 bg-slate-150 dark:bg-navy-500">
                                        <div
                                            class="w-5/12 rounded-full bg-primary dark:bg-accent"
                                        ></div>
                                    </div>
                                    <div class="limit_amount">
                                        <p>₹{{$availableLimit}}<span> / ₹{{$loanDetails->approvedAmount}} </span></p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-8">
                                <div class="right_lddt">
                                    <div class="credit_debit_details">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="debitcard cd_details">
                                                    <h1>Amount Debit</h1>
                                                    <p>₹{{$totalDebit}}</p>
                                                    <div class="arrow_icon"><img src="{{asset('assets/admin')}}/images/uparrow.png" alt=""></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="creditcard cd_details">
                                                    <h1>Amount Credit</h1>
                                                    <p>₹{{$totalCredit}}</p>
                                                    <div class="arrow_icon"><img src="{{asset('assets/admin')}}/images/downarrow.png" alt=""></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="loanmore_details">
                                        <div class="lm_title">Customer Information</div>
                                        <div class="lmcard_customerdetails">
                                            <ul>

                                                <li>
                                                    <h1>Customer Name</h1>
                                                    <p>{{$userDtl->name}}</p>
                                                </li>
                                                <li>
                                                    <h1>Mobile</h1>
                                                    <p>{{$userDtl->mobile}}</p>
                                                </li>
                                                <li>
                                                    <h1>Email</h1>
                                                    <p>{{$userDtl->email}}</p>
                                                </li>
                                                <li>
                                                    <h1>Tenure</h1>
                                                    <p>{{$loanDetails->approvedTenureD}}</p>
                                                </li>
                                                <li>
                                                    <h1>Valid From</h1>
                                                    <p>{{(strtotime($loanDetails->validFromDate)) ? date('d M, Y',strtotime($loanDetails->validFromDate)) : ''}}</p>
                                                </li>
                                                <li>
                                                    <h1>Valid To</h1>
                                                    <p>{{(strtotime($loanDetails->validToDate)) ? date('d M, Y',strtotime($loanDetails->validToDate)) : ''}}</p>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col-lg-12" id="btnhistory">
                                            {{--
                                            <a href="javascript:;">
                                                <button Type="button"  class="btn bg-success btn_import2 font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                                                    Loan Settlement
                                                </button>
                                            </a>
                                            --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button type="button" onclick="disburseRawMaterialAmount();"
                                                            class="btn addbtn_right bg-danger font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                                                        <i class="fa-solid fa-money-bill-transfer"></i>
                                                        Disburse Amount
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" onclick="collectRawMaterialAmount();"
                                                            class="btn addbtn_right bg-success font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                                                        <i class="fa-solid fa-plus"></i>
                                                        Collect Amount
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" onclick="initiateCCLimit();"
                                                            class="btn addbtn_right bg-warning font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                                                        <i class="fa-solid fa-money-bill-transfer"></i>
                                                        Increase CC Limit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="transition_details">
                <div class="row">
                    <div class="col-lg-12">
                        <div x-data="{activeTab:'tabHome'}" class="tabs flex flex-col">
                            <div
                                class="is-scrollbar-hidden tab_bgdrk overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200"
                            >
                                <div class="tabs-list flex px-1.5 py-1">
                                    <button onclick="rewMaterialAppliedLoansTxnHistory('all');"
                                        @click="activeTab = 'tabHome'"
                                        :class="activeTab === 'tabHome' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                        class="btn shrink-0 space-x-2 px-3 py-1.5 font-medium"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4.5 w-4.5"
                                            fill="none"
                                            viewbox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                            ></path>
                                        </svg>
                                        <span> All Current Statement </span>
                                    </button>
                                    <button onclick="rewMaterialAppliedLoansTxnHistory('debit');"
                                        @click="activeTab = 'laststatement'"
                                        :class="activeTab === 'laststatement' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                        class="btn shrink-0 space-x-2 px-3 py-1.5 font-medium"
                                    >

                                        <span> <i class="fa-solid fa-credit-card"></i> Debit</span>
                                    </button>

                                    <button onclick="rewMaterialAppliedLoansTxnHistory('credit');"
                                        @click="activeTab = 'tabProfile'"
                                        :class="activeTab === 'tabProfile' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                        class="btn shrink-0 space-x-2 px-3 py-1.5 font-medium"
                                    >

                                        <span><i class="fa-solid fa-money-bills"></i> Credit</span>
                                    </button>


                                </div>
                            </div>
                            <div class="tab-content pt-4">
                                <div id="mainTblHtml" class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


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

    <div class="modal fade" id="collectLoanModal" tabindex="-1" aria-labelledby="updateEmpInfoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="collectLoanModalHeading">Collect Amount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                </div>

                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="applyLoanAdminFrm">
                        <input type="hidden" id="loanIdRawMaterial" name="loanIdRawMaterial">
                        @csrf
                        <div id="collectLoanModalBody"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success bg-success" id="sattleRawMaterialTxnBtn" style="display: none;" onclick="sattleRawMaterialTxn();">Settle Transaction</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="creditLimitModal" tabindex="-1" aria-labelledby="creditLimitModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="creditLimitModalHeading">Increate Credit Limit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                </div>

                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="applyLoanAdminFrm">
                        <input type="hidden" id="loanIdCreditLimit" name="loanIdCreditLimit">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label>Available CC Limit</label>
                                <input type="number" value="{{$loanDetails->approvedAmount}}" name="maxLimitAmount" id="maxLimitAmount" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success bg-success" id="creditLimitBtn"  onclick="increateCreditLimitFN();">Update CC Limit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    function rewMaterialAppliedLoansTxnHistory(filterType)
    {

        $('#mainTblHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
        $.post('{{route('rewMaterialAppliedLoansTxnHistory')}}',{
            "_token": "{{ csrf_token() }}",
            filterType:filterType,
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
        rewMaterialAppliedLoansTxnHistory('all');
    });

    function collectRawMaterialAmount(){
        $('#collectLoanModalBody').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
        $.post('{{route('collectRawMaterialAmount')}}',{
            "_token": "{{ csrf_token() }}",
            loanId:'{{$loanId}}'
        },function (data){
            var obj = JSON.parse(data);
            if(obj.status=='success'){
                $('#collectLoanModalBody').html(obj.data);
                $('.otherCollect').hide();
                $('#sattleRawMaterialTxnBtn').hide();
                $('#debitRecordId').val('');
                $('#collectionDate').val('');
                $('#collectionAmount').val('');
                $('#collectLoanModal').modal('show');
                $('#loanIdRawMaterial').val({{$loanId}});

            }else{
                alertMessage('Error!', obj.message, 'error', 'no');
                return false;
            }
        });
    }

    function sattleRawMatetialsTxnAutoCustom()
    {
        var collectionDate=$('#collectionDate').val();
        var collectionAmount=$('#collectionAmount').val();
        var transactionIdCredit=$('#transactionIdCredit').val();
        var payment_modeCredit=$('#payment_modeCredit').val();


        if(!$.trim(collectionDate)){
            alertMessage('Error!', 'Please select collect date.', 'error', 'no');
            return false;
        }else if(!parseInt(collectionAmount)){
            alertMessage('Error!', 'Please enter collect amount.', 'error', 'no');
            return false;
        }else if(!$.trim(transactionIdCredit)){
            alertMessage('Error!', 'Please enter transaction Id.', 'error', 'no');
            return false;
        }else if(!$.trim(payment_modeCredit)){
            alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
            return false;
        }else{
           //waitForProcess();
            $.post('{{route('sattleRawMatetialsTxnAutoCustom')}}',{
                "_token": "{{ csrf_token() }}",
                loanId:'{{$loanId}}',
                collectionDate:collectionDate,
                collectionAmount:collectionAmount,
                transactionIdCredit:transactionIdCredit,
                payment_modeCredit:payment_modeCredit,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#collectLoanModal').modal('hide');
                    alertMessage('Success!', obj.message, 'success', 'yes');
                    return false;
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }
    }


/*
    function getRawMaterialLoanCalcOnTxn(debitRecordId)
    {
        var debitRecordId=$('#debitRecordId').val();
        var collectionDate=$('#collectionDate').val();
        if(!$.trim(debitRecordId)){
            alertMessage('Error!', 'Please select transaction.', 'error', 'no');
            return false;
        }else if(!$.trim(collectionDate)){
            alertMessage('Error!', 'Please select collect date.', 'error', 'no');
            return false;
        }else{
            $.post('{{route('getRawMaterialLoanCalcOnTxn')}}',{
                "_token": "{{ csrf_token() }}",
                loanId:'{{$loanId}}',
                debitRecordId:debitRecordId,
                collectionDate:collectionDate,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){

                    var objD=obj.data;
                    $('#numOfDaysCredit').val(objD.numOfDays);
                    $('#roiCredit').val(objD.rateOfInterest);
                    $('#baseAmountCredit').val(objD.loanAmount);
                    $('#paybleAmountCredit').val(objD.playbleLoanAmount);
                    $('#interestAmountCredit').val(objD.totalInterest);
                    $('#interestAmountPaybleCredit').val(objD.interestPayble);
                    $('#tdsPercentCredit').val(objD.tdsPercent);
                    $('#tdsAmountCredit').val(objD.tdsAmount);

                    $('#sattleRawMaterialTxnBtn').show();
                    $('.otherCollect').show();
                    $('#loanIdRawMaterial').val({{$loanId}});
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }
    }

    function sattleRawMaterialTxn()
    {
        var debitRecordId=$('#debitRecordId').val();
        var collectionDate=$('#collectionDate').val();

        var baseAmountCredit=$('#baseAmountCredit').val();
        var transactionIdCredit=$('#transactionIdCredit').val();
        var payment_modeCredit=$('#payment_modeCredit').val();
        var interestAmountCredit=$('#interestAmountCredit').val();
        var numOfDaysCredit=$('#numOfDaysCredit').val();
        var paybleAmountCredit=$('#paybleAmountCredit').val();
        var tdsPercentCredit=$('#tdsPercentCredit').val();
        var tdsAmountCredit=$('#tdsAmountCredit').val();
        var interestAmountPaybleCredit=$('#interestAmountPaybleCredit').val();

        if(!$.trim(debitRecordId)){
            alertMessage('Error!', 'Please select transaction.', 'error', 'no');
            return false;
        }else if(!$.trim(collectionDate)){
            alertMessage('Error!', 'Please select collect date.', 'error', 'no');
            return false;
        }else if(!$.trim(baseAmountCredit) || !$.trim(interestAmountCredit) || !$.trim(numOfDaysCredit) || !$.trim(paybleAmountCredit) || !$.trim(tdsPercentCredit) || !$.trim(tdsAmountCredit) || !$.trim(interestAmountPaybleCredit)){
            alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
            return false;
        }else if(!$.trim(transactionIdCredit)){
            alertMessage('Error!', 'Please enter transaction Id.', 'error', 'no');
            return false;
        }else if(!$.trim(payment_modeCredit)){
            alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
            return false;
        }else{
            $.post('{{route('sattleRawMaterialTxn')}}',{
                "_token": "{{ csrf_token() }}",
                loanId:'{{$loanId}}',
                debitRecordId:debitRecordId,
                collectionDate:collectionDate,
                transactionIdCredit:transactionIdCredit,
                payment_modeCredit:payment_modeCredit,
                interestAmountCredit:interestAmountCredit,
                numOfDaysCredit:numOfDaysCredit,
                paybleAmountCredit:paybleAmountCredit,
                tdsPercentCredit:tdsPercentCredit,
                tdsAmountCredit:tdsAmountCredit,
                interestAmountPaybleCredit:interestAmountPaybleCredit,
                baseAmountCredit:baseAmountCredit
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#collectLoanModal').modal('hide');
                    alertMessage('Success!', obj.message, 'success', 'yes');
                    return false;
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }
    }
    */

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
        var approveTenure=$('#approveTenure').val();
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
            }
            /*else if(!approveTenure){
                alertMessage('Error!', 'Please select tenure.', 'error', 'no');
                return false;
            }*/
            else if(!processDate){
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
                    approveTenure:approveTenure,
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

    function initiateCCLimit()
    {
        $('#loanIdCreditLimit').val('{{$loanId}}');
        $('#creditLimitModal').modal('show');
    }

    function increateCreditLimitFN()
    {
        var loanIdCreditLimit=$('#loanIdCreditLimit').val();
        var maxLimitAmount=$('#maxLimitAmount').val();
        if(!parseInt(loanIdCreditLimit))
        {
                alertMessage('Error!','Invalid Request', 'error', 'no');
                return false;
        }else if(!parseInt(maxLimitAmount))
        {
                alertMessage('Error!', 'Please enter amount for credit limit.', 'error', 'no');
                return false;
        }else{
            swal({
                title: 'Warning!',
                text: 'Are you sure want to change the Credit Limit?',
                icon: 'warning',
                buttons:true,
                closeOnClickOutside: false,
            }).then((willDelete) => {
                if (willDelete) {
                    $.post('{{route('increateCreditLimitRawmaterial')}}',{
                        "_token": "{{ csrf_token() }}",
                        loanIdCreditLimit:loanIdCreditLimit,
                        maxLimitAmount:maxLimitAmount,
                    },function(data){
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
            });
        }
    }
</script>
@endsection
