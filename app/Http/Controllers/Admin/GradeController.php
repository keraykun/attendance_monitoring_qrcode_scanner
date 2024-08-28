<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $grades = Grade::paginate(10);
        if($search){
            $grades = Grade::where('name', 'like', '%' . $search . '%')->paginate(10);
        }
        return view('admin.grade.index')->with(compact('grades'));
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
            'grade'=>['required','unique:grades,name'],
        ]);

        Grade::create([
            'name'=>$request->grade,
        ]);
        return redirect()->back()->with('created','Successfull created');
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
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'grade'=>['required'],
        ]);

        $grade->update([
            'name'=>$request->grade,
        ]);
        return redirect()->back()->with('updated','Successfull updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        Grade::destroy($grade->id);
        return redirect()->back()->with('deleted','Successfull deleted');
    }
}
