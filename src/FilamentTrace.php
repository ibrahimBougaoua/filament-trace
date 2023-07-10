<?php

namespace IbrahimBougaoua\FilamentTrace;

use IbrahimBougaoua\FilamentTrace\Models\TraceSetting;
use IbrahimBougaoua\FilamentTrace\Models\Logger;
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

    public static function hasMigrated() : bool
    {
        if( Schema::hasTable('filament_trace') &&
            Schema::hasTable('filament_logger') &&
            Schema::hasTable('filament_trace_settings')
        )
            return true;
        return false;
    }

    public static function truncate($key) : void
    {
        if( $key == 'trace' )
            Trace::truncate();
        elseif( $key == 'logger' )
            Logger::truncate();
    }

    public static function sTrace($key) : void
    {
        $traceSetting = TraceSetting::where('key',$key)->first();
        $traceSetting->update(['stop' => ! $traceSetting->stop]);
    }

    public static function isStopped($key) : bool
    {
        $traceSetting = TraceSetting::where('key',$key)->first();
        return $traceSetting ? $traceSetting->stop : false;
    }
}