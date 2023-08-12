<?php

namespace IbrahimBougaoua\FilamentTrace;

use IbrahimBougaoua\FilamentTrace\Commands\FilamentLoggerTruncateCommand;
use IbrahimBougaoua\FilamentTrace\Commands\FilamentTraceInstallCommand;
use IbrahimBougaoua\FilamentTrace\Commands\FilamentTraceTruncateCommand;
use IbrahimBougaoua\FilamentTrace\Listeners\LoginTrace;
use IbrahimBougaoua\FilamentTrace\Listeners\LogoutTrace;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentTraceServiceProvider extends PackageServiceProvider
{
    public function packageBooted(): void
    {
        parent::packageBooted();

        if (FilamentTrace::hasMigrated()) {
            if (! FilamentTrace::isStopped('logger')) {
                Event::listen(
                    Login::class,
                    LoginTrace::class
                );

                Event::listen(
                    Logout::class,
                    LogoutTrace::class
                );
            }

            if (! FilamentTrace::isStopped('trace')) {
                FilamentTrace::prepareModelsClassNames();
            }
        }
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
            ->hasCommands([
                FilamentTraceInstallCommand::class,
                FilamentTraceTruncateCommand::class,
                FilamentLoggerTruncateCommand::class,
            ]);
    }
}
