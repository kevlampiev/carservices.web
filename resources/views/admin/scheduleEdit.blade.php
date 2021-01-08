@extends('admin.main')

@section('content')
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;" action="{{ route('admin.schedules.update', $schedule) }}">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <h1 class="h3 mb-3 font-weight-normal">Schedules editing form</h1>
            <label for="Date" class="sr-only">Work day</label>
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('name') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="date" name="date" id="Date" min="2021-01-01" max="2021-12-31" class="form-control" style="margin-bottom: 10px;" value="{{ $schedule['work_day'] }}">

            <button class="btn btn-primary" type="submit">Save</button>
        </div>

    </form>

@endsection
