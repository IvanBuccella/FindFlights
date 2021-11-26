<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flights')->insert([
            'price'          => 10.00,
            'code_departure' => 1,
            'code_arrival'   => 2,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 11.00,
            'code_departure' => 1,
            'code_arrival'   => 3,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 15.00,
            'code_departure' => 1,
            'code_arrival'   => 4,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 5.00,
            'code_departure' => 2,
            'code_arrival'   => 6,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 10.00,
            'code_departure' => 2,
            'code_arrival'   => 7,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 20.00,
            'code_departure' => 2,
            'code_arrival'   => 4,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 17.00,
            'code_departure' => 4,
            'code_arrival'   => 9,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 19.00,
            'code_departure' => 5,
            'code_arrival'   => 6,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 30.00,
            'code_departure' => 6,
            'code_arrival'   => 8,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}
