<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates the boroughs table.
 * This table describes an `Subprefeitura` from
 * Brasil's Territorial and Administrative divisions.
 * 
 * @author Nick <contato@nickgomes.dev>
 */
class CreateBoroughsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boroughs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25)->unique();
            $table->smallInteger('smdu_code')->unique();
            $table->string('octave_region_name', 7);
            $table->string('quinary_region_name', 6);
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
        Schema::dropIfExists('boroughs');
    }
}
