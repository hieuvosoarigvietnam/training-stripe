<?php

namespace App\Services\Square\Payment;

use App\Services\Square\BaseSquareService;
use Square\Models\Error;

class GetListPaymentsService extends BaseSquareService
{
    /**
     * Construction
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handle get list payments
     *
     * @param $request
     * @return mixed|Error[]
     */
    public function handle($request)
    {
        $client = $this->getClient();

        $api_response = $client->getPaymentsApi()->listPayments();

        if ($api_response->isSuccess()) {
            return $api_response->getResult();
        } else {
           return $api_response->getErrors();
        }
    }
}
