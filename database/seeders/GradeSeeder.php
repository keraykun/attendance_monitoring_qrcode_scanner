<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grade::create([
        'name'=>'Grade 7'
        ]);
        Grade::create([
        'name'=>'Grade 8'
        ]);
        Grade::create([
        'name'=>'Grade 9'
        ]);
        Grade::create([
        'name'=>'Grade 10'
        ]);
        Grade::create([
        'name'=>'Grade 11'
        ]);
        Grade::create([
        'name'=>'Grade 12'
        ]);
    }
}
