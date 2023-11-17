<?php

namespace App\Services\Square\Customer;

use App\Repositories\Contracts\SquaresRepository;
use App\Services\Square\BaseSquareService;

class DisableCardService extends BaseSquareService
{
    /**
     * Construction
     *
     * @param SquaresRepository $squaresRepository
     */
    public function __construct(protected SquaresRepository $squaresRepository)
    {
        parent::__construct();
    }

    /**
     * handle disable card & remove in system
     *
     */
    public function handle($request)
    {
        $client = $this->getClient();
        $user = $request->user();
        $square = $this->squaresRepository->where('user_id', $user->id)->first();

        $api_response = $client->getCardsApi()->disableCard($square->card_id);

        if ($api_response->isSuccess()) {
            $square->update(['card_id' => null]);

            return $api_response->getResult();

        } else {
            return $api_response->getErrors();
        }
    }
}
