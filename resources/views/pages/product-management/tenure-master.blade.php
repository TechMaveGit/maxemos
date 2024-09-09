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
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="javascript:;">Product Management</a>
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
                <button  type="button" onclick="openAddCatModal();" class="btn addbtn_right bg-success btn_import font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                    <i class="fa-solid fa-plus"></i>
                    Add Tenure
                </button>
            </div>
        </div>

        <section class="filters_table">

            <div class="table_mainstart">
                <div class="row">
                    <div class="col-lg-8">
                        &nbsp;
                    </div>
                    <div class="col-lg-4">
                        <select name="cateroryName" id="cateroryName" class="form-select" onchange="getTenureList(this.value);">
                            <option value="">All</option>
                            @if(count($category))
                                @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <div>
                            <div class="card mt-3">
                                <div class="is-scrollbar-hidden min-w-full overflow-x-auto" id="tenureHtml" x-data="pages.tables.initExample1">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table end -->
        </section>
    </main>


    <div class="modal fade" id="addEditCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100 heading_title" >
                        Add Tenure
                    </h3>
                    <button @click="showModal = !showModal" data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="form_boxmodal">

                    <div class="form-wizard">
                        <div class="myContainer">
                            <div class="form-container animated">
                                <form class="forms-sample" id="actionForm" method="post" enctype="multipart/form-data">

                                    @csrf
                                    <div class="inputes_start">
                                        <div class="mb-3">
                                            <input type="hidden" id="recordId" name="recordId">
                                            <label for="loanCategory" class="form-label">Category Name</label>
                                            <select class="form-select" id="loanCategory" name="loanCategory">
							                <option value="">Select Category</option>
							                @if(count($category))
							                    @foreach($category as $cat)
							                        <option value="{{$cat->id}}">{{$cat->name}}</option>
							                    @endforeach
							                @endif
							            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tenureTitle" class="form-label">Tenure Title</label>
                                            <input type="text" class="form-control" id="tenureTitle" name="tenureTitle" autocomplete="off" placeholder="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="numOfMonths" class="form-label">Tenure Months/Year</label>
                                            <input type="text" class="form-control" id="numOfMonths" name="numOfMonths" autocomplete="off" placeholder="Ex- 1 Month, 1 Month 15 Days, 1 Year, 1 Year 6 Months">
                                        </div>
                                        <div class="mb-3">
                                            <label for="numOfEmis" class="form-label">No. Of EMI</label>
                                            <input type="number" class="form-control" id="numOfEmis" name="numOfEmis" autocomplete="off" value="" placeholder="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="sortOrder" class="form-label">Sort Order</label>
                                            <input type="number" class="form-control" id="sortOrder" name="sortOrder" autocomplete="off" value="0" placeholder="">
                                        </div>
                                        <div class="btn-list mt-4">
                                            <button id="formSubmitBtn" type="submit" class="btn btn-primary bg-primary">
                                                Save
                                            </button>
                                            <a href="javascript:void(0);" id="resetBtn" style="display: none;" onclick="$('#addEditCategoryModal').modal('hide');" class="btn btn-danger">Close</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- wizard end -->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function (){
            $('.is-hoverable').DataTable();
        });
    </script>
    <script>
        $('#actionForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            var recordId=$('#recordId').val();
            var loanCategory=$('#loanCategory').val();
            var tenureTitle=$('#tenureTitle').val();
            var numOfMonths=$('#numOfMonths').val();
            var numOfEmis=$('#numOfEmis').val();
            var sortOrder=$('#sortOrder').val();
            if(!loanCategory){
                alertMessage('Error!', 'Please select the category name.', 'error', 'no');
                return false;
            } else if(!tenureTitle) {
                alertMessage('Error!', 'Please enter the tenure title.', 'error', 'no');
                return false;
            }else if(!numOfMonths) {
                alertMessage('Error!', 'Please enter tenure months/year.', 'error', 'no');
                return false;
            }else if(!parseInt(numOfEmis)) {
                alertMessage('Error!', 'Please enter number of emi.', 'error', 'no');
                return false;
            }else if(!parseInt(sortOrder)) {
                alertMessage('Error!', 'Please enter the sort number.', 'error', 'no');
                return false;
            }else{
                $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');
                $.ajax({
                    type:'POST',
                    url: "{{route('saveTenureDetails')}}",
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
        function setInputs(recordId)
        {
            $('#recordId').val(recordId);
            $('#tenureTitle').val($('#editInputs'+recordId).attr('data-name'));
            $('#numOfMonths').val($('#editInputs'+recordId).attr('data-numOfMonths'));
            $('#loanCategory').val($('#editInputs'+recordId).attr('data-loanCategory'));
             $('#sortOrder').val($('#editInputs'+recordId).attr('data-sortOrder'));
             $('#numOfEmis').val($('#editInputs'+recordId).attr('data-numOfEmis'));
            $('.heading_tloanCategoryitle').html('Edit Tenure');
            $('#resetBtn').show();
            $('#addEditCategoryModal').modal('show');
        }

        function openAddCatModal()
        {
            $('#recordId').val('');
            $('#catName').val('');
            $('#catDesc').val('');
            $('#sortOrder').val(0);
            $('.heading_title').html('Add Tenure');
            $('#resetBtn').show();
            $('#addEditCategoryModal').modal('show');
        }

        function deleteCategory(recordId)
        {
            swal({
                title: 'Warning!',
                text: 'Are you sure want to delete this category?',
                icon: 'warning',
                buttons:true,
            }).then((willDelete) => {
                if(willDelete)
                {
                    waitForProcess();
                    $.post('{{route('deleteCategory')}}',{
                        "_token": "{{ csrf_token() }}",
                        recordId:recordId,
                    },function (data){
                        var obj = JSON.parse(data);
                        if(obj.status=='success')
                        {
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

        function updateCategoryStatusMaster(recordId,status)
        {
            if(status=='1')
            {
                var textMessage='Are you sure want to active this category?';
            }else{
                var textMessage='Are you sure want to deactive this category?';
            }

            swal({
                title: 'Warning!',
                text: textMessage,
                icon: 'warning',
                buttons: true,
                closeOnClickOutside: false,
            }).then((willDelete) => {
                if (willDelete) {
                    waitForProcess();
                    $.post('{{route('updateCategoryStatusMaster')}}',{
                        "_token": "{{ csrf_token() }}",
                        recordId:recordId,
                        status:status,
                    },function (data){
                        var obj = JSON.parse(data);
                        if(obj.status=='success'){
                            alertMessage('Success!', obj.message, 'success', 'no');
                            setTimeout(function (){
                                location.reload();
                            },400);
                        }else{
                            alertMessage('Error!', obj.message, 'error', 'no');
                            return false;
                        }
                    });
                }
            });
        }
        
        function getTenureList(catId)
        {
            $.post('{{route('filterTenureList')}}',{
                "_token": "{{ csrf_token() }}",
                catId:catId,
            },function (data){
               $('#tenureHtml').html(data);
               $('#mainTbl').DataTable();
            });
        }
        
        getTenureList('');
    </script>
@endsection
