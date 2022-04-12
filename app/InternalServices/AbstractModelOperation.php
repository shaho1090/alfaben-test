<?php


namespace App\InternalServices;


use Illuminate\Database\Eloquent\Model;

abstract class AbstractModelOperation
{
    protected array $request;
    protected Model $model;

    public function __construct(Model $model,array $request)
    {
        $this->request = $request;
        $this->model = $model;
    }

    abstract function handle();
}
