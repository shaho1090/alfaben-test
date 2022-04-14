<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request):array
    {
        return [
            'id' => $this->id,
            'registered_at' => $this->registered_at,
            'status' => $this->status,
            'started_at' => $this->started_at,
            'completed_at' => $this->completed_at,
            'vehicle' => new VehicleResource($this->vehicle),
            'driver' => new DriverResource($this->driver),
            'locations' =>  TransferLocationResource::collection($this->locations)
        ];
    }
}
