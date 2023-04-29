<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('post_code')->length(7);
            $table->string('ken_name', 8);
            $table->string('city_name', 24);
            $table->string('town_name', 32);
            $table->string('block_name', 64);
            $table->datetime('updated_at')->nullable();
            $table->datetime('created_at')->nullable();
            $table->bigIncrements('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
