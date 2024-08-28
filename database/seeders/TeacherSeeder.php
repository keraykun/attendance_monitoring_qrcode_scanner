<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i <5 ; $i++) {
            $this->faker = Faker::create();
             User::factory()->create([
                'name' => $this->faker->name(),
                'email' =>  $this->faker->email(),
                'role'=>'teacher',
                'password' =>Hash::make('password'),
            ]);
          }
    }
}
