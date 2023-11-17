<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Payments.
 *
 * @package namespace App\Models;
 */
class Payments extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'payments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'payment_id', 'amount', 'quantity', 'status', 'note'];

}
