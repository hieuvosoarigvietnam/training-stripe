<?php

namespace App\Services\Square;

use Square\Environment;
use Square\SquareClient;

class BaseSquareService
{
    protected $client;

    /**
     * Construction.
     */
    public function __construct()
    {
        $this->client = new SquareClient([
            'accessToken' => getenv('SQUARE_ACCESS_TOKEN'),
            'environment' => Environment::SANDBOX,
        ]);
    }

    /**
     * Get the Square's client for authorization.
     *
     * @return SquareClient
     */
    public function getClient()
    {
        return $this->client;
    }
}
