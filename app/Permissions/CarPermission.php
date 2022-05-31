<?php


namespace App\Permissions;


use App\Models\Car;
use App\Models\User;

class CarPermission
{
    static function canRentCar(User $user, Car $car): bool
    {
        return !$car->isRented() && !$user->hasRentedCar();
    }
}
