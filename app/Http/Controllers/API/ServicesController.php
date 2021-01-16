<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Type;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('city')) {
            $city = urldecode(request()->get('city'));
            return response()->json(
                Service::query()
                    ->where('city', $city)
                    ->with('types')->get(),
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }
        return response()->json(
            Service::query()
                ->with('types')->get(),
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }


    public function show(Service $service)
    {

        $date = new Carbon();
        $schedules = Schedule::query()
            ->where('schedules.service_id', $service->id)
            ->whereBetween('work_day', [$date->today(), $date->addWeek(3)])
            ->select('schedules.id', 'schedules.work_day', 'schedules.work_time', 'schedules.order_id', 'types.name')
            ->join('types', 'schedules.service_type_id', '=', 'types.id')
            ->get();

        $types = Service::query()->find($service->id)
            ->types()
            ->select('name')
            ->get();

        return response()->json([
            'service' => $service,
            'schedules' => $schedules,
            'types' => $types
        ], 200);
    }


    public function setSchedule(Request $request)
    {
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

    public function cityList()
    {
        return response()
            ->json(Service::query()
                ->select('city')
                ->distinct()
                ->orderBy('city')
                ->get(), 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function typeList()
    {
        return response()->json(Type::query()->select('name')->get(), 200, [], JSON_UNESCAPED_UNICODE);
    }
}
