<?php

namespace IbrahimBougaoua\FilamentTrace\Commands;

use IbrahimBougaoua\FilamentTrace\FilamentTrace;
use Illuminate\Console\Command;

class FilamentTraceTruncateCommand extends Command
{
    public $signature = 'filament-trace-truncate';

    public $description = 'Filament Trace Truncate';

    public function handle(): int
    {
        FilamentTrace::truncate();

        $this->comment('Filament Trace Truncated.');

        return self::SUCCESS;
    }
}
