<?php


namespace App\InternalServices\Passenger;


use App\InternalServices\AbstractModelOperation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateNewPassenger extends AbstractModelOperation
{
   public function handle(): Model
   {
       $this->request['password'] =  Hash::make(Str::random(8));

        $this->model->fill($this->request);
        $this->model->save();

        return $this->model->refresh();
    }
}
