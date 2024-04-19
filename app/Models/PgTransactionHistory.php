<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PgTransactionHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'loanId',
        'orderId',
        'txnId',
        'amount',
        'transactionDate',
        'paymentStatus',
        'responseData',
    ];
}
