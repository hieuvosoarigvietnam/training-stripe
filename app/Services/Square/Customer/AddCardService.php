<?php

namespace App\Services\Square\Customer;

use App\Repositories\Contracts\SquaresRepository;
use App\Services\Square\BaseSquareService;
use Square\Models\Card;
use Square\Models\CreateCardRequest;

class AddCardService extends BaseSquareService
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
     * handle add card to customer of square
     *
     * @return \Square\Models\Error[]
     */
    public function handle($request)
    {
        $client = $this->getClient();
        $user = $request->user();

        $square = $this->squaresRepository->where('user_id', $user->id)->first();

        // Example card for test BE, just can take information of card from FE.
        // Todo: refactor later
        $attrs = [
            'expMonth' => 10,
            'expYear' => 30,
            'sourceId' => 'cnon:card-nonce-ok'
        ];
        $idempotencyKey = uniqid();

        $card = new Card();
        $card->setExpMonth($attrs['expMonth']);
        $card->setExpYear($attrs['expYear']);
        $card->setCustomerId($square->customer_id);

        $body = new CreateCardRequest(
            $idempotencyKey,
            $attrs['sourceId'],
            $card
        );

        $api_response = $client->getCardsApi()->createCard($body);

        if ($api_response->isSuccess()) {
            $cardId = $api_response->getResult()->getCard()->getId();

            return $this->squaresRepository->storeCustomerSquare($square->customer_id, ['card_id' => $cardId]);
        } else {
            return $api_response->getErrors();
        }
    }
}
