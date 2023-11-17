<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PaymentsRepository;
use App\Models\Payments;
use App\Validators\PaymentsValidator;

/**
 * Class PaymentsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PaymentsRepositoryEloquent extends BaseRepository implements PaymentsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Payments::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createPayment(array $values)
    {
        return $this->create($values);
    }
}
