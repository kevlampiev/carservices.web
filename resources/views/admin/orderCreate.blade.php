@extends('admin.main')

@section('content')
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;"
          action="{{ route('admin.orders.store') }}">
        @csrf

        <div class="mb-3">
            <h1 class="h3 mb-3 font-weight-normal">Создание нового заказа</h1>
            <label for="Name">Имя пользователя</label>
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('name') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="name" id="Name" class="form-control" placeholder="Имя пользователя"
                   style="margin-bottom: 10px;">
            <label for="car_model">Модель</label>
            @if ($errors->has('car_model'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('car_model') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="car_model" id="car_model" class="form-control" placeholder="Модель"
                   style="margin-bottom: 10px;">
            <label for="license_plate_number">Гос.номер</label>
            @if ($errors->has('license_plate_number'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('license_plate_number') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="license_plate_number" id="license_plate_number" class="form-control"
                   placeholder="Гос.номер" style="margin-bottom: 10px;">
            <label for="description">Описание проблемы</label>
            <textarea class="form-control" name="description" placeholder="Описание проблемы" id="description" rows="5"
                      style="margin-bottom: 10px;"></textarea>
            <label for="order_status">Сатус заказа</label>
            @if ($errors->has('order_status'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('order_status') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <select class="form-control" name="order_status" id="order_status" style="margin-bottom: 10px;">
                <option value="in_waiting">In waiting</option>
                <option value="confirmed">Confirmed</option>
                <option value="deny">Deny</option>
            </select>
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </div>

    </form>

@endsection
