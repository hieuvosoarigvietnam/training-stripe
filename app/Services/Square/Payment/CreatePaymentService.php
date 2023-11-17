<?php

namespace App\Services\Square\Payment;

use App\Repositories\Contracts\PaymentsRepository;
use App\Repositories\Contracts\SquaresRepository;
use App\Services\Square\BaseSquareService;
use Square\Models\CreatePaymentRequest;
use Square\Models\Money;

class CreatePaymentService extends BaseSquareService
{
    public function __construct(protected SquaresRepository $squaresRepository, protected PaymentsRepository $paymentsRepository)
    {
        parent::__construct();
    }

    /**
     * handle create payment
     */
    public function handle($request)
    {
        $client = $this->getClient();
        $user = $request->user();
        $square = $this->squaresRepository->where('user_id', $user->id)->first();

        $amount = $request['amount'] ?? 10000;
        $complete = $request['complete'] ?? true; // variable is true or false

        $amount_money = new Money();
        $amount_money->setAmount($amount);
        $amount_money->setCurrency('JPY');
        $idempotencyKey = uniqid();

        $body = new CreatePaymentRequest($square->card_id, $idempotencyKey);
        $body->setAmountMoney($amount_money);
        $body->setAutocomplete($complete);
        $body->setCustomerId($square->customer_id);

        $api_response = $client->getPaymentsApi()->createPayment($body);

        if ($api_response->isSuccess()) {
            $result = $api_response->getResult()->getPayment();

            $values = [
                'user_id' => $user->id,
                'payment_id' => $result->getId(),
                'amount' => $amount,
                'status' => $result->getStatus(),
                'note' => 'Payment is ' . $result->getStatus(),
            ];

            return $this->paymentsRepository->createPayment($values);

        } else {
            return $api_response->getErrors();
        }
    }
}
