<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenure extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'loanCategory',
        'name',
        'numOfMonths',
        'numOfEmis',
        'sortOrder',
        'status',
    ];
}
