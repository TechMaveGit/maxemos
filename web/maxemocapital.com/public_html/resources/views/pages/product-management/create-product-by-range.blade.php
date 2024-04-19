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
                        <h4 class="mb-sm-0"><span class="user_name_title">Create Product By Range</span></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Product Management</li>
                                <li class="breadcrumb-item active">Create Product By Range</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

<div class="page-header d-lg-flex d-block">
   <div class="page-leftheader">
      <div class="page-title"> Create Product By Range </div>
   </div>

<div class="page-rightheader ms-md-auto">
   <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
      <div class="btn-list">
      <a href="javascript:void(0);" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#add_product_modal"><i data-feather="plus" class="btn-icon-prepend feather_iconfont"></i>Create Product</a>
       <!-- <a href="javascript:void(0);" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </a>
       <a href="javascript:void(0);" class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </a> <a href="javascript:void(0);" class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </a> -->
     </div>
   </div>
</div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card table_maincard">
      <div class="card-body ">


<div class="row" id="filters">
   <div class="col-lg-10 col-md-12">
      <div class="row">
          <div class="col-lg-3">
          <div class="form-group">
            <label for="name" class="form-label">Product ID</label>
            <input id="name" class="form-control" name="name" type="text">
          </div>
          </div>
          <div class="col-lg-3">
          <div class="form-group">
            <label for="name" class="form-label">Product Name</label>
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


        <div class="table-responsive">
          <table id="dataTableExample" class="table table-bordered">
            <thead>
              <tr>
                <th>S.No.</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Range From</th>
                <th>Range To</th>
                <th>Tenure</th>
                <th>Number of EMI</th>
                  <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @php
                $srn=1;
            @endphp
            @if(count($products))
                @foreach($products as $prow)
                    <tr>
                        <td>{{$srn++}}</td>
                        <td>{{$prow->productCode}}</td>
                        <td>{{$prow->productName}}</td>
                        <td>{{$prow->amount}}</td>
                        <td>{{$prow->amountTo}}</td>
                        <td>{{(isset($tenureArr[$prow->tenure])) ? $tenureArr[$prow->tenure] : ''}}</td>
                        <td>{{$prow->numOfEmi}}</td>
                        <td>{{($prow->status==1) ? 'Active' : 'Deactive'}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="javascript:void(0);" id="editInputs{{$prow->id}}" onclick="setInputs({{$prow->id}});" pfPercentage="{{$prow->pfPercentage}}" productCode="{{$prow->productCode}}" productName="{{$prow->productName}}" amount="{{$prow->amount}}" amountTo="{{$prow->amountTo}}" tenure="{{$prow->tenure}}" numOfEmi="{{$prow->numOfEmi}}" rateOfInterest="{{$prow->rateOfInterest}}" gst="{{$prow->gst}}" premium="{{$prow->premium}}" processingFee="{{$prow->processingFee}}" insurance="{{$prow->insurance}}" verificationCharges="{{$prow->verificationCharges}}" collectionFee="{{$prow->collectionFee}}" plateformFee="{{$prow->plateformFee}}" convenienceFee="{{$prow->convenienceFee}}" principleAmount="{{$prow->principleAmount}}" class="action-btns1" ><i class="fa fa-pencil"></i> </a>
                                @if($prow->status==1)
                                    <a href="javascript:void(0);" onclick="updateProductStatusMaster({{$prow->id}},0);"  class="action-btns1" style="color: red;" ><i class="fa fa-thumbs-down"></i> </a>
                                @else
                                    <a href="javascript:void(0);" onclick="updateProductStatusMaster({{$prow->id}},1);"  class="action-btns1" style="color: forestgreen;" ><i class="fa fa-thumbs-up"></i> </a>
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

<!-- add product modal start -->
<div class="example add_User_modalstart">
      <!-- Modal -->
      <div class="modal fade" id="add_product_modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Create Product</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">

            <form class="forms-sample">
              <div class="row">
                <div class="col-lg-6" style="display: none;">
                <div class="mb-3">
                    <input type="hidden" id="recordId">
            <label for="productCode" class="form-label">Product ID</label>
            <input type="text" class="form-control" id="productCode" autocomplete="off" placeholder="Enter Product ID">
          </div>
                </div>
                  <div class="col-lg-6">
                      <div class="mb-3">
                          <label for="productName" class="form-label">Product Name</label>
                          <input type="text" class="form-control" id="productName" autocomplete="off" placeholder="">
                      </div>
                  </div>
                <div class="col-lg-6">
                <div class="mb-3">
            <label for="amount" class="form-label">Range From</label>
            <input type="text" class="form-control" id="amount" autocomplete="off" placeholder="">
          </div>
                </div>
                <div class="col-lg-6">
                <div class="mb-3">
            <label for="amountTo" class="form-label">Range To</label>
            <input type="text" class="form-control" id="amountTo" autocomplete="off" placeholder="">
          </div>
                </div>

                <div class="col-lg-6">
                     <div class="form-group mb-3">
                          <label class="form-label">Tenure</label>
                          <select class="js-example-basic-single2 form-select" onchange="checkTenureAndEMi();" id="tenure" data-width="100%">
                              <option value="">Select Tenure</option>
                              @if(count($tenure))
                                  @foreach($tenure as $trow)
                                      <option value="{{$trow->id}}" datamonth="{{$trow->otherValueOrDays}}">{{$trow->ansTitle}}</option>
                                  @endforeach
                              @endif
                          </select>
                    </div>
             </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="numOfEmi" class="form-label">Number of EMI</label>
                        <input type="number" class="form-control" readonly id="numOfEmi" placeholder="">
                    </div>
                </div>

                  <div class="col-lg-6">
                      <div class="mb-3">
                          <label for="rateOfInterest" class="form-label">ROI</label>
                          <input type="number" step="any" class="form-control" id="rateOfInterest" name="rateOfInterest" autocomplete="off" placeholder="">
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="mb-3">
                          <label for="gst" class="form-label">GST</label>
                          <input type="number" class="form-control sumamount" id="gst" name="gst" autocomplete="off" placeholder="">
                      </div>
                  </div>
                  {{--<div class="col-lg-6">
                      <div class="mb-3">
                          <label for="premium" class="form-label">Premium</label>
                          <input type="text" class="form-control sumamount" id="premium" name="premium" autocomplete="off" placeholder="">
                      </div>
                  </div>--}}
                  {{--<div class="col-lg-6">
                      <div class="mb-3">
                          <label for="processingFee" class="form-label">Processing Fee</label>
                          <input type="text" class="form-control sumamount" id="processingFee" name="processingFee" autocomplete="off" placeholder="">
                      </div>
                  </div>--}}
                  <div class="col-lg-6">
                      <div class="mb-3">
                          <label for="insurance" class="form-label">Insurance</label>
                          <input type="number" class="form-control sumamount" id="insurance" name="insurance" autocomplete="off" placeholder="">
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="mb-3">
                          <label for="verificationCharges" class="form-label">Verification Charges</label>
                          <input type="number" class="form-control sumamount" id="verificationCharges" name="verificationCharges" autocomplete="off" placeholder="">
                      </div>
                  </div>
                  {{--<div class="col-lg-6">
                      <div class="mb-3">
                          <label for="collectionFee" class="form-label">Collection Fee</label>
                          <input type="text" class="form-control sumamount" id="collectionFee" name="collectionFee" autocomplete="off" placeholder="">
                      </div>
                  </div>--}}
                  <div class="col-lg-6">
                      <div class="mb-3">
                          <label for="plateformFee" class="form-label">Plateform Fee</label>
                          <input type="number" class="form-control sumamount" id="plateformFee" name="plateformFee" autocomplete="off" placeholder="">
                      </div>
                  </div>
                  {{--<div class="col-lg-6" style="display: none;">
                      <div class="mb-3">
                          <label for="convenienceFee" class="form-label">Convenience Fee</label>
                          <input type="number" class="form-control " id="convenienceFee" name="convenienceFee" value="0" autocomplete="off" placeholder="">
                      </div>
                  </div>
                  --}}
                  <div class="col-lg-6">
                      <div class="mb-3">
                          <label for="pfPercentage" class="form-label">PF (%)</label>
                          <input type="number" class="form-control " id="pfPercentage" name="pfPercentage" value="0" autocomplete="off" placeholder="">
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="mb-3">
                          <label for="principleAmount" class="form-label">Principle Amount</label>
                          <input type="text" class="form-control" readonly id="principleAmount" name="principleAmount" autocomplete="off" placeholder="">
                      </div>
                  </div>
              </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="formSubmitBtn" onclick="saveProductByRange();" class="btn btn-primary">Save </button>
                <button type="button" id="resetBtn" style="display: none;" onclick="resetForm();" class="btn btn-danger">Create Product </button>
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
        function checkTenureAndEMi()
        {
            var noOfEmi=$('#tenure option:selected').attr('datamonth');
            $('#numOfEmi').val(noOfEmi);
        }

        function saveProductByRange()
        {
            var recordId=$('#recordId').val();
            var productCode=$('#productCode').val();
            var productName=$('#productName').val();
            var amount=$('#amount').val();
            var amountTo=$('#amountTo').val();
            var tenure=$('#tenure').val();
            var numOfEmi=$('#numOfEmi').val();

            var rateOfInterest=$('#rateOfInterest').val();
            var gst=$('#gst').val();
            var premium=$('#premium').val();
            var processingFee=$('#processingFee').val();
            var insurance=$('#insurance').val();
            var verificationCharges=$('#verificationCharges').val();
            var collectionFee=$('#collectionFee').val();
            var plateformFee=$('#plateformFee').val();
            var convenienceFee=$('#convenienceFee').val();
            var principleAmount=$('#principleAmount').val();
            var pfPercentage=$('#pfPercentage').val();
            /*
            if(!productCode){
                alertMessage('Error!', 'Please enter the product id.', 'error', 'no');
                return false;
            }
            */
            if(!productName) {
                alertMessage('Error!', 'Please enter the product name.', 'error', 'no');
                return false;
            } else if(!parseInt(amount)) {
                alertMessage('Error!', 'Please enter the start range amount.', 'error', 'no');
                return false;
            } else if(!parseInt(amountTo)) {
                alertMessage('Error!', 'Please enter the end range amount.', 'error', 'no');
                return false;
            } else if(!tenure) {
                alertMessage('Error!', 'Please enter the tenure.', 'error', 'no');
                return false;
            } else if(!numOfEmi) {
                alertMessage('Error!', 'Please enter the number of emi.', 'error', 'no');
                return false;
            }else{
                $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');
                $.post('{{route('saveProductByRange')}}',{
                    "_token": "{{ csrf_token() }}",
                    recordId:recordId,
                    productCode:productCode,
                    productName:productName,
                    amount:amount,
                    amountTo:amountTo,
                    tenure:tenure,
                    numOfEmi:numOfEmi,
                    rateOfInterest:rateOfInterest,
                    gst:gst,
                    premium:premium,
                    processingFee:processingFee,
                    insurance:insurance,
                    verificationCharges:verificationCharges,
                    collectionFee:collectionFee,
                    plateformFee:plateformFee,
                    convenienceFee:convenienceFee,
                    principleAmount:principleAmount,
                    pfPercentage:pfPercentage
                },function (data){
                    var obj = JSON.parse(data);
                    $('#formSubmitBtn').text('Submit').removeAttr('disabled');
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
        }

        function setInputs(recordId)
        {
            $('#recordId').val(recordId);
            $('#productCode').val($('#editInputs'+recordId).attr('productCode'));
            $('#productName').val($('#editInputs'+recordId).attr('productName'));
            $('#amount').val($('#editInputs'+recordId).attr('amount'));
            $('#amountTo').val($('#editInputs'+recordId).attr('amountTo'));
            $('#tenure').val($('#editInputs'+recordId).attr('tenure'));
            $('#numOfEmi').val($('#editInputs'+recordId).attr('numOfEmi'));

            $('#rateOfInterest').val($('#editInputs'+recordId).attr('rateOfInterest'));
            $('#gst').val($('#editInputs'+recordId).attr('gst'));
            $('#premium').val($('#editInputs'+recordId).attr('premium'));
            $('#processingFee').val($('#editInputs'+recordId).attr('processingFee'));
            $('#insurance').val($('#editInputs'+recordId).attr('insurance'));
            $('#verificationCharges').val($('#editInputs'+recordId).attr('verificationCharges'));
            $('#collectionFee').val($('#editInputs'+recordId).attr('collectionFee'));
            $('#plateformFee').val($('#editInputs'+recordId).attr('plateformFee'));
            $('#convenienceFee').val($('#editInputs'+recordId).attr('convenienceFee'));
            $('#principleAmount').val($('#editInputs'+recordId).attr('principleAmount'));
            $('#pfPercentage').val($('#editInputs'+recordId).attr('pfPercentage'));

            $('#exampleModalCenterTitle').html('Edit Product');
            $('#resetBtn').show();
            $('#add_product_modal').modal('show');
        }

        function resetForm()
        {
            $('#recordId').val('');
            $('#productCode').val('');
            $('#productName').val('');
            $('#amount').val('');
            $('#amountTo').val('');
            $('#tenure').val('');
            $('#numOfEmi').val('');
            $('#rateOfInterest').val('');
            $('#gst').val('');
            $('#premium').val('');
            $('#processingFee').val('');
            $('#insurance').val('');
            $('#verificationCharges').val('');
            $('#collectionFee').val('');
            $('#plateformFee').val('');
            $('#convenienceFee').val('');
            $('#principleAmount').val('');
            $('#pfPercentage').val('');
            $('#exampleModalCenterTitle').html('Create Product');
            $('#resetBtn').hide();
        }

        $('.sumamount').change(function (){
            calculatePrincipleAmount();
        });

        function calculatePrincipleAmount()
        {
            var sum = 0;
            $('.sumamount').each(function(){
                var a=($(this).val()) ? $(this).val() : 0;
                sum += parseFloat(a);  // Or this.innerHTML, this.innerText
            });
            $('#principleAmount').val(sum);
        }

        function updateProductStatusMaster(recordId,status)
        {
            if(status=='1')
            {
                var textMessage='Are you sure want to active this product?';
            }else{
                var textMessage='Are you sure want to deactive this product?';
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
                    $.post('{{route('updateProductStatusMaster')}}',{
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
