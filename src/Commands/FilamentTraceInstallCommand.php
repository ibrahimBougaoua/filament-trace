<?php

namespace IbrahimBougaoua\FilamentTrace\Commands;

use IbrahimBougaoua\FilamentTrace\FilamentTrace;
use IbrahimBougaoua\FilamentTrace\Models\TraceSetting;
use Illuminate\Console\Command;

class FilamentTraceInstallCommand extends Command
{
    public $signature = 'filament-trace-install';

    public $description = 'filament trace install';

    public function handle(): int
    {
        if( FilamentTrace::hasMigrated() )
        {
            if( ! TraceSetting::count() )
            {
                TraceSetting::create([
                    'key' => 'trace',
                    'truncate' => false,
                    'stop' => false,
                ]);

                TraceSetting::create([
                    'key' => 'logger',
                    'truncate' => false,
                    'stop' => false,
                ]);

                $this->comment('All done');
            }
        } else {
            $this->comment('You are not migrate tables yet,please follow steps : ');
            $this->comment('php artisan vendor:publish --tag="filament-trace-migrations"');
            $this->comment('php artisan migrate');
            $this->comment('php artisan filament-trace-install');
        }

        return self::SUCCESS;
    }
}
