<?php

namespace IbrahimBougaoua\FilamentTrace\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IbrahimBougaoua\FilamentTrace\FilamentTrace
 */
class FilamentTrace extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \IbrahimBougaoua\FilamentTrace\FilamentTrace::class;
    }
}
