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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    {{ Str::upper('new schedule') }}
                </button>
                <!-- Modal add-->
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
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                   </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Room Name</label>
                                   <select class="form-control" name="room" id="room">
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endforeach
                                   </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Teacher</label>
                                   <select class="form-control" name="teacher" id="teacher">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
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
                            <a class="btn btn-info btn-sm" href="{{ route('admin.schedule.show',$schedule->id) }}">Show</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#updateModal-{{ $schedule->id }}">
                                EDIT
                            </button>
                            <!-- Modal update-->
                                <form method="POST" action="{{ route('admin.schedule.update',$schedule->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal fade" id="updateModal-{{ $schedule->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> {{ Str::upper('update schedule') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Grade Level</label>
                                               <select class="form-control" name="grade" id="grade">
                                                    @foreach ($grades as $grade)
                                                       @if ($grade->id==$schedule->grade->id)
                                                         <option selected value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                       @else
                                                          <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                       @endif
                                                    @endforeach
                                               </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Room Name</label>
                                               <select class="form-control" name="room" id="room">
                                                @foreach ($rooms as $room)
                                                    @if ($room->id==$schedule->room->id)
                                                    <option selected value="{{ $room->id }}">{{ $room->name }}</option>
                                                    @else
                                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                    @endif
                                                @endforeach
                                               </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Teacher</label>
                                               <select class="form-control" name="teacher" id="teacher">
                                                    @foreach ($teachers as $teacher)
                                                    @if ($teacher->id==$schedule->teacher->id)
                                                    <option selected value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                    @else
                                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                    @endif
                                                @endforeach
                                               </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update changes</button>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                </form>
                            <!--end modal update-->
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#deleteModal-{{ $schedule->id }}">
                                DELETE
                            </button>
                            <!-- Modal update-->
                                <form method="POST" action="{{ route('admin.schedule.destroy',$schedule->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal fade" id="deleteModal-{{ $schedule->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> {{ Str::upper('remove schedule') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to remove this?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Update changes</button>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                </form>
                            <!--end modal update-->
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
