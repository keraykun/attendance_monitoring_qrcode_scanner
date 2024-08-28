<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $rooms = Room::paginate(10);
        if($search){
            $rooms = Room::where('name', 'like', '%' . $search . '%')->paginate(10);
        }
        return view('admin.room.index')->with(compact('rooms'));
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
            'room'=>['required','unique:rooms,name'],
        ]);

        Room::create([
            'name'=>$request->room,
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
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room'=>['required'],
        ]);

        $room->update([
            'name'=>$request->room,
        ]);
        return redirect()->back()->with('updated','Successfull updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        Room::destroy($room->id);
        return redirect()->back()->with('deleted','Successfull deleted');
    }
}
