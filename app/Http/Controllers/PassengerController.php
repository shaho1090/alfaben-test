<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassengerStoreRequest;
use App\Http\Resources\PassengerResource;
use App\InternalServices\Passenger\CreateNewPassenger;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class PassengerController extends Controller
{
    /**
     * @throws \Exception
     */
    public function store(PassengerStoreRequest $request): JsonResponse
    {
        try{
            $passenger = (new CreateNewPassenger(new User(),$request->toArray()))->handle();
        }catch (\Exception $ex){
            throw $ex;
        }

        return response()->json([
            'data' => new PassengerResource($passenger)
        ]);
    }
}
