<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aws', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('client');
            $table->integer('tour_number')->nullable();
            $table->date('loading_date');
            $table->integer('coli');
            $table->integer('led');
            $table->string('coverage');
            $table->integer('wm_quantity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aws');
    }
}
