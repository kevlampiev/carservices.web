<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request)
    {
        $orders = $request->has('search') ?
            $this->orderRepository->search($request) :
            $this->orderRepository->getAll();
        return view('admin.orders', ['orders' => $orders]);
    }

    public function create()
    {
        return view('admin.orderCreate');
    }

    public function store(OrderRequest $request)
    {
        $user = User::query()->where('name', $request->name)->first();
        $order = new Order;
        $order->fill(
            [
                'user_id' => $user->id,
                'car_model' => $request->car_model,
                'license_plate_number' => $request->license_plate_number,
                'description' => $request->description
            ]
        );
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


    public function update(OrderRequest $request, Order $order)
    {
        $order = $order->fill(
            [
                'car_model' => $request->car_model,
                'license_plate_number' => $request->license_plate_number,
                'description' => $request->description,
                'order_status' => $request->order_status
            ]
        );
        if ($order->save()) {
            return redirect()->route('admin.orders.index');
        }
        return back();
    }


    public function destroy(Order $order): \Illuminate\Http\RedirectResponse
    {
        $order->delete();
        return back();
    }
}
