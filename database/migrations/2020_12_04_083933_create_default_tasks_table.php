<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort_order');
            $table->enum('status', ['active', 'inactive']);
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();	

            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('default_tasks');
    }
}
