@extends('admin.adminPage')

@section('title')
    @parent
@endsection

@section('content')
    {{--    @dd($schedules)--}}
    <a href="{{ route('admin.schedules.create') }}" role="button" class="btn btn-primary"
       style="width: 250px; display: block; margin: 5px auto; font-weight: bold;">Add new schedule</a>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Work day</th>
            <th scope="col">Work time</th>
            <th scope="col">Service Name</th>
            <th scope="col">Order ID</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($schedules as $schedule)
            <tr>

                <th scope="row">{{ $schedule['id'] }}</th>
                <td>{{ $schedule['work_day'] }}</td>
                <td>{{ $schedule['work_time'] }}</td>
                <td>{{ $schedule['name'] }}</td>
                <td>
                    {{ ($schedule['order_id']) ? $schedule['order_id'] : 'There is no order' }}</td>
                <td>
                    <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST">
                        <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-success">Edit</a>
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $schedules->links() }}
@endsection
