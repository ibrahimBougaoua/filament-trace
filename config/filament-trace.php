<?php

use Filament\Pages\Actions\Action;
use IbrahimBougaoua\FilamentTrace\FilamentTrace;

// config for IbrahimBougaoua/FilamentTrace
return [
    'tables' => [
        'trace' => 'filament_trace',
        'logger' => 'filament_logger',
        'settings' => 'filament_trace_settings',
    ],
    'geolocation' => [
        'service' => 'https://geolocation-db.com/json/',
        'key' => 'f2e84010-e1e9-11ed-b2f8-6b70106be3c8',
    ],
    'browsers' => [
        'Chrome' => 'Chrome',
        'Firefox' => 'Firefox',
        'Safari' => 'Safari',
        'Edge' => 'Edg',
        'IE' => 'MSIE',
        'Opera' => 'Opera',
    ],
    'systems' => [
        'iPhone' => 'iPhone',
        'iPad' => 'iPad',
        'Android' => 'Android',
        'Windows Phone' => 'Windows Phone',
        'Windows' => 'Windows',
        'Mac' => 'Macintosh',
        'Linux' => 'Linux',
    ],
    'devices' => [
        'Mobile',
        'Android',
        'iPhone',
        'iPad',
        'Windows Phone',
    ],
    'actions' => [
        'trace_truncate' => Action::make('trace_truncate')
            ->label('Delete all')
            ->action(fn () => FilamentTrace::truncate('trace'))
            ->color('danger')
            ->icon('heroicon-s-trash')
            ->requiresConfirmation()
            ->modalHeading('Delete all trace.')
            ->modalSubheading('Are you sure you\'d like to Delete all trace ?')
            ->modalButton('Yes, Delete them'),
        'logger_truncate' => Action::make('logger_truncate')
            ->label('Delete all')
            ->action(fn () => FilamentTrace::truncate('logger'))
            ->color('danger')
            ->icon('heroicon-s-trash')
            ->requiresConfirmation()
            ->modalHeading('Delete all logger.')
            ->modalSubheading('Are you sure you\'d like to Delete all logger ?')
            ->modalButton('Yes, Delete them'),
    ],
];
