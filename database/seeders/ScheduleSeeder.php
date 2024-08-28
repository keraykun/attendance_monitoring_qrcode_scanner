<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\ScheduleStudents;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::where('role','teacher')->get() as $teacher) {
           Schedule::create([
            'teacher_id'=>$teacher->id,
            'room_id'=>Room::all()->random()->id,
            'grade_id'=>Grade::all()->random()->id,
           ]);
        }

        foreach (Student::all() as $student) {
            ScheduleStudents::create([
                'student_id'=>$student->id,
                'schedule_id'=>Schedule::all()->random()->id,
            ]);
        }
    }
}
