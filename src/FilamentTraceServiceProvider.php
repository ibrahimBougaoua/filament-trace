<?php

namespace IbrahimBougaoua\FilamentTrace;

use Filament\Navigation\UserMenuItem;
use Filament\PluginServiceProvider;
use IbrahimBougaoua\FilamentTrace\Commands\FilamentTraceTruncateCommand;
use IbrahimBougaoua\FilamentTrace\FilamentTrace;
use IbrahimBougaoua\FilamentTrace\Resources\TraceResource;
use Spatie\LaravelPackageTools\Package;

class FilamentTraceServiceProvider extends PluginServiceProvider
{
    protected array $resources = [
        TraceResource::class,
    ];

    protected function getUserMenuItems(): array
    {
        return [
            UserMenuItem::make()
                ->label('Trace')
                ->url(route('filament.resources.traces.index'))
                ->icon('heroicon-s-eye'),
        ];
    }

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
            ->hasCommand(FilamentTraceTruncateCommand::class);
    }
}
