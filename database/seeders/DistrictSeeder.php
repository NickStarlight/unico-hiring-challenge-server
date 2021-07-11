<?php

namespace Database\Seeders;

use App\Models\Borough;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        DB::table('districts')->insert([
            'name' => $faker->text(18),
            'ibge_code' => $faker->numberBetween(100000000, 999999999),
            'borough_id' => Borough::first()->id
        ]);
    }
}
