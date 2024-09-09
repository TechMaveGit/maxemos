<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanKycOtherPendetail extends Model
{
    use HasFactory;
    protected $fillable = ['userId','name','fatherName','dateOfBirth','gender','mobile','email','pancard_img','pancard_no','addressLine1','city','state_short','state','pincode'];
}
