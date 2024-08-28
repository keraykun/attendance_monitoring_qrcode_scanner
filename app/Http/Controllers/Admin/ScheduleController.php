<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\ScheduleStudents;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $grades = Grade::all();
        $rooms = Room::all();
        $teachers = User::where('role','teacher')->get();

        $search = $request->search;
        $schedules = Schedule::with(['room', 'teacher', 'grade'])
        ->leftJoin('grades', 'schedules.grade_id', '=', 'grades.id')
        ->orderByRaw("CAST(SUBSTRING_INDEX(grades.name, ' ', -1) AS UNSIGNED) ASC")
        ->withCount('schedule') // Use the relationship name 'schedule'
        ->paginate(10);

        if($search){
             $schedules = Schedule::with(['room', 'teacher', 'grade'])
            ->select('*', 'rooms.name as room_name', 'grades.name as grade_name')
            ->leftJoin('grades', 'schedules.grade_id', '=', 'grades.id')
            ->leftJoin('rooms', 'schedules.room_id', '=', 'rooms.id')
            ->leftJoin('users', 'schedules.teacher_id', '=', 'users.id')
            ->orderByRaw("CAST(SUBSTRING_INDEX(grades.name, ' ', -1) AS UNSIGNED) ASC")
            ->withCount('schedule') // Use the relationship name 'schedule'
            ->where('grades.name', 'like', '%' . $search . '%')
            ->orWhere('rooms.name', 'like', '%' . $search . '%')
            ->orWhere('users.name', 'like', '%' . $search . '%')
            ->paginate(10);
        }

        return view('admin.schedule.index')
        ->with(compact(
            'schedules',
            'grades',
            'rooms',
            'teachers'
        ));
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
       //return $request;
       Schedule::create([
            'grade_id'=>$request->grade,
            'room_id'=>$request->room,
            'teacher_id'=>$request->teacher,
       ]);
       return redirect()->back()->with('created','Successfull created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
         $schedule->where('id',$schedule->id)->with('schedule.student','grade','room','teacher')->first();
          return view('admin.schedule.show')->with(compact('schedule'));
    }

    public function list(Schedule $schedule){
        $students = ScheduleStudents::where('schedule_id',$schedule->id)->with('student')->get();

        $html = ''; // Initialize an empty string to store HTML output

        foreach ($students as $scheduleStudent) {
            $html .= '<tr>';
            $html .= '<td>' . $scheduleStudent->student->student_id . '</td>';
            $html .= '<td>' . $scheduleStudent->student->lastname . ' ' . $scheduleStudent->student->firstname . ' , ' . $scheduleStudent->student->middlename . '</td>';
            $html .= '<td>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-' . $scheduleStudent->id . '">DELETE</button>
                <form method="POST" action="' . route('admin.studentschedule.destroy', $scheduleStudent->id) . '">';
                $html .= csrf_field();
                $html .= method_field('DELETE');
                    $html .='<div class="modal fade" id="deleteModal-' . $scheduleStudent->id . '" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">REMOVE STUDENT</h5>
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
            </td>';
            $html .= '</tr>';
        }
        return $html;
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
    public function update(Request $request, Schedule $schedule)
    {
        $schedule->update([
            'grade_id'=>$request->grade,
            'room_id'=>$request->room,
            'teacher_id'=>$request->teacher,
        ]);
        return redirect()->back()->with('updated','Successfull updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {

        Schedule::destroy($schedule->id);
        return redirect()->back()->with('deleted','Successfull deleted');
    }
}
