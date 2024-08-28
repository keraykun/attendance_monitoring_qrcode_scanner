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
    <div class="col-md-12 mb-3">
        <div class="card">

            <div class="card-body">
                <form method="GET">
                <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search . . .">
                        <div class="input-group-append">
                          <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                          </button>
                        </div>
                  </div>
                </form>
            </div>
          </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Grade Level</th>
                        <th scope="col">Room Name</th>
                        <th scope="col">Teacher Name</th>
                        <th scope="col">Total Student</th>
                        <th scope="col">Attendance</th>
                        <th scope="col">Student List</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($schedules as $schedule)
                      <tr>
                        <td>{{ $schedule->grade->name }}</td>
                        <td>{{ $schedule->room->name }}</td>
                        <td>{{ $schedule->teacher->name }}</td>
                        <td>{{ $schedule->schedule_count }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('teacher.schedule.show',$schedule->id) }}">Show</a>
                        </td>
                        <td>
                            <a class="btn btn-success btn-sm" href="{{ route('teacher.schedule.room',$schedule->id) }}">Show</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>

            <div class="card-body">
             {{    $schedules->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
          </div>
    </div>
</div>
</div>

@endsection
