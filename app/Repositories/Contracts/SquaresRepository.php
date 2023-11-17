<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SquaresRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface SquaresRepository extends RepositoryInterface
{
    /**
     * handle store customer square
     *
     * @param array $customer_id
     * @param array $values
     * @return mixed
     */
    public function storeCustomerSquare(string $customer_id, array $values);
}
