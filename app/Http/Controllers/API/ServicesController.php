<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Type;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function index() {
        $city=urldecode(request()->get('city'));
        return response()->json(Service::query()
            ->where('city',$city)
            ->with('types')->get(),
            200,[],JSON_UNESCAPED_UNICODE);
    }


    public function show(Service $service) {
        $selected = Service::query()->where('id', $service->id)->with('schedules')->with('types')->get();
        return response()->json($selected, 200);
    }


    public function setSchedule(Request $request) {
        $dataOrder = [
            'user_id' => Auth::id(),
            'car_model' => $request->car_model,
            'license_plate_number' => $request->license_plate_number,
            'description' => $request->description,
            'order_status' => 'in_waiting'
        ];

        $order = Order::query()->firstOrCreate($dataOrder);
        $scheduleData = [
            'work_day' => $request->work_day,
            'work_time' => $request->work_time,
            'service_id' => $request->service_id,
            'service_type_id' => $request->service_type_id,
            'order_id' => $order->id
        ];

        $schedule = Schedule::query()->firstOrCreate($scheduleData);
        return response()->json(['message' => 'Запись добавлена в базу']);
    }

    public function cityList() {
        return response()->json(Service::query()->select('city')->distinct()->orderBy('city')->get(),200,[],JSON_UNESCAPED_UNICODE);
    }

    public function typeList() {
        return response()->json(Type::query()->select('name')->get(), 200,[],JSON_UNESCAPED_UNICODE);
    }

}
