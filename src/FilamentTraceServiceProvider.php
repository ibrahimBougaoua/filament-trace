<?php

namespace IbrahimBougaoua\FilamentTrace;

use IbrahimBougaoua\FilamentTrace\Commands\FilamentTraceCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentTraceServiceProvider extends PackageServiceProvider
{
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
            ->hasMigration('create_filament-trace_table')
            ->hasCommand(FilamentTraceCommand::class);
    }
}
