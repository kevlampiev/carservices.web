@extends('admin.main')

@section('content')
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;"
          action="{{ route('admin.user.updatePass', $user) }}">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <h1 class="h3 mb-3 font-weight-normal">Изменение пароля пользователя</h1>
            <label for="password">Введите новый пароль</label>
            @if ($errors->has('password'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('password') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                   style="margin-bottom: 10px;">
            <label for="password-confirm">Подтвердите пароль</label>
            <input type="password" name="password_confirmation" id="password-confirm" class="form-control"
                   placeholder="Confirm Password" style="margin-bottom: 10px;">
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </div>

    </form>

@endsection
