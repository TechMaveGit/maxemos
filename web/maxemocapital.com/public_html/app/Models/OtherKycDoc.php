<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherKycDoc extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'title',
        'docsUrl',
    ];
}
