<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeds the database for presets.
 * This seeder is used for testing purposes.
 * For inputting real data in the database, please,
 * use the ETL module.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CensusAreaSeeder::class,
            CensusSectorSeeder::class,
            BoroughSeeder::class,
            DistrictSeeder::class,
            FairAddressSeeder::class,
            FairSeeder::class,
        ]);
    }
}
