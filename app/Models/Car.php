<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="Car",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="name",
 *      type="string"
 *  )
 * )
 */
class Car extends Model
{
    use HasFactory;

    protected $table = "car";
    protected $fillable = ["name"];

    public function isRented() : bool
    {
        return boolval(CarUser::where('car_id', $this->id)->first());
    }
}
