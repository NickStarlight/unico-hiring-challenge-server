<?php

namespace Tests\Unit;

use App\Models\CensusArea;
use App\Models\CensusSector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CensusAreaModelTest extends TestCase
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
    public function test_census_sector_relationship()
    {
        $censusArea = CensusArea::first();
        $this->assertInstanceOf(CensusSector::class, $censusArea->censusSector);
    }
}
