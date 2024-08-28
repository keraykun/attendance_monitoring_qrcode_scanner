@extends('admin.layout')
@section('content')

@error('teacher')
<script>
    // Display success message
    Swal.fire({
        icon: 'warning',
        text: "{{ $message }}",
        showConfirmButton: false,
    });
</script>
@enderror
@error('email')
<script>
    // Display success message
    Swal.fire({
        icon: 'warning',
        text: "{{ $message }}",
        showConfirmButton: false,
    });
</script>
@enderror
@error('password')
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
                    {{ Str::upper('new teacher') }}
                </button>
                <!-- Modal add-->
                    <form method="POST" action="{{ route('admin.teacher.store') }}">
                        @csrf
                        <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> {{ Str::upper('new teacher') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Teacher Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="teacher" value="{{ old('teacher') }}" aria-describedby="emailHelp" placeholder="Enter name">
                                </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ old('email') }}"  aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Password">
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
                        <th scope="col">Full name</th>
                        <th scope="col">Email</th>
                        <td scope="col">Action</td>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($teachers as $teacher)
                      <tr>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#updateModal-{{ $teacher->id }}">
                                EDIT
                            </button>
                            <!-- Modal update-->
                                <form method="POST" action="{{ route('admin.teacher.update',$teacher->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal fade" id="updateModal-{{ $teacher->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> {{ Str::upper('update teacher') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Teacher Name</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="teacher" value="{{ $teacher->name }}" aria-describedby="emailHelp" placeholder="Enter name">
                                            </div>
                                                <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ $teacher->email }}"  aria-describedby="emailHelp" placeholder="Enter email">
                                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                                </div>
                                                <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" name="password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Confirm Password</label>
                                                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Password">
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
                            <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#deleteModal-{{ $teacher->id }}">
                                DELETE
                            </button>
                            <!-- Modal update-->
                                <form method="POST" action="{{ route('admin.teacher.destroy',$teacher->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal fade" id="deleteModal-{{ $teacher->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> {{ Str::upper('remove teacher') }}</h5>
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
             {{    $teachers->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
          </div>
    </div>
</div>
</div>

@endsection
