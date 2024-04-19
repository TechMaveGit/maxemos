<nav class="sidebar">
  <div class="sidebar-header">
  <a href="{{route('adminDashboard')}}" class="noble-ui-logo sidelogo d-block "><img class="gallery-img img-fluid mx-auto" src="{{asset('/')}}/assets/images/advanx-01.png" alt="">

</a>
      <?php
        $userPermissions=App\Providers\AppServiceProvider::checkDecodePermissions();
      ?>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['/']) }}">
        <a href="{{route('adminDashboard')}}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      <!-- <li class="nav-item nav-category">LOS Roles and Responsibilities</li>

      <li class="nav-item">
              <a href="{{ url('/los-roles/manage-master-information') }}" class="nav-link {{ active_class(['los-roles/manage-master-information']) }}">Manage Master Information  </a>
      </li>
      <li class="nav-item">
              <a href="{{ url('/los-roles/app-information') }}" class="nav-link {{ active_class(['los-roles/app-information']) }}">App Information  </a>
      </li>

      <li class="nav-item">
              <a href="{{ url('/los-roles/kyc-approval-department') }}" class="nav-link {{ active_class(['los-roles/kyc-approval-department']) }}"> KYC Approval Department</a>
      </li>
      <li class="nav-item">
              <a href="{{ url('/los-roles/loan-disbursement') }}" class="nav-link {{ active_class(['los-roles/loan-disbursement']) }}"> Loan Disbursement</a>
      </li>

 -->

<!-- system user management -->
    <?php if(in_array('all',$userPermissions) || in_array('view-roles',$userPermissions) || in_array('view-sys-user',$userPermissions)){ ?>
      <li class="nav-item {{ active_class(['los-roles/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#los-roles" role="button" aria-expanded="{{ is_active_route(['los-roles/*']) }}" aria-controls="los-roles">
        <i class="link-icon" data-feather="compass"></i>
          <span class="link-title">System User Management</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['los-roles/*']) }}" id="los-roles">
          <ul class="nav sub-menu">
              <?php if(in_array('all',$userPermissions) || in_array('view-roles',$userPermissions)){ ?>
            <li class="nav-item">
              <a href="{{ url('/los-roles/roles') }}" class="nav-link {{ active_class(['los-roles/roles']) }}">Roles</a>
            </li>
              <?php } ?>
              <?php if(in_array('all',$userPermissions) || in_array('view-sys-user',$userPermissions)){ ?>
            <li class="nav-item">
              <a href="{{ url('/los-roles/users') }}" class="nav-link {{ active_class(['los-roles/users']) }}">Users</a>
            </li>
              <?php } ?>
          </ul>
        </div>
      </li>
<?php } ?>
      <!-- customer management -->
      <!-- <li class="nav-item nav-category">Customer Management</li> -->

        <?php if(in_array('all',$userPermissions) || in_array('newcustomers',$userPermissions) || in_array('rejectedcustomers',$userPermissions) || in_array('kycverifiedcustomers',$userPermissions) || in_array('finalapprovalfordisbursement',$userPermissions)){ ?>
      <li class="nav-item {{ active_class(['customers/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#customers" role="button" aria-expanded="{{ is_active_route(['customers/*']) }}" aria-controls="customers">
        <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Customer Management</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['customers/*']) }}" id="customers">
          <ul class="nav sub-menu">
          <?php if(in_array('all',$userPermissions) || in_array('newcustomers',$userPermissions)){ ?>
          <li class="nav-item">
              <a href="{{ route('customerList') }}" class="nav-link {{ active_class(['customers/customers-list']) }}">New Loan Applications</a>
            </li>
          <?php } ?>
          <?php if(in_array('all',$userPermissions) || in_array('rejectedcustomers',$userPermissions)){ ?>
           <li class="nav-item">
              <a href="{{ url('/customers/rejected-customers') }}" class="nav-link {{ active_class(['customers/rejected-customers']) }}">Rejected Loan Applications</a>
            </li>
              <?php } ?>
              <?php if(in_array('all',$userPermissions) || in_array('employment-verification',$userPermissions)){ ?>
              <li class="nav-item">
                  <a href="{{ route('employmentVerification') }}" class="nav-link {{ active_class(['customers/employment-verification']) }}">Employment Verification</a>
              </li>
              <?php } ?>
              <?php if(in_array('all',$userPermissions) || in_array('employment-verification-rejected',$userPermissions)){ ?>
              <li class="nav-item">
                  <a href="{{ route('employmentVerificationRejected') }}" class="nav-link {{ active_class(['customers/employment-verification-rejected']) }}">Employment Verification Rejected</a>
              </li>
              <?php } ?>
            <?php if(in_array('all',$userPermissions) || in_array('kycverifiedcustomers',$userPermissions)){ ?>
            <li class="nav-item">
              <a href="{{ url('/customers/kyc-verified-customers') }}" class="nav-link {{ active_class(['customers/kyc-verified-customers']) }}">Credit Assessment Status</a>
            </li>
              <?php } ?>
              <?php if(in_array('all',$userPermissions) || in_array('finalapprovalfordisbursement',$userPermissions)){ ?>
         <li class="nav-item">
              <a href="{{ url('/customers/final-approval-for-disbursement') }}" class="nav-link {{ active_class(['customers/final-approval-for-disbursement']) }}">Disbursement Approval</a>
            </li>
              <?php } ?>
              <?php if(in_array('all',$userPermissions) || in_array('finalapprovalfordisbursement',$userPermissions)){ ?>
              <li class="nav-item">
                  <a href="{{ url('/customers/disbursement-pending-rejected') }}" class="nav-link {{ active_class(['customers/disbursement-pending-rejected']) }}">Disbursement Pending / Rejected</a>
              </li>
              <?php } ?>
          </ul>
        </div>
      </li>
        <?php } ?>

      <!-- loan management tab -->

    <?php if(in_array('all',$userPermissions) || in_array('today-disbursement',$userPermissions) || in_array('pending-disbursement',$userPermissions) || in_array('disbursed-loan-list',$userPermissions) || in_array('repeat-loans-list',$userPermissions) || in_array('bank-management',$userPermissions)){ ?>
      <!-- <li class="nav-item nav-category">Loan Management</li> -->
      <li class="nav-item {{ active_class(['loan-management/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#loanmanagement" role="button" aria-expanded="{{ is_active_route(['loan-management/*']) }}" aria-controls="loanmanagement">
          <i class="link-icon" data-feather="dollar-sign"></i>
          <span class="link-title">Loan Management</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['loan-management/*']) }}" id="loanmanagement">
          <ul class="nav sub-menu">
              <?php if(in_array('all',$userPermissions) || in_array('today-disbursement',$userPermissions)){ ?>
          <li class="nav-item">
              <a href="{{ url('/loan-management/today-disbursement') }}" class="nav-link {{ active_class(['loan-management/today-disbursement']) }}">Current Disbursement Pipeline</a>
            </li>
                  <?php } ?>
                  <?php if(in_array('all',$userPermissions) || in_array('pending-disbursement',$userPermissions)){ ?>
            <li class="nav-item">
              <a href="{{ url('/loan-management/pending-disbursement') }}" class="nav-link {{ active_class(['loan-management/pending-disbursement']) }}">Pending Disbursement</a>
            </li>
              <?php } ?>
              <?php if(in_array('all',$userPermissions) || in_array('disbursed-loan-list',$userPermissions)){ ?>
            <li class="nav-item">
              <a href="{{ url('/loan-management/loan-disbursed') }}" class="nav-link {{ active_class(['loan-management/loan-disbursed']) }}">Disbursed Loan</a>
            </li>
                  <?php } ?>
                  <?php if(in_array('all',$userPermissions) || in_array('repeat-loans-list',$userPermissions)){ ?>
{{--            <li class="nav-item">--}}
{{--              <a href="{{ url('/loan-management/repeat-loan-customers') }}" class="nav-link {{ active_class(['loan-management/repeat-loan-customers']) }}">Repeat Loan Customers</a>--}}
{{--            </li>--}}
                  <?php } ?>
                  <?php if(in_array('all',$userPermissions) || in_array('bank-management',$userPermissions)){ ?>
            <li class="nav-item">
              <a href="{{ url('/loan-management/add-bank') }}" class="nav-link {{ active_class(['loan-management/add-bank']) }}">FLDG Bank</a>
            </li>
              <?php } ?>
          </ul>
        </div>
      </li>
    <?php } ?>

    <?php if(in_array('all',$userPermissions) || in_array('customer-emi',$userPermissions) || in_array('received-emi',$userPermissions) || in_array('todays-emi',$userPermissions) || in_array('overdue-emi',$userPermissions) || in_array('closed-loan',$userPermissions) || in_array('noc-customers',$userPermissions)){ ?>
      <!-- collection managements tab -->
      <li class="nav-item {{ active_class(['collection-management/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#collection-management" role="button" aria-expanded="{{ is_active_route(['collection-management/*']) }}" aria-controls="collection-management">
          <i class="link-icon" data-feather="aperture"></i>
          <span class="link-title">Collection Management</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['collection-management/*']) }}" id="collection-management">
          <ul class="nav sub-menu">
              <?php if(in_array('all',$userPermissions) || in_array('customer-emi',$userPermissions)){ ?>
          <li class="nav-item">
              <a href="{{ url('/collection-management/customer-emi') }}" class="nav-link {{ active_class(['collection-management/customer-emi']) }}">Customer EMI  </a>
          </li>
          <?php } ?>
          <?php if(in_array('all',$userPermissions) || in_array('received-emi',$userPermissions)){ ?>
          <li class="nav-item">
              <a href="{{ url('/collection-management/received') }}" class="nav-link {{ active_class(['collection-management/received']) }}">Received  </a>
          </li>
          <?php } ?>
          <?php if(in_array('all',$userPermissions) || in_array('todays-emi',$userPermissions)){ ?>
          <li class="nav-item">
              <a href="{{ url('/collection-management/today-emi') }}" class="nav-link {{ active_class(['collection-management/today-emi']) }}">Today's EMI  </a>
          </li>
          <?php } ?>
          <?php if(in_array('all',$userPermissions) || in_array('overdue-emi',$userPermissions)){ ?>
          <li class="nav-item">
              <a href="{{ url('/collection-management/over-due-emi') }}" class="nav-link {{ active_class(['collection-management/over-due-emi']) }}">Over Due EMI  </a>
          </li>
          <?php } ?>
          <?php if(in_array('all',$userPermissions) || in_array('closed-loan',$userPermissions)){ ?>
          <li class="nav-item">
              <a href="{{ url('/collection-management/closed-loan') }}" class="nav-link {{ active_class(['collection-management/closed-loan']) }}">Closed Loan</a>
          </li>
          <?php } ?>
          <?php if(in_array('all',$userPermissions) || in_array('noc-customers',$userPermissions)){ ?>
          <li class="nav-item">
              <a href="{{ url('/collection-management/noc-customers') }}" class="nav-link {{ active_class(['collection-management/noc-customers']) }}">NOC Customers</a>
          </li>
          <?php } ?>

          </ul>
        </div>
      </li>
    <?php } ?>

    <?php if(in_array('all',$userPermissions) || in_array('category-management',$userPermissions) || in_array('sub-category-management',$userPermissions) || in_array('product-by-range-management',$userPermissions) || in_array('product-by-category-management',$userPermissions)){ ?>
      <!-- product management -->
      <li class="nav-item {{ active_class(['product-management/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#product-management" role="button" aria-expanded="{{ is_active_route(['product-management/*']) }}" aria-controls="product-management">
          <i class="link-icon" data-feather="archive"></i>
          <span class="link-title">Product Management</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['product-management/*']) }}" id="product-management">
          <ul class="nav sub-menu">
              <?php if(in_array('all',$userPermissions) || in_array('category-management',$userPermissions)){ ?>
            <li class="nav-item">
              <a href="{{ route('categoryList') }}" class="nav-link {{ active_class(['product-management/product-category']) }}">Product Category</a>
            </li>
          <?php } ?>
          <?php if(in_array('all',$userPermissions) || in_array('sub-category-management',$userPermissions)){ ?>
            <li class="nav-item">
              <a href="{{ route('subCategoryList') }}" class="nav-link {{ active_class(['product-management/product-subcategory']) }}">Product Sub-Categories</a>
            </li>
              <?php } ?>
              <?php if(in_array('all',$userPermissions) || in_array('product-by-category-management',$userPermissions)){ ?>

            <li class="nav-item">
              <a href="{{ url('/product-management/create-product-by-category') }}" class="nav-link {{ active_class(['product-management/create-product-by-category']) }}">Create Product by Category</a>
            </li>
          <?php } ?>
          <?php if(in_array('all',$userPermissions) || in_array('product-by-range-management',$userPermissions)){ ?>
            <li class="nav-item">
              <a href="{{ route('productsByRange') }}" class="nav-link {{ active_class(['product-management/create-product-by-range']) }}">Create Product by Range</a>
            </li>
          <?php } ?>
          </ul>
        </div>
      </li>
    <?php } ?>

      <li class="nav-item {{ active_class(['system-algorithm/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#system-algorithm" role="button" aria-expanded="{{ is_active_route(['system-algorithm/*']) }}" aria-controls="system-algorithm">
          <i class="link-icon" data-feather="layout"></i>
          <span class="link-title">System Algorithm</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['system-algorithm/*']) }}" id="system-algorithm">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/system-algorithm/credit-score') }}" class="nav-link {{ active_class(['system-algorithm/credit-score']) }}">Credit Score</a>
            </li>
              <li class="nav-item">
                  <a href="{{ route('accessLogs') }}" class="nav-link {{ active_class(['system-algorithm/access-logs']) }}">System Access Logs</a>
              </li>

          </ul>
        </div>
      </li>
      <li class="nav-item {{ active_class(['important-links/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#important-links" role="button" aria-expanded="{{ is_active_route(['important-links/*']) }}" aria-controls="important-links">
          <i class="link-icon" data-feather="link"></i>
          <span class="link-title">Important Links </span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['important-links/*']) }}" id="important-links">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/important-links/tech-support') }}" class="nav-link {{ active_class(['important-links/tech-support']) }}">Tech Support</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('careerPosts') }}" class="nav-link {{ active_class(['important-links/tech-support']) }}">Career Posts</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/important-links/privacy-policy') }}" class="nav-link {{ active_class(['important-links/privacy-policy']) }}">Privacy Policy</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/important-links/terms-condition') }}" class="nav-link {{ active_class(['important-links/terms-condition']) }}">Terms & Condition</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/important-links/faq') }}" class="nav-link {{ active_class(['important-links/faq']) }}">FAQ</a>
            </li>

          </ul>
        </div>
      </li>

        <li class="nav-item {{ active_class(['report/*']) }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#reports" role="button" aria-expanded="{{ is_active_route(['los-roles/*']) }}" aria-controls="los-roles">
                <i class="link-icon" data-feather="clipboard"></i>
                <span class="link-title">Reports</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse {{ show_class(['report/*']) }}" id="reports">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('customReports',['new-customers',urlencode('New customers lending')]) }}" class="nav-link {{ active_class(['report/new-customer-lending']) }}">New customers lending</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customReports',['approved-loans',urlencode('Approved customers')]) }}" class="nav-link {{ active_class(['report/new-customer-lending']) }}">Approved customers</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customReports',['disbursed-loans',urlencode('Disburse customers')]) }}" class="nav-link {{ active_class(['report/new-customer-lending']) }}">Disburse customers</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customReports',['disbursement-pending',urlencode('Pending for disbursement')]) }}" class="nav-link {{ active_class(['report/new-customer-lending']) }}">Pending for disbursement</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customReports',['over-due-payments',urlencode('Over due reports')]) }}" class="nav-link {{ active_class(['report/new-customer-lending']) }}">Over due reports</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customReports',['received-payments',urlencode('Received Payments')]) }}" class="nav-link {{ active_class(['report/new-customer-lending']) }}">Received Payments</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('customReports',urlencode('System user logs')) }}" class="nav-link {{ active_class(['report/new-customer-lending']) }}">System user logs</a>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </li>
    </ul>
  </div>
</nav>
<nav class="settings-sidebar">
  <div class="sidebar-body">
    <a href="#" class="settings-sidebar-toggler">
      <i data-feather="settings"></i>
    </a>
    <h6 class="text-muted mb-2">Sidebar:</h6>
    <div class="mb-3 pb-3 border-bottom">
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
          Light
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
          Dark
        </label>
      </div>
    </div>
    <div class="theme-wrapper">
      <h6 class="text-muted mb-2">Light Version:</h6>
      <a class="theme-item active" href="https://www.nobleui.com/laravel/template/demo1/">
        <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
      </a>
      <h6 class="text-muted mb-2">Dark Version:</h6>
      <a class="theme-item" href="https://www.nobleui.com/laravel/template/demo2/">
        <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
      </a>
    </div>
  </div>
</nav>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


<!-- <script>
  $(document).ready(function(){
    alert("eiohtoi")
     $(".nav-link").click(function(){
      $(this).parent().css("color","blue");
     })
  })
</script> -->
