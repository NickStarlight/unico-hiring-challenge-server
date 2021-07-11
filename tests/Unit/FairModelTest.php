<?php

namespace Tests\Unit;

use App\Models\Borough;
use App\Models\CensusArea;
use App\Models\CensusSector;
use App\Models\District;
use App\Models\Fair;
use App\Models\FairAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FairModelTest extends TestCase
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
    public function test_fair_address_relationship()
    {
        $fair = Fair::first();
        $this->assertInstanceOf(FairAddress::class, $fair->address);
    }

    /**
     * Test the scopeAllRelations function.
     *
     * @return void
     */
    public function test_scopeAllRelations()
    {
        $fair = Fair::allRelations()->first();
        $this->assertInstanceOf(FairAddress::class, $fair->address);
        $this->assertInstanceOf(District::class, $fair->address->district);
        $this->assertInstanceOf(CensusArea::class, $fair->address->censusArea);
        $this->assertInstanceOf(Borough::class, $fair->address->district->borough);
        $this->assertInstanceOf(CensusSector::class, $fair->address->censusArea->censusSector);
    }

    /**
     * Test the scopeFilterByFairName function.
     *
     * @return void
     */
    public function test_scopeFilterByFairName(): void
    {
        /** First we get a random fair */
        $fairs = Fair::get();
        $randomFair = $fairs->random(1)->first();

        /** Then, we apply FilterByFairName on a new query */
        $checkFair = Fair::FilterByFairName($randomFair->name)->first();

        $this->assertEquals($randomFair->name, $checkFair->name);
    }
}
