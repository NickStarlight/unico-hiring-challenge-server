<?php

namespace Database\Seeders;

use App\Models\CensusArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CensusSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('census_sectors')->insert([
            'code' => Str::random(13),
            'census_area_id' => CensusArea::first()->id,
        ]);
    }
}
