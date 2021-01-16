<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Schedule;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::query()
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->get();
//        $orders = Order::all();
        return response()->json($orders, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        //
//    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json($order, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return response()->json($order, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'car_model' => 'required|alpha_dash|min:2|max:30',
            'license_plate_number' => 'required|alpha_num|min:3',
            'descriptions' => 'required|string'
        ]);
        $order = $order->fill($request->all());
        if ($order->save()) {
            return response()->json(200);
        }
        return response()->json(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $schedule = Schedule::query()->find($order->id);
        $schedule->delete();
        $result = $order->delete();
        if ($result) {
            return response()->json(200);
        }
        return response()->json(400);
    }
}
