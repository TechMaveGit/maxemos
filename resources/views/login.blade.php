<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{asset('assets/admin')}}/asset/img/logo/favicon.png" type="image/gif">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin')}}/css/signup.css">
</head>
<body>

<!-- Login 11 start -->
<div class="login-11">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-12 bg-color-11">
                <div class="form-section">
                    <div class="logo">
                        <a href="javascript:;">
                            <img src="{{asset('assets/admin')}}/images/logos/maxemo-logo.png" alt="logo">
                        </a>
                    </div>
                    <h3>Welcome to Dashboard</h3>
                    <div class="login-inner-form">
                        <form action="" method="post" id="actionForm">
                            @csrf
                            <div class="form-group clearfix">
                                <label for="first_field" class="form-label">Email address</label>
                                <div class="form-box">
                                    <input name="email" id="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                                    <i class="flaticon-mail-2"></i>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label for="second_field" class="form-label">Password</label>
                                <div class="form-box">
                                    <input name="password" id="password" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                                    <i class="flaticon-password"></i>
                                </div>
                            </div>
                            {{--<div class="checkbox form-group clearfix">
                                <div class="form-check float-start">
                                    <input class="form-check-input" type="checkbox" id="rememberme">
                                    <label class="form-check-label" for="rememberme">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#" class="link-light float-end forgot-password">Forgot your password?</a>
                            </div>--}}
                            <div class="form-group clearfix mb-0">
                             <button type="submit" id="formSubmitBtn" class="btn btn-primary btn-lg btn-theme">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 col-md-12 bg-img">
                <div class="info">
                    <h1 class="animate-charcter">Welcome To Maxemo</h1>
                    {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type</p> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('assets/sweetalert.min.js')}}"></script>
<script>
    $('#actionForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var email=$('#email').val();
        var password=$('#password').val();
        if(!email){
            alertMessage('Error!', 'Please enter the email.', 'error', 'no');
            return false;
        } else if(!password) {
            alertMessage('Error!', 'PLease enter the password.', 'error', 'no');
            return false;
        } else{
            $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');
            $.ajax({
                type:'POST',
                url: "{{route('userLogin')}}",
                data: formData,
                cache:false,
                contentType: false,
                dataType: 'json',
                processData: false,
                success: (data) => {
                    console.log(data);
                    var obj = data;
                    $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                    if(obj.status=='success')
                    {
                        swal({
                            title: 'Congratulations!',
                            text: obj.message,
                            icon: 'success',
                        });
                        location.href=obj.URL;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                },
                error: function(data){
                    alertMessage('Error!', 'Invalid data uploaded.', 'error', 'no');
                    $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                    return false;
                }
            });
        }
    });
</script>
<script>
    function alertMessage(textH, textMessage, textIcon, action) {
        swal({
            title: textH,
            text: textMessage,
            icon: textIcon,
            closeOnClickOutside: false,
        }).then((willDelete) => {
            if (willDelete && action == 'yes') {
                location.reload();
            }
        });
    }

    function waitForProcess() {
        swal("Please wait while processing..", {
            title: 'Please Wait!.',
            buttons: false,
            closeOnClickOutside: false,
        });
    }

    function wip() {
        swal("Thanks for patience, It will available soon.", {
            title: 'Work in progress!',
            closeOnClickOutside: false,
        });
    }

</script>


</body>
</html>
