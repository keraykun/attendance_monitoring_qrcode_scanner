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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="input-group">
                            <!-- Search icon -->
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <!-- Input field -->
                            <input type="text" class="form-control" placeholder="Search Student . . ." id="exampleInput" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- Button trigger dropdown -->
                            <div class="input-group-append">
                            <button id="searchStudent" class="btn btn-outline-secondary" type="button">Search</button>
                            <!-- Dropdown menu -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Student id</th>
                                <th scope="col">Student name</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="studentSearchTable">

                            </tbody>
                        </table>
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
                <th></th>
              </tr>
            </thead>
            <tbody id="studentList">

            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
            fetchScheduleList();
            function fetchScheduleList() {
                var scheduleID = $("#scheduleID").val();
                var url = "{{ route('admin.schedule.list', ['schedule' => ':schedule']) }}";
                url = url.replace(':schedule', scheduleID);
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(response) {
                        $("#studentList").empty();
                        $("#studentList").html(response);

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error here
                    }
                });
            }


            $(document).on('click', '.add-student-btn', function(){
                     var scheduleID = $("#scheduleID").val();
                    var studentId = $(this).data('student-id');
                    // Make a POST request to the admin.studentschedule.store route
                    $.ajax({
                        url: '{{ route("admin.studentschedule.store") }}',
                        method: 'POST',
                        data: {
                            studentID: studentId,
                            scheduleID:scheduleID,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response){
                            console.log(response)
                            // Handle success response
                            if(response.ok){
                                fetchScheduleList()
                                Swal.fire({
                                    icon: 'success',
                                    text: response.ok
                                });
                            }else if(response.error){
                                Swal.fire({
                                    icon: 'warning',
                                    text: response.error
                                });
                            }
                        },
                        error: function(xhr, status, error){
                            // Handle error response
                            console.log(xhr.responseText);
                        }
                    });
                });

            $('#searchStudent').click(function(){
                var searchQuery = $('#exampleInput').val();
                if($('#exampleInput').val()==''){
                    console.log('empty')
                    return false;
                }
                var url = "{{ route('admin.student.show', ['student' => ':student']) }}";
                url = url.replace(':student', searchQuery);
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: { query: searchQuery },
                    success: function(response){
                        $("#studentSearchTable").html(response);

                    },
                    error: function(xhr, status, error){
                        // Handle the error response
                        console.log(xhr.responseText);
                    }
                });
            });

    });
    </script>
</div>
</div>

@endsection
