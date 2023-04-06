<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class StripePaymentController extends Controller
{
    public $stripe;
    public function __construct()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $this->stripe = new \Stripe\StripeClient(
            'sk_test_51MtRtIEGX204kkIn5OjZtCjyuSavMumKcTDx0GR3LJogfgoQFid9YszkbdJCEiwgv1sXmnf33l33avE4u7K8nX1d0020Nmr05j'
        );
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     * @return \Illuminate\Http\RedirectResponse
     */

    public function stripePost(Request $request)
    {
        $customer = Stripe\Customer::create(array(
            "address" => [
                "line1" => "",
                "postal_code" => "360001",
                "city" => "Yerevan",
                "state" => "GJ",
                "country" => "IN",
            ],
            "email" => "shushanvardanyan03@gmail.com",
            "name" => "Shushan Vardanyan",
            "source" => $request->stripeToken
        ));
        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "customer" => $customer->id,
            "description" => "Test payment",
            "shipping" => [
                "name" => "Jenny Rosen",
                "address" => [
                    "line1" => "510 Townsend St",
                    "postal_code" => "98140",
                    "city" => "San Francisco",
                    "state" => "CA",
                    "country" => "US",
                ],
            ]
        ]);
        Session::flash('success', 'Payment successful!');
        return back();

    }

    public function retrieveBalance()
    {
        $balance = $this->stripe->balance->retrieve([]);
        dd($balance);
    }

    /**
     * @return void
     * @throws Stripe\Exception\ApiErrorException
     */
    public function balanceTransactions()
    {
        $transaction = $this->stripe->balanceTransactions->retrieve(
            'txn_3MtSzFEGX204kkIn1NJkolnH',
            []
        );
        dd($transaction);
    }
    public function getAllTransactions($limit = 3)
    {
        $transactions = $this->stripe->balanceTransactions->all(['limit' => $limit]);
        dd($transactions);
    }
}
