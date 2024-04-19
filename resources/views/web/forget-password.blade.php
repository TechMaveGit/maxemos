<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
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
                        <h3>Password Reset</h3>
                        <p>To reset your password, Enter the email address which you used at registration</p>
                        
                        <input name="email" type="email" class="form-control" id="userEmail" placeholder="E-mail Address"
                            required>
                        <div class="form-button full-width">
                            <button id="submit" type="button" onclick="sendMailForForgetPassword();" class="ibtn btn-forget">Send Reset Link</button>
                        </div>
                    </div>
                    <div class="form-sent">
                        <div class="tick-holder">
                            <div class="tick-icon"></div>
                        </div>
                        <h3>Password link sent</h3>
                        <p>Please check your inbox <a href="https://brandio.io/cdn-cgi/l/email-protection"
                                class="__cf_email__"
                                data-cfemail="20494f46524d60494f46524d54454d504c4154450e494f">[email&#160;protected]</a>
                        </p>
                        <div class="info-holder">
                            <span>Unsure if that email address was correct?</span> <a href="#">We can help</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="{{ asset('assets/web') }}/login/js/jquery.min.js"></script>
    <script src="{{ asset('assets/web') }}/login/js/popper.min.js"></script>
    <script src="{{ asset('assets/web') }}/login/js/main.js"></script>
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
                    setTimeout(() => {
                        window.opener.location.replace("{{ route('webUserLogin') }}");
                    }, 5000);
                } else {
                    $('.mobileOtpHtml').hide();
                    $('.sendOtpBtnHtml').show();
                    alertMessage('Error!', obj.message, 'error', 'no');
                }
            });
        }
    }
</script>
</body>

</html>
