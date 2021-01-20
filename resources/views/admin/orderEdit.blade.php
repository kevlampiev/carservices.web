@extends('admin.main')

@section('content')
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;" action="{{ route('admin.orders.update', $order) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <h1 class="h3 mb-3 font-weight-normal">Редактирование заказа</h1>
{{--            <label for="Name" class="sr-only">Name</label>--}}
{{--            @if ($errors->has('name'))--}}
{{--                <div class="alert alert-danger" role="alert">--}}
{{--                    @foreach($errors->get('name') as $error)--}}
{{--                        {{ $error }}--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <input type="text" name="name" id="Name" class="form-control" value="{{ $order['name'] }}" placeholder="Имя пользователя" style="margin-bottom: 10px;">--}}
            <label for="car_model" >Модель</label>
            @if ($errors->has('car_model'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('car_model') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="car_model" id="car_model" class="form-control" value="{{ $order['car_model'] }}" placeholder="Модель" style="margin-bottom: 10px;">
            <label for="license_plate_number">Гос.номер</label>
            @if ($errors->has('license_plate_number'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('license_plate_number') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="license_plate_number" id="license_plate_number" class="form-control" value="{{ $order['license_plate_number'] }}" style="margin-bottom: 10px;">
            <label for="description">Описание проблемы</label>
            <textarea class="form-control" name="description" id="description" rows="5" style="margin-bottom: 10px;">{{ $order['description'] }}</textarea>
                        <select class="form-control" name="status" style="margin-bottom: 10px;" aria-label="Default select example">
                            <option @if ($order['status'] == 'in_waiting') selected @endif value="in_waiting">in_waiting</option>
                            <option @if ($order['status'] == 'confirmed') selected @endif value="confirmed">confirmed</option>
                            <option @if ($order['status'] == 'deny') selected @endif value="deny">deny</option>
                        </select>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>

    </form>

@endsection
