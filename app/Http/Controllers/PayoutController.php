<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class PayoutController extends Controller
{
    public $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            'sk_test_51MtRtIEGX204kkIn5OjZtCjyuSavMumKcTDx0GR3LJogfgoQFid9YszkbdJCEiwgv1sXmnf33l33avE4u7K8nX1d0020Nmr05j'
        );
    }

    public function createPayout()
    {

        $payout = $this->stripe->payouts->create([
            'amount' => 1100,
            'currency' => 'usd',
        ]);

        dd($payout);
    }

    public function retrievePayout()
    {
        $payout = $this->stripe->payouts->retrieve(
            'po_1MtViVEGX204kkInLzwvi1fE',
            []
        );
        dd($payout);
    }

    public function updatePayouts()
    {
        $updatePayout = $this->stripe->payouts->update(
            'po_1MtViVEGX204kkInLzwvi1fE',
            ['metadata' => ['order_id' => '4151']]
        );
        dd($updatePayout);
    }

    public function cancelPayouts()
    {
        $canceled = $this->stripe->payouts->cancel(
            'po_1MtViVEGX204kkInLzwvi1fE',
            []
        );
        dd($canceled);
    }

    public function getListOfPayouts($limit = 3)
    {
        $list = $this->stripe->payouts->all(['limit' => $limit]);
        dd($list);
    }
}
