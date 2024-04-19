@extends('layout.master')

@section('content')
    <main>
        <div class="breadcrums_area breadcrums">

            <div class="common_pagetitle">{{$pageTitle}}</div>

            <div class="flex items-center space-x-4  lg:py-6 breadcrum_right">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl breadcrum_largetitle">
                    Dashboard
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="javascript:voide(0);">Roles</a>
                        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li>{{$pageTitle}}</li>
                </ul>
            </div>
        </div>

        <div class="main_page_title">
            <div class="common_pagetitlebig">{{$pageTitle}}</div>
            <div class="btns_rightimport">
                <button onclick="addUser()"
                        class="btn addbtn_right bg-success btn_import font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                    <i class="fa-solid fa-plus"></i>
                    Add New
                </button>
            </div>
        </div>


        <div class="table_mainstart" id="sc_table">
            <div class="row">
                <div class="col-lg-12">
                    <div>

                        <div class="card mt-3">
                            <div
                                class="is-scrollbar-hidden min-w-full overflow-x-auto"
                                x-data="pages.tables.initExample1"
                            >
                                <table class="is-hoverable w-full text-left faq_table" >
                                    <thead>
                                    <tr>
                                        <th
                                            class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Profile
                                        </th>

                                        <th
                                            class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Name
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Email
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Mobile No.
                                        </th>
                                        <th
                                            class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Date
                                        </th>

                                        <th
                                            class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            User Type
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Status
                                        </th>
                                        <th
                                            class="whitespace-nowrap rounded-tr-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($users))
                                        @foreach($users as $crow)
                                            <tr>
                                                @php
                                                    if($crow->profilePic){
                                                        $profilePic=env('APP_URL').'public/'.$crow->profilePic;
                                                    }else{
                                                        $profilePic='https://media.istockphoto.com/vectors/male-face-silhouette-or-icon-man-avatar-profile-unknown-or-anonymous-vector-id1087531642?k=20&m=1087531642&s=612x612&w=0&h=D6OBNUY7ZxQTAHNVtL9mm2wbHb_dP6ogIsCCWCqiYQg=';
                                                    }
                                                @endphp
                                                <td class="">
                                                    <a href="{{$profilePic}}" target="_blank">
                                                        <img src="{{$profilePic}}" style="width: 100px;height: 100px;object-fit: contain;" alt="image">
                                                    </a>
                                                </td>
                                                <td>{{$crow->name}}</td>
                                                <td>{{$crow->email}}</td>
                                                <td>{{$crow->mobile}}</td>
                                                <td>{{(strtotime($crow->created_at)) ? date('d/m/Y',strtotime($crow->created_at)) : ''}}</td>
                                                <td>{{ucfirst($crow->userTypeName)}}</td>
                                                <td>
                                                    @if($crow->status==1)
                                                        <span class="badge badge-success-light">Active</span>
                                                    @elseif($crow->status==2)
                                                        <span class="badge badge-danger">Rejected</span>
                                                    @else
                                                        <span class="badge badge-danger">Deactive</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    <div class="d-flex role_actionss">
                                                        <a href="javascript:;" name="{{$crow->name}}" email="{{$crow->email}}" mobile="{{$crow->mobile}}" userType="{{$crow->userType}}" id="editUser{{$crow->id}}" onclick="editUser({{$crow->id}})" class="btn btn-success editbtnrol" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit" aria-label="Edit"><i class="fas fa-pencil"></i></a>
                                                        &nbsp;<a href="javascript:;"  onclick="deleteAdmin({{$crow->id}})" class="btn btn-danger dltbtnrol" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit" aria-label="Edit"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>

                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- table end -->
        </section>
    </main>

    <!-- add category Modal start-->
    <div class="modal fade" id="add_User_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100" id="userModalTitle">
                        Add User
                    </h3>
                    <button @click="showModal = !showModal" data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="form_boxmodal">
                    <form id="userProfileForm" method="post" enctype="multipart/form-data">
                        <div class="mainfrm_box">
                            @csrf
                            <div class="row">
                                <input type="hidden" id="userActionId" name="userActionId" value="">
                                <input type="hidden" id="userActionName" name="userActionName" value="add">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">User Name</label>
                                        <input type="text" class="form-control" id="username" name="username" autocomplete="off" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">User Email</label>
                                        <input type="email" class="form-control" id="useremail" name="useremail" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="mobilenumber" class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Enter Mobile No.">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">User Password</label>
                                        <input type="text" class="form-control" id="password" name="password" autocomplete="off" placeholder="******">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">User Type</label>
                                        <select id="userType" name="userType" class="js-example-basic-single2 form-select" data-width="100%">
                                            <option value="">Select Role</option>
                                            @if(count($userRoles))
                                                @foreach($userRoles as $urow)
                                                    <option value="{{$urow->id}}">{{$urow->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Upload User Profile</h6>
                                                <input type="file" id="myDropify" name="myDropify"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="formSubmitBtn" class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Save </button>
                            </div>
                        </div>
                    </form>

                    </form>
                </div>
            </div>
        </div>
        <!-- add category modal end -->

@endsection
@section('scripts')
            <script>
                function editUser(userId)
                {
                    $('#userActionId').val(userId);
                    $('#userActionName').val('edit');
                    $('#username').val($('#editUser'+userId).attr('name'));
                    $('#useremail').val($('#editUser'+userId).attr('email'));
                    $('#mobilenumber').val($('#editUser'+userId).attr('mobile'));
                    $('#userType').val($('#editUser'+userId).attr('userType'));
                    $('#myDropify').val('');
                    $('#userModalTitle').html('Edit User');
                    $('#add_User_modal').modal('show');
                }

                function addUser()
                {
                    $('#userActionId').val('');
                    $('#userActionName').val('add');
                    $('#username').val('');
                    $('#useremail').val('');
                    $('#mobilenumber').val('');
                    $('#userType').val('');
                    $('#myDropify').val('');
                    $('#userModalTitle').html('Add User');
                    $('#add_User_modal').modal('show');
                }

                $('#userProfileForm').submit(function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    var userActionName=$('#userActionName').val();
                    var userActionId=$('#userActionId').val();
                    var username=$('#username').val();
                    var useremail=$('#useremail').val();
                    var mobilenumber=$('#mobilenumber').val();
                    var password=$('#password').val();
                    var userType=$('#userType').val();

                    if(!$.trim(username)){
                        alertMessage('Error!', 'Please enter the username.', 'error', 'no');
                        return false;
                    }else if(!$.trim(useremail)){
                        alertMessage('Error!', 'Please enter the email id.', 'error', 'no');
                        return false;
                    }else if(!$.trim(mobilenumber)){
                        alertMessage('Error!', 'Please enter the mobile number.', 'error', 'no');
                        return false;
                    }else if(!$.trim(userType)){
                        alertMessage('Error!', 'Please select user role.', 'error', 'no');
                        return false;
                    }else if(userActionName=='add' && !password){
                        alertMessage('Error!', 'Please enter password.', 'error', 'no');
                        return false;
                    }else{
                        $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');
                        $.ajax({
                            type:'POST',
                            url: "{{route('saveUserProfile')}}",
                            data: formData,
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                var obj = JSON.parse(data);
                                $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                                if(obj.status=='success')
                                {
                                    this.reset();
                                    alertMessage('Success!', obj.message, 'success', 'yes');
                                    return false;
                                }else{
                                    alertMessage('Error!', obj.message, 'error', 'no');
                                    return false;
                                }
                            },
                            error: function(data){
                                $('#formSubmitBtn').text('Save').removeAttr('disabled');
                                alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                                return false;
                            }
                        });
                    }
                });

                function deleteAdmin(recordId)
                {
                    swal({
                        title: 'Warning!',
                        text: 'Are you sure want to delete this user?',
                        icon: 'warning',
                        buttons:true,
                    }).then((willDelete) => {
                        if(willDelete)
                        {
                            waitForProcess();
                            $.post('{{route('deleteAdmin')}}',{
                                "_token": "{{ csrf_token() }}",
                                recordId:recordId,
                            },function (data){
                                var obj = JSON.parse(data);
                                if(obj.status=='success')
                                {
                                    alertMessage('Success!', obj.message, 'success', 'yes');
                                    return false;
                                }else{
                                    alertMessage('Error!', obj.message, 'error', 'no');
                                    return false;
                                }
                            });
                        }
                    });
                }
            </script>
@endsection

