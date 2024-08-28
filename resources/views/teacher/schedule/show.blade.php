@extends('teacher.layout')
@section('content')
<style>
    #calendar {
        width: 100%; /* Adjust as needed */
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><b>Teacher : </b>{{ $schedule->teacher->name }}</li>
                            <li class="list-group-item"><b>Room : </b>{{ $schedule->room->name }}</li>
                            <li class="list-group-item"><b>Grade Year : </b>{{ $schedule->grade->name }}</li>
                            <li class="list-group-item"><b>Date Today : </b>{{ date('M d ,Y') }}</li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" value="{{ $schedule->id }}" name="scheduleID">
                        <a href="{{ route('teacher.schedule.index') }}" class="btn btn-info">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        allDaySlot: false,
        eventConstraint: 'businessHours',
        selectable: true,
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: true,
            hour12: true
        },
        dateClick: function(info) {
            var scheduleId = document.querySelector('input[name="scheduleID"]').value;
            var date = info.dateStr;
            window.location.href = "{{ route('teacher.schedule.selected', ['schedule' => ':schedule', 'date' => ':date']) }}"
                .replace(':schedule', scheduleId)
                .replace(':date', date);
        },
    });

    calendar.render();
});
</script>
@endsection
