<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchedulesRequest;
use App\Models\Schedule;
use App\Repositories\Interfaces\ScheduleRepositoryInterface;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public $scheduleRepository;

    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function index(Request $request)
    {
        $schedules = $request->has('search') ?
            $this->scheduleRepository->search($request) :
            $this->scheduleRepository->getAll();
        return view('admin.schedules', ['schedules' => $schedules]);
    }

    public function create()
    {
        return view('admin.scheduleCreate');
    }

    public function store(SchedulesRequest $request)
    {
        $schedule = new Schedule;

        $schedule->fill($request->all());

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

    public function update(SchedulesRequest $request, Schedule $schedule)
    {
        $schedule->fill($request->all());
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
