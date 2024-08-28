<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $students = Student::paginate(10);
        if($search){
            $students = Student::where(function($query) use($search){
                $query->where('contact', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('student_id', 'like', '%' . $search . '%')
                ->orWhere('middlename', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%')
                ->orWhereRaw("CONCAT(lastname, ' ', firstname, ' , ', middlename) LIKE ?", ['%' . $search . '%']);
            })->paginate(10);
        }
        return view('admin.student.index')->with(compact('students'));
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
        $students = Student::where(function($query) use($student){
            $query->where('contact', 'like', '%' . $student . '%')
            ->orWhere('firstname', 'like', '%' . $student . '%')
            ->orWhere('student_id', 'like', '%' . $student . '%')
            ->orWhere('middlename', 'like', '%' . $student . '%')
            ->orWhere('lastname', 'like', '%' . $student . '%')
            ->orWhereRaw("CONCAT(lastname, ' ', firstname, ' , ', middlename) LIKE ?", ['%' . $student . '%']);
        })->get();

        $html = ''; // Initialize an empty string to store HTML output

        foreach ($students as $student) {
            $html .= '<tr>';
            $html .= '<td>' . $student->student_id . '</td>';
            $html .= '<td>' . $student->lastname . ' ' . $student->firstname . ' , ' . $student->middlename . '</td>';
            $html .= '<td><button data-student-id="'.$student->id.'" type="button" class="btn btn-sm btn-info add-student-btn">ADD</button></td>';
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
    public function destroy(Student $student)
    {
        Student::destroy($student->id);
        return redirect()->back()->with('deleted','Successfull deleted');
    }
}
