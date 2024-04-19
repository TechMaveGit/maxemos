@extends('layout.master')

@section('content')
    <main >
        @php
            if($userDtl->profilePic){
                $profilePic=env('APP_URL').'public/'.$userDtl->profilePic;
            }else{
                $profilePic='https://media.istockphoto.com/vectors/male-face-silhouette-or-icon-man-avatar-profile-unknown-or-anonymous-vector-id1087531642?k=20&m=1087531642&s=612x612&w=0&h=D6OBNUY7ZxQTAHNVtL9mm2wbHb_dP6ogIsCCWCqiYQg=';
            }
        @endphp

        <div class="breadcrums_area breadcrums">

            <div class="common_pagetitle">Profile</div>

            <div class="flex items-center space-x-4  lg:py-6 breadcrum_right">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl breadcrum_largetitle">
                    Dashboard
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="index.php">Home</a>
                        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li>Profile</li>
                </ul>
            </div>


        </div>

        <div class="main_page_title">
            <div class="common_pagetitlebig">Profile</div>
        </div>

        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12 lg:col-span-4">
                <div class="card p-4 sm:p-5">
                    <div class="flex items-center space-x-4">
                        <div class="avatar h-14 w-14">
                            <img class="rounded-full" src="{{$profilePic}}" alt="avatar">
                        </div>
                        <div>
                            <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                                {{$userDtl->name}}
                            </h3>
                            <p class="text-xs+">{{$userDtl->roleName}}</p>
                        </div>
                    </div>
                    <ul class="mt-6 space-y-1.5 font-inter font-medium personalinfo_box">
                        <li>
                            <a class="flex items-center space-x-2 rounded-lg bg-primary px-4 py-2.5 tracking-wide text-white outline-none transition-all dark:bg-accent" href="#">

                                <span>Personal Information</span>
                            </a>
                        </li>
                        <li>
                            <a class="group flex space-x-2 rounded-lg py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100" href="#">
                                <div class="personalinfo_dettails">
                                    <i class="fa fa-address-card"></i>

                                    <span>User ID</span>
                                </div>
                                <div class="per_info"><p>{{$userDtl->customerCode}}</p></div>


                            </a>
                        </li>
                        <li>
                            <a class="group flex space-x-2 rounded-lg py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100" href="#">
                                <div class="personalinfo_dettails">
                                    <i class="fa fa-user-alt"></i>
                                    <span>User Name</span>
                                </div>
                                <div class="per_info"><p>{{$userDtl->name}}</p></div>
                            </a>
                        </li>

                        <li>
                            <a class="group flex space-x-2 rounded-lg py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100" href="#">

                                <div class="personalinfo_dettails">
                                    <i class="fa fa-lock"></i>

                                    <span>User Type </span>
                                </div>
                                <div class="per_info"><p>{{$userDtl->roleName}}</p></div>


                            </a>
                        </li>
                        <li>
                            <a class="group flex space-x-2 rounded-lg py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100" href="#">

                                <div class="personalinfo_dettails">
                                    <i class="fa fa-envelope" ></i>
                                    <span> Email </span>
                                </div>
                                <div class="per_info"><p>{{$userDtl->email}} </p></div>
                            </a>
                        </li>
                        <li>
                            <a class="group flex space-x-2 rounded-lg py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100" href="#">
                                <div class="personalinfo_dettails">
                                    <i class="fa fa-phone-alt" fill="none" viewBox="0 0 24 24" stroke="currentColor"></i>
                                    <span> Mobile No </span>
                                </div>
                                <div class="per_info"><p>{{$userDtl->mobile}}</p></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-8">
                <div class="card">
                    <form action="" id="profileDetailsForm" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                            Edit Profile
                        </h2>
                        <div class="flex justify-center space-x-2">
                            <button type="submit" id="profileDetailsFormBtn" class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    Update
                                </button>
                        </div>
                    </div>
                    <div class="p-4 sm:p-5">
                            <div class="flex flex-col">
                                <span class="text-base font-medium text-slate-600 dark:text-navy-100">Profile Photo</span>
                                <div class="avatar mt-1.5 h-20 w-20">
                                    <img class="mask is-squircle" src="{{$profilePic}}" alt="avatar">
                                </div>
                            </div>
                            <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 editform_start">
                                <label class="block">
                                    <span>User ID</span>
                                    <span class="relative mt-1.5 flex">
                                        <input disabled style="cursor: not-allowed;" name="userid" value="{{$userDtl->customerCode}}" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter full name" type="text">
                                      <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="fa-regular fa-user text-base"></i>
                                      </span>
                                </span>
                                </label>
                                <label class="block">
                                    <span>User Name </span>
                                    <span class="relative mt-1.5 flex">
                      <input name="username" id="username" value="{{$userDtl->name}}" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter name" type="text">
                      <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                        <i class="fa-regular fa-user text-base"></i>
                      </span>
                    </span>
                                </label>
                                <label class="block">
                                    <span>Email Address </span>
                                    <span class="relative mt-1.5 flex">
                      <input name="useremail" id="useremail" value="{{$userDtl->email}}" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter email address" type="text">
                      <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                        <i class="fa-regular fa-envelope text-base"></i>
                      </span>
                    </span>
                                </label>
                                <label class="block">
                                    <span>Phone Number</span>
                                    <span class="relative mt-1.5 flex">
                      <input name="usermobile" id="usermobile" value="{{$userDtl->mobile}}" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter phone number" type="text">
                      <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                        <i class="fa fa-phone"></i>
                      </span>
                    </span>
                                </label>

                                <label class="block">
                                    <span>Profile Pic.</span>
                                    <span class="relative mt-1.5 flex">
                      <input name="userprofile" id="userprofile" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="file">
                      <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                      </span>
                    </span>
                                </label>
                                <label class="block"></label>

                            </div>
                            <div class="row mt-4"><hr>
                                <div class="col-md-12 mt-2">

                                    <center> <h2 style="color: red;">Enter password if you want to change it.</h2></center>
                                </div>
                                <div class="col-md-6 mt-5">
                                    <label class="block">
                                        <span>New Password</span>
                                        <span class="relative mt-1.5 flex">
                                      <input name="userpassword" id="userpassword" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="******" type="password">
                                      <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="fa fa-key"></i>
                                      </span>
                                    </span>
                                    </label>
                                </div>
                                <div class="col-md-6 mt-5">
                                    <label class="block">
                                        <span>Confirm Password</span>
                                        <span class="relative mt-1.5 flex">
                                      <input name="userpassword2" id="userpassword2" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="******" type="password">
                                      <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="fa fa-key"></i>
                                      </span>
                                    </span>
                                    </label>
                                </div>
                            </div>
                            <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $('#profileDetailsForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            var recordId=$('.recordId').val();
            var username=$('#username').val();
            var useremail=$('#useremail').val();
            var usermobile=$('#usermobile').val();
            var userpassword=$('#userpassword').val();
            var userpassword2=$('#userpassword2').val();


            if(!username) {
                alertMessage('Error!', 'Please enter name.', 'error', 'no');
                return false;
            } else if(!useremail) {
                alertMessage('Error!', 'Please enter email.', 'error', 'no');
                return false;
            }else if(!usermobile) {
                alertMessage('Error!', 'Please enter mobile number.', 'error', 'no');
                return false;
            }else if(userpassword !=userpassword2) {
                alertMessage('Error!', 'Confirm password not matched.', 'error', 'no');
                return false;
            }else{
                $('#profileDetailsFormBtn').text('Please Wait...').attr('disabled','disabled');
                $.ajax({
                    type:'POST',
                    url: "{{route('updateAdminProfile')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        var obj = JSON.parse(data);
                        $('#profileDetailsFormBtn').text('Submit').removeAttr('disabled');
                        if(obj.status=='success')
                        {
                            alertMessage('Success!', obj.message, 'success', 'yes');
                            return false;
                        }else{
                            alertMessage('Error!', obj.message, 'error', 'no');
                            return false;
                        }
                    },
                    error: function(data){
                        $('#profileDetailsFormBtn').text('Save').removeAttr('disabled');
                        alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                        return false;
                        //console.log(data);
                    }
                });
            }
        });

    </script>
@endsection
