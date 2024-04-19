<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPreCloserHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'loanId',
        'isWithCharges',
        'principleDeposit',
        'posChargePercentage',
        'posChargeAmount',
        'gstPercentage',
        'gstAmount',
        'totalPreCloserAmount',
        'totalPaybleAmount',
        'paymentMode',
        'remark',
        'transactionDate',
    ];
}
