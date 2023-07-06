<?php

namespace IbrahimBougaoua\FilamentTrace\Commands;

use Illuminate\Console\Command;

class FilamentTraceCommand extends Command
{
    public $signature = 'filament-trace';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
