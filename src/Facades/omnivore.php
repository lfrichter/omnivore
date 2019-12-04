<?php

namespace lfrichter\omnivore\Facades;

use Illuminate\Support\Facades\Facade;

class Omnivore extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'omnivore';
    }
}
