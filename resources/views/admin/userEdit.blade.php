@extends('admin.main')

@section('content')
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;"
          action="{{ route('admin.users.update', $user) }}">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <h1 class="h3 mb-3 font-weight-normal">Редактирование данных пользователя</h1>
            <label for="Name">Имя</label>
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('name') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="name" id="Name" class="form-control" style="margin-bottom: 10px;"
                   value="{{ $user['name'] }}">
            <label for="Email">Эл.почта</label>
            @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('email') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="email" name="email" id="Email" class="form-control" style="margin-bottom: 10px;"
                   value="{{ $user['email'] }}">
            <label for="Role">Роль пользователя</label>
            <select class="form-control" id="Role" name="role" style="margin-bottom: 10px;"
                    aria-label="Default select example">
                <option @if ($user['role'] == 'admin') selected @endif value="admin">admin</option>
                <option @if ($user['role'] == 'owner') selected @endif value="owner">owner</option>
                <option @if ($user['role'] == 'user') selected @endif value="user">user</option>
            </select>
            <button class="btn btn-primary" type="submit">Сохранить</button>
            <a href="{{ route('admin.user.changePass', $user) }}" class="btn btn-success">Изменить пароль</a>
        </div>

    </form>

@endsection

