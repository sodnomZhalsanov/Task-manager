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
    protected $connection = 'pgsql';
    public function up(): void
    {
        //
        Schema::create('tasks', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title');
            $table->longText('description');
            $table->string('color');
            $table->date('completed_at');
            $table->date('deadline');
            $table->integer('importance');
            $table->boolean('is_done');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tasks');
    }
};
