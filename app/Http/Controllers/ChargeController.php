<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class ChargeController extends Controller
{
    public $stripe;
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            'sk_test_51MtRtIEGX204kkIn5OjZtCjyuSavMumKcTDx0GR3LJogfgoQFid9YszkbdJCEiwgv1sXmnf33l33avE4u7K8nX1d0020Nmr05j'
        );
    }

    public function createCharge()
    {

       $charge =   $this->stripe->charges->create([
            'amount' => 100,
            'currency' => 'usd',
            'source' => 'tok_mastercard',
            'description' => 'Charging 100 usd',
        ]);

       dd($charge);
    }

    public function retrieveCharge()
    {
        $charge =  $this->stripe->charges->retrieve(
            'ch_3MtSzFEGX204kkIn1gTauZ7L',
            []
        );
        dd($charge);
    }
    public function updateCharge()
    {
       $updateCharge =  $this->stripe->charges->update(
            'ch_3MtSzFEGX204kkIn1gTauZ7L',
            ['metadata' => ['order_id' => '6735']]
        );
        dd($updateCharge);
    }
    public function captureCharge()
    {
       $captured = $this->stripe->charges->capture(
           'ch_3MtTuYEGX204kkIn0DoNcXBv',
           []
       );
       dd($captured);
    }
    public function getListOfCharges($limit = 3)
    {
       $list = $this->stripe->charges->all(['limit' => $limit]);
       dd($list);
    }
}
