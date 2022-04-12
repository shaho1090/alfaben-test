<?php


namespace App\Types;


use ReflectionClass;

abstract class AbstractTypes
{
    /**
     * @throws \ReflectionException
     */
    public function toArray(): array
    {
        return (new ReflectionClass(new $this))->getConstants();
    }
}
