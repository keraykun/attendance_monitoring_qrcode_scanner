<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
        'name'=>'Flower A'
        ]);
        Room::create([
        'name'=>'Sunset B'
        ]);
        Room::create([
        'name'=>'Blooming C'
        ]);
        Room::create([
        'name'=>'Violet D'
        ]);
    }
}
