<?php

use App\Http\Controllers\ChargeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentIntentsController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
    Route::get('retrieveBalance', 'retrieveBalance')->name('stripe.retrieve.balance');
    Route::get('balanceTransaction', 'balanceTransactions')->name('stripe.balance.transactions');
    Route::get('balanceTransactions', 'getAllTransactions')->name('stripe.balance.transactions');
});
Route::controller(ChargeController::class)->group(function(){
    Route::post('charge', 'createCharge')->name('stripe.charge');
    Route::get('charge', 'retrieveCharge')->name('retrieve.charge');
    Route::post('updateCharge', 'updateCharge')->name('update.charge');
    Route::post('captureCharge', 'captureCharge')->name('capture.charge');
    Route::get('getListOfCharges', 'getListOfCharges')->name('list.charge');
});
Route::controller(CustomerController::class)->group(function(){
    Route::post('customer', 'createCustomer')->name('stripe.customer');
    Route::get('customer', 'retrieveCustomer')->name('retrieve.customer');
    Route::post('updateCustomer', 'updateCustomer')->name('update.customer');
    Route::delete('deleteCustomer', 'deleteCustomer')->name('delete.customer');
    Route::get('getListOfCustomers', 'getListOfCustomers')->name('list.customer');
});
Route::controller(PaymentIntentsController::class)->group(function(){
    Route::post('paymentIntents', 'createPaymentItent')->name('stripe.paymentIntent');
    Route::get('paymentIntents', 'retrievePaymentIntent')->name('retrieve.paymentIntent');
    Route::post('updatePaymentIntent', 'updatePaymentIntent')->name('update.paymentIntent');
    Route::post('confirmPaymentIntent', 'confirmPaymentIntent')->name('confirm.paymentIntent');
    Route::post('capturePaymentIntent', 'capturePaymentIntent')->name('capture.paymentIntent');
    Route::post('cancelPaymentIntents', 'cancelPaymentIntents')->name('cancel.paymentIntent');
    Route::get('getListOfPaymentIntents', 'getListOfPaymentIntents')->name('list.paymentIntent');
});
Route::controller(PayoutController::class)->group(function(){
    Route::post('payout', 'createPayout')->name('stripe.payout');
    Route::get('payout', 'retrievePayout')->name('retrieve.payout');
    Route::post('updatePayouts', 'updatePayouts')->name('update.payout');
    Route::post('cancelPayouts', 'cancelPayouts')->name('cancel.payout');
    Route::get('getListOfPayouts', 'getListOfPayouts')->name('list.payout');
});
