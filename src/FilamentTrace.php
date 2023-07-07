<?php

namespace IbrahimBougaoua\FilamentTrace;
use IbrahimBougaoua\FilamentTrace\Models\Trace;
use IbrahimBougaoua\FilamentTrace\Traits\ModelsClassNames;
use IbrahimBougaoua\FilamentTrace\Observers\GeneralObserver;
use Schema;

class FilamentTrace
{
    public static function prepareModelsClassNames()
    {
        $classList = ModelsClassNames::prepareModelsClassNames(
            ModelsClassNames::getAllModelsClassNames()
        );

        foreach ($classList as $className)
            $className::observe(GeneralObserver::class);
    }
    
    public static function hasMigrated()
    {
        if( Schema::hasTable('filament_trace') ) 
            return true;
        return false;
    }

    public static function truncate()
    {
        Trace::truncate();
    }
}
