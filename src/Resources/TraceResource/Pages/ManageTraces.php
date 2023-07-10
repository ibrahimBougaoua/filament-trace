<?php

namespace IbrahimBougaoua\FilamentTrace\Resources\TraceResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ManageRecords;
use IbrahimBougaoua\FilamentTrace\FilamentTrace;
use IbrahimBougaoua\FilamentTrace\Resources\TraceResource;

class ManageTraces extends ManageRecords
{
    protected static string $resource = TraceResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('logger')
                ->label('Logger')
                ->url(route('filament.resources.loggers.index'))
                ->color('primary')
                ->icon('heroicon-o-user-group'),
            config('filament-trace.actions.trace_truncate'),
            FilamentTrace::isStopped('trace')
            ? Action::make('start')
                ->label('Start it')
                ->action(fn () => FilamentTrace::sTrace('trace'))
                ->color('success')
                ->icon('heroicon-s-stop')
                ->requiresConfirmation()
                ->modalHeading('Start trace')
                ->modalSubheading('Are you sure you\'d like to Start the trace ?.')
                ->modalButton('Yes, Start it')
            : Action::make('stop')
                ->label('Stop it')
                ->action(fn () => FilamentTrace::sTrace('trace'))
                ->color('danger')
                ->icon('heroicon-s-stop')
                ->requiresConfirmation()
                ->modalHeading('Stop trace')
                ->modalSubheading('Are you sure you\'d like to Stop the trace ?.')
                ->modalButton('Yes, Stop it'),
        ];
    }
}
