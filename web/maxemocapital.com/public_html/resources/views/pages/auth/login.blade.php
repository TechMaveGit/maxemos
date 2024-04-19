@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
            <div class="auth-side-wrapper" style="background-image: url({{ url('/assets/images/loginimage.jpg') }})">

            </div>
          </div>
          <label class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo loginlogo d-block mb-2"><img class="gallery-img img-fluid mx-auto" src="../assets/images/advanx-01.png" alt="">
</a>
              <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
              <form class="forms-sample" id="actionForm" method="post" action="">
                  @csrf
                <div class="mb-3">
                  <label for="userEmail" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" placeholder="Password">
                </div>
                  {{--
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="authCheck">
                  <label class="form-check-label" for="authCheck">
                    Remember me
                  </label>
                </div>
                  --}}
                <div>
                <button type="submit" id="formSubmitBtn" class="btn btn-primary me-2 mb-2 mb-md-0">Login</button>
                 {{-- <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="twitter"></i>
                    Login with twitter
                  </button>
                    --}}
                </div>
                  {{--
                <a href="{{ url('/auth/register') }}" class="d-block mt-3 text-muted">Not a user? Sign up</a>
                  --}}
              </form>
            </div>
              <div class="auth-form-wrapper px-4">
              <label>Copyright © 2022 AdvanX. All rights reserved.</label>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
@section('scripts')
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
@endsection
