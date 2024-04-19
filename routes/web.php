<?php

use App\Http\Controllers\ApplyLoanController;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommonController as CommonController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EMIController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\GloadController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Payments\EaseBuzzApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RawMaterialLoanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Web\ApplyController;
use App\Http\Controllers\Web\CustomerController as WebCustomerController;
use App\Models\ApplyLoanHistory;
use App\Providers\AppServiceProvider;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Dompdf\Dompdf;
use Dompdf\Options;
// use DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Web Routes
Route::get('/',[WebCustomerController::class,'index'])->name('welcomeWeb');

Route::get('/web/about-us',function(){ return view('web.about-us'); })->name('WebAboutUs');
Route::get('/web/our-teams',function(){ return view('web.our-team'); })->name('WebOurteam');
Route::get('/web/career',function(){ return view('web.career'); })->name('WebCareer');


Route::get('/web/business-loan',function(){ return view('web.business-loan'); })->name('WebBusinessLoan');
Route::get('/web/personal-loan',function(){ return view('web.personal-loan'); })->name('WebPersonalLoan');
Route::get('/web/raw-material-financing',function(){ return view('web.raw-material-financing'); })->name('WebRawLoan');
Route::get('/web/receivables-invoicing',function(){ return view('web.receivables-invoicing'); })->name('WebReceivableLoan');
Route::get('/web/code-of-conduct',function(){ return view('web.code-of-conduct'); })->name('WebCodeOfConduct');
Route::get('/web/fair-practice-code',function(){ return view('web.fair-practice-code'); })->name('WebFairPractice');
Route::get('/web/grievance-redressal-mechanism',function(){ return view('web.grievance-redressal-mechanism'); })->name('WebGrievance');
Route::get('/web/interest-rate-policy',function(){ return view('web.interest-rate-policy'); })->name('WebInterestRate');
Route::get('/web/kyc-policy',function(){ return view('web.kyc-policy'); })->name('WebKycPolicy');
Route::get('/web/contact',function(){ return view('web.contact'); })->name('WebContact');
Route::get('/web/blog',function(){ return view('web.blog'); })->name('WebBlog');

Route::get('sign-up-now',[WebCustomerController::class,'signUp'])->name('signUp');
Route::get('user-login',[WebCustomerController::class,'userLogin'])->name('webUserLogin');
Route::post('user-login',[WebCustomerController::class,'webUserLoginCheck'])->name('webUserLoginCheck');
Route::post('user-web-signup',[WebCustomerController::class,'saveCustomerInfoWebSignUp'])->name('saveCustomerInfoWebSignUp');
Route::get('user-logout',[WebCustomerController::class,'webUserLogOut'])->name('webUserLogOut');
Route::get('forget-password',[WebCustomerController::class,'forgetPassword'])->name('forgetPassword');
Route::post('forget-password-send-mail',[WebCustomerController::class,'sendMailForForgetPassword'])->name('sendMailForForgetPassword');

Route::get('send-msg-for-emi-reminder',[CommonController::class,'sendMsgForEmiReminder'])->name('sendMsgForEmiReminder');

Route::get('/export/{page}',[ExportController::class,'excelReport'])->name('adminExportReports');

Route::get('enach-api/{id}',[WebCustomerController::class,'enachApi'])->name('enachApi');

Route::post('send-user-login-otp',[CommonController::class,'sendLoginOTP'])->name('sendLoginOTP');
Route::post('verify-login-otp',[CommonController::class,'verifyLoginOTP'])->name('verifyLoginOTP');

Route::get('del-raw-history',[CommonController::class,'delRawHistory'])->name('delRawHistory');
Route::get('/test-sms',[CommonController::class,'msgTest'])->name('msgTest');
Route::post('/web/career-form',[WebCustomerController::class,'careerForm'])->name('WebCareerFormSubmit');

Route::post('/contact-us-data',[ApplyController::class,'contactdata'])->name('contactdata');

Route::group(['prefix'=>'user', 'middleware'=>'auth:web'], function(){
    Route::get('apply-now',[WebCustomerController::class,'applyNow'])->name('applyNow');
    Route::get('dashboard',[WebCustomerController::class,'userDashboard'])->name('userDashboard');
    Route::post('loan-data',[WebCustomerController::class,'userLoanDetailsHtml'])->name('userLoanDetailsHtml');
    
    Route::post('dashboard-html',[WebCustomerController::class,'userDashboardHtml'])->name('userDashboardHtml');
    Route::post('change-password-web',[WebCustomerController::class,'changePasswordWeb'])->name('changePasswordWeb');
    
    Route::post('initiate-apply-loan-web',[WebCustomerController::class,'initiateApplyLoanWeb'])->name('initiateApplyLoanWeb');
    Route::post('get-business-or-employment-form-for-loan-apply',[WebCustomerController::class,'getBusinessOrEmploymentFormForLoanApply'])->name('getBusinessOrEmploymentFormForLoanApply');
    Route::post('save-apply-loan-by-web-user',[WebCustomerController::class,'saveApplyLoanByWebUser'])->name('saveApplyLoanByWebUser');
    Route::post('loan-details-by-user-web',[WebCustomerController::class,'getLoanHistoryByUserWeb'])->name('getLoanHistoryByUserWeb');
    Route::post('filter-raw-material-txn-history',[WebCustomerController::class,'filterRawMaterialTxnHistory'])->name('filterRawMaterialTxnHistory');
    Route::post('disbursement-request-for-raw-materials-loans',[WebCustomerController::class,'disburseRequestForRawMaterialAppliedLoans'])->name('disburseRequestForRawMaterialAppliedLoans');
    
    Route::get('initiate-payment/{id}',[WebCustomerController::class,'initiateRawMaterialPayment'])->name('initiateRawMaterialPayment');
    //Route::post('initiate-payment-page',[WebCustomerController::class,'initiateRawMaterialPaymentUI'])->name('initiateRawMaterialPaymentUI');
    
    Route::post('applyloan-step1/',[ApplyController::class,'loanTypeAmount'])->name('applyloan.step1');
    Route::post('applyloan-step2/',[ApplyController::class,'kycdetails'])->name('applyloan.step2');
    Route::post('applyloan-step3/',[ApplyController::class,'PersonalInformation'])->name('applyloan.step3');
    Route::post('applyloan-step4/',[ApplyController::class,'saveCoApplicantInfoPrivate'])->name('applyloan.step4');
    Route::post('applyloan-step5/',[ApplyController::class,'saveUserBankDetailsPrivate'])->name('applyloan.step5');
    Route::post('applyloan-step6/',[ApplyController::class,'saveProfessionalDetailsPrivate'])->name('applyloan.step6');
    Route::any('test/',[ApplyController::class,'testCases'])->name('applyloan.test');

    Route::post('/webPancardVerify',[ApplyController::class,'webPancardVerify'])->name('webPancardVerify');
    Route::post('/webAadharcardVerify',[ApplyController::class,'webAadharcardVerify'])->name('webAadharcardVerify');
    Route::post('/webPancardPatnerOne',[ApplyController::class,'webPancardPatnerOne'])->name('webPancardPatnerOne');
    Route::post('/webPancardPatnerTwo',[ApplyController::class,'webPancardPatnerTwo'])->name('webPancardPatnerTwo');

});


//Admin Routes
Route::get('/admin-login',[CommonController::class,'index'])->name('login');
Route::get('/admin',[CommonController::class,'index'])->name('loginA');
Route::post('login',[CommonController::class,'login'])->name('userLogin');

Route::post('superlogin',[CommonController::class,'superAdminlogin'])->name('superAdminlogin');

Route::get('/term-and-condition',function(){
    return view('web.terms-condition');
})->name('webTermCondition');
Route::get('/privacy-policy',function(){
    return view('web.privacy-policy');
})->name('webPrivacyPolicy');


Route::post('import-users-by-csv',[CustomerController::class,'importusersByCSV'])->name('importusersByCSV');

Route::get('accept-loan/{status}/{id}',[ApplyLoanController::class,'acceptLoanByCustomer'])->name('acceptLoanByCustomer');
Route::get('ocr_adhaar_verification',[CustomerController::class,'ocr_adhaar_verification'])->name('ocr_adhaar_verification');

Route::get('accept-consent-by-customer/{status}/{id}',[ApplyLoanController::class,'acceptConsentByCustomer'])->name('acceptConsentByCustomer');

Route::get('view-loan-detail/{id}',[ApplyLoanController::class,'viewAdminLaonDetail'])->name('viewAdminLaonDetail');
Route::post('view-loan-detail-admin/{id}',[ApplyLoanController::class,'viewAdminLaonDetailSubmit'])->name('viewAdminLaonDetailSubmit');

Route::get('sattle-raw-material-txn-auto-custom-curl',[RawMaterialLoanController::class,'sattleRawMatetialsTxnAutoCustom'])->name('sattleRawMatetialsTxnAutoCustomCurl');

Route::group(['prefix'=>'admin', 'middleware'=>'auth:web'], function(){
    Route::get('dashboard',[DashboardController::class,'index'])->name('adminDashboard');
    

    Route::post('get-profile-details-html',[CustomerController::class,'getProfileDetailsHtml'])->name('getProfileDetailsHtml');
    Route::post('send-sms-alert-by-type',[CommonController::class,'sendSmsAlertByType'])->name('sendSmsAlertByType');
    
    Route::post('delete-role',[CommonController::class,'deleteRole'])->name('deleteRole');
    Route::post('delete-admin',[CommonController::class,'deleteAdmin'])->name('deleteAdmin');
    Route::post('update-credit-limit-raw-material',[RawMaterialLoanController::class,'increateCreditLimitRawmaterial'])->name('increateCreditLimitRawmaterial');
    Route::post('collect-raw-material-amount-calc-on-txn',[CustomerController::class,'getRawMaterialLoanCalcOnTxn'])->name('getRawMaterialLoanCalcOnTxn');
    Route::post('sattle-raw-material-txn',[RawMaterialLoanController::class,'sattleRawMaterialTxn'])->name('sattleRawMaterialTxn');
    Route::post('sattle-raw-material-txn-auto-custom',[RawMaterialLoanController::class,'sattleRawMatetialsTxnAutoCustom'])->name('sattleRawMatetialsTxnAutoCustom');
    
    Route::post('save-deviation-info',[CustomerController::class,'saveDeviationInfo'])->name('saveDeviationInfo');
    Route::post('reject-for-customer-consent',[CustomerController::class,'rejectForCustomerConsent'])->name('rejectForCustomerConsent');
    
    Route::post('previewEMIDetails',[EMIController::class,'previewEMIDetails'])->name('previewEMIDetails');
    
    Route::get('all-loan-list',[LoanController::class,'allLoanList'])->name('allLoanList');
    Route::get('all-customers-list',[CustomerController::class,'allcustomer'])->name('allcustomer');
    Route::get('customers-list',[CustomerController::class,'index'])->name('customerList');
    Route::post('save-customers-info',[CustomerController::class,'saveCustomerInfo'])->name('saveCustomerInfo');
    
    Route::post('save-co-applicant-info',[ApplyLoanController::class,'saveCoApplicantInfo'])->name('saveCoApplicantInfo');
    Route::post('save-professional-info',[ApplyLoanController::class,'saveProfessionalDetails'])->name('saveProfessionalDetails');
    Route::post('save-kyc-info',[ApplyLoanController::class,'saveKycDetails'])->name('saveKycDetails');
    Route::post('save-user-bank-details',[ApplyLoanController::class,'saveUserBankDetails'])->name('saveUserBankDetails');
    Route::post('apply-loan-by-admin',[ApplyLoanController::class,'applyLoanByAdmin'])->name('applyLoanByAdmin');
    
    Route::post('initiate-apply-loan',[ApplyLoanController::class,'initiateApplyLoan'])->name('initiateApplyLoan');
    Route::post('send-for-customer-consent',[ApplyLoanController::class,'sendForCustomerConsent'])->name('sendForCustomerConsent');
    Route::post('get-loan-details-for-customer-consent',[ApplyLoanController::class,'initiateApplyLoanEditForCustomerConsent'])->name('initiateApplyLoanEditForCustomerConsent');
    Route::post('get-loan-details-for-superadmin-consent',[ApplyLoanController::class,'initiateApplyLoanEditForAdminConsent'])->name('initiateApplyLoanEditForAdminConsent');
    Route::post('get-loan-details-for-superadmin-consent-raw',[ApplyLoanController::class,'initiateApplyLoanEditForAdminConsentRaw'])->name('initiateApplyLoanEditForAdminConsentRaw');
    
    
    Route::post('deleteOtherDocuments',[CustomerController::class,'deleteOtherDocuments'])->name('deleteOtherDocuments');
    Route::post('get-user-all-details',[CustomerController::class,'getUserAllDetails'])->name('getUserAllDetails');
    Route::post('get-business-or-company-details',[CustomerController::class,'getBusinessOrCompanyDetails'])->name('getBusinessOrCompanyDetails');
    Route::post('get-cash-flow-analysis-details-by-user',[CustomerController::class,'getUserCashFlowAnalysisDetailsByUser'])->name('getUserCashFlowAnalysisDetailsByUser');
    Route::post('docs-mark-as-read',[CommonController::class,'markDocsAsRead'])->name('markDocsAsRead');
    Route::get('customer-card/{id}',[CustomerController::class,'customerCard'])->name('customerCard');
    Route::get('rejected-customers',[LoanController::class,'kycRejectedUsers'])->name('kycRejectedUsers');
    Route::get('employment-verification',[LoanController::class,'employmentVerification'])->name('employmentVerification');
    Route::get('employment-verification-rejected',[LoanController::class,'employmentVerificationRejected'])->name('employmentVerificationRejected');
    Route::get('kyc-verified-customers',[LoanController::class,'kycApprovedUsers'])->name('kycApprovedUsers');
    Route::get('final-credit-assessment',[LoanController::class,'finalKycApprovedUsers'])->name('finalKycApprovedUsers');
    Route::post('disbursed-docs-upload-data',[CustomerController::class,'disbursedDocsUploadData'])->name('disbursedDocsUploadData');
    
    
    Route::get('final-approval-for-disbursement',[LoanController::class,'finalDisbursementUsers'])->name('finalDisbursementUsers');
    Route::get('disbursement-pending',[LoanController::class,'disbursementPendingUsers'])->name('disbursementPendingUsers');
    Route::get('disbursement-rejected',[LoanController::class,'disbursementRejectedUsers'])->name('disbursementRejectedUsers');
    
    Route::post('collect-raw-material-amount',[RawMaterialLoanController::class,'collectRawMaterialAmount'])->name('collectRawMaterialAmount');
    Route::post('approve-raw-material-disbursement-request',[RawMaterialLoanController::class,'approveDisbursementRequest'])->name('approveDisbursementRequest');
    Route::post('filter-customer-raw-material-financing-loans',[RawMaterialLoanController::class,'filterCustomerForRawMaterialFinancingLoans'])->name('filterCustomerForRawMaterialFinancingLoans');
    Route::get('raw-material-financing-loans',[RawMaterialLoanController::class,'rawMaterialFinancingLoans'])->name('rawMaterialFinancingLoans');
    Route::get('due-renewal-raw-material-financing-loans',[RawMaterialLoanController::class,'dueRenewalRawMaterialFinancingLoans'])->name('dueRenewalRawMaterialFinancingLoans');
    Route::post('filter-customer-raw-material-disbursement-pending-history',[RawMaterialLoanController::class,'filterRawMaterialDisbursementPendingList'])->name('filterRawMaterialDisbursementPendingList');
    Route::get('raw-material-disbursement-pending-list',[RawMaterialLoanController::class,'rawMaterialDisbursementPendingList'])->name('rawMaterialDisbursementPendingList');
    Route::post('filter-customer-raw-material-financing-loans-txn-history',[RawMaterialLoanController::class,'rewMaterialAppliedLoansTxnHistory'])->name('rewMaterialAppliedLoansTxnHistory');
    Route::post('raw-material-financing-approved-loans',[RawMaterialLoanController::class,'rewMaterialAppliedLoans'])->name('rewMaterialAppliedLoans');
    Route::get('raw-material-financing-loan-account-details/{id}',[RawMaterialLoanController::class,'rawMaterialLoanAccountDetails'])->name('rawMaterialLoanAccountDetails');
    Route::post('disburse-raw-material-financing-loan-amount',[RawMaterialLoanController::class,'disburseRawMaterialAppliedLoans'])->name('disburseRawMaterialAppliedLoans');
    Route::post('disburse-request-raw-material-financing-loan-amount',[RawMaterialLoanController::class,'disburseRequestRawMaterialAppliedLoans'])->name('disburseRequestRawMaterialAppliedLoans');
    Route::post('renew-raw-material-financing-loan',[RawMaterialLoanController::class,'renewalRawMaterialAppliedLoans'])->name('renewalRawMaterialAppliedLoans');
    
    Route::post('send-for-customer-approval',[ApplyLoanController::class,'sendLoanForCustomerApproval'])->name('sendLoanForCustomerApproval');
    Route::post('schedule-loan-disburse',[CustomerController::class,'scheduleLoanDisburse'])->name('scheduleLoanDisburse');
    
    Route::post('disburse-amount-and-create-emi-card',[EMIController::class,'disburseAmountAndCreateEmi'])->name('disburseAmountAndCreateEmi');
    Route::post('emi-details',[EMIController::class,'getLoanEmiDetails'])->name('getLoanEmiDetails');
    Route::post('mark-as-paid-this-emi',[EMIController::class,'markAsPaidThisEmi'])->name('markAsPaidThisEmi');
    
    Route::post('close-emi-details',[CustomerController::class,'closeLoanAllTime'])->name('closeLoanAllTime');
    Route::post('pay-outstanding-amount',[CustomerController::class,'payOutStandingAmount'])->name('payOutStandingAmount');
    Route::post('get-employment-info-for-update',[CustomerController::class,'getUserEmploymentInfoForUpdate'])->name('getUserEmploymentInfoForUpdate');
    Route::post('get-employment-info-with-admin-updates',[CustomerController::class,'getUserEmploymentInfoWithAdminUpdates'])->name('getUserEmploymentInfoWithAdminUpdates');
    Route::post('get-personal-discussion-info-with-admin-updates',[CustomerController::class,'getPersonalDiscussionDetailsWithAdminUpdate'])->name('getPersonalDiscussionDetailsWithAdminUpdate');
    Route::post('save-personal-discussion-info-with-admin-updates',[CustomerController::class,'savePersonalDiscussionInfo'])->name('savePersonalDiscussionInfo');
    Route::post('employment-info-for-update',[CustomerController::class,'employmentInfoForUpdate'])->name('employmentInfoForUpdate');
    Route::post('confirm-amount-for-loan-disbursement',[CustomerController::class,'confirmAmountForDisbursement'])->name('confirmAmountForDisbursement');
    Route::post('get-loan-details-for-schedule-disbursement',[CustomerController::class,'getLoanDetailsForScheduleDisbursement'])->name('getLoanDetailsForScheduleDisbursement');

    Route::post('customers-list-filter',[CustomerController::class,'filterUsersCustomerManagement'])->name('filterUsersCustomerManagement');

    Route::post('get-payble-amount-bullet-repayment',[CustomerController::class,'getPaybleAmountBulletRepayment'])->name('getPaybleAmountBulletRepayment');
    Route::post('sattle-bullet-repayment-txn',[CustomerController::class,'sattleBulletRepaymentTxn'])->name('sattleBulletRepaymentTxn');

    Route::get('today-disbursement',[ReportController::class,'todayDisbursement'])->name('todayDisbursement');
    Route::get('today-raw-disbursement',[ReportController::class,'todayRawDisbursement'])->name('todayRawDisbursement');
    Route::get('pending-disbursement',[ReportController::class,'pendingDisbursement'])->name('pendingDisbursement');
    Route::get('loan-disbursed',[ReportController::class,'disbursedLoanList'])->name('disbursedLoanList');
    Route::post('filter-users-other-lists',[CustomerController::class,'filterUsersListsOther'])->name('filterUsersListsOther');
    Route::post('mark-as-closed-on-pre-closer',[CustomerController::class,'markLoanAsClosedOnPreCloser'])->name('markLoanAsClosedOnPreCloser');

    //Route::get('today-disbursement', function () { return view('pages.loan-management.today-disbursement'); });
    //Route::get('pending-disbursement', function () { return view('pages.loan-management.pending-disbursement'); });
    Route::get('add-company', function () { return view('pages.loan-management.add-company'); });

    Route::get('add-bank',[DashboardController::class,'banksList'])->name('banksList');
    Route::post('save-bank-details',[DashboardController::class,'saveBankDetails'])->name('saveBankDetails');
    Route::post('delete-bank',[DashboardController::class,'deleteBank'])->name('deleteBank');
    Route::post('get-product-list-by-category',[DashboardController::class,'getProductsListByCategory'])->name('getProductsListByCategory');


    Route::get('customer-emi',[ReportController::class,'customerEmis'])->name('customerEmis');
    Route::get('received',[ReportController::class,'receivedEmis'])->name('receivedEmis');
    Route::get('today-emi',[ReportController::class,'todaysEmis'])->name('todaysEmis');
    Route::get('over-due-emi',[ReportController::class,'overDueEmis'])->name('overDueEmis');
    Route::get('closed-loan',[ReportController::class,'closedLoans'])->name('closedLoans');
    Route::get('noc-customers',[ReportController::class,'nocCustomers'])->name('nocCustomers');
    Route::get('sanction-letter-customers/{id}',[ReportController::class,'sanctionCustomers'])->name('sanctionCustomers');

    Route::get('tech-support',[CommonController::class,'techSupport'])->name('techSupport');
    Route::post('filter-tech-support',[CommonController::class,'filterSupportQuery'])->name('filterSupportQuery');
    Route::post('save-tech-support',[CommonController::class,'saveTicketDetails'])->name('saveTicketDetails');
    Route::post('update-tech-support-ticket-status',[CommonController::class,'changeTicketStatus'])->name('changeTicketStatus');
    Route::post('update-tech-support-ticket-priority-status',[CommonController::class,'changePriorityStatus'])->name('changePriorityStatus');
    Route::get('privacy-policy',[CommonController::class,'privacyPolicy'])->name('privacyPolicy');
    Route::post('save-privacy-policy',[CommonController::class,'savePrivacyPolicy'])->name('savePrivacyPolicy');
    Route::get('terms-condition',[CommonController::class,'termsAndConditions'])->name('termsAndConditions');
    Route::post('save-terms-condition',[CommonController::class,'saveTermsAndConditions'])->name('saveTermsAndConditions');
    Route::get('faq',[CommonController::class,'faqList'])->name('faqList');
    Route::post('save-faq',[CommonController::class,'saveFaq'])->name('saveFaq');
    Route::get('credit-score',[CommonController::class,'creditScore'])->name('creditScore');
    Route::post('save-credit-score',[CommonController::class,'saveCibilScore'])->name('saveCibilScore');

    Route::get('equifax-report/{user_id}',[CommonController::class,'equifaxReport'])->name('equifaxReport');

    Route::get('question-and-answer/{id}',[DashboardController::class,'creditScoreQnsAns'])->name('creditScoreQnsAns');
    Route::post('save-credit-score-question-and-answer/{id}',[DashboardController::class,'saveCreditScoreQnsAns'])->name('saveCreditScoreQnsAns');
    Route::get('access-logs',[CommonController::class,'accessLogs'])->name('accessLogs');
    Route::get('product-category',[ProductController::class,'categoryList'])->name('categoryList');
    Route::post('save-category',[ProductController::class,'saveCategory'])->name('saveCategory');
    Route::post('delete-category',[ProductController::class,'deleteCategory'])->name('deleteCategory');


    Route::get('tenure-list',[ProductController::class,'tenureList'])->name('tenureList');
    Route::post('filter-tenure-list',[ProductController::class,'filterTenureList'])->name('filterTenureList');
    Route::post('save-tenure-details',[ProductController::class,'saveTenureDetails'])->name('saveTenureDetails');
    Route::post('get-tenures-list-by-category',[DashboardController::class,'getTenureListByCategory'])->name('getTenureListByCategory');


    Route::get('product-subcategory',[ProductController::class,'subCategoryList'])->name('subCategoryList');
    Route::post('save-sub-category',[ProductController::class,'saveSubCategory'])->name('saveSubCategory');
    Route::post('delete-sub-category',[ProductController::class,'deleteSubCategory'])->name('deleteSubCategory');

    Route::get('create-product-by-range',[ProductController::class,'productsByRange'])->name('productsByRange');
    Route::post('save-product-by-range',[ProductController::class,'saveProductByRange'])->name('saveProductByRange');
    Route::get('products-list',[ProductController::class,'productsByCategory'])->name('productsByCategory');
    Route::post('save-product-by-category',[ProductController::class,'saveProductByCategory'])->name('saveProductByCategory');
    Route::post('get-sub-category-by-category-id',[ProductController::class,'getSubCategoryByCatId'])->name('getSubCategoryByCatId');
    Route::post('update-product-status-master',[ProductController::class,'updateProductStatusMaster'])->name('updateProductStatusMaster');
    Route::post('update-category-status-master',[ProductController::class,'updateCategoryStatusMaster'])->name('updateCategoryStatusMaster');
    Route::post('update-sub-category-status-master',[ProductController::class,'updateSubCategoryStatusMaster'])->name('updateSubCategoryStatusMaster');

    


    Route::get('roles',[DashboardController::class,'rolesList'])->name('rolesList');
    Route::get('view-roles-permissions/{id}',[DashboardController::class,'roleDefaultPermissions'])->name('roleDefaultPermissions');
    Route::post('update-roles-permissions',[DashboardController::class,'updateRolesPermissions'])->name('updateRolesPermissions');
    Route::get('users',[DashboardController::class,'adminUsers'])->name('adminUsers');
    Route::get('edit-user/{id}',[DashboardController::class,'editProfile'])->name('editProfile');

    Route::post('save-roles',[DashboardController::class,'saveRoles'])->name('saveRoles');
    Route::post('save-user-profile',[DashboardController::class,'saveUserProfile'])->name('saveUserProfile');
    Route::get('profile/{slug}/{id}',[CustomerController::class,'profileDetails'])->name('profileDetails');
    Route::post('save-kyc-status',[ApplyLoanController::class,'saveKycStatus'])->name('saveKycStatus');
    Route::post('save-employment-status',[CustomerController::class,'saveEmploymentStatus'])->name('saveEmploymentStatus');
    Route::post('save-disbursement-status',[CustomerController::class,'saveDisbursementStatus'])->name('saveDisbursementStatus');
    Route::get('sys-user-profile/{id}',[DashboardController::class,'sysUserProfile'])->name('sysUserProfile');
    Route::post('save-admin-profile-info',[DashboardController::class,'updateAdminProfile'])->name('updateAdminProfile');



    Route::get('career-application',function(){ return view('pages.carrers.data'); })->name('careerApplication');
    Route::get('career-posts',[CommonController::class,'careerPost'])->name('careerPosts');
    Route::match(['get','post'],'career-add',[CommonController::class,'careerPostAdd'])->name('careerAdd');
    Route::match(['get','post'],'career-edit/{id}',[CommonController::class,'careerPostEdit'])->name('careerEdit');


    Route::get('logout',[CommonController::class,'logout'])->name('adminLogout');
    Route::get('/{pagename}/{any}',[CommonController::class,'customReports'])->name('customReports');
    Route::post('custom-report-filter',[CommonController::class,'customReportsFilter'])->name('customReportsFilter');
    
    Route::get('aum-report',[ReportController::class,'aumReports'])->name('aumReports');
    Route::post('filter-aum-report',[ReportController::class,'filterAumReports'])->name('filterAumReports');
    Route::get('payment-report',[ReportController::class,'paymentReports'])->name('paymentReports');
    Route::post('filter-payment-report',[ReportController::class,'filterPaymentReports'])->name('filterPaymentReports');

    Route::get('next-month-emi-report',[ReportController::class,'nextMonthEmiReports'])->name('nextMonthEmiReports');
    Route::post('filter-next-month-emi-report',[ReportController::class,'filterNextMonthEmiReports'])->name('filterNextMonthEmiReports');
    
    Route::get('accrud-working-report',[ReportController::class,'accrudWorkingReports'])->name('accrudWorkingReports');
    Route::post('accrud-working-report',[ReportController::class,'filterAccrudWorkingReports'])->name('filterAccrudWorkingReports');
});



Route::get('/clear', function () {
    Artisan::call('optimize');
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    dd('done');
});

Route::get('/cronrun',function(){
    //dd('done');
    Artisan::call('overDueEmiRemainder:cron');
});


Route::get('/mail', function () {
    $to = 'basant@techmavesoftware.com'; // Replace with the recipient's email address
    $subject = 'Test Subject DDDDDDDD';
    $body = '<p>This is a test email body.</p>';
    
    Mail::raw($body, function ($message) use ($to, $subject) {
        $message->to($to)
        ->subject($subject);
    });
    dd('done');
    // AppServiceProvider::sendMail("basant@techmavesoftware.com", "Basant", "Loan Disbursement Request #LF0123123 | Maxemos", $body);
    // $email = new \SendGrid\Mail\Mail();
    //     $email->setFrom('sales@maxemocapital.com', 'Maxemo');
    //     $email->setSubject('TEST MAil');
    //     $email->addTo("basant@techmavesoftware.com", "Basant");
    //     $email->addContent(
    //         "text/html", "<h1>Test Mail</h1>"
    //     );

    //     $sendgrid = new \SendGrid(env('SAND_GRID_API_KEY'));
    //     $sendgrid->send($email);

    // Mail::raw('Hi, welcome user! It\'s Test Mail.', function ($message) {
    //     $message->to('basant@techmavesoftware.com')->subject('Test Mail');
    //   });
    // dd('done');
});



// Route::any('/enash-test',[GloadController::class,'enashAuthorization']);

Route::any('/test1',function (){
    // $client = new Client();
    echo md5('255');
   
    dd('--');
    try{

        $response = $client->request('POST', 'https://pay.easebuzz.in/initiate_seamless_payment/', [
            'form_params' => [
                'access_key' => 'e6154e9bbbd4eeae26e3c60a9a8f77e7ca640f6b94e326f91d2acc1f36ca2a4a',
                'payment_mode' => 'EN',
                'ifsc' => 'PUNB0010410',
                'account_type' => 'SAVINGS',
                'account_no' => '51462171013571',
                'auth_mode' => 'NetBanking',
                'bank_code' => 'PNBCB'
            ],
            'headers' => [
              'Accept' => 'application/json',
              'Content-Type' => 'application/x-www-form-urlencoded',
            ],
          ]);

        // $response = $client->request('POST', 'https://pay.easebuzz.in/initiate_seamless_payment/', [
        //     'form_params' => [
        //       'access_key' => 'e6154e9bbbd4eeae26e3c60a9a8f77e7ca640f6b94e326f91d2acc1f36ca2a4a',
        //       'payment_mode' => 'UPIAD',
        //       'upi_va' => '1777',
        //       'request_mode' => 'seamless_vpa'
        //     ],
        //     'headers' => [
        //       'Accept' => 'application/json',
        //       'Content-Type' => 'application/x-www-form-urlencoded',
        //     ],
        //   ]);

    
    }catch(Exception $e){
        dd($e->getMessage());
    }
      dd($response);
      dd(json_decode($response->getBody(),true));
});


Route::any('/test2',function (){
    dd('done');
    $client = new Client();

    $merchant_txn = 'OR' . strtotime(date('Y-m-d H:i:s')) . rand(0000, 9999);
    $sub_merchant_id = 'ORS' . strtotime(date('Y-m-d H:i:s')) . rand(0000, 9999);

    //$hash_sequence = "key|merchant_txn|name|email|phone|amount|udf1|udf2|udf3|udf4|udf5|message|salt";

    // $max_amount=$request->amount;
    $max_amount= "11.0";
    $amount = '1.0';

    $MERCHANT_KEY = 'VPGJ1ZK4UZ';
    $SALT_KEY = 'BBTX2XUUMH';
    $expiry_date = date("d/m/Y", strtotime("+1 month"));

    // key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10|salt

    $hash_sequence = $MERCHANT_KEY."|$merchant_txn|$amount|Laon Data|".auth()->user()->name."|".auth()->user()->email."|||||$max_amount||||||".$SALT_KEY;
    // dd($hash_sequence);
    $finalHash = hash('sha512', $hash_sequence);

    try{
    $response = $client->request('POST', 'https://pay.easebuzz.in/payment/initiateLink', [
        'form_params' => [
          'key' => $MERCHANT_KEY,
          'txnid' => $merchant_txn,
          'amount' => $amount,
          'productinfo' => 'Laon Data',
          'firstname' => auth()->user()->name,
          'phone' => auth()->user()->mobile,
          'email' => auth()->user()->email,
          'surl' => 'http://maxemocapital.co.in/api/enash-failed',
          'furl' => 'http://maxemocapital.co.in/api/enash-failed',
          'hash' => $finalHash,
          'udf1' => '',
          'udf2' => '',
          'udf3' => '',
          'udf4' => '',
          'udf5' => $max_amount,
          'udf6' => '',
          'udf7' => '',
          'udf8' => '',
          'udf9' => '',
          'udf10' => '',
          'address1' => '',
          'address2' => '',
          'city' => '',
          'state' => '',
          'country' => '',
          'zipcode' => '',
          'customer_authentication_id' => '15d3f8f237d0467d8e865ffe2265dcb5',
          'show_payment_mode' => 'EN',
          'sub_merchant_id' => '',
          'request_flow' => 'SEAMLESS',
          'final_collection_date' => $expiry_date
        ],
        'headers' => [
          'Accept' => 'application/json',
          'Content-Type' => 'application/x-www-form-urlencoded',
        ],
      ]);
    }catch(Exception $e){
        dd($e->getMessage());
    }
      
      dd(json_decode($response->getBody(),true));
});

Route::any('/test11',function (){
    dd('--');

    $EaseBuzzApiController = new EaseBuzzApiController();
    $dataurl = $EaseBuzzApiController->easyCollectionLink(1101);
    dd($dataurl);
    $client = new Client();

    $merchant_txn = 'OR' . strtotime(date('Y-m-d H:i:s')) . rand(0000, 9999);
    $sub_merchant_id = 'ORS' . strtotime(date('Y-m-d H:i:s')) . rand(0000, 9999);

    //$hash_sequence = "key|merchant_txn|name|email|phone|amount|udf1|udf2|udf3|udf4|udf5|message|salt";

    // $max_amount=$request->amount;
    $max_amount= "11.0";
    $amount = '1.0';

    $MERCHANT_KEY = 'VPGJ1ZK4UZ';
    $SALT_KEY = 'BBTX2XUUMH';
    $expiry_date = date("d/m/Y", strtotime("+1 month"));

    //key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10|salt

    $hash_sequence = $MERCHANT_KEY."|$merchant_txn|$amount|maxemos|".auth()->user()->name."|".auth()->user()->email."|||||$max_amount||||||".$SALT_KEY;
    // dd($hash_sequence);
    $finalHash = hash('sha512', $hash_sequence);

    try{
        // 'key' => $MERCHANT_KEY,
        //   'txnid' => $merchant_txn,
        //   'amount' => $amount,
        //   'productinfo' => 'maxemos',
        //   'firstname' => auth()->user()->name,
        //   'phone' => auth()->user()->mobile,
        //   'email' => auth()->user()->email,
        //   'surl' => 'http://maxemocapital.co.in/maxemolms/enash-success',
        //   'furl' => 'http://maxemocapital.co.in/maxemolms/enash-failed',
        //   'hash' => $finalHash,
        $response = $client->request('POST', 'https://pay.easebuzz.in/payment/initiateDirectDebitRequest/', [
            'form_params' => [
              'key' => $MERCHANT_KEY,
              'txnid' => $merchant_txn,
              'amount' => $amount,
              'productinfo' => 'maxemos',
              'firstname' => auth()->user()->name,
              'phone' => auth()->user()->mobile,
              'email' => auth()->user()->email,
              'surl' => 'http://maxemocapital.co.in/maxemolms/enash-success',
              'furl' => 'http://maxemocapital.co.in/maxemolms/enash-failed',
              'hash' => $finalHash,
              'udf1' => '',
              'udf2' => '',
              'udf3' => '',
              'udf4' => '',
              'udf5' => $max_amount,
              'udf6' => '',
              'udf7' => '',
              'udf8' => '',
              'udf9' => '',
              'udf10' => '',
              'address1' => '',
              'address2' => '',
              'city' => '',
              'state' => '',
              'country' => '',
              'zipcode' => '',
              'customer_authentication_id' => '15d3f8f237d0467d8e865ffe2265dcb5',
              'merchant_debit_id' => $merchant_txn,
              'auto_debit_access_key' => '8b247501-8dac-4e19-80f3-c3116ce606e5',
              'sub_merchant_id' => ''
            ],
            'headers' => [
              'Accept' => 'application/json',
              'Content-Type' => 'application/x-www-form-urlencoded',
            ],
          ]);
    }catch(Exception $e){
        dd($e->getMessage());
    }
      
      dd(json_decode($response->getBody(),true));
});

// e6154e9bbbd4eeae26e3c60a9a8f77e7ca640f6b94e326f91d2acc1f36ca2a4a

Route::get('/testdata',function(){
    // Initialize cURL session
    dd('---');
    $ch = curl_init();
            
        
    // Set cURL options

    $url = 'https://ists.equifax.co.in/cir360service/cir360report';
    

      $data = '{
        "RequestHeader": {
            "CustomerId": "9198",
            "UserId": "STS_MAXPCS",
            "Password": "W3#QeicsB",
            "MemberNumber": "007FP13413",
            "SecurityCode": "2AI",
            "CustRefField": "123456",
            "ProductCode": [
                "PCS"
            ]
        },
        "RequestBody": {
            "InquiryPurpose": "00",
            "TransactionAmount": "0",
            "FirstName": "RAVI GOLA",
            "MiddleName": "",
            "LastName": "",
            "InquiryAddresses": [
                {
                    "seq": "1",
                    "AddressLine1": "S / O Ramnath Prajapati , Sector F - 941 , Govind Nagar , Mathura , Mathura , Uttar Pradesh",
                    "City": "",
                    "State": "UP",
                    "AddressType": [
                        "H"
                    ],
                    "Postal": "281001"
                }
            ],
            "InquiryPhones": [
                {
                    "seq": "1",
                    "Number": "8512827828",
                    "PhoneType": [
                        "M"
                    ]
                }
            ],
            "EmailAddresses": [
                {
                    "seq": "1",
                    "Email": "ravi@techmavesoftware.com",
                    "EmailType": [
                        "O"
                    ]
                }
            ],
            "IDDetails": [
                {
                    "seq": "1",
                    "IDValue": "BREPG5851M",
                    "IDType": "T",
                    "Source": "Inquiry"
                },
                {
                    "seq": "2",
                    "IDValue": "",
                    "IDType": "P",
                    "Source": "Inquiry"
                },
                {
                    "seq": "3",
                    "IDValue": "",
                    "IDType": "V",
                    "Source": "Inquiry"
                },
                {
                    "seq": "4",
                    "IDValue": "",
                    "IDType": "D",
                    "Source": "Inquiry"
                },
                {
                    "seq": "5",
                    "IDValue": "",
                    "IDType": "M",
                    "Source": "Inquiry"
                }
            ],
            "DOB": "1993-02-12",
            "Gender": "M"
        },
        "Score": [
            {
                "Type": "ERS",
                "Version": "3.1"
            }
        ]
    }';

    $headers = array(
        "Content-Type: application/json"
      );

    // Set headers
    // dd($data);

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); // Increase the connection timeout to 30 seconds (adjust as needed).
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

    // Execute cURL request and get the response
    $response = curl_exec($ch);

    echo "<pre>", print_r(json_decode($response, true)),"</pre>";
    // Check for cURL errors
    if (curl_errno($ch)) {
        $errorMessage = curl_error($ch);
        curl_close($ch);
        return $errorMessage;
    } else {
        curl_close($ch);
        $responseData = json_decode($response, true);
        return $responseData;
    }

});

// Route::get('/test-autopay',[TestController::class,'eashInhert']);
// Route::get('/test-autopay1',[TestController::class,'autoDebitAuth']);
// Route::get('/test-autopay2',[TestController::class,'eashautoPay']);


Route::get('/test-raw',function(){
    dd('--');
    
    // dd($insertdata);
    // DB::table('renewal_loans')->insert($insertdata);
});


Route::get('/test-sms',function(){
    // $baseUrl = public_path();
    // dd($baseUrl);
    
    // return view('pages.app-management.sanction-letter',compact('app_data'));
    // dd('--');
    // $view = view('pages.app-management.sanction-letter')->render();

    // AppServiceProvider::sendMailAttachment('basant@techmavesoftware.com','basant','Test Mail','<h1>adsadasd</h1>','pages.app-management.sanction-letter',232);
    dd('done');
    // return view('web.noc');
    //     $currentMonth=date('m');
    //         $currentYear=date('Y');
    //         $today=date('Y-m-d');
    //         $twoDaysBack = date('d F Y',strtotime(date('Y-m-d').' -3 days'));
    //         // dd($twoDaysBack);
    //         // $remainderLists=DB::select("SELECT ed.*,u.customerCode,u.nameTitle,u.name,u.mobile,u.email FROM loan_emi_details ed LEFT JOIN users u ON ed.userId=u.id WHERE date(ed.emiDate)<=date('$twoDaysBack') AND ed.status !='success' AND reminderSent='0'");
    //         $remainderLists=DB::select("SELECT ed.id,ed.loanId,ed.netemiAmount,ed.payment_links,u.customerCode,u.nameTitle,u.name,u.mobile,u.email FROM loan_emi_details ed LEFT JOIN users u ON ed.userId=u.id WHERE date(ed.emiDueDate)<date('$today') AND MONTH(ed.emiDate)<='$currentMonth' AND YEAR(ed.emiDate)<='$currentYear' AND ed.status = 'pending' AND ed.netemiAmount>0 LIMIT 2");
    // if(!empty($remainderLists)){
    //             foreach($remainderLists as $rlist){
                

    //                 $EaseBuzzApiController = new EaseBuzzApiController();
    //                 if($rlist->payment_links){
    //                     $paylink_url =$rlist->payment_links;
    //                 }else{
    //                     $paylink_url = $EaseBuzzApiController->easyCollectionLink($rlist->id);
    //                 }
    //                  dd($rlist,$rlist->id,$rlist->payment_links,$paylink_url);
    //             }
    // }
    // dd(empty($remainderLists),$remainderLists);
    // dd('--');
    // $textMessage = 'Hello from Maxemo Team, this is a reminder for your Loan ID LE0001, your payment due date is 5 august Amount Rs. 10 kindly pay on due date Regards,Maxemo Capital';
    // $mobile = '9871802071';
    // $loanid = 'LE0001';
    // $fdate = date('Y-m-d');
    // $amount = 10;
    // $textMessage= 'Hello from Maxemo Team, This is a reminder for your Loan ID '.$loanid.', your payment due date is '.$fdate.' Amount INR '.$amount.' kindly pay on due date. Regards, Maxemo Capital';
    // // $textMessage= 'Hello from Maxemo Team, This is a reminder for your Loan ID , your payment due date is  Amount INR  kindly pay on due date. Regards, Maxemo Capital';
    // // $RES=AppServiceProvider::sendSms($mobile, $textMessage);
    //   dd($RES);
});



Route::get('/loan-noc/{id}',[CommonController::class,'loanNoc'])->name('loan-noc');

Route::get('/linkf',function(){
    dd("--");
    Artisan::call('storage:link');
    $fileContent = Storage::disk('public_upload')->get('user-profile/167869560199783.png');
    echo $fileContent;
});

Route::get('/test-pay',function(){
dd('done');
    $apidata = urldecode('key=VPGJ1ZK4UZ&furl=https%3A%2F%2Fpay.easebuzz.in%2Feasy_collect%2Ffurl%2Ff79bb275110b412b8cc29fefeca3b738&hash=400ca2fa44d9f228c48eea8f0e651c6779d0c22e083c92500f8cbaf4825303fea3bd9d07d6867c00a173cb9fcf23a93047fd81e9384a83ea39584cd286dc1fb3&mode=EN&surl=https%3A%2F%2Fpay.easebuzz.in%2Feasy_collect%2Fsurl%2Ff79bb275110b412b8cc29fefeca3b738&udf1=&udf2=&udf3=&udf4=&udf5=6314.00&udf6=&udf7=&udf8=&udf9=&email=raju%40techmavesoftware.com&error=User+rejected+the+transaction+on+pre-login+page&phone=8920638723&txnid=OR16947565465760&udf10=&amount=1&status=failure&upi_va=NA&PG_TYPE=NA&addedon=2023-09-15+07%3A08%3A10.000000&cardnum=NA&bankcode=NA&bank_name=NA&card_type=E-NACH&easepayid=E2309159V9HBRO&firstname=Raju+Morya&productinfo=EasyCollect+Payment&service_tax=0&bank_ref_num=ENA230915124033141BP1LS6QEJYDEAP&cardCategory=NA&issuing_bank=NA&name_on_card=NA&discount_code=NA&error_Message=User+rejected+the+transaction+on+pre-login+page&merchant_logo=NA&payment_source=Easebuzz&service_charge=0&unmappedstatus=NA&discount_amount=0&net_amount_debit=0&payment_category=KHDDA&settlement_amount=0&auto_debit_auth_msg=&cancellation_reason=NA&authorization_status=initiated&cash_back_percentage=50&deduction_percentage=0&auto_debit_access_key=NA&auto_debit_auth_error=&customer_authentication_id=f340f5c966a74ecb803430cd429a4973');

    $dataShow = explode('&',$apidata);

    $keyvalue = [];
    foreach($dataShow as $prod){
        $data = explode('=',$prod);
        $keyvalue[$data[0]] = $data[1] ?? '';
    }
   

    dd($keyvalue);
});