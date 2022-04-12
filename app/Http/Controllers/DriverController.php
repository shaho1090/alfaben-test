<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverStoreRequest;
use App\Http\Resources\DriverResource;
use App\InternalServices\AbstractModelOperation;
use App\InternalServices\Driver\CreateNewDriver;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverController extends Controller
{
    /**
     * @throws \Exception
     */
    public function store(DriverStoreRequest $request): JsonResponse
    {
       try{
           $passenger = (new CreateNewDriver(new User(),$request->toArray()))->handle();
       }catch (\Exception $ex){
           throw $ex;
       }

       return response()->json([
           'data' => new DriverResource($passenger)
       ]);
   }
}
