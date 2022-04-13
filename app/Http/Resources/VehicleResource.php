<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'number_plate' => $this->number_plate,
            'detail_id' => $this->detail,
            'last_mod_date' => $this->last_mod_date,
            'is_active' => $this->is_active,
            'driver_id' => new DriverResource($this->driver),
            'owner_id' => new DriverResource($this->owner),
        ];
    }
}
