@extends('layout.master')

@section('content')
<style>
    .btn_import2 {
  padding: 8px 7px;
}
</style>
    <main >
        <div class="breadcrums_area breadcrums">
            <div class="common_pagetitle">Raw Material Pending Files</div>
                
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
                    <li>Raw Material Pending Files</li>
                </ul>
            </div>
        </div>

        <div class="main_page_title">
            <div class="common_pagetitlebig" style="width: 30%;">Raw Material Pending Files</div>
            <div class="btns_rightimport" style="display: inline-flex">
                {{-- <div><strong>Total Amount : </strong><span id="totalCustomers" class="text-danger" style="font-weight: 700;"></span></div> --}}
            </div>
        </div>
        <section class="filters_table">
            <div class="filters">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                           
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="block">
                                        <span>From</span>
                                        <span class="relative mt-1.5 flex">
                                          <input x-flatpickr="" id="fromDate" name="fromDate"  class="form-input peer w-full rounded-full border border-slate-300 bg-transparent placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input active" placeholder="Choose date..." type="text" readonly="readonly">
                                          <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                          </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="block">
                                        <span>To</span>
                                        <span class="relative mt-1.5 flex">
                                          <input x-flatpickr="" id="toDate" name="toDate"  class="form-input peer w-full rounded-full border border-slate-300 bg-transparent placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input" placeholder="Choose date..." type="text" readonly="readonly">
                                          <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                          </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <button type="button" onclick="filterRawPendingFileReport();" class="btn btn-block mt-4 rounded-full bg-danger font-medium text-white hover:bg-danger-focus focus:bg-danger-focus active:bg-danger-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    Search
                                </button>
                                <a href="javascript:;" onclick="resetFilter();" class="btn btn-block mt-4 rounded-full bg-warning font-medium text-white hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Reset Filter</a>
                                <a id="exportdatahref" href="{{route('adminExportReports',['page'=>'raw-pending-files'])}}/?loanreportFilter=none" class="btn btn-info mt-4 text-white"> Export Data</a> 
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="table_mainstart">
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div class="card mt-3">
                                <div id="mainTblHtml" class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1"><div id="mainTbl_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="mainTbl_length"><label>Show <select name="mainTbl_length" aria-controls="mainTbl" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="mainTbl_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="mainTbl"></label></div><table id="mainTbl" class="is-hoverable w-full text-left dataTable no-footer" role="grid" aria-describedby="mainTbl_info">
                                <thead>
                                <tr role="row"><th whitespace-nowrap="" rounded-tl-lg="" bg-slate-200="" px-4="" py-3="" font-semibold="" uppercase="" text-slate-800="" dark:bg-navy-800="" dark:text-navy-100="" lg:px-5="" class="sorting_asc" tabindex="0" aria-controls="mainTbl" rowspan="1" colspan="1" style="width: 82.8px;" aria-sort="ascending" aria-label="Profile: activate to sort column descending">Profile</th><th whitespace-nowrap="" rounded-tl-lg="" bg-slate-200="" px-4="" py-3="" font-semibold="" uppercase="" text-slate-800="" dark:bg-navy-800="" dark:text-navy-100="" lg:px-5="" class="sorting" tabindex="0" aria-controls="mainTbl" rowspan="1" colspan="1" style="width: 96.3px;" aria-label="Cust. ID: activate to sort column ascending">Cust. ID</th><th whitespace-nowrap="" rounded-tl-lg="" bg-slate-200="" px-4="" py-3="" font-semibold="" uppercase="" text-slate-800="" dark:bg-navy-800="" dark:text-navy-100="" lg:px-5="" class="sorting" tabindex="0" aria-controls="mainTbl" rowspan="1" colspan="1" style="width: 79.7667px;" aria-label="Name: activate to sort column ascending">Name</th><th whitespace-nowrap="" rounded-tl-lg="" bg-slate-200="" px-4="" py-3="" font-semibold="" uppercase="" text-slate-800="" dark:bg-navy-800="" dark:text-navy-100="" lg:px-5="" class="sorting" tabindex="0" aria-controls="mainTbl" rowspan="1" colspan="1" style="width: 74.9333px;" aria-label="Email: activate to sort column ascending">Email</th><th whitespace-nowrap="" rounded-tl-lg="" bg-slate-200="" px-4="" py-3="" font-semibold="" uppercase="" text-slate-800="" dark:bg-navy-800="" dark:text-navy-100="" lg:px-5="" class="sorting" tabindex="0" aria-controls="mainTbl" rowspan="1" colspan="1" style="width: 124.967px;" aria-label="Mobile No.: activate to sort column ascending">Mobile No.</th><th whitespace-nowrap="" rounded-tl-lg="" bg-slate-200="" px-4="" py-3="" font-semibold="" uppercase="" text-slate-800="" dark:bg-navy-800="" dark:text-navy-100="" lg:px-5="" class="sorting" tabindex="0" aria-controls="mainTbl" rowspan="1" colspan="1" style="width: 122.367px;" aria-label="Loan Type: activate to sort column ascending">Loan Type</th><th whitespace-nowrap="" rounded-tl-lg="" bg-slate-200="" px-4="" py-3="" font-semibold="" uppercase="" text-slate-800="" dark:bg-navy-800="" dark:text-navy-100="" lg:px-5="" class="sorting" tabindex="0" aria-controls="mainTbl" rowspan="1" colspan="1" style="width: 65.9333px;" aria-label="Date: activate to sort column ascending">Date</th><th whitespace-nowrap="" rounded-tl-lg="" bg-slate-200="" px-4="" py-3="" font-semibold="" uppercase="" text-slate-800="" dark:bg-navy-800="" dark:text-navy-100="" lg:px-5="" class="sorting" tabindex="0" aria-controls="mainTbl" rowspan="1" colspan="1" style="width: 84.5167px;" aria-label="Status: activate to sort column ascending">Status</th><th whitespace-nowrap="" rounded-tl-lg="" bg-slate-200="" px-4="" py-3="" font-semibold="" uppercase="" text-slate-800="" dark:bg-navy-800="" dark:text-navy-100="" lg:px-5="" class="sorting" tabindex="0" aria-controls="mainTbl" rowspan="1" colspan="1" style="width: 84.8167px;" aria-label="Action: activate to sort column ascending">Action</th></tr>
                                </thead>
                                <tbody><tr class="odd"><td colspan="9" class="dataTables_empty" valign="top">No data available in table</td></tr></tbody>
                            </table><div class="dataTables_info" id="mainTbl_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div><div class="dataTables_paginate paging_simple_numbers" id="mainTbl_paginate"><a class="paginate_button previous disabled" aria-controls="mainTbl" data-dt-idx="0" tabindex="0" id="mainTbl_previous">Previous</a><span></span><a class="paginate_button next disabled" aria-controls="mainTbl" data-dt-idx="1" tabindex="0" id="mainTbl_next">Next</a></div></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table end -->
        </section>

        <section class="filters_table">
                            
            <div class="table_mainstart">
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div class="card mt-3">
                                <div id="mainTblHtml" class="" x-data="pages.tables.initExample1">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table end -->
        </section>
    </main>
    



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
                                <a  style="color:blue;" target="_blank" id="invoiceFileV">View Invoice</a>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <strong>Draw Down Form</strong><br>
                                <a  style="color:blue;" target="_blank" id="drawDownFormFileV">View Draw Down Form</a>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <strong>UTR Name</strong> <span id="utrNameV"></span> <br>
                                <a  style="color:blue;" target="_blank" id="utrFormFileV">View UTR File</a>
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



    <div class="modal fade" id="rawDocsModalUploads" tabindex="-1" aria-labelledby="rawDocsModalUploads" aria-hidden="true">
        <form method="POST" action="{{route('rawPendingDocsUpload')}}"  enctype="multipart/form-data" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title">Uploaded Raw Pending Document </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                </div>

                <div class="modal-body">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <strong>Invoice Number</strong><br>
                                <input class="form-control" type="hidden" name="raw_disb_loan_id" id="uraw_disb_loan_id" />
                                <input class="form-control" type="hidden" name="raw_loan_id" id="uraw_loan_id" />
                                <input class="form-control" type="text" name="invoice_number" id="uinvoice_number" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <strong>Invoice File</strong> <a target="_blank" class="btn-link" id="uinvoice_file_label"></a> <br>
                                <input class="form-control" type="file" name="invoiceFile" id="uinvoice_file" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <strong>Draw Down Form</strong> <a target="_blank" class="btn-link" id="udraedownform_label"></a><br>
                                <input class="form-control" type="file" name="drawDownFormFile" id="udraedownform" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <strong>UTR Name</strong> <span id="utrNameV"></span> <br>
                                <input class="form-control" type="text" name="utr_name" id="uutr_name" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <strong>UTR File</strong> <a target="_blank" class="btn-link" id="uutr_file_label"></a> <br>
                                <input class="form-control" type="file" name="utrFormFile" id="uutr_file" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success bg-success" >Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
    </div>
@endsection
@section('scripts')
<script>
   

    function resetFilter(){
        location.reload();
    }

        function filterRawPendingFileReport()
        {
            var fromDate=$('#fromDate').val();
            var toDate=$('#toDate').val();

            var currentUrl = $("#exportdatahref").attr('href');
            var url = new URL(currentUrl);
           

            if(fromDate){
            url.searchParams.set("fromDate", fromDate);
            }
            if(toDate){
            url.searchParams.set("toDate", toDate);
            }

            $("#exportdatahref").attr('href',url);

            $('#mainTblHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
            $.post('{{route('filterRawPendingFileReport')}}',{
                "_token": "{{ csrf_token() }}",
                fromDate:fromDate,
                toDate:toDate,
            },function (data){
                $('#mainTblHtml').html(data);
                $('.is-hoverableable').DataTable({
                    "ordering": false
                });

                $("#totalCustomers").text($("#totalCust").text() != '' ? $("#totalCust").text() : 0 );
            });
        }

        $(document).ready(function (){
            filterRawPendingFileReport();
        });


        function openInvFiles(loanIdDisburseId)
        {
            var invoiceNumber=$('#rawFile'+loanIdDisburseId).attr('data-invoiceNumber');
            var invoiceFile=$('#rawFile'+loanIdDisburseId).attr('data-invoiceFile');
            var drawDownFormFile=$('#rawFile'+loanIdDisburseId).attr('data-drawDownFormFile');

            var urtName=$('#rawFile'+loanIdDisburseId).attr('data-urtName');
            var urtFile=$('#rawFile'+loanIdDisburseId).attr('data-urtFile');
            
            $('#invoiceNumberV').html(invoiceNumber);
            if(invoiceFile && invoiceFile != ""){
                $('#invoiceFileV').attr('href',`{{asset('/')}}public/${invoiceFile}`);
            }else{
                $('#invoiceFileV').attr('href','javascript:void(0)').text('No File Exist').attr('target','');
            }
            if(drawDownFormFile && drawDownFormFile != ""){
                $('#drawDownFormFileV').attr('href',`{{asset('/')}}public/${drawDownFormFile}`);
            }else{
                $('#drawDownFormFileV').attr('href','javascript:void(0)').text('No File Exist').attr('target','');
            }

            $('#utrNameV').html(urtName);
            if(urtFile && urtFile != ""){
                $('#utrFormFileV').attr('href',`{{asset('/')}}public/${urtFile}`);
            }else{
                $('#utrFormFileV').attr('href','javascript:void(0)').text('No File Exist').attr('target','');
            }
            $('#rawDocsModal').modal('show');
        }

        function rewMaterialAppliedLoansUpload(that,mainId,loanIdDisburseId){
            let invoiceNumber = $(that).attr('data-invoiceNumber');
            let invoiceFile = $(that).attr('data-invoiceFile');
            let drawDownFormFile = $(that).attr('data-drawDownFormFile');
            let utr_name = $(that).attr('data-utr_name');
            let utr_file = $(that).attr('data-utr_file');


            $("#uinvoice_number").val(invoiceNumber);
            $("#uutr_name").val(utr_name);
            if(invoiceFile && invoiceFile != ""){
                $("#uinvoice_file_label").attr('href',`{{asset('/')}}public/${invoiceFile}`);
                $("#uinvoice_file_label").text('View File');
            }

            if(drawDownFormFile && drawDownFormFile != ""){
                $("#udraedownform_label").attr('href',`{{asset('/')}}public/${drawDownFormFile}`);
                $("#udraedownform_label").text('View File');
            }
            if(utr_file && utr_file != ""){
                $("#uutr_file_label").attr('href',`{{asset('/')}}public/${utr_file}`);
                $("#uutr_file_label").text('View File');
            }

            $("#uraw_disb_loan_id").val(mainId);
            $("#uraw_loan_id").val(loanIdDisburseId);
            $('#rawDocsModalUploads').modal('show');
        }
    </script>

@if(session()->get('success'))

<script>

    alertMessage('Success !', "{{session()->get('success')}}", 'success', 'yes');

</script>

@elseif(session()->get('error'))

<script>

    alertMessage('Error !', "{{session()->get('error')}}", 'error', 'no');

</script>

@endif
@endsection
