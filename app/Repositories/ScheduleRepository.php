<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Repositories\Interfaces\ScheduleRepositoryInterface;
use Illuminate\Http\Request;

class ScheduleRepository implements ScheduleRepositoryInterface
{
    public function getAll()
    {
        return Schedule::query()
            ->join('services', 'schedules.service_id', '=', 'services.id')
            ->select('schedules.*', 'services.name')
            ->orderBy('work_day')
            ->paginate(7);
    }

    public function search(Request $request)
    {
        return Schedule::query()
            ->join('services', 'schedules.service_id', '=', 'services.id')
            ->where('services.name', 'like', "%$request->search%")
            ->orWhere('schedules.work_day', 'like', "%$request->search%")
            ->orWhere('schedules.work_time', 'like', "%$request->search%")
            ->orWhere('schedules.order_id', 'like', "%$request->search%")
            ->select('schedules.*', 'services.name')
            ->orderBy('work_day')
            ->paginate(7)
            ->withPath("?" . $request->getQueryString());
    }
}
