<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Payments\EmiWebhookController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/enash-success',[EmiWebhookController::class,'easebuzzEmiWebhook']);
Route::match(['get', 'post'],'/enash-failed',[EmiWebhookController::class,'easebuzzEmiWebhook']);

// Route::any('/enash-failed',function(Request $request){
//     Storage::disk('local')->put('enash-failed-method.txt', $request->method());
//     Storage::disk('local')->put('enash-failed'.time().'.txt', $request->getContent());
//     Storage::disk('local')->put('enash-failed'.time().'.json', $request->getContent());
// });
//Route::post('ocr_adhaar_verification',[CustomerController::class,'ocr_adhaar_verification'])->name('ocr_adhaar_verification');

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
