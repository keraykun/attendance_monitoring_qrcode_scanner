<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleStudents extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }

    public function schedule(){
        return $this->belongsTo(Schedule::class,'schedule_id','id');
    }
}
