<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aw_id')->nullable();
            $table->unsignedBigInteger('usual_task_id')->nullable();
            $table->string('name');
            $table->time('start')->nullable();
            $table->time('finish')->nullable();
            $table->char('status', 1)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('closed')->default(0);
            $table->date('date');
            $table->boolean('show_in_plan')->default(1);
            $table->boolean('daily')->default(0);
            $table->string('style')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->foreign('aw_id')->references('id')->on('aws')->onDelete('cascade');
            $table->foreign('usual_task_id')->references('id')->on('usual_tasks')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('task_worker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('worker_id');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
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
        Schema::dropIfExists('tasks');
    }
}
