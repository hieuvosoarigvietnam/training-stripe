<?php

namespace App\Repositories\Eloquent;

use App\Models\Stripe;
use App\Repositories\Contracts\StripeRepository;
use App\Validators\StripeValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class StripeRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class StripeRepositoryEloquent extends BaseRepository implements StripeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Stripe::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
