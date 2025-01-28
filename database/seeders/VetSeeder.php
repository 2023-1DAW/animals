<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vets')->insert([
            "name" => "Cucho",
            "email" => "cucho@vet.org",
            "phone" => "654654654",
            "address" => "calle..."
        ]);
        DB::table('vets')->insert([
            "name" => "Carla",
            "email" => "carla@vet.org",
            "phone" => "987987987"
        ]);
    }
}
