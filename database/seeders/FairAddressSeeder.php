<?php

namespace Database\Seeders;

use App\Models\CensusArea;
use App\Models\District;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FairAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        DB::table('fair_addresses')->insert([
            [
                'number' => $faker->numberBetween(1, 1000),
                'street' => $faker->text(34),
                'neighborhood' => $faker->text(20),
                'reference_point' => $faker->text(20),
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'district_id' => District::first()->id,
                'census_area_id' => CensusArea::first()->id,
            ],
            [
                'number' => $faker->numberBetween(1, 1000),
                'street' => $faker->text(34),
                'neighborhood' => $faker->text(20),
                'reference_point' => $faker->text(20),
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'district_id' => District::first()->id,
                'census_area_id' => CensusArea::first()->id,
            ],
            [
                'number' => $faker->numberBetween(1, 1000),
                'street' => $faker->text(34),
                'neighborhood' => $faker->text(20),
                'reference_point' => $faker->text(20),
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'district_id' => District::first()->id,
                'census_area_id' => CensusArea::first()->id,
            ],
        ]);
    }
}
