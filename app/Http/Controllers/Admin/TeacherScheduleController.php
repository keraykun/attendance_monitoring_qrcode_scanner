<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Student;
use Carbon\Carbon;

class TeacherScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function index(Request $request)
    // {
    //     $search = $request->search;
    //     $schedules = Schedule::with(['room', 'teacher', 'grade'])
    //     ->leftJoin('grades', 'schedules.grade_id', '=', 'grades.id')
    //     ->orderByRaw("CAST(SUBSTRING_INDEX(grades.name, ' ', -1) AS UNSIGNED) ASC")
    //     ->withCount('schedule')
    //     ->paginate(10);

    //     return view('admin.teacherschedule.index')->with(compact('schedules'));
    // }

    public function index(Request $request)
    {
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

        return view('admin.teacherschedule.index')
        ->with(compact(
            'schedules',
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $teacherschedule)
    {

        $schedule = Schedule::where('id',$teacherschedule->id)->with('schedule.student','grade','room','teacher')->first();
        return view('admin.teacherschedule.show')->with(compact('schedule'));
    }

    public function selected(Schedule $schedule, $date)
    {

        // Convert the date string to a Carbon instance
        $picked = Carbon::parse($date);

        // Load the schedule details
         $schedule = Schedule::where('id', $schedule->id)->with('grade', 'room', 'teacher')->first();

        return view('admin.teacherschedule.selected')->with(compact('schedule', 'picked'));
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
