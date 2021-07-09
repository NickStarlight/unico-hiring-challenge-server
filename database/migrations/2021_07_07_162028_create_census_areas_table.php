<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates the census_areas table.
 * This table describes an `Area de Ponderação` from
 * Brasil IBGE.
 * 
 * @author Nick <contato@nickgomes.dev>
 */
class CreateCensusAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('census_areas', function (Blueprint $table) {
            $table->id();
            $table->string('code', 15)->unique();
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
        Schema::dropIfExists('census_areas');
    }
}
