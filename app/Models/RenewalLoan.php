<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewalLoan extends Model
{
    use HasFactory;
    protected $fillable = [
        'loanid',
        'userId',
        'plateform_fee',
        'renewal_from',
        'renewal_to',
        'txn_date',
        'type_renewal',
        'lastAmount',
        'updatedAmount'
    ];
}
