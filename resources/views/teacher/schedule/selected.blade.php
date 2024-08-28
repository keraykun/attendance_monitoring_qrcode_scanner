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
    <div class="col-xl-5 col-lg-5 col-md-12  mb-4" style="max-width: 500px;">
        <div class="card">
            <div class="card-body">
                <div style="padding: 10px; width:450px;" id="qr-reader"></div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><b>Teacher : </b>{{ $schedule->teacher->name }}</li>
                    <li id="scheduleID" data-schedule="{{ $schedule->id }}" class="list-group-item"><b>Room : </b>{{ $schedule->room->name }}</li>
                    <li class="list-group-item"><b>Grade Year : </b>{{ $schedule->grade->name }}</li>
                    <li id="scheduleDate" data-date="{{ date($picked) }}" class="list-group-item"><b>Date Picked : </b>{{ date('M d , Y',strtotime($picked)) }}</li>
                  </ul>
            </div>
            <div class="card-footer">
                <input type="hidden" value="{{ $schedule->id }}" name="scheduleID">
                <a href="{{ route('teacher.schedule.index') }}" class="btn btn-info">Back</a>
            </div>
        </div>
    </div>
    <div class="col-xl-7 col-lg-7 col-md-12"  style="max-width: 800px;">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Student id</th>
                <th scope="col">Student name</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody id="studentTable">

            </tbody>
        </table>
        <script type="text/javascript" src="https://unpkg.com/html5-qrcode"></script>
        <script type="text/javascript">

            tableStudent()

            function tableStudent(){
                    var scheduleID = $('#scheduleID').data('schedule');
                    var scheduleDate = $('#scheduleDate').data('date');

                    var url = `{{ route('teacher.attendance.list', ['schedule' => ':schedule', 'date' => ':date']) }}`;
                    url = url.replace(':schedule', scheduleID).replace(':date', scheduleDate);
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(response) {
                            $('#studentTable').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
            }


            function extractTextFromUrl(decodedText) {
                const urlParts = decodedText.split('/');
                const lastPart = urlParts[urlParts.length - 1];
                return decodeURIComponent(lastPart);
            }

            function onScanSuccess(decodedText, decodedResult) {
                const text = extractTextFromUrl(decodedText);
                // console.log("Text scanned:", text);
                sendDataToBackend(text);
            }

            function sendDataToBackend(scannedText) {
                var scheduleID = $('#scheduleID').data('schedule')
                var scheduleDate = $('#scheduleDate').data('date')
                $.ajax({
                    url: "{{ route('teacher.attendance.store') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        studentID: scannedText,
                        scheduleID:scheduleID,
                        scheduleDate: scheduleDate,
                    },
                    success: function(response) {
                        console.log(response)
                    if (response.ok) {
                        tableStudent();
                        Swal.fire({
                            icon: 'success',
                            html: '<div><b>' + response.ok + '</b></div>' +
                                '<div><b>' + response.room + '</b></div>' +
                                '<div><b>' + response.grade + '</b></div>',
                            allowOutsideClick: false,
                        });
                    } else if (response.error) {
                        Swal.fire({
                            icon: 'warning',
                            text: response.error,
                            allowOutsideClick: false,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
                });
            }
            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess);

        </script>
    </div>
</div>
</div>

{{-- <tr>
    <td>{{ $schedule->student->student_id }}</td>
    <td>{{ $schedule->student->lastname.' '.$schedule->student->firstname.' , '.$schedule->student->middlename }}</td>
    <td id="statusCode-{{ $schedule->student->student_id }}"></td>
</tr> --}}
@endsection
