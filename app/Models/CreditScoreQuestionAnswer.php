<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditScoreQuestionAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'questionId',
        'ansTitle',
        'otherValueOrDays',
        'correctAns',
        'scorePositive',
        'scoreNegative',
        'status',
    ];
}
