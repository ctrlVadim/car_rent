<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="CarUser",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="car_id",
 *      type="integer"
 *  )
 *  @SWG\Property(
 *      property="user_id",
 *      type="integer"
 *  )
 * )
 */
class CarUser extends Model
{
    use HasFactory;

    protected $table = "car_user";
    protected $fillable = ["car_id", "user_id"];
}
