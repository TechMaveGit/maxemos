<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="icon" href="{{ asset('assets/web') }}/asset/img/logo/favicon.png" type="image/gif">
    <link rel="stylesheet" href="{{ asset('assets/web') }}/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/web') }}/asset/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web') }}/asset/css/signup.css">
</head>

<body>
    <!-- Login 11 start -->
    <div class="login-11">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-12 bg-color-11">
                    <div class="form-section">
                        <div class="logo">
                            <a href="{{ route('welcomeWeb') }}">
                                <img src="{{ asset('assets/web') }}/asset/img/logo/maxemo-logo.png" alt="logo">
                            </a>
                        </div>
                        <h3>Recover Your Password</h3>
                        <div class="login-inner-form">
                            <div class="form-group clearfix">
                                <label for="first_field" class="form-label">Email address</label>
                                <div class="form-box">
                                    <input name="email" type="email" class="form-control" id="userEmail"
                                        placeholder="Email Address" aria-label="Email Address">
                                    <i class="flaticon-mail-2"></i>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button type="button" onclick="sendMailForForgetPassword();"
                                    class="btn btn-primary btn-lg btn-theme">Send Me Email</button>
                            </div>
                            {{-- <div class="extra-login">
                            <span>Or Login With</span>
                        </div>
                        <ul class="social-list clearfix">
                            <li><a href="#" class="facebook-bg">Facebook</a></li>
                            <li><a href="#" class="twitter-bg">Twitter</a></li>
                            <li><a href="#" class="google-bg">Google</a></li>
                        </ul> --}}
                        </div>
                        <p class="text-center">Already a member?<a href="{{ route('webUserLogin') }}"> Login here</a>
                        </p>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-12 bg-img">
                    <div class="info">
                        <h1 class="animate-charcter">Welcome To Maxemo</h1>
                        {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login 11 end -->
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('assets/sweetalert.min.js') }}"></script>
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

    function sendMailForForgetPassword() {
        var userEmail = $('#userEmail').val();
        if (!userEmail) {
            alertMessage('Error!', 'Please enter the registered email.', 'error', 'no');
            return false;
        } else {
            waitForProcess();
            $.post('{{ route('sendMailForForgetPassword') }}', {
                "_token": "{{ csrf_token() }}",
                userEmail: userEmail,
            }, function(data) {
                var obj = JSON.parse(data);
                if (obj.status == 'success') {
                    $('#mobileOtp').val('');
                    $('.mobileOtpHtml').show();
                    $('.sendOtpBtnHtml').hide();
                    alertMessage('Success!', obj.message, 'success', 'no');
                } else {
                    $('.mobileOtpHtml').hide();
                    $('.sendOtpBtnHtml').show();
                    alertMessage('Error!', obj.message, 'error', 'no');
                }
            });
        }
    }
</script>
