<?php

namespace App\Services\Square\Customer;

use App\Repositories\Contracts\SquaresRepository;
use App\Services\Square\BaseSquareService;
use Square\Models\CreateCustomerRequest;

class CreateCustomerService extends BaseSquareService
{
    /**
     * Construction
     *
     */
    public function __construct(protected SquaresRepository $squaresRepository)
    {
        parent::__construct();
    }

    /**
     * Handle create customer
     *
     * @param $request
     * @return \Square\Models\Error[]
     */
    public function handle($request)
    {
        $client = $this->getClient();
        $user = $request->user();
        $square = $this->squaresRepository->where('user_id', $user->id)->first();

        if($square){
            return responseError(__('Customer already exists!'));
        }

        $body = new  CreateCustomerRequest();
        $body->setEmailAddress($user->email);
        $body->setGivenName($user->name);

        $api_response = $client->getCustomersApi()->createCustomer($body);

        if ($api_response->isSuccess()) {
            $customer_id = $api_response->getResult()->getCustomer()->getId();

            $attrs = [
                'customer_id' => $customer_id,
                'user_id' => $request->user()->id,
            ];

            return $this->squaresRepository->storeCustomerSquare($customer_id, $attrs);

        } else {
            return $api_response->getErrors();
        }
    }
}
