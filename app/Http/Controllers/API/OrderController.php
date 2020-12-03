<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;

class OrderController extends Controller
{
    public function setOrder(Request $request) {
//        $request->validate([
//            'car_model' => 'required|alpha_dash|min:2|max:30',
//            'license_plate_number' => 'required|alpha_num|min:3',
//            'descriptions' => 'required|string'
//        ]);
//

//        $id = Auth::user()->id;
        $order = new Order([
            'user_id' => Auth::user()->id,
            'car_model' => $request->input('car_model'),
            'license_plate_number' => $request->input('license_plate_number'),
            'description' => $request->input('description'),
            'order_status' => 'in_waiting'
        ]);

        $order->save();
        $id = $request->input('schedule_id');
        $schedule = Schedule::query()->findOrFail($id);
        $schedule->order_id = $order->id;
        $schedule->save();

        return response()->json($id);
    }
}
