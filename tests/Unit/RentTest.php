<?php

namespace Tests\Unit;

use App\Models\CarUser;
use Tests\TestCase;

class RentTest extends TestCase
{
    // FormRequest always returns 422 if something is not valid

    public function test_rent_car()
    {
        CarUser::where('user_id', 1)->delete();

        $response = $this->post(route('api.car.rent'), ['user_id' => 1, 'car_id' => 1]);

        $response->assertStatus(200);
    }


    public function test_cant_rent_busy_car()
    {
        CarUser::where('user_id', 1)->orWhere('user_id', 2)->orWhere('car_id', 1)->delete();

        $this->post(route('api.car.rent'), ['user_id' => 1, 'car_id' => 1]);
        $response = $this->post(route('api.car.rent'), ['user_id' => 2, 'car_id' => 1]);

        $response->assertStatus(403);
    }


    public function test_busy_user_cant_rent_car()
    {
        CarUser::where('user_id', 1)->orWhere('car_id', 1)->orWhere('car_id', 2)->delete();

        $this->post(route('api.car.rent'), ['user_id' => 1, 'car_id' => 1]);
        $response = $this->post(route('api.car.rent'), ['user_id' => 1, 'car_id' => 2]);

        $response->assertStatus(403);
    }


    public function test_busy_user_cant_rent_busy_car()
    {
        CarUser::where('user_id', 1)->orWhere('car_id', 1)->delete();

        $this->post(route('api.car.rent'), ['user_id' => 1, 'car_id' => 1]);
        $response = $this->post(route('api.car.rent'), ['user_id' => 1, 'car_id' => 1]);

        $response->assertStatus(403);
    }
}
