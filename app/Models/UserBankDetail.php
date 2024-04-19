<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBankDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'accountHolderName',
        'bankName',
        'ifscCode',
        'accountType',
        'accountNumber',
        'address',
        'state',
        'city',
        'pincode',
        'apisLog',
    ];
}
