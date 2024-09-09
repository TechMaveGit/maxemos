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
{{-- @dd($userDtl) --}}
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
                                @php
                                    $leftamount = $availableLimit/$loanDetails->approvedAmount;
                                    $leftamount = $leftamount*100;
                                @endphp
                                <div class="amount_limit">
                                    <h5>Limit</h5>
                                    <div class="progress h-3 bg-slate-150 dark:bg-navy-500">
                                        <div class=" rounded-full bg-primary dark:bg-accent" style="width:{{$leftamount}}%;"></div>
                                    </div>
                                    <div class="limit_amount">
                                        <p>₹{{$availableLimit}}<span> / ₹{{$loanDetails->approvedAmount}} </span></p>
                                    </div>
                                </div>
                                <div class="amount_limit">
                                    <h5 style="font-weight: 600;color:#000;">Out Standing Amount</h5>
                                    <p>₹{{ number_format($OutStandingAmount,2) }}</p>
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
                                                @if(strtotime($loanDetails->validToDate) < time())
                                                <li>
                                                    <button type="button" onclick="renewaloanRawMaterialAmount();" class="btn addbtn_right bg-dark font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                                                        <i class="fa-solid fa-rotate-left"></i>
                                                        Renewal Loan
                                                    </button>
                                                </li>
                                                @endif

                                                @php
                                                    $renewaloan = DB::table('renewal_loans')->where('loanid',$loanDetails->id)->where('type_renewal','renewal')->get();
                                                    $ccUpdateHistory = DB::table('renewal_loans')->where('loanid',$loanDetails->id)->where('type_renewal','pf')->get();
                                                @endphp

                                                
                                                <li>
                                                    @if($renewaloan)
                                                    <button type="button" onclick="renewaloanHistoryRawMaterialAmount();" class="btn addbtn_right bg-primary font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                                                        <i class="fa-solid fa-timeline"></i>
                                                        Renewal History 
                                                    </button>
                                                    <div class="modal fade" id="renewaloanHistoryRawMaterialAmount" tabindex="-1" aria-labelledby="updateEmpInfoModal" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title">Renewal History</h3>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                                                                </div>
                                                
                                                                <div class="modal-body">
                                                                    <table class="table basic_tablecustom">
                                                                        <thead>
                                                                                <th>S.No.</th>
                                                                                <th>Valid From</th>
                                                                                <th>Valid To</th>
                                                                                <th>Platform Fee</th>
                                                                                <th>Txn Date</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($renewaloan as $rloan)
                                                                            <tr>
                                                                                <td>{{$loop->iteration}}</td>
                                                                                <td>{{$rloan->renewal_from}}</td>
                                                                                <td>{{$rloan->renewal_to}}</td>
                                                                                <td>{{$rloan->plateform_fee}}</td>
                                                                                <td>{{$rloan->txn_date}}</td>
                                                                            </tr>
                                                                            @endforeach
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($ccUpdateHistory)
                                                    <button type="button" onclick="ccloanHistoryRawMaterialAmount();" class="btn addbtn_right bg-primary font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                                                        <i class="fa-solid fa-timeline"></i>
                                                        CC Limit History 
                                                    </button>
                                                    <div class="modal fade" id="ccloanHistoryRawMaterialAmount" tabindex="-1" aria-labelledby="updateEmpInfoModal" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title">CC Limit History</h3>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                                                                </div>
                                                
                                                                <div class="modal-body">
                                                                    <table class="table basic_tablecustom">
                                                                        <thead>
                                                                                <th>S.No.</th>
                                                                                <th>Previous CC Limit</th>
                                                                                <th>Updated CC Limit</th>
                                                                                <th>Platform Fee</th>
                                                                                <th>Created Date</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($ccUpdateHistory as $rloan)
                                                                            <tr>
                                                                                <td>{{$loop->iteration}}</td>
                                                                                <td>{{$rloan->lastAmount}}</td>
                                                                                <td>{{$rloan->updatedAmount}}</td>
                                                                                <td>{{$rloan->plateform_fee}}</td>
                                                                                <td>{{$rloan->txn_date}}</td>
                                                                            </tr>
                                                                            @endforeach
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
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
                                                    @if ($userDtl->kycStatus == "approved" && $userDtl->viewKycDetails == 1)
                                                        
                                                    
                                                    {{-- onclick="disburseRawMaterialAmount();" --}}
                                                    <button type="button"  onclick="disburseRequestRawMaterialAmount();"
                                                            class="btn addbtn_right bg-danger font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                                                        <i class="fa-solid fa-money-bill-transfer"></i>
                                                        Disburse Schedule
                                                    </button>
                                                    @else
                                                    <button type="button"  onclick="disburseRequestRawMaterialAmountKycApprove();"
                                                            class="btn addbtn_right bg-danger font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                                                        <i class="fa-solid fa-money-bill-transfer"></i>
                                                        Disburse Schedule
                                                    </button>
                                                    @endif
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
                        
                    <div class="col-lg-12 card card-body">
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

                                    <button onclick="rewMaterialAppliedLoansTxnHistory('due');"
                                        @click="activeTab = 'tabDueProfile'"
                                        :class="activeTab === 'tabDueProfile' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                        class="btn shrink-0 space-x-2 px-3 py-1.5 font-medium"
                                    >

                                        <span><i class="fa-solid fa-money-bills"></i> Due Summary</span>
                                    </button>
                                    <div style="width: 100% !important;display: block;text-align: right;">
                                        <a  id="exportdataSheetRaw" class="btn btn-primary creditamt_btn" href="<?php echo route('adminExportReports',['page'=>'customer-rawmaterial-dataexport']); ?>/?loanId=<?php echo $loanDetails->id;?>&filterData=all">
                                            <i class="fa-solid fa-money-bill-transfer"></i> Export Data
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-content pt-4">
                                <div id="mainTblHtml" class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1">

                                </div>
                            </div>
                        </div>
                    </div>

                    <?php $pendingDisbmentRequest = DB::table('raw_materials_loan_requests')->where(['loanId'=>$loanDetails->id])->orderBy('created_at','DESC')->get(); 
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
                    <form method="POST" enctype="multipart/form-data" id="disburseModalAdminFrm">
                        <input type="hidden" id="actionLoanId" name="actionLoanId">
                        <input type="hidden" id="actionUserId" name="actionUserId">
                        <input type="hidden" id="actionType" name="actionType">
                        @csrf
                        <div id="initiateApplyLoanModalBody"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success bg-success" onclick="proceedApplication(this);">Proceed</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="renewalaoninitiateApplyLoanModal" tabindex="-1" aria-labelledby="updateEmpInfoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Renewal Loan</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="{{ route('renewalRawMaterialAppliedLoans') }}" enctype="multipart/form-data" id="renewaldisburseModalAdminFrm">
                        <input type="hidden" id="renewalactionLoanId" name="actionLoanId">
                        <input type="hidden" id="renewalactionUserId" name="actionUserId">
                        @csrf
                        <div id="renewalaoninitiateApplyLoanModalBody">
                            <div class="col-lg-12 mt-3">
                                <label><strong>Renewal Amount</strong></label>
                                <input type="number" id="renewalAmount" name="renewalAmount" value="" class="form-control">
                            </div>
                            
                            <div class="col-lg-12 mt-3">
                                <label><strong>Txn Date</strong></label>
                                <input type="date" id="renewtxndate" value="" name="renewtxndate" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success bg-success" onclick="renewproceedApplication();">Renew</button>
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
                            <div class="col-md-12 mt-3">
                                <label>Platform Fee</label>
                                <input type="number" value="" name="platformFee" id="platformFee" class="form-control">
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
                        <div class="row mt-3">
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
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <strong>UTR Name</strong> <span id="utrNameV"></span> <br>
                                <a href="" style="color:blue;" target="_blank" id="utrFormFileV">View UTR File</a>
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

    function disburseRequestRawMaterialAmountKycApprove(){
        alertMessage('Error!', "Need to verify customer kyc. ", 'error', 'no');
    }

    function rewMaterialAppliedLoansTxnHistory(filterType)
    {
        var currentHref = $('#exportdataSheetRaw').attr('href');
        var updatedHref = currentHref.replace(/(\?|&)filterData=[^&]*/, '$1filterData='+filterType);
        $('#exportdataSheetRaw').attr('href', updatedHref);

        $('#mainTblHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
        $.post('{{route('rewMaterialAppliedLoansTxnHistory')}}',{
            "_token": "{{ csrf_token() }}",
            filterType:filterType,
            loanId:'{{$loanId}}',
            pageNameStr:'{{$pageNameStr}}'
        },function (data){
            var obj = JSON.parse(data);
            console.log(obj);
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

    function renewproceedApplication(){

    }

    function sattleRawMatetialsTxnAutoCustom(that)
    {
      	$(that).attr('disabled',true);
        setTimeout(() => {
            $(that).attr('disabled',false);
        }, 4000);
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

    function renewaloanRawMaterialAmount(){
        $('#renewalactionLoanId').val('{{$loanDetails->id}}');
        $('#renewalactionUserId').val('{{$loanDetails->userId}}');
        $('#renewalaoninitiateApplyLoanModal').modal('show');
    }

    function renewaloanHistoryRawMaterialAmount(){
        $('#renewaloanHistoryRawMaterialAmount').modal('show');
    }

    function ccloanHistoryRawMaterialAmount(){
        $('#ccloanHistoryRawMaterialAmount').modal('show');
    }

    function renewproceedApplication(){
        var actionLoanId=$('#renewalactionLoanId').val();
        var actionUserId=$('#renewalactionUserId').val();
        var renewalAmount=$('#renewalAmount').val();
        var renewtxndate=$('#renewtxndate').val();

        if(!actionLoanId || !actionUserId){
            alertMessage('Error!', 'Invalid Request, Please try again', 'error', 'yes');
            return false;
        }

        if(!parseInt(renewalAmount)){
            alertMessage('Error!', 'Please enter amount.', 'error', 'no');
            return false;
        }else if(!renewtxndate){
            alertMessage('Error!', 'Please select date.', 'error', 'no');
            return false;
        }else{
            waitForProcess();
            $('#renewaldisburseModalAdminFrm').submit();
        }
    }

    function disburseRequestRawMaterialAmount(){
        $('#initiateApplyLoanModalHeading').html('Disburse Schedule Loan');
        var htmlStr =`<div class="col-lg-12 mt-3">
            <label><strong>Disburse Amount</strong></label>
            <input type="number" id="processAmount" name="processAmount" value="" class="form-control">
        </div>
        
        <div class="col-lg-12 mt-3">
            <label><strong>Disburse Date</strong></label>
            <input type="date" id="processDate" value="" name="disburseDate" class="form-control">
        </div>`;

        $('#initiateApplyLoanModalBody').html(htmlStr);
        $('#actionType').val('out');
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
        <div class="col-lg-12 mt-3">
            <label><strong>Invoice Number</strong></label>
            <input type="text" id="invoiceNumber" value="" name="invoiceNumber" class="form-control">
        </div>
        <div class="col-lg-12 mt-3">
            <label><strong>Upload Invoice File</strong></label>
            <input type="file" id="invoiceFile" value="" name="invoiceFile" class="form-control">
        </div>
        <div class="col-lg-12 mt-3">
            <label><strong>Upload Draw Down Form</strong></label>
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
        `;


        $('#initiateApplyLoanModalBody').html(htmlStr);
        $('#actionType').val('out');
        $('#actionLoanId').val('{{$loanDetails->id}}');
        $('#actionUserId').val('{{$loanDetails->userId}}');
        $('#initiateApplyLoanModal').modal('show');
    }

    function proceedApplication(that)
    {
      	$(that).attr('disabled',true);
        setTimeout(() => {
            $(that).attr('disabled',false);
        }, 4000);
        var actionType=$('#actionType').val();
        var approveTenure=$('#approveTenure').val();
        var actionLoanId=$('#actionLoanId').val();
        var actionUserId=$('#actionUserId').val();
        var processAmount=$('#processAmount').val();
        var processDate=$('#processDate').val();
        // var transactionId=$('#transactionId').val();
        // var payment_mode=$('#payment_mode').val();

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
            }
            // else if(!transactionId){
            //     alertMessage('Error!', 'Please enter transaction id.', 'error', 'no');
            //     return false;
            // }else if(!payment_mode){
            //     alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
            //     return false;
            // }
            else{
                waitForProcess();
                $('#disburseModalAdminFrm').submit();
                /*$.post('{{route('disburseRawMaterialAppliedLoans')}}',{
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
                });*/
            }
        }

    }

    $('#disburseModalAdminFrm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var actionType=$('#actionType').val();
        var approveTenure=$('#approveTenure').val();
        var actionLoanId=$('#actionLoanId').val();
        var actionUserId=$('#actionUserId').val();
        var processAmount=$('#processAmount').val();
        var processDate=$('#processDate').val();
        // var transactionId=$('#transactionId').val();
        // var payment_mode=$('#payment_mode').val();

            if(!actionType || actionType !='out' || !actionLoanId || !actionUserId){
                alertMessage('Error!', 'Invalid Request, Please try again', 'error', 'yes');
                return false;
            }

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
            }
            // else if(!transactionId){
            //     alertMessage('Error!', 'Please enter transaction id.', 'error', 'no');
            //     return false;
            // }else if(!payment_mode){
            //     alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
            //     return false;
            // }
            else{
            
            $.ajax({
                type:'POST',
                url: "{{route('disburseRequestRawMaterialAppliedLoans')}}",
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
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        }
    });
    
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
        var platformFee=$('#platformFee').val();
        if(!parseInt(loanIdCreditLimit))
        {
                alertMessage('Error!','Invalid Request', 'error', 'no');
                return false;
        }else if(!parseInt(maxLimitAmount))
        {
                alertMessage('Error!', 'Please enter amount for credit limit.', 'error', 'no');
                return false;
        }else if(!parseInt(platformFee))
        {
                alertMessage('Error!', 'Please enter amount for platform fee.', 'error', 'no');
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
                        platformFee:platformFee,
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
    
    function openInvFiles(loanIdDisburseId)
    {
        var invoiceNumber=$('#rawFile'+loanIdDisburseId).attr('data-invoiceNumber');
        var invoiceFile=$('#rawFile'+loanIdDisburseId).attr('data-invoiceFile');
        var drawDownFormFile=$('#rawFile'+loanIdDisburseId).attr('data-drawDownFormFile');

        var urtName=$('#rawFile'+loanIdDisburseId).attr('data-urtName');
        var urtFile=$('#rawFile'+loanIdDisburseId).attr('data-urtFile');
        
        $('#invoiceNumberV').html(invoiceNumber);
        $('#invoiceFileV').attr('href',`{{asset('/')}}public/${invoiceFile}`);
        $('#drawDownFormFileV').attr('href',`{{asset('/')}}public/${drawDownFormFile}`);

        $('#utrNameV').html(urtName);
        if(urtFile == undefined){
            $('#utrFormFileV').attr('href',`javascript:void(0);`);
        }else{
            $('#utrFormFileV').attr('href',`{{asset('/')}}public/${urtFile}`);
        }
        

        $('#rawDocsModal').modal('show');

    }
</script>

<script>
// $.post('{{route('disburseAmountAndCreateEmi')}}',{
//                         "_token": "{{ csrf_token() }}",
//                         loanId:'58',
//                     },function(data){
//                         var obj = JSON.parse(data);
//                         if(obj.status=='success'){
//                             alertMessage('Success!', obj.message, 'success', 'yes');
//                             return false;
//                         }else{
//                             alertMessage('Error!', obj.message, 'error', 'no');
//                             return false;
//                         }
//                     });
</script>
@endsection
