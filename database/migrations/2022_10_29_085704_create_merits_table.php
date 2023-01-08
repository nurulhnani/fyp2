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
        Schema::create('merits', function (Blueprint $table) {
            $table->id();
            $table->string('merit_name');
            $table->string('type');
            $table->string('level');
            $table->integer('merit_point');
            $table->string('achievement')->nullable();
            $table->string('desc')->nullable();
            $table->date('date');
            $table->string('student_mykid');
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
        Schema::dropIfExists('merits');
    }
};
