<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'categoryId',
        'subCategoryId',
        'productCode',
        'productName',
        'tenure',
        'amount',
        'amountTo',
        'numOfEmi',
        'description',
        'image',
        'productType',
        'rateOfInterest',
        'pfPercentage',
        'gst',
        'premium',
        'processingFee',
        'insurance',
        'verificationCharges',
        'collectionFee',
        'plateformFee',
        'convenienceFee',
        'principleAmount',
        'status',
    ];
}
