<?php

namespace Tests\Feature;

use App\Models\Fair as ModelsFair;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetFairTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Test the return of all fairs.
     *
     * @return void
     */
    public function test_return_all_fairs()
    {
        $response = $this->get('/api/v1/fair');
        $fairs = ModelsFair::allRelations()->simplePaginate(10);

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json
                    ->has('data', $fairs->count()) // Test we returned all the seeded fairs
                    ->has('links') // Test if the pagination objects are rendered
                    ->has('meta') // Test if the meta object is rendered
                    ->has(
                        'data.0', // Assert on the first element that:
                        fn ($json) =>
                        $json->where('id', $fairs->first()->id) // The first eloquent result has the same ID
                            ->where('name', $fairs->first()->name) // And the same name
                            ->where('pmsp_code', $fairs->first()->pmsp_code) // And the same pmsp_code
                            ->has('address') // contains an address
                            ->has('address.district') // address contains it's district information
                            ->has('address.district.borough') // district object contains it's borough
                            ->has('address.census_area') // address contains it's census_area
                            ->has('address.census_area.census_sector') // and census area contains it's sector
                    )
            );
    }

    /**
     * Test the return of a specific fair by name.
     *
     * @return void
     */
    public function test_return_specific_fair_by_query_name_filter()
    {
        /** First list all fails and get a random one */
        $fairs = ModelsFair::allRelations()->get();
        $randomFair = $fairs->random(1)->first();

        /** Open a request searching the random name */
        $randomName = $randomFair->name;
        $response = $this->get("/api/v1/fair?name=$randomName");

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json
                    ->has('data', 1) // Test we returned only one record
                    ->has('links') // Test if the pagination objects are rendered
                    ->has('meta') // Test if the meta object is rendered
                    ->has(
                        'data.0', // Assert on the first element that:
                        fn ($json) =>
                        $json->where('id', $randomFair->id) // The first eloquent result has the same ID
                            ->where('name', $randomFair->name) // And the same name
                            ->where('pmsp_code', $randomFair->pmsp_code) // And the same pmsp_code
                            ->has('address') // contains an address
                            ->has('address.district') // address contains it's district information
                            ->has('address.district.borough') // district object contains it's borough
                            ->has('address.census_area') // address contains it's census_area
                            ->has('address.census_area.census_sector') // and census area contains it's sector
                    )
            );
    }

    /**
     * Test the return of an 404 message when no fair with given name exists.
     *
     * @return void
     */
    public function test_return_empty_when_filtering_fair_by_nonexisting_name()
    {
        /** This name will never exists, those words are not present in faker name metadata. */
        $response = $this->get("/api/v1/fair?name=UNICOHIRINGCHALLENGE");

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json
                    ->has('data', 0) // Test we returned zero records
                    ->has('links') // Test if the pagination objects are rendered
                    ->has('meta') // Test if the meta object is rendered
            );
    }

    /**
     * Test the return of a specific fair by ID.
     *
     * @return void
     */
    public function test_return_specific_fair_by_param_id()
    {
        /** First list all fails and get a random one */
        $fairs = ModelsFair::allRelations()->get();
        $randomFair = $fairs->random(1)->first();

        /** Open a request searching the random name */
        $randomID = $randomFair->id;
        $response = $this->get("/api/v1/fair/$randomID");

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json
                    ->has(
                        'data',
                        fn ($json) =>
                        $json->where('id', $randomFair->id) // The first eloquent result has the same ID
                            ->where('name', $randomFair->name) // And the same name
                            ->where('pmsp_code', $randomFair->pmsp_code) // And the same pmsp_code
                            ->has('address') // contains an address
                            ->has('address.district') // address contains it's district information
                            ->has('address.district.borough') // district object contains it's borough
                            ->has('address.census_area') // address contains it's census_area
                            ->has('address.census_area.census_sector') // and census area contains it's sector
                    )
            );
    }

    /**
     * Test the empty return of a specific fair by nonexistent ID.
     *
     * @return void
     */
    public function test_return_empty_when_getting_fair_by_nonexisting_Id()
    {
        /** 
         * Negative autoincrements don't exist but are valid numbers.
         * I mean, they CAN exist, but not on this DB structure.
         */
        $response = $this->get("/api/v1/fair/-1");
        $response->assertStatus(404);
    }
}
