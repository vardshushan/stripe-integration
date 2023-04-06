<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class PaymentIntentsController extends Controller
{
    public $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            'sk_test_51MtRtIEGX204kkIn5OjZtCjyuSavMumKcTDx0GR3LJogfgoQFid9YszkbdJCEiwgv1sXmnf33l33avE4u7K8nX1d0020Nmr05j'
        );
    }

    public function createPaymentItent()
    {

        $intent = $this->stripe->paymentIntents->create([
            'amount' => 2000,
            'currency' => 'usd',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);

        dd($intent);
    }

    public function retrievePaymentIntent()
    {
        $intent = $this->stripe->paymentIntents->retrieve(
            'pi_1DtB8F2eZvKYlo2CakPdNzMO',
            []
        );
        dd($intent);
    }

    public function updatePaymentIntent()
    {
        $updateIntent = $this->stripe->paymentIntents->update(
            'pi_1DtB8F2eZvKYlo2CakPdNzMO',
            ['metadata' => ['order_id' => '4151']]
        );
        dd($updateIntent);
    }

    public function confirmPaymentIntent()
    {
        $confirmIntent = $this->stripe->paymentIntents->confirm(
            'pi_1DtB8F2eZvKYlo2CakPdNzMO',
            ['payment_method' => 'pm_card_visa']
        );
        dd($confirmIntent);
    }

    public function capturePaymentIntent()
    {
        $captureIntent = $this->stripe->paymentIntents->capture(
            'pi_3Mr1Q32eZvKYlo2C1pk594CT',
            []
        );
        dd($captureIntent);
    }

    public function cancelPaymentIntents()
    {
        $deleted = $this->stripe->paymentIntents->cancel(
            'pi_1DtB8F2eZvKYlo2CakPdNzMO',
            []
        );
        dd($deleted);
    }

    public function getListOfPaymentIntents($limit = 3)
    {
        $list = $this->stripe->paymentIntents->all(['limit' => $limit]);
        dd($list);
    }
}
