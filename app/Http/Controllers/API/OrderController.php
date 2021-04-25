<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\OrderCreated;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function setOrder(Request $request)
    {
        $order = new Order([
            'user_id' => Auth::user()->id,
            'car_model' => $request->input('car_model'),
            'license_plate_number' => $request->input('license_plate_number'),
            'description' => $request->input('description'),
            'order_status' => 'in_waiting'
        ]);

        $order->save();
        Mail::to(Auth::user()->email)
        ->cc(Auth::user()->email)
        ->send(new OrderCreated());
        $id = $request->input('schedule_id');
        $schedule = Schedule::query()->findOrFail($id);
        $schedule->order_id = $order->id;
        $schedule->save();

        return response()->json($id);
    }
}
