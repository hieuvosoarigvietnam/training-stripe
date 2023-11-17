<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\SquaresRepository;
use App\Models\Squares;
use App\Validators\SquaresValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class SquaresRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class SquaresRepositoryEloquent extends BaseRepository implements SquaresRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Squares::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * handle store customer from square
     *
     * @param $data
     * @return mixed
     * @throws ValidatorException
     */
    public function storeCustomerSquare(string $customer_id, array $values): mixed
    {
        return $this->updateOrCreate(['customer_id' => $customer_id], $values);
    }
}
