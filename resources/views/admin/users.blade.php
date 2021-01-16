@extends('admin.adminPage')

@section('title')
    @parent
@endsection

@section('content')
    <a href="{{ route('admin.users.create') }}" role="button" class="btn btn-primary"
       style="width: 250px; display: block; margin: 5px auto; font-weight: bold;">Add new user</a>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>

                <th scope="row">{{ $user['id'] }}</th>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['role'] }}</td>
                <td>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success">Edit</a>
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
