<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'customerCode',
        'titleName',
        'name',
        'mobile',
        'email',
        'password',
        'gender',
        'profilePic',
        'dateOfBirth',
        'maritalStatus',
        'addressLine1',
        'addressLine2',
        'city',
        'state',
        'state_short',
        'district',
        'pincode',
        'deviceToken',
        'userMpin',
        'aadhaar_no',
        'pancard_no',
        'religion',
        'educationStatus',
        'fatherName',
        'motherName',
        'sourcePerson',
        'branchName',
        'cibilScore',
        'deviceType',
        'deviceId',
        'userType',
        'remember_token',
        'kycStatus',
        'viewKycDetails',
        'viewPersonalDetails',
        'viewProfessionalDetails',
        'viewBankDetails',
        'userPermissions',
        'initialConcentData',
        'initialConcentApproval',
        'lattitude',
        'longitude',
        'status',
    ];

    public static function getUserDetailsById($userId)
    {
        $userColmnsStr="u.id,u.customerCode,u.sourcePersonNumber,u.nameTitle,u.name,u.mobile,u.email,u.password,u.profilePic,u.dateOfBirth,u.addressLine1,u.addressLine2,u.city,u.state,u.district,u.pincode,u.deviceToken,u.userMpin,u.aadhaar_no,u.pancard_no,u.religion,u.educationStatus,u.fatherName,u.motherName,u.sourcePerson,u.branchName,u.cibilScore,u.gender,u.maritalStatus,u.kycStatus,u.deviceId,u.userType,u.viewKycDetails,u.viewPersonalDetails,u.viewProfessionalDetails,u.viewBankDetails,u.remember_token,u.status,u.lattitude,u.longitude,u.created_at,u.updated_at";
        //$RES=DB::select("SELECT $userColmnsStr,genca.ansTitle as gender,marica.ansTitle as maritalStatus FROM users u LEFT JOIN credit_score_question_answers genca ON u.gender=genca.id LEFT JOIN credit_score_question_answers marica ON u.maritalStatus=marica.id WHERE u.id='$userId'");
        $RES=DB::select("SELECT $userColmnsStr FROM users u WHERE u.id='$userId'");
        if(count($RES)){
            return $RES[0];
        }else{
            return false;
        }
    }

    public static function checkMobileIfExists($userId,$mobile)
    {
        if($userId){
            $RES=DB::select("select * from users where mobile='$mobile' and  id !='$userId'");
        }else{
            $RES=DB::select("select * from users where mobile='$mobile'");
        }

        if(count($RES)){
            return count($RES);
        }else{
            return false;
        }
    }

    public function pendingloans()
    {
        return $this->hasMany(ApplyLoanHistory::class,'userId','id')->where('loanCategory',3)->whereIn('status',['customer-approved','disbursed']);
    }
}
