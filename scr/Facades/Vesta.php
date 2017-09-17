<?php

namespace Tabuna\Vesta\Facades;

use Illuminate\Support\Facades\Facade;
use Tabuna\Vesta\Services\VestaAPI;

class Vesta extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return VestaAPI::class;
    }
}
