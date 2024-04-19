<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <title>Maxemo Dashboard</title>
    <link rel="icon" type="image/png" href="{{asset('assets/admin')}}/images/logos/favicon.png" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet"/>

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/bootstrap.min.css" />
    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/app.css" />
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/custom.css">
    <!-- Javascript Assets -->
    <script src="{{asset('assets/admin')}}/js/app.js" defer></script>

    <!-- data table js link -->
    <!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/datatables.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com//ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <style>
            .btn-secondary {
                background: #787272 !important;
            }
        </style>
</head>
<?php
$userPermissions=App\Providers\AppServiceProvider::checkDecodePermissions();
?>
<body x-data class="is-header-blur" x-bind="$store.global.documentBody">
<!-- App preloader-->
<div
    class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900"
>
    <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
</div>

<!-- Page Wrapper -->
<div
    id="root"
    class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900"
    x-cloak
>
    <!-- Sidebar -->
    <div class="sidebar print:hidden">
        <div class="sidebar-panel">
            <div
                class="flex sideopbar h-full grow flex-col bg-white pl-[var(--main-sidebar-width)] dark:bg-navy-750"
            >

                <div
                    class="flex h-18 w-full items-center justify-between pl-4 pr-1"
                >
                    <p
                        class="text-base tracking-wider text-slate-800 dark:text-navy-100"
                    >
                    <div class="logo_main" id="logo_sidebar">
                        <a href="{{route('adminDashboard')}}"><img src="{{asset('assets/admin')}}/images/logos/maxemo-logo.png" alt=""></a>
                    </div>
                    </p>
                    <button
                        @click="$store.global.isSidebarExpanded = false"
                        class="btn h-7 w-7 rounded-full p-0 text-primary hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-accent-light/80 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 xl:hidden"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewbox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>
                    </button>
                </div>

                <div x-data="{expandedItem:null}" class="h-[calc(100%-4.5rem)] overflow-x-hidden pb-6" x-init="$el._x_simplebar = new SimpleBar($el);" >
                    <ul class="flex flex-1 flex-col px-4 font-inter">
                        <li x-init="$el.scrollIntoView({block: 'center'})">
                            <a href="{{route('adminDashboard')}}" class="flex d_text py-2 text-xs+ font-medium tracking-wide text-primary outline-none transition-colors duration-300 ease-in-out dark:text-accent-light" > Dashboard </a>
                        </li>

                    </ul>
                    <div class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>
                    <ul class="flex flex-1 flex-col px-4 font-inter sidebarmenu_list">
                        <?php if(in_array('all',$userPermissions) || in_array('view-roles',$userPermissions) || in_array('view-sys-user',$userPermissions)){ ?>
                        <li x-data="accordionItem('menu-item-1')">
                            <a
                                :class="expanded && 'text-slate-800 font-semibold dark:text-navy-50'"
                                @click="expanded = !expanded"
                                class="flex items-center justify-between py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                href="javascript:void(0);"
                            >
                    <span class="mainli_menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass link-icon"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                    System User Management</span>
                                <svg
                                    :class="expanded && 'rotate-90'"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                    fill="none"
                                    viewbox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </a>
                            <ul x-collapse x-show="expanded">
                                <?php if(in_array('all',$userPermissions) || in_array('view-roles',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('rolesList')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>User Roles</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                                    <?php if(in_array('all',$userPermissions) || in_array('view-sys-user',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('adminUsers')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Users</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if(in_array('all',$userPermissions) || in_array('newcustomers',$userPermissions) || in_array('rejectedcustomers',$userPermissions) || in_array('kycverifiedcustomers',$userPermissions) || in_array('employment-verification-rejected',$userPermissions) || in_array('credit-assessment-status-list',$userPermissions) || in_array('finalapprovalfordisbursement',$userPermissions) || in_array('customer-approval-pending',$userPermissions) || in_array('customer-approval-rejected',$userPermissions)){ ?>
                                <li x-data="accordionItem('menu-item-2')">
                            <a
                                :class="expanded && 'text-slate-800 font-semibold dark:text-navy-50'"
                                @click="expanded = !expanded"
                                class="flex items-center justify-between py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                href="javascript:void(0);"
                            >
                    <span class="mainli_menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user link-icon"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Customer Management</span>
                                <svg
                                    :class="expanded && 'rotate-90'"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                    fill="none"
                                    viewbox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </a>
                            <ul x-collapse x-show="expanded">
                                <?php if(in_array('all',$userPermissions) || in_array('newcustomers',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('customerList')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>New Customers</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{route('allcustomer')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>All Customers</span>
                                        </div>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if(in_array('all',$userPermissions) || in_array('rejectedcustomers',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('kycRejectedUsers')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Rejected Customers</span>
                                        </div>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if(in_array('all',$userPermissions) || in_array('kycverifiedcustomers',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('employmentVerification')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Business / Company Verification Customers</span>
                                        </div>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if(in_array('all',$userPermissions) || in_array('employment-verification-rejected',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('employmentVerificationRejected')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Business / Company Rejected Customers</span>
                                        </div>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if(in_array('all',$userPermissions) || in_array('credit-assessment-status-list',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('kycApprovedUsers')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Credit Assessment Status</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                                    <?php if(in_array('all',$userPermissions) || in_array('final-credit-assessment-status-list',$userPermissions)){ ?>
                                    <li>
                                        <a
                                            href="{{route('finalKycApprovedUsers')}}"
                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                        >
                                            <div class="flex items-center space-x-2">
                                                <div
                                                    class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                                ></div>
                                                <span>Final Credit Assessment Status</span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if(in_array('all',$userPermissions) || in_array('finalapprovalfordisbursement',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('finalDisbursementUsers')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Disbursement Approval</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                                    <?php if(in_array('all',$userPermissions) || in_array('customer-approval-pending',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('disbursementPendingUsers')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Customer Pending List</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                                    <?php if(in_array('all',$userPermissions) || in_array('customer-approval-rejected',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('disbursementRejectedUsers')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Customer Rejected List</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                            </ul>
                        </li>
                            <?php } ?>
                        <?php if(in_array('all',$userPermissions) || in_array('today-disbursement',$userPermissions) || in_array('pending-disbursement',$userPermissions) || in_array('disbursed-loan-list',$userPermissions)){ ?>
                            <li x-data="accordionItem('menu-item-3')">
                            <a
                                :class="expanded && 'text-slate-800 font-semibold dark:text-navy-50'"
                                @click="expanded = !expanded"
                                class="flex items-center justify-between py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                href="javascript:void(0);"
                            >
                    <span class="mainli_menu">


                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="rupeecolor" id="IconChangeColor" height="14" width="14" transform="scale(1,1)"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M.0022 64C.0022 46.33 14.33 32 32 32H288C305.7 32 320 46.33 320 64C320 81.67 305.7 96 288 96H231.8C241.4 110.4 248.5 126.6 252.4 144H288C305.7 144 320 158.3 320 176C320 193.7 305.7 208 288 208H252.4C239.2 266.3 190.5 311.2 130.3 318.9L274.6 421.1C288.1 432.2 292.3 452.2 282 466.6C271.8 480.1 251.8 484.3 237.4 474L13.4 314C2.083 305.1-2.716 291.5 1.529 278.2C5.774 264.1 18.09 256 32 256H112C144.8 256 173 236.3 185.3 208H32C14.33 208 .0022 193.7 .0022 176C.0022 158.3 14.33 144 32 144H185.3C173 115.7 144.8 96 112 96H32C14.33 96 .0022 81.67 .0022 64V64z" id="mainIconPathAttribute"  stroke-width="0" filter="url(#shadow)"></path><filter id="shadow"><feDropShadow id="shadowValue" stdDeviation=".5" dx="0" dy="0" flood-color="black"></feDropShadow></filter><filter id="shadow"><feDropShadow id="shadowValue" stdDeviation=".5" dx="0" dy="0" flood-color="black"></feDropShadow></filter></svg>

                    Loan Management</span>
                                <svg
                                    :class="expanded && 'rotate-90'"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                    fill="none"
                                    viewbox="0 0 24 24"
                                    stroke="currentColor" >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </a>
                            <ul x-collapse x-show="expanded">
                                <?php if(in_array('all',$userPermissions) || in_array('today-disbursement',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('todayDisbursement')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Today Disbursement</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                                    <?php if(in_array('all',$userPermissions) || in_array('pending-disbursement',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('pendingDisbursement')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Pending Disbursement</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                                    <?php if(in_array('all',$userPermissions) || in_array('disbursed-loan-list',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('disbursedLoanList')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Disbursed Loan</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{route('allLoanList')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>All Loan List</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>

                        <?php if(in_array('all',$userPermissions) || in_array('rawmaterial-loan-list',$userPermissions)){ ?>
                        <li x-data="accordionItem('menu-item-raw-mat')">
                            <a
                                :class="expanded && 'text-slate-800 font-semibold dark:text-navy-50'"
                                @click="expanded = !expanded"
                                class="flex items-center justify-between py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                href="javascript:void(0);"
                            >
                    <span class="mainli_menu">


                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="rupeecolor" id="IconChangeColor" height="14" width="14" transform="scale(1,1)"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M.0022 64C.0022 46.33 14.33 32 32 32H288C305.7 32 320 46.33 320 64C320 81.67 305.7 96 288 96H231.8C241.4 110.4 248.5 126.6 252.4 144H288C305.7 144 320 158.3 320 176C320 193.7 305.7 208 288 208H252.4C239.2 266.3 190.5 311.2 130.3 318.9L274.6 421.1C288.1 432.2 292.3 452.2 282 466.6C271.8 480.1 251.8 484.3 237.4 474L13.4 314C2.083 305.1-2.716 291.5 1.529 278.2C5.774 264.1 18.09 256 32 256H112C144.8 256 173 236.3 185.3 208H32C14.33 208 .0022 193.7 .0022 176C.0022 158.3 14.33 144 32 144H185.3C173 115.7 144.8 96 112 96H32C14.33 96 .0022 81.67 .0022 64V64z" id="mainIconPathAttribute"  stroke-width="0" filter="url(#shadow)"></path><filter id="shadow"><feDropShadow id="shadowValue" stdDeviation=".5" dx="0" dy="0" flood-color="black"></feDropShadow></filter><filter id="shadow"><feDropShadow id="shadowValue" stdDeviation=".5" dx="0" dy="0" flood-color="black"></feDropShadow></filter></svg>

                    Raw Material Financing</span>
                                <svg
                                    :class="expanded && 'rotate-90'"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                    fill="none"
                                    viewbox="0 0 24 24"
                                    stroke="currentColor" >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </a>
                            <ul x-collapse x-show="expanded">
                                <li>
                                    <a
                                        href="{{route('todayRawDisbursement')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Today / Pending Disbursement</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{route('rawMaterialDisbursementPendingList')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Disbursement Approval</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{route('rawMaterialFinancingLoans')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Approved List</span>
                                        </div>
                                    </a>
                                </li>
                                

                                <li>
                                    <a
                                        href="{{ route('dueRenewalRawMaterialFinancingLoans') }}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Due Renewal Loan</span>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <?php } ?>

                        <?php if(in_array('all',$userPermissions) || in_array('customer-emi',$userPermissions) || in_array('received-emi',$userPermissions) || in_array('todays-emi',$userPermissions) || in_array('overdue-emi',$userPermissions) || in_array('closed-loan',$userPermissions) || in_array('noc-customers',$userPermissions)){ ?>
                            <li x-data="accordionItem('menu-item-4')">
                            <a
                                :class="expanded && 'text-slate-800 font-semibold dark:text-navy-50'"
                                @click="expanded = !expanded"
                                class="flex items-center justify-between py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                href="javascript:void(0);"
                            >
                    <span class="mainli_menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-aperture link-icon"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
                    Collection Management</span>
                                <svg
                                    :class="expanded && 'rotate-90'"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                    fill="none"
                                    viewbox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </a>
                            <ul x-collapse x-show="expanded">
                                <?php if(in_array('all',$userPermissions) || in_array('customer-emi',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('customerEmis')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Customer's EMI</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                                    <?php if(in_array('all',$userPermissions) || in_array('todays-emi',$userPermissions)){ ?>
                                        <li>
                                            <a
                                                href="{{route('todaysEmis')}}"
                                                class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                            >
                                                <div class="flex items-center space-x-2">
                                                    <div
                                                        class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                                    ></div>
                                                    <span>Today's Pending EMI</span>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if(in_array('all',$userPermissions) || in_array('received-emi',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('receivedEmis')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Today's Received EMI</span>
                                        </div>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if(in_array('all',$userPermissions) || in_array('overdue-emi',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('overDueEmis')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Over Due EMI</span>
                                        </div>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if(in_array('all',$userPermissions) || in_array('closed-loan',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('closedLoans')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Closed Loan (NOC)</span>
                                        </div>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if(in_array('all',$userPermissions) || in_array('noc-customers',$userPermissions)){ ?>
                                {{-- <li>
                                    <a
                                        href="{{route('nocCustomers')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>NOC Customers</span>
                                        </div>
                                    </a>
                                </li> --}}
                                    <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>

                        <?php if(in_array('all',$userPermissions) || in_array('product-by-category-list',$userPermissions) || in_array('category-list',$userPermissions)){ ?>
                            <li x-data="accordionItem('menu-item-5')">
                            <a
                                :class="expanded && 'text-slate-800 font-semibold dark:text-navy-50'"
                                @click="expanded = !expanded"
                                class="flex items-center justify-between py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                href="javascript:void(0);"
                            >
                    <span class="mainli_menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive link-icon"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                    Product Management</span>
                                <svg
                                    :class="expanded && 'rotate-90'"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                    fill="none"
                                    viewbox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </a>
                            <ul x-collapse x-show="expanded">
                                <?php if(in_array('all',$userPermissions) || in_array('category-list',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('categoryList')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Manage Category</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                                    <?php if(in_array('all',$userPermissions) || in_array('product-by-category-list',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('productsByCategory')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Manage Products</span>
                                        </div>
                                    </a>
                                </li>
                                    <?php } ?>
                                <?php if(in_array('all',$userPermissions) || in_array('tenure-list',$userPermissions)){ ?>
                                <li>
                                    <a
                                        href="{{route('tenureList')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Manage Tenures</span>
                                        </div>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>

                    </ul>
                    <div class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>
                    <ul class="flex flex-1 flex-col px-4 font-inter">
                        <li x-data="accordionItem('menu-item-7')">
                            <a
                                :class="expanded && 'text-slate-800 font-semibold dark:text-navy-50'"
                                @click="expanded = !expanded"
                                class="flex items-center justify-between py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                href="javascript:void(0);"
                            >
                    <span class="mainli_menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout link-icon"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    System Algorithm </span>
                                <svg
                                    :class="expanded && 'rotate-90'"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                    fill="none"
                                    viewbox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </a>
                            <ul x-collapse x-show="expanded">
                                <li>
                                    <a
                                        href="javascript:;" onclick="wip();"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Credit Score</span>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li x-data="accordionItem('menu-item-8')">
                            <a
                                :class="expanded && 'text-slate-800 font-semibold dark:text-navy-50'"
                                @click="expanded = !expanded"
                                class="flex items-center justify-between py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                href="javascript:void(0);"
                            >
                    <span class="mainli_menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link link-icon"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                    Important Links</span>
                                <svg
                                    :class="expanded && 'rotate-90'"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                    fill="none"
                                    viewbox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </a>
                            <ul x-collapse x-show="expanded">
                                <li>
                                    <a
                                        href="{{route('techSupport')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Tech Support</span>
                                        </div>
                                    </a>
                                </li>
                                 <li>
                                    <a
                                        href="{{route('careerPosts')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Career Posts</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{route('privacyPolicy')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Privacy Policy</span>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a
                                        href="{{route('termsAndConditions')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Terms & Condition</span>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a
                                        href="{{route('faqList')}}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>FAQ</span>
                                        </div>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <li x-data="accordionItem('menu-item-9')">
                            <a
                                :class="expanded && 'text-slate-800 font-semibold dark:text-navy-50'"
                                @click="expanded = !expanded"
                                class="flex items-center justify-between py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                href="javascript:void(0);"
                            >
                    <span class="mainli_menu">
                     <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard link-icon"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                    Reports</span>
                                <svg
                                    :class="expanded && 'rotate-90'"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                    fill="none"
                                    viewbox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </a>

                            <ul x-collapse x-show="expanded">

                                {{-- <li>
                                    <a
                                        href="{{ route('customReports',['new-customers',urlencode('New customers lending')]) }}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>New customers lending</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('customReports',['approved-loans',urlencode('Approved customers')]) }}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Approved customers</span>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a
                                        href="{{ route('customReports',['disbursed-loans',urlencode('Disburse customers')]) }}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Disburse customers</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('customReports',['disbursement-pending',urlencode('Pending for disbursement')]) }}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Pending for disbursement</span>
                                        </div>
                                    </a>
                                </li> --}}
                                <li>
                                    <a
                                        href="{{ route('customReports',['over-due-payments',urlencode('Over due reports')]) }}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Over Due Report</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('customReports',['raw-over-due-payments',urlencode('Raw Over due reports')]) }}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Raw Over Due Report</span>
                                        </div>
                                    </a>
                                </li>

                                {{-- <li>
                                    <a
                                        href="{{ route('customReports',['received-payments',urlencode('Received Payments')]) }}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Received Payments</span>
                                        </div>
                                    </a>
                                </li> --}}
                                <li>
                                    <a
                                        href="{{ route('aumReports') }}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>AUM Report</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('paymentReports') }}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Payment Report</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('nextMonthEmiReports') }}"
                                        class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    >
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="h-1.5 w-1.5 rounded-full border border-current opacity-40"
                                            ></div>
                                            <span>Month EMI Report</span>
                                        </div>
                                    </a>
                                </li>


                            </ul>
                        </li>
                    </ul>
                </div>
                {{--
                <div class="fixed_illustrationsidebar">
                    <img class="illustration_vector" alt="avatar" src="{{asset('assets/admin')}}/images/sidebar-illustration.jpg">
                </div>
                --}}
            </div>
        </div>
    </div>

    <!-- App Header Wrapper-->
    <nav class="header print:hidden">
        <!-- App Header  -->
        <div
            class="header-container relative flex w-full bg-white dark:bg-navy-750 print:hidden"
        >
            <!-- Header Items -->
            <div class="flex w-full items-center justify-between">
                <!-- Left: Sidebar Toggle Button -->
                <div class="h-7 w-7 headerleft_menuwlogo">
                    <button
                        class="menu-toggle ml-0.5 flex h-7 w-7 flex-col justify-center space-y-1.5 text-primary outline-none focus:outline-none dark:text-accent-light/80"
                        :class="$store.global.isSidebarExpanded && 'active'"
                        @click="$store.global.isSidebarExpanded = !$store.global.isSidebarExpanded"
                    >
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <div class="logo_main">
                        <a href="{{route('adminDashboard')}}"> <img src="{{asset('assets/admin')}}/images/logos/maxemo-logo.png" alt=""></a>
                    </div>
                </div>



                <!-- Right: Header buttons -->
                <div class="-mr-1.5 flex items-center space-x-1">
                {{--
                <!-- Mobile Search Toggle -->
                <button
                    @click="$store.global.isSearchbarActive = !$store.global.isSearchbarActive"
                    class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:hidden"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5.5 w-5.5 text-slate-500 dark:text-navy-100"
                        fill="none"
                        viewbox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                </button>

                <!-- Main Searchbar -->
                <template x-if="$store.breakpoints.smAndUp">
                    <div
                        class="flex"
                        x-data="usePopper({placement:'bottom-end',offset:12})"
                        @click.outside="if(isShowPopper) isShowPopper = false"
                    >
                        <div class="relative mr-4 flex h-8">
                            <input
                                placeholder="Search here..."
                                class="form-input peer h-full rounded-full bg-slate-150 pl-9 text-xs+ text-slate-800 ring-primary/50 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:text-navy-100 dark:placeholder-navy-300 dark:ring-accent/50 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                                :class="isShowPopper ? 'w-80' : 'w-60' search_top"
                                @focus="isShowPopper= true"
                                type="text"
                                x-ref="popperRef"
                            />
                            <div
                                class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4.5 w-4.5 transition-colors duration-200"
                                    fill="currentColor"
                                    viewbox="0 0 24 24"
                                >
                                    <path
                                        d="M3.316 13.781l.73-.171-.73.171zm0-5.457l.73.171-.73-.171zm15.473 0l.73-.171-.73.171zm0 5.457l.73.171-.73-.171zm-5.008 5.008l-.171-.73.171.73zm-5.457 0l-.171.73.171-.73zm0-15.473l-.171-.73.171.73zm5.457 0l.171-.73-.171.73zM20.47 21.53a.75.75 0 101.06-1.06l-1.06 1.06zM4.046 13.61a11.198 11.198 0 010-5.115l-1.46-.342a12.698 12.698 0 000 5.8l1.46-.343zm14.013-5.115a11.196 11.196 0 010 5.115l1.46.342a12.698 12.698 0 000-5.8l-1.46.343zm-4.45 9.564a11.196 11.196 0 01-5.114 0l-.342 1.46c1.907.448 3.892.448 5.8 0l-.343-1.46zM8.496 4.046a11.198 11.198 0 015.115 0l.342-1.46a12.698 12.698 0 00-5.8 0l.343 1.46zm0 14.013a5.97 5.97 0 01-4.45-4.45l-1.46.343a7.47 7.47 0 005.568 5.568l.342-1.46zm5.457 1.46a7.47 7.47 0 005.568-5.567l-1.46-.342a5.97 5.97 0 01-4.45 4.45l.342 1.46zM13.61 4.046a5.97 5.97 0 014.45 4.45l1.46-.343a7.47 7.47 0 00-5.568-5.567l-.342 1.46zm-5.457-1.46a7.47 7.47 0 00-5.567 5.567l1.46.342a5.97 5.97 0 014.45-4.45l-.343-1.46zm8.652 15.28l3.665 3.664 1.06-1.06-3.665-3.665-1.06 1.06z"
                                    />
                                </svg>
                            </div>
                        </div>
                        <div
                            :class="isShowPopper && 'show'"
                            class="popper-root"
                            x-ref="popperRoot"
                        >
                            <div
                                class="popper-box flex max-h-[calc(100vh-6rem)] w-80 flex-col rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-800 dark:bg-navy-700 dark:shadow-soft-dark"
                            >


                                <div
                                    class="is-scrollbar-hidden overflow-y-auto overscroll-contain pb-2"
                                >


                                    <div
                                        class="mt-3 flex items-center justify-between bg-slate-100 py-1.5 px-3 dark:bg-navy-800"
                                    >
                                        <p
                                            class="text-xs uppercase text-slate-400 dark:text-navy-300"
                                        >
                                            Recent
                                        </p>
                                        <a
                                            href="#"
                                            class="text-tiny+ font-medium uppercase text-primary outline-none transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70"
                                        >
                                            View All
                                        </a>
                                    </div>

                                    <div class="mt-1 font-inter font-medium">
                                        <a
                                            class="group flex items-center space-x-2 px-2.5 py-2 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                            href="apps-chat.html"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                                                fill="none"
                                                viewbox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                                />
                                            </svg>
                                            <span>New customers</span>
                                        </a>
                                        <a
                                            class="group flex items-center space-x-2 px-2.5 py-2 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                            href="apps-filemanager.html"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                                                fill="none"
                                                viewbox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"
                                                />
                                            </svg>
                                            <span>loan</span>
                                        </a>
                                        <a
                                            class="group flex items-center space-x-2 px-2.5 py-2 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                                            href="apps-mail.html"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                                                fill="none"
                                                viewbox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                />
                                            </svg>
                                            <span>disbursed loan</span>
                                        </a>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            --}}
                    <!-- Dark Mode Toggle -->
                    <button
                        @click="$store.global.isDarkModeEnabled = !$store.global.isDarkModeEnabled"
                        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    >
                        <svg
                            x-show="$store.global.isDarkModeEnabled"
                            x-transition:enter="transition-transform duration-200 ease-out absolute origin-top"
                            x-transition:enter-start="scale-75"
                            x-transition:enter-end="scale-100 static"
                            class="h-6 w-6 text-amber-400"
                            fill="currentColor"
                            viewbox="0 0 24 24"
                        >
                            <path
                                d="M11.75 3.412a.818.818 0 01-.07.917 6.332 6.332 0 00-1.4 3.971c0 3.564 2.98 6.494 6.706 6.494a6.86 6.86 0 002.856-.617.818.818 0 011.1 1.047C19.593 18.614 16.218 21 12.283 21 7.18 21 3 16.973 3 11.956c0-4.563 3.46-8.31 7.925-8.948a.818.818 0 01.826.404z"
                            />
                        </svg>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            x-show="!$store.global.isDarkModeEnabled"
                            x-transition:enter="transition-transform duration-200 ease-out absolute origin-top"
                            x-transition:enter-start="scale-75"
                            x-transition:enter-end="scale-100 static"
                            class="h-6 w-6 text-amber-400"
                            viewbox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>

                    {{--
                    <!-- Notification-->
                    <div
                        x-effect="if($store.global.isSearchbarActive) isShowPopper = false"
                        x-data="usePopper({placement:'bottom-end',offset:12})"
                        @click.outside="if(isShowPopper) isShowPopper = false"
                        class="flex"
                    >
                        <button
                            @click="isShowPopper = !isShowPopper"
                            x-ref="popperRef"
                            class="btn relative h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-slate-500 dark:text-navy-100"
                                stroke="currentColor"
                                fill="none"
                                viewbox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M15.375 17.556h-6.75m6.75 0H21l-1.58-1.562a2.254 2.254 0 01-.67-1.596v-3.51a6.612 6.612 0 00-1.238-3.85 6.744 6.744 0 00-3.262-2.437v-.379c0-.59-.237-1.154-.659-1.571A2.265 2.265 0 0012 2c-.597 0-1.169.234-1.591.65a2.208 2.208 0 00-.659 1.572v.38c-2.621.915-4.5 3.385-4.5 6.287v3.51c0 .598-.24 1.172-.67 1.595L3 17.556h12.375zm0 0v1.11c0 .885-.356 1.733-.989 2.358A3.397 3.397 0 0112 22a3.397 3.397 0 01-2.386-.976 3.313 3.313 0 01-.989-2.357v-1.111h6.75z"
                                />
                            </svg>

                            <span
                                class="absolute -top-px -right-px flex h-3 w-3 items-center justify-center"
                            >
                    <span
                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-secondary opacity-80"
                    ></span>
                    <span
                        class="inline-flex h-2 w-2 rounded-full bg-secondary"
                    ></span>
                  </span>
                        </button>
                        <div
                            :class="isShowPopper && 'show'"
                            class="popper-root"
                            x-ref="popperRoot"
                        >
                            <div
                                x-data="{activeTab:'tabAll'}"
                                class="popper-box mx-4 mt-1 flex max-h-[calc(100vh-6rem)] w-[calc(100vw-2rem)] flex-col rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-800 dark:bg-navy-700 dark:shadow-soft-dark sm:m-0 sm:w-80"
                            >
                                <div
                                    class="rounded-t-lg bg-slate-100 text-slate-600 dark:bg-navy-800 dark:text-navy-200"
                                >
                                    <div class="flex items-center justify-between px-4 pt-2">
                                        <div class="flex items-center space-x-2">
                                            <h3
                                                class="font-medium text-slate-700 dark:text-navy-100"
                                            >
                                                Notifications
                                            </h3>
                                            <div
                                                class="badge h-5 rounded-full bg-primary/10 px-1.5 text-primary dark:bg-accent-light/15 dark:text-accent-light"
                                            >
                                                26
                                            </div>
                                        </div>

                                        <button
                                            class="btn  -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4.5 w-4.5"
                                                fill="none"
                                                viewbox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                            </svg>
                                        </button>
                                    </div>

                                    <div
                                        class="is-scrollbar-hidden flex shrink-0 overflow-x-auto px-3"
                                    >
                                        <button
                                            @click="activeTab = 'tabAll'"
                                            :class="activeTab === 'tabAll' ? 'border-primary noti_tabbtn dark:border-accent text-primary dark:text-accent-light' : 'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                            class="btn shrink-0 rounded-none border-b-2 px-3.5 py-2.5"
                                        >
                                            <span>All</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="tab-content flex flex-col overflow-hidden">
                                    <div
                                        x-show="activeTab === 'tabAll'"
                                        x-transition:enter="transition-all duration-300 easy-in-out"
                                        x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                        x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                        class="is-scrollbar-hidden space-y-4 overflow-y-auto px-4 py-4"
                                    >
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-secondary/10 dark:bg-secondary-light/15"
                                            >
                                                <i
                                                    class="fa fa-user-edit text-secondary dark:text-secondary-light"
                                                ></i>
                                            </div>
                                            <div>
                                                <p
                                                    class="font-medium text-slate-600 dark:text-navy-100"
                                                >
                                                    User Photo Changed
                                                </p>
                                                <div
                                                    class="mt-1 text-xs text-slate-400 line-clamp-1 dark:text-navy-300"
                                                >
                                                    John Doe changed his avatar photo
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-info/10 dark:bg-info/15"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 text-info"
                                                    fill="none"
                                                    viewbox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                    />
                                                </svg>
                                            </div>
                                            <div>
                                                <p
                                                    class="font-medium text-slate-600 dark:text-navy-100"
                                                >
                                                    Mon, June 14, 2021
                                                </p>
                                                <div
                                                    class="mt-1 flex text-xs text-slate-400 dark:text-navy-300"
                                                >
                                                    <span class="shrink-0">08:00 - 09:00</span>
                                                    <div
                                                        class="mx-2 my-1 w-px bg-slate-200 dark:bg-navy-500"
                                                    ></div>

                                                    <span class="line-clamp-1">Frontend Conf</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary/10 dark:bg-accent-light/15"
                                            >
                                                <i
                                                    class="fa-solid fa-image text-primary dark:text-accent-light"
                                                ></i>
                                            </div>
                                            <div>
                                                <p
                                                    class="font-medium text-slate-600 dark:text-navy-100"
                                                >
                                                    Images Added
                                                </p>
                                                <div
                                                    class="mt-1 text-xs text-slate-400 line-clamp-1 dark:text-navy-300"
                                                >
                                                    Mores Clarke added new image gallery
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-success/10 dark:bg-success/15"
                                            >
                                                <i class="fa fa-leaf text-success"></i>
                                            </div>
                                            <div>
                                                <p
                                                    class="font-medium text-slate-600 dark:text-navy-100"
                                                >
                                                    Design Completed
                                                </p>
                                                <div
                                                    class="mt-1 text-xs text-slate-400 line-clamp-1 dark:text-navy-300"
                                                >
                                                    Robert Nolan completed the design of the CRM
                                                    application
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-info/10 dark:bg-info/15"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 text-info"
                                                    fill="none"
                                                    viewbox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                    />
                                                </svg>
                                            </div>
                                            <div>
                                                <p
                                                    class="font-medium text-slate-600 dark:text-navy-100"
                                                >
                                                    Wed, June 21, 2021
                                                </p>
                                                <div
                                                    class="mt-1 flex text-xs text-slate-400 dark:text-navy-300"
                                                >
                                                    <span class="shrink-0">16:00 - 20:00</span>
                                                    <div
                                                        class="mx-2 my-1 w-px bg-slate-200 dark:bg-navy-500"
                                                    ></div>

                                                    <span class="line-clamp-1">UI/UX Conf</span>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}

                    @php
                        if(auth()->user()->profilePic){
                            $profilePic=env('APP_URL').'public/'.auth()->user()->profilePic;
                        }else{
                            $profilePic='https://media.istockphoto.com/vectors/male-face-silhouette-or-icon-man-avatar-profile-unknown-or-anonymous-vector-id1087531642?k=20&m=1087531642&s=612x612&w=0&h=D6OBNUY7ZxQTAHNVtL9mm2wbHb_dP6ogIsCCWCqiYQg=';
                        }
                    @endphp

                    <div
                        x-data="usePopper({placement:'bottom-end',offset:12})"
                        @click.outside="if(isShowPopper) isShowPopper = false"
                        class="flex"
                    >
                        <button
                            @click="isShowPopper = !isShowPopper"
                            x-ref="popperRef"
                            class="avatar h-10 w-10 top_profileicon"
                        >
                            <img
                                class="rounded-full"
                                src="{{$profilePic}}"
                                alt="avatar"
                            />
                            <span
                                class="absolute right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-success dark:border-navy-700"
                            ></span>
                        </button>

                        <div
                            :class="isShowPopper && 'show'"
                            class="popper-root fixed"
                            x-ref="popperRoot"
                        >
                            <div
                                class="popper-box w-64 rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-600 dark:bg-navy-700"
                            >
                                <div
                                    class="flex items-center space-x-4 rounded-t-lg bg-slate-100 profile_picbox dark:bg-navy-800"
                                >
                                    <div class="avatar h-14 w-14">
                                        <img
                                            class="rounded-full"
                                            src="{{$profilePic}}"
                                            alt="avatar"
                                        />
                                    </div>
                                    <div>
                                        <a
                                            href="javascript:;"
                                            class="text-base font-medium text-slate-700 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light"
                                        >
                                            {{auth()->user()->name}}
                                        </a>
                                        <p class="text-xs text-slate-400 dark:text-navy-300">
                                            {{auth()->user()->email}}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col pt-2 pb-5">
                                    <a
                                        href="{{route('sysUserProfile',auth()->user()->id)}}"
                                        class="group flex items-center space-x-3 py-2 px-4 tracking-wide outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
                                    >
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-warning text-white"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4.5 w-4.5"
                                                fill="none"
                                                viewbox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                />
                                            </svg>
                                        </div>

                                        <div>
                                            <h2
                                                class="font-medium text-slate-700 transition-colors group-hover:text-primary group-focus:text-primary dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light"
                                            >
                                                Profile
                                            </h2>
                                            <div
                                                class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300"
                                            >
                                                View profile
                                            </div>
                                        </div>
                                    </a>

                                    <div class="mt-3 px-4">
                                        <button
                                            class="btn h-9 w-full space-x-2 bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                fill="none"
                                                viewbox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                                />
                                            </svg>
                                            <a href="{{route('adminLogout')}}" class="pro_logoutbtgf"> <span>Logout</span></a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Searchbar -->
    <div
        x-show="$store.breakpoints.isXs && $store.global.isSearchbarActive"
        x-transition:enter="easy-out transition-all"
        x-transition:enter-start="opacity-0 scale-105"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="easy-in transition-all"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-[100] flex flex-col bg-white dark:bg-navy-700 sm:hidden"
    >
        <div
            class="flex items-center space-x-2 bg-slate-100 px-3 pt-2 dark:bg-navy-800"
        >
            <button
                class="btn -ml-1.5 h-7 w-7 shrink-0 rounded-full p-0 text-slate-600 hover:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-100 dark:hover:bg-navy-300/20 dark:active:bg-navy-300/25"
                @click="$store.global.isSearchbarActive = false"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    stroke-width="1.5"
                    viewbox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </button>
            <input
                x-effect="$store.global.isSearchbarActive && $nextTick(() => $el.focus() );"
                class="form-input h-8 w-full bg-transparent placeholder-slate-400 dark:placeholder-navy-300"
                type="text"
                placeholder="Search here..."
            />
        </div>



        <div
            class="is-scrollbar-hidden overflow-y-auto overscroll-contain pb-2"
        >

            <div
                class="mt-3 flex items-center justify-between bg-slate-100 py-1.5 px-3 dark:bg-navy-800"
            >
                <p class="text-xs uppercase text-slate-400 dark:text-navy-300">
                    Recent
                </p>
                <a
                    href="#"
                    class="text-tiny+ font-medium uppercase text-primary outline-none transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70"
                >
                    View All
                </a>
            </div>

            <div class="mt-1 font-inter font-medium">
                <a
                    class="group flex items-center space-x-2 px-2.5 py-2 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                    href="apps-chat.html"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                        fill="none"
                        viewbox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                        />
                    </svg>
                    <span>New customers</span>
                </a>
                <a
                    class="group flex items-center space-x-2 px-2.5 py-2 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                    href="apps-filemanager.html"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                        fill="none"
                        viewbox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"
                        />
                    </svg>
                    <span>Rejected customers</span>
                </a>
                <a
                    class="group flex items-center space-x-2 px-2.5 py-2 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                    href="apps-mail.html"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                        fill="none"
                        viewbox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        />
                    </svg>
                    <span>car loan</span>
                </a>


            </div>
        </div>
    </div>


    <div id="content" class="main-content w-full pb-8">
        @yield('content')
    </div>
    <div id="x-teleport-target"></div>
    
     <!-- Emi details Modal start-->
    <div class="modal fade" id="emiDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                        Loan EMI Details
                    </h3>
                    <button data-bs-dismiss="modal" aria-label="Close" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="form_boxmodal">

                    <div class="form-wizard" id="emiDetailsHtml">
                    </div>
                    <!-- wizard end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Emi details  modal end -->
    
    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>

    <script src="{{asset('assets/admin')}}/js/bootstrap.min.js"></script>

    <!-- drag and drop custom file upload -->
    <script src="{{asset('assets/admin')}}/js/jquery.js"></script>
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var htmlPreview =
                        '<img width="200" src="' + e.target.result + '" />' +
                        '<p>' + input.files[0].name + '</p>';
                    var wrapperZone = $(input).parent();
                    var previewZone = $(input).parent().parent().find('.preview-zone');
                    var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

                    wrapperZone.removeClass('dragover');
                    previewZone.removeClass('hidden');
                    boxZone.empty();
                    boxZone.append(htmlPreview);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function reset(e) {
            e.wrap('<form>').closest('form').get(0).reset();
            e.unwrap();
        }

        $(".dropzone").change(function() {
            readFile(this);
        });

        $('.dropzone-wrapper').on('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('dragover');
        });

        $('.dropzone-wrapper').on('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
        });

        $('.remove-preview').on('click', function() {
            var boxZone = $(this).parents('.preview-zone').find('.box-body');
            var previewZone = $(this).parents('.preview-zone');
            var dropzone = $(this).parents('.form-group').find('.dropzone');
            boxZone.empty();
            previewZone.addClass('hidden');
            reset(dropzone);
        });

    </script>

    <!-- data table js -->
    <!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
    <script src="{{asset('assets/admin')}}/js/datatables.js"></script>

    <script>
        $(function () {
            $('.is-hoverable').DataTable();
        });
    </script>

    <script>
        $(function () {
            $('table').addClass('table-bordered');
        });
    </script>
    <!-- delete modal -->


    <script>
        var totalSteps = $(".steps li").length;

        $(".submit").on("click", function(){
            return false;
        });

        $(".steps li:nth-of-type(1)").addClass("active");
        $(".myContainer .form-container:nth-of-type(1)").addClass("active");

        $(".form-container").on("click", ".next", function() {
            $(".steps li").eq($(this).parents(".form-container").index() + 1).addClass("active");
            $(this).parents(".form-container").removeClass("active").next().addClass("active flipInX");
        });

        $(".form-container").on("click", ".back", function() {
            $(".steps li").eq($(this).parents(".form-container").index() - totalSteps).removeClass("active");
            $(this).parents(".form-container").removeClass("active flipInX").prev().addClass("active flipInY");
        });


        /*=========================================================
        *     If you won't to make steps clickable, Please comment below code
        =================================================================*/
        $(".steps li").on("click", function() {
            var stepVal = $(this).find("span").text();
            $(this).prevAll().addClass("active");
            $(this).addClass("active");
            $(this).nextAll().removeClass("active");
            $(".myContainer .form-container").removeClass("active flipInX");
            $(".myContainer .form-container:nth-of-type("+ stepVal +")").addClass("active flipInX");
        });
    </script>
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

        function isNumber(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
        
        function calcNetDisburseAmount()
        {
            var approvedAmount= parseFloat($('#approvedAmount').val());
            var plateformFee=parseFloat($('#plateformFee').val());
            var insurance=parseFloat($('#insurance').val());
            //var netDisbursementAmount=parseFloat(approvedAmount-plateformFee-insurance).toFixed(2);
            var netDisbursementAmount=parseFloat(approvedAmount).toFixed(2);
            $('#netDisbursementAmount').val(netDisbursementAmount);
        }
        
        function getLoanEmiDetails(loanId)
        {
            $.post('{{route('getLoanEmiDetails')}}',{
                "_token": "{{ csrf_token() }}",
                loanId:loanId,
            },function (data){
                var obj = JSON.parse(data);
                if(obj.status=='error')
                {
                    alertMessage('Error!', obj.message, 'error', 'no');
                    return false;
                }else{
                    $('#emiDetailsHtml').html(obj.data);
                    console.log(obj.payOutStandingTxnDateMaxDate);
                    $("#payOutStandingTxnDate" ).datepicker({changeYear:true,changeMonth:true,minDate:0});
                    $('#emiDetails').modal('show');
                }
            });
        }

        function getPaybleAmountBulletRepayment(loanId)
        {
            var bullet_repaymentLoanId=$('#bullet_repaymentLoanId').val();
            var bullet_repaymentCollectDate=$('#bullet_repaymentCollectDate').val();
            if(!parseInt(bullet_repaymentLoanId))
            {
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!bullet_repaymentCollectDate)
            {
                alertMessage('Error!', 'Please select collection date.', 'error', 'no');
                return false;
            }else{
                $.post('{{route('getPaybleAmountBulletRepayment')}}',{
                    "_token": "{{ csrf_token() }}",
                    loanId:bullet_repaymentLoanId,
                    bullet_repaymentCollectDate:bullet_repaymentCollectDate,
                },function (data){
                    var obj = JSON.parse(data);
                    if(obj.status=='success')
                    {
                        $('.bullet_repaymentHtml').show();
                        $('#bullet_repaymentPaybleAmount').val(obj.totalPaybleAmount);
                        $('#bullet_repaymentTotalInterest').val(obj.totalInterest);
                        $('#bullet_repaymentInterestDays').val(obj.tenureInDays);
                        $('#bullet_repaymentTXNID').val('');
                        $('#bullet_repaymentPaymentMethod').val('');
                        $('#bullet_repaymentCollectDate').attr('disabled','disabled');
                        $('#bullet_repaymentSetButton').attr('onclick','sattleBulletRepaymentTxn();');
                        $('#bullet_repaymentSetButton').text('Sattle Loan');
                    }else{                        
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }

        function sattleBulletRepaymentTxn()
        {
            var bullet_repaymentLoanId=$('#bullet_repaymentLoanId').val();
            var bullet_repaymentCollectDate=$('#bullet_repaymentCollectDate').val();
            var bullet_repaymentPaymentMethod=$('#bullet_repaymentPaymentMethod').val();
            var bullet_repaymentTXNID=$('#bullet_repaymentTXNID').val();

            if(!parseInt(bullet_repaymentLoanId) || !bullet_repaymentCollectDate)
            {
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else if(!bullet_repaymentCollectDate)
            {
                alertMessage('Error!', 'Please select collection date.', 'error', 'no');
                return false;
            }else if(!bullet_repaymentPaymentMethod)
            {
                alertMessage('Error!', 'Please enter the payment method.', 'error', 'no');
                return false;
            }else if(!bullet_repaymentTXNID)
            {
                alertMessage('Error!', 'Please enter the transaction id.', 'error', 'no');
                return false;
            }else{

                swal({
                    title: 'Warning!',
                    text: 'Are you sure want to sattle this loan?',
                    icon: 'warning',
                    buttons:true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        waitForProcess();
                        $.post('{{route('sattleBulletRepaymentTxn')}}',{
                            "_token": "{{ csrf_token() }}",
                            loanId:bullet_repaymentLoanId,
                            bullet_repaymentCollectDate:bullet_repaymentCollectDate,
                            transactionId:bullet_repaymentTXNID,
                            payment_mode:bullet_repaymentPaymentMethod,
                        },function (data){
                            var obj = JSON.parse(data);
                            if(obj.status=='success')
                            {
                                $('#emiDetails').modal('hide');
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
        }

        function closeLoanAllTime(loanId){

            const { value: date } = swal({
                title: "Close This Loan",
                text: "Are you sure you want to close this loan.",
                content: {
                    element: "input",
                    attributes: {
                    placeholder: "Loan close date",
                    type: "date",
                    required:true
                    },
                },
                icon: "warning",
            }).then((value) => {
                if (value) {
                    $.post('{{route('closeLoanAllTime')}}',{
                        "_token": "{{ csrf_token() }}",
                        loanId:loanId,
                        closed_date:value
                    },function (data){
                        var obj = JSON.parse(data);
                        if(obj.status=='error')
                        {
                            alertMessage('Error!', obj.message, 'error', 'no');
                            return false;
                        }else{
                            alertMessage('Success !', obj.message, 'success', 'yes');
                           setTimeout(() => {
                               location.reload();
                           }, 4000);
                        }
                    });
                }else{
                    alertMessage('Error!', 'Please select loan close date.', 'error', 'no');
                }
            });

            
        }
        
        function showCLoserCharges(value)
        {
            $(".closercharge").hide();
            $("."+value).show();
            $('.closerchargeOther').show();
        }
        
        function showCloserTypeHtml()
        {
            $(".closeTypeHtml").show();
        }
        
        function cancelCloseThisLoan(loanId)
        {
            $(".closercharge").hide();
            $('.closerchargeOther').hide();
            $(".closeTypeHtml").hide();
        }
        
        function closeThisLoan(loanId,userId)
        {
            var totalCalcStr=$('#totalCalcStr').val();
            var totalCalcStrWc=$('#totalCalcStrWc').val();
            var closerPayMode=$('#closerPayMode').val();
            var closerTxnId=$('#closerTxnId').val();
            var closerRemark=$('#closerRemark').val();
            var transactionDate=$('#closingTransactionDate').val();
            var closeType=$('input[name="closeType"]:checked').val()
            if(!$.trim(closerPayMode)){
                alertMessage('Error!', 'Please enter payment mode.', 'error', 'no');
                return false;
            }if(!$.trim(closeType)){
                alertMessage('Error!', 'Please select close type.', 'error', 'no');
                return false;
            }else if(!$.trim(transactionDate)){
                alertMessage('Error!', 'Please select closing date.', 'error', 'no');
                return false;
            }else if(!$.trim(closerTxnId)){
                alertMessage('Error!', 'Please enter transaction Id.', 'error', 'no');
                return false;
            }else if(!$.trim(closerRemark)){
                alertMessage('Error!', 'Please enter remark.', 'error', 'no');
                return false;
            }else if(!$.trim(totalCalcStr) || !$.trim(totalCalcStrWc)){
                alertMessage('Error!', 'Invalid Request, Please try again.', 'error', 'no');
                return false;
            }else{
                waitForProcess();
                $.post('{{route('markLoanAsClosedOnPreCloser')}}',{
                    "_token": "{{ csrf_token() }}",
                    loanId:loanId,
                    userId:userId,
                    totalCalcStr:totalCalcStr,
                    totalCalcStrWc:totalCalcStrWc,
                    closerPayMode:closerPayMode,
                    closerTxnId:closerTxnId,
                    closerRemark:closerRemark,
                    closeType:closeType,
                    transactionDate:transactionDate,
                },function (data){
                    var obj = JSON.parse(data);
                    if(obj.status=='success')
                    {
                        $('#emiDetails').modal('hide');
                        alertMessage('Success!', obj.message, 'success', 'yes');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }
    </script>
@yield('scripts')

</body>
</html>


