<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanEmiDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'loanId',
        'emiId',
        'emiSr',
        'emiAmount',
        'netemiAmount',
        'interest',
        'tdsAmount',
        'netInterest',
        'principle',
        'balance',
        'emiDate',
        'emiDueDate',
        'status',
        'transactionId',
        'payment_mode',
        'transactionDate',
        'lateCharges',
        'remark',
        'isPreClosed',
        'preCloserId',
        'reminderSent',
        'reminderSentDate',
    ];
}
