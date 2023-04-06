<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;

class CustomerController extends Controller
{
    public $stripe;
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            'sk_test_51MtRtIEGX204kkIn5OjZtCjyuSavMumKcTDx0GR3LJogfgoQFid9YszkbdJCEiwgv1sXmnf33l33avE4u7K8nX1d0020Nmr05j'
        );
    }

    public function createCustomer()
    {

        $customer =  $this->stripe->customers->create([
            'description' => 'My First Test Customer (created for API docs at https://www.stripe.com/docs/api)',
        ]);

        dd($customer);
    }

    public function retrieveCustomer()
    {
        $customer =  $this->stripe->customers->retrieve(
            'cus_NemecOZjUFkGDm',
            []
        );
        dd($customer);
    }
    public function updateCustomer()
    {
        $updateCustomer =  $this->stripe->customer->update(
            'cus_NemecOZjUFkGDm',
            ['metadata' => ['order_id' => '6735']]
        );
        dd($updateCustomer);
    }
    public function deleteCustomer()
    {
        $deleted = $this->stripe->customers->delete(
            'cus_NemecOZjUFkGDm',
            []
        );
        dd($deleted);
    }
    public function getListOfCustomers($limit = 3)
    {
        $list = $this->stripe->customers->all(['limit' => 3]);
        dd($list);
    }
}
