<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleStoreRequest;
use App\Http\Resources\VehicleResource;
use App\InternalServices\Vehicle\CreateNewVehicle;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    /**
     * @throws \Exception
     */
    public function store(VehicleStoreRequest $request): JsonResponse
    {
        try{
            $passenger = (new CreateNewVehicle(new Vehicle(),$request->toArray()))->handle();
        }catch (\Exception $ex){
            throw $ex;
        }

        return response()->json([
            'data' => new VehicleResource($passenger)
        ]);
    }
}
