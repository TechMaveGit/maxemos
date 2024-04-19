@extends('layout.master')

@section('content')
    <main>
        <div class="breadcrums_area breadcrums">

            <div class="common_pagetitle">Tech Support</div>

            <div class="flex items-center space-x-4  lg:py-6 breadcrum_right">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl breadcrum_largetitle">
                    Dashboard
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="javascript:voide(0);">Important Links</a>
                        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li>Tech Support</li>
                </ul>
            </div>
        </div>

        <div class="main_page_title">
            <div class="common_pagetitlebig">Tech Support</div>
            <div class="btns_rightimport">
                <button onclick="createTkt();"
                        class="btn addbtn_right bg-success btn_import font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                    <i class="fa-solid fa-plus"></i>
                    Create issue / Ticket
                </button>
            </div>
        </div>

        <div class="filters">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="block">
                                    <span>Priority</span>
                                    <select id="filterPriority" name="filterPriority" class="form-select mt-1.5 w-full rounded-full border border-slate-300 bg-white px-4 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                        <option value="">Select</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium </option>
                                        <option value="Low">Low </option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
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
                        <div class="col-lg-3">
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
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="block">
                                    <span>Status</span>
                                    <select id="filterStatus" name="filterStatus" class="form-select mt-1.5 w-full rounded-full border border-slate-300 bg-white px-4 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                        <option value="">Select</option>
                                        <option value="New">New</option>
                                        <option value="Working">Working </option>
                                        <option value="Closed">Closed </option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12">
                    <span>&nbsp;</span>
                    <div class="form-group without_lablebtn">
                        <button onclick="return filterSupportQuery();" class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="table_mainstart" id="sc_table">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card table_maincard">
                                <div class="card-body ">


                        <div class="card mt-3">
                            <div id="techSupportHtml" class="is-scrollbar-hidden min-w-full overflow-x-auto"x-data="pages.tables.initExample1">

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
                </div>
            </div>
        </div>
        <!-- table end -->
        </section>
    </main>






    <!-- add category Modal start-->
    <div class="modal fade" id="add_edit_faq_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100" id="add_User_tkt_modalHeading">
                        Create issue / Ticket
                    </h3>
                    <button @click="showModal = !showModal" data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="form_boxmodal">
                    <form id="actionForm" method="POST" enctype="multipart/form-data">
                        <div class="mainfrm_box">
                            <div class="row">
                                <input type="hidden" id="recordId" name="recordId">
                                @csrf
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="tktTitle" class="form-label">Ticket Title</label>
                                        <input type="text" class="form-control" id="tktTitle" name="tktTitle" autocomplete="off" placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Priority</label>
                                        <select class="form-select" id="tktPriority" name="tktPriority" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="High">High</option>
                                            <option value="Medium">Medium </option>
                                            <option value="Low">Low </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="exampleInputdate" class="form-label">Date</label>
                                        <div class="input-group date datepicker" id="datePickerExample2">
                                            <input type="date" id="tktDate" name="tktDate" class="form-control">
                                            <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select class="js-example-basic-single2 form-select" id="tktStatus" name="tktStatus" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="New">New</option>
                                            <option value="Working">Working</option>
                                            <option value="Closed">Closed </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="tktDesc" class="form-label">Description</label>
                                        <textarea class="form-control" id="tktDesc" rows="5" name="tktDesc" autocomplete="off" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Upload Files</h6>
                                                <input type="file" id="myDropify" name="myDropify"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="formSubmitBtn" class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Save </button>
                            </div>
                        </div>
                    </form>

                    </form>
                </div>
            </div>
        </div>
        <!-- add category modal end -->

        @endsection
        @section('scripts')
            <script>
                $('#actionForm').submit(function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    var recordId= $('#recordId').val();
                    var tktTitle=$('#tktTitle').val();
                    var tktPriority=$('#tktPriority').val();
                    var tktDate=$('#tktDate').val();
                    var tktStatus=$('#tktStatus').val();
                    var tktDesc=$('#tktDesc').val();
                    var myDropify=$('#myDropify').val();
                    if(!tktTitle){
                        alertMessage('Error!', 'Please enter the title.', 'error', 'no');
                        return false;
                    } else if(!tktPriority) {
                        alertMessage('Error!', 'Please select priority.', 'error', 'no');
                        return false;
                    } else if(!tktDate) {
                        alertMessage('Error!', 'Please select ticket date.', 'error', 'no');
                        return false;
                    } else if(!tktStatus) {
                        alertMessage('Error!', 'Please select ticket status.', 'error', 'no');
                        return false;
                    } else if(!tktDesc) {
                        alertMessage('Error!', 'Please enter the description.', 'error', 'no');
                        return false;
                    }else{
                        $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');
                        $.ajax({
                            type:'POST',
                            url: "{{route('saveTicketDetails')}}",
                            data: formData,
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                var obj = JSON.parse(data);
                                $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                                if(obj.status=='success')
                                {
                                    $('#recordId').val('');
                                    $('#catName').val('');
                                    $('#catDesc').val('');
                                    alertMessage('Success!', obj.message, 'success', 'yes');
                                    return false;
                                }else{
                                    alertMessage('Error!', obj.message, 'error', 'no');
                                    return false;
                                }
                            },
                            error: function(data){
                                $('#formSubmitBtn').text('Save').removeAttr('disabled');
                                alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                                return false;
                                //console.log(data);
                            }
                        });
                    }
                });

                function filterSupportQuery()
                {
                    var filterPriority=$('#filterPriority').val();
                    var fromDate=$('#fromDate').val();
                    var toDate=$('#toDate').val();
                    var filterStatus=$('#filterStatus').val();

                    $('#techSupportHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
                    $.post('{{route('filterSupportQuery')}}',{
                        "_token": "{{ csrf_token() }}",
                        filterPriority:filterPriority,
                        fromDate:fromDate,
                        toDate:toDate,
                        filterStatus:filterStatus,
                    },function (data){
                        $('#techSupportHtml').html(data);
                        $('.is-hoverable').DataTable();
                    });
                }

                $(document).ready(function(){
                    filterSupportQuery();
                });

                function createTkt()
                {
                    $('#recordId').val('');
                    $('#tktTitle').val('');
                    $('#tktPriority').val('');
                    $('#tktDate').val('');
                    $('#tktStatus').val('');
                    $('#tktDesc').val('');
                    $('#myDropify').val('');
                    $('#add_User_tkt_modalHeading').html('Create issue / Ticket ');
                    $('#add_User_tkt_modal').modal('show');
                }

                function editTkt(recordId)
                {
                    $('#recordId').val(recordId);
                    $('#tktTitle').val($('#editTkt'+recordId).attr('tktTitle'));
                    $('#tktPriority').val($('#editTkt'+recordId).attr('tktPriority'));
                    $('#tktDate').val($('#editTkt'+recordId).attr('tktDate'));
                    $('#tktStatus').val($('#editTkt'+recordId).attr('tktStatus'));
                    $('#tktDesc').val($('#editTkt'+recordId).attr('tktDesc'));
                    $('#myDropify').val('');
                    $('#add_User_tkt_modalHeading').html('Edit Ticket ');
                    $('#add_User_tkt_modal').modal('show');
                }

                function changePriorityStatus(recordId,status)
                {
                    if(status=='1'){
                        var statusText='Low';
                    }else if(status=='2'){
                        var statusText='Medium';
                    }else if(status=='3'){
                        var statusText='High';
                    }

                    if(!statusText){
                        return false;
                    }

                    swal({
                        title: 'Warning!',
                        text: 'Are you sure mark the priority status as '+statusText+'?',
                        icon: 'warning',
                        buttons:true,
                        closeOnClickOutside: false,
                    }).then((willDelete) => {
                        if (willDelete) {
                            waitForProcess();
                            $.post('{{route('changePriorityStatus')}}',{
                                "_token": "{{ csrf_token() }}",
                                recordId:recordId,
                                status:statusText,
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
                    });
                }

                function changeTicketStatus(recordId,status)
                {
                    if(status=='1'){
                        var statusText='New';
                    }else if(status=='2'){
                        var statusText='Working';
                    }else if(status=='3'){
                        var statusText='Closed';
                    }

                    if(!statusText){
                        return false;
                    }

                    swal({
                        title: 'Warning!',
                        text: 'Are you sure mark the ticket status as '+statusText+'?',
                        icon: 'warning',
                        buttons:true,
                        closeOnClickOutside: false,
                    }).then((willDelete) => {
                        if (willDelete) {
                            waitForProcess();
                            $.post('{{route('changeTicketStatus')}}',{
                                "_token": "{{ csrf_token() }}",
                                recordId:recordId,
                                status:statusText,
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
                    });
                }
            </script>
@endsection

