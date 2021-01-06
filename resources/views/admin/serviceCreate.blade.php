@extends('admin.main')

@section('content')
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;" action="{{ route('admin.services.store') }}">
        @csrf

        <div class="mb-3">
            <h1 class="h3 mb-3 font-weight-normal">Creating new service</h1>
            <label for="Name">Name</label>
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('name') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="name" id="Name" class="form-control" style="margin-bottom: 10px;">
            <label for="City">City</label>
            @if ($errors->has('city'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('city') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="city" id="City" class="form-control" style="margin-bottom: 10px;">
            <label for="Address">Address</label>
            @if ($errors->has('address'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('address') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="address" id="Address" class="form-control" style="margin-bottom: 10px;">
            <label for="textarea">Description</label>
            <textarea class="form-control" name="description" id="textarea" rows="5"></textarea>
            <label for="Site">Site</label>
            @if ($errors->has('site'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('site') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="site" id="Site" class="form-control" style="margin-bottom: 10px;">
            <label for="Phone">Phone</label>
            @if ($errors->has('city'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('phone') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="phone" id="Phone" class="form-control" style="margin-bottom: 10px;">
            <label for="Email">Email address</label>
            @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('email') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="email" name="email" id="Email" class="form-control" style="margin-bottom: 10px;">
            <label for="Telegram">Telegram</label>
            @if ($errors->has('telegram'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('telegram') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="telegram" id="Telegram" class="form-control" style="margin-bottom: 10px;">
            <label for="Skype">Skype</label>
            @if ($errors->has('skype'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('skype') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="skype" id="Skype" class="form-control" style="margin-bottom: 10px;">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>

    </form>

@endsection
