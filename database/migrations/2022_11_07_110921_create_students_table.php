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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('status');
            $table->string('name');
            $table->string('mykid');
            $table->unsignedBigInteger('classlist_id')->nullable();
            $table->string('gender')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('address')->nullable();
            $table->string('G1_name')->nullable();
            $table->string('G1_relation')->nullable();
            $table->string('G1_phonenum')->nullable();
            $table->integer('G1_income',false,false)->nullable();
            $table->string('G2_name')->nullable();
            $table->string('G2_relation')->nullable();
            $table->string('G2_phonenum')->nullable();
            $table->integer('G2_income',false,false)->nullable();
            $table->string('image_path')->nullable();
            $table->string('additional_Info')->nullable();
            $table->foreign('classlist_id')->references('id')->on('classlists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
