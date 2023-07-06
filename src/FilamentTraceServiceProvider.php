<?php

namespace IbrahimBougaoua\FilamentTrace;

use Filament\Navigation\UserMenuItem;
use Filament\PluginServiceProvider;
use IbrahimBougaoua\FilamentTrace\Commands\FilamentTraceCommand;
use IbrahimBougaoua\FilamentTrace\FilamentTrace;
use Spatie\LaravelPackageTools\Package;

class FilamentTraceServiceProvider extends PluginServiceProvider
{
    public function packageBooted(): void
    {
        if( FilamentTrace::hasMigrated() )
            FilamentTrace::prepareModelsClassNames();
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-trace')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament_trace_table')
            ->hasCommand(FilamentTraceCommand::class);
    }
}
