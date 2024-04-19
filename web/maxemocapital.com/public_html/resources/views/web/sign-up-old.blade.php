<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign Up</title>

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

                    <h3>Create An Account</h3>

                    <div class="login-inner-form">

                        <form method="POST" id="actionForm">

                            @csrf

                            <div class="form-group clearfix">

                                <label for="name" class="form-label">Full Name</label>

                                <div class="form-box">

                                    <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" aria-label="Full Name">

                                    <i class="flaticon-user"></i>

                                </div>

                            </div>

                            <div class="form-group clearfix">

                                <label for="email" class="form-label">Email address</label>

                                <div class="form-box">

                                    <input name="email" type="email" class="form-control" id="email" placeholder="Email Address" aria-label="Email Address">

                                    <i class="flaticon-mail-2"></i>

                                </div>

                            </div>

                            <div class="form-group clearfix">

                                <label for="mobileNumber" class="form-label">Mobile Number</label>

                                <div class="form-box">

                                    <input name="mobileNumber" type="number" class="form-control" id="mobileNumber" placeholder="Mobile Number" aria-label="Mobile Number">

                                    <i class="flaticon-mail-2"></i>

                                </div>

                            </div>

                            <div class="form-group clearfix">

                                <label for="password" class="form-label">Password</label>

                                <div class="form-box">

                                    <input name="password" type="password" class="form-control" autocomplete="off" id="password" placeholder="Password" aria-label="Password">

                                    <i class="flaticon-password"></i>

                                </div>

                            </div>

                            <div class="form-group clearfix">

                                <label for="password" class="form-label">Confirm Password</label>

                                <div class="form-box">

                                    <input name="cpassword" type="password" class="form-control" autocomplete="off" id="cpassword" placeholder="Confirm Password" aria-label="Password">

                                    <i class="flaticon-password"></i>

                                </div>

                            </div>

                            <div class="form-group checkbox clearfix">

                                <div class="clearfix float-start">

                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" value="yes" id="accepttermsAndConditions">

                                        <label class="form-check-label" for="accepttermsAndConditions">

                                            I agree to the terms of service

                                        </label>

                                    </div>

                                </div>

                            </div>

                            <div class="form-group clearfix mb-0">

                                <button type="submit" id="formSubmitBtn" class="btn btn-primary btn-lg btn-theme">Register</button>

                            </div>

                        </form>

                        {{--<div class="extra-login">

                            <span>Or Login With</span>

                        </div>

                        <ul class="social-list clearfix">

                            <li><a href="#" class="facebook-bg">Facebook</a></li>

                            <li><a href="#" class="twitter-bg">Twitter</a></li>

                            <li><a href="#" class="google-bg">Google</a></li>

                        </ul>--}}

                    </div>

                    <p class="text-center">Already have an account?<a href="{{route('webUserLogin')}}"> Login here</a></p>

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

    <script src="{{ asset('assets/sweetalert.min.js') }}"></script>

<script>

    $('#actionForm').submit(function(e) {

        e.preventDefault();



        var formData = new FormData(this);



        var name=$('#name').val();

        var email=$('#email').val();

        var mobileNumber=$('#mobileNumber').val();

        var password=$('#password').val();

        var cpassword=$('#cpassword').val();

        var accepttermsAndConditions=$('#accepttermsAndConditions:checked').val();

        if(!name){

            alertMessage('Error!', 'Please enter the name.', 'error', 'no');

            return false;

        }else if(!email){

            alertMessage('Error!', 'Please enter the email.', 'error', 'no');

            return false;

        }else if(!mobileNumber){

            alertMessage('Error!', 'Please enter the mobile number.', 'error', 'no');

            return false;

        }else if(!parseInt(mobileNumber) || mobileNumber.length!=10){

            alertMessage('Error!', 'Please enter the valid mobile number.', 'error', 'no');

            return false;

        } else if(!password) {

            alertMessage('Error!', 'Please enter the password.', 'error', 'no');

            return false;

        } else if(password !=cpassword) {

            alertMessage('Error!', 'Confirm password not matched.', 'error', 'no');

            return false;

        } else if(!accepttermsAndConditions) {

            alertMessage('Error!', 'Please accept the terms & condition.', 'error', 'no');

            return false;

        } else{

            $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');

            $.ajax({

                type:'POST',

                url: "{{route('saveCustomerInfoWebSignUp')}}",

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

                        setTimeout(() => {

                            location.href=obj.URL;

                        }, 3000);

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