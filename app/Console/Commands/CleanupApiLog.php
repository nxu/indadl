<?php

namespace App\Console\Commands;

use App\Utilities\ApiLogging\Logger;
use Illuminate\Console\Command;

class CleanupApiLog extends Command
{
    protected $signature = 'api-log:cleanup';
    protected $description = 'Clean up old API log entries';

    public function handle(Logger $logger)
    {
        $logger->cleanup();
    }
}
