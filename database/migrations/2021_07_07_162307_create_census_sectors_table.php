<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates the census_sectors table.
 * This table describes an `Setor Censitário` from
 * Brasil IBGE.
 * 
 * @author Nick <contato@nickgomes.dev>
 */
class CreateCensusSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('census_sectors', function (Blueprint $table) {
            $table->id();
            $table->string('code', 15)->unique();
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
        Schema::dropIfExists('census_sectors');
    }
}
