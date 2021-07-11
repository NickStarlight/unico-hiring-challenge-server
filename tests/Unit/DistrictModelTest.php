<?php

namespace Tests\Unit;

use App\Models\Borough;
use App\Models\District;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DistrictModelTest extends TestCase
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
        $district = District::first();
        $this->assertInstanceOf(Borough::class, $district->borough);
    }
}
