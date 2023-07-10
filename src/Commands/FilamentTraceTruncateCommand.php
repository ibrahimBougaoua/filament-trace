<?php

namespace IbrahimBougaoua\FilamentTrace\Commands;

use IbrahimBougaoua\FilamentTrace\FilamentTrace;
use Illuminate\Console\Command;

class FilamentTraceTruncateCommand extends Command
{
    public $signature = 'filament-trace-truncate';

    public $description = 'Filament Truncate trace table';

    public function handle(): int
    {
        FilamentTrace::truncate('trace');
        $this->comment('Filament trace Truncated successfully.');

        return self::SUCCESS;
    }
}
