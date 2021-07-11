<?php

namespace Tests\Feature;

use App\Models\CensusArea;
use App\Models\District;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as FakerFactory;

class PostFairTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Test the return of a creating a fair.
     *
     * @return void
     */
    public function test_post_fair()
    {
        /** Create new fair data using the same faker techniques as the seeders */
        $faker = FakerFactory::create();
        $newData = [
            'name' => $faker->name,
            'pmsp_code' => strval($faker->numberBetween(100000, 999999)),
            'address' =>  [
                'number' => $faker->numberBetween(1, 1000),
                'street' => $faker->text(34),
                'neighborhood' => $faker->text(20),
                'reference_point' => $faker->text(20),
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'district_id' => District::first()->id,
                'census_area_id' => CensusArea::first()->id,
            ]
        ];

        /** Send the patch request and assert that the response was successful */
        $response = $this->postJson("/api/v1/fair", $newData);
        $response->assertStatus(200);

        /** Assert that the database has inserted data as expected */
        $this->assertDatabaseHas('fairs', [
            'id' => $response->json()['data']['id'],
            'pmsp_code' => $newData['pmsp_code']
        ]);
        $this->assertDatabaseHas('fair_addresses', $newData['address']);
    }

    /**
     * Test the return of a creating an invalid fair.
     *
     * @return void
     */
    public function test_post_fair_invalid_inputs()
    {
        /** Create new fair data using the same faker techniques as the seeders */
        $faker = FakerFactory::create();
        $newData = [
            'name' => null,
            'pmsp_code' => 'UNICO',
            'address' =>  [
                'number' => 'UNICO',
                'street' => null,
                'neighborhood' => null,
                'reference_point' => null,
                'latitude' => null,
                'longitude' => null,
                'district_id' => null,
                'census_area_id' => null,
            ]
        ];

        /** Send the patch request and assert that the response was successful */
        $response = $this->postJson("/api/v1/fair", $newData);
        $response->assertStatus(422);
    }
}
