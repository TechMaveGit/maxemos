<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'employerName',
        'emailId',
        'mobileNo',
        'companyTeleNo',
        'companyFaxNo',
        'companyGstin',
        'companyPan',
        'companyType',
        'address',
        'district',
        'state',
        'pincode',
        'totalExpInCurrentCompany',
        'currentSalary',
        'fromAdmin',
        'isBusiness',
        'status',
        'remark',
    ];
}
