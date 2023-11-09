<?php

namespace App\Http\Controllers\Api\Stripe;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stripe\UpdateCustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Handle payment items
     *
     * @param Request $request
     * @return void
     */
    public function retrievingCustomer(Request $request)
    {
        $user = $request->user();

         return  $user->createOrGetStripeCustomer();
    }

    /**
     * Get balance of customer
     *
     * @param Request $request
     * @return void
     */
    public function balance(Request $request)
    {
        $user = $request->user();

        return $user->balance();
    }

    /**
     * Update information of customer
     *
     * @param UpdateCustomerRequest $request
     * @return void
     */
    public function update(UpdateCustomerRequest $request)
    {
        $user = $request->user();
        $option = $request->validated();

        return $user->updateStripeCustomer($option);
    }
}
