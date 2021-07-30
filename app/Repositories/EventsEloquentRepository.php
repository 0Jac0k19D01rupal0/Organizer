<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class EventsEloquentRepository implements EventsRepository
{

    /**
     * Return all events
     *
     * @return \Illuminate\Support\Collection
     */
    public function events()
    {
        return DB::table('events')->get();
    }

    /**
     * Return events by day
     *
     * @param $start
     * @param $end
     * @return \Illuminate\Support\Collection
     */
    public function dayEvents($start, $end)
    {
        $dayStart = date("d", $start);
        $dayEnd = date("d", $end);

        return DB::table('events')
            ->whereBetween('DAY(time)', [$dayStart, $dayEnd])
            ->get();
    }

    /**
     * Return events by week
     *
     * @param $start
     * @param $end
     * @return \Illuminate\Support\Collection
     */
    public function weekEvents($start, $end)
    {
        $weekStart = $start->subDays($start->dayOfWeek)->setTime(0, 0);
        $weekEnd = $end->subDays($end->dayOfWeek)->setTime(0, 0);

        return DB::table('events')
            ->whereBetween('time', [$weekStart, $weekEnd])
            ->get();
    }

    /**
     * Return events by month
     *
     * @param $start
     * @param $end
     * @return \Illuminate\Support\Collection
     */
    public function monthEvents($start, $end)
    {
        $monthStart = date('m', $start);
        $monthEnd = date('m', $end);

        return DB::table('events')
            ->whereBetween('MOUNT(time)', [$monthStart, $monthEnd])
            ->get();
    }

    /**
     * Return events by year
     *
     * @param $start
     * @param $end
     * @return \Illuminate\Support\Collection
     */
    public function yearEvents($start, $end)
    {
        $startYear = date('Y', $start);
        $endYear = date('Y', $end);

        return DB::table('events')
            ->whereBetween('YEAR(time)', [$startYear, $endYear])
            ->get();
    }

    /**
     * Return events by user
     *
     * @param $user
     * @return mixed
     */
    public function eventsCurrentUser($user)
    {
        return DB::tables('events')
            ->whereRaw('user_id', [$user])
            ->get();
    }
}
