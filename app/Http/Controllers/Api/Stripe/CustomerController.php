<?php

namespace App\Http\Controllers\Api\Stripe;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stripe\AddCardRequest;
use App\Http\Requests\Stripe\UpdateCustomerRequest;
use App\Services\Stripe\AddCardService;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

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

        return $user->createOrGetStripeCustomer();
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

        return $user->createSetupIntent();
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

    /**
     * Add card to customer
     *
     * @param AddCardRequest $request
     * @param AddCardService $service
     * @return \Stripe\Account|\Stripe\BankAccount|\Stripe\Card|\Stripe\Source
     * @throws ApiErrorException
     */
    public function addCard(AddCardRequest $request, AddCardService $service)
    {
        return $service->handle($request);
    }

    /**
     * Purchase
     *
     * @param Request $request
     * @return void
     */
    public function purchase(Request $request)
    {
        $stripe = new StripeClient($_ENV['STRIPE_SECRET']);

        $user = $request->user()->createOrGetStripeCustomer();

//         Payment with PaymentMethod
//        $payment = $request->user()->charge(
//            100, $user->invoice_settings->default_payment_method // or paymentMethodId
//        );

        // Creating Payment Intents
        $payment = $request->user()->pay(
            1000
        );

        // pay the Payment Intents
//        $payment = $stripe->paymentIntents->confirm(
//            'pi_3OATrzKFDlquYgjA09a77NG1',
//            [
//                'payment_method' => 'card_1OA7uDKFDlquYgjAmvu1kxO6',
//                'return_url' => 'http://127.0.0.1:8000/api/orders' //must have redirect url
//            ]);

        return $payment;
    }

    /**
     * get invoices
     *
     * @param Request $request
     * @return void
     */
    public function invoices(Request $request)
    {
        $user = $request->user();

        return $user->invoices();
    }
}
