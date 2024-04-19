@extends('layout.master')
@section('content')
    <!-- Main Content Wrapper -->

    <style>
        .dash_tablecst{
            padding:20px;
        }
        .dashchart{
            width: 700px !important;
height: auto  !important;
        }
        .mainchartbox{
            background: #fff;
padding: 20px;
border-radius: 5px;
width:100% !important;
border: 1px solid rgba(0,0,0,.125);
        }
        .dashchart_heading{
            padding-bottom:20px;
            font-weight: bold;
font-size: 16px;
        }
        
        #myUL{
            position: absolute; 
            top: 33px; 
            right: 6px;
            width: 24.7%; 
            margin: 4px;
        }
        #myUL li{
            background: #e9eef5;
            padding: 10px;
            border: 1px solid #fefeff;
        }
        #closeSerbtn{
            position: absolute;
            right: 18px;
            top: 8px;
            border-radius: 50%;
            background: #ddd;
            padding: 4px 6px;
            font-size: 12px;
        }
    </style>
    <main >
        <div
            class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6"
        >
            <div class="col-span-12 lg:col-span-12">

                <!-- cards -->
                <div class="row rp_topcard" id="notp__margins">
<div class="col-12 mb-3" style="position: relative;" >
                        <input type="text" id="myInput" class="form-control" style="width: 25%;float: right;border-radius: 0;"   onkeyup="searchUserList()" placeholder="Search By Name Or Id ..." title="Type in a name">
                        <i class="fa fa-times" onclick="removeSearchData()" id="closeSerbtn"></i>
                        <ul id="myUL" >
                            @if ($alluserlist)
                            @foreach ($alluserlist as $ulist)
                                <li><a  data-cusCode="{{$ulist->customerCode}}" data-companyname="{{ $ulist->employerName }}" data-uname="{{ $ulist->name }}" href="{{ url('admin/profile/customers-list/'.$ulist->id) }}">{{$ulist->customerCode}} ({{ $ulist->name }}) <br>Company : {{ $ulist->employerName }}</a></li>
                            @endforeach
                            @endif
                          
                        </ul>
                        <script>
                            $("#closeSerbtn").hide();
                            $("#myUL").hide();
                        </script>
                    </div>
                    <div class="col-lg-3" style="cursor: pointer;" onclick="location.href='{{route('allcustomer')}}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$totalUserRegistered}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#00ADA3"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM40.0033 19.1441L49.272 35.6798L40.8133 30.973C40.3083 30.693 39.6966 30.693 39.1916 30.973L30.7329 35.6798L40.0033 19.1441ZM40.0033 60.8509L30.7329 44.3152L39.1916 49.022C39.4433 49.162 39.7233 49.232 40.0016 49.232C40.28 49.232 40.56 49.162 40.8117 49.022L49.2703 44.3152L40.0033 60.8509ZM40.0033 45.6569L29.8296 39.9967L40.0033 34.3364L50.1754 39.9967L40.0033 45.6569Z" fill="#00ADA3"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Total Customers</p>
                        </div>
                    </div>
                    <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{route('customerList')}}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$newUserCount}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#00ADA3"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM40.0033 19.1441L49.272 35.6798L40.8133 30.973C40.3083 30.693 39.6966 30.693 39.1916 30.973L30.7329 35.6798L40.0033 19.1441ZM40.0033 60.8509L30.7329 44.3152L39.1916 49.022C39.4433 49.162 39.7233 49.232 40.0016 49.232C40.28 49.232 40.56 49.162 40.8117 49.022L49.2703 44.3152L40.0033 60.8509ZM40.0033 45.6569L29.8296 39.9967L40.0033 34.3364L50.1754 39.9967L40.0033 45.6569Z" fill="#00ADA3"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">New Customers</p>
                        </div>
                    </div>
                    <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{route('employmentVerification')}}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$employment_verification}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#00ADA3"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM40.0033 19.1441L49.272 35.6798L40.8133 30.973C40.3083 30.693 39.6966 30.693 39.1916 30.973L30.7329 35.6798L40.0033 19.1441ZM40.0033 60.8509L30.7329 44.3152L39.1916 49.022C39.4433 49.162 39.7233 49.232 40.0016 49.232C40.28 49.232 40.56 49.162 40.8117 49.022L49.2703 44.3152L40.0033 60.8509ZM40.0033 45.6569L29.8296 39.9967L40.0033 34.3364L50.1754 39.9967L40.0033 45.6569Z" fill="#00ADA3"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Verified Business/Company</p>
                        </div>
                    </div>

                    <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{route('kycApprovedUsers')}}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$kyc_verified_customers}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#00ADA3"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM40.0033 19.1441L49.272 35.6798L40.8133 30.973C40.3083 30.693 39.6966 30.693 39.1916 30.973L30.7329 35.6798L40.0033 19.1441ZM40.0033 60.8509L30.7329 44.3152L39.1916 49.022C39.4433 49.162 39.7233 49.232 40.0016 49.232C40.28 49.232 40.56 49.162 40.8117 49.022L49.2703 44.3152L40.0033 60.8509ZM40.0033 45.6569L29.8296 39.9967L40.0033 34.3364L50.1754 39.9967L40.0033 45.6569Z" fill="#00ADA3"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Credit Assessment Status</p>
                        </div>
                    </div>

                    <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{route('finalKycApprovedUsers')}}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$final_credit_assessment}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#00ADA3"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM40.0033 19.1441L49.272 35.6798L40.8133 30.973C40.3083 30.693 39.6966 30.693 39.1916 30.973L30.7329 35.6798L40.0033 19.1441ZM40.0033 60.8509L30.7329 44.3152L39.1916 49.022C39.4433 49.162 39.7233 49.232 40.0016 49.232C40.28 49.232 40.56 49.162 40.8117 49.022L49.2703 44.3152L40.0033 60.8509ZM40.0033 45.6569L29.8296 39.9967L40.0033 34.3364L50.1754 39.9967L40.0033 45.6569Z" fill="#00ADA3"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Final Credit Assessment</p>
                        </div>
                    </div>

                    <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{route('disbursementPendingUsers')}}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$disbursement_pending_list}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#00ADA3"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM40.0033 19.1441L49.272 35.6798L40.8133 30.973C40.3083 30.693 39.6966 30.693 39.1916 30.973L30.7329 35.6798L40.0033 19.1441ZM40.0033 60.8509L30.7329 44.3152L39.1916 49.022C39.4433 49.162 39.7233 49.232 40.0016 49.232C40.28 49.232 40.56 49.162 40.8117 49.022L49.2703 44.3152L40.0033 60.8509ZM40.0033 45.6569L29.8296 39.9967L40.0033 34.3364L50.1754 39.9967L40.0033 45.6569Z" fill="#00ADA3"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Customer Pending List</p>
                        </div>
                    </div>

                    <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{route('finalDisbursementUsers')}}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$final_approval_for_disbursement}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#00ADA3"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM40.0033 19.1441L49.272 35.6798L40.8133 30.973C40.3083 30.693 39.6966 30.693 39.1916 30.973L30.7329 35.6798L40.0033 19.1441ZM40.0033 60.8509L30.7329 44.3152L39.1916 49.022C39.4433 49.162 39.7233 49.232 40.0016 49.232C40.28 49.232 40.56 49.162 40.8117 49.022L49.2703 44.3152L40.0033 60.8509ZM40.0033 45.6569L29.8296 39.9967L40.0033 34.3364L50.1754 39.9967L40.0033 45.6569Z" fill="#00ADA3"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Disbursement Approval</p>
                        </div>
                    </div>

                    
                    
                    
                    

                    <div class="col-lg-3" style="cursor: pointer;" onclick="location.href='{{ route('allLoanList') }}?loanType=1'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$businessLoans}}
                                </p>
                                <div class="card_iconc mb-3">
                                    <img src="{{asset('assets/admin')}}/images/icons/card-iconc3.png" alt="">
                                </div>
                            </div>
                            <p class="mt-1 text-xs+">Business Loan</p>
                        </div>
                    </div>

                    <div class="col-lg-3" style="cursor: pointer;" onclick="location.href='{{ route('allLoanList') }}?loanType=2'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$persionalLoans}}
                                </p>
                                <div class="card_iconc mb-3">
                                    <img src="{{asset('assets/admin')}}/images/icons/card-iconc3.png" alt="">
                                </div>
                            </div>
                            <p class="mt-1 text-xs+">Personal loan</p>
                        </div>
                    </div>

                    <div class="col-lg-3" style="cursor: pointer;" onclick="location.href='{{ route('allLoanList') }}?loanType=8'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$outStandingLoans}}
                                </p>
                                <div class="card_iconc mb-3">
                                    <img src="{{asset('assets/admin')}}/images/icons/card-iconc3.png" alt="">
                                </div>
                            </div>
                            <p class="mt-1 text-xs+">Outstanding Loan</p>
                        </div>
                    </div>
                    <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{ route('allLoanList') }}?loanType=3'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between space-x-1">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$totalRawLoans}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#00ADA3"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM40.0033 19.1441L49.272 35.6798L40.8133 30.973C40.3083 30.693 39.6966 30.693 39.1916 30.973L30.7329 35.6798L40.0033 19.1441ZM40.0033 60.8509L30.7329 44.3152L39.1916 49.022C39.4433 49.162 39.7233 49.232 40.0016 49.232C40.28 49.232 40.56 49.162 40.8117 49.022L49.2703 44.3152L40.0033 60.8509ZM40.0033 45.6569L29.8296 39.9967L40.0033 34.3364L50.1754 39.9967L40.0033 45.6569Z" fill="#00ADA3"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Raw Material Financing Loan</p>
                        </div>
                    </div>

                    <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{route('rawMaterialFinancingLoans')}}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between space-x-1">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$rawMaterialFinancingLoans}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#00ADA3"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM40.0033 19.1441L49.272 35.6798L40.8133 30.973C40.3083 30.693 39.6966 30.693 39.1916 30.973L30.7329 35.6798L40.0033 19.1441ZM40.0033 60.8509L30.7329 44.3152L39.1916 49.022C39.4433 49.162 39.7233 49.232 40.0016 49.232C40.28 49.232 40.56 49.162 40.8117 49.022L49.2703 44.3152L40.0033 60.8509ZM40.0033 45.6569L29.8296 39.9967L40.0033 34.3364L50.1754 39.9967L40.0033 45.6569Z" fill="#00ADA3"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Raw Material Financing Approved</p>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$receievablesInvoicingLoans}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#374C98"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM52.5455 56.9324H26.0111L29.2612 38.9483L25.4944 39.7317V36.6649L29.8279 35.7482L32.6447 20.2809H43.2284L40.8283 33.4481L44.5285 32.6647V35.7315L40.2616 36.6149L37.7949 50.2154H54.5122L52.5455 56.9324Z" fill="#374C98"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Receivables Financing</p>
                        </div>
                    </div> --}}

                  {{--  <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{ route('customReports',['received-payments',urlencode('Received Payments')]) }}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between space-x-1">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{number_format($perncipalDeposit,2)}}
                                </p>
                                <div class="card_iconc mb-3">
                                    <img src="{{asset('assets/admin')}}/images/icons/card-iconc2.png" alt="">
                                </div>
                            </div>
                            <p class="mt-1 text-xs+">Collected EMI</p>
                        </div>
                    </div> --}}

                    {{-- <div class="col-lg-3">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{ $totalEMIAmountCollected}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#374C98"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM52.5455 56.9324H26.0111L29.2612 38.9483L25.4944 39.7317V36.6649L29.8279 35.7482L32.6447 20.2809H43.2284L40.8283 33.4481L44.5285 32.6647V35.7315L40.2616 36.6149L37.7949 50.2154H54.5122L52.5455 56.9324Z" fill="#374C98"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Collected Interest</p>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{ route('customReports',['over-due-payments',urlencode('Over due reports')]) }}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between space-x-1">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$totalEMIAmountDue}}
                                </p>
                                <div class="card_iconc mb-3">
                                    <img src="{{asset('assets/admin')}}/images/icons/card-iconc2.png" alt="">
                                </div>
                            </div>
                            <p class="mt-1 text-xs+">Due EMI</p>
                        </div>
                    </div> --}}

                   {{-- <div class="col-lg-3">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$totalInterestAmountDue}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#374C98"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM52.5455 56.9324H26.0111L29.2612 38.9483L25.4944 39.7317V36.6649L29.8279 35.7482L32.6447 20.2809H43.2284L40.8283 33.4481L44.5285 32.6647V35.7315L40.2616 36.6149L37.7949 50.2154H54.5122L52.5455 56.9324Z" fill="#374C98"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Due Interest</p>
                        </div>
                    </div> --}}
                     <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{ route('aumReports') }}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{number_format($totalApprovedAmount,2)}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#374C98"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM52.5455 56.9324H26.0111L29.2612 38.9483L25.4944 39.7317V36.6649L29.8279 35.7482L32.6447 20.2809H43.2284L40.8283 33.4481L44.5285 32.6647V35.7315L40.2616 36.6149L37.7949 50.2154H54.5122L52.5455 56.9324Z" fill="#374C98"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Total Disbursed</p>
                        </div>
                    </div>

                    <div class="col-lg-3" style="cursor:pointer;" onclick="location.href='{{ route('aumReports') }}'">
                        <div class="rounded-lg bg-slate-150 rcard_loans dark:bg-navy-700">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{number_format($allOutstandingAmount,2)}}
                                </p>
                                <svg class="mb-3 currency-icon" width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="40" fill="white"></circle>
                                    <path d="M40.725 0.00669178C18.6241 -0.393325 0.406678 17.1907 0.00666126 39.275C-0.393355 61.3592 17.1907 79.5933 39.2749 79.9933C61.3592 80.3933 79.5933 62.8093 79.9933 40.7084C80.3933 18.6241 62.8092 0.390041 40.725 0.00669178ZM39.4083 72.493C21.4909 72.1597 7.17362 57.3257 7.50697 39.4083C7.82365 21.4909 22.6576 7.17365 40.575 7.49033C58.5091 7.82368 72.8096 22.6576 72.493 40.575C72.1763 58.4924 57.3257 72.8097 39.4083 72.493Z" fill="#374C98"></path>
                                    <path d="M40.5283 10.8305C24.4443 10.5471 11.1271 23.3976 10.8438 39.4816C10.5438 55.549 23.3943 68.8662 39.4783 69.1662C55.5623 69.4495 68.8795 56.599 69.1628 40.5317C69.4462 24.4477 56.6123 11.1305 40.5283 10.8305ZM52.5455 56.9324H26.0111L29.2612 38.9483L25.4944 39.7317V36.6649L29.8279 35.7482L32.6447 20.2809H43.2284L40.8283 33.4481L44.5285 32.6647V35.7315L40.2616 36.6149L37.7949 50.2154H54.5122L52.5455 56.9324Z" fill="#374C98"></path>
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Total OutStanding</p>
                        </div>
                    </div>

                </div>

                <!--cards end  -->
{{--
                <div class="flex items-center justify-between space-x-2">
                    <h2
                        class="text-base dashchart_heading font-medium tracking-wide text-slate-800 line-clamp-1 dark:text-navy-100"
                    >
                        Customers on-board monthly overview
                    </h2>
                </div>


                <div class="flex flex-col mainchartbox sm:flex-row sm:space-x-7 col-md-11">
                    <canvas id="myChart" class="dashchart" width="400" height="400"></canvas>
                </div>
--}}
                
            </div>
            <div class="col-span-12 lg:col-span-12">
                {{--<div class="card pb-4 analytics_graphcard">
                    <div
                        class="my-3 flex h-8 items-center justify-between px-4 sm:px-5"
                    >
                        <h2
                            class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                        >
                            Products
                        </h2>

                    </div>

                    <div>
                        <div
                            x-init="$nextTick(() => { $el._x_chart = new ApexCharts($el,pages.charts.travelAnalytics); $el._x_chart.render() });"
                        ></div>
                    </div>
                    <div
                        class="mx-auto mt-3 max-w-xs px-4 text-center text-xs+ sm:px-5"
                    >
                        <div class="row mb-3 graph_most_used">
                            <div class="col-12 d-flex justify-content-center">
                                <div>
                                    <label class="d-flex align-items-center justify-content-center tx-10 text-uppercase fw-bolder">Most used product<span class="p-1 ms-1 rounded-circle bg-secondary"></span></label>
                                    <h5 class="fw-bolder mb-0 text-center">{{$appliedProductName}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary graphbtn">{{$totalAppliedCount}} customers Applied</button>
                        </div>
                    </div>
                </div>--}}

                <div class="card  disbursedloan_cuscard" id="dash_mtable">
                    <div class=" flex h-8 items-center justify-between">
                        <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            Disbursed Loan Customers
                        </h2>
                        <!-- <a href="#" class="border-b border-dotted border-current pb-0.5 text-xs+ font-medium text-primary outline-none transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70">View All</a> -->
                    </div>

                    <div class="space-y-4 mt-3">
                        @if(count($latestDisbursedLoans))
                            @foreach($latestDisbursedLoans as $ldRow)
                                @php
                                    if ($ldRow->profilePic) {
                                        $profilePic = env('APP_URL') . 'public/' . $ldRow->profilePic;
                                    } else {
                                        $profilePic = 'https://media.istockphoto.com/vectors/male-face-silhouette-or-icon-man-avatar-profile-unknown-or-anonymous-vector-id1087531642?k=20&m=1087531642&s=612x612&w=0&h=D6OBNUY7ZxQTAHNVtL9mm2wbHb_dP6ogIsCCWCqiYQg=';
                                    }

                                    $profileDtlURL=route('profileDetails', ['dashboard', $ldRow->userId]);
                                @endphp
                                <div class="flex items-center justify-between space-x-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="avatar h-10 w-10" onclick="window.open('<?=$profileDtlURL?>')" style="cursor: pointer;">
                                            <img class="mask is-hexagon" src="{{$profilePic}}" alt="avatar">
                                        </div>
                                        <div onclick="window.open('<?=$profileDtlURL?>')" style="cursor: pointer;">
                                            <p class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">
                                                {{$ldRow->name}} / {{$ldRow->customerCode}}
                                            </p>
                                            <p></p>
                                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                                {{$ldRow->email}} / {{$ldRow->mobile}}
                                            </p>
                                        </div>
                                    </div>
                                    <p class="text-xs">{{(strtotime($ldRow->disbursedDate)) ? date('d M, Y',strtotime($ldRow->disbursedDate)) : '' }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-span-12 lg:col-span-12">
            <div class="table_mainstart"> 
                <div class="card">
                    <div class=" w-full dash_tablecst">
                        <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            New Customers
                        </h2>
                        <div class="mt-3" style="width: 100% !important;">
                            <div class="" style="overflow-x: scroll;" >
                                <?php
                            $htmlStr ='<table class="is-hoverable w-full text-left">
                                <thead>
                                <tr>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Customer Profile</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Customer ID</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Customer Name</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Customer Email</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Mobile No.</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Date</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Status</th>
                                </tr>
                                </thead>
                                <tbody>';
                                    if (count($newUserRes))
                                    {
                                        foreach ($newUserRes as $crow)
                                        {

                                            if ($crow->profilePic) {
                                                $profilePic = env('APP_URL') . 'public/' . $crow->profilePic;
                                            } else {
                                                $profilePic = 'https://media.istockphoto.com/vectors/male-face-silhouette-or-icon-man-avatar-profile-unknown-or-anonymous-vector-id1087531642?k=20&m=1087531642&s=612x612&w=0&h=D6OBNUY7ZxQTAHNVtL9mm2wbHb_dP6ogIsCCWCqiYQg=';
                                            }
                                            $createdDate = (strtotime($crow->created_at)) ? date('d/m/Y', strtotime($crow->created_at)) : '';
                                            $htmlStr .=' <tr>

                                        <td class="">
                                            <div class="avatar flex h-10 w-10">
                                                <img class="mask is-squircle" src="' . $profilePic . '" alt="image">
                                            </div>
                                        </td>
                                        <td>' . $crow->customerCode . '</td>
                                        <td>' . $crow->name . '</td>
                                        <td>' . $crow->email . '</td>
                                        <td>' . $crow->mobile . '</td>
                                        <td>' . $createdDate . '</td>
                                        <td>';

                                            if ($crow->status == 1) {
                                                $htmlStr .='<span class="badge badge-success-light">Active</span>';
                                            } else if ($crow->status == 2) {
                                                $htmlStr .='<span class="badge badge-danger">Rejected</span>';
                                            } else {
                                                $htmlStr .='<span class="badge badge-danger">Deactive</span>';
                                            }

                                            $htmlStr .='</td>
                                    </tr>';
                                        }
                                    }
                                    $htmlStr .='</tbody>
                                            </table>';
                                    echo $htmlStr;
                                    ?>
                        </div>
                    </div>

                    {{-- <div class=" w-full dash_tablecst">
                        <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            Business Verification
                        </h2>
                        <div class="mt-3" style="width: 100% !important;">
                            <div class="" style="overflow-x: scroll;" >
                                <table class="is-hoverable w-full text-left">
                                <thead>
                                <tr>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Customer Profile</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Customer ID / Customer Name / Customer Email / Mobile No.</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"> Employer Name </th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"> Employer Email</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"> Employer Mobile No.</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Company Tele.No.</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Company GSTIN</th>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if (count($employment_histories_business))
                                    
                                        @foreach ($employment_histories_business as $business)
                                        
                                            @php
                                            if ($business->profilePic) {
                                                $profilePic = env('APP_URL') . 'public/' . $business->profilePic;
                                            } else {
                                                $profilePic = 'https://media.istockphoto.com/vectors/male-face-silhouette-or-icon-man-avatar-profile-unknown-or-anonymous-vector-id1087531642?k=20&m=1087531642&s=612x612&w=0&h=D6OBNUY7ZxQTAHNVtL9mm2wbHb_dP6ogIsCCWCqiYQg=';
                                            }
                                            $createdDate = (strtotime($business->created_at)) ? date('d/m/Y', strtotime($business->created_at)) : '';
                                           @endphp
                                            $htmlStr .=' <tr>

                                        <td class="">
                                            <div class="avatar flex h-10 w-10">
                                                <img class="mask is-squircle" src="{{ $profilePic }}" alt="image">
                                            </div>
                                        </td>
                                        <td>{{ $business->customerCode }}<br>'.$business->name.'<br>'.$business->email.'<br>'.$business->mobile.'</td>
                                        <td>{{$business->employerName}}</td>
                                        <td>{{ $business->emailId }}</td>
                                        <td>{{ $business->mobileNo }}</td>
                                        <td>{{ $business->companyTeleNo }}</td>
                                        <td>{{ $business->companyGstin }}</td>
                                        <td><span class="badge badge-danger">{{$business->status}}</span></td>
                                    </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                        </div>
                    </div> --}}
                </div>

                
            </div>



            </div>
           

            </div>



        </div>


    </main>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
<script>
let myTimeout;
    function searchUserList() {
        $("#myUL").show();
        $("#closeSerbtn").show();
        clearTimeout(myTimeout);
        myTimeout = setTimeout(() => {
            hideSerachList();
        }, 6000);
        var input, filter, ul, li, a, i, txtValue, txtName, txtCompanyname;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        let t = 0;
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.getAttribute('data-cusCode');
            txtName = a.getAttribute('data-uname');
            txtCompanyname = a.getAttribute('data-companyname');
            if ((txtValue.toUpperCase().indexOf(filter) > -1 || txtName.toUpperCase().indexOf(filter) > -1 || txtCompanyname.toUpperCase().indexOf(filter) > -1) && t<6) {
                t++;
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    
    function hideSerachList(){
        $("#myUL").hide();
    }

    function removeSearchData(){
        document.getElementById("myInput").value = "";
        $("#closeSerbtn").hide();
        $("#myUL").hide();
    }
    </script>
<script>
    var ctx = document.getElementById("myChart").getContext("2d");

    var data = <?=$graphStr?>;

    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            barValueSpacing: 10,
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                    }
                }]
            }
        }
    });

</script>
@endsection
