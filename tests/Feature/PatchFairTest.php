<?php

namespace Tests\Feature;

use App\Models\Fair as ModelsFair;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as FakerFactory;
use Illuminate\Testing\Fluent\AssertableJson;

class PatchFairTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Test the return of a patching a fair.
     *
     * @return void
     */
    public function test_patch_fair()
    {
        /** First list all fails and get a random one */
        $fairs = ModelsFair::allRelations()->get();
        $randomFair = $fairs->random(1)->first();

        /** Open a request searching the random name */
        $randomID = $randomFair->id;

        /** Create new fair data using the same faker techniques as the seeders */
        $faker = FakerFactory::create();
        $newData = [
            'name' => $faker->name,
            'pmsp_code' => $faker->numberBetween(100000, 999999),
            'address' =>  [
                'number' => $faker->numberBetween(1, 1000),
                'street' => $faker->text(34),
                'neighborhood' => $faker->text(20),
                'reference_point' => $faker->text(20),
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'district_id' => $randomFair->address->district_id,
                'census_area_id' => $randomFair->address->census_area_id,
            ]
        ];

        /** Send the patch request and assert that the response was successful */
        $response = $this->patchJson("/api/v1/fair/$randomID", $newData);

        /** Get the fair information again from the database */
        $updatedFair = ModelsFair::allRelations()->find($randomID);

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json
                    ->has(
                        'data',
                        fn ($json) =>
                        $json->where('id', $updatedFair->id) // The first eloquent result has the same ID
                            ->where('name', $updatedFair->name) // And the same name
                            ->where('pmsp_code', $updatedFair->pmsp_code) // And the same pmsp_code
                            ->has('address') // contains an address
                            ->has('address.district') // address contains it's district information
                            ->has('address.district.borough') // district object contains it's borough
                            ->has('address.census_area') // address contains it's census_area
                            ->has('address.census_area.census_sector') // and census area contains it's sector
                    )
            );
    }

    /**
     * Test the return of a patching a fair.
     *
     * @return void
     */
    public function test_patch_fair_invalid_inputs()
    {
        /** First list all fails and get a random one */
        $fairs = ModelsFair::allRelations()->get();
        $randomFair = $fairs->random(1)->first();

        /** Open a request searching the random name */
        $randomID = $randomFair->id;

        /** Create new fair data using the same faker techniques as the seeders */
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
        $response = $this->patchJson("/api/v1/fair/$randomID", $newData);

        $response->assertStatus(422);
    }

    /**
     * Test error when attempting to patch nonexistent fair.
     *
     * @return void
     */
    public function test_patch_fair_error_on_nonexistent_id()
    {
        /** 
         * Negative autoincrements don't exist but are valid numbers.
         * I mean, they CAN exist, but not on this DB structure.
         */
        $response = $this->patch("/api/v1/fair/-1");
        $response->assertStatus(404);
    }
}
