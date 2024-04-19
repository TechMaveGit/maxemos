<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutStandingPaymentHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'loanId',
        'amount',
        'type',
        'txnId',
        'txnDate',
        'paymentMode',
    ];
}
