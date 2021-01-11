@extends('admin.main')

@section('content')
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;" action="{{ route('admin.services.update', $service) }}">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <h1 class="h3 mb-3 font-weight-normal">Editing form</h1>
            <label for="Name">Name</label>
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('name') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="name" id="Name" class="form-control" style="margin-bottom: 10px;" value="{{ $service ['name'] }}">
            <label for="City">City</label>
            @if ($errors->has('city'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('city') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="city" id="City" class="form-control" style="margin-bottom: 10px;" value="{{ $service ['city'] }}">
            <label for="Address">Address</label>
            @if ($errors->has('address'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('address') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="address" id="Address" class="form-control" style="margin-bottom: 10px;" value="{{ $service ['address'] }}">
            <label for="textarea">Description</label>
            <textarea class="form-control" name="description" id="textarea" rows="5">{{ $service ['description'] }}</textarea>
            <label for="Site">Site</label>
            @if ($errors->has('site'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('site') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="site" id="Site" class="form-control" style="margin-bottom: 10px;" value="{{ $service ['site'] }}">
            <label for="Phone">Phone</label>
            @if ($errors->has('city'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('phone') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="phone" id="Phone" class="form-control" style="margin-bottom: 10px;" value="{{ $service ['phone'] }}">
            <label for="Email">Email address</label>
            @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('email') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="email" name="email" id="Email" class="form-control" style="margin-bottom: 10px;" value="{{ $service['email'] }}">
            <label for="Telegram">Telegram</label>
            @if ($errors->has('telegram'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('telegram') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="telegram" id="Telegram" class="form-control" style="margin-bottom: 10px;" value="{{ $service ['telegram'] }}">
            <label for="Skype">Skype</label>
            @if ($errors->has('skype'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('skype') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="skype" id="Skype" class="form-control" style="margin-bottom: 10px;" value="{{ $service ['skype'] }}">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>


    </form>
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;" action="">
        <h5 class="h5 mb-3 font-weight-normal">Тип сервиса</h5>
        <ul class="list-group">
            @foreach($types as $type)
                <li class="list-group-item" style="display: flex; justify-content: space-between">
                    {{ $type['name'] }}
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="&times;">
                    </form>
                </li>
            @endforeach
        </ul>
        <h5 style="margin: 0 auto; display: block; text-align: center;">Добавить тип {{ $type['name'] }}</h5>
        <select class="form-control" name="role" style="margin-bottom: 10px;" aria-label="Default select example">
            @foreach($allTypes as $item)
                @if(!array_search($item['name'], $types))
                    <p>{{ $item['name'] }}</p>
                @endif
{{--            <option value="admin">{{ $item['name'] }}</option>--}}
            @endforeach
        </select>
        <button class="btn btn-primary" type="submit">Добавить</button>
    </form>


@endsection
