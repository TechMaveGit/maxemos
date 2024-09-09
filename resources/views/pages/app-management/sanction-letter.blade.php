<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanction Letter</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
    </style>
    @php
      $loanData = DB::table('apply_loan_histories')->leftJoin('users','users.id','apply_loan_histories.userId')->leftJoin('categories','categories.id','apply_loan_histories.loanCategory')->leftJoin('tenures','tenures.id','apply_loan_histories.approvedTenure')->leftJoin('user_bank_details','user_bank_details.userId','users.id')->select('user_bank_details.accountHolderName','user_bank_details.bankName','user_bank_details.accountNumber','user_bank_details.ifscCode','user_bank_details.address AS bank_address','user_bank_details.state AS bank_state','user_bank_details.city AS bank_city','user_bank_details.pincode AS bank_pincode','categories.name AS cate_name','tenures.name AS t_name','users.name AS employerName','users.addressLine1 AS emh_addressLine1','users.city as emh_city','users.district AS emh_district','users.state AS emh_state','users.pincode AS emh_pincode','apply_loan_histories.*')->where('apply_loan_histories.id',$app_data)->first();
      $co_applicant = DB::table('co_applicant_details')->where('userId',$loanData->userId)->select('nameTitleCoApp','customerNameCoApp')->get();
      
      $principleChargesDetails = json_decode($loanData->principleChargesDetails,true);
      $processingFee = $principleChargesDetails['processingFee']??0;
      $co_applicant_details = null;
      $co_applicant_detail_str = '';
      if($co_applicant){
        foreach ($co_applicant as $coap) {
          $co_applicant_details[] = $coap->nameTitleCoApp.' '.$coap->customerNameCoApp;
        }
      }
      if($co_applicant_details) $co_applicant_detail_str = implode(', ',$co_applicant_details);

      $disbursedDate = $loanData->disbursedDate;

      if($loanData->loanCategory == 3){
        $disbursedDate = $loanData->validFromDate;
        $ts1 = strtotime($loanData->validFromDate);
        $ts2 = strtotime($loanData->validToDate);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
      }else{
        $diff = $loanData->t_name;
      }
    @endphp
</head>
<body>
    <div class="wrapper" style="width:80%; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; margin: 35px auto;">
       <div class="content_box" style="padding: 35px;">
          <div class="logo" style="text-align: end;">
            <h1>Maxemo</h1>
          </div>
          <div class="top_cx" style="display:flex; align-items: center; justify-content: space-between; margin-top: 20px;">
            <p style="margin:0;">Ref. No. MCSPL/BL/{{date('y')}}/LF0{{$loanData->id}}</p>
            <p style="margin:0;"><strong>Date:</strong> {{$disbursedDate??'-'}}</p>
          </div>
       
          <p style="margin:30px 0;">To</p>

          <p>NAME :- {{$loanData->employerName??'-'}}</p>
          <p>ADDRESS :- {{$loanData->emh_addressLine1??'-'}} {{$loanData->emh_district??'-'}} {{$loanData->emh_city??'-'}} {{$loanData->emh_state??'-'}} {{$loanData->emh_pincode??'-'}}</p>

          <p style="margin: 30px 0;">Sir/Madam,</p>

          <h6 style="font-size: 14px; margin-bottom: 0;">Sanction of Loan from MAXEMO CAPITAL SERVICES PRIVATE LIMITED vide Loan ID- MCSPL/BL/{{date('y')}}/LF0{{$loanData->id}}</h6>
          <p>Thank you for choosing <strong>MAXEMO CAPITAL SERVICES PRIVATE LIMITED</strong> . We are pleased to inform you that with reference to the above loan ID we have in principle sanctioned you the loan, which will be transferred within 7 working days to the Bank account of Borrower or Co-borrower, the details of which are given below:</p>
       
          <table style="border: 1px solid #000; border-bottom:none; border-right:none; border-collapse: collapse;
          width: 100%; margin: 20px 0;">
             <tr>
              <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Borrower</th>
              <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">{{$loanData->employerName??'-'}}</td>
            </tr>
            <tr>
                <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Guarantor</th>
                <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">{{$co_applicant_detail_str}}</td>
              </tr>
              <tr>
                <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Purpose of Loan</th>
                <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">{{$loanData->cate_name??'-'}}</td>
              </tr>
              <tr>
                <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Drawing Period</th>
                <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">{{$loanData->t_name??'-'}}</td>
              </tr>
              <tr>
                <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;"> Loan Amount Applied</th>
                <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Rs. {{$loanData->loanAmount??'-'}}/-</td>
              </tr>
              <tr>
                <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;"> @if($loanData->loanCategory == 3) Limit Sanctioned @else Approved Loan Amount @endif</th>
                <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Rs. @if($loanData->loanCategory == 3) {{$loanData->approvedAmount??'-'}} @else {{$loanData->approvedAmount??'-'}} @endif/-</td>
              </tr>
              <tr>
                <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;"> Repayment Period</th>
                <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">{{$diff??'-'}}</td>
              </tr>
              <tr>
                <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Prepayment Terms</th>
                <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">
                    <ol style="padding-left: 18px;">
                        <li style="margin-bottom:10px;">Drawdown Days as per days offered 60 days from the raise of invoice date.</li>
                        <li style="margin-bottom:10px;">Any prepayment done through electronic mode like NEFT/ RTGS/ Debit Card/ UPI/ Cash etc. to be updated automatically to eliminate the error of NACH running to the account.</li>
                    </ol>
                </td>
              </tr>
              <tr>
                <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Rate of Interest</th>
                <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">{{$loanData->rateOfInterest}}% Reducing In case of delay in repayment of the principal installment and or payment of interest installment, penal interest on the overdue amount in default for the period of delay will be charged at 3% over and above the applicable interest rate</td>
              </tr>
              <tr>
                <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Loan Processing Fee</th>
                <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Rs.{{$processingFee}} (Included 18% GST) will be collected upfront at the time of disbursement.</td>
              </tr>
              <tr>
                <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Security- Post Dated Cheque (PDC)</th>
                <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">5 Post Dated Cheque’s shall be provided for the entire loan amount by the borrower.</td>
              </tr>
              <tr>
                <th style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">Bank Account Details</th>
                <td style="border-right: 1px solid #000;border-bottom: 1px solid #000;padding: 10px;">
                    <ul style="padding-left: 0px; list-style: none;">
                        <li style="margin-bottom:10px;"><strong>Bank Name</strong> - {{$loanData->bankName??''}}</li>
                        <li style="margin-bottom:10px;"><strong>Account Number</strong> - {{$loanData->accountNumber??''}}</li>
                        <li style="margin-bottom:10px;"><strong>IFSC Code</strong> - {{$loanData->ifscCode??''}}</li>
                        <li style="margin-bottom:10px;"><strong>Bank Address </strong> - {{$loanData->bank_address??''}} {{$loanData->bank_state??''}} {{$loanData->bank_city??''}} {{$loanData->bank_pincode??''}}</li>
                        <li style="margin-bottom:10px;"><strong>Name Of Account Holder</strong> - {{$loanData->accountHolderName??''}}</li>

                    </ul>
                </td>
              </tr>
          </table>
          <p><strong style="color: rgb(255, 91, 91);">Note : </strong>Kindly find sanction letter in attachment</p>
          <br/>
          <br/>

          <h5 style="margin-bottom: 15px;">OTHER TERMS & CONDITIONS: </h5>
          <p style="margin-bottom: 15px;">The Proposed Loan should be Cancelled or Revoked without any prior Information/Notice in case of the following circumstances:</p>
          <ol style="padding-left: 18px;">
            <li style="margin-bottom:20px;">If the statements in the Loan Application or the documents / proofs filed by the Applicant (s) were found to be false or misleading.</li>
            <li style="margin-bottom:20px;">If any information concerning the income and ability to repay the Loan would be wrongly furnished or suppressed,</li>
            <li style="margin-bottom:20px;">If the Applicant failed to submit the requisite documents within specified time. </li>
            <li style="margin-bottom:20px;">Any other reason at the sole discretion of the MCSPL.</li>
            <li style="margin-bottom:20px;">MCSPL reserves the right to appropriate the collections first to charges if any, penal interest, interest, and then to the principal.</li>
            <li style="margin-bottom:20px;">6.	If the Borrowers fail to pay the instalment amount together with interest due, within 30 days from the due date, MCSPL shall have the right to demand payment of the entire Loan Amount outstanding. Further, after three (3) months of the due date of the 1st Instalment which is not repaid, the MCSPL, shall take appropriate steps in order to recover the loan amount, besides taking legal action, for recovery of entire loan amount outstanding, along with penalty, future interest and litigation charges.</li>
          </ol>

          <h6 style="font-size: 16px; margin-bottom: 50px; margin-top:30px">For Maxemo Capital Services Pvt Ltd</h6>
          <h6 style="font-size: 16px; margin-bottom: 50px;">MCSPL Authorized Signatory</h6>
          <h6 style="font-size: 16px; margin-bottom: 50px;">Accepted by:</h6>
          <h6 style="font-size: 15px; margin-bottom: 50px;">Name and Signatures of the Borrower (Authorized signatory):  {{$loanData->employerName??'-'}}</h6>
          <h6 style="font-size: 15px;">Name and Signatures of the Guarantor: <span style="border-bottom:1px solid #000; width:100px;display: inline-block;"></span></h6>
        </div>
    </div>
</body>
</html>