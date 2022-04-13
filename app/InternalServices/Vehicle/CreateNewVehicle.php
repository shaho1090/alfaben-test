<?php


namespace App\InternalServices\Vehicle;


use App\InternalServices\AbstractModelOperation;
use Illuminate\Database\Eloquent\Model;

class CreateNewVehicle extends AbstractModelOperation
{
    public function handle(): Model
    {
        $this->model->fill($this->request);
        $this->model->save();

        return $this->model->refresh();
    }
}
