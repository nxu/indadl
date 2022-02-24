<?php

namespace App\Http\Controllers;

use App\Utilities\ApiLogging\Stats\StatsRepository;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index(StatsRepository $repo)
    {
        $last24h = $repo->getSummarySince(now()->subHours(24));
        $last7d = $repo->getSummarySince(now()->subDays(7));
        $last14d = $repo->getSummarySince(now()->subDays(14));

        $ips = $repo->getTopIps();

        return view('stats.index', compact('last24h', 'last7d', 'last14d', 'ips'));
    }

    public function last24h(StatsRepository $repo)
    {
        $title = 'Elmúlt 24 óra';
        [$labels, $data] = $repo->getLast24hGraph();

        return view('stats.graph', compact('title', 'labels', 'data'));
    }

    public function last7d(StatsRepository $repo)
    {
        $title = 'Elmúlt 7 nap';
        [$labels, $data] = $repo->getLastXDaysGraph(now()->subDays(7));

        return view('stats.graph', compact('title', 'labels', 'data'));
    }

    public function last14d(StatsRepository $repo)
    {
        $title = 'Elmúlt 14 nap';
        [$labels, $data] = $repo->getLastXDaysGraph(now()->subDays(14));

        return view('stats.graph', compact('title', 'labels', 'data'));
    }
}
