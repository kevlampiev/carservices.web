<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@forelse($users as $user)
    <div>
        <h3>Имя пользователя: {{ $user->name }}</h3>
        <p>Статус: {{ $user->role }}</p>
        <a href="#" class="btn btn-success">Изменить статус</a>
        <p>Эл.почта: {{ $user->email }}</p>
        <a href="{{ route('admin.user.edit', $user) }}">Редактировать</a>
        <a href="{{ route('admin.user.destroy', $user) }}">Удалить</a>
        <hr>
    </div>
@empty
    <p>There are no any users</p>
@endforelse

</body>
</html>
