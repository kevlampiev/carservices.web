<?php


namespace App\Repositories;

use App\Models\Service;
use App\Models\Schedule;
use App\Repositories\Interfaces\TimeSlotRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\DB;

class TimeSlotRepository implements TimeSlotRepositoryInterface
{
    public function checkService($id)
    {
        $schedule = Schedule::find($id);
        $service = Service::where('id', $schedule->service_id)
        ->where('user_id', Auth::user()->id)
        ->first();

        if ($service) {
            return true;
        }
        return false;
    }

    public function checkSchedule(Request $request)
    {
        $date = new DateTime($request->work_day);
        $schedule = Schedule::where('work_day', $date)
        ->where('work_time', $request->work_time)
        ->where('service_id', $request->service_id)
        ->where('service_type_id', $request->service_type_id)
        ->first();

        if ($schedule) {
            return true;
        }
        return false;
    }
}
