<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class DeviationRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'deviationLoanAmount',
        'deviationLoanAmountR',
        'deviationLoanTenure',
        'deviationLoanTenureR',
        'deviationNegativePD',
        'deviationNegativePDR',
        'deviationNegativeCibil',
        'deviationNegativeCibilR',
        'deviationNegativeCpvFI',
        'deviationNegativeCpvFIR',
        'deviationNegativeEligibility',
        'deviationNegativeEligibilityR',
        'deviationNegativeProfile',
        'deviationNegativeProfileR',
        'overAllDeviationRemark'
    ];

}
