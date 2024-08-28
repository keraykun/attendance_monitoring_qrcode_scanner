<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $teachers = User::where('role','teacher')->paginate(10);
        if($search){
            $teachers = User::where('role','teacher')->where(function($query) use($search){
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            })->paginate(10);
        }
        return view('admin.teacher.index')->with(compact('teachers'));
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
      //  return $request;
        $request->validate([
            'teacher'=>['required'],
            'email'=>['required','unique:users,email'],
            'password' =>['required','confirmed'],
        ]);

        User::create([
            'name'=>$request->teacher,
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>'teacher',
        ]);
        return redirect()->back()->with('updated','Successfull updated');
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
    public function update(Request $request, User $teacher)
    {

        $request->validate([
            'teacher'=>['required'],
            'email'=>['required','unique:users,email'],
            'password' =>['required','confirmed'],
        ]);

        $teacher->update([
            'name'=>$request->teacher,
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>'teacher',
        ]);
        return redirect()->back()->with('updated','Successfull updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $teacher)
    {
        User::destroy($teacher->id);
        return redirect()->back()->with('deleted','Successfull deleted');
    }
}
