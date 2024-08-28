<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScheduleStudents;
use Illuminate\Http\Request;

class ScheduleStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $exist = ScheduleStudents::where(function($query) use($request){
            $query->where('schedule_id', $request->scheduleID)
            ->where('student_id', $request->studentID);
        })->exists();

        if($exist){
            return response()->json(['error'=>'Student has been already exist']);
        }
        ScheduleStudents::create([
            'schedule_id'=>$request->scheduleID,
            'student_id'=>$request->studentID,
        ]);
        return response()->json(['ok'=>'Student has been added']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ScheduleStudents $scheduleStudents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScheduleStudents $scheduleStudents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScheduleStudents $scheduleStudents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduleStudents $studentschedule)
    {
        ScheduleStudents::destroy($studentschedule->id);
        return redirect()->back()->with('deleted','Successfull deleted');
    }

}

