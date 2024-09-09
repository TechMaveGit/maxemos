<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        "id","career_post_id","full_name","email","mobile","describe_work","cv"
    ];
}
