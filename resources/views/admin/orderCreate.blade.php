@extends('admin.main')

@section('content')
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;"
          action="{{ route('admin.orders.store') }}">
        @csrf

        <div class="mb-3">
            <h1 class="h3 mb-3 font-weight-normal">Создание нового заказа</h1>
            <label for="Name" class="sr-only">Name</label>
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('name') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="name" id="Name" class="form-control" placeholder="Имя пользователя"
                   style="margin-bottom: 10px;">
            <label for="car_model" class="sr-only">Email address</label>
            @if ($errors->has('car_model'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('car_model') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="car_model" id="car_model" class="form-control" placeholder="Модель"
                   style="margin-bottom: 10px;">
            <label for="license_plate_number" class="sr-only">Password</label>
            @if ($errors->has('license_plate_number'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('license_plate_number') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="license_plate_number" id="license_plate_number" class="form-control"
                   placeholder="Гос.номер" style="margin-bottom: 10px;">
            <label for="description" class="sr-only">Confirm</label>
            <textarea class="form-control" name="description" placeholder="Описание проблемы" id="description" rows="5"
                      style="margin-bottom: 10px;"></textarea>
            {{--            <select class="form-control" name="status" style="margin-bottom: 10px;" aria-label="Default select example">--}}
            {{--                <option value="in_waiting">in_waiting</option>--}}
            {{--                <option value="in_process">in_process</option>--}}
            {{--                <option value="completed">completed</option>--}}
            {{--            </select>--}}
            <button class="btn btn-primary" type="submit">Save</button>
        </div>

    </form>

@endsection
