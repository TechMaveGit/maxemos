<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{asset('assets/web')}}/asset/img/logo/favicon.png" type="image/gif">
    <link rel="stylesheet" href="{{asset('assets/web')}}/asset/css/bootstrap.min.css">
   <link rel="stylesheet" href="{{asset('assets/web')}}/asset/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/web')}}/asset/css/signup.css">
</head>
<body>
<!-- Login 11 start -->
<div class="login-11">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-12 bg-color-11">
                <div class="form-section">
                    <div class="logo">
                        <a href="{{route('welcomeWeb')}}">
                        <img src="{{asset('assets/web')}}/asset/img/logo/maxemo-logo.png" alt="logo">
                        </a>
                    </div>
                    <h3>Sign Into Your Account</h3>
                    <div class="login-inner-form">
                        <form action="" method="post" id="actionForm">
                            @csrf
                            <div class="form-group clearfix">
                                <label for="mobile" class="form-label">Login With</label>
                                <div class="form-box">
                                    <input type="radio" checked onclick="checkLoginType();" name="loginWith" value="email"> Email & Password <br>
                                    <input type="radio" name="loginWith" onclick="checkLoginType();" value="mobile"> Mobile & OTP <br>
                                </div>
                            </div>
                            <div class="mobileFrm" style="display: none;">
                                <div class="form-group clearfix">
                                    <label for="mobile" class="form-label">Enter Mobile</label>
                                    <div class="form-box">
                                        <input name="mobile" id="mobile" type="number" class="form-control" placeholder="Enter Mobile Number" aria-label="Enter Mobile Number">
                                        <i class="flaticon-mail-2"></i>
                                    </div>
                                </div>
                                <div class="form-group clearfix mobileOtpHtml" style="display: none;">
                                    <label for="mobileOtp" class="form-label">Enter OTP</label>
                                    <div class="form-box">
                                        <input name="mobileOtp" id="mobileOtp" type="number" class="form-control" placeholder="Enter OTP" aria-label="Enter OTP">
                                        <i class="flaticon-mail-2"></i>
                                    </div>
                                </div>
                                <div class="row col-md-12 mobileOtpHtml" style="display: none;">
                                    <div class="col-lg-6 ">
                                        <button type="button" id="verifyBtn" onclick="verifyLoginOTP();" class="btn btn-primary btn-xs">Verify OTP</button>
                                    </div>
                                    <div class="col-lg-6">
                                        <button type="button" id="resendOtp" onclick="sendLoginOTP();" class="btn btn-primary btn-xs">Resend OTP</button>
                                    </div>
                                </div>
                                <div class="form-group clearfix mb-0 sendOtpBtnHtml">
                                    <button type="button" id="sendOtpBtn" onclick="sendLoginOTP();" class="btn btn-primary btn-lg btn-theme">Send OTP</button>
                               </div>
                            </div>
                            <div class="emailFrm">
                                <div class="form-group clearfix">
                                    <label for="email" class="form-label">Email address</label>
                                    <div class="form-box">
                                        <input name="email" id="email" type="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                                        <i class="flaticon-mail-2"></i>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="form-box">
                                        <input name="password" id="password"  type="password" class="form-control" autocomplete="off" id="second_field" placeholder="Password" aria-label="Password">
                                        <i class="flaticon-password"></i>
                                    </div>
                                </div>
                                <div class="checkbox form-group clearfix">
                                    {{--<div class="form-check float-start">
                                        <input class="form-check-input" type="checkbox" id="rememberme">
                                        <label class="form-check-label" for="rememberme">
                                            Remember me
                                        </label>
                                    </div>--}}
                                    <a href="{{route('forgetPassword')}}" class="link-light float-end forgot-password">Forgot your password?</a>
                                </div>
                                <div class="form-group clearfix mb-0">
                                     <button type="submit" id="formSubmitBtn" class="btn btn-primary btn-lg btn-theme">Login</button>
                                </div>
                            </div>
                        </form>
                       {{-- <div class="extra-login">
                            <span>Or Login With</span>
                        </div>
                        <ul class="social-list clearfix">
                            <li><a href="#" class="facebook-bg">Facebook</a></li>
                            <li><a href="#" class="twitter-bg">Twitter</a></li>
                            <li><a href="#" class="google-bg">Google</a></li>
                        </ul>--}}
                    </div>
                    <p class="text-center">Don't have an account?<a href="{{route('signUp')}}"> Register here</a></p>
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
<!-- Login 11 end -->
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
                url: "{{route('webUserLoginCheck')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
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
    function checkLoginType()
    {
        var loginType=$('input[name="loginWith"]:checked').val();
        if(loginType=='email')
        {
            $('.emailFrm').show();
            $('.mobileFrm').hide();
        }else{
            $('.emailFrm').hide();
            $('.mobileFrm').show();
        }
    }
    function sendLoginOTP(){
        var mobile=$('#mobile').val();
        if(!$.trim(mobile))
        {
            alertMessage('Error!', 'Please enter mobile number.', 'error', 'no');
            return false;
        }else{
            $.post('{{route('sendLoginOTP')}}',{
                "_token": "{{ csrf_token() }}",
                mobile:mobile,
            },function(data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
                    $('#mobileOtp').val('');
                    $('.mobileOtpHtml').show();
                    $('.sendOtpBtnHtml').hide();
                     alertMessage('Success!', obj.message, 'success', 'no');
                }else{
                    $('.mobileOtpHtml').hide();
                    $('.sendOtpBtnHtml').show();
                     alertMessage('Error!', obj.message, 'error', 'no');
                }
            });
        }
    }
    function verifyLoginOTP(){
        var mobile=$('#mobile').val();
        var mobileOtp=$('#mobileOtp').val();
        if(!$.trim(mobile))
        {
            alertMessage('Error!', 'Please enter mobile number.', 'error', 'no');
            return false;
        }else if(!$.trim(mobileOtp))
        {
            alertMessage('Error!', 'Please enter OTP.', 'error', 'no');
            return false;
        }else{
            $.post('{{route('verifyLoginOTP')}}',{
                "_token": "{{ csrf_token() }}",
                mobile:mobile,
                sendOtp:mobileOtp,
            },function(data){
                var obj = JSON.parse(data);
                if(obj.status=='success'){
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
            });
        }
    }
</script>
</body>
</html>