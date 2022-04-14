<?php


namespace App\InternalServices\Transfer;


use App\InternalServices\AbstractModelOperation;
use App\InternalServices\Address\CreateNewAddress;
use App\Models\Address;
use App\Models\Transfer;
use App\Types\TransferStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CreateNewTransfer extends AbstractModelOperation
{
    function handle(): Model
    {
        $this->createTransfer();
        $this->createLocations();
        $this->addPassengers();
        return $this->model;
    }

    private function createTransfer()
    {
        $this->model->fill([
            'registrant_id' => $this->request['registrant_id'],
            'registered_at' => Carbon::now()->toDateTimeString(),
            'vehicle_id' => $this->request['vehicle_id'],
            'driver_id' => $this->request['driver_id'],
            'status' => TransferStatuses::AWAITING
        ]);

        $this->model->save();
    }

    private function createLocations()
    {
        foreach($this->request['locations'] as $key => $location){

            if(!isset($location['address_id']) || is_null($location['address_id'])){
                $this->request['locations'][$key]['address_id'] = $this->createNewAddress($location)->id;
            }

            $this->model->locations()->create([
                'address_id' => $this->request['locations'][$key]['address_id']
            ]);
        }
    }

    private function createNewAddress(array $request): Model
    {
       return (new CreateNewAddress(new Address(),$request))->handle();
    }

    private function addPassengers()
    {
        foreach ($this->request['passengers'] as $passengerId){
            $this->model->passengers()->create([
                'passenger_id' => $passengerId
            ]);
        }
    }
}
