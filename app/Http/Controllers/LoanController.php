<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class LoanController extends Controller
{

    public function allLoanList()
    {
      $pageTitle='All Loan List';
      $pageNameStr='all-loan-list';

      return view('pages.loan-management.to-be-disburse',compact('pageTitle','pageNameStr'));
    }


    public function kycRejectedUsers()
    {
        $pageTitle='Rejected Customers ';
        $pageNameStr='rejected-customers';
        return view('pages.customers.customers-list',compact('pageTitle','pageNameStr'));
    }

    public function kycApprovedUsers()
    {

        $pageTitle='Credit Assessment Status';
        $pageNameStr='kyc-verified-customers';
        return view('pages.customers.customers-list',compact('pageTitle','pageNameStr'));
    }

    public function finalKycApprovedUsers()
    {

        $pageTitle='Final Credit Assessment Status';
        $pageNameStr='final-credit-assessment';
        return view('pages.customers.customers-list',compact('pageTitle','pageNameStr'));
    }

    public function employmentVerification()
    {
        $pageTitle='Business Verifications Customers';
        $pageNameStr='employment-verification';
        return view('pages.customers.customers-list',compact('pageTitle','pageNameStr'));
    }

    public function employmentVerificationRejected()
    {
        $pageTitle='Business Rejected Customers';
        $pageNameStr='employment-verification-rejected';
        return view('pages.customers.customers-list',compact('pageTitle','pageNameStr'));
    }

    public function finalDisbursementUsers()
    {
        $pageTitle='Final Approval For Disbursement Customers List';
        $pageNameStr='final-approval-for-disbursement';
        
        return view('pages.customers.customers-list',compact('pageTitle','pageNameStr'));
    }

    public function disbursementPendingUsers()
    {
        $pageTitle='Disbursement Pending Customers List';
        $pageNameStr='disbursement-pending-list';
        return view('pages.customers.customers-list',compact('pageTitle','pageNameStr'));
    }

    public function disbursementRejectedUsers()
    {
        $pageTitle='Disbursement Rejected Customers List';
        $pageNameStr='disbursement-rejected-list';
        return view('pages.customers.customers-list',compact('pageTitle','pageNameStr'));
    }

    
}