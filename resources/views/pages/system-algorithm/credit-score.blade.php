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
                        <h4 class="mb-sm-0"><span class="user_name_title">Credit Score</span></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">System User Management</li>
                                <li class="breadcrumb-item active">Credit Score</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

<div class="page-header d-lg-flex d-block">
   <div class="page-leftheader">
      <div class="page-title">Credit Score</div>
   </div>

</div>

<section class="questionansser mb-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="question_card card">
                    <div class="row">
                        <div class="col-lg-5">
                              <div class="form-group">
                                <label for="name" class="form-label">Credit (Score)</label>
                                <input id="minCibilScoreForApply" value="{{$settings->minCibilScoreForApply}}" class="form-control" name="minCibilScoreForApply" type="text">
                                  <span style="color: red;">0 Means Anyone can apply</span>
                              </div>
                        </div>
                    </div>
                <div class="modal-footer mt-3">
                  <button type="button" onclick="saveCibilScore();" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card table_maincard">
      <div class="card-body ">

        <div class="table-responsive">
          <table id="dataTableExample" class="table table-bordered">
            <thead>
              <tr>
                <th>S.No.</th>
                <th>Credit (Score) </th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>

                <td>1</td>
                <td>10</td>
                <td><span class="badge badge-success-light">Active</span></td>
                <td>
                <div class="d-flex">
                     <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#edit_User_modal" class="action-btns1" ><i data-feather="edit-2" class="btn-icon-prepend feather_iconfont text-success"></i> </a>
                     <a href="javascript:void(0);" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i data-feather="trash-2" class="btn-icon-prepend feather_iconfont text-danger"></i></a>
                    </div>
                </td>
              </tr>

              <tr>

                <td>2</td>
                <td>20</td>
                <td><span class="badge bg-danger colorcustom_badge">Inactive</span></td>
                <td>
                <div class="d-flex">
                     <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#edit_User_modal" class="action-btns1" ><i data-feather="edit-2" class="btn-icon-prepend feather_iconfont text-success"></i> </a>
                     <a href="javascript:void(0);" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i data-feather="trash-2" class="btn-icon-prepend feather_iconfont text-danger"></i></a>
                    </div>
                </td>
              </tr>

              <tr>

                <td>3</td>
                <td>10</td>
                <td><span class="badge badge-success-light">Active</span></td>
                <td>
                <div class="d-flex">
                     <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#edit_User_modal" class="action-btns1" ><i data-feather="edit-2" class="btn-icon-prepend feather_iconfont text-success"></i> </a>
                     <a href="javascript:void(0);" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i data-feather="trash-2" class="btn-icon-prepend feather_iconfont text-danger"></i></a>
                    </div>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
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
        function saveCibilScore()
        {
            $.post('{{route('saveCibilScore')}}',{
                "_token": "{{ csrf_token() }}",
                minCibilScoreForApply:$('#minCibilScoreForApply').val(),
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
    </script>
@endsection
