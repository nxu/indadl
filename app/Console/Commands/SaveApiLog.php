<?php

namespace App\Console\Commands;

use App\Utilities\ApiLogging\Logger;
use Illuminate\Console\Command;

class SaveApiLog extends Command
{
    protected $signature = 'api-log:save';
    protected $description = 'Persists API log entries to database';

    public function handle(Logger $logger)
    {
        $logger->persist();

        return 0;
    }
}
