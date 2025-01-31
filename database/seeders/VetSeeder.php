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
        for ($i = 0; $i < 10; $i++) {
            DB::table('vets')->insert([
                "name" => "nombre$i",
                "email" => "mail$i@vet.org",
                "phone" => "12341234$i",
            ]);
        }
        /*DB::table('vets')->insert([
            "name" => "Cucho",
            "email" => "cucho11@vet.org",
            "phone" => "654654654",
            "address" => "calle..."
        ]);
        DB::table('vets')->insert([
            "name" => "a",
            "email" => "carla22@vet.org",
            "phone" => "987987987"
        ]);*/
    }
}
