@extends('admin.main')

@section('content')
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;"
          action="{{ route('admin.users.store') }}">
        @csrf

        <div class="mb-3">
            <h1 class="h3 mb-3 font-weight-normal">Creating user</h1>
            <label for="Name" class="sr-only">Name</label>
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('name') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="name" id="Name" class="form-control" placeholder="Name"
                   style="margin-bottom: 10px;">
            <label for="Email" class="sr-only">Email address</label>
            @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('email') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="email" name="email" id="Email" class="form-control" placeholder="Email"
                   style="margin-bottom: 10px;">
            <label for="password" class="sr-only">Password</label>
            @if ($errors->has('password'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('password') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                   style="margin-bottom: 10px;">
            <label for="password-confirm" class="sr-only">Confirm</label>
            <input type="password" name="password-confirm" id="password-confirm" class="form-control"
                   placeholder="Confirm Password" style="margin-bottom: 10px;">
            <select class="form-control" name="role" style="margin-bottom: 10px;" aria-label="Default select example">
                <option value="admin">admin</option>
                <option value="owner">owner</option>
                <option value="user">user</option>
            </select>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>

    </form>

@endsection
