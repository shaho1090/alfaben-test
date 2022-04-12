<?php


namespace App\InternalServices\Driver;


use App\InternalServices\AbstractModelOperation;
use App\Types\UserTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateNewDriver extends AbstractModelOperation
{
    public function handle(): Model
    {
        if(is_null($this->request['password'])) {
            $this->request['password'] = Hash::make(Str::random(8));
        }

        $this->request['type'] = UserTypes::DRIVER;

        $this->model->fill($this->request);
        $this->model->save();

        return $this->model->refresh();
    }
}
