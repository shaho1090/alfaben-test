<?php


namespace App\InternalServices\Address;


use App\InternalServices\AbstractModelOperation;
use Illuminate\Database\Eloquent\Model;

class CreateNewAddress extends AbstractModelOperation
{

    function handle(): Model
    {
       $this->model->fill($this->request);
       $this->model->save();
       return $this->model->refresh();
    }
}
