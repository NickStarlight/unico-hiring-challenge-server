<?php

namespace Database\Seeders;

use App\Models\FairAddress;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        $addresses = FairAddress::all();

        $fairs = [];
        foreach ($addresses as $address) {
            array_push(
                $fairs,
                [
                    'name' => $faker->name,
                    'pmsp_code' => $faker->numberBetween(100000, 999999),
                    'address_id' => $address->id,
                ]
            );
        }

        DB::table('fairs')->insert($fairs);
    }
}
