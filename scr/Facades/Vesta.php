<?php

namespace Tabuna\VestaAPI\Facades;

use Illuminate\Support\Facades\Facade;
use Tabuna\VestaAPI\Services\VestaAPI;

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
