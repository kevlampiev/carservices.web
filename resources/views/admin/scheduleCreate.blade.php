@extends('admin.main')

@section('content')
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;"
          action="{{ route('admin.schedules.store') }}">
        @csrf

        <div class="mb-3">
            <h1 class="h3 mb-3 font-weight-normal">Create new schedule</h1>
            <label for="date">Work day</label>
            @if ($errors->has('work_day'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('work_day') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="date" name="work_day" id="Date" min="2021-01-01" max="2021-12-31" class="form-control"
                   style="margin-bottom: 10px;">
            <label for="time">Work time</label>
            @if ($errors->has('work_time'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('work_time') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="work_time" id="time" class="form-control" style="margin-bottom: 10px;">
            <label for="service">Service ID</label>
            @if ($errors->has('service_id'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('service_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="service_id" id="service" class="form-control" style="margin-bottom: 10px;">
            <label for="type">Service Type ID</label>
            @if ($errors->has('service_type_id'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('service_type_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input type="text" name="service_type_id" id="type" class="form-control" style="margin-bottom: 10px;">

            <button class="btn btn-primary" type="submit">Save</button>
        </div>

    </form>

@endsection
