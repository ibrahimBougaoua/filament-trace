<?php

namespace IbrahimBougaoua\FilamentTrace\Resources\TraceLoggerResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ManageRecords;
use IbrahimBougaoua\FilamentTrace\FilamentTrace;
use IbrahimBougaoua\FilamentTrace\Resources\TraceLoggerResource;

class ManageTraceLoggers extends ManageRecords
{
    protected static string $resource = TraceLoggerResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('trace')
                ->label('Trace')
                ->url(route('filament.resources.traces.index'))
                ->color('primary')
                ->icon('heroicon-s-document-text'),
            config('filament-trace.actions.logger_truncate'),
            FilamentTrace::isStopped('logger') 
            ? Action::make('start')
                ->label('Start it')
                ->action(fn () => FilamentTrace::sTrace('logger'))
                ->color('success')
                ->icon('heroicon-s-stop')
                ->requiresConfirmation()
                ->modalHeading('Start Logger')
                ->modalSubheading('Are you sure you\'d like to Start the Logger ?.')
                ->modalButton('Yes, Start it')
            : Action::make('stop')
                ->label('Stop it')
                ->action(fn () => FilamentTrace::sTrace('logger'))
                ->color('danger')
                ->icon('heroicon-s-stop')
                ->requiresConfirmation()
                ->modalHeading('Stop Logger')
                ->modalSubheading('Are you sure you\'d like to Stop the Logger ?.')
                ->modalButton('Yes, Stop it'),
        ];
    }
}
