<?php

namespace Tests\Unit;

use App\Models\CarUser;
use Tests\TestCase;

class ReturnTest extends TestCase
{
    // FormRequest always returns 422 if something is not valid

    public function test_user_can_return_car()
    {
        CarUser::where('user_id', 1)->orWhere('car_id', 1)->delete();

        $this->post(route('api.car.rent'), ['user_id' => 1, 'car_id' => 1]);
        $response = $this->delete(route('api.car.return'), ['user_id' => 1, 'car_id' => 1]);

        $response->assertStatus(200);
    }


    public function test_user_cant_return_null_car()
    {
        CarUser::where('user_id', 1)->orWhere('car_id', 100000)->delete();

        $response = $this->delete(route('api.car.return'), ['user_id' => 1, 'car_id' => 100000]);

        $response->assertStatus(404);
    }


    public function test_null_user_cant_return_car()
    {
        CarUser::where('user_id', 1)->orWhere('car_id', 1)->delete();

        $response = $this->delete(route('api.car.return'), ['user_id' => 100000, 'car_id' => 1]);

        $response->assertStatus(404);
    }


    public function test_null_user_cant_return_null_car()
    {
        CarUser::where('user_id', 1)->orWhere('car_id', 1)->delete();

        $response = $this->delete(route('api.car.return'), ['user_id' => 100000, 'car_id' => 100000]);

        $response->assertStatus(404);
    }
}
