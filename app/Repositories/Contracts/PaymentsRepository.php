<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PaymentsRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface PaymentsRepository extends RepositoryInterface
{
    /**
     * handle create payment
     * @param array $values
     * @return mixed
     */
    public function createPayment(array $values);
}
