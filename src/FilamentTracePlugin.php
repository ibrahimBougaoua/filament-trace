<?php

declare(strict_types=1);

namespace IbrahimBougaoua\FilamentTrace;

use Filament\Contracts\Plugin;
use Filament\Panel;
use IbrahimBougaoua\FilamentTrace\Resources\TraceLoggerResource;
use IbrahimBougaoua\FilamentTrace\Resources\TraceResource;

class FilamentTracePlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'filament-trace';
    }

    public function register(Panel $panel): void
    {
        $panel->pages([
            TraceLoggerResource::class,
            TraceResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
