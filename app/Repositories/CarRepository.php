<?php


namespace App\Repositories;


use App\Models\Car;

class CarRepository
{
    public function findOne(int $id): Car
    {
        return Car::where('id', $id)->first();
    }
}
