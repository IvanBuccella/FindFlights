<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('airports')->insert([
            'name'       => "Buenos Aires / Ezeiza",
            'code'       => "EZE",
            'lat'        => 0.987654321,
            'lng'        => 0.123456789,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('airports')->insert([
            'name'       => "Roma-Fiumicino",
            'code'       => "FCO",
            'lat'        => 0.987654321,
            'lng'        => 0.123456789,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('airports')->insert([
            'name'       => "Milano-Malpensa",
            'code'       => "MXP",
            'lat'        => 0.987654321,
            'lng'        => 0.123456789,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('airports')->insert([
            'name'       => "Milano-Bergamo",
            'code'       => "BGY",
            'lat'        => 0.987654321,
            'lng'        => 0.123456789,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('airports')->insert([
            'name'       => "Milano-Linate",
            'code'       => "LIN",
            'lat'        => 0.987654321,
            'lng'        => 0.123456789,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('airports')->insert([
            'name'       => "Venezia",
            'code'       => "VCE",
            'lat'        => 0.987654321,
            'lng'        => 0.123456789,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('airports')->insert([
            'name'       => "Bologna",
            'code'       => "BLQ",
            'lat'        => 0.987654321,
            'lng'        => 0.123456789,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('airports')->insert([
            'name'       => "Catania",
            'code'       => "CTA",
            'lat'        => 0.987654321,
            'lng'        => 0.123456789,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('airports')->insert([
            'name'       => "Napoli",
            'code'       => "NAP",
            'lat'        => 0.987654321,
            'lng'        => 0.123456789,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('airports')->insert([
            'name'       => "Palermo",
            'code'       => "PMO",
            'lat'        => 0.987654321,
            'lng'        => 0.123456789,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
