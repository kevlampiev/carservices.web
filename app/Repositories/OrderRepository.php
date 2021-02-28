<?php


namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAll(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Order::query()
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name')
            ->orderBy('id')
            ->paginate(7);
    }

    public function search(Request $request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Order::query()
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('users.name', 'like', "%$request->search%")
            ->orWhere('car_model', 'like', "%$request->search%")
            ->orWhere('license_plate_number', 'like', "%$request->search%")
            ->orWhere('order_status', 'like', "%$request->search%")
            ->select('orders.*', 'users.name')
            ->orderBy('id')
            ->paginate(7)
            ->withPath("?".$request->getQueryString());
    }
}
