<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="Credit%20Report_files/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="Credit%20Report_files/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="Credit%20Report_files/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="Credit%20Report_files/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</head>

<body>


@php
  $data = (object)$userData;
@endphp




  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Credit Report</title>
  <style>
    * {
      padding: 0px;
      margin: 0px;
      font-family: 'Poppins', sans-serif;
    }

    tr td {
      font-size: 14px;
      padding: 15px 10px !important;
    }

    tr th {
      font-size: 14px;
      padding: 0px 10px !important;
    }

    .print-button {
      text-align: center;
      position: absolute;
      top: 10px;
      right: 40px;
    }

    .print-button__content {
      display: inline-block;
      cursor: pointer;
      margin-top: 1em;
      padding: 0.5em 1em;
      color: white;
      text-decoration: none;
      font-size: 13px;
      border-radius: 3px;
      transition: 0.3s;
      background: #518b37;
    }

    .print-button__content:hover {
      background-color: #28a805;
    }
  </style>



  <div class="section_form"
    style="width: calc(85% - 40px); position: relative; margin: 60px auto; padding: 60px 40px; box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
    <div class="print-button">

      @if(!isset($data->CCRResponse->CIRReportDataLst->Error))
      <span class="print-button__content  js__action--print" title="Print this page">
        <i class="fa-solid fa-print"></i> Print
      </span>
      
      @endif
    </div>
    <div class="top__header" style="margin-bottom: 30px; margin-top: 30px;">
      <img src="https://maxemocapital.com/assets/web/asset/img/logo/maxemo-logo.png" style="width: 180px;">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/Equifax_Logo.svg/2560px-Equifax_Logo.svg.png" jsaction="load:XAeZkd;" jsname="HiaYvf"
        class="n3VNCb KAlRDb" alt="File:Equifax Logo.svg - Wikimedia Commons" data-noaft="1"
        style="/* width: 585px; */height: 47.857px;/* margin: 0px; */float: right;/* margin-bottom: -29px; */">
    </div>
    @if(!isset($data->CCRResponse->CIRReportDataLst->Error))
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <!-- START HEADER/BANNER -->

    </table>
    <table class="table" style="width:100%; padding-bottom:10px; border-bottom: 3px solid #444;">
      <thead>
        <tr style="text-align: left; color: #323232; font-size: 22px; ">
          <th scope="col" style="padding-bottom: 6px;">Consumer Reference Number</th>
          <th scope="col" style="padding-bottom: 6px;">Credit Score</th>
          <th scope="col" style="padding-bottom: 6px;">Date Time</th>
          <th scope="col" style="padding-bottom: 6px;">Name</th>
          <th scope="col" style="padding-bottom: 6px;">ReportOrderNO</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $data->InquiryResponseHeader->ClientID ?? 'N/A' }} </td>
          <td>{{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->ScoreDetails[0]->Value ?? 'N/A' }}</td>
          <td>{{ ($data->InquiryResponseHeader->Date ?? 'N/A')." ".($data->InquiryResponseHeader->Time ?? 'N/A') }} </td>
          <td>{{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->PersonalInfo->Name->FullName ?? 'N/A' }}</td>
          <td>{{ $data->InquiryResponseHeader->ReportOrderNO ?? 'N/A' }}</td>
        </tr>
      </tbody>
    </table>

    <div class="common_title" style="margin: 20px 0px; font-size:18px; font-weight:bold;">Product Code : Applicable for
      Retail</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th>Personal Information</th>
          <th>Identification</th>
          <th>Family Details</th>
        </tr>
      </thead>
      <tbody>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Full Name:<span class="line_sample"
              style="position:absolute; right:60px;">{{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->PersonalInfo->Name->FullName ?? 'N/A' }}</span></td>
          <td style="padding: 0px 8px;  position: relative;">PAN:<span class="line_sample"
              style="position:absolute; right:60px;">{{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->IdentityInfo->PANId[0]->IdNumber ?? 'N/A' }}</span></td>
          <td style="padding: 0px 8px;  position: relative;">Home:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px;  position: relative;">Alias Name:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px;  position: relative;">Ration Card:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px;  position: relative;">Office:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px;  position: relative;">Dob:<span class="line_sample"
              style="position:absolute; right:60px;">{{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->PersonalInfo->DateOfBirth ?? 'N/A' }}</span></td>
          <td style="padding: 0px 8px;  position: relative;">UID::<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px;  position: relative;">Mobile:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px;  position: relative;">Age:<span class="line_sample"
              style="position:absolute; right:60px;">{{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->PersonalInfo->Age->Age ?? 'N/A' }}</span></td>
          <td style="padding: 0px 8px;  position: relative;">Voter ID:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Alt. Mobile:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Gender:<span class="line_sample"
              style="position:absolute; right:60px;">{{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->PersonalInfo->Gender ?? 'N/A' }}</span></td>
          <td style="padding: 0px 8px; position: relative;">Driver License:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;"><span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Total Income: <span class="line_sample"
              style="position:absolute; right:60px;">{{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->PersonalInfo->TotalIncome ?? 'N/A' }}</span></td>
          <td style="padding: 0px 8px; position: relative;">Passport ID: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Email: <span class="line_sample" style="position:absolute; right:60px;">{{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->EmailAddressInfo[0]->EmailAddress ?? 'N/A' }}</span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Occupation <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Photo Credit Card: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">ID Other: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>

      </tbody>
    </table>

    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Consumer Phone Info:
    </div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Sno.</th>
          <th style="text-align: left;">Type</th>
          <th style="text-align: left;">Reported Date</th>
          <th style="text-align: left;"> Number </th>
        </tr>
      </thead>
      @php $phoneInfo = $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->PhoneInfo ?? null; @endphp
      <tbody>
        @if($phoneInfo)
        @foreach ($phoneInfo as $key => $value)
          <tr >
          <td ><?= $value->seq ?></td>
          <td ><?= $value->typeCode ?></td>
          <td ><?= $value->ReportedDate ?></td>
          <td ><?= $value->Number ?></td> 
        </tr>    
        @endforeach
          
        @endif

      </tbody>
    </table>

    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Micro finance
      Accounts Summary:</div>
      @php $MicrofinanceAccountsSummary = $data->CCRResponse->CIRReportDataLst[1]->CIRReportData->MicrofinanceAccountsSummary ?? null; @endphp
    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">id.</th>
          <th style="text-align: left;">ActiveAccounts</th>
          <th style="text-align: left;">TotalPastDue</th>
          <th style="text-align: left;"> NoOfPastDueAccounts </th>
          <th style="text-align: left;"> RecentAccount </th>
          <th style="text-align: left;"> TotalBalanceAmount </th>
          <th style="text-align: left;"> MonthlyPayment </th>
          <th style="text-align: left;"> TotalWrittenOffAmount </th>
        </tr>
      </thead>

      <tbody>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">{{ $MicrofinanceAccountsSummary->id ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $MicrofinanceAccountsSummary->NoOfActiveAccounts ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $MicrofinanceAccountsSummary->TotalPastDue ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $MicrofinanceAccountsSummary->NoOfPastDueAccounts ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $MicrofinanceAccountsSummary->RecentAccount ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $MicrofinanceAccountsSummary->TotalBalanceAmount ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $MicrofinanceAccountsSummary->TotalMonthlyPaymentAmount ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $MicrofinanceAccountsSummary->TotalWrittenOffAmount ?? 'N/A' }}</td>
        </tr>

      </tbody>
    </table>

      @php
        $MicrofinanceAccountDetails = $data->CCRResponse->CIRReportDataLst[1]->CIRReportData->MicrofinanceAccountDetails ?? null;
      @endphp
      @if($MicrofinanceAccountDetails)
      <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Micro finance Account
        Details:</div>
        @foreach ($MicrofinanceAccountDetails as $value)
          
        
        <table class="table"
          style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

          <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
            <tr>
              <th style="text-align: left;">Sno.</th>
              <th style="text-align: left;">CustomerCode</th>
              <th style="text-align: left;">CustRefField</th>
              <th style="text-align: left;"> ReportOrderNO </th>
              <th style="text-align: left;"> ProductCode </th>
              <th style="text-align: left;"> Date </th>
              <th style="text-align: left;"> HitCode </th>
              <th style="text-align: left;"> CustomerName </th>
            </tr>
          </thead>
          <tbody>

            <tr style="height: 32px; font-size: 19px; color: #464646;">
              <td style="padding: 0px 8px; position: relative;">{{ $value->seq ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->branchIDMFI ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->kendraIDMFI ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->id ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->AccountNumber ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->CurrentBalance ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->Institution ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->PastDueAmount ?? 'N/A' }}</td>
            </tr>

          </tbody>
        </table>
        <table class="table"
          style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

          <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
            <tr>
              <th style="text-align: left;">DisbursedAmount</th>
              <th style="text-align: left;">LoanCategory</th>
              <th style="text-align: left;">LoanPurpose</th>
              <th style="text-align: left;"> Open </th>
              <th style="text-align: left;"> SanctionAmount </th>
              <th style="text-align: left;"> LastPaymentDate </th>
              <th style="text-align: left;"> DateReported </th>
              <th style="text-align: left;"> DateOpened </th>
            </tr>
          </thead>
          <tbody>

            <tr style="height: 32px; font-size: 19px; color: #464646;">
              <td style="padding: 0px 8px; position: relative;">{{ $value->DisbursedAmount ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->LoanCategory ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->LoanPurpose ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->Open ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->SanctionAmount ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->LastPaymentDate ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->DateReported ?? 'N/A' }}</td>
              <td style="padding: 0px 8px; position: relative;">{{ $value->DateOpened ?? 'N/A' }}</td>
            </tr>

          </tbody>
        </table>
        @endforeach
      @endif

      @php
          $CIRReportDataLst01 = $data->CCRResponse->CIRReportDataLst ?? null;
          @endphp
        @if($CIRReportDataLst01)
        @foreach ($CIRReportDataLst01 as $key => $valueLoop)
        <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Inquiry Response Header:</div>
          <table class="table"
            style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">
  
            <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
              <tr>
                <th style="text-align: left;">Sno.</th>
                <th style="text-align: left;">CustomerCode</th>
                <th style="text-align: left;">CustRefField</th>
                <th style="text-align: left;"> ReportOrderNO </th>
                <th style="text-align: left;"> ProductCode </th>
                <th style="text-align: left;"> Date </th>
                <th style="text-align: left;"> HitCode </th>
                <th style="text-align: left;"> CustomerName </th>
              </tr>
            </thead>
            @php
              $InquiryResponseHeader = $data->CCRResponse->CIRReportDataLst[0]->InquiryResponseHeader ?? null;
            @endphp
            <tbody>
  
              <tr style="height: 32px; font-size: 19px; color: #464646;">
                <td style="padding: 0px 8px; position: relative;">1</td>
                <td style="padding: 0px 8px; position: relative;">{{ $InquiryResponseHeader->CustomerCode ?? 'N/A' }}</td>
                <td style="padding: 0px 8px; position: relative;">{{ $InquiryResponseHeader->CustRefField ?? 'N/A' }}</td>
                <td style="padding: 0px 8px; position: relative;">{{ $InquiryResponseHeader->ReportOrderNO ?? 'N/A' }}</td>
                <td style="padding: 0px 8px; position: relative;">
                  @php
                    $ProductCode = $InquiryResponseHeader->ProductCode;
                  @endphp
                  @foreach ($ProductCode as $key => $value)
                    {{$value}}<br/>
                  @endforeach
                </td>
                <td style="padding: 0px 8px; position: relative;">{{ $InquiryResponseHeader->Date ?? 'N/A' }}</td>
                <td style="padding: 0px 8px; position: relative;">{{ $InquiryResponseHeader->HitCode ?? 'N/A' }}</td>
                <td style="padding: 0px 8px; position: relative;">{{ $InquiryResponseHeader->CustomerName ?? 'N/A' }}</td>
              </tr>
  
            </tbody>
          </table>

          <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Inquiry Request Header:</div>
          <table class="table"
            style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">
  
            <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
              <tr>
                <th style="text-align: left;">Sno</th>
                <th style="text-align: left;">InquiryPurpose</th>
                <th style="text-align: left;">FirstName</th>
                <th style="text-align: left;"> MiddleName </th>
                <th style="text-align: left;"> LastName </th>
                <th style="text-align: left;"> InquiryAddresses </th>
              </tr>
            </thead>
            @php
              $InquiryRequestInfo = $data->CCRResponse->CIRReportDataLst[0]->InquiryRequestInfo ?? null;
            @endphp
            <tbody>
  
              <tr style="height: 32px; font-size: 19px; color: #464646;">
                <td style="padding: 0px 8px; position: relative;">1</td>
                <td style="padding: 0px 8px; position: relative;">{{ $InquiryRequestInfo->InquiryPurpose ?? 'N/A' }}</td>
                <td style="padding: 0px 8px; position: relative;">{{ $InquiryRequestInfo->FirstName ?? 'N/A' }}</td>
                <td style="padding: 0px 8px; position: relative;">{{ $InquiryRequestInfo->MiddleName ?? 'N/A' }}</td>
                <td style="padding: 0px 8px; position: relative;">{{ $InquiryRequestInfo->LastName ?? 'N/A' }}</td>
                <td style="padding: 0px 8px; position: relative;">
                  @php
                    $InquiryAddresses = $InquiryRequestInfo->InquiryAddresses;
                  @endphp
                  @if($InquiryAddresses)
                    @foreach ($InquiryAddresses as $key => $value)
                      {{$value->AddressLine1}} <br/>
                    @endforeach
                  @endif
                </td>
              </tr>
  
            </tbody>
          </table>
          


    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Inquiry Phones:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Sno.</th>
          <th style="text-align: left;">Number</th>
          <th style="text-align: left;"> PhoneType </th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>


    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">IDDetails:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Sno.</th>
          <th style="text-align: left;">IDType</th>
          <th style="text-align: left;">IDValue</th>
          <th style="text-align: left;"> Source </th>
        </tr>
      </thead>
      @php
        $InquiryRequestInfo = $data->CCRResponse->CIRReportDataLst[0]->InquiryRequestInfo->InquiryPhones ?? null;
      @endphp
      <tbody>
        @if($InquiryRequestInfo)
          @foreach ($InquiryRequestInfo as $key => $InquiryRequestInfo)
          <tr>
            <td>{{ $InquiryRequestInfo->seq ?? 'N/A' }}</td>
            <td>{{ $InquiryRequestInfo->Number ?? 'N/A' }}</td>
            <td>
              @php
                $PhoneType = $InquiryRequestInfo->PhoneType;
              @endphp
              @if($PhoneType)
                @foreach ($PhoneType as $key => $value)
                  {{$value}}<br/>
                @endforeach
              @endif
            </td>
            <td></td>
          </tr>
          @endforeach
        @endif
        
      </tbody>
    </table>


    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">IDDetails:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Sno.</th>
          <th style="text-align: left;">IDType</th>
          <th style="text-align: left;">IDValue</th>
          <th style="text-align: left;"> Source </th>
        </tr>
      </thead>
      @php
        $IDDetails = $data->CCRResponse->CIRReportDataLst[$key]->InquiryRequestInfo->IDDetails ?? null;
      @endphp
      <tbody>
        @if($IDDetails)
          @foreach ($IDDetails as $key => $IDDetails)
          <tr>
            <td>{{ $IDDetails->seq ?? 'N/A' }}</td>
            <td>{{ $IDDetails->IDType ?? 'N/A' }}</td>
            <td>{{ $IDDetails->IDValue ?? 'N/A' }}</td>
            <td>{{ $IDDetails->Source ?? 'N/A' }}</td>
          </tr>
          @endforeach
        @endif
        
      </tbody>
    </table>

    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">IDDetails:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Sno.</th>
          <th style="text-align: left;">Institution</th>
          <th style="text-align: left;">Date</th>
          <th style="text-align: left;"> Time </th>
          <th style="text-align: left;"> RequestPurpose </th>
        </tr>
      </thead>
      @php
        $IDDetails = $data->CCRResponse->CIRReportDataLst[$key]->CIRReportData->Enquiries ?? null ;
      @endphp
      <tbody>
        @if($IDDetails)
          @foreach ($IDDetails as $key => $IDDetails)
            <tr>
              <td>{{ $IDDetails->seq ?? 'N/A' }}</td>
              <td>{{ $IDDetails->Institution ?? 'N/A' }}</td>
              <td>{{ $IDDetails->Date ?? 'N/A' }}</td>
              <td>{{ $IDDetails->Time ?? 'N/A' }}</td>
              <td>{{ $IDDetails->RequestPurpose ?? 'N/A' }}</td>
            </tr>
          @endforeach
          
        @endif
        
      </tbody>
    </table>

    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Enquiry Summary:
    </div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Purpose.</th>
          <th style="text-align: left;">Total</th>
          <th style="text-align: left;">Past30Days</th>
          <th style="text-align: left;"> Past12Months </th>
          <th style="text-align: left;"> Past24Months </th>
          <th style="text-align: left;"> Past24Months </th>
          <th style="text-align: left;"> Recent </th>
        </tr>
      </thead>
      @php
        $EnquirySummary = $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->EnquirySummary ?? null;
      @endphp
      <tbody>

        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->Purpose ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->Total ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->Past30Days ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->Past12Months ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->Past24Months ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->Recent ?? 'N/A' }}</td>

        </tr>

      </tbody>
    </table>

    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Other Key Ind:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">AgeOfOldestTrade.</th>
          <th style="text-align: left;">NumberOfOpenTrades</th>
          <th style="text-align: left;">AllLinesEVERWritten</th>
          <th style="text-align: left;"> AllLinesEVERWrittenIn9Months </th>
          <th style="text-align: left;"> AllLinesEVERWrittenIn6Months </th>
        </tr>
      </thead>
      @php
        $EnquirySummary = $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->OtherKeyInd ?? null;
      @endphp
      <tbody>

        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->AgeOfOldestTrade ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->NumberOfOpenTrades ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->AllLinesEVERWritten ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->AllLinesEVERWrittenIn9Months ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->AllLinesEVERWrittenIn6Months ?? 'N/A' }}</td>

        </tr>

      </tbody>
    </table>

    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Recent Activities:
    </div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">AccountsDeliquent.</th>
          <th style="text-align: left;">AccountsOpened</th>
          <th style="text-align: left;">TotalInquiries</th>
          <th style="text-align: left;"> AccountsUpdated </th>
          <th style="text-align: left;"> AllLinesEVERWrittenIn6Months </th>
        </tr>
      </thead>
      @php
        $EnquirySummary = $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RecentActivities ?? null;
      @endphp
      <tbody>

        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->AccountsDeliquent ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->AccountsOpened ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->TotalInquiries ?? 'N/A' }}</td>
          <td style="padding: 0px 8px; position: relative;">{{ $EnquirySummary->AccountsUpdated ?? 'N/A' }}</td>

        </tr>

      </tbody>
    </table>

    @endforeach
        @endif
    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Retail Accounts
      Summary:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">No Of Accounts</th>
          <th style="text-align: left;">No Of Active Accounts</th>
          <th style="text-align: left;"> NoOfWriteOffs </th>
          <th style="text-align: left;">TotalPastDue</th>
          <th style="text-align: left;">MostSevereStatusWithIn24Months</th>
          <th style="text-align: left;"> SingleHighestCredit </th>

          <!--                 <th style="text-align: left;">RecentAccount</th>
                <th style="text-align: left;">OldestAccount</th>
                <th style="text-align: left;"> TotalBalanceAmount </th>
                <th style="text-align: left;">TotalSanctionAmount</th>
                <th style="text-align: left;">TotalCreditLimit</th>
                <th style="text-align: left;"> TotalMonthlyPaymentAmount </th> -->
        </tr>
      </thead>

      <tbody>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">
            {{$data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->NoOfAccounts ?? 'N/A'}}
          </td>
          <td style="padding: 0px 8px; position: relative;">
            {{$data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->NoOfActiveAccounts ?? 'N/A'}}
          </td>
          <td style="padding: 0px 8px; position: relative;">
            {{$data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->NoOfWriteOffs ?? 'N/A'}}
          </td>
          <td style="padding: 0px 8px; position: relative;">
            {{$data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->TotalPastDue ?? 'N/A'}}
          </td>
          <td style="padding: 0px 8px; position: relative;">
            {{$data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->MostSevereStatusWithIn24Months ?? 'N/A'}}
          </td>
          <td style="padding: 0px 8px; position: relative;">
            {{$data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->SingleHighestCredit ?? 'N/A'}}
          </td>
        </tr>

      </tbody>
      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Highest Sanction Amt</th>
          <th style="text-align: left;">High Credit</th>
          <th style="text-align: left;"> Average Balance </th>
          <th style="text-align: left;">Highest Balance</th>
          <th style="text-align: left;">No Due Accounts</th>
          <th style="text-align: left;"> Zero Balance Accounts </th>
        </tr>
      </thead>
      <tbody>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">
            {{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->SingleHighestSanctionAmount ?? 'N/A' }}
          </td>
          <td style="padding: 0px 8px; position: relative;">
            {{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->TotalHighCredit ?? 'N/A' }}
          </td>
          <td style="padding: 0px 8px; position: relative;">
            {{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->AverageOpenBalance ?? 'N/A' }}
          </td>
          <td style="padding: 0px 8px; position: relative;">
            {{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->SingleHighestBalance ?? 'N/A' }}
          </td>
          <td style="padding: 0px 8px; position: relative;">
            {{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->NoOfPastDueAccounts ?? 'N/A' }}
          </td>
          <td style="padding: 0px 8px; position: relative;">
            {{ $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->NoOfZeroBalanceAccounts ?? 'N/A' }}
          </td>
        </tr>
      </tbody>
      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Recent Account</th>
          <th style="text-align: left;">Oldest Account</th>
          <th style="text-align: left;">Balance Amount </th>
          <th style="text-align: left;">Sanction Amount</th>
          <th style="text-align: left;">Credit Limit</th>
          <th style="text-align: left;"> Monthly Payment </th>
        </tr>
      </thead>
      <tbody>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">
              {{  $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->RecentAccount ?? 'N/A' }}
          </td>
          <td style="padding: 0px 8px; position: relative;">
              {{  $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->OldestAccount ?? 'N/A' }}
          </td>
          <td style="padding: 0px 8px; position: relative;">
              {{  $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->TotalBalanceAmount ?? 'N/A' }}
          </td>
          <td style="padding: 0px 8px; position: relative;">
              {{  $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->TotalSanctionAmount ?? 'N/A' }}
          </td>
          <td style="padding: 0px 8px; position: relative;">
              {{  $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->TotalCreditLimit ?? 'N/A' }}
          </td>
          <td style="padding: 0px 8px; position: relative;">
              {{  $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountsSummary->TotalMonthlyPaymentAmount ?? 'N/A' }}
          </td>
        </tr>
      </tbody>
    </table>
    @php
      $panData =  $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->IdentityInfo->VoterID ?? null;
    @endphp
    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Consumer Voter
      Verification:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Sno</th>
          <th style="text-align: left;">Reported Date</th>
          <th style="text-align: left;"> Id Number </th>
        </tr>
      </thead>
      <tbody>
        @if($panData)
        @foreach ($panData as $key => $value)
          <tr>
            <td>{{ $value->seq ?? 'N/A' }} </td>
            <td>{{ $value->ReportedDate ?? 'N/A' }} </td>
            <td>{{ $value->IdNumber ?? 'N/A' }} </td>
          </tr>
        @endforeach
          
        @endif

      </tbody>
    </table>


    @php
      $PANId =  $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->IdentityInfo->PANId ?? null;
    @endphp
    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Consumer PAN Verification:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Sno</th>
          <th style="text-align: left;">Reported Date</th>
          <th style="text-align: left;"> Id Number </th>
        </tr>
      </thead>
      <tbody>
        @if($PANId)
        @foreach ($PANId as $key => $value)
          <tr>
            <td>{{ $value->seq ?? 'N/A' }} </td>
            <td>{{ $value->ReportedDate ?? 'N/A' }} </td>
            <td>{{ $value->IdNumber ?? 'N/A' }} </td>
          </tr>
        @endforeach
          
        @endif
      </tbody>
    </table>


    @php
      $NationalIDCard =  $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->IdentityInfo->NationalIDCard ?? null;
    @endphp
    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Consumer National ID Card Verification:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Sno</th>
          <th style="text-align: left;">Reported Date</th>
          <th style="text-align: left;"> Id Number </th>
        </tr>
      </thead>
      <tbody>
        @if($NationalIDCard)
        @foreach ($NationalIDCard as $key => $value)
          <tr>
            <td>{{ $value->seq ?? 'N/A' }} </td>
            <td>{{ $value->ReportedDate ?? 'N/A' }} </td>
            <td>{{ $value->IdNumber ?? 'N/A' }} </td>
          </tr>
        @endforeach
          @endif
      </tbody>
    </table>

    @php
      $RationCard =  $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IDAndContactInfo->IdentityInfo->RationCard ?? null;
    @endphp
    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Ration Card:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Sno</th>
          <th style="text-align: left;">Reported Date</th>
          <th style="text-align: left;"> Id Number </th>
        </tr>
      </thead>
      <tbody>
        @if($RationCard)
        @foreach ($RationCard as $key => $value)
          <tr>
            <td>{{ $value->seq ?? 'N/A' }} </td>
            <td>{{ $value->ReportedDate ?? 'N/A' }} </td>
            <td>{{ $value->IdNumber ?? 'N/A' }} </td>
          </tr>
        @endforeach
          @endif
      </tbody>
    </table>


    @php
      $Passport =   $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IdentityInfo->Passport ?? null;
    @endphp
    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Consumer Passport
      Verification:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Sno</th>
          <th style="text-align: left;">Reported Date</th>
          <th style="text-align: left;"> Id Number </th>
        </tr>
      </thead>
      <tbody>
        @if($Passport)
        @foreach ($Passport as $key => $value)
          <tr>
            <td>{{ $value->seq ?? 'N/A' }} </td>
            <td>{{ $value->ReportedDate ?? 'N/A' }} </td>
            <td>{{ $value->IdNumber ?? 'N/A' }} </td>
          </tr>
        @endforeach
          @endif
      </tbody>
    </table>

    @php
      $RetailAccountDetails =   $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->RetailAccountDetails ?? null; 
    @endphp
    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Retail Account Details:</div>
    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Sno</th>
          <th style="text-align: left;">AccountType</th>
          <th style="text-align: left;"> Balance </th>
          <th style="text-align: left;"> LastPayment </th>
          <th style="text-align: left;"> Open </th>
          <th style="text-align: left;"> HighCredit </th>
          <th style="text-align: left;"> AccountStatus </th>
          <th style="text-align: left;"> LastPaymentDate </th>
          <th style="text-align: left;"> CreditLimit </th>
        </tr>
      </thead>
      <tbody>
        @if($RetailAccountDetails)
          @foreach ($RetailAccountDetails as $key => $value)
            <tr>
              <td>{{ $value->seq ?? 'N/A' }}</td>
              <td>{{ $value->AccountType ?? 'N/A' }}</td>
              <td>{{ $value->Balance ?? 'N/A' }}</td>
              <td>{{ $value->LastPayment ?? 'N/A' }}</td>
              <td>{{ $value->Open ?? 'N/A' }}</td>
              <td>{{ $value->HighCredit ?? 'N/A' }}</td>
              <td>{{ $value->AccountStatus ?? 'N/A' }}</td>
              <td>{{ $value->LastPaymentDate ?? 'N/A' }}</td>
              <td>{{ $value->CreditLimit ?? 'N/A' }}</td>
            </tr>
          @endforeach
        @endif

      </tbody>
    </table>

    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Consumer Address:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Type</th>
          <th style="text-align: left;">Address</th>
          <th style="text-align: left;"> State </th>
          <th style="text-align: left;">Postal</th>
          <th style="text-align: left;">Date Reported</th>
        </tr>
      </thead>
      @php
        $address = $data->CCRResponse->CIRReportDataLst[0]->CIRReportData->IdentityInfo->AddressInfo ?? null;
      @endphp
      <tbody>
        @if($address)
          @foreach ($address as $key => $value)
            
            <tr>
              <td>{{ $value->Type ?? 'N/A' }}</td>
              <td>{{ $value->Address ?? 'N/A' }}</td>
              <td>{{ $value->State ?? 'N/A' }}</td>
              <td>{{ $value->Postal ?? 'N/A' }}</td>
              <td>{{ $value->ReportedDate ?? 'N/A' }}</td>
            </tr>
          @endforeach
        @endif

      </tbody>
    </table>

    <table class="table"
      style="width:100%; padding-bottom:10px; margin-top: 20px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Consumer-Recent Activity</th>
          <th style="text-align: left;"></th>
          <th style="text-align: left;"></th>
          <th style="text-align: left;"></th>

        </tr>
      </thead>
      <tbody>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Number Of Enquires: <span class="line_sample"
              style="position:absolute; right:60px;">-</span></td>
          <td style="padding: 0px 8px; position: relative;">Accounts Opened: <span class="line_sample"
              style="position:absolute; right:60px;">-</span></td>
          <td style="padding: 0px 8px; position: relative;">Accounts Updated: <span class="line_sample"
              style="position:absolute; right:60px;">-</span></td>
          <td style="padding: 0px 8px; position: relative;">Accounts Delinquent: <span class="line_sample"
              style="position:absolute; right:60px;">-</span></td>
        </tr>
      </tbody>
    </table>

    <table class="table"
      style="width:100%; padding-bottom:10px; margin-top: 20px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Consumer-Other Key Credit Profile Indicator</th>
          <th style="text-align: left;"></th>
          <th style="text-align: left;"></th>
          <th style="text-align: left;"></th>

        </tr>
      </thead>
      <tbody>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Age Of Oldest Trade (months): <span class="line_sample"
              style="position:absolute; right:60px;">-</span></td>
          <td style="padding: 0px 8px; position: relative;">%All Lines Ever Written Off: <span class="line_sample"
              style="position:absolute; right:60px;">-</span></td>

        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Number Of Open Trades: <span class="line_sample"
              style="position:absolute; right:60px;">-</span></td>
          <td style="padding: 0px 8px; position: relative;">All Lines Ever Written Off Within 9 Months Of Origination:
            <span class="line_sample" style="position:absolute; right:60px;">-</span></td>

        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;"></td>
          <td style="padding: 0px 8px; position: relative;">All Lines Ever Written Off Within 6 Months Of Origination:
            <span class="line_sample" style="position:absolute; right:60px;">-</span></td>

        </tr>
      </tbody>
    </table>


    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;display: none;">Product
      Code : Applicable for MFI</div>
    <table class="table"
      style="display: none;width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th>Personal Information</th>
          <th>Identification</th>
          <th>Family Details</th>
        </tr>
      </thead>
      <tbody>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Full Name:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">PAN: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Home:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>

        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Alias Name:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Ration Card: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Office:<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>

        </tr>

        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Dob: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">UID: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Mobile: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Age: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Voter ID: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Alt. Mobile: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Gender: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Driver License: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;"><span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Total Income: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Passport ID: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Email: <span class="line_sample"
              style="position:absolute; right:60px;">
            </span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Occupation <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Photo Credit Card: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">ID Other: <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
      </tbody>
    </table>




    <table class="table"
      style="width:100%; padding-bottom:10px; margin-top: 20px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left;">Consumer-Other Key Credit Profile Indicator</th>
          <th style="text-align: left;"></th>
          <th style="text-align: left;"></th>
          <th style="text-align: left;"></th>

        </tr>
      </thead>
      <tbody>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Age Of Oldest Trade (months): <span class="line_sample"
              style="position:absolute; right:60px;">-</span></td>
          <td style="padding: 0px 8px; position: relative;">%All Lines Ever Written Off: <span class="line_sample"
              style="position:absolute; right:60px;">-</span></td>

        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">Number Of Open Trades: <span class="line_sample"
              style="position:absolute; right:60px;">-</span></td>
          <td style="padding: 0px 8px; position: relative;">All Lines Ever Written Off Within 9 Months Of Origination:
            <span class="line_sample" style="position:absolute; right:60px;">-</span></td>

        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;"></td>
          <td style="padding: 0px 8px; position: relative;">All Lines Ever Written Off Within 6 Months Of Origination:
            <span class="line_sample" style="position:absolute; right:60px;">-</span></td>

        </tr>
      </tbody>
    </table>

    <div class="common_title" style="margin: 30px 0px 10px 0px; font-size:18px; font-weight:bold;">Glossary, Terms &amp;
      Explanations:</div>

    <div class="common_title" style="margin: 10px 0px 10px 0px; font-size:18px; font-weight:bold;"> History:</div>

    <table class="table"
      style="width:100%; padding-bottom:10px; border: 0; border-spacing: 0; border-collapse: collapse; border: 1px solid rgb(144, 143, 143); border-bottom: 2px solid rgb(144, 143, 143);">

      <thead style=" background: #dde2ff; font-size: 19px;  color: #373737; height: 37px;">
        <tr>
          <th style="text-align: left; width: 50%;">Code</th>
          <th style="text-align: left; width: 50%;">Address</th>
        </tr>
      </thead>
      <tbody>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">*<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">Data Not Reported <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">0<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">current account <span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
        <tr style="height: 32px; font-size: 19px; color: #464646;">
          <td style="padding: 0px 8px; position: relative;">121+<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
          <td style="padding: 0px 8px; position: relative;">1-30 days past due<span class="line_sample"
              style="position:absolute; right:60px;"></span></td>
        </tr>
      </tbody>
    </table>

    @else
    <p style="text-align: center"><b>{{$data->CCRResponse->CIRReportDataLst->Error->ErrorDesc}}</b></p>
    @endif


    <p style="padding-top: 30px; font-size: 14px; line-height: 25px; color: #646464;">Contact
      Us: Phone: 1800 209 3247 Fax: +91-22-6112-7950 Email:
      ecissupport@equifaxindia.com. This report is to be used subject to and
      in compliance
      with the Membership agreement entered into between the
      Member/Specified User and Equifax Credit Information Services Private
      Limited ("ECIS"), in
      the case of Members/Specified Users of ECIS. In other
      cases, the use of this report is governed by the terms and conditions of
      ECIS, contained in the
      Application form submitted by the customer/user. The
      information contained in this report is derived from various
      Members/sources which are not
      controlled by ECIS. ECIS provides this report on a
      best effort basis and does not guarantee the timeliness, correctness or
      completeness of the information
      contained therein, except as explicitly stated in the
      Membership agreement/terms and conditions of ECIS, as the case may be.</p>

  </div>



  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
  <script>
    $('.js__action--print').click(function () {
      window.print();
      return false;
    });
  </script>



</body>

</html>