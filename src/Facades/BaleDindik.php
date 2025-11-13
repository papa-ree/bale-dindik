<?php

namespace Paparee\BaleDindik\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Paparee\BaleDindik\BaleDindik
 */
class BaleDindik extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Paparee\BaleDindik\BaleDindik::class;
    }
}
