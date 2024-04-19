@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />

  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
  @endpush

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"><span class="user_name_title">Product Sub Categories</span></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Product Management</li>
                                <li class="breadcrumb-item active">Product Sub Categories</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

<div class="page-header d-lg-flex d-block">
   <div class="page-leftheader">
      <div class="page-title"> Product Sub Categories </div>
   </div>

<div class="page-rightheader ms-md-auto">
   <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
      <div class="btn-list">
       <!-- <a href="javascript:void(0);" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#add_User_modal"><i data-feather="plus" class="btn-icon-prepend feather_iconfont"></i> Product Sub Category</a> -->
       <!-- <a href="javascript:void(0);" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </a>
       <a href="javascript:void(0);" class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </a> <a href="javascript:void(0);" class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </a> -->
     </div>
   </div>
</div>
</div>

<div class="row">
  <div class="col-lg-4 add_category_col">
         <div class="card">
           <div class="card-body">
           <form class="forms-sample">
           <div class="add_category_panel">
               <div class="heading_title">Add New Sub Category</div>
           </div>
         <div class="inputes_start">
         <div class="mb-3">
            <label for="catName" class="form-label">Sub Category Name</label>
            <input type="text" class="form-control" id="catName" autocomplete="off" placeholder="">
          </div>
          <div class="mb-3">
            <label for="parentCat" class="form-label">Select Parent Category</label>
            <select class="form-select" id="parentCat">
                <option selected="" disabled="">Select Category</option>
                @if(count($category))
                    @foreach($category as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                @endif
            </select>
          </div>

          <div class="btn-list">
       <a href="javascript:void(0);" id="formSubmitBtn" onclick="saveCategory();" class="btn btn-primary">
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus btn-icon-prepend feather_iconfont"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add New Category</a>

     </div>
         </div>
           </form>

         </div>
    </div>
  </div>
  <div class="col-lg-8 grid-margin stretch-card">
    <div class="card table_maincard">
      <div class="card-body ">


        <div class="row" id="filters">
   <div class="col-lg-8 col-md-12">
      <div class="row">
          <div class="col-lg-12">
          <div class="form-group">
            <label for="name" class="form-label">Search Sub Category </label>
            <input id="name" class="form-control" name="name" type="text">
          </div>
          </div>

      </div>
   </div>

   <div class="col-lg-4 col-md-12">
      <div class="form-group without_lablebtn"> <a href="javascript:void(0);" class="btn btn-primary btn-block">Search Product Categories</a> </div>
   </div>
</div>


        <div class="table-responsive bank_table">
          <table id="dataTableExample" class="table table-bordered">
            <thead>
              <tr>
                <th>S.No.</th>
                <th>Parent Category Name</th>
                <th>Subcategory Name</th>
                  <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @php
                $srn=1;
            @endphp
            @if(count($subcategory))
                @foreach($subcategory as $crow)
                    <tr>
                        <td>{{$srn++}}</td>
                        <td>{{$crow->categoryName}}</td>
                        <td>{{$crow->name}}</td>
                        <td>{{($crow->status==1) ? 'Active' : 'Deactive'}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="javascript:void(0);" id="editInputs{{$crow->id}}" onclick="setInputs({{$crow->id}});"  data-name="{{$crow->name}}"  data-categoryId="{{$crow->categoryId}}" class="action-btns1" ><i data-feather="edit-2" class="btn-icon-prepend feather_iconfont text-success"></i> </a>
                                <a href="javascript:void(0);" class="action-btns1" onclick="deleteCategory({{$crow->id}});"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i data-feather="trash-2" class="btn-icon-prepend feather_iconfont text-danger"></i></a>
                                @if($crow->status==1)
                                    <a href="javascript:void(0);" onclick="updateSubCategoryStatusMaster({{$crow->id}},0);"  class="action-btns1" style="color: red;" ><i class="fa fa-thumbs-down"></i> </a>
                                @else
                                    <a href="javascript:void(0);" onclick="updateSubCategoryStatusMaster({{$crow->id}},1);"  class="action-btns1" style="color: forestgreen;" ><i class="fa fa-thumbs-up"></i> </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- edit User modal start -->
<div class="example add_User_modalstart">
      <!-- Modal -->
      <div class="modal fade" id="edit_subCat_modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Edit Sub Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">

            <form class="forms-sample">
              <div class="row">
                <div class="col-lg-6">
                <div class="mb-3">
                <label for="catName2" class="form-label">Sub Category Name </label>
                    <input type="hidden" id="recordId" name="recordId">
                <input type="text" class="form-control" id="catName2" autocomplete="off" placeholder="6 Months EMI">
              </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="parentCat2" class="form-label">Parent Category  </label>
                        <select class="form-select" id="parentCat2">
                            <option selected="" disabled="">Select Category</option>
                            @if(count($category))
                                @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="formSubmitBtn2" onclick="editCategory();" class="btn btn-primary">Save</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection


@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush

<!-- form elements -->

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/timepicker.js') }}"></script>
@endpush


@push('plugin-scripts')
  <script>
    var varyingModal = document.getElementById('varyingModal')
    varyingModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-bs-* attributes
      var recipient = button.getAttribute('data-bs-whatever')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      var modalTitle = varyingModal.querySelector('.modal-title')
      var modalBodyInput = varyingModal.querySelector('.modal-body input')

      modalTitle.textContent = 'New message to ' + recipient
      modalBodyInput.value = recipient
    })
  </script>
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
@endpush
@section('scripts')
    <script>

        function saveCategory()
        {
            var catName=$('#catName').val();
            var parentCat=$('#parentCat').val();
            if(!parentCat){
                alertMessage('Error!', 'Please enter the parent category.', 'error', 'no');
                return false;
            } else if(!catName) {
                alertMessage('Error!', 'Please enter the sub category name.', 'error', 'no');
                return false;
            }else{
                $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');
                $.post('{{route('saveSubCategory')}}',{
                    "_token": "{{ csrf_token() }}",
                    catName:catName,
                    parentCat:parentCat,
                },function (data){
                    var obj = JSON.parse(data);
                    $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                    if(obj.status=='success')
                    {
                        $('#recordId').val('');
                        $('#catName').val('');
                        $('#parentCat').val('');
                        alertMessage('Success!', obj.message, 'success', 'no');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }

        function editCategory()
        {
            var recordId=$('#recordId').val();
            var catName=$('#catName2').val();
            var parentCat=$('#parentCat2').val();
            if(!recordId){
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!parentCat){
                alertMessage('Error!', 'Please enter the parent category.', 'error', 'no');
                return false;
            } else if(!catName) {
                alertMessage('Error!', 'Please enter the sub category name.', 'error', 'no');
                return false;
            }else{
                $('#formSubmitBtn2').text('Please Wait...').attr('disabled','disabled');
                $.post('{{route('saveSubCategory')}}',{
                    "_token": "{{ csrf_token() }}",
                    recordId:recordId,
                    catName:catName,
                    parentCat:parentCat,
                },function (data){
                    var obj = JSON.parse(data);
                    $('#formSubmitBtn2').text('Save').removeAttr('disabled');
                    if(obj.status=='success')
                    {
                        $('#recordId').val('');
                        $('#catName2').val('');
                        $('#parentCat2').val('');
                        $('#edit_subCat_modal').modal('hide');
                        alertMessage('Success!', obj.message, 'success', 'yes');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }

        function setInputs(recordId)
        {
            $('#recordId').val(recordId);
            $('#catName2').val($('#editInputs'+recordId).attr('data-name'));
            $('#parentCat2').val($('#editInputs'+recordId).attr('data-categoryId'));
            $('#edit_subCat_modal').modal('show');
        }

        function deleteCategory(recordId)
        {
            swal({
                title: 'Warning!',
                text: 'Are you sure want to delete this Sub-Category?',
                icon: 'warning',
                buttons: true,
            }).then((willDelete) => {
                if(willDelete)
                {
                    waitForProcess();
                    $.post('{{route('deleteSubCategory')}}',{
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

        function updateSubCategoryStatusMaster(recordId,status)
        {
            if(status=='1')
            {
                var textMessage='Are you sure want to active this subcategory?';
            }else{
                var textMessage='Are you sure want to deactive this subcategory?';
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
                    $.post('{{route('updateSubCategoryStatusMaster')}}',{
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
