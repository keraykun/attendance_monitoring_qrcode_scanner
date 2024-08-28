@extends('teacher.layout')
@section('content')

@error('schedule')
<script>
    // Display success message
    Swal.fire({
        icon: 'warning',
        text: "{{ $message }}",
        showConfirmButton: false,
    });
</script>
@enderror

<div class="container-fluid">
<div class="row">
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><b>Teacher : </b>{{ $schedule->teacher->name }}</li>
                            <li class="list-group-item"><b>Room : </b>{{ $schedule->room->name }}</li>
                            <li class="list-group-item"><b>Grade Year : </b>{{ $schedule->grade->name }}</li>
                            <li class="list-group-item"><b>Date Today : </b>{{ date('M d ,Y') }}</li>
                          </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-7">
        <span><input type="hidden" id="scheduleID" value="{{ $schedule->id }}"></span>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Student id</th>
                <th scope="col">Student name</th>
              </tr>
            </thead>
            <tbody id="studentList">
                @foreach ($schedule->schedule as $schedule)
                    <tr>
                        <td>{{ $schedule->student->student_id }}</td>
                        <td>{{ $schedule->student->lastname }} {{ $schedule->student->firstname }} , {{ $schedule->student->middlename }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
</div>

@endsection
