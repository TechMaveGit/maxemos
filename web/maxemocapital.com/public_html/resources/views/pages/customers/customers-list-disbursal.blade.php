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
                        <h4 class="mb-sm-0"><span class="user_name_title">Customers list</span></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customer Management</li>
                                <li class="breadcrumb-item active">{{$pageTitle}}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

<div class="page-header d-lg-flex d-block">
   <div class="page-leftheader">
      <div class="page-title"> {{$pageTitle}} </div>
   </div>

<div class="page-rightheader ms-md-auto">
   <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
      <div class="btn-list">
          {{--<a href="javascript:void(0);" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#add_customer_modal"><i data-feather="arrow-up-circle" class="btn-icon-prepend feather_iconfont"></i> Import</a>--}}
          {{--<a href="javascript:void(0);" class="btn export_btn"  data-bs-toggle="modal" data-bs-target="#add_customer_modal"><i data-feather="arrow-down-circle" class="btn-icon-prepend feather_iconfont"></i>  Export</a>--}}
     </div>
   </div>
</div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card table_maincard">
      <div class="card-body ">


<div class="row" id="filters">
   <div class="col-lg-8 col-md-12">
      <div class="row">
          <div class="col-lg-3">
          <div class="form-group">
            <label for="name" class="form-label">Filter by Search</label>
            <input id="name" class="form-control" name="name" type="text">
          </div>
          </div>
          <div class="col-lg-3">
          <div class="form-group">
            <label for="name" class="form-label">Source</label>
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
   <div class="col-lg-2">
 <div class="form-group">
          <label class="form-label">Status</label>
          <select class="js-example-basic-single form-select" data-width="100%">
            <option value="AC">Active</option>
            <option value="UN">Unactive </option>
          </select>
        </div>
 </div>
   <div class="col-lg-2 col-md-12">
      <div class="form-group without_lablebtn"> <a href="javascript:void(0);" class="btn btn-primary btn-block">Search</a> </div>
   </div>
</div>


        <div class="table-responsive">
          <table id="dataTableExample" class="table table-bordered">
            <thead>
              <tr>
                <th>Profile</th>
                <th>Cust. ID</th>
                <th> Name</th>
                <th> Email</th>
                <th>Mobile No.</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @if(count($customers))
                @foreach($customers as $crow)
                    <tr>
                        @php
                            if($crow->profilePic){
                                $profilePic=env('APP_URL').'public/'.$crow->profilePic;
                            }else{
                                $profilePic='https://media.istockphoto.com/vectors/male-face-silhouette-or-icon-man-avatar-profile-unknown-or-anonymous-vector-id1087531642?k=20&m=1087531642&s=612x612&w=0&h=D6OBNUY7ZxQTAHNVtL9mm2wbHb_dP6ogIsCCWCqiYQg=';
                            }
                        @endphp
                        <td class="">
                            <img src="{{$profilePic}}" alt="image">
                        </td>
                        <td>{{$crow->customerCode}}</td>
                        <td>{{$crow->name}}</td>
                        <td>{{$crow->email}}</td>
                        <td>{{$crow->mobile}}</td>
                        <td>{{(strtotime($crow->created_at)) ? date('d/m/Y',strtotime($crow->created_at)) : ''}}</td>
                        <td>
                            @if($crow->status==1)
                                <span class="badge badge-success-light">Active</span>
                            @elseif($crow->status==2)
                                <span class="badge badge-danger">Rejected</span>
                            @else
                                <span class="badge badge-danger">Deactive</span>
                            @endif

                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('profileDetails',[$pageNameStr,$crow->id]) }}" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="View" aria-label="View"><i data-feather="eye" class="btn-icon-prepend feather_iconfont text-primary"></i></a>
                                {{--<a href="javascript:;" onclick="getLoanEmiDetails({{$crow->id}});" class="btn btn-info">EMI Card </a>--}}
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


<!-- edit customer modal start -->
<div class="modal fade" id="emiDetails" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Loan EMI Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body" id="emiDetailsHtml">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
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
    function getLoanEmiDetails(userId)
    {
        $.post('{{route('getLoanEmiDetails')}}',{
            "_token": "{{ csrf_token() }}",
            userId:userId,
        },function (data){
            $('#emiDetailsHtml').html(data);
            $('#emiDetails').modal('show');
        });
    }

    function closeLoanAllTime(loadId){
      $.post('{{route('closeLoanAllTime')}}',{
            "_token": "{{ csrf_token() }}",
            loanId:loadId,
        },function (data){
            $('#emiDetailsHtml').html(data);
            $('#emiDetails').modal('show');
        });
    }
</script>
@endsection
