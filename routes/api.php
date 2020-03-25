<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('auth/logout', 'Api\Auth\LoginController@logout');
    Route::group(['middleware' => ['verified']], function () {   
        Route::prefix('auth/')->group(function(){
            Route::prefix('user/')->group(function (){
                Route::post('/', 'User\DashboardController@user');
                Route::post('account-type', 'User\DashboardController@accountType');
                Route::post('add-bank', 'User\BankAccountController@store');
                Route::post('dashboard/', 'User\DashboardController@user');
                Route::post('savings/', 'User\SavingsController@getUserSavings');
                Route::post('account/', 'User\DashboardController@accountInfo');
                Route::prefix('transactions')->group(function (){
                    Route::post('deposit/', 'User\SavingsController@store');
                    Route::post('history/', 'User\TransactionController@index');
                    Route::post('withdraw/', 'User\SavingsController@withdraw');
                    Route::post('transfer/', 'User\TransferController@transferFunds');
                    Route::post('qt-code', 'User\QRCodeController@generateId'); 
                    Route::post('send-otp', 'User\UserOAuth@sendOtp'); 
                });
            });
        });
    });
});
Route::group(['verify' => true], function () {  
    Route::prefix('auth/')->group(function (){
        Route::post('register/', 'Api\Auth\RegisterController@register');
        Route::post('login/', 'Api\Auth\LoginController@login')->middleware('verified');
    });
});
Route::prefix('email/')->group(function (){
    Route::get('verify/{id}', 'Api\Auth\VerificationApiController@verify')->name('verificationapi.verify');
    Route::get('resend/', 'Api\Auth\VerificationApiController@resend')->name('verificationapi.resend');
});

Route::prefix('otp/')->group(function(){
    Route::post('validation', 'Api\Auth\VerificationApiController@validateOtp');
});