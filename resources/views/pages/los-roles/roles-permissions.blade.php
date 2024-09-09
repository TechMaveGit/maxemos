@extends('layout.master')

@section('content')
    <main>
        <div class="breadcrums_area breadcrums">

            <div class="common_pagetitle">{{(strlen($pageTitle)>25) ? substr($pageTitle,0,25).'...' : ''}}</div>

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
                    <li>{{(strlen($pageTitle)>25) ? substr($pageTitle,0,25).'...' : ''}}</li>
                </ul>
            </div>
        </div>

        <div class="main_page_title">
            <div class="common_pagetitlebig">{{$pageTitle}}</div>
        </div>


        <div class="table_mainstart" id="sc_table">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">

                        <div class="card mt-3 roles_tablecard">
                            <div class="is-scrollbar-hidden min-w-full overflow-x-auto"
                                 x-data="pages.tables.initExample1" >
                                <div class="row" style="margin: 10px;background: #455298 !important;border-radius: 10px;color: #fff;text-align: center;">
                                    <h2 style="font-size: 24px;font-weight: bolder;padding: 10px;">Customer Management</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">1. New Customers</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="newcustomers" id="newcustomers" {{(in_array('newcustomers',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="newcustomers">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="add-customers" id="add-customers" {{(in_array('add-customers',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="add-customers">Add</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="edit-customers" id="edit-customers" {{(in_array('edit-customers',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="edit-customers">Edit</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="approverejectkyc" id="approverejectkyc" {{(in_array('approverejectkyc',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="approverejectkyc">Approve/Reject Business Verification</label>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">2. Rejected Customers</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="rejectedcustomers" id="rejectedcustomers" {{(in_array('rejectedcustomers',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="rejectedcustomers">View List</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">3. Business Verification Customers</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="kycverifiedcustomers" id="kycverifiedcustomers" {{(in_array('kycverifiedcustomers',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="kycverifiedcustomers">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="approve-reject-employment" id="approve-reject-employment" {{(in_array('approve-reject-employment',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="approve-reject-employment">Approve/Reject For Credit Assessment</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">4. Business Verification Rejected</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="employment-verification-rejected" id="employment-verification-rejected" {{(in_array('employment-verification-rejected',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="employment-verification-rejected">View List</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">5. Credit Assessment Status</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="credit-assessment-status-list" id="credit-assessment-status-list" {{(in_array('credit-assessment-status-list',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="credit-assessment-status-list">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="send-for-admin-approval" id="send-for-admin-approval" {{(in_array('send-for-admin-approval',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="send-for-admin-approval">Send For Admin Approval</label>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">6. Final Credit Assessment Status</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="final-credit-assessment-status-list" id="final-credit-assessment-status-list" {{(in_array('final-credit-assessment-status-list',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="final-credit-assessment-status-list">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="send-for-customer-assessment" id="send-for-customer-assessment" {{(in_array('send-for-customer-assessment',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="send-for-customer-assessment">Send For Customer Consent</label>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">7. Customer Approval Pending</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="customer-approval-pending" id="customer-approval-pending" {{(in_array('customer-approval-pending',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="customer-approval-pending">View List</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">8. Customer Approval Rejected</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="customer-approval-rejected" id="customer-approval-rejected" {{(in_array('customer-approval-rejected',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="customer-approval-rejected">View List</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">9. Disbursement Approval</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="finalapprovalfordisbursement" id="finalapprovalfordisbursement" {{(in_array('finalapprovalfordisbursement',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="finalapprovalfordisbursement">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="schedule-disbursement" id="schedule-disbursement" {{(in_array('schedule-disbursement',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="schedule-disbursement">Schedule Disbursement</label>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row" style="margin: 10px;background: #455298 !important;border-radius: 10px;color: #fff;text-align: center;">
                                    <h2 style="font-size: 24px;font-weight: bolder;padding: 10px;">Loan Management</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">1. Current Disbursement Pipeline</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="today-disbursement" id="today-disbursement" {{(in_array('today-disbursement',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="today-disbursement">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="loan-disburse" id="loan-disburse" {{(in_array('loan-disburse',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="loan-disburse">Loan Disburse</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>


                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">2. Pending Disbursement</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">

                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="pending-disbursement" id="pending-disbursement" {{(in_array('pending-disbursement',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="pending-disbursement">View List</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">3. Disbursed Loan List</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="disbursed-loan-list" id="disbursed-loan-list" {{(in_array('disbursed-loan-list',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="disbursed-loan-list">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="view-emi-details" id="view-emi-details" {{(in_array('view-emi-details',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="view-emi-details">View EMI Details</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">4. Raw Material Loan</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="rawmaterial-loan-list" id="rawmaterial-loan-list" {{(in_array('rawmaterial-loan-list',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="rawmaterial-loan-list">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="rawmaterial-disburse-amount" id="rawmaterial-disburse-amount" {{(in_array('rawmaterial-disburse-amount',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="rawmaterial-disburse-amount">Disburse Amount</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="rawmaterial-collect-amount" id="rawmaterial-collect-amount" {{(in_array('rawmaterial-collect-amount',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="rawmaterial-collect-amount">Collect Amount</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="row" style="margin: 10px;background: #455298 !important;border-radius: 10px;color: #fff;text-align: center;">
                                    <h2 style="font-size: 24px;font-weight: bolder;padding: 10px;">Collection Management</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">1. Customers EMI</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="customer-emi" id="customer-emi" {{(in_array('customer-emi',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="customer-emi">View List</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>


                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">2. Received EMI</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="received-emi" id="received-emi" {{(in_array('received-emi',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="received-emi">View List</label>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">3. Today's EMI</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="todays-emi" id="todays-emi" {{(in_array('todays-emi',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="todays-emi">View List</label>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">4. Over Due EMI</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">

                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="overdue-emi" id="overdue-emi" {{(in_array('overdue-emi',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="overdue-emi">View List</label>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">5. Closed Loan</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="closed-loan" id="closed-loan" {{(in_array('closed-loan',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="closed-loan">View List</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">6. NOC Customers</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="noc-customers" id="noc-customers" {{(in_array('noc-customers',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="noc-customers">View List</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row" style="margin: 10px;background: #455298 !important;border-radius: 10px;color: #fff;text-align: center;">
                                    <h2 style="font-size: 24px;font-weight: bolder;padding: 10px;">System User Management</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">1. Roles</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="view-roles" id="view-roles" {{(in_array('view-roles',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="view-roles">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="add-role" id="add-role" {{(in_array('add-role',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="add-role">Add  </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="edit-role" id="edit-role" {{(in_array('edit-role',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="edit-role">Edit  </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="change-permissions" id="change-permissions" {{(in_array('change-permissions',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="change-permissions">Change Permissions  </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="delete-roles" id="delete-roles" {{(in_array('delete-roles',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="delete-roles">Delete Role  </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>


                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">2. Users</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="view-sys-user" id="view-sys-user" {{(in_array('view-sys-user',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="view-sys-user">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="add-sys-user" id="add-sys-user" {{(in_array('add-sys-user',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="add-sys-user">Add  </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="edit-sys-user" id="edit-sys-user" {{(in_array('edit-sys-user',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="edit-sys-user">Edit  </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="delete-sys-user" id="delete-sys-user" {{(in_array('delete-sys-user',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="delete-sys-user">Delete User  </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row" style="margin: 10px;background: #455298 !important;border-radius: 10px;color: #fff;text-align: center;">
                                    <h2 style="font-size: 24px;font-weight: bolder;padding: 10px;">Product Management</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">1. Manage Product</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="product-by-category-list" id="product-by-category-list" {{(in_array('product-by-category-list',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="product-by-category-list">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="add-product-by-category" id="add-product-by-category" {{(in_array('add-product-by-category',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="add-product-by-category">Add  </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="edit-product-by-category" id="edit-product-by-category" {{(in_array('edit-product-by-category',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="edit-product-by-category">Edit  </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="product-activation" id="product-activation" {{(in_array('product-activation',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="product-activation">Active / Deactive  </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>


                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">2. Manage Category</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="category-list" id="category-list" {{(in_array('category-list',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="category-list">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="add-category" id="add-category" {{(in_array('add-category',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="add-category">Add  </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="edit-category" id="edit-category" {{(in_array('edit-category',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="edit-category">Edit  </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="category-activation" id="category-activation" {{(in_array('category-activation',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="category-activation">Active / Deactive  </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 mt-3 mb-2">
                                        <table class="is-hoverable w-full text-left">

                                            <tbody id="roles_data">
                                            <tr class="dtrg-group dtrg-start dtrg-level-0">
                                                <td colspan="7">3. Manage Tenure</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <ul class="role_list">
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="tenure-list" id="tenure-list" {{(in_array('tenure-list',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="tenure-list">View List</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="add-tenure" id="add-tenure" {{(in_array('add-tenure',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="add-tenure">Add  </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check mb-3">
                                                                <input type="checkbox" name="permissionchk[]" class="form-check-input permissionschk" value="edit-tenure" id="edit-tenure" {{(in_array('edit-tenure',$userPermissionsArr)) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="edit-tenure">Edit  </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-9">&nbsp;</div>
                                    <div class="col-md-3">
                                        <button type="button" onclick="updateRolesPermissions()" class="btn btn-primary btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90 mb-5" >Update Permissions</button>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- table end -->
        </section>
    </main>

@endsection
@section('scripts')
    <script>
        function updateRolesPermissions()
        {
            var userPermissions = $('input[name="permissionchk[]"]:checked')
                .map(function(){return $(this).val();}).get();
            if(!userPermissions.length)
            {
                alertMessage('Error!', 'Please choose atleast one permission', 'error', 'no');
                return false;
            }else{
                waitForProcess();
                $.post('{{route('updateRolesPermissions')}}',{
                    "_token": "{{ csrf_token() }}",
                    permissionTo:'{{$permissionTo}}',
                    userId:'{{$roleId}}',
                    userPermissions:userPermissions,
                },function (data){
                    var obj = JSON.parse(data);
                    if(obj.status=='success')
                    {
                        alertMessage('Success!', obj.message, 'success', 'no');
                        return false;
                    }else{
                        alertMessage('Error!', obj.message, 'error', 'no');
                        return false;
                    }
                });
            }
        }
    </script>
@endsection
