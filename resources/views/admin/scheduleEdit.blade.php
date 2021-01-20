@extends('admin.main')

@section('content')
    <form class="form-signin mb-3" enctype="multipart/form-data" method="POST" style="margin: 0 auto; width: 50%;"
          action="{{ route('admin.schedules.update', $schedule) }}">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <h1 class="h3 mb-3 font-weight-normal">Schedules editing form</h1>

            <label for="date" class="sr-only">Work day</label>
            @if ($errors->has('work_day'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('work_day') as $error)

                        {{ $error }}
                    @endforeach
                </div>
            @endif


            <input type="date" name="work_day" id="date" min="2021-01-01" max="2021-12-31" class="form-control" style="margin-bottom: 10px;" value="{{ $schedule['work_day'] }}">
            <label for="time" >Work time</label>
            @if ($errors->has('work_time'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('work_time') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <input type="text" name="work_time" id="time" class="form-control" style="margin-bottom: 10px;" value="{{ $schedule['work_time'] }}">
            <label for="service" >Service ID</label>
            @if ($errors->has('service_id'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('service_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <input type="text" name="service_id" id="service" class="form-control" style="margin-bottom: 10px;" value="{{ $schedule['service_id'] }}">
            <label for="type" >Service Type ID</label>
            @if ($errors->has('service_type_id'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('service_type_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <input type="text" name="service_type_id" id="type" class="form-control" style="margin-bottom: 10px;" value="{{ $schedule['service_type_id'] }}">


            <button class="btn btn-primary" type="submit">Save</button>
        </div>

    </form>

@endsection
