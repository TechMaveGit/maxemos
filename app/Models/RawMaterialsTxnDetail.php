<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialsTxnDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'loanId',
        'debitRecordId',
        'txnGroupId',
        'amount',
        'openingDate',
        'openingBalance',
        'openingBalanceLatest',
        'interestAmount',
        'interestAmountPayble',
        'tdsPercent',
        'tdsAmount',
        'totalAmount',
        'extraForwardedAmount',
        'status',
        'transactionId',
        'payment_mode',
        'transactionDate',
        'numOfDays',
        'txnType',
        'outstandingBalance',
        'interestStartDate',
        'approvedTenure',
        'tenureDueDate',
        'isFullSettled',
        'lateCharges',
        'numOfDaysOfFine',
        'remark',
    ];
}
