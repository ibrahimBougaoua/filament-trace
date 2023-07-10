<?php

namespace IbrahimBougaoua\FilamentTrace\Commands;

use IbrahimBougaoua\FilamentTrace\FilamentTrace;
use Illuminate\Console\Command;

class FilamentLoggerTruncateCommand extends Command
{
    public $signature = 'filament-logger-truncate';

    public $description = 'Filament Truncate logger table';

    public function handle(): int
    {
        FilamentTrace::truncate('logger');
        $this->comment('Filament logger Truncated successfully.');

        return self::SUCCESS;
    }
}
