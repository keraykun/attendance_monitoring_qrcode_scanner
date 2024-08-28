<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\ScheduleStudents;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

         $student = Student::with(['list.schedule','list.schedule.grade','list.schedule.room'])->get();
       $id = Auth::id();
       $search = $request->search;
       $students = Student::whereHas('list.schedule',function($query) use($id){
             $query->where('teacher_id',$id);
        })->paginate(10);

        if($search){
            $students = Student::where(function($query) use($search){
                $query->where('contact', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('student_id', 'like', '%' . $search . '%')
                ->orWhere('middlename', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%')
                ->orWhereRaw("CONCAT(lastname, ' ', firstname, ' , ', middlename) LIKE ?", ['%' . $search . '%']);
            })
            ->whereHas('list.schedule',function($query) use($id){
                $query->where('teacher_id',$id);
            })
            ->paginate(10);
        }

        return view('teacher.student.index')->with(compact('students'));
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
        $request->validate([
            'firstname'=>['required'],
            'middlename'=>['required'],
            'lastname'=>['required'],
            'contact'=>['required'],
        ]);

        Student::create([
            'student_id'=>$request->studentID,
            'firstname'=>$request->firstname,
            'middlename'=>$request->middlename,
            'lastname'=>$request->lastname,
            'contact'=>$request->contact,
        ]);
        return redirect()->back()->with('created','Successfull created');
    }

    /**
     * Display the specified resource.
     */
    public function show($student)
    {

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
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'firstname'=>['required'],
            'middlename'=>['required'],
            'lastname'=>['required'],
            'contact'=>['required'],
        ]);

        $student->update([
            'student_id'=>$request->studentID,
            'firstname'=>$request->firstname,
            'middlename'=>$request->middlename,
            'lastname'=>$request->lastname,
            'contact'=>$request->contact,
        ]);
        return redirect()->back()->with('updated','Successfull updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduleStudents $student)
    {


        ScheduleStudents::where('id',$student->id)->delete();
        return redirect()->back()->with('deleted','Successfull deleted');
    }
}
