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
            'price'          => 10.21,
            'code_departure' => 1,
            'code_arrival'   => 2,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 11.12,
            'code_departure' => 1,
            'code_arrival'   => 3,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 15.78,
            'code_departure' => 1,
            'code_arrival'   => 4,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 5.98,
            'code_departure' => 2,
            'code_arrival'   => 6,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 10.01,
            'code_departure' => 2,
            'code_arrival'   => 7,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 20.66,
            'code_departure' => 2,
            'code_arrival'   => 4,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 17.25,
            'code_departure' => 4,
            'code_arrival'   => 9,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 19.83,
            'code_departure' => 5,
            'code_arrival'   => 6,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 30.45,
            'code_departure' => 6,
            'code_arrival'   => 8,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 2.50,
            'code_departure' => 1,
            'code_arrival'   => 5,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('flights')->insert([
            'price'          => 5.10,
            'code_departure' => 5,
            'code_arrival'   => 2,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        for ($i = 1; $i <= 10; $i++) {
            for ($j = 10; $j >= 1; $j--) {
                if ($i != $j) {
                    DB::table('flights')->insert([
                        'price'          => mt_rand(1, 999),
                        'code_departure' => $i,
                        'code_arrival'   => $j,
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ]);
                    DB::table('flights')->insert([
                        'price'          => mt_rand(1, 999),
                        'code_departure' => $j,
                        'code_arrival'   => $i,
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ]);
                }
            }
        }
    }
}
