<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      for ($i=0; $i <100 ; $i++) {
        $this->faker = Faker::create();
        Student::create([
            'student_id' =>$this->faker->unique()->randomNumber(8),
            'firstname'=>$this->faker->firstName(),
            'middlename'=>$this->faker->lastName(),
            'lastname'=>$this->faker->lastName(),
            'contact' =>fake()->randomElement(['091'.$this->faker->numberBetween(00000000,99999999)]),
        ]);
      }
    }
}
