<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\ScheduleStudents;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.attendance.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $date = date("Y-m-d",strtotime($request->scheduleDate));

        $exist = ScheduleStudents::where(function($query) use($request){
            $query->where('schedule_id', $request->scheduleID)
            ->where('student_id', $request->studentID);
        })->exists();

        if($exist){
            $attendanceExist = Attendance::where(function($query) use($request,$date){
                $query->where('schedule_id', $request->scheduleID)
                ->where('student_id', $request->studentID)
                ->whereDate('date_at', $date);
            })->exists();
            if($attendanceExist){
                return response()->json(['error'=>'Student is already present in this schedule']);
            }else{
                Attendance::create([
                 'schedule_id'=>$request->scheduleID,
                 'student_id'=>$request->studentID,
                  'date_at'=>$date,
                ]);
                $student = Student::where('id',$request->studentID)
                ->with(['list.schedule','list.schedule.grade','list.schedule.room'])->first();
                 return response()->json([
                    'ok' => 'Student : ' . $student->lastname . ' ' . $student->firstname . ' ' . $student->middlename . ' is Present',
                    'room' => 'Room : ' . $student->list->schedule->room->name,
                    'grade' => 'Grade : ' . $student->list->schedule->grade->name,
                ]);
            }
        }else{
            return response()->json(['error'=>'Student not exist in this schedule']);
        }
    }

    public function list(Schedule $schedule ,$date)
    {
       $date = date("Y-m-d",strtotime($date));
        $attendances = Attendance::with('student')->where('schedule_id', $schedule->id)->whereDate('date_at', $date)->get();

        // Generate HTML for table rows
        $html = '<table>';
        $html .= '<tbody>'; // Opening tbody tag
        foreach ($attendances as $attendance) {
            $html .= '<tr>';
            $html .= '<td>' . $attendance->student->student_id . '</td>';
            $html .= '<td>' . $attendance->student->lastname . ' ' . $attendance->student->firstname . ' ' . $attendance->student->middlename . '</td>';
            $html .= '<td style="color:green;">' . Str::ucfirst($attendance->status). '</td>';
            // Add more columns as needed
            $html .= '</tr>';
        }
        $html .= '</tbody>'; // Closing tbody tag
        $html .= '</table>';

        return $html;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
