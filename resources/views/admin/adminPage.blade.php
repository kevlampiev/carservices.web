@extends('admin.main')

@section('title')
    @parent
@endsection

@section('content')
    <h3>Выбирите таблицу для редактирования</h3>
    {{--    <h1>Select DB for CRUD</h1>--}}

    {{--    @forelse($users as $user)--}}
    {{--        <p>{{ $user['name'] }}</p>--}}
    {{--    @empty--}}
    {{--        <p>There are no any users</p>--}}
    {{--    @endforelse--}}

@endsection
