@extends('admin.layout')
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
                    <form method="POST" action="{{ route('admin.schedule.store') }}">
                        @csrf
                        <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> {{ Str::upper('new schedule') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Grade Level</label>
                                   <select class="form-control" name="grade" id="grade">
                                        <option value=""></option>
                                   </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        </div>
                        </div>
                    </form>
                <!--end modal add-->
            </div>
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
                        <th scope="col">Grade level</th>
                        <th scope="col">Room name</th>
                        <th scope="col">Teacher name</th>
                        <th scope="col">Total Student</th>
                        <th scope="col"></th>
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
                            <a class="btn btn-info btn-sm" href="{{ route('admin.teacherschedule.show',$schedule->id) }}">Show</a>
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
