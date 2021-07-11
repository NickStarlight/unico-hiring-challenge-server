<?php

namespace Tests\Feature;

use App\Models\Fair as ModelsFair;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteFairTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Test the deletion of a specific fair.
     *
     * @return void
     */
    public function test_fair_delete_by_id()
    {
        /** First list all fails and get a random one */
        $fairs = ModelsFair::allRelations()->get();
        $randomFair = $fairs->random(1)->first();

        /** Open a request searching the random name */
        $randomID = $randomFair->id;
        $response = $this->delete("/api/v1/fair/$randomID");

        $response->assertStatus(200);

        /** Assert fair is gone from database */
        $this->assertSoftDeleted($randomFair);
    }

    /**
     * Test error when attempting to delete nonexistent fair.
     *
     * @return void
     */
    public function test_fair_delete_error_on_nonexistent_id()
    {
        /** 
         * Negative autoincrements don't exist but are valid numbers.
         * I mean, they CAN exist, but not on this DB structure.
         */
        $response = $this->delete("/api/v1/fair/-1");
        $response->assertStatus(404);
    }
}
