<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDoc extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'idProofFront',
        'idProofBack',
        'panCardFront',
        'addressProofFront',
        'addressProofBack',
        'salerySlip1',
        'salerySlip2',
        'salerySlip3',
        'bankAttachemet',
        'otherDocument',
        'otherDocumentTitle',
        'aadhaarLog',
        'pancardLog',
        'userAboutVideo',
    ];
}
