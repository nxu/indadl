<?php

namespace App\Utilities\ApiLogging\Stats;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatsRepository
{
    public function getSummarySince(Carbon $date)
    {
        return DB::table('api_log')
            ->selectRaw('response')
            ->selectRaw('COUNT(1) as requests')
            ->where('ts', '>=', $date)
            ->groupBy('response')
            ->get();
    }

    public function getTopIps()
    {
        return DB::table('api_log')
            ->selectRaw('ip')
            ->selectRaw('COUNT(1) as requests')
            ->groupBy('ip')
            ->orderBy('requests', 'desc')
            ->limit(5)
            ->get();
    }

    public function getLast24hGraph()
    {
        $data = DB::table('api_log')
            ->selectRaw('HOUR(ts) as h')
            ->selectRaw('response')
            ->selectRaw('COUNT(1) as requests')
            ->where('ts', '>=', now()->subHours(24))
            ->groupBy(DB::raw('HOUR(ts)'))
            ->groupBy('response')
            ->get();

        $labels = $data->pluck('h')
            ->unique()
            ->values()
            ->map(function ($h) {
                return "$h:00";
            });

        $data = $data
            ->groupBy('response')
            ->transform(function ($items) {
                return $items->map(function ($items) {
                        return $items->requests;
                    });
            })
            ->sortBy(function ($data, $key) {
                return $key;
            });

        return [$labels, $data];
    }

    public function getLastXDaysGraph(Carbon $since)
    {
        $data = DB::table('api_log')
            ->selectRaw('DAY(ts) as d')
            ->selectRaw('response')
            ->selectRaw('COUNT(1) as requests')
            ->where('ts', '>=', $since)
            ->groupBy(DB::raw('DAY(ts)'))
            ->groupBy('response')
            ->get();

        $labels = $data->pluck('d')
            ->unique()
            ->values()
            ->map(function ($d) {
                return "$d.";
            });

        $data = $data
            ->groupBy('response')
            ->transform(function ($items) {
                return $items->map(function ($items) {
                        return $items->requests;
                    });
            })
            ->sortBy(function ($data, $key) {
                return $key;
            });

        return [$labels, $data];
    }
}
