@extends('layout.master')

@section('content')
    <main >
        <div class="breadcrums_area breadcrums">

            <div class="common_pagetitle">{{(strlen($pageTitle)>18) ? substr($pageTitle,0,18).'...' : $pageTitle}}</div>

            <div class="flex items-center space-x-4  lg:py-6 breadcrum_right">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl breadcrum_largetitle">
                    Dashboard
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="javascript:;">Customers Management</a>
                        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li>{{(strlen($pageTitle)>18) ? substr($pageTitle,0,18).'...' : $pageTitle}}</li>
                </ul>
            </div>
        </div>

        <div class="main_page_title">
            <div class="common_pagetitlebig">{{$pageTitle}}</div>
            <div class="btns_rightimport">
                @if($pageNameStr=='customers-list')
                <button data-bs-toggle="modal" data-bs-target="#addbank_modal"
                        class="btn addbtn_right bg-success btn_import font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                    <i class="fa-solid fa-plus"></i>
                    Add Applicant
                </button>
                <button onclick="importUsersListModalOpen();" 
                        class="btn addbtn_right bg-success btn_import font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90">
                    <i class="fa-solid fa-plus"></i>
                    Import Users
                </button>
                @endif
            </div>
        </div>

        <section class="filters_table">
            <div class="filters">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="block">
                                        <span>Filter by Search</span>
                                        <span class="relative mt-1.5 flex">
                                          <input id="customSearch" name="customSearch" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent   placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Enter name" type="text">
                                          <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                          </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="block">
                                        <span>From</span>
                                        <span class="relative mt-1.5 flex">
                                          <input x-flatpickr="" id="fromDate" name="fromDate" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input active" placeholder="Choose date..." type="text" readonly="readonly">
                                          <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                          </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="block">
                                        <span>To</span>
                                        <span class="relative mt-1.5 flex">
                                          <input x-flatpickr="" id="toDate" name="toDate" class="form-input peer w-full rounded-full border border-slate-300 bg-transparent  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input active" placeholder="Choose date..." type="text" readonly="readonly">
                                          <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                          </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="block">
                                <span>Status</span>
                                <select id="userStatus" name="userStatus" class="form-select mt-1.5 w-full rounded-full border border-slate-300 bg-white px-4 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <span>&nbsp;</span>
                        <div class="form-group without_lablebtn">
                            <button type="button" onclick="filterUsersCustomerManagement();" class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table_mainstart">
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div class="card mt-3">
                                <div id="mainTblHtml" class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table end -->
        </section>
    </main>



    <!-- add customer Modal start-->
    <div class="modal fade" id="addbank_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                        New Applicant
                    </h3>
                    <button @click="showModal = !showModal" data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="form_boxmodal">

                    <div class="form-wizard">
                        <div class="myContainer">
                            <div class="form-container animated">
                                <div class="head_ledtright">
                                    <h2 class="text-center form-title">Personal Information</h2>
                                    {{--<div class="right_steptext">Step 1</div>--}}
                                </div>
                                <form id="personalForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mainfrm_box">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Title</span>
                                                    <select id="nameTitle" name="nameTitleCu" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="">Select</option>
                                                        <option value="Mr.">Mr. </option>
                                                        <option value="Ms.">Ms. </option>
                                                        <option value="Mrs.">Mrs. </option>
                                                        <option value="Smt.">Smt. </option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Applicant Name</span>
                                                    <input id="customerName" name="customerName" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder=" " type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Applicant Email</span>
                                                    <input id="customerEmail" name="customerEmail" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder=" " type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Applicant Phone</span>
                                                    <input id="customerPhone" onkeypress="javascript:return isNumber(event)" name="customerPhone" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Marital Status</span>
                                                    <select id="maritalStatus" name="maritalStatus" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="">Select</option>
                                                        <option value="Married">Married </option>
                                                        <option value="Unmarried">Unmarried </option>
                                                    </select>
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Gender</span>
                                                    <select id="gender" name="gender"
                                                            class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    >
                                                        <option value="">Select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="customdateinp">
                                                    <span>DOB</span>
                                                    <input id="dateOfBirth" name="dateOfBirth" x-flatpickr="" class="form-input mt-1.5 peer w-full rounded-lg border border-slate-300 bg-transparent py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input" placeholder="Choose date..." type="text" readonly="readonly">
                                                    <div class="pointer-events-none absolute calender_iconinp flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Address</span>
                                                    <input id="address" name="address" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Address 2 (Optional)</span>
                                                    <input id="address2" name="address2" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>City</span>
                                                    <input id="city" name="city" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>District</span>
                                                    <input id="district" name="district" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>State</span>
                                                    <input id="state" name="state" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Pincode</span>
                                                    <input id="pincode" name="pincode" onkeypress="javascript:return isNumber(event)" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Aadhaar Number</span>
                                                    <input id="aadhaar_no" name="aadhaar_no" onkeypress="javascript:return isNumber(event)" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Pan Number</span>
                                                    <input id="pancard_no" name="pancard_no" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Password</span>
                                                    <input id="password" name="password" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="password">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Confirm Password</span>
                                                    <input id="cnfpassword" name="cnfpassword" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="password">
                                                </label>
                                            </div>


                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Upload Profile Photo</span>
                                                    <input type="file" id="profileImg" name="profileImg" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                </label>
                                            </div>



                                        </div>
                                    </div>

                                    <div class="form-group text-right mar-b-0">
                                        <button type="submit" name="personalFormBtn" id="personalFormBtn" class="btn btn-primary btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- wizard end -->
                </div>
            </div>
        </div>
    </div>
    <!-- add customer modal end -->

    <!-- add customer Modal start-->
    <div class="modal fade" id="add_edit_user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                        Update Applicant Details
                    </h3>
                    <button @click="showModal = !showModal" data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="form_boxmodal">

                    <div class="form-wizard">
                        <div class="myContainer">
                            <div class="form-container animated">
                                <div class="head_ledtright">
                                    <h2 class="text-center form-title">Personal Information</h2>
                                    <div class="right_steptext">Step 1</div>
                                </div>
                                <form id="personalFormEdit" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="recordId" id="recordId" class="recordId" value="">
                                    @csrf
                                    <div class="mainfrm_box">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Applicant ID</span>
                                                    <input id="customerCodeE" name="customerCode" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Title</span>
                                                    <select id="nameTitleCu" name="nameTitleCu" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="">Select</option>
                                                        <option value="Mr.">Mr. </option>
                                                        <option value="Ms.">Ms. </option>
                                                        <option value="Mrs.">Mrs. </option>
                                                        <option value="Smt.">Smt. </option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Applicant Name</span>
                                                    <input id="customerNameE" name="customerName" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder=" " type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Applicant Email</span>
                                                    <input id="customerEmailE" name="customerEmail" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder=" " type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Applicant Phone</span>
                                                    <input id="customerPhoneE" onkeypress="javascript:return isNumber(event)" name="customerPhone" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Marital Status</span>
                                                    <select id="maritalStatusE" name="maritalStatus" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="">Select</option>
                                                        <option value="Married">Married </option>
                                                        <option value="Unmarried">Unmarried </option>
                                                    </select>
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Gender</span>
                                                    <select id="genderE" name="gender"
                                                            class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    >
                                                        <option value="">Select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="customdateinp">
                                                    <span>DOB</span>
                                                    <input id="dateOfBirthE" name="dateOfBirth" x-flatpickr="" class="form-input mt-1.5 peer w-full rounded-lg border border-slate-300 bg-transparent py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input" placeholder="Choose date..." type="text" readonly="readonly">
                                                    <div class="pointer-events-none absolute calender_iconinp flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Address</span>
                                                    <input id="addressE" name="address" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Address 2 (Optional)</span>
                                                    <input id="address2E" name="address2" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>City</span>
                                                    <input id="cityE" name="city" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>District</span>
                                                    <input id="districtE" name="district" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>State</span>
                                                    <input id="stateE" name="state" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Pincode</span>
                                                    <input id="pincodeE" onkeypress="javascript:return isNumber(event)" name="pincode" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Aadhaar Number</span>
                                                    <input id="aadhaar_noE" onkeypress="javascript:return isNumber(event)" name="aadhaar_no" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Pan Number</span>
                                                    <input id="pancard_noE" name="pancard_no" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Religion</span>
                                                    <input id="religionCu" name="religionCu" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Education Status</span>
                                                    <input id="educationStatusCu" name="educationStatusCu" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Father Name</span>
                                                    <input id="fatherNameCu" name="fatherNameCu" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Mother Name</span>
                                                    <input id="motherNameCu" name="motherNameCu" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>



                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Cibil Score</span>
                                                    <input id="cibilScoreCu" name="cibilScoreCu" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Upload Profile Photo</span> <a href="" id="profileImgV" target="_blank" style="color: blue;display: none;">( Click Here to View )</a>
                                                    <input type="file" id="profileImg#" name="profileImg" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Source Person Name</span>
                                                    <input id="sourcePerson2" name="sourcePerson" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Branch Name</span>
                                                    <input id="branchName2" name="branchName" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>



                                        </div>
                                    </div>
                                    <div class="form-group text-right mar-b-0 nextbtn_brx personalFormBtnNE" style="display: none;">
                                        <input type="button" id="personalFormBtnNE" value="NEXT" class="btn btn-primary next btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    </div>
                                    <div class="form-group text-right mar-b-0">
                                        <button type="submit" name="personalFormBtn" id="personalFormBtnE" class="btn btn-primary btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                            Next
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="form-container animated">
                                <div class="head_ledtright">
                                    <h2 class="text-center form-title">Co Applicant / Guarantor Details</h2>
                                    <div class="right_steptext">Step 2</div>
                                </div>
                                <form id="personalFormCoApplicantEdit" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="recordId" id="recordId" class="recordId" value="">
                                    @csrf
                                    <div class="mainfrm_box">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Title</span>
                                                    <select id="nameTitleCoApp" name="nameTitleCoApp" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="">Select</option>
                                                        <option value="Mr.">Mr. </option>
                                                        <option value="Ms.">Ms. </option>
                                                        <option value="Mrs.">Mrs. </option>
                                                        <option value="Smt.">Smt. </option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Name</span>
                                                    <input id="customerNameCoApp" name="customerNameCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder=" " type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Gender</span>
                                                    <select id="genderCoApp" name="genderCoApp"
                                                            class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    >
                                                        <option value="">Select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="customdateinp">
                                                    <span>DOB</span>
                                                    <input id="dateOfBirthECoApp" name="dateOfBirthCoApp" x-flatpickr="" class="form-input mt-1.5 peer w-full rounded-lg border border-slate-300 bg-transparent py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent flatpickr-input" placeholder="Choose date..." type="text" readonly="readonly">
                                                    <div class="pointer-events-none absolute calender_iconinp flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Religion</span>
                                                    <input id="religionCoApp" name="religionCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Education Status</span>
                                                    <input id="educationStatusCoApp" name="educationStatusCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Father Name</span>
                                                    <input id="fatherNameCoApp" name="fatherNameCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Mother Name</span>
                                                    <input id="motherNameCoApp" name="motherNameCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Marital Status</span>
                                                    <select id="maritalStatusCoApp" name="maritalStatusCoApp" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="">Select</option>
                                                        <option value="Married">Married </option>
                                                        <option value="Unmarried">Unmarried </option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Relation With Applicant</span>
                                                    <input id="relationWithApplicantCoApp" name="relationWithApplicantCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Cibil Score</span>
                                                    <input id="cibilScoreCoApp" name="cibilScoreCoApp" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group text-right mar-b-0 nextbtn_brx personalFormBtnNECoApp" style="display: none;">
                                        <input type="button" id="personalFormBtnNEApp" value="NEXT" class="btn btn-primary next btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    </div>
                                    <div class="form-group text-right mar-b-0">
                                        <input type="button" value="BACK" class="btn btn-default back btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                        <button type="submit" name="personalFormBtnApp" id="personalFormBtnEApp" class="btn btn-primary btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                            Next
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="form-container animated">
                                <div class="head_ledtright">
                                    <h2 class="text-center form-title">Business Details</h2>
                                    <div class="right_steptext">Step 3</div>
                                </div>
                                <form method="POST" id="professionalDetailsFrm" enctype="multipart/form-data">
                                    <input type="hidden" name="recordId" id="recordId" class="recordId" value="">
                                    @csrf
                                    <div class="mainfrm_box">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Company Name</span>
                                                    <input id="employerName" name="employerName" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Company Phone No.</span>
                                                    <input id="companyMobileNo" onkeypress="javascript:return isNumber(event)" name="companyMobileNo" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="number">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Telephone No.</span>
                                                    <input id="companyTeleNo" onkeypress="javascript:return isNumber(event)" name="companyTeleNo" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="number">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Email Id</span>
                                                    <input id="companyEmailId" name="companyEmailId" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Fax No.</span>
                                                    <input id="companyFaxNo" name="companyFaxNo" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>GSTIN</span>
                                                    <input id="companyGstin" maxlength="15" name="companyGstin" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>PAN No.</span>
                                                    <input id="companyPan" maxlength="10" name="companyPan" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Company Type</span>
                                                    <select id="companyType" name="companyType" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="">Select </option>
                                                        <option value="Partnership">Partnership </option>
                                                        <option value="Propritorship">Propritorship </option>
                                                        <option value="Pvt. Ltd.">Pvt. Ltd. </option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Address</span>
                                                    <input id="companyAddress" name="companyAddress" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>District</span>
                                                    <input id="companyDistrict" name="companyDistrict" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>State</span>
                                                    <input id="companyState" name="companyState" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Pincode</span>
                                                    <input id="companyPincode" onkeypress="javascript:return isNumber(event)" name="companyPincode" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <?php $cashFLowStyle='style="display:none;"'; if($pageNameStr!='customers-list' && $pageNameStr!='rejected-customers' && $pageNameStr!='employment-verification' && $pageNameStr!='employment-verification-rejected'){ $cashFLowStyle=''; } ?>

                                                <div class="row col-md-12" <?=$cashFLowStyle?> >
                                            <div class="col-lg-12 mt-3 mb-3">
                                                <center><h3 style="font-size: 22px;font-weight: 700;">Cash Flow Analysis</h3></center>
                                                <hr>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Source Of Income</span>
                                                    <input id="sourceOfIncome" name="sourceOfIncome" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Sale</span>
                                                    <input id="cfaSale" name="cfaSale" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Margin %</span>
                                                    <input id="cfaMargin" name="cfaMargin" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Gross Margin</span>
                                                    <input id="cfaGrossMargin" readonly name="cfaGrossMargin" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Amount Available</span>
                                                    <input id="cfaAmountAvailable" readonly name="cfaAmountAvailable" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Electricity Bill Of Residence</span>
                                                    <input id="cfaElectricityBillOfResidence" name="cfaElectricityBillOfResidence" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Electricity Bill Of Business</span>
                                                    <input id="cfaElectricityBillOfBusiness" name="cfaElectricityBillOfBusiness" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Residence/ Business Premises Rent</span>
                                                    <input id="cfaResidenceBusinessPermissesRent" name="cfaResidenceBusinessPermissesRent" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Household Expense</span>
                                                    <input id="cfaHouseHoldExpense" name="cfaHouseHoldExpense" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Salary</span>
                                                    <input id="cfaSalary" name="cfaSalary" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Misc. Expenses </span>
                                                    <input id="cfaMiscExpenses" name="cfaMiscExpenses" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>School Fees</span>
                                                    <input id="cfaSchoolFee" name="cfaSchoolFee" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Gross Amount Available</span>
                                                    <input id="cfaGrossAmountAvailable" readonly name="cfaGrossAmountAvailable" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Running EMI</span>
                                                    <input id="cfaRunningEmi" name="cfaRunningEmi" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Credit Card EMI</span>
                                                    <input id="cfaCreditCardEMi" name="cfaCreditCardEMi" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Proposed EMI</span>
                                                    <input id="cfaProposedEmi" name="cfaProposedEmi" class="calcCfaRun form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Net Amount Available</span>
                                                    <input id="cfaNetAmountAvailable" readonly name="cfaNetAmountAvailable" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>FOIR % </span>
                                                    <input id="cfaFOIR" readonly name="cfaFOIR" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Net Monthly Income</span>
                                                    <input id="cfaNetMonthlyIncome" readonly name="cfaNetMonthlyIncome" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right mar-b-0 nextbtn_brx" style="display: none;">

                                        <input type="button" value="NEXT" id="professionalDetailsFrmBtnNext" class="btn btn-primary next btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">

                                    </div>
                                    <div class="form-group text-right mar-b-0">
                                        <input type="button" value="BACK" class="btn btn-default back btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                        <button type="submit" name="professionalDetailsFrmBtn" id="professionalDetailsFrmBtn" class="btn btn-primary btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                            Next
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="form-container animated">
                                <div class="head_ledtright">
                                    <h2 class="text-center form-title">KYC</h2>
                                    <div class="right_steptext">Step 4</div>
                                </div>

                                <form method="POST" enctype="multipart/form-data" id="kycForm">
                                    <input type="hidden" name="recordId" id="recordId" class="recordId" value="">
                                    @csrf
                                    <div class="mainfrm_box">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label class="block">
                                                    <span>Upload identity Card Front</span><a href="" id="idProofFrontV" target="_blank" style="color: blue;display: none;">( Click Here to View )</a>
                                                    <input id="idProofFront" name="idProofFront" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                                                </label>
                                            </div>

                                            <div class="col-lg-12">
                                                <label class="block">
                                                    <span>Upload identity Card Back</span><a href="" id="idProofBackV" target="_blank" style="color: blue;display: none;">( Click Here to View )</a>
                                                    <input id="idProofBack" name="idProofBack" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                                                </label>
                                            </div>

                                            <div class="col-lg-12">
                                                <label class="block">
                                                    <span>Upload PAN Card</span><a href="" id="panCardFrontV" target="_blank" style="color: blue;display: none;">( Click Here to View )</a>
                                                    <input id="panCardFront" name="panCardFront" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                                                </label>
                                            </div>

                                            <div class="col-lg-12">
                                                <label class="block">
                                                    <span>Upload Address Proof Front</span><a href="" id="addressProofFrontV" target="_blank" style="color: blue;display: none;">( Click Here to View )</a>
                                                    <input id="addressProofFront" name="addressProofFront" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                                                </label>
                                            </div>

                                            <div class="col-lg-12">
                                                <label class="block">
                                                    <span>Upload Address Proof Back</span><a href="" id="addressProofBackV" target="_blank" style="color: blue;display: none;">( Click Here to View )</a>
                                                    <input id="addressProofBack" name="addressProofBack" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                                                </label>
                                            </div>
                                        {{--
                                            <div class="col-lg-12">
                                                <label class="block">
                                                    <span>Upload Photo of Salary Slip - 1 Month</span>
                                                    <input id="salerySlip1" name="salerySlip1" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                                                </label>
                                            </div>

                                            <div class="col-lg-12">
                                                <label class="block">
                                                    <span>Upload Photo of Salary Slip - 2 Month</span>
                                                    <input id="salerySlip2" name="salerySlip2" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                                                </label>
                                            </div>

                                            <div class="col-lg-12">
                                                <label class="block">
                                                    <span>Upload Photo of Salary Slip - 3 Month</span>
                                                    <input id="salerySlip3" name="salerySlip3" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                                                </label>
                                            </div>
                                        --}}
                                            <div class="col-lg-12">
                                                <label class="block">
                                                    <span>Upload Photo/PDF of Bank Statement</span><a href="" id="bankAttachemetV" target="_blank" style="color: blue;display: none;">( Click Here to View )</a>
                                                    <input id="bankAttachemet" name="bankAttachemet" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
                                                </label>
                                            </div>
                                            <div id="otherDocsHtml">
                                                
                                            </div>
                                            <div class="row col-lg-12 mb-5">
                                                <div class="col-md-7">
                                                    &nbsp;
                                                </div>
                                                <div class="col-md-5">
                                                    <button type="button" onclick="docsAddMore();" class="btn btn-warning bg-warning float-right">Add More Other Docs</button>
                                                    <!-- <button type="button" onclick="docsRemoveLast();" class="btn btn-danger bg-danger">Remove</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right mar-b-0 nextbtn_brx" style="display: none;">
                                        <input type="button" value="NEXT" id="kycFormBtnNext" class="btn btn-primary next btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    </div>
                                    <div class="form-group text-right mar-b-0">
                                        <input type="button" value="BACK" class="btn btn-default back btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                        <button type="submit" name="kycFormBtn" id="kycFormBtn" class="btn btn-primary btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                            Next
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="form-container animated">
                                <div class="head_ledtright">
                                    <h2 class="text-center form-title">Bank details</h2>
                                    <div class="right_steptext">Step 5</div>
                                </div>

                                <form method="POST" enctype="multipart/form-data" id="bankDetailsForm">
                                    <input type="hidden" name="recordId" id="recordId" class="recordId" value="">
                                    @csrf
                                    <div class="mainfrm_box">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Account Holder Name</span>
                                                    <input id="accountHolderName" name="accountHolderName" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Bank Name</span>
                                                    <input id="bankName" name="bankName" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>IFSC</span>
                                                    <input id="ifscCode" name="ifscCode" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder=" " type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Account Type</span>
                                                    <select id="accountType" name="accountType" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="">Select </option>
                                                        <option value="Savings">Savings </option>
                                                        <option value="Current">Current </option>
                                                        <option value="CC">CC </option>
                                                        <option value="OD">OD </option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Account Number</span>
                                                    <input id="accountNumber" onkeypress="javascript:return isNumber(event)" name="accountNumber" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Confirm Account Number</span>
                                                    <input id="accountNumberC" onkeypress="javascript:return isNumber(event)" name="accountNumberC" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Address</span>
                                                    <input id="bankAddress" name="bankAddress" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>City</span>
                                                    <input id="bankCity" name="bankCity" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>State</span>
                                                    <input id="bankState" name="bankState" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>  

                                            <div class="col-lg-6">
                                                <label class="block">
                                                    <span>Pin Code</span>
                                                    <input id="bankPincode" onkeypress="javascript:return isNumber(event)" name="bankPincode" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group text-right mar-b-0 nextbtn_brx">
                                        <input type="button" value="BACK" class="btn btn-default back btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                        <input type="submit" id="bankDetailsFormBtn" value="SUBMIT" class="btn btn-primary btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- wizard end -->
                </div>
            </div>
        </div>
    </div>
    <!-- add customer modal end -->

    <div class="modal fade" id="initiateApplyLoanModal" tabindex="-1" aria-labelledby="updateEmpInfoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apply Loan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close">X</button>
                </div>

                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="applyLoanAdminFrm">
                        <input type="hidden" id="initiateApplyLoanUserId" name="initiateApplyLoanUserId">
                        @csrf
                        <div id="initiateApplyLoanModalBody"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importUsersListModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                        Import Users Using CSV
                    </h3>
                    <button @click="showModal = !showModal" data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="form_boxmodal">

                    <div class="form-wizard">
                        <div class="myContainer">
                            <div class="form-container animated">
                                <div class="head_ledtright">
                                    <h2 class="text-center form-title">Personal Information</h2>
                                </div>
                                <form id="importUserForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mainfrm_box">
                                        <div class="row">
                                            

                                            <div class="col-lg-9">
                                                <label class="block">
                                                    <span>Upload CSV File</span> (<a style="color:blue;" href="{{asset('assets/import-examples/customer-info.csv')}}" download>Download Sample</a>)
                                                    <input type="file" id="userData" name="userData" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                </label>
                                            </div>



                                        </div>
                                    </div>

                                    <div class="form-group text-right mar-b-0">
                                        <button type="submit" name="importFormBtn" id="importFormBtn" class="btn btn-primary btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- wizard end -->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script>
    function importUsersListModalOpen()
    {
        $('#importUsersListModal').modal('show');
    }
    function filterUsersCustomerManagement()
    {
        var customSearch=$('#customSearch').val();
        var fromDate=$('#fromDate').val();
        var toDate=$('#toDate').val();
        var userStatus=$('#userStatus').val();

        $('#mainTblHtml').html('<center><img src="{{env('LOADERIMG')}}" /></center>');
        $.post('{{route('filterUsersCustomerManagement')}}',{
            "_token": "{{ csrf_token() }}",
            customSearch:customSearch,
            fromDate:fromDate,
            toDate:toDate,
            userStatus:userStatus,
            pageNameStr:'{{$pageNameStr}}'
        },function (data){
            $('#mainTblHtml').html(data);
            $('.is-hoverable').DataTable();
        });
    }

    $(document).ready(function (){
        $('#customerCodeHtml').hide();
        filterUsersCustomerManagement();
    });

    $('#personalForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var recordId=$('#recordId').val();
        var nameTitleCu=$('#nameTitle').val();
        var customerName=$('#customerName').val();
        var customerEmail=$('#customerEmail').val();
        var customerPhone=$('#customerPhone').val();

        var maritalStatus=$('#maritalStatus').val();
        var gender=$('#gender').val();        
        var dateOfBirth=$('#dateOfBirth').val();
        var address=$('#address').val();
        var city=$('#city').val();
        var district=$('#district').val();
        var state=$('#state').val();
        var pincode=$('#pincode').val();

        var aadhaar_no=$('#aadhaar_no').val();
        var pancard_no=$('#pancard_no').val();

        var password=$('#password').val();
        var cnfpassword=$('#cnfpassword').val();
       

        if(!nameTitleCu) {
            alertMessage('Error!', 'Please select applicant name title.', 'error', 'no');
            return false;
        } else if(!customerName) {
            alertMessage('Error!', 'Please enter the applicant name.', 'error', 'no');
            return false;
        } else if(!customerEmail) {
            alertMessage('Error!', 'Please enter email id.', 'error', 'no');
            return false;
        }else if(!customerPhone) {
            alertMessage('Error!', 'Please enter mobile number.', 'error', 'no');
            return false;
        }else if(!maritalStatus) {
            alertMessage('Error!', 'Please select marital status.', 'error', 'no');
            return false;
        }else if(!gender) {
            alertMessage('Error!', 'Please select gender.', 'error', 'no');
            return false;
        }else if(!dateOfBirth) {
            alertMessage('Error!', 'Please select date of birth.', 'error', 'no');
            return false;
        }else if(!address) {
            alertMessage('Error!', 'Please enter address.', 'error', 'no');
            return false;
        }else if(!city) {
            alertMessage('Error!', 'Please enter city.', 'error', 'no');
            return false;
        }else if(!state) {
            alertMessage('Error!', 'Please enter state.', 'error', 'no');
            return false;
        }else if(!pincode) {
            alertMessage('Error!', 'Please enter pincode.', 'error', 'no');
            return false;
        }else if(aadhaar_no && aadhaar_no.length!=12) {
            alertMessage('Error!', 'Please enter valid aadhaar number.', 'error', 'no');
            return false;
        }else if(pancard_no && pancard_no.length!=10) {
            alertMessage('Error!', 'Please enter valid pan number.', 'error', 'no');
            return false;
        }else if(!password) {
            alertMessage('Error!', 'Please enter password.', 'error', 'no');
            return false;
        }else if(password != cnfpassword) {
            alertMessage('Error!', 'Confirm password not match.', 'error', 'no');
            return false;
        }else{
            $('#personalFormBtn').text('Please Wait...').attr('disabled','disabled');
            $.ajax({
                type:'POST',
                url: "{{route('saveCustomerInfo')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
                    if(obj.status=='success')
                    {
                        alertMessage('Success!', obj.message, 'success', 'yes');
                        return false;
                    }else{
                        $('#personalFormBtn').text('Submit').removeAttr('disabled');
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                },
                error: function(data){
                    $('#personalFormBtn').text('Submit').removeAttr('disabled');
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        }
    });

    function editCustomerProfile(userId)
    {
        $.post('{{route('getUserAllDetails')}}',{
            "_token": "{{ csrf_token() }}",
            userId:userId,
        },function(data){
            var obj = JSON.parse(data);
            if(obj.status=='success')
            {
                $('.recordId').val(userId);
                if(obj.user)
                {
                    $('#customerCodeE').val(obj.user.customerCode).attr('disabled','disabled');
                    $('#customerNameE').val(obj.user.name);
                    $('#customerEmailE').val(obj.user.email);
                    $('#customerPhoneE').val(obj.user.mobile);
                    $('#maritalStatusE').val(obj.user.maritalStatus);
                    $('#genderE').val(obj.user.gender);
                    $('#dateOfBirthE').val(obj.user.dateOfBirth);
                    $('#addressE').val(obj.user.addressLine1);
                    $('#address2E').val(obj.user.addressLine2);
                    $('#cityE').val(obj.user.city);
                    $('#districtE').val(obj.user.district);
                    $('#stateE').val(obj.user.state);
                    $('#pincodeE').val(obj.user.pincode);
                    $('#aadhaar_noE').val(obj.user.aadhaar_no);
                    $('#pancard_noE').val(obj.user.pancard_no);

                    $('#nameTitleCu').val(obj.user.nameTitle);
                    $('#religionCu').val(obj.user.religion);
                    $('#educationStatusCu').val(obj.user.educationStatus);
                    $('#fatherNameCu').val(obj.user.fatherName);
                    $('#motherNameCu').val(obj.user.motherName);
                    $('#cibilScoreCu').val(obj.user.cibilScore);

                    $('#sourcePerson2').val(obj.user.sourcePerson);
                    $('#branchName2').val(obj.user.branchName);


                    if(obj.user.profilePic){
                        $('#profileImgV').attr('href','{{asset('/')}}public/'+obj.user.profilePic);
                        $('#profileImgV').show();
                    }else{
                        $('#profileImgV').hide();
                    }

                }

                if(obj.coApplicantDetails)
                {
                    $('#nameTitleCoApp').val(obj.coApplicantDetails.nameTitleCoApp);
                    $('#customerNameCoApp').val(obj.coApplicantDetails.customerNameCoApp);
                    $('#genderCoApp').val(obj.coApplicantDetails.genderCoApp);
                    $('#dateOfBirthECoApp').val(obj.coApplicantDetails.dateOfBirthCoApp);
                    $('#religionCoApp').val(obj.coApplicantDetails.religionCoApp);
                    $('#educationStatusCoApp').val(obj.coApplicantDetails.educationStatusCoApp);
                    $('#fatherNameCoApp').val(obj.coApplicantDetails.fatherNameCoApp);
                    $('#motherNameCoApp').val(obj.coApplicantDetails.motherNameCoApp);
                    $('#maritalStatusCoApp').val(obj.coApplicantDetails.maritalStatusCoApp);
                    $('#relationWithApplicantCoApp').val(obj.coApplicantDetails.relationWithApplicantCoApp);
                    $('#cibilScoreCoApp').val(obj.coApplicantDetails.cibilScoreCoApp);
                }

                if(obj.employment)
                {
                    $('#employerName').val(obj.employment.employerName);
                    $('#employeeId').val(obj.employment.employeeId);
                    $('#companyMobileNo').val(obj.employment.mobileNo);
                    $('#companyTeleNo').val(obj.employment.companyTeleNo);
                    $('#companyFaxNo').val(obj.employment.companyFaxNo);
                    $('#companyGstin').val(obj.employment.companyGstin);
                    $('#companyPan').val(obj.employment.companyPan);
                    $('#companyEmailId').val(obj.employment.emailId);
                    $('#companyState').val(obj.employment.state);
                    $('#companyDistrict').val(obj.employment.district);
                    $('#companyAddress').val(obj.employment.address);
                    $('#companyPincode').val(obj.employment.pincode);
                    $('#companyType').val(obj.employment.companyType);
                }

                if(obj.cashFlowAnalysisDetails)
                {
                    $('#sourceOfIncome').val(obj.cashFlowAnalysisDetails.sourceOfIncome);
                    $('#cfaSale').val(obj.cashFlowAnalysisDetails.cfaSale);
                    $('#cfaMargin').val(obj.cashFlowAnalysisDetails.cfaMargin);
                    $('#cfaGrossMargin').val(obj.cashFlowAnalysisDetails.cfaGrossMargin);
                    $('#cfaAmountAvailable').val(obj.cashFlowAnalysisDetails.cfaAmountAvailable);
                    $('#cfaElectricityBillOfResidence').val(obj.cashFlowAnalysisDetails.cfaElectricityBillOfResidence);
                    $('#cfaElectricityBillOfBusiness').val(obj.cashFlowAnalysisDetails.cfaElectricityBillOfBusiness);
                    $('#cfaResidenceBusinessPermissesRent').val(obj.cashFlowAnalysisDetails.cfaResidenceBusinessPermissesRent);
                    $('#cfaHouseHoldExpense').val(obj.cashFlowAnalysisDetails.cfaHouseHoldExpense);
                    $('#cfaSalary').val(obj.cashFlowAnalysisDetails.cfaSalary);
                    $('#cfaMiscExpenses').val(obj.cashFlowAnalysisDetails.cfaMiscExpenses);
                    $('#cfaSchoolFee').val(obj.cashFlowAnalysisDetails.cfaSchoolFee);
                    $('#cfaGrossAmountAvailable').val(obj.cashFlowAnalysisDetails.cfaGrossAmountAvailable);
                    $('#cfaRunningEmi').val(obj.cashFlowAnalysisDetails.cfaRunningEmi);
                    $('#cfaCreditCardEMi').val(obj.cashFlowAnalysisDetails.cfaCreditCardEMi);
                    $('#cfaProposedEmi').val(obj.cashFlowAnalysisDetails.cfaProposedEmi);
                    $('#cfaNetAmountAvailable').val(obj.cashFlowAnalysisDetails.cfaNetAmountAvailable);
                    $('#cfaFOIR').val(obj.cashFlowAnalysisDetails.cfaFOIR);
                    $('#cfaNetMonthlyIncome').val(obj.cashFlowAnalysisDetails.cfaNetMonthlyIncome);
                }

                if(obj.bank)
                {
                    $('#accountHolderName').val(obj.bank.accountHolderName);
                    $('#bankName').val(obj.bank.bankName);
                    $('#ifscCode').val(obj.bank.ifscCode);
                    $('#accountType').val(obj.bank.accountType);
                    $('#accountNumber').val(obj.bank.accountNumber);
                    $('#accountNumberC').val(obj.bank.accountNumber);
                    $('#bankAddress').val(obj.bank.address);
                    $('#bankState').val(obj.bank.state);
                    $('#bankCity').val(obj.bank.city);
                    $('#bankPincode').val(obj.bank.pincode);

                }

                if(obj.kycDetails){
                    if(obj.kycDetails.idProofFront){
                        $('#idProofFrontV').attr('href','{{asset('/')}}public/'+obj.kycDetails.idProofFront);
                        $('#idProofFrontV').show();
                    }else{
                        $('#idProofFrontV').hide();
                    }

                    if(obj.kycDetails.idProofBack){
                        $('#idProofBackV').attr('href','{{asset('/')}}public/'+obj.kycDetails.idProofBack);
                        $('#idProofBackV').show();
                    }else{
                        $('#idProofBackV').hide();
                    }

                    if(obj.kycDetails.panCardFront){
                        $('#panCardFrontV').attr('href','{{asset('/')}}public/'+obj.kycDetails.panCardFront);
                        $('#panCardFrontV').show();
                    }else{
                        $('#panCardFrontV').hide();
                    }

                    if(obj.kycDetails.addressProofFront){
                        $('#addressProofFrontV').attr('href','{{asset('/')}}public/'+obj.kycDetails.addressProofFront);
                        $('#addressProofFrontV').show();
                    }else{
                        $('#addressProofFrontV').hide();
                    }

                    if(obj.kycDetails.addressProofBack){
                        $('#addressProofBackV').attr('href','{{asset('/')}}public/'+obj.kycDetails.addressProofBack);
                        $('#addressProofBackV').show();
                    }else{
                        $('#addressProofBackV').hide();
                    }

                    if(obj.kycDetails.bankAttachemet){
                        $('#bankAttachemetV').attr('href','{{asset('/')}}public/'+obj.kycDetails.bankAttachemet);
                        $('#bankAttachemetV').show();
                    }else{
                        $('#bankAttachemetV').hide();
                    }

                    /*
                    if(obj.kycDetails.otherDocument){
                        $('#otherDocumentV').attr('href','{{asset('/')}}public/'+obj.kycDetails.otherDocument);
                        $('#otherDocumentV').show();
                    }else{
                        $('#otherDocumentV').hide();
                    }
                    
                    $('#otherDocumentTitle').val(obj.kycDetails.otherDocumentTitle);
                    */

                    $('#otherDocsHtml').html(obj.otherDocHtml);
                }

                $('#add_edit_user_modal').modal('show');
            }else{
                alertMessage('Error!', obj.message, 'error', 'no');
                return false;
            }
        });


    }

    $('#personalFormEdit').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var recordId=$('.recordId').val();

        var nameTitleCu=$('#nameTitleCu').val();
        var customerName=$('#customerNameE').val();
        var customerEmail=$('#customerEmailE').val();
        var customerPhone=$('#customerPhoneE').val();

        var maritalStatus=$('#maritalStatusE').val();
        var gender=$('#genderE').val();        
        var dateOfBirth=$('#dateOfBirthE').val();
        var address=$('#addressE').val();
        var city=$('#cityE').val();
        var district=$('#districtE').val();
        var state=$('#stateE').val();
        var pincode=$('#pincodeE').val();

        var aadhaar_no=$('#aadhaar_noE').val();
        var pancard_no=$('#pancard_noE').val();

        var password=$('#passwordE').val();
        var cnfpassword=$('#cnfpasswordE').val();


        var religionCu=$('#religionCu').val();
        var educationStatusCu=$('#educationStatusCu').val();
        var fatherNameCu=$('#fatherNameCu').val();
        var motherNameCu=$('#motherNameCu').val();
        var cibilScoreCu=$('#cibilScoreCu').val();
        var sourcePerson2=$('#sourcePerson2').val();
        var branchName2=$('#branchName2').val();
       

        if(!nameTitleCu) {
            alertMessage('Error!', 'Please select applicant name title.', 'error', 'no');
            return false;
        } else if(!customerName) {
            alertMessage('Error!', 'Please enter the applicant name.', 'error', 'no');
            return false;
        } else if(!customerEmail) {
            alertMessage('Error!', 'Please enter email id.', 'error', 'no');
            return false;
        }else if(!customerPhone) {
            alertMessage('Error!', 'Please enter mobile number.', 'error', 'no');
            return false;
        }else if(!maritalStatus) {
            alertMessage('Error!', 'Please select marital status.', 'error', 'no');
            return false;
        }else if(!gender) {
            alertMessage('Error!', 'Please select gender.', 'error', 'no');
            return false;
        }else if(!dateOfBirth) {
            alertMessage('Error!', 'Please select date of birth.', 'error', 'no');
            return false;
        }else if(!address) {
            alertMessage('Error!', 'Please enter address.', 'error', 'no');
            return false;
        }else if(!city) {
            alertMessage('Error!', 'Please enter city.', 'error', 'no');
            return false;
        }else if(!state) {
            alertMessage('Error!', 'Please enter state.', 'error', 'no');
            return false;
        }else if(!pincode) {
            alertMessage('Error!', 'Please enter pincode.', 'error', 'no');
            return false;
        }else if(aadhaar_no && aadhaar_no.length!=12) {
            alertMessage('Error!', 'Please enter valid aadhaar number.', 'error', 'no');
            return false;
        }else if(pancard_no && pancard_no.length!=10) {
            alertMessage('Error!', 'Please enter valid pan number.', 'error', 'no');
            return false;
        }else if(!religionCu) {
            alertMessage('Error!', 'Please enter religion.', 'error', 'no');
            return false;
        }else if(!educationStatusCu) {
            alertMessage('Error!', 'Please enter education status.', 'error', 'no');
            return false;
        }else if(!fatherNameCu) {
            alertMessage('Error!', 'Please enter father name.', 'error', 'no');
            return false;
        }else if(!motherNameCu) {
            alertMessage('Error!', 'Please enter mother name.', 'error', 'no');
            return false;
        }else if(!cibilScoreCu) {
            alertMessage('Error!', 'Please enter cibil score.', 'error', 'no');
            return false;
        }else if(!sourcePerson2) {
            alertMessage('Error!', 'Please enter source person name.', 'error', 'no');
            return false;
        }else if(!branchName2) {
            alertMessage('Error!', 'Please enter branch name.', 'error', 'no');
            return false;
        }else{
            $('#personalFormBtnE').text('Please Wait...').attr('disabled','disabled');
            $.ajax({
                type:'POST',
                url: "{{route('saveCustomerInfo')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
                    $('#personalFormBtnE').text('Submit').removeAttr('disabled');
                    if(obj.status=='success')
                    {
                        $('#personalFormBtnNE').click();

                        alertMessage('Success!', obj.message, 'success', 'no');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                },
                error: function(data){
                    $('#personalFormBtnE').text('Save').removeAttr('disabled');
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        }
    });

    $('#personalFormCoApplicantEdit').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var recordId=$('.recordId').val();
        var nameTitleCoApp=$('#nameTitleCoApp').val();
        var customerNameCoApp=$('#customerNameCoApp').val();
        var genderCoApp=$('#genderCoApp').val();

        var dateOfBirthECoApp=$('#dateOfBirthECoApp').val();
        var religionCoApp=$('#religionCoApp').val();
        var educationStatusCoApp=$('#educationStatusCoApp').val();
        var fatherNameCoApp=$('#fatherNameCoApp').val();
        var motherNameCoApp=$('#motherNameCoApp').val();
        var maritalStatusCoApp=$('#maritalStatusCoApp').val();
        var relationWithApplicantCoApp=$('#relationWithApplicantCoApp').val();
        var cibilScoreCoApp=$('#cibilScoreCoApp').val();

        if(!recordId) {
            alertMessage('Error!', 'Invalid Request.', 'error', 'no');
            return false;
        } else if(!nameTitleCoApp) {
            alertMessage('Error!', 'Please select name title.', 'error', 'no');
            return false;
        }else if(!customerNameCoApp) {
            alertMessage('Error!', 'Please enter name.', 'error', 'no');
            return false;
        }else if(!genderCoApp) {
            alertMessage('Error!', 'Please select gender.', 'error', 'no');
            return false;
        }else if(!dateOfBirthECoApp) {
            alertMessage('Error!', 'Please select date of birth.', 'error', 'no');
            return false;
        }else if(!religionCoApp) {
            alertMessage('Error!', 'Please enter religion.', 'error', 'no');
            return false;
        }else if(!educationStatusCoApp) {
            alertMessage('Error!', 'Please select education status.', 'error', 'no');
            return false;
        }else if(!fatherNameCoApp) {
            alertMessage('Error!', 'Please enter father name.', 'error', 'no');
            return false;
        }else if(!motherNameCoApp) {
            alertMessage('Error!', 'Please enter mother name.', 'error', 'no');
            return false;
        }else if(!maritalStatusCoApp) {
            alertMessage('Error!', 'Please select merital status.', 'error', 'no');
            return false;
        }else if(!relationWithApplicantCoApp) {
            alertMessage('Error!', 'Please enter relation with applicant.', 'error', 'no');
            return false;
        }else if(!cibilScoreCoApp) {
            alertMessage('Error!', 'Please enter cibil score.', 'error', 'no');
            return false;
        }else{
            $('#personalFormBtnECoApp').text('Please Wait...').attr('disabled','disabled');
            $.ajax({
                type:'POST',
                url: "{{route('saveCoApplicantInfo')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
                    $('#personalFormBtnECoApp').text('Submit').removeAttr('disabled');
                    if(obj.status=='success')
                    {
                        $('#personalFormBtnNEApp').click();

                        alertMessage('Success!', obj.message, 'success', 'no');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                },
                error: function(data){
                    $('#personalFormBtnECoApp').text('Save').removeAttr('disabled');
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        }
    });

    $('#professionalDetailsFrm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var recordId=$('.recordId').val();
        var employerName=$('#employerName').val();
        var companyMobileNo=$('#companyMobileNo').val();
        var companyPan=$('#companyPan').val();
        var companyGstin=$('#companyGstin').val();

        var companyType=$('#companyType').val();
        var companyAddress=$('#companyAddress').val();
        var companyDistrict=$('#companyDistrict').val();
        var companyState=$('#companyState').val();
        var companyPincode=$('#companyPincode').val();

        if(!employerName) {
            alertMessage('Error!', 'Please enter the company name.', 'error', 'no');
            return false;
        } else if(!companyMobileNo) {
            alertMessage('Error!', 'Please enter company phone number.', 'error', 'no');
            return false;
        } else if(!companyPan) {
            alertMessage('Error!', 'Please enter pan number.', 'error', 'no');
            return false;
        } else if(companyPan && companyPan.length!=10) {
            alertMessage('Error!', 'Please enter valid pan number.', 'error', 'no');
            return false;
        }else if(!companyGstin) {
            alertMessage('Error!', 'Please enter GSTIN.', 'error', 'no');
            return false;
        }else if(companyGstin && companyGstin.length!=15) {
            alertMessage('Error!', 'Please enter valid GSTIN.', 'error', 'no');
            return false;
        } else if(!companyType) {
            alertMessage('Error!', 'Please select company type.', 'error', 'no');
            return false;
        } else if(!companyAddress) {
            alertMessage('Error!', 'Please enter company address.', 'error', 'no');
            return false;
        } else if(!companyDistrict) {
            alertMessage('Error!', 'Please enter company district.', 'error', 'no');
            return false;
        } else if(!companyState) {
            alertMessage('Error!', 'Please enter company state.', 'error', 'no');
            return false;
        } else if(!companyPincode) {
            alertMessage('Error!', 'Please enter company pincode.', 'error', 'no');
            return false;
        }else{
            $('#professionalDetailsFrmBtn').text('Please Wait...').attr('disabled','disabled');
            $.ajax({
                type:'POST',
                url: "{{route('saveProfessionalDetails')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
                    $('#professionalDetailsFrmBtn').text('Submit').removeAttr('disabled');
                    if(obj.status=='success')
                    {
                        $('#professionalDetailsFrmBtnNext').click();
                        alertMessage('Success!', obj.message, 'success', 'no');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                },
                error: function(data){
                    $('#professionalDetailsFrmBtn').text('Save').removeAttr('disabled');
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        }
    });

    $('#kycForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let otherDocumentTitle = $("input[name='otherDocumentTitle[]']").map(function(){return $(this).val();}).get();
        let alreadyId =  $("input[name='otherDocumentIds[]']").map(function(){return $(this).val();}).get(); 
        
        if(alreadyId.length > 0){
            formData.append('otherDocumentIds', JSON.parse(JSON.stringify(alreadyId)));
        }
        formData.append('otherDocumentTitle', JSON.parse(JSON.stringify(otherDocumentTitle)));
        var recordId=$('.recordId').val();
        $('#kycFormBtn').text('Please Wait...').attr('disabled','disabled');
         $.ajax({
            type:'POST',
            url: "{{route('saveKycDetails')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                var obj = JSON.parse(data);
                $('#kycFormBtn').text('Submit').removeAttr('disabled');
                if(obj.status=='success')
                {
                    $('#kycFormBtnNext').click();
                    alertMessage('Success!', obj.message, 'success', 'no');
                    return false;
                }else{
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }
            },
            error: function(data){
                $('#kycFormBtn').text('Save').removeAttr('disabled');
                alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                return false;
                console.log(data);
            }
        });
    });

    $('#bankDetailsForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var recordId=$('.recordId').val();
        var accountHolderName=$('#accountHolderName').val();
        var bankName=$('#bankName').val();
        var ifscCode=$('#ifscCode').val();
        var accountType=$('#accountType').val();
        var accountNumber=$('#accountNumber').val();
        var accountNumberC=$('#accountNumberC').val();
        var bankAddress=$('#bankAddress').val();
        var bankCity=$('#bankCity').val();
        var bankState=$('#bankState').val();
        var bankPincode=$('#bankPincode').val();


        if(!accountHolderName) {
            alertMessage('Error!', 'Please enter the account holder name.', 'error', 'no');
            return false;
        } else if(!bankName) {
            alertMessage('Error!', 'Please enter bank name.', 'error', 'no');
            return false;
        } else if(!ifscCode) {
            alertMessage('Error!', 'Please enter IFSC code.', 'error', 'no');
            return false;
        } else if(!accountType) {
            alertMessage('Error!', 'Please account type.', 'error', 'no');
            return false;
        }else if(!accountNumber) {
            alertMessage('Error!', 'Please enter account number.', 'error', 'no');
            return false;
        }else if(accountNumber !=accountNumberC) {
            alertMessage('Error!', 'Confirm account number not matched.', 'error', 'no');
            return false;
        }else if(!bankAddress) {
            alertMessage('Error!', 'Please enter bank address.', 'error', 'no');
            return false;
        }else if(!bankCity) {
            alertMessage('Error!', 'Please enter bank city.', 'error', 'no');
            return false;
        }else if(!bankState) {
            alertMessage('Error!', 'Please enter bank state.', 'error', 'no');
            return false;
        }else if(!bankPincode) {
            alertMessage('Error!', 'Please enter bank address pincode.', 'error', 'no');
            return false;
        }else{
            $('#bankDetailsFormBtn').text('Please Wait...').attr('disabled','disabled');
            $.ajax({
                type:'POST',
                url: "{{route('saveUserBankDetails')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
                    $('#bankDetailsFormBtn').text('Submit').removeAttr('disabled');
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
                    $('#bankDetailsFormBtn').text('Save').removeAttr('disabled');
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        }
    });

    function initiateApplyLoan(userId)
    {
        $.post('{{route('initiateApplyLoan')}}',{
            "_token": "{{ csrf_token() }}",
            userId:userId,
            pageNameStr:'{{$pageNameStr}}',
        },function(data){
            var obj = JSON.parse(data);
            if(obj.status=='success'){
                $('#initiateApplyLoanModalBody').html(obj.data);
                $('#initiateApplyLoanUserId').val(userId);
                $('#initiateApplyLoanModal').modal('show');
            }else{
                alertMessage('Error!', obj.message, 'error', 'no');
                return false;
            }
        });
    }

    $('#applyLoanAdminFrm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var userId=$('#initiateApplyLoanUserId').val();
        var loanCategory=$('#loanCategory').val();
        var productName=$('#productName').val();
        var approveTenure=$('#approveTenure').val();
        var approvedAmount=$('#approvedAmount').val();
        var approvedRoi=$('#approvedRoi').val();
        var invoiceFile=$('#invoiceFile').val();
        var validFromDate=$('#validFromDate').val();
        var validToDate=$('#validToDate').val();
        var plateformFee=$('#plateformFee').val();
        var insurance=$('#insurance').val();
        var roiType=$('#roiType').val();

        if(!userId){
            alertMessage('Error!', 'Invalid Request, Please try again', 'error', 'yes');
            return false;
        }else if(!loanCategory){
            alertMessage('Error!', 'Please select category name.', 'error', 'no');
            return false;
        }else if(loanCategory!='3' && loanCategory!='4' && !productName){
            alertMessage('Error!', 'Please select product name.', 'error', 'no');
            return false;
        }else if(loanCategory=='3' && !invoiceFile){
            alertMessage('Error!', 'Please upload bill.', 'error', 'no');
            return false;
        }else if(loanCategory=='4' && !invoiceFile){
            alertMessage('Error!', 'Please upload invoice.', 'error', 'no');
            return false;
        }else if(loanCategory=='3' && (!validFromDate || !validToDate)){
            alertMessage('Error!', 'Please select valid from & valid to date.', 'error', 'no');
            return false;
        }else if(loanCategory!='3' && loanCategory!='4' && !roiType){
            alertMessage('Error!', 'Please select ROI type.', 'error', 'no');
            return false;
        }else if(loanCategory!='3' && loanCategory!='4' && !approveTenure){
            alertMessage('Error!', 'Please select tenure.', 'error', 'no');
            return false;
        }else if(!approvedAmount){
            alertMessage('Error!', 'Please enter approved amount.', 'error', 'no');
            return false;
        }else if(!approvedRoi){
            alertMessage('Error!', 'Please enter rate of interest.', 'error', 'no');
            return false;
        }else if(!parseInt(plateformFee)){
            alertMessage('Error!', 'Please enter plateform fee.', 'error', 'no');
            return false;
        }else{
            $('#initiateApplyLoanBtnFnBtn').text('Please Wait...').attr('disabled','disabled');
            $('#initiateApplyLoanFrmResetBtn').text('Please Wait...').attr('disabled','disabled');
            $.ajax({
                type:'POST',
                url: "{{route('applyLoanByAdmin')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
                    if(obj.status=='success'){
                        alertMessage('Success!', obj.message, 'success', 'yes');
                        initiateApplyLoan(userId);
                        return false;
                    }else{
                        $('#initiateApplyLoanBtnFnBtn').text('Send For Admin Approval').removeAttr('disabled');
                        $('#initiateApplyLoanFrmResetBtn').text('Cancel').removeAttr('disabled');
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                },
                error: function(data){
                    $('#initiateApplyLoanBtnFnBtn').text('Send For Admin Approval').removeAttr('disabled');
                    $('#initiateApplyLoanFrmResetBtn').text('Cancel').removeAttr('disabled');
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        }
    });

    function initiateApplyLoanFrmReset()
    {
        $('#loanCategory').val('');
        $('#approveTenure').val('');
        $('#approvedAmount').val('');
        $('#approvedRoi').val('');
        $('#invoiceFile').val('');
        $('#validFromDate').val('');
        $('#validToDate').val('');
    }

    function checkProductTypeCategory()
    {
        var loanId=$('#loanCategory').val();
        $('#invoiceFile').val('');
        $('#validFromDate').val('');
        $('#validToDate').val('');
        $('#productName').val('');
        $('#productName').val('');
        $('#approveTenure').val('');
        $('#invoiceFileLabel').html('');

        if(parseInt(loanId)==3){
            $('.validFromDateHtml').show();
            $('.validToDateHtml').show();
            $('.approveTenureHtml').hide();
        }else{
            $('.validFromDateHtml').hide();
            $('.validToDateHtml').hide();
            $('.approveTenureHtml').show();
        }


        if(parseInt(loanId)==3 || parseInt(loanId)==4){

            var label=(parseInt(loanId)==4) ? 'Upload Invoice' : 'Upload Bill';
            $('#invoiceFileLabel').html(label);
            $('#invoiceFileHtml').show();
            $('.productNameHtml').hide();
            $('.roiTypeHtml').hide();
        }else{
            $('#invoiceFileHtml').hide();
            $('.productNameHtml').show();
            $('.roiTypeHtml').show();
        }

        getProductsListByCategory(loanId);
        getTenuresListByCategory(loanId);
    }

    function calculatePlateformFee() {
        var approvedAmount=parseFloat($('#approvedAmount').val()).toFixed(2);
        var pfFee=(approvedAmount*1.5)/100;
        var gstOfPfFee=(pfFee*18)/100;
        var totalPlateformFee=parseFloat(pfFee+gstOfPfFee).toFixed(2);
        $('#plateformFee').val(totalPlateformFee);
    }

    function validateIfTenureApplicable()
    {
        var roiType=$('#roiType').val();
        var loanId=$('#loanCategory').val();
        $('#approveTenure').val('');
        if(roiType=='bullet_repayment'){
            $('.roiTenureHtml').hide();
        }else{
            $('.roiTenureHtml').show();
        }
    }

    function getProductsListByCategory(catId)
    {
        $.post('{{route('getProductsListByCategory')}}',{
            "_token": "{{ csrf_token() }}",
            catId:catId,
        },function(data){
            var obj = JSON.parse(data);
            if(obj.status=='success'){
                $('#productName').html(obj.data);
            }else{
                $('#productName').html('');
            }
        });
    }

    function getTenuresListByCategory(catId)
    {
        $.post('{{route('getTenureListByCategory')}}',{
            "_token": "{{ csrf_token() }}",
            catId:catId,
        },function(data){
            var obj = JSON.parse(data);
            if(obj.status=='success'){
                $('#approveTenure').html(obj.data);
            }else{
                $('#approveTenure').html('');
            }
        });
    }

    $('.calcCfaRun').change(function(){
        cashflowAnalysisCalc();
    });
    
    function cashflowAnalysisCalc()
    {
        var cfaSale=parseFloat($('#cfaSale').val());
        var cfaMargin=parseFloat($('#cfaMargin').val());
        var cfaGrossMargin=parseFloat((cfaSale*cfaMargin)/100).toFixed(2);
        $('#cfaGrossMargin').val(cfaGrossMargin);
        $('#cfaAmountAvailable').val(cfaGrossMargin);
        
        var cfaElectricityBillOfResidence=parseFloat($('#cfaElectricityBillOfResidence').val());
        var cfaElectricityBillOfBusiness=parseFloat($('#cfaElectricityBillOfBusiness').val());
        var cfaResidenceBusinessPermissesRent=parseFloat($('#cfaResidenceBusinessPermissesRent').val());
        var cfaHouseHoldExpense=parseFloat($('#cfaHouseHoldExpense').val());
        var cfaSalary=parseFloat($('#cfaSalary').val());
        var cfaMiscExpenses=parseFloat($('#cfaMiscExpenses').val());
        var cfaSchoolFee=parseFloat($('#cfaSchoolFee').val());
        
        var tatalExpenses=parseFloat(cfaElectricityBillOfResidence+cfaElectricityBillOfBusiness+cfaResidenceBusinessPermissesRent+cfaHouseHoldExpense+cfaSalary+cfaMiscExpenses+cfaSchoolFee);
        var cfaGrossAmountAvailable=parseFloat(cfaGrossMargin-tatalExpenses).toFixed(2);
        $('#cfaGrossAmountAvailable').val(cfaGrossAmountAvailable);
        
        var cfaRunningEmi=parseFloat($('#cfaRunningEmi').val());
        var cfaCreditCardEMi=parseFloat($('#cfaCreditCardEMi').val());
        var cfaProposedEmi=parseFloat($('#cfaProposedEmi').val());
        var totalEmiDeductions=cfaRunningEmi+cfaCreditCardEMi+cfaProposedEmi;
        
        var cfaNetAmountAvailable=parseFloat(cfaGrossAmountAvailable-totalEmiDeductions).toFixed(2);
        $('#cfaNetAmountAvailable').val(cfaNetAmountAvailable);
        
        var cfaFOIR=Math.round(parseFloat((totalEmiDeductions/cfaGrossAmountAvailable)*100));
        $('#cfaFOIR').val(cfaFOIR);
        $('#cfaNetMonthlyIncome').val(cfaGrossAmountAvailable);
    }

    $('#importUserForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var userData=$('#userData').val();

        if(!userData) {
            alertMessage('Error!', 'Please upload csv file.', 'error', 'no');
            return false;
        } else{
            $('#importFormBtn').text('Please Wait...').attr('disabled','disabled');
            $.ajax({
                type:'POST',
                url: "{{route('importusersByCSV')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var obj = JSON.parse(data);
                    if(obj.status=='success')
                    {
                        alertMessage('Success!', obj.message, 'success', 'yes');
                        return false;
                    }else{
                        $('#importFormBtn').text('Submit').removeAttr('disabled');
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                },
                error: function(data){
                    $('#v').text('Submit').removeAttr('disabled');
                    alertMessage('Error!', 'Invalid data uploaded', 'error', 'no');
                    return false;
                    //console.log(data);
                }
            });
        }
    });

    function docsAddMore()
    {
        var maxOtherDocs=parseInt($('#maxOtherDocs').val())+1;

        var docHtml =`<div class="row col-lg-12 mb-5" id="otherRow`+maxOtherDocs+`">
            <label class="block">
                <span>Others documents <span style="font-size: 10px;color: red;">(IT RETURN,GSt return,balance sheet PNL)</span></span>
                
            </label>
            <div class="col-lg-5">
                <input name="otherDocumentTitle[]" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Document Name" type="text">
            </div>
            <div class="col-lg-1">&nbsp;</div>
            <div class="col-lg-6">
                <input name="otherDocument[]" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="file">
            </div>
        </div>`;
        $('#otherDocsHtml').append(docHtml);
        $('#maxOtherDocs').val(maxOtherDocs)
    }
</script>
@endsection
