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
                        <h4 class="mb-sm-0"><span class="user_name_title">Roles</span></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">System User Management</li>
                                <li class="breadcrumb-item active">Roles</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

<div class="page-header d-lg-flex d-block">
   <div class="page-leftheader">
      <div class="page-title"> Permission for {{$roles->name}} </div>
   </div>

</div>

<section class="rolescardsec">
<div class="row roles_cardrow">
    <div class="col-lg-3">
        <div class="role_card">
                <div class="role_header">Customer Management</div>
                <ul class="role_list">
                    <li>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="newcustomers" id="newcustomers" {{(in_array('newcustomers',$userPermissionsArr)) ? 'checked' : ''}}>
                            <label class="form-check-label" for="newcustomers">New Loan Applications</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="rejectedcustomers" id="rejectedcustomers" {{(in_array('rejectedcustomers',$userPermissionsArr)) ? 'checked' : ''}}>
                            <label class="form-check-label" for="rejectedcustomers">Rejected Loan Applications</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="employment-verification" id="employment-verification" {{(in_array('employment-verification',$userPermissionsArr)) ? 'checked' : ''}}>
                            <label class="form-check-label" for="employment-verification">Employment Verification</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="employment-verification-rejected" id="employment-verification-rejected" {{(in_array('employment-verification-rejected',$userPermissionsArr)) ? 'checked' : ''}}>
                            <label class="form-check-label" for="employment-verification-rejected">Employment Verification Rejected</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="kycverifiedcustomers" id="kycverifiedcustomers" {{(in_array('kycverifiedcustomers',$userPermissionsArr)) ? 'checked' : ''}}>
                            <label class="form-check-label" for="kycverifiedcustomers">Credit Assessment Status</label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="finalapprovalfordisbursement" id="finalapprovalfordisbursement" {{(in_array('finalapprovalfordisbursement',$userPermissionsArr)) ? 'checked' : ''}}>
                            <label class="form-check-label" for="finalapprovalfordisbursement">Disbursement Approval</label>
                        </div>
                    </li>

                </ul>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="role_card">
            <div class="role_header">Customer Profile / Loan Approval</div>
            <ul class="role_list">
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="view-mpin" id="view-mpin" {{(in_array('view-mpin',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="view-mpin">View MPIN</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="approverejectkyc" id="approverejectkyc" {{(in_array('approverejectkyc',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="approverejectkyc">Approve/Reject Kyc</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="approve-reject-employment" id="approve-reject-employment" {{(in_array('approve-reject-employment',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="approve-reject-employment">Approve/Reject Employment</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="loan-send-for-approval" id="loan-send-for-approval" {{(in_array('loan-send-for-approval',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="loan-send-for-approval">Send For Customer Approval</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="schedule-disbursement" id="schedule-disbursement" {{(in_array('schedule-disbursement',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="schedule-disbursement">Schedule Disbursement</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="loan-disburse" id="loan-disburse" {{(in_array('loan-disburse',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="loan-disburse">Loan Disburse</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="view-emi-details" id="view-emi-details" {{(in_array('view-emi-details',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="view-emi-details">View EMI Details</label>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="role_card">
            <div class="role_header">Loan / Bank Management </div>
            <ul class="role_list">
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="today-disbursement" id="today-disbursement" {{(in_array('today-disbursement',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="today-disbursement">Today Disbursement</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="pending-disbursement" id="pending-disbursement" {{(in_array('pending-disbursement',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="pending-disbursement">Pending Disbursement</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="disbursed-loan-list" id="disbursed-loan-list" {{(in_array('disbursed-loan-list',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="disbursed-loan-list">Disbursed Loan List</label>
                    </div>
                </li>
                {{--<li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="repeat-loans-list" id="repeat-loans-list" {{(in_array('repeat-loans-list',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="repeat-loans-list">Repeat Customer Loans</label>
                    </div>
                </li>--}}
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="bank-management" id="bank-management" {{(in_array('bank-management',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="bank-management">FLDG Bank </label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="add-bank" id="add-bank" {{(in_array('add-bank',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="add-bank">Add FLDG Bank</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="edit-bank" id="edit-bank" {{(in_array('edit-bank',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="edit-bank">Edit FLDG Bank</label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="role_card">
            <div class="role_header">Collection Management</div>
            <ul class="role_list">
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="customer-emi" id="customer-emi" {{(in_array('customer-emi',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="customer-emi">Customers EMI</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="received-emi" id="received-emi" {{(in_array('received-emi',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="received-emi">Received EMI</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="todays-emi" id="todays-emi" {{(in_array('todays-emi',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="todays-emi">Today's EMI</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="overdue-emi" id="overdue-emi" {{(in_array('overdue-emi',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="overdue-emi">Over Due EMI</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="closed-loan" id="closed-loan" {{(in_array('closed-loan',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="closed-loan">Closed Loan</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="noc-customers" id="noc-customers" {{(in_array('noc-customers',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="noc-customers">NOC Customers</label>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="row roles_cardrow mt-5">
    <div class="col-lg-3">
        <div class="role_card">
            <div class="role_header">Product/Category Management</div>
            <ul class="role_list">
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="category-management" id="category-management" {{(in_array('category-management',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="category-management">Category Management</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="sub-category-management" id="sub-category-management" {{(in_array('sub-category-management',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="sub-category-management">Sub Category Management</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="product-by-range-management" id="product-by-range-management" {{(in_array('product-by-range-management',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="product-by-range-management">Product By Range Management</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="product-by-category-management" id="product-by-category-management" {{(in_array('product-by-category-management',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="product-by-category-management">Product By Category Management</label>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="role_card">
            <div class="role_header">Product/Category Actions</div>
            <ul class="role_list">
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="add-category" id="add-category" {{(in_array('add-category',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="add-category">Add Category </label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="edit-category" id="edit-category" {{(in_array('edit-category',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="edit-category">Edit Category </label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="add-sub-category" id="add-sub-category" {{(in_array('add-sub-category',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="add-sub-category">Add Sub Category </label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="edit-sub-category" id="edit-sub-category" {{(in_array('edit-sub-category',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="edit-sub-category">Edit Sub Category </label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="add-product-by-range" id="add-product-by-range" {{(in_array('add-product-by-range',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="add-product-by-range">Add Product By Range</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="edit-product-by-range" id="edit-product-by-range" {{(in_array('edit-product-by-range',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="edit-product-by-range">Edit Product By Range</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="add-product-by-category" id="add-product-by-category" {{(in_array('add-product-by-category',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="add-product-by-category">Add Product By Category</label>
                    </div>
                </li>
                <li>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="edit-product-by-category" id="edit-product-by-category" {{(in_array('edit-product-by-category',$userPermissionsArr)) ? 'checked' : ''}}>
                        <label class="form-check-label" for="edit-product-by-category">Edit Product By Category</label>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>

<div class="row mt-t">
    <div class="col-md-9">&nbsp;</div>
    <div class="col-md-3">
        <button type="button" onclick="updateRolesPermissions()" class="btn btn-danger">Update Permissions</button>
    </div>
</div>

</section>

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
        function updateRolesPermissions()
        {
            var userPermissions = $('input[name="permissionchk[]"]:checked')
                .map(function(){return $(this).val();}).get();
            if(!userPermissions.length)
            {
                alertMessage('Error!', 'Please choose atleast one permission', 'error', 'no');
                return false;
            }else{
                waitForProcess();
                $.post('{{route('updateRolesPermissions')}}',{
                    "_token": "{{ csrf_token() }}",
                    permissionTo:'{{$permissionTo}}',
                    userId:'{{$roleId}}',
                    userPermissions:userPermissions,
                },function (data){
                    var obj = JSON.parse(data);
                    if(obj.status=='success')
                    {
                        alertMessage('Success!', obj.message, 'success', 'no');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }
    </script>
@endsection
