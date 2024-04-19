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
                <button  type="button" onclick="addProduct();" class="btn addbtn_right bg-success btn_import font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                    <i class="fa-solid fa-plus"></i>
                    Create Product
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
                                                <th '.$TBLLTHCLS.'>Product ID</th>
                                                <th '.$TBLLTHCLS.'>Product Category</th>
                                                <th '.$TBLLTHCLS.'>Product Name</th>
                                                <th '.$TBLLTHCLS.'>Tenure</th>
                                                <th '.$TBLLTHCLS.'>ROI %</th>
                                                <th '.$TBLLTHCLS.'>Description</th>
                                                <th '.$TBLLTHCLS.'>Product icon or image</th>
                                                <th '.$TBLLTHCLS.'>Status</th>
                                                <th '.$TBLLTHCLS.'>Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>';
                                    $srn=1;
                                    foreach ($products as $prow)
                                    {
                                        $imageStr='';
                                        $image=asset('/').'public/'.$prow->image;
                                        if($prow->image){
                                            $imageStr='<a href="'.$image.'" target="_blank"><img src="'.$image.'" style="width:100px;height:100px;object-fit:contain;" /></a>';
                                        }

                                        $statusStr=($prow->status==1) ? '<label class="label label-success">Active</label>' : '<label class="label label-danger">Deactive</label>';

                                        $buttons='';

                                        if($prow->status==1){
                                            $buttons .='<a href="javascript:void(0);" onclick="updateProductStatusMaster('.$prow->id.',0);"  class="btn btn-danger" ><i class="fa fa-thumbs-down"></i> </a>';
                                        }else{
                                            $buttons .='<a href="javascript:void(0);" onclick="updateProductStatusMaster('.$prow->id.',1);"  class="btn btn-success" ><i class="fa fa-thumbs-up"></i> </a>';
                                        }


                                        $buttons .='<a href="javascript:void(0);" id="editInputs'.$prow->id.'" onclick="setInputs('.$prow->id.');"  pfPercentage="'.$prow->pfPercentage.'" productCode="'.$prow->productCode.'" productName="'.$prow->productName.'" categoryId="'.$prow->categoryId.'" amount="'.$prow->amount.'" description="'.$prow->description.'" tenure="'.$prow->tenure.'" numOfEmi="'.$prow->numOfEmi.'" rateOfInterest="'.$prow->rateOfInterest.'" gst="'.$prow->gst.'" premium="'.$prow->premium.'" processingFee="'.$prow->processingFee.'" insurance="'.$prow->insurance.'" verificationCharges="'.$prow->verificationCharges.'" collectionFee="'.$prow->collectionFee.'" plateformFee="'.$prow->plateformFee.'" convenienceFee="'.$prow->convenienceFee.'" principleAmount="'.$prow->principleAmount.'" class="btn btn-primary" ><i class="fa fa-pencil"></i> </a>
                                        <!--<a href="javascript:void(0);" class="btn btn-danger" onclick="deleteCategory('.$prow->id.');" ><i class="fa fa-trash"></i></a>-->';

                                        $htmlStr .='<tr>
                                                <td>'.$srn.'</td>
                                                <td>'.$prow->productCode.'</td>
                                                <td>'.$prow->categoryName.'</td>
                                                <td>'.$prow->productName.'</td>
                                                <td>'.$prow->tenure.'</td>
                                                <td>'.$prow->rateOfInterest.'</td>
                                                <td>'.$prow->description.'</td>
                                                <td>'.$imageStr.'</td>
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


    <div class="modal fade" id="add_product_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100" id="exampleModalCenterTitle" >
                        Create Product
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
                                    <div class="row">

                                        <div class="col-lg-6 " style="display: none;">
                                            <div class="mb-3">
                                                <input type="hidden" id="recordId" name="recordId">
                                                <label for="productCode" class="form-label">Product ID</label>
                                                <input type="text" class="form-control" id="productCode" readonly name="productCode" autocomplete="off" placeholder="Enter Product ID">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Product Category</label>
                                                <select class="js-example-basic-single2 form-select" id="categoryId" name="categoryId" data-width="100%">
                                                    <option value="">Select Category</option>
                                                    @if(count($category))
                                                        @foreach($category as $catr)
                                                            <option value="{{$catr->id}}">{{$catr->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="productName" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="productName" name="productName" autocomplete="off" placeholder="Enter Product Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Tenure</label>
                                                <select class="js-example-basic-single2 form-select" onchange="checkTenureAndEMi();" id="tenure" name="tenure" data-width="100%">
                                                    <option value="">Select Tenure</option>
                                                    @if(count($tenure))
                                                        @foreach($tenure as $trow)
                                                            <option value="{{$trow->id}}" datamonth="{{$trow->numOfMonths}}">{{$trow->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="rateOfInterest" class="form-label">ROI</label>
                                                <input type="number" class="form-control" id="rateOfInterest" name="rateOfInterest" autocomplete="off" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Product Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label class="mb-2">Upload Product icon or image</label>
                                            <input type="file" class="form-control" id="myDropify" name="myDropify"/>
                                        </div>
                                        <div class="col-lg-12 mt-5">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="formSubmitBtn" class="btn btn-primary bg-primary">Save </button>
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
        $('#categoryId').change(function (){
            var categoryId=$(this).val();
            //getSubCategoryByCatId(categoryId,'');
        });

        function checkTenureAndEMi()
        {
            var noOfEmi=$('#tenure option:selected').attr('datamonth');
            $('#numOfEmi').val(noOfEmi);
        }

        function addProduct()
        {
            resetForm();
            $('#add_product_modal').modal('show');
        }
        function getSubCategoryByCatId(categoryId,oldCatId)
        {
            $.post('{{route('getSubCategoryByCatId')}}',{
                "_token": "{{ csrf_token() }}",
                categoryId:categoryId,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#subCategoryId').html(obj.data);
                    setTimeout(function (){
                        $('#subCategoryId').val(oldCatId);
                    },400);
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            });
        }

        $('#actionForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            var recordId=$('#recordId').val();
            var productCode=$('#productCode').val();
            var productName=$('#productName').val();
            var categoryId=$('#categoryId').val();
            var tenure=$('#tenure').val();
            var description = $('#description').val();
            var myDropify = $('#myDropify').val();

            /*
            if(!productCode){
                toastr.error('Please enter the product id.');
                return false;
            }
            */
            if(!categoryId) {
                alertMessage('Error!', 'Please select category.', 'error', 'no');
                return false;
            }else if(!productName) {
                alertMessage('Error!', 'Please enter the product name.', 'error', 'no');
                return false;
            }else if(!tenure) {
                alertMessage('Error!', 'Please select tenure.', 'error', 'no');
                return false;
            }else if(!description) {
                alertMessage('Error!', 'Please enter the description.', 'error', 'no');
                return false;
            }else if(!myDropify && !recordId) {
                alertMessage('Error!', 'Please choose product icon.', 'error', 'no');
                return false;
            }else{
                $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');
                $.ajax({
                    type:'POST',
                    url: "{{route('saveProductByCategory')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        var obj = JSON.parse(data);
                        $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                        if(obj.status=='success')
                        {
                            this.reset();
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
            $('#productCode').val($('#editInputs'+recordId).attr('productCode'));
            $('#productName').val($('#editInputs'+recordId).attr('productName'));
            $('#categoryId').val($('#editInputs'+recordId).attr('categoryId'));

            //getSubCategoryByCatId($('#editInputs'+recordId).attr('categoryId'),$('#editInputs'+recordId).attr('subCategoryId'));

            //$('#amount').val($('#editInputs'+recordId).attr('amount'));
            $('#description').val($('#editInputs'+recordId).attr('description'));
            $('#tenure').val($('#editInputs'+recordId).attr('tenure'));
            //$('#numOfEmi').val($('#editInputs'+recordId).attr('numOfEmi'));

            $('#rateOfInterest').val($('#editInputs'+recordId).attr('rateOfInterest'));
            // $('#gst').val($('#editInputs'+recordId).attr('gst'));
            // $('#premium').val($('#editInputs'+recordId).attr('premium'));
            // $('#processingFee').val($('#editInputs'+recordId).attr('processingFee'));
            // $('#insurance').val($('#editInputs'+recordId).attr('insurance'));
            // $('#verificationCharges').val($('#editInputs'+recordId).attr('verificationCharges'));
            // $('#collectionFee').val($('#editInputs'+recordId).attr('collectionFee'));
            // $('#plateformFee').val($('#editInputs'+recordId).attr('plateformFee'));
            // $('#convenienceFee').val($('#editInputs'+recordId).attr('convenienceFee'));
            // $('#principleAmount').val($('#editInputs'+recordId).attr('principleAmount'));
            // $('#pfPercentage').val($('#editInputs'+recordId).attr('pfPercentage'));

            $('#exampleModalCenterTitle').html('Edit Product');
            $('#resetBtn').show();
            $('#add_product_modal').modal('show');
        }

        function resetForm()
        {
            $('#recordId').val('');
            $('#productCode').val('');
            $('#productName').val('');
            //$('#amount').val('');
            $('#description').val('');
            $('#categoryId').val('');
            //$('#subCategoryId').val('');
            $('#tenure').val('');
            //$('#numOfEmi').val('');
            $('#rateOfInterest').val('');
            //$('#gst').val('');
            //$('#premium').val('');
            //$('#processingFee').val('');
           // $('#insurance').val('');
            //$('#verificationCharges').val('');
            //$('#collectionFee').val('');
            //$('#plateformFee').val('');
            //$('#convenienceFee').val('');
            //$('#pfPercentage').val('');
            //$('#principleAmount').val('');
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
