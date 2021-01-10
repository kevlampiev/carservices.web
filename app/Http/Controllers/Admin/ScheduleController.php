<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = Schedule::query()
            ->join('services', 'schedules.service_id', '=', 'services.id')
            ->join('services_types', 'schedules.service_type_id', '=', 'services_types.id')
            ->join('orders', 'schedules.order_id', '=', 'orders.id')
            ->get();
        return response()->json($schedule, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //        $type = Type::query()->where('id', $schedule->service_type_id)->select('name')->first();
        $schedule = Schedule::query()->where('schedules.id', $schedule->id)
            ->join('services', 'schedules.service_id', '=', 'services.id')
            ->join('services_types', 'schedules.service_type_id', '=', 'services_types.id')
            ->join('orders', 'schedules.order_id', '=', 'orders.id')
            ->get();
        return response()->json($schedule);
        //        return response()->json([
        //            'schedule' => $schedule,
        //            'type' => $type
        //            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        return response()->json($schedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Schedule     $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate(
            [
            'work_date' => 'required|date',
            'work_time' => 'required|numeric'
            ]
        );
        $schedule = $schedule->fill($request->all());
        if ($schedule->save()) {
            return response()->json(200);
        }
        return response()->json(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $result = $schedule->delete();
        if ($result) {
            return response()->json(200);
        }
        return response()->json(400);
    }
}
