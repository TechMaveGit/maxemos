
<!DOCTYPE html>
<html class="no-js" lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>Maxemo Caption Noc</title>
  <link rel="stylesheet" href="{{asset('assets/web')}}/simplehtml/css/style.css">
</head>

<body>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_align_center tm_mb20">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img width="20%" src="{{asset('assets/web')}}/asset/img/logo/maxemo-logo.png" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <div class="tm_primary_color tm_f50 tm_text_uppercase"></div>
            </div>
          </div>
          <div class="tm_invoice_info tm_mb20">
            <div class="tm_invoice_seperator tm_gray_bg"></div>
            <div class="tm_invoice_info_list">
              <!-- <p class="tm_invoice_number tm_m0">Invoice No: <b class="tm_primary_color">#LL93784</b></p>
              <p class="tm_invoice_date tm_m0">Date: <b class="tm_primary_color">01.07.2022</b></p> -->
            </div>
          </div>
          <div class="tm_invoice_head tm_mb10">
            <div class="tm_invoice_left">
              <p class="tm_mb2"><b class="tm_primary_color">Date: {{date('d F Y')}} </b></p>
              <p>Ref Number: {{ $customerUpload['refno'] }}</p>
              <p style="text-align: center;"><b class="tm_primary_color">No Objection Certificate</b></p>
              <p>To,</p>
              <p>{{ $customerUpload['user']['name'] ?? '' }} (Cust. id {{ $customerUpload['user']['customerCode'] ?? '' }})</p>
              <p>Client contact no: {{$customerUpload['user']['mobile']}}</p>
              <p><b>Subject: Clearance of {{$customerUpload['laonName']}}</b></p>
              <p>
                This is to certify that {{ $customerUpload['user']['name'] ?? '' }} is our customer and has closed {{Str::lower($customerUpload['laonName'])}} against <b>loan ID LF0{{$customerUpload['loanId']}}</b> of rupee <b>INR {{$customerUpload['loanamount']}}</b> Only in full and final with maxemo capital.

We further confirm that no outstanding payment is due and payable by the customer as of date against the said finance facility loan in our books.

Please note that this certificate does not constitute any financial undertaking /liability and is being issued without any risk and responsibility on the part of the bank or any of its officers.

<p>Sincerely,</p>
              </p>
              <p>Manager Operations<br>
                <b>Maxemo Capital</b>
            </p>
              <p>* if applicable The un-utilised Post Dated / Security Cheques will be destroyed after 45 days from the date of closure.</p>
            </div>
            
          </div>
          
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Print</span>
        </a>
        <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
          <span class="tm_btn_text">Download</span>
        </button>
      </div>
    </div>
  </div>
  <script src="{{asset('assets/web')}}/simplehtml/js/jquery.min.js"></script>
  <script src="{{asset('assets/web')}}/simplehtml/js/jspdf.min.js"></script>
  <script src="{{asset('assets/web')}}/simplehtml/js/html2canvas.min.js"></script>
  <script src="{{asset('assets/web')}}/simplehtml/js/main.js"></script>
</body>

</html>