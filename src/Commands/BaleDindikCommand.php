<?php

namespace Paparee\BaleDindik\Commands;

use Illuminate\Console\Command;

class BaleDindikCommand extends Command
{
    public $signature = 'bale-dindik';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
