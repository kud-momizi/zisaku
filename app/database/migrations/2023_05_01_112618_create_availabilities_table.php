<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('hospital_id');
            $table->date('date')->nullable();
            $table->time('am_start_time')->nullable();
            $table->time('am_end_time')->nullable();
            $table->time('pm_start_time')->nullable();
            $table->time('pm_end_time')->nullable();
            $table->integer('am_limit');
            $table->integer('pm_limit');
            $table->integer('day_of_week');
            $table->string('note', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availabilities');
    }
}
