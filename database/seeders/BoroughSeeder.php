<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoroughSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        DB::table('boroughs')->insert([
            'name' => $faker->text(25),
            'smdu_code' => $faker->numberBetween(1000, 9999),
            'octave_region_name' => $faker->text(5),
            'quinary_region_name' => $faker->text(5),
            'smdu_code' => $faker->numberBetween(1000, 9999),
        ]);
    }
}
