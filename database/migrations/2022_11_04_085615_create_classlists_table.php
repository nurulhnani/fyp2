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
        Schema::create('classlists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('class_name');
            // $table->unsignedBigInteger('student_id')->nullable();;
            $table->integer('femaleStudent');
            $table->integer('maleStudent');
            $table->string('classroom_teacher');
            // $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classlists');
    }
};
