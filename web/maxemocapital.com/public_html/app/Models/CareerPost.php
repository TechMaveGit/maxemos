<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerPost extends Model
{
    use HasFactory;
    protected $fillable = [
        "id","title","location","no_of_postions","details","opening_date","closing_date" 
    ];
}
