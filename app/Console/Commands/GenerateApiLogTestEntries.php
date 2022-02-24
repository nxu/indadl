<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class GenerateApiLogTestEntries extends Command
{
    protected $signature = 'api-log:test';
    protected $description = 'Generates test entries for testing api log';

    public function handle()
    {
        $ips = [
            '192.168.10.1',
            '2223:fba2:1afb:e258:3e67:1d9c:1d17:b760',
            '49.196.39.65',
            '49.196.39.65',
            '49.196.39.65',
            '178.211.53.126',
            '178.211.53.126',
            '30.67.41.167',
            '30.67.41.167',
        ];

        $codes = [200, 200, 200, 200, 200, 200, 400, 400, 400, 500];

        $period = CarbonPeriod::create(Carbon::today()->subMonth(), '1 second', Carbon::tomorrow());

        foreach ($period as $time) {
            $this->info("Processing [{$time->format('Y-m-d H:i:s')}]");
            $requests = random_int(0, 2);

            for ($i = 0; $i < $requests; ++$i) {
                $ip = Arr::random($ips);
                $code = Arr::random($codes);

                DB::table('api_log')->insert([
                    'ts' => $time,
                    'ip' => $ip,
                    'response' => $code,
                ]);
            }
        }
    }
}
