<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\StripeRepository;
use App\Entities\Stripe;
use App\Validators\StripeValidator;

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
