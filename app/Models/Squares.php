<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Squares.
 *
 * @package namespace App\Models;
 */
class Squares extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'squares';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'customer_id', 'card_id'];

}
