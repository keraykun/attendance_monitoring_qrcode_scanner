<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id','id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }


    public function schedule(){
        return $this->hasMany(ScheduleStudents::class,'schedule_id','id');
    }
}
