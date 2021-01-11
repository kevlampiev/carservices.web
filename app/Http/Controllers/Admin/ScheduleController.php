<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    public function index()
    {
        $schedules = Schedule::query()
            ->join('services', 'schedules.service_id', '=', 'services.id')
//            ->join('services_types', 'schedules.service_type_id', '=', 'services_types.id')
//            ->join('orders', 'schedules.order_id', '=', 'orders.id')
            ->select('schedules.*', 'services.name')
            ->get();
        return view('admin.schedules', ['schedules' => $schedules]);
    }

    public function create()
    {
        return view('admin.scheduleCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'work_day' => 'required|date',

            'work_time' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'service_type_id' => 'required|exists:types,id'
        ]);
        $schedule = new Schedule;
        $schedule -> fill($request->all());

        if ($schedule->save()) {
            return redirect()->route('admin.schedules.index');
        }
        return back();
    }

    public function show(Schedule $schedule)
    {
//
    }

    public function edit(Schedule $schedule)
    {
        return view('admin.scheduleEdit', ['schedule' => $schedule]);
    }

    public function update(Request $request, Schedule $schedule)
    {

        $request->validate([
            'work_day' => 'required|date',
            'work_time' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'service_type_id' => 'required|exists:types,id'
        ]);
        $schedule -> fill($request->all());
        if ($schedule->save()) {
            return redirect()->route('admin.schedules.index');
        }
        return back();

    }


    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return back();
    }
}
