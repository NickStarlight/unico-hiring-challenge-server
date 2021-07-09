<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates the districts table.
 * This table describes an `Distrito` from
 * Brasil's Territorial and Administrative divisions.
 * 
 * @author Nick <contato@nickgomes.dev>
 */
class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 18)->unique();
            $table->string('ibge_code', 9)->unique();
            $table->foreignId('borough_id')->constrained('boroughs');
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
        Schema::dropIfExists('districts');
    }
}
