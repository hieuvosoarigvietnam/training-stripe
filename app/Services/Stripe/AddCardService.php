<?php

namespace App\Services\Stripe;

use Mockery\Exception;
use Stripe\Account;
use Stripe\BankAccount;
use Stripe\Card;
use Stripe\Exception\ApiErrorException;
use Stripe\Source;
use Stripe\StripeClient;
use Stripe\Charge;

class AddCardService
{
    /**
     * Handle add card to customer
     *
     * @param $request
     * @return Account|BankAccount|Card|Source
     * @throws ApiErrorException
     */
    public function handle($request): Account|BankAccount|Card|Source
    {
        try
        {
            $attrs = $request->validated();

            $stripe = new StripeClient($_ENV['STRIPE_SECRET']);

            /*
             * TODO: Can create tokens when Stripe/Settings/Integration turn on
             *  handle card information directly.
             *
             */

//            $token = $stripe->tokens->create([
//                'card' => [
//                    'number' => $attrs['number'],
//                    'exp_month' => $attrs['exp_month'],
//                    'exp_year' => $attrs['exp_year'],
//                    'cvc' => $attrs['cvc'],
//                ],
//            ]);

            $token = 'tok_amex'; // test tokens

            return $stripe->customers->createSource(
                $request->user()->stripe_id,
                ['source' => $token]
            );

        }catch (Exception $e){
            throw new ($e->getMessage());
        }
    }
}
