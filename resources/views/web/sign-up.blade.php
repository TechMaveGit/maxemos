<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up Now</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <h3>Create An Account</h3>
                        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis reprehenderit similique
                            qui.</p> --}}
                        <div class="page-links">
                            <a href="{{ route('webUserLogin') }}">Login</a><a href="{{ route('signUp') }}"
                                class="active">Register</a>
                        </div>
                        <form method="POST" id="actionForm">
                            @csrf
                            <input class="form-control" type="text" id="name" name="name" placeholder="Full Name" required>
                            <input class="form-control" name="email" type="email"  id="email" placeholder="E-mail Address" required>
                            <input class="form-control" id="mobileNumber" name="mobileNumber" type="number" placeholder="Mobile Number" required>
                            <div class="password__input">
                                <input name="password" type="password" class="form-control" autocomplete="off"
                                id="password" placeholder="Password" required>
                                <span class="fa-regular fa-eye-slash field-icon " id="eye"></span>
                            </div>
                            <div class="password__input">
                                <input name="cpassword" type="password" class="form-control" autocomplete="off"
                                id="cpassword" placeholder="Confirm Password" required>
                                <span class="fa-regular fa-eye-slash field-icon " id="eye2"></span>
                            </div>
                            <div class="form-group checkbox clearfix">
                                <div class="clearfix float-start">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="yes"
                                            id="accepttermsAndConditions">
                                        <label class="form-check-label" for="accepttermsAndConditions">
                                            I agree to the <a href="{{route('webTermCondition')}}">terms of service</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-button">
                                <button id="formSubmitBtn" type="submit" class="ibtn">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/web') }}/login/js/jquery.min.js"></script>
    <script src="{{ asset('assets/web') }}/login/js/popper.min.js"></script>
    <script src="{{ asset('assets/web') }}/login/js/main.js"></script>
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
        $(function() {
            $('#eye2').click(function() {
                if ($(this).hasClass('fa-eye-slash')) {
                    $(this).removeClass('fa-eye-slash');
                    $(this).addClass('fa-eye');
                    $('#cpassword').attr('type', 'text');
                } else {
                    $(this).removeClass('fa-eye');
                    $(this).addClass('fa-eye-slash');
                    $('#cpassword').attr('type', 'password');
                }
            });
        });
    </script>
     <script src="{{ asset('assets/sweetalert.min.js') }}"></script>
     <script>
         $('#actionForm').submit(function(e) {
             e.preventDefault();
             var formData = new FormData(this);
             var name = $('#name').val();
             var email = $('#email').val();
             var mobileNumber = $('#mobileNumber').val();
             var password = $('#password').val();
             var cpassword = $('#cpassword').val();
             var accepttermsAndConditions = $('#accepttermsAndConditions:checked').val();
             var regex = /^(0|91)?[6-9][0-9]{9}$/;
            
             if (!name) {
                 alertMessage('Error!', 'Please enter the name.', 'error', 'no');
                 return false;
             } else if (!email) {
                 alertMessage('Error!', 'Please enter the email.', 'error', 'no');
                 return false;
             } else if (!mobileNumber) {
                 alertMessage('Error!', 'Please enter the mobile number.', 'error', 'no');
                 return false;
             } else if(!regex.test(mobileNumber)){
                alertMessage('Error!', 'Please enter valid mobile number.', 'error', 'no');
                return false;
                } else if (!password) {
                 alertMessage('Error!', 'Please enter the password.', 'error', 'no');
                 return false;
             } else if (password != cpassword) {
                 alertMessage('Error!', 'Confirm password not matched.', 'error', 'no');
                 return false;
             } else if (!accepttermsAndConditions) {
                 alertMessage('Error!', 'Please accept the terms & condition.', 'error', 'no');
                 return false;
             } else {
                 $('#formSubmitBtn').text('Please Wait...').attr('disabled', 'disabled');
                 $.ajax({
                     type: 'POST',
                     url: "{{ route('saveCustomerInfoWebSignUp') }}",
                     data: formData,
                     cache: false,
                     contentType: false,
                     processData: false,
                     success: (data) => {
                         var obj = JSON.parse(data);
                         $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                         if (obj.status == 'success')
                         {
                             swal({
                                 title: 'Congratulations!',
                                 text: obj.message,
                                 icon: 'success',
                             });
                             setTimeout(() => {
                                 location.href = obj.URL;
                             }, 3000);
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
     </script>
</body>

</html>
