<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TimeSlotEditRequest;
use DateTime;
use App\Repositories\Interfaces\TimeSlotRepositoryInterface;
use App\Mail\TimeSlotCreated;
use Illuminate\Support\Facades\Mail;

class TimeSlotController extends Controller
{
    private $timeSlotRepository;

    public function __construct(TimeSlotRepositoryInterface $timeSlotRepository)
    {
        $this->timeSlotRepository = $timeSlotRepository;
    }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TimeSlotEditRequest $request)
    {
        $schedule = new Schedule;
        $schedule->fill($request->all());

        if ($schedule->save()) {
            Mail::to(Auth::user()->email)
            ->cc('nik.aleksenko@gmail.com')
            ->send(new TimeSlotCreated($schedule, $request->name));

            return response()->json([
                'message' => 'Запись добавлена',
                'schedule' => $schedule
            ]);
        }
        return response()->json(['error' => 'Error']);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TimeSlotEditRequest $request, $id)
    {
        $date = new DateTime($request->work_day);
        if ($this->timeSlotRepository->checkService($id)) {
            if ($this->timeSlotRepository->checkSchedule($request)) {
                return response()->json(['message' => 'Запись в такими параметрами уже есть в БД']);
            }
            $schedule = Schedule::find($id);
            $result = $schedule->update([
                'work_day' => $date,
                'work_time' => $request->work_time,
                'service_type_id' => $request->service_type_id
            ]);
            if ($result) {
                return response()->json(['message' => 'Запись обновлена', 'schedule'=>$schedule], 200);
            }
            return response()->json(['error' => 'Error']);
        }
        return response()->json(['message' => 'Вы ввели неверные значения']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($this->timeSlotRepository->checkService($id)) {
            $schedule = Schedule::find($id);

            if ($schedule->delete()) {
                return response()->json(['message' => 'Запись удалена']);
            }
            return response()->json(['error' => 'Error']);
        }
        return response()->json(['message' => 'Вы не можете удалить данную запись']);
    }
}
