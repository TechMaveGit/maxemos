<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ApplyLoanHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'bankId',
        'loanAmount',
        'tenure',
        'status',
        'productId',
        'loanCategory',
        'roiType',
        'rateOfInterest',
        'approvedAmount',
        'netDisbursementAmount',
        'approvedTenure',
        'monthlyEMI',
        'totalInterest',
        'emisDetailsStr',
        'principleCharges',
        'principleChargesDetails',
        'invoiceFile',
        'extraAmountDays',
        'extraIntrestAmount',
        'disbursedDate',
        'validFromDate',
        'validToDate',
        'remark',
        'isPreClosed',
        'preCloserId'
    ];

    public static function getRawMaterialAppliedLoans($userId)
    {
        $loanDetails=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.userId='$userId' and alh.loanCategory='3' AND (alh.status='customer-approved' OR alh.status='closed' OR alh.status='noc-issued') ORDER BY alh.id DESC");
        return $loanDetails;
    }

    public static function getAllAppliedLoans($userId)
    {
        $loanDetails=DB::select("SELECT alh.*,c.name as categoryName,p.productName,t1.name as appliedTenureD,t2.name as approvedTenureD FROM apply_loan_histories alh LEFT JOIN categories c ON alh.loanCategory=c.id LEFT JOIN products p ON alh.productId=p.id LEFT JOIN tenures t1 ON alh.tenure=t1.id LEFT JOIN tenures t2 ON alh.approvedTenure=t2.id where alh.userId='$userId' ORDER BY alh.id DESC");
        return $loanDetails;
    }
}
