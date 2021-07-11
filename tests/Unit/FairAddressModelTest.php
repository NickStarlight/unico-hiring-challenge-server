<?php

namespace Tests\Unit;

use App\Models\CensusArea;
use App\Models\District;
use App\Models\FairAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FairAddressModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Test wether the relationship has been bound.
     *
     * @return void
     */
    public function test_district_relationship()
    {
        $fairAddress = FairAddress::first();
        $this->assertInstanceOf(District::class, $fairAddress->district);
    }

    /**
     * Test wether the relationship has been bound.
     *
     * @return void
     */
    public function test_census_area_relationship()
    {
        $fairAddress = FairAddress::first();
        $this->assertInstanceOf(CensusArea::class, $fairAddress->censusArea);
    }
}
