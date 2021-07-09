<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates the fair_addresses table.
 * This table describes an address from an open Fair.
 * 
 * @author Nick <contato@nickgomes.dev>
 */
class CreateFairAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fair_addresses', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('number')->nullable();
            $table->string('street', 34);
            $table->string('neighborhood', 20)->nullable();
            $table->string('reference_point', 24)->nullable();
            $table->float('longitude');
            $table->float('latitude');
            $table->foreignId('district_id')->constrained('districts');
            $table->foreignId('census_area_id')->constrained('census_areas');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fair_addresses');
    }
}
