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
                        <h4 class="mb-sm-0"><span class="user_name_title">Add FLDG Bank</span></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Loan Management</li>
                                <li class="breadcrumb-item active">Add FLDG Bank</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

<div class="page-header d-lg-flex d-block">
   <div class="page-leftheader">
      <div class="page-title"> Add FLDG Bank </div>
   </div>

<div class="page-rightheader ms-md-auto">
   <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
      <div class="btn-list">
       <a href="javascript:void(0);" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#add_bank_modal"><i data-feather="plus" class="btn-icon-prepend feather_iconfont"></i> Add FLDG Bank</a>
     </div>
   </div>
</div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card table_maincard">
      <div class="card-body ">
        <!-- <h6 class="card-title">Data Table</h6>
        <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> -->


        <div class="row" id="filters">
   <div class="col-lg-10 col-md-12">
      <div class="row">
          <div class="col-lg-3">
          <div class="form-group">
            <label for="name" class="form-label">Bank Name</label>
            <input id="name" class="form-control" name="name" type="text">
          </div>
          </div>
         <div class="col-lg-3">
            <div class="form-group">
                <label class="form-label">From</label>
                <div class="input-group date datepicker" id="datePickerExample">
                       <input type="date" class="form-control">
                       <span class="input-group-text input-group-addon">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                             <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                             <line x1="16" y1="2" x2="16" y2="6"></line>
                             <line x1="8" y1="2" x2="8" y2="6"></line>
                             <line x1="3" y1="10" x2="21" y2="10"></line>
                          </svg>
                       </span>
                </div>
            </div>
         </div>
 <div class="col-lg-3">
            <div class="form-group">
               <label class="form-label">To</label>
<div class="input-group date datepicker" id="datePickerExample">
   <input type="date" class="form-control">
   <span class="input-group-text input-group-addon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
         <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
         <line x1="16" y1="2" x2="16" y2="6"></line>
         <line x1="8" y1="2" x2="8" y2="6"></line>
         <line x1="3" y1="10" x2="21" y2="10"></line>
      </svg>
   </span>
</div>
</div>
 </div>
      </div>
   </div>

   <div class="col-lg-2 col-md-12">
      <div class="form-group without_lablebtn"> <a href="javascript:void(0);" class="btn btn-primary btn-block">Search</a> </div>
   </div>
</div>


        <div class="table-responsive bank_table">
          <table id="dataTableExample" class="table table-bordered">
            <thead>
              <tr>
                <th>S.No.</th>
                <th>Bank Name</th>
                <th>Description</th>
                <th>Bank Address</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $srn=1;
                @endphp
                @if(count($banks))
                    @foreach($banks as $crow)
                        <tr>
                            <td>{{$srn++}}</td>
                            <td>{{$crow->name}}</td>
                            <td>{{$crow->description}}</td>
                            <td>{{$crow->location}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="javascript:void(0);" id="editInputs{{$crow->id}}" onclick="setInputs({{$crow->id}});"  bankName="{{$crow->name}}" description="{{$crow->description}}" bankAddress="{{$crow->location}}" class="action-btns1" ><i data-feather="edit-2" class="btn-icon-prepend feather_iconfont text-success"></i> </a>
                                    <a href="javascript:void(0);" class="action-btns1" onclick="deleteBank({{$crow->id}});"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i data-feather="trash-2" class="btn-icon-prepend feather_iconfont text-danger"></i></a>
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

<!-- add product modal start -->
<div class="example add_User_modalstart">
    <!-- Modal -->
    <div class="modal fade" id="add_bank_modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">

                    <form class="forms-sample">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="hidden" id="recordId">
                                    <label for="bankName" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" id="bankName" autocomplete="off" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" autocomplete="off" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="bankAddress" class="form-label">Bank Address</label>
                                    <input type="text" class="form-control" id="bankAddress" autocomplete="off" placeholder="">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="formSubmitBtn" onclick="saveBankDetails();" class="btn btn-primary">Save </button>
                    <button type="button" id="resetBtn" style="display: none;" onclick="resetForm();" class="btn btn-danger">Create Bank </button>
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

        function saveBankDetails()
        {
            var recordId=$('#recordId').val();
            var bankName=$('#bankName').val();
            var description=$('#description').val();
            var bankAddress=$('#bankAddress').val();
            if(!bankName){
                alertMessage('Error!', 'Please enter the bank name.', 'error', 'no');
                return false;
            } else if(!description) {
                alertMessage('Error!', 'Please enter the bank description.', 'error', 'no');
                return false;
            }else if(!bankAddress) {
                alertMessage('Error!', 'Please enter the bank address.', 'error', 'no');
                return false;
            }else{
                $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');
                $.post('{{route('saveBankDetails')}}',{
                    "_token": "{{ csrf_token() }}",
                    recordId:recordId,
                    bankName:bankName,
                    description:description,
                    bankAddress:bankAddress,
                },function (data){
                    var obj = JSON.parse(data);
                    $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                    if(obj.status=='success')
                    {
                        $('#recordId').val('');
                        $('#bankName').val('');
                        $('#description').val('');
                        $('#bankAddress').val('');
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
            $('#bankName').val($('#editInputs'+recordId).attr('bankName'));
            $('#description').val($('#editInputs'+recordId).attr('description'));
            $('#bankAddress').val($('#editInputs'+recordId).attr('bankAddress'));
            $('#exampleModalCenterTitle').html('Edit Bank');
            $('#resetBtn').show();
            $('#add_bank_modal').modal('show');
        }

        function resetForm()
        {
            $('#recordId').val('');
            $('#bankName').val('');
            $('#description').val('');
            $('#bankAddress').val('');
            $('#exampleModalCenterTitle').html('Create Bank');
            $('#resetBtn').hide();
        }

        function deleteBank(recordId)
        {
            swal({
                title: 'Warning!',
                text: 'Are you sure want to delete this bank?',
                icon: 'warning',
                buttons:true,
            }).then((willDelete) => {
                if(willDelete)
                {
                    waitForProcess();
                    $.post('{{route('deleteBank')}}',{
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
    </script>
@endsection
