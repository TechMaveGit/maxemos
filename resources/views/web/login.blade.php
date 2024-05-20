<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/web') }}/asset/img/logo/favicon.png" type="image/gif">
    <link rel="stylesheet" href="{{ asset('assets/web') }}/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/web') }}/asset/fonts/flaticon/font/flaticon.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('assets/web') }}/login/css/iofrm-style.css">
    <link rel="stylesheet" href="{{ asset('assets/web') }}/login/css/iofrm-theme4.css">
    <link rel="stylesheet" href="{{ asset('assets/web') }}/login/css/fontawesome-all.min.css">
</head>

<body>
    <div style="position: absolute; bottom: 0px; width: 100%; z-index: 10000; text-align: center;">
        <h6 style="padding: 18px 30px; background-color: aliceblue; margin: 0px;">Feel free to contact us in case of any queries. Helpline Number - 7827218200</h6>
    </div>
    <div class="form-body">
        <div class="website-logo">
            <a href="{{ route('welcomeWeb') }}">
                <div class="logo">
                    <img class="logo-size" src="{{ asset('assets/web') }}/login/images/maxemo-logo.png" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="{{ asset('assets/web') }}/login/images/graphic1.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Get more things done with <br> Login platform. </h3>
                        <p>Welcome To Maxemo Capital </p>
                        <div class="page-links">
                            <a href="##" class="active">Login</a><a href="{{ route('signUp') }}">Register</a>
                        </div>
                        <div class="inline-el-holder select__options">
                            <div class="inline-el email__formtrigger">
                                <div class="rad-with-details">
                                    <input type="radio" id="rad1" name="rad" required=""
                                        checked=""><label for="rad1">Email & Password </label>
                                </div>
                            </div>
                            <div class="inline-el mobile__formtrigger">
                                <div class="rad-with-details">
                                    <input type="radio" id="rad2" name="rad" required=""><label
                                        for="rad2">Mobile & OTP </label>
                                </div>
                            </div>
                        </div>
                        <form id="actionForm" class="emailpass__form">@csrf
                            <input class="form-control" type="email" name="email" id="email" placeholder="E-mail Address"
                                required>
                            <div class="password__input">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                                    required>
                                <span class="fa-regular fa-eye-slash field-icon " id="eye"></span>
                            </div>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Login</button> <a
                                    href="{{ route('forgetPassword') }}">Forgot password?</a>
                            </div>
                        </form>
                        <div class="mobilenumber__form">
                            <input class="form-control" name="mobile" id="mobile" type="number" placeholder="Enter Mobile Number"
                                required>
                            <div class="form-button">
                                <button id="sendOtpBtn" onclick="sendLoginOTP();" type="button" class="ibtn send_otpbtn">Send OTP</button> <a
                                    href="{{ route('signUp') }}">Don't have an account? Register here</a>
                            </div>
                        </div>
                        <div class="otp__form">
                            <input class="form-control" type="text"  name="mobileOtp" id="mobileOtp" placeholder="Enter OTP" required>
                            <div class="form-button">
                                <button id="verifyBtn" onclick="verifyLoginOTP();" type="button" class="ibtn">Verify OTP</button>
                                <button id="resendOtp" onclick="sendLoginOTP();" type="button" class="ibtn resendotp__btn">Resend OTP</button>
                            </div>
                        </div>

                       

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/web') }}/login/js/jquery.min.js"></script>
    <script src="{{ asset('assets/web') }}/login/js/popper.min.js"></script>
    <script src="{{ asset('assets/web') }}/login/js/main.js"></script>
    <script src="{{ asset('assets/sweetalert.min.js') }}"></script>
    <!-- form hide show -->
    <script>
        $(document).ready(function() {
            $(".mobilenumber__form").hide();
            $(".otp__form").hide();
            $(".mobile__formtrigger").click(function() {
                $(".mobilenumber__form").show();
                $(".emailpass__form").hide();
            });
            $(".email__formtrigger").click(function() {
                $(".mobilenumber__form").hide();
                $(".emailpass__form").show();
                $(".otp__form").hide();
            });
            // $(".send_otpbtn").click(function() {
            //     $(".mobilenumber__form").hide();
            //     $(".emailpass__form").hide();
            //     $(".otp__form").show();
            // });
        })
    </script>
    <script>
        $(function() {
            $('#eye').click(function() {
                if ($(this).hasClass('fa-eye-slash')) {
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                    $('#password').attr('type', 'text');
                } else {
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                    $('#password').attr('type', 'password');
                }
            });
        });
    </script>
    <script>
        $('#actionForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var email = $('#email').val();
            var password = $('#password').val();
            if (!email) {
                alertMessage('Error!', 'Please enter the email.', 'error', 'no');
                return false;
            } else if (!password) {
                alertMessage('Error!', 'PLease enter the password.', 'error', 'no');
                return false;
            } else {
                $('#formSubmitBtn').text('Please Wait...').attr('disabled', 'disabled');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('webUserLoginCheck') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                    console.log(data,JSON.parse(data));
                        var obj = JSON.parse(data);
                        $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                        if (obj.status == 'success') {
                            swal({
                                title: 'Congratulations!',
                                text: obj.message,
                                icon: 'success',
                            });
                            location.href = obj.URL;
                        } else {
                            alertMessage('Error!', obj.message, 'error', 'no');
                            return false;
                        }
                    },
                    error: function(data) {
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

        function checkLoginType() {
            var loginType = $('input[name="loginWith"]:checked').val();
            if (loginType == 'email') {
                $('.emailFrm').show();
                $('.mobileFrm').hide();
            } else {
                $('.emailFrm').hide();
                $('.mobileFrm').show();
            }
        }

        function sendLoginOTP() {
            var mobile = $('#mobile').val();
            var regex = /^(0|91)?[6-9][0-9]{9}$/;
            if (!$.trim(mobile)) {
                alertMessage('Error!', 'Please enter mobile number.', 'error', 'no');
                return false;
            }else if(!regex.test(mobile)){
                alertMessage('Error!', 'Please enter valid mobile number.', 'error', 'no');
                return false;
            } else {
                $.post('{{ route('sendLoginOTP') }}', {
                    "_token": "{{ csrf_token() }}",
                    mobile: mobile,
                }, function(data) {
                    var obj = JSON.parse(data);
                    if (obj.status == 'success') {
                        $('#mobileOtp').val('');
                        $(".mobilenumber__form").hide();
                        $(".emailpass__form").hide();
                        $(".otp__form").show();
                        alertMessage('Success!', obj.message, 'success', 'no');
                    } else {
                        alertMessage('Error!', obj.message, 'error', 'no');
                    }
                });
            }
        }

        function verifyLoginOTP() {
            var mobile = $('#mobile').val();
            var mobileOtp = $('#mobileOtp').val();
            if (!$.trim(mobile)) {
                alertMessage('Error!', 'Please enter mobile number.', 'error', 'no');
                return false;
            } else if (!$.trim(mobileOtp)) {
                alertMessage('Error!', 'Please enter OTP.', 'error', 'no');
                return false;
            } else {
                $.post('{{ route('verifyLoginOTP') }}', {
                    "_token": "{{ csrf_token() }}",
                    mobile: mobile,
                    sendOtp: mobileOtp,
                }, function(data) {
                    var obj = JSON.parse(data);
                    if (obj.status == 'success') {
                        swal({
                            title: 'Congratulations!',
                            text: obj.message,
                            icon: 'success',
                        });
                        location.href = obj.URL;
                    } else {
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }
    </script>

<!-- timer code -->




</body>

</html>
