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
            $table->uuid('id')->primary();
            $table->uuid('teamID')->onDelete('set null');
            $table->uuid('projectID')->nullable();
            $table->string('title')->nullable(false);
            $table->text('desc')->nullable();
            $table->uuid('assigneeID')->nullable();
            $table->string('status')->default('todo');
            $table->foreign('teamID')->references('id')->on('teams');
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
