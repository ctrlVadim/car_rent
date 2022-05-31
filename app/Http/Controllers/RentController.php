<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentRequest;
use App\UseCases\CarService;
use Facade\FlareClient\Http\Exceptions\NotFound;

class RentController extends Controller
{
    public $service;


    public function __construct(CarService $service)
    {
        $this->service = $service;
    }


    /**
     * Rent Car
     * @OA\Post (
     *     path="/api/car/rent",
     *     tags={"Rent"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="car_id",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="user_id",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                     "car_id":1,
     *                     "user_id":1
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Car successfully rented",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="200"),
     *              @OA\Property(property="message", type="string", example="Car successfully rented"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="User already has car or car is already used by someone else",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="403"),
     *              @OA\Property(property="message", type="string", example="User already has car or car is already used by someone else"),
     *          )
     *      )
     * )
     */
    public function rent(RentRequest $request)
    {
        try {
            $this->service->rent($request);

            return response()->json([
                'status' => 200,
                'message' => 'Car successfully rented'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'error' => $e->getMessage(),
            ], $e->getCode());
        }
    }


    /**
     * Return Car
     * @OA\Delete (
     *     path="/api/car/return",
     *     tags={"Rent"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="car_id",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="user_id",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                     "car_id":1,
     *                     "user_id":1
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Car successfully returned",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="200"),
     *              @OA\Property(property="message", type="string", example="Car successfully returned"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Rent not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example="404"),
     *              @OA\Property(property="message", type="string", example="Rent not found"),
     *          )
     *      )
     * )
     */
    public function return(RentRequest $request)
    {
        try {
            $this->service->return($request);

            return response()->json([
                'status' => 200,
                'message' => 'Car successfully returned'
            ], 200);
        } catch (NotFound $e) {
            return response()->json([
                'status' => $e->getCode(),
                'error' => $e->getMessage(),
            ], $e->getCode());
        }
    }
}
