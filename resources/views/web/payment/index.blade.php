@extends('web.layout.main')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/app.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/dashboard-css.css">



<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Raw Material Payment</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcomeWeb')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Raw Material Payment</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="maindash_form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 card">
                <form method="POST" action="{{url('/')}}/easebuzz-lib/easebuzz.php?api_name=initiate_payment">
                    <div class="main-form">
                    
                        <div class="mt-3">
                            <div class="form-group">
                                <label for="txnid">Transaction ID<sup>*</sup></label>
                                <input type="text" id="txnid" class="form-control" readonly name="txnid" value="<?='ODRAW'.strtotime(date('Y-m-d H:i:s')).rand(00000,99999)?>" placeholder="T31Q6JT8HB">
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount<sup>(should be float)*</sup></label>
                                <input id="amount" onchange="convertToFloat()" type="number" class="form-control" name="amount" value="10.00" step=".01" placeholder="100.00">
                            </div>  

                            <div class="form-group hidden">
                                <label for="firstname">First Name<sup>*</sup></label>
                                <input id="firstname" class="form-control" name="firstname" value="<?=$userloggedData->name?>" placeholder="Name">
                            </div>
                    
                            <div class="form-group hidden">
                                <label for="email">Email ID<sup>*</sup></label>
                                <input id="email" class="form-control" name="email" value="<?=$userloggedData->email?>" placeholder="Email Id">
                            </div>
                    
                            <div class="form-group hidden">
                                <label for="phone">Phone<sup>*</sup></label>
                                <input id="phone" class="form-control" name="phone" value="<?=$userloggedData->mobile?>" placeholder="Mobile Number">
                            </div>
                            
                            <div class="form-group hidden">
                                <label for="productinfo">Product Information<sup>*</sup></label>
                                <input id="productinfo" class="form-control" name="productinfo" value="Raw Material Payment" placeholder="">
                            </div>
                    
                            <div class="form-group hidden">
                                <label for="surl">Success URL<sup>*</sup></label>
                                <input id="surl" class="form-control" name="surl" value="{{url('/')}}/easebuzz-lib/response.php" placeholder="">
                            </div>
                            
                            <div class="form-group hidden">
                                <label for="furl">Failure URL<sup>*</sup></label>
                                <input id="furl" class="form-control" name="furl" value="{{url('/')}}/easebuzz-lib/response.php"
                                placeholder="">
                            </div>

                        </div>

                        <div class="optional-data hidden">

                            <div class="form-group">
                                <label for="udf1">UDF1</label>
                                <input id="udf1" class="form-control" name="udf1" value="{{$loanDetails->id}}" placeholder="User description1">
                            </div>
                        
                            <div class="form-group">
                                <label for="udf2">UDF2</label>
                                <input id="udf2" class="form-control" name="udf2" value="{{$loanDetails->userId}}" placeholder="User description2">
                            </div>
                    
                            <div class="form-group">
                                <label for="udf3">UDF3</label>
                                <input id="udf3" class="form-control" name="udf3" value="" placeholder="User description3">
                            </div>
                    
                            <div class="form-group">
                                <label for="udf4">UDF4</label>
                                <input id="udf4" class="form-control" name="udf4" value="" placeholder="User description4">
                            </div>
                    
                            <div class="form-group">
                                <label for="udf5">UDF5</label>
                                <input id="udf5" class="form-control" name="udf5" value="" placeholder="User description5">
                            </div>
                            
                            <div class="form-group">
                                <label for="address1">Address 1</label>
                                <input id="address1" class="form-control" name="address1" value="<?=$userloggedData->address ?? '' ?>" placeholder="Address 1">
                            </div>
                    
                            <div class="form-group">
                                <label for="address2">Address 2</label>
                                <input id="address2" class="form-control" name="address2" value="" placeholder="Address 2">
                            </div>
                            
                            <div class="form-group">
                                <label for="city">City</label>
                                <input id="city" class="form-control" name="city" value="<?=$userloggedData->city ?? '' ?>" placeholder="City">
                            </div>
                    
                            <div class="form-group">
                                <label for="state">State</label>
                                <input id="state" class="form-control" name="state" value="<?=$userloggedData->state ?? '' ?>" placeholder="State">
                            </div>
                    
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input id="country" class="form-control" name="country" value="<?=$userloggedData->country ?? '' ?>" placeholder="Country">
                            </div>
                            
                            <div class="form-group">
                                <label for="zipcode">Zip-Code</label>
                                <input id="zipcode" class="form-control" name="zipcode" value="<?=$userloggedData->pincode ?? '' ?>" placeholder="Pincode">
                            </div>
                        </div>
                
                        <div class="form-group">
                            <button type="submit" id="showpaynow" disabled class="btn  btn-success bg-success p-2">Pay Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<script>
    function convertToFloat()
{

    let showpaynow = $("#showpaynow");
    if($('#amount').val()% 1 == 0){
    var amount=parseFloat($('#amount').val()).toFixed(2);
    }else{
        var amount= $('#amount').val();
    }
    showpaynow.removeAttr('disabled');
    $('#amount').val(parseFloat(amount).toFixed(2));
}
</script>

@endsection
@section('scripts')
<script>
function changePassword()
{
    var oldPassword=$('#oldPassword').val();
    var newPassword=$('#newPassword').val();
    var newPasswordC=$('#newPasswordC').val();
    if(!oldPassword) {
        alertMessage('Error!', 'Please enter old password.', 'error', 'no');
        return false;
    } else if(!newPassword) {
        alertMessage('Error!', 'Please enter new password.', 'error', 'no');
        return false;
    } else if(!newPasswordC) {
        alertMessage('Error!', 'Please please enter confirm password.', 'error', 'no');
        return false;
    } else if(newPassword != newPasswordC) {
        alertMessage('Error!', 'Confirm password not matched.', 'error', 'no');
        return false;
    }else{
        $('#changePasswordBtn').text('Please Wait...').attr('disabled','disabled');
        $.post('{{route('changePasswordWeb')}}',{
            "_token": "{{ csrf_token() }}",
            oldPassword:oldPassword,
            newPassword:newPassword,
            newPasswordC:newPasswordC,
        },function(data){
            var obj = JSON.parse(data);
            $('#changePasswordBtn').text('Save').removeAttr('disabled');
            if(obj.status=='success'){
                $('#oldPassword').val('');
                $('#newPassword').val('');
                $('#newPasswordC').val('');
                alertMessage('Success!', obj.message, 'success', 'no');
                return false;
            }else{
                alertMessage('Error!', obj.message, 'error', 'no');
                return false;
            }
        });
    }
}

function getLoanHistoryByUser(loanType)
{
    $('#changePasswordBtn').text('Please Wait...').attr('disabled','disabled');
    $.post('{{route('getLoanHistoryByUserWeb')}}',{
        "_token": "{{ csrf_token() }}",
        loanType:loanType,
    },function(data){
        $('#loanHistoryHtml').html(data);
    });
}


</script>
@endsection
