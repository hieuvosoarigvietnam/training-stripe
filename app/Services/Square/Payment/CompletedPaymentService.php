<?php

namespace App\Services\Square\Payment;

use App\Repositories\Contracts\PaymentsRepository;
use App\Services\Square\BaseSquareService;
use Square\Models\CompletePaymentRequest;

class CompletedPaymentService extends BaseSquareService
{
    public function __construct(protected PaymentsRepository $paymentsRepository)
    {
        parent::__construct();
    }

    public function handle($request)
    {
        $client = $this->getClient();

        $body = new CompletePaymentRequest();

        $api_response = $client->getPaymentsApi()->completePayment($request['payment_id'], $body);

        if ($api_response->isSuccess()) {
            $result = $api_response->getResult();

            return $this->paymentsRepository->where('payment_id', $request['payment_id'])
                ->update([
                    'status' => $result->getPayment()->getStatus(),
                    'note' => 'Payment is ' . $result->getPayment()->getStatus()
                ]);
        } else {
            return $api_response->getErrors();
        }
    }
}
