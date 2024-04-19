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
                    Add Category
                </button>
            </div>
        </div>

        <section class="filters_table">

            <div class="table_mainstart">
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div class="card mt-3">
                                <div class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1">
                                    <?php
                                    $TBLLTHCLS='whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5';
                                    $htmlStr ='<table id="mainTbl" class="is-hoverable w-full text-left dataTable no-footer">
                                            <thead>
                                              <tr>
                                               <th '.$TBLLTHCLS.'>S.No.</th>
                                                <th '.$TBLLTHCLS.'>Category Name</th>
                                                <th '.$TBLLTHCLS.'>Description</th>
                                                  <th '.$TBLLTHCLS.'>Status</th>
                                                    <th '.$TBLLTHCLS.'>Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>';
                                    $srn=1;
                                    foreach ($category as $crow)
                                    {
                                        

                                        $statusStr=($crow->status==1) ? '<label class="label label-success">Active</label>' : '<label class="label label-danger">Deactive</label>';

                                        $buttons='';

                                        if($crow->status==1){
                                            $buttons .='<a href="javascript:void(0);" onclick="updateCategoryStatusMaster('.$crow->id.',0);"  class="btn btn-danger" ><i class="fa fa-thumbs-down"></i> </a>';
                                        }else{
                                            $buttons .='<a href="javascript:void(0);" onclick="updateCategoryStatusMaster('.$crow->id.',1);"  class="btn btn-success" ><i class="fa fa-thumbs-up"></i> </a>';
                                        }

                                        $buttons .='<a href="javascript:void(0);" id="editInputs'.$crow->id.'" onclick="setInputs('.$crow->id.');"  data-name="'.$crow->name.'" data-desc="'.$crow->description.'" class="btn btn-primary" ><i class="fa fa-pencil"></i> </a>
                                        <!--<a href="javascript:void(0);" class="btn btn-danger" onclick="deleteCategory('.$crow->id.');" ><i class="fa fa-trash"></i></a>-->';

                                        $htmlStr .='<tr>
                                                        <td>'.$srn.'</td>
                                                        <td>'.$crow->name.'</td>
                                                        <td>'.$crow->description.'</td>
                                                        <td>'.$statusStr.'</td>
                                                        <td>'.$buttons.'</td>
                                                    </tr>';
                                        $srn++;
                                    }

                                    $htmlStr .='</tbody>
                                            </table>';
                                    echo $htmlStr;
                                    ?>
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
                        Add Category
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
                                            <label for="catName" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" id="catName" name="catName" autocomplete="off" placeholder="">
                                        </div>

                                        <div class="mb-3">
                                            <label for="catDesc" class="form-label">Description</label>
                                            <textarea class="form-control" id="catDesc" name="catDesc" rows="5"></textarea>
                                        </div>
                                        <div class="mb-3" hidden>
                                            <label class="form-label">Upload Category icon or image</label>
                                            <input type="file" class="form-control" id="myDropify" name="myDropify"/>
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

            // var recordId=$('#recordId').val();
            var catName=$('#catName').val();
            var catDesc=$('#catDesc').val();
            // var myDropify=$('#myDropify').val();
            if(!catName){
                alertMessage('Error!', 'Please enter the category name.', 'error', 'no');
                return false;
            } else if(!catDesc) {
                alertMessage('Error!', 'Please enter the category description.', 'error', 'no');
                return false;
            }
            // else if(!$.trim(recordId) && !myDropify) {
            //     alertMessage('Error!', 'Please upload category image or icon.', 'error', 'no');
            //     return false;
            // }
            else{
                $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');
                $.ajax({
                    type:'POST',
                    url: "{{route('saveCategory')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        var obj = JSON.parse(data);
                        $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                        if(obj.status=='success')
                        {
                            // $('#recordId').val('');
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
            $('#catName').val($('#editInputs'+recordId).attr('data-name'));
            $('#catDesc').val($('#editInputs'+recordId).attr('data-desc'));
            $('.heading_title').html('Edit Category');
            $('#resetBtn').show();
            $('#addEditCategoryModal').modal('show');
        }

        function openAddCatModal()
        {
            $('#recordId').val('');
            $('#catName').val('');
            $('#catDesc').val('');
            $('.heading_title').html('Add Category');
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
    </script>
@endsection
