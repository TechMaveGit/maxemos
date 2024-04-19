<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoApplicantDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'nameTitleCoApp',
        'customerNameCoApp',
        'genderCoApp',
        'dateOfBirthCoApp',
        'religionCoApp',
        'educationStatusCoApp',
        'fatherNameCoApp',
        'motherNameCoApp',
        'maritalStatusCoApp',
        'relationWithApplicantCoApp',
        'cibilScoreCoApp',
        'status',
    ];
}
