@extends('admin.adminPage')

@section('title')
    @parent
@endsection

@section('content')
    <a href="{{ route('admin.orders.create') }}" role="button" class="btn btn-primary"
       style="width: 250px; display: block; margin: 5px auto; font-weight: bold;">Добавить новый заказ</a>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя пользователя</th>
            <th scope="col">Модель</th>
            <th scope="col">Номер</th>
            <th scope="col">Описание</th>
            <th scope="col">Статус</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>

                <th scope="row">{{ $order['id'] }}</th>
                <td>{{ $order['name'] }}</td>
                <td>{{ $order['car_model'] }}</td>
                <td>{{ $order['license_plate_number'] }}</td>
                <td>{{ $order['description'] }}</td>
                <td>{{ $order['order_status'] }}</td>
                <td>
                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST">
                        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-success">Edit</a>
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $orders->links() }}
@endsection
