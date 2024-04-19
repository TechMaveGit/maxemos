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
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="javascript:;">Reports</a>
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
                @if ($pageName == 'over-due-payments' || $pageName == 'raw-over-due-payments')
                <div><strong>Total Over Due : </strong><span id="totalOverDue_amount" class="text-danger" style="font-weight: 700;"></span></div>
                @endif
            </div>
        </div>

        <section class="filters_table">
            <div class="filters">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="row">
                            <div class="{{ $pageName == 'over-due-payments' ? 'col-lg-4' : 'col-lg-6' }}">
                                <div class="form-group">
                                    <label class="block">
                                        <span><?=($pageName == 'received-payments') ? 'Select Date' : 'From' ?></span>
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
                            <div class="{{ $pageName == 'over-due-payments' ? 'col-lg-4' : 'col-lg-6' }}">
                                @if($pageName != 'received-payments')
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
                                @endif
                                
                            </div>
                            @if($pageName == 'over-due-payments')
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="block">
                                        <span>Loan Type</span>
                                        <select id="loanTypereportFilter" class="form-select mt-1.5 w-full rounded-full border border-slate-300 bg-white px-4 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                            <option value="">All Loan</option>
                                            <option value="1">Business Loan</option>
                                            <option value="2">Personal loan</option>
                                            <option value="8">Outstanding Loan</option>
                                        </select>
                                    </label>
                                </div>
                                
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <span>&nbsp;</span>
                        <div class="form-group without_lablebtn">
                            <button type="button" onclick="filterCustomReports();" class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                Search
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <span>&nbsp;</span>
                        <div class="form-group without_lablebtn">
                            <a href="javascript:void(0)" onclick="location.reload()" style="padding: 11px 35px 10px 35px !important;" class="btn min-w-[7rem] btn-warning rounded-full  text-white">
                               Reset Search
                            </a>
                        </div>
                    </div>
                    @if($pageName == 'over-due-payments' || $pageName == 'raw-over-due-payments')
                    <div class="col-lg-2 col-md-12">
                        <div class="form-group">
                            <a id="exportdatahref" href="{{route('adminExportReports',['page'=>$pageName])}}" class="btn btn-info mt-4 text-white"> Export Data</a> 
                        </div>
                    </div>
                    @endif
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

@endsection
@section('scripts')
<script>
        function filterCustomReports()
        {
            var fromDate=$('#fromDate').val();
            var toDate=$('#toDate').val();
            var loanType=$('#loanTypereportFilter').val()||null;

            var currentUrl = $("#exportdatahref").attr('href');
            if(currentUrl){
                var url = new URL(currentUrl);

                if(fromDate){
                url.searchParams.set("fromDate", fromDate);
                }
                if(toDate){
                url.searchParams.set("toDate", toDate);
                }
                
                if(loanType){
                url.searchParams.set("loanType", loanType);
                }
            }

            $("#exportdatahref").attr('href',url);

            $('#mainTblHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
            $.post('{{route('customReportsFilter')}}',{
                "_token": "{{ csrf_token() }}",
                fromDate:fromDate,
                toDate:toDate,
                pageName:'{{$pageName}}',
                loanType:loanType
            },function (data){
                $('#mainTblHtml').html(data);
                $('#totalOverDue_amount').text($('#overDueAmountHidden').text())
                $('#mainTbl').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{ extend: 'excelHtml5', text: 'Export Excel' },
                        //'copyHtml5',
                        //'excelHtml5',
                        //'csvHtml5',
                        //'pdfHtml5'
                    ]
                } );
            });
        }

        $(document).ready(function (){
            filterCustomReports();
        });
    </script>
@endsection
