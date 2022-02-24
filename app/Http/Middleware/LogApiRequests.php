<?php

namespace App\Http\Middleware;

use App\Utilities\ApiLogging\Logger;
use Closure;

class LogApiRequests
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (config('app.log_api_requests')) {
            $this->logger->log($request, $response);
        }

        return $response;
    }
}
