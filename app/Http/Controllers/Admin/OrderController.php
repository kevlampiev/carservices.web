<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::query()
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name')
            ->orderBy('id')
            ->paginate(7);
//            ->get();
//        $orders = Order::all();
        return view('admin.orders', ['orders' => $orders]);
    }

    public function create()
    {
        return view('admin.orderCreate');
    }


    public function store(Request $request)
    {
//        dd($request);
        $request->validate(
            [
                'name' => 'required|exists:users,name',
                'car_model' => 'required|string|min:2',
                'license_plate_number' => 'required|string|min:6'
            ]);
        $user = User::query()->where('name', $request->name)->first();
//        dd($user);
        $order = new Order;
        $order->fill(
            [
                'user_id' => $user->id,
                'car_model' => $request->car_model,
                'license_plate_number' => $request->license_plate_number,
                'description' => $request->description
            ]);
        if ($order->save()) {
            return redirect()->route('admin.orders.index');
        }
        return back();
    }


    public function show()
    {
        //
    }

    public function edit(Order $order)
    {
        return view('admin.orderEdit', ['order' => $order]);
    }


    public function update(Request $request, Order $order)
    {
//        dd($request);
        $request->validate(
            [
//                'name' => 'required|exists:users,name',
                'car_model' => 'required|string|min:2',
                'license_plate_number' => 'required|string|min:6',
                'status' => 'required|in:in_waiting,confirmed,deny'
            ]);
        $order = $order->fill(
            [
//                'user_id' => $user->id,
                'car_model' => $request->car_model,
                'license_plate_number' => $request->license_plate_number,
                'description' => $request->description,
                'order_status' => $request->status
            ]);
        if ($order->save()) {
            return redirect()->route('admin.orders.index');
        }
        return back();
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return back();
    }
}
