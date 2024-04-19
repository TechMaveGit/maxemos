<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechSupport extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description',
        'images',
        'priority',
        'status',
        'solvedDate',
        'ticketDate',
    ];
}
