<?php

use App\Http\Controllers\Backend\CarCategoryController;
use App\Http\Controllers\Backend\CarController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\InvestmentController;
use App\Http\Controllers\Backend\InvestorContactPersonController;
use App\Http\Controllers\Backend\InvestorController;
use App\Http\Controllers\Backend\PurchasePaymentController;
use App\Http\Controllers\Backend\SettlementController;
use App\Http\Controllers\Backend\VendorInfoController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\PaymentMethodController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Web Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::group(['as' => 'backend.', 'prefix' => 'backend/', 'middleware' => 'auth'], function () {
    Route::resource('investor', InvestorController::class);
    Route::resource('investment', InvestmentController::class);
    Route::resource('investorContactPerson', InvestorContactPersonController::class);
    Route::resource('settlement', SettlementController::class);
    Route::resource('vendorInfo', VendorInfoController::class);
    Route::resource('carCategory', CarCategoryController::class);
    Route::resource('car', CarController::class);
    Route::resource('purchasePayment', PurchasePaymentController::class);
    Route::get('purchase-payment/{car}', [PurchasePaymentController::class, 'purchasePayment'])->name('purchasePayment');
    Route::resource('invoice', InvoiceController::class);
    Route::get('/ajax/get-items-by-category/{category}', [ InvoiceController::class, 'searchByCategory']);
    Route::resource('paymentMethod', PaymentMethodController::class);

});
