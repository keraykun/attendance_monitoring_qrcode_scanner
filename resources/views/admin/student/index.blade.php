@extends('admin.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
@error('firstname')
<script>
    // Display success message
    Swal.fire({
        icon: 'warning',
        text: "{{ $message }}",
        showConfirmButton: false,
    });
</script>
@enderror

@error('middlename')
<script>
    // Display success message
    Swal.fire({
        icon: 'warning',
        text: "{{ $message }}",
        showConfirmButton: false,
    });
</script>
@enderror

@error('lastname')
<script>
    // Display success message
    Swal.fire({
        icon: 'warning',
        text: "{{ $message }}",
        showConfirmButton: false,
    });
</script>
@enderror

@error('contact')
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
                    {{ Str::upper('new student') }}
                </button>
                <!-- Modal add-->
                    <form method="POST" action="{{ route('admin.student.store') }}">
                        @csrf
                        <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> {{ Str::upper('new student') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student ID</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="studentID" value="{{ old('studentID') }}" aria-describedby="emailHelp" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student firstname</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="firstname" value="{{ old('firstname') }}" aria-describedby="emailHelp" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student middlename</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="middlename" value="{{ old('middlename') }}" aria-describedby="emailHelp" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student lastname</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="lastname" value="{{ old('lastname') }}" aria-describedby="emailHelp" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student contact</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="contact" value="{{ old('contact') }}" aria-describedby="emailHelp" placeholder="Enter name">
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
                        <th scope="col">Student ID</th>
                        <th scope="col">Student full name</th>
                        <th scope="col">Student Contact</th>
                        <th scope="col">Action</th>
                        <th></th>
                        <th scope="col">Generate Qrcode</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($students as $student)
                      <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->lastname.' '. $student->firstname.' , '.$student->middlename }}</td>
                        <td>{{ $student->contact }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#updateModal-{{ $student->id }}">
                                EDIT
                            </button>
                            <!-- Modal update-->
                                <form method="POST" action="{{ route('admin.student.update',$student->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal fade" id="updateModal-{{ $student->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> {{ Str::upper('update student') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Student ID</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="studentID" value="{{ $student->student_id }}" aria-describedby="emailHelp" placeholder="Enter name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Student firstname</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="firstname" value="{{ $student->firstname }}" aria-describedby="emailHelp" placeholder="Enter name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Student middlename</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="middlename" value="{{ $student->middlename }}" aria-describedby="emailHelp" placeholder="Enter name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Student lastname</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="lastname" value="{{ $student->lastname }}" aria-describedby="emailHelp" placeholder="Enter name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Student contact</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="contact" value="{{ $student->contact }}" aria-describedby="emailHelp" placeholder="Enter name">
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
                            <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#deleteModal-{{ $student->id }}">
                                DELETE
                            </button>
                            <!-- Modal update-->
                                <form method="POST" action="{{ route('admin.student.destroy',$student->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal fade" id="deleteModal-{{ $student->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> {{ Str::upper('remove student') }}</h5>
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
                        <td>
                            <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#qrCodeModal-{{ $student->id }}">
                            <i class="fa fa-qrcode"></i>
                            </button>
                             <!-- Modal qrcode-->
                                <div class="modal fade" id="qrCodeModal-{{ $student->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> {{ Str::upper('student qrcode') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <p>{{ $student->lastname . ' ' . $student->firstname . ', ' . $student->middlename . ', ' . $student->student_id }}</p>
                                            <canvas id="qrCodeCanvas-{{ $student->id }}" width="500" height="500"></canvas>
                                            <a class="btn btn-info btn-sm" id="downloadLink-{{ $student->id }}" class="downloadLink" href="#" download="qr_code_{{ $student->id }}.png">Download QR Code</a>
                                        </div>
                                        <script>
                                            // Function to generate QR code
                                            function generateQRCode(studentId, studentInfo) {
                                                var qr = new QRious({
                                                    element: document.getElementById(`qrCodeCanvas-${studentId}`),
                                                    value: studentInfo,
                                                    size: 500
                                                });

                                                // Update download link href attribute with QR code data URL
                                                var downloadLink = document.getElementById(`downloadLink-${studentId}`);
                                                downloadLink.href = document.getElementById(`qrCodeCanvas-${studentId}`).toDataURL();
                                            }

                                            // Call the function for each student
                                            @foreach($students as $student)
                                                var studentId{{ $student->id }} = "{{ $student->id }}";
                                               // var studentId{{ $student->id }} = "{{ $student->lastname . ' ' . $student->firstname . ', ' . $student->middlename . ', ' . $student->student_id }}";
                                                generateQRCode("{{ $student->id }}", studentId{{ $student->id }});
                                            @endforeach
                                        </script>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                                </div>
                        <!--end modal qrcode-->

                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="card-body">
             {{    $students->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
          </div>
    </div>
</div>
</div>

@endsection
