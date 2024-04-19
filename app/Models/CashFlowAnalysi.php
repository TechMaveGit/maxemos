<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFlowAnalysi extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'userId',
        'sourceOfIncome',
        'cfaSale',
        'cfaMargin',
        'cfaGrossMargin',
        'cfaAmountAvailable',
        'cfaElectricityBillOfResidence',
        'cfaElectricityBillOfBusiness',
        'cfaResidenceBusinessPermissesRent',
        'cfaHouseHoldExpense',
        'cfaSalary',
        'cfaMiscExpenses',
        'cfaSchoolFee',
        'cfaGrossAmountAvailable',
        'cfaRunningEmi',
        'cfaCreditCardEMi',
        'cfaProposedEmi',
        'cfaNetAmountAvailable',
        'cfaFOIR',
        'cfaNetMonthlyIncome'
    ];
}
