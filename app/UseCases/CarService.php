<?php


namespace App\UseCases;


use App\Http\Requests\RentRequest;
use App\Models\Car;
use App\Models\CarUser;
use App\Permissions\CarPermission;
use App\Repositories\CarRepository;
use App\Repositories\UserRepository;
use Facade\FlareClient\Http\Exceptions\NotFound;

class CarService
{
    private $userRepository;
    private $carRepository;


    public function __construct(UserRepository $userRepository, CarRepository $carRepository)
    {
        $this->userRepository = $userRepository;
        $this->carRepository = $carRepository;
    }


    public function rent(RentRequest $form): bool
    {
        if (CarPermission::canRentCar(
            $this->userRepository->findOne($form['user_id']),
            $this->carRepository->findOne($form['car_id'])
        )) {
            CarUser::create($form->validated());
            return true;
        }
        throw new \Exception("User already has car or car is already used by someone else", 403);
    }


    public function return(RentRequest $form): bool
    {
        if ($carUser = CarUser::where('user_id', $form['user_id'])
            ->where('car_id', $form['user_id'])->first()) {
            $carUser->delete();

            return true;
        }

        throw new NotFound("Rent not found", 404);
    }
}
