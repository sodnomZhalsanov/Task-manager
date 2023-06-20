<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('invites', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('owner_id');
            $table->integer('user_id');
            $table->integer('task_id');
            $table->foreign('task_id')
                ->references('id')->on('tasks')
                ->onDelete('cascade');
            $table->boolean('is_accepted');
            $table->string('token', 16)->unique();
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
        //
        Schema::dropIfExists('invites');
    }
};
