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
                <button onclick="addRole();"
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
                                            S. No.
                                        </th>

                                        <th
                                            class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Role ID
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Role Type
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                            Description
                                        </th>
                                        <th
                                            class="whitespace-nowrap rounded-tl-lg bg-slate-200  py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
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
                                    @if(count($roles))
                                        @php $rsr=1; @endphp
                                        @foreach($roles as $role)
                                            <tr>
                                                <td>{{$rsr++}}</td>
                                                <td>{{$role->roleId}}</td>
                                                <td>{{$role->name}}</td>
                                                <td>{{$role->description}}</td>
                                                <td>
                                                    @if($role->status==1)
                                                        <span class="badge badge-success-light">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Deactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex role_actionss">
                                                        <a href="javascript:void(0);" name="{{$role->name}}" desc="{{$role->description}}" id="editRole{{$role->id}}" onclick="editRole({{$role->id}})" class="btn btn-success editbtnrol" ><i data-feather="edit-2" class="fa fa-pencil"></i> </a>
                                                        {{--                                <a href="javascript:void(0);" class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete" aria-label="Delete"><i data-feather="trash-2" class="btn-icon-prepend feather_iconfont text-danger"></i></a>--}}
                                                        <a href="{{route('roleDefaultPermissions',$role->id)}}" class="btn btn-primary viewbtnrol" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Permissions" aria-label="Permissions"><i class="fa fa-eye-slash"></i></a>
                                                        <a href="javascript:void(0);" class="btn btn-danger dltbtnrol" data-bs-toggle="tooltip" data-bs-placement="top" onclick="deleteRole({{$role->id}})" title="" data-bs-original-title="Delete" aria-label="Delete"><i data-feather="trash-2" class="fa fa-trash"></i></a>
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
                        Add Roles
                    </h3>
                    <button @click="showModal = !showModal" data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="form_boxmodal">
                    <form id="actionForm" method="post" enctype="multipart/form-data">
                        <div class="mainfrm_box">
                            @csrf
                            <div class="row">
                                <input type="hidden" id="recordId" name="recordId">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="roleType" class="form-label">Role Type</label>
                                        <input type="text" class="form-control" id="roleType" name="roleType" autocomplete="off" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="roleDesc" class="form-label">Description</label> <br>
                                        <textarea id="roleDesc" class="form-control" name="roleDesc" cols="30" rows="3" style="width:100%;"></textarea>
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
                function editRole(roleId)
                {
                    $('#recordId').val(roleId);
                    $('#roleType').val($('#editRole'+roleId).attr('name'));
                    $('#roleDesc').val($('#editRole'+roleId).attr('desc'));
                    $('#roleModalHeading').html('Edit Role');
                    $('#add_User_modal').modal('show');
                }

                function addRole()
                {
                    $('#recordId').val('');
                    $('#roleType').val('');
                    $('#roleDesc').val('');
                    $('#roleModalHeading').html('Add Role');
                    $('#add_User_modal').modal('show');
                }

                $('#actionForm').submit(function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    var roleType=$('#roleType').val();
                    var roleDesc=$('#roleDesc').val();
                    if(!roleType) {
                        alertMessage('Error!', 'PLease enter the role type.', 'error', 'no');
                        return false;
                    }else if(!roleDesc) {
                        alertMessage('Error!', 'PLease enter the role description.', 'error', 'no');
                        return false;
                    } else{
                        $('#formSubmitBtn').text('Please Wait...').attr('disabled','disabled');
                        $.ajax({
                            type:'POST',
                            url: "{{route('saveRoles')}}",
                            data: formData,
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                var obj = JSON.parse(data);
                                $('#formSubmitBtn').text('Save').removeAttr('disabled');
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
                                alertMessage('Error!', 'Invalid data uploaded.', 'error', 'no');
                                $('#formSubmitBtn').text('Submit').removeAttr('disabled');
                                return false;
                            }
                        });
                    }
                });

                function deleteRole(recordId)
                {
                    swal({
                        title: 'Warning!',
                        text: 'Are you sure want to delete this role?',
                        icon: 'warning',
                        buttons:true,
                    }).then((willDelete) => {
                        if(willDelete)
                        {
                            waitForProcess();
                            $.post('{{route('deleteRole')}}',{
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



