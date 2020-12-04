<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aw_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aw_id')->nullable();
            $table->string('name');
            $table->integer('aw')->nullable();
            $table->integer('wm')->nullable();

            $table->timestamps();
            $table->foreign('aw_id')->references('id')->on('aws')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aw_items');
    }
}
