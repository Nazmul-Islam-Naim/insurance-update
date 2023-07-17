<?php

use App\Http\Controllers\RequisitionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/map', function () {
    return view('map');
});

Auth::routes();
Route::group(['middleware'=>['auth']],function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index2'])->name('home2');

    //****** Accounts ***********//
    Route::prefix(config('app.account'))->group(function () {
        Route::resource('account-type', 'App\Http\Controllers\AccountTypeController');
        Route::resource('bank-account', 'App\Http\Controllers\BankAccountController');
        Route::get('bank-deposit/{id}', 'App\Http\Controllers\BankDepositController@bankDeposit');
        Route::resource('bank-deposit', 'App\Http\Controllers\BankDepositController');
        Route::get('amount-transfer/{id}', 'App\Http\Controllers\AmountTransferController@amountTransfer');
        Route::resource('amount-transfer', 'App\Http\Controllers\AmountTransferController');
        Route::get('amount-withdraw/{id}', 'App\Http\Controllers\AmountWithdrawController@amountWithdraw');
        Route::resource('amount-withdraw', 'App\Http\Controllers\AmountWithdrawController');
        Route::get('bank-report/{id}', 'App\Http\Controllers\BankAccountController@showBankReport');
        Route::post('bank-report/{id}', 'App\Http\Controllers\BankAccountController@showBankReportFilter')->name('bank-report.filter');
        Route::post('find-chequeno-with-chequebook-id', 'App\Http\Controllers\AmountWithdrawController@findChequeNoWithChequeBookId');
        Route::resource('cheque-book', 'App\Http\Controllers\ChequeBookController');
        Route::resource('cheque-no', 'App\Http\Controllers\ChequeNoController');
        Route::resource('daily-transaction', 'App\Http\Controllers\DailyTransactionController');
        Route::post('daily-transaction', 'App\Http\Controllers\DailyTransactionController@filter')->name('transaction.filter');
        // get overall income report
        Route::get('overall-income-report', 'App\Http\Controllers\DailyTransactionController@overallIncomeReport');
        Route::post('overall-income-report', 'App\Http\Controllers\DailyTransactionController@overallIncomeReportFiltering')->name('overall-income-report.filter');
        // get overall income report
        Route::get('overall-expense-report', 'App\Http\Controllers\DailyTransactionController@overallExpenseReport');
        Route::post('overall-expense-report', 'App\Http\Controllers\DailyTransactionController@overallExpenseReportFiltering')->name('overall-expense-report.filter');
    });

    //******** Other Receive *******//
    Route::prefix(config('app.or'))->group(function () {
        Route::resource('receive-type', 'App\Http\Controllers\ReceiveTypeController');
        Route::resource('receive-sub-type', 'App\Http\Controllers\ReceiveSubTypeController');
        Route::resource('receive-voucher', 'App\Http\Controllers\ReceiveVoucherController');
        Route::get('receive-voucher-report', 'App\Http\Controllers\ReceiveVoucherController@report');
        Route::post('receive-voucher-report', 'App\Http\Controllers\ReceiveVoucherController@filter')->name('receive.filter');
        Route::post('find-receive-subtype-with-type-id', 'App\Http\Controllers\ReceiveVoucherController@findReceiveSubTypeWithType');
    });

    //******** Other Payment *******//
    Route::prefix(config('app.op'))->group(function () {
        Route::resource('payment-type', 'App\Http\Controllers\PaymentTypeController');
        Route::resource('payment-sub-type', 'App\Http\Controllers\PaymentSubTypeController');
        Route::resource('payment-voucher', 'App\Http\Controllers\PaymentVoucherController');
        Route::get('payment-voucher-report', 'App\Http\Controllers\PaymentVoucherController@report');
        Route::post('payment-voucher-report', 'App\Http\Controllers\PaymentVoucherController@filter')->name('payment.filter');
        Route::post('find-payment-subtype-with-type-id', 'App\Http\Controllers\PaymentVoucherController@findPaymentSubTypeWithType');
    });

    //******** insurance utility part *******//
    Route::prefix(config('app.utility'))->group(function () {
        Route::resource('client', 'App\Http\Controllers\Utility\ClientInsuredController');
        Route::resource('bank', 'App\Http\Controllers\Utility\BankController');
        Route::resource('voyage-from', 'App\Http\Controllers\Utility\VoyageFromController');
        Route::resource('voyage-to', 'App\Http\Controllers\Utility\VoyageToController');
        Route::resource('voyage-via', 'App\Http\Controllers\Utility\VoyageViaController');
        Route::resource('transit-by', 'App\Http\Controllers\Utility\TransitByController');
        Route::resource('currency', 'App\Http\Controllers\Utility\CurrecyController');
        Route::resource('additional-perils', 'App\Http\Controllers\Utility\AdditionalPerilsController');
        Route::resource('motor-certificate-type', 'App\Http\Controllers\Utility\MotorCertificateTypeController');
        Route::resource('type-of-certificate', 'App\Http\Controllers\Utility\TypeOfCertificateController');
        Route::resource('tarrif-type', 'App\Http\Controllers\Utility\TarrifTypeController');
        Route::resource('tarrif-calculation', 'App\Http\Controllers\Utility\TarrifCalculationController');

        //------------------------- ajax call --------------------//
        Route::post('take-stamp-amount', 'App\Http\Controllers\Utility\TransitByController@takeStampAmount')->name('take-stamp-amount');

    });

    
    //******** products part *******//
    Route::prefix(config('app.product'))->group(function () {
        Route::resource('product-category', 'App\Http\Controllers\Product\ProductCategoryController');
        Route::resource('product-sub-category', 'App\Http\Controllers\Product\ProductSubCategoryController');
        Route::resource('product', 'App\Http\Controllers\Product\ProductController');

    });

    
    //******** marine cargo insurance part *******//
    Route::prefix(config('app.marine'))->group(function () {
        Route::resource('marine-cargo-insurance', 'App\Http\Controllers\Marine\MarineCargoInsuraceController');
        Route::get('marine-bill-collection', 'App\Http\Controllers\Marine\MarineCargoInsuraceController@marineBillCollection')
            ->name('marine-bill-collection');
        Route::get('marine-bill-collection-form/{id}', 'App\Http\Controllers\Marine\MarineCargoInsuraceController@marineBillCollectionForm')
            ->name('marine-bill-collection-form');
        Route::post('marine-bill-collection-form-store', 'App\Http\Controllers\Marine\MarineCargoInsuraceController@marineBillCollectionFormStore')
            ->name('marine-bill-collection-form-store');
        Route::get('marine-bill-collection-report', 'App\Http\Controllers\Marine\MarineCargoInsuraceController@marineBillCollectionReport')
            ->name('marine-bill-collection-report');
        Route::get('marine-invoice/{id}', 'App\Http\Controllers\Marine\MarineCargoInsuraceController@marineInvoice')
            ->name('marine-invoice');

    });
    
    //******** fire insurance part *******//
    Route::prefix(config('app.fire'))->group(function () {
        Route::resource('fire-insurance', 'App\Http\Controllers\Fire\FireInsuranceController');
        Route::get('fire-bill-collection', 'App\Http\Controllers\Fire\FireInsuranceController@fireBillCollection')
            ->name('fire-bill-collection');
        Route::get('fire-bill-collection-form/{id}', 'App\Http\Controllers\Fire\FireInsuranceController@fireBillCollectionForm')
            ->name('fire-bill-collection-form');
        Route::post('fire-bill-collection-form-store', 'App\Http\Controllers\Fire\FireInsuranceController@fireBillCollectionFormStore')
            ->name('fire-bill-collection-form-store');
        Route::get('fire-bill-collection-report', 'App\Http\Controllers\Fire\FireInsuranceController@fireBillCollectionReport')
            ->name('fire-bill-collection-report');
            Route::get('fire-invoice/{id}', 'App\Http\Controllers\Fire\FireInsuranceController@fireInvoice')
                ->name('fire-invoice');
    });
    
    //******** motor insurance part *******//
    Route::prefix(config('app.motor'))->group(function () {
        Route::resource('motor-insurance', 'App\Http\Controllers\Motor\MotorInsuranceController');
        Route::post('get-tarrif', 'App\Http\Controllers\Motor\MotorInsuranceController@getTarrif')->name('get-tarrif');
        Route::get('motor-bill-collection', 'App\Http\Controllers\Motor\MotorInsuranceController@motorBillCollection')
            ->name('motor-bill-collection');
        Route::get('motor-bill-collection-form/{id}', 'App\Http\Controllers\Motor\MotorInsuranceController@motorBillCollectionForm')
            ->name('motor-bill-collection-form');
        Route::post('motor-bill-collection-form-store', 'App\Http\Controllers\Motor\MotorInsuranceController@motorBillCollectionFormStore')
            ->name('motor-bill-collection-form-store');
        Route::get('motor-bill-collection-report', 'App\Http\Controllers\Motor\MotorInsuranceController@motorBillCollectionReport')
            ->name('motor-bill-collection-report');
            Route::get('motor-invoice/{id}', 'App\Http\Controllers\Motor\MotorInsuranceController@motorInvoice')
                ->name('motor-invoice');
    });

    
    //******** commission part *******//
    Route::prefix(config('app.commission'))->group(function () {
        Route::resource('payment-title', 'App\Http\Controllers\Commission\PaymentTitleController');   

        Route::resource('marine-commission', 'App\Http\Controllers\Commission\MarineCommissionController');    
        Route::get('marine-commission-form/{id}', 'App\Http\Controllers\Commission\MarineCommissionController@commissionForm')
        ->name('marine-commission-form');  
        
        Route::resource('fire-commission', 'App\Http\Controllers\Commission\FireCommissionController'); 
        Route::get('fire-commission-form/{id}', 'App\Http\Controllers\Commission\FireCommissionController@commissionForm')
        ->name('fire-commission-form');
        
        Route::resource('motor-commission', 'App\Http\Controllers\Commission\MotorCommissionController'); 
        Route::get('motor-commission-form/{id}', 'App\Http\Controllers\Commission\MotorCommissionController@commissionForm')
        ->name('motor-commission-form');
          
        Route::get('commission-report', 'App\Http\Controllers\Commission\MarineCommissionController@commissionReport')
        ->name('commission-report');  

    });


    //******** users part *******//
    Route::prefix(config('app.user'))->group(function () {
        Route::resource('department', 'App\Http\Controllers\DepartmentController');
        Route::resource('designation', 'App\Http\Controllers\DesignationController');
        Route::resource('branch', 'App\Http\Controllers\Branch\BranchController');
        Route::resource('user-list', 'App\Http\Controllers\UserController');
        Route::resource('user-role', 'App\Http\Controllers\RoleController');

    });


    //******** amendment part *******//
    Route::prefix(config('app.amendment'))->group(function () {
        Route::resource('other-receive-amenment', 'App\Http\Controllers\OtherReceiveAmenmentController');
        Route::post('other-receive-amenment', 'App\Http\Controllers\OtherReceiveAmenmentController@filter')->name('other-receive.filter');
        Route::resource('other-payment-amenment', 'App\Http\Controllers\OtherPaymentAmenmentController');
        Route::post('other-payment-amenment', 'App\Http\Controllers\OtherPaymentAmenmentController@filter')->name('other-payment.filter');
        Route::resource('bank-deposit-amendment', 'App\Http\Controllers\BankDepositAmenmentController');
        Route::post('bank-deposit-amendment', 'App\Http\Controllers\BankDepositAmenmentController@filter')->name('bank-deposit.filter');
        Route::resource('bank-withdraw-amendment', 'App\Http\Controllers\BankWithdrawAmenmentController');
        Route::post('bank-withdraw-amendment', 'App\Http\Controllers\BankWithdrawAmenmentController@filter')->name('bank-withdraw.filter');
        Route::resource('bank-transfer-amendment', 'App\Http\Controllers\BankTransferAmenmentController');
        Route::post('bank-transfer-amendment', 'App\Http\Controllers\BankTransferAmenmentController@filter')->name('bank-transfer.filter');


    });


    // Setting part
    Route::put('save-site-setting/{id}', 'App\Http\Controllers\SettingController@saveSiteSetting')->name('save-site-setting');
    Route::put('save-currency-setting/{id}', 'App\Http\Controllers\SettingController@saveCurrencySetting')->name('save-currency-setting');
    Route::put('update-user-password/{id}', 'App\Http\Controllers\SettingController@updateUserPassword')->name('update-user-password');
    Route::put('update-site-theme/{id}', 'App\Http\Controllers\SettingController@saveSiteTheme')->name('update-site-theme');

    Route::get('settings', 'App\Http\Controllers\SettingController@index');
});

//Clear Cache facade value:
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});
//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});
//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});
//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});
//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/foo', function () {
    Artisan::call('storage:link');
    return '<h1>Storage Created</h1>';
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
