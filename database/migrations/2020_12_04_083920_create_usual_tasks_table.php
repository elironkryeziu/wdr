<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsualTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usual_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('monthly')->default(0);
            $table->boolean('monday')->default(0);
            $table->boolean('tuesday')->default(0);
            $table->boolean('wednesday')->default(0);
            $table->boolean('thursday')->default(0);
            $table->boolean('friday')->default(0);
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

        });

        Schema::create('usualtask_worker', function (Blueprint $table) {
            $table->unsignedBigInteger('usual_task_id');
            $table->unsignedBigInteger('worker_id');
            $table->timestamps();

            $table->foreign('usual_task_id')->references('id')->on('usual_tasks')->onDelete('cascade');
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usual_tasks');
    }
}
