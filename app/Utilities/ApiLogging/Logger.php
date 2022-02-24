<?php

namespace App\Utilities\ApiLogging;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class Logger
{
    public function log(Request $request, Response $response)
    {
        $statusCode = $response->getStatusCode();

        if (mb_substr($statusCode, 0, 1) == '2') {
            $statusCode = 200;
        } elseif (mb_substr($statusCode, 0, 1) == '4') {
            $statusCode = 400;
        } elseif (mb_substr($statusCode, 0, 1) == '5') {
            $statusCode = 500;
        }

        $apiRequest = new ApiRequest(time(), $request->getClientIp(), $statusCode);
        $apiRequest = json_encode($apiRequest);

        Redis::lpush('api-log', $apiRequest);
    }

    public function persist()
    {
        while ($entry = Redis::lpop('api-log')) {
            $entry = json_decode($entry);

            DB::table('api_log')->insert([
                'ts' => Carbon::createFromTimestamp($entry->timestamp, 'Europe/Budapest'),
                'ip' => $entry->ip,
                'response' => $entry->response_code
            ]);
        }
    }

    public function cleanup()
    {
        DB::table('api_log')
            ->where('ts', '<', now()->subMonth()->timestamp)
            ->delete();
    }
}
