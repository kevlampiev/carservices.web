<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Http\Requests\TimeSlotEditRequest;
use DateTime;

class TimeSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TimeSlotEditRequest $request, $id)
    {
        $date = new DateTime($request->work_day);
        $service = Service::where('id', $request->service_id)
        ->where('user_id', Auth::user()->id)
        ->first();
        if ($service) {
            $schedule = Schedule::find($id);
            $result = $schedule->update([
                'work_day' => $date,
                'work_time' => $request->work_time,
                'service_type_id' => $request->service_type_id
            ]);
            if ($result) {
                return response()->json(['message' => 'Запись обновлена'],200);
            }
            return response()->json(['error' => 'Error']);
        }
        return response()->json(['message' => 'Вы ввели неверные значения']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
