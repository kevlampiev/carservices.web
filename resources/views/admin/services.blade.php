@extends('admin.adminPage')

@section('title')
    @parent
@endsection

@section('content')
{{--    @dump($services)--}}
    <form action="{{ route('admin.services.index') }}">
        <div class="filters row">
            <div class="col-sm-6 col-md-3">
                <label for="search_string">Поиск записи
                    <input type="text" id="search_string" name="search" value="">
                </label>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-primary">Поиск</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-warning">Сбросить фильтр</a>
            </div>
        </div>
    </form>
    <a href="{{ route('admin.services.create') }}" role="button" class="btn btn-primary"
       style="width: 300px; display: block; margin: 5px auto; font-weight: bold;">Добавить новый сервис</a>
    <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
        @foreach($services as $service)
            <div class="card" style="width: 30%; margin: 5px;">
                <img src="{{ $service['img_link'] }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Название: {{ $service['name'] }}</h5>
                    <ul>Тип сервиса:
                        @foreach($service['types'] as $type)
                            <li style="display: inline">{{ $type['name'] }} |</li>
                        @endforeach
                    </ul>
                    <p class="card-text">Описание: {{ $service['description'] }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Город: {{ $service['city'] }}</li>
                    <li class="list-group-item">Адрес: {{ $service['address'] }}</li>
                    <li class="list-group-item">Телефон: {{ $service['phone'] }}</li>
                    <li class="list-group-item">Эл.почта: {{ $service['email'] }}</li>
                    <li class="list-group-item">Сайт: {{ $service['site'] }}</li>
                    <li class="list-group-item">Телеграмм: {{ $service['telegram'] }}</li>
                    <li class="list-group-item">Скайп: {{ $service['skype'] }}</li>
                </ul>
                <form class="card-body" action="{{ route('admin.services.destroy', $service) }}" method="POST">
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-success">Edit</a>
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </div>
        @endforeach
    </div>
    {{ $services->links() }}

@endsection
