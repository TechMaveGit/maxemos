<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDiscussionOnCall extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'residentialAddressFromHowTimeLiving',
        'presentAddressISParmanentAdd',
        'businessVintageProof',
        'businessDesctiotion',
        'hasABoardingOrOnboarding',
        'businessDetails',
        'businessPics',
        'kmBusinessHowLongFromBranch',
        'existingCustomer',
        'pdDoneBy',
        'pdDoneDate',
        'avgBankBalance',
        'creditSummation',
        'creditTransaction',
        'overAllStatus',
    ];
}
