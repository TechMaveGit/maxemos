<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialsLoanRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan_id','loanAmount','approvedAmount','disburse_date','user_id','status'
    ];
}
