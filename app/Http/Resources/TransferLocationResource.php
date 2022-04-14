<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferLocationResource extends JsonResource
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
            'arriving_time' => $this->arriving_time,
            'leaving_time' => $this->leaving_time,
            'starting_km' => $this->starting_km,
            'ending_km' => $this->ending_km,
            'address' => new AddressResource($this->address),
        ];
    }
}
